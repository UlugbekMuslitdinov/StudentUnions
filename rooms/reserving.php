<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['title'] = 'Reserving a Room';
$page_options['styles'] = '#center-col{width:780px;}';
$page_options['header_image'] = '/template/images/banners/room_reservation_banner.jpg';
$page_options['page'] = 'Reserve a Room';
rooms_start($page_options);
?>

<style>
#plugIn{
    width: 100%;
    height: 700px;
}
</style>

<h1>Reserving a Room in the Student Union Memorial Center</h1>
<p>
	The Student Union Memorial Center is designed to support the activities, meetings and conferences of the students, faculty and staff of the
	University of Arizona. Groups eligible to reserve space in the Student Union Memorial Center include:
</p>

<ol style="margin-left:20px; line-height: 1.5em !important;">
	<li>
		<a href="/rooms/procedures_studentorg.php" style="font-weight: bold;" >Student Clubs &amp; Organizations</a> that are officially recognized by <a href="http://arizonaorgs.orgsync.com"
		onclick="window.open(this.href); return false;"
		onkeypress="window.open(this.href); return false;">ASUA</a>.
	</li>
	<li>
		<a href="/rooms/procedures_university.php" style="font-weight: bold;" >University Offices &amp; Departments</a>.
	</li>
	<li>
		<a href="/rooms/procedures_other.php" style="font-weight: bold;" >Non-University Groups</a>.
	</li>
</ol>

<p>
	Room reservations and catering orders can be placed in person in the Student Union Memorial Center or by calling (520) 621-1414. Please note that
	reservation requests will be accepted and processed in order of receipt, tentative reservations will not be accepted, and priority booking is extended
	to on-campus constituents.<br><br>
</p>

<p>
	Reservation requests (for weekly or re-occurring events or meetings) must be submitted on the <a href="/rooms/reservation_form.php" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'" ><u>room reservation form</u></a>
	to the Event Services Office or sent in via fax at 621-2545.<br><br>
</p>

<!-- <p>
	For more information on room rentals, go <a href="/rooms/" 
           <a href="menu.php?unit=corepsu" rel="shadowbox;height=500;width=600" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'"><u>HERE</u></a>.
</p> -->

<p>
	<a href="/rooms/template/resources/OCCChart_2019.pdf"><u>Room Layout Capacity</u></a> at a glance. <br><br>
</p>

<!-- Remove the SocialTables Javascript plugin.  Replace it with the web link.-->
<!--
<div id="plugIn">
	<script id="socialtables-onsite-script" type="text/javascript" src="//s3.amazonaws.com/socialtables-onsite/577/socialtables-onsite.js" async></script>
</div>
-->
<p>
	Click 
		<a href="https://onsite.socialtables.com/onsite/72" a target="_blank">
			<u>HERE for a Floor Map and Available Room Layout Options</u>
		</a> of the Student Union Memorial Center.<br /><br />
</p>

<p>
	Policies on <a href="https://risk.arizona.edu/campus-safety/fire-safety" onMouseOver="this.style.color='#F58523'" onMouseOut="this.style.color='#E00A0D'" ><u><b>Candles, Open Flames, Pyrotechnics and Other Heat Sources</b></u></a>
</p>

<?php
rooms_finish()
?>
