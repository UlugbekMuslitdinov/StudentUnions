<?php
// ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/includes/mp_functions.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/BBCatCash.php');
session_start();

//if set user has just selected login method otherwise we are returing from the different authorization services
if(isset($_GET['login_type'])){
	switch($_GET['login_type']){

		//They are trying to use UA Guest Center to login. Send to /mealplans/guest so shibboleth will handle logging them in
		case 'UAGuest':
			$_SESSION['catcash_login_try'] = true;
			header('Location:http://su-wdevtest.union.arizona.edu/UA_GUEST/');
			exit();
		break;

		//They are using an anonomous guest login with studentid and last name
		case 'Guest':
			//login credintials are in the $_SESSION from guest.php and will be processed in next section
		break;

		//Otherwise they are logging in via netID so include the script to hadle that
		default:
			//check to see if they clicked a link to sign up for a specific plan
			if(isset($_GET['plan']))
				$_SESSION['plan'] = $_GET['plan'];

      //proccess webauth authentication
			include($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');
		break;
	}
}



//first check for guest login
if(isset($_POST['sid']) && isset($_POST['last_name'])){
	$_SESSION['mp_login']['type'] = 'guest';
	$_SESSION['mp_login']['access'] = 'deposit';
	$_SESSION['mp_login']['id'] = $_POST['sid'];
	$_SESSION['mp_login']['guest_id'] = 0;
}
//next check if student using webauth
elseif(isset($_SESSION['webauth']['netID'])){
	$_SESSION['mp_login']['type'] = 'webauth';
	$_SESSION['mp_login']['access'] = 'full';
	$_SESSION['mp_login']['id'] = $_SESSION['webauth']['emplid'];
	$_SESSION['mp_login']['guest_id'] = 'NULL';
	$_SESSION['payment_email'] = $_SESSION['webauth']['netID'].'@email.arizona.edu';
}
//last check if parent with guestauth
else{
	$_SESSION['mp_login']['type'] = 'guestauth';
	$_SESSION['mp_login']['access'] = strpos( $_SESSION["Shib-guestPrivs"], "MEALPLAN-FULLACCESS", 0) === false?'deposit':'full';
	$_SESSION['mp_login']['id'] = $_SESSION['Shib-emplId'];
	$_SESSION['mp_login']['guest_id'] = $_SESSION['Shib-oprid'];
}


//convert id obtained from various login methods to the id used in bb
$_SESSION['mp_login']['mp_id'] = convertIdToMPId($_SESSION['mp_login']['id']);


$BBCatCash = New BBCatCash;
$lastname = isset($_POST['last_name']) ? $_POST['last_name'] : null;
$cust = $BBCatCash->get_customer_info($_SESSION['mp_login']['mp_id'], $lastname);


if (is_array($cust))
{
    $_SESSION['catcash'] = $cust; 
	// var_dump($cust); 
	
	//print("custnum: " . (int)$_SESSION['catcash']['cust_num'] . "<br/>");
//	print("cust_id: " . $_SESSION['catcash']['id'] . "<br/>");
//	print("netid: " . $_SESSION['webauth']['netID'] . "<br/>");
//	print("firstname: " . $_SESSION['catcash']['firstname'] . "<br/>");
//	print("lastname: " . $_SESSION['catcash']['lastname'] . "<br/>");	
//	print("iso: " . $_SESSION['catcash']['iso'] . "<br/>");
//	exit();
	
	$custnum = (int)$_SESSION['catcash']['cust_num'];
	$cust_id = $_SESSION['catcash']['id'];
	// Guest can login without netID.
	if(isset($_SESSION['webauth']['netID'])) {
		$netid = $_SESSION['webauth']['netID'];
	} else {
		$netid = "";
	}
	$firstname = $_SESSION['catcash']['firstname'];
	$lastname = $_SESSION['catcash']['lastname'];
	$deposit_to = 2; 	// 1 for MealPlans & 2 for CatCash
	$iso = $_SESSION['catcash']['iso'];
	$db = new db_mysqli('su');
	$query = "INSERT INTO session_handler (custnum, cust_id, netid, firstname, lastname, deposit_to, iso) VALUES ($custnum, $cust_id, '$netid', '$firstname', '$lastname', $deposit_to, '$iso')";
	$db->query($query);
}
else
{
    // Something went wrong redirect
}

if($_SERVER['SERVER_ENV'] == 'production'){
	$domain = 'union.arizona.edu';
}
else{
	$domain = $_SERVER['SERVER_NAME'];
}

header("Location:https://".$domain."/catcash/transactions.php");

