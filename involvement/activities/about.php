<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/involvement/template/involv.inc.php');
$page_options = array();
$page_options['page'] = 'uab-about';
$page_options['title'] = 'About The Wildcat Events Board';
$page_options['header_image'] = '/template/images/banners/wildcat_event_board_banner.jpg';
$page_options['ad2_image'] = '/template/images/photos/ad2.png';
$page_options['ad3_image'] = '/template/images/photos/ad3.png';
$page_options['ad_link'] = '/activities';
involv_start($page_options);

?>
<h1>About the Wildcat Events Board</h1>
<p>
  The Wildcat Events Board, is a student-run organization bringing social and educational programs to the University of Arizona. 
  We plan concerts, comedy shows, speakers, poets, films, and more for the UA community.
</p>
<p>
  We are more than just a fun social group (we are that, too). Our members learn lifelong skills such as networking, time management, 
  organization, public speaking, event planning and marketing — to name just a few.
</p>
<p>
  Getting involved in the University community is an important part of college life, and joining the Wildcat Events Board is an 
  excellent way to learn about leadership, responsibility, and working with others. It’s also a great way to make friends and 
  have a good time.
</p>

<?php 
involv_finish();