<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/mealplans/includes/mp_functions.inc');

$cust_id = 108898;
showMealPlansBalance($cust_id);
foreach(array_combine ($sva_id, $sva_balance) as $sva_id => $sva_balance) {
	echo $sva_id . " - $" . $sva_balance . "<br />";
}

?>