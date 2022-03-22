<?php
ini_set('display_errors', 0);
session_start();
require_once('template/mp.inc');
require_once ('includes/mysqli.inc');
require_once('includes/tia.php');

$db = new db_mysqli('mealplans');

//make sure a user is currently logged in and session hasn't expired
if(!isset($_SESSION['mp_cust']['id']) || !isset($_SESSION['webauth']['netID']) || $_SESSION['mp_cust']['state'] != 'no plan'){
	header("Location:index.php");
	exit();
}

if($_SESSION['payment_type']=="bursars"){

	if(isset($_SESSION['debug']) && $_SESSION['debug'] && isset($_SESSION['now'])){
    $now = $_SESSION['now'];
  }
  else{
    $now = time();
  }

  if($now < strtotime($_SESSION['yearly_config']['can_charge_bursars']) && $_SESSION['plus_plan']){
    $tia['tia_log_id'] = 0;
    $status = 'bursars hold';

    $query = 'insert into bursar_payment set emplid='.$_SESSION['mp_login']['id'].', subcode='.$_SESSION['plan_subcode'].', bursars_amount='.$_SESSION['deposit_amount'].', term=2'.date("y").'4';
    $db->query($query);
    $payment_id = $db->insert_id;

    $query = 'insert into bursar_payment set emplid='.$_SESSION['mp_login']['id'].', subcode=500000100040, bursars_amount='.$_SESSION['fees'].', term=2'.date("y").'4';
    $db->query($query);
    $payment2_id = $db->insert_id;
  }
  else{
  	require_once('includes/bursars.inc');


  	$response = charge_bursars($_SESSION['deposit_amount'], $_SESSION['mp_login']['id'], getSignupTerm($_SESSION['plus_plan']), $_SESSION['plan_subcode']);

  	if($response == 0){
  		print 'An error has occured. The bursars office may be down. Please try again later';
  		exit();
  	}

  	$payment_id = $response;
  	$payment2_id = 0;

  	if($_SESSION['fees']>0){

  		$response = charge_bursars($_SESSION['fees'], $_SESSION['mp_login']['id'], getSignupTerm($_SESSION['plus_plan']), 500000100040);

  		if($response == 0){
  			$response = charge_bursars($_SESSION['fees'], $_SESSION['mp_login']['id'], getSignupTerm($_SESSION['plus_plan']), 500000100040);
  			if($response == 0){
  				sleep(1);
  				email_error('Bursars error: Fee failed to charge. See session info below for more info.');
  			}
  		}
      $payment2_id = $repsonse;
  	}
  	$tia = tia_transaction(DEPOSIT, $_SESSION['deposit_amount'], $_SESSION['mp_cust']['iso'], $_SESSION['plan_tender_num']);
    $status = 'pending';
  }

  if($payment2_id == '')
    $payment2_id = 0;


	$query = 'insert into deposit set'.
			'   amount			= "'.	$_SESSION['deposit_amount'].
			'", fee				= "'.	$_SESSION['fees'].
			'", total			= "'.	$_SESSION['total_amount'].
			'", new_signup		= "'.	'1'.
			'", plan_id			= "'.	$_SESSION['plan'].
			'", bursar_id 		= "'.	$payment_id.
			'", bursar_fee_id    = "'. $payment2_id.
			'", bb_account_id	= "'.	$_SESSION['mp_cust']['cust_num'].
			'", guest_id		=  '.	$_SESSION['mp_login']['guest_id'].
			' , first_name		= "'.	$_SESSION['mp_cust']['firstname'].
			'", last_name		= "'.	$_SESSION['mp_cust']['lastname'].
			'", payment_type	= "'.	'Bursars'.
			'", email			= "'.	$_SESSION['webauth']['netID'].'@email.arizona.edu'.
			'", phone			= "'.	''.
			'", plan_name		= "'.	$_SESSION['plan_name'].
			'", num_payments	= "'.	$_SESSION['num_payments'].
			'", bb_plan_id 		= "'.	$_SESSION['bb_plan_id.'].
			'", status			= "'.	$status.
			'", tia_id			= "'.	$tia['tia_log_id'].
			'"';


$db->query($query);

}
else{
require_once('includes/mp_cardtaker.inc');

	$initial_values = array('orderAmount'=>$_SESSION['total_amount']);
	$payment = new payment_process($initial_values);

	unset($_SESSION['paymentID']);


	$tia = tia_transaction(DEPOSIT, $_SESSION['deposit_amount'], $_SESSION['mp_cust']['iso'], $_SESSION['plan_tender_num']);


  $query = 'insert into deposit set'.
  			'   amount			= "'.	$_SESSION['deposit_amount'].
  			'", fee				= "'.	$_SESSION['fees'].
  			'", total			= "'.	$_SESSION['total_amount'].
  			'", new_signup		= "'.	'1'.
  			'", plan_id			= "'.	$_SESSION['plan'].
				//'", charge_id 		= "'.	$payment->get_paymentID.
  			'", bb_account_id	= "'.	$_SESSION['mp_cust']['cust_num'].
  			'", guest_id		=  '.	$_SESSION['mp_login']['guest_id'].
  			' , first_name		= "'.	$_SESSION['mp_cust']['firstname'].
  			'", last_name		= "'.	$_SESSION['mp_cust']['lastname'].
				'", payment_type	= "'.	$_SESSION['req_card_type'].
  			//'", payment_type	= "'.	'Card'.//$payment->get_cardtype().
  			'", email			= "'.	$_SESSION['req_bill_to_email'].
  			'", phone			= "'.	$_SESSION['req_bill_to_phone'].
  			'", plan_name		= "'.	$_SESSION['plan_name'].
  			'", num_payments	= "'.	$_SESSION['num_payments'].
  			'", bb_plan_id 		= "'.	$_SESSION['bb_plan_id.'].
  			'", status			= "'.	'pending'.
  			'", tia_id			= "'. $tia['tia_log_id'].
  			'"';
	//echo $query;
  $db->query($query);


  switch($_SESSION['req_card_type']){
  	case "001":
  		$card = 'Visa';
  	break;

  	case "002":
  		$card = 'MasterCard';
  	break;

  	case "003":
  		$card = 'American Express';
  	break;
  }


  $status = 'pending';

}

$deposit_id = $db->insert_id;

if($status == 'pending'){
  $query = 'insert into signup_pending set deposit_id='.$deposit_id.', emplid='.$_SESSION['mp_login']['id'].', plan="'.$_SESSION['import_plan_name'].'", amount="'.$_SESSION['deposit_amount'].'", num_payments='.$_SESSION['num_payments'];
  $db->query($query);
}
else{
  $query = 'insert into signup_pending set status="bursars hold", deposit_id='.$deposit_id.', emplid='.$_SESSION['mp_login']['id'].', plan="'.$_SESSION['import_plan_name'].'", amount="'.$_SESSION['deposit_amount'].'", num_payments='.$_SESSION['num_payments'];
  $db->query($query);
}



require_once('phplib/mimemail/htmlMimeMail5.php');

	$mail = new htmlMimeMail5();

    $mail->setFrom('Arizona Student Unions<no-reply@email.arizona.edu>');

    $mail->setSubject('Meal Plan Sign Up Confirmation');

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
                                    <td><img width="645" height="197" alt="free revyvle mug" src="http://studentaffairs.arizona.edu/mailcall/user_images/MealPlans_Confirmation_Deposit_02(1).jpg" /></td>
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
                                                <p>The purchase below has been processed. We appreciate your business.</p>
                                                <h2>Account Information</h2>
                                                <p>Name: <b>'.$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname'].'</b><br />

                                                </b> Email: <b>'.$_SESSION['webauth']['netID'].'@email.arizona.edu</b><br />
                                                </p>
                                                <h2>Payment Information</h2><p>
                                                '.($_SESSION['payment_type']!='bursars'?'Name on card: <b>'. $_SESSION['req_bill_to_forename'] .' '. $_SESSION['req_bill_to_surname'] .'</b><br />
                                                Payment Method: <b>'. $card . ' - '. $_SESSION['req_card_number'] .'</b><br />':'Payment Method: <b>Bursars</b><br />').'
                                                Total: <b>$'.$_SESSION['total_amount'].'</b></p>
                                                <h2>Order Information</h2>
                                                <p>Student ID: <b>'.$_SESSION['mp_login']['id'].'</b><br />
                                                Meal Plan: <b>'.$_SESSION['plan_name'].'</b><br />
                                                Date: <b>'.date("m/d/y").'</b></p>
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

	$result  = $mail->send(array($_SESSION['webauth']['netID'].'@email.arizona.edu'));


session_destroy();
session_start();
mp_start('Thank You', 0, 0);
?>
<h1>Thank You</h1>
<p>
Thank you for signing up for a University of Arizona meal plan.<br />
A confirmation of your purchase will be sent to your email address.
</p>
<p>
You are still logged into webauth, to log out please click <a href="https://webauth.arizona.edu/webauth/logout?logout_href=https://su-wdevtest.union.arizona.edu/mealplans&logout_text=Click here to return to Meal Plans">here</a>.

</p>

<?php mp_finish();?>
