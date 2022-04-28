<?php
session_start();
// require_once($_SERVER['DOCUMENT_ROOT'] .'/commontools/phplib/mimemail/htmlMimeMail5.php');
// if the submit button was clicked.
$decision = $_REQUEST['decision'];
// if (isset($_POST['submit'])) {
if($decision == 'ACCEPT') {
	// Send email.
	$email = $_REQUEST['req_merchant_defined_data6'];
	// $_SESSION['$bb_account_id'] = $_REQUEST['req_merchant_defined_data7'];
	$subject = "Celebration Cookies";
	$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
	$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
	// $headers .= "Bcc: su-web@email.arizona.edu\r\n";
	// $headers .= "Bcc: su-web@email.arizona.edu\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
	// $message = "test  123";
	$message = "statement: " . $_REQUEST['req_merchant_defined_data8'] . " & first_name: " . $_REQUEST['req_merchant_defined_data4'];
	mail($email, $subject, $message, $headers);
	// mail($email_manager, $subject, $message, $headers);
	header("Location: submit_success.php");	
	// display a confirmation messge.
	//echo "<form><input type='hidden' id='submit_success'></form><p class='submit_success' >Thank you. The form was submitted successfully.</p><br />"; 
	} 	
?>