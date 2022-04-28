<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/mealplans/includes/mp_functions.inc');

$bb_id = "108898";		// This is the account checking for each student.
// $mp_id = "0000000000000909241164";		// This is the Swipe Sabino Guest Card account.
// $mp_id = "0000000000000909239542";		// This is the Honors Agave Guest Card account.
// $mp_id = "0000000000000000776978";		// This is for Yontaek's account.
// $mp_id = "0000000000005500776978";		// This is for Yontae's 50/50  account.
// $last_name = "Quade";					// This is not needed.

getPlanForCustID2($bb_id);
function getPlanForCustID2($bb_id){
	$db = new db_mysqli('mealplans');
	$BBlink = bb_connect();

  // $query = 'select SV_ACCOUNT_TYPE_ID as BB_ID from CUSTOMER_SV_ACCOUNT where CUST_ID =108898';
  // $query = 'select SV_ACCOUNT_TYPE_ID as BB_ID from CUSTOMER_SV_ACCOUNT where SV_ACCOUNT_TYPE_ID in ('.implode(', ', getPlanIDS()).') and CUST_ID ='.$bb_id;
  $query = 'select SV_ACCOUNT_TYPE_ID as BB_ID from CUSTOMER_SV_ACCOUNT where SV_ACCOUNT_TYPE_ID in (2, 104, 46, 47, 48, 43, 41) and CUST_ID =' . $bb_id;		// Yontaek's account
  // $query = 'select SV_ACCOUNT_TYPE_ID as BB_ID from CUSTOMER_SV_ACCOUNT where SV_ACCOUNT_TYPE_ID in (2, 104, 46, 47, 48, 43, 41) and CUST_ID = 314886';		// Su Tech Test account

	$result = bb_query($BBlink, $query);

	$active_grp = oci_fetch_assoc($result);


	if(oci_num_rows($result) == 0)
		return NULL;

  $active_grp['NAME'] = getPlanNameFromID($active_grp['BB_ID']);
print("BBID: ");
print_r($active_grp['BB_ID']);
print("<br />");
print("Plan Name: " . $active_grp['NAME'] );
}

// print("Plan2: " . $active_grp['NAME']);
?>
