<?php
date_default_timezone_set('America/Phoenix');

// require_once($_SERVER['DOCUMENT_ROOT'] . '/template/global.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/infodesk/template/infodesk.main.php');

	############################################
	# required for all pages using DELIVERANCE #
	############################################
 
	// enables 'edit | view' options to appear for authorized users
	// session_start();

	// connect to database
	// require_once("/srv/www/htdocs/commontools/deliverance/inc_db_switch.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/inc_db_switch.php");

	// includes the display functions
	require_once($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/display_functions.php");

	################################
	# end DELIVERANCE requirements #
	################################


require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('hours2');

$locations = array();

// convert opening hour to a.m/p.m format
function convert_time($cur_time) {
	$tme=strtotime($cur_time);
	$tme1 = date('g', $tme);
	if(date('i', $tme)!="00"){
		$tme1 .= date(':i', $tme); 
	}
	if(date('a', $tme)=="am"){
		return $tme1 .= "a.m";
	}
	else{
		return $tme1.= "p.m";
	}
}

//looking at a categories hours (e.g . Dining , SUMC ...)

	//////////////////////// SET CATEGORY /////////////////////////////////////
	
	//valid categories with where clause to pull only location in that categorey
	$allowed_cat = array(
					'all' 		=> ' ',
	 				'sumc'		=> ' and group_id=1',
					'psu'		=> ' and group_id=2',
					'ufs'		=> ' and group_id=3',
					'admin'		=> ' and group_id=4',
					'dining'	=> ' and subgroup="Dining"',
					'services'	=> ' and subgroup="Services"'
					);
					
	$cat_titles = array(
					'all' 		=> 'All Hours...',
	 				'sumc'		=> 'Student Union Memorial Center...',
					'psu'		=> 'Park Student Union...',
					'ufs'		=> 'Union Outlets...',
					'admin'		=> 'Administrative...',
					'dining'	=> 'Dining...',
					'services'	=> 'Retail &amp; Services...'
					);
					
	//set category
	$category = isset($_GET['cat'])?$_GET['cat']:'';
					
	//if invalid category is passed in set to all
	if(isset($allowed_cat[$category]) && !$allowed_cat[$category]){
		$category = 'all';	
	}
	//get part of where clause to pull the current category
	$cat_where = isset($allowed_cat[$category])?$allowed_cat[$category]:'';
	
	///////////////////////////////////////////////////////////////////////////
	
	///////////////////////////// TODAYS HOURS VS WHATS OPEN //////////////////
	
	//default to showing todays hours
	$today_or_open = 'today';
	
	if(isset($_GET['open'])){
		$today_or_open = 'open';	
	}
	
	///////////////////////////////////////////////////////////////////////////
	
	/////////////////////////// PULL LOCATIONS AND HOURS //////////////////////
	
	$cur_date = date("Y-m-d");
	$cur_day = date('N');

	$timezone = date_default_timezone_get();
	echo "The current server timezone is: " . $timezone . '<br>';
	$date = date('m/d/Y h:i:s a', time());
	echo 'The current time is ' . $date . '<br>';
	
	//select all locations from current category
	$query = 'select * from location where 1'.$cat_where.' order by location_name';
	$result = $db->query($query);
	
	//loop through locations getting hours and add to array to be displayed later
	while($location = mysqli_fetch_assoc($result)){
		
		//pull default hours for this location
		$query = 'select hours.* from hours join periods on hours.type=periods.type join location on hours.location_id=location.location_id where start_date<="'.$cur_date.'" and end_date>="'.$cur_date.'" and location.location_id='.$location['location_id'];
		$result2 = $db->query($query);
		$default_hours = mysqli_fetch_array($result2);
		
		//set the hours for today from default day of week
		$cur_today_open = $default_hours[(($cur_day*2)-1)];
		$cur_today_close = $default_hours[($cur_day*2)];
		
		//pull any exceptions if there are any
		$result2 = $db->query('select * from exceptions where date_of="'.$cur_date.'" and location_id='.$location['location_id']);
		$location_exceptions = mysqli_fetch_assoc($result2);
		
		//if there are exceptions overwrite the defaults
		if ($location_exceptions!=null) {
			$cur_today_open=$location_exceptions['open'];
			$cur_today_close=$location_exceptions['close'];
		}
		
		//mark as closed if so otherwise format hours
		if ($cur_today_open==$cur_today_close && $cur_today_open=="00:00:00") {
			$todays_hours = 'closed';
		}
		// highland market is open 24hrs during the regular school year.
		else if ($cur_today_open==$cur_today_close && $cur_today_open!="00:00:00") {
			$todays_hours = 'open 24hrs';
		}
		else{
			$todays_hours = convert_time($cur_today_open).' - '.convert_time($cur_today_close);
		}
		
		//check if only pulling open locations
		
		if($today_or_open == 'open'){
			
			// reset the flag.
			// otherwise, everything shows as open.
			$reverseAndOpen = FALSE;
			
			// change >= to <= 
			if (strtotime($cur_today_open) <= strtotime($cur_today_close)) {   
				if (strtotime($cur_today_open) <= time() && time() <= mktime(0,0,0,date("m"),date("d")+1,date("Y"))) {
					$reverseAndOpen = TRUE;
				}
			}
			
			if ((strtotime($cur_today_open) <= time() && strtotime($cur_today_close) >= time() || $reverseAndOpen) && $todays_hours != 'closed' && $todays_hours != 'coming soon'){
				if (strtotime($cur_today_close) >= time()){
					$locations[] = array('name' => $location['location_name'], 'hours' => $todays_hours, 'url' => $location['location_url'], 'close_time' => strtotime($cur_today_close), 'current_time' => time());
				}

				// date('m/d/Y H:i:s', time())
			}
			
		}
		//otherwise add to locations array to be displayed
		else{
			$locations[] = array('name' => $location['location_name'], 'hours' => $todays_hours, 'url' => $location['location_url']);							
		}
		
	}
	/////////////////////////////////////////////////////////////////////////////
	// echo '<pre>';
	// var_dump($locations);

$page_options['title'] = 'Hours';
$page_options['page'] = 'Union Hours';
$page_options['header_image'] = '/template/images/banners/hours_banner.jpg';
infodesk_start($page_options);
// page_start($page_options);
?>

<link rel="stylesheet" type="text/css" href="style.css">

<div class="col">

	<div class="bar">
		<div class="row m-0 hours-nav">
			<!-- <a id="bar3" name="today" class=""> -->
				<div class="dropdown col-sm-4 hours-nav-list" name="today">
					<p id="today">Today's Hours</p>
					<div class="dropdown-content">
						<a href="index.php">All Locations</a>
						<a href="index.php?cat=sumc">SUMC</a>
						<a href="index.php?cat=psu">Park Student Union</a>
						<a href="index.php?cat=ufs">Union Outlets</a>
					</div>
				</div>
			<!-- </a> -->
			<!-- <a class="col-sm-4" id="bar3" href="index.php?cat=<?php echo $category; ?>&open">What's Open Now?</a> -->
			<!-- <a id="bar3" class=""> -->
				<div class="dropdown col-sm-4 hours-nav-list" name="today">
					<p id="today">What's Open Now?</p>
					<div class="dropdown-content">
						<a href="index.php?open">All Locations</a>
						<a href="index.php?cat=sumc&open">SUMC</a>
						<a href="index.php?cat=psu&open">Park Student Union</a>
						<a href="index.php?cat=ufs&open">Union Outlets</a>
					</div>
				</div>
			<!-- </a> -->
			<a class="col-sm-4 hours-nav-list" id="bar3" href="calendar.php">Calendar</a>
		</div>
	</div>

	<h2 style="padding-top: 20px; padding-left: 15px;">
		<?php
			switch ($category) {
				case 'sumc':
					echo 'Student Unions Memorial Center';
					break;

				case 'psu':
					echo 'Park Student Unions';
					break;
				
				case 'ufs':
					echo 'Union Outlets';
					break;
				
				default:
					echo "All Locations";
					break;
			}
		?>
	</h2>

	<div class="locations">

	<?php
	foreach ($locations as $key => $value) {
		if (substr($value['name'], -54) == ' <span style="font-weight:normal;">Coming Soon!</span>') {
			$locations[$key]['name'] = substr($value['name'], 0, -54);
		}
	}

	$num = sizeof($locations);
	if ($num == 0){
		echo '<p style="padding-left: 15px;">All locations are closed.</p>';
	}

		$half = intval($num / 2) + $num % 2;

		for ($x = 0; $x < $half; $x++) {
			// echo $locations[$x]['name'] . $locations[$x]['hours'];
			// echo '<br>';
			print '<div class="card col-6 col-sm-12 col-md-4">' . '<img src="images/location.png" id="icon">' . '<a class="card-name" ' . (!empty($locations[$x]['url']) ? 'href="' . $locations[$x]['url'] . '"' : 'style=""') . '>' . $locations[$x]['name'] . '<div class="card-hour">' . $locations[$x]['hours'] . '</div></a></div>';
		}
	?>

	<?php
		$i = 0;
		for ($x = $half; $x < ($half * 2); $x++) {
			if (array_key_exists($x, $locations)){
				print '<div class="card col-6 col-sm-12 col-md-4">' . '<img src="images/location.png" id="icon">' . '<a class="card-name" ' . (!empty($locations[$x]['url']) ? 'href="' . $locations[$x]['url'] . '"' : 'style=""') . '>' . $locations[$x]['name'] . '<div class="card-hour">' . $locations[$x]['hours'] . '</div></a></div>';				$i++;
			}
		}
	?>

	</div>
</div>

<?php infodesk_finish(); ?>