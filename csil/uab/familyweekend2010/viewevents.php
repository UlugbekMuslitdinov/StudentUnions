<?php
require_once 'template/fw.inc';
require_once 'events.inc';

if($_GET['day']=='fri')
	$title = 'Friday\'s Events';
elseif($_GET['day']=='sat')
	$title = 'Saturday\'s Events';
else
	$title = 'Sunday\'s Events';
fw_start($title);
?>
<p style="margin-left:0px; padding-left:0px;">Our event list for Family Weekend 2010 is taking shape. See the list below for the tentative schedule, and check back soon for further updates.</p>
<?php if($_GET['day']=='fri'):?>
<h4>Friday, October 8</h4>
<br/>
<?php 
for($x=0; $x<sizeof($fri_events); $x++){
?>
					<h3><?=$fri_events[$x]['title']?></h3>
					<div style="padding:0 0 0 20px;">
						<?=$fri_events[$x]['desc']?><br />
						<b><?=$fri_events[$x]['time']?> &#9679; <?=$fri_events[$x]['location']?> &#9679; <?=$fri_events[$x]['price']==''?'Included with Registration':$fri_events[$x]['price']?></b>
					</div>
					<br />


<?php 
}
endif;


 if($_GET['day']=='sat'):?>
<h4>Saturday, October 9</h4>
<br/>
<?php 
for($x=0; $x<sizeof($sat_events); $x++){
?>
					<h3><?=$sat_events[$x]['title']?></h3>
					<div style="padding:0 0 0 20px;">
						<?=$sat_events[$x]['desc']?><br />
						<b><?=$sat_events[$x]['time']?> &#9679; <?=$sat_events[$x]['location']?> &#9679; <?=$sat_events[$x]['price']==''?'Included with Registration':$sat_events[$x]['price']?></b>
					</div>
					<br />


<?php 
}
endif;


if($_GET['day']=='sun'):?>
<h4>Sunday, October 10</h4>
<br/>
<?php 
for($x=0; $x<sizeof($sun_events); $x++){
?>
					<h3><?=$sun_events[$x]['title']?></h3>
					<div style="padding:0 0 0 20px;">
						<?=$sun_events[$x]['desc']?><br />
						<b><?=$sun_events[$x]['time']?> &#9679; <?=$sun_events[$x]['location']?> &#9679; <?=$sun_events[$x]['price']==''?'Included with Registration':$sun_events[$x]['price']?></b>
					</div>
					<br />


<?php 
}
endif;
fw_finish();
?>