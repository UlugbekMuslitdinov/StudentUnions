<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// require_once '/srv/www/htdocs/union/mealplans/includes/db.inc';
// db_connect();
// db_select('mealplans');

// $query = 'select cust_id, account_active from lost_card where status="Pending Export"';
// $result = db_query($query);
// while($row = mysql_fetch_assoc($result)){
// 	$string =  $row['cust_id']."|".$row['account_active']."\n";
// 	if(file_put_contents ('/mnt/Bbin/accountsOnOff.txt', $string, FILE_APPEND)){	
// 		db_query('update lost_card set status="Exported" where cust_id='.$row['cust_id']);
// 	}
// 	else{
// 		email_error('Unable to write to export file "/mnt/Bbin/accountsOnOff.txt"', 1);
// 	}	
// }
// echo 'John Testing';

include_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/includes/mysqli.inc");

$db = new db_mysqli('mealplans');

$query = 'select cust_id, account_active from lost_card where status="Pending Export"';
$result = $db->query($query);
while($row = mysqli_fetch_assoc($result)){
	$string =  $row['cust_id']."|".$row['account_active']."\n";
	if(file_put_contents ('/mnt/Bbin/accountsOnOff.txt', $string, FILE_APPEND)){	
		$db->query('update lost_card set status="Exported" where cust_id='.$row['cust_id']);
	}
	else{
		email_error('Unable to write to export file "/mnt/Bbin/accountsOnOff.txt"', 1);
	}	
}

?>
