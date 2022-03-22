<?php

require_once 'vendor/autoload.php';

// START DATE
$start = isset($_GET['start']) ? $_GET['start'] : date("Y-m-d").'T00:00:00-07:00';

// END DATE
$end = isset($_GET['end']) ? $_GET['end'] : date("Y-m-d", strtotime('+30 days')).'T00:00:00-07:00';

// CALENDARS
$calendar_ids[] = 'r91kf8e58gjq33akrnhlo5ituk@group.calendar.google.com'; //Activites Board
$calendar_ids[] = '0rvt013ke1jdi67oeojcmvovtc@group.calendar.google.com'; //ASUA
$calendar_ids[] = 'uaor65u7g4rp3qfo9jtjv66n7s@group.calendar.google.com'; //Career Services
// $calendar_ids[] = 'np7b4221terameeeuugv1e7ou8@group.calendar.google.com'; //CSIL
$calendar_ids[] = '7lde8gnlc08uue6oebb8j33dt4@group.calendar.google.com'; //Dining
$calendar_ids[] = 'nkj5uavso16ofaf4umvfdlbvd4@group.calendar.google.com'; //Gallager Theater
$calendar_ids[] = '6p4vfk5bfd3tgd1np34skev3gs@group.calendar.google.com'; //Games Room
$calendar_ids[] = 'ucd9kt5sgbdve5jalkpbmddtc8@group.calendar.google.com'; //Galleries
$calendar_ids[] = 'email.arizona.edu_ieujbdt3ip8lnhkn56i9vmms5g@group.calendar.google.com'; //Women's Resource Center
// $calendar_ids[] = 'klocp42akqe62qrt3k3avqtdpo@group.calendar.google.com'; //Women's Resource Center
// $calendar_ids[] = 'asuapride@gmail.com'; //Pride Alliance

$client = new Google_Client();
$client->setApplicationName("Union Calendar Feed");
$client->setDeveloperKey('AIzaSyCVH7-3rDU0kuTWg2UgkMSV_z6YHEKPZos');

$service = new Google_Service_Calendar($client);

$optParams = [
  'maxResults' => 50,
  'timeMax'=>$end,
  'timeMin'=>$start
];

$events = array();

foreach($calendar_ids as $cal_id) {

  try {
    $eventFeed = $service->events->listEvents($cal_id,$optParams);
  } catch (Google_Service_Exception $e) {
    echo "Error: " . $e->getMessage();
  }

  foreach ($eventFeed as $event) {

    if ($event->status != "cancelled") {

        $event_start = strtotime($event->start->dateTime);
        $event_end = strtotime($event->end->dateTime);

        $evt = [
          'id' => $event->id,
          'where' => $event->location,
          'start_date' => date("Y-m-d", $event_start),
          'state_time' => date("G:i:s eP", $event_start),
          'end_date' => date("Y-m-d", $event_end),
          'end_time' => date("G:i:s eP", $event_end),
          'allday' => $event->start->dateTime.'',
          'duration' => (($event_end - $event_start)/3600),
          'title' => htmlspecialchars($event->summary, ENT_QUOTES),
          'desc' =>htmlspecialchars($event->description.'', ENT_QUOTES)
        ];

        $events[] = $evt;
    }
  }

}

if(isset($_GET['format']) && $_GET["format"] == "iCal")
{
   echo "BEGIN:VCALENDAR"."\r\n".
        "VERSION:2.0"."\r\n".
        "PRODID:-//SVN Rev: 6126//union.arizona.edu pg_iCal//EN"."\r\n".
        "CALSCALE:Gregorian"."\r\n".
        //"X-WR-TIMEZONE:America/Pheonix"."\r\n".
        "X-WR-CALNAME:Union Unified Calendar"."\r\n".
        "X-WR-CALDESC:Contains: Activities Board, ASUA, Career Services, CSIL, Dining, Gallager, Games Room, Off Campus Housing, Galleries and Women's Resource Center"."\r\n".

        "BEGIN:VTIMEZONE"."\r\n".
        "TZID:America/Phoenix"."\r\n".
        "BEGIN:STANDARD"."\r\n".
        "DTSTART:19671029T020000"."\r\n".
        "TZOFFSETFROM:-0600"."\r\n".
        "TZOFFSETTO:-0700"."\r\n".
        "TZNAME:MST"."\r\n".
        "END:STANDARD"."\r\n".
        "END:VTIMEZONE"."\r\n";

    $i = 0;
    if (isset($events))
    foreach($events as $event) {
      //Sanitize all properties of the array
      foreach($event as $detail)
        $detail = str_replace("&#039;", "'", preg_replace("/\s+/", " ", $detail));

      $sdate = date("Ymd\THis", strtotime($event["start_date"]." ".$event["start_time"]));

      echo "BEGIN:VEVENT"."\r\n".
           "UID:{$sdate}Z-".md5($event["id"])."@union.arizona.edu"."\r\n".
           "SUMMARY:$event[title]"."\r\n".
           "DESCRIPTION:$event[desc]"."\r\n".
           "DTSTART;TZID=America/Phoenix:".$sdate."\r\n".
           "DTEND;TZID=America/Phoenix:".date("Ymd\THis", strtotime($event["end_date"]." ".$event["end_time"]))."\r\n".
           "LOCATION:$event[where]"."\r\n".
           "END:VEVENT"."\r\n";
    }

    echo "END:VCALENDAR";

}
else
{
  echo '<?xml version="1.0" encoding="utf-8"?>';
  echo "\r<Events>\r";
    foreach($events as $event){
      echo "\t<Event>\r".
                  //"<eventID>0</eventID>".
                  "\t\t<title>".$event["title"]."</title>\r".
                  "\t\t<description>".$event["desc"]."</description>\r".
                  "\t\t<startDate>".$event["start_date"]."</startDate>\r".
                  "\t\t<startTime>".$event["start_time"]."</startTime>\r".
                  "\t\t<endDate>".$event["end_date"]."</endDate>\r".
                  "\t\t<endTime>".$event["end_time"]."</endTime>\r".
                  "\t\t<allDay>".$event["allday"]."</allDay>\r".
                  "\t\t<duration>".$event["duration"]."</duration>\r".
                  "\t\t<location>".$event["where"]."</location>\r".
                "\t</Event>\r";
    }
    echo "</Events>";
  }
