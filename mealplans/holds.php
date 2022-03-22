<?php
ini_set('display_errors', 1);
try{
	  if($_SESSION['debug'] != 1){	
		  $client = new SoapClient("https://nk-prd.uits.arizona.edu/soap-proxy/sa/saprd/UA_PAYMENT.1.wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
		  // $client = new SoapClient("https://so-prd.uaccess.arizona.edu/gateway/services/UA_PAYMENT?wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
    }
    else{
      $client = new SoapClient("https://nk-prd.uits.arizona.edu/soap-proxy/sa/saprd/UA_PAYMENT.1.wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
		// $client = new SoapClient("https://so-tst.uaccess.arizona.edu/gateway/services/UA_PAYMENT?wsdl", array('login' => "mosaic-owsm-su-mealplan", 'password' => "h4qGVibYJPQtu?gFmG&fdhqBXR", "trace" => 1, "exceptions" => 1, "connection_timeout" => 10));
    }
	}
	catch(SoapFault $e){
		
	}
		
		
		 
		  
		$params = array("EMPLID" => "01857085"); 
		
		
		$response = $client->GET_SERVICE_INDICATORS($params);
		
		$holds = 0;
		foreach($response->SRVC_IND as $hold){
			if($hold->SRVC_IND_CD == "BAR")
				$holds = 1;
		}
		
		print $holds;
		
		//var_dump($response);
		if($response->SRVC_IND){
			print 'has holds';
		}
		else{
			print 'can charge';
		}
