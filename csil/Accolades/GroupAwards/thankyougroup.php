<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);

//print_r($_POST);

?>

<div style="width:555px">
<br /><br />
<?php
	
	if((!isset($_POST['NON'])) || ($_POST['NON'] == "")){
		print "<span class='error-msg' >Please enter your name</span><br />";
		$error = true;
	}
		if((!isset($_POST['CMA'])) || ($_POST['CMA'] == "")){
		print "<span class='error-msg' >Please enter your current mailing address</span><br />";
		$error = true;
	}
			if((!isset($_POST['CSZ'])) || ($_POST['CSZ'] == "")){
		print "<span class='error-msg' >Please enter your City, State and ZIP code</span><br />";
		$error = true;
	}
			if((!isset($_POST['PHN'])) || ($_POST['PHN'] == "")){
		print "<span class='error-msg' >Please enter your phone number</span><br />";
		$error = true;
	}
			if((!isset($_POST['EMA'])) || ($_POST['EMA'] == "")){
		print "<span class='error-msg' >Please enter your email</span><br />";
		$error = true;
	}		if((!isset($_POST['RTN'])) || ($_POST['RTN'] == "")){
		print "<span class='error-msg' >Please enter your relation to the nominee</span><br />";
		$error = true;
	}
			if((!isset($_POST['NOO'])) || ($_POST['NOO'] == "")){
		print "<span class='error-msg' >Please enter your nominated group's title</span><br />";
		$error = true;
	}
			if((!isset($_POST['CI'])) || ($_POST['CI'] == "")){
		print "<span class='error-msg' >Please enter the nominee department's contact individual</span><br />";
		$error = true;
	}
			if((!isset($_POST['CMAO'])) || ($_POST['CMAO'] == "")){
		print "<span class='error-msg' >Please enter the nominee's current mailing address</span><br />";
		$error = true;
	}
			if((!isset($_POST['CSZO'])) || ($_POST['CSZO'] == "")){
		print "<span class='error-msg' >Please enter the nominee's City, State and ZIP code</span><br />";
		$error = true;
	}
			if((!isset($_POST['PHOO'])) || ($_POST['PHOO'] == "")){
		print "<span class='error-msg' >Please enter the nominee's phone number</span><br />";
		$error = true;
	}
			if((!isset($_POST['EMAO'])) || ($_POST['EMAO'] == "")){
		print "<span class='error-msg' >Please enter the nominee's email</span><br />";
		$error = true;
	}
	
	if((!isset($_POST['q1'])) || ($_POST['q1'] == "") || ($_POST['q1'] == "Enter Answer Here")){
		print "<span class='error-msg' >Please answer Question 1</span><br />";
		$error = true;
	}
	
	if((!isset($_POST['q2'])) || ($_POST['q2'] == "") || ($_POST['q2'] == "Enter Answer Here")){
		print "<span class='error-msg' >Please answer Question 2</span><br />";
		$error = true;
	}
	
	if((!isset($_POST['q3'])) || ($_POST['q3'] == "") || ($_POST['q3'] == "Enter Answer Here")){
		print "<span class='error-msg' >Please answer Question 3</span><br />";
		$error = true;
	}
	
	if((!isset($_POST['q4'])) || ($_POST['q4'] == "") || ($_POST['q4'] == "Enter Answer Here")){
		print "<span class='error-msg' >Please answer Question 4</span><br />";
		$error = true;
	}
	
	if ($error == true) {
		print "<br><br>";
		require_once('formgroup.php');
		}
	
		/*if($_FILES['userfile']['size'] == 0 ){
		print "Please submit a letter or essay of recommendation<br />";
		$error = true;
	}*/
 
	
	else {
	
	print "<h1> Thank you for your group award nomination!</h1>
			<p>Your award nomination has been succesfully received!</p>";
	

	require_once ('includes/mysqli.inc');
	$db = new db_mysqli('accolades13');
	
	$query = "INSERT INTO Groups SET 
	awardTitle =\"" . $_POST['awardTitle'] . "\",
	nominatorName = \"" . $_POST['NON'] . "\", 
	currentMail = \"" . $_POST['CMA'] . "\", 
	currentMail2 = \"" . $_POST['CMA2'] . "\", 
	cityStateZip = \"" . $_POST['CSZ'] . "\", 
	phone = \"" . $_POST['PHN'] . "\", 
	email = \"" . $_POST['EMA'] . "\", 
	relationToNominee = \"" . $_POST['RTN'] . "\",
	nameOrganization = \"" . $_POST['NOO'] . "\", 
	contactIndiv = \"" . $_POST['CI'] . "\",
	currentMailOrg = \"" . $_POST['CMAO'] . "\", 
	currentMailOrg2 = \"" . $_POST['CMAO2'] . "\",
	cityStateZipOrg = \"" . $_POST['CSZO'] . "\", 
	phoneOrg = \"" . $_POST['PHOO'] . "\",
	emailOrg = \"" . $_POST['EMAO'] . "\",
	question1 = \"" . $_POST['q1'] . "\",
	question2 = \"" . $_POST['q2'] . "\",
	question3 = \"" . $_POST['q3'] . "\",
	question4 = \"" . $_POST['q4'] . "\";"; 
	
	
	$db->query($query);
	
}

//goes into the insert statement if using attachments

/*
essayLetter = \"" . $content . "\",
	essayFilename = \"" . $fileName . "\",
	essayFiletype = \"" . $fileType . "\",
	essayFilesize = " . $fileSize . ";";
*/	
?>

<?php involv_finish(); ?>