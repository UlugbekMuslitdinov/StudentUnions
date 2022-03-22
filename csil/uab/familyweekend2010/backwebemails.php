<?php
session_start();
if(!$_SESSION['fw']['backweb']){
	header("Location:backweb.php");
	exit();	
}

include('../../../commontools/mysql_link.inc');
mysql_select_db('familyweekend10', $DBlink);

$query = 'select email from payment';
$result = mysql_query($query);
while($row = mysql_fetch_assoc($result)){
	print $row['email'].'<br />';
}