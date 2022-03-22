<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// Store in DB
$db = new db_mysqli('mealplans');
$amount = 3550.00;
$bb_account_id = 23531631;
$guest_id = "DKDKEIEI";
$first_name = "Yontaek";
$last_name = "Testing";
$payment_type = "VISA";
$plan_id = 2;
$bb_plan_id = 1;
$num_payments = 1;
$plan_name = "Silver";
$email = "email@email.com";
$phone = "520-333-4444";
$status = "Complete";
$tia_id = 390352;

$query = "INSERT INTO deposit (amount, fee, total, new_signup, plan_id, bb_account_id, guest_id, first_name, last_name, payment_type, email, phone, plan_name, num_payments, bb_plan_id, status, tia_id) VALUES ('$amount', '0', '$amount', '0', '$plan_id', '$bb_account_id', '$guest_id', '$first_name', '$last_name', '$payment_type', '$email', '$phone', '$plan_name', '$num_payments', '$bb_plan_id', '$status', '$tia_id')";
	
$db->query($query);
print("hi");
?>
Debugging