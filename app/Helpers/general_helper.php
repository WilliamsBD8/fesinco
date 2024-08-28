<?php
  use App\Models\General;
  use App\Models\SocialNetwork;
  use App\Models\Category;
  use App\Models\Section;
  use App\Models\ContactTopic;
  use App\Models\About;

  function config_page(){
    $g_model = new General();
    $info = $g_model->first();
    return $info;
  }

  function getAbout(){
    $a_model = new About();
    $info = $a_model->first();
    return $info;
  }

  function social_networks(){
    $sn_model = new SocialNetwork();
    $info = $sn_model->where(['status' => 'active'])->findAll();
    return $info;
  }

  function sections($id){
    $c_model = new Category();
    $category = $c_model->where(['id' => $id])->first();
    $category->details = $c_model->getSection($id);
    return $category;
  }

  function getSections($ids){
    $s_model = new Section();
    $sections = $s_model->whereIn('category_id', $ids)->findAll();
    if($ids[0] == 3 || $ids[0] == 5){
      $sections = $sections[0];
      $sections->details = $s_model->getDetails($sections->id);
    }else{
      foreach ($sections as $key => $section) {
        $section->details = $s_model->getDetails($section->id);
      }
    }
    
    return $sections;
  }

  function contact_topics(){
    $ct_model = new ContactTopic();
    $info = $ct_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();
    return $info;
  }
?>