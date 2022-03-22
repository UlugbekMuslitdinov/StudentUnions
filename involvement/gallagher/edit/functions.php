<?php
session_start();
function loginCheck(){
	include('webauth/include.php');
	$valid_user = ['yontaek','cpartica','ricarlos','kevinbuchmiller','jnhenkel'];

	if (!in_array($_SESSION['webauth']['netID'],$valid_user)){
		// User is not valid
		// Redirect
		header("Location: /");
		die();
	}
}

function getJsonFileName(){
	return 'gallagher_sch.json';
}


function getJson(){
	$data = file_get_contents('gallagher_sch.json');
	$data = json_decode($data, true);
	return $data;
}

function sortByDate($arr)
{ 
	usort($arr, 'date_compare');
	return $arr;
}

function date_compare($a, $b)
{

    $value = -1;

    $a_date = strtotime($a['start_date']);
    $b_date = strtotime($b['start_date']);

    // Compare date first
    if ($a_date > $b_date){
    	$value = 1;
    }else if ($a_date == $b_date){
    	// Same date then compare time
    	if ($a['time'][0] > $b['time'][0]){
			$value = 1;
    	}else if ($a['time'][0] == $b['time'][0]){
    		$value = 0;
    	}	
    }

    return $value;
}    