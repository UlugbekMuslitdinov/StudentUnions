<?php
if (isset($_SESSION['check']))
{
	if (!$_SESSION['admin'])
	{
		$_SESSION['display'] = 3; //reset application.php
		$_SESSION['sch_error'] = '<span style="color: red">You are not a verified admin.</span>';
		redirect('https://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	}
}
	
if (isset($_SESSION['scholarship']))
{
	if (isset($_POST['sch_var_code']) && $_POST['sch_var_code'] != "Equiss$11")
	{
		$_SESSION['display'] = 3; //reset application.php
		$_SESSION['sch_error'] = '';
		redirect('https://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	}
}
	
if (isset($_SESSION['idb']))
{
	if (isset($_POST['idb_var_code'])&& $_POST['idb_var_code'] != "Equiss$11")
	{
		$_SESSION['display'] = 3; //reset application.php
		$_SESSION['sch_error'] = '<span style="color: red">The Verification Code you entered is not valid. Please try again</span>';
		redirect('https://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	}
}

$_SESSION = clean_string($_SESSION);

// Save into general registration
$query = "INSERT INTO registration SET
			firstName = '{$_SESSION['firstName']}',
			lastName = '{$_SESSION['lastName']}',
			address = '{$_SESSION['address']}',
			city = '{$_SESSION['city']}',
			state = '{$_SESSION['state']}',
			ZIP = '{$_SESSION['zip']}',
			phoneNumber = '{$_SESSION['phone']}',
			cell = '{$_SESSION['cell']}',
			email = '{$_SESSION['email']}',
			school = '{$_SESSION['school']}',
			specdiet = '{$_SESSION['specdiet']}',
			specneeds = '{$_SESSION['specneeds']}',
			major = '{$_SESSION['major']}',
			career = '{$_SESSION['career']}',
			DOB = '{$_SESSION['DOB']}',
			age = '{$_SESSION['age']}',
			race = '{$_SESSION['race']}',
			gender = '{$_SESSION['gender']}',
			religion = '{$_SESSION['religion']}',
			orientation = '{$_SESSION['orientation']}',
			economic = '{$_SESSION['economic']}',
			shuttle = '{$_SESSION['shuttle']}',
			printedName = '{$_SESSION['printedName']}',
			sigDate = '{$_SESSION['sigDate']}',
			conditionsAgreement = '{$_SESSION['conditionsAgreement']}',
			q_1 = '{$_SESSION['q_one']}',
			q_2 = '{$_SESSION['q_two']}',
			q_3 = '{$_SESSION['q_three']}'";

$lastid = 0;
if ($result = mysql_query($query))
{
	// Get the id of the registration we just inserted
	$lastid = mysql_insert_id();
	
	$idents = $_SESSION['identities'];
	$nid = count($idents);
	
	// Save the Identify statements that were selected in "identities" table
	if ($nid != 0)
	{
		foreach($idents as $ix)
		{
			$query = "INSERT INTO identities SET reg_id = $lastid, identity_text = '$ix'";	
			$result = mysql_query($query) or die(mysql_error());
		} 
	}
	
	// Save into payments table
	$pay_type = pay_type();
	$query = "INSERT INTO payment SET
				reg_id = $lastid,
				firstName = '{$_SESSION['firstName']}',
				lastName = '{$_SESSION['lastName']}',
				address = '{$_SESSION['address']}',
				city = '{$_SESSION['city']}',
				state = '{$_SESSION['state']}',
				zip = '{$_SESSION['zip']}',
				email = '{$_SESSION['email']}',
				phoneNumber = '{$_SESSION['phone']}',
				status = 'approved',
				time = " . time() . 
				sprintf(", paymentID = '%s', total = '%d'", $pay_type['paymentID'], $pay_type['total']);
	
	$result = mysql_query($query) or die(mysql_error());
}

// Send confirmation email
$to = $_SESSION['email'];
$subject = 'Equiss Social Justice Retreat Confirmation';
$message = "Thank you for registering for the Equiss Social Justice Retreat.<br />See you May 23rd!<br />Contact us: equiss@yahoo.com" . get_receipt($pay_type) . get_info($lastid);
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: equiss@yahoo.com' . "\r\n";
mail($to, $subject, $message, $headers);

// Send notice email
$to = EMAIL_ADMIN;
$subject = 'Equiss Social Justice Retreat Registration';
$message = "A new registration has been stored in the database.<br /><a href=\"http://www.union.arizona.edu/csil/equissregistration/backweb/backweball.php\">Click Here</a> to see current registrations.";
mail($to, $subject, $message, $headers);

// Display thank you
echo "<h3>Thank you for registering!</h3>
<p>Your information has been received!</p>" . get_receipt($pay_type);

session_destroy();
?>