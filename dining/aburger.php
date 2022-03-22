<?php

require_once ('dining.inc');
$page_options['page'] = '"A" Burger';
$page_options['header_image'] = "/template/images/banners/14_AburgerPlasma950x534.jpg";
dining_start($page_options);
?>
<style>
	#page-content-container > div:nth-child(1)  {
		height: 534px !important;
	}
</style>

<h1>"A" Burger</h1>

<p>
	Presenting the 1/2 lb "A" Burger March 26 thru April 8
</p>

<p>
	Brown bagged with side and drink for $7.95 
</p>

<p>
	"A" branded bun available at 
</p>

<ul style="list-style-type: none; line-height: 1.25em;">
	<li><b>Cactus Grill: </b> March 26, 27, 28</li>
	<li><b>Cellar Bistro: </b> March 31, April 1, 2, 3</li>
	<li><b>Highland Market: </b> April 4, 7, 8</li>
</ul>

<br />

<?php
dining_finish();
?>