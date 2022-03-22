<?php
$mobile_browser = '0';

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	    $mobile_browser++;
	}

	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	    $mobile_browser++;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	    'wapr','webc','winw','winw','xda ','xda-');

	if (in_array($mobile_ua,$mobile_agents)) {
	    $mobile_browser++;
	}

	if (array_key_exists('ALL_HTTP', $_SERVER)) {
		if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
		    $mobile_browser++;
		}
	}

	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
	    $mobile_browser = 0;
	}

// Removing the redirection to the mobile site
/*
if($mobile_browser){
	header("Location: http://m.union.arizona.edu/dining");
	exit();
}
*/
require_once('template/mp.inc');

$webauth_logout = 0;
if(array_key_exists('logout', $_GET) && $_GET['logout'] == 1){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_SESSION['webauth']['netID'])){ $webauth_logout = 1; }
	session_destroy();
	session_start();
}
?>
<!--
<div style="background-color: #00275b; width: 100%; top: 0px; padding-top: 20px; padding-bottom: 20px;">
	<p style="margin-bottom: 0px; color: #fff; font-weight: 600; font-size: 20px; text-align: center;">
	The meal plans & catcash system is currently down for maintenance. It is expected to be back online Friday March 26th. If you need to make a deposit please call the meal plan office at 520-621-7043 or send us an email at <a href="mailto:su-mealplan@email.arizona.edu">su-mealplan@email.arizona.edu</a>.
	</p>
</div>-->
<!--
 <div style="background-color: #00275b; width: 100%; top: 0px; padding-top: 20px; padding-bottom: 20px;">
	<p style="margin-bottom: 0px; color: #fff; font-weight: 600; font-size: 20px; text-align: center;">
	Our Meal Plans and CatCash Guest Login pages are experiencing issues. Please contact the Meal Plans and CatCash Office for assistance at 520-621-7043 or su-mealplan@email.arizona.edu.
	</p>
</div> 
-->
<?php
$page_options['page'] = 'Meal Plans Home';
mp_start('Meal Plans Home');
?>

<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>
<!--Expand & Collapse--> 
<script type="text/javascript">
	$(function() {
		$("h2.expand").toggler();
		$("#content").expandAll({
			trigger : "h2.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	});
</script>
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
.page-img-banner, .wrap-banner-img {
	margin-bottom: 1.5rem;
}
#mp-content {
	margin-top: 0px;
}
</style>
<style>
	#content h2 {
		margin-top: 10px !important;
		/* width:520px !important; */
	}
	#content p {
		/* width:500px !important; */
	}
	#content hr {
		/* width:510px !important; */
	}
	#content a {
		color: #AA3333;
	}
</style>
<!--
<h2>Congratulations Garrett Ardis, <br />our Meal Plan winner!</h2>
<img src="template/images/14_MealPlanWinner_MM_003a.jpg" style="max-width: 500px; margin-bottom: 1.5em;" alt="Garrett Ardis" />
-->
<!-- <headers>
	<frame-options policy="DENY"/>
</headers> -->
<!--
<div class="row">
	<b>We are experiencing unexpected errors during the CatCash or MealPlans deposit with either Chrome or Edge.  We recommend other browsers to deposit.  We apologize for the inconvenience.  While we are continuing to investigate the root cause, please contact the Meal Plans Office at su-mealplan@email.arizona.edu if you have any issues.</b>
</div><br />-->
<!--
<div class="row">
	<img src="/mealplans/template/images/mealplansclosed.jpg" alt="MealPlans Closed" style="padding-left: 10px; padding-right: 10px; width:550px ; height: 688px;" />
</div>
-->
<div class="row" style="margin-top: 30px;">
	<div class="col-12 p-1">
		<h1 style="margin-bottom: 2rem !important;"><span style="color:darkcyan;">Which Meal Plan is for me?</span></h1>
		<p>
			Save money on every meal you buy on campus with your <b>Arizona Student Unions Meal Plan</b>.
		</p>
		<p>
			There are several Meal Plans to choose from, each designed to fit your needs based on how often you eat on campus.
		</p><br /><br />
		
		<div id="content" >
		<h1 style="margin-bottom: 2rem !important;"><span style="color:darkcyan;">Choose the plan that's right for you:</span></h1>

		<p>
		<h2 class="expand" >
		<img src="template/images/meal_swipeplan.jpg" width="600" height="84" alt="Swipe Meal Plans" />
		</h2>
		<div class="collapse">
		<div align=center><a href="/mealplans/template/resources/SwipeMealPlans_Flyer.pdf" target="_blank"><img src="template/images/learnmore.png" width="300" height="51" alt="Learn More" /></a></div>
		</div>
		
			
		<h2 class="expand" >	
		<img src="template/images/meal_debitplan.jpg" width="600" height="84" alt="Debit Meal Plans" />
		</h2>
		<div class="collapse">
		<span style="color:red;font-weight:bold;">Debit Meal Plans</span> are specifically designed and recommended for incoming students living on-campus.<br /><br />
		Save Arizona State Sales Tax of 6.1% Plus get 3%, 5% or 7% off every food or beverage purchase on campus.<br/><br />
		<div align=center><a href="plans.php#wildcat"><img src="template/images/learnmore.png" width="300" height="51" alt="Learn More" /></a></div>
		<br /><br />
		The <span style="color:red;font-weight:bold;">Commuter Meal Plan</span> is recommended for students living off-campus or in a fraternity or a sorority. This plan also meets the need of students who only eat occasionally on campus.<br /><br />
		<div align=center><a href="plans.php#commuter"><img src="template/images/learnmore.png" width="300" height="51" alt="Learn More" /></a></div>
		</div>
			
		<h2 class="expand" >	
		<img src="template/images/meal_honorsplan.jpg" width="600" height="84" alt="Honors Meal Plans" />
		</h2>
		<div class="collapse">
		The <span style="color:red;font-weight:bold;">Honors Meal Plan</span> are specifically designed and recommended for incoming students residing in the Honors Village and are mandatory.
		<br /><br />
		<a href="/mealplans/template/resources/HonorsGreekMealPlanWaiver.pdf" target="_blank" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><b><u>Honors Greek MealPlan Waiver</u></b></a><br />
		<div align=center><a href="template/resources/HonorsVillageMealPlans_Flyer.pdf" target="_blank"><img src="template/images/learnmore.png" width="300" height="51" alt="Learn More" /></a></div>
		</div>
		
		<h2 class="expand" >
		<img src="template/images/catcash.jpg" width="600" height="84" alt="CatCash" />
		</h2>
		<div class="collapse">
		<div align=center><a href="/catcash/index.php" target="_blank"><img src="template/images/learnmore.png" width="300" height="51" alt="Learn More" /></a></div>
		</div>
		
		<h2 class="expand" >
		<img src="template/images/meal_facultystaff.jpg" width="600" height="84" alt="Faculty & Staff" />
		</h2>
		<div class="collapse">
		The <span style="color:red;font-weight:bold;">Faculty/Staff Meal Plan</span> lets UA staff eat on campus and provides a <b>10% bonus</b> on every deposit.<br /><br />
		<div align=center><a href="plans.php#staff"><img src="template/images/learnmore.png" width="300" height="51" alt="Learn More" /></a></div>
		</div>
		</p>
	</div>
	</div>
</div>



<?php
mp_finish();
if(isset($_GET['logout']) && $_GET['logout'] == 1 && $webauth_logout==1){
?>
<!-- <script>
window.onload = function() {
Shadowbox.open({
content:	"webauth_logout.php",
player:     "iframe",
height:     120,
width:      425
});
};
</script> -->
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
