<?php
session_start();
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

if($_GET['action']=="logout") {
	session_destroy();
	header("Location: https://webauth.arizona.edu/webauth/logout?logout_href=https://union.arizona.edu/sickfest/backweb/index.php&logout_text=Return%20To%20SICKFest%20Backweb");
	exit;
}

include('webauth/include.php');
$_SESSION['sickfest_backweb_user'] = $_SESSION['webauth']['netID'];
$users = array("sanorris", "jmasson", "mishah", "nbischof", "kbeyer", "styx", "chargrav", "alampiss", "cleary");
if (!in_array($_SESSION['sickfest_backweb_user'],$users)) {
	unset($_SESSION['sickfest_backweb_user']);
	echo 'permission denied';
	die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SICKFEST Backweb</title>
<link rel="stylesheet" type="text/css" href="backwebstyle.css" />
</head>
<body>
<h1>SICKFEST Backweb</h1>
<ul>
<li><a href="list.php">List Purchases</a></li><br />
<li><a href="add.php">Add New Purchase</a></li><br />
<li><a href="search.php">Search For Purchase</a></li>
</ul>
</body>
</html>