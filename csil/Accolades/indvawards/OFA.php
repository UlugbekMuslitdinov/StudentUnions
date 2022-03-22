<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">

<h1>Outstanding Faculty Award</h1>

<p>This award is presented to a Faculty member who has shown outstanding commitment to the students he/she advises, while teaching and inspiring them to succeed.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li>Faculty member must be a University of Arizona Faculty Member
	<li>Completed nomination form
</ul>
<br />

<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>Faculty member must have held position during the Fall <?php echo date("Y") - 1; ?> and/or Spring <?php echo date("Y"); ?> Semesters.
</ul>

<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>
<br />

<?
require_once("formindv.php");
?>

<?php involv_finish() ?>