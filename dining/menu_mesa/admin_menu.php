<?php

// authenticate with WebAuth
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');

// connect to database
include($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// include menu settings
include("admin_menu_settings.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mesa Room Menu System</title>
<link rel="stylesheet" type="text/css" href="admin_menu.css" />

<!-- link calendar files  -->
<!-- source location -->
<!-- http://www.softcomplex.com/products/tigra_calendar/ -->
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 

</head>

<body>
<div id="calGrid">
<h1 style="text-align:center; margin-top:20px;">Mesa Room Menu System</h1>

<?php

	echo '<p style="padding-top:5px; text-align:center;"><a href="/dining/menu_central.php/">Back to Menu Central</a> | <a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/menu_central.php&logout_text=Return%20to%20Menu%20Central">Logout of UA NetID WebAuth</a></p>';
	
// CHECK FOR VALID ACCESS
// include list of authorized users
include("webauth.php");

if (!$grantAccess) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.</p>";
	echo '</div>';
	session_unset();
} else {

	// access has been granted

// select database
$db = new db_mysqli("menus_mesa");
	

if ($_POST) {

###############
## FUNCTIONS ##
###############

// Form data cleaning function
function cleanFormData($formData) {
	$formData = trim($formData); // removes leading and trailing spaces
	$formData = strip_tags($formData); // strips HTML style tags

		if(get_magic_quotes_gpc()){ // prevents duplicate backslashes if magic quotes is enabled in php install
			$formData = stripslashes($formData);
		}

	return $formData;
}
		
####################
## ERROR CHECKING ##
####################
	
	$errors = false;
	$error_msg = array();
	$error_class = array();

	## DATE VALIDATION ##
	if ($_POST['assignA']) {
	
		// Check submitted start date for menu A
		if (empty($_POST['dateA'])) {
			$errors = true;
			$error_msg['dateA'] = 'Please select a date.';
			$error_class['dateA'] = ' class="error"';
			$error_class_detail['dateA'] = ' class="errorDetail"';
			$error_field_class['dateA'] = 'bgError';

		// Check submitted start date for conflict with an existing future date. Only applies to assignA form because of other logic forcing future menus to assignB position.
		} else if (date("Y-m-d", strtotime($_POST['dateA'])) > $today && $_SESSION['future']) {
			$errors = true;
			$error_msg['dateA'] = 'You cannot schedule more than one menu for a future start date.';
			$error_class['dateA'] = ' class="error"';
			$error_class_detail['dateA'] = ' class="errorDetail"';
			$error_field_class['dateA'] = 'bgError';

		// Check submitted start date for conflict with an existing start date.
		} else if (date("Y-m-d", strtotime($_POST['dateA'])) == $_SESSION['date'][1]) {
			$errors = true;
			$error_msg['dateA'] = 'You cannot schedule the same start date for two menus.';
			$error_class['dateA'] = ' class="error"';
			$error_class_detail['dateA'] = ' class="errorDetail"';
			$error_field_class['dateA'] = 'bgError';

		} else {
			$dateA = cleanFormData(date("Y-m-d", strtotime($_POST['dateA'])));
		}

		if (!$errors) {
			// update the schedule
			$db->query("UPDATE start SET
			startDate = \"" . $dateA . "\"
			WHERE menuID = \"" . $_POST['menuID'] . "\"");
			
		}

	} else if ($_POST['assignB']) {

		// Check submitted start date for menu B
		if (empty($_POST['dateB'])) {
			$errors = true;
			$error_msg['dateB'] = 'Please select a date.';
			$error_class['dateB'] = ' class="error"';
			$error_class_detail['dateB'] = ' class="errorDetail"';
			$error_field_class['dateB'] = 'bgError';
			
		// Check submitted start date for conflict with an existing start date.
		} else if (date("Y-m-d", strtotime($_POST['dateB'])) == $_SESSION['date'][0]) {
			$errors = true;
			$error_msg['dateB'] = 'You cannot schedule the same start date for two menus.';
			$error_class['dateB'] = ' class="error"';
			$error_class_detail['dateB'] = ' class="errorDetail"';
			$error_field_class['dateB'] = 'bgError';
			
		} else {
			$dateB = cleanFormData(date("Y-m-d", strtotime($_POST['dateB'])));
		}
		
		if (!$errors) {
			// update the schedule
			$db->query("UPDATE start SET
			startDate = \"" . $dateB . "\"
			WHERE menuID = \"" . $_POST['menuID'] . "\"");
			
		}
		
	}
	
}

?>

<table class="main" cellpadding="0" cellspacing="0" rules="all">
<tr>
	<td class="main" colspan="6" style="text-align:left;"><p style="padding-bottom:3px;"><strong>Welcome to the Mesa Room Menu Management System</strong></p>
	<p style="line-height:15px;">Use the tools below to copy, edit and schedule the Mesa Room menu that appears on the Union website. A few tips to get started:</p>
	<ul class="genBulls">
		<li>The "Copy/Edit" tool allows you to copy the "Current" menu into an "Expired" or "Future" menu and then edit and save the content.</li>
		<li>Changes made to the "Current" menu appear on the website immediately.</li>
		<li>"Future" menu start dates are also immediately highlighted on the site.</li>
		<li>If you have changed the name of a menu but are not seeing the updated name in the grid below, click the [refresh] link to update the display.</li>
	</ul>
	<p style="text-align:right;"><a href="/dining/sumc/mesaroom" target="_blank">View Live Menu</a> | <a href="history.php">View Admin Log</a></p></td>
</tr>
<tr bgcolor="#CCCCCC" valign="top">
	<td class="hdr">Status</td>
	<td class="hdr">Menu Name<br /><span style="font-weight:normal;">[<a href="" title="Click this link if you've changed a menu name but are not seeing the updated name in the grid below.">refresh</a>]</span></td>
	<td class="hdr">Copy/Edit</td>
	<td class="hdr">Edit</td>
	<td class="hdr">Preview</td>
	<td class="hdr">Schedule</td>
</tr>

<?php
	## MENU DISPLAY LOGIC
	// get the menu start dates
	$result = $db->query("SELECT * FROM start ORDER BY startDate ASC");

	// initialize vars
	$i = 0;
	$future = false;
	$_SESSION['future'] = false;

	## Figure out the order to display the menus
	## We will never have two future or current day menus.
	## Error checking on the entry side will prevent this.
	## The only options supported/allowed are expired and current or current and future menus.
	## This way we always have one menu that is current/displayed
	// loop through results and assign to array
	while ($row = $result->fetch_assoc()) {
	
		// put dates for both menus in the session for error checking later on
		$_SESSION['date'][$i] = $row['startDate'];
		
		if ($row['startDate'] <= $today) {
			$menuID[$i] = $row['menuID'];
			$i++;
		} else {
			$future = true;
			$_SESSION['future'] = true;
			$menuID[$i] = $row['menuID'];
			$i++;
		}

	}
	
	// if we have a future menu, show the current first and the future second
	if ($future) {
	
		// query for future menu name and schedule ##
		$futureMenu = $db->query("SELECT menu.id, menu.name, start.startDate FROM menu, start WHERE menu.id = " . $menuID[1] . " AND start.menuID = " . $menuID[1] . "");
		$futureMenuR = $futureMenu->fetch_assoc();

		// query for current menu name and schedule ##
		$currentMenu = $db->query("SELECT menu.id, menu.name, start.startDate FROM menu, start WHERE menu.id = " . $menuID[0] . " AND start.menuID = " . $menuID[0] . "");
		$currentMenuR = $currentMenu->fetch_assoc();
	
?>

<tr style="text-align:left;">
	<td><strong style="color:green;">Current</strong></td>
	<td><strong style="color:green;"><? echo $currentMenuR['name']; ?></strong></td>
	<?php
	
		echo '<td></td>';
	
		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $currentMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a></td>';

		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $currentMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a></td>';

		echo '<td>Start Date: <span style="color:green; font-weight:bold;">' . date("m/d/Y", strtotime($currentMenuR['startDate'])) . '</span>';
		?>
	<form style="padding:0; margin:0;" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="text" name="dateA" class="tcal <?php echo $error_field_class['dateA']; ?>" value="" /><span<?php echo $error_class_detail['dateA']; ?>><?= ($error_msg['dateA']) ? '<br />' . $error_msg['dateA'] : '' ?></span><br />
		<input type="hidden" name="menuID" value="<? echo $currentMenuR['id']; ?>" />
		<input type="submit" name="assignA" value="Set" />
	</form>
	</td>
</tr>

<tr style="text-align:left;">
	<td><strong style="color:blue;">Future</strong></td>
	<td><strong style="color:blue;"><? echo $futureMenuR['name']; ?></strong></td>
	<?php 
	
		// pass both IDs if they choose the "Copy" option -- current for pulling the "Current" menu's data into the view, and future for saving over the future menu on submit
		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menusave=' . $futureMenuR['id'] . '&menu=' . $currentMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/copy.png" width="24" height="24" alt="Copy from \'Current\' Menu and Edit" title="Copy from \'Current\' Menu and Edit" /></a></td>';

		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $futureMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a></td>';

		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $futureMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a></td>';

		echo '<td>Start Date: <span style="color:blue; font-weight:bold;">' . date("m/d/Y", strtotime($futureMenuR['startDate'])) . '</span>';
		?>
	<form style="padding:0; margin:0;" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="text" name="dateB" class="tcal <?php echo $error_field_class['dateB']; ?>" value="" /><span<?php echo $error_class_detail['dateB']; ?>><?= ($error_msg['dateB']) ? '<br />' . $error_msg['dateB'] : '' ?></span><br />
		<input type="hidden" name="menuID" value="<? echo $futureMenuR['id']; ?>" />
		<input type="submit" name="assignB" value="Set" />
	</form>	
	</td>
</tr>

<?php
	// if we don't have a future menu, still show the current menu first and the expired menu second
	} else {
	
		// query for expired and current menu name and schedule ##
		$expiredMenu = $db->query("SELECT menu.id, menu.name, start.startDate FROM menu, start WHERE menu.id = " . $menuID[0] . " AND start.menuID = " . $menuID[0] . "");
		$expiredMenuR = $expiredMenu->fetch_assoc();

		// query for current menu name and schedule ##
		$currentMenu = $db->query("SELECT menu.id, menu.name, start.startDate FROM menu, start WHERE menu.id = " . $menuID[1] . " AND start.menuID = " . $menuID[1] . "");
		$currentMenuR = $currentMenu->fetch_assoc();

?>

<tr style="text-align:left;">
	<td><strong style="color:green;">Current</strong></td>
	<td><strong style="color:green;"><? echo $currentMenuR['name']; ?></strong></td>
	<?php 
	
		echo '<td></td>';
	
		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $currentMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a></td>';

		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $currentMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a></td>';

		echo '<td>Start Date: <span style="color:green; font-weight:bold;">' . date("m/d/Y", strtotime($currentMenuR['startDate'])) . '</span>';
		?>
	<form style="padding:0; margin:0;" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="text" name="dateB" class="tcal <?php echo $error_field_class['dateB']; ?>" value="" /><span<?php echo $error_class_detail['dateB']; ?>><?= ($error_msg['dateB']) ? '<br />' . $error_msg['dateB'] : '' ?></span><br />
		<input type="hidden" name="menuID" value="<? echo $currentMenuR['id']; ?>" />
		<input type="submit" name="assignB" value="Set" />
	</form>	
	</td>
</tr>

<tr style="text-align:left;">
	<td><strong style="color:red;">Expired</strong></td>
	<td><strong style="color:red;"><? echo $expiredMenuR['name']; ?></strong></td>
	<?php

		// pass both IDs if they choose the "Copy" option -- current for pulling the "Current" menu's data into the view, and expired for saving over the expired menu on submit
		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menusave=' . $expiredMenuR['id'] . '&menu=' . $currentMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/copy.png" width="24" height="24" alt="Copy from \'Current\' Menu and Edit" title="Copy from \'Current\' Menu and Edit" /></a></td>';

		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $expiredMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a></td>';

		echo '<td><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $expiredMenuR['id'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_mesa/img/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a></td>';

		echo '<td>Start Date: <span style="color:red; font-weight:bold;">' . date("m/d/Y", strtotime($expiredMenuR['startDate'])) . '</span>';
		?>
	<form style="padding:0; margin:0;" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="text" name="dateA" class="tcal <?php echo $error_field_class['dateA']; ?>" value="" /><span<?php echo $error_class_detail['dateA']; ?>><?= ($error_msg['dateA']) ? '<br />' . $error_msg['dateA'] : '' ?></span><br />
		<input type="hidden" name="menuID" value="<? echo $expiredMenuR['id']; ?>" />
		<input type="submit" name="assignA" value="Set" />
	</form>
	</td>
</tr>

<?php
	}
?>

</table>

<?php
} // END the IF for WebAuth
?>

</body>
</html>