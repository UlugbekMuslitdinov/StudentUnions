<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'other';
$template = 'sidebar_only';


/* the main page for this section */
$section_title 		= 'union intranet';
$section_title_img	= '/intra/intranet.gif';
$section_url 		= '/intra/index.php';

$photo_url		= './intrapic.jpg';
$photo_alt		= 'intranet';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array();
$parent_url		= array();


/* links for the section's children */

$child_title = 	array('Union NewZ',
					  'Maintenance Request Form',
					  'Marketing Department',
					  'Union Hours',
					  'Union Photo Gallery',
					  '50/50 Meal Plan Regulations',
					  'Staff Directory',
					  'Other College Unions',
					  'Director\'s Advisory Group'
					 );
					         
$child_url = 	array('/about/newz/index.php',
					  '/intra/requestform.php',
					  '/about/marketing/index.php',
					  '/infodesk/hours',
					  '/about/gallery/index.php',
					  '/intra/mealplan.php',
					  '/about/directory/index.php',
					  'http://dolphin.upenn.edu/~oslaf/unions.html',
					  '/about/dag/index.php'
					 );
					 
?>