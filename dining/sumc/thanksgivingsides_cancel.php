<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// Payment canceled at the CyberSource payment page.
$id = $_REQUEST['req_merchant_defined_data4'];
$db = new db_mysqli('su');
$query = "UPDATE forms SET status = 'Canceled' WHERE id =" . $id . "";
$result = $db->query($query);

// Redirect.
header("Location: http://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php");
?>