<?php
require_once('involv.inc');
$page_options = array();
$page_options['page'] = 'gallagher-about';
$page_options['header_image'] = '/template/images/banners/Gallagher_freemovies_webbanner.png';
involv_start($page_options);
?>
<style type="text/css" >
	h1 { 
		margin-top: 20px !important;
	}
	
</style>
<h1>About Gallagher Theater</h1>

<p>Located on the main floor of the Student Union Memorial Center, right across the food
court, Gallagher Theater is UA's premier on-campus movie theater! Equipped with THX, Dolby
Digital Sound, a 26 X 11 ft. Screen, this 340 seat theater is ready to handle all of your
digital entertainment needs. Our regularly scheduled movie Blockbusters occur every 
Thursday and Sunday during the semester. We are dedicated to playing the most
relevant and engaging films that the UA community wants to see.  Assisted hearing devices
are available. The Box office opens 1 hour prior to a showing, allowing time to purchase
tickets, popcorn, candy, or soda and still find the perfect seat.</p>

<br />

<h2>Gallagher Theater History</h2>
<p>Built in 1971 Gallagher Theater Movies were only 75 Cents to UA Students. The old
theater contained 630 seats and a lobby area, a favored spot to take a nap in between
classes. The Gallagher still continues traditions such as Midnight Movies, semester poster
sales, and the playing of University Activities Board Films. The Gallagher was named after
Edward Joseph Gallagher III, who contributed films and artwork to the Student Union.</p>
<p><img src="/gallagher/images/history_pic.gif" alt="" height="236" width="301" border="0"></p>
<p></p>
<?php 
involv_finish();