<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/mealplans/includes/mp_functions.inc');

// Show Swipe plan for the id.
getSPFromId2();
function getSPFromId2(){
	$BBlink = bb_connect();
	$cust_num = 99506251 ;
	
	$query = "SELECT c.custnum, c.firstname, c.lastname, cbv.boardplanid, b.boardplan, cbv.weekallowed, cbv.weekused, cbv.weekbalance, cbv.monthallowed, cbv.monthused, cbv.monthbalance, cbv.semqtrallowed, cbv.semqtrused, cbv.semqtrbalance, cbv.yearallowed, cbv.yearused, cbv.yearbalance
	from customerboardplanusagestatus cbv, customer c, boardplan b
	where cbv.customerid=c.cust_id 
	and cbv.boardplanid=b.boardplan_id
	and cbv.boardplanid in (17,18,19,20,22,23,24,25,26,27,28) 
	and c.custnum=$cust_num
	order by cbv.boardplanid";

	$result = bb_query($BBlink, $query);
	$bbcust = oci_fetch_assoc($result);
	print("OCI Row: " . oci_num_rows($result) . "<br />");

	if(oci_num_rows($result) == 0)
		return NULL;

	$return = [
		'firstname' => $bbcust['FIRSTNAME'],
		'lastname' => $bbcust['LASTNAME'],
		'plan_name' => $bbcust['BOARDPLAN'],
		'plan_id' => $bbcust['BOARDPLANID']
	];

	print_r($return);	
	return $return;
}
?>