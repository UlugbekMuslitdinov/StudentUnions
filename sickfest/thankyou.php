<?php
session_start();
$error=FALSE;
?>
<html>
<body style="color:#FFF;background-image:url('images/orderform_bg.png');background-repeat:repeat;font-family:Helvetica, Verdana, Geneva, sans-serif;font-size:16px;margin-top:30px; margin-left:20px;">
<?php
require_once('cardtaker/cardtaker.inc');
$initial_values = array(
);
$order_form = new payment_process($initial_values);
$paymentID			= $order_form->get_paymentID(); //returns paymentID
$processPurchase = $_SESSION['paymentID'];
unset($_SESSION['paymentID']);
$first_name			= $order_form->get_firstname();
$last_name			= $order_form->get_lastname();
$email = $order_form->get_email();
if ($email!=""&&$email!=NULL) {
	$_SESSION["email"]	= $email;
}

//var_dump($_SESSION);
if ($_SESSION['studentTickets']==NULL) {
	$_SESSION['studentTickets']="0";
}
if ($_SESSION['generalAdmissions']==NULL) {
	$_SESSION['generalAdmissions']="0";
}

require('commontools/mysql_link.inc');
if (!$DBlink) {
	$error=TRUE;
    die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 1)<br />" . mysql_error()) . "</p>";
}

$DBselected = mysql_select_db("sickfest", $DBlink);
if (!$DBselected) {
	$error=TRUE;
    die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)<br />" . mysql_error()) . "</p>";
}

if ($error) {
	echo "FATAL SUBMITION ERROR!</body></html>";
	die;
}
/**** die above prevents execution of below if there was an error ****/
if (isset($processPurchase)) {
	$query = 'INSERT INTO purchase SET'
				. ' paymentID = '				. $paymentID
				. ', first_name = "'			. $first_name
				. '", last_name = "'			. $last_name
				. '", netID = "'				. $_SESSION['netID']
				. '", email = "'				. $_SESSION["email"]
				. '", num_student = '			. $_SESSION['studentTickets']
				. ', num_general = '			. $_SESSION['generalAdmissions']
				. ', total = '					. $_SESSION['total']
			. ';';
	
	//echo "<br /><br />Query: ".$query;
	$result = mysql_query($query, $DBlink);
	if (!$result) {
		$error=TRUE;
		die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 4)<br />" . mysql_error()) . "</p>";
	}
	
	$confirmationNumber = mysql_insert_id();
	
	require_once('phplib/mimemail/htmlMimeMail5.php');
 	$mail = new htmlMimeMail5();
	$mail->setFrom('union.arizona.edu<no-reply@email.arizona.edu>');
    $mail->setSubject('SICKFEST Purchase Confirmation');
	$body='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SICKFest 18 - Featuring Craig Robinson</title>
</head>
<body bgcolor="#524741" topmargin="0" alink="#CC3300" vlink="#CC6600" link="#CC3300">
<center>
	<table width="600" bgcolor="#FFFFFF" align="center" cellpadding="0" cellspacing="0" >
<!--header-->
    	<tr><td colspan="2" valign="top" align="center"><img src="http://union.arizona.edu/sickfest/images/sick_receipt_head.jpg" width="600" height="330" alt="SICKFEST 18 - FEATURING CRAIG ROBINSON" border="0" /><br /><br />
             <font style="font-size:24px; font-family:Arial, Helvetica, sans-serif; color:#524741;"><strong>Thank you for purchasing tickets online for<br />Craig Robinson - Live at SICKFEST 18</strong></font><br />
            </td>
        </tr>
<!--end header-->

<!-- edit body copy here-->
        <tr>
          <td width="595" valign="top" align="" style="padding: 10px 10px 10px 10px; font-family:Arial, Helvetica, sans-serif;">
          
            <font style="font-size:18px; color:#333333;"><strong>Purchase Details:</strong></font>
            <font style="font-size:12px; color:#333333;">
            <ul>
            <li>Confirmation Number: 100'.$confirmationNumber.'</li>';
if ($_SESSION['studentTickets']>0) {
	$body.='<li>Qty: "'.$_SESSION['studentTickets'].'" Student Tickets</li>';
}
if ($_SESSION['generalAdmissions']>0) {
	$body.='<li>Qty: "'.$_SESSION['generalAdmissions'].'" General Admissions Tickets</li>';
}
$body.='			
			<li>Purchase Total: $'.$_SESSION['total'].'</li>
			
            </ul>

			Please pick up your tickets at the Gallagher Box Office between 9am and 5pm M-F.<br />
			You may also pick them up at Will Call at Social Sciences 100 starting at 6:30pm day of show.<br /><br />

			<img src="http://union.arizona.edu/sickfest/images/schedule.gif" width="570" height="147" border="0" /><br /><br />Visit <a href="http://union.arizona.edu/sickfest">union.arizona.edu/sickfest</a>, <a href="http://www.uacomedycorner.com">uacomedycorner.com</a>, or call (520) 626-9331 for more information.<br />&#42;S.I.C.K Festival will include adult content. Parental discretion is advised. <br />
    		</font>
          </td>
        </tr>
<!--end body copy-->
    </table>
</center>
</body>
</html>
	';
    $mail->setHTML($body);
    $result  = $mail->send(array($_SESSION["email"]));
}
echo '<img src="images/purchase_success_head.png" alt="Payment Successful" />';
echo "<br /><br /><br />";
echo "Thank you for purchasing event tickets online.";
echo "<br /><br /><br />";
echo "Please pick up your tickets at the gallagher Box Office between 9am and 5pm M-F. You may also pick them up at Will Call at Social Sciences 100 starting at 6:30pm day of show.";
echo "<br /><br /><br />";
echo "A reciept has been sent to ".$_SESSION["email"].".";
?>
</body></html>