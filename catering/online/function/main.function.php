<?php
session_start();
include_once('db.class.php');
require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
require $_SERVER['DOCUMENT_ROOT']."/catering/online/function/DB.php";

function checkAgreement(){
	if (!isset($_SESSION['catering']['agreement']) || ($_SESSION['catering']['agreement'] != 'agree') ){
		// var_dump($_SESSION);
		header('Location: /catering/online_order/agreement.php');
		// $_SESSION['catering_status']['agreement']==false;
		die();
	}
}

function return404(){
	http_response_code(404);
	//include('my_404.php'); // provide your own HTML for the error page
	die();
}

function checkStatusSession($status){
	// echo '<pre>';
	// echo $status;
	// var_dump($_SESSION);

	$selected_restaurant = '';
	if (isset($_SESSION['catering']['restaurant'])){ $selected_restaurant = $_SESSION['catering']['restaurant']; }

	// Check time first
	if (isset($_SESSION['catering']['time'])){
		$date = new DateTime();
		$curr_time = $date->getTimestamp();
		$time_diff = $curr_time - $_SESSION['catering']['time'];
		if ($time_diff > 60*20 && $status != "agreement"){
			// Time passed more than 20 minutes
			unset_all_session();
			header("Location: agreement.php?r=".$selected_restaurant);
			die();
		}else{
			// Update Time
			$_SESSION['catering']['time'] = $curr_time;
		}
	}else{
		// Never started
		$_SESSION['catering_status'][$status] = false;
		header("Location: agreement.php?r=".$selected_restaurant);
		die();
	}

	$arr_status = ['agreement','index','menu','review','order_complete'];
	if (isset($_SESSION['catering_status'][$status])){
		if ($_SESSION['catering_status'][$status] == true){
			// foreach ($_SESSION['catering_status'] as $key => $value) {
			for ($i = 0; $i < count($arr_status); $i++){
				$key = $arr_status[$i];
				$value = $_SESSION['catering_status'][$key];
				if ($value==false){
					// header("Location: ".$key.".php");
					// die();
				}
			}
		}else{
			// foreach ($_SESSION['catering_status'] as $key => $value) {
			for ($i = 0; $i < count($arr_status); $i++){
				$key = $arr_status[$i];
				$value = $_SESSION['catering_status'][$key];
				if ($value==false && $key != $status){
					header("Location: ".$key.".php");
					die();
				}else if ($key == $status){
					break;
				}
			}
		}
	}else {
		$_SESSION['catering_status'][$status] = false;
		header("Location: index.php");
		die();
		// return404();
	}
}

function returnToMain(){
	
}

function unset_all_session(){
	unset($_SESSION['catering']['time']);
	unset($_SESSION['catering']['restaurant']);
	unset($_SESSION['catering']['agreement']);
	unset($_SESSION['catering_status']['agreement']);
	unset($_SESSION['catering_status']['index']);
	unset($_SESSION['catering_status']['menu']);
	unset($_SESSION['catering_status']['review']);
	unset($_SESSION['catering_status']['order_complete']);
	unset($_SESSION['catering_post']['agreement']);
	unset($_SESSION['catering_post']['index']);
	unset($_SESSION['catering_post']['menu']);
	unset($_SESSION['catering_post']['review']);
	unset($_SESSION['catering_id']);
	unset($_SESSION['catering']['customer_info']);
	unset($_SESSION['catering']['extra']);
	unset($_SESSION['catering']['burritos']);
}