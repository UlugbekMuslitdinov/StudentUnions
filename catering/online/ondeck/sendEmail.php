<?php
$email = new sendEmail();
// Set email sender and receiver
$email->setSender('From Catering','su-web@email.arizona.edu');
$email->setReceiver('Customer', $customer_info->customer_email);
$email->changeEmailSetting('msgContainHtml',true);


// Email to customer
$email->setEmailTitle('On Deck Deli : Catering Order');
$receipt = buildReceipt($data);
$email->setMessage($receipt);
$result = $email->finallySendEmail('From Catering','Customer');