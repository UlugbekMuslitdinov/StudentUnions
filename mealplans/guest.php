<?php
session_start();
$_SESSION["Shib-guestPrivs"] = $_SERVER["Shib-guestPrivs"];
$_SESSION['Shib-emplId'] = $_SERVER['Shib-emplId'];
$_SESSION['Shib-oprid'] = $_SERVER['Shib-oprid'];


/*================MODS=============*/
// print "<pre>".print_r($_SERVER, true)."</pre>";
// exit();

/*=============END MODS============*/

if($_SESSION['mealplans_site'] == 'mobile'){
	header("Location:https://m.union.arizona.edu/dining/mealplans/dologin.php");
}
else if (isset($_SESSION['catcash_login_try']) && $_SESSION['catcash_login_try']){
	$_SESSION['catcash_login_try'] = false;
	header("Location: /catcash/login.php");
}
else {
	header("Location:login.php");
}