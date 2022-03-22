<?php

// check for valid netID
$users = array('carlson7', 'yontaek','sarthakbawal','christinecarlson','michellew1','debbyw');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccess = true;
} else {
	$grantAccess = false;
}

// check for valid netID for Admin status
$users = array('yontaek', 'sarthakbawal','christinecarlson','michellew1','debbyw');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccessAdmin = true;
} else {
 	$grantAccessAdmin = false;
}


?>
