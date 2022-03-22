<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">

<h1>Student Affairs Outstanding Organization Award</h1>

<p>This award is presented to a recognized and registered Student Organization, that has made exceptional contributions within the UA community.  This organization not only advances the mission of The University of Arizona but they also positively represent their interests on and off campus, demonstrating wildcat spirit while being a source of UA pride.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li>Organization may be nominated by any student, faculty or staff</li>
	<li>Organization may not be submitted for any other award</li>
</ul>
<br />


<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>Organization must be within Student Affairs Unit</li>
</ul>



<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>

</li>
<br />

<?
require_once("formgroup.php");
?>

<?php involv_finish() ?>