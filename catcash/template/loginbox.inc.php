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

<div id="login-box" style="width: 205px; background-color: #dcab20;">
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

// if(!$control['online'] && $_SERVER['SCRIPT_NAME'] != '/mealplans/viewtransactions.php' && !isset($_GET['maintenance'])){
if(!$control['online'] && $_SERVER['SCRIPT_NAME'] != '/mealplans/viewtransactions.php' && !isset($_GET['maintenance'])){
  print '<p>'.$control['online_message'].'</p>';
}
//if user is not logged in display login options
else if(!isset($_SESSION['catcash'])){
?>

	<h2>LOG IN!</h2>
	<p>Add funds or check your balance&hellip;</p>
	<div id="login-buttons">
		<form action="login.php" method="get">
            <input type="hidden" value="netID" name="login_type" />
            <input type="image" src="/mealplans/template/images/LoginSignUp.png" value="netID Login" />
        </form>
		<p align="center">or</p>
		<form action="login.php" method="get">
            <input type="hidden" value="UAGuest" name="login_type" />
            <input type="image" src="/mealplans/template/images/GuestLogin.png" value="GuestAuth" />
        </form>
	</div>

	<!--
	<p>
		The meal plans application is down for the next couple of minutes for upgrades. Sorry for the inconvenience.
	</p>
	-->
<?php
}
else{
	// Get Balance
	require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/BBCatCash.php');
	$BBCatCash = New BBCatCash;
	$balance = $BBCatCash->get_balance($_SESSION['catcash']['id']);
?>
    <h1>HELLO!<a id="form-login-btn" href="/catcash/index.php?logout=1" class="learn-more" style="font-size:11px; font-weight:bold;">Log out</a></h1>
    
	<p><?=$_SESSION['catcash']['firstname'].' '.$_SESSION['catcash']['lastname']?></p>
    <p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",$balance)?></b></span></p>
    <div id="login-buttons" style="margin-top:0px;">
        <a href="deposit.php?new=1"><img src="/mealplans/template/images/AddFunds.png" style="margin-bottom:5px;"/></a><br />
        <a style="float:right;" href=transactions.php class="learn-more">Transaction History</a>
    </div>
<?php
}
?>
</div>
</div>
