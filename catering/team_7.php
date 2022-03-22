<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once('deliverance.inc.php');	 
page_start($page_options);
?>
<?php
require_once('catering_slider.inc.php');
?>
<div id="catering_page" >
<?php
require_once('catering_left_col.inc.php');
?>
<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" />
	
<div id="center-col" >
	 
	 	<h2>Arizona Catering Co.</h2>
		<p>
            <h3>Please contact the Event Planning Office</h3>
            <div style="margin-top:10px; margin-left:30px;">
            Monday – Friday from 8am – 5pm <br />
            Phone: 520-621-1414  &nbsp;&nbsp;<img src="images/dot_diamond.jpg" />&nbsp;&nbsp; <a href="mailto:su-eventplanning@email.arizona.edu"><u>su-eventplanning@email.arizona.edu</u></a>
    </div>
            
            <p>
            <h3>OUR TEAM:</h3>
            <div style="margin-top:10px; margin-left:30px;">
            <strong>Brenda Keagle</strong>, Assistant Director, Event Planning<br />
            520-621-1416 &nbsp;&nbsp;<img src="images/dot_diamond.jpg" />&nbsp;&nbsp; <a href="mailto:brendak@email.arizona.edu"><u>brendak@email.arizona.edu</u></a><br /><br />
            <strong>Charlene James</strong>, Senior Sales & Event Planner<br />
            520-621-6566 &nbsp;&nbsp;<img src="images/dot_diamond.jpg" />&nbsp;&nbsp; <a href="mailto:charlenej@email.arizona.edu"><u>charlenej@email.arizona.edu</u></a><br /><br />
            <strong>Marbila Rocha</strong>, Sales & Event Planner<br />
            520-626-5497 &nbsp;&nbsp;<img src="images/dot_diamond.jpg" />&nbsp;&nbsp; <a href="mailto:marbilarocha@email.arizona.edu"><u>marbilarocha@email.arizona.edu</u></a><br /><br />
            <strong>Diane Wolford</strong>, Sales & Event Planner<br />
            520-621-0989 &nbsp;&nbsp;<img src="images/dot_diamond.jpg" />&nbsp;&nbsp; <a href="mailto:dwolford@email.Arizona.edu"><u>dwolford@email.Arizona.edu</u></a><br /><br />
            <strong>Sara Winters</strong>, Sales & Event Planner<br />
            520-621-1989 &nbsp;&nbsp;<img src="images/dot_diamond.jpg" />&nbsp;&nbsp; <a href="mailto:sarawinters@email.arizona.edu"><u>sarawinters@email.arizona.edu</u></a>
    </div>
            </p>
		</p>
		 
		 
</div> 

<?php
require_once('catering_right_col.inc.php');
?>

</div>
		 
<div style="clear:both;">
	<br /><br />
</div>

<?php page_finish(); ?>