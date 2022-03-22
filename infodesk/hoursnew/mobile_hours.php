<?php

#####################################
## hours constants as of 8/12/2014 ##

// codes for meal times
$breakfast = 1;
$lunch = 2;
$dinner = 3;
$continuous = 4;

// location_id list for venues serving specific meals
$cactusID = 5;
$iqID = 27;
$bdkID = 68;

// location_id list for venues open 24
$highlandID = 42;

// special hours definitions
$cactus['breakfastStart'] = '07:00:00';
$cactus['breakfastEnd'] = '10:30:00';
$iq['breakfastStart'] = '07:30:00';
$iq['breakfastEnd'] = '10:00:00';
$bdk['breakfastStart'] = '07:00:00';
$bdk['breakfastEnd'] = '10:00:00';
$bdk['lunchStart'] = '11:00:00';
$bdk['lunchEnd'] = '14:00:00';
$bdk['dinnerStart'] = '00:00:00';
$bdk['dinnerEnd'] = '00:00:00';

// breakfast, lunch and dinner hours for fixed locations

## end ##
#########

// include db and create new object
require('hours_db.inc');

$query = 'SELECT * FROM location WHERE subgroup = "Dining" ORDER BY location_name ASC';
$result = $db->query($query);
$i = 1;

// visual listing for review and testing
/*
while ($list = $result->fetch_array()) {
	if ($list['breakfast'] == 'yes') {
		echo $i.') '.$list['location_name'] . ' - ' . $list['breakfast'] . ' - ' . $list['lunch'] . ' - ' . $list['dinner'] . ' - ' . $list['continuous'] . '<br />';
		$i++;
	}
	if ($list['lunch'] == 'yes') {
		echo $i.') '.$list['location_name'] . ' - ' . $list['breakfast'] . ' - ' . $list['lunch'] . ' - ' . $list['dinner'] . ' - ' . $list['continuous'] . '<br />';
		$i++;
	}
	if ($list['dinner'] == 'yes') {
		echo $i.') '.$list['location_name'] . ' - ' . $list['breakfast'] . ' - ' . $list['lunch'] . ' - ' . $list['dinner'] . ' - ' . $list['continuous'] . '<br />';
		$i++;
	}
	if ($list['continuous'] == 'yes') {
		echo $i.') '.$list['location_name'] . ' - ' . $list['breakfast'] . ' - ' . $list['lunch'] . ' - ' . $list['dinner'] . ' - ' . $list['continuous'] . '<br />';
		$i++;
	}
}
*/

// Function to subtract 1 second from closing time to ensure proper display in feeds
function format24($closing) {
	$closing = new DateTime($closing);
	$closing->modify('-1 second');
	$closing = $closing->format('H:i:s');
	return $closing;
}

// logic to get the right sets of hours
## get date in MySQL format
$today = date("Y-m-d");
$future = strtotime("+ 6 days", time());
$week = date("Y-m-d", $future);

## get current period and assign type (school or summer)
$query = 'SELECT * FROM periods WHERE DATE(start_date) <= "'.$today.'" AND DATE(end_date) >= "'.$today.'"';
$result = $db->query($query);
$period = $result->fetch_array();
$type = $period['type'];

// code to update the db tables
## first empty the table
//$query = 'TRUNCATE TABLE meal_times';
$query = 'DELETE FROM meal_times';
$empty = $db->query($query);

// get the relevant list of dining locations
$query = 'SELECT * FROM location WHERE subgroup = "Dining" ORDER BY location_id ASC';
$result = $db->query($query);

while ($list = $result->fetch_array()) {

	// get the standard hours for the current period and location
	$queryHours = 'SELECT * FROM hours WHERE location_id = '.$list['location_id'].' AND type = '.$type.'';
	$resultHours = $db->query($queryHours);
	$resultHours2 = $db->query($queryHours);
	$hours = $resultHours->fetch_array();
	$hoursE = $resultHours2->fetch_array();

	// get the exception hours for the current location (today plus 6 days for a total of 1 week)
	$queryHoursExceptions = 'SELECT * FROM exceptions WHERE location_id = '.$list['location_id'].' AND date_of >= "'.$today.'" AND date_of <= "'.$week.'"';
	$resultHoursExceptions = $db->query($queryHoursExceptions);

	// continuous hours logic
	// reformat 24-hour locations' times for each day so they work in the feed
	if ($hours['openm'] != '00:00:00' && $hours['openm'] == $hours['closem']) {
		$closing = $hours['closem'];
		$hours['closem'] = format24($closing);
	}
	if ($hours['opent'] != '00:00:00' && $hours['opent'] == $hours['closet']) {
		$closing = $hours['closet'];
		$hours['closet'] = format24($closing);
	}
	if ($hours['openw'] != '00:00:00' && $hours['openw'] == $hours['closew']) {
		$closing = $hours['closew'];
		$hours['closew'] = format24($closing);
	}
	if ($hours['openr'] != '00:00:00' && $hours['openr'] == $hours['closer']) {
		$closing = $hours['closer'];
		$hours['closer'] = format24($closing);
	}
	if ($hours['openf'] != '00:00:00' && $hours['openf'] == $hours['closef']) {
		$closing = $hours['closef'];
		$hours['closef'] = format24($closing);
	}
	if ($hours['opens'] != '00:00:00' && $hours['opens'] == $hours['closes']) {
		$closing = $hours['closes'];
		$hours['closes'] = format24($closing);
	}
	if ($hours['openu'] != '00:00:00' && $hours['openu'] == $hours['closeu']) {
		$closing = $hours['closeu'];
		$hours['closeu'] = format24($closing);
	}

	// continuous hours query
	if ($list['continuous'] == 'yes') {
		$query = 'INSERT INTO meal_times SET location_id='.$list['location_id'].', meal_details_id="'.$continuous.'", startm="'.$hours['openm'].'", endm="'.$hours['closem'].'", startt="'.$hours['opent'].'", endt="'.$hours['closet'].'", startw="'.$hours['openw'].'", endw="'.$hours['closew'].'", startr="'.$hours['openr'].'", endr="'.$hours['closer'].'", startf="'.$hours['openf'].'", endf="'.$hours['closef'].'", starts="'.$hours['opens'].'", ends="'.$hours['closes'].'", startu="'.$hours['openu'].'", endu="'.$hours['closeu'].'" ';
		$db->query($query);
	}

		// logic for continuous hours' exceptions
		while ($hoursExceptions = $resultHoursExceptions->fetch_array()) {

			switch (date("N",strtotime($hoursExceptions['date_of']))) {
				case 1:
				$hoursE['openm'] = $hoursExceptions['open'];
				$hoursE['closem'] = $hoursExceptions['close'];
				break;
				case 2:
				$hoursE['opent'] = $hoursExceptions['open'];
				$hoursE['closet'] = $hoursExceptions['close'];
				break;
				case 3:
				$hoursE['openw'] = $hoursExceptions['open'];
				$hoursE['closew'] = $hoursExceptions['close'];
				break;
				case 4:
				$hoursE['openr'] = $hoursExceptions['open'];
				$hoursE['closer'] = $hoursExceptions['close'];
				break;
				case 5:
				$hoursE['openf'] = $hoursExceptions['open'];
				$hoursE['closef'] = $hoursExceptions['close'];
				break;
				case 6:
				$hoursE['opens'] = $hoursExceptions['open'];
				$hoursE['closes'] = $hoursExceptions['close'];
				break;
				case 7:
				$hoursE['openu'] = $hoursExceptions['open'];
				$hoursE['closeu'] = $hoursExceptions['close'];
				break;
			}

			// exceptions hours logic
			// reformat 24-hour locations' times for each day so they work in the feed
			if ($hoursE['openm'] != '00:00:00' && $hoursE['openm'] == $hoursE['closem']) {
			    $closing = $hoursE['closem'];
			    $hoursE['closem'] = format24($closing);
			}
			if ($hoursE['opent'] != '00:00:00' && $hoursE['opent'] == $hoursE['closet']) {
			    $closing = $hoursE['closet'];
			    $hoursE['closet'] = format24($closing);
			}
			if ($hoursE['openw'] != '00:00:00' && $hoursE['openw'] == $hoursE['closew']) {
			    $closing = $hoursE['closew'];
			    $hoursE['closew'] = format24($closing);
			}
			if ($hoursE['openr'] != '00:00:00' && $hoursE['openr'] == $hoursE['closer']) {
			    $closing = $hoursE['closer'];
			    $hoursE['closer'] = format24($closing);
			}
			if ($hoursE['openf'] != '00:00:00' && $hoursE['openf'] == $hoursE['closef']) {
			    $closing = $hoursE['closef'];
			    $hoursE['closef'] = format24($closing);
			}
			if ($hoursE['opens'] != '00:00:00' && $hoursE['opens'] == $hoursE['closes']) {
			    $closing = $hoursE['closes'];
			    $hoursE['closes'] = format24($closing);
			}
			if ($hoursE['openu'] != '00:00:00' && $hoursE['openu'] == $hoursE['closeu']) {
			    $closing = $hoursE['closeu'];
			    $hoursE['closeu'] = format24($closing);
			}
			
			// update continuous hours' exceptions
			$query = 'UPDATE meal_times SET startm="'.$hoursE['openm'].'", endm="'.$hoursE['closem'].'", startt="'.$hoursE['opent'].'", endt="'.$hoursE['closet'].'", startw="'.$hoursE['openw'].'", endw="'.$hoursE['closew'].'", startr="'.$hoursE['openr'].'", endr="'.$hoursE['closer'].'", startf="'.$hoursE['openf'].'", endf="'.$hoursE['closef'].'", starts="'.$hoursE['opens'].'", ends="'.$hoursE['closes'].'", startu="'.$hoursE['openu'].'", endu="'.$hoursE['closeu'].'" WHERE location_id = '.$hoursExceptions['location_id'].' ';
			$db->query($query);
		}

	## breakfast hours ##
	if ($list['breakfast'] == 'yes') {

		## BEGIN Cactus Grill logic
		if ($list['location_id'] == $cactusID) {
			
			## monday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openm'], $hoursE['openm']);
			$latest = max($hours['openm'], $hoursE['openm']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}
			
			if ($hours['openm'] == '00:00:00' || $hoursE['openm'] == '00:00:00') {
				$cactus['breakfastStartM'] = '00:00:00';
				$cactus['breakfastEndM'] = '00:00:00';
			} else if ($latest > $cactus['breakfastStart'] && $latest < $cactus['breakfastEnd']) {
				$cactus['breakfastStartM'] = $latest;
				$cactus['breakfastEndM'] = $cactus['breakfastEnd'];
			} else if ($latest == $cactus['breakfastStart'] && !$earlyException) {
				$cactus['breakfastStartM'] = $cactus['breakfastStart'];
				$cactus['breakfastEndM'] = $cactus['breakfastEnd'];
			} else if (!$earlyException) {
				$cactus['breakfastStartM'] = '00:00:00';
				$cactus['breakfastEndM'] = $latest;
			} else if ($earlyException) {
				$cactus['breakfastStartM'] = $earliest;
				$cactus['breakfastEndM'] = $cactus['breakfastEnd'];
			} else {
				$cactus['breakfastStartM'] = '00:00:00';
				$cactus['breakfastEndM'] = '00:00:00';
			}

			// tuesday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['opent'], $hoursE['opent']);
			$latest = max($hours['opent'], $hoursE['opent']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['opent'] == '00:00:00' || $hoursE['opent'] == '00:00:00') {
				$cactus['breakfastStartT'] = '00:00:00';
				$cactus['breakfastEndT'] = '00:00:00';
			} else if ($latest > $cactus['breakfastStart'] && $latest < $cactus['breakfastEnd']) {
				$cactus['breakfastStartT'] = $latest;
				$cactus['breakfastEndT'] = $cactus['breakfastEnd'];
			} else if ($latest == $cactus['breakfastStart'] && !$earlyException) {
				$cactus['breakfastStartT'] = $cactus['breakfastStart'];
				$cactus['breakfastEndT'] = $cactus['breakfastEnd'];
			} else if (!$earlyException) {
				$cactus['breakfastStartT'] = '00:00:00';
				$cactus['breakfastEndT'] = $latest;
			} else if ($earlyException) {
				$cactus['breakfastStartT'] = $earliest;
				$cactus['breakfastEndT'] = $cactus['breakfastEnd'];
			} else {
				$cactus['breakfastStartT'] = '00:00:00';
				$cactus['breakfastEndT'] = '00:00:00';
			}

			// wednesday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openw'], $hoursE['openw']);
			$latest = max($hours['openw'], $hoursE['openw']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openw'] == '00:00:00' || $hoursE['openw'] == '00:00:00') {
				$cactus['breakfastStartW'] = '00:00:00';
				$cactus['breakfastEndW'] = '00:00:00';
			} else if ($latest > $cactus['breakfastStart'] && $latest < $cactus['breakfastEnd']) {
				$cactus['breakfastStartW'] = $latest;
				$cactus['breakfastEndW'] = $cactus['breakfastEnd'];
			} else if ($latest == $cactus['breakfastStart'] && !$earlyException) {
				$cactus['breakfastStartW'] = $cactus['breakfastStart'];
				$cactus['breakfastEndW'] = $cactus['breakfastEnd'];
			} else if (!$earlyException) {
				$cactus['breakfastStartW'] = '00:00:00';
				$cactus['breakfastEndW'] = $latest;
			} else if ($earlyException) {
				$cactus['breakfastStartW'] = $earliest;
				$cactus['breakfastEndW'] = $cactus['breakfastEnd'];
			} else {
				$cactus['breakfastStartW'] = '00:00:00';
				$cactus['breakfastEndW'] = '00:00:00';
			}

			// thursday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openr'], $hoursE['openr']);
			$latest = max($hours['openr'], $hoursE['openr']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openr'] == '00:00:00' || $hoursE['openr'] == '00:00:00') {
				$cactus['breakfastStartR'] = '00:00:00';
				$cactus['breakfastEndR'] = '00:00:00';
			} else if ($latest > $cactus['breakfastStart'] && $latest < $cactus['breakfastEnd']) {
				$cactus['breakfastStartR'] = $latest;
				$cactus['breakfastEndR'] = $cactus['breakfastEnd'];
			} else if ($latest == $cactus['breakfastStart'] && !$earlyException) {
				$cactus['breakfastStartR'] = $cactus['breakfastStart'];
				$cactus['breakfastEndR'] = $cactus['breakfastEnd'];
			} else if (!$earlyException) {
				$cactus['breakfastStartR'] = '00:00:00';
				$cactus['breakfastEndR'] = $latest;
			} else if ($earlyException) {
				$cactus['breakfastStartR'] = $earliest;
				$cactus['breakfastEndR'] = $cactus['breakfastEnd'];
			} else {
				$cactus['breakfastStartR'] = '00:00:00';
				$cactus['breakfastEndR'] = '00:00:00';
			}

			// friday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openf'], $hoursE['openf']);
			$latest = max($hours['openf'], $hoursE['openf']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openf'] == '00:00:00' || $hoursE['openf'] == '00:00:00') {
				$cactus['breakfastStartF'] = '00:00:00';
				$cactus['breakfastEndF'] = '00:00:00';
			} else if ($latest > $cactus['breakfastStart'] && $latest < $cactus['breakfastEnd']) {
				$cactus['breakfastStartF'] = $latest;
				$cactus['breakfastEndF'] = $cactus['breakfastEnd'];
			} else if ($latest == $cactus['breakfastStart'] && !$earlyException) {
				$cactus['breakfastStartF'] = $cactus['breakfastStart'];
				$cactus['breakfastEndF'] = $cactus['breakfastEnd'];
			} else if (!$earlyException) {
				$cactus['breakfastStartF'] = '00:00:00';
				$cactus['breakfastEndF'] = $latest;
			} else if ($earlyException) {
				$cactus['breakfastStartF'] = $earliest;
				$cactus['breakfastEndF'] = $cactus['breakfastEnd'];
			} else {
				$cactus['breakfastStartF'] = '00:00:00';
				$cactus['breakfastEndF'] = '00:00:00';
			}

			// saturday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['opens'], $hoursE['opens']);
			$latest = max($hours['opens'], $hoursE['opens']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['opens'] == '00:00:00' || $hoursE['opens'] == '00:00:00') {
				$cactus['breakfastStartS'] = '00:00:00';
				$cactus['breakfastEndS'] = '00:00:00';
			} else if ($latest > $cactus['breakfastStart'] && $latest < $cactus['breakfastEnd']) {
				$cactus['breakfastStartS'] = $latest;
				$cactus['breakfastEndS'] = $cactus['breakfastEnd'];
			} else if ($latest == $cactus['breakfastStart'] && !$earlyException) {
				$cactus['breakfastStartS'] = $cactus['breakfastStart'];
				$cactus['breakfastEndS'] = $cactus['breakfastEnd'];
			} else if (!$earlyException) {
				$cactus['breakfastStartS'] = '00:00:00';
				$cactus['breakfastEndS'] = $latest;
			} else if ($earlyException) {
				$cactus['breakfastStartS'] = $earliest;
				$cactus['breakfastEndS'] = $cactus['breakfastEnd'];
			} else {
				$cactus['breakfastStartS'] = '00:00:00';
				$cactus['breakfastEndS'] = '00:00:00';
			}

			// sunday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openu'], $hoursE['openu']);
			$latest = max($hours['openu'], $hoursE['openu']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openu'] == '00:00:00' || $hoursE['openu'] == '00:00:00') {
				$cactus['breakfastStartU'] = '00:00:00';
				$cactus['breakfastEndU'] = '00:00:00';
			} else if ($latest > $cactus['breakfastStart'] && $latest < $cactus['breakfastEnd']) {
				$cactus['breakfastStartU'] = $latest;
				$cactus['breakfastEndU'] = $cactus['breakfastEnd'];
			} else if ($latest == $cactus['breakfastStart'] && !$earlyException) {
				$cactus['breakfastStartU'] = $cactus['breakfastStart'];
				$cactus['breakfastEndU'] = $cactus['breakfastEnd'];
			} else if (!$earlyException) {
				$cactus['breakfastStartU'] = '00:00:00';
				$cactus['breakfastEndU'] = $latest;
			} else if ($earlyException) {
				$cactus['breakfastStartU'] = $earliest;
				$cactus['breakfastEndU'] = $cactus['breakfastEnd'];
			} else {
				$cactus['breakfastStartU'] = '00:00:00';
				$cactus['breakfastEndU'] = '00:00:00';
			}

			$query = 'INSERT INTO meal_times SET location_id='.$list['location_id'].', meal_details_id='.$breakfast.', startm="'.$cactus['breakfastStartM'].'", endm="'.$cactus['breakfastEndM'].'", startt="'.$cactus['breakfastStartT'].'", endt="'.$cactus['breakfastEndT'].'", startw="'.$cactus['breakfastStartW'].'", endw="'.$cactus['breakfastEndW'].'", startr="'.$cactus['breakfastStartR'].'", endr="'.$cactus['breakfastEndR'].'", startf="'.$cactus['breakfastStartF'].'", endf="'.$cactus['breakfastEndF'].'", starts="'.$cactus['breakfastStartS'].'", ends="'.$cactus['breakfastEndS'].'", startu="'.$cactus['breakfastStartU'].'", endu="'.$cactus['breakfastEndU'].'" ';

			$db->query($query);

			// update continuous hours' opening times to reflect end of breakfast for Cactus
			$query = 'UPDATE meal_times SET startm="'.$cactus['breakfastEndM'].'", endm="'.$hoursE['closem'].'", startt="'.$cactus['breakfastEndT'].'", endt="'.$hoursE['closet'].'", startw="'.$cactus['breakfastEndW'].'", endw="'.$hoursE['closew'].'", startr="'.$cactus['breakfastEndR'].'", endr="'.$hoursE['closer'].'", startf="'.$cactus['breakfastEndF'].'", endf="'.$hoursE['closef'].'", starts="'.$cactus['breakfastEndS'].'", ends="'.$hoursE['closes'].'", startu="'.$cactus['breakfastEndU'].'", endu="'.$hoursE['closeu'].'" WHERE location_id = '.$list['location_id'].' AND meal_details_id = '.$continuous.' ';

			$db->query($query);

		} // END if ($list['location_id'] == $cactusID)
		## END Cactus Grill logic

		## BEGIN IQ Fresh logic
		if ($list['location_id'] == $iqID) {
			
			## monday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openm'], $hoursE['openm']);
			$latest = max($hours['openm'], $hoursE['openm']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}
			
			if ($hours['openm'] == '00:00:00' || $hoursE['openm'] == '00:00:00') {
				$iq['breakfastStartM'] = '00:00:00';
				$iq['breakfastEndM'] = '00:00:00';
			} else if ($latest > $iq['breakfastStart'] && $latest < $iq['breakfastEnd']) {
				$iq['breakfastStartM'] = $latest;
				$iq['breakfastEndM'] = $iq['breakfastEnd'];
			} else if ($latest == $iq['breakfastStart'] && !$earlyException) {
				$iq['breakfastStartM'] = $iq['breakfastStart'];
				$iq['breakfastEndM'] = $iq['breakfastEnd'];
			} else if (!$earlyException) {
				$iq['breakfastStartM'] = '00:00:00';
				$iq['breakfastEndM'] = $latest;
			} else if ($earlyException) {
				$iq['breakfastStartM'] = $earliest;
				$iq['breakfastEndM'] = $iq['breakfastEnd'];
			} else {
				$iq['breakfastStartM'] = '00:00:00';
				$iq['breakfastEndM'] = '00:00:00';
			}

			// tuesday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['opent'], $hoursE['opent']);
			$latest = max($hours['opent'], $hoursE['opent']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['opent'] == '00:00:00' || $hoursE['opent'] == '00:00:00') {
				$iq['breakfastStartT'] = '00:00:00';
				$iq['breakfastEndT'] = '00:00:00';
			} else if ($latest > $iq['breakfastStart'] && $latest < $iq['breakfastEnd']) {
				$iq['breakfastStartT'] = $latest;
				$iq['breakfastEndT'] = $iq['breakfastEnd'];
			} else if ($latest == $iq['breakfastStart'] && !$earlyException) {
				$iq['breakfastStartT'] = $iq['breakfastStart'];
				$iq['breakfastEndT'] = $iq['breakfastEnd'];
			} else if (!$earlyException) {
				$iq['breakfastStartT'] = '00:00:00';
				$iq['breakfastEndT'] = $latest;
			} else if ($earlyException) {
				$iq['breakfastStartT'] = $earliest;
				$iq['breakfastEndT'] = $iq['breakfastEnd'];
			} else {
				$iq['breakfastStartT'] = '00:00:00';
				$iq['breakfastEndT'] = '00:00:00';
			}

			// wednesday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openw'], $hoursE['openw']);
			$latest = max($hours['openw'], $hoursE['openw']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openw'] == '00:00:00' || $hoursE['openw'] == '00:00:00') {
				$iq['breakfastStartW'] = '00:00:00';
				$iq['breakfastEndW'] = '00:00:00';
			} else if ($latest > $iq['breakfastStart'] && $latest < $iq['breakfastEnd']) {
				$iq['breakfastStartW'] = $latest;
				$iq['breakfastEndW'] = $iq['breakfastEnd'];
			} else if ($latest == $iq['breakfastStart'] && !$earlyException) {
				$iq['breakfastStartW'] = $iq['breakfastStart'];
				$iq['breakfastEndW'] = $iq['breakfastEnd'];
			} else if (!$earlyException) {
				$iq['breakfastStartW'] = '00:00:00';
				$iq['breakfastEndW'] = $latest;
			} else if ($earlyException) {
				$iq['breakfastStartW'] = $earliest;
				$iq['breakfastEndW'] = $iq['breakfastEnd'];
			} else {
				$iq['breakfastStartW'] = '00:00:00';
				$iq['breakfastEndW'] = '00:00:00';
			}

			// thursday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openr'], $hoursE['openr']);
			$latest = max($hours['openr'], $hoursE['openr']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openr'] == '00:00:00' || $hoursE['openr'] == '00:00:00') {
				$iq['breakfastStartR'] = '00:00:00';
				$iq['breakfastEndR'] = '00:00:00';
			} else if ($latest > $iq['breakfastStart'] && $latest < $iq['breakfastEnd']) {
				$iq['breakfastStartR'] = $latest;
				$iq['breakfastEndR'] = $iq['breakfastEnd'];
			} else if ($latest == $iq['breakfastStart'] && !$earlyException) {
				$iq['breakfastStartR'] = $iq['breakfastStart'];
				$iq['breakfastEndR'] = $iq['breakfastEnd'];
			} else if (!$earlyException) {
				$iq['breakfastStartR'] = '00:00:00';
				$iq['breakfastEndR'] = $latest;
			} else if ($earlyException) {
				$iq['breakfastStartR'] = $earliest;
				$iq['breakfastEndR'] = $iq['breakfastEnd'];
			} else {
				$iq['breakfastStartR'] = '00:00:00';
				$iq['breakfastEndR'] = '00:00:00';
			}

			// friday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openf'], $hoursE['openf']);
			$latest = max($hours['openf'], $hoursE['openf']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openf'] == '00:00:00' || $hoursE['openf'] == '00:00:00') {
				$iq['breakfastStartF'] = '00:00:00';
				$iq['breakfastEndF'] = '00:00:00';
			} else if ($latest > $iq['breakfastStart'] && $latest < $iq['breakfastEnd']) {
				$iq['breakfastStartF'] = $latest;
				$iq['breakfastEndF'] = $iq['breakfastEnd'];
			} else if ($latest == $iq['breakfastStart'] && !$earlyException) {
				$iq['breakfastStartF'] = $iq['breakfastStart'];
				$iq['breakfastEndF'] = $iq['breakfastEnd'];
			} else if (!$earlyException) {
				$iq['breakfastStartF'] = '00:00:00';
				$iq['breakfastEndF'] = $latest;
			} else if ($earlyException) {
				$iq['breakfastStartF'] = $earliest;
				$iq['breakfastEndF'] = $iq['breakfastEnd'];
			} else {
				$iq['breakfastStartF'] = '00:00:00';
				$iq['breakfastEndF'] = '00:00:00';
			}

			// saturday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['opens'], $hoursE['opens']);
			$latest = max($hours['opens'], $hoursE['opens']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['opens'] == '00:00:00' || $hoursE['opens'] == '00:00:00') {
				$iq['breakfastStartS'] = '00:00:00';
				$iq['breakfastEndS'] = '00:00:00';
			} else if ($latest > $iq['breakfastStart'] && $latest < $iq['breakfastEnd']) {
				$iq['breakfastStartS'] = $latest;
				$iq['breakfastEndS'] = $iq['breakfastEnd'];
			} else if ($latest == $iq['breakfastStart'] && !$earlyException) {
				$iq['breakfastStartS'] = $iq['breakfastStart'];
				$iq['breakfastEndS'] = $iq['breakfastEnd'];
			} else if (!$earlyException) {
				$iq['breakfastStartS'] = '00:00:00';
				$iq['breakfastEndS'] = $latest;
			} else if ($earlyException) {
				$iq['breakfastStartS'] = $earliest;
				$iq['breakfastEndS'] = $iq['breakfastEnd'];
			} else {
				$iq['breakfastStartS'] = '00:00:00';
				$iq['breakfastEndS'] = '00:00:00';
			}

			// sunday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openu'], $hoursE['openu']);
			$latest = max($hours['openu'], $hoursE['openu']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openu'] == '00:00:00' || $hoursE['openu'] == '00:00:00') {
				$iq['breakfastStartU'] = '00:00:00';
				$iq['breakfastEndU'] = '00:00:00';
			} else if ($latest > $iq['breakfastStart'] && $latest < $iq['breakfastEnd']) {
				$iq['breakfastStartU'] = $latest;
				$iq['breakfastEndU'] = $iq['breakfastEnd'];
			} else if ($latest == $iq['breakfastStart'] && !$earlyException) {
				$iq['breakfastStartU'] = $iq['breakfastStart'];
				$iq['breakfastEndU'] = $iq['breakfastEnd'];
			} else if (!$earlyException) {
				$iq['breakfastStartU'] = '00:00:00';
				$iq['breakfastEndU'] = $latest;
			} else if ($earlyException) {
				$iq['breakfastStartU'] = $earliest;
				$iq['breakfastEndU'] = $iq['breakfastEnd'];
			} else {
				$iq['breakfastStartU'] = '00:00:00';
				$iq['breakfastEndU'] = '00:00:00';
			}

			$query = 'INSERT INTO meal_times SET location_id='.$list['location_id'].', meal_details_id='.$breakfast.', startm="'.$iq['breakfastStartM'].'", endm="'.$iq['breakfastEndM'].'", startt="'.$iq['breakfastStartT'].'", endt="'.$iq['breakfastEndT'].'", startw="'.$iq['breakfastStartW'].'", endw="'.$iq['breakfastEndW'].'", startr="'.$iq['breakfastStartR'].'", endr="'.$iq['breakfastEndR'].'", startf="'.$iq['breakfastStartF'].'", endf="'.$iq['breakfastEndF'].'", starts="'.$iq['breakfastStartS'].'", ends="'.$iq['breakfastEndS'].'", startu="'.$iq['breakfastStartU'].'", endu="'.$iq['breakfastEndU'].'" ';

			$db->query($query);

			// update continuous hours' opening times to reflect end of breakfast for Cactus
			$query = 'UPDATE meal_times SET startm="'.$iq['breakfastEndM'].'", endm="'.$hoursE['closem'].'", startt="'.$iq['breakfastEndT'].'", endt="'.$hoursE['closet'].'", startw="'.$iq['breakfastEndW'].'", endw="'.$hoursE['closew'].'", startr="'.$iq['breakfastEndR'].'", endr="'.$hoursE['closer'].'", startf="'.$iq['breakfastEndF'].'", endf="'.$hoursE['closef'].'", starts="'.$iq['breakfastEndS'].'", ends="'.$hoursE['closes'].'", startu="'.$iq['breakfastEndU'].'", endu="'.$hoursE['closeu'].'" WHERE location_id = '.$list['location_id'].' AND meal_details_id = '.$continuous.' ';

			$db->query($query);

		} // END if ($list['location_id'] == $iqID)
		## END IQ Fresh logic

		## BEGIN BDK logic
		if ($list['location_id'] == $bdkID) {
			
			## monday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openm'], $hoursE['openm']);
			$latest = max($hours['openm'], $hoursE['openm']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}
			
			if ($hours['openm'] == '00:00:00' || $hoursE['openm'] == '00:00:00') {
				$bdk['breakfastStartM'] = '00:00:00';
				$bdk['breakfastEndM'] = '00:00:00';
			} else if ($latest > $bdk['breakfastStart'] && $latest < $bdk['breakfastEnd']) {
				$bdk['breakfastStartM'] = $latest;
				$bdk['breakfastEndM'] = $bdk['breakfastEnd'];
			} else if ($latest == $bdk['breakfastStart'] && !$earlyException) {
				$bdk['breakfastStartM'] = $bdk['breakfastStart'];
				$bdk['breakfastEndM'] = $bdk['breakfastEnd'];
			} else if (!$earlyException) {
				$bdk['breakfastStartM'] = '00:00:00';
				$bdk['breakfastEndM'] = $latest;
			} else if ($earlyException) {
				$bdk['breakfastStartM'] = $earliest;
				$bdk['breakfastEndM'] = $bdk['breakfastEnd'];
			} else {
				$bdk['breakfastStartM'] = '00:00:00';
				$bdk['breakfastEndM'] = '00:00:00';
			}

			// tuesday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['opent'], $hoursE['opent']);
			$latest = max($hours['opent'], $hoursE['opent']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['opent'] == '00:00:00' || $hoursE['opent'] == '00:00:00') {
				$bdk['breakfastStartT'] = '00:00:00';
				$bdk['breakfastEndT'] = '00:00:00';
			} else if ($latest > $bdk['breakfastStart'] && $latest < $bdk['breakfastEnd']) {
				$bdk['breakfastStartT'] = $latest;
				$bdk['breakfastEndT'] = $bdk['breakfastEnd'];
			} else if ($latest == $bdk['breakfastStart'] && !$earlyException) {
				$bdk['breakfastStartT'] = $bdk['breakfastStart'];
				$bdk['breakfastEndT'] = $bdk['breakfastEnd'];
			} else if (!$earlyException) {
				$bdk['breakfastStartT'] = '00:00:00';
				$bdk['breakfastEndT'] = $latest;
			} else if ($earlyException) {
				$bdk['breakfastStartT'] = $earliest;
				$bdk['breakfastEndT'] = $bdk['breakfastEnd'];
			} else {
				$bdk['breakfastStartT'] = '00:00:00';
				$bdk['breakfastEndT'] = '00:00:00';
			}

			// wednesday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openw'], $hoursE['openw']);
			$latest = max($hours['openw'], $hoursE['openw']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openw'] == '00:00:00' || $hoursE['openw'] == '00:00:00') {
				$bdk['breakfastStartW'] = '00:00:00';
				$bdk['breakfastEndW'] = '00:00:00';
			} else if ($latest > $bdk['breakfastStart'] && $latest < $bdk['breakfastEnd']) {
				$bdk['breakfastStartW'] = $latest;
				$bdk['breakfastEndW'] = $bdk['breakfastEnd'];
			} else if ($latest == $bdk['breakfastStart'] && !$earlyException) {
				$bdk['breakfastStartW'] = $bdk['breakfastStart'];
				$bdk['breakfastEndW'] = $bdk['breakfastEnd'];
			} else if (!$earlyException) {
				$bdk['breakfastStartW'] = '00:00:00';
				$bdk['breakfastEndW'] = $latest;
			} else if ($earlyException) {
				$bdk['breakfastStartW'] = $earliest;
				$bdk['breakfastEndW'] = $bdk['breakfastEnd'];
			} else {
				$bdk['breakfastStartW'] = '00:00:00';
				$bdk['breakfastEndW'] = '00:00:00';
			}

			// thursday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openr'], $hoursE['openr']);
			$latest = max($hours['openr'], $hoursE['openr']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openr'] == '00:00:00' || $hoursE['openr'] == '00:00:00') {
				$bdk['breakfastStartR'] = '00:00:00';
				$bdk['breakfastEndR'] = '00:00:00';
			} else if ($latest > $bdk['breakfastStart'] && $latest < $bdk['breakfastEnd']) {
				$bdk['breakfastStartR'] = $latest;
				$bdk['breakfastEndR'] = $bdk['breakfastEnd'];
			} else if ($latest == $bdk['breakfastStart'] && !$earlyException) {
				$bdk['breakfastStartR'] = $bdk['breakfastStart'];
				$bdk['breakfastEndR'] = $bdk['breakfastEnd'];
			} else if (!$earlyException) {
				$bdk['breakfastStartR'] = '00:00:00';
				$bdk['breakfastEndR'] = $latest;
			} else if ($earlyException) {
				$bdk['breakfastStartR'] = $earliest;
				$bdk['breakfastEndR'] = $bdk['breakfastEnd'];
			} else {
				$bdk['breakfastStartR'] = '00:00:00';
				$bdk['breakfastEndR'] = '00:00:00';
			}

			// friday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openf'], $hoursE['openf']);
			$latest = max($hours['openf'], $hoursE['openf']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openf'] == '00:00:00' || $hoursE['openf'] == '00:00:00') {
				$bdk['breakfastStartF'] = '00:00:00';
				$bdk['breakfastEndF'] = '00:00:00';
			} else if ($latest > $bdk['breakfastStart'] && $latest < $bdk['breakfastEnd']) {
				$bdk['breakfastStartF'] = $latest;
				$bdk['breakfastEndF'] = $bdk['breakfastEnd'];
			} else if ($latest == $bdk['breakfastStart'] && !$earlyException) {
				$bdk['breakfastStartF'] = $bdk['breakfastStart'];
				$bdk['breakfastEndF'] = $bdk['breakfastEnd'];
			} else if (!$earlyException) {
				$bdk['breakfastStartF'] = '00:00:00';
				$bdk['breakfastEndF'] = $latest;
			} else if ($earlyException) {
				$bdk['breakfastStartF'] = $earliest;
				$bdk['breakfastEndF'] = $bdk['breakfastEnd'];
			} else {
				$bdk['breakfastStartF'] = '00:00:00';
				$bdk['breakfastEndF'] = '00:00:00';
			}

			// saturday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['opens'], $hoursE['opens']);
			$latest = max($hours['opens'], $hoursE['opens']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['opens'] == '00:00:00' || $hoursE['opens'] == '00:00:00') {
				$bdk['breakfastStartS'] = '00:00:00';
				$bdk['breakfastEndS'] = '00:00:00';
			} else if ($latest > $bdk['breakfastStart'] && $latest < $bdk['breakfastEnd']) {
				$bdk['breakfastStartS'] = $latest;
				$bdk['breakfastEndS'] = $bdk['breakfastEnd'];
			} else if ($latest == $bdk['breakfastStart'] && !$earlyException) {
				$bdk['breakfastStartS'] = $bdk['breakfastStart'];
				$bdk['breakfastEndS'] = $bdk['breakfastEnd'];
			} else if (!$earlyException) {
				$bdk['breakfastStartS'] = '00:00:00';
				$bdk['breakfastEndS'] = $latest;
			} else if ($earlyException) {
				$bdk['breakfastStartS'] = $earliest;
				$bdk['breakfastEndS'] = $bdk['breakfastEnd'];
			} else {
				$bdk['breakfastStartS'] = '00:00:00';
				$bdk['breakfastEndS'] = '00:00:00';
			}

			// sunday
			// find the earliest and latest opening hours and compare with normal breakfast hours to see if breakfast actually happens on each day
			$earliest = min($hours['openu'], $hoursE['openu']);
			$latest = max($hours['openu'], $hoursE['openu']);
			$earlyException = false;

			if ($earliest < $latest) {
				$earlyException = true;
			}

			if ($hours['openu'] == '00:00:00' || $hoursE['openu'] == '00:00:00') {
				$bdk['breakfastStartU'] = '00:00:00';
				$bdk['breakfastEndU'] = '00:00:00';
			} else if ($latest > $bdk['breakfastStart'] && $latest < $bdk['breakfastEnd']) {
				$bdk['breakfastStartU'] = $latest;
				$bdk['breakfastEndU'] = $bdk['breakfastEnd'];
			} else if ($latest == $bdk['breakfastStart'] && !$earlyException) {
				$bdk['breakfastStartU'] = $bdk['breakfastStart'];
				$bdk['breakfastEndU'] = $bdk['breakfastEnd'];
			} else if (!$earlyException) {
				$bdk['breakfastStartU'] = '00:00:00';
				$bdk['breakfastEndU'] = $latest;
			} else if ($earlyException) {
				$bdk['breakfastStartU'] = $earliest;
				$bdk['breakfastEndU'] = $bdk['breakfastEnd'];
			} else {
				$bdk['breakfastStartU'] = '00:00:00';
				$bdk['breakfastEndU'] = '00:00:00';
			}

			$query = 'INSERT INTO meal_times SET location_id='.$list['location_id'].', meal_details_id='.$breakfast.', startm="'.$bdk['breakfastStartM'].'", endm="'.$bdk['breakfastEndM'].'", startt="'.$bdk['breakfastStartT'].'", endt="'.$bdk['breakfastEndT'].'", startw="'.$bdk['breakfastStartW'].'", endw="'.$bdk['breakfastEndW'].'", startr="'.$bdk['breakfastStartR'].'", endr="'.$bdk['breakfastEndR'].'", startf="'.$bdk['breakfastStartF'].'", endf="'.$bdk['breakfastEndF'].'", starts="'.$bdk['breakfastStartS'].'", ends="'.$bdk['breakfastEndS'].'", startu="'.$bdk['breakfastStartU'].'", endu="'.$bdk['breakfastEndU'].'" ';

			$db->query($query);

			// update continuous hours' opening times to reflect end of breakfast for Cactus
			$query = 'UPDATE meal_times SET startm="'.$bdk['breakfastEndM'].'", endm="'.$hoursE['closem'].'", startt="'.$bdk['breakfastEndT'].'", endt="'.$hoursE['closet'].'", startw="'.$bdk['breakfastEndW'].'", endw="'.$hoursE['closew'].'", startr="'.$bdk['breakfastEndR'].'", endr="'.$hoursE['closer'].'", startf="'.$bdk['breakfastEndF'].'", endf="'.$hoursE['closef'].'", starts="'.$bdk['breakfastEndS'].'", ends="'.$hoursE['closes'].'", startu="'.$bdk['breakfastEndU'].'", endu="'.$hoursE['closeu'].'" WHERE location_id = '.$list['location_id'].' AND meal_details_id = '.$continuous.' ';

			$db->query($query);

		} // END if ($list['location_id'] == $bdkID)
		## END BDK logic
	
	} // END if ($list['breakfast'] == 'yes')
	## /BREAKFAST HOURS ##

	## LUNCH HOURS ##
	if ($list['lunch'] == 'yes') {

		## BEGIN BDK logic
		if ($list['location_id'] == $bdkID) {
			
			## monday
			// find the earliest closing hours and compare with normal lunch hours to see if lunch actually happens on each day
			$earliest = min($hours['closem'], $hoursE['closem']);
			$earlyException = false;
			$noLunch = false;

			if ($earliest < $bdk['lunchEnd']) {
				$earlyException = true;
				if ($earliest < $bdk['lunchStart']) {
					$noLunch = true;
				}
			}

			if ($hours['openm'] == '00:00:00' || $hoursE['openm'] == '00:00:00' || $noLunch) {
				$bdk['lunchStartM'] = '00:00:00';
				$bdk['lunchEndM'] = '00:00:00';
			} else if ($earlyException) {
				$bdk['lunchStartM'] = $bdk['lunchStart'];
				$bdk['lunchEndM'] = $earliest;
			} else {
				$bdk['lunchStartM'] = $bdk['lunchStart'];
				$bdk['lunchEndM'] = $bdk['lunchEnd'];
			}

			// tuesday
			// find the earliest closing hours and compare with normal lunch hours to see if lunch actually happens on each day
			$earliest = min($hours['closet'], $hoursE['closet']);
			$earlyException = false;
			$noLunch = false;

			if ($earliest < $bdk['lunchEnd']) {
				$earlyException = true;
				if ($earliest < $bdk['lunchStart']) {
					$noLunch = true;
				}
			}

			if ($hours['opent'] == '00:00:00' || $hoursE['opent'] == '00:00:00' || $noLunch) {
				$bdk['lunchStartT'] = '00:00:00';
				$bdk['lunchEndT'] = '00:00:00';
			} else if ($earlyException) {
				$bdk['lunchStartT'] = $bdk['lunchStart'];
				$bdk['lunchEndT'] = $earliest;
			} else {
				$bdk['lunchStartT'] = $bdk['lunchStart'];
				$bdk['lunchEndT'] = $bdk['lunchEnd'];
			}

			// wednesday
			// find the earliest closing hours and compare with normal lunch hours to see if lunch actually happens on each day
			$earliest = min($hours['closew'], $hoursE['closew']);
			$earlyException = false;
			$noLunch = false;

			if ($earliest < $bdk['lunchEnd']) {
				$earlyException = true;
				if ($earliest < $bdk['lunchStart']) {
					$noLunch = true;
				}
			}

			if ($hours['openw'] == '00:00:00' || $hoursE['openw'] == '00:00:00' || $noLunch) {
				$bdk['lunchStartW'] = '00:00:00';
				$bdk['lunchEndW'] = '00:00:00';
			} else if ($earlyException) {
				$bdk['lunchStartW'] = $bdk['lunchStart'];
				$bdk['lunchEndW'] = $earliest;
			} else {
				$bdk['lunchStartW'] = $bdk['lunchStart'];
				$bdk['lunchEndW'] = $bdk['lunchEnd'];
			}

			// thursday
			// find the earliest closing hours and compare with normal lunch hours to see if lunch actually happens on each day
			$earliest = min($hours['closer'], $hoursE['closer']);
			$earlyException = false;
			$noLunch = false;

			if ($earliest < $bdk['lunchEnd']) {
				$earlyException = true;
				if ($earliest < $bdk['lunchStart']) {
					$noLunch = true;
				}
			}

			if ($hours['openr'] == '00:00:00' || $hoursE['openr'] == '00:00:00' || $noLunch) {
				$bdk['lunchStartR'] = '00:00:00';
				$bdk['lunchEndR'] = '00:00:00';
			} else if ($earlyException) {
				$bdk['lunchStartR'] = $bdk['lunchStart'];
				$bdk['lunchEndR'] = $earliest;
			} else {
				$bdk['lunchStartR'] = $bdk['lunchStart'];
				$bdk['lunchEndR'] = $bdk['lunchEnd'];
			}

			// friday
			// find the earliest closing hours and compare with normal lunch hours to see if lunch actually happens on each day
			$earliest = min($hours['closef'], $hoursE['closef']);
			$earlyException = false;
			$noLunch = false;

			if ($earliest < $bdk['lunchEnd']) {
				$earlyException = true;
				if ($earliest < $bdk['lunchStart']) {
					$noLunch = true;
				}
			}

			if ($hours['openf'] == '00:00:00' || $hoursE['openf'] == '00:00:00' || $noLunch) {
				$bdk['lunchStartF'] = '00:00:00';
				$bdk['lunchEndF'] = '00:00:00';
			} else if ($earlyException) {
				$bdk['lunchStartF'] = $bdk['lunchStart'];
				$bdk['lunchEndF'] = $earliest;
			} else {
				$bdk['lunchStartF'] = $bdk['lunchStart'];
				$bdk['lunchEndF'] = $bdk['lunchEnd'];
			}

			// saturday
			// find the earliest closing hours and compare with normal lunch hours to see if lunch actually happens on each day
			$earliest = min($hours['closes'], $hoursE['closes']);
			$earlyException = false;
			$noLunch = false;

			if ($earliest < $bdk['lunchEnd']) {
				$earlyException = true;
				if ($earliest < $bdk['lunchStart']) {
					$noLunch = true;
				}
			}

			if ($hours['opens'] == '00:00:00' || $hoursE['opens'] == '00:00:00' || $noLunch) {
				$bdk['lunchStartS'] = '00:00:00';
				$bdk['lunchEndS'] = '00:00:00';
			} else if ($earlyException) {
				$bdk['lunchStartS'] = $bdk['lunchStart'];
				$bdk['lunchEndS'] = $earliest;
			} else {
				$bdk['lunchStartS'] = $bdk['lunchStart'];
				$bdk['lunchEndS'] = $bdk['lunchEnd'];
			}

			// sunday
			// find the earliest closing hours and compare with normal lunch hours to see if lunch actually happens on each day
			$earliest = min($hours['closeu'], $hoursE['closeu']);
			$earlyException = false;
			$noLunch = false;

			if ($earliest < $bdk['lunchEnd']) {
				$earlyException = true;
				if ($earliest < $bdk['lunchStart']) {
					$noLunch = true;
				}
			}

			if ($hours['openu'] == '00:00:00' || $hoursE['openu'] == '00:00:00' || $noLunch) {
				$bdk['lunchStartU'] = '00:00:00';
				$bdk['lunchEndU'] = '00:00:00';
			} else if ($earlyException) {
				$bdk['lunchStartU'] = $bdk['lunchStart'];
				$bdk['lunchEndU'] = $earliest;
			} else {
				$bdk['lunchStartU'] = $bdk['lunchStart'];
				$bdk['lunchEndU'] = $bdk['lunchEnd'];
			}

			$query = 'INSERT INTO meal_times SET location_id='.$list['location_id'].', meal_details_id='.$lunch.', startm="'.$bdk['lunchStartM'].'", endm="'.$bdk['lunchEndM'].'", startt="'.$bdk['lunchStartT'].'", endt="'.$bdk['lunchEndT'].'", startw="'.$bdk['lunchStartW'].'", endw="'.$bdk['lunchEndW'].'", startr="'.$bdk['lunchStartR'].'", endr="'.$bdk['lunchEndR'].'", startf="'.$bdk['lunchStartF'].'", endf="'.$bdk['lunchEndF'].'", starts="'.$bdk['lunchStartS'].'", ends="'.$bdk['lunchEndS'].'", startu="'.$bdk['lunchStartU'].'", endu="'.$bdk['lunchEndU'].'" ';

			$db->query($query);

		} // END if ($list['location_id'] == $bdkID)
		## END BDK logic
	
	} // END if ($list['lunch'] == 'yes')
	## /LUNCH HOURS ##

	## DINNER HOURS ##
	// currently no locations have specific dinner hours, so this is just used as a place holder for BDK in case they ever make dinner public
	if ($list['dinner'] == 'yes') {
		$query = 'insert into meal_times set location_id='.$list['location_id'].', meal_details_id="'.$dinner.'"';
		$db->query($query);
	} // END if ($list['dinner'] == 'yes')
	## /DINNER HOURS ##

} // END while ($list = $result->fetch_array())

?>