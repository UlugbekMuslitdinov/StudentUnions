<?php
// require_once $_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc';
require_once ('includes/mysqli.inc');
$db = new db_mysqli('mealplans');
$query = 'delete from signup_pending where status="Exported"';
$db->query($query);
$query = 'select deposit_id, emplid, plan, num_payments, amount from signup_pending where status="Pending Export"';
$result = $db->query($query);
while($signup = mysqli_fetch_assoc($result)){
        $commuter = "F";
        $plus5 = "F";
        $plus6 = "F";
        $plus7= "F";
        $enrich= "F";
	$enrich_tax = "F";
        $staff = "F";
	$tax = "Non-Taxable";
        
        switch($signup['plan']){
          case "Commuter":
            $commuter = "T";
	    $account = "Commuter";
          break;
          case "Copper":
            $plus5 = "T";
            $enrich= "F";
	    $account="Copper";
          break;
          case "Silver":
            $plus6 = "T";
            $enrich= "F";
	    $account="Silver"; 
          break;
          case "Gold":
            $plus7 = "T";
            $enrich = "F";
	    $account= "Gold";
          break;
          case "Faculty/Staff":
            $staff = "T";
	    $enrich_tax = "T";
	    $account = "FS";
	    $tax = "Taxable";
          break;
        }
          
          
        $string =  
$signup['emplid']."|".$commuter."|".$plus5."|".$plus6."|".$plus7."|".$enrich."|".$enrich_tax."|".$staff."|".$signup['amount']."|".$signup['num_payments']."|".(
$signup['num_payments']==2?intval($signup['amount']):'0')."|".$tax."|".$signup['plan']."\n";
        $account_file = file_put_contents ('/mnt/Bbin/WebAccountImport.txt', $string, FILE_APPEND);
	$deposit_file = file_put_contents ('/mnt/Bbin/WebDeposit'.$account.'Import.txt', $string, FILE_APPEND);
        if($account_file && $deposit_file){
                $db->query('update signup_pending set status="Exported" where deposit_id='.$signup['deposit_id']);
                $db->query('update deposit set status="Exported" where deposit_id='.$signup['deposit_id']);
        }
        else{
                $db->email_error('Unable to write to export file "/mnt/Bbin/ActiveGroupImport.txt"', 1);
        }
}

## Check to make sure Bbin mount is present
// This will verify the mount status regardless of Pending Exports being present. Gives us a better chance to fix the problem BEFORE it's a problem.
$filename = '/mnt/Bbin/mount_check_DO_NOT_REMOVE.txt';

if (!file_exists($filename)) {
	$server = '<span style="color:red;"><strong>WebServer2</strong></span>';
	$db->email_error("The Blackboard share [/mnt/Bbin/] is NOT mounted on [$server]. The Meal Plans export file cannot be written. Immediate action required! ", 1);
}