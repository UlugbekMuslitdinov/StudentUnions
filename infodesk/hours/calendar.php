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
					<p id="today">Today's Hour</p>
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

	<div id="caldiv">
		<div class="card" name="calendar">
			<div class="card-text" name="month">
			<span class="previous" onclick="window.location='<?php print './calendar.php?month=' . $Pmonth . '&year=' . $Pyear; ?>'" style="cursor:pointer;"><</span>
			<?php print ' <b>' . $months[$month - 1] . ' ' . $year . '</b>'; ?>
			<span class="next" onclick="window.location='<?php print './calendar.php?month=' . $Nmonth . '&year=' . $Nyear; ?>'" style="cursor:pointer;">></span>
			</div>
		</div>
		<table align="center" cellspacing="2" class="calendar">
			<tbody>
				
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
		
		<p style="font-size:16px; margin-top: 10px;">&nbsp;&nbsp;Click on a week to see its full schedule.</p>
		
		<div style="clear:both;"></div>

	</div>

</div>

<?php infodesk_finish(); ?>