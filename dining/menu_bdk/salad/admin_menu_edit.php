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
include("../webauth.php");

if (!$grantAccess) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.</p>";
	echo '</div>';
	session_unset();
} else { // access has been granted so continue
		
// include menu settings
include("admin_menu_settings.php");

// select database
$db = new db_mysqli("menus_bdk_salad");
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Menu ~ Bear Down Kitchen Menu System</title>
<link rel="stylesheet" type="text/css" href="../admin_menu.css" />
</head>

<body>
<h1 style="text-align:center; margin-top:20px;">Bear Down Kitchen Menu System</h1>
<div style="width:675px; border:1px solid #CCC; margin:20px auto 0 auto;">
<h2>Edit <em style="color:green;">Salad Bar</em> Menu</h2>

<?php
if (!isset($_POST['submit'])) {

// query the menu id
$nameResult = $db->query("SELECT * FROM menu WHERE id = " . $_GET['menu'] . "");
$nameRow = $nameResult->fetch_assoc();

?>

<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>?id=<?php echo $_GET['menu']; ?>" method="POST">
<div style="width:313px; float:left; margin:10px 0 10px 10px;">

<h3>Menu Name</h3>
<input type="text" size="30" name="name" value="<?php echo $nameRow['name'] ?>" /><br />&nbsp;<br />

<h4><em>Display Menu Name on Live Site?</em></h4>
Yes <input type="radio" value="Yes" name="display" <?php if ($nameRow['display'] == "Yes") {echo 'checked="checked"';} ?> />&nbsp;&nbsp;&nbsp;&nbsp;No <input type="radio" value="No" name="display" <?php if ($nameRow['display'] == "No") {echo 'checked="checked"';} ?> /><br />&nbsp;<br />

<h4><em>Display Prices Live Site?</em></h4>
Yes <input type="radio" disabled="disabled" value="Yes" name="prices" <?php if ($nameRow['prices'] == "Yes") {echo 'checked="checked"';} ?> />&nbsp;&nbsp;&nbsp;&nbsp;No <input type="radio" value="No" name="prices" <?php if ($nameRow['prices'] == "No") {echo 'checked="checked"';} ?> /><br />&nbsp;<br />

<h3>Grains</h3>
<?php 
// query the item table to get all the Grains on this menu
$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $grains . " ORDER BY id");

$count = 1;
while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxGrains)) {
	echo $count . '. <input type="text" maxlength="100" size="30" name="grain[' . $count . ']" value="' . $itemRow['name'] . '" /> $<input type="text" maxlength="5" size="3" name="priceGrains[' . $count . ']" value="' . $itemRow['price'] . '" /><br />';
	$count++;
}
echo '&nbsp;<br />';
?>

<h3>Salad Dressings</h3>
<?php 
// query the item table to get all the Vegetarian items on this menu
$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $salads . " ORDER BY id");

$count = 1;
while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSalads)) {
	echo $count . '. <input type="text" maxlength="100" size="30" name="salad[' . $count . ']" value="' . $itemRow['name'] . '" /> $<input type="text" maxlength="5" size="3" name="priceSalads[' . $count . ']" value="' . $itemRow['price'] . '" /><br />';
	$count++;
}
echo '&nbsp;<br />';
?>

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

<h3>Chef's Notes</h3>
<?php 
// query the item table to get all the Comments on this menu
$commentResult = $db->query("SELECT comments FROM menu WHERE id = " . $_GET['menu'] . "");

while ($commentRow = $commentResult->fetch_assoc()) {
	echo '<p style="padding-left:70px; font-size:10px; color:#999999;">225 characters max</p>';
	echo '<textarea style="width:227px" rows="7" name="comments" onKeyDown="textCounter(this.form.comments,this.form.remLen,225);" onKeyUp="textCounter(this.form.comments,this.form.remLen,225);">' . $commentRow['comments'] . '</textarea><br />';
	echo '<input readonly type=text name=remLen size=3 maxlength=3 value="225" style="padding-left:2px; font-size:10px; color:#999999;"> <span style="padding-left:2px; font-size:10px; color:#999999;">characters remaining</span>';
}

echo '&nbsp;<br />';
?>
</div>

<div style="width:312px; float:right; margin:10px 0 10px 10px;">

<h3>Salad Bar</h3>
<?php 
// query the item table to get all the Entrees on this menu
$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $entrees . " ORDER BY id");

$count = 1;
while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxEntrees)) {
	echo $count . '. <input type="text" maxlength="100" size="30" name="entree[' . $count . ']" value="' . $itemRow['name'] . '" /> $<input type="text" maxlength="5" size="3" name="priceEntrees[' . $count . ']" value="' . $itemRow['price'] . '" /><br />';
	$count++;
}
echo '&nbsp;<br />';
?>

<h3>Salad Toppings</h3>
<?php
// query the item table to get all the Vegetables on this menu
$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $_GET['menu'] . " AND dishID = " . $sides . " ORDER BY id");

$count = 1;
while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSides)) {
	echo $count . '. <input type="text" maxlength="100" size="30" name="side[' . $count . ']" value="' . $itemRow['name'] . '" /> $<input type="text" maxlength="5" size="3" name="priceSides[' . $count . ']" value="' . $itemRow['price'] . '" /><br />';
	$count++;
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
	$db = new db_mysqli("menus_bdk_salad");
		
		
	## MENU NAME ###############################
	// BEGIN MENU DATA COLLECTION AND SAVE TO DB
	// assign the menu value from the form
	$menu = cleanFormData($_POST['name']);
	$display = $_POST['display'];
	$prices = $_POST['prices'];

	// if the form field is blank, skip the db entry and leave the old name in place
	if ($menu != '') {
		// set up the query
		$db->query("UPDATE menu SET
		name = \"" . $menu . "\",
		display = \"" . $display . "\",
		prices = \"" . $prices . "\"
		WHERE id = " . $id . "");

	} // END the IF for blank form fields
		
	## DISH TYPE 1 #############################
	// BEGIN GRAIN DATA COLLECTION AND SAVE TO DB
	// delete the old grain data for this menu
	$result = $db->query("DELETE FROM item WHERE menuID = " . $_GET['id'] . " AND dishID = " . $grains . "");

	// assign some tmp values for short term calculations
	$tmp = 1;
	$tmp1 = 1;

	// loop through all of the potential grain values from the form
	while ($tmp <= $maxGrains) {
		
		// assign the grain values from the form
		$grain[$tmp] = cleanFormData($_POST['grain'][$tmp1]);

		// assign the price values from the form
		$priceGrains[$tmp] = cleanFormData($_POST['priceGrains'][$tmp1]);

		// if the form field is blank, skip the db entry
		if ($grain[$tmp] != '') {
			// set up the query
			$query = $db->query("INSERT INTO item
			(name, menuID, dishID, price)
			VALUES ('$grain[$tmp]', $id, $grains, '$priceGrains[$tmp]')");
		
			// set up the query to save the history of this update
			$queryEventContent = $db->query("INSERT INTO history_event_content
			(id, name, dishID, price)
			VALUES ('$keyID', '$grain[$tmp]', $grains, '$priceGrains[$tmp]')");
		
		} // END the IF for blank form fields
	
		// increment the tmp values
		$tmp++;
		$tmp1++;
	
	} // END the WHILE
	// END GRAIN DATA COLLECTION AND SAVE TO DB
	##########################################
	
	## DISH TYPE 2 ##############################
	// BEGIN SALAD DATA COLLECTION AND SAVE TO DB
	// delete the old salad data for this menu
	$result = $db->query("DELETE FROM item WHERE menuID = " . $_GET['id'] . " AND dishID = " . $salads . "");

	// assign some tmp values for short term calculations
	$tmp = 1;
	$tmp1 = 1;

	// loop through all of the potential salad values from the form
	while ($tmp <= $maxSalads) {
		
		// assign the salad values from the form
		$salad[$tmp] = cleanFormData($_POST['salad'][$tmp1]);
		
		// assign the price values from the form
		$priceSalads[$tmp] = cleanFormData($_POST['priceSalads'][$tmp1]);

		// if the form field is blank, skip the db entry
		if ($salad[$tmp] != '') {
			// set up the query
			$query = $db->query("INSERT INTO item
			(name, menuID, dishID, price)
			VALUES ('$salad[$tmp]', $id, $salads, '$priceSalads[$tmp]')");
	
			// set up the query to save the history of this update
			$queryEventContent = $db->query("INSERT INTO history_event_content
			(id, name, dishID, price)
			VALUES ('$keyID', '$salad[$tmp]', $salads, '$priceSalads[$tmp]')");
		
		} // END the IF for blank form fields
	
		// increment the tmp values
		$tmp++;
		$tmp1++;
	
	} // END the WHILE
	// END SALAD DATA COLLECTION AND SAVE TO DB
	##########################################

	## DISH TYPE 3 ###############################
	// BEGIN ENTREE DATA COLLECTION AND SAVE TO DB
	// delete the old entree data for this menu
	$result = $db->query("DELETE FROM item WHERE menuID = " . $_GET['id'] . " AND dishID = " . $entrees . "");

	// assign some tmp values for short term calculations
	$tmp = 1;
	$tmp1 = 1;

	// loop through all of the potential entree values from the form
	while ($tmp <= $maxEntrees) {
		
		// assign the entree values from the form
		$entree[$tmp] = cleanFormData($_POST['entree'][$tmp1]);

		// assign the price values from the form
		$priceEntrees[$tmp] = cleanFormData($_POST['priceEntrees'][$tmp1]);

		// if the form field is blank, skip the db entry
		if ($entree[$tmp] != '') {
			// set up the query
			$query = $db->query("INSERT INTO item
			(name, menuID, dishID, price)
			VALUES ('$entree[$tmp]', $id, $entrees, '$priceEntrees[$tmp]')");
	
			// set up the query to save the history of this update
			$queryEventContent = $db->query("INSERT INTO history_event_content
			(id, name, dishID, price)
			VALUES ('$keyID', '$entree[$tmp]', $entrees, '$priceEntrees[$tmp]')");
		
		} // END the IF for blank form fields
	
		// increment the tmp values
		$tmp++;
		$tmp1++;
	
	} // END the WHILE
	// END ENTREE DATA COLLECTION AND SAVE TO DB
	##########################################

	## DISH TYPE 4 #############################
	// BEGIN SIDE DATA COLLECTION AND SAVE TO DB
	// delete the old side data for this menu
	$result = $db->query("DELETE FROM item WHERE menuID = " . $_GET['id'] . " AND dishID = " . $sides . "");

	// assign some tmp values for short term calculations
	$tmp = 1;
	$tmp1 = 1;

	// loop through all of the potential side values from the form
	while ($tmp <= $maxSides) {
		
		// assign the side values from the form
		$side[$tmp] = cleanFormData($_POST['side'][$tmp1]);
		
		// assign the price values from the form
		$priceSides[$tmp] = cleanFormData($_POST['priceSides'][$tmp1]);

		// if the form field is blank, skip the db entry
		if ($side[$tmp] != '') {
			// set up the query
			$query = $db->query("INSERT INTO item
			(name, menuID, dishID, price)
			VALUES ('$side[$tmp]', $id, $sides, '$priceSides[$tmp]')");
	
			// set up the query to save the history of this update
			$queryEventContent = $db->query("INSERT INTO history_event_content
			(id, name, dishID, price)
			VALUES ('$keyID', '$side[$tmp]', $sides, '$priceSides[$tmp]')");
		
		} // END the IF for blank form fields
	
		// increment the tmp values
		$tmp++;
		$tmp1++;
	
	} // END the WHILE
	// END SIDE DATA COLLECTION AND SAVE TO DB
	##########################################

	## COMMENTS ###################################
	// BEGIN COMMENT DATA COLLECTION AND SAVE TO DB

		// assign the side values from the form
		$comments = cleanFormData($_POST['comments']);

			// set up the query
			$db->query("UPDATE menu SET
			comments = \"" . $comments . "\"
			WHERE id = \"" . $_GET['id'] . "\"");

			if ($comments) {
				// set up the query to save the history of this update
				$queryEventContent = $db->query("INSERT INTO history_event_content
				(id, comments)
				VALUES ('$keyID', '$comments')");
		
			}
			
			
	// END COMMENT DATA COLLECTION AND SAVE TO DB
	#############################################

			// assign form values
			$display = $_POST['display'];
			$prices = $_POST['prices'];

			// set up the query to save the history of this update
			$queryEvent = $db->query("INSERT INTO history_event
			(id, netID, menu, display, prices, timestamp)
			VALUES ('$keyID', '$netID', '$menu', '$display', '$prices', $timestamp)");
		
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