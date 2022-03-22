<?php
session_start();
if(!isset($_SESSION['user'])){
	exit();
}
require_once('includes/mysqli.inc');
$db = new db_mysqli('student_hiring');
$query = 'select * from resumes where resume_id='.intval($_GET['id']);
$result = $db->query($query);
$resume = $result->fetch_assoc();
header('Content-type: '.$resume['type']);
header("Content-length: ".$resume['size']);
header('Content-disposition: attachment; filename='.$resume['name']);
header("Cache-Control: maxage=1"); // Age is in seconds.
header("Pragma: public");
echo $resume['resume'];
?>