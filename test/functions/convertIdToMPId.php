<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/mealplans/includes/mp_functions.inc');

$id = "23670427";
convertIdToMPId2($id);
function convertIdToMPId2($id){
	$mp_id = str_pad($id, 22, '0', STR_PAD_LEFT);
	print($mp_id);
	return $mp_id;
}

?>