<style>
#mealplan-mobile-btn { display: none; }
@media (max-width:767px){
	#right-col {
		position: absolute;
		left: -235px;
		padding: 10px 20px 30px 10px !important;
		max-width: 245px !important;
		background-color: #fff;
		box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)!important;
	}
	#login-box {
		width: 214px;
		border-radius: 0px !important;
	}
	#mealplan-mobile-btn {
		display: block;
		position: absolute;
    padding: 10px 10px;
    font-size: 40px;
    right: -60px;
    background-color: #fff;
    line-height: 30px;
    border-top-right-radius: 7px;
		border-bottom-right-radius: 7px;
		box-shadow: 0 2px 0px 0 rgba(0,0,0,.16),0 0px 0px 0 rgba(0,0,0,.12)!important;
		opacity: 0.85;
	}
	#mealplan-mobile-btn .fa-times {
		display:none;
		padding: 0px 7px;
	}

	#right-col.open {
		-webkit-animation: slide 0.2s forwards;
    -webkit-animation-delay: 0.2s;
    animation: slide 0.2s forwards;
    animation-delay: 0.2s;
	}
	@-webkit-keyframes slide { 100% { left: 0; } }
	@keyframes slide { 100% { left: 0; } }
	#right-col.open #mealplan-mobile-btn { opacity: 1; }

	#right-col.open .fa-sign-in-alt { display: none; }
	#right-col.close .fa-sign-in-alt { display: block; }
	#right-col.open .fa-times { display: block; }
	#right-col.close .fa-times { display: none; }

	#right-col.close {
		-webkit-animation: slideout 0.5s backwards;
    -webkit-animation-delay: 0.5s;
    animation: slideout 0.5s backwards;
		animation-delay: 0.5s;
		opacity: 0.85;
	}
	@-webkit-keyframes slideout { 100% { left: -235px; } }
	@keyframes slideout { 100% { left: -235px; } }
	/* #mealplan-mobile-btn:before {
		font-family: "Font Awesome 5 Free";
		content: "\f2f6";
		display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
	} */
}
</style>
<script>
function openMobileLogin() {
	var right_col = document.getElementById("right-col");
	if (right_col.classList.contains("open")) {
		right_col.classList.add("close");
		right_col.classList.remove("open");
	}
	else {
		right_col.classList.remove("close");
		right_col.classList.add("open");
	}
}
</script>

<div id="login-box" style="width: 205px; height: 300px;">
	<div id="mealplan-mobile-btn" onclick="openMobileLogin()">
		<i class="fas fa-sign-in-alt"></i>
		<i class="fas fa-times"></i>
	</div>

<div id="login-wrapper" style="position:relative;">
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/inc_db_switch.php");
//check if mealplans is turned off currently
$db = new db_mysqli('mealplans');
$query = "select * from control";
$result = $db->query($query);
$control = mysqli_fetch_assoc($result);

if(!$control['online'] && $_SERVER['SCRIPT_NAME'] != '/mealplans/viewtransactions.php' && !isset($_GET['maintenance'])){
  print '<p>'.$control['online_message'].'</p>';
}
//if user is not logged in display login options
else if(!isset($_SESSION['mp_cust']['id']) && !isset($_SESSION['5050mp_cust']['id'])){
?>

	<h2>LOG IN!</h2>
	<p>Add funds or check your plan balance&hellip;</p>
	
	<div id="login-buttons">
		<form action="login.php" method="get"><input type="hidden" value="netID" name="login_type" /><input type="image" src="/mealplans/template/images/LoginSignUp.png" value="netID Login" /></form>
		<p align="center">or</p>
		<form action="login.php" method="get"><input type="hidden" value="UAGuest" name="login_type" /><input type="image" src="/mealplans/template/images/GuestLogin.png" value="GuestAuth" /></form>
	</div>

	 <!--
	<p>
		The meal plans application is down for the next couple of minutes for upgrades. Sorry for the inconvenience.
	</p>
	-->
<?php
}
else{
	switch($_SESSION['mp_cust']['state']){
		case 'active':
?>
			<h1>HELLO!<a id="form-login-btn" href="/mealplans/index.php?logout=1" class="learn-more" style="font-size:11px; font-weight:bold;">Log out</a></h1>
			<?php
			if(strpos($_SERVER['REQUEST_URI'], '/mealplans/viewtransactions5050.php', 0) === false && strpos($_SERVER['REQUEST_URI'], '/mealplans/swipe', 0) === false){
				// Meal Plan Transaction Page
			 	print '<a href="/mealplans/viewtransactions.php" style="position:absolute; left:205px; top:20px;"><img src="/mealplans/template/images/mp_light_grn.png" /></a>';
			    if($_SESSION['5050mp_cust']['id']){
			      	print '<a href="/mealplans/viewtransactions5050.php" style="position:absolute; left:205px; top:110px;"><img src="/mealplans/template/images/5050_light_gray.png" /></a>';
			    }
			    if (isset($_SESSION['swipe_plan'])){
					if ($_SESSION['5050mp_cust']['id']){
						print '<a href="/mealplans/swipe" style="position:absolute; left:205px; top:197px;"><img src="/mealplans/template/images/swipe_light_gray.png" /></a>';
					}
					else {
						print '<a href="/mealplans/swipe" style="position:absolute; left:205px; top:110px;"><img src="/mealplans/template/images/swipe_light_gray.png" /></a>';
					}
			    }
			?>
			<p><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
			<?php
				// Swap Silver and Gold plans due to BB ID reversal for 2013/14 year. Will fix in next year's updates so BB IDs agree with IDs in our MySQL mealplans DB.
				if ($_SESSION['mp_cust']['plan']['NAME'] == 'Gold') {
					$plan = 'Silver';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else if ($_SESSION['mp_cust']['plan']['NAME'] == 'Silver') {
					$plan = 'Gold';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else {
					echo '<p>Plan: <b>' . $_SESSION['mp_cust']['plan']['NAME'] . '</b></p>';
				}
			?>
			<!--<p>Plan: <b>--><?php//=$_SESSION['mp_cust']['plan']['NAME']?><!--</b></p>-->
			<!--<p>Plan Expires: <b><?=$_SESSION['mp_cust']['plan']['EXPIRES']?></b></p>-->
			<p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['mp_cust']['id']))?></b></span></p>
			<div id="login-buttons" style="margin-top:0px;">
				<!--<a href="deposit.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />-->
        		<a href="deposit.php?new=1"><img src="/mealplans/template/images/AddFunds.png" style="margin-bottom:5px;"/></a><br />
				<a style="float:right;" href=viewtransactions.php class="learn-more">Transaction History</a><br />
				<a style="float:right;" href="deactivate.php" class="learn-more">Deactivate Card</a>
			</div>
			<?php
			}
			else if (strpos($_SERVER['REQUEST_URI'], '/mealplans/swipe/', 0) === 0) {
				// Swipe Transaction Page
				print '<a href="/mealplans/viewtransactions.php" style="position:absolute; left:205px; top:20px;"><img src="/mealplans/template/images/mp_light_gray.png" /></a>';
				if($_SESSION['5050mp_cust']['id']){
			      	print '<a href="/mealplans/viewtransactions5050.php" style="position:absolute; left:205px; top:110px;"><img src="/mealplans/template/images/5050_light_gray.png" /></a>';
			    }
			    if (isset($_SESSION['swipe_plan'])){
					if($_SESSION['5050mp_cust']['id']){
						print '<a href="/mealplans/swipe" style="position:absolute; left:205px; top:197px;"><img src="/mealplans/template/images/swipe_light_grn.png" /></a>';
					}
					else {
						print '<a href="/mealplans/swipe" style="position:absolute; left:205px; top:110px;"><img src="/mealplans/template/images/swipe_light_grn.png" /></a>';
					}
			    }

			    ?>
			    <p><?=$_SESSION['swipe_plan']['firstname'].' '.$_SESSION['swipe_plan']['lastname']?></p>
			    <p>Plan: <b><?=$_SESSION['swipe_plan']['plan_name']?></b></p>
				<p>
				<?php
					$semPlanId = [22];
					if ( in_array($_SESSION['swipe_plan']['plan_id'], $semPlanId) ) {
						print 'Balance: ';
					}
					else {
						print 'Week Balance: ';
					}
				?>
				<span style="font-size:16px;"><b><?php echo getBalanceForSwipe($_SESSION['mp_login']['mp_id']); ?></b></span></p>
		      	<div id="login-buttons" style="margin-top:0px;">
			        <!--<a href="deposit5050.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />-->
			        <!-- <a href="deposit5050.php?new=1"><img src="/mealplans/template/images/AddFunds.png" style="margin-bottom:5px;"/></a><br /> -->
			        <a style="float:right;" href="/mealplans/swipe/" class="learn-more">Transaction History</a>
		      	</div>
			<?php
			}
      		else{
				// 5050 Transaction Page
            	print '<a href="/mealplans/viewtransactions.php" style="position:absolute; left:205px; top:20px;"><img src="/mealplans/template/images/mp_light_gray.png" /></a><a href="/mealplans/viewtransactions5050.php" style="position:absolute; left:205px; top:110px;"><img src="/mealplans/template/images/5050_light_grn.png" /></a>';
			    if (isset($_SESSION['swipe_plan'])){
			    	print '<a href="/mealplans/swipe/" style="position:absolute; left:205px; top:197px;"><img src="/mealplans/template/images/swipe_light_gray.png" /></a>';
			    }

      		?>
				<p><?=$_SESSION['5050mp_cust']['firstname'].' '.$_SESSION['5050mp_cust']['lastname']?></p>
				<p>Plan: <b><?=$_SESSION['5050mp_cust']['plan']['NAME']?></b></p>
				<!--<p>Plan Expires: <b><?=$_SESSION['5050mp_cust']['plan']['EXPIRES']?></b></p>-->
				<p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['5050mp_cust']['id']))?></b></span></p>
				<div id="login-buttons" style="margin-top:0px;">
					<!--<a href="deposit5050.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />-->
					<a href="deposit5050.php?new=1"><img src="/mealplans/template/images/AddFunds.png" style="margin-bottom:5px;"/></a><br />
					<a style="float:right;" href=viewtransactions5050.php class="learn-more">Transaction History</a>
				</div>
			<?php
			}
      		?>
<?php
		break;
		case 'deactive':
?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more"  style="font-size:11px; font-weight:bold;">Log out</a></h1>
			<p><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
			<?php
				// Swap Silver and Gold plans due to BB ID reversal for 2013/14 year. Will fix in next year's updates so BB IDs agree with IDs in our MySQL mealplans DB.
				if ($_SESSION['mp_cust']['plan']['NAME'] == 'Gold') {
					$plan = 'Silver';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else if ($_SESSION['mp_cust']['plan']['NAME'] == 'Silver') {
					$plan = 'Gold';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else {
					echo '<p>Plan: <b>' . $_SESSION['mp_cust']['plan']['NAME'] . '</b></p>';
				}
			?>
			<!--<p>Plan: <b>--><?//=$_SESSION['mp_cust']['plan']['NAME']?><!--</b></p>-->
			<!--<p>Plan Expires: <b><?=$_SESSION['mp_cust']['plan']['EXPIRES']?></b></p>-->
			<p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['mp_cust']['id']))?></b></span></p>
			<div id="login-buttons" style="margin-top:0px;">
				<form action="deactivate.php" method="post"><input type="image" src="/mealplans/template/images/reactivate_btn.jpg" value="activate" name="activate" style="margin-bottom:5px;" /><input type="hidden" name="activate" value="1" /></form>

				<a style="float:right;" href=viewtransactions.php class="learn-more">Transaction History</a>
			</div>
<?php
		break;
		case 'pending':
?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Log out</a></h1>
			<p><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
			<p>Your meal plan sign up is still pending</p>
<?php
		break;

		case 'deposit':
?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Log out</a></h1>
			<p>Guest of <?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
<?php
		break;

		case 'swipe' :
			?>
			<?php
			// Swipe Transaction Page
			print '<a href="/mealplans/swipe" style="position:absolute; left:205px; top:20px;"><img src="/mealplans/template/images/swipe_light_grn.png" /></a>';
			?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Log out</a></h1>
			<p><?=$_SESSION['swipe_plan']['firstname'].' '.$_SESSION['swipe_plan']['lastname']?></p>
			<p>Plan: <b><?=$_SESSION['swipe_plan']['plan_name']?></b></p>
			<p>
			<?php
				$semPlanId = [22];
				if ( in_array($_SESSION['swipe_plan']['plan_id'], $semPlanId) ) {
					print 'Balance: ';
				}
				else {
					print 'Week Balance: ';
				}
			?>
			<span style="font-size:16px;"><b><?php echo getBalanceForSwipe($_SESSION['mp_login']['mp_id']); ?></b></span></p>
			<div id="login-buttons" style="margin-top:0px;">
				<!--<a href="deposit5050.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />-->
				<!-- <a href="deposit5050.php?new=1"><img src="/mealplans/template/images/AddFunds.png" style="margin-bottom:5px;"/></a><br /> -->
				<a style="float:right;" href="/mealplans/swipe/" class="learn-more">Transaction History</a>
			</div>
			<?php
		break;

    case '50/50':
        print '<a href="/mealplans/chooseplan.php" style="position:absolute; left:205px; top:20px;"><img src="template/images/5050tab.png" /></a>';
	    if (isset($_SESSION['swipe_plan'])){
			print '<a href="/mealplans/swipe/" style="position:absolute; left:205px; top:159px;"><img src="/mealplans/template/images/swipe_light_gray.png" /></a>';
		}
      ?>
      <h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Log out</a></h1>
      <p><?=$_SESSION['5050mp_cust']['firstname'].' '.$_SESSION['5050mp_cust']['lastname']?></p>
      <p>Plan: <b><?=$_SESSION['5050mp_cust']['plan']['NAME']?></b></p>
      <!--<p>Plan Expires: <b><?=$_SESSION['5050mp_cust']['plan']['EXPIRES']?></b></p>-->
      <p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['5050mp_cust']['id']))?></b></span></p>
      
      <p>&nbsp;</p>
      <div id="login-buttons" style="margin-top:0px;">
        <!--<a href="deposit5050.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />-->
        <a href="deposit5050.php?new=1"><img src="/mealplans/template/images/AddFunds.png" style="margin-bottom:5px;"/></a><br />
        <a style="float:right;" href=viewtransactions5050.php class="learn-more">Transaction History</a>
      </div>
     <?php
	break;
	
	default:
		?>
		<h2>LOG IN!</h2>
		<p>Add funds or check your plan balance&hellip;</p>
		<div id="login-buttons">
			<form action="login.php" method="get"><input type="hidden" value="netID" name="login_type" /><input type="image" src="/mealplans/template/images/LoginSignUp.png" value="netID Login" /></form>
			<p align="center">or</p>
			<form action="login.php" method="get"><input type="hidden" value="UAGuest" name="login_type" /><input type="image" src="/mealplans/template/images/GuestLogin.png" value="GuestAuth" /></form>
		</div>
		<?php
	}



?>

<?php
}
?>
</div>
</div>
