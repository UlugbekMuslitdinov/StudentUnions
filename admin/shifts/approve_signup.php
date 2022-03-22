<?php
// Approve the Shift Signp.
$shift_id = $_GET['shift_id'];
$employee_id = $_GET['employee_id'];
$task_id = $_GET['task_id'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	

$query = "UPDATE SignupTasks SET status = 'Approved' WHERE shift_id = " . $shift_id . " AND employee_id = " . $employee_id . " AND task_id = " . $task_id . "";
$db->query($query);
$query_2 = "UPDATE Signups SET status = 'Emailed' WHERE shift_id = " . $shift_id . " AND employee_id = " . $employee_id . "";
$db->query($query_2);

// If this person has applied for other tasks as well for this shift, change them as "Filled."
$query_3 = "SELECT count(id) AS count_id  FROM SignupTasks WHERE shift_id = " . $shift_id . " AND employee_id = " . $employee_id . " AND task_id != " . $task_id . "";
$filled = $db->query($query_3);
$filled = mysqli_fetch_assoc($filled);
$count_id = $filled['count_id'];
if ($count_id > 0) {
	$query_4 = "UPDATE SignupTasks SET status = 'Filled' WHERE shift_id = " . $shift_id . " AND employee_id = " . $employee_id . " AND task_id != " . $task_id . "";
	$db->query($query_4);	
}

// Redirect after data Update.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/email_approved.php?employee_id=" . $employee_id . "&shift_id=" . $shift_id . "&task_id=" . $task_id . "");
// header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/view_shifts.php?id=" . $shift_id);
?>

