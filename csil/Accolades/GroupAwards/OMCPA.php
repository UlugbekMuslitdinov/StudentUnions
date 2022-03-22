<?php
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">

<h1>Outstanding Multi-Cultural Program Award</h1>

<p>This award is presented to a University of Arizona student organization for implementing an outstanding multi-cultural program.  This organization demonstrates their ability to promote a sense of cooperation between different cultures in a program.  The program encourages the preservation of different cultures and cultural identities within a unified society and establishes a sense of open-mindedness and self-identity for the participants while educating the whole of the campus community. </p>
 
<h5>General Eligibility Criteria:</b>  </hr>
<ul>
	<li>Program may be nominated by any student, faculty, or staff.</li>
	<li>Program may not be submitted for any other award</li>
	<li>Must be UA recognized organization</li>
	<li>Organizations must be in good standing with the University Judicial System</li>
</ul>
<br />

<h5>Specific Eligibility Criteria: </h5>
<ul>
	<li>A multi-cultural program is defined as a program that advocates a society that extends equitable status to distinct identities.</li> 
	<li>The program must have taken place between February 1, <?php echo date("Y") - 1; ?> - February 1, <?php echo date("Y"); ?>.</li>
</ul>
<br />


<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>
<br />
<?
require_once("formgroup.php");
?>

<?php involv_finish() ?>