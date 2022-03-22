<?php

// check for valid netID
$users = array('kmbeyer', 'jmichae1', 'rachelb1', 'jtoddmillay', 'carlson7', 'landrade', 'pkelsey', 'bedillon', 'yontaek', 'ldj', 'levengoo', 'shannonbeckett', 'ppm', 'snapoleon', 'stoutj', 'stout', 'jlevengoo', 'sbray1', 'emilyr1', 'neyshar','sarthakbawal','christinecarlson');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccess = true;
} else {
	$grantAccess = false;
}

// check for valid netID for Admin status
$users = array('kmbeyer', 'jmichae1', 'jtoddmillay', 'landrade', 'bedillon', 'yontaek', 'ldj', 'levengoo', 'sbray1', 'emilyr1', 'jlevengoo','sarthakbawal','christinecarlson');
if (in_array($_SESSION['webauth']['netID'], $users)) {
	$grantAccessAdmin = true;
} else {
	$grantAccessAdmin = false;
}

?>
