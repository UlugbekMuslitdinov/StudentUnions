<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'csil';
$template = 'standard';


/* the main page for this section */
$section_title 		= 'advisor resources';
$section_title_img	= '/csil/clubs/clubs.gif';
$section_url 		= '/csil/clubs/advisors/index.php';

$photo_url		= '/csil/clubs/graffiti.jpg';
$photo_alt		= 'graffiti picture';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array('involvement',
						'clubs & organizations');
						
$parent_url		= array('/csil/index.php',
						'/csil/clubs/index.php');


/* links for the section's children */

$child_title = 	array('Resources for Club Advisors',
					  'Roles of the Advisor',
					  'How To Use Your Advisor'
					  );
					         
$child_url = 	array('/csil/clubs/advisors/resources.php',
					  '/csil/clubs/advisors/roles.php',
					  '/csil/clubs/advisors/howto.php'
					  );

?>