<?php

// check for valid netID
$users = array('yontaek', 'eotkank87','christinecarlson', 'kmalvarez', 'hernand6');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccess = true;
} else {
	$grantAccess = false;
}

// check for valid netID for Admin status
$users = array('yontaek', 'jmichae1', 'jtoddmillay', 'landrade', 'ldj', 'levengoo','eotkank87','christinecarlson');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccessAdmin = true;
} else {
	$grantAccessAdmin = false;
}

?>
