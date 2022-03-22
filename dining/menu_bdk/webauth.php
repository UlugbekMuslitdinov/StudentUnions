<?php

// check for valid netID
$users = array('yontaek', 'rachelb1', 'jtoddmillay', 'carlson7', 'jlarison', 'pkelsey', 'zackbaker', 'ldj', 'levengoo', 'ppm', 'stoutj','eotkank87','emilyr1','christinecarlson', 'chefken', 'ammckearney', 'debbyw');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccess = true;
} else {
	$grantAccess = false;
}

// check for valid netID for Admin status
$users = array('yontaek', 'jtoddmillay', 'zackbaker', 'ldj', 'levengoo', 'eotkank87','christinecarlson','chefken', 'ammckearney', 'debbyw');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccessAdmin = true;
} else {
	$grantAccessAdmin = false;
}

?>
