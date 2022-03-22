<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );
ini_set('sendmail_from', 'su-web@email.arizona.edu');

if ( function_exists( 'mail' ) )
{
    echo 'mail() is available';
}
else
{
    echo 'mail() has been disabled';
}

$to = 'su-web@email.arizona.edu';
$subject = 'test email';
$message = 'no text';

$headers = array(
    "MIME-Version:1.0",
    "Content-type:text/html; charset=iso-8859-1",
    "From: Dale <eotkank87@email.arizona.edu>",
    "Reply-To:su-web@email.arizona.edu",
    "X-Mailer:PHP/" . PHP_VERSION
);
$headers = implode("\r\n", $headers);

// $return = mail('eotkank87@email.arizona.edu','subject','message',$headers);
// var_dump($return);

// $header = "From: noreply@example.com\r\n"; 
// $header.= "MIME-Version: 1.0\r\n"; 
// $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
// $header.= "X-Priority: 1\r\n"; 

$status = mail($to, $subject, $message, $headers);

if($status)
{ 
    echo '<p>Your mail has been sent!</p>';
} else { 
    echo '<p>Something went wrong, Please try again!</p>'; 
    print_r(error_get_last());
}


// error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

// set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
// require_once "Mail.php";

// $host = "ssl://smtp.dreamhost.com";
// $username = "youremail@example.com";
// $password = "your email password";
// $port = "465";
// $to = "address_form_will_send_TO@example.com";
// $email_from = "youremail@example.com";
// $email_subject = "Subject Line Here: " ;
// $email_body = "whatever you like" ;
// $email_address = "reply-to@example.com";

// $headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
// $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
// $mail = $smtp->send($to, $headers, $email_body);


// if (PEAR::isError($mail)) {
// echo("<p>" . $mail->getMessage() . "</p>");
// } else {
// echo("<p>Message successfully sent!</p>");
// }