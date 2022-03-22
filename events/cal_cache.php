<?php

require_once 'vendor/autoload.php';

if(is_readable('cal_cache.inc')){
	unlink('cal_cache.inc');
}
function trim_text($input, $length = 94, $ellipses = true) {

	//no need to trim, already shorter than trim length
	if (strlen($input) <= $length) {
		return $input;
	}

	//find last space within length
	$last_space = strrpos(substr($input, 0, $length), ' ');
	$trimmed_text = substr($input, 0, $last_space);

	//add ellipses (...)
	if ($ellipses) {
		$trimmed_text .= '...';
	}

	return htmlspecialchars($trimmed_text);
}

date_default_timezone_set('America/Phoenix');
$start = date("Y-m-d").'T00:00:00-07:00';
$end = date("Y-m-d", strtotime('+30 days')).'T00:00:00-07:00';

$optParams = array('maxResults' => 50,'timeMax'=>$end,'timeMin'=>$start);

$calendars= array(	
	'Student Unions' =>'azstudentunion@gmail.com',
	'ASUA' =>'0rvt013ke1jdi67oeojcmvovtc@group.calendar.google.com',
	'Career Services' =>'uaor65u7g4rp3qfo9jtjv66n7s@group.calendar.google.com',
	//'CSIL' =>' np7b4221terameeeuugv1e7ou8@group.calendar.google.com', => Getting an error
	'Dining' => '7lde8gnlc08uue6oebb8j33dt4@group.calendar.google.com',
	'Events Board' => 'r91kf8e58gjq33akrnhlo5ituk@group.calendar.google.com',
	'Gallagher' => 'nkj5uavso16ofaf4umvfdlbvd4@group.calendar.google.com',
	'Games Room' => '6p4vfk5bfd3tgd1np34skev3gs@group.calendar.google.com',
	'Off Campus Housing' => 'bbt1joikvitvd0u5a0bo1ltahg@group.calendar.google.com',
	// 'SA Marketing Schedules' => 'tr8uigm1llmurq2v890dh6d5es@group.calendar.google.com', => Getting an error
	'Union Galleries' => 'ucd9kt5sgbdve5jalkpbmddtc8@group.calendar.google.com', 
	//'Women\'s Resource Center' => 'auroras@email.arizona.edu',
	'Women\'s Resource Center' => 'email.arizona.edu_ieujbdt3ip8lnhkn56i9vmms5g@group.calendar.google.com',
	// 'Women\'s Resource Center' => 'klocp42akqe62qrt3k3avqtdpo@group.calendar.google.com',
	// 'LGBTQ Student Club Meetings' => 'asuapride@gmail.com'
);

$client = new Google_Client();
$client->setApplicationName("Union Calendar Feed");
$client->setDeveloperKey('AIzaSyCVH7-3rDU0kuTWg2UgkMSV_z6YHEKPZos');

$service = new Google_Service_Calendar($client);
$eventFeed = "";
$days = "";

foreach($calendars as $cal_id){

	// Retrieve the event list from the calendar server
	try {
		$eventFeed = $service->events->listEvents($cal_id,$optParams);
	} catch (Google_Service_Exception $e) {
	    echo "Error: " . $e->getMessage();
	}

	foreach ($eventFeed as $event) {
		if ($event->status != "cancelled") {
				$where = $event->location;

				$date_start = date("g:i", strtotime($event->start->dateTime));
				$date_end = date("g:ia", strtotime($event->end->dateTime));

				$days[] = '<h3>'.$event->summary.'</h3><p class="when">'.$where.'::'.$date_start.'-'.$date_end.'</p><p>'.trim_text($event->description).'</p>';
		}
	}


}

file_put_contents('cal_cache.inc', serialize($days));
