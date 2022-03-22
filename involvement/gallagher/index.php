<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/involvement/template/involv.inc.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
$page_options = array();
$page_options['page'] = 'Gallagher Theater';
// serving banner from Deliverance
$page_options['header_image'] = '/template/images/banners/gallagher_banner.jpg';
involv_start($page_options);

//include('gcal.inc');

// the calendars are on azstudentunion@gmail.com  pswd=sumc4414

function trim_text($input, $length = 94, $ellipses = true){
	//no need to trim, already shorter than trim length
	if (strlen($input) <= $length)
		return $input;

	//find last space within length
	$last_space = strrpos(substr($input, 0, $length), ' ');
	$trimmed_text = substr($input, 0, $last_space);

	//add ellipses (...)
	if ($ellipses)
		$trimmed_text .= '...';

	return htmlspecialchars($trimmed_text);
}

$client = new Google_Client();
$client->setApplicationName("Union Calendar Feed");
$client->setDeveloperKey('AIzaSyCVH7-3rDU0kuTWg2UgkMSV_z6YHEKPZos');

$service = new Google_Service_Calendar($client);

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
*/
$start = date("Y-m-d").'T00:00:00-07:00';
$end = date("Y-m-d", strtotime('+30 days')).'T00:00:00-07:00';

/*
//var_dump($start_query);
//var_dump($end_query);
$query->setStartMin($start_query);
$query->setStartMax($end_query);

// Fetch calendar data
*/
$optParams = array('maxResults' => 50,'timeMax'=>$end,'timeMin'=>$start);
$cal_id = 'nkj5uavso16ofaf4umvfdlbvd4@group.calendar.google.com';
/*
try{
	$eventFeed = $service->getCalendarEventFeed('https://www.google.com/calendar/feeds/'
		.$cal_id.'/private/full?start-min='
		.date("Y-m-d")
		.'T07:00:00&start-max='
		.date("Y-m-d", strtotime('next year')) // We show events 1 year out
		.'T06:59:59&sortorder=ascending&orderby=starttime&singleevents=false');
}catch (Zend_Gdata_App_Exception $e){
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


$days = array();
?>

<link rel="stylesheet" type="text/css" href="/involvement/gallagher/style.css">

<h1>More than a movie....</h1>
<div>
	<p>The physical space of the Gallagher Theater is closed until further notice to mitigate the spread of COVID-19. We are offering titles available for digital streaming to all students with a valid NETID, see movie schedule for details. </p>    
</div>
<iframe width="900" height="500" src="https://outlook.office365.com/calendar/published/960e964d2a05479ab6a050440130f722@arizona.edu/22b128fb8a624337b7cc53d94d27d4525267834411108775009/calendar.html"></iframe>
<div align="center">
<a href="/gallagher/index.php"><img src="images/WatchMovie.png" alt="Watch Movie" width="350" height="62"></a>
<!--<a href="https://gallagher.union.arizona.edu"><u><b>FREE MOVIES – NETID LOG IN</b></u></a>-->
</div>
<br />
<!--
<div>
	<span class="collapsible">
		<div class="su-card">
			<div class="su-card-text"><img src="/template/images/involvement/gallagher.png" id="icon">Gallagher Hours<i class="su-arrow"></i></div>
		</div>
	</span>
	<div class="su-content">
		<p>
			The Box Office opens 30 mins before show time, so get your tickets early and skip the line! <br />
			<strong>(Movies are subject to change.  Please check the website before a showing!)</strong><br />
		</p>
	</div>
</div>
-->
<div>
	<span class="collapsible">
		<div class="su-card">
			<div class="su-card-text"><img src="/template/images/involvement/gallagher.png" id="icon">Movie Schedule<i class="su-arrow"></i></div>
		</div>
	</span>
	<div class="su-content2">
		<?php
		// Get data
		$data = file_get_contents('edit/gallagher_sch.json');
		$data = json_decode($data, true);

		$print ='';
		for ($i=0; $i < count($data); $i++) { 
			$timestamp = strtotime($data[$i]['start_date']);
			$date = date('l', $timestamp);
			$month = date('n', $timestamp);
			$day = date('j', $timestamp);
			$week = date('W', $timestamp);
			$timestamp2 = strtotime($data[$i]['end_date']);
			$date2 = date('l', $timestamp2);
			$month2 = date('n', $timestamp2);
			$day2 = date('j', $timestamp2);
			$week2 = date('W', $timestamp2);
			$print .= '<b style="margin-left: 12px;">'. $date .' '.$month.'/'.$day.'</b> - ';
			$print .= '<b>'. $date2 .' '.$month2.'/'.$day2.'</b>';
			// Display time
			//$print .= ', '.implode(' and ', $data[$i]['time']);

			$print .= ' - ';
			$countName = count($data[$i]['name']);
			if ($countName == 2){
				$print .= '<b>DOUBLE FEATURE:</b><br>';
			}

			if ($countName != 1){
				$print .= '<span style="margin-left:30px;">';
			}
			else {
				$print .= '<span>';
			}
			$print .= ' '.implode(' <b>and</b> ', $data[$i]['name']);
			$print .= '</span>';
			$print .= '<br>';

			// Space between weeks
			// if($i != (count($data)-1) && $week != date('W', strtotime($data[$i+1]['date']))){
			// 	$print .= '<br>';
			// }
		}
		echo $print;
		?>
	</div>
</div>

<div>
	<p style="margin-left: 10px; margin-top: 1px;">Have questions about movie titles and show times?  Email us at <br /><a href="mailto:SU-Gallaghertheater@email.arizona.edu">SU-GallagherTheater@email.arizona.edu</a><br />
    <span style="color:#f26522;">PLEASE NOTE:</span> Movie titles and show times are subject to change.  
    </p><br/>
</div>

<div>
<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gallagher.png" id="icon">Event Space Pricing<i class="su-arrow"></i></div>
	</div>
</span>
</div>
<div>
<p style="margin-left: 10px; margin-top: 1px;">For event space booking, please contact the Event Planning Office directly at <a href="mailto:su-sueventplanning@email.arizona.edu">su-sueventplanning@email.arizona.edu</a>.</p>
</div>

<div class="container" style="width:100%;">
<img src="images/gallagher06.jpg" alt="Gallagher Announcement" width="800" />
<!--4 sliding images are replaced by a single image.-->
<!--    
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
	  <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
	<div class="carousel-inner">
      <div class="item active">
        <img src="./images/slides/380-0-20190822.jpg" alt="First Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/380-1-20190822.jpg" alt="Second Slide" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="./images/slides/380-2-20190822.jpg" alt="Third Slide" style="width:100%;">
      </div>

	  <div class="item">
        <img src="./images/slides/380-3-20190822.jpg" alt="Last Slide" style="width:100%;">
      </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
-->
</div>

<script type="text/javascript" src="/template/common/js/collapse.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
-->
<?php
involv_finish();
