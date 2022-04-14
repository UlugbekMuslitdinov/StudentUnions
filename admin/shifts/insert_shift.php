
<?php
// Connect to the database.
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$supervisor = $_POST['supervisor'];
	// $netid = "";
	$event = $_POST['event'];
	$location = $_POST['location'];
	$shift_date = $_POST['shift_date'];
	// Format Date.
	$date=date_create($shift_date);
	$shift_date = date_format($date,"m/d/Y");
	// Format Time.
	$timefrom = $_POST['timefrom'];
	$timefrom=date_create($timefrom);
	$timefrom = date_format($timefrom,"h:i A");
	$timeto = $_POST['timeto'];
	$timeto=date_create($timeto);
	$timeto = date_format($timeto,"h:i A");
	$num_positions = $_POST['num_positions'];
	$shiftsupervisor_id = $_POST['shiftsupervisor'];
	$urgent = $_POST['urgent'];
	$note = $_POST['note'];

// Store the information into the database.
	$db = new db_mysqli('signup');
	$query = "INSERT INTO Shifts SET " . 
		"event = '" . $event .
		"', location_id = " . $location .
		", shift_date = '" . $shift_date .
		"', time_from = '" . $timefrom .
		"', time_to = '" . $timeto .
		"', num_positions = " . $num_positions .
		", shiftsupervisor_id = " . $shiftsupervisor_id .  
		", urgent = " . $urgent .  
		", note = '" . $note .
		"'" ;
	$db->query($query);
	
// Insert Tasks into the ShiftsTasks table.
	$tasks = $_POST['task'];
	$count = count($tasks);
	if ($count > 0) {
		// Get the Shift ID for this insertion.
		$query = "SELECT max(id) as max_id FROM Shifts";
		$result = $db->query($query);
		$shift = mysqli_fetch_assoc($result);
		$shift_id = $shift['max_id'];
		for ($i=0; $i<$count; $i++)
		{	
		 $query="INSERT INTO ShiftsTasks (shift_id, task_id) VALUES ($shift_id, $tasks[$i])"; 
		 $db->query($query);
		}
	}

// Redirect after data insertion.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/index.php?confirm=yes");
}
?>