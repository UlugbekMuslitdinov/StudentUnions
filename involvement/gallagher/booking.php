<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/involvement/template/involv.inc.php');
$page_options = array();
$page_options['page'] = 'Booking Gallagher';
$page_options['header_image'] = '/template/images/banners/gallagher_banner.jpg';
involv_start($page_options);
?>
<h1>Booking Gallagher Theater</h1>
<p>
Interested in booking the Gallagher Theater for your next event?  Gallagher is great for lectures, film screenings, and live performances!  Complete a <a href="/template/resources/forms/RoomReservationRequestForm.pdf" target="_blank"><span style="color: #F58523;"><strong><u>request form</u></strong></span></a> and submit it to us at<br /> <a href="mailto:su-gallaghertheater@email.arizona.edu" >SU-GallagherTheater@email.arizona.edu</a>.  You'll receive notification of your booking status within 7 days.</p>  
<p>
Don't forget to plan ahead because Gallagher Theater books quickly once the school year begins!  We recommend submitting your request at least a month before the event date.  
</p>
<p>
Have questions booking the Gallagher Theater?<br />  
Email us at <a href="mailto:su-gallaghertheater@email.arizona.edu" >SU-GallagherTheater@email.arizona.edu</a>.<br />
PLEASE NOTE: Room scheduling is subject to change based on the needs of the University.  
</p>

<?php
involv_finish();
