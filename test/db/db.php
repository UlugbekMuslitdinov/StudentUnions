<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

function selectDeposit() {
	global $deposit;
	$db = new db_mysqli('mealplans');
	$query = 'SELECT * FROM deposit WHERE bb_account_id = 776978 ORDER By deposit_time DESC LIMIT 10';
	$result = $db->query($query);
	$deposit = mysqli_fetch_assoc($result);
	return $deposit;
}

selectDeposit();
print("Deposit: ");
print("<br/>");
print($deposit['deposit_id']);
print("<br/>");
var_dump($deposit);
?>