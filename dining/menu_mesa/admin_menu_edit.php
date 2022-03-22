<?php

// authenticate with WebAuth
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');

// connect to database
include($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// turn off magic quotes if it's on
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
} // END magic quotes IF

###############
## FUNCTIONS ##
###############
	
	// Form data cleaning function
function cleanFormData($formData) {
	global $db;
	$formData = $db->escape($formData); // clean for mysql entry
	$formData = trim($formData); // removes leading and trailing spaces
	$formData = strip_tags($formData); // strips HTML style tags

	return $formData;
} // END function

// CHECK FOR VALID ACCESS
// include list of authorized users
include("webauth.php");

if (!$grantAccess) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.</p>";
//	echo '<p style="padding-top:20px; text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/sumc/redingtonrestaurant/&logout_text=Return%20to%20Redington Menu">Logout of UA NetID WebAuth</a></p>';
	echo '</div>';
	session_unset();
} else { // access has been granted so continue
		
// include menu settings
include("admin_menu_settings.php");

// select database
$db = new db_mysqli("menus_mesa");
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Menu ~ Mesa Room Menu System</title>
<link rel="stylesheet" type="text/css" href="admin_menu.css" />
<!-- JavaScript for comments limiter -->
<script language="javascript">
<!-- Original:  Ronnie T. Moore -->
<!-- Web Site:  The JavaScript Source -->

<!-- Dynamic 'fix' by: Nannette Thacker -->
<!-- Web Site: http://www.shiningstar.net -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}
// End -->
</script>
</head>

<body>
<h1 style="text-align:center; margin-top:20px;">Mesa Room Menu System</h1>
<div style="width:675px; border:1px solid #CCC; margin:20px auto 0 auto;">
<?php
if ($_GET['menusave']) {
	echo '<h2>Copy / Edit Menu</h2><p style="padding-left:10px; font-style:italic;">Use the content below from the "Current" menu to save time in updating your "Expired" or "Future" menu.</p>';
} else {
	echo '<h2>Edit Menu</h2>';
}
?>

<?php
if (!$_POST['submit']) {

// query the menu id
$nameResult = $db->query("SELECT name FROM menu WHERE id = " . $_GET['menu'] . "");
$nameRow = $nameResult->fetch_assoc();

?>

<? // if this is not a copy menu update, use the normal menu ID
if (!$_GET['menusave']) {
?>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>?id=<?php echo $_GET['menu']; ?>" method="POST">
<? // otherwise, use the alternate menusave ID to save over the menu
} else {
?>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>?id=<?php echo $_GET['menusave']; ?>" method="POST">
<?
}
?>

<div style="width:313px; float:left; margin:10px 0 10px 10px;">

<h3>Menu Name</h3>
<input type="text" size="30" name="name" value="<?php echo $nameRow['name'] ?>" /><br />&nbsp;<br />

<h3>First Course</h3>
<?php 
// query the item table to get all the First Courses on this menu
$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $firstCourses . " ORDER BY id");

$count = 1;
while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxFirstCourse)) {
	echo $count . '. <input type="text" maxlength="100" size="30" name="firstCourse[' . $count . ']" value="' . $itemRow['name'] . '" /><br />';
	$count++;
}
echo '&nbsp;<br />';
?>

<h3 style="margin-bottom:0;">Entr&eacute;es</h3>
<p style="margin-bottom:10px; font-size:10px;">Entr&eacute;e names require an associated description. Leaving a description field blank will result in the entr&eacute;e name being ignored when clicking the "Update Menu" button. Likewise, a description requires an associated entr&eacute;e name.</p>
<?php 
// query the item table to get all the Entrees on this menu
$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $entrees . " ORDER BY id");

$count = 1;
while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxEntrees)) {
	echo $count . '. <input type="text" maxlength="100" size="30" name="entree[' . $count . ']" value="' . $itemRow['name'] . '" /><br />';
	echo '<textarea name="description[' . $count . ']" style="width:172px; height:100px; margin:2px 0 10px 13px;">' . $itemRow['description'] . '</textarea><br />';
	$count++;
}
echo '&nbsp;<br />';
?>

</div>

<div style="width:312px; float:right; margin:10px 0 10px 10px;">

<h3>Dessert</h3>
<?php
// query the item table to get all the Desserts on this menu
$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $desserts . " ORDER BY id");

$count = 1;
while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxDesserts)) {
	echo $count . '. <input type="text" maxlength="100" size="30" name="dessert[' . $count . ']" value="' . $itemRow['name'] . '" /><br />';
	$count++;
}
echo '&nbsp;<br />';
?>

<h3>Chef's Notes</h3>
<?php 
// query the item table to get all the Comments on this menu
$commentResult = $db->query("SELECT comments FROM menu WHERE id = " . $_GET['menu'] . "");

while ($commentRow = $commentResult->fetch_assoc()) {
	echo '<p style="padding-left:70px; font-size:10px; color:#999999;">125 characters max</p>';
	echo '<textarea style="width:227px" rows="7" name="comments" onKeyDown="textCounter(this.form.comments,this.form.remLen,125);" onKeyUp="textCounter(this.form.comments,this.form.remLen,125);">' . $commentRow['comments'] . '</textarea><br />';
	echo '<input readonly type=text name=remLen size=3 maxlength=3 value="125" style="padding-left:2px; font-size:10px; color:#999999;"> <span style="padding-left:2px; font-size:10px; color:#999999;">characters remaining</span>';
}

echo '&nbsp;<br />';
?>

<input type="submit" name="submit" value="Update Menu" />
</div>

<br class="clear" />

</form>

<?php
} else { // if NOT POST submit, put the form contents into the database

	// assign the menu ID
	$id = $_GET['id'];
	
	// set up the arrays to use in assigning the data
	$firstCourse = array();
	$entree = array();
	$dessert = array();

	## Set up vars for event tracking ##
	// create a unique key based on netID, time and random number between 1 and 1,000,000
	$keyID = $_SESSION['webauth']['netID'] . '_' . time() . '_' . mt_rand(1, 1000000);
	// put the netID in a var for db entry
	$netID = $_SESSION['webauth']['netID'];
	// put the time in a var for db entry
	$timestamp = time();
	
	##########################
	## SAVE FORM DATA TO DB ##
	##########################
	
	// select database
	$db = new db_mysqli("menus_mesa");
		
		
	## MENU NAME ###############################
	// BEGIN MENU DATA COLLECTION AND SAVE TO DB
	// assign the menu value from the form
	$menu = cleanFormData($_POST['name']);

	// if the form field is blank, skip the db entry and leave the old name in place
	if ($menu != '') {
		// set up the query
		$db->query("UPDATE menu SET
		name = \"" . $menu . "\"			
		WHERE id = " . $id . "");

	} // END the IF for blank form fields
		
	## DISH TYPE 1 #############################
	// BEGIN FIRST COURSE DATA COLLECTION AND SAVE TO DB
	// delete the old first course data for this menu
	$db->query("DELETE FROM item WHERE menuID = " . $_GET['id'] . " AND dishID = " . $firstCourses . "");

	// assign some tmp values for short term calculations
	$tmp = 1;
	$tmp1 = 1;

	// loop through all of the potential first course values from the form
	while ($tmp <= $maxFirstCourse) {
		
		// assign the first course values from the form
		$firstCourse[$tmp] = cleanFormData($_POST['firstCourse'][$tmp1]);

		// if the form field is blank, skip the db entry
		if ($firstCourse[$tmp] != '') {
			// set up the query
			$db->query("INSERT INTO item
			(name, menuID, dishID)
			VALUES ('$firstCourse[$tmp]', $id, $firstCourses)");
		
			// set up the query to save the history of this update
			$db->query("INSERT INTO history_event_content
			(id, name, dishID)
			VALUES ('$keyID', '$firstCourse[$tmp]', $firstCourses)");
		
		} // END the IF for blank form fields
	
		// increment the tmp values
		$tmp++;
		$tmp1++;
	
	} // END the WHILE
	// END FIRST COURSE DATA COLLECTION AND SAVE TO DB
	##########################################
	
	## DISH TYPE 2 ###############################
	// BEGIN ENTREE DATA COLLECTION AND SAVE TO DB
	// delete the old entree data for this menu
	$db->query("DELETE FROM item WHERE menuID = " . $_GET['id'] . " AND dishID = " . $entrees . "");

	// assign some tmp values for short term calculations
	$tmp = 1;
	$tmp1 = 1;

	// loop through all of the potential entree values from the form
	while ($tmp <= $maxEntrees) {
		
		// assign the entree values from the form
		$entree[$tmp] = cleanFormData($_POST['entree'][$tmp1]);
		$description[$tmp] = cleanFormData($_POST['description'][$tmp1]);

		// if the form field is blank, skip the db entry
		if ($entree[$tmp] != '' && $description[$tmp] != '') {
			// set up the query
			$db->query("INSERT INTO item
			(name, description, menuID, dishID)
			VALUES ('$entree[$tmp]','$description[$tmp]', $id, $entrees)");
	
			// set up the query to save the history of this update
			$db->query("INSERT INTO history_event_content
			(id, name, description, dishID)
			VALUES ('$keyID', '$entree[$tmp]', '$description[$tmp]', $entrees)");
		
		} // END the IF for blank form fields
	
		// increment the tmp values
		$tmp++;
		$tmp1++;
	
	} // END the WHILE
	// END ENTREE DATA COLLECTION AND SAVE TO DB
	##########################################

	## DISH TYPE 3 #############################
	// BEGIN DESSERT DATA COLLECTION AND SAVE TO DB
	// delete the old dessert data for this menu
	$db->query("DELETE FROM item WHERE menuID = " . $_GET['id'] . " AND dishID = " . $desserts . "");

	// assign some tmp values for short term calculations
	$tmp = 1;
	$tmp1 = 1;

	// loop through all of the potential Dessert values from the form
	while ($tmp <= $maxDesserts) {
		
		// assign the Dessert values from the form
		$dessert[$tmp] = cleanFormData($_POST['dessert'][$tmp1]);

		// if the form field is blank, skip the db entry
		if ($dessert[$tmp] != '') {
			// set up the query
			$db->query("INSERT INTO item
			(name, menuID, dishID)
			VALUES ('$dessert[$tmp]', $id, $desserts)");
	
			// set up the query to save the history of this update
			$db->query("INSERT INTO history_event_content
			(id, name, dishID)
			VALUES ('$keyID', '$dessert[$tmp]', $desserts)");
		
		} // END the IF for blank form fields
	
		// increment the tmp values
		$tmp++;
		$tmp1++;
	
	} // END the WHILE
	// END DESSERT DATA COLLECTION AND SAVE TO DB
	##########################################

	## COMMENTS ###################################
	// BEGIN COMMENT DATA COLLECTION AND SAVE TO DB

		// assign the dessert values from the form
		$comments = cleanFormData($_POST['comments']);

			// set up the query
			$db->query("UPDATE menu SET
			comments = \"" . $comments . "\"
			WHERE id = \"" . $_GET['id'] . "\"");

			if ($comments) {
				// set up the query to save the history of this update
				$db->query("INSERT INTO history_event_content
				(id, comments)
				VALUES ('$keyID', '$comments')");
		
			}
			
			
	// END COMMENT DATA COLLECTION AND SAVE TO DB
	#############################################

			// set up the query to save the history of this update
			$db->query("INSERT INTO history_event
			(id, netID, menu, timestamp)
			VALUES ('$keyID', '$netID', '$menu', $timestamp)");
		
?>

<div style="margin:0 0 0 10px;">
<p>The menu was updated successfully!</p>
<ul class="genBulls">
	<li><a href="admin_menu_edit.php?menu=<?php echo $id; ?>">Edit this menu again</a></li>
	<li><a href="admin_menu_preview.php?menu=<?php echo $id; ?>">Preview this menu</a></li>
</ul>
</div>

<?php
} // END if POST submit
?>
<p style="text-align:center; margin:10px 0 10px 0;"><a href="javascript:parent.close()">close / cancel</a></p>

</div>

</body>
</html>

<?php
} // END IF for granting access
?>