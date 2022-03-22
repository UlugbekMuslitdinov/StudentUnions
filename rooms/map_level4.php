<?php
	require_once('rooms.inc');
  $page_options['title'] = 'Room Locations - Level 4';
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
<p><img src="/rooms/template/images/map_level4.jpg" alt="student union memorial center map, level 4" height="342" width="500" border="0"></p>
<table width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="4">
				<tr>
					<td bgcolor="#e6e6e6" width="5%">
						<div align="center">
							<b>a</b></div>
					</td>
					<td bgcolor="white" width="45%">Ventana Room</td>
					<td bgcolor="#e6e6e6" width="5%">
						<div align="center">
							<b>d</b></div>
					</td>
					<td bgcolor="white" width="45%">Copper Room</td>
				</tr>
				<tr>
					<td bgcolor="#e6e6e6" width="5%">
						<div align="center">
							<b>b</b></div>
					</td>
					<td bgcolor="white" width="45%">Tubac Room</td>
					<td bgcolor="#e6e6e6" width="5%">
						<div align="center">
							<b>e</b></div>
					</td>
					<td bgcolor="white" width="45%">Agave Room</td>
				</tr>
				<tr>
					<td bgcolor="#e6e6e6" width="5%">
						<div align="center">
							<b>c</b></div>
					</td>
					<td bgcolor="white" width="45%">Presidio Room</td>
					<td bgcolor="#e6e6e6" width="5%">
						<div align="center">
							<b>&nbsp;</b></div>
					</td>
					<td bgcolor="white" width="45%">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<p><img src="/rooms/template/images/map_legend.gif" alt="" height="150" width="500" border="0"></p>
<?php rooms_finish() ?>