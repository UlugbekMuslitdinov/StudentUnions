<?php
// header("Location: https://union.arizona.edu/celebrationcookies/index.php");
// die();
// Processig the CyberSource form.
$decision = $_REQUEST['decision'];
if($decision == 'ACCEPT') {
	// Send email.
	$email = $_REQUEST['req_merchant_defined_data6'];
	// $email_manager = "su-web@email.arizona.edu";
	// $email_manager = "su-arizonadining@email.arizona.edu";
	$email_manager = "su-arizonadining@arizona.edu";
	$subject = "Celebration Cookies";
	$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
	$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
	$message_0 = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: verdana;font-size: 14px; line-height: 150%">';
	$message = $message_0 . '
		<br /><h3 style="width:100%;border-top:1px solid #333;border-bottom:1px solid #333;padding-top:5px;padding-bottom:6px;margin-top:0px;margin-bottom:10px;">Celebration Cookies</h3>
		<b>Purchaser Information</b><br/>
		<b>FIRST NAME: </b> '.$_REQUEST['req_merchant_defined_data4'].'<br/>
		<b>LAST NAME: </b> '.$_REQUEST['req_merchant_defined_data5'].'<br/
		<b>EMAIL: </b> '.$_REQUEST['req_merchant_defined_data6'].'<br/>
		<b>PHONE: </b> '.$_REQUEST['req_merchant_defined_data7'].'<br/>
		<b>NOTE:</b><br/><pre><div style="font-family: verdana; font-size: 14px;"> '.$_REQUEST['req_merchant_defined_data8'].'</div></pre><br />
		<b>Student Information</b><br/>
		<b>STUDENT NAME: </b> '.$_REQUEST['req_merchant_defined_data9'].'<br/>
		<b>STUDENT EMAIL: </b> '.$_REQUEST['req_merchant_defined_data10'].'<br/
		<b>STUDENT PHONE: </b> '.$_REQUEST['req_merchant_defined_data11'].'<br/><br/>
		<b>PICKUP DATE: </b> '.$_REQUEST['req_merchant_defined_data12'].'<br/>
		<b>TOTAL: </b> $'.$_REQUEST['req_merchant_defined_data23'].' ($' . $_REQUEST['req_merchant_defined_data13'] . ' + $' . $_REQUEST['req_merchant_defined_data22'] . ' tax)<br/><br/>
		<b>Quantity for Each Item</b><br/>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
		<td width="400" align="center">Item</td>
		<td width="250" align="center">Quantity</td>
		</tr>';
	if ($_REQUEST['req_merchant_defined_data14'] > 0) {
	$message .= '
		<tr>
		<td>Spring Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data14'].'</span></td>
		</tr>';
	}
	if ($_REQUEST['req_merchant_defined_data15'] > 0) {
	$message .= '
		<tr>
		<td>Graduation Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data15'].'</span></td>
		</tr>';
	}
	// For A Cookie
	if ($_REQUEST['req_merchant_defined_data17'] > 0) {
	$message .= '
		<tr>
		<td>"A" Cookie 4-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data17'].'</span></td>
		</tr>';
	}
	// For Baseball/Softball
	if ($_REQUEST['req_merchant_defined_data26'] > 0) {
	$message .= ' 
		<tr>
		<td>Baseball/Softball Sports Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data26'].'<br /> ('.$_REQUEST['req_merchant_defined_data25'].' Themed)</span></td>
		</tr>';
	}
	// For Basketball/Football
	if ($_REQUEST['req_merchant_defined_data16'] > 0) {
	$message .= ' 
		<tr>
		<td>Basketball/Football Sports Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data16'].'<br /> ('.$_REQUEST['req_merchant_defined_data24'].' Themed)</span></td>
		</tr>';
	}
	if ($_REQUEST['req_merchant_defined_data18'] > 0) {
	$message .= '
		<tr>
		<td>Donate Spring Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data18'].'</span></td>
		</tr>';
	}
	if ($_REQUEST['req_merchant_defined_data19'] > 0) {
	$message .= '
		<tr>
		<td>Donate Graduation Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data19'].'</span></td>
		</tr>';
	}
	// For A cookie donation
	if ($_REQUEST['req_merchant_defined_data21'] > 0) {
	$message .= '
		<tr>
		<td>Donate "A" Cookie 4-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data21'].'</span></td>
		</tr>';
	}
	// For Baseball/Softball
	if ($_REQUEST['req_merchant_defined_data27'] > 0) {
	$message .= '
		<tr>
		<td>Donate Baseball/Softball Sports Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data27'].'<br /> ('.$_REQUEST['req_merchant_defined_data25'].' Themed)</span></td>
		</tr>';
	}
	// For Basketball/Football
	if ($_REQUEST['req_merchant_defined_data20'] > 0) {
	$message .= '
		<tr>
		<td>Donate Basketball/Football Sports Cookie 5-Pack - $14.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$_REQUEST['req_merchant_defined_data20'].'<br /> ('.$_REQUEST['req_merchant_defined_data24'].' Themed)</span></td>
		</tr>';
	}
	$message .= '
		</table><br />
	</body>
	</html>';
	$message_2 = '<br />
		Thank you for your purchase of celebration cookies through the Student Union Memorial Center.  Please instruct your student to check their CatMail for pick up instructions.  If you have questions or concerns, please email Arizona Dining at <a href="mailto:su-arizonadining@arizona.edu">su-arizonadining@arizona.edu</a> or call 520-621-1945.<br /><br />
		Thank you!<br />
		Student Union Dining Team';
	$message_3 .= '
	</body>
	</html>';
	$message_customer = $message . $message_2 . $message_3;
	$message .= $message_3;
	mail($email, $subject, $message_customer, $headers);
	mail($email_manager, $subject, $message, $headers);
	header("Location: submit_success.php");	
	
	// display a confirmation messge.
	//echo "<form><input type='hidden' id='submit_success'></form><p class='submit_success' >Thank you. The form was submitted successfully.</p><br />"; 
	} 	
?>