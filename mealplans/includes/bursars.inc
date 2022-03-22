<?php
ini_set('default_socket_timeout', 10);
require_once ('includes/mysqli.inc');

function charge_bursars($amount, $emplid, $term, $ssf_item = 500000100000){

	$db = new db_mysqli('mealplans');
	 try{
	  if(isset($_SESSION['debug']) && $_SESSION['debug'] != 1){
		  $client = new SoapClient("https://nk-prd.uits.arizona.edu/soap-proxy/sa/saprd/UA_SF020.1.wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
	 
		  // $client = new SoapClient("https://so-prd.uaccess.arizona.edu/gateway/services/UA_SF020?wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
    }
    else{
      $client = new SoapClient("https://nk-prd.uits.arizona.edu/soap-proxy/sa/saprd/UA_SF020.1.wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
	
		// $client = new SoapClient("https://so-tst.uaccess.arizona.edu/gateway/services/UA_SF020?wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
    }
	 }
	 catch(SoapFault $e){

	 }



		$query = 'insert into bursar_payment set emplid='.$emplid.', subcode=\''.$ssf_item.'\', bursars_amount='.$amount.', term='.$term;
		$db->query($query);
		$bursars_id = $db->insert_id;


		$params = array("BUSINESS_UNIT" =>"UAZ00", "EMPLID" => $emplid,  "ACCOUNT_TYPE_SF" => "MPL", "SSF_ITEM_TYPE" => $ssf_item, "ORIGNL_ITEM_AMT" => $amount, "STRM" => $term, "REF1_DESCR" => "mp".$bursars_id);

		$_SESSION['bursars_charge'] = $params;
		//var_dump($client);
		$client->UA_SF020($params);
		$response = $client->__getLastResponse();

		$xml = simplexml_load_string($response);

		$result = $xml->children('soapenv', TRUE)->children()->UA_SF020_RESPONSE->UA_SF020_RESULT;









		if(!$response || $result->SUCCESS == 0){
			$bursars_id = 0;
			//print 'An error has occured. The bursars office may be down. Please try again later';
			$db->email_error("bursars error:\n".$response, 1);

			$query = 'update bursar_payment set'.
						'   response		= "'.	$db->escape($response).
						'" where bursar_id='.$bursars_id;
			$db->query($query);
		}
		else{
			$query = 'update bursar_payment set'.
						'   response		= "'.	$db->escape($response).
						'", item_nbr		= "'.	$db->escape($result->ITEM_NBR).
						'", line_seq_no		= "'.	$db->escape($result->LINE_SEQ_NBR).
						'" where bursar_id='.$bursars_id;
			$db->query($query);
		}











	return $bursars_id;
}

function has_bursars_holds($emplid){
	//return false;
	 try{
	  if(isset($_SESSION['debug']) && $_SESSION['debug'] != 1){
		  $client = new SoapClient("https://nk-prd.uits.arizona.edu/soap-proxy/sa/saprd/UA_PAYMENT.1.wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
		  
		  // $client = new SoapClient("https://so-prd.uaccess.arizona.edu/gateway/services/UA_PAYMENT?wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
	    }
	    else{
	      $client = new SoapClient("https://nk-prd.uits.arizona.edu/soap-proxy/sa/saprd/UA_PAYMENT.1.wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
		  
			// $client = new SoapClient("https://so-tst.uaccess.arizona.edu/gateway/services/UA_PAYMENT?wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
	    }
	}
	catch(SoapFault $e){
	//	var_dump ($e);
	echo "Your transaction cannot be processed at this time.";
	}

	$params = array("EMPLID" => $emplid);

	$response = $client->GET_SERVICE_INDICATORS($params);

	$holds = false;
	if (isset($response->SRVC_IND) && $response->SRVC_IND)
	{
		foreach($response->SRVC_IND as $hold){
			if($hold->SRVC_IND_CD == "BAR")
				$holds = true;
		}
	}

	return $holds;
}

function getCurrentTerm(){
	$db = new db_mysqli('mealplans');
	//get important dates from the current yearly config
  $query = 'select * from yearly_config where start <= "'.date("Y-m-d").'" and end >= "'.date("Y-m-d").'"';
  $result = $db->query($query);
  $yearly_config = mysqli_fetch_assoc($result);

  if(isset($_SESSION['debug']) && $_SESSION['debug'] && isset($_SESSION['now'])){
    $now = $_SESSION['now'];
  }
  else{
    $now = time();
  }

  if($now < strtotime($yearly_config['can_charge_bursars'])){
    return '2'.date('y').'2';
  }
  else if($now < strtotime($yearly_config['spring_term_start'])){
    return '2'.date('y').'4';
  }
  else{
    return '2'.date('y').'1';
  }
}

function getSignupTerm($plusplan){
  if(!$plusplan){
    return getCurrentTerm();
  }
  else{

    if($_SESSION['debug'] && isset($_SESSION['now'])){
    $now = $_SESSION['now'];
    }
    else{
      $now = time();
    }

    if($now > strtotime($_SESSION['yearly_config']['spring_term_start'])){
      return '2'.date('y').'1';
    }
    else{
      return '2'.date('y').'4';
    }
  }
}
?>
