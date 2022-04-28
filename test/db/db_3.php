<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

function selectDeposit() {
	global $deposit_id, $deposit_time;
	$db = new db_mysqli('mealplans');
	$query = 'SELECT * FROM deposit WHERE bb_account_id = 776978 ORDER By deposit_time DESC LIMIT 3';
	$result = $db->query($query);
	while ($deposit = mysqli_fetch_assoc($result)) {
		$deposit_id[] = $deposit['deposit_id'];
		$deposit_time[] = $deposit['deposit_time'];
	}
	return $deposit_id;
	return $deposit_time;
}

selectDeposit();
print("Deposit ID: ");
print("<br/>");
var_dump($deposit_id);
print("<br/>");
print("Deposit Time: ");
foreach($deposit_id as $deposit_id) {
	print($deposit_id . "-");
}
print("<br/>");	
var_dump($deposit_time);
print("<br/>");	
foreach(array_combine ($deposit_id, $deposit_time) as $id => $time) {
	echo $id . " - " . $time . "<br />";
}
?>
