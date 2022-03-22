<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
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
			if((!isset($_POST['FNM'])) || ($_POST['FNM'] == "")){
		print "<span class='error-msg' >Please enter your nominee's name</span><br />";
		$error = true;
	}
			if((!isset($_POST['LNM'])) || ($_POST['LNM'] == "")){
		print "<span class='error-msg' >Please enter your nominee's name</span><br />";
		$error = true;
	}
			if((!isset($_POST['CMAN'])) || ($_POST['CMAN'] == "")){
		print "<span class='error-msg' >Please enter the nominee's current mailing address</span><br />";
		$error = true;
	}
			if((!isset($_POST['CSZN'])) || ($_POST['CSZN'] == "")){
		print "<span class='error-msg' >Please enter the nominee's City, State and ZIP code</span><br />";
		$error = true;
	}
			if((!isset($_POST['PHON'])) || ($_POST['PHON'] == "")){
		print "<span class='error-msg' >Please enter the nominee's phone number</span><br />";
		$error = true;
	}
			if((!isset($_POST['EMAN'])) || ($_POST['EMAN'] == "")){
		print "<span class='error-msg' >Please enter the nominee's email</span><br />";
		$error = true;
	}
	
			if((!isset($_POST['COL'])) || ($_POST['COL'] == "")){
		print "<span class='error-msg' >Please enter the nominee's college</span><br />";
		$error = true;
	}
		if((!isset($_POST['DEPT'])) || ($_POST['DEPT'] == "")){
		print "<span class='error-msg' >Please enter the nominee's department</span><br />";
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
		require_once('formindv.php');
		}
	
	
	else {
	
	print "<h1> Thank you for your individual award nomination!</h1>
			<p>Your award nomination has been succesfully received!</p>";
	
	/*$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
		
	$fp = fopen($tmpName, 'r');
	$content = fread($fp, $fileSize);
	$content = addslashes($content);
	fclose($fp);*/
 
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli('accolades13');
	
	$query = "INSERT INTO Individuals SET
	awardTitle = \"" . $_POST['AN'] . "\", 
	nominatorName = \"" . $_POST['NON'] . "\", 
	currentMail = \"" . $_POST['CMA'] . "\", 
	currentMail2 = \"" . $_POST['CMA2'] . "\", 
	cityStateZip = \"" . $_POST['CSZ'] . "\", 
	phone = \"" . $_POST['PHN'] . "\", 
	email = \"" . $_POST['EMA'] . "\", 
	relationToNominee = \"" . $_POST['RTN'] . "\",
	firstNameNominee = \"" . $_POST['FNM'] . "\",
	lastNameNominee = \"" . $_POST['LNM'] . "\",
	currentMailNominee = \"" . $_POST['CMAN'] . "\", 
	currentMailNominee2 = \"" . $_POST['CMAN2'] . "\",
	cityStateZipNominee = \"" . $_POST['CSZN'] . "\", 
	phoneNominee = \"" . $_POST['PHON'] . "\",
	emailNominee = \"" . $_POST['EMAN'] . "\", 
	college = \"" . $_POST['COL'] . "\",
	department = \"" . $_POST['DEPT'] . "\",
	question1 = \"" . $_POST['q1'] . "\",
	question2 = \"" . $_POST['q2'] . "\",
	question3 = \"" . $_POST['q3'] . "\",
	question4 = \"" . $_POST['q4'] . "\";"; 
	
	$db->query($query);
	
	/*$result = mysql_query("SELECT MAX(id) AS maxid FROM registration");
    $stuff = mysql_fetch_assoc($result);
						 		
					
	$query = "INSERT INTO identities SET"
	. " reg_id = "			 				. $stuff['maxid']
				
	$result = mysql_query($query, $DBlink); 
	
	}	*/
			
} 
	
?>

<?php involv_finish(); ?>