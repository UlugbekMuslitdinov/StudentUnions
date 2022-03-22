<?php
	require_once ('includes/studentapp.inc');
	// override session timeout to give them 90 minutes
	ini_set("session.gc_maxlifetime", 5400);
	session_start();
	$_SESSION['employment_app'] = new student_app_proccess('union');
	$_SESSION['employment_app'] -> login();
?>

