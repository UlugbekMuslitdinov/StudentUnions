<?php
 ini_set('display_errors', 0);
require_once('../includes/bb.inc');
$BBlink = bb_connect();
$query = 'select CUST_ID, CUSTNUM, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where';
if(isset($_POST['catcard']) && $_POST['catcard'] != ''){
	$query .= ' DEFAULTCARDNUM=:defaultcardnum_bv';
	$result = oci_parse($BBlink, $query);
	$tmp_val = str_pad(substr($_POST['catcard'], 7, 9), 22, '0', STR_PAD_LEFT);
	oci_bind_by_name($result, ":defaultcardnum_bv", $tmp_val);
}
else if(isset($_POST['emplid']) && $_POST['emplid'] != ''){
	$query .= ' CUSTNUM=:custnum_bv';
	$result = oci_parse($BBlink, $query);
	// oci_bind_by_name($result, ":custnum_bv", str_pad($_POST['emplid'], 22, '0', STR_PAD_LEFT));
	$tmp_val = str_pad($_POST['emplid'], 22, '0', STR_PAD_LEFT);
	oci_bind_by_name($result, ":custnum_bv", $tmp_val);
}
else if($_POST['first'] != '' && $_POST['last'] != ''){
	$query .= ' FIRSTNAME=:firstname_bv and LASTNAME=:lastname_bv';
	$result = oci_parse($BBlink, $query);
	oci_bind_by_name($result, ":firstname_bv", $_POST['first'], 30);
	oci_bind_by_name($result, ":lastname_bv", $_POST['last'], 30);
}
else if($_POST['first'] != ''){
	$query .= ' FIRSTNAME=:firstname_bv order by LASTNAME';
	$result = oci_parse($BBlink, $query);
	oci_bind_by_name($result, ":firstname_bv", $_POST['first'], 30);
}
else if($_POST['last'] != ''){
	$query .= ' LASTNAME=:lastname_bv order by FIRSTNAME';
	$result = oci_parse($BBlink, $query);
	oci_bind_by_name($result, ":lastname_bv", $_POST['last'], 30);
}
		
oci_execute($result);
oci_fetch_all($result, $bbcust, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
$count = count($bbcust);

	
	if($count == 0){
		print '{"error":1}';
	}
	else if($count == 1){
		$bbcust['error'] = 0;
		$bbcust['numResults'] = 1;
		
		$query = 'select CUST_ID, CUSTNUM, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where CUSTNUM=:custnum_bv';
		$result = oci_parse($BBlink, $query);
		$tmp_val = str_pad('55'.$_POST['emplid'], 22, '0', STR_PAD_LEFT);
		oci_bind_by_name($result, ":custnum_bv", $tmp_val);
		oci_execute($result);
		$bbcust55 = oci_fetch_assoc($result);
		
		if($_POST['start'] != '' && $_POST['end'] != ''){
			$bbcust['trans'] = getBBTransactionsForAccounts($bbcust[0]['CUST_ID'], array(1, 2, 3, 43, 45, 46, 47, 48, 49, 50), 0, 4000);
			$bbcust['trans'] = filter_by_both($bbcust['trans']);
			
			$bbcust['trans_5050'] = getBBTransactions($bbcust55['CUST_ID'], 0, 4000);
			$bbcust['trans_5050'] = filter_by_both($bbcust['trans_5050']);
			
			$bbcust['trans_flex'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], CATCASH_ID, 0, 4000);
			$bbcust['trans_flex'] = filter_by_both($bbcust['trans_flex']);
			
			$bbcust['trans_reslife'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], RESLIFE_ID, 0, 4000);
			$bbcust['trans_reslife'] = filter_by_both($bbcust['trans_reslife']);
			
			$bbcust['start'] = date("m/d/Y", strtotime($_POST['start']));
			$bbcust['end'] = date("m/d/Y", strtotime($_POST['end']));
		}
		else if($_POST['start'] != ''){
			$bbcust['trans'] = getBBTransactionsForAccounts($bbcust[0]['CUST_ID'], array(1, 2, 3, 43, 45, 46, 47, 48, 49, 50), 0, 4000);
			$bbcust['trans'] = filter_by_start($bbcust['trans']);
			
			$bbcust['trans_5050'] = getBBTransactions($bbcust55['CUST_ID'], 0, 4000);
			$bbcust['trans_5050'] = filter_by_start($bbcust['trans_5050']);
			
			$bbcust['trans_flex'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], CATCASH_ID, 0, 4000);
			$bbcust['trans_flex'] = filter_by_start($bbcust['trans_flex']);
			
			$bbcust['trans_reslife'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], RESLIFE_ID, 0, 4000);
			$bbcust['trans_reslife'] = filter_by_start($bbcust['trans_reslife']);
			
			$bbcust['trans'] = array_slice($bbcust['trans'], 0, 32);
			$bbcust['trans_5050'] = array_slice($bbcust['trans_5050'], 0, 32);
			$bbcust['trans_flex'] = array_slice($bbcust['trans_flex'], 0, 32);
			$bbcust['trans_reslife'] = array_slice($bbcust['trans_reslife'], 0, 32);
			$bbcust['start'] = date("m/d/Y", strtotime($_POST['start']));
			$bbcust['end'] = date("m/d/Y", strtotime($bbcust['trans'][count($bbcust['trans'])-1]["when"]));
		}
		else if($_POST['end'] != ''){
			$bbcust['trans'] = getBBTransactionsForAccounts($bbcust[0]['CUST_ID'], array(1, 2, 3, 43, 45, 46, 47, 48, 49, 50), 0, 4000);
			$bbcust['trans'] = filter_by_end($bbcust['trans']);
			
			$bbcust['trans_5050'] = getBBTransactions($bbcust55['CUST_ID'], 0, 4000);
			$bbcust['trans_5050'] = filter_by_end($bbcust['trans_5050']);
			
			$bbcust['trans_flex'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], CATCASH_ID, 0, 4000);
			$bbcust['trans_flex'] = filter_by_end($bbcust['trans_flex']);
			
			$bbcust['trans_reslife'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], RESLIFE_ID, 0, 4000);
			$bbcust['trans_reslife'] = filter_by_end($bbcust['trans_reslife']);
			
			$bbcust['start'] = date("m/d/Y");
			$bbcust['end'] = date("m/d/Y", strtotime($_POST['end']));
		}
		else{
			//$bbcust['trans'] = getBBTransactions($bbcust[0]['CUST_ID'], 0, 34);
			$bbcust['trans'] = getBBTransactionsForAccounts($bbcust[0]['CUST_ID'], array(1, 2, 3, 43, 45, 46, 47, 48, 49, 50), 0, 31);
			$bbcust['start'] = date("m/d/Y");
			$bbcust['end'] = date("m/d/Y", strtotime($bbcust['trans'][count($bbcust['trans'])-1]["when"]));
			
			$bbcust['trans_flex'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], CATCASH_ID);
			$bbcust['trans_reslife'] = getBBTransactionsForAccountType($bbcust[0]['CUST_ID'], RESLIFE_ID);
			$bbcust['trans_5050'] = getBBTransactions($bbcust55['CUST_ID'], 0, 31);
		}
		
		print json_encode($bbcust);
	}
	else{
		
		$bbcust['error'] = 0;
		$bbcust['numResults'] = $count;
		print json_encode($bbcust);
	}
	
	function filter_by_end($array){
		$x = count($array) - 1;
		while(strtotime($array[$x]['when']) <= strtotime($_POST['end'].' 00:00:00') && $x > -1){
			array_pop($array);	
			$x--;
		}
		return $array;	
	}
	function filter_by_start($array){
		for($x = 0; strtotime($array[$x]['when']) >= strtotime($_POST['start'].' 23:59:59'); $x){
					
			array_shift($array);
		}
		return $array;
	}

	function filter_by_both($array){
		$array = filter_by_start($array);
		return filter_by_end($array);
	}
?>
