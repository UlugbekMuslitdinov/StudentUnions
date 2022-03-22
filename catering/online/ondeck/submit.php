<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/catering/online_order/function/main.function.php';
include_once('./calculations.php');


header('Content-type: application/json');
// header("Access-Control-Allow-Origin: *");
$data = json_decode( file_get_contents( 'php://input' ), true );

// file_put_contents( 'test.txt' , var_export($data, TRUE) );

// fake latency
sleep(2);

// require $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
// require $_SERVER['DOCUMENT_ROOT']."/catering/online_order/function/DB.php";
include_once('./email.class.php');	

$db = New CateringDB('su');
$customer_info = $db->table('catering')->where('id', $_SESSION['catering_id'])->first();
$data['customer_name'] = $customer_info->customer_name;

$email = new sendEmail();

// // Set email sender and receiver
$email->setSender('From Catering','su-retailcatering@email.arizona.edu');
$email->setReceiver('Customer', $customer_info->customer_email);
$email->setReceiver('Catering Manager','su-web@email.arizona.edu');
// $email->setReceiver('Catering Manager','su-retailcatering@email.arizona.edu');
$email->changeEmailSetting('msgContainHtml',true);

// Email to web manager
//$email->setEmailTitle('On Deck Deli : Catering Order');
//$msg = '        <span>There is a new order for On Deck Deli online catering!<br/> Please check the order and follow up.</span>';
//$receipt = buildReceipt($customer_info, $data , $msg);
//$email->setMessage($receipt);
//$email->finallySendEmail('From Catering','Web Manager');

// Email to catering manager
$email->setEmailTitle('On Deck Deli : Catering Order');
$msg = '        <span>There is a new order for On Deck Deli online catering!<br/> Please check the order and follow up.</span>';
$receipt = buildReceipt($customer_info, $data , $msg);
$email->setMessage($receipt);
$email->finallySendEmail('From Catering','Catering Manager');

// // // Email to customer
$email->setEmailTitle('On Deck Deli : Catering Order');
$msg = '<span style="font-weight:bold; font-size: 18px;">Thank you for your order!</span><br/> Your order request was successfully received and is being reviewed. You will receive an email response when further action is taken, or if more information is required.';
$receipt = buildReceipt($customer_info, $data , $msg);
$email->setMessage($receipt);
$result = $email->finallySendEmail('From Catering','Customer');
// echo json_encode($result);

$return = array();
$return['orderID'] = $_SESSION['catering_id'];
$return['email'] = $customer_info->customer_email;
$return['success'] = true;

// Store Order Data in DB
$update = $db->table('catering')->where('id', $_SESSION['catering_id'])->update(['order' => file_get_contents( 'php://input' ), 'status' => 'Submitted']);

if ( $return['orderID'] == '' || $return['email'] == '' ) {
    $return['success'] = false;
}
echo json_encode($return);

// Update status in DB

// Destroy Session
unset_all_session();


?>