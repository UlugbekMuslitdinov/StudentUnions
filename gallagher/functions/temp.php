<?php
// include_once('db.class.php');
// include_once('./functions/db.class.php');
// Database
echo "test0";
require_once ('/commontools/includes/mysqli.inc');
echo "test00";
$db = new db_mysqli('su');
echo "test000";
updateDB();


function updateDB() {	
	echo "test11";
	$query2 = "INSERT INTO temp (id, netid) VALUES (2, 'test2');";
	$db->query($query2);
	echo "test22";
	echo "Inserted into database";
}
