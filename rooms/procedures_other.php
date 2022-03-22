<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['title'] = 'Reserving a Room: Non-University Groups';
$page_options['page'] = 'Non-University Groups';
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
<h1 style="width: 120%;">Reserving a Room: Non-University Groups</h1>
<p>
	The Arizona Student Unions welcome Non-University groups to host events at the Student Union Memorial Center. Non-University groups hosting SUMC events
	are required to sign a contract with the Arizona Student Unions ten (10) business days prior to their event and are required to <b>deposit 50% on the facility
	fee.</b> Since the facilities are primarily intended to support the campus community, priority booking has been extended to on-campus entities. Therefore, 
	<b>Non-University groups will be given the opportunity to book space <i>after</i> student groups and campus departments.</b>
</p>
<h2>Room Assignments</h2>
<p>
	A variety of rooms are available for use by off-campus groups: small meeting rooms, mid-size lecture rooms, or multipurpose rooms are available.
	The Arizona Student Unions will strive to assign the room preferred. Each day, room assignments are posted outside the meeting rooms and at various
	locations throughout the Union. Please refer to our <a href="/rooms/roomrates.php">list of the charges for rooms in the Student Union Memorial
	Center</a>. <b>The Arizona Student Unions reserves the right to reassign rooms to serve the greatest number of programs and services.</b> The Event
	Services Office will provide notification of changes to reservations as promptly as possible via email, phone or fax.
</p>

<h2>Confirmation</h2>
<p>
	The Event Services office will confirm requested reservations on the <a href="/rooms/reservation_form.php">submitted form</a> by fax, telephone, mail,
	or email. All reservations made by phone or walk-in will also receive a confirmation. <b>The reserving group&#146;s contact person will be required
	to sign the room confirmation agreeing to the policies and procedures of the Arizona Student Unions and return the signed confirmation to the Event
	Services office within (2) two days of receipt.</b> Catered meals will receive a confirmation when the menu for the event has been submitted to the
	Event Services office.
</p>

<h2>Cancellations</h2>
<p>
	The Arizona Student Unions reserve the right to impose a cancellation fee if written notice to cancel a space is not submitted at least five (5) working
	days prior to the event for general meeting rooms and thirty (30) days prior to the event for ballrooms. Meeting rooms canceled less than 5 working days
	before the event will incur a 50% charge of the room rental and less than 3 days prior notice will be billed in full. Ballrooms canceled less than (30)
	thirty days prior to the event will be billed at 50% of the room rental and less than (15) fifteen days notice prior to the event will be billed in full.
	Off campus groups will be required to leave a deposit of 25% of the total catering bill which will be applied to the final catering charges. If the event
	should cancel less than (30) thirty days prior to the scheduled time, the deposit is not refundable.

</p>

<h2>No Shows</h2>
<p>
	Five (5) working day&#146;s notice is required to cancel a general meeting room reservation in the Student Union Memorial Center to avoid paying a cancellation
	fee. Full room charges will be enforced for all No Shows on reservations with existing charges or with rooms where physical labor has been expended.
</p>

<?php rooms_finish()
?>