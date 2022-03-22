<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">


<h1>Outstanding Student Organization Advisor Award</h1>

<p>This award is presented to an Organization Advisor who has shown outstanding commitment to the organization he/she advises by providing support and encouragement to the organization while challenging each student to succeed.</p>


<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>Must be the Advisor on record of a recognized and registered student organization at the University of Arizona.</li>
	<li>Held Organization Advisor position during the academic Fall <?php echo date("Y") - 1; ?> and/or Spring <?php echo date("Y"); ?> Semesters.</li>
</ul>

<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>
<br />

<?
require_once("formindv.php");
?>

<?php involv_finish() ?>