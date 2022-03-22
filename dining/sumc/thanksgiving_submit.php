<?php
// Turn off all error reporting
error_reporting(0);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// Form processing
if (isset($_POST['submit']) ){
	$name = $_POST["client_name"];
	$phone = $_POST["client_phone"];
	$email = $_POST["client_email"];
	$entreechoice = $_POST["entreechoice"];
	//$saladchoice = $_POST["saladchoice"];
	//$sides = $_POST['starches'];
	$dessert = $_POST["dessert"];
	$location = $_POST['location'];
	$time = $_POST['time'];
	$payment = $_POST['payment'];
	// Add description for the payment option.
		switch ($payment) {
			case 1:
				$payment_2 = "Credit Card/ Debit Card";
				$status = "Started";
				$payment_message = "";
				break;
			case 2:
				$payment_2 = "Meal Plan";
				$status = "Not Paid";
				$payment_message = "<p><b>A team member from Dining Services will contact you for Meal Plan/Cat Cash payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
			case 3:
				$payment_2 = "Other";
				$status = "Not Paid";
				$payment_message = "<p><b>A team member from Dining Services will contact you for your IDB payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
		}	
	//if($payment == 'card') {
//		header("Location: ./thanksgiving_cybersource.php");
//	}

// Entre validation
if(!isset($entreechoice)) {
	echo '<script type="text/JavaScript">alert("You must select 1 main Entree.");window.history.back();</script>'; 
	die();
	return false;	
// Bread validation
} elseif(!isset($location)) {
	echo '<script type="text/JavaScript">alert("You must select the location.");window.history.back();</script>'; 
	die();
	return false;
// Bread validation
} elseif(!isset($time)) {
	echo '<script type="text/JavaScript">alert("You must select the time.");window.history.back();</script>'; 
	die();
	return false;
// Dessert validation
} elseif(!isset($dessert)) {
	echo '<script type="text/JavaScript">alert("You must select 1 dessert.");window.history.back();</script>'; 
	die();
	return false;
} else {	
	
// Send the Confirmation email.
$subject = "Thanksgiving Offerings To Go - " . date("F j, Y, g:i a") . "";
$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
//$headers .= "Bcc: emilyr1@arizona.edu\r\n";
$headers .= "Bcc: su-web@email.arizona.edu\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$message = '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: arial, sans-serif;font-size: 13px;line-height:150%;">
		<br /><h3 style="width:100%;border-top:1px solid #333;border-bottom:1px solid #333;padding-top:5px;padding-bottom:6px;margin-top:0px;margin-bottom:10px;">Thanksgiving Offerings To Go Order Summary:</h3>
		<b>NAME:</b> '.$name.'<br/>
		<b>EMAIL:</b> '.$email.'<br/>
		<b>PHONE:</b> '.$phone.'<br/><br/>
		<b>ENTR&Eacute;E:</b> '.$entreechoice.'<br/>
		<b>SALADS:</b><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fall Layered Salad<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thanksgiving Slaw<br/>
		<b>SIDES:</b><br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Autumn Sage and Sausage Stuffing<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creamy Yukon Mashed Potatoes<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spiced-Maple Garnet Yams, Pecans and Apricots<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Roasted Cauliflower and Pomegranate Molasses<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creamed Spinach and Shallot Rings<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maple Roasted Harvest Root Vegetables<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cranberry Orange Relish<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cranberry Multigrain Loaf<br/>
		<b>DESSERT:</b> '.$dessert.'<br/>
		<b>LOCATION:</b> '.$location.'<br/>
		<b>TIME:</b> '.$time.'<br/>
		<b>PAYMENT OPTION:</b> '.$payment_2.'<br/><br />
		'.$payment_message.'
	</body>
</html>';
	
// Store the information into the database.
$db = new db_mysqli('su');
$query = "insert into forms set " . 
		 "form = 'Thanksgiving Offerings To-Go'" .
	     ", name = '" . $name .
	     "', email = '" . $email .
	     "', phone = '" . $phone .
		 "', pickuptime = '" . $time .
	     "', pickuplocation = '" . $location .  
		 "', payment = '" . $payment_2 .  
		 "', totalamount = '" . "85" .	// It's an $85 package.
	     "', status = '" . $status .
		 "', emailsubject = '" . $subject .
	     "', emailheaders = '" . $headers .
	     "', emailmessage = '" . $message .
		 "'" ;
$db->query($query);

// Retrieve ID for this record. The ID is needed after the credit card payment to send email.
$query = "SELECT max(id) as max_id FROM forms";
$result = $db->query($query);
$form = mysqli_fetch_assoc($result);
$max_id = $form['max_id'];

// Payment Option
if ($payment == 1) {	// If the payment option is 1 (Credit Card)
	header("Location: http://".$_SERVER[HTTP_HOST]."/dining/sumc/thanksgiving_handler.php?id=" . $max_id . "");
} else {
	// Send email.
	mail($email, $subject, $message, $headers);
	// Redirect to the confirmation page.
	header("Location: http://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php?confirm=feast");
}

}
}
?>