<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">


<h1>Outstanding Teaching Assistant/Graduate Assistant of the Year Award</h1>

<p>This award is presented to a deserving graduate teaching assistant or graduate assistant that has made a meaningful difference in the education of students.  This person inspires students to achieve by being more than a mentor; they are a friend, a guide and a role model.  What makes this person exceptional is his/her willingness to make himself/herself available to meet the needs of students. He/she is respected, flexible and a joy to work with.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li>TA/GA may be nominated by any student, faculty or staff</li>
	<li>TA/GA may not be nominated for any other award</li>
	<li>Student may not be self nominated</li>
	<li>Student must be a U of A student and have a good academic and disciplinary standing</li> 
	<li>Student may receive this award only once during their tenure at the U of A</li>
</ul>
<br />

<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>Must be a graduate student</li>
</ul>

<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>
<br />

<?
require_once("formindv.php");
?>

<?php involv_finish() ?>