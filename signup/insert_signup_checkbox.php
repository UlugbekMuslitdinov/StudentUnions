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
$employee_id = $records['id'];

// Check if this NetID already exists in the database.
if ($records['id'] > 0) {		// If YES, UPDATE
	$query = "UPDATE Employees SET " . 
		"first_name = '" . $first_name .
		"', last_name = '" . $last_name .
		"', email = '" . $email .
		"', phone = '" . $phone .
		"', affiliation = '" . $affiliation .  
		"', supervisor_id = " . $supervisor_id .  
		" WHERE id = " . $records['id'] . "";
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
}

// Retrieve ID for this record. The ID is needed after the credit card payment to send email.
$query = "SELECT max(id) as max_id FROM Employees";
$result = $db->query($query);
$employee = mysqli_fetch_assoc($result);
$max_id = $employee['max_id'];

// Insert Shifts into the Signups table.
if (isset($_POST['shift'])) {
$shifts = $_POST['shift'];
$count = count($shifts);
for ($i=0; $i<$count; $i++)
	{
	 $query2="INSERT INTO Signups (shift_id, status, employee_id) VALUES ($shifts[$i], 'Pending', $max_id)"; 
	 $db->query($query2);
	
	// Retrieve ID for this record. 
	$query = "SELECT max(id) as id FROM Signups";
	$result = $db->query($query);
	$record = mysqli_fetch_assoc($result);
	$max_signup_id = $record['id'];
	
	// Insert Task(s).
	if (isset($_POST['task'])) {
	$tasks = $_POST['task'];
	$count_j = count($tasks);
	for ($j=0; $j<$count_j; $j++)
		{
		 $query3="INSERT INTO SignupTasks (signup_id, task_id) VALUES ($max_signup_id,  $tasks[$j] )"; 
		 $db->query($query3);
	}
	}
}
}
// Redirect after data insertion.
header("Location: http://".$_SERVER[HTTP_HOST]."/signup/index.php?confirm=yes");

?>