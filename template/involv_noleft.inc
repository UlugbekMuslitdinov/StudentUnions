<?php
require_once('C:/xampp/htdocs/project/template/global.inc');

function involv_start($page_options){ global $page_options;
	if($_SESSION['mobile_browser']){
		mobile_involv_start($page_options);
		return true;
	}
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
	session_start();

	// connect to database
	require_once("deliverance/inc_db_switch.php");

	// includes the display functions
	require_once("deliverance/display_functions.php");

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
	
	page_start('Dining');
?>
	<!-- BEGIN added support for Deliverance based banner -->
	<div style="height:300px; margin-top:6px; margin-bottom:15px;">
		<?=$header ?>
	</div>
	<!-- END added support for Deliverance based banner -->	

	<div id="right-col">
		<?=$page_options['ad1'] ?>
		<?php
		randomFeed(37);
		sequentialFeed(38);
		?>
		<a href="/events" ><img src="/dining/template/images/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php" ><img src="/dining/template/images/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus" ><img src="/dining/template/images/tellus_btn.jpg" alt="donate" /></a>
	</div>
	
	<div id="center-col" style="width: 700px;">
	
	
<?php
		}

		function involv_finish(){
		if($_SESSION['mobile_browser']){
		mobile_involv_finish();
		return true;
		}
	?>
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
