<?php
  use App\Models\General;
  use App\Models\SocialNetwork;
  use App\Models\Section;
  use App\Models\SectionDetail;
  use App\Models\ContactTopic;

  function config_page(){
    $g_model = new General();
    $info = $g_model->first();
    return $info;
  }

  function social_networks(){
    $sn_model = new SocialNetwork();
    $info = $sn_model->where(['status' => 'active'])->findAll();
    return $info;
  }

  function sections(){
    $s_model = new Section();
    $sections = $s_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();
    $sd_model = new SectionDetail();
    foreach($sections as $section){
      $section->details = $sd_model->where(['section_id' => $section->id])->orderBy('position', 'ASC')->findAll();
    }
    return $sections;
  }

  function contact_topics(){
    $ct_model = new ContactTopic();
    $info = $ct_model->where(['status' => 'active'])->orderBy('position', 'ASC')->findAll();
    return $info;
  }
?>