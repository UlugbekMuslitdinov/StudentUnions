<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/involvement/template/involv.inc.php');
$page_options = array();
$page_options['page'] = 'uab-committees';
$page_options['title'] = 'The Wildcat Events Board Committees';
$page_options['header_image'] = '/template/images/banners/wildcat_event_board_banner.jpg';
$page_options['ad2_image'] = '/template/images/photos/ad2.png';
$page_options['ad3_image'] = '/template/images/photos/images/ad3.png';
$page_options['ad_link'] = '/activities';
involv_start($page_options);

?>

<style type="text/css" >
	h2 { 
		margin-top: 20px !important;
	}
	p {
		margin-top: -5px !important;
	}
</style>

<h1>Wildcat Events Board Committees</h1>

<h2>Arts</h2>
<p>
  The Arts Committee coordinates visual and performing arts events at the UA. From Open Mic Nights, Poetry Slams, Photography Expos, and Movies on the mall, 
  the Arts Committee brings life and culture to the UA.
</p>

<h2>Concerts</h2>
<p>
  The Concerts Committee is responsible for bringing both small and large scale concerts to the UA. Last year we brought Mac Miller, Which attracted over 7,000 
  students. Previous artists include The Cab, We the Kings, The Fray, and Plain White Tees.
</p>

<h2>Project Volunteers</h2>
<p>
  The Project Volunteer Committee hosts philanthropic events on the UA campus as well as participating in community service projects around the Tucson community. 
  In the past we have partnered with Diamond Children’s Medical Center as well as the American Cancer Society.
</p>

<h2>Speakers</h2>
<p>
  The Speakers Committee brings influential speakers to campus that Wildcats want to hear. In previous years, noted speakers included Spike Lee, Adrian Grenier, 
  To Write Love on Her Arms’ Jamie Tworkowski, Tim Wise, and the cast of MTV’s The Buried Life.
</p>

<h2>Wild Nights</h2>
<p>
  The Wild Nights Committee is responsible for planning late night programs and outrageous events on the mall for students each month. Past events include Casino 
  Nights, Inflatable Water Park Days, Hoedowns, and the annual Think pink Fashion Show in benefit of the Susan G Komen foundation.
</p>
<?php 
involv_finish();