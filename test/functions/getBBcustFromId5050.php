<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/mealplans/includes/mp_functions.inc');

$id = "23121144";
// $id = "00776978";		This is Yontaek account.
$last_name = "CHOI";

getMPCustFromId2(convertIdTo5050MPId2($id));

function convertIdTo5050MPId2($id){
	$mp_id = str_pad('55'.$id, 22, '0', STR_PAD_LEFT);
	print("MP ID: " . $mp_id . "<br />");
	return $mp_id;
}

function getMPCustFromId2($mp_id, $last_name = NULL){
	return getBBcustFromId2($mp_id, $last_name);
}

//return mealplan account object which contains all basic info needed by the app
function getBBcustFromId2($mp_id, $last_name){
	global $mp_cust;
	$BBlink = bb_connect();

	if($last_name == NULL){
		$query = 'select CUST_ID, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where CUSTNUM='.$mp_id;
		$result = bb_query($BBlink, $query);
	}
	else{	
		$query = 'select CUST_ID, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where CUSTNUM=:custnum_bv and LASTNAME=:lastname_bv';
		$result = oci_parse($BBlink, $query);
		oci_bind_by_name($result, ":custnum_bv", $mp_id);
		oci_bind_by_name($result, ":lastname_bv", stripslashes($last_name), 30);
		oci_execute($result);
	}

	$bbcust = oci_fetch_assoc($result);

	if(oci_num_rows($result) == 0)
		return false;

	$mp_cust['firstname'] = $bbcust['FIRSTNAME'];
	$mp_cust['lastname'] = $bbcust['LASTNAME'];
	$mp_cust['plan'] = getPlanForCustID($bbcust['CUST_ID']);
	$mp_cust['id'] = $bbcust['CUST_ID'];
	$mp_cust['cust_num'] = $mp_id;
	$mp_cust['balance'] = getBalanceForCustID($bbcust['CUST_ID']);
	$mp_cust['is_active'] = $bbcust['IS_ACTIVE'];
	$mp_cust['iso'] = '6017090'.substr($bbcust['DEFAULTCARDNUM'], -9, 9);
	
	print_r($mp_cust);
	return $mp_cust;
}
//getBBcustFromId($mp_id, $last_name);
//print_r($mp_cust);
?>