<?php
ini_set('display_errors', 1);
require_once('template/mpbackweb.inc');
require_once('../includes/mp_functions.inc');


function charge_bursars($bursar_id){
global $db;

  $query = 'select * from bursar_payment where bursar_id='.$bursar_id;
  $result = $db->query($query);
  $row = mysqli_fetch_assoc($result);
  $emplid = $row['emplid'];
  $ssf_item = $row['subcode'];
  $amount = $row['bursars_amount'];
  $term = $row['term'];

      $client = new SoapClient("https://nk-prd.uits.arizona.edu/soap-proxy/sa/saprd/UA_SF020.1.wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
	// $client = new SoapClient("https://so-prd.uaccess.arizona.edu/gateway/services/UA_SF020?wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));



    $params = array("BUSINESS_UNIT" =>"UAZ00", "EMPLID" => str_pad($emplid,8, '0', STR_PAD_LEFT),  "ACCOUNT_TYPE_SF" => "MPL", "SSF_ITEM_TYPE" => $ssf_item, "ORIGNL_ITEM_AMT" => $amount, "STRM" => $term, "REF1_DESCR" => "mp".$bursar_id);

    $_SESSION['bursars_charge'] = $params;
    //var_dump($client);
    $client->UA_SF020($params);
    $response = $client->__getLastResponse();
    print '<!-- ';
	var_dump( $response);
	print ' -->';
    $xml = simplexml_load_string($response);

    $result = $xml->children('soapenv', TRUE)->children()->UA_SF020_RESPONSE->UA_SF020_RESULT;




    if(!$response || ($result->SUCCESS == 0 && $result->REASON != "SQLExec failed to return ITEM_NBR")){
    	///////////////////////////////////////////////////////////
    	//try again
      	 //$params = array("BUSINESS_UNIT" =>"UAZ00", "EMPLID" => str_pad($emplid,8, '0', STR_PAD_LEFT),  "ACCOUNT_TYPE_SF" => "MPL", "SSF_ITEM_TYPE" => $ssf_item, "ORIGNL_ITEM_AMT" => $amount, "STRM" => $term, "REF1_DESCR" => "mp".$bursar_id);



	    $_SESSION['bursars_charge'] = $params;
	    //var_dump($client);
	    $client->UA_SF020($params);
	    $response = $client->__getLastResponse();
	    print '<!-- ';
		var_dump( $response);
		print ' -->';
	    $xml = simplexml_load_string($response);

	    $result = $xml->children('soapenv', TRUE)->children()->UA_SF020_RESPONSE->UA_SF020_RESULT;




	    if(!$response || ($result->SUCCESS == 0 && $result->REASON != "SQLExec failed to return ITEM_NBR")){

	      $error = 1;
		  $query = 'update bursar_payment set'.
	            '   response    = "'. $db->escape($response).
	            '", item_nbr    = "'. $db->escape(intval($result->ITEM_NBR)).
	            '", line_seq_no   = "'. $db->escape(intval($result->LINE_SEQ_NBR)).
	            '", transaction_time= CURRENT_TIMESTAMP'.
	            '  where bursar_id='.$bursar_id;

	    }
	    else{

	    $error = 0;

	      $query = 'update bursar_payment set'.
	            '   response    = "'. $db->escape($response).
	            '", item_nbr    = "'. $db->escape(intval($result->ITEM_NBR)).
	            '", line_seq_no   = "'. $db->escape(intval($result->LINE_SEQ_NBR)).
	            '", transaction_time= CURRENT_TIMESTAMP'.
	            '  where bursar_id='.$bursar_id;
	      $db->query($query);
	    }


      	///////////////////////////////////////////////////////////
      	/*
      $error = 1;
	  $query = 'update bursar_payment set'.
            '   response    = "'. mysql_real_escape_string($response).
            '", item_nbr    = "'. mysql_real_escape_string($result->ITEM_NBR).
            '", line_seq_no   = "'. mysql_real_escape_string($result->LINE_SEQ_NBR).
            '" where bursar_id='.$bursar_id;
	  */
    }
    else{

    $error = 0;

      $query = 'update bursar_payment set'.
            '   response    = "'. $db->escape($response).
            '", item_nbr    = "'. $db->escape(intval($result->ITEM_NBR)).
            '", line_seq_no   = "'. $db->escape(intval($result->LINE_SEQ_NBR)).
            '", transaction_time= CURRENT_TIMESTAMP'.
	        '  where bursar_id='.$bursar_id;
      $db->query($query);
    }


  return $error;
}


if(isset($_POST['type'])){
	switch($_POST['type']){
	  case 'copper - 1':
	    $plan = 'Copper';
	    $payments = 1;
	  break;

	  case 'copper - 2':
	    $plan = 'Copper';
	    $payments = 2;
	  break;

	  // edited 2013-14 plans
	  case 'silver - 1':
	    $plan = 'Silver';
	    $payments = 1;
	  break;

	  case 'silver - 2':
	    $plan = 'Silver';
	    $payments = 2;
	  break;

	  case 'gold - 1':
	    $plan = 'Gold';
	    $payments = 1;
	  break;

	  case 'gold - 2':
	    $plan = 'Gold';
	    $payments = 2;
	  break;

// old plan
/*
	  case 'plus10 - 1':
	    $plan = 'Plus 10';
	    $payments = 1;
	  break;

	  case 'plus10 - 2':
	    $plan = 'Plus 10';
	    $payments = 2;
	  break;
*/
	   case 'commuter - 1':
	    $plan = 'Commuter';
	    $payments = 1;
	  break;

	}
	$amount = 0;
	$query = 'select signup_pending.*, deposit.bursar_id, deposit.bursar_fee_id from signup_pending join deposit on signup_pending.deposit_id=deposit.deposit_id where signup_pending.status="Bursars Hold" and signup_pending.plan="'.$plan.'" and signup_pending.num_payments='.$payments;
	$result = $db->query($query);
	$i = 0;
	while($deposit = mysqli_fetch_assoc($result)){
	  $cust = getMPCustFromId(convertIdToMPId($deposit['emplid']));

	  $error  = charge_bursars($deposit['bursar_id']);
	$error2=2;

	  $error2 *= charge_bursars($deposit['bursar_fee_id']);

	  $error +=$error2;
	  $query = 'update signup_pending set status="Pending Export" where deposit_id='.$deposit['deposit_id'];
	   $db->query($query);

	   if($error){
	  	 print 'error('.$error.') - '.$deposit['emplid'].' ('.$deposit['deposit_id'].') - '.$deposit['amount'].'<br />';
	   }
	   else{
	   	 $amount+= $deposit['amount'];
		 print $deposit['emplid'].' ('.$deposit['deposit_id'].') - '.$deposit['amount'].'<br />';
	   }
	  //$tia = tia_transaction(DEPOSIT, $deposit['amount'], $cust['mp_cust']['iso'], $cust['plan_tender_num']);
	  //if($i == 49)
	  if($i == $_POST['howmany'])
	  	break;
	  $i++;
	}
	print 'Amount deposited should be: $'.$amount;
}

//start page
mpbackweb_start('charge');
?>
<form action="" method="post">
<input type="submit" name="type" value="copper - 1" >
<input type="submit" name="type" value="copper - 2" >

<input type="submit" name="type" value="silver - 1" >
<input type="submit" name="type" value="silver - 2" >
<input type="submit" name="type" value="gold - 1" >
<input type="submit" name="type" value="gold - 2" >

<!--
<input type="submit" name="type" value="plus7 - 1" >
<input type="submit" name="type" value="plus7 - 2" >
<input type="submit" name="type" value="plus10 - 1" >
<input type="submit" name="type" value="plus10 - 2" >
-->

<input type="submit" name="type" value="commuter - 1" >


<select name="howmany">
	<option value="4">5</option>
	<option value="9">10</option>
	<option value="19">20</option>
	<option value="29">30</option>
	<option value="39">40</option>
	<option value="49" selected="selected">50</option>
</select> <span style="font-size: 10px;">[Select how many records to push at once.]</span>

</form>
