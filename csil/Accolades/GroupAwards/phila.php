<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">


<h1>Outstanding Philanthropy Award</h1>

<p>This award is presented to a University of Arizona student organization for implementing an outstanding philanthropy program.  The philanthropic organization selected as the recipient of this award will have given monetary donations, and goods to support a charitable cause. This altruistic and selfless cause has promoted a sense of well-being and improved the quality of life in our surrounding community. </p>  

<h5>General Eligibility Criteria: </h5>
<ul>
	<li>Program may be nominated by any student, faculty, or staff.</li>
	<li>Program may not be submitted for any other award</li>
	<li>Organizations must be UA recognized organization</li>
	<li>Organizations must be in good standing with the University Judicial System</li>
</ul>
<br />


<h5>Specific Eligibility Criteria:</h5>
<ul> 
	<li>A philanthropic program is defined as an effort that leads to the profiting of charitable foundations, and/or worthy individuals.</li>
	<li>The program must have taken place between February 1, <?php echo date("Y") - 1; ?> - February 1, <?php echo date("Y"); ?>.</li>
</ul>


<p>Questions and comments may be directed to Celina Alvarez, Center for Student Involvement &amp; Leadership, <a href="mailto:csilfrontdesk@gmail.com">csilfrontdesk@gmail.com</a> or 520-621-2782.</p>

</li>
<br />

<?
require_once("formgroup.php");
?>

<?php involv_finish() ?>