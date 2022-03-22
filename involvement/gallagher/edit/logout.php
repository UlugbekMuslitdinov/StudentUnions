<?php
session_start();
if(isset($_SESSION['webauth']['netID']) && $_SESSION['webauth']['netID']!=''){
	// session_destroy();
	unset($_SESSION['webauth']['netID']);
	//return 'https://webauth.arizona.edu/webauth/logout?logout_href=http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'&logout_text='.$text;
	header('Location: https://webauth.arizona.edu/webauth/logout?logout_href=http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	die();
}else {
	header("Location: /");
	die();
}