<?php
// Database Connection
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
// require_once('includes/mysqli.inc');
$db = new db_mysqli('su');
// NetID login required.
function loginCheck() {
	include($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
//	$valid_user = ['yontaek','ricarlos'];
//
//	if (!in_array($_SESSION['webauth']['netID'],$valid_user)){		
//		// User is not valid
//		header("Location: /");
//		die();
//	}
}
// Insert every Login record.
function updateDB($netid, $emplid) {	
	$db = new db_mysqli('su');
	$query = "INSERT INTO gallagher (netid, emplid) VALUES ('$netid', '$emplid')";
	$result = $db->query($query);
}
?>
