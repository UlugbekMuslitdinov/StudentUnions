<style>
    .digital_ad {
        width: 240px;
        height: 103px;
        background: url("/template/layout/header/img/digitalads_pdf.png") no-repeat;
        display: inline-block;
    }
    .digital_ad:hover {
        background: url("/template/layout/header/img/digitalads_pdf_2.png") no-repeat;
    }
</style>
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');

function involv_start($page_options){ global $page_options;
	// if($_SESSION['mobile_browser']){
	// 	mobile_involv_start($page_options);
	// 	return true;
	// }
	$page_options['script_incs']= array('/commontools/jslib/jquery.js', '/commontools/jslib/shadowbox/shadowbox.js');
	$dining_options['scripts'] = 'Shadowbox.init();';
	
	$dining_options['ssheets'][] = '/commontools/jslib/shadowbox/shadowbox.css';
	
	$dining_options['ssheets'][] = '/involvement/template/involv.css';
	
	$dining_options['ad1'] = '<a href="http://www.youtube.com/embed/bLwPx_bsGto?autoplay=1" rel="shadowbox;width=560;height=347;"><img src="/involvement/template/images/NYR_SPFfilmStill.jpg" /></a>';
	
	$page_options = array_merge($dining_options, $page_options);

	############################################
	# required for all pages using DELIVERANCE #
	############################################
 
	// enables 'edit | view' options to appear for authorized users

	// connect to database
	require_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");

	// includes the display functions
	require_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");

	################################
	# end DELIVERANCE requirements #
	################################

	// banner served by Deliverance
	ob_start();
	sequentialFeed(43);
	$header = ob_get_clean();

	// BEGIN added support for Deliverance based banner
	if($page_options['header_image']){
		$header = '<img id="dining-header-img" src="'.$page_options['header_image'].'" width="950"/>';
	}
	unset($page_options['header_image']);
    // END added support for Deliverance based banner
	
	// Load nav json
	// $nav_json = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/involvement.json");
	// var_dump($nav_json);
	// $nav = json_decode($nav_json, true);
	// var_dump($nav);
	
	page_start('Involvement');
?>
	<!-- BEGIN added support for Deliverance based banner -->
	<div class="col-md-12 wrap-banner-img">
		<?=$header?>
	</div>
	<!-- END added support for Deliverance based banner -->	

	<!-- Left Col -->
	<?php
	// Add PDF Download button on the Digital Ads page.
	if (($_SERVER['REQUEST_URI'] == "/involvement/digitalads/") || ($_SERVER['REQUEST_URI'] == "/involvement/digitalads/index.php")) {
	?>
    <a href="/involvement/digitalads/resources/DigitalAdPlatforms.pdf" target="_blank" class="digital_ad"><!--<img src="/template/layout/header/img/digitalads_pdf.png" width="240" height="103" alt="Download Digital Ads PDF" title="Download Digital Ads PDF" />--></a>
    <div style="margin-top:100px;margin-left:-240px;">
	<?php 
		}
	?>								 
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/involvement.php";
	print_left_nav($involvement_route, $page_options['page'], ['other', 'other2']);
	?>
	<?php
	// Add PDF Download button on the Digital Ads page.
	if (($_SERVER['REQUEST_URI'] == "/involvement/digitalads/") || ($_SERVER['REQUEST_URI'] == "/involvement/digitalads/index.php")) {
	?>
    </div>
    <?php 
		}
	?>		

	<div class="col mt-3">
	
<?php 
}

function involv_finish(){
?>
	</div>

	<!-- Right Col -->
	<div id="right-col" class="col" style="display: none;">

		<?php
			if (isset($page_options['ad1'])){
				echo $page_options['ad1'];
			}

			//
			randomFeed(37);
			sequentialFeed(38);
		?>
		<a href="/events" ><img src="/dining/template/images/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php" ><img src="/dining/template/images/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus" ><img src="/dining/template/images/tellus_btn.jpg" alt="donate" /></a>
	</div>
<?php 
	page_finish();
}

function mobile_involv_start($page_options){ global $page_options;
	
			
	page_start();
	
	?>
	
	<?php
}
function mobile_involv_finish(){
	?>
	<!-- <div style="clear:both;"></div></div></div> -->
<?php
	page_finish();
}
 /*
function makeHeader($title = "", $back = false, $alt = "")
	{?>
		<div id="pageTitleBarContainer" >
			
			<div id="pageTitle"><?=$title?></div>
			<div id="pageTitleBar">
				
				<div id="altButton" style="display: <?= ($alt == "")?"none":"" ?>">
					<span><img src="/template/images/menu_button.png" height="90%"/></span>
				</div>
				<div id="pageTitleBreak" align="center" style="margin-top:3px;">
					<a href="/involvement"><img src="/template/images/involvement_icon.png" /></a>
					<a href="/shopping"><img src="/template/images/services_icon.png" style="margin:0px 10px;" /></a>
					<a href="http://m.union.arizona.edu/dining"><img src="/template/images/dining_icon.png" /></a>
				</div>
				<div id="backButton" style="display: <?= ($back)?"":"" ?>" onclick="window.location='/'">
					<span><img src="/template/images/home_button.png" height="90%" /></span>
				</div>
			</div>
			
		</div>
			
		
		
		<div id="loadingDiv"><div id="loadingPanel"><div id="loadingText">Loading...</div></div></div>
		
		<?php
	}
*/