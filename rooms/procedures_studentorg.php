<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['title'] = 'Reserving a Room: Student Organizations';
$page_options['page'] = 'Student Clubs and Organizations';
rooms_start($page_options);
?>

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

<h1 style="width: 150%;">Reserving a Room: Student Clubs and Organizations</h1>

<p>Click on the questions to display the answers.</p>

<a name="top"></a>

<div id="content">
	<h2 class="expand" >When can I reserve a room?</h2>
	<div class="collapse">
		<p>
		Officially recognized student clubs and organizations may book room reservations up to one semester in advance. Recognized student groups may begin booking space for their clubs and organizations at the end of April for the following Fall semester. Student groups can begin reserving space for the Spring semester at the beginning of November. Groups may book rooms each semester as needed on a first come basis.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Who can reserve the rooms for my group?</h2>
	<div class="collapse">
		<p>
			Only the President or Treasurer of the recognized student organizations can make reservations or changes to reservations for their recognized student group or organization.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What rooms are available?</h2>
	<div class="collapse">
		<p>
		A variety of rooms are available for use by student groups: small meeting rooms, midsize lecture rooms, or multipurpose rooms. The Arizona Student Unions will 
		strive to assign the preferred room. Go <a href="/rooms/roomrates.php" >here</a> to see which rooms are available. Please note the Unions reserve the right to 
		reassign rooms to serve the greatest number of programs and services.
		</p>
		<p>
			<b>Available rooms:</b> Agave, Cholla, Copper, Ocotillo, Presidio, Sabina, San Pedro, Santa Cruz, Tubac, Ventana
		</p>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Are there fees for rooms in the SUMC?</h2>
	<div class="collapse">
		<p>
			<b>Meeting Rooms:</b>
			<br>
			All Recognized student groups are allowed two preset meeting rooms per week, with a two-hour limit per meeting, at no charge. Room charges apply to 
			any student group who exceeds the weekly allotted rooms or the two-hour time limit. <b>All student groups and departments charging an admission fee for 
			their events will be assessed a room charge.</b>
		</p>
		<p>
			<b>Available rooms are:</b> Agave, Cholla, Copper, Ocotillo, Presidio, Sabina, San Pedro, Santa Cruz, Tubac, Ventana
		</p>
		<p>
			<b>Ballrooms:</b>
			<br>
			There is a rental fee for ballrooms and larger rooms where setup is required. All fees are due and payable within 30 days of the event. 
			Please refer to our <a href="/rooms/roomrates.php">list of available Student Union rooms and charges</a>.
		</p>
		<p>
			Groups that misrepresent an event or affiliation in order to avoid fees and charges will be charged appropriately and may have their reservation privileges 
			suspended, as determined by the Unions' Associate Director.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Will my reservation be confirmed?</h2>
	<div class="collapse">
		<p>
			Many times there are waiting lists for organizations needing space. To be most effective in coordinating space availability, it is important that 
			groups choosing not to use their scheduled room notify the Event Services office so we may reassign the space. The Event Services office will confirm 
			requested reservations by fax, telephone, mail, or email. The reserving group&#146;s faculty advisor or president will be required to sign the room 
			confirmation agreeing to the policies and procedures of the Arizona Student Unions and return the signed confirmation to the Event Services office within 
			(2) days of receipt. Catered meals will receive a confirmation when the menu for the event has been submitted to the Event Services office.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>
	
	<h2 class="expand" >What if I need to cancel my reservation?</h2>
	<div class="collapse">
		<p>
			Five (5) working day's notice is required to cancel a general meeting room reservation in the Student Union Memorial Center to avoid penalties on future 
			room use. Groups who cancel their reservation with less than 5 working days before the event will be given only one (1) late cancellation without penalty. 
			The second time a group fails to give sufficient notice to cancel a space, their privilege to reserve rooms in the Student Union Memorial Center will be 
			forfeited for the remainder of the semester.
			<br>
			<br>
		</p>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>
		
	<h2 class="expand" >What if my group doesn't show up for our scheduled reservation?</h2>
	<div class="collapse">
		<p>
			Student Groups will be given only one (1) &#147;No show&#148; per semester without penalty. The second time a group fails to give sufficient 
			notice to cancel a space, their privilege to reserve rooms in the Student Union Memorial Center will be forfeited for the remainder of the semester.
			<br>
			<br>
		</p>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>
	
	
</div>
<br />
<br />

<?php rooms_finish()
?>