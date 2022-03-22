<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');

function dining_start($page_options){ global $page_options;

	############################################
	# required for all pages using DELIVERANCE #
	############################################

	// enables 'edit | view' options to appear for authorized users
	//session_start();

	// connect to database
	require_once($_SERVER["DOCUMENT_ROOT"] . "/commontools/deliverance/inc_db_switch.php");

	// includes the display functions
	require_once($_SERVER["DOCUMENT_ROOT"] . "/commontools/deliverance/display_functions.php");

	################################
	# end DELIVERANCE requirements #
	################################

ob_start();
randomFeed(6);
$ad = ob_get_clean();

ob_start();
randomFeed(8);
$header = ob_get_clean();

//connect to database
include("mysql_link.inc");

// $DBlink=mysqli_connect('mysql_host', 'web', 'viv3nij'); 
mysqli_select_db($DBlink,"hours2");									 
// mysqli_select_db('hours2');
// mysql_select_db('hours2');
	$page_options['script_incs']= array('/commontools/jslib/jquery.js', '/commontools/jslib/shadowbox/shadowbox.js','/js/rotate.js');
	$page_options['scripts'] = 'Shadowbox.init();';
	$dining_options['ssheets'][] = '/dining/template/dining.css';
	$dining_options['ssheets'][] = '/commontools/jslib/shadowbox/shadowbox.css';
	$dining_options['ad_image'] = '/dining/template/images/mealplan_ad.gif';
	$dining_options['ad_static'] = $ad;
	$dining_options['ad_alt']= 'Meal Plans';
	$dining_options['ad_link']= '/mealplans';

	if($page_options['header_image']){
		$header = '<img id="dining-header-img" src="'.$page_options['header_image'].'" width="950"/>';
	}
	unset($page_options['header_image']);


	$page_options = array_merge($dining_options, $page_options);
	page_start('Dining');
?>
	<div style="height:300px; margin-top:6px; margin-bottom:15px;">
	<?=$header?>

	</div>
	<div id="right-col">
		<?=$page_options['ad']?>

		<style type="text/css">
			.wrap-restaurants {
				position: relative;
				clear: both;
				width: 100%;
			}
			.wrap-restaurants > a {
				position: absolute;
				z-index: 0;
				visibility: hidden;
			}
			.wrap-restaurants > a:nth-child(1){
				visibility: visible;
			}
		</style>

		<!-- <a href="/dining/template/movies/BagelTalk.mov" rel="shadowbox;height=353;width=600"><img src="<?=$page_options['video_image']?>" alt"<?=$page_options['video_alt']?>" /></a> -->
		<a href="<?=$page_options['ad_link']?>"><img src="<?=$page_options['ad_image']?>" alt"<?=$page_options['ad_alt']?>" /></a>
		<a href="/events"><img src="/dining/template/images/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php"><img src="/dining/template/images/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus"><img src="/dining/template/images/tellus_btn.jpg" alt="donate" /></a>
	</div>
	<div id="left-col">
   <span>Let's Eat</span>
   <ul>
     <li><a href="/dining" class="<?=$page_options['page'] == 'Dining'?'active':''?>" >Dining Home</a></li>
     <li><a href="/mealplans">Meal Plans</a></li>
     <li><a href="/dining/sumc" class="<?=$page_options['page'] == 'sumc'?'active':''?>">Eat at Student Union</a></li>
     <li><a href="/dining/psu" class="<?=$page_options['page'] == 'psu'?'active':''?>">Eat at Park Student Union</a></li>
		<li><a href="/roadrunner" class="<?=$page_options['page'] == 'roadrunner'?'active':''?>">RoadRunner Mobile Kitchen</a></li>
     <li><a href="/dining/other" class="<?=$page_options['page'] == 'other'?'active':''?>">More Places to Eat</a></li>
     <!--<li><a href="/dining/redandblue" class="<?=$page_options['page'] == 'redblue'?'active':''?>">Red & Blue Market</a></li>-->
     <li><a href="/catering">Arizona Catering Company</a></li>
     <li><a href="/infodesk/hours/index.php?cat=dining">Dining Hours</a></li>
     <li><a href="/maps">Building Maps</a></li>
     <!-- <li><a href="">Gift Connection</a></li> -->
     <li><a href="/diningcard/index.php">Departmental Dining Card</a></li>
     <li><a href="/employment">Employment Opportunities</a></li>
     <li><a href="/foodsafety/index.php">Food Safety Information</a></li>
     <li><a href="http://nutrition.union.arizona.edu" target="_blank">Nutrition</a></li>
   </ul>
 </div>
	<div id="center-col">


<?php
}

function dining_finish(){
?>
	</div>
<?php
	page_finish();
}
