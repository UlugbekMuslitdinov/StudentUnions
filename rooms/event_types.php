<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['page'] = 'Types of Events';
$page_options['header_image'] = '/template/images/banners/gamesroom_banner.jpg';
rooms_start($page_options);
?>
<style>
	.main-list li {
		margin-top: 1em;
	}
</style>
<h1>Types of Events Held in the
<br />
Student Union Memorial Center</h1>
<p>
	The meeting rooms and ballrooms available in the Student Union Memorial Center are available for a number of types of events. Below are some of the 
	ways you can use our rooms:
</p>
<ul class="main-list" style="margin-left:20px; line-height: 1.25em;">
	<li>
		<b>Weekly Meetings</b>
	</li>
	<li>
		<b>Classes</b>
	</li>
	<li>
		<b>One-time Events</b>
	</li>
	<li>
		<b>Catered Meals and Receptions</b>
	</li>
	<li>
		<b>Conferences</b>
		<br>
		Potential conferences may request a booking hold on the Student Union Memorial Center up to (2) two years before their scheduled event. At the one year 
		mark, the group will need to commit to an official booking and put a 50% deposit on the facility. If the conference cancels less than (60) sixty days 
		before the event date, the deposit is non-refundable.
	</li>
	<li>
		<b>High-Occupancy/High-Risk Events</b>
		<br>
		All groups hosting high-occupancy events (dances, concerts, etc.) will need to submit a completed High Occupancy Event Request Form at least (3) three 
		weeks prior to the event. The group must agree to abide by the policies of the Arizona Student Unions&#146; facilities. All groups hosting such events 
		will be required to meet with a representative of the Arizona Student Unions Operations department prior to the date of the event to discuss details such 
		as payment for room charges, cleanup, setup and security. The &#147;High-Occupancy Event Request Form&#148; is available from the Event Services office.
	</li>
</ul>
<?php rooms_finish(); ?>