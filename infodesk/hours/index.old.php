<?php
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



function convert_time($cur_time) {
	$tme=strtotime($cur_time);
	$tme1 = date('g', $tme);
	if(date('i', $tme)!="00"){
		$tme1 .= date(':i', $tme); 
	}
	if(date('a', $tme)=="am"){
		return $tme1 .= "a";
	}
	else{
		return $tme1.= "p";
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
	$table_title = '<span style="float:right; margin-right:7px;">
						<a href="index.php?cat='.$category.'&open" style="font-size:12px; font-weight:bold; color:#ffffff; text-decoration:none;">
						 	What\'s Open Now?
						 </a>
					</span>
					Today\'s Hours*';
	
	
	if(isset($_GET['open'])){
		$today_or_open = 'open';
		$table_title = '<span style="float:right; margin-right:7px;">
						<a href="index.php?cat='.$category.'" style="font-size:12px; font-weight:bold; color:#ffffff; text-decoration:none;">
						 	Today\'s Hours
						 </a>
					</span>
					Open Now*';	
	}
	
	///////////////////////////////////////////////////////////////////////////
	
	/////////////////////////// PULL LOCATIONS AND HOURS //////////////////////
	
	$cur_date = date("Y-m-d");
	$cur_day = date('N');
	
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
			
			if (strtotime($cur_today_open) >= strtotime($cur_today_close)) {
				if (strtotime($cur_today_open) <= time() && time() <= mktime(0,0,0,date("m"),date("d")+1,date("Y"))) {
					$reverseAndOpen = TRUE;
				}
			}
			
			if ((strtotime($cur_today_open) <= time() && strtotime($cur_today_close) >= time() || $reverseAndOpen) && $todays_hours != 'closed' && $todays_hours != 'coming soon'){
				$locations[] = array('name' => $location['location_name'], 'hours' => $todays_hours, 'url' => $location['location_url']);
			}
			
		}
		//otherwise add to locations array to be displayed
		else{
			$locations[] = array('name' => $location['location_name'], 'hours' => $todays_hours, 'url' => $location['location_url']);							
		}
		
	}
	/////////////////////////////////////////////////////////////////////////////






$page_options['title'] = 'Hours';
$page_options['page'] = 'Union Hours';
$page_options['header_image'] = '/template/images/banners/hours_banner.jpg';
infodesk_start($page_options);
// page_start($page_options);
?>
<style>
	#right-col {
		padding: 0px;
		width: 205px;
		/* float: right; */
		margin-left: 15px;
	}
	#right-col img {
		margin-bottom: 5px;
	}

	#center-col {
		/* float: left;
		width: 564px; */
	}
	#center-col h1 {
		font-size: 30px;
		line-height: 32px;
		color: #776655;
		margin-top: 0px;
	}
	#center-col h2 {
		font-size: 18px;
		color: #444444;
		margin-top: 0px;
		margin-bottom: 8px;
	}
	#center-col p {
		font-size: 12px;
		line-height: 14px;
		color: #444444;
	}
	#center-col p a:link, #center-col p a:visted, #center-col p a:active, #center-col p a:hover {
		font-size: 12px;
		font-decoration: none;
		color: #bb2244;
	}
	table td, table td .location {
		/* height: 27px;
		line-height: 27px; */
		color: #444444;
		/* font-size: 10px; */
	}

	.row1 {
		background-color: #b7b6b1;
	}
	.row0 {
		background-color: #e5e4de;
	}
	.rowlast, .rowfirst {
		/*background-color:#ffffff;*/
		background-color: #e5e4de;
	}
	.names {
		padding-left: 15px;
	}
	.hours {
		width: 90px;
	}

	#caldiv tr {
		color: #444444;
		background-color: #b7b6b1;
		cursor: pointer;
	}
	#caldiv td {
		width: 25px;
		text-align: center;
	}
	#caldiv td.off {

		background-color: #e5e4de;
	}
	#caldiv .highlight {
		background-color: #ffd186;
	}

	@media (max-width:767px){
		#right-col { display: none; }
		.names { padding-left: 5px; }
	}

</style>
<!-- <img src="images/header.jpg" height="303" style="margin-top:6px; margin-bottom:20px;"/> -->


	<div id="center-col" class="col">

		<h1><?=isset($cat_titles[$category])?$cat_titles[$category]:''?></h1>

		<div class="row p-1">

			<div class="col-12 p-0">
				<div class="hours-table-title" style="">
					&nbsp;<?=$table_title ?>
				</div>
			</div>

			<div class="col col-sm-6 p-0" style="border-right: 1px solid #fff;">
				<table cellspacing="0" cellpadding="0" width="100%" >
					<tbody>
						<?php
						foreach ($locations as $key => $value) {
							if (substr($value['name'], -54) == ' <span style="font-weight:normal;">Coming Soon!</span>') {
								$locations[$key]['name'] = substr($value['name'], 0, -54);
							}
						}

						$num = sizeof($locations);
						$half = intval($num / 2) + $num % 2;

						for ($x = 0; $x < $half; $x++) {
							print '<tr class="row' . ($x % 2) . '"><td class="names"><a class="location" ' . (!empty($locations[$x]['url']) ? 'href="' . $locations[$x]['url'] . '"' : 'style=""') . '>' . $locations[$x]['name'] . '</a></td><td class="hours">' . $locations[$x]['hours'] . '</td></tr>';
						}
						?>
					</tbody>
				</table>
			</div>

			<div class="col col-sm-6 p-0" style="border-left: 1px solid #fff;">
				<table cellspacing="0" cellpadding="0" width="100%" >
					<tbody>
						<?php
						$i = 0;
						for ($x = $half; $x < ($half * 2); $x++) {
							if (array_key_exists($x, $locations)){
								print '<tr class="row' . ($i % 2) . '"><td class="names"><a class="location" ' . (!empty($locations[$x]['url']) ? 'href="' . $locations[$x]['url'] . '"' : 'style=""') . '>' . $locations[$x]['name'] . '</a></td><td class="hours">' . $locations[$x]['hours'] . '</td></tr>';
								$i++;
							}
						}
						?>
					</tbody>
				</table>
			</div>

			<div class="col-12">
				<span style="font-size:15px; color:#444444;">*Hours may be subject to change without notice.</span>
			</div>

		</div>
		

		<div style="background-color:#363636; height:10px; float:left; width:100%;   margin-top:8px;"></div>
		
	</div>

	<div id="right-col" class="col">

<?php
	$months = explode(', ', 'January, February, March, April, May, June, July, August, September, October, November, December');

	if (isset($_GET['year']))
		$year = intval($_GET['year']);
	else
		$year = date("Y");

	if (isset($_GET['month']))
		$month = intval($_GET['month']);
	else
		$month = date('m');

	if ($month == 12) {
		$Nmonth = 1;
		$Nyear = $year + 1;
	} else {
		$Nmonth = $month + 1;
		$Nyear = $year;
	}

	if ($month == 1) {
		$Pmonth = 12;
		$Pyear = $year - 1;
	} else {
		$Pmonth = $month - 1;
		$Pyear = $year;
	}

	$first_day_month = date("Y-m-1", strtotime($year . "-" . $month . "-1"));
	$last_day_month = date("Y-m-t", strtotime($year . "-" . $month . "-1"));

	$days = date("t", strtotime($year . "-" . $month . "-1"));

	$first_day_week = date("N", strtotime($year . '-' . $month . '-1'));

	//var_dump($hours);
	for ($i = $first_day_week - 2; $i > -1; $i--) {
		$cal[$i]['day'] = '';
		$cal[$i]['type'] = 'off';
	}

	$d = 1;
	$dayss = $days + $first_day_week - 1;
	for ($i = $first_day_week - 1; $i < $dayss; $i++) {
		$cal[$i]['day'] = $d++;

	}

	for ($i = $i; $i < 42; $i++) {
		$cal[$i]['day'] = '';
		$cal[$i]['type'] = 'off';
	}

	//var_dump($time);

	$i = 0;
	$w = 0;
?>
<script>
	function edit_week(week) {
		window.open('week.php?date=' + week, 'Hours');
	}

</script>


	<link rel="stylesheet" type="text/css" href="style.css">

	<div id="caldiv" align="center">
        <div style="padding-top:15px; color:#444444;">
			<span style="font-size:14px;">
	            <span  onclick="window.location='<?php print './index.php?month=' . $Pmonth . '&year=' . $Pyear; ?>'" style="cursor:pointer;"><</span>
	            <?php print '<b>' . $months[$month - 1] . "</b> " . $year; ?>
	            <span onclick="window.location='<?php print './index.php?month=' . $Nmonth . '&year=' . $Nyear; ?>'" style="cursor:pointer;">></span>
			</span>
            <table style="clear:both; margin-top:0px;" cellspacing="2" class="calendar">
                <tbody>
                    <tr>
                        
                        <td style="background-color:#FFFFFF;">mon</td>
                        <td style="background-color:#FFFFFF;">tue</td>
                        <td style="background-color:#FFFFFF;">wed</td>
                        <td style="background-color:#FFFFFF;">thu</td>
                        <td style="background-color:#FFFFFF;">fri</td>
                        <td style="background-color:#FFFFFF;">sat</td>
						<td style="background-color:#FFFFFF;">sun</td>
                    </tr>
                    
                    <tr onclick="edit_week('<?php print $year . '-' . $month . '-1'; ?>')" onmouseover="this.className='highlight'" onmouseout="this.className=''">
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                    </tr>
                    <tr onclick="edit_week('<?php print $year.'-'.$month.'-'.$cal[$i]['day']?>')" onmouseover="this.className='highlight'" onmouseout="this.className=''">
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                    </tr>
                    <tr onclick="edit_week('<?php print $year . '-' . $month . '-' . $cal[$i]['day']; ?>')" onmouseover="this.className='highlight'" onmouseout="this.className=''">
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                    </tr>
                    <tr onclick="edit_week('<?php print $year . '-' . $month . '-' . $cal[$i]['day']; ?>')" onmouseover="this.className='highlight'" onmouseout="this.className=''">
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                    </tr>
                    <tr onclick="edit_week('<?php print $year . '-' . $month . '-' . $cal[$i]['day']; ?>')" onmouseover="this.className='highlight'" onmouseout="this.className=''">
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                    </tr>
					<?php if($cal[$i]['day'] != ''){?>
                    <tr onclick="edit_week('<?php print $year . '-' . $month . '-' . $cal[$i]['day']; ?>')" onmouseover="this.className='highlight'" onmouseout="this.className=''">
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i++]['day']; ?></td>
                        <td id="cell<?php print $i; ?>" class="<?= array_key_exists('type', $cal[$i])?$cal[$i]['type']:'' ?>"><?php print $cal[$i]['day']; ?></td>
                    </tr>
					<?php } ?>
                </tbody>
            </table>
			<p align="left" style="font-size:9px; margin-bottom: 10px;">&nbsp;&nbsp;Click on a week to see its full schedule.</p>
        </div>
        <div style="clear:both;"></div>
    </div>












		<?php
		include_once ($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");
		// randomFeed(6);
		?>
		<!-- <a href="/events"><img src="/template/images/buttons/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php"><img src="/template/images/buttons/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus"><img src="/template/images/buttons/tellus_btn.jpg" alt="donate" /></a> -->
	</div><!-- End of Right Column -->
<?php
		infodesk_finish();
	