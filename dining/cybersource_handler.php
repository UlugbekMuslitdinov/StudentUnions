<?php

// ini_set('display_errors', 1);
  session_start();

  require_once('includes/mysqli.inc');
  require_once('phplib/mimemail/htmlMimeMail5.php');

//   echo '<pre>';
// // var_dump($_REQUEST);
// var_dump($_SESSION);

  $_SESSION['mealpackage']['cybersource']['processed'] = false;
  $_SESSION['mealpackage']['cybersource']['req_bill_to_phone'] = ( isset($_REQUEST['req_bill_to_phone']) ? $_REQUEST['req_bill_to_phone'] : '' );
  $_SESSION['mealpackage']['cybersource']['req_bill_to_email'] = $_REQUEST['req_bill_to_email'];
  $_SESSION['mealpackage']['cybersource']['req_card_type'] = $_REQUEST['req_card_type'];
  $_SESSION['mealpackage']['cybersource']['req_bill_to_forename'] = $_REQUEST['req_bill_to_forename'];
  $_SESSION['mealpackage']['cybersource']['req_bill_to_surname'] = $_REQUEST['req_bill_to_surname'];
  $_SESSION['mealpackage']['cybersource']['req_card_number'] = $_REQUEST['req_card_number'];
  $decision = $_REQUEST['decision'];
  $host = $_REQUEST['req_merchant_defined_data1'];
  $origin = $_REQUEST['req_merchant_defined_data2'];
  $mobile = ( isset($_REQUEST['req_merchant_defined_data3']) ? $_REQUEST['req_merchant_defined_data3'] : '' );
  $orderid = $_REQUEST['req_merchant_defined_data4'];
  $email = $_REQUEST['req_merchant_defined_data5'];
  $_SESSION['mealpackage']['cybersource']['amount'] = $_REQUEST['auth_amount'];

//testing?
$env_test = false;

//was payment accepted
if($decision == 'ACCEPT')
{
    //decide what kind of cc transaction is taking place
    
    // $query_mobile_part = $mobile ? '", mobile=1' : '"';

    $db = new db_mysqli('su');
    $query = 'update mealpackage set'.
        '   status 			= "paid"'.
        'where id = '.$orderid;
    $result = $db->query($query);

    // 
    $query = 'select * from mealpackage where id="'.$orderid.'"';
	$result = $db->query($query);
    $order_info = mysqli_fetch_assoc($result);

    // var_dump($order_info);
    
    send_mail($order_info, $_SESSION['mealpackage']['cybersource']['req_bill_to_email']);
    $email_response = send_mail_to_manager($order_info, 'su-sueventplanning@email.arizona.edu');
    
    header("Location:http://" . $host . "/dining/mealpackage/confirmation.php");
    exit();
}
else
{
    //return to form so user may correct and resubmit
    //echo $decision . '<br />';
    //echo $_REQUEST['invalid_fields'];
    //echo $_REQUEST['message'];
    header("Location:http://" . $host . $origin);
}

function send_mail($data, $email)
{
    $mail = new htmlMimeMail5();
    $mail->setFrom('Arizona Student Unions<su-sueventplanning@email.arizona.edu>');
    $mail->setSubject('Meal Package Order Confirmation');
    $mail->setHTML('<style type="text/css">body, html{margin:0px; padding:0px;}</style>
    <table width="100%" height="auto" cellspacing="0" cellpadding="0" style="border: medium none ; margin: 0px; padding: 0px; width: 100%; height: 100%; ">
        <tbody>
            <tr>
                <td valign="top" align="center">
                <table width="700" cellspacing="0" cellpadding="0" style="height: 100%;">
                    <tbody>
                        <tr>
                            <td valign="top" style="height: 100%; width: 100%;">
                            <table height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="height: 100%;">
                                <tbody>
                                    <tr>
                                        <td>
                                        <!--<img width="646" height="196" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/DepositConfirmationTop.jpg" />-->
                                        <!--<img width="645" height="197" alt="Meal PLans" src="http://studentaffairs.arizona.edu/mailcall/user_images/MealPlans_Confirmation_Deposit_02(1).jpg" />-->
                                        </td>
                                    </tr>
                                    <tr style="height: 100%;">
                                        <td clign="center" valign="top" height="100%" style="height: 100%;">
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td>
                                                        <h1 style="font-size:18px; color:#fbb614;"><b>Your order has been received.</b></h1>
                                                        <p><b>Dear '.$data['firstname'].' '.$data['lastname'].',</b></p>
                                                        <!--<p>A deposit of $ has been made to your meal plan account via credit card charge().</p>-->

                                                        <!--<p>For questions or comments, call 520.621.7043 or 800.374.7379. You can also email us at mealplan@email.arizona.edu.</p>-->
                                                        <!--<img width="200" height="27" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/StudentUnions_200.jpg" />-->
                                                        <!--<img width="65" height="30" alt="" src="http://studentaffairs.arizona.edu/mailcall/user_images/union_logo.jpg" />-->
                                                    </td>
                                                    <td width="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td>
                                                        <table rules="all" style="border-color: #666; border: 1px;" cellpadding="3">
                                                            <tr style="background: #eee;"><td><strong>First Name:</strong> </td><td>' . $data['firstname'] . '</td></tr>
                                                            <tr><td><strong>Last Name:</strong> </td><td>' . $data['lastname'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Email:</strong> </td><td>' . $data['email'] . '</td></tr>
                                                            <tr><td><strong>Phone:</strong> </td><td>' . $data['phone'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Dorm:</strong> </td><td>' . $data['dorm'] . '</td></tr>
                                                            <tr><td><strong>Room Number:</strong> </td><td>' . $data['room_number'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Meal:</strong> </td><td>' . $data['meal'] . '</td></tr>
                                                            <tr><td><strong>Refrigerator:</strong> </td><td>' . $data['refrigerator'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Microwave:</strong> </td><td>' . $data['microwave'] . '</td></tr>
                                                            <tr><td><strong>Request:</strong> </td><td>' . $data['requests'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Payment Method:</strong> </td><td>' . $data['payment'] . '</td></tr>
                                                        </table>
                                                    </td>
                                                    <td width="20">&nbsp;</td>
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

    $result  = $mail->send(array($email));
}


function send_mail_to_manager($data, $email)
{

$mail = new htmlMimeMail5();
// $mail->setFrom('Arizona Student Unions<no-reply@email.arizona.edu>');
$mail->setFrom('Arizona Student Unions<su-sueventplanning@email.arizona.edu>');
$mail->setSubject('Meal Package Order Submission');
$mail->setHTML('<style type="text/css">body, html{margin:0px; padding:0px;}</style>
    <table width="100%" height="auto" cellspacing="0" cellpadding="0" style="border: medium none ; margin: 0px; padding: 0px; width: 100%; height: 100%; ">
        <tbody>
            <tr>
                <td valign="top" align="center">
                <table width="700" cellspacing="0" cellpadding="0" style="height: 100%;">
                    <tbody>
                        <tr>
                            <td valign="top" style="height: 100%; width: 100%;">
                            <table height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="height: 100%;">
                                <tbody>
                                    <tr style="height: 100%;">
                                        <td clign="center" valign="top" height="100%" style="height: 100%;">
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td>
                                                        <table rules="all" style="border-color: #666; border: 1px;" cellpadding="3">
                                                            <tr style="background: #eee;"><td><strong>Type</strong> </td><td>' . $data['type'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>First Name:</strong> </td><td>' . $data['firstname'] . '</td></tr>
                                                            <tr><td><strong>Last Name:</strong> </td><td>' . $data['lastname'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Email:</strong> </td><td>' . $data['email'] . '</td></tr>
                                                            <tr><td><strong>Phone:</strong> </td><td>' . $data['phone'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Dorm:</strong> </td><td>' . $data['dorm'] . '</td></tr>
                                                            <tr><td><strong>Room Number:</strong> </td><td>' . $data['room_number'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Meal:</strong> </td><td>' . $data['meal'] . '</td></tr>
                                                            <tr><td><strong>Refrigerator:</strong> </td><td>' . $data['refrigerator'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Microwave:</strong> </td><td>' . $data['microwave'] . '</td></tr>
                                                            <tr><td><strong>Request:</strong> </td><td>' . $data['requests'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Payment Method:</strong> </td><td>' . $data['payment'] . '</td></tr>
                                                        </table>
                                                    </td>
                                                    <td width="20">&nbsp;</td>
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

    $result  = $mail->send(array($email));

    return $result;
}