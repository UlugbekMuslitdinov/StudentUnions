<?php

// authenticate with WebAuth
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');

// connect to database
include($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// CHECK FOR VALID ACCESS
// include list of authorized users
include("webauth.php");

if (!$grantAccess) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:su-web@email.arizona.edu\">su-web@email.arizona.edu</a> if you need access or have questions.</p>";
//	echo '<p style="padding-top:20px; text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/sumc/pangea/&logout_text=Return%20to%20Pangea Menu">Logout of UA NetID WebAuth</a></p>';
	echo '</div>';
	session_unset();
} else { // access has been granted so continue
		
// include menu settings
include("admin_menu_settings.php");

// select database
$db = new db_mysqli("menus_85north");
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Preview Menu ~ '85 North Restaurant Menu System</title>
<link rel="stylesheet" type="text/css" href="admin_menu.css" />
</head>

<body>
<h1 style="text-align:center; margin-top:20px;">'85 North Restaurant Menu System</h1>
<div style="width:675px; border:1px solid #CCC; margin:20px auto 0 auto;">
<h2>Preview <!--<em style="color:green;"></em>--> Menu</h2>

<?php

// query the menu id
$nameResult = $db->query("SELECT * FROM menu WHERE id = " . $_GET['menu'] . "");
$nameRow = $nameResult->fetch_assoc();

?>

<div style="width:313px; float:left; margin:10px 0 10px 10px;">

<h3 style="margin-bottom:0;">Menu Name</h3>
<?php echo '<p>' . $nameRow['name'] . '</p>'; ?>

<h4 style="margin-bottom:0; margin-top:15px;"><em>Display Menu Name on Live Site?</em></h4>
<?php
echo '<p>'.$nameRow['display'].'</p>';
?>

<h4 style="margin-bottom:0; margin-top:15px;"><em>Display Prices on Live Site?</em></h4>
<?php
echo '<p>'.$nameRow['prices'].'</p>';
?>

<?php
$itemID = 1;
echo '<h2><u>Breakfast</u></h2>';
foreach($bk as $key => $value) {
	printMenu ($db, $itemID, $value, $key);
	$itemID += 4;
}

$itemID = 2;
echo '<h2><u>Lunch</u></h2>';
foreach($lunch as $key => $value) {
	printMenu ($db, $itemID, $value, $key);
	$itemID += 4;
}
?>

<h3 style="margin-bottom:0; margin-top:15px;">Chef's Notes</h3>
<?php 
// query the item table to get all the Vegetarian items on this menu
$commentResult = $db->query("SELECT comments FROM menu WHERE id = " . $_GET['menu'] . "");

// init counters and flags
$display = false;

while ($commentRow = $commentResult->fetch_assoc()) {
	// only show the row if it is not empty
	if ($commentRow['comments'] != '') {
		echo nl2br($commentRow['comments']) . '<br />';
		$display = true;
	}
}
if (!$display) {
	echo '<p><span style="color:#ff0000;">No notes to display.</span><br />
	The "Chef\'s Notes" header and this message will be hidden on the live menu.</p>';
}
?>
</div>

<div style="width:312px; float:right; margin:10px 0 10px 10px;">

<?php

$itemID = 3;
echo '<h2><u>Dinner</u></h2>';
foreach($dinner as $key => $value) {
	printMenu ($db, $itemID, $value, $key);
	$itemID += 4;
}

$itemID = 4;
echo '<h2><u>Brunch</u></h2>';
foreach($br as $key => $value) {
	printMenu ($db, $itemID, $value, $key);
	$itemID += 4;
}
?>

<br />
<form>
<input name="edit" type="button" value="Edit Menu" onClick="window.location='admin_menu_edit.php?menu=<?php echo $_GET['menu']; ?>'" />
</form>
</div>

<br class="clear" />




<p style="text-align:center; margin:10px 0 10px 0;"><a href="javascript:parent.close()">close / cancel</a></p>

</div>

</body>
</html>

<?php
} // END IF for granting access
?>

<?php
function printMenu ($db, $dishID, $max, $title) {
	echo '<h3 style="margin-bottom:0; margin-top:15px;">'.$title.'</h3>';
	// query the item table to get all the Grains on this menu
	$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $dishID . " ORDER BY id");

	// init counters and flags
	$count = 1;
	$display = false;

	while (($itemRow = $itemResult->fetch_assoc()) && ($count <= $max)) {
		// only show the row if it is not empty
		if ($itemRow['name'] != '') {
			echo $itemRow['name'] . ' / $' . $itemRow['price'] . '<br />';
			$display = true;
		}
		$count++;
	}
	if (!$display) {
		echo '<p><span style="color:#ff0000;">No "'.$title.'" to display.</span><br />
		The "'.$title.'" header and this message will be hidden on the live menu.</p>';
	}
}
?>