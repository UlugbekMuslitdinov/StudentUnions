<?php
include_once('main.function.php');

function postSetup($fromWhere){
	// Make sure it is POST method
	if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
		// header("Location: ../".$fromWhere.".php");
		// die();
	}
	// Also check if $_POST['status']
	checkStatus($fromWhere);

	// Finally Check agreement
	// checkAgreement();
}

function checkStatus($status){
	if (isset($_POST['status'])){
		if ($_POST['status'] == ''){
			return404();
			die();
		}else{
			// if ($_SESSION['catering_post'][$status] == true){
			// 	header("Location: ../".$status.".php");
			// 	die();
			// }
		}
	}else{
		header("Location: ../".$status.".php");
		die();
	}
}

function checkPost($arr){

}

