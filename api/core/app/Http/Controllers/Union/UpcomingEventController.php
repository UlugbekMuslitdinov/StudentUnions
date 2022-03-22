<?php

namespace App\Http\Controllers\Union;

use App\Http\Controllers\Controller;
use App\Libraries\GoogleCalendar;
use Google_Service_Calendar;

class UpcomingEventController extends Controller 
{
	public function __construct()
    {
        $this->middleware('suapi');
	}
	
    public function getList()
    {
        $client = GoogleCalendar::getClient();
        $service = new Google_Service_Calendar($client);

        // Print the next 10 events on the user's calendar.
		$calendarId = 'primary';
		$optParams = array(
		  'maxResults' => 10,
		  'orderBy' => 'startTime',
		  'singleEvents' => true,
		  'timeMin' => date('c'),
		);

		$results = $service->events->listEvents($calendarId, $optParams);
		$events = $results->getItems();

		// Initialize return
		$return = [
			'result' => '',
			'events' => []
		];

		if (empty($events)) {
		    // No upcoming events found
			$return['result'] = false;
		} else {
		    // Upcoming events
		    $return['result'] = true;
		    foreach ($events as $event) {

				// Get Date
				$date = null;
				$start = null;
				$end = null;

				if ($event->start->dateTime != null) {
					$date = date("Y-m-d", strtotime(date($event->start->dateTime)));
					$start = date("Y-m-d", strtotime(date($event->start->dateTime)));
				}
				else {
					$date = date("Y-m-d", strtotime(date($event->start->date)));
					$start = date("Y-m-d", strtotime(date($event->start->date)));
				}

				if ($event->end->dateTime != null) {
					$end = date("Y-m-d", strtotime("-1", strtotime(date($event->end->dateTime))));
				}
				else {
					$end = date("Y-m-d", strtotime("-1", strtotime(date($event->end->date))));
				}

		        $tmp_arr = [
		        	'name' => $event->summary,
					'date' => $date,
					'start' => $start,
					'end'  => $end,
					'location' => $event->location,
					'description' => $event->description
		        ];
		        array_push($return['events'], $tmp_arr);
		    }
		}

		return response()->json(['result' => $return['result'], 'events' => $return['events']], 200);
    }
}