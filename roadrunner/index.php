<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/dining/template/dining.inc');
	$page_options['page'] = 'roadrunner';
	$page_options['header_alt'] = 'Dining Services';
	$page_options['video_alt'] = 'Dining Video';

	if (!array_key_exists('styles', $page_options))
	{
		$page_options['styles'] = '';
	}

	$page_options['styles'] .= 'h1 {margin-bottom:20px}';
	$page_options['styles'] .= '#center-col h2 { font-size:16px; color:#393939;}';
	$page_options['styles'] .= '#center-col h2 a:active, #center-col h2 a:link, #center-col h2 a:active, #center-col h2 a:visited{ font-size:16px; color:#D30033;}';
	$page_options['styles'] .= '#center-col h2 a:hover{ color:#FF1F57; }';
	$page_options['styles'] .= '#center-col p{font-size:12px; margin:0px; margin-bottom:8px; line-height:11px;}';
	$page_options['styles'] .= '#center-col p a:active, #center-col p a:link, #center-col p a:hover, #center-col p a:visited{ font-size:9px;}';
	$page_options['styles'] .= '.black-button { height:20px; width:118px; text-align:center; background-color:#393939; float:left; margin-right:12px;}';
	$page_options['styles'] .= '#center-col .black-button a:active, #center-col .black-button a:link, #center-col .black-button a:hover, #center-col .black-button a:visited{ color:#ffffff; line-height:20px; font-size:13px; font-weight:bold;}';
	$page_options['styles'] .= '#location-description p{font-size:12px; line-height:14px;}';
    $page_options['styles'] .= '#location-description p a:active, #location-description p a:link, #location-description p a:hover, #location-description p a:visited{ font-size:12px;}';

	//$page_options['has_mobile_version'] = 1;
	dining_start($page_options);

?>
<style>
	/* h1 {
		font-family: Helvetica,Arial,sans-serif !important;
		font-size:30px !important;
		line-height:32px !important;
		margin-top:0 !important;
		color: #776655 !important;
	} */
	.reg-p p {
		font-size: 13px !important;
		line-height: 1.25em !important;
	}
	.reg-p a {
		font-size: 13px !important;

	}
</style>

	<h1>RoadRunner Mobile Kitchen</h1>

	<p>
    Hungry Wildcats!<br /><br />
    Welcome to first food truck - RoadRunner Mobile Kitchen - another delicious creation of Arizona Student Unions.
    RoadRunner offers tasty street eats all around campus for our guests to enjoy! <strong>LESS CHASE, MORE TASTE!</strong> You'll love these delicious signature items from our creative Burger menu, the Backyard BBQ menu, the build-Your-Own Grilled Cheese menu, and the Street Tacos menu. You can find us at every Arizona football game, at the west side of the stadium.<br /><br /> 
    RoadRunner Mobile Kitchen is available to cater your next large event for an exciting change of pace!<br /> <br />
		<strong>Contact</strong>: Student Union Sales at <a href="mailto:SU-sales@email.arizona.edu">SU-sales@email.arizona.edu</a> 
	</p>
				
	<strong><a href="/dining/template/resources/RoadRunner_Brochure_19_WEB.pdf" target="_blank">Catering Menu</a></strong>
	
<?php

	dining_finish();

?>
