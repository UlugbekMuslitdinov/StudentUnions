<?php
	require_once('dining.inc');
  $page_options['title'] = 'Nutritional Info';
  dining_start($page_options);
	$today = getdate();
	$m = $today["mon"];
	$d = $today["mday"];
	$y = $today["year"];
?>
<h1>Nutritional Info</h1>
<p>
You want the food you eat to be healthy and tasty -- and at the Arizona Student Unions, that's just what you get!
Coming soon: an in-depth online look at the nutrition information in each of our restaurants.
Check back often to see our progress, and stay on track with your nutrition goals.
</p>

<!--p style="margin-bottom: .25em;">Restaurants currently available:</p>
<ul style="list-style-type: none; line-height: 1.5em; margin-left: .5em; margin-top: 0; float: left;" >
	<li><a href='/nutrition?id=16&name=IQ Fresh'>IQ Fresh</a></li>
	<li><a href='/nutrition?id=17&name=Core'>Core</a></li>
	<li><a href='/nutrition?id=19&name=PSU'>PSU</a></li>
	<li><a href='/nutrition?id=21&name=Cactus Grill'>Cactus Grill</a></li>
	<li><a href='/nutrition?id=25&name=Arizona Room'>Arizona Room</a></li>
	<li><a href='http://www.pinkberry.com/component/content/article/35-products/231-nutrition'
		onclick="window.open(this.href); return false;"
		onkeypress="window.open(this.href); return false;">Pinkberry</a></li>
	<li><a href='/nutrition?id=35&name=Sabor'>Sabor</a></li>
	<li><a href='/nutrition?id=36&name=The Counter'>The Counter</a></li>
	<li><a href='/nutrition?id=41&name=On Deck Deli'>On Deck Deli</a></li>
	<li><a href='http://www.einsteinbros.com/nutrition/calculator'
		onclick="window.open(this.href); return false;"
		onkeypress="window.open(this.href); return false;">Einstein Bros Bagels</a></li>
	<li><a href='/nutrition?id=55&name=Pangea'>Pangea</a></li>
</ul>

<ul style="list-style-type: none; line-height: 1.5em; margin-left: 4em; margin-top: 0; float: left;" >
	<li><a href='http://www.chick-fil-a.com/food/meal'
		onclick="window.open(this.href); return false;"
		onkeypress="window.open(this.href); return false;">Chick-Fil-A</a></li>
	<li><a href='http://assets.starbucks.com/menu/catalog/nutrition?view_control=product&region=&location=&food=bakery&wellness=low-fat&wellness=low-sodium#view_control=nutrition'
		onclick="window.open(this.href); return false;"
		onkeypress="window.open(this.href); return false;">Starbucks @ Bookstore</a></li>
	<li><a href='http://assets.starbucks.com/menu/catalog/nutrition?view_control=product&region=&location=&food=bakery&wellness=low-fat&wellness=low-sodium#view_control=nutrition'
		onclick="window.open(this.href); return false;"
		onkeypress="window.open(this.href); return false;">Starbucks @ Library</a></li>
	<li><a href='/nutrition?id=67&name=Canyon Coffee'>Canyon Coffee</a></li>
	<li><a href='/nutrition?id=72&name=Cellar Bistro'>Cellar Bistro</a></li>
	<li><a href='/nutrition?id=78&name=McClelland'>McClelland</a></li>
	<li><a href='/nutrition?id=79&name=AME'>AME</a></li>
	<li><a href='/nutrition?id=80&name=McKale'>McKale</a></li>
	<li><a href='/nutrition?id=82&name=Nucleus'>Nucleus</a></li>
	<li><a href='/nutrition?id=90&name=Highland'>Highland Market</a></li>
	<li><a href='/nutrition?id=98&name=U-Mart'>U-Mart</a></li>
</ul>

<br style="clear: both;" /-->

<?php dining_finish(); ?>
