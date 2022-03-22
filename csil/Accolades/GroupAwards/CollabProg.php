<?php
session_start();
require_once ('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">

<h1>Outstanding Collaborative Program Award</h1>

<p>
This award is presented to a University of Arizona student organization for implementing an outstanding collaborative program.
This organization has demonstrated the ability to promote a sense of cooperation between organizations in a joint program by
promoting open-mindedness and inclusiveness, while maintaining its own identity.
</p>

<h5>General Eligibility Criteria: </h5>
<ul>
	<li>Program may be nominated by any student, faculty, or staff.</li>
	<li>Program may not be submitted for any other award</li>
	<li>Must be UA recognized organizations</li>
	<li>Organizations must be in good standing with the University Judicial System</li>
</ul>
<br />

<h5>Specific Eligibility Criteria: </h5>
<ul>
	<li>A collaborative program is defined as a program that directly involves two or more organizations or institutions</li>
	<li>The program must have taken place between February 1, <?php echo date("Y") - 1; ?> - February 1, <?php echo date("Y"); ?>.</li>
</ul>
<br />

<?
require_once ("formgroup.php");
?>

<?php involv_finish()
?>