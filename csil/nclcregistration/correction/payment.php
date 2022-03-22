<?php
	
	
	if(!isset($_SERVER['HTTPS']) && (count($_GET) == 0))
    {
        header("location: https://www.union.arizona.edu/csil/nclcregistration/correction/payment.php");
    }
	
	//print_r($_SESSION);
	
if ( ($_GET['merchantDefinedData3'] == "true") || isset($_GET['merchantDefinedData3']) ) {
	$tempFN		= $_SESSION['billTo_firstName'];
	$tempLN 	= $_SESSION['billTo_lastName'];
	$tempAdr	= $_SESSION['billTo_street1'];
	$tempCity	= $_SESSION['billTo_city'];
	$tempState	= $_SESSION['billTo_state'];
	$tempZIP	= $_SESSION['billTo_postalCode'];
	$tempCCNum	= $_SESSION['card_lastFour'];
	$tempPhone	= $_SESSION['billTo_phoneNumber'];
	$tempEmail	= $_SESSION['billTo_email'];
	$tempTotal	= $_SESSION['orderAmount'];
	$tempOrderNum = $_SESSION['orderNumber'];
	}
	

		if ( ($_GET['merchantDefinedData3'] == "false") || !isset($_GET['merchantDefinedData3']) ) {
			$_SESSION['tot'] = $_SESSION['attendee'] * 30 + 30; 
			
		
		include_once("../../../common/cybersource_forms/form_switcher.php");
		
		} else {
		
		
				
			$DBlink = mysql_connect("trinity.sunion.arizona.edu", "web", "viv3nij")
			or die("<br><p><h3>Oops!</h3></p> <p>We could not save your registration in our database.  We apologize for the inconvenince, but you will need to contact (520) 621-8046</p>1");
			
			//Choose DB
			mysql_select_db("NCLC09", $DBlink)
			or die("<br><p><h3>Oops!</h3></p> <p>We could not save your registration in our database.  We apologize for the inconvenince, 			but you will need to contact (520) 621-8046</p>2");
				
		$query = "SELECT id FROM Payment WHERE cybersource_orderNum =\"" . $tempOrderNum . "\"";
			
		$result = mysql_query($query, $DBlink);
		$num = mysql_num_rows($result);
			
		if($num == 0) {
				
			$query = "INSERT INTO Payment SET"
					. " firstName = \"" 				. $tempFN
					. "\", lastName = \""				. $tempLN
					. "\", address = \""				. $tempAdr
					. "\", city = \""					. $tempCity
					. "\", state = \""					. $tempState
					. "\", zip = \""					. $tempZIP
					. "\", email = \""					. $tempEmail
					. "\", phone = \""					. $tempPhone
					. "\", cardLastFour = \""			. $tempCCNum
					. "\", cybersource_orderNum = \""	. $tempOrderNum
					. "\", total = "					. $tempTotal
					. ", status = \"approved\";";	
			
			//mysql_query($query, $DBlink);
			
			$_SESSION['attendee']++;
			$query2 =  "INSERT INTO Corrections SET"
					. " firstName = \"" 				. $_SESSION['firstName']
					. "\", lastName = \""				. $_SESSION['lastName']
					. "\", groupsize = "		. $_SESSION['attendee'] . ";";
					
			//mysql_query($query2, $DBlink);
			
			
	//Use $query to insert into payment	  
	if((!mysql_query($query, $DBlink)) || (!mysql_query($query2, $DBlink))) {
		//SQL INSERT error
		print("<br><p><h3>Oops!</h3></p> <p>We could not save your registration in our database.  We apologize for the inconvenince, but you will need to contact (520) 		
		621-8046</p>3");
		}  else {
		
	
			
		print "<h1>Congratulations</h1>";
		print "<p>Your Payment has been updated and processed!</p>";
		
		$to = $tempEmail;
		$subject = "NCLC Payment Correction Confirmation";
		$message = "Dear " . $tempFN . " " . $tempLN . ",\n \n Your NCLC payment correction for $" . $tempTotal . " has been processed \n \n NCLC Team";
		$from = "nclc@email.arizona.edu";
		$headers = "From: $from";
		mail($to,$subject,$message,$headers);
		
		//print $query;
		//print "<br>";
		//print $query2;
		
		session_destroy();
			}
		}
	}
		?>