<?php

	include('gcal.inc');

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

$query = $service->newEventQuery();
		// Set options on the query
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setOrderby('starttime');
		//$query->setFutureevents('true');
		$query->setSortorder('ascending');
		$query->setSingleEvents(true);
		//$query->setUser($user);
		$start_query = date("Y-m-d", time());
		$end_query = date("Y-m-d", time()+604800);
		//var_dump($start_query);
		//var_dump($end_query);
		$query->setStartMin($start_query);
		$query->setStartMax($end_query);


$calendars= array(
	'Events Board' => 'r91kf8e58gjq33akrnhlo5ituk%40group.calendar.google.com',
	'ASUA' =>'0rvt013ke1jdi67oeojcmvovtc%40group.calendar.google.com',
	'Dining' => '7lde8gnlc08uue6oebb8j33dt4%40group.calendar.google.com',
	'Gallagher' => 'nkj5uavso16ofaf4umvfdlbvd4%40group.calendar.google.com',
	'Games Room' => '6p4vfk5bfd3tgd1np34skev3gs%40group.calendar.google.com',
	// 'Off Campus Housing' => 'bbt1joikvitvd0u5a0bo1ltahg%40group.calendar.google.com',
	'Union Galleries' => 'ucd9kt5sgbdve5jalkpbmddtc8%40group.calendar.google.com'
);

$calendar_privacy = array
(
	'Events Board' => 'private-9a5bded9b53d0debf6c4bcc58ba1d615'
);

//print date("Y-m-d");
foreach($calendars as $cal_name => $cal_id){

	// Retrieve the event list from the calendar server

	$query->setUser($cal_id);
	//$query->setVisibility($calendar_privacy[$cal_name]);

	//var_dump($query->getQueryUrl());

	try {
	    //$eventFeed = $service->getCalendarEventFeed('https://www.google.com/calendar/feeds/'.$cal_id.'/private/full?start-min='.date("Y-m-d").'T07:00:00&start-max='.date("Y-m-d", time()+604800).'T06:59:59');
			$eventFeed = $service->getCalendarEventFeed($query);
	} catch (Zend_Gdata_App_Exception $e) {
	    echo "Error: " . $e->getMessage();
	}

	//var_dump($eventFeed);
	foreach ($eventFeed as $event) {
		//var_dump($event);
		if ($event->eventStatus->value!="http://schemas.google.com/g/2005#event.canceled") {

				$where =$event->getWhere();
				$where = $where[0]->getValueString();
				if ($where != '') {
					$where .= '::';
				}
				$when = $event->getWhen();
				$date_start = date("g:i", strtotime($when[0]->getStartTime()));
				$date_end = date("g:ia", strtotime($when[0]->getEndTime()));
				//$days[] = 	'<div class="event"><div class="event_link" onclick="displayEvent(event,\''.$eventID.'\',\''.$date_start.'-'.$date_end.'\');">'.$event->title.'</div><div class="event_time">'.$date_start."-".$date_end.'</div></div><br />';
				$days[] = '<h3>'.$event->title.'</h3><p class="when">'.$where.$date_start.'-'.$date_end.'</p><p>'.trim_text($event->getContent()).'</p>';
		}
	}


}

//var_dump($days);

file_put_contents('cal_cache.inc', serialize($days));
