<?php
include_once('./email.class.php');	
$email = new sendEmail();

// // Set email sender and receiver
$email->setSender('From Catering','su-web@email.arizona.edu');
$email->setReceiver('Customer', 'su-web@email.arizona.edu');
$email->changeEmailSetting('msgContainHtml',true);


// // // Email to customer
$email->setEmailTitle('On Deck Deli : Catering Order');
// $receipt = buildReceipt($customer_info, $data);
$email->setMessage('$receipt');
$result = $email->finallySendEmail('From Catering','Customer');
var_dump($result);