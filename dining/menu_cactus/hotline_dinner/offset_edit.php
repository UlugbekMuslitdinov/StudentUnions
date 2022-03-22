<?php

// authenticate with WebAuth
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');

// connect to database
include($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cactus Grill Menu System</title>
<link rel="stylesheet" type="text/css" href="admin_menu.css" />
</head>

<body>
<div style="padding:10px;">
<h1 style="text-align:center; margin-top:20px;">Cactus Grill Menu System</h1>

<?php
	
// CHECK FOR VALID ACCESS
// include list of authorized users
include("webauth.php");

if (!$grantAccess) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.</p>";
//	echo '<p style="padding-top:20px; text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/menu_pangea/&logout_text=Return%20to%20Pangea Menu">Logout of UA NetID WebAuth</a></p>';
	echo '</div>';
	session_unset();
} else {

// select database
$db = new db_mysqli("menus_cactus_dinner");
	

// query the plate pricing offset
$offset = $db->query("SELECT offset FROM plate_pricing WHERE id = 1");
$offsetRow = $offset->fetch_assoc();

?>

<?php
if (!isset($_POST['priceChange'])) {
?>

<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>?id=1" method="POST" style="text-align:center;">
<p style="padding-top:20px;"><strong>Plate pricing: </strong>$<input type="text" value="<?php echo $offsetRow['offset']; ?>" name="offset" maxlength="4" style="width:30px;" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value=" Set Price " name="priceChange" /></p>
</form>

<?php
} else {
?>

<?php
	// check for errors and process the form
	if (isset($_POST['offset']) && is_numeric($_POST['offset'])) {
		// set up the query
		$db->query("UPDATE plate_pricing SET
		offset = \"" . $_POST['offset'] . "\"
		WHERE id = " . $_GET['id'] . "");

		// confirm change		
		echo '<p style="padding-top:10px; color:green; text-align:center; font-weight:bold;">Plate pricing changed successfully!</p>';
	
	} else {

		// explain error
		echo '<p style="padding-top:10px; color:red; text-align:center;"><strong>Plate pricing error!<br />
		Please enter a valid dollar amount (eg. x.xx).</strong><br />&nbsp;<br />
		<a href="offset_edit.php">Try again!</a></p>';

	} // END if (is_numeric($_POST['offset']))

?>

<?php
} // END if (!$_POST['priceChange'])
?>

<p style="text-align:center; padding-top:25px;"><a href="javascript:;" onclick="javascript:parent.close()">close</a></p>

</div>

<?php
} // END the IF for WebAuth
?>

</body>
</html>