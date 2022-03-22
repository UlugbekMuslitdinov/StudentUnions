<?php
	session_start();

	$_SESSION['payment'] = $_POST['payment'];

	if ($_SESSION['payment'] == "Check" || $_SESSION['payment'] == "Interdepartmental Billing Form (U of A Only)") {
	
	include_once('paycheck.php');
	
	} else {
	

	
	/*if(!isset($_SERVER['HTTPS']) && (count($_GET) == 0))
    {
        header("location: https://www.union.arizona.edu/csil/nclc/payment.php");
    }*/
	
	
	
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

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Payment Information</title>


<?php 
/*
if($_GET['merchantDefinedData3'] == "true"){
 $cur_page="signup_complete";}
 else {
$cur_page="payment";
}*/

include_once("common/page_start.php");

?>
<div class="content_block">

<h1>NCLC 2009 Online Registration</h1>
		
<?
		
		if ( ($_GET['merchantDefinedData3'] == "false") || !isset($_GET['merchantDefinedData3']) ) {
		if (time() < 1232949600) {
			$_SESSION['tot'] = $_SESSION['attendee'] * 50 + 50; 
			} else {
			$_SESSION['tot'] = $_SESSION['attendee'] * 75 + 75;
			} 
		
		include_once("../../common/cybersource_forms/form_switcher.php");
		
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
					. ", status = \"approved\"";	
			
			
	//Use $query to insert into payment	  
	if(!mysql_query($query, $DBlink)) {
		//SQL INSERT error
		print("<br><p><h3>Oops!</h3></p> <p>We could not save your registration in our database.  We apologize for the inconvenince, but you will need to contact (520) 		
		621-8046</p>3");
		}  else {

		//Payment was entered, now get the id of that payment for insert into other tables
		$query = "SELECT id FROM Payment WHERE cybersource_orderNum =\"" . $tempOrderNum . "\"";
		$result = mysql_query($query, $DBlink);
		$payment_id = mysql_result($result,0,"id");
		
		$queryReg = "SELECT max(regID) FROM attendee";
		$resultReg = mysql_query($queryReg, $DBlink);
		$reg_ID = mysql_result($resultReg,"regID");
			if (!$reg_ID) {
				$reg_ID = 1;
				} else {
				$reg_ID++;
			}
		
		$query = "INSERT INTO Attendee SET 
			payment_id = " . $payment_id . ",	
			regID = " . $reg_ID . ",
			lastName = \"" 	. $_SESSION['lastName'] . "\",
			firstName = \"" . $_SESSION['firstName'] . "\",
			age = " . $_SESSION['age'] . ",
			gender = \"" 	. $_SESSION['gender'] . "\", 
			attnType = \"" 	. $_SESSION['attnType'] . "\",
			mealType = \"" 	. $_SESSION['mealType'] . "\",
			mealSpecReq = \"" 	. $_SESSION['mealSpecReq'] . "\",
			tShirtSize = \"" 	. $_SESSION['TShirtSize'] . "\",
			school = \"" 	. $_SESSION['school'] . "\",
			International = \"" 	. $_SESSION['Intl'] . "\",
			IntlCountry = \"" 	. $_SESSION['IntlCountry'] . "\",
			StudentOrg = \"" 	. $_SESSION['StuOrg'] . "\",
			email = \"" 	. $_SESSION['email'] . "\",
			phone = \"" 	. $_SESSION['phone'] . "\",
			address1 = \"" 	. $_SESSION['add1'] ."\",
			address2 = \"" 	. $_SESSION['add2'] . "\",
			city = \"" 	. $_SESSION['city'] . "\",
			state = \"" 	. $_SESSION['state'] ."\",
			ZIP = \"" 	. $_SESSION['zip'] . "\",
			paytype = \"Credit Card\",
			payconf = \"Yes\";";

			
			mysql_query($query, $DBlink);
		
		print "<br>";
		
		$query2 = "select id from attendee where lastName=\"" . $_SESSION['lastName'] . "\" AND firstName=\"" . $_SESSION['firstName'] . "\"";
		$result = mysql_query($query2, $DBlink);
		$idnum = mysql_result($result,0,"id");
		
		//print $idnum;
		
		for ($i = 1; $i <= $_SESSION['attendee']; $i++) {
		
		$query = "INSERT INTO Attendee SET 
			payment_id = " . $payment_id . ",
			regID = " . $reg_ID . ",	
			lastName = \"" 	. $_SESSION['lastName' . $i] . "\",
			firstName = \"" . $_SESSION['firstName'  . $i] . "\",
			age = " . $_SESSION['age' . $i] . ",
			gender = \"" 	. $_SESSION['gender' . $i] . "\", 
			attnType = \"" 	. $_SESSION['attnType'  . $i] . "\",
			mealType = \"" 	. $_SESSION['mealType'  . $i] . "\",
			mealSpecReq = \"" 	. $_SESSION['mealSpecReq'  . $i] . "\",
			tShirtSize = \"" 	. $_SESSION['TShirtSize'  . $i] . "\",
			school = \"" 	. $_SESSION['school'  . $i] . "\",
			International = \"" 	. $_SESSION['Intl' . $i] . "\",
			IntlCountry = \"" 	. $_SESSION['IntlCountry' . $i] . "\",
			StudentOrg = \"" 	. $_SESSION['StuOrg' . $i] . "\",
			payconf = \"Yes\";";

			
		//print $query;
		//print "<br>";
		print "<br>";
		
			mysql_query($query, $DBlink);
			
			}
			
		if ($_SESSION['hostType'] == "host") {
		
			
		$query = "INSERT INTO Host SET regID = " . $reg_ID . ",	
			lastName = \"" 	. $_SESSION['lastName']
			. "\", 	hostGender = \"" 	. $_SESSION['hostGen']
			. "\", hostCapacity = \"" . $_SESSION['hostCap']
			. "\", hostPref = \"" . $_SESSION['hostPref'] . "\";";
		
		//print $query;
		
			mysql_query($query, $DBlink);
		
		}
		
		if ($_SESSION['hostType'] == "guest") {
		
			
		$query = "INSERT INTO Guest SET regID = " . $reg_ID . ",	
			lastName = \"" 	. $_SESSION['lastName']
			. "\", 	guestTrans = \"" 	. $_SESSION['guestTrans']
			. "\", 	guestGender = \"" 	. $_SESSION['guestGen']
			. "\", guestNumber = \"" . $_SESSION['guestNum']
			. "\", guestPref = \"" . $_SESSION['guestPref'] . "\";";
		
				
			mysql_query($query, $DBlink);
		
		}
			
		print "<h1>Congratulations</h1>";
		print "<p>Your Registration has been successfully processed and saved in our database!</p>";
		print "<p>A confirmation email has been sent to your email</p>";
		
		/*print "<form action=\"callforprograms.php\" method=\"post\">";
		print "<b>Would you like to submit a call for programs?</b>";
		print "<br><br>";
		print "<input type=\"submit\" value=\"Yes\">";
		print "<input type=\"button\" onClick=\"document.location = 'index.php';\" value=\"No\">";*/
			
		//print_r($_SESSION);	
		print "<br><br><br><br>";
		
		include_once('mail.php');
		require_once('selected_confirm.php');
			
			}
		}
		
		
	}
	?>		
</div>

<?
	include_once("common/page_end.php");
	}
?>	