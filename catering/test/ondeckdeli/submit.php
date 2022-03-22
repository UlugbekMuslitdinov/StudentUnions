<?php
include_once('./calculations.php');


// header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
$data = json_decode( file_get_contents( 'php://input' ), true );

// fake latency
sleep(2);

echo json_encode($data);

include_once('./email.class.php');

$email = new sendEmail();
// Set email sender and receiver
$email->setSender('From Catering','su-web@email.arizona.edu');
$email->setReceiver('Customer', 'amitarunshankar@gmail.com');
$email->changeEmailSetting('msgContainHtml',true);


// Email to customer
$email->setEmailTitle('On Deck Deli : Catering Order');
$receipt = buildReceipt($data);
$email->setMessage($receipt);
$result = $email->finallySendEmail('From Catering','Customer');
?>