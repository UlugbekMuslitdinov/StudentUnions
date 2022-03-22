<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
<title>'85 North System</title>
<link rel="stylesheet" type="text/css" href="admin_menu.css" />
</head>

<body>
<div id="calGrid">
<h1 style="text-align:center; margin-top:20px;">'85 North Restaurant Menu System</h1>

<?php

	echo '<p style="padding-top:5px; text-align:center;"><a href="/dining/menu_central.php">Back to Menu Central</a> | <a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/menu_central.php/&logout_text=Return%20to%20Menu%20Central">Logout of UA NetID WebAuth</a></p>';
	
// CHECK FOR VALID ACCESS
// include list of authorized users
include("webauth.php");

if (!$grantAccess) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:su-web@email.arizona.edu\">su-web@email.arizona.edu</a> if you need access or have questions.</p>";
//	echo '<p style="padding-top:20px; text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/menu_85north/&logout_text=Return%20to%20Pangea Menu">Logout of UA NetID WebAuth</a></p>';
	echo '</div>';
	session_unset();
} else {

	// access has been granted

	###################################################################
	// check each week to see if a change of status has been posted  //
	###################################################################
	
	if (isset($_POST['wk1Status'])) {
	
		// select database
		$db = new db_mysqli("menus_85north");
			
	
		// query to edit week 1 status
		$update = $db->query("UPDATE week SET 
		status = \"" . $_POST['wk1Status'] . "\"
		WHERE id = 1");

	} else if (isset($_POST['wk2Status'])) {
		
		// select database
		$db = new db_mysqli("menus_85north");
			
	
		// query to edit week 1 status
		$update = $db->query("UPDATE week SET 
		status = \"" . $_POST['wk2Status'] . "\"
		WHERE id = 2");

	} else if (isset($_POST['wk3Status'])) {

		// select database
		$db = new db_mysqli("menus_85north");
			
	
		// query to edit week 1 status
		$update = $db->query("UPDATE week SET 
		status = \"" . $_POST['wk3Status'] . "\"
		WHERE id = 3");

	} // END IF for week status updates

	###################################################################
	// check each day to see if a change of status has been posted   //
	###################################################################

	for ($i=1; $i <= 21; $i++) { 
		## day n ##
		if (isset($_POST['day'.$i.'Menu'])) {
			// select database
			$db = new db_mysqli("menus_85north");
				
		
			// query to edit day n menu
			$update = $db->query("UPDATE day SET
			menuID = \"" . $_POST['day'.$i.'Menu'] . "\"
			WHERE id = ".$i);
		} // END IF for day menu updates
	}

?>

<table cellpadding="0" cellspacing="0" rules="all">
<tr>
	<td colspan="6" style="text-align:left;"><p style="padding-bottom:3px;"><strong>Welcome to the '85 North Menu Management System</strong></p>
	<p style="line-height:15px;">Use the calendar grid below to make updates to the 3-week rotating menu. For each day, a total of 20 menus are available for customization, with 15 being 'active' at any given time. You may also 'close' the restaurant on a day-by-day basis, by selecting the "Closed" option from any of the "Change Menu..." pulldowns. Or you may close an entire week (Mon-Fri) by using the pulldowns in the far left column. If you are unsure of what a particular icon does, hold your cursor over it to view a brief description. Please note that changes made here appear on the live website immediately.</p>
	<div style="float:left;"><h2 style="color:green;">'85 north Menu</h2></div>
	<div style="float:right;">
	<p style="font-size:14px;"></p>
	<ul style="padding:7px 0 0 20px;">
		<li><a href="/dining/other/85north" target="_blank">View Live Menu</a> | <a href="history.php">View Admin Log</a></li>
	</ul>
	</div>
	</td>
</tr>
<tr bgcolor="#CCCCCC">
	<td style="text-align:center; padding:5px 10px 5px 10px;"><a href="admin_menu.php" title="Refresh: click here if you've changed a menu name but are not seeing the updated name in the calendar grid below"><img src="/dining/menu_85north/images/refresh.gif" width="25" height="25" align="bottom" /></a></td>
	<td class="hdr">Monday</td>
	<td class="hdr">Tuesday</td>
	<td class="hdr">Wednesday</td>
	<td class="hdr">Thursday</td>
	<td class="hdr">Friday</td>
	<td class="hdr">Saturday</td>
	<td class="hdr">Sunday</td>
</tr>

<?php
// select database
$db = new db_mysqli("menus_85north");
	

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
	case 5:
        $dayOfWk = 'Saturday';
		break;
	case 6:
        $dayOfWk = 'Sunday';
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
		$days = [
			0,
			1,2,3,4,5,6,7,
			8,9,10,11,12,13,14,
			15,16,17,18,19,20,21
		];
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
		$days = [
			0,
			8,9,10,11,12,13,14,
			15,16,17,18,19,20,21,
			1,2,3,4,5,6,7,
		];
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
		$days = [
			0,
			15,16,17,18,19,20,21,
			1,2,3,4,5,6,7,
			8,9,10,11,12,13,14
		];
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
$sat1 = date("M j", strtotime("+5 days", strtotime($startDate)));
$sun1 = date("M j", strtotime("+6 days", strtotime($startDate)));

// assign dates for week 2
$mon2 = date("M j", strtotime("+7 days", strtotime($startDate)));
$tue2 = date("M j", strtotime("+8 days", strtotime($startDate)));
$wed2 = date("M j", strtotime("+9 days", strtotime($startDate)));
$thu2 = date("M j", strtotime("+10 days", strtotime($startDate)));
$fri2 = date("M j", strtotime("+11 days", strtotime($startDate)));
$sat2 = date("M j", strtotime("+12 days", strtotime($startDate)));
$sun2 = date("M j", strtotime("+13 days", strtotime($startDate)));

// assign dates for week 3
$mon3 = date("M j", strtotime("+14 days", strtotime($startDate)));
$tue3 = date("M j", strtotime("+15 days", strtotime($startDate)));
$wed3 = date("M j", strtotime("+16 days", strtotime($startDate)));
$thu3 = date("M j", strtotime("+17 days", strtotime($startDate)));
$fri3 = date("M j", strtotime("+18 days", strtotime($startDate)));
$sat3 = date("M j", strtotime("+19 days", strtotime($startDate)));
$sun3 = date("M j", strtotime("+20 days", strtotime($startDate)));

$str_week1 = 1; $str_week2 = 2; $str_week3 = 3;
if ($weekCount == 2) {
	$str_week1 = 2; $str_week2 = 3; $str_week3 = 1;
}
else if ($weekCount == 3) {
	$str_week1 = 3; $str_week2 = 1; $str_week3 = 2;
}

?>

<!-- >>> BEGIN WEEK 1 <<< -->
<tr valign="top">
	<td class="wk">Week <?php echo $str_week1; ?><br />&nbsp;<br />
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="wk<?php echo $wkPlDwn1; ?>Status" onChange="this.form.submit();">
		<option<?= $week1 == 'Open' ? ' selected' : '' ?> value="Open">Open</option>
		<option<?= $week1 == 'Closed' ? ' selected' : '' ?> value="Closed">Closed</option>
	</select></form></td>

<!-- BEGIN DAY 1 -->
	<?php printDay($db, true, $week1, $dayOfWk, $mon1, $days[1]); ?>
<!-- END DAY 1 -->	

<!-- BEGIN DAY 2 -->
	<?php printDay($db, true, $week1, $dayOfWk, $tue1, $days[2]); ?>
<!-- END DAY 2 -->

<!-- BEGIN DAY 3 -->
	<?php printDay($db, true, $week1, $dayOfWk, $wed1, $days[3]); ?>
<!-- END DAY 3 -->

<!-- BEGIN DAY 4 -->
	<?php printDay($db, true, $week1, $dayOfWk, $thu1, $days[4]); ?>
<!-- END DAY 4 -->

<!-- BEGIN DAY 5 -->
	<?php printDay($db, true, $week1, $dayOfWk, $fri1, $days[5]); ?>
<!-- END DAY 5 -->

<!-- BEGIN DAY 6 -->
	<?php printDay($db, true, $week1, $dayOfWk, $sat1, $days[6]); ?>
<!-- END DAY 6 -->

<!-- BEGIN DAY 7 -->
	<?php printDay($db, true, $week1, $dayOfWk, $sun1, $days[7]); ?>
<!-- END DAY 7 -->
</tr>
<!-- >>> END WEEK 1 <<< -->

<!-- >>> BEGIN WEEK 2 <<< -->
<tr valign="top">
	<td class="wk">Week <?php echo $str_week2; ?><br />&nbsp;<br />
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="wk<?php echo $wkPlDwn2; ?>Status" onChange="this.form.submit();">
		<option<?= $week2 == 'Open' ? ' selected' : '' ?> value="Open">Open</option>
		<option<?= $week2 == 'Closed' ? ' selected' : '' ?> value="Closed">Closed</option>
	</select></form></td>

<!-- BEGIN DAY 8 -->
	<?php printDay($db, true, $week2, $dayOfWk, $mon2, $days[8]); ?>
<!-- END DAY 8 -->	

<!-- BEGIN DAY 9 -->
	<?php printDay($db, true, $week2, $dayOfWk, $tue2, $days[9]); ?>
<!-- END DAY 9 -->

<!-- BEGIN DAY 10 -->
	<?php printDay($db, true, $week2, $dayOfWk, $wed2, $days[10]); ?>
<!-- END DAY 10 -->

<!-- BEGIN DAY 11 -->
	<?php printDay($db, true, $week2, $dayOfWk, $thu2, $days[11]); ?>
<!-- END DAY 11 -->

<!-- BEGIN DAY 12 -->
	<?php printDay($db, true, $week2, $dayOfWk, $fri2, $days[12]); ?>
<!-- END DAY 12 -->

<!-- BEGIN DAY 13 -->
	<?php printDay($db, true, $week2, $dayOfWk, $sat2, $days[13]); ?>
<!-- END DAY 13 -->

<!-- BEGIN DAY 14 -->
	<?php printDay($db, true, $week2, $dayOfWk, $sun2, $days[14]); ?>
<!-- END DAY 14 -->
</tr>
<!-- >>> END WEEK 2 <<< -->

<!-- >>> BEGIN WEEK 3 <<< -->
<tr valign="top">
	<td class="wk">Week <?php echo $str_week3; ?><br />&nbsp;<br />
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="wk<?php echo $wkPlDwn3; ?>Status" onChange="this.form.submit();">
		<option<?= $week3 == 'Open' ? ' selected' : '' ?> value="Open">Open</option>
		<option<?= $week3 == 'Closed' ? ' selected' : '' ?> value="Closed">Closed</option>
	</select></form></td>
	
<!-- BEGIN DAY 8 -->
	<?php printDay($db, true, $week3, $dayOfWk, $mon3, $days[15]); ?>
<!-- END DAY 8 -->	

<!-- BEGIN DAY 9 -->
	<?php printDay($db, true, $week3, $dayOfWk, $tue3, $days[16]); ?>
<!-- END DAY 9 -->

<!-- BEGIN DAY 10 -->
	<?php printDay($db, true, $week3, $dayOfWk, $wed3, $days[17]); ?>
<!-- END DAY 10 -->

<!-- BEGIN DAY 11 -->
	<?php printDay($db, true, $week3, $dayOfWk, $thu3, $days[18]); ?>
<!-- END DAY 11 -->

<!-- BEGIN DAY 12 -->
	<?php printDay($db, true, $week3, $dayOfWk, $fri3, $days[19]); ?>
<!-- END DAY 12 -->

<!-- BEGIN DAY 13 -->
	<?php printDay($db, true, $week3, $dayOfWk, $sat3, $days[20]); ?>
<!-- END DAY 13 -->

<!-- BEGIN DAY 14 -->
	<?php printDay($db, true, $week3, $dayOfWk, $sun3, $days[21]); ?>
<!-- END DAY 14 -->
	
</tr>
</table>
</div>

<?php
} // END the IF for WebAuth
?>

</body>
</html>


<?php
// printDay($fri1, $days[5]);
function printDay($db, $thisWeek, $week, $dayOfWk, $strDate, $menuID){
	?>
	<td <?php if ($thisWeek && $dayOfWk == 'Friday') { echo ' bgcolor="#d0f5c4"'; } ?>><p style="text-align:right; color:#F60;"><?php echo $strDate; ?><br />&nbsp;<br /></p>
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<select name="day<?php echo $menuID; ?>Menu" onChange="this.form.submit();">
	<?php
	
		// query the day table for day 
		$day = $db->query("SELECT * FROM day WHERE id = " . $menuID . "");
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
			echo '<br /><a href="javascript:;" onclick="javascript:window.open(\'admin_menu_edit.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=1123, height=800, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_85north/images/edit.gif" width="20" height="22" alt="Edit" title="Edit" /></a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="javascript:window.open(\'admin_menu_preview.php?menu=' . $dayRow['menuID'] . '\',\'View\',\'width=1103, height=750, scrollbars=yes, resizable=yes, toolbar=yes, location=yes\')"><img src="/dining/menu_85north/images/preview.gif" width="20" height="22" alt="Preview" title="Preview" /></a>';
		}
		if ($week == 'Closed') {
			echo '<p style="margin-top:5px; color:#ff0000;">CLOSED THIS WEEK</p>';
		}
	?>
	<br />&nbsp;<br /></p></td>
	<?php
}
?>