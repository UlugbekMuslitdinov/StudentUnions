<?php
/*
 * Equiss Registration
 * Updated January, 2011
 */

require_once('../include.php');
require_once('password_protect.php');

// Excel
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=equiss.xls");
header("Pragma: no-cache");
header("Expires: 0");

$fields = array('id', 'lastName', 'firstName', 'email', 'age', 'school', 'major', 'career', 'specdiet', 'specneeds', 'gender', 'race', 'orientation', 'religion', 'economic', 'shuttle');

echo implode("\t", $fields) . "\tidentities\n";

$sql = "SELECT " . implode(', ', $fields) . " FROM registration WHERE status = 1";
$result = mysql_query($sql) or die(mysql_error());
while ($row = mysql_fetch_assoc($result))
{
	foreach ($row as $key => $value)
	{
		echo htmlentities(stripslashes($value)) . "\t";
	}
	
	echo identities($row['id']) . "\n";
}

function identities($id)
{
	$identities = array();
	$sql = "SELECT identity_text FROM identities WHERE reg_id = $id";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_assoc($result))
	{
		$identities[] = htmlentities(stripslashes($row['identity_text']));
	}
	
	return implode('|', $identities);
}
?>