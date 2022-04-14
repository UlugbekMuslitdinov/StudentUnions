<?php
// require_once($_SERVER['DOCUMENT_ROOT'] .'/commontools/phplib/mimemail/htmlMimeMail5.php');
// if the submit button was clicked.
if (isset($_POST['submit'])) {
	// Send the confirmation email.
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$email = $_POST["email"];
	// $email_manager = "sueventplanning@email.arizona.edu";
	$email_manager = "su-web@email.arizona.edu";
	$phone = $_POST["phone"];
	if (isset($_POST["statement"])) {
	$statement = $_POST["statement"];	
	} else {
	$statement = "";
	}
	$s_name = $_POST["s_name"];
	$s_email = $_POST["s_email"];
	$s_phone = $_POST["s_phone"];
	$pickupdate = date($_POST["pickupdate"]);
	$total = $_POST["total_price_2"];
	$tax = $_POST["total_tax"];
	$total2 = $_POST["total_price_3"];
	$cookie_1 = $_POST["cookie_1"];
	$cookie_2 = $_POST["cookie_2"];
	$cookie_3 = $_POST["cookie_3"];
	$cookie_4 = $_POST["cookie_4"];
	$cookie_5 = $_POST["cookie_5"];
	$cookie_6 = $_POST["cookie_6"];
	$cookie_7 = $_POST["cookie_7"];
	$cookie_8 = $_POST["cookie_8"];
	$cookie_9 = $_POST["cookie_9"];
	$cookie_10 = $_POST["cookie_10"];
	$cookie_11 = $_POST["cookie_11"];
	$cookie_12 = $_POST["cookie_12"];
	$cookie_13 = $_POST["cookie_13"];
	$cookie_14 = $_POST["cookie_14"];

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
		<b>LAST NAME: </b> '.$last_name.'<br/
		<b>EMAIL: </b> '.$email.'<br/>
		<b>PHONE: </b> '.$phone.'<br/>
		<b>STATEMENT:</b><br/><pre><div style="font-family: verdana; font-size: 14px;"> '.$statement.'</div></pre><br/>
		<b>Student Information</b><br/>
		<b>STUDENT NAME: </b> '.$s_name.'<br/>
		<b>STUDENT EMAIL: </b> '.$s_email.'<br/
		<b>STUDENT PHONE: </b> '.$s_phone.'<br/><br/>
		<b>PICKUP DATE: </b> '.$pickupdate.'<br/>
		<b>TOTAL: </b> $'.$total2.' ($' . $total . ' + $' . $tax . ' tax)<br/><br/>
		<b>Quantity for Each Item</b><br/>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
		<td width="400" align="center">Item</td>
		<td width="80" align="center">Quantity</td>
		</tr>
		<tr>
		<td>Spring Potted Cookie Bouquet - $19.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_1.'</span></td>
		</tr>
		<tr>
		<td>Spring Cookie 4-Pack - $9.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_2.'</span></td>
		</tr>
		<tr>
		<td>Spring Cookie 5-Pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_3.'</span></td>
		</tr>
		<tr>
		<td>Graduation Potted Cookie Bouquet - $19.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_4.'</span></td>
		</tr>
		<tr>
		<td>Graduation Cookie 4-Pack - $9.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_5.'</span></td>
		</tr>
		<tr>
		<td>Graduation Cookie 5-Pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_6.'</span></td>
		</tr>
		<tr>
		<td>Graduation Sports Cookie 5-Pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_7.'</span></td>
		</tr>
		<tr>
		<td>Donate Spring Potted Cookie Bouquet - $19.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_8.'</span></td>
		</tr>
		<tr>
		<td>Donate Spring Cookie 4-Pack - $9.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_9.'</span></td>
		</tr>
		<tr>
		<td>Donate Spring Cookie 5-Pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_10.'</span></td>
		</tr>
		<tr>
		<td>Donate Graduation Potted Cookie Bouquet - $19.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_11.'</span></td>
		</tr>
		<tr>
		<td>Donate Graduation Cookie 4-Pack - $9.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_12.'</span></td>
		</tr>
		<tr>
		<td>Donate Graduation Cookie 5-Pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_13.'</span></td>
		</tr>
		<tr>
		<td>Donate Sports Cookie 5-Pack - $11.99</td>
		<td align="center"><span style="font-size:20px;font-weight:bold;">'.$cookie_14.'</span></td>
		</tr>
		</table>
	</body>
	</html>';
	$message_customer = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: verdana;font-size: 14px; line-height: 150%">
		Thank you for your purchase of celebration cookies through the Student Union Memorial Center.  Please instruct your student to check their CatMail for pick up instructions.  If you have any further questions please call us at 520-621-1414 or email us at <br /><a href="mailto:su-sueventplanning@email.arizona.edu">su-sueventplanning@email.arizona.edu</a>.<br /><br />

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