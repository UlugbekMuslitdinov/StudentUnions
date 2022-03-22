<?php
header('Location: /');
exit();

require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Park Student Union';
$page_options['nav']['PSU']['Places to Eat']['link'] = '/dining/index.php';
$page_options['nav']['PSU']['Maps']['link'] = '/infodesk/maps/index.php';
$page_options['nav']['PSU']['Room Scheduling']['link'] = '/rooms/index.php';
$page_options['nav']['PSU']['PSU BookStore']['link'] = 'http://www.uofabookstores.com/uaz/AboutUs/PSUHours.asp';
$page_options['nav']['PSU']['Meeting Rooms']['link'] = '/psu/meeting.php';
$page_options['nav']['PSU']['Photo Gallery']['link'] = '/about/gallery/index.php';
$page_options['nav']['PSU']['Gaming Center']['link'] = '/psu/code.php';
$page_options['header_image'] = '/template/images/banners/PSU.png';
page_start($page_options);
?>
<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3">
		<h2>Park Student Union has 3 new meeting rooms available for your department or student group:
		<br>
		</h2> Stop by to check them out or call 621-1414 or 621-1989 to reserve  or request a quote.
		<br>
		All rooms are equipped with a movie screen and white board.
		<br>
		A/V equipment is available upon request.
		<br>
		Redington Catering serves all rooms. 
		</td>
	</tr>
	<tr>
		<td width="49%"><b><a href="/rooms/layouts/index.php?room=diamondback">Diamondback Room</a></b>
		<br>
		A corner room with an open round table for 10 people with additional chairs around the perimeter of the room
		<p>
			<b><a href="/rooms/layouts/index.php?room=javelina">Javelina Room</a></b>
			<br>
			A middle room with a standard set up of auditorium style seating for 24 with a presenters table at the front of the room
		</p></td>
		<td width="16"></td>
		<td valign="top" width="50%">
		<p>
			<b><a href="/rooms/layouts/index.php?room=coati">Coati Room</a></b>
			<br>
			A room with a standard set up of auditorium style seating for 24 with a presenters table at the front of the room.
		</p>
		<p>
			<b><a href="/rooms/layouts/index.php?room=meeting-a">PSU Full Meeting Room</a></b>
			<br>
			All rooms are separated by retractable air wall allowing for the us90e fo2 to 3 of the rooms to be reserved for banquets and other large meetings
		</p>
		</td>
	</tr>
</table>
<?php page_finish()
?>