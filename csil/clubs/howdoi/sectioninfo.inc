<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'csil';
$template = 'standard';


/* the main page for this section */
$section_title 		= 'how do i?';
$section_title_img	= '/csil/clubs/clubs.gif';
$section_url 		= '/csil/clubs/howdoi/index.php';

$photo_url		= '/csil/clubs/graffiti.jpg';
$photo_alt		= 'graffiti picture';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array('involvement',
						'clubs & organizations');
						
$parent_url		= array('/csil/index.php',
						'/csil/clubs/index.php');


/* links for the section's children */

$child_title = 	array('Advertise in the Wildcat',
					  'Get a Website',
					  'Get Audio/Visual Equip',
					  'Get Catering',
					  'Get a Mail Box',
					  'Make Copies, etc.',
					  'Get Helium',
					  'Take a Challenge Course',
					  'Open an Off-campus Bank Account'
					  );
					         
$child_url = 	array('/csil/clubs/howdoi/dailywildcat.php',
					  'http://web.asua.arizona.edu/~asua/webacct.htm',
					  '/csil/clubs/howdoi/audiovisual.php',
					  '/csil/clubs/howdoi/catering.php',
					  '/csil/clubs/howdoi/mailboxes.php',
					  '/csil/clubs/howdoi/fastcopy.php',
					  '/csil/clubs/howdoi/helium.php',
					  '/csil/clubs/howdoi/challengecourse.php',
					  '/csil/clubs/howdoi/bankaccount.php'
					  );

?>