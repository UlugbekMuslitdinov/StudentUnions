<?php
require_once 'template/fw.inc';
require_once 'events.inc';

fw_start('At a Glance');
?>
<p style="margin-left:0px; padding-left:0px;">Our event list for Family Weekend 2010 is taking shape. See the list below for the tentative schedule, and check back soon for further updates.</p>
<h3>Friday, October 8</h3>
<table style="line-height:normal;">
	<tbody>
	<?php 
		foreach($fri_events as $event)
			print '<tr><td width="150px" style="padding-right:10px">'.$event['time'].'</td><td>'.$event['title'].'</td></tr>';
	?>
	</tbody>
</table>
<br />
<h3>Saturday, October 9</h3>
<table>
	<tbody>
	<?php 
		foreach($sat_events as $event)
			print '<tr><td width="150px" style="padding-right:10px">'.$event['time'].'</td><td>'.$event['title'].'</td></tr>';
	?>
	</tbody>
</table>
<br />
<h3>Sunday, October 10</h3>
<table>
	<tbody>
	<?php 
		foreach($sun_events as $event)
			print '<tr><td width="150px" style="padding-right:10px">'.$event['time'].'</td><td>'.$event['title'].'</td></tr>';
	?>
	</tbody>
</table>

<?php 
fw_finish();
?>