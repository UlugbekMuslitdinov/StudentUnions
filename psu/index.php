<?php
header('Location: /');
exit();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
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
<table width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#e6e6e6">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="8">
				<tr>
					<td bgcolor="white">
						<div align="center">
							<img src="/psu/images/core_logo.gif" alt="" border="0">&nbsp;&nbsp;&nbsp;&nbsp;<img src="/psu/images/logo_lapetite.jpeg" alt="" height="65" border="0">&nbsp;&nbsp;&nbsp;&nbsp;<img src="/psu/images/logo_iq.gif" alt="" height="65" width="65" border="0"></div>
					</td>
				</tr>
				<tr>
					<td bgcolor="white">
						<div align="center">
							<img src="images/logo_bageltalk.jpg" alt="" height="60" width="100" border="0">&nbsp;&nbsp;&nbsp;&nbsp;<img src="/psu/images/logo_route66.gif" alt="" height="65" width="67" border="0">&nbsp;&nbsp;&nbsp;&nbsp;<img src="/psu/images/logo_ondeck.gif" alt="" height="65" border="0"></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br>
<a href="/psu/code.php"><img src="images/PSUGame_Banner.jpg" width="498" height="128" border="0" longdesc="http://www.union.arizona.edu/psugaming" /></a>
<table width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
<tr>
		<td>
		</td>
	</tr>
</table>

<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3">
			<h2><br>Park Student Union has expanded the food options for breakfast, lunch and dinner:<br>
				<br>
			</h2>
		</td>
	</tr>
	<tr>
		<td width="49%" valign="top">
  			<p style="vertical-align:top"><b><font color="#333366"><a href="/dining/psu/parkdining">Park Avenue Dining</a><br>
					</font></b>Within walking distance of many of the UA residence halls on the West side of campus, enjoy a full breakfast, pasta, salads, burgers, variety of homemade entrees, and deli-style sandwiches.</p>
			<p style="vertical-align:top"><b><font color="#333366"><a href="/dining/psu/parkmarket">Park Avenue Market</a><br>
					</font></b>Now located on the main level of Park Student Union, the expanded retail experience boasts everything from typical convenience store fare to frozen yogurt and snacks to college swag like t-shirts, school supplies, UA gifts and more.</p>
			<p></p>
		</td>
		<td width="16">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td valign="top" width="50%">
			<p><b><font color="#333366"><a href="/dining/psu/bageltalk">Bagel Talk</a><br>
					</font></b>bagels &amp; sandwiches</p>
			<p><b><font color="#333366"><a href="/dining/psu/lapetite">La Petite Patisserie Now open!</a><br>
					</font></b>Freshly baked pastries, sweet and savory crepes, fruit smoothies, and coffee and espresso.</p>
			<p><a href="/dining/sumc/core/"><b>Core</b></a><br>
							Core is designed to offer healthy, tasty and unique food options that meet your needs.</p>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<h2><br>Park Student Union has expanded the services available to you:<br>
				<br>
			</h2>
		</td>
	</tr>
	<tr>
		<td valign="top" width="49%">
			<div align="center">
				<img src="/psu/images/UABookstorePSU-logo.gif" alt="" width="100" height="63" border="0"><br>
				<p><b><a href="http://www.uofabookstores.com/uaz/AboutUs/PSUHours.asp">PSU BookStore<br>
							<br>
						</a></b></p>
				<p><img src="/psu/images/ResLife_NewLogo(clr).gif" alt="" width="100" height="72" border="0"></p>
				<p><b><a href="http://www.life.arizona.edu/">Residence Life Office, West Area</a></b></p>
				<br />
				<p><img src="/psu/images/thinktank.png" alt=""  border="0"></p>
				<p><b><a href="http://thinktank.arizona.edu/">The Think Tank</a></b></p>
			</div>
			<p></p>
		</td>
		<td width="16"></td>
		<td valign="top" width="50%">
			<div align="center">
				<p><img src="/psu/images/KAMP_Logo_blue.gif" alt="" width="120" height="38" border="0"></p>
				<p><b><a href="http://kamp.arizona.edu">KAMP Radio<br>
							<br>
						</a></b></p>
			</div>
			<p><b><a href="http://wc.arizona.edu/azmedia/">Arizona Student Media</a></b></p>
			<p><b>Other Services</b></p>
			<p>Self Serve Copy Machines<br>
				Universal Money ATM<br>
				Information Desk<br>
				Study Lounge<br>
				Commuter Cyber Station<br>
				Internet Computer Stations<br>
					Cash to Chip Machine<br>
				Vending Machines<br>Expanded indoor and outdoor patio seating including a courtyard</p>
		</td>
	</tr>
</table>
<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3">
			<h2><br>Park Student Union has expanded its entertainment:<br>
				<br>
			</h2>
		</td>
	</tr>
	<tr>
		<td width="49%">
			<ul>
            	<li><a href="/psu/code.php"><strong>PSU Gaming Center<br />
                	</strong></a><br />
                    Xbox 360, PS3 and Wii coming!
				<li>Friday Night Poker tournaments
				<li>Billiards tables and foosball
				<li>Direct TV Satelite on 7 TV's
				<li>Live Music every Wednesday from 5-7p
			</ul>
		</td>
		<td></td>
		<td>Check out our other free programs by clicking on the events link to the left.</td>
	</tr>
	<tr>
		<td colspan="3">
			<h2><br>Park Student Union has 3 new meeting rooms available for your department or student group:<br></h2>
			Stop by to check them out or call 621-1414 or 621-1989 to reserve  or request a quote.<br>All rooms are equipped with a movie screen and white board.<br>
					A/V equipment is available upon request.<br>
				Redington Catering serves all rooms.
		
		</td>
	</tr>
	<tr>
		<td width="49%"><b><a href="/rooms/layouts/index.php?room=diamondback">Diamondback Room</a></b><br>
			A corner room with an open round table for 10 people with additional chairs around the perimeter of the room
			<p><b><a href="/rooms/layouts/index.php?room=javelina">Javelina Room</a></b><br>
				A middle room with a standard set up of auditorium style seating for 24 with a presenters table at the front of the room</p>
		</td>
		<td width="16"></td>
		<td valign="top" width="50%">
			<p><b><a href="/rooms/layouts/index.php?room=coati">Coati Room</a></b><br>
				A room with a standard set up of auditorium style seating for 24 with a presenters table at the front of the room.</p>
			<p><b><a href="/rooms/layouts/index.php?room=meeting-a">PSU Full Meeting Room</a></b><br>
				All rooms are separated by a retractable air wall allowing for
				  the use of 2 to 3 rooms to be reserved for banquets
				  and other large meetings.</p>
		</td>
	</tr>
</table>
<p>Park Student Union<br>
	615 N. Park, Tucson, AZ 85721</p>
<?php page_finish() ?>