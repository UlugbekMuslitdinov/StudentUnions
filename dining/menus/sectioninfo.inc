<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'other';
$template = 'sidebar_only';


/* the main page for this section */
$section_title 		= 'building hours';
$section_title_img	= '/infodesk/infodesk.gif';
$section_url 		= '/infodesk/hours/index.php';

$photo_url		= '/infodesk/clocks.jpg';
$photo_alt		= 'clocks';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array('infodesk');
$parent_url		= array('/infodesk/index.php');


/* links for the section's children */

$child_title = 	array('Hours of Operation',
					  'Building Maps'
					 );
					         
$child_url = 	array('/infodesk/hours/index.php',
					  '/infodesk/maps/index.php'
					  );
?>