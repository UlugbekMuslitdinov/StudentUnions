<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['title'] = 'Special Services';
$page_options['page'] = 'Conference Services';
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
<h1>Conference Services</h1>

<h2 style="margin-top: 15px;">Catering</h2>
<p>
	The Arizona Student Unions is the designated campus department responsible for the provision of food and beverage services for the University. 
	<!-- Please review the <a href="http://w3.arizona.edu/%7epolicy/catering.shtml">University of Arizona catering policy</a> for more information. -->
</p>
<p>
	<a href="/catering/index.php">Catering</a> features an extensive menu to meet all of your catering needs from punch and cookies to banquet 
	style gourmet meals. A complete catering service is available for events both in the Student Union Memorial Center and at Campus events at other locations. 
	Arizona Student Unions policy prohibits bringing food or beverages from outside sources into the building. Our Event Services staff is available to assist 
	you in determining your catering needs and can be reached at (520) 621-1989. Catering orders may also be faxed to the Event Services Office at 621-2545 
	or <a href="/catering/index.php">ordered on-line through our web ordering system</a>.
</p>
<p>
	To ensure the success of your event, you are advised to have all catering orders in place and finalized at least 10 working days prior to your event. If 
	your order is placed with insufficient notice, we may be unable to accommodate your needs based upon the nature and scope of your event. If a group orders 
	a full service catered meal or substantial hors d&#146;oeuvres menu, the room charge for the room where the meal is taking place will be waived.
</p>
<p>
	We are happy to provide assistance in planning a customized menu or large banquet functions. Contact our Special Events Coordinator at 621-1415. Please 
	discuss your menu options with the Event Services staff for exact pricing and facility charges.
</p>

<h2>Audio Visual Equipment Rentals</h2>
<p>
	The Arizona Student Unions have a wide variety of audio-visual equipment that can be used to enhance your meeting or event. Audio and Visual equipment should 
	be ordered from the Event Services office at the time the room reservation is requested. Requests for A/V equipment should be made no less than five (5) working 
	days before the scheduled event to assure availability. Last minute changes or additions for audio-visual equipment will include a late fee. The Arizona Student 
	Unions can provide lecterns, microphones, chalkboards, cork boards, easels, movie screens, projector stands and other equipment at a nominal charge, please 
	<a href="/rooms/audiovisual.php">refer to our equipment list for prices</a>. A/V Equipment outside the Union: For events taking place outside the Student Union 
	requiring tables, chairs or other equipment, please contact Facilities Management at 621-4701. Unfortunately, the Arizona Student Unions are unable to rent or 
	loan equipment outside the Student Union Memorial Center.
</p>

<h2>Events in Outdoor Spaces</h2>
<p>
	Often groups will want to host events outside for greater visibility and to take advantage of our wonderful Arizona weather. 
	<a href="/catering/index.php">Catering</a> services can be extended to selected outside spaces on campus. Please contact the mall events coordinator at 626-2630 
	to schedule space on the UA mall or to reserve the Student Union stage on the North plaza of the Student Union Memorial Center. For more information, please 
	visit the <a href="/mall/index.php">Campus Use &amp; Mall Scheduling website</a>.
</p>

<?php rooms_finish()
?>