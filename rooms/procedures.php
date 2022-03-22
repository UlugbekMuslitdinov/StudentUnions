<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
  $page_options['title'] = 'General Procedures';
  $page_options['page'] = 'Reservation Procedures';
  rooms_start($page_options);
?>
<style type="text/css">
#content {
	width: 750px;
}
#content ul, ol {
	line-height: 1.25em;
	margin-top: 5px;
}
#content li {
	margin-top: 5px;
}
.collapse p, hr {
	width:588px !important;
}
</style>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>
<script type="text/javascript">
	$(function() {
		// --- Using the default options:
		$("h2.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "h2.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	}); 
</script>

<h1 style="width: 800px;">General Procedures for Reserving a Room</h1>

<p style="margin-top: 20px; margin-bottom: -5px;">Click on the topics to display the content.</p>

<a name="top"></a>

<div id="content">
<ol style="margin-left:20px; margin-top: 20px;">
	
	<h2 class="expand" >Contact</h2>
	<div class="collapse">
		<p>
			Please submit completed <a href="/rooms/reservation_form.php">room reservation request forms</a>, questions and comments to the Event Service Office.  
		</p>
		<p>
			<strong>Location:</strong> Event Services Office, 3rd floor of the Student Union Memorial Center.  1303 E University Blvd, Tucson, AZ 85721.
		</p>
		<p>
			<strong>Phone Number:</strong> 520-621-1414
		</p>
		<p>
			<strong>Email Address:</strong> SUeventplanning@email.arizona.edu 
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	<!--	
	<h2 class="expand" >Determine your room reservation needs:</h2> 
	<div class="collapse">
		<p>
			What kind of event are you planning? Will you need the space each week or only one time? How many people do you expect to attend your event? 
			Will you want food at your event? What A/V Equipment will you require? Special set-ups? Be prepared to provide the Event coordinator with 
			the details of your event when making your room reservation.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	-->
	<h2 class="expand" >Room Assignments:</h2>
	<div class="collapse">
		<p>
			When booking a room at the Student Union Memorial Center by submitting a <a href="/template/resources/forms/RoomReservationRequestForm.pdf" target="_blank">room reservation request form</a>, the client will receive a contract prior to their event confirming room location, A/V, setup, and catering details.  Though the Arizona Student Unions strive to assign the room preferred, availability cannot be guaranteed. The Arizona Student Unions reserves the right to reassign rooms to serve the greatest number of programs and services for the university. The Event Services Office will provide notification of changes to reservations promptly via email. 
		</p>
		<p> 
		Each day, room assignments are posted outside the meeting rooms and at various locations throughout the Student Union Memorial Center. 
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	<!--
	<h2 class="expand" ><a name="confirmation"></a>Confirmation:</h2>
	<div class="collapse">
		<p>
			The Event Services office will confirm requested reservations on the submitted form by fax, telephone, mail, or email. All reservations made by phone or 
			walk-in will also receive a confirmation. The reserving group’s contact person will be required to sign the room confirmation agreeing to the SUMC policies 
			and procedures r and return the signed confirmation to the Event Services office within two (2) two days of receipt. Catered meals will receive a confirmation 
			when the menu for the event has been submitted to Event Services.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	-->	
	<h2 class="expand" ><a name="cancellation"></a>Cancellations:</h2>
	<div class="collapse">
		<p>
	 		The Arizona Student Unions reserves the right to assess a cancellation fee if written notice to cancel a room reservation is not submitted at least 14 days prior to the event for general meeting rooms and 45 days prior to the event for Ballrooms, Sonora Room, Kachina Lounge, Gallagher Theater, Union Gallery, and Games Room. 
		</p>
		<p>
			General meeting rooms canceled less than 14 days prior to the event will incur a 50% charge of the room rental. 
		</p>
		<p>
			General meeting rooms canceled less than 3 days prior to the event will be billed in full.
		</p>
		<p> 
			Ballrooms, Sonora Room, Kachina Lounge, Gallagher Theater, Union Gallery, or Games Room canceled less than 45 days prior to the event will incur a 50% charge of the room rental. 
		</p>
		<p>
			Ballrooms, Sonora Room, Kachina Lounge, Gallagher Theater, Union Gallery, or Games Room canceled less than 14 prior to the event will be billed in full. 
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	
	<h2 class="expand" >No Shows:</h2>
	<div class="collapse">
		<p>
	 		Room reservations with signed contracts will be billed in full if not canceled prior to the event date regardless of client/guest attendance.  A second occurrence may lead to suspension of room booking privileges for the group/department/organization.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	
	<h2 class="expand" >Recognized Student Groups:</h2>
	<div class="collapse">
		<p>
	 		All recognized student groups are permitted two preset meeting rooms per week, with a two-hour limit per meeting, at no charge. These groups may book rooms each semester as needed on a first-come basis. 
		</p>
		<p>
			Only the President or Treasurer of recognized student organizations can make reservations or changes to reservations for their clubs. Room charges apply to any student group who exceed the weekly allotted rooms, the two-hour time limit, or violate any Student Union policies.
		</p>
		<p>
			Room reservations for events charging an admission do not qualify for no-charge rooms and all will be assessed a room charge.
		</p>
		<p>
			Groups that misrepresent an event or affiliation in order to avoid fees and charges will be charged appropriately and may have their reservation privileges suspended, as determined by the Associate Director of Catering and Event Services.
		</p>
		<p>
			Available rooms include: Agave, Cholla, Copper, Ocotillo, Presidio, Sabino, San Pedro, Santa Cruz, Tubac, and Ventana.
		</p>
		<p>
			For room rates please go <a href="/rooms/roomrates.php" target="_blank">here</a>.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	
	<h2 class="expand" >University Departments:</h2>
	<div class="collapse">
		<p>
	 		University departments are permitted two preset meeting rooms per week, with a two-hour limit per meeting, at no charge for standard department meetings. Conferences, extended days in the same week or multiple rooms on the same day do not qualify.  Departments requesting more than two preset meeting rooms per week will be charged for any additional reservations.  Departments may book rooms each semester as needed on a first-come basis. 
		</p>
		<p>
			Room reservations for events charging an admission do not qualify for no-charge rooms and all will be assessed a room charge.
		</p>
		<p>
			Departments that misrepresent an event or affiliation in order to avoid fees and charges will be charged appropriately and may have their reservation privileges suspended, as determined by the Associate Director of Catering and Event Services.
		</p>
		<p>
			Available rooms include: Agave, Cholla, Copper, Ocotillo, Presidio, Sabino, San Pedro, Santa Cruz, Tubac, and Ventana.
		</p>
		<p>
			For room rates please go <a href="/rooms/roomrates.php" target="_blank">here</a>.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	<!--
	<h2 class="expand" >Room Charges:</h2>
	<div class="collapse">
		<p>
	 		All recognized student groups are allowed two (2) preset meeting rooms per week, with a two-hour limit per meeting, at no charge. These groups may 
	 		book rooms each semester as needed on a first come basis. <b>Available rooms are:</b> Agave, Cholla, Copper, Ocotillo, Presidio, Sabina, San Pedro, Santa Cruz, 
	 		Tubac, Ventana.
		</p>
		<p>
			Only the President or Treasurer of the recognized student organizations can make reservations or changes to reservations for their clubs. Room charges 
			apply to any student group who exceed the weekly allotted rooms or the two-hour time limit. 
		</p>
		<p>
			University departments are permitted two (2) preset meeting rooms per week with a two (2) hour limit at no charge, for day-to-day meetings  only and does 
			not include conferences, extended days in the same week or multiple rooms on the same day. Departments that go over the two-rooms-per-week limit will be 
			charged a <a href="/rooms/roomrates.php" >room charge</a>.
		</p>
		<p>
			All student groups and departments charging an admission fee for their events will be assessed a room charge. There is a rental fee for ballrooms and rooms 
			whenever setup is required.
		</p>
		<p>
			Groups that misrepresent an event or affiliation in order to avoid fees and charges will be charged appropriately and may have their reservation privileges 
			suspended, as determined by the Unions’ Associate Director. All fees, if applicable are due and payable within 30 (thirty) days of the event. 
		</p>
		<p>
			For room rates please go <a href="/rooms/roomrates.php" >here</a>. 
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	-->
	
	<!--
	<h2 class="expand" ><a name="servicerates"></a>Miscellaneous Service Rates:</h2>
	<div class="collapse">
		 <ul style="float: left; margin-left: 20px; list-style-type: none;">
			<li>Banner Space</li>
			<li>Lift with operator</li>
			<li>Clean Up Charge</li>
			<li>Labor charge</li>
			<li>Overtime (for use of room after official closing time)</li>
			<li>Piano</li>
			<li>Moving of piano on stage</li>
			<li>Barco Projector (does not include operator or VCR)</li>
			<li>Small Tent (10' X 10')</li>
			<li>Large Tent (20' X 30')</li>
		</ul>
		<ul style="float: left; margin-left: 40px; list-style-type: none;">
			<li>$25.00 per day</li>
			<li>$35.00 per hour</li>
			<li>$50.00 minimum charge</li>
			<li>$50.00 per hour (2 hour minimum)</li>
			<li>$35.00 per hour</li>
			<li>$45.00 per day</li>
			<li>$100.00 minimum charge</li>
			<li>$125.00 per day</li>
			<li>$80.00 per day</li>
			<li>$225.00 per day</li>
		</ul>
		<br style="clear: both;" />
		<p class="top" >
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	-->
	
	<h2 class="expand" >Room Setups:</h2>
	<div class="collapse">
		<p>
	 		Setup and equipment needs for rooms are to be requested at the time the reservation is made. Some rooms in the SUMC are available with an existing standard setup (preset) and their setups cannot be changed. Other rooms may be arranged in a variety of configurations. Please note that if you require a specific set up, some rooms may not be available.  For more complicated setups, special diagrams for room reservations can be created and requested through our Event Planners.  
		</p>
		<p>
			Furniture, including tables and chairs, may only be moved by Arizona Student Unions staff. When possible, we will try to accommodate all changes to reservations, but due to timing and staffing constraints, changes to setup may not always be possible. Last minute requests to room setup may incur labor charges.

		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	
	
	
	<h2 class="expand" >Advertising:</h2>
	<div class="collapse">
		<p>
	 		Any advertising for the promotion of a program or special event to be held in a Student Union space, such as newspaper releases, posters, tickets 
	 		and handbills must indicate the sponsoring group. Any advertising or promotion of an event must be discussed with and approved by the Student Union 
	 		Memorial Center Event Services office at the time the reservation is made and before it is confirmed. 
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	
	
	
	<h2 class="expand" >Additional Personnel &amp; Security:</h2> 
	<div class="collapse">
		<p>
			Some events in the Student Union Memorial Center may require additional event personnel or specialized technicians. The cost of the required event personnel will be charged to the reserving group. Whenever possible, these charges will be discussed in advance and will be reflected on the event contract. 
		</p>
		<p>
			Additionally, some events such determined to be high risk or involving high occupancy may require security personnel. Only UA police or other campus approved security companies may be used to satisfy security requirements. The client will be responsible for coordinating and paying for security personnel.

		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	
	<h2 class="expand" >Parking:</h2>
	<div class="collapse">
		<p>
	 		If your event will require vehicle parking for guests, please contact Parking and Transportation Services at (520) 626-7275. 
		</p>
		<p>
			The rental of space in the Student Union Memorial Center does not include parking. 
		</p>
		<p>
			The nearest public parking facility is the Second Street Garage, located behind the Student Union Memorial Center.

		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<hr  class="clear" />
		<br />
	</div>
	
</ol>

</div>
<br /><br />
<?php rooms_finish() ?>