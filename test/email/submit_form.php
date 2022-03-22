<?php
// require_once($_SERVER['DOCUMENT_ROOT'] .'/commontools/phplib/mimemail/htmlMimeMail5.php');
// if the submit button was clicked.
if (isset($_POST['submit'])) {
	// Send the confirmation email.
	$first_name = $_POST["first_name"];
	$email = $_POST["email"];

	// Send email.
	$subject = "Celebration Cookies";
	$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
	$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
	// $headers .= "Bcc: su-web@email.arizona.edu\r\n";
	// $headers .= "Bcc: su-web@email.arizona.edu\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
	$message = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: verdana;font-size: 14px; line-height: 150%">
		<br /><h3 style="width:100%;border-top:1px solid #333;border-bottom:1px solid #333;padding-top:5px;padding-bottom:6px;margin-top:0px;margin-bottom:10px;">Celebration Cookies</h3>
		<b>Purchaser Information</b><br/>
		<b>FIRST NAME: </b> '.$first_name.'<br/>
		<b>EMAIL: </b> '.$email.'<br/>
	</body>
	</html>';

	mail($email, $subject, $message, $headers);
	header("Location: submit_success.php");	
	// display a confirmation messge.
	//echo "<form><input type='hidden' id='submit_success'></form><p class='submit_success' >Thank you. The form was submitted successfully.</p><br />"; 
	} 	
?>