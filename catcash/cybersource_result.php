<?php
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
// This is for CatCash
ini_set('display_errors', 1);
  session_start();
  require_once('includes/mysqli.inc');
  require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/BBCatCash.php');
  require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/tia.php');
  require_once('phplib/mimemail/htmlMimeMail5.php');
  $db = new db_mysqli('mealplans');

  $_SESSION['processed'] = false;
  $_SESSION['req_bill_to_phone'] = ( isset($_REQUEST['req_bill_to_phone']) ? $_REQUEST['req_bill_to_phone'] : '' );
  $_SESSION['req_bill_to_email'] = $_REQUEST['req_bill_to_email'];  
  $_SESSION['req_card_type'] = $_REQUEST['req_card_type'];
  $_SESSION['req_bill_to_forename'] = $_REQUEST['req_bill_to_forename'];
  $_SESSION['req_bill_to_surname'] = $_REQUEST['req_bill_to_surname'];
  $_SESSION['req_card_number'] = $_REQUEST['req_card_number'];
  $decision = $_REQUEST['decision'];
  print("decision: " . $decision) . "<br/>";
  $host = $_REQUEST['req_merchant_defined_data1'];
  $origin = $_REQUEST['req_merchant_defined_data2'];
  // $mobile = ( isset($_REQUEST['req_merchant_defined_data3']) ? $_REQUEST['req_merchant_defined_data3'] : '' );
  $lname = $_REQUEST['req_merchant_defined_data4'];
  $amount = $_REQUEST['auth_amount'];
  $bb_account_id = $_REQUEST['req_merchant_defined_data7'];
  $_SESSION['$bb_account_id'] = $_REQUEST['req_merchant_defined_data7'];
  // $_SESSION['payment_email'] = $_REQUEST['req_merchant_defined_data9'];
  // $_SESSION['payment_phone'] = $_REQUEST['req_merchant_defined_data10'];
  // print("PHONE: " . $_REQUEST['req_merchant_defined_data10'] . "<br/>"); 
  // print("EMAIL: " . $_REQUEST['req_merchant_defined_data9'] . "<br/>"); 

// Retrieve records from the db in case session variables are lost unexpectedly on Chrome.
 if (!isset($_SESSION['catcash']['iso'])) {
	 
  if (!isset($bb_account_id)) {
	  $bb_account_id = $_SESSION['catcash']['cust_num']; 
  } else {
	  $bb_account_id = $bb_account_id;
  }
	 
	define('db_sessions', '');
	define('db_iso', '');

	$db2 = new db_mysqli('su');
	$result2 = $db2->query('SELECT * from session_handler where custnum = ' . $bb_account_id . ' ORDER BY id DESC LIMIT 1');
	$db_sessions = mysqli_fetch_assoc($result2);
	$db_custnum = $db_sessions['custnum'];
	$db_cust_id = $db_sessions['cust_id'];
	$db_iso = $db_sessions['iso'];
	$db_firstname = $db_sessions['firstname'];
	$db_lastname = $db_sessions['lastname'];
	$_SESSION['catcash']['custnum'] = $db_custnum;
	$_SESSION['catcash']['id'] = $db_cust_id;
	// $_SESSION['catcash']['iso'] = $db_iso;
	$_SESSION['catcash']['firstname'] = $db_firstname;
	$_SESSION['catcash']['lastname'] = $db_lastname;
	$_SESSION['catcash']['iso'] = $db_iso;
	print("custnum: " . $_SESSION['catcash']['custnum']) . "<br/>";
}
  // $_SESSION['payment_phone'] = $_REQUEST['req_merchant_defined_data10'];
  // print("PHONE: " . $_REQUEST['req_merchant_defined_data10'] . "<br/>"); 
  // print("EMAIL: " . $_REQUEST['req_merchant_defined_data9'] . "<br/>"); 

//$_SESSION['catcash']['iso'] = 6017090201720694;
// print("ddil: " . $_SESSION['ddil']) . "<br/>";
// $_SESSION['catcash'] = array($_SESSION['catcash']);
// print("SESSION_catcash_iso: " . $_SESSION['catcash']['iso']) . "<br/>"; 
if(empty($_SESSION['catcash']['iso']))
	print("SESSION_catcash_iso_1: " . $_SESSION['catcash']['iso']) . "<br/>";
{
    $_SESSION['mp_login']['type'] = $_REQUEST['req_merchant_defined_data5'];
    $_SESSION['mp_login']['access'] = $_REQUEST['req_merchant_defined_data6'];
    $_SESSION['mp_login']['id'] = $_REQUEST['req_merchant_defined_data7'];
    $_SESSION['mp_login']['guest_id'] = $_REQUEST['req_merchant_defined_data8'];
	$_SESSION['catcash']['cust_num'] = $_REQUEST['req_merchant_defined_data7'];

    require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/includes/mp_functions.inc');

    //convert id obtained from various login methods to the id used in bb
    $_SESSION['mp_login']['mp_id'] = convertIdToMPId($_SESSION['mp_login']['id']);

    $BBCatCash = New BBCatCash;
    $lastname = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $cust = $BBCatCash->get_customer_info($_SESSION['mp_login']['mp_id'], $lastname);


    if (!isset($_SESSION['catcash']))
        $_SESSION['catcash'] = 'no account';

    if($_SESSION['mp_login']['access'] == 'deposit')
        $_SESSION['catcash']['state'] = 'deposit';
}

//testing?
$env_test = false;

//was payment accepted
if($decision == 'ACCEPT') {
	print("iso_2: " . $_SESSION['catcash']['iso']) . "<br/>";
	print("iso_3: " . $db_iso) . "<br/>";
    //decide what kind of cc transaction is taking place    
     $query_mobile_part = $mobile ? '", mobile=1' : '"';

    //site signup
    switch ($origin)
    {
      //site deposit
      case '/catcash/deposit.php':
    
        if (!$env_test)
        {
          $tia = tia_transaction(DEPOSIT, $amount, $_SESSION['catcash']['iso'], 2);
        }
        else
        {
          $tia['tia_log_id'] = '0';
        }

// Store in MySQL.
// $bb_account_id = $_SESSION['catcash']['cust_num'];
$bb_account_id = (int)$_REQUEST['req_merchant_defined_data7'];
$guest_id = ($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"'));
$first_name = $_REQUEST['req_merchant_defined_data3'];
$last_name = $_REQUEST['req_merchant_defined_data4'];
//$first_name = $_SESSION['catcash']['firstname'];
//$last_name = $_SESSION['catcash']['lastname'];
$payment_type = $_REQUEST['req_card_type'];
// $plan_id = (int)$_SESSION['catcash']['plan']['ID'];
// $bb_plan_id = ($_SESSION['catcash']['plan']['BB_ID']/1);
// $num_payments = ($_SESSION['catcash']['plan']['NUM_PAYMENTS']/1);
// $plan_name = $_SESSION['catcash']['plan']['NAME'];
$email = substr($_REQUEST['req_bill_to_email'], 0, 100);
$phone = substr($_SESSION['req_bill_to_phone'], 0, 15);
// $phone = "1: ".$_SESSION['mp_login']['mp_id']."2: ".$_SESSION['catcash']['cust_num'];
$status = "Complete";
$tia_id = ($tia['tia_log_id']/1);

$query = "INSERT INTO deposit (amount, fee, total, new_signup, plan_id, bb_account_id, guest_id, first_name, last_name, payment_type, email, phone, plan_name, num_payments, bb_plan_id, status, tia_id) VALUES ('$amount', '0', '$amount', '0', 7, $bb_account_id, '$guest_id', '$first_name', '$last_name', '$payment_type', '$email', '$phone', 'CatCash', 1, 31, '$status', '$tia_id')";
					
        $query_mobile_part;
        $db->query($query);
        // echo "stored in deposit table";
        send_mail();
        // echo "sent mail";
        header("Location:http://" . $host . "/catcash/transactions.php?deposit");
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
    $mail->setSubject('CatCash Deposit Confirmation');
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
