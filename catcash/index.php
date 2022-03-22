<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/template/catcash.inc.php');

$webauth_logout = 0;
if(array_key_exists('logout', $_GET) && $_GET['logout'] == 1){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_SESSION['webauth']['netID'])){ $webauth_logout = 1; }
	session_destroy();

	// var_dump(PHP_SESSION_NONE);
	// if (session_status() == PHP_SESSION_NONE) {
	// 	session_start();
	// }
}

$page_options['page'] = 'Home';
?>
<div style="background-color: #00275b; width: 100%; top: 0px; padding-top: 20px; padding-bottom: 20px;">
	<p style="margin-bottom: 0px; color: #fff; font-weight: 600; font-size: 20px; text-align: center;">
	Our Meal Plans and CatCash Guest Login pages are experiencing issues. Please contact the Meal Plans and CatCash Office for assistance at 520-621-7043 or su-mealplan@email.arizona.edu.
	</p>
</div> 
<?php
cc_start('Home');
?>

<style>
#text_title a:active, #text_title a:link,  #text_title a:visited {
	font-size:25px;
	font-weight: bold;
	color: #896028;
	text-decoration:underline;
	display:inline;
}
#text_title a:hover{
	font-size:25px;
	font-weight: bold;
	color: red;
	text-decoration:underline;
	display:inline;
}
</style>
<!--
<h2>Congratulations Garrett Ardis, <br />our Meal Plan winner!</h2>
<img src="template/images/14_MealPlanWinner_MM_003a.jpg" style="max-width: 500px; margin-bottom: 1.5em;" alt="Garrett Ardis" />
-->
<!-- <headers>
	<frame-options policy="DENY"/>
</headers> -->
<div class="row">
	<div class="col-12 p-1">
		<!--<div class="row">
			<b>We are experiencing unexpected errors during the CatCash or MealPlans deposit with either Chrome or Edge.  We recommend other browsers to deposit.  We apologize for the inconvenience.  While we are continuing to investigate the root cause, please contact the Meal Plans Office at su-mealplan@email.arizona.edu if you have any issues.</b>
		</div><br /><br />-->
		</h1>
		<div class="row">
			<div class="col-4">
				<div class="" style="width: 18rem;">
					<img class="card-img-top" src="template/images/CatCash_Home_2.png">
					<div class="card-body">
						<h5 class="card-title" style="color: #ac051f;">HOW IT WORKS!</h5>
						<p class="card-text" style="height: 80px; font-size:14px;">CatCa$h is easy! Simply swipe your CatCard to access funds at participating locations!</p>
						<a href="https://catcash.arizona.edu/howitworks.php" class="btn" style="width: 100%; color: #fff; background-color: #00275b;">Get Started Today!</a>
					</div>
				</div>
			</div>

			<div class="col-4">
				<div class="" style="width: 18rem;">
					<img class="card-img-top" src="template/images/CatCash_Home_3.jpg">
					<div class="card-body">
						<h5 class="card-title" style="color: #ac051f;">YOU HAVE QUESTIONS!</h5>
						<p class="card-text" style="height: 80px; font-size:14px;">If you have any questions about CatCa$h, we have the answers. Visit the FAQ page for further information.</p>
						<a href="https://catcash.arizona.edu/faqs.php" class="btn" style="width: 100%; color: #fff; background-color: #00275b;">Get Answers Now</a>
					</div>
				</div>
			</div>

			<div class="col-4">
				<div class="" style="width: 18rem;">
					<img class="card-img-top" src="template/images/whereitworks_small_picture.png">
					<div class="card-body">
						<h5 class="card-title" style="color: #ac051f;">WHERE IT WORKS!</h5>
						<p class="card-text" style="height: 80px; font-size:14px;">CatCa$h is an effortless way to pay for parking, printing, and services provided by selected retailers off-campus</p>
						<a href="https://catcash.arizona.edu/whereitworks.php" class="btn" style="width: 100%; padding-left: 0px; padding-right: 0px; color: #fff; background-color: #00275b;">See Complete List of Locations</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>


<?php
cc_finish();
if(isset($_GET['logout']) && $_GET['logout'] == 1 && $webauth_logout==1){
?>
<div id="webauth_logout_modal">
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
					<a type="button" class="btn btn-primary" href="https://webauth.arizona.edu/webauth/logout?logout_href=https://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>&logout_text=Click here to return to Meal Plans">Yes</a>
					<button type="button" class="btn btn-outline-primary" onclick="document.getElementById('webauth_logout_modal').remove();">No</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
