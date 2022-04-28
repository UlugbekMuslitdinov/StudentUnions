<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
// require_once('mysqli.php');
function selectHours2() {
	global $location;
	$db = new db_mysqli('hours2');
	$query = 'select * from location where location_id = 5 order by location_name';
	$result = $db->query($query);
	$location = mysqli_fetch_assoc($result);
	return $location;
}

selectHours2();
//print($location['location_name']);
print("hi5");
print("<br/>");
print_r($location);
print("<br/>");
print("hi6");
print("<br/>");
print($location['location_url']);
print("<br/>");
print("hi6");
print("<br/>");
var_dump($location);
?>