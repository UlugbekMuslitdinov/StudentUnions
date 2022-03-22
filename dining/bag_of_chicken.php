<?php 
	require_once('dining.inc');
	// $page_options['page'] = 'Dining';
	$page_options['header_alt'] = 'Dining Services';
	$page_options['video_image'] = '/dining/template/images/video_placeholder.jpg';
	$page_options['video_alt'] = 'Dining Video';
	$page_options['styles'] .= 'h1 {margin-bottom:20px}';
	$page_options['styles'] .= '#center-col h2 { font-size:18px; color:#393939; margin-bottom: 15px !important; text-align: center;}';
	$page_options['styles'] .= '#center-col h2 a:active, #center-col h2 a:link, #center-col h2 a:active, #center-col h2 a:visited{ font-size:16px; color:#D30033;}';
	$page_options['styles'] .= '#center-col h2 a:hover{ color:#FF1F57; }';
	$page_options['styles'] .= '#center-col h3 { font-size:14px; color:#393939; margin-bottom: 15px !important; text-align: center;}';
	$page_options['styles'] .= '#center-col h3 a:active, #center-col h3 a:link, #center-col h3 a:active, #center-col h3 a:visited{ font-size:14px; color:#D30033;}';
	$page_options['styles'] .= '#center-col h3 a:hover{ color:#FF1F57; }';
	$page_options['styles'] .= '#center-col p{font-size:16px !important; margin-bottom:8px; line-height:1.5em; text-align: center; vertical-align: center;}';
	$page_options['styles'] .= '#center-col p a:active, #center-col p a:link, #center-col p a:hover, #center-col p a:visited{ font-size:9px;}';
	$page_options['styles'] .= '#center-col .black-button a:active, #center-col .black-button a:link, #center-col .black-button a:hover, #center-col .black-button a:visited{ color:#ffffff; line-height:20px; font-size:13px; font-weight:bold;}';
	dining_start($page_options);
?>	
 	
	<h1>Bag of Chicken</h1>
	
	<p>
		<img src="/template/images/ads/2buckCluck-web2F.jpg" />
	</p>
	<br />
	
	
	<h2>
		Bag o' Chicken $2
	</h2>
	<h2>
		Or
	</h2>
	<h2>
		The Street Urchin Special with fries and fizzy $3.95
	</h2>
	<h2>
		Lunch and Dinner at: 
	</h2>
	<br />
	
	<h3> 
		<a href="/dining/sumc/cactus" >Cactus Grill</a> | 
		<a href="/dining/sumc/iq" >IQ Fresh</a> | 
		<a href="/dining/sumc/cellar" >Cellar Bistro</a> | 
		<a href="/dining/psu/parkdining" >Park Avenue Dining</a> | 
		<a href="/dining/other/highland" >Highland Market</a> 
	</h3>
	<br />
 
<?php 
	dining_finish();
?>