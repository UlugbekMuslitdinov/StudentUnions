<?php
// Connection 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

// Query
$user_query = "SELECT * from employment WHERE timestamp LIKE '2022%' ORDER BY id DESC;";
$user_query = $db->query($user_query);
$filename = "EmploymentPopupResponses_2022"; // File Name

//header info for browser 
header("Content-Type: text/csv");  
header("Content-Disposition: attachment; filename=$filename.csv");  
header("Pragma: no-cache"); 
header("Expires: 0");

// Write data to file
$flag = false;
while ($row = mysqli_fetch_assoc($user_query)) {
    if (!$flag) {
        // display field/column names as first row
        echo implode(",\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode(",\t", array_values($row)) . "\r\n";
}
?>
