<?php
//global $page_options;
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/global.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/includes/bb.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/bb_catcash.inc.php');

function cc_start($title, $header = 1, $must_be_logged_in = 0, $signup = 0){

	// //make sure a user is currently logged in and session hasn't expired
	// if($must_be_logged_in && !isset($_SESSION['mp_cust']['id'])){
	// 	header("Location:index.php");
	// }

	// Check Login
	if (isset($_SESSION['mp_login']['mp_id']) && !isset($_SESSION['catcash'])){
		// header("Location:https://union.arizona.edu/catcash/login.php");
		// exit();
		require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/BBCatCash.php');
		$BBCatCash = New BBCatCash;
		$_SESSION['catcash'] = $BBCatCash->get_customer_info($_SESSION['mp_login']['mp_id'], NULL);
	}


	global $page_options;
	$page_options['ssheets'] = array('/mealplans/template/mp.css', '/commontools/jslib/shadowbox/shadowbox.css');
	// Customize Title for the Swipe Plan files.
	$currentFile = $_SERVER["PHP_SELF"];
    $parts = Explode('/', $currentFile);
	$currentFile = $parts[count($parts) - 1];
	// Customize Titles
	$page_options['title'] = 'CatCash - '.$title;

	page_start($page_options);
	?>

	<?php
	if($header){
	?>
	<div class="col-12 page-img-banner wrap-banner-img">
		<img src="/template/images/banners/catcash.jpg" />
	</div>
	<?php
	}
	elseif($signup){
	?>
	<div class="col-12" style="color:#a3a2a2; font-size:12px; font-weight:bold; margin-top:30px; margin-left:15px;">
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
	<?php
	if(!$signup){
	?>
	<!-- Left Col -->
    <?php
    // include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/mealplan_leftnav.php";
    // print_left_nav($mealplans_route, $page_options['page'], ['other', 'other2']);
	}
	?>
	<div id="mp-content" class="col">


	<?php
}

function cc_finish($signup = 0){
	?>
	</div>
	<div id="right-col" class="col wrap-right-col p-0">
		<?php
		if($signup)
			include('signup_tracker_box.inc');
		else
			include($_SERVER['DOCUMENT_ROOT'] . '/catcash/template/loginbox.inc.php')
		?>

		<div class="wrap-mp-contactus">
			<p class="mp-address">
				<b>Meal Plans Office in Business Center</b><br />
				Student Union Memorial Center<br />
				1303 E. University Blvd.<br />
				Tucson, AZ 85721<br />
			</p>
			<p class="mp-contact-info">
				<b>
					P.520.621.7043<br />
					P.800.374.7379<br />
					<a href="mailto:mealplan@email.arizona.edu">su-mealplan@email.arizona.edu</a>
				</b>
			</p>
		</div>

	</div>
	<?php
	page_finish();
	// if (isset($_GET['logout']) && $_GET['logout']==1){
	?>
	<!-- <div style="position: fixed; background-color: #00275b; width: 100%; top: 0px; padding-top: 20px; padding-bottom: 20px;">
		<p style="color: #fff; font-weight: 600; font-size: 20px; text-align: center;">
		The MealPlans online management system is not be available during the server maintenance.
		</p>
	</div> -->
	<!-- <div id="webauth_logout_modal">
		<div class="modal-backdrop fade show" onclick="document.getElementById('webauth_logout_modal').remove();"></div>
		<div class="modal fade show" tabindex="-1" role="dialog" style="display:block;" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header" style="border-bottom-width: 0px;">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('webauth_logout_modal').remove();">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<p>You are still logged into webauth. Would you like to logout?</p>
					</div>

					<div class="modal-footer" style="border-top-width: 0px;">
						<a type="button" class="btn btn-primary" href="https://webauth.arizona.edu/webauth/logout?logout_href=https://union.arizona.edu/mealplans&logout_text=Click here to return to Meal Plans">Yes</a>
						<button type="button" class="btn btn-outline-primary" onclick="document.getElementById('webauth_logout_modal').remove();">No</button>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<?php
	// }
}
