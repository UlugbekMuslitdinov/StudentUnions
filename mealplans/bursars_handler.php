<?php
ini_set('display_errors', 0);
ini_set('default_socket_timeout', 30);
session_start();
require_once ('includes/mysqli.inc');
require_once('includes/tia.php');
require_once('includes/bursars.inc');

$db = new db_mysqli('mealplans');

	$response = charge_bursars($_POST['amount'], $_SESSION['mp_login']['id'], getCurrentTerm());

/*
$xml = simplexml_load_string($response);

$result = $xml->children('soapenv', TRUE)->children()->UA_SF020_RESPONSE->UA_SF020_RESULT;
//var_dump($result);


if(!$response || $result->SUCCESS == 0){
	
	print 'An error has occured. The bursars office may be down. Please try again later';
$values = '';
			foreach($_SESSION['bursars_charge'] as $key => $value){
				$values .= $key.' : '.$value.'<br />';
			}
	email_error("bursars error:\n".$response, 1);
}
else{
	
$tia = tia_transaction(DEPOSIT, $_POST['amount'], $_SESSION['mp_cust']['iso'], $_SESSION['mp_cust']['plan']['TENDER_NUM']);
//$tia['tia_log_id']=0;




$DBlink = db_connect();
db_select('mealplans');

$query = 'insert into bursar_payment set'.
				'   term			= "'.	getCurrentTerm().
				'", bursars_amount	= "'.	$_POST['amount'].
				'", response		= "'.	mysql_real_escape_string($response, $DBlink).
				'", item_nbr		= "'.	mysql_real_escape_string($result->ITEM_NBR, $DBlink).
				'", line_seq_no		= "'.	mysql_real_escape_string($result->LINE_SEQ_NBR, $DBlink).
				'"';
db_query($query);

$bursar_id  = mysql_insert_id($DBlink);
*/
var_dump($response);
if($response == 0){
	
	exit();
}

$tia = tia_transaction(DEPOSIT, $_POST['amount'], $_SESSION['mp_cust']['iso'], $_SESSION['mp_cust']['plan']['TENDER_NUM']);
//$tia['tia_log_id']=0;
	
$bursar_id = $response;

$query = 'insert into deposit set'.
				'   amount 			= "'.	$_POST['amount'].
				'", fee				= "'.	'0'.
				'", total			= "'.	$_POST['amount'].
				'", new_signup		= "'.	'0'.
				'", bursar_id		= "'.	$bursar_id.
				'", bb_account_id	= "'. 	$_SESSION['mp_cust']['cust_num'].
				'", first_name		= "'.	$_SESSION['mp_cust']['firstname'].
				'", last_name		= "'.	$_SESSION['mp_cust']['lastname'].
				'", payment_type	= "'.	'Bursars'.
				'", plan_id			= "'.	$_SESSION['mp_cust']['plan']['ID'].
				'", bb_plan_id		= "'.	$_SESSION['mp_cust']['plan']['BB_ID'].
				'", num_payments	= "'.	$_SESSION['mp_cust']['plan']['NUM_PAYMENTS'].
				'", plan_name		= "'.	$_SESSION['mp_cust']['plan']['NAME'].
				'", email			= "'.	substr($_POST['email'], 0, 100).
				'", phone			= "'.	substr($_POST['phone'], 0, 15).
				'", status			= "'.	'Complete'.
				'", tia_id			= "'.	$tia['tia_log_id'].
				'"';
$db->query($query);


require_once('phplib/mimemail/htmlMimeMail5.php');
	
	$mail = new htmlMimeMail5();

    $mail->setFrom('Arizona Student Unions<no-reply@email.arizona.edu>');
    
    $mail->setSubject('Meal Plan Deposit Confirmation');
    
    $mail->setHTML('<style type="text/css">body, html{margin:0px; padding:0px; background-image: url(\'http://studentaffairs.arizona.edu/mailcall/user_images/mp_bg(1).jpg\'); background-repeat:repeat-x;}</style>
<table width="100%" height="auto" cellspacing="0" cellpadding="0" style="border: medium none ; margin: 0px; padding: 0px; width: 100%; height: 100%; ">
    <tbody>
        <tr>
            <td valign="top" align="center">
            <table width="645" cellspacing="0" cellpadding="0" style="height: 100%;">
                <tbody>
                    <tr>
                        <td valign="top" style="height: 100%; width: 100%;">
                        <table height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="height: 100%;">
                            <tbody>
                                <tr>
                                    <td><img width="645" height="197" alt="Meal PLans" src="http://studentaffairs.arizona.edu/mailcall/user_images/MealPlans_Confirmation_Deposit_02(1).jpg" /></td>
                                </tr>
                                <tr style="height: 100%;">
                                    <td clign="center" valign="top" height="100%" style="height: 100%;">
                                    <table cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td width="30">&nbsp;</td>
                                                <td>
                                                <h1 style="font-size:18px; color:#fbb614;"><b>Your payment has been received.</b></h1>
                                                <p><b>Dear '.$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname'].',</b></p>
                                                <p>A deposit of $'.$_POST['amount'].' has been made to your meal plan account via Bursars charge.</p>
                                                
                                                <p>For questions or comments, call 520.621.7043 or 800.374.7379. You can also email us at mealplan@email.arizona.edu.</p>
                                                <p><img width="65" height="30" alt="" src="http://studentaffairs.arizona.edu/mailcall/user_images/union_logo.jpg" /></p>
                                                </td>
                                                <td width="30">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </tbody>
</table>');
    
	$result  = $mail->send(array($_SESSION['payment_email']));

print '<script>var temp = new Date(); window.parent.location = "viewtransactions.php?deposit="+temp.getTime();</script>';


