<?php
	// connect to database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	
	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_85north/admin_menu_settings.php");

	// default text to appear when no price has been entered
	$priceText = 'TBD';
	
	// Initialize
	$menuNameRow = null;
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!----><link rel="stylesheet" type="text/css" href="/dining/restaurant_menus/online_css/pangea.css"> 
<link rel="stylesheet" type="text/css" href="/dining/restaurant_menus/online_css/85north.css">
<script type="text/javascript" src="online_menu.js"></script>

<img src="/template/images/banners/85north.jpg" class="banner">

<div class="background">
	<?php
		echo '<a id="btn-back" href="/dining/other/85north" style="">RETURN TO RESTAURANT PAGE</a>';
	?>
	<div id="menu-content" style="overflow-y: scroll; overflow-x: hidden; height: 1196px;">

		<div id="0" style="display:block;">
		
			<!-- <h1>World Fare</h1> -->

	<?php
	if (!isset($_GET['addDays'])){ $_GET['addDays'] = 0; }
	#################################
	## BEGIN WORLD FARE MENU LOGIC ##
	#################################

	## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

	// select database
	$db = new db_mysqli("menus_85north");

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

	// calculate how many total days have past using the total number of rounded weeks
	$tmp = $weeksPast * 7;

	// figure out where to start the date count for the first Monday
	$startDate = date("M j", strtotime("+" . $tmp . " days", strtotime($startRow['startDay'])));

	// assign dates for week 1
	// the $tue1 below is how i'll probably want to show this on the actual display page for the popup editor and on the live menu page
	// $tue1 = date("l, F j, Y", strtotime("+1 days", strtotime($startDate)));
	// $mon1 = $startDate;
	?>

	<?php
	$mj_today = date("M j", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));
	$day_diff = date_diff(date_create($startDate), date_create($mj_today))->d;
	// var_dump($day_diff);

	// query the day table
	$day = $db->query("SELECT * FROM day WHERE id = " . $days[$day_diff+1] . "");
	$dayRow = $day->fetch_assoc();
	// query the menu table to figure out the name of the menu based on the menu ID for this day
	$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
	$menuNameRow = $menuName->fetch_assoc();


	?>

	<?php
		// START THE LOGIC TO DISPLAY THE MENU INFORMATION
		
		// set counter to track empty menu items
		$noMenu = 0;

		// display the date
		echo '<div style="float:left; text-align: center;"><p><span id="current-date"><strong>' . $todayFormatted . '</strong></span>';
		
		// check to make sure the restaurant is open before displaying the menu name and menu
		if ($menuNameRow['name'] == 'Closed' /*|| $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday'*/ || $week1 == 'Closed') {
			echo '<br>';
			echo '<br><strong>CLOSED</strong></p>';
			// decide if we need to announce a day-only closure...
			if ($week1 != 'Closed' /*|| $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday'*/) {
				echo '<p style="padding-top:14px;">We are closed today. Please visit us another time.</p></div>';
			} else { // ...or a week-long closure
				echo '<p style="padding-top:14px;">We are closed this week. Please visit us another time.</p></div>';
			}
			
			// get out of php so we can easily show the form
			?>
			<div align="center">
				<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
				<input type="hidden" name="unit" value="85north" />
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
				$displayFunction = 'full_line_item_85north';
			} else {
				$displayFunction = 'item_only_85north';
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
				<input type="hidden" name="unit" value="85north" />
				<!-- <input type="hidden" name="menuType" value="world" /> -->
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
			
			$itemID = 1;
			if(checkMenuSize($db, $dayRow['menuID'], $itemID, $bk) != 0) {
				echo '<center><h2><u>Breakfast</u></h2></center>';
				foreach($bk as $key => $value) {
					$noMenu += displayMenu($db, $dayRow['menuID'], $itemID, $value, $key);
					$itemID += 4;
				}
			}
			$itemID = 2;
			if(checkMenuSize($db, $dayRow['menuID'], $itemID, $lunch) != 0) {
				echo '<center><h2><u>Lunch</u></h2></center>';
				foreach($lunch as $key => $value) {
					$noMenu += displayMenu($db, $dayRow['menuID'], $itemID, $value, $key);
					$itemID += 4;
				}
			}
			$itemID = 3;
			if(checkMenuSize($db, $dayRow['menuID'], $itemID, $dinner) != 0) {
				echo '<center><h2><u>Dinner</u></h2></center>';
				foreach($dinner as $key => $value) {
					$noMenu += displayMenu($db, $dayRow['menuID'], $itemID, $value, $key);
					$itemID += 4;
				}
			}
			$itemID = 4;
			if(checkMenuSize($db, $dayRow['menuID'], $itemID, $br) != 0) {
				echo '<center><h2><u>Brunch</u></h2></center>';
				foreach($br as $key => $value) {
					$noMenu += displayMenu($db, $dayRow['menuID'], $itemID, $value, $key);
					$itemID += 4;
				}
			}

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

		</div><!-- /1 -->
		
		
	</div><!-- /menu-content -->
</div>

<?php
function displayMenu($db, $menuID, $dishID, $max, $title) {
	// query the item table to get all the Entrees on this menu
	$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $menuID . " AND dishID = " . $dishID . " ORDER BY id");

	// init counters and flags
	$noMenu = 0;
	$count = 1;
	$display = false;
	$showHeader = false;

	while (($itemRow = $itemResult->fetch_assoc()) && ($count <= $max)) {
		// if we haven't shown the header and this category is not blank, show the header
		if (!$showHeader && $itemRow['name'] != '') {
			echo '<p id="sub-title">'.$title.'</p>';
			$showHeader = true;
		} // END IF to show header

		// only show the row if it is not empty
		if ($itemRow['name'] != '') {

			// if no price is entered, display using predefined setting
			if (!$itemRow['price']) {
				$itemRow['price'] = '';
			}

			echo item_only_pangea($itemRow['name'], '', $itemRow['price']);
			
			$display = true;
		// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
		} else if ($count == 1) {
			$noMenu = 1;
		} // END IF not empty
		$count++;
		
	} // END While loop

	return $noMenu;
}

function getMenuItemSize($db, $menuID, $dishID, $max, $title) {
	// query the item table to get all the Entrees on this menu
	$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $menuID . " AND dishID = " . $dishID . " ORDER BY id");

	// init counters and flags
	$noMenu = 0;
	$count = 1;
	$display = false;
	$showHeader = false;
	$ret = 0;

	while (($itemRow = $itemResult->fetch_assoc()) && ($count <= $max)) {
		// only show the row if it is not empty
		if ($itemRow['name'] != '') {
			$ret += 1;
		// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
		} else if ($count == 1) {
			$noMenu = 1;
		} // END IF not empty
		$count++;
		
	} // END While loop

	return $ret;
}

function checkMenuSize($db, $menuID, $dishID, $menu) {
	$ret = 0;
	foreach($menu as $key => $value) {
		$ret += getMenuItemSize($db, $menuID, $dishID, $value, $key);
		$dishID += 4;
	}

	return $ret;
}
?>