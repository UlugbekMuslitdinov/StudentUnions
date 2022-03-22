<?php
// Connection 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

// Query
//$user_query = "SELECT * from employment WHERE timestamp LIKE '2021%' ORDER BY id DESC;";
//$user_query = $db->query($user_query);
$filename = "EmploymentPopupResponses_2021ByMonth"; // File Name

//header info for browser 
header("Content-Type: text/csv");  
header("Content-Disposition: attachment; filename=$filename.csv");  
header("Pragma: no-cache"); 
header("Expires: 0");
//response types in an array to be iterated over
$responseTypes = array('Direct Mail', 'Social Media', 'Tabling Event/Job Fair', 'Recruitment Site', 'YouTube Ad', 'Other');
//create empty array for associative array containing each month as key and the respective total as value pair.
$monthlyTotals = array();
//column headers
echo "Response Choice, JAN, FEB, MAR, APR, MAY, JUN, JUL, AUG, SEP, OCT, NOV, DEC \r\n";
//iterate through response types to create each row
for ($i=0; $i<6; $i++) {
	echo $responseTypes[$i] . ","; //print first cell
	for ($j=1; $j<13; $j++) {
		//convert month int j to string and then make every month string two characters ('01', '02'... '12')
		if ($j >=10) {
			$j = strval($j);
		} else { //if month is 1-9, need to prefix with 0 so 01,02, and so on match timestamp format
			$j = "0" . strval($j);
		}
		$user_query = $db->query("SELECT count(response) as total FROM employment WHERE response='" . $responseTypes[$i] . "' AND timestamp LIKE '2021-" . $j . "%';");
		$user_query = $user_query->fetch_assoc();
		// Write data to file
		echo strval($user_query['total']) . ",";
		//get month total for all response types
		$monthsTotal = $db->query("SELECT count(response) as total FROM employment WHERE timestamp LIKE '2021-" . $j . "%'"); //should look like ('01'=>'some int', '02'=>'some int'... '12'=>'some int')
		$monthsTotal = $monthsTotal->fetch_assoc();
		$monthlyTotals[$j] = $monthsTotal['total'];
	}
	//end row
	echo "\r\n";
}
//print totals row
echo "Totals";
foreach ($monthlyTotals as $val) {
	echo "," . strval($val);
}
//for ($i=0; $i<$monthlyTotals.length; $i++) {
//	if ($i<10) {
//		$i = "0" . strval($i);
//	}
//	echo "," . strval($monthlyTotals[$i]);
//}
?>
