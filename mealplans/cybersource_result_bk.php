<?php
  // ini_set('display_errors', 1);
  

  require_once('includes/mysqli.inc');
  require_once('includes/tia.php');
  require_once('phplib/mimemail/htmlMimeMail5.php');
  require_once( __DIR__ . '/includes/mp_functions.inc');
  session_start();

  $db = new db_mysqli('mealplans');

  $_SESSION['processed'] = false;
  $_SESSION['req_bill_to_phone'] = ( isset($_REQUEST['req_bill_to_phone']) ? $_REQUEST['req_bill_to_phone'] : '' );
  $_SESSION['req_bill_to_email'] = $_REQUEST['req_bill_to_email'];
  $_SESSION['req_card_type'] = $_REQUEST['req_card_type'];
  $_SESSION['req_bill_to_forename'] = $_REQUEST['req_bill_to_forename'];
  $_SESSION['req_bill_to_surname'] = $_REQUEST['req_bill_to_surname'];
  $_SESSION['req_card_number'] = $_REQUEST['req_card_number'];
  $decision = $_REQUEST['decision'];
  //print("decision: " . $decision . "<br/>");
  $host = $_REQUEST['req_merchant_defined_data1'];
  $origin = $_REQUEST['req_merchant_defined_data2'];
  // $mobile = ( isset($_REQUEST['req_merchant_defined_data3']) ? $_REQUEST['req_merchant_defined_data3'] : '' );
  $lname = $_REQUEST['req_merchant_defined_data4'];
  $amount = $_REQUEST['auth_amount'];
  $bb_account_id = $_REQUEST['req_merchant_defined_data7'];
  $_SESSION['$bb_account_id'] = $_REQUEST['req_merchant_defined_data7'];

//print("req_merchant_defined_data7: " . $_REQUEST['req_merchant_defined_data7'] . "<br/>");
//print("req_merchant_defined_data4: " . $_REQUEST['req_merchant_defined_data4'] . "<br/>");
//print("mp_login_mp_id: " . $_SESSION['mp_login']['mp_id'] . "<br/>");
//print("mp_cust_id_1: " . $_SESSION['mp_cust']['id'] . "<br/>");
//print("mp_cust_iso_1: " . $_SESSION['mp_cust']['iso'] . "<br/>");
//print("mp_cust_state_0: " . $_SESSION['mp_cust']['state'] . "<br/>");

if(empty($_SESSION['mp_cust']['iso'])) {
	print("lost sessions<br/>");
	$_SESSION['mp_cust'] = getMPCustFromId($bb_account_id, $lname);
	print("mp_cust_state: " . $_SESSION['mp_cust']['plan']['NUM_PAYMENTS'] . "<br/>");
	exit();
//  print("mp_cust_iso_2: " . $_SESSION['mp_cust']['iso'] . "<br/>");
//  print("bb_account_id: " . $bb_account_id . "<br/>");	 
//	define('db_sessions', '');
//	define('db_iso', '');
//  
//	$db2 = new db_mysqli('su');
//	$result2 = $db2->query('SELECT * from session_handler where custnum = ' . $bb_account_id . ' ORDER BY id DESC LIMIT 1');
//	$db_sessions = mysqli_fetch_assoc($result2);
//	$db_custnum = $db_sessions['custnum'];
//	$db_cust_id = $db_sessions['cust_id'];
//	$db_iso = $db_sessions['iso'];
//	$db_firstname = $db_sessions['firstname'];
//	$db_lastname = $db_sessions['lastname'];
//	$db_mp_state = $db_sessions['mp_state'];
//	$db_activestudent = $db_sessions['activestudent'];
//	$db_activeemployee = $db_sessions['activeemployee'];
//	$_SESSION['mp_cust']['custnum'] = $db_custnum;
//	$_SESSION['mp_cust']['id'] = $db_cust_id;
//	$_SESSION['mp_cust']['firstname'] = $db_firstname;
//	$_SESSION['mp_cust']['lastname'] = $db_lastname;
//	$_SESSION['mp_cust']['state'] = $db_mp_state;
//	$_SESSION['mp_cust']['iso'] = $db_iso;
//	$_SESSION['webauth']['activestudent'] = $db_activestudent;
//	$_SESSION['webauth']['activeemployee'] = $db_activeemployee;
//	print("mp_cust_id_2: " . $_SESSION['mp_cust']['id'] . "<br/>");
//    print("mp_cust_state: " . $_SESSION['mp_cust']['state'] . "<br/>");
//	print("activeemployee: " . $_SESSION['webauth']['activeemployee'] . "<br/>");

    $_SESSION['mp_login']['type'] = $_REQUEST['req_merchant_defined_data5'];
    $_SESSION['mp_login']['access'] = $_REQUEST['req_merchant_defined_data6'];
    $_SESSION['mp_login']['id'] = $_REQUEST['req_merchant_defined_data7'];
    $_SESSION['mp_login']['guest_id'] = $_REQUEST['req_merchant_defined_data8'];

    require_once('includes/mp_functions.inc');

    //convert id obtained from various login methods to the id used in bb
    $_SESSION['mp_login']['mp_id'] = convertIdToMPId($_SESSION['mp_login']['id']);
	  // print("mplogin_mpid_2: " . $_SESSION['mp_login']['mp_id']  . "<br/>");

    //try to get basic MP customer info based on id
    $_SESSION['mp_cust'] = getMPCustFromId($_SESSION['mp_login']['mp_id'], $lname);
	// print("mpcust_plan_BBID: " . $_SESSION['mp_cust']['plan']['BB_ID'] . "<br/>");

	$active_plan_ids = array(1, 2, 3, 10, 11, 12, 41, 43, 46, 47, 48);

    if(!$_SESSION['mp_cust'])
      $_SESSION['mp_cust']['state'] = 'no account';

    elseif(!in_array($_SESSION['mp_cust']['plan']['BB_ID'], $active_plan_ids)){
      if(isMPAccountSignupPending($_SESSION['mp_login']['id']))
        $_SESSION['mp_cust']['state'] = 'pending';
      else
        $_SESSION['mp_cust']['state'] = 'no plan';
    }

    elseif($_SESSION['mp_cust']['is_active'] == 'F')
      $_SESSION['mp_cust']['state'] = 'deactive';

    else{
      $_SESSION['mp_cust']['state'] = 'active';
      removeMPSignupPending($_SESSION['mp_login']['id']);
    }
	// print("mpcust_state_2: " . $_SESSION['mp_cust']['state'] . "<br/>");

    //check to see if active employee to narrow down looking up for 5050s
    if($_SESSION['webauth']['activeemployee']){
      //try to load 50/50 account
      $_SESSION['5050mp_cust'] = getMPCustFromId(convertIdTo5050MPId($_SESSION['mp_login']['id']));
      //var_dump($_SESSION['5050mp_cust']);
      if($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account')
        $_SESSION['mp_cust']['state'] == '50/50';
    }

    if($_SESSION['mp_login']['access'] == 'deposit')
      $_SESSION['mp_cust']['state'] = 'deposit';
  //print("tendernum_1: " . $_SESSION['mp_cust']['plan']['TENDER_NUM'] . "<br/>");
  } else {
	//print("mp_cust_iso value was not lost during the payment process.<br/>");
	//print("tendernum_2: " . $_SESSION['mp_cust']['plan']['TENDER_NUM'] . "<br/>");
}

  //testing?
  $env_test = false;

  //was payment accepted
  if($decision == 'ACCEPT')
  {
    //decide what kind of cc transaction is taking place (deposit, 50/50 deposit, signup, mobile deposit, mobile signup)

    // $query_mobile_part = $mobile ? '", mobile=1' : '"';

    //site signup
    switch ($origin)
    {
      case '/mealplans/confirm.php':
        header("Location:signupcomplete.php");
        break;

      //site deposit
      case '/mealplans/deposit.php':
      // case '/mealplans/deposit0.php':

//print("amount: " . $amount . "<br/>"); 
//print("mp_cust_iso: " . $_SESSION['mp_cust']['iso'] . "<br/>");			
//print("tender_num_3: " . $_SESSION['mp_cust']['plan']['TENDER_NUM'] . "<br/>");			
        if (!$env_test)
        {
          $tia = tia_transaction(DEPOSIT, $amount, $_SESSION['mp_cust']['iso'], $_SESSION['mp_cust']['plan']['TENDER_NUM']);
        }
        else
        {
          $tia['tia_log_id'] = '0';
		  //print("did not deposit, WHY?<br/>");
        }

        $query = 'insert into deposit set'.
          '   amount 			= "'.	$amount.
          '", fee				= "'.	'0'.
          '", total			= "'.	$amount.
          '", new_signup		= "'.	'0'.
          //'", charge_id		= "'.	$_SESSION['paymentID'].
          '", bb_account_id	= "'. 	$_SESSION['mp_cust']['cust_num'].
          '", guest_id		=  '.	($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"')).
          ', first_name		= "'.	$_SESSION['mp_cust']['firstname'].
          '", last_name		= "'.	$_SESSION['mp_cust']['lastname'].
          '", payment_type	= "'.	$_REQUEST['req_card_type'].
          '", plan_id			= "'.	$_SESSION['mp_cust']['plan']['ID'].
          '", bb_plan_id		= "'.	$_SESSION['mp_cust']['plan']['BB_ID'].
          '", num_payments	= "'.	$_SESSION['mp_cust']['plan']['NUM_PAYMENTS'].
          '", plan_name		= "'.	$_SESSION['mp_cust']['plan']['NAME'].
          '", email			= "'.	substr($_REQUEST['req_bill_to_email'], 0, 100).
          '", phone			= "'.	substr($_SESSION['req_bill_to_phone'], 0, 15).
          '", status			= "'.	'Complete'.
          '", tia_id			= "'.	$tia['tia_log_id'].
          $query_mobile_part;

        $db->query($query);

        send_mail();

        header("Location:http://" . $host . "/mealplans/viewtransactions.php?deposit");
        break;

      //50/50 deposit
      case '/mealplans/deposit5050.php':
        if (!$env_test)
        {
          $tia = tia_transaction(DEPOSIT, $amount, $_SESSION['5050mp_cust']['iso'], $_SESSION['5050mp_cust']['plan']['TENDER_NUM']);
        }
        else
        {
          $tia['tia_log_id'] = '0';
        }

        $query = 'insert into deposit set'.
          '   amount      = "'. $amount.
          '", fee       = "'. '0'.
          '", total     = "'. $amount.
          '", new_signup    = "'. '0'.
          //'", charge_id   = "'. $_SESSION['paymentID'].
          '", bb_account_id = "'.   ($_SESSION['5050mp_cust']['cust_num']/1).
          '", guest_id    =  '. ($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"')).
          ', first_name   = "'. $_SESSION['5050mp_cust']['firstname'].
          '", last_name   = "'. $_SESSION['5050mp_cust']['lastname'].
          '", payment_type  = "'. $_REQUEST['req_card_type'].
          '", plan_id     = "'. $_SESSION['5050mp_cust']['plan']['ID'].
          '", bb_plan_id    = "'. $_SESSION['5050mp_cust']['plan']['BB_ID'].
          '", num_payments  = "'. $_SESSION['5050mp_cust']['plan']['NUM_PAYMENTS'].
          '", plan_name   = "'. $_SESSION['5050mp_cust']['plan']['NAME'].
          '", email     = "'. substr($_REQUEST['req_bill_to_email'], 0, 100).
          '", phone     = "'. substr($_SESSION['req_bill_to_phone'], 0, 15).
          '", status      = "'. 'Complete'.
          '", tia_id      = "'. $tia['tia_log_id'].
          $query_mobile_part;

        $db->query($query);

        send_mail();

        header("Location:http://" . $host . "/mealplans/viewtransactions.php?deposit");
        break;

      default:
        break;
    }
  }
  else
  {
    //return to form so user may correct and resubmit
    //echo $decision . '<br />';
    //echo $_REQUEST['invalid_fields'];
    //echo $_REQUEST['message'];
    header("Location:http://" . $host . $origin);
  }

  function send_mail()
  {
    global $amount;

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
                                        <td>
										<img width="646" height="196" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/DepositConfirmationTop.jpg" />
										<!--<img width="645" height="197" alt="Meal PLans" src="http://studentaffairs.arizona.edu/mailcall/user_images/MealPlans_Confirmation_Deposit_02(1).jpg" />-->
										</td>
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
                                                    <p>A deposit of $'.$amount.' has been made to your meal plan account via credit card charge('.$_SESSION['req_card_number'].').</p>

                                                    <p>For questions or comments, call 520.621.7043 or 800.374.7379. You can also email us at mealplan@email.arizona.edu.</p>
                                                    <p>
													<img width="200" height="27" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/StudentUnions_200.jpg" />
													<!--<img width="65" height="30" alt="" src="http://studentaffairs.arizona.edu/mailcall/user_images/union_logo.jpg" />-->
													</p>
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

    $result  = $mail->send(array($_SESSION['req_bill_to_email']));
  }
