<?php
// Send email.
$shift_id = $_GET['shift_id'];
$employee_id = $_GET['employee_id'];
$task_id = $_GET['task_id'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
// Query for the Shift
$query_1 = "SELECT * FROM Shifts S LEFT JOIN ShiftsTasks ST ON S.id = ST.shift_id LEFT JOIN Tasks T ON ST.task_id = T.id LEFT JOIN Locations L ON L.id = S.location_id LEFT JOIN Shiftsupervisors SS ON S.shiftsupervisor_id = SS.id";
$query_1 .= " WHERE S.id = " . $shift_id . " AND T.id = " . $task_id . "";
$shift = $db->query($query_1);
$shift = mysqli_fetch_assoc($shift);
$shift_date = $shift['shift_date'];
$time_from = $shift['time_from'];
$time_to = $shift['time_to'];
$note = $shift['note'];
$task = $shift['task'];
$location = $shift['location'];
$shiftsupervisor_email = $shift['email'];

// Query for the employee
$query_2 = "SELECT E.*, E.email AS email, S.email AS supervisor_email FROM Employees E LEFT JOIN Supervisors S ON E.supervisor_id = S.id WHERE E.id = " . $employee_id . "";
$employee = $db->query($query_2);
$employee = mysqli_fetch_assoc($employee);
$first_name = $employee['first_name'];
$last_name = $employee['last_name'];
$employeesupervisor_email = $employee['supervisor_email'];

// Email to the applicatnt.
$location_message = "<br />Dear " . $first_name . " " . $last_name . "!<br /> Thank you for your willingness to help us!  You have been selected to work on <b>" . $shift_date . " (" . $time_from . " - " . $time_to . ")</b> at <b>" . $location . "</b> for the " . $task . " position.<br /><br />  Arrive in black pants (not jeans or yoga pants), black socks, black nonslip shoes. Shirt will be provided. Please clock in & out as you normally would do and ask for person in charge.";
//  This is a special note for the Shift.
if (strlen($note) > 0) {
	$location_message .= "<br /><br />NOTE:<br />";
	$location_message .= $note;
}
$email = $employee['email'];
$subject = "Shift Sign Up Confirmation";
$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
// $headers .= "Bcc: su-web@email.arizona.edu\r\n";
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
// Send email to applicant.
mail($email, $subject, $message, $headers);

// Email to the Shift Supervisor & Applicant Supervisor
$supervisor_message = "<br />Hi,<br /> We notify that the employee below has signed up and has been approved for the following shift and position. " . "<br /><br />\r\n";
$supervisor_message .= "<b>Employee:</b> " . $first_name . " " . $last_name . "<br />\r\n";
$supervisor_message .= "<b>Shift Date:</b> " . $shift_date . "<br />\r\n";
$supervisor_message .= "<b>Shift Time:</b> " . $time_from . " - " . $time_to . "<br />\r\n";
$supervisor_message .= "<b>Location:</b> " . $location . "<br />\r\n";
$supervisor_message .= "<b>Position:</b> " . $task . "<br />\r\n";
	
// $email = $shiftsupervisor_email;
// The email recipient on the testing server.
$email = "su-web@email.arizona.edu";
$subject = "Shift Sign Up Confirmation";
$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
$headers .= "Bcc: " . $employeesupervisor_email . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$message = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>' . $supervisor_message . '
<body style="font-family: arial, sans-serif;font-size: 13px;">
</body>
</html>';
// Send email to supervisors.
mail($email, $subject, $message, $headers);

// Redirect after data Update.
header("Location: http://".$_SERVER[HTTP_HOST]."/admin/shifts/view_shifts.php?id=" . $shift_id);
// test.union.arizona.edu/admin/shifts/email_approved.php?employee_id=2&shift_id=6&task_id=8
?>

