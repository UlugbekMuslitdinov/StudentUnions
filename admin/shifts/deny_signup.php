<?php
// Deny this Shift Signup
$shift_id = $_GET['shift_id'];
$employee_id = $_GET['employee_id'];
$task_id = $_GET['task_id'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
$query = "UPDATE SignupTasks SET status = 'Filled' WHERE shift_id = " . $shift_id . " AND employee_id = " . $employee_id . " AND task_id = " . $task_id . " AND id > 0;";
$db->query($query);

// Redirect after data Update.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/email_filled.php?employee_id=" . $employee_id . "&shift_id=" . $shift_id . "&task_id=" . $task_id . "");
// header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/view_shifts.php?id=" . $shift_id);
?>

