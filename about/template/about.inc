<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

function about_start($page_options){
  global $page_options;
  $section_options['header_image'] = '/template/images/banners/about.png';
  $nav['Send Feedback (General)'] = array('link' => '/marketing/ask.php', 'sname' =>'feedback');
  $nav['Staff Directory']['link'] = '/about/directory/index.php';
  $nav['Photo Gallery']['link'] = '/about/gallery/index.php';
  $nav['Student Jobs']['link'] = '/employment/index.php';
  $nav['Student HR Department']['link'] = '/about/student_hr';
  $nav['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
  $nav['Mission Statement']['link'] = '/about/mission.php';
  $nav['Union Factoids & Features']['link'] = '/about/morethan.php';
  // $nav['Outstanding UA Achievements']['link'] = '/about/bell/index.php';
  $nav['Recycling']['link'] = '/sustainability/index.php';
  // changed history.php to /about/history.php so that it would work everywhere
  $nav['History']['link'] = '/about/history.php';
  $nav['Construction']['link'] = '/construction/index.php';
  $nav['Student Unions Advisory Council']['link'] = '/about/suac.php';
  if (!isset($page_options['header_image'])){
    $page_options['header_image'] = '/template/images/banners/about_union_banner.jpg';
  }
  $page_options = array_merge($section_options, $page_options);

  page_start($page_options);
?>
  <div class="col-md-12 wrap-banner-img">
		<img src="<?php echo $page_options['header_image']; ?>" />
  </div>

  <!-- Left Col -->
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/about_leftnav.php";
  print_left_nav($aboutleft_route, $page_options['page'], []);
  ?>

    <div class="col">
      <div class="col-12 mt-4">
<?php
}

function about_finish(){
?>
  </div></div>
<?php
  page_finish();
}
