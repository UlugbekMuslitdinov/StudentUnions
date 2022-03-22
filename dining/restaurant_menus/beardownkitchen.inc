<?php
	// connect to database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	
	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_bdk/breakfast/admin_menu_settings.php");

	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_bdk/grill/admin_menu_settings.php");

	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_bdk/lunch/admin_menu_settings.php");

	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_bdk/pizza/admin_menu_settings.php");

	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_bdk/salad/admin_menu_settings.php");

	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_bdk/saute/admin_menu_settings.php");

	// default text to appear when no price has been entered
	$priceText = 'TBD';
	
?>

<link rel="stylesheet" type="text/css" href="/dining/restaurant_menus/online_css/beardownkitchen.css">
<script type="text/javascript" src="online_menu.js"></script>

<?php // sticky menus and navigation
if (!isset($_GET['menuType']) || $_GET['menuType'] == 'breakfast') {
	$breakfast = 'block';
	$grill = 'none';
	$lunch = 'none';
	$pizza = 'none';
	$salad = 'none';
	$saute = 'none';
?>
<div class="background" style="position:relative;">
	<?php
		echo '<a id="btn-back" href="/dining/other/beardownkitchen" style="">RETURN TO RESTAURANT PAGE</a>';
	?>
	<div id="nav" align="center"> 
	    	<span name="nav" class="active" onclick="show('0')" id="0-link">BREAKFAST</span>
	    	<span name="nav" onclick="show('1')" id="1-link">GRILL & DELI</span>
	    	<span name="nav" onclick="show('2')" id="2-link">LUNCH</span>
	    	<span name="nav" onclick="show('3')" id="3-link">PIZZA</span>
	    	<span name="nav" onclick="show('4')" id="4-link">SALAD BAR</span>
   	    	<span name="nav" onclick="show('5')" id="5-link">PASTA/STIR-FRY</span>
		<script>var current='0';</script>
	</div>
<?php
} else if ($_GET['menuType'] == 'grill') {
	$breakfast = 'none';
	$grill = 'block';
	$lunch = 'none';
	$pizza = 'none';
	$salad = 'none';
	$saute = 'none';
?>
	<div id="nav" align="center"> 
			<span name="nav" class="active" onclick="show('0')" id="0-link">BREAKFAST</span>
	    	<span name="nav" onclick="show('1')" id="1-link">GRILL & DELI</span>
	    	<span name="nav" onclick="show('2')" id="2-link">LUNCH</span>
	    	<span name="nav" onclick="show('3')" id="3-link">PIZZA</span>
	    	<span name="nav" onclick="show('4')" id="4-link">SALAD BAR</span>
   	    	<span name="nav" onclick="show('5')" id="5-link">PASTA/STIR-FRY</span>
		<script>var current='1';</script>
	</div>
<?php
} else if ($_GET['menuType'] == 'lunch') {
	$breakfast = 'none';
	$grill = 'none';
	$lunch = 'block';
	$pizza = 'none';
	$salad = 'none';
	$saute = 'none';
?>
	<div id="nav" align="center"> 
			<span name="nav" class="active" onclick="show('0')" id="0-link">BREAKFAST</span>
	    	<span name="nav" onclick="show('1')" id="1-link">GRILL & DELI</span>
	    	<span name="nav" onclick="show('2')" id="2-link">LUNCH</span>
	    	<span name="nav" onclick="show('3')" id="3-link">PIZZA</span>
	    	<span name="nav" onclick="show('4')" id="4-link">SALAD BAR</span>
   	    	<span name="nav" onclick="show('5')" id="5-link">PASTA/STIR-FRY</span>
		<script>var current='2';</script>
	</div>
<?php
} else if ($_GET['menuType'] == 'pizza') {
	$breakfast = 'none';
	$grill = 'none';
	$lunch = 'none';
	$pizza = 'block';
	$salad = 'none';
	$saute = 'none';
?>
	<div id="nav" align="center"> 
			<span name="nav" class="active" onclick="show('0')" id="0-link">BREAKFAST</span>
	    	<span name="nav" onclick="show('1')" id="1-link">GRILL & DELI</span>
	    	<span name="nav" onclick="show('2')" id="2-link">LUNCH</span>
	    	<span name="nav" onclick="show('3')" id="3-link">PIZZA</span>
	    	<span name="nav" onclick="show('4')" id="4-link">SALAD BAR</span>
   	    	<span name="nav" onclick="show('5')" id="5-link">PASTA/STIR-FRY</span>
		<script>var current='3';</script>
	</div>
<?php
} else if ($_GET['menuType'] == 'salad') {
	$breakfast = 'none';
	$grill = 'none';
	$lunch = 'none';
	$pizza = 'none';
	$salad = 'block';
	$saute = 'none';
?>
	<div id="nav" align="center"> 
			<span name="nav" class="active" onclick="show('0')" id="0-link">BREAKFAST</span>
	    	<span name="nav" onclick="show('1')" id="1-link">GRILL & DELI</span>
	    	<span name="nav" onclick="show('2')" id="2-link">LUNCH</span>
	    	<span name="nav" onclick="show('3')" id="3-link">PIZZA</span>
	    	<span name="nav" onclick="show('4')" id="4-link">SALAD BAR</span>
   	    	<span name="nav" onclick="show('5')" id="5-link">PASTA/STIR-FRY</span>
		<script>var current='4';</script>
	</div>
<?php
} else if ($_GET['menuType'] == 'saute') {
	$breakfast = 'none';
	$grill = 'none';
	$lunch = 'none';
	$pizza = 'none';
	$salad = 'none';
	$saute = 'block';
?>
	<div id="nav" align="center"> 
			<span name="nav" class="active" onclick="show('0')" id="0-link">BREAKFAST</span>
	    	<span name="nav" onclick="show('1')" id="1-link">GRILL & DELI</span>
	    	<span name="nav" onclick="show('2')" id="2-link">LUNCH</span>
	    	<span name="nav" onclick="show('3')" id="3-link">PIZZA</span>
	    	<span name="nav" onclick="show('4')" id="4-link">SALAD BAR</span>
   	    	<span name="nav" onclick="show('5')" id="5-link">PASTA/STIR-FRY</span>
		<script>var current='5';</script>
	</div>
<?php
}
?>

<div class="menu-content">

	<!-- <div id="desc" >
		<p style="font-size:12px;">Offering buffet-style options, and made-to-order breakfast and lunch, a pizza oven, salad bar, deli, pasta/stir-fry and grill stations, a full beverage station, panoramic mountain and stadium views and much more!</p>
		Lunch is $12.50 and includes the standard lunch menu, grill & deli, pizza, salad bar and pasta/stir-fry options.
	</div> -->

	<!-- sticky menus / see code starting on line 13  -->
	<div id="0" style="display:<?php echo $breakfast; ?>;">
	
    	<h1 id="title">Breakfast: $8.75</h1>

<?php

################################
## BEGIN BREAKFAST MENU LOGIC ##
################################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_bdk_breakfast");

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
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
		$day16 = 16;
		$day17 = 17;
		$day18 = 18;
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
		$day1 = 7;
		$day2 = 8;
		$day3 = 9;
		$day4 = 10;
		$day5 = 11;
		$day6 = 12;
		$day7 = 13;
		$day8 = 14;
		$day9 = 15;
		$day10 = 16;
		$day11 = 17;
		$day12 = 18;
		$day13 = 1;
		$day14 = 2;
		$day15 = 3;
		$day16 = 4;
		$day17 = 5;
		$day18 = 6;
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
		$day1 = 13;
		$day2 = 14;
		$day3 = 15;
		$day4 = 16;
		$day5 = 17;
		$day6 = 18;
		$day7 = 1;
		$day8 = 2;
		$day9 = 3;
		$day10 = 4;
		$day11 = 5;
		$day12 = 6;
		$day13 = 7;
		$day14 = 8;
		$day15 = 9;
		$day16 = 10;
		$day17 = 11;
		$day18 = 12;
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
$sun1 = date("njY", strtotime("+6 days", strtotime($startDate)));

// assign dates for week 2
$mon2 = date("njY", strtotime("+7 days", strtotime($startDate)));
$tue2 = date("njY", strtotime("+8 days", strtotime($startDate)));
$wed2 = date("njY", strtotime("+9 days", strtotime($startDate)));
$thu2 = date("njY", strtotime("+10 days", strtotime($startDate)));
$fri2 = date("njY", strtotime("+11 days", strtotime($startDate)));
$sun2 = date("njY", strtotime("+13 days", strtotime($startDate)));

// assign dates for week 3
$mon3 = date("njY", strtotime("+14 days", strtotime($startDate)));
$tue3 = date("njY", strtotime("+15 days", strtotime($startDate)));
$wed3 = date("njY", strtotime("+16 days", strtotime($startDate)));
$thu3 = date("njY", strtotime("+17 days", strtotime($startDate)));
$fri3 = date("njY", strtotime("+18 days", strtotime($startDate)));
$sun3 = date("njY", strtotime("+20 days", strtotime($startDate)));
?>

<?php
$menuNameRow = null;
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
		
    case $sun1:
		// query the day table for day 6
		$day = $db->query("SELECT * FROM day WHERE id = " . $day6 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;
		
    case $mon2:
		// query the day table for day 7
		$day = $db->query("SELECT * FROM day WHERE id = " . $day7 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue2:
		// query the day table for day 8
		$day = $db->query("SELECT * FROM day WHERE id = " . $day8 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed2:
		// query the day table for day 9
		$day = $db->query("SELECT * FROM day WHERE id = " . $day9 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu2:
		// query the day table for day 10
		$day = $db->query("SELECT * FROM day WHERE id = " . $day10 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri2:
		// query the day table for day 11
		$day = $db->query("SELECT * FROM day WHERE id = " . $day11 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $sun2:
		// query the day table for day 12
		$day = $db->query("SELECT * FROM day WHERE id = " . $day12 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $mon3:
		// query the day table for day 13
		$day = $db->query("SELECT * FROM day WHERE id = " . $day13 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue3:
		// query the day table for day 14
		$day = $db->query("SELECT * FROM day WHERE id = " . $day14 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed3:
		// query the day table for day 15
		$day = $db->query("SELECT * FROM day WHERE id = " . $day15 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu3:
		// query the day table for day 16
		$day = $db->query("SELECT * FROM day WHERE id = " . $day16 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri3:
		// query the day table for day 17
		$day = $db->query("SELECT * FROM day WHERE id = " . $day17 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $sun3:
		// query the day table for day 18
		$day = $db->query("SELECT * FROM day WHERE id = " . $day18 . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;
	
	}

## END CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##
if (!isset($_GET['addDays'])){
	$_GET['addDays'] = '0';
}
?>

<div align="center" style="padding:5px 0 0 20px;">
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
	<input type="hidden" name="unit" value="beardownkitchen" />
	<input type="hidden" name="menuType" value="breakfast" />
	<select name="addDays" onChange="this.form.submit();">
		<option value="" disabled selected>View another day...</option>
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
<!-- <br clear="all" /> -->

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION
	
	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="date-selected">' . $todayFormatted . '</span>';
	
	if ($menuNameRow == null){ $noMenu = 4; }

	if ($menuNameRow != null){
		// check to make sure the restaurant is open before displaying the menu name and menu
		if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $week1 == 'Closed') {
			echo '<p><strong>Closed</strong></p>';
			// decide if we need to announce a day-only closure...
			if ($week1 != 'Closed' || $dayOfWk == 'Saturday') {
				echo '<p style="padding-top:14px; font-size:24px;">We are closed today. Please visit us another time.</p></div>';
			} else { // ...or a week-long closure
				echo '<p style="padding-top:14px; font-size:24px;">We are closed this week. Please visit us another time.</p></div>';
			}
						
		} else {
		
			// check price display setting and assign appropriate function name for menu display
			if ($menuNameRow['prices'] == 'Yes') {
				$displayFunction = 'full_line_item_bdk';
			} else {
				$displayFunction = 'item_only_bdk';
			}

			// should we show the menu name
			if ($menuNameRow['display'] == 'Yes') {
				echo '  ' . '<span id="menu-name"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
			} else {
				echo '</p></div>';
			}

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
					echo '<h1 id="title">Today\'s Options</strong></h1>';
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
					echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Vegetarian</strong></p>';
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
					echo '<h1 id="title">Grains</strong></h1>';
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
					echo '<h1 id="title">Veg/Fruit</strong></h1>';
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
					echo '<p id="note"><strong>CHEF\'S NOTES</strong><br />';
					$showHeader = true;
				} // END IF to show header
				
				// only show the row if it is not empty
				if ($commentRow['comments'] != '') {
					echo '<span style="font-size:16px; font-weight: normal;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
					echo '<br /></span><span style="font-size:16px; color:#cccccc; font-style:italic; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
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
	} // End of $menuNameRow not null
	
	// if we have 4 dishes w/o items, we have no menu, so let them know
	if ($noMenu == 4) {
		echo '<p style="width:800px; margin-left:6%; font-size:24px;">We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
	
##############################
## END BREAKFAST MENU LOGIC ##
##############################

?>

	</div></div><!-- /0 -->
	
	<!-- sticky menus / see code starting on line 13  -->
	<div id="1" class="menu-content" style="display:<?php echo $grill; ?>; margin-top: 0%;">
    	<h1 id="title">Grill & Deli</h1>

<?php

###################################
## BEGIN GRILL & DELI MENU LOGIC ##
###################################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_bdk_grill");

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
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
if (!isset($_GET['addDays'])){
	$_GET['addDays'] = '0';
}	
?>

<div align="center" style="padding:5px 0 0 20px;">
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
	<input type="hidden" name="unit" value="beardownkitchen" />
	<input type="hidden" name="menuType" value="breakfast" />
	<select name="addDays" onChange="this.form.submit();">
		<option value="" disabled selected>View another day...</option>
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
<!-- <br clear="all" /> -->

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION
	
	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="date-selected">' . $todayFormatted . '</span>';
	
	// check to make sure the restaurant is open before displaying the menu name and menu
	if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
		echo '<p><strong>Closed</strong></p>';
		// decide if we need to announce a day-only closure...
		if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
			echo '<p style="padding-top:14px; font-size:24px;">We are closed today. Please visit us another time.</p></div>';
		} else { // ...or a week-long closure
			echo '<p style="padding-top:14px; font-size:24px;">We are closed this week. Please visit us another time.</p></div>';
		}
		
	} else {

		// check price display setting and assign appropriate function name for menu display
		if ($menuNameRow['prices'] == 'Yes') {
			$displayFunction = 'full_line_item_bdk';
		} else {
			$displayFunction = 'item_only_bdk';
		}

		// should we show the menu name
		if ($menuNameRow['display'] == 'Yes') {
			echo '  ' . '<span id="menu-name"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
		} else {
			echo '</p></div>';
		}

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
				echo '<h1 id="title">Today\'s Options</h1>';
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
				echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Vegetarian</strong></p>';
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
				echo '<h1 id="title">Grains</strong></h1>';
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
				echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Vegetable</strong></p>';
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
				echo '<p id="note"><strong>CHEF\'S NOTES</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<span style="font-size:16px; font-weight: normal;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
				echo '<br /></span><span style="font-size:16px; color:#cccccc; font-style:italic; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
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
		echo '<p style="width:800px; margin-left:6%; font-size:24px;">We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
	
#################################
## END GRILL & DELI MENU LOGIC ##
#################################

?>

	</div><!-- /1 -->

	<!-- sticky menus / see code starting on line 13  -->
	<div id="2" class="menu-content" style="display:<?php echo $lunch; ?>; margin-top: 0%">
    	<h1 id="title">Lunch</h1>

<?php

############################
## BEGIN LUNCH MENU LOGIC ##
############################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_bdk_lunch");

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
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
if (!isset($_GET['addDays'])){
	$_GET['addDays'] = '0';
}	
?>

<div align="center" style="padding:5px 0 0 20px;">
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
	<input type="hidden" name="unit" value="beardownkitchen" />
	<input type="hidden" name="menuType" value="breakfast" />
	<select name="addDays" onChange="this.form.submit();">
		<option value="" disabled selected>View another day...</option>
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
<!-- <br clear="all" /> -->

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION
	
	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="date-selected">' . $todayFormatted . '</span>';
	
	// check to make sure the restaurant is open before displaying the menu name and menu
	if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
		echo '<p><strong>Closed</strong></p>';
		// decide if we need to announce a day-only closure...
		if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
			echo '<p style="padding-top:14px; font-size:24px;">We are closed today. Please visit us another time.</p></div>';
		} else { // ...or a week-long closure
			echo '<p style="padding-top:14px; font-size:24px;">We are closed this week. Please visit us another time.</p></div>';
		}
		
	} else {

		// check price display setting and assign appropriate function name for menu display
		if ($menuNameRow['prices'] == 'Yes') {
			$displayFunction = 'full_line_item_bdk';
		} else {
			$displayFunction = 'item_only_bdk';
		}

		// should we show the menu name
		if ($menuNameRow['display'] == 'Yes') {
			echo '  ' . '<span id="menu-name"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
		} else {
			echo '</p></div>';
		}

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
				echo '<h1 id="title">Today\'s Options</h1>';
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
				echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Vegetarian</strong></p>';
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
				echo '<h1 id="title">Grains</strong></h1>';
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
				echo '<h1 id="title">Vegetable</strong></h1>';
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
				echo '<p id="note"><strong>CHEF\'S NOTES</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<span style="font-size:16px; font-weight: normal;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
				echo '<br /></span><span style="font-size:16px; color:#cccccc; font-style:italic; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
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
		echo '<p style="width:800px; margin-left:6%; font-size:24px;">We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
	
##########################
## END LUNCH MENU LOGIC ##
##########################

?>

	</div><!-- /2 -->

	<!-- sticky menus / see code starting on line 13  -->
	<div id="3" class="menu-content" style="display:<?php echo $pizza; ?>; margin-top: 0%;">
    	<h1 id="title">Pizza</h1>

<?php

############################
## BEGIN PIZZA MENU LOGIC ##
############################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_bdk_pizza");

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
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
if (!isset($_GET['addDays'])){
	$_GET['addDays'] = '0';
}	
?>

<div align="center" style="padding:5px 0 0 20px;">
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
	<input type="hidden" name="unit" value="beardownkitchen" />
	<input type="hidden" name="menuType" value="breakfast" />
	<select name="addDays" onChange="this.form.submit();">
		<option value="" disabled selected>View another day...</option>
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
<!-- <br clear="all" /> -->

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION
	
	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="date-selected">' . $todayFormatted . '</span>';
	
	// check to make sure the restaurant is open before displaying the menu name and menu
	if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
		echo '<p><strong>Closed</strong></p>';
		// decide if we need to announce a day-only closure...
		if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
			echo '<p style="padding-top:14px; font-size:24px;">We are closed today. Please visit us another time.</p></div>';
		} else { // ...or a week-long closure
			echo '<p style="padding-top:14px; font-size:24px;">We are closed this week. Please visit us another time.</p></div>';
		}
		
	} else {

		// check price display setting and assign appropriate function name for menu display
		if ($menuNameRow['prices'] == 'Yes') {
			$displayFunction = 'full_line_item_bdk';
		} else {
			$displayFunction = 'item_only_bdk';
		}

		// should we show the menu name
		if ($menuNameRow['display'] == 'Yes') {
			echo '  ' . '<span id="menu-name"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
		} else {
			echo '</p></div>';
		}

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
				echo '<h1 id="title">Today\'s Options</h1>';
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
				echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Vegetarian</strong></p>';
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
				echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Grains</strong></p>';
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
				echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Vegetable</strong></p>';
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
				echo '<p id="note"><strong>CHEF\'S NOTES</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<span style="font-size:16px; font-weight: normal;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
				echo '<br /></span><span style="font-size:16px; color:#cccccc; font-style:italic; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
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
		echo '<p style="width:800px; margin-left:6%; font-size:24px;">We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
	
##########################
## END PIZZA MENU LOGIC ##
##########################

?>

	</div><!-- /3 -->

	<!-- sticky menus / see code starting on line 13  -->
	<div id="4" class="menu-content" style="display:<?php echo $salad; ?>; margin-top: 0%;">
    	<h1 id="title">Salad Bar</h1>

<?php

################################
## BEGIN SALAD BAR MENU LOGIC ##
################################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_bdk_salad");

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
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
if (!isset($_GET['addDays'])){
	$_GET['addDays'] = '0';
}	
?>

<div align="center" style="padding:5px 0 0 20px;">
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
	<input type="hidden" name="unit" value="beardownkitchen" />
	<input type="hidden" name="menuType" value="breakfast" />
	<select name="addDays" onChange="this.form.submit();">
		<option value="" disabled selected>View another day...</option>
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
<!-- <br clear="all" /> -->

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION
	
	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="date-selected">' . $todayFormatted . '</span>';
	
	// check to make sure the restaurant is open before displaying the menu name and menu
	if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
		echo '<p><strong>Closed</strong></p>';
		// decide if we need to announce a day-only closure...
		if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
			echo '<p style="padding-top:14px; font-size:24px;">We are closed today. Please visit us another time.</p></div>';
		} else { // ...or a week-long closure
			echo '<p style="padding-top:14px; font-size:24px;">We are closed this week. Please visit us another time.</p></div>';
		}
		
	} else {

		// check price display setting and assign appropriate function name for menu display
		if ($menuNameRow['prices'] == 'Yes') {
			$displayFunction = 'full_line_item_bdk';
		} else {
			$displayFunction = 'item_only_bdk';
		}

		// should we show the menu name
		if ($menuNameRow['display'] == 'Yes') {
			echo '  ' . '<span id="menu-name"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
		} else {
			echo '</p></div>';
		}
		
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
				echo '<h1 id="title">Salad Bar Items</strong></h1>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {
			

				// if no price is entered, display using predefined setting
/*				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
				}

				echo $displayFunction($itemRow['name'], '', $itemRow['price']);
*/
				// EXCEPTION: this is the display function that uses commas rather than a line by line listing. Prices won't work, even though they're accepted in the Edit view. Had to use this view due to quantity of items to display
				echo '<span style="font-size:20px; color:#fff;">';
				// put a comma before the next item ONLY if we have an initial item and more than one item
				if ($display) {
					echo ', ';
				}
				echo $itemRow['name'] . '</span>';
				
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
				echo '<h1 id="title">Salad Dressings</strong></h1>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {
			
				// if no price is entered, display using predefined setting
/*				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
				}

				echo $displayFunction($itemRow['name'], '', $itemRow['price']);
*/

				// EXCEPTION: this is the display function that uses commas rather than a line by line listing. Prices won't work, even though they're accepted in the Edit view. Had to use this view due to quantity of items to display
				echo '<span style="font-size:20px; color: #fff;">';
				// put a comma before the next item ONLY if we have an initial item and more than one item
				if ($display) {
					echo ', ';
				}
				echo $itemRow['name'] . '</span>';
				
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
				echo '<p style="margin-bottom:3px;"><strong style="font-size:12px; color:#F29332;">Grains</strong></p>';
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
				echo '<h1 id="title">Salad Toppings</strong></h1>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
/*				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
				}
			
				echo $displayFunction($itemRow['name'], '', $itemRow['price']);
*/

				// EXCEPTION: this is the display function that uses commas rather than a line by line listing. Prices won't work, even though they're accepted in the Edit view. Had to use this view due to quantity of items to display
				echo '<span style="font-size:20px; color: #fff">';
				// put a comma before the next item ONLY if we have an initial item and more than one item
				if ($display) {
					echo ', ';
				}
				echo $itemRow['name'] . '</span>';
				
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
				echo '<p id="note"><strong>CHEF\'S NOTES</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<span style="font-size:16px; font-weight: normal;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
				echo '<br /></span><span style="font-size:16px; color:#cccccc; font-style:italic; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
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
		echo '<p style="width:800px; margin-left:6%; font-size:24px;">We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
	
##############################
## END SALAD BAR MENU LOGIC ##
##############################

?>

	</div><!-- /4 -->

	<!-- sticky menus / see code starting on line 13  -->
	<div id="5" class="menu-content" style="display:<?php echo $saute; ?>; margin-top: 0%;">
    	<h1 id="title">Pasta/Stir-Fry</h1>
    	
<?php

################################
## BEGIN SAUTE BAR MENU LOGIC ##
################################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_bdk_saute");

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
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
if (!isset($_GET['addDays'])){
	$_GET['addDays'] = '0';
}	
?>

<div align="center" style="padding:5px 0 0 20px;">
	<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
	<input type="hidden" name="unit" value="beardownkitchen" />
	<input type="hidden" name="menuType" value="breakfast" />
	<select name="addDays" onChange="this.form.submit();">
		<option value="" disabled selected>View another day...</option>
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
<!-- <br clear="all" /> -->

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION
	
	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="date-selected">' . $todayFormatted . '</span>';
	
	// check to make sure the restaurant is open before displaying the menu name and menu
	if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
		echo '<p><strong>Closed</strong></p>';
		// decide if we need to announce a day-only closure...
		if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
			echo '<p style="padding-top:14px; font-size:24px;">We are closed today. Please visit us another time.</p></div>';
		} else { // ...or a week-long closure
			echo '<p style="padding-top:14px; font-size:24px;">We are closed this week. Please visit us another time.</p></div>';
		}
		
	} else {

		// check price display setting and assign appropriate function name for menu display
		if ($menuNameRow['prices'] == 'Yes') {
			$displayFunction = 'full_line_item_bdk';
		} else {
			$displayFunction = 'item_only_bdk';
		}

		// should we show the menu name
		if ($menuNameRow['display'] == 'Yes') {
			echo '  ' . '<span id="menu-name"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
		} else {
			echo '</p></div>';
		}
		
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
				echo '<h1 id="title">Protein</strong></h1>';
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
				echo '<h1 id="title">Vegetarian</h1>';
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
				echo '<h1 id="title">Starch</strong></h1>';
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
				echo '<h1 id="title">Sauce</h1>';
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
				echo '<p id="note"><strong>CHEF\'S NOTES</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<span style="font-size:16px; font-weight: normal;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
				echo '<br /></span><span style="font-size:16px; color:#cccccc; font-style:italic; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
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
		echo '<p style="width:800px; margin-left:6%; font-size:24px;">We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
	
##############################
## END SAUTE BAR MENU LOGIC ##
##############################

?>

	</div><!-- /5 -->

</div><!-- /menu-content -->

</div>
