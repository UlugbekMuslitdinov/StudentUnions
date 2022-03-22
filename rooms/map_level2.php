<?php
  require_once('rooms.inc');
  $page_options['title'] = 'Room Locations - Level 2';
  rooms_start($page_options);
?>
<h1>Room Locations</h1>
<table width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="4" bgcolor="white">
				<tr>
					<td><a href="/rooms/map_level2.php">level 2</a> :: <a href="/rooms/map_level3.php">level 3</a> :: <a href="/rooms/map_level4.php">level 4</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<p><img src="/rooms/template/images/map_level2.jpg" alt="student union memorial center map, level 2" height="363" width="500" border="0"></p>
<p><img src="/rooms/template/images/map_legend.gif" alt="" height="150" width="500" border="0"></p>
<?php rooms_finish() ?>