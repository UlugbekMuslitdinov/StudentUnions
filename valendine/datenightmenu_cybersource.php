<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// Store the information into the database.
$id = $_REQUEST['req_merchant_defined_data4'];
$db = new db_mysqli('su');

// Update the status as complete.
$query = "UPDATE forms SET status = 'Paid' WHERE id =" . $id . "";
$result = $db->query($query);

$query = "SELECT * FROM forms WHERE id = " . $id . "";
$result = $db->query($query);
$form = mysqli_fetch_assoc($result);
$email = $form['email'];
$subject = $form['emailsubject'];
$headers = $form['emailheaders'];
$message = $form['emailmessage'];

// Send email.
mail($email, $subject, $message, $headers);
header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/index.php?confirm=feast");
?>