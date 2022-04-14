
<?php
session_start(); //Need this to get supervisors netid
// Connect to the database.
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$employee_id = $_POST['employee_id'];
	$banned = $_POST['banned'];
	$note = $_POST['note'];
	$netid = $_SESSION['webauth']['netID']; //Supervisors netid from session webauth login. This is for Comments table	

// Store the information into the database.
	$db = new db_mysqli('signup');
	if ((isset($banned)) && (strlen($banned) > 0)) {
		$query = "UPDATE Employees SET banned = '" . $banned . "' WHERE id = " . $employee_id . "";
		$db->query($query);
	}
	if ((isset($note)) && (strlen($note) > 0)) {
		$query = "INSERT INTO Comments (employee_id, netid, comment) 
					VALUES (". $employee_id .", '". $netid ."', '". $note ."')";
		$db->query($query);
	}

// Redirect after data insertion.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/employee_view.php?id=". $employee_id);
}
?>