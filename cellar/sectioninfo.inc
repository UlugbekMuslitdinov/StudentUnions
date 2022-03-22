<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'other';
$template = 'standard';


/* the main page for this section */
$section_title 		= 'the cellar';
$section_title_img	= none;
$section_url 		= '/cellar/index.php';

$photo_url		= '/cellar/gamesroom/break.jpg';
$photo_alt		= 'the cellar';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array();
$parent_url		= array();


/* links for the section's children */

$child_title = 	array('Games Room',
					  'Cellar Bistro',
					  'Email Games Room',
					 );
					         
$child_url = 	array('/cellar/gamesroom/index.php',
					  '/dining/sumc/cellar/index.php',
					  'mailto:uagames@email.arizona.edu',
					 );
					 
?>