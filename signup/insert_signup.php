<?php
session_start();
// Connect to the database.
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');
// NetID is passed from the WebAuth login.
$netid = $_SESSION["netid"];

// Variables from the form.
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$affiliation = $_POST['affiliation'];
	$supervisor_id = $_POST['supervisor'];

// Check if this NetID exists on the database
$query = "SELECT id FROM Employees WHERE netid = '" . $netid . "'";
$result = $db->query($query);
$records = mysqli_fetch_assoc($result);

// Check if this NetID already exists in the database.
if ($records['id'] > 0) {		// If YES, UPDATE
	$employee_id = $records['id'];
	$query = "UPDATE Employees SET " . 
		"first_name = '" . $first_name .
		"', last_name = '" . $last_name .
		"', email = '" . $email .
		"', phone = '" . $phone .
		"', affiliation = '" . $affiliation .  
		"', supervisor_id = " . $supervisor_id .  
		" WHERE id = " . $employee_id . "";
	$db->query($query);	
} else {						// If NO, INSERT
	$query = "INSERT INTO Employees SET " . 
		"first_name = '" . $first_name .
		"', last_name = '" . $last_name .
		"', email = '" . $email .
		"', phone = '" . $phone .
		"', affiliation = '" . $affiliation .  
		"', supervisor_id = " . $supervisor_id .  
		", netid = '" . $netid .
		"'" ;
	$db->query($query);

// Retrieve ID for this record. 
$query = "SELECT max(id) as max_id FROM Employees";
$result = $db->query($query);
$employee = mysqli_fetch_assoc($result);
$employee_id = $employee['max_id'];
}

// Insert Records.
if (isset($_POST['shift'])) {	
$shifts = $_POST['shift'];
// $count = count($shifts);
foreach($shifts as $shift_array)  
   {  
    // Insert Shifts into the Signups table.
	$query2="INSERT INTO Signups (shift_id, status, employee_id) VALUES ($shift_array, 'Applied', $employee_id)"; 
	$db->query($query2);	
	
	// Get Task array.
	$tasks = $_POST['task'];
	foreach($tasks as $task_array) {
		$shift_id = substr($task_array, 0, strpos($task_array, 'Shift'));	// $task_array like "5Shift-Task_2"
		$task_id = substr($task_array, strpos($task_array, '_') + 1);
		// Insert Task array.
		$query3="INSERT INTO SignupTasks (shift_id, task_id, employee_id, status) VALUES ($shift_id, $task_id, $employee_id, 'Pending')"; 
		$db->query($query3);
	}
		// Get Requirement Array.
		$requirements = $_POST['requirement'];
		foreach($requirements as $requirement_array) {
			$shift_id = substr($requirement_array, 0, strpos($requirement_array, 'Shift'));	// $task_array like "5Shift-Task_2"
			$task_id = substr($requirement_array, strpos($requirement_array, '_') + 1);
			// Get requirement_id from the array: String like "5Shiftx1yTask_2"
			$string_before_y = substr($requirement_array, 0, strpos($requirement_array, 'y'));
			$x_position = strpos($string_before_y, 'x');
			$requirement_id_position = $x_position + 1;
			$requirement_id = substr($string_before_y, $requirement_id_position);
			// Get Filled value.
			$filled = $_POST['filled_' . $requirement_id];
			// Insert Requirement array.
			$query4="INSERT INTO SignupRequirements (shift_id, task_id, requirement_id, employee_id, filled) VALUES ($shift_id, $task_id, $requirement_id, $employee_id, '$filled')"; 
			$db->query($query4);
		}
}
}

// Redirect after data insertion.
header("Location: http://".$_SERVER[HTTP_HOST]."/signup/index.php?confirm=yes");

?>