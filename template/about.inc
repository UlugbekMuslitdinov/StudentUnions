<?php
require_once('C:/xampp/htdocs/project/template/global.inc');

function about_start($page_options){
  global $page_options;
  $section_options['header_image'] = '/template/images/banners/about.png';
  $section_options['no_sidenav'] = false;
  $section_options['nav']['About']['Send Feedback (General)'] = array('link' => '/marketing/ask.php', 'sname' =>'feedback');

  $section_options['nav']['About']['Staff Directory']['link'] = '/about/directory/index.php';
  $section_options['nav']['About']['Staff Directory']['sname'] = 'directory';

  $section_options['nav']['About']['Photo Gallery']['link'] = '/about/gallery/index.php';
  $section_options['nav']['About']['Photo Gallery']['sname'] = 'photo-gallery';

  $section_options['nav']['About']['Student Jobs']['link'] = '/employment/index.php';
  $section_options['nav']['About']['Student Jobs']['sname'] = 'student-jobs';

  // $section_options['nav']['About']['Student HR Department']['link'] = '/about/student_hr';
  $section_options['nav']['About']['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
  $section_options['nav']['About']['Arizona Applied Leadership Program (AALP)']['sname'] = 'aalp';

  $section_options['nav']['About']['Mission Statement']['link'] = '/about/mission.php';
  $section_options['nav']['About']['Mission Statement']['sname'] = 'mission-statement';

  $section_options['nav']['About']['Union Factoids & Features']['link'] = '/about/morethan.php';
  $section_options['nav']['About']['Union Factoids & Features']['sname'] = 'morethan';
  // $section_options['nav']['About']['Outstanding UA Achievements']['link'] = '/about/bell/index.php';
  $section_options['nav']['About']['Recycling']['link'] = '/sustainability/index.php';
  $section_options['nav']['About']['Recycling']['sname'] = 'sustainability';
  
  // changed history.php to /about/history.php so that it would work everywhere
  $section_options['nav']['About']['History']['link'] = '/about/history.php';
  $section_options['nav']['About']['History']['sname'] = 'history';

  $section_options['nav']['About']['Construction']['link'] = '/construction/index.php';
  $section_options['nav']['About']['Construction']['sname'] = 'construction';

  $page_options = array_merge($section_options, $page_options);
  
  page_start($page_options);
}

function about_finish(){
  page_finish();
}
