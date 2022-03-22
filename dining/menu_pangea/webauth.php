<?php

// check for valid netID
$users = array('jmichae1', 'rachelb1', 'jtoddmillay', 'carlson7', 'jlarison', 'pkelsey', 'sarahannquiroz', 'danielleflowers', 'ldj', 'levengoo', 'shannonbeckett', 'ppm', 'snapoleon', 'stoutj', 'landrade', 'yontaek', 'treybannon','eotkank87','emilyr1','christinecarlson');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccess = true;
} else {
	$grantAccess = false;
}

// check for valid netID for Admin status
$users = array('jmichae1', 'jtoddmillay', 'jlarison', 'ldj', 'levengoo', 'yontaek', 'treybannon','eotkank87','christinecarlson');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccessAdmin = true;
} else {
	$grantAccessAdmin = false;
}

?>
