<?php
// Send email.
$shift_id = $_GET['shift_id'];
$employee_id = $_GET['employee_id'];
$task_id = $_GET['task_id'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
// Query for the Shift
$query_1 = "SELECT * FROM Shifts S LEFT JOIN ShiftsTasks ST ON S.id = ST.shift_id LEFT JOIN Tasks T ON ST.task_id = T.id LEFT JOIN Locations L ON L.id = S.location_id WHERE S.id = " . $shift_id . " AND T.id = " . $task_id . "";
$shift = $db->query($query_1);
$shift = mysqli_fetch_assoc($shift);
// $ = $shift[''];
$shift_date = $shift['shift_date'];
$time_from = $shift['time_from'];
$time_to = $shift['time_to'];
$note = $shift['note'];
$task = $shift['task'];
$location = $shift['location'];
	
// Query for the employee
$query_2 = "SELECT * FROM Employees WHERE id = " . $employee_id . "";
$employee = $db->query($query_2);
$employee = mysqli_fetch_assoc($employee);
$first_name = $employee['first_name'];
$last_name = $employee['last_name'];

$location_message = "<br />Dear " . $first_name . " " . $last_name . "!<br /> Thank you for your willingness to help us!  But sorry! The shift on <b>" . $shift_date . " (" . $time_from . " - " . $time_to . ")</b> at <b>" . $location . " for the " . $task . " position</b> was already filled.<br /><br />";
//  This is a special note for the Shift.
if (strlen($note) > 0) {
	$location_message .= "<br /><br />NOTE:<br />";
	$location_message .= $note;
}

$email = $employee['email'];
$subject = "Shift Sign Already Filled";
$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
// $headers .= "Bcc: angelicg@arizona.edu\r\n";
$headers .= "Bcc: su-web@email.arizona.edu\r\n";
$headers .= "Bcc: yontaek@arizona.edu\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$message = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>' . $location_message . '
<body style="font-family: arial, sans-serif;font-size: 13px;">
</body>
</html>';

// Send email.
mail($email, $subject, $message, $headers);
// Redirect after data Update.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/view_shifts.php?id=" . $shift_id);
// test.union.arizona.edu/admin/shifts/email_approved.php?employee_id=2&shift_id=6&task_id=8
?>

