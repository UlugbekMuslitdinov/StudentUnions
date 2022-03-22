<?php
	session_start();
	$_SESSION['lastName'] = $_POST['lastName'];
	$_SESSION['firstName'] = $_POST['firstName'];
	$_SESSION['age'] = $_POST['age'];
	$_SESSION['gender'] = $_POST['gender'];
	$_SESSION['attnType'] = $_POST['attnType'];
	$_SESSION['mealType'] = $_POST['mealType'];
	$_SESSION['mealSpecReq'] = $_POST['mealSpecReq'];
	
	
if (time() < 1232949600) {
	$_SESSION['TShirtSize'] = $_POST['TShirtSize'];
	} else {
	$_SESSION['TShirtSize'] = "none";
	}
	
	if ($_POST['school'] != "") { 
	$_SESSION['school'] = $_POST['school'];
	} else {
	$_SESSION['school'] = $_POST['schoolMan'];
	}
	
	$_SESSION['Intl'] = $_POST['Intl'];
	$_SESSION['IntlCountry'] = $_POST['IntlCountry'];
	$_SESSION['StuOrg'] = $_POST['StuOrg'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['phone'] = $_POST['phone'];
	$_SESSION['add1'] = $_POST['add1'];
	$_SESSION['add2'] = $_POST['add2'];
	$_SESSION['city'] = $_POST['city'];
	$_SESSION['state'] = $_POST['state'];
	$_SESSION['zip'] = $_POST['zip'];
	
	
	for ($i = 1; $i <= $_SESSION['attendee']; $i++) {
	
	$_SESSION['firstName' . $i] = $_POST['firstName'. $i];
	$_SESSION['lastName'. $i] = $_POST['lastName'. $i];
	$_SESSION['age'. $i] = $_POST['age'. $i];
	$_SESSION['gender'. $i] = $_POST['gender'. $i];
	$_SESSION['attnType'. $i] = $_POST['attnType'. $i];
	$_SESSION['mealType'. $i] = $_POST['mealType'. $i];
	$_SESSION['mealSpecReq'. $i] = $_POST['mealSpecReq'. $i];

	if (time() <  1232949600) {
	$_SESSION['TShirtSize' . $i] = $_POST['TShirtSize' . $i];
	} else {
	$_SESSION['TShirtSize' . $i] = "none";
	}

	if ($_POST['school' . $i] != "") { 
		$_SESSION['school' . $i] = $_POST['school' . $i];
		} else {
		$_SESSION['school' . $i] = $_POST['schoolMan' . $i];
		}
	
	$_SESSION['Intl' . $i] = $_POST['Intl' . $i];
	$_SESSION['IntlCountry' . $i] = $_POST['IntlCountry' . $i];
	$_SESSION['StuOrg' . $i] = $_POST['StuOrg' . $i];
	}
	

/* Correction Edits start */

	if	((!isset($_POST['firstName'])) || ($_POST['firstName'] == ""))  {
	
		$error = true;
		$_POST['error1'] = "You did not enter a first name<br>";
		
		}
	
	if ((!isset($_POST['lastName']))  || ($_POST['lastName'] == "")) {
	
		$error = true;
		$_POST['error2'] = "You did not enter a last name<br>";
		
		}
		
	if ((!isset($_POST['age'])) || ($_POST['age'] == "")) {
	
		$error = true;
		$_POST['error3'] = "You did not enter your age<br>";
		
		}
		
	if   ( ( (!isset($_POST['school']))  || ($_POST['school'] == "") )  && ( ($_POST['schoolMan'] == "")  || (!isset($_POST['school'])) ) ) {
	
		$error = true;
		$_POST['error4'] = "You did not specify what participating school you are affiliated with<br>";
		
		}
		
	if (($_POST['Intl'] == "Yes") && ($_POST['IntlCountry'] == "")) {
	
		$error = true;
		$_POST['error5'] = "You specified that you are an International Student, but did not specify the country you identify with<br>";
		
		}
		
	if	((!isset($_POST['email'])) || ($_POST['email'] == "")) {
	
		$error = true;
		$_POST['error6'] = "You did enter your email address<br>";
		
		}
		
	if  ((!isset($_POST['add1']))  || ($_POST['add1'] == "")) {
	
		$error = true;
		$_POST['error7'] = "You did not enter your street address<br>";
		
		}
		
	if  ((!isset($_POST['city']))  || ($_POST['city'] == "")) {
	
		$error = true;
		$_POST['error8'] = "You did not enter your city<br>";
		
		}
		
	if  ((!isset($_POST['state']))  || ($_POST['state'] == "")) {
	
		$error = true;
		$_POST['error9'] = "You did not enter your state code<br>";
		
		}
	if  ((!isset($_POST['zip']))  || ($_POST['zip'] == "")) {
	
		$error = true;
		$_POST['error10'] = "You did not enter your zip code<br>";
		
		}
		
for ($i=1; $i <= $_SESSION['attendee']; $i++) {
	
		if((!isset($_POST['firstName' . $i])) || ($_POST['firstName' . $i] == ""))  {
	
		$error = true;
		$_POST['errorAttn1' . $i] = "You did not enter a first name for additional attendee " . $i . "<br>";
		
		}
		
		if((!isset($_POST['lastName' . $i])) || ($_POST['lastName' . $i] == ""))  {
	
		$error = true;
		$_POST['errorAttn2' . $i] = "You did not enter a last name for additional attendee " . $i . "<br>";
		
		}
		
		
		if((!isset($_POST['age' . $i])) || ($_POST['age' . $i] == ""))  {
	
		$error = true;
		$_POST['errorAttn3' . $i] = "You did not enter an age foradditional attendee " . $i . "<br>";
		
		}
		
		
		if( ( (!isset($_POST['school'. $i]))  || ($_POST['school'. $i] == "") )  && ( ($_POST['schoolMan'. $i] == "")  || (!isset($_POST['school'. $i])) ) ) {
	
		$error = true;
		$_POST['errorAttn4' . $i] = "You did not enter the school additional attendee " . $i . " is affiliated with<br>";
		
		}
		
		if ($_POST['Intl' . $i] == "Yes") {
			if (($_POST['IntlCountry' . $i] == "") || (!isset($_POST['IntlCountry' . $i]))) {
	
					$error = true;
					$_POST['errorAttn5' . $i] = "You specified that attendee " . $i . " is an International Student, but did not specify the country they identify with<br>";
					}
		}
}
	
	
	
if (isset($error)) {

		$_POST['change'] = true;
		
		require_once('reg2.php');
	
} else {

/* Correction Edits End */



	include_once("common/page_start.php");
	//print_r($_SESSION);
?>


<div class="content_block">

<h1>NCLC 2009 Online Registration</h1>

<?

	print "<br><br>";
	print "Please confirm that all this data is correct:";
	print "<br><br>";
	
	print '<form action="reg2.php" method="post">';
	print '<div style="height:40px; width:400px">';
	print '<div style="float:left; width:300px">';
	print "<br><br>";
	print "<b>Primary Registrant:</b>";
	print "<br><br>";
	print '</div>';
	print '<div style="float:left; width:100px"">';
	print "<br><br>";
	print '<input type="hidden" name="change" value="true">';
	print '<input type="submit" value="Change Primary">';
	print "<br><br>";
	print '</div>';
	print '</div>';
	print '</form>';
	
	print '<div style="float:left;">';
	print "<table>";
	print "<tr>";
	print "<td width=\"200px\">";
	print "First Name:";
	print "</td>";
	print "<td>";
	print $_SESSION['firstName'];
	print "</td>";
	print "</tr>";
	
	
	print "<tr>";
	print "<td>";
	print "Last Name";
	print "</td>";
	print "<td>";
	print $_SESSION['lastName'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Age:";
	print "</td>";
	print "<td>";
	print $_SESSION['age'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Gender:";
	print "</td>";
	print "<td>";
	print $_SESSION['gender'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Attendee Type:";
	print "</td>";
	print "<td>";
	print $_SESSION['attnType'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Meal Type:";
	print "</td>";
	print "<td>";
	print $_SESSION['mealType'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Meal Type Specifics:";
	print "</td>";
	print "<td>";
	print $_SESSION['mealSpecReq'];
	print "</td>";
	print "</tr>";

if (time() < 1232949600) {
		print "<tr>";
			print "<td>";
			print "T-Shirt Size:";
			print "</td>";
			print "<td>";
			print $_SESSION['TShirtSize'];
			print "</td>";
		print "</tr>";
	}
	
	print "<tr>";
	print "<td>";
	print "School:";
	print "</td>";
	print "<td>";
	print $_SESSION['school'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
			print "<td>";
			print "International Student:";
			print "</td>";
			print "<td>";
			print $_SESSION['Intl'];
			print "</td>";
		print "</tr>";
	
		print "<tr>";
			print "<td>";
			print "Country (If International):";
			print "</td>";
			print "<td>";
			print $_SESSION['IntlCountry'];
			print "</td>";
		print "</tr>";
	
		print "<tr>";
			print "<td>";
			print "Student Organization:";
			print "</td>";
			print "<td>";
			print $_SESSION['StuOrg'];
			print "</td>";
		print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Email:";
	print "</td>";
	print "<td>";
	print $_SESSION['email'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Phone:";
	print "</td>";
	print "<td>";
	print $_SESSION['phone'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Address:";
	print "</td>";
	print "<td>";
	print $_SESSION['add1'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Addr Line 2:";
	print "</td>";
	print "<td>";
	print $_SESSION['add2'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "City:";
	print "</td>";
	print "<td>";
	print $_SESSION['city'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "State:";
	print "</td>";
	print "<td>";
	print $_SESSION['state'];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "ZIP:";
	print "</td>";
	print "<td>";
	print $_SESSION['zip'];
	print "</td>";
	print "</tr>";

	
	print "<br><br>";
	
	
if($_SESSION['attendee'] > 0) {	

	print "</table>";
	print "</div>";

	print '<form action="reg.php" method="post">';
	print '<div style="height:40px; width:400px">';
	print '<div style="float:left; width:300px">';
	print "<br><br>";
	print "<b>Other Attendee(s):</b>";
	print "<br><br>";
	print '</div>';
	print '<div style="float:left; width:100px"">';
	print "<br><br>";
	print '<input type="hidden" name="changeAttn" value="true">';
	print '<input type="submit" value="Change Attendee(s)">';
	print "<br><br>";
	print '</div>';
	print '</div>';
	print '</form>';
	
	print '<div style="float:left;">';
	print "<table>";
	
	for($i = 1; $i <= $_SESSION['attendee']; $i++) {
	
	print "<tr>";
	print '<td colspan="2">';
	print '<b>Additional Attendee &nbsp;' . $i . '</b>';
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td width=\"200px\">";
	print "First Name";
	print "</td>";
	print "<td>";
	print $_SESSION['firstName' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Last Name";
	print "</td>";
	print "<td>";
	print $_SESSION['lastName' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Age:";
	print "</td>";
	print "<td>";
	print $_SESSION['age' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Gender:";
	print "</td>";
	print "<td>";
	print $_SESSION['gender' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Attendee Type:";
	print "</td>";
	print "<td>";
	print $_SESSION['attnType' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Meal Type:";
	print "</td>";
	print "<td>";
	print $_SESSION['mealType' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Meal Type Specifics:";
	print "</td>";
	print "<td>";
	print $_SESSION['mealSpecReq' . $i];
	print "</td>";
	print "</tr>";
	
if (time() < 1232949600) {
	print "<tr>";
	print "<td>";
	print "T-Shirt Size:";
	print "</td>";
	print "<td>";
	print $_SESSION['TShirtSize' . $i];
	print "</td>";
	print "</tr>";
}
	
	print "<tr>";
	print "<td>";
	print "School:";
	print "</td>";
	print "<td>";
	print $_SESSION['school' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "International Student:";
	print "</td>";
	print "<td>";
	print $_SESSION['Intl' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Country (If International):";
	print "</td>";
	print "<td>";
	print $_SESSION['IntlCountry' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "Student Organization:";
	print "</td>";
	print "<td>";
	print $_SESSION['StuOrg' . $i];
	print "</td>";
	print "</tr>";
	
	print "<tr>";
	print "<td>";
	print "&nbsp;";
	print "</td>";
	print "</tr>";
	print "<tr>";
	print "<td>";
	print "&nbsp;";
	print "</td>";
	print "</tr>";
	}
	


}

print "</table>";

print "<br>";
print '<form action="reg4.php">';
print '<input type="submit" value="Save &amp; Continue"/>';
print '</form>';
	
print "</div>";

	/* ------------------- Corrections Check --------------------*/	
	
	}
	
	/* ------------------- End Corrections Check --------------------*/	


?>

</div>

<?
	include_once("common/page_end.php");
?>