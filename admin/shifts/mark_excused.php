<?php
// Mark attendance.
$shift_id = $_GET['shift_id'];
$employee_id = $_GET['employee_id'];
$task_id = $_GET['task_id'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
$query = "UPDATE SignupTasks SET attendance = 'Excused' WHERE shift_id = " . $shift_id . " AND employee_id = " . $employee_id . " AND task_id = " . $task_id . "";
$db->query($query);

// Redirect after data Update.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/view_shifts.php?id=" . $shift_id);
?>

