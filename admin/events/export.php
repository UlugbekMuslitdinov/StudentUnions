<?php
session_start();
// Connection 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

//include "index.php";
if ($_SESSION['formSelector']) {
    $formSelector = $_SESSION['formSelector'];
}
//Create a where condition for sql queries specific to selected form
if ($formSelector=="Thanksgiving") {
    $whereCondition = "WHERE form LIKE '%Thanksgiving%'";
} else if ($formSelector=="Valentine") {
    $whereCondition = "WHERE form LIKE '%Valentine%'";
} else if ($formSelector=="Holiday") {
    $whereCondition = "WHERE form LIKE '%Holiday%'";
} else {
    $whereCondition = "";
    $formSelector = "All";
}

// Query
$user_query = "SELECT id, form, name, email, phone, pickuptime, pickuplocation, payment, status, timestamp from forms ".$whereCondition." ORDER BY id DESC;";
$user_query = $db->query($user_query);
$filename = $formSelector."Orders"; // File Name

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

