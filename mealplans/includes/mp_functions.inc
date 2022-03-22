<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/mealplans/includes/bb.inc');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('mealplans');

function convertIdToMPId($id){
	$mp_id = str_pad($id, 22, '0', STR_PAD_LEFT);
	return $mp_id;
}

function convertIdTo5050MPId($id){
	$mp_id = str_pad('55'.$id, 22, '0', STR_PAD_LEFT);
	return $mp_id;
}

function getMPCustFromId($mp_id, $last_name = NULL){
	return getBBcustFromId($mp_id, $last_name);
}

function  getRecentMPTransactions($mp_id){
	return getBBTransactions($mp_id, 1,5);
}

function getMPTransactionCount($mp_id){
	return getBBTransactionCount($mp_id);
}

function getMPTransactions($mp_id, $rowstart, $rowend){
	return getBBTransactions($mp_id, $rowstart, $rowend);
}

function isMPAccountSignupPending($mp_id){
	global $db;
	$query = 'select * from signup_pending where emplid='.$mp_id;
	$result = $db->query($query);
	if(mysqli_num_rows($result) > 0)
		return true;
	else
		return false;
}

function removeMPSignupPending($mp_id){
	global $db;
	$query = 'delete from signup_pending where emplid='.$mp_id;
	$result = $db->query($query);
}

function getActiveBBPlanIds(){
	global $db;
  $query = 'select bb_plan_id from plan where active=1';
  $result = $db->query($query);
  while($bb_plan_id = mysqli_fetch_assoc($result)){
    $active_plan_ids[] = $bb_plan_id['bb_plan_id'];
  }
  return $active_plan_ids;
}
function exportPendingSignups(){
global $db;
$query = 'select deposit_id, emplid, plan, num_payments, amount from signup_pending where status="Pending Export"';
$result = $db->query($query);
while($signup = mysqli_fetch_assoc($result)){
        $commuter = "F";
        $plus5 = "F";
        $plus6 = "F";
        $plus7= "F";
        $enrich= "F";
        $staff = "F";

        switch($signup['plan']){
          case "Commuter":
            $commuter = "T";
          break;
          case "Copper":
            $plus5 = "T";
            $enrich = "T";
          break;
          case "Silver":
            $plus6 = "T";
            $enrich = "T";
          break;
          case "Gold":
            $plus7 = "T";
            $enrich = "T";
          break;
          case "Faculty/Staff":
            $staff = "T";
          break;
        }


        $string =  $signup['emplid']."|".$commuter."|".$plus5."|".$plus6."|".$plus7."|".$enrich."|".$staff."|".$signup['amount']."|".$signup['num_payments']."|".($signup['num_payments']==2?$signup['amount']:'0')."|".$signup['plan']."\n";

        if(file_put_contents ('/mnt/Bbin/ActiveGroupImport.txt', $string, FILE_APPEND)){
                $db->query('update signup_pending set status="Exported" where deposit_id='.$signup['deposit_id']);
                $db->query('update deposit set status="Exported" where deposit_id='.$signup['deposit_id']);
        }
        else{
                email_error('Unable to write to export file "/mnt/Bbin/ActiveGroupImport.txt"', 1);
        }
}

}
