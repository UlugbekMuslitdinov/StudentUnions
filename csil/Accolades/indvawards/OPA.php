<?php
session_start();
require_once ('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">

<h1>Outstanding Professional Staff Member Award</h1>

<p>This award is presented to a Professional Staff Member who has shown outstanding commitment to his/her work, while encouraging and advocating for students.</p>

<h5>General Eligibility Criteria: </h5>
<ul>
	<li>Staff member must be a University of Arizona Staff Member</li>
</ul>
<br />

<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>Professional Staff Member must have held staff position during the Fall <?php echo date("Y") - 1; ?> and/or Spring <?php echo date("Y"); ?> Semesters.</li>
</ul>

<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>
<br />

<?
require_once ("formindv.php");
?>

<?php involv_finish()
?>