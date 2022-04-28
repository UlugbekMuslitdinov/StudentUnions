<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/mealplans/includes/mp_functions.inc');

$id = "23434723";
$id = "00776978";		// This is Yontaek account.
convertIdTo5050MPId2($id);
function convertIdTo5050MPId2($id){
	// global $mp_id;
	$mp_id = str_pad('55'.$id, 22, '0', STR_PAD_LEFT);
	print($mp_id);
	return $mp_id;
}

?>