<?php

namespace App\Controllers;

use App\Models\CreditRate;
use App\Models\Credit;
use App\Models\User;
use App\Models\Extract;
use App\Models\HistoryUser;

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
			$c_model = new Credit();
			$credits = $c_model
				->select([
					'type',
					'COUNT(*) as total',
					'SUM(IFNULL(value, 0)) as value'
				])
				->where(['user_id' => session('user')->id])
				->groupBy('type')
				->findAll();
			// var_dump($credits); die;
			return  view('pages/user/afiliado', [
				'credits' => $credits,
				'day' => (90 - $diferencia->days)
			]);
		}else{
			$u_model = new User();
			$users = $u_model->where(['status' => 'active', 'role_id' => 3])->countAllResults();
			$last_month = date('Y-m-d 00:00:00', strtotime('-1 month'));
			$total_active_users_last_month = $u_model->where(['status' => 'active', 'role_id' => 3])
			->where('created_at >=', $last_month)
			->countAllResults();

			$c_model = new Credit();
			$credits = $c_model->countAllResults();
			$credits_pendientes = $c_model->where(['credit_status_id' => 2])->countAllResults();

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

			return  view('pages/home', [
				'users_actives'		=> $users,
				'users_new'			=> $total_active_users_last_month,
				'credits_total'		=> $credits,
				'credits_pendiente'	=> $credits_pendientes,
				'extracts_total'	=> $extracts,
				'extract'			=> $extract,

				'history_users'		=> $history_user,
				'credits'			=> $credits_pend,

				'day' 				=> (90 - $diferencia->days)
			]);
		}
	}

	public function simulate(){
		$cr_model = new CreditRate();
		$type_credits = $cr_model
			->select([
				'credit_rates.*',
				'section_details.title as credit_name'
			])
			->join('section_details', 'section_details.id = credit_rates.section_detail_id', 'left')
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
				'security_rates.rate as secutiry_rate'
			])
			->where(['credit_rates.id' => $data->type_credit_id])
			->join('security_rates', 'security_rates.id = credit_rates.security_rates_id', 'left')
		->first();

		
		$valor_tasa  = (float) $type_credit->rate/100;
		$tasa_interes = $valor_tasa + (float) $type_credit->secutiry_rate;
		$mont_value = (float) $data->value;
		
		$cuota = ($mont_value * ($tasa_interes * pow(1 + $tasa_interes, $data->quota_max))) / (pow(1 + $tasa_interes, $data->quota_max) - 1);
		$sald_fina = $mont_value;
		$page = view('pages/pdf/simulate', [
			'mont_value'	=> $mont_value,
			'cuota'			=> $cuota,
			'valor_tasa'	=> $valor_tasa,
			'segu_tasa'		=> $type_credit->secutiry_rate,
			'quota_max'		=> $data->quota_max
		]);
		$mpdf = new Mpdf();

		$mpdf->SetHTMLFooter('
        	<hr>
			<table width="100%">
				<tr>
					<td width="50%" align="left">Software elaborado por IPlanet Colombia SAS</td>
					<td width="50%" align="right">Pagina {PAGENO}/{nbpg}</td>
				</tr>
			</table>
		');

		$mpdf->WriteHTML($page, \Mpdf\HTMLParserMode::HTML_BODY);
		// Guardar el PDF en una variable
		$pdfOutput = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);

		// Convertir el PDF a base64
		$pdfBase64 = base64_encode($pdfOutput);

		$c_model = new Credit();
		$c_model->save([
			'user_id'			=> session('user')->id,
			'credit_status_id'	=> 1,
			'credit_rate_id'	=> $type_credit->id,
			'quota'				=> $data->quota_max,
			'security_rate'		=> $type_credit->secutiry_rate,
			'rate'				=> $type_credit->rate,
			'value'				=> $data->value
		]);

		return $this->respond([
			'pdf' 	=> $pdfBase64,
			'page'	=> $page
		]);
	}

	public function credits(){
		$cr_model = new CreditRate();
		$type_credits = $cr_model
			->select([
				'credit_rates.*',
				'section_details.title as credit_name'
			])
			->join('section_details', 'section_details.id = credit_rates.section_detail_id', 'left')
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
			'pledge'			=> $data->pledge,
			'co_signer'			=> $data->co_signer,
			'observation'		=> $data->observation,
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

	public function about()
  	{
    	return view('pages/about');
  	}

	// PDF

	public function generate_pdf(){

	}

}
