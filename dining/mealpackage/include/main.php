<?php
function loginCheck(){
	require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');
	// include('webauth/include.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/includes/mp_functions.inc');

	if (isset($_SESSION['webauth']['netID'])){
		$_SESSION['mealpackage']['login_info']['type'] = 'webauth';
		$_SESSION['mealpackage']['login_info']['access'] = 'full';
		$_SESSION['mealpackage']['login_info']['id'] = base64_encode($_SESSION['webauth']['emplid']);
		$_SESSION['mealpackage']['login_info']['guest_id'] = 'NULL';
		$_SESSION['mealpackage']['login_info']['netid'] = $_SESSION['webauth']['netID'];

		// // Get Meal Plan ID
		$_SESSION['mealpackage']['login_info']['mp_id'] = convertIdToMPId($_SESSION['webauth']['emplid']);

		//try to get basic MP customer info based on id
		// $mp_cust = getMPCustFromId($_SESSION['mealpackage']['login_info']['mp_id'], NULL);
		// $_SESSION['mealpackage']['login_info']['lastname'] = NULL;
		// $_SESSION['mealpackage']['login_info']['firstname'] = NULL;
		// if ($mp_cust){
		// 	$_SESSION['mealpackage']['login_info']['lastname'] = $mp_cust['lastname'];
		// 	$_SESSION['mealpackage']['login_info']['firstname'] = $mp_cust['firstname'];
		// }
	}
}