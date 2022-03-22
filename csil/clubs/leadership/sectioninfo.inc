<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'csil';
$template = 'standard';


/* the main page for this section */
$section_title 		= 'leadership resources';
$section_title_img	= '/csil/clubs/clubs.gif';
$section_url 		= '/csil/clubs/leadership/index.php';

$photo_url		= '/csil/clubs/graffiti.jpg';
$photo_alt		= 'graffiti picture';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array('involvement',
						'clubs & organizations');
						
$parent_url		= array('/csil/index.php',
						'/csil/clubs/index.php');


/* links for the section's children */

$child_title = 	array('ACLC Conference',
					  'Leadership Courses for Credit',
					  'Workshop Series',
					  'All-Campus Leadership Awards',
					  'Distribute Recruitment Flyers'					  
					  );
					         
$child_url = 	array('/csil/aclc/index.php',
					  '/csil/leadership/courses.php',
					  '/csil/leadership/workshops.php',
					  '/csil/leadership/awards/index.php',
					  '/csil/clubs/leadership/where.php'
					  );

?>