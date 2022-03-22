<?php
//require_once('db.inc');
//db_connect();
//db_select('menuboards');
?>
<style>
.burgers {
		vertical-align:top;
		font-size:12px;
		font-weight:normal;

		width:100%;
		float:left;
		margin-top:5px;
	}
	.late_night {
		vertical-align:top;
		font-size:12px;
		font-weight:normal;

		width:100%;
		float:left;
		margin-top:10px;
	}

	.left_col {
		float:left;
		width:270px;
	}
	.right_col {
		float:left;
		width:270px;
		margin-left:10px;
	}
	.line-item {
		margin-bottom:10px;
	}
	td{
		font-size:10px !important;
	}
</style>
<div id="nav" style="position:absolute; top:20px; right:10px;">
	<span class="active" onclick="show('1')" id="1-link" >Signature Burgers</span> :
    <span onclick="show('7')" id="7-link">Burger Experience</span> :
	<span onclick="show('3')" id="3-link">Greens &amp; Sandwiches</span> :
	<span onclick="show('4')" id="4-link">Sides &amp; Fries</span> :
	<span onclick="show('2')" id="2-link">Snacks</span> :
	<span onclick="show('5')" id="5-link">Sugar Fix</span> :
	<span onclick="show('6')" id="6-link">Beverages</span>
	<script>var current='1';</script>
</div>
<div id="logo">
	<img src="template/images/logos/cellar.jpg" alt="Cellar Bistro"/>
</div>
<div id="desc" >
	<p>
	</p>
</div>
<div id="menu-content" style="clear:both; padding-top:10px;">
<div id="1" style="display:block;">
		<h1>Burgers</h1>
		<p>Choose your patty: Beef, Turkey or Black Bean, Chicken Breast, Salmon <br>
			Served with house sauce and beer-battered fries or house-made chips</p>
		<?php
			full_line_item('Earth Burger', 'Blue oyster mushroom, arugula, red wine onion jam', '8.50');
			full_line_item('American Burger', 'American cheese, butter lettuce, tomato, pickle, onion', '8.25');
			full_line_item('Hottie Burger', 'Jalapeno cheese, roasted rajas, avocado, oven roasted tomato', '9');
			full_line_item('Uber Cheese Burger', 'Cheddar cheese, provolone cheese, boursin cheese', '8.50');
			full_line_item('Farm Burger', 'Bacon, English sharp cheese, fried egg, arugula', '9');
			full_line_item('Southern Yardbird Burger', 'Mustard, pickle, butter lettuce', '8.25');
		?>
</div>

<div id="3" style="display:none;">
		<h1>Greens and Sandwiches</h1>
		<p>Served with house-made chips or fries</p>
		<?php
			full_line_item('Fresh Fruit Salad', 'Melon, berries, mocha, honey oat bran muffin', '7');
			full_line_item('Chicken Caesar Salad', 'Gem lettuce, chicken, soy nuts, Parmesan, pesto Caesar dressing', '7');
			full_line_item('Chop Chop Salad', 'Gem lettuce, sherry vinaigrette, salami, provolone, tomato, turkey, chickpeas, cucumber, pea sprouts', '7');
			full_line_item('Chicken Club Sandwich', 'Toasted multigrain bread, bacon, chicken, tomato, lettuce, pesto mayo, Swiss cheese', '8');
			full_line_item('PB&J', 'Nutella, strawberry jam, banana, toasted multigrain bread', '5');
			full_line_item('BLT Sandwich', 'Toasted multigrain bread + Dbl smoked bacon + Butter Lettuce + Tomato + Pesto Mayo', '7');
		?>

</div>

<div id="4" style="display:none;">
	<h1>Sides and Fries</h1>
		<?php
			full_line_item('Just Fries (beer battered)', 'W/ Chipotle Ketchup', '3');
			full_line_item('Sweet Potato Fries', 'Vanilla powdered sugar, honey jalape&ntilde;o mayo', '3');
			full_line_item('Fruit Cup', 'Seasonal fruit, berries', '3');
			full_line_item('Little Chop Chop', '', '3');
			full_line_item('House Made Chips', 'Sea salt', '2');
		?>
</div>

<div id="2" style="display:none;">
		<h1>Snacks</h1>
		<?php
			full_line_item('Jumbo Chicken Wings', 'Choice of sauce (Ragili, BBQ, Chipotle & Honey, Red hot)', '7');
			full_line_item('Hummus & Flatbread', 'Veggie sticks', '6');
			full_line_item('Peppered Chicken Tenders', 'Serano ranch', '7');
			full_line_item('Nacho Daddy', 'All the fixins', '7');
		?>
</div>

<div id="5" style="display:none;">
	<h1>Sugar Fix</h1>
		<?php
			full_line_item('Hand-Spun Milkshakes', 'Apple Pie, Cheesecake, Chocolate, Macchiato, Oreo, Pi&ntilde;a Colada, Strawberry, Vanilla', '4.50');
			full_line_item('Boba', '', '1');
			full_line_item('Down & Dirty Sundae', 'Soft serve + Oreos + Chocolate Sauce + M&MS', '3.75');
		?>
</div>

<div id="6" style="display:none;">
	<h1>Beverages</h1>
		<?php
			full_line_item('Freestyle Coca-Cola&reg; Fountain', '', '2');
			full_line_item('Fuze Green or Black Tea', '', '2');
			full_line_item('Boba Teas', 'Raspberry, Strawberry, Peach, Pomegranate, Blackberry, Lemon, Watermelon, Mango', '3');
		?>
</div>

<div id="7" style="display:none;">
		<h1>Build Your Burger Experience</h1>
        <h2>All burgers come with = Lettuce + tomato + pickle + and choice of fries or chips</h2><br />
		<?php
			full_line_item('1/4lb Angus beef burger ', '', '$5.95');
			full_line_item('1/3lb Veggie burger', '', '$5.95');
			full_line_item('Marinated ckn breast', '', '$6.49');
			full_line_item('1/4 lb Salmon burger', '', '$7.49');
			full_line_item('1/3lb Turkey burger', '', '$5.95');
		?>
        <br />
        <p>
        <h2>Additional toppings: </h2>
        <div style="font-size:10px;">        
        <strong>$0.59 ea</strong><br />
        Peppers, Sprouts, Jalapeno, Mushroom, Arugula, Red onion jam<br /><br />
        <strong>$0.79 ea</strong><br />
        Cheddar, American, Swiss, Blue cheese, Peppre jack, Dill Crema<br /><br />
        <strong>$0.99 ea</strong><br />
        Dbl smkd bacon, Grilled peppers, Caramelized Onions, Guacamole, Cured tomato, Fried egg, Rajas
        </div>
        </p>
</div>
</div>
