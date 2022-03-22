<?php

	error_reporting(E_ALL);
	echo"Here";

	$BBlink = oci_connect('guest', 'cHeer#03', '192.168.73.45:1521/BBTS');
        if (!$BBlink) {
            $e = oci_error();
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		echo "bad";
		var_dump($e);
        }
	else {
		echo "good";
	}
?>
