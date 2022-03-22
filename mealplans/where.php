<?php
require_once('template/mp.inc');
$page_options['page'] = 'Where Can I Eat';
mp_start('Which Plan', 1);
?>
<style>
#mp-content h1{

	font-size: 26px;
}
#mp-content h2{
	color: #776655;
	margin-top:15px;
}
#mp-content table ul li, #mp-content ul li, #mp-content table ul li a:link, #mp-content table ul li a:active, #mp-content table ul li a:visited, #mp-content table ul li a:hover, #mp-content .fake-link{
	color:#363636 !important;
	font-size:10px !important;
	margin:2px 0px !important;
	font-size:12px !important;
}
#mp-content a:link, #mp-content a:visited, #mp-content a:active
{
	color: #BB1F42;
	text-decoration: none;
	font-weight: bold;
}
#mp-content a:hover
{
	color: #D35422;
	text-decoration: underline;
}
</style>

<h1>Where Can I Eat With My Meal Plan?</h1>

<p>
	Your meal plan works at over 30 on-campus dining locations, from restaurants to vending machines, convenience stores, and concessions at multiple University of Arizona athletic venues.
</p>

<a href="/dining">
	Check all on campus dininig locations &gt;
</a>

<?php

// require($_SERVER['DOCUMENT_ROOT'] . '/mealplans/template/dining_locations.inc');
mp_finish();

?>
