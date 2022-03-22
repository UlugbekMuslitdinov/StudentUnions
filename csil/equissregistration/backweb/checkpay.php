<?php
// Card taker
require_once('cardtaker/cardtaker.inc');

//
// Start card processing
//
echo '<link rel="stylesheet" href="http://sutest.arizona.edu:8088/cardtaker/cardtaker.css" type="text/css" />
<script type="text/javascript" src="http://sutest.arizona.edu:8088/cardtaker/cardtaker.js"></script>';
				
$intial_values = array(
	'firstName' => $_SESSION['firstName'],
	'lastName' => $_SESSION['lastName'],
	'address' => $_SESSION['address'],
	'city' => $_SESSION['city'],
	'state' => $_SESSION['state'],
	'postalCode' => $_SESSION['zip'],
	'phoneNumber' => $_SESSION['phoneNumber'],
	'orderAmount' => 199.00
);

$initial_values = array();
$order_form = new payment_process($initial_values);
if ($order_form->get_stage() != 'approved')
{
	$order_form->set_total(199.00);
	$order_form->require_contact(TRUE);
	$order_form->show_contact(TRUE);
	$order_form->display_form();
}
else
{
	$_SESSION['display'] = 5;
}


?>