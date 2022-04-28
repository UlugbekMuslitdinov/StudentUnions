<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

function selectDeposit() {
	global $deposit_id;
	$db = new db_mysqli('mealplans');
	$query = 'SELECT * FROM deposit WHERE bb_account_id = 776978 ORDER By deposit_time DESC LIMIT 10';
	$result = $db->query($query);
	while ($deposit = mysqli_fetch_assoc($result)) {
		$deposit_id[] = $deposit['deposit_id'];
	}
	return $deposit_id;
}

selectDeposit();
print("Deposit: ");
print("<br/>");
var_dump($deposit_id);
	
?>