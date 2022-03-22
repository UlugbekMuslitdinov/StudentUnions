<?php
	session_start();
	require_once('involv.inc');
$page_options['title'] = 'Accolades';
$page_options['header_image'] = '/template/images/banners/Accolades-2012.png';
involv_start($page_options);
?>

<div style="width:555px; min-height: 1800px;">

<h1>Outstanding Community Service Award</h1>

<p>This award is presented to a University of Arizona student organization for implementing an outstanding community service program. The service-oriented organization selected as the recipient of this award will have demonstrated their understanding of social responsibility by performing services that benefit the public or institutions in the community. This organization will have generously donated their time and skills, in order to improve the quality of life within our society.</p>

<h5>General Eligibility Criteria:</h5>
<ul>
	<li>Program may be nominated by students, faculty, or staff.</li>
	<li>Program may not be submitted for any other award.</li>
	<li>The organization must be a UA recognized organization</li>
	<li>The organization must be in good standing with the University Judicial System.</li>
</ul>
<br />

<h5>Specific Eligibility Criteria:</h5>
<ul>
	<li>A community service program is defined as an effort (excluding fundraisers or donations of money) directly benefiting organizations, and/or individuals, and/or charities.</li>
	<li>The program must have taken place between February 1, <?php echo date("Y") - 1; ?> - February 1, <?php echo date("Y"); ?>.</li>
</ul>
<br />


<?
require_once("formgroup.php");
?>

<?php involv_finish() ?>