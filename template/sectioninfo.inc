<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'construction';
$template = 'standard';


/* the main page for this section */
$section_title 		= 'construction';
$section_title_img	= '/construction/construction.gif';
$section_url 		= '/construction/index.php';

$photo_url		= '/construction/newunion_photo.jpg';
$photo_alt		= 'photo of new union';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array();
$parent_url		= array();


/* links for the section's children */

$child_title = 	array('Park Renovation & Expansion',
					  'Construction Timelapse',
					  'Live Webcam!',
					  'Virtual Tour',
					  'Photo Gallery',
					  'Views of the Union',
					  'Features',
					  'Phases',
					  'Our New Name',
					  'Why do we need a new Union?',
					  'How You Can Help',
					  'Other UA Construction'
					  );
					         
$child_url = 	array('/construction/psu/index.php',
					  '/construction/timelapse/index.php',
					  '/construction/webcam/index.php',
					  '/construction/virtualtour/index.php',
					  '/construction/gallery/index.php',
					  '/construction/views/index.php',
					  '/construction/features.php',
					  '/construction/phases.php',
					  '/construction/newname.php',
					  '/construction/whyanewu/index.php',
					  '/construction/how.php',
					  'http://www.fdc.arizona.edu/uaconstruction'
					  );
?>