<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once ('deliverance.inc.php');
page_start($page_options);
?>
<?php
require_once ('catering_slider.inc.php');
?>
<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>
<script type="text/javascript">
	$(function() {
		// --- Using the default options:
		$("li.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "li.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	});
</script>

<div id="catering_page" >
	<?php
	require_once ('catering_left_col.inc.php');
	?>
	<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" />


	<div id="center-col" >


		<h2>Arizona Catering Company Policies</h2>

		<p>
			Thank you for choosing Arizona Catering Company as your event caterer! We continually strive to provide exceptional service and
			extraordinary culinary experiences for your event, meeting, conference or banquet. Founded on simplicity and driven by excellence,
			Arizona Catering Company creates memorable experiences and successful events.
		</p>


		<p style="margin-top: 1.5em; margin-bottom: 1em;">
		Click on the topics to show/hide the content.
		</p>

	 	<div id="content">
		<ul style="margin-top: 20px;">
		<li class="expand" >
		 <strong>ORDERING INFORMATION</strong>
		</li>

		<div class="collapse" >
			<p>
				To insure a successful event your food and beverage order must be placed a minimum of 7 business days prior to your event.
				All orders placed less than 7 business days prior to event date must be placed directly with Event Planning Office by calling
				520-621-1989.  Orders placed less than 7 days may have limited menu options and staffing. All orders must include the following
				information:
			</p>
			<ol>
				<li>Name</li>
				<li>Department, College, Company or Organization</li>
				<li>Phone Number</li>
				<li>Email</li>
				<li>Type of Event or Service Needed</li>
				<li>Number of Guests</li>
				<li>Location of Event or Delivery</li>
				<li>Time of Event (Arrival/Delivery, Start of Event and End of Event)</li>
				<li>Method of Payment (If paying with UA Access Account number, please have number and sub codes available when placing order)</li>
			</ol>
			<p>
				An Event Order will be provided for your final review and approval.  Guarantees are due 3 business days prior to event date.
				Your order / event will not be processed without signature and approval of order.
			</p>
			<br /><hr /><br />
		</div>


		<li class="expand" >
		 <strong>GUARANTEES</strong>
		 </li>
		<div class="collapse" >
				<p>
					Arizona Catering Company requires the final order and guest guarantee a minimum of 3 business days prior to the event date, this includes
					<strong>ALL</strong> allergy, vegetarian, vegan, gluten free or special needs requirements for event menu.  Once the guarantee is given,
					the count cannot be reduced.  Requests for increases after count is given will be handled on an individual bases based on product requested.
					Please note Arizona Catering Company prepares for the guest count only.  No additional product will be provided unless ordered.  Final
					billing will be based on guarantee or actual guests attendance, whichever is higher. Changes to guest count or food order placed
					less than 3 days prior to event date may be subject to additional fees or menu adjusted based on product availability and costs.  Additional
					charges will be presented by Event Planner prior to event date.
				</p>
				<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>CHOICE OF ENTRÉE</strong>
		  </li>
		<div class="collapse" >
			<p>
				A choice of three entrees (including vegetarian) may be offered to attendees. Charges for all meals is based on the highest priced entrée.
				Final count for number of each entrée is due three business days prior to the event. A place card must be provided for each guest indicating
				their entrée selection.
			</p>
			<p>
				Two guest lists are required:
			</p>
			<ol>
				<li>Guests names in alphabetical order listing entrée choice and table number.</li>
				<li>Guest list by table number indicating the guest name and entrée choice. Vegetarian, Dietary or Special menu needs are in addition to the
					entrée choice but cannot exceed three entrée options total.</li>
			</ol>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>SERVICE FEES AND STATE TAX</strong>
		 </li>
		<div class="collapse" >
			<p>
				All events requiring service staff to remain for all or part of the event will be subject to <strong>18% Service Charge</strong>.
				Arizona state tax (currently 6.1%) will be added to all
				food and beverage items. If your organization is tax exempt for Rooms and Meals tax, please forward the appropriate
				documentation.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>MENU PRICING</strong>
			</li>
		<div class="collapse" >
			<p>
				All menus and pricing is subject to change in the event of unforeseen market changes.  Arizona Catering Company reserves the right to
				adjust prices as needed.  If this occurs your Event Planner will provide you with new menu pricing as well as options to adjust menu
				to keep original menu pricing. Final menu selecion must be placed a minimum of 10 days prior to event. Prices are guaranteed 30 days prior to event.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>ALCOHOL SERVICE</strong>
		</li>
		<div class="collapse" >
			<p>
				Any event wanting to provide Alcohol must complete Alcohol Permit Application <a href="/alcohol/"
					onclick="window.open(this.href); return false;"
					onkeypress="window.open(this.href); return false;">www.union.arizona.edu/alcohol</a> and
				submit to permit office for approval.  Application must be submitted a minimum of 3 weeks prior to event date.  Approval will be forward
				to contact listed on application.  Questions regarding application or policy please contact 520-621-9463. Permit fee of $75 per event will be charged to your final event charges.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>CANCELLATIONS</strong>
		</li>
		<div class="collapse" >
			<p>
				All cancellations made less than 15 days prior to event date will be subject to the following charges:
			</p>
			<table border="0" cellpadding="0" cellspacing="0" >
				<tr>
					<td width="150">15 – 7 days</td>
					<td>25% of total food/beverage purchase</td>
				</tr>
				<tr>
					<td>7 – 3 days</td>
					<td>50% of total food/beverage purchase</td>
				</tr>
				<tr>
					<td>Less than 3 days</td>
					<td>100% of total food/beverage purchase</td>
				</tr>
			</table>
			<p>
				In the case the event was cancelled due to weather or Act of God no cancellation fee will apply.
				In the case that the event date is changed to a date within 30 days of the original date no cancellation fee will apply, provided the date was changed more than 3 days prior to the original event date.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>PAYMENT</strong>
		</li>
		<div class="collapse" >
			<p>
				Approved payment options include:
			</p>

			<ul>
				<li>
					<strong>UA Access Account Number: </strong> correct billing information must be provided when placing order.
				</li>
				<li>
					<strong>Credit Card: </strong> Visa, Mastercard and American Express are all accepted as full, partial or deposit payments.
					Credit Card Authorization will be handled through SU Accounting Department and receipt will be provided at the time of payment.
					Credit Card payments must be made within 7 days following the event date unless otherwise stated in contract.
				</li>
				<li>
					<strong>Direct Bill: </strong> Approval for billing post event will be handled on an individual basis.  Please ask your Event
					Planner for more information.
				</li>
			</ul>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>MEETING ROOMS</strong>
		</li>
		<div class="collapse" >
			<p>
				All events booked in the Student Union that do not require or request any food or beverage services will be subject to a setup fee
				of $1.50 per person for theater seating or existing Boardroom seating.  For rooms requiring Classroom seating, conference seating
				or rounds a charge of $2.50 per person will apply.  Setup fees include all requested / ordered tables, chairs and applicable linens
				as well as water service.  Setup fees are not subject to service charges.  Applicable sales tax will be applied.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>STAFFING</strong>
		</li>
		<div class="collapse" >
			<p>
				Arizona Catering Company will provide appropriate event staff for all events.  In the event your event requires additional staffing due
				to style of event or service needs, the Event Planner will provide you with options to consider.  ALL Chef Attended stations require an
				attended fee of $50.00.
			</p>
			<p>
				Should the scheduled starting of a function be delayed by more than one hour (60 minutes) without prior notification from the client,
				an overtime labor charge of $25 per server per hour will be applied to client’s account. The charges will also apply if function does
				not end at scheduled time.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>OFFICE HOURS OF OPERATIONS</strong>
		</li>
		<div class="collapse" >
			<p>
				The Arizona Catering Company Event Planning Office is open 8am – 5pm Monday through Friday or by appointment.  Office is closed for
				University Holidays.  Event and Delivery Hours of Operation are based on each client individually and needs of event.  All events
				taking place in Student Union must end by Midnight.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>DELIVERY POLICIES</strong>
		</li>
		<div class="collapse" >
			<p>
				Arizona Catering Company offers complete campus delivery and pickup services.  Off-site event venues and needs are handled on an
				individual basis.  Please note that Arizona Catering Company drivers and staff do not have keys to any campus buildings.  It is
				the responsibility of the client to make arrangements to have the building and event space unlocked and available for delivery
				and set up.  Please speak with your Event Planner to determine an arrival and set up time for any events taking place outside of
				the Student Union. All pickups will be arranged with the client at the time of delivery.  In the event the pickup staff arrives
				at appointed time and cannot access building or event space an additional fee will apply to return at another time to retrieve
				equipment. Arizona Catering Company no longer charges individual delivery charges.  Please see below for applicable service charges.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>SERVICE INCLUDED</strong>
		</li>
		<div class="collapse" >
			<ul>
				<li><strong>DELIVERY/DROP OFF SERVICE: </strong>  All delivery/drop offs will include complete set up of ordered food, beverage and trash receptacles.
					Food/Beverage tables will include standard linen, disposable ware (including plates, utensils, cups, service utensils when applicable).
					</li>
				<li><strong>REQUIRED EVENTS: </strong> All events requiring service staff to remain for all or part of the event will include complete set up of
					ordered food, beverage, service area and appropriate guests tables.  Food/Beverage tables and guests tables will include standard linens,
					china, silverware, glassware and appropriate service equipment.</li>
			</ul>
			<p>
				<i>
					Please speak with your Event Planner if interested in specialty linens or décor for your event.  Appropriate rental fees will apply based
					on request.
				</i>
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>CHANGES TO ROOM SET UP &amp; EVENT CLEAN UP</strong>
		</li>
		<div class="collapse" >
			<p>
				Appropriate labor charges may apply when additional set up is required in event rooms after the event order &amp; set up have been approved by the client and set up completed.
				The Event Order is distributed 7 business days prior to the event. Labor charges of $50.00 per hour, per employee may apply to events
				that require more than the standard cleanup at the conclusion of the event. Please do not include glitter and/or confetti in your decor.
				Please make arrangements to remove all items from the event location immediately at the end of the event. Arizona Catering Company is
				not responsible for items left behind. Picking up items the following day is not always possible due to functions and other events scheduled
				in the same space.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>STUDENT UNION CONFLICT OF INTEREST POLICY</strong>
		</li>
		<div class="collapse" >
			<p>
				The Arizona Student Union has established contracts with retail and service providers in the Student Union and areas campus wide.
				The purpose of this policy is to identify the services provided exclusively by existing contracted companies.
			</p>
			<p>
				Any department, organization, college, company or campus organization that reserves space in the Student Unions or hosts events on
				the University of Arizona Campus must provide the Arizona Student Unions a list of proposed companies or organizations involved with
				their event.
			</p>
			<p>
				To avoid existing contractual conflict, the Student Unions will review the list of proposed companies or organizations whose University
				sponsorship or participation may create a contractual breach with exclusivity rights guaranteed to companies already contracted with
				the Arizona Student Unions.  Potential conflicts include, but may not be limited to service similar to these listed below:
			</p>
			<ul>
				<li>Education Testing Services</li>
				<li>Travel Agency</li>
				<li>Catering Companies or any food/beverage service provider</li>
				<li>Restaurants/Fast Food Companies</li>
				<li>Career Counseling/Job Help</li>
				<li>Bookstores</li>
				<li>Mailing/Shipping Companies</li>
				<li>Copy Services</li>
				<li>Computer Services</li>
				<li>Banking/Financial Institution</li>
			</ul>
			<p>
				To avoid conflict <strong>ALL</strong> food and beverage service provided at <strong>ANY</strong> event within the Student Union
				<strong>MUST</strong> be provided by Arizona Catering Company and/or Campus Dining Services.
			</p>
			<p>
				The Arizona Student Unions reserves the sole right to enforce this policy and to make final decisions as to which companies or organizations
				are conflicts of interest with existing contracts.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>CONDUCT OF EVENT</strong>
		</li>
		<div class="collapse" >
			<p>
				Client undertakes to conduct the Event in an orderly manner, in full compliance with applicable laws, regulations and University of Arizona,
				Student Union and Arizona Catering Company rules. Client accepts full responsibility for the conduct of all persons in attendance and for
				any damage done to any part of the University of Arizona, Student Union and Arizona Catering Company's premises during any time such premises
				are under the control of Client, or Client's agents, invitee, employees or independent contractors employed by Client. Client hereby indemnifies
				and holds harmless the University of Arizona, Student Union and Arizona Catering Company and each of the foregoing, against any and all claims,
				liabilities or costs (including reasonable attorney's fees and whether by reasons of personal injury or death or property damage or otherwise)
				arising out of or connected with the Event or this Agreement, caused or contributed to by the negligence of Client, or any guest, invitee or
				agent of Client or any independent contractor hired by Client. Upon the request of University of Arizona, Student Union and Arizona Catering
				Company, Client shall procure and maintain, at its expense, policies of insurance, in such amounts, upon such terms and with such responsible
				insurance companies shall be satisfactory to University of Arizona, Student Union and Arizona Catering Company, including comprehensive general
				liability coverage
				and such workers compensation, employers liability and automobile liability coverage as may be required by University of Arizona, Student Union
				and Arizona Catering Company. Certificates of the issuance of each such policy shall be delivered to University of Arizona, Student Union and
				Arizona Catering Company at least three (3) days prior to the Event. Each such policy shall name the University of Arizona, Student Union and
				Arizona Catering Company as additional insured. Such insurance shall be considered primary of any similar insurance carried by any of the above
				named parties.
			</p>
			<br /><hr /><br />
		</div>

		<li class="expand" >
		 <strong>SECURITY</strong>
		</li>
		<div class="collapse" >
			<p>
				If required, in the sole judgment of University of Arizona, Student Union and Arizona Catering Company, in order to maintain adequate security
				measures in light of the size and nature of Event, Client shall provide, at its expense, a minimum of uniformed guards (not to carry weapons),
				supervisors and ushers (the Security Personnel). All Security Personnel shall be supplied by UAPD. The Security Personnel are to coordinate with
				University of Arizona Student Union and Arizona Catering Company’s regular security force and shall concern themselves only with access to the
				space reserved hereunder (or substituted therefore), restricting their presence to these areas of the premises of the Student Union.
			</p>
			<br /><hr /><br />
		</div>
		</ul>
		</div>
			<br />
			<br />
			<br />
		</div>

	</div>
	<?php
	require_once ('catering_right_col.inc.php');
    ?>
</div>

<div style="clear:both;">
	<br />
	<br />
</div>

<?php page_finish(); ?>
