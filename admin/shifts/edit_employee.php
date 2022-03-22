
<?php
// Connect to the database.
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$employee_id = $_POST['employee_id'];
	$performance = $_POST['performance'];
	$banned = $_POST['banned'];
	$note = $_POST['note'];

// Store the information into the database.
	$db = new db_mysqli('signup');
	$query = "UPDATE Employees SET " . 
		"performance = '" . $performance .
		"', banned = '" . $banned .
		"', comment = '" . $note .
		"' WHERE id = " . $employee_id . "";
	$db->query($query);
	

// Redirect after data insertion.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/employees.php");
}
?>