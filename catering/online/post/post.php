<?php
$filename = "";
switch ($_POST['status']) {
	case 'Agreement':
		$filename = "agreement";
		break;

	case 'Customer Information':
		$filename = "customer_info";
		break;

	case 'Menu':
		$filename = "menu";
		break;

	case 'Complete Order':
		$filename = "completeOrder";
		break;
	
	default:
		$filename = "wrong";
		break;
}

// Post 
// echo $_POST['status'];
// session_start();
// var_dump($_SESSION);
// echo 'post.php';

if($filename != "wrong"){
	include($filename.'.post.php');
}else{
	header("Location: ../index.php");
	die();
}