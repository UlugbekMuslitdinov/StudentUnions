<?php

// check for valid netID
$users = array('yontaek', 'alewis3','sarthakbawal','christinecarlson', 'kmalvarez', 'hernand6', 'jschultz2');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccess = true;
} else {
	$grantAccess = false;
}

// check for valid netID for Admin status
$users = array('yontaek','eotkank87','christinecarlson', 'kmalvarez', 'hernand6');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccessAdmin = true;
} else {
	$grantAccessAdmin = false;
}

?>
