<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');

function involv_start($page_options){ global $page_options;

############################################
# required for all pages using DELIVERANCE #
############################################

// enables 'edit | view' options to appear for authorized users
session_start();

// includes the display functions
include("deliverance/display_functions.php");

// connect to database
include("deliverance/inc_db_switch.php");

// select database
mysql_select_db("deliverance", $DBlink)
or die(mysql_error());

################################
# end DELIVERANCE requirements #
################################
ob_start();
staticFeed(9);
staticFeed(10);
$ads = ob_get_clean();




	$dining_options['ssheets'][] = '/involvement/template/spf.css';
	$dining_options['ad1_image'] = '/involvement/template/images/su_gallagher_gallery_games_10.jpg';
	$dining_options['ad2_image'] = '/involvement/template/images/su_gallagher_gallery_games_15.jpg';
	$dining_options['ad_alt']= 'Meal Plans';
	$dining_options['ad_link']= '/mealplans';
	
	
	$page_options = array_merge($dining_options, $page_options);
	page_start('Dining');
?>
	<div id="right-col">
		<?=$ads?>
		<a href="/events"><img src="/dining/template/images/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php"><img src="/dining/template/images/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus"><img src="/dining/template/images/tellus_btn.jpg" alt="donate" /></a>
	</div>
	<div id="left-col">
		<img src="/involvement/template/images/SPF_Image.jpg" />
		<span><!-- Kyle Oman --></span>
		<div id="small"></div>
	</div>
	<div id="center-col">
	<h1>Spaces, Places, Faces</h1>
	
<?php 
}

function involv_finish(){
?>
	</div>
<?php 
	page_finish();
}