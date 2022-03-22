<?php
	require('sectioninfo.inc');
	require('global.inc');
	$title = 'Computer Lab';
	pageStart($title);
?>
<h1>Welcome to The Cellar Computer Lab!</h1><br />
<p><?php include('http://union.arizona.edu/cgi-bin/WebObjects/EventsCalendar.woa/wa/singleCategoryView?key=games') ?></p>
<p><?php printLocationHours(8) ?></p>
<p>E-mail us at <?=emailLink("uagames@email.arizona.edu")?></p>
<?php pageFinish() ?>
