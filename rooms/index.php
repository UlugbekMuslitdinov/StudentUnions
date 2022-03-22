<?php
header("Location: ../index.php");
require_once ('rooms.inc');
require_once ('hours.inc');
$page_options['title'] = 'Event Services';
rooms_start($page_options);
?>
<h1>Room Rental</h1>

<?php printLocationHours(36) ?>

<table width="950" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="50%">
		<p>
			The Arizona Student Unions offer a variety of meeting rooms, banquet facilities, and conference spaces in the Student Union Memorial Center (SUMC). 
			Room reservations and catering orders can be arranged by contacting the Event Services Office at (520) 621-1414 or by visiting us on the 
			<a href="/infodesk/maps/index.php">3rd floor of the SUMC</a>. Our office is open weekdays from 8 a.m. to 5 p.m.
		</p>
		<p>
			The SUMC facilities are available for use by students, UA departments, colleges, nonprofit organizations and commercial businesses. With its central 
			campus location, the SUMC offers the ideal setting, amenities and eclectic catering options for any event, meeting, conference, activity or special event.
		</p>
		<p>
			Whether you are coordinating a week-long conference or scheduling a weekly meeting, we will be happy to accommodate your needs. Contact our Event 
			Services Office and we can begin working with you to plan an incredible event.
		</p>
		<p>
			Our phone: (520) 621-1414
			<br>

			Fax: (520) 621-2545
		</p>
		 
		<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
			<tr>
				<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="8" bgcolor="white">
					<tr>
						<td>
						<p>
							<b>COMMENCEMENT EVENTS</b><br />
							To accommodate the maximum number of Commencement events possible in Student Union Memorial Center, all commencement requests must be made 
							in writing and submitted to the Event Services office. We do not confirm any commencement requests more than one year in advance. Please note 
							commencement requests are <u>requests only</u> and do not constitute a confirmation for space. Reservation requests will not be considered confirmed 
							until the Event Services office sends an official reservation confirmation from our office. All requests will be reviewed by the Event Services 
							manager before being scheduled. 	
						</p>
						</td>
					</tr>
				</table></td>
			</tr>
		</table><p></p></td>
		<td valign="top" width="30" >&nbsp;&nbsp;</td>
		<td valign="top" width="150">
		<p>
		<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="https://risk.arizona.edu/fire-safety/heat-sources">Policies ON</a></b><br />
		Candles, Open Flames, Pyrotechnics and <br />Other Heat Sources
		<br>
		</p>
		<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/rooms/reserving.php">Reserving a Room</a></b>
		<br>
		The basics of who can reserve a room and how.
		<p style="width: 300px;" ><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/rooms/event_types.php">Types of Events</a></b>
			<br>
			Some of the types of events that our rooms are available for.
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b>Procedures by Group Type</b>
			<br>
			<a href="/rooms/procedures_studentorg.php">Student Clubs &amp; Organizations</a>
			<br>
			<a href="/rooms/procedures_university.php">University Offices &amp; Departments</a>
			<br>
			<a href="/rooms/procedures_other.php">Non-University Groups </a>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/rooms/procedures.php">General Procedures</a></b>
			<br>
			<a href="/rooms/procedures.php">Making a reservation</a>
			<br>
			<a href="/rooms/procedures.php#confirmation">Confirmations</a>
			<br>
			<a href="/rooms/procedures.php#cancellation"> Cancellation/No-Show Policy</a>
			<br>
			<a href="/rooms/procedures.php#servicerates">Miscellaneous Service Rates</a>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b>Rates</b>
			<br>
			<a href="/rooms/roomrates.php">Room Rates</a>
			<br>
			<a href="/rooms/layouts/index.php">Room Layouts</a>
			<br>
			<a href="/rooms/audiovisual.php">Equipment Rental Pricing</a>
			<br>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b>Room Locations</b>
			<br>
			<a href="/rooms/map_level2.php">level 2</a>
			<br>
			<a href="/rooms/map_level3.php">level 3</a>
			<br>
			<a href="/rooms/map_level4.php">level 4</a>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0" style="margin-bottom: 2px;">&nbsp;<b><a href="/rooms/reservation_form.php" style="font-size: 1.5em; font-weight: bold; background-color: #EDEDED; padding: 3px;">Reservation Form</a></b>
		</p>
		<p style="width: 300px;" ><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/rooms/services.php">Special Services</a></b>
			<br>
			Catering, A/V Equipment Rental, &amp; Outdoor Spaces
		</p>
		<p style="width: 300px;" ><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/cgi-bin/WebObjects/EventsCalendar.woa/wa/roomSchedulingEvents">Room Scheduling Events</a></b>
			<br>
			View scheduled events taking place in the SUMC &amp; PSU
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/rooms/policies.php">General Room Use Policies</a></b>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/operations/policies/banners.php">Banner Hanging Policies</a></b>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/operations/policies/bulletinboards.php">Bulletin Board Use Policies</a></b>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/operations/policies/dances.php">Dance Policies</a></b>
		</p>
		<p><img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b><a href="/operations/policies/index.php">Other Policies</a></b>
		</p></td>
	</tr>
</table>

<?php printLocationHours(36) ?>
<br />
<?php rooms_finish()
?>