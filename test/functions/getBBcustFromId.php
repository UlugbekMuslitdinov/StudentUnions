<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/mealplans/includes/mp_functions.inc');

$mp_id = "000000000000023576694 ";		// This is the account checking for each student.
// $mp_id = "0000000000000909241164";		// This is the Swipe Sabino Guest Card account.
// $mp_id = "0000000000000909239542";		// This is the Honors Agave Guest Card account.
// $mp_id = "0000000000000000776978";		// This is for Yontaek's account.
// $mp_id = "0000000000005500776978";		// This is for Yontae's 50/50  account.
// $last_name = "Quade";					// This is not needed.

getBBcustFromId($mp_id, $last_name);
print_r($mp_cust);
?>