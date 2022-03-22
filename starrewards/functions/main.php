<?php
function loginCheck(){
	include('webauth/include.php');
	$valid_user = ['yontaek','ricarlos'];

	if (!in_array($_SESSION['webauth']['netID'],$valid_user)){
		// User is not valid
		// Redirect
		header("Location: /");
		die();
	}
}