<?php
require_once( __DIR__ . '/includes/mp_functions.inc');
session_start();

//if set user has just selected login method otherwise we are returing from the different authorization services
if(isset($_GET['login_type'])){
	switch($_GET['login_type']){

		//They are trying to use UA Guest Center to login. Send to /mealplans/guest so shibboleth will handle logging them in
		case 'UAGuest':
			// header('Location:'. $_SERVER['HTTP_REFERER'] . 'guest.php');
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



//try to get basic MP customer info based on id
$lastname = isset($_POST['last_name']) ? $_POST['last_name'] : null;
$_SESSION['mp_cust'] = getMPCustFromId($_SESSION['mp_login']['mp_id'], $lastname);

/*
 *
 *
 * 	$mp_cust['firstname']
 *  $mp_cust['lastname']
 *  $mp_cust['plan']['NAME']
 *  $mp_cust['plan']['BB_ID']
 *  $mp_cust['plan']['ID']
 *  $mp_cust['plan']['NUM_PAYMENTS']
 *  $mp_cust['plan']['TENDER_NUM']
 *  $mp_cust['plan']['EXPIRES']
 *  $mp_cust['id']
 *  $mp_cust['cust_num']
 *  $mp_cust['balance']
 *  $mp_cust['is_active']
 *  $mp_cust['iso']
 *
 *
 *
 *
 */


//find current state of mp account

//check if no account was found
if(!$_SESSION['mp_cust']){
	$_SESSION['mp_cust']['state'] = 'no account';
}


//check if account has a plan
elseif(!in_array($_SESSION['mp_cust']['plan']['BB_ID'], getActiveBBPlanIds())){

  //check if they have signed up for a plan and it just hasn't been imported yet
	if(isMPAccountSignupPending($_SESSION['mp_login']['id']))
		$_SESSION['mp_cust']['state'] = 'pending';
	else
		$_SESSION['mp_cust']['state'] = 'no plan';
}

//check if account is currently deactivated
elseif($_SESSION['mp_cust']['is_active'] == 'F')
	$_SESSION['mp_cust']['state'] = 'deactive';

//otherwise account has an active mp
else{
	$_SESSION['mp_cust']['state'] = 'active';
	removeMPSignupPending($_SESSION['mp_login']['id']);
}



//check to see if person might have a 50/50 account if active employee
if($_SESSION['webauth']['activeemployee']){

	//try to load 50/50 account
	$_SESSION['5050mp_cust'] = getMPCustFromId(convertIdTo5050MPId($_SESSION['mp_login']['id']));

  //change state to 50/50 if they have one and no other mp
	if($_SESSION['5050mp_cust'] && ($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account'))
		$_SESSION['mp_cust']['state'] = '50/50';
}

// Check if an user has a swipe plen
$swipe_plan = getSPFromId($_SESSION['mp_cust']['cust_num']);
if ($swipe_plan != null){
	$_SESSION['swipe_plan'] = $swipe_plan;
	// $_SESSION['mp_cust']['state'] = 'swipe';
	if($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account' || $_SESSION['webauth']['activeemployee'] == false)
		$_SESSION['mp_cust']['state'] = 'swipe';
}

//last check if they only have deposit access which overides current state if they have a mp
if($_SESSION['mp_login']['access'] == 'deposit' && ($_SESSION['mp_cust']['state'] == 'active' || $_SESSION['mp_cust']['state'] == 'deactive'))
	$_SESSION['mp_cust']['state'] = 'deposit';

if($_SERVER['SERVER_ENV'] == 'production'){
  $domain = 'union.arizona.edu';
}
else{
  $domain = $_SERVER['SERVER_NAME'];
}

//take user to appropriate page based on thier state
switch($_SESSION['mp_cust']['state']){
	case 'active':
		header("Location:https://".$domain."/mealplans/viewtransactions.php");
		exit();
	break;
	case 'pending':
		header("Location:https://".$domain."/mealplans/pending.php");
		exit();
	break;
	case 'deactive':
		header("Location:https://".$domain."/mealplans/viewtransactions.php");
		exit();
	break;
	case 'deposit':
		header("Location:https://".$domain."/mealplans/deposit.php");
		exit();
	break;
	case '50/50':
		header("Location:https://".$domain."/mealplans/viewtransactions5050.php");
		exit();
	break;
	case 'swipe':
		header("Location:https://".$domain."/mealplans/swipe");
		exit();
	break;
	case 'no plan':
		if($_SESSION['mp_login']['guest_id'] != 'NULL'){
			header("Location:https://".$domain."/mealplans/noplan.php");
			exit();
		}
		else{
			header("Location:https://".$domain."/mealplans/chooseplan.php");
			exit();
		}
	default:
		header("Location:https://".$domain."/mealplans/noaccount.php");
		exit();
	break;
}
