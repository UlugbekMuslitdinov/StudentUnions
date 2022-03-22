<?php

// check for valid netID
$users = array('kmbeyer', 'jmichae1', 'rachelb1', 'jtoddmillay','christinecarlson');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccess = true;
} else {
	$grantAccess = false;
}

// check for valid netID for Admin status
$users = array('kmbeyer', 'jmichae1', 'jtoddmillay','christinecarlson');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccessAdmin = true;
} else {
	$grantAccessAdmin = false;
}

?>