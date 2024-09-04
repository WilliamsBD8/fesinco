<?php

namespace App\Controllers;

use App\Models\CreditRate;
use App\Models\Credit;
use App\Models\User;
use App\Models\Extract;
use App\Models\HistoryUser;
use App\Models\ExtractsContributions;
use App\Models\ExtractsWallet;
use App\Models\Pqr;
use App\Models\Password;

use App\Models\LineCreditExtract;

use App\Models\CreditStatus;

use Mpdf\Mpdf;

use CodeIgniter\API\ResponseTrait;

class DashboardController extends BaseController
{
    use ResponseTrait;

	public function index()
	{

		$fechaEspecifica = new \DateTime(session('user')->password->created_at);
		$fechaActual = new \DateTime('now');
		$diferencia = $fechaEspecifica->diff($fechaActual);

		if(session('user')->role_id == 3){
			$cs_model = new CreditStatus();
			$credits = $cs_model
				->select([
					'SUM(IFNULL(value, 0)) as value',
					'IFNULL(COUNT(credits.id), 0) as total',
					'credit_status.name',
					'credit_status.id'
				])
				->join('credits', 'credits.credit_status_id = credit_status.id and credits.user_id ='.session('user')->id, 'left')
				->join('users', 'users.id = credits.user_id', 'left')
				// ->where(['credits.user_id' => ])
				->groupBy('credit_status.id')
				->orderBy('credit_status.id', 'ASC')
				->findAll();
			// return $this->respond($credits);

			$pqr_model = new Pqr();

			$pqrs_total = $pqr_model->where(['user_id' => session('user')->id])->countAllResults();
			$pqrs_total_mes = $pqr_model->where([
					'user_id' => session('user')->id,
					'MONTH(created_at)' => date('m'),
					'YEAR(created_at)' => date('Y'),
				])->countAllResults();

			$pqrs_indicators = (object) [
				'total'	=> $pqrs_total,
				'mes'	=> $pqrs_total_mes
			];

			$pqrs = $pqr_model->where(['user_id' => session('user')->id])->orderBy('updated_at', 'DESC')->limit(5)->get()->getResult();
			return  view('pages/user/afiliado', [
				'credits'	=> $credits,
				'day' 		=> (90 - $diferencia->days),
				'pqrs'		=> $pqrs,
				'pqrs_indi'	=> $pqrs_indicators
			]);
		}else{
			$u_model = new User();
			$users = $u_model->where(['status' => 'active', 'role_id' => 3])->countAllResults();
			$last_month = date('Y-m');
			$total_active_users_last_month = $u_model->where(['status' => 'active', 'role_id' => 3])
			->like('created_at', "%{$last_month}%")
			->countAllResults();
			
			$c_model = new Credit();
			$credits = $c_model->where(['credit_status_id >' => 1])->countAllResults();
			$credits_pendientes = $c_model->where(['credit_status_id' => 2])->countAllResults();

			$p_model  = new Pqr();
			$pqrs_t = $p_model->countAllResults();
			$pqrs_p = $p_model->where(['status' => 'Por revisar'])->countAllResults();
			$pqrs = $p_model
				->where(['pqrs.status' => 'Por revisar'])
				->join('users', 'users.id = pqrs.user_id', 'left')
				->orderBy('pqrs.created_at', 'DESC')->limit(5)->get()->getResult();

			
			$e_model = new Extract();
			$extracts = $e_model->countAllResults();
			$extract = $e_model->where(['status' => 'Cargado'])->orderBy('date', 'DESC')->first();
			
			$hu_model = new HistoryUser();
			$history_user = $hu_model
			->select(['users.name', 'MAX(history_users.created_at) as created_at'])
			->join('users', 'users.id = history_users.user_id', 'left')
			->groupBy('history_users.user_id')->limit(5)->get()->getResult();
			
			$credits_pend = $c_model
			->select([
					'users.name',
					'credits.created_at'
				])
				->where(['credit_status_id' => 2])
				->join('users', 'users.id = credits.user_id')
				->orderBy('credits.created_at', 'ASC')->limit(5)->get()->getResult();
				//die;
				
			return  view('pages/home', [
				'users_actives'		=> $users,
				'users_new'			=> $total_active_users_last_month,

				'credits_total'		=> $credits,
				'credits_pendiente'	=> $credits_pendientes,

				'pqr_total'			=> $pqrs_t,
				'pqrs_pendiente'	=> $pqrs_p,
				'pqrs'				=> $pqrs,

				'extracts_total'	=> $extracts,
				'extract'			=> $extract,

				'history_users'		=> $history_user,
				'credits'			=> $credits_pend,

				'day' 				=> (90 - $diferencia->days)
			]);
		}
	}

	public function load_extracts(){
		// $request = $this->request->getJson();
		$e_model = new Extract();
		$extracts = $e_model->where(['status' => 'Para cargar'])->findAll();
		if(count($extracts) == 1){
			$ec_model = new ExtractsContributions();
			$ew_model = new ExtractsWallet();
			$lce_model = new LineCreditExtract();
			$line_credits = $lce_model->findAll();
			$extract = $extracts[0];
			$file_con = FCPATH . 'upload/extracts/' . $extract->contributions_file;
			$file_wal = FCPATH . 'upload/extracts/' . $extract->wallet_file;

			$errors = [];
			$wallets_data = [];
			$contrib_data = [];

			$error_format = [];

			$new_users = 0;

			if(file_exists($file_wal)){
				$wallets = fopen($file_wal, "r");
				if($wallets){
					$aux_cont=0;
					while (($data = fgetcsv($wallets, 1000, ";")) !== FALSE) {
						if($aux_cont <> 0){
							$line_credit = 0;
							foreach ($line_credits as $key => $credit) {
								if($credit->code == $data[6])
									$line_credit = $credit->id;
							}
							if($line_credit == 0)
								$errors[] =  $data[6];
							$wallets_data[] = $data;
						}else{
							if(count($data) != 14)
								$error_format[] = "Error al leer los datos del archivo de cartera.";
						}
						$aux_cont++;
					}
				}
			} else {
				return $this->respond([
					'message' 	=> "El archivo {$extract->wallet_file} no existe.",
					'file' 		=> $file_wal,
					'status'	=> false
				]);
			}

			if (file_exists($file_con)) {
				$contributions = fopen($file_con, "r");
				if($contributions){
					$aux_cont=0;
					while (($data = fgetcsv($contributions, 1000, ";")) !== FALSE) {
						if($aux_cont == 0){
							if(count($data) != 16)
								$error_format[] = "<br>Error al leer los datos del archivo aportes.";
						}else{
							$contrib_data[] = $data;
						}
						$aux_cont++;
					}
				}
			} else {
				return $this->respond([
					'message' 	=> "El archivo {$extract->contributions_file} no existe.",
					'file' 		=> $file_con,
					'status'	=> false
				]);
			}

			if(count($error_format) > 0){
				return $this->respond([
					'errors_format' 	=> $error_format,
					'status'	=> false
				]);
			}else if(count($errors) > 0){
				return $this->respond([
					'message' 	=> "No se pudo cargar el extracto ya que no existen todos los codigos en la linea de crédito.",
					'data' 		=> $errors,
					'status'	=> false
				]);
			}

			foreach ($wallets_data as $key => $data) {
				$u_model = new User();
				$user = $u_model->where(['identification' => $data[1]])->first();
				if(empty($user)){
					$u_model->save([
						'name'              => 'NN',
						'email'             => 'NN',
						'username'          => $data[1],
						'identification'    => $data[1],
						'status'            => 'active',
						'photo'             => '',
						'role_id'           => 3
					]);
					$user_id = $u_model->insertID();
					$p_model = new Password();
					$p_model->save([
						'user_id'   => $user_id,
						'password'  => password_hash($data[1], PASSWORD_DEFAULT),
						'temporary'	=> 'Si'
					]);
					$new_users++;
				}else $user_id = $user->id;

				$line_credit = 0;

				foreach ($line_credits as $key => $credit) {
					if($credit->code == $data[6])
						$line_credit = $credit->id;
				}

				if($line_credit != 0){
					$ew_model->save([
						'user_id'					=> $user_id,
						'registro'					=> $data[0],
						'feccorte'					=> convierte_fecha_mysql($data[2]),
						'fecsolici'					=> convierte_fecha_mysql($data[3]),
						'fecfinal'					=> convierte_fecha_mysql($data[4]),
						'numero'					=> $data[5],
						'line_credit_extract_id'	=> $line_credit,
						'tasanual'					=> $data[7],
						'tasmes'					=> $data[8],
						'valor'						=> $data[9],
						'ctapact'					=> $data[10],
						'ctapend'					=> $data[11],
						'valcta'					=> $data[12],
						'saldo'						=> $data[13],
						'fecha_cargue'				=> $extract->date,
					]);
				}
			}
	
			foreach ($contrib_data as $data) {
				if($aux_cont <> 0){
					$u_model = new User();
					$user = $u_model->where(['identification' => $data[1]])->first();
					if(empty($user)){
						$u_model->save([
							'name'              => 'NN',
							'email'             => 'NN',
							'username'          => $data[1],
							'identification'    => $data[1],
							'status'            => 'active',
							'photo'             => '',
							'role_id'           => 3
						]);
						$user_id = $u_model->insertID();
						$p_model = new Password();
						$p_model->save([
							'user_id'   => $user_id,
							'password'  => password_hash($data[1], PASSWORD_DEFAULT),
							'temporary'	=> 'Si'
						]);
						$new_users++;
					}else $user_id = $user->id;
					$ec_model->save([
						'user_id' 		=> $user_id,
						'numero' 		=> $data[0],
						'fecha' 		=> convierte_fecha_mysql($data[2]),
						'salahoper'		=> $data[3],
						'salahopex'		=> $data[4],
						'salresesp'		=> $data[5],
						'salahovol'		=> $data[6],
						'salahopro'		=> $data[7],
						'salaportes'	=> $data[8],
						'ctaahorro'		=> $data[9],
						'ctaaportes'	=> $data[10],
						'ctareserva'	=> $data[11],
						'total'			=> $data[12],
						'cartera'		=> $data[13],
						'nivelendeu'	=> $data[14],
						'salario'		=> $data[15],
						'fecha_cargue'	=> $extract->date,
					]);
				}
				$aux_cont++;
			}
			
			$e_model->save([
				'id'		=> $extract->id,
				'status'	=> 'Cargado'
			]);

			$message = "Extracto N° {$extract->consecutive} cargado con éxito.";
			$nuevos_usuarios = $new_users == 1 ? "nuevo usuario." : "nuevos usuarios.";
			$message .= $new_users > 0 ? "<br>Con {$new_users} {$nuevos_usuarios}" : "";

			return $this->respond([
				'message' 	=> $message,
				'status'	=> true
			]);
		}else if(count($extracts) == 0){
			return $this->respond(['message' => "No existe un extracto para cargar.", 'status'	=> false]);
		}

		return $this->respond(['message' => "Por favor asegurece que existe un solo extracto para cargar.", 'status'	=> false]);
	}

	public function simulate(){
		$cr_model = new CreditRate();
		$type_credits = $cr_model
			->select([
				'credit_rates.*',
				'line_credit_extracts.name as credit_name'
			])
			->join('line_credit_extracts', 'line_credit_extracts.id = credit_rates.line_credit_extract_id', 'left')
		->findAll();
		return view('pages/simulate', [
			'type_credits' => $type_credits
		]);
	}

	public function create_simulate(){
		$data = $this->request->getJson();
		$cr_model = new CreditRate();
		$type_credit = $cr_model
			->select([
				'credit_rates.*',
				'security_rates.rate as security_rate'
			])
			->where(['credit_rates.id' => $data->type_credit_id])
			->join('security_rates', 'security_rates.id = credit_rates.security_rates_id', 'left')
		->first();

		
		$valor_tasa  = (float) $type_credit->rate / 100;
		$tasa_interes = $valor_tasa + (float) ($type_credit->security_rate / 100);
		$mont_value = (float) $data->value;
		
		$cuota = ($mont_value * ($tasa_interes * pow(1 + $tasa_interes, $data->quota_max))) / (pow(1 + $tasa_interes, $data->quota_max) - 1);
		$sald_fina = $mont_value;
		$page = view('pages/pdf/simulate', [
			'mont_value'	=> $mont_value,
			'cuota'			=> $cuota,
			'valor_tasa'	=> $valor_tasa,
			'segu_tasa'		=> (float) $type_credit->security_rate / 100,
			'quota_max'		=> $data->quota_max,
			'rate'			=> $type_credit->rate,
			'tasa_interes'	=> $tasa_interes
		]);
		// Guardar el PDF en una variable
		$pdfOutput = $this->generate_pdf($page);

		// Convertir el PDF a base64
		$pdfBase64 = base64_encode($pdfOutput);

		$c_model = new Credit();
		$c_model->save([
			'user_id'			=> session('user')->id,
			'credit_status_id'	=> 1,
			'credit_rate_id'	=> $type_credit->id,
			'quota'				=> $data->quota_max,
			'security_rate'		=> $type_credit->security_rate,
			'rate'				=> $type_credit->rate,
			'value'				=> $data->value
		]);

		return $this->respond([
			'pdf' 	=> $pdfBase64,
			'page'	=> $page,
			// 'out'	=> $pdfOutput
		]);
	}

	public function credits(){
		$cr_model = new CreditRate();
		$type_credits = $cr_model
			->select([
				'credit_rates.*',
				'line_credit_extracts.name as credit_name',
				'security_rates.rate as secutiry_rate'
			])
			->join('line_credit_extracts', 'line_credit_extracts.id = credit_rates.line_credit_extract_id', 'left')
			->join('security_rates', 'security_rates.id = credit_rates.security_rates_id', 'left')
		->findAll();
		return view('pages/credits', [
			'type_credits' => $type_credits
		]);
	}

	public function create_credit(){
		$data = $this->request->getJson();
		$cr_model = new CreditRate();
		$type_credit = $cr_model
			->select([
				'credit_rates.*',
				'security_rates.rate as secutiry_rate'
			])
			->where(['credit_rates.id' => $data->type_credit_id])
			->join('security_rates', 'security_rates.id = credit_rates.security_rates_id', 'left')
		->first();

		$base64_file = explode(',', $data->file);
		$binaryData = base64_decode($base64_file[1]);
		$new_name = date('y_m_d_h_i')."_".uniqid().".".explode('.', $data->filename)[1];
		file_put_contents('upload/credits/' . $new_name, $binaryData);

		
		$valor_tasa  = (float) $type_credit->rate/100;
		$tasa_interes = $valor_tasa + (float) $type_credit->secutiry_rate;
		$mont_value = (float) $data->value;

		$c_model = new Credit();
		$credit = [
			'user_id'			=> session('user')->id,
			'credit_status_id'	=> 2,
			'credit_rate_id'	=> $type_credit->id,
			'quota'				=> $data->quota_max,
			'security_rate'		=> $type_credit->secutiry_rate,
			'rate'				=> $type_credit->rate,
			'value'				=> $data->value,
			'file'				=> $new_name,
			'co_signer'			=> $data->co_signer,
			'observation'		=> $data->observation,
			'date_init'			=> $data->date_init,
			'position'			=> $data->position
		];
		if($c_model->save($credit)){
			return $this->respond([
				'status'	=> true,
				'message'	=> 'Crédito solicitado con éxito.'
			]);
		}

		return $this->respond([
			'status'	=> false,
			'message'	=> 'No se pudo solicitar el crédito.'
		]);

	}

	public function updated_credit(){
		$c_model = new Credit();
		$info = $this->request->getJson();
		switch ($info->type) {
			case '1':
				$d_save = [
					'id' => $info->id,
					'credit_status_id' => 2
				];
				$credit = $c_model->where(['id' => $info->id])->first();
				if(empty($credit->file) || $credit->file == '')
					$d_return = [
						'status' 	=> false,
						'message'	=> 'Debe de cargar un archivo.'
					];
				else if($c_model->save($d_save))
					$d_return = [
						'status' 	=> true,
						'message'	=> 'Solicitud realizada con éxito.'
					];
				else 
					$d_return = [
						'status' 	=> false,
						'message'	=> 'Error al generar la solicitud.'
					];
				break;
			case '3':
				$d_save = [
					'id' => $info->id,
					'credit_status_id' => 3
				];
				if($c_model->save($d_save))
					$d_return = [
						'status' 	=> true,
						'message'	=> 'Solicitud aprobada con éxito.'
					];
				else 
					$d_return = [
						'status' 	=> false,
						'message'	=> 'Error al aprobar la solicitud.'
					];
				break;
			
			default:
				$d_save = [
					'id' => $info->id,
					'credit_status_id' => 4
				];
				if($c_model->save($d_save))
					$d_return = [
						'status' 	=> true,
						'message'	=> 'Solicitud rechazada con éxito.'
					];
				else 
					$d_return = [
						'status' 	=> false,
						'message'	=> 'Error al rechazar la solicitud.'
					];
				break;
		}
		return $this->respond($d_return);
	}


	public function extracts($id = null){
		if($id != null && session('user')->role_id == 3)
			return view('errors/html/error_401');
		$id = $id ?? session('user')->id;

		$ec_model = new ExtractsContributions();
		$fechas = $ec_model->select('YEAR(fecha) as year, MONTH(fecha) as mes, user_id as user')->distinct()->orderBy('year', 'ASC')
		->orderBy('mes', 'ASC')->where(['user_id' => $id])->findAll();
		return view('pages/extracts', [
			'fechas' => $fechas
		]);
		return $this->respond($fechas);
		var_dump($fechas);
	}

	public function about()
  	{
    	return view('pages/about');
  	}

	public function extracts_view(){
		$ec_model = new ExtractsContributions();
		$ew_model = new ExtractsWallet();
		$u_model = new User();


		$data = $this->request->getJson();
		$user = $u_model->where(['id' => $data->user])->first();
		$extracts_con = $ec_model->like('fecha', "%{$data->year}-{$data->mes}%")->where(['user_id' => $data->user])->first();
		$extracts_wal = $ew_model->like('feccorte', "%{$data->year}-{$data->mes}%")->where(['user_id' => $data->user])->findAll();
		foreach ($extracts_wal as $key => $extract_wall) {
			$extract_wall->line_credit_wall = $ew_model->getLineCreditExtract($extract_wall->line_credit_extract_id);
		}


		$page = view("pages/pdf/extracts", [
			"extracts_con" 	=> $extracts_con,
			"extracts_wal" 	=> $extracts_wal,
			"user"			=> $user,
			"data"			=> $data
		]);

		// Guardar el PDF en una variable
		$pdfOutput = $this->generate_pdf($page);

		// Convertir el PDF a base64
		$pdfBase64 = base64_encode($pdfOutput);
		return $this->respond([
			'pdf' => $pdfBase64,
			'extracts_wal' => $extracts_wal,
			'extracts_con'	=> $extracts_con,
		]);
	}

	public function generate_pdf_credit($id){
		$c_model = new Credit();
		$u_model = new User();
		$credit = $c_model->where(['id' => $id])->first();
		$user = $u_model->where(['id' => $credit->user_id])->first();

		$valor_tasa  = (float) $credit->rate / 100;
		$tasa_interes = $valor_tasa + (float) ($credit->security_rate / 100);
		$mont_value = (float) $credit->value;
		
		$cuota = ($mont_value * ($tasa_interes * pow(1 + $tasa_interes, (int)$credit->quota))) / (pow(1 + $tasa_interes, (int)$credit->quota) - 1);
		$sald_fina = $mont_value;
		$page = view('pages/pdf/simulate', [
			'mont_value'	=> $mont_value,
			'cuota'			=> $cuota,
			'valor_tasa'	=> $valor_tasa,
			'segu_tasa'		=> (float) $credit->security_rate / 100,
			'quota_max'		=> $credit->quota,
			'rate'			=> $credit->rate,
			'tasa_interes'	=> $tasa_interes,
			'user'			=> $user
		]);

		$name = $credit->credit_status_id == 1 ? "simulacion_{$id}.pdf" : ($credit->credit_status_id == 2 ? "solicitud_{$id}.pdf" : "credito_{$id}.pdf");

		// Guardar el PDF en una variable
		return $this->generate_pdf($page, "D", $name);

		return $this->respond(['data' => $credit]);
	}

	public function generate_pdf_solicity($id){
		$c_model = new Credit();
		$u_model = new User();
		$credit = $c_model
			->select([
				'credits.*',
				'credit_rates.quota_max',
				'line_credit_extracts.name as credit_name'
			])
			->where(['credits.id' => $id])
			->join('credit_rates', 'credit_rates.id = credits.credit_rate_id', 'left')
			->join('line_credit_extracts', 'line_credit_extracts.id = credit_rates.line_credit_extract_id', 'left')
			->first();
		$user = $u_model->where(['id' => $credit->user_id])->first();

		$page = view('pages/pdf/solicity', [
			'credit' 	=> $credit,
			'user'		=> $user
		]);
		
		$this->generate_pdf($page, "I", "solicitud_{$credit->id}.pdf"); die;
		return $this->respond($credit);
	}

	
	// PDF

	private function generate_pdf($page, $return = "S", $name = ""){
		$mpdf = new Mpdf([
			'mode'          => 'utf-8',
			'format'        => 'Letter',
			"margin_left"   => 5,
			"margin_right"  => 5,
			"margin_top"    => 28,
			"margin_bottom" => 17,
			"margin_header" => 0
		]);

		$mpdf->SetHTMLHeader('
			<table class="table-header">
				<tr>
					<td class="header-logo"><img width="105px" src="assets/img/logo-pdf.png"></td>
					<td class="header-text">
						<h1 class="header-title">FESINCO<span class="header-span"> FONDO DE EMPLEADOS DE LA SUPERINTENDENCIA DE INDUSTRIA Y COMERCIO</span></h1>
						<p class="header-par">SOLICITUD DE CRÉDITO CON GARANTÍA DE LIBRANZA Y PRESTACIONES SOCIALES</p>
					</td>
				</tr>
			</table>
		');

		$mpdf->SetHTMLFooter('
        	<hr>
			<table width="100%">
				<tr>
					<td width="50%" align="left">Software elaborado por IPlanet Colombia SAS</td>
					<td width="50%" align="right">Pagina {PAGENO}/{nbpg}</td>
				</tr>
			</table>
		');

		$css  = file_get_contents('assets/css/pdf.css');

		$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($page, \Mpdf\HTMLParserMode::HTML_BODY);
		$output = $mpdf->Output($name, $return);
		return $output;
	}

}
