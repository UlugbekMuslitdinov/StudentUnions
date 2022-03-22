<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">


<h1>Outstanding Social Justice Advocate Award</h1>

<p>This award is presented to an individual who selflessly advocates for the interests of others.  This person supports, promotes, and defends access and equality for all members of our community.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li> Advocate may not be self nominated</li>
</ul>
<br />

<h5>Specific Criteria:</h5>
<ul>
	<li> Must be a University of Arizona faculty, staff or student</li>
</ul>

<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>
<br />

<?
require_once("formindv.php");
?>

<?php involv_finish() ?>