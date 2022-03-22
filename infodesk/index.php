<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/infodesk/template/infodesk.main.php');
  $page_options['title'] = 'Information Desk';
  $page_options['nav']['Information Desk']['Hours of Operation']['link'] = '/infodesk/hours/index.php';
  $page_options['nav']['Information Desk']['Building Maps']['link'] = '/infodesk/maps/index.php';
  $page_options['header_image'] = '/template/images/banners/about_union_banner.jpg';
  $page_options['page'] = 'Contact';
  infodesk_start($page_options);
?>

<div class="col pl-4">
  <h1 class="mt-4">Information Desk</h1>
  <p>Student Union Memorial Center (520) 621-7755</p>
  <p>Global Center (520) 621-2338</p>

  <p style="margin-top: 15px;">Here's the place for when things are open and where to find them.</p>
  <p>Take a look at the:</p>
  <p><a href="/infodesk/hours/index.php">Hours of Operation</a></p>
  <p><a href="/infodesk/maps/index.php">Building Maps</a></p>
</div>

<?php infodesk_finish(); ?>

