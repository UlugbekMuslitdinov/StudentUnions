<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['title'] = 'Reserving a Room: University Departments';
$page_options['page'] = 'University Offices or Departments';
rooms_start($page_options);
?>
<style>
	h1 {
		margin-bottom: .25em !important;
	}
	h2 {
		margin-top: 1em !important;
		margin-bottom: .1em !important;
	}
	p {
		margin-top: .05em !important;
		margin-bottom: 1.5em !important;
	}
</style>
<h1 style="">Reserving a Room: University Offices and Departments</h1>
<p>
	University departments can schedule space in the Student Union Memorial Center up to one (1) year in advance for conferences and other special 
	activities. High Profile or large events taking place annually may be scheduled up to 2 years in advance of the day of the event.	 
</p>
<h2>Room Assignments</h2>
<p>
	A variety of rooms are available for use by University Departments: small meeting rooms, mid-size lecture rooms, or multipurpose rooms are available. 
	The Arizona Student Unions will strive to assign the room preferred. Each day, room assignments are posted outside the meeting rooms and at various 
	locations throughout the SUMC. An agenda of daily events is also posted at the SUMC Information Desk. <b>The Arizona Student Unions reserve the right to reassign rooms to serve the greatest number of programs and services.</b> The Event Services Office will provide notification of changes to reservations as promptly as possible via email, 
	phone or fax.
</p>
<h2>Room Charges</h2>
<p>
	<b>University departments are permitted two preset rooms per week, with a (2) two hour limit at no charge</b> for day-to-day meetings only. Special 
	events, conferences, extended days in the same week or multiple rooms on the same day are billed accordingly. Departments that go over the (2) two 
	rooms per week limit will also be billed the <a href="/rooms/roomrates.php">appropriate room charge</a>.
</p>
<p>
	<b>Groups that misrepresent an event or affiliation in order to avoid fees and charges will be charged appropriately and may have their reservation 
	privileges suspended. These determinations are made by the Director of the Arizona Student Unions.</b>
</p>
<h2>Confirmation</h2>
<p>
	The Event Services office will confirm requested reservations on the <a href="/rooms/reservation_form.php">submitted form</a> by fax, telephone, mail, or 
	email. All reservations made by phone or walk-in will also receive a confirmation. <b>The reserving group&#146;s contact person will be required to sign 
	the room confirmation agreeing to the policies and procedures of the Arizona Student Unions and return the signed confirmation to the Event Services 
	office within (2) days of receipt.</b> Catered meals will receive a confirmation when the menu for the event has been submitted to the Event Services office.
</p>
<?php rooms_finish()
?>