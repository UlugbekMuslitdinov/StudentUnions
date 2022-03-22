<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">


<h1>Department of the Year Award</h1>

<p>This award goes to a department on campus that has gone above and beyond their duties.  They have consistently served their students, staff and faculty by providing a place of support,  encouraging diversity, creativity, and involvement on campus, and have promoted excellence in education.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li>Department may be nominated by a student, faculty or staff</li>
	<li>Department may not be submitted for any other award</li>
</ul> 
<br />


<?
require_once("formgroup.php");
?>

<?php involv_finish() ?>