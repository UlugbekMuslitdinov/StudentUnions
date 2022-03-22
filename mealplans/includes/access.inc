<?php
//file checks the database to see if a particular netID has access to the backweb
//the database and webauth handling should have already occured before this file is included

//select user with desired netid
$result = $db->query('select * from user_access where netID="'.$_SESSION['webauth']['netID'].'"');

//store user data in session
$_SESSION['user'] = mysqli_fetch_assoc($result);

//check if found
$found = mysqli_num_rows($result);
if(!$found){
	print $_SESSION['webauth']['netID'].'You do not have access to this site';
	exit();
}
?>
