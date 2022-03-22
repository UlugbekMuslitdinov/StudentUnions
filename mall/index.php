<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/mall/template/mall.inc');
  $page_options['title'] = 'Campus Use &amp; Mall Scheduling';
  $page_options['page'] = 'Reserve the UA Mall';
  $page_options['header_image'] = '/template/images/banners/ua_mall_banner.jpg';
  mall_start($page_options);
?>
<h1>Mall Use &amp; Scheduling</h1>

<p>Welcome to the University of Arizona Campus Use &amp; Mall Scheduling. We provide campus departments, clubs, and organizations, as well as vendors and visitors the opportunity to reserve space for a variety of functions on the UA Mall and various other campus locations. Before you contact us, please familiarize yourself with the many available options, and understand the <a href="/mall/guidelines.php">guidelines</a> as presented on this site.</p>

<br />

<div style="width: 100%;">
	<b style="font-size: 17px;">The University of Arizona Policy and Regulations Governing the Use of the Campus:</b><br />
	<a href="campus_use_policy.pdf" target="_blank">Campus Use Policy</a> <br />
	<a href="restroom_guidelines.pdf" target="_blank">Restroom Guidelines</a>
</div>

<br />

<p>
  <b>Please call us at</b> (520) 626-2630 to reserve space and for further information.
</p>
<p>
  Student Union Memorial Center, 3rd Floor,<br>
  Tucson, Arizona, (520) 626-2630
</p>
<?php mall_finish() ?>
