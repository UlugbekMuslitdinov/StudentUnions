<?php
// header("Location: https://union.arizona.edu/celebrationcookies/index.php");
// die();
// Processig the CyberSource form.
$decision = $_REQUEST['decision'];
if($decision == 'ACCEPT') {
	// Send email.
	$email = $_REQUEST['req_merchant_defined_data6'];
	$email_manager = "su-web@email.arizona.edu";
	// $email_manager = "sueventplanning@email.arizona.edu";
	$subject = "Cookies";
	$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
	$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
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
		<b>FIRST NAME: </b> '.$_REQUEST['req_merchant_defined_data4'].'<br/>
		<b>LAST NAME: </b> '.$_REQUEST['req_merchant_defined_data5'].'<br/
		<b>EMAIL: </b> '.$_REQUEST['req_merchant_defined_data6'].'<br/>
		<b>PHONE: </b> '.$_REQUEST['req_merchant_defined_data7'].'<br/>
		<b>STATEMENT:</b><br/><pre><div style="font-family: verdana; font-size: 14px;"> '.$_REQUEST['req_merchant_defined_data8'].'</div></pre><br/>
		<b>Student Information</b><br/>
		<b>STUDENT NAME: </b> '.$_REQUEST['req_merchant_defined_data9'].'<br/>
		<b>STUDENT EMAIL: </b> '.$_REQUEST['req_merchant_defined_data10'].'<br/
		<b>STUDENT PHONE: </b> '.$_REQUEST['req_merchant_defined_data11'].'<br/><br/>
		<b>PICKUP DATE: </b> '.$_REQUEST['req_merchant_defined_data12'].'<br/>
		<b>TOTAL: </b> $'.$_REQUEST['req_merchant_defined_data17'].' ($' . $_REQUEST['req_merchant_defined_data13'] . ' + $' . $_REQUEST['req_merchant_defined_data16'] . ' tax)<br/><br/>
		<b>Quantity for Each Item</b><br/>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
		<td width="400" align="center">Item</td>
		<td width="80" align="center">Quantity</td>
		</tr>
		<tr>
		<td>Welcome Wildcat 5-Pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data14']
			.'</span></td>
		</tr>
		<tr>
		<td>Donate Welcome Wildcat 5-pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data15'].'</span></td>
		</tr>
		</table>
	</body>
	</html>';
	$message_customer = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: verdana;font-size: 14px; line-height: 150%">
		Thank you for your purchase of cookies through the Student Union Memorial Center.  Please instruct your student to check their CatMail for pick up instructions.  If you have any further questions please call us at 520-621-1414 or email us at <br /><a href="mailto:su-sueventplanning@email.arizona.edu">su-sueventplanning@email.arizona.edu</a>.<br /><br />

		Thank you!<br />
		Student Union Culinary and Events Team	
	</body>
	</html>';
	mail($email, $subject, $message_customer, $headers);
	mail($email_manager, $subject, $message, $headers);
	header("Location: submit_success.php");	
	
	// display a confirmation messge.
	//echo "<form><input type='hidden' id='submit_success'></form><p class='submit_success' >Thank you. The form was submitted successfully.</p><br />"; 
	} 	
?>