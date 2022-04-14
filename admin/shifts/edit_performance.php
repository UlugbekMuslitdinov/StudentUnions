<?php
session_start();
// Connect to the database.
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');


	$performance = $_GET['performance'];
    $id = $_GET['id'];
    $shift_id = $_GET['shift_id'];

  
// Store the information into the database.
	$db = new db_mysqli('signup');
	$query = "UPDATE Signups 
                SET performance = '". $performance ."'
                WHERE shift_id = '". $shift_id ."'
                AND employee_id = '". $id ."'";
	$db->query($query);

// Redirect after data insertion.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/employee_view.php?id=". $id);

?>