<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">

<h1>Dean of Students Emerging Leader Award</h1>

<p>This award is presented to a non-graduating University of Arizona undergraduate for exceptional contributions and exhibiting further potential in leadership.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li>Student must be a University of Arizona student</li>
	<li>Student must have a good academic and disciplinary standing with the University of Arizona</li>
	<li>Student may not be self nominated</li>
	<li>Award must pertain to the student's performance/achievement while attending the University of Arizona</li>
	<li>Student may receive this award only once during their tenure at the University of Arizona</li>
</ul>
<br />

<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>The University of Arizona undergraduate student must not be graduating in the <?php echo date("Y") - 1; ?> - <?php echo date("Y"); ?> academic year.</li>
	<li>Student has demonstrated leadership skills</li>
	<li>Student has demonstrated involvement in community service opportunities</li>
	<li>Student has made contributions to the University and/or the Tucson community</li>
	<li>Student has demonstrated inclusiveness and diversity</li>
</ul>


<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>
<br />

<?
require_once("formindv.php");
?>

<?php involv_finish() ?>