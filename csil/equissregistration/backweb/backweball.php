<?php
require_once('password_protect.php');
require_once('page_start.php');

$result = mysql_query("SELECT lastName, firstName, id FROM registration WHERE status = 1 ORDER BY id DESC");
		
if (mysql_num_rows($result) > 0)
{
	while ($registrants = mysql_fetch_assoc($result))
	{
		$registrants = array_map('htmlentities', $registrants);
		echo "<a href=\"backwebinfo.php?id={$registrants['id']}\">{$registrants['firstName']} {$registrants['lastName']}</a><br>";
	}
}
else
{
	//not registered
	echo "No Registrants Yet!";
}

require_once('page_end.php');
?>