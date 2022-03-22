<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">


<h1>Outstanding New Student Organization Award</h1>

<p>This award is presented to a new student organization for developing itself and providing support to its members, despite their new position on campus.  Its continued involvement and enthusiastic participation is proof of the organization's establishment at the UA.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li>Student organization may be nominated by any student, faculty or staff</li>
	<li>Organization may not be submitted for any other award</li>
	<li>Must be a recognized and registered organziation</li>
	<li>Organization must be in good standing with the University Judicial System</li>
</ul>
<br />

<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>Organization must have been started during the <?php echo date("Y") - 1; ?> - <?php echo date("Y"); ?> academic year.</li>
</ul>
<br />

<?
require_once("formgroup.php");
?>

<?php involv_finish() ?>