<?php
	// connect to database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	
	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_pangea/italian/admin_menu_settings.php");

	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_pangea/worldfare/admin_menu_settings.php");

	// default text to appear when no price has been entered
	$priceText = 'TBD';
	
	// Initialize
	$menuNameRow = null;
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/dining/restaurant_menus/online_css/pangea.css">
<script type="text/javascript" src="online_menu.js"></script>

<?php
if (!isset($_GET['menuType']) || $_GET['menuType'] == 'world') {
	$italian = 'block';
	$world = 'none';
?>

<?php
} else if ($_GET['menuType'] == 'italian') {
	$italian = 'block';
	$world = 'none';
}
?>

<div class="background">
	<?php
		echo '<a id="btn-back" href="/dining/sumc/pangea" style="">RETURN TO RESTAURANT PAGE</a>';
	?>
	<div id="menu-content">

		<div id="0" style="display:<?php echo $world; ?>;">
		
			<h1>World Fare</h1>

	<?php
	if (!isset($_GET['addDays'])){ $_GET['addDays'] = 0; }
	#################################
	## BEGIN WORLD FARE MENU LOGIC ##
	#################################

	## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

	// select database
	$db = new db_mysqli("menus_pangea_worldfare");

	// query the start table to get start date
	$start = $db->query("SELECT * FROM start");
	$startRow = $start->fetch_assoc();

	// divide by the number of seconds in a day and round down to current day
	$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
	// if this is for a future date, add it to the actual days passed figure
	if (isset($_GET['addDays'])) {
		$daysPast = $daysPast + $_GET['addDays'];
	}
	// divide by the number of seconds in a week and round down to current week
	$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
	// if this is for a future date, add it to the actual weeks passed figure
	if (isset($_GET['addDays'])) {
		$plusSeconds = $_GET['addDays'] * 86400;
		$weeksPast = floor(((time()+$plusSeconds) - strtotime($startRow['startDay'])) / 604800);
	}

	## assign current dates ##
	// assign for use in menu logic
	$today = date("njY", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));
	// assign current date in format for menu display
	$todayFormatted = date("l, F j, Y", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));

	// calculate days and weeks passed
	$dayCount = $daysPast % 7; // based on a Monday start date sometime in the past; setting in db
	$weekCount = $weeksPast % 3; // based on a 3-week rotation

		// figure out which day of the week it is
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

	// calculate how many total days have past using the total number of rounded weeks
	$tmp = $weeksPast * 7;

	// figure out where to start the date count for the first Monday
	$startDate = date("M j", strtotime("+" . $tmp . " days", strtotime($startRow['startDay'])));

	// assign dates for week 1
	// the $tue1 below is how i'll probably want to show this on the actual display page for the popup editor and on the live menu page
	// $tue1 = date("l, F j, Y", strtotime("+1 days", strtotime($startDate)));
	// $mon1 = $startDate;
	$mon1 = date("njY", strtotime("+0 days", strtotime($startDate)));
	$tue1 = date("njY", strtotime("+1 days", strtotime($startDate)));
	$wed1 = date("njY", strtotime("+2 days", strtotime($startDate)));
	$thu1 = date("njY", strtotime("+3 days", strtotime($startDate)));
	$fri1 = date("njY", strtotime("+4 days", strtotime($startDate)));

	// assign dates for week 2
	$mon2 = date("njY", strtotime("+7 days", strtotime($startDate)));
	$tue2 = date("njY", strtotime("+8 days", strtotime($startDate)));
	$wed2 = date("njY", strtotime("+9 days", strtotime($startDate)));
	$thu2 = date("njY", strtotime("+10 days", strtotime($startDate)));
	$fri2 = date("njY", strtotime("+11 days", strtotime($startDate)));

	// assign dates for week 3
	$mon3 = date("njY", strtotime("+14 days", strtotime($startDate)));
	$tue3 = date("njY", strtotime("+15 days", strtotime($startDate)));
	$wed3 = date("njY", strtotime("+16 days", strtotime($startDate)));
	$thu3 = date("njY", strtotime("+17 days", strtotime($startDate)));
	$fri3 = date("njY", strtotime("+18 days", strtotime($startDate)));
	?>

	<?php

	// figure out which day of the week it is and run day-specific query (unless it's a weekend)
		switch ($today) {
		case $mon1:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day1 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $tue1:
			// query the day table for day 2
			$day = $db->query("SELECT * FROM day WHERE id = " . $day2 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $wed1:
			// query the day table for day 3
			$day = $db->query("SELECT * FROM day WHERE id = " . $day3 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $thu1:
			// query the day table for day 4
			$day = $db->query("SELECT * FROM day WHERE id = " . $day4 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $fri1:
			// query the day table for day 5
			$day = $db->query("SELECT * FROM day WHERE id = " . $day5 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $mon2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day6 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $tue2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day7 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $wed2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day8 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $thu2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day9 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $fri2:
			// query the day table for day 10
			$day = $db->query("SELECT * FROM day WHERE id = " . $day10 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $mon3:
			// query the day table for day 11
			$day = $db->query("SELECT * FROM day WHERE id = " . $day11 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $tue3:
			// query the day table for day 12
			$day = $db->query("SELECT * FROM day WHERE id = " . $day12 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $wed3:
			// query the day table for day 13
			$day = $db->query("SELECT * FROM day WHERE id = " . $day13 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $thu3:
			// query the day table for day 14
			$day = $db->query("SELECT * FROM day WHERE id = " . $day14 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $fri3:
			// query the day table for day 15
			$day = $db->query("SELECT * FROM day WHERE id = " . $day15 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
		
		}

	## END CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

	?>

	<?php
		// START THE LOGIC TO DISPLAY THE MENU INFORMATION
		
		// set counter to track empty menu items
		$noMenu = 0;

		// display the date
		echo '<div style="float:left;"><p><span id="current-date"><strong>' . $todayFormatted . '</strong></span>';
		
		// check to make sure the restaurant is open before displaying the menu name and menu
		if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
			echo '<br>';
			echo '<br><strong>CLOSED</strong></p>';
			// decide if we need to announce a day-only closure...
			if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
				echo '<p style="padding-top:14px;">We are closed today. Please visit us another time.</p></div>';
			} else { // ...or a week-long closure
				echo '<p style="padding-top:14px;">We are closed this week. Please visit us another time.</p></div>';
			}
			
			// get out of php so we can easily show the form
			?>
			<div align="center">
				<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
				<input type="hidden" name="unit" value="pangea" />
				<input type="hidden" name="menuType" value="world" />
				<select id="date-select" name="addDays" onChange="this.form.submit();">
					<option id="disabled" value="" disabled selected>View another day...</option>
					<option<?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
					<option<?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
					<option<?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>	
					<option<?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
				</select>
				</form>
			</div>
			<br clear="all" />

			<?php
			
		} else {
		
			// check price display setting and assign appropriate function name for menu display
			if ($menuNameRow['prices'] == 'Yes') {
				$displayFunction = 'full_line_item_pangea';
			} else {
				$displayFunction = 'item_only_pangea';
			}

			// should we show the menu name
			if ($menuNameRow['display'] == 'Yes') {
				echo '<br><span style="color:black;"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
			} else {
				echo '</p></div>';
			}

			// get out of php so we can easily show the form
			?>
			<div align="center">
				<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
				<input type="hidden" name="unit" value="pangea" />
				<input type="hidden" name="menuType" value="world" />
				<select id="date-select" name="addDays" onChange="this.form.submit();">
					<option id="disabled" value="" disabled selected>View another day...</option>
					<option<?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
					<option<?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
					<option<?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>	
					<option<?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
				</select>
				</form>
			</div>
			<br clear="all" />

			<?php

			############################
			## START THE MENU DISPLAY ##
			############################
			
			// BEGIN ENTREES
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $entrees . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxEntrees)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p id="sub-title">Entr&eacute;es</p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {

					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}

					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END ENTREES

			// BEGIN VEGETARIAN (aka SALADS in menu system)
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $salads . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSalads)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p id="sub-title">Vegetarian</strong></p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {

					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}

					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END VEGETARIAN (aka SALADS in menu system)

			// BEGIN GRAINS
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $grains . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxGrains)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p id="sub-title">Grains</p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {
				
					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}

					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END GRAINS

			// BEGIN VEG/FRUIT (aka SIDES in menu system)
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $sides . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSides)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p style="margin-bottom:3px;"><strong style="color:#F29332;">Veg/Fruit</strong></p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {

					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}

					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END VEG/FRUIT (aka SIDES in menu system)

			// BEGIN COMMENTS (Chef's Notes)
			// query the menu table to get comments on this menu
			$commentResult = $db->query("SELECT comments FROM menu WHERE id = " . $dayRow['menuID'] . "");

			// init counters and flags
			$display = false;
			$showHeader = false;

			while ($commentRow = $commentResult->fetch_assoc()) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $commentRow['comments'] != '') {
					echo '<p id="sub-title">Chef\'s Notes<br />';
					$showHeader = true;
				} // END IF to show header
				
				// only show the row if it is not empty
				if ($commentRow['comments'] != '') {
					echo '<span id="note">' . nl2br($commentRow['comments']) . '</span><span style=""><br />';
					echo '<br /></span><span id="comment">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} // END IF not empty
				
				// only show the closing P tag if we actually have items in the list
				if (!$showHeader && $commentRow['comments'] != '') {
					echo '</p>';
				} // END IF to show header
				
			} // END While loop
			// END COMMENTS (Chef's Notes)
			## END THE MENU DISPLAY
			
		} // END the IF for checking on restaurant closure
		
		// if we have 4 dishes w/o items, we have no menu, so let them know
		if ($noMenu == 4) {
			echo '<p>We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
			<p>Please try again later.</p>';
		}
		// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
		
	###############################
	## END WORLD FARE MENU LOGIC ##
	###############################

	?>

		</div>
		
		<div id="1" style="display:<?php echo $italian; ?>;">
			<h1 class="title">ALL-YOU-CARE-TO-EAT</h1>

	<?php

	##############################
	## BEGIN ITALIAN MENU LOGIC ##
	##############################

	## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

	// select database
	$db = new db_mysqli("menus_pangea_italian");

	// query the start table to get start date
	$start = $db->query("SELECT * FROM start");
	$startRow = $start->fetch_assoc();

	// divide by the number of seconds in a day and round down to current day
	$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
	// if this is for a future date, add it to the actual days passed figure
	if (isset($_GET['addDays'])) {
		$daysPast = $daysPast + $_GET['addDays'];
	}
	// divide by the number of seconds in a week and round down to current week
	$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
	// if this is for a future date, add it to the actual weeks passed figure
	if (isset($_GET['addDays'])) {
		$plusSeconds = $_GET['addDays'] * 86400;
		$weeksPast = floor(((time()+$plusSeconds) - strtotime($startRow['startDay'])) / 604800);
	}

	## assign current dates ##
	// assign for use in menu logic
	$today = date("njY", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));
	// assign current date in format for menu display
	$todayFormatted = date("l, F j, Y", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));

	// calculate days and weeks passed
	$dayCount = $daysPast % 7; // based on a Monday start date sometime in the past; setting in db
	$weekCount = $weeksPast % 3; // based on a 3-week rotation

		// figure out which day of the week it is
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

	// calculate how many total days have past using the total number of rounded weeks
	$tmp = $weeksPast * 7;

	// figure out where to start the date count for the first Monday
	$startDate = date("M j", strtotime("+" . $tmp . " days", strtotime($startRow['startDay'])));

	// assign dates for week 1
	// the $tue1 below is how i'll probably want to show this on the actual display page for the popup editor and on the live menu page
	// $tue1 = date("l, F j, Y", strtotime("+1 days", strtotime($startDate)));
	// $mon1 = $startDate;
	$mon1 = date("njY", strtotime("+0 days", strtotime($startDate)));
	$tue1 = date("njY", strtotime("+1 days", strtotime($startDate)));
	$wed1 = date("njY", strtotime("+2 days", strtotime($startDate)));
	$thu1 = date("njY", strtotime("+3 days", strtotime($startDate)));
	$fri1 = date("njY", strtotime("+4 days", strtotime($startDate)));

	// assign dates for week 2
	$mon2 = date("njY", strtotime("+7 days", strtotime($startDate)));
	$tue2 = date("njY", strtotime("+8 days", strtotime($startDate)));
	$wed2 = date("njY", strtotime("+9 days", strtotime($startDate)));
	$thu2 = date("njY", strtotime("+10 days", strtotime($startDate)));
	$fri2 = date("njY", strtotime("+11 days", strtotime($startDate)));

	// assign dates for week 3
	$mon3 = date("njY", strtotime("+14 days", strtotime($startDate)));
	$tue3 = date("njY", strtotime("+15 days", strtotime($startDate)));
	$wed3 = date("njY", strtotime("+16 days", strtotime($startDate)));
	$thu3 = date("njY", strtotime("+17 days", strtotime($startDate)));
	$fri3 = date("njY", strtotime("+18 days", strtotime($startDate)));
	?>

	<?php

	// figure out which day of the week it is and run day-specific query (unless it's a weekend)
		switch ($today) {
		case $mon1:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day1 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $tue1:
			// query the day table for day 2
			$day = $db->query("SELECT * FROM day WHERE id = " . $day2 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $wed1:
			// query the day table for day 3
			$day = $db->query("SELECT * FROM day WHERE id = " . $day3 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $thu1:
			// query the day table for day 4
			$day = $db->query("SELECT * FROM day WHERE id = " . $day4 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $fri1:
			// query the day table for day 5
			$day = $db->query("SELECT * FROM day WHERE id = " . $day5 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
			
		case $mon2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day6 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $tue2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day7 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $wed2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day8 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $thu2:
			// query the day table for day 1
			$day = $db->query("SELECT * FROM day WHERE id = " . $day9 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $fri2:
			// query the day table for day 10
			$day = $db->query("SELECT * FROM day WHERE id = " . $day10 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $mon3:
			// query the day table for day 11
			$day = $db->query("SELECT * FROM day WHERE id = " . $day11 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $tue3:
			// query the day table for day 12
			$day = $db->query("SELECT * FROM day WHERE id = " . $day12 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $wed3:
			// query the day table for day 13
			$day = $db->query("SELECT * FROM day WHERE id = " . $day13 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $thu3:
			// query the day table for day 14
			$day = $db->query("SELECT * FROM day WHERE id = " . $day14 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;

		case $fri3:
			// query the day table for day 15
			$day = $db->query("SELECT * FROM day WHERE id = " . $day15 . "");
			$dayRow = $day->fetch_assoc();
			// query the menu table to figure out the name of the menu based on the menu ID for this day
			$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
			$menuNameRow = $menuName->fetch_assoc();
			break;
		
		}

	## END CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

	?>

	<?php
		// START THE LOGIC TO DISPLAY THE MENU INFORMATION
		
		// set counter to track empty menu items
		$noMenu = 0;

		// display the date
		echo '<div align="center"><p><span id="current-date">' . $todayFormatted . '</span>';
		
		// check to make sure the restaurant is open before displaying the menu name and menu
		if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
			echo '<br>';
			echo '<br><strong>CLOSED</strong></p>';
			// decide if we need to announce a day-only closure...
			if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
				echo '<p style="padding-top:14px;">We are closed today. Please visit us another time.</p></div>';
			} else { // ...or a week-long closure
				echo '<p style="padding-top:14px;">We are closed this week. Please visit us another time.</p></div>';
			}
			
			// get out of php so we can easily show the form
			?>
			<div align="center">
				<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
				<input type="hidden" name="unit" value="pangea" />
				<input type="hidden" name="menuType" value="italian" />
				<select id="date-select" name="addDays" onChange="this.form.submit();">
					<option id="disabled" value="" disabled selected>View another day...</option>
					<option<?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
					<option<?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
					<option<?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>	
					<option<?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
				</select>
				
				</form>
			</div>
			<br clear="all" />

			<?php
			
		} else {

			// check price display setting and assign appropriate function name for menu display
			if ($menuNameRow['prices'] == 'Yes') {
				$displayFunction = 'full_line_item_pangea';
			} else {
				$displayFunction = 'item_only_pangea';
			}

			// should we show the menu name
			if ($menuNameRow['display'] == 'Yes') {
				echo '<br><span style="color:black;"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
			} else {
				echo '</p></div>';
			}

			// get out of php so we can easily show the form
			?>
			<div align="center">
				<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
				<input type="hidden" name="unit" value="pangea" />
				<input type="hidden" name="menuType" value="italian" />
				<select id="date-select" name="addDays" onChange="this.form.submit();">
					<option id="disabled" value="" disabled selected>View another day...</option>
					<option<?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
					<option<?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
					<option<?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>	
					<option<?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
					<option<?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
				</select>
				</form>
			</div>
			<br clear="all" />

			<?php

			############################
			## START THE MENU DISPLAY ##
			############################
			
			// BEGIN ENTREES
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $entrees . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxEntrees)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p id="sub-title">Entr&eacute;es</p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {
				
					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}

					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END ENTREES

			// BEGIN VEGETARIAN (aka SALADS in menu system)
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $salads . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSalads)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p id="sub-title">Vegetarian</strong></p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {
				
					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}

					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END VEGETARIAN (aka SALADS in menu system)

			// BEGIN GRAINS
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $grains . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxGrains)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p id="sub-title">Grains</strong></p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {
				
					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}

					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END GRAINS

			// BEGIN VEGETABLE (aka SIDES in menu system)
			// query the item table to get all the Entrees on this menu
			$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $sides . " ORDER BY id");

			// init counters and flags
			$count = 1;
			$display = false;
			$showHeader = false;

			while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSides)) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $itemRow['name'] != '') {
					echo '<p id="sub-title">Vegetable</p>';
					$showHeader = true;
				} // END IF to show header

				// only show the row if it is not empty
				if ($itemRow['name'] != '') {

					// if no price is entered, display using predefined setting
					if (!$itemRow['price']) {
						$itemRow['price'] = $priceText;
					}
				
					echo $displayFunction($itemRow['name'], '', $itemRow['price']);
					
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} else if ($count == 1) {
					$noMenu++;
				} // END IF not empty
				$count++;
				
			} // END While loop
			// END VEGETABLE (aka SIDES in menu system)

			// BEGIN COMMENTS (Chef's Notes)
			// query the menu table to get comments on this menu
			$commentResult = $db->query("SELECT comments FROM menu WHERE id = " . $dayRow['menuID'] . "");

			// init counters and flags
			$display = false;
			$showHeader = false;

			while ($commentRow = $commentResult->fetch_assoc()) {
				// if we haven't shown the header and this category is not blank, show the header
				if (!$showHeader && $commentRow['comments'] != '') {
					echo '<p id="sub-title">Chef\'s Notes<br />';
					$showHeader = true;
				} // END IF to show header
				
				// only show the row if it is not empty
				if ($commentRow['comments'] != '') {
					echo '<span id="note">' . nl2br($commentRow['comments']) . '</span><span style=""><br />';
					echo '<br /></span><span id="comment">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
					$display = true;
				// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
				} // END IF not empty
				
				// only show the closing P tag if we actually have items in the list
				if (!$showHeader && $commentRow['comments'] != '') {
					echo '</p>';
				} // END IF to show header
				
			} // END While loop
			// END COMMENTS (Chef's Notes)
			## END THE MENU DISPLAY
			
		} // END the IF for checking on restaurant closure
		
		// if we have 4 dishes w/o items, we have no menu, so let them know
		if ($noMenu == 4) {
			echo '<p>We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
			<p>Please try again later.</p>';
		}
		// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
		
	############################
	## END ITALIAN MENU LOGIC ##
	############################

	?>

		</div><!-- /1 -->
		
		<div id="2" style="display:none;">
		
			<h1>Sushi</h1>
			<div style="float: left; width: 270px">
				<h2>Rolls</h2>
				<?php
					full_line_item_pangea_sushi('Spicy Tuna Roll', 'Yellowfin Tuna, Mayo, Sriracha, Chili Oil and Sambal', '5.95');
					full_line_item_pangea_sushi('Salmon Poke Roll', 'Skuna Bay Salmon', '5.95');
					full_line_item_pangea_sushi('Veggie Roll', 'Cucumber, Carrots, Avocado and Takuan', '4.95');
					full_line_item_pangea_sushi('California Roll', 'Surimi Crab Meat, Avocado and Cucumber', '5.65');
					full_line_item_pangea_sushi('Wildcat Roll', 'Surimi Crab Meat, Avocado and Cucumber shrimp furikake', '7.95');
					full_line_item_pangea_sushi('Rainbow Roll', 'Surimi Cucumber Avocado Salmon Shrimp Tuna', '8.75');
					full_line_item_pangea_sushi('Dragon', 'surimi cucumber avocado eel', '8.95');
					full_line_item_pangea_sushi('Philie Roll', 'Cream cheese cucumber surimi', '5.95');
				?>
			</div>
			<div style="float: left; width: 270px">
				<h2>Rolls (continued)</h2>
				<?php
					full_line_item_pangea_sushi('Surimi roll', 'Surimi crab', '5.65');
					full_line_item_pangea_sushi('Wontadas', 'Wonton ebi surimi cucumber avocado salt spicy mayo lemon juice', '5.95');
					full_line_item_pangea_sushi('Catapillar roll', 'Surimi avocado furikake eel sauce', '6.75');
				?>

				<h2>Nigiri</h2>
				<?php
					full_line_item_pangea_sushi('Skuna Bay Salmon', 'Skuna Bay Salmon, Teriyaki Glaze and Furikake', '5.25');
					full_line_item_pangea_sushi('Unagi Kabayaki', 'Japanese Fresh Water Eel and Teriyaki Sauce', '5.95');
					full_line_item_pangea_sushi('Ebi', 'Shrimp and Furikake  eel sauce', '6.50');
					full_line_item_pangea_sushi('Squid Salad', '', '3.75');
					full_line_item_pangea_sushi('Seaweed Salad', '', '2.75');
					full_line_item_pangea_sushi('Edamame', '', '2.55');
				?>
			</div>
		</div><!-- /2 -->
	</div><!-- /menu-content -->
</div>