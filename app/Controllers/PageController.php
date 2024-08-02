<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\About;
use App\Models\Role;
use App\Models\HomeGalery;
use App\Models\Section;
use App\Models\SectionDetail;
use App\Models\Agreement;
use App\Models\AgreementDetail;

class PageController extends BaseController
{

	public function home()
	{
		$hg_model = new HomeGalery();
		$imgs = $hg_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();
		$s_model = new Section();
		$sections = $s_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();
		$a_model = new Agreement();
		$agreement = $a_model->first();
		$ad_model = new AgreementDetail();
		$agreement_details = $ad_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();

		$agreement_details = array_chunk($agreement_details, 4);

    return  view('landings/home', [
			'imgs'							=> $imgs,
			'sections'					=> $sections,
			'agreement'					=> $agreement,
			'agreement_details' => $agreement_details
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
		$section = $s_model->where(['id' => $id])->first();
		$sections = $s_model->where(['id !=' => $id])->findAll();
		// var_dump($sections); die;
		$sd_model = new SectionDetail();
		$details = $sd_model->where(['section_id' => $id, 'status' => 'active'])->findAll();
		return view('landings/section', [
			'section' 	=> $section,
			'details'		=> $details,
			'sections'	=> $sections
		]);
	}

	public function section_detail($id){
		$s_model = new SectionDetail();
		$section = $s_model
			->select(['section_details.*', 'sections.title as section'])
			->where(['section_details.id' => $id])
			->join('sections', 'sections.id = section_details.section_id', 'left')
		->first();

		$sections = $s_model->where(['section_id' => $section->section_id])->findAll();

		return view('landings/section_detail', [
			'section'		=> $section,
			'sections'	=> $sections
		]);
	}

}
