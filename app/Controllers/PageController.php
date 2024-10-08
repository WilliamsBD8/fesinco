<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\About;
use App\Models\AboutDetail;
use App\Models\Role;
use App\Models\HomeGalery;

use App\Models\Category;

use App\Models\Section;
use App\Models\SectionDetail;
use App\Models\Agreement;
use App\Models\AgreementDetail;
use App\Models\InfoTeam;
use App\Models\ContactTopic;
use App\Models\General;
use App\Models\Payment;

use CodeIgniter\API\ResponseTrait;

class PageController extends BaseController
{
    use ResponseTrait;

	public function home()
	{
		$hg_model = new HomeGalery();
		$imgs = $hg_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();

		$c_model = new Category();
		$category_1 = $c_model->where(['id' => 1])->first();
		$category_1->details = $c_model->getSection(1);

		$a_model = new About();
		$about = $a_model->find(1);
		$ad_model = new AboutDetail();

		$about->details = $ad_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();

		$s_model = new Section();
		$agreement = $s_model->where(['category_id' => 2, 'status' => 'active'])->orderBy('position', 'ASC')->first();
		$agreement->details = $s_model->getDetails($agreement->id);

		$publication = $c_model->where(['id' => 4])->first();
		$publication->details = $c_model->getSection($publication->id);

		$it_model = new InfoTeam();
		$teams = $it_model->first();
		$teams->teams = $it_model->getTeams();

		
		$g_model = new General();
		$info = $g_model->first();

		$p_model = new Payment();
		$payments = $p_model->where(['status' => 'Activo'])->orderBy('position', 'ASC')->findAll();

		// var_dump($publication); die;

    	return  view('landings/home', [
			'imgs'			=> $imgs,
			'category_1'	=> $category_1,
			'about'			=> $about,
			'agreement'		=> $agreement,
			'publication'	=> $publication,
			'teams'			=> $teams,
			'general'		=> $info,
			'payments'		=> $payments
		]);
	}

	public function about_us(){
		$about_model = new About();
		$about = $about_model->first();
		$r_model = new Role();
		$roles = $r_model->whereIn('id', [4,5,6])->findAll();
		$u_model = new User();
		$users = $u_model->where(['role_id' => 7])->findAll();
		foreach ($roles as $key => $rol) {
			$rol->users = $r_model->getUsers($rol->id);
		}
    	return  view('landings/about_us', [
			'about' => $about,
			'roles'	=> $roles,
			'teams'	=> $users
		]);
	}

	public function contact($tema = null){
    	return  view('landings/contact', [
			'tema' => $tema
		]);
	}

	public function section($id){
		$s_model = new Section();
		$sd_model = new SectionDetail();
		$section = $s_model->where(['id' => $id])->first();
		$section->details = $sd_model->where(['section_id' => $section->id, 'status' => 'active'])->orderBy('position', 'ASC')->paginate(9, '');
		$section->pager = $sd_model->pager;
		$sections = $s_model
			->select([
				'sections.*',
				'COUNT(section_details.id) as total'
			])
			->join('section_details', 'section_details.section_id = sections.id', 'left')
			->where(['sections.id !=' => $id, 'sections.category_id' => $section->category_id])
			->groupBy('sections.id')->findAll();

		$ids = array_map(function($objeto) {
			return $objeto->id;
		}, $section->details);
		
		// var_dump($section); die;

		if(!empty($ids))
			$sec_recient = $s_model->getDetailsBasic($id)
				->whereNotIn('id', $ids)
				->orderBy('id', 'DESC')
				->limit(5)->get()->getResult();
		else $sec_recient = [];
		return view('landings/section', [
			'section' 	=> $section,
			'sections'	=> $sections,
			'recents'	=> $sec_recient
		]);
	}

	public function section_detail($id){
		$sd_model = new SectionDetail();
		$s_model = new Section();
		$section = $sd_model
			->select(['section_details.*', 'sections.title as section', 'sections.category_id as category_id'])
			->where(['section_details.id' => $id])
			->join('sections', 'sections.id = section_details.section_id', 'left')
		->first();
		
		// var_dump($section); die;

		$sections = $s_model
			->select([
				'sections.*',
				'COUNT(section_details.id) as total'
			])
			->join('section_details', 'section_details.section_id = sections.id', 'left')
			->where(['sections.id !=' => $section->section_id, 'sections.category_id' => $section->category_id])
			->groupBy('sections.id')->findAll();

		$sec_recient = $s_model->getDetailsBasic($section->section_id)
			->whereNotIn('id', [$id])
			->orderBy('id', 'DESC')
			->limit(5)->get()->getResult();
			
		// var_dump([$sec_recient, $id]); die;

		return view('landings/section_detail', [
			'section'	=> $section,
			'sections'	=> $sections,
			'recents'	=> $sec_recient
		]);
	}

	public function sections($id){
		$s_model = new Section();
		$section = $s_model->where(['id' => $id])->first();
		$section->details = $s_model->getDetails($id);
		return view('landings/sections', [
			'section' => $section
		]);
	}

	public function sendContact(){
		$data = $this->request->getJson();
		try{
			$ct_model = new ContactTopic();
			$contact_topic = $ct_model->where(['id' => $data->subject])->first();
			$email = new EmailController();
			$text = "
				<b>Nombre: </b>{$data->name}<br>
				<b>Correo: </b>{$data->email}<br>
				<b>Mensaje: </b>{$data->message}
			";
			$response = $email->send('wabox324@gmail.com', 'wabox', $contact_topic->email, $contact_topic->title, $text);
			return $this->respond(['status' => $response->status, 'msg' => $response->status ? 'Mensaje enviado con exíto' : 'Error al enviar el correo.']);
		}catch(\Exception $e){
			return $this->respond(['status' => false, 'msg' => $e->getMessage()]);
		}
	}

}
