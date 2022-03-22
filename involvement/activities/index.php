<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/involvement/template/involv.inc.php');
$page_options = array();
$page_options['page'] = 'uab';
$page_options['title'] = 'The Wildcat Events Board';
$page_options['header_image'] = '/template/images/banners/wildcat_event_board_banner.jpg';
$page_options['ad2_image'] = '/template/images/photos/ad2.png';
$page_options['ad3_image'] = '/template/images/photos/ad3.png';
$page_options['ad_link'] = '/activities';
involv_start($page_options);

//include('../../events/gcal.inc');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

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

/*
$query = $service->newEventQuery();
    // Set options on the query
    $query->setVisibility('private');
    $query->setProjection('full');
    $query->setOrderby('starttime');
    //$query->setFutureevents('true');
    $query->setSortorder('ascending');
    $query->setSingleEvents('true');
    $query->setUser($user);
    $start_query = date("Y-m-24");
    $end_query = date("Y-m-31");
    //var_dump($start_query);
    //var_dump($end_query);
$query->setStartMin($start_query);
$query->setStartMax($end_query);
*/

$client = new Google_Client();
$client->setApplicationName("Union Calendar Feed");
$client->setDeveloperKey('AIzaSyCVH7-3rDU0kuTWg2UgkMSV_z6YHEKPZos');

$service = new Google_Service_Calendar($client);

$start = date("Y-m-d").'T00:00:00-07:00';
$end = date("Y-m-d", strtotime('+30 days')).'T00:00:00-07:00';

$optParams = array('maxResults' => 50,'timeMax'=>$end,'timeMin'=>$start);
$cal_id = 'r91kf8e58gjq33akrnhlo5ituk@group.calendar.google.com';

/*
  try{
      $eventFeed = $service->getCalendarEventFeed('https://www.google.com/calendar/feeds/'.$cal_id.'/private/full?start-min='.date("Y-m-d").'T07:00:00&start-max='.date("Y-12-29").'T06:59:59&sortorder=ascending&orderby=starttime&singleevents=false');
  } catch (Zend_Gdata_App_Exception $e) {
      echo "Error: " . $e->getMessage();
  }
*/
try
{
  // $eventFeed = $service->events->listEvents($cal_id,$optParams);
}
catch (Google_Service_Exception $e)
{
  //exit($e);
  echo "Error: " . $e->getMessage();
}

  //var_dump($eventFeed);
  /*
  foreach ($eventFeed as $event) {

    if ($event->eventStatus->value!="http://schemas.google.com/g/2005#event.canceled") {

        $where =$event->getWhere();
        $where = $where[0]->getValueString();
        $when = $event->getWhen();



        $start = strtotime($when[0]->getStartTime());
        $end = strtotime($when[0]->getEndTime());

        if(strpos($event->title.'', "Movie:", 0) === false){
          $title = $event->title.'';
        }
        else{
          $title = substr($event->title.'', 7);
          $days[$title]['movie'] = 1;
        }
        $days[$title]['desc'] = $event->getContent().'';
        //var_dump();
        if($event->recurrence.'' != ''){

          $convert_days = array("SU" => "Sundays", "MO" => "Mondays", "TU" => "Tuesdays", "WE" => "Wednesdays", "TH" => "Thursdays", "FR" => "Fridays", "SA" => "Saturdays");

          $recurrence = explode("\n",$event->recurrence.'');
          $recurrence = explode(";",substr($recurrence[2], 6));
          foreach($recurrence as $item){
            $temp = explode("=", $item);
            $rec[$temp[0]] = $temp[1];
          }
          //var_dump($rec);

          $dow = explode(',',$rec['BYDAY']);
          $when_str = '';
          foreach($dow as $day){
            $when_str .= $convert_days[$day].', ';
          }
          $when_str = substr($when_str, 0, -2);
          //var_dump($when_str);
          $days[$title]['when'][$when_str][] = date("gA", $start).'&nbsp;-&nbsp;'.date("gA", $end);
        }
        else{
          $days[$title]['when'][date("l, F d:", $start)][] = date("gA", $start);
        }
        $days[$title]['where'] = $where;

    }
  }
  */

  $days = array();

  // if($eventFeed) foreach ($eventFeed as $event){

  //   if ($event->status != "cancelled"){
  //     $where =$event->location;
  //     //$where = $where[0]->getValueString();
  //     //$when = $event->getWhen();

  //     $start = strtotime($event->start->dateTime);
  //     $end = strtotime($event->end->dateTime);

  //     if(strpos(htmlspecialchars($event->summary, ENT_QUOTES).'', "Movie:", 0) === false)
  //       $title = htmlspecialchars($event->summary, ENT_QUOTES).'';
  //     else{
  //       $title = substr(htmlspecialchars($event->summary, ENT_QUOTES).'', 7);
  //       $days[$title]['movie'] = 1;
  //     }
  //     $days[$title]['desc'] = htmlspecialchars($event->summary, ENT_QUOTES).'';

  //     $days[$title]['when'][date("l, F d:", $start)][] = date("gA", $start);
  //   }
  // }
  //var_dump($days);




?>
<style>
  tr{

  }
  .row1{
    background-color:#666666;
  }
  .row0{
    background-color:#444444;
  }
  td{
    color:#ffffff;
    font-size:12px;
    height:17px;
  }
  .event{
    border-top:1px dotted #444444;
    padding-top:15px;
    padding-bottom:15px;
  }
  .row td{
    color:#444444;
  }
</style>
<h1>The Wildcat Events Board</h1>
<p>
  <span style="font-size:18px;">The Wildcat Events Board</span> is a student run organization that provides educational, entertaining, and thought provoking
  events for the University of Arizona.
</p>
<p>
 Find us in ASUA on the 3rd floor of the Student Union Memorial Center.
</p>
<p>
	For more information about our events or how to get involved, contact <a href="mailto:uawebpr@gmail.com">uawebpr@gmail.com</a> or call 520-626-0036,
	or visit our website at <a href="http://uawildcateventsboard.wix.com/eventsboard"
		onclick="window.open(this.href); return false;"
      	onkeypress="window.open(this.href); return false;" >http://uawildcateventsboard.wix.com/eventsboard</a>.
</p>
<p style="font-size: 13px;">
  <span style="color:#f26522;">PLEASE NOTE</span> that all events listed (including weekly films and special events) are subject to change.
</p>
<div id="frame" style="display: none; height: 600px; overflow:hidden;">

<div style="border-bottom:2px solid #beb6ae; margin-bottom:5px;">
<?php

  if ($days) {
  $i=1;
  foreach($days as $title => $event){
    print '<div id="event-'.$i++.'" class="event">';
    print '<h2>'.$title.'</h2>';
    print '<p>'.$event['desc'].'</p>';

    print '<table cellspacing="0" cellpadding="0" width="210"><tr class="row"><td colspan="2">Times:</td></tr>';


    foreach($event['when'] as $day => $times){
      print '<tr class="row"><td align="left">'.$day.'</td><td align="right">'.implode(' : ', $times).'&nbsp;&nbsp;&nbsp;</td></tr>';
    }
    print '</table>';
    print '<p>Where:<br />'.$event['where'].'</p>';
    print '</div>';

  	}
  }



?>




</div>
<script>var numOfDivs = <?=$i?>; </script>
</div>
<div align="right"><a href="javascript:down();"><img src="../template/images/down_arrow.gif"></a> <a href="javascript:up();"><img src="../template/images/up_arrow.gif"></a></div>
<script src="/commontools/jslib/jquery-1.3.2.min.js"></script>
<script src="/commontools/jslib/jquery.scrollTo.js"></script>
<script>
  var i = 0;

  function up()
  {
    if(i > 0)
    {
      i--;
      $('#frame').scrollTo('#event-'+i, 800)
    }
  }

  function down()
  {
    if(i < numOfDivs)
    {
      i++;
      $('#frame').scrollTo('#event-'+i, 800)
    }
  }
  </script>
<?php
involv_finish();
