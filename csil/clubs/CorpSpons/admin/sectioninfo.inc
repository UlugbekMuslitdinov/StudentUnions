<?php

/* variables that set the characteristics of how
   the current section should be displayed */
   

$area = 'csil';
$template = 'standard';


/* the main page for this section */
$section_title 		= 'Funding Request Form';
$section_title_img	= '/csil/clubs/clubs.gif';
$section_url 		= '/csil/clubs/index.php';
// $section_url 		= '/csil/clubs/CorpSpons/index.php';

$photo_url		= '/csil/clubs/corp_partner.jpg';
$photo_alt		= 'Corporate Sponsors';	


/* links to show for the parents */
/* lower indexes are more ancestral */
$parent_title	= array('involvement',
						'clubs & organizations');
						
$parent_url		= array('/csil/index.php',
						'/csil/clubs/index.php');
// 						'/csil/clubs/CorpSpons');


/* links for the section's children */

$child_title = 	array('CSIL Club Funding Admin');
					         
$child_url = 	array('/csil/clubs/application/admin/index.php');

?>