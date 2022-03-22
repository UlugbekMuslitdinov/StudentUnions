<?php	
	session_start();
include_once("common/page_start.php");

?>

<div class="content_block">


<h1>NCLC 2009 Online Registration</h1>

<b>Print This Page </b>

<p>We have stored your information in our database and look forward to receiving your payment.  Your registration <b>will not</b> be processed until we receive your payment and a copy of the summary page. A confirmation e-mail will be sent to the primary registrant's e-mail address to confirm that payment has been received. </p>

<b>Payments</b>
<p>Registrations postmarked after January 26, 2009 and February 6, 2009 will be charged $75 per person.  Registrations postmarked after February 6, 2009 will not be processed. </p>

<p>Please mail a copy of your registration summary and payment to:
<br /><br />
National Collegiate Leadership Conference<br />
Center for Student Involvement and Leadership<br />
Arizona Student Unions<br />
PO Box 210017<br />
Tucson, Arizona 85721-0017<br />
</p>

<p>Questions:<br />
If you have any questions please contact our office by phone at 520-626-1572 or by e-mail at nclc@email.arizona.edu</p>

<p>Requesting Special Services:<br />
Please contact our Facilities Chair, Lauren Myers at lmyers@email.arizona.edu to request special services or accommodations.</p>

<p>Cost and Refund Policy:  The cost of registration ($50) for the National Collegiate Leadership Conference includes all conference materials, three days of programming and dinner on Saturday evening. The fee does not include lodging or transportation; however participation in the hosting program is available at no cost. After January 25, 2009, the registration fee will increase to $75 per person and t-shirts will not be provided for participants who register after this date.  Requests for refunds must be made in writing and are subject to a 25% administrative fee. Refund Requests must be received no later than January 25, 2009.</p>

<?

	$DBlink = mysql_connect("trinity.sunion.arizona.edu","web","viv3nij")
			or die("<br><p><h3>Oops!</h3></p> <p>We could not save your registration in our database.  We apologize for the inconvenince, but you will need to contact (520) 621-8046</p>1");
			
			//Choose DB
			mysql_select_db("NCLC09", $DBlink)
			or die("<br><p><h3>Oops!</h3></p> <p>We could not save your registration in our database.  We apologize for the inconvenince, 			but you will need to contact (520) 621-8046</p>2");

		
		$queryReg = "SELECT max(regID) FROM attendee";
		$resultReg = mysql_query($queryReg, $DBlink);
		$reg_ID = mysql_result($resultReg,"regID");
			if (!$reg_ID) {
				$reg_ID = 1;
				} else {
				$reg_ID++;
			}
		
		$query = "INSERT INTO Attendee SET 
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
			paytype = \"" 	. $_SESSION['payment'] . "\",
			payconf = \"No\";";
			
			mysql_query($query, $DBlink);
		
		//print $query;
		//print "<br>";
		print "<br>";
		
		//print $idnum;
		
		for ($i = 1; $i <= $_SESSION['attendee']; $i++) {
		
		$query = "INSERT INTO Attendee SET 	
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
			payconf = \"No\";";
			
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
		
			mysql_query($query, $DBlink);
		
		}
		
		if ($_SESSION['hostType'] == "guest") {
		
			
		$query = "INSERT INTO Guest SET regID = " . $reg_ID . ",	
			lastName = \"" 	. $_SESSION['lastName']
			. "\", 	guestTrans = \"" 	. $_SESSION['guestTrans']
			. "\", 	guestGender = \"" 	. $_SESSION['guestGen']
			. "\", guestNumber = \"" . $_SESSION['guestNum']
			. "\", guestPref = \"" . $_SESSION['guestPref'] . "\";";
		
		//print $query;
				
			mysql_query($query, $DBlink);
		
		}
		
include_once('mail.php');
require_once('selected_confirm.php');
session_destroy();
?>

</div>

<?
	
	include_once("common/page_end.php");
	
?>