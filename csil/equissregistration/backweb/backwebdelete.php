<?php
require_once('password_protect.php');
require_once('../include.php');

$referer = (isset($_POST['referer'])) ? $_POST['referer'] : $_SERVER['HTTP_REFERER'];
$id = intval($_GET['id']);
if (!isset($id) || isset($_POST['cancel']))
	redirect($referer);

include('page_start.php');

$query = "SELECT * FROM registration WHERE id = $id";
$registrants = mysql_fetch_assoc(mysql_query($query));

echo '<div align="center">';
if (isset($_POST['delete']))
{
	$query = "UPDATE registration SET status = 0 WHERE id = $id";
	$result = mysql_query($query);
	echo '<p>Registrant ' . $registrants['firstName'] . ' ' .  $registrants['lastName'] . ' Successfully Deleted!</p>
	<p>Click <a href="backweball.php">here</a> to return to the registrant list</p>';
}
else
{
	echo '<p>Are you sure you want to delete registrant ' . $registrants['firstName'] . ' ' .  $registrants['lastName'] . '?</p>
	<form method="post"><input type="submit" name="delete" value="Delete">&nbsp;&nbsp;&nbsp;<input type="submit" name="cancel" value="Cancel">
	<input type="hidden" name="referer" value="' . $referer . '"></form>';
}
echo '</div>';

include('page_end.php');
?>