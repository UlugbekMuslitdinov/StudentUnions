<?php
function loginCheck(){
	include('webauth/include.php');
	$valid_user = ['yontaek','ricarlos', 'brandyh', 'valenciaj', 'harrisoj', 'aecheveste', 'abw2', 'imedina7302'];

	if (!in_array($_SESSION['webauth']['netID'],$valid_user)){
		// User is not valid
		// Redirect
		header("Location: /");
		die();
	}
}