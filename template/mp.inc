<?php
//global $page_options;
session_start();
require_once('../template/global.inc');
require_once('includes/bb.inc');

function mp_start($title, $header = 1, $must_be_logged_in = 0, $signup = 0){

	//make sure a user is currently logged in and session hasn't expired
	if($must_be_logged_in && !isset($_SESSION['mp_cust']['id'])){
		header("Location:index.php");
	}

	global $page_options;
	$page_options['ssheets'] = array('template/mp.css', '/commontools/jslib/shadowbox/shadowbox.css');
	$page_options['scripts'] = 'Shadowbox.init();';
	$page_options['script_incs']= array('/commontools/jslib/jquery.js', '/commontools/jslib/shadowbox/shadowbox.js');

	$page_options['title'] = 'Mealplans - '.$title;

	page_start('Mealplans');
	?>

	<?php



	if($header){
	?>
	<div id="mp-header-ads" style="float:right; width:95px;">
		<a href="http://www.union.arizona.edu/dining/psu/bageltalk/" ><img src="template/images/subheader1.jpg" alt="Bagel Talk" style="margin-bottom: 8px;"/></a>
		<a href="http://union.arizona.edu/dining/healthy/index.php" ><img src="template/images/subheader2.jpg" alt="Healthy Options" style="margin-bottom: 9px;"/></a>
		<a href="/dining/other/beardownkitchen" ><img src="/template/images/subheader3.jpg" alt="Bear Down Kitchen" style="margin-bottom: 0px;"/></a>
	</div>
	<img id="mp-header" src="template/images/header.jpg" alt="Mealplans" />
	<div style="clear:both;"></div>
	<?php
	}
	elseif($signup){
	?>
	<div style="color:#a3a2a2; font-size:12px; font-weight:bold; margin-top:30px; margin-left:15px;">
		<span style="<?=$title == 'Choose a Meal Plan'?'color:#FBB611;':''?>">Choose Plan</span>
		<img src="template/images/step_arrow.gif" />
		<span style="<?=$title == 'Terms and Conditions'?'color:#FBB611;':''?>">Terms and Conditions</span>
		<img src="template/images/step_arrow.gif" />
		<span style="<?=$title == 'Payment Options'?'color:#FBB611;':''?>">Payment Options</span>
		<img src="template/images/step_arrow.gif" />
		<span style="<?=$title == 'Confirm &amp; Finish'?'color:#FBB611;':''?>">Confirm &amp; Finish</span>
		<img src="template/images/step_arrow.gif" />
		<span style="<?=$title == ''?'color:#FBB611;':''?>">Thank You</span>
	</div>
	<?php
	}
	else{
		print '<div id="spacer" style="height:30px;"></div>';
	}
	?>
	<div id="right-col">
		<?php
		if($signup)
			include('signup_tracker_box.inc');
		else
			include('loginbox.inc')
		?>
		<!--<a href="/dining/iq/index.php" ><img src="template/images/side_ad.jpg" alt="IQ Fresh, NOW HAVE BREAKFAST, everyday. all day on weekends" style="margin-top:13px; margin-bottom:12px;"/></a>-->
		<a href="http://catcash.arizona.edu" ><img src="template/images/catcash.png" alt="catcash" style="margin-top:13px; margin-bottom:12px;"/></a>
		<a href="/events" ><img src="template/images/events_btn.jpg" alt="events" style="margin-right:6px;" /></a>
		<a href="/about/marketing/ask.php"><img src="template/images/about_btn.jpg" alt="about" style="margin-right:5px;" /></a>
		<a href="/tellus" ><img src="template/images/tellus_btn.jpg" alt="tell us" /></a>
		<p style="font-size:11px; margin-top:12px;">
		<b>Meal Plans Office</b><br />
		Student Union Memorial Center<br />
		1303 E. University Blvd.<br />
		Tucson, AZ 85721<br />
		</p>
		<p style="font-size:11px; margin-top:12px;">
		<b>
		520.621.7043<br />
		800.374.7379<br />
		<a href="mailto:mealplan@email.arizona.edu" style="font-size:11px; text-decoration:none; color:#363636;">mealplan@email.arizona.edu</a>
		</b>
		</p>
	</div>
	<?php
	if(!$signup){
	?>
	<div id="left-nav">
		<p id="get-the-scoop">Get The Scoop</p>
		<ul id="nav-list">
			<li><a class="nav-links" href="why.php">Why get a Meal Plan?</a></li>
			<li><a class="nav-links" href="plans.php">What plans are available?</a></li>
			<li><a class="nav-links" href="swipeplans.php">Swipe Plan</a></li>
			<li><a class="nav-links" href="where.php">Where can I eat?</a></li>
			<li><a class="nav-links" href="faq.php">FAQ</a></li>
			<li><a class="nav-links" href="terms.php">Terms &amp; Conditions</a></li>
			<!-- 
			<li><a class="nav-links" href="/dining/healthy/index.php">Healthy Options</a></li>
			<li><a class="nav-links" href="/mealplans/template/resources/mealplans.pdf" target="_blank">Meal Plan Info (2016/2017)</a></li>
			<li><a class="nav-links" href="/mealplanstemplate/resources/mealplan_app.pdf" target="_blank">Application (2016/2017)</a></li>
			<li><a class="nav-links" href="">Guest Accounts</a></li> -->
		</ul>
	</div>
	<?php
	}
	?>
	<div id="mp-content">


	<?php
}

function mp_finish(){
	?>
	</div>
	<?php
	page_finish();
}
