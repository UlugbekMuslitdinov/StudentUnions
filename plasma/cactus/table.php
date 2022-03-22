<?php
  	require_once('includes/mysqli.inc');
	
	$dbh = new db_mysqli('plasma_cactus');
	
	$result = $dbh->query("SELECT * FROM `slides`");
	while($row = $result->fetch_assoc())
	{
		for($i = 0; $i < 24; $i++)
		{
			$time = strtotime($i.':00:00');
			if(strtotime($row['start_time']) <= $time && time() > strtotime($row['start_date']) && $time < strtotime($row['end_time']) && time() < strtotime($row['end_date']))
				$data[intval($row['day'])][$i] .= $row['slide_set'] . ' - ' . $row['resource_id'] . '<br/>';
		}
	}
?>
<style>
td
{
	padding: 5px
}
</style>
<table>
	<thead>
		<tr><td>Time</td><td>Monday</td><td>Tuesday</td><td>Wednesday</td><td>Thursday</td><td>Friday</td><td>Saturday</td><td>Sunday</td></tr>
	</thead>
	<tbody>
<?php

	for($i = 0; $i < 24; $i++)
	{
		print '<tr><td>'.$i.':00</td>';
		for($j = 1; $j <= 7; $j++)
		{
			$style = (($i + $j) % 2 == 0) ? "style=\"background-color: #EEF\"" : "style=\"background-color: #EFE\"";
			print "<td $style>" . $data[$j][$i] . '</td>';
		}
		print '</tr>';
	}
?>