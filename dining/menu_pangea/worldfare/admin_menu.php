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
<title>Pangea Menu System</title>
<link rel="stylesheet" type="text/css" href="../admin_menu.css" />
</head>

<body>
<div id="calGrid">
<h1 style="text-align:center; margin-top:20px;">Pangea Restaurant Menu System</h1>

<?php

	echo '<p style="padding-top:5px; text-align:center;"><a href="/dining/menu_central.php">Back to Menu Central</a> | <a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/menu_central.php/&logout_text=Return%20to%20Menu%20Central">Logout of UA NetID WebAuth</a></p>';
	
// CHECK FOR VALID ACCESS
// include list of authorized users
include("../webauth.php");

if (!$grantAccess) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.</p>";
//	echo '<p style="padding-top:20px; text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/menu_pangea/&logout_text=Return%20to%20Pangea Menu">Logout of UA NetID WebAuth</a></p>';
	echo '</div>';
	session_unset();
} else {

	// access has been granted

	###################################################################
	// check each week to see if a change of status has been posted  //
	###################################################################
	
	if (isset($_POST['wk1Status'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit week 1 status
		$update = $db->query("UPDATE week SET 
		status = \"" . $_POST['wk1Status'] . "\"
		WHERE id = 1");

	} else if (isset($_POST['wk2Status'])) {
		
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit week 1 status
		$update = $db->query("UPDATE week SET 
		status = \"" . $_POST['wk2Status'] . "\"
		WHERE id = 2");

	} else if (isset($_POST['wk3Status'])) {

		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit week 1 status
		$update = $db->query("UPDATE week SET 
		status = \"" . $_POST['wk3Status'] . "\"
		WHERE id = 3");

	} // END IF for week status updates

	###################################################################
	// check each day to see if a change of status has been posted   //
	###################################################################

	## day 1 ##
	if (isset($_POST['day1Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 1 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day1Menu'] . "\"
		WHERE id = 1");

	} // END IF for day menu updates

	## day 2 ##
	if (isset($_POST['day2Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 2 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day2Menu'] . "\"
		WHERE id = 2");

	} // END IF for day menu updates

	## day 3 ##
	if (isset($_POST['day3Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 3 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day3Menu'] . "\"
		WHERE id = 3");

	} // END IF for day menu updates

	## day 4 ##
	if (isset($_POST['day4Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 4 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day4Menu'] . "\"
		WHERE id = 4");

	} // END IF for day menu updates

	## day 5 ##
	if (isset($_POST['day5Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 5 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day5Menu'] . "\"
		WHERE id = 5");

	} // END IF for day menu updates

	## day 6 ##
	if (isset($_POST['day6Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 6 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day6Menu'] . "\"
		WHERE id = 6");

	} // END IF for day menu updates

	## day 7 ##
	if (isset($_POST['day7Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 7 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day7Menu'] . "\"
		WHERE id = 7");

	} // END IF for day menu updates

	## day 8 ##
	if (isset($_POST['day8Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 8 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day8Menu'] . "\"
		WHERE id = 8");

	} // END IF for day menu updates

	## day 9 ##
	if (isset($_POST['day9Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 9 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day9Menu'] . "\"
		WHERE id = 9");

	} // END IF for day menu updates

	## day 10 ##
	if (isset($_POST['day10Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 10 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day10Menu'] . "\"
		WHERE id = 10");

	} // END IF for day menu updates

	## day 11 ##
	if (isset($_POST['day11Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 11 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day11Menu'] . "\"
		WHERE id = 11");

	} // END IF for day menu updates

	## day 12 ##
	if (isset($_POST['day12Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 12 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day12Menu'] . "\"
		WHERE id = 12");

	} // END IF for day menu updates

	## day 13 ##
	if (isset($_POST['day13Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 13 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day13Menu'] . "\"
		WHERE id = 13");

	} // END IF for day menu updates

	## day 14 ##
	if (isset($_POST['day14Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 14 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day14Menu'] . "\"
		WHERE id = 14");

	} // END IF for day menu updates

	## day 15 ##
	if (isset($_POST['day15Menu'])) {
	
		// select database
		$db = new db_mysqli("menus_pangea_worldfare");
			
	
		// query to edit day 15 menu
		$update = $db->query("UPDATE day SET
		menuID = \"" . $_POST['day15Menu'] . "\"
		WHERE id = 15");

	} // END IF for day menu updates

?>

<table cellpadding="0" cellspacing="0" rules="all">
<tr>
	<td colspan="6" style="text-align:left;"><p style="padding-bottom:3px;"><strong>Welcome to the Pangea Menu Management System</strong></p>
	<p style="line-height:15px;">Use the calendar grid below to make updates to the 3-week rotating menu. For each day, a total of 20 menus are available for customization, with 15 being 'active' at any given time. You may also 'close' the restaurant on a day-by-day basis, by selecting the "Closed" option from any of the "Change Menu..." pulldowns. Or you may close an entire week (Mon-Fri) by using the pulldowns in the far left column. If you are unsure of what a particular icon does, hold your cursor over it to view a brief description. Please note that changes made here appear on the live website immediately.</p>
	<div style="float:left;"><h2 style="color:green;">World Fare Menu</h2></div>
	<div style="float:right;">
	<p style="font-size:14px;"><a href="/dining/menu_pangea/italian/admin_menu.php">Italian Menu</a> | <!--<a href="/dining/menu_pangea/worldfare/admin_menu.php">-->World Fare Menu<!--</a>--></p>
	<ul style="padding:7px 0 0 20px;">
		<li><a href="/dining/sumc/pangea" target="_blank">View Live Menu</a> | <a href="history.php">View Admin Log</a></li>
	</ul>
	</div>
	</td>
</tr>
<tr bgcolor="#CCCCCC">
	<td style="text-align:center; padding:5px 10px 5px 10px;"><a href="admin_menu.php" title="Refresh: click here if you've changed a menu name but are not seeing the updated name in the calendar grid below"><img src="/dining/menu_pangea/images/refresh.gif" width="25" height="25" align="bottom" /></a></td>
	<td class="hdr">Monday</td>
	<td class="hdr">Tuesday</td>
	<td class="hdr">Wednesday</td>
	<td class="hdr">Thursday</td>
	<td class="hdr">Friday</td>
</tr>

<?php
// select database
$db = new db_mysqli("menus_pangea_worldfare");
	

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);

// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);

// CODE FOR DEBUGGING
// same as two lines above except that it advances current date by 1 week or more--just change the 7s to 14s or 21s etc...
// $daysPast = floor(((time() + (7 * 24 * 60 * 60)) - strtotime($startRow['startDay'])) / 86400);
// $weeksPast = floor(((time() + (7 * 24 * 60 * 60)) - strtotime($startRow['startDay'])) / 604800);

// CODE FOR DEBUGGING
// echo 'Start Date: ' . $startRow['startDay'];
// echo '<br />' . $daysPast . ' days have passed since start date';
// echo '<br />' . $weeksPast . ' weeks have passed since start date';

$dayCount = $daysPast % 7;
$weekCount = $weeksPast % 3;

	// figure out which day of the week it is (unless it's a weekend)
	switch ($dayCount) {
    case 0:
        $dayOfWk = 'Monday';
        break;
    case 1:
        $dayOfWk = 'Tuesday';
        break;
    case 2:
        $dayOfWk = 'Wednesday';
        break;
    case 3:
        $dayOfWk = 'Thursday';
        break;
    case 4:
        $dayOfWk = 'Friday';
        break;
	}

	// figure out which week of the rotation we are in
	switch ($weekCount) {
	case 0:
		$whichWeek = 'Week 1'; // this is only used for debugging
		
		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 1;
		$wkPlDwn2 = 2;
		$wkPlDwn3 = 3;
				
		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week1
		$week1 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week 2 in week2
		$week2 = $weekRow['status'];
		
		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week3
		$week3 = $weekRow['status'];

		// assign the days based on which week we are in
		$day1 = 1;
		$day2 = 2;
		$day3 = 3;
		$day4 = 4;
		$day5 = 5;
		$day6 = 6;
		$day7 = 7;
		$day8 = 8;
		$day9 = 9;
		$day10 = 10;
		$day11 = 11;
		$day12 = 12;
		$day13 = 13;
		$day14 = 14;
		$day15 = 15;
        break;
	case 1:
		$whichWeek = 'Week 2'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 2;
		$wkPlDwn2 = 3;
		$wkPlDwn3 = 1;
		
		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week3
		$week3 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week1
		$week1 = $weekRow['status'];
		
		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week2
		$week2 = $weekRow['status'];

		// assign the days based on which week we are in
		$day1 = 6;
		$day2 = 7;
		$day3 = 8;
		$day4 = 9;
		$day5 = 10;
		$day6 = 11;
		$day7 = 12;
		$day8 = 13;
		$day9 = 14;
		$day10 = 15;
		$day11 = 1;
		$day12 = 2;
		$day13 = 3;
		$day14 = 4;
		$day15 = 5;
        break;
	case 2:
		$whichWeek = 'Week 3'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 3;
		$wkPlDwn2 = 1;
		$wkPlDwn3 = 2;
		
		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");
		
		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week2
		$week2 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week3
		$week3 = $weekRow['status'];
		
		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week1
		$week1 = $weekRow['status'];
		
		// assign the days based on which week we are in		
		$day1 = 11;
		$day2 = 12;
		$day3 = 13;
		$day4 = 14;
		$day5 = 15;
		$day6 = 1;
		$day7 = 2;
		$day8 = 3;
		$day9 = 4;
		$day10 = 5;
		$day11 = 6;
		$day12 = 7;
		$day13 = 8;
		$day14 = 9;
		$day15 = 10;
        break;
	}

// CODE FOR DEBUGGING
//echo '<br /><p style="text-align:center;">Week in rotation: ' . $weekCount . ' which is "' . $whichWeek . '" of the rotation</p>';
// FYI for the user, but they probably won't want or need it...may be better off w/o it
//echo '<br /><p style="text-align:center;">We are in "' . $whichWeek . '" of the rotation.</p>';

// calculate how many total days have past using the total number of rounded weeks
$tmp = $weeksPast * 7;

// figure out where to start the date count for the first Monday
$startDate = date("M j", strtotime("+" . $tmp . " days", strtotime($startRow['startDay'])));

// assign dates for week 1
// the $tue1 below is how i'll probably want to show this on the actual display page for the popup editor and on the live menu page
// $tue1 = date("l, F j, Y", strtotime("+1 days", strtotime($startDate)));
$mon1 = $startDate;
$tue1 = date("M j", strtotime("+1 days", strtotime($startDate)));
$wed1 = date("M j", strtotime("+2 days", strtotime($startDate)));
$thu1 = date("M j", strtotime("+3 days", strtotime($startDate)));
$fri1 = date("M j", strtotime("+4 days", strtotime($startDate)));

// assign dates for week 2
$mon2 = date("M j", strtotime("+7 days", strtotime($startDate)));
$tue2 = date("M j", strtotime("+8 days", strtotime($startDate)));
$wed2 = date("M j", strtotime("+9 days", strtotime($startDate)));
$thu2 = date("M j", strtotime("+10 days", strtotime($startDate)));
$fri2 = date("M j", strtotime("+11 days", strtotime($startDate)));

// assign dates for week 3
$mon3 = date("M j", strtotime("+14 days", strtotime($startDate)));
$tue3 = date("M j", strtotime("+15 days", strtotime($startDate)));
$wed3 = date("M j", strtotime("+16 days", strtotime($startDate)));
$thu3 = date("M j", strtotime("+17 days", strtotime($startDate)));
$fri3 = date("M j", strtotime("+18 days", strtotime($startDate)));

?>

<!-- >>> BEGIN WEEK 1 <<< -->
<tr valign="top">
	<td class="wk">Week 1<br />&nbsp;<br />
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="wk<? echo $wkPlDwn1; ?>Status" onChange="this.form.submit();">
		<option<?= $week1 == 'Open' ? ' selected' : '' ?> value="Open">Open</option>
		<option<?= $week1 == 'Closed' ? ' selected' : '' ?> value="Closed">Closed</option>
	</select></form></td>

<!-- BEGIN DAY 1 -->
	<td <?php if ($dayOfWk == 'Monday') { echo ' bgcolor="#d0f5c4"'; } ?>><p style="text-align:right; color:#F60;"><?php echo $mon1; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day1; ?>Menu" onChange="this.form.submit();">
	<?php	
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $day1 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table so we can fill out the options list of all available menus
		$menu = $db->query("SELECT * FROM menu ORDER BY name");

		// loop through all the menu options
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
			
			
//			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')">Edit</a>';
//			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')">Review</a>';
			
			
			
			
		}
		if ($week1 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 1 -->	

<!-- BEGIN DAY 2 -->
	<td <?php if ($dayOfWk == 'Tuesday') { echo ' bgcolor="#d0f5c4"'; } ?>><p style="text-align:right; color:#F60;"><?php echo $tue1; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day2; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 2
		$day = $db->query("SELECT * FROM day WHERE id = " . $day2 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week1 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 2 -->

<!-- BEGIN DAY 3 -->
	<td <?php if ($dayOfWk == 'Wednesday') { echo ' bgcolor="#d0f5c4"'; } ?>><p style="text-align:right; color:#F60;"><?php echo $wed1; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day3; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day3 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week1 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 3 -->

<!-- BEGIN DAY 4 -->
	<td <?php if ($dayOfWk == 'Thursday') { echo ' bgcolor="#d0f5c4"'; } ?>><p style="text-align:right; color:#F60;"><?php echo $thu1; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day4; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day4 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week1 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 4 -->

<!-- BEGIN DAY 5 -->
	<td <?php if ($dayOfWk == 'Friday') { echo ' bgcolor="#d0f5c4"'; } ?>><p style="text-align:right; color:#F60;"><?php echo $fri1; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day5; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day5 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week1 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 5 -->
</tr>
<!-- >>> END WEEK 1 <<< -->

<!-- >>> BEGIN WEEK 2 <<< -->
<tr valign="top">
	<td class="wk">Week 2<br />&nbsp;<br />
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="wk<? echo $wkPlDwn2; ?>Status" onChange="this.form.submit();">
		<option<?= $week2 == 'Open' ? ' selected' : '' ?> value="Open">Open</option>
		<option<?= $week2 == 'Closed' ? ' selected' : '' ?> value="Closed">Closed</option>
	</select></form></td>

<!-- BEGIN DAY 6 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $mon2; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day6; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day6 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week2 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 6 -->

<!-- BEGIN DAY 7 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $tue2; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day7; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day7 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week2 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 7 -->

<!-- BEGIN DAY 8 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $wed2; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day8; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day8 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week2 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 8 -->
	
<!-- BEGIN DAY 9 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $thu2; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day9; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day9 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week2 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 9 -->
	
<!-- BEGIN DAY 10 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $fri2; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day10; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day10 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week2 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 10 -->
</tr>
<!-- >>> END WEEK 2 <<< -->

<!-- >>> BEGIN WEEK 3 <<< -->
<tr valign="top">
	<td class="wk">Week 3<br />&nbsp;<br />
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="wk<? echo $wkPlDwn3; ?>Status" onChange="this.form.submit();">
		<option<?= $week3 == 'Open' ? ' selected' : '' ?> value="Open">Open</option>
		<option<?= $week3 == 'Closed' ? ' selected' : '' ?> value="Closed">Closed</option>
	</select></form></td>
	
<!-- BEGIN DAY 11 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $mon3; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day11; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day11 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week3 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 11 -->
	
<!-- BEGIN DAY 12 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $tue3; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day12; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day12 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week3 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 12 -->
	
<!-- BEGIN DAY 13 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $wed3; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day13; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day13 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week3 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 13 -->
	
<!-- BEGIN DAY 14 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $thu3; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day14; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day14 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week3 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 14 -->
	
<!-- BEGIN DAY 15 -->
	<td><p style="text-align:right; color:#F60;"><?php echo $fri3; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $day15; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $day15 . "");
		$dayRow = $day->fetch_assoc();;
		
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();

		echo '<option selected="selected">Change Menu...</option>';
		
		// query the menu table
		$menu = $db->query("SELECT * FROM menu ORDER BY name");
		
		while ($menuRow = $menu->fetch_assoc()) {
			echo '<option value="' . $menuRow['id'] . '">' . $menuRow['name'] . '</option>';
		}
	?>
	</select></form><br />&nbsp;<br />

	<?php
		if ($menuNameRow['name'] == 'Closed') {
			echo '<p style="color:#ff0000;">' . $menuNameRow['name'] . '</p>';
		} else {
			echo '<p><strong>' . $menuNameRow['name'] . '</strong></p>';
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=725, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_pangea/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week3 == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
<!-- END DAY 15 -->
	
</tr>
</table>
</div>

<?php
} // END the IF for WebAuth
?>

</body>
</html>