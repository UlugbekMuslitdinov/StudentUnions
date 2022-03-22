<style>
	.line-item {
		margin-bottom: 4px;
	}
	.short .line-item div {
		width:450px;
	}
	.line-item div{
		width:520px;
	}
</style>
<div id="nav" >
	<span class="active" onclick="show('entrees')" id="entrees-link" >Savory Crepes</span>  :  <span onclick="show('nachos_sides')" id="nachos_sides-link">Sweet Crepes</span>  :  <span onclick="show('ensalads')" id="ensalads-link">Baked Goodies</span>  :  <span onclick="show('bocaditos')" id="bocaditos-link">Coffee/Espresso</span>  :  <span onclick="show('alacarte')" id="alacarte-link">Fruit Smoothies</span>
	<script>var current='entrees';</script>
</div>
<div id="logo">
	<img src="template/images/logos/lapetite.jpg" alt="Sabor"/>
</div>
<div id="desc" >
	<p>
		Fresh French pastries, sweet and savory crepes, smoothies, coffee and espresso in an easy-to-go environment perfect for students in a rush between classes.
	</p>
</div>
<style type="text/css">
h4 {
	font-size:12px;
	margin-top:10px;
	margin-bottom:5px;
}
i {
	font-size:10px;
}
.right-col {
	margin-top:0;
}
</style>
<div id="menu-content" style="clear:both; padding-top:5px;" class="short">
	<div id="entrees" >

		<h1>Savory Crepes</h2>

		<?php
			full_line_item('Egg, Bacon and Cheese', '', '5.09');
			full_line_item('Egg, Ham, and Cheese', '', '5.09');
			full_line_item('Egg and Cheese', '', '4.09');
			full_line_item('Turkey, Tomato, Spinach and Pesto Sauce', '', '5.49');
			full_line_item('Spinach, Tomato, Onion, Goat Cheese and Pesto Sauce', '', '5.99');
			full_line_item('Ham, Tomato and Swiss Cheese', '', '4.89');
			full_line_item('Swiss Cheese, Tomato and Mushroom', '', '4.79');
			full_line_item('Swiss Cheese, Tomato and Spinach', '', '4.69');
			full_line_item('Pepperoni Pizza', '', '4.99');
		?>

		<h2>Extras</h2>
		<p class="list">
			Bacon (2 slices.): Add 2, Cheese: Add .69 (ea), Egg or Veggie: Add .89 (ea)
		</p>

	</div>
	<div id="nachos_sides" style="display:none;" class="short">

    	<h1>Sweet Crepes</h1>

    	<?php
				full_line_item('Banana and Chocolate  ', '', '3.99');
				full_line_item('Nutella® (Hazelnut Spread)', '', '3.99');
				full_line_item('Banana and Nutella ', '', '4.49');
				full_line_item('Strawberry and Honey', '', '4.59');
				full_line_item('Strawberry and Chocolate ', '', '4.49');
				full_line_item('Strawberry and Nutella', '', '4.99');
				full_line_item('Greek Yogurt, Banana, Honey and Granola (served cold)', '', '4.79');
				full_line_item('Strawberry, Banana, and Nutella', '', '5.69');
				full_line_item('Sugar and Cinnamon', '', '2.79');
    	?>

			<h2>Extras</h2>
			<p class="list">
				Strawberry: Add 1.39, Banana: Add .89, Cinnamon Sugar: Add .89, Whipped Cream: add .89
			</p>

	</div>
	<div id="ensalads" style="display:none;" class="short">
    	<h1>Baked Goodies</h1>
    	<?php
				full_line_item('Croissant ', '', '1.99');
				full_line_item('Chocolate Croissants', '', '1.99');
				full_line_item('Lemon Tart', '', '2.79');
				full_line_item('Éclair', '', '1.99');
				full_line_item('Coconut Roll', '', '1.99');
    	?>
	</div>
	<div id="bocaditos" style="display:none;">
    	<h1 style="margin-top:-5px;">Coffee/Espresso</h1>
    	<div class="short">
    	<?php
				full_line_item('Coffee', '', '1.59 / 1.89');
				full_line_item('Café Au Lait', '', '1.79 / 2.39');
				full_line_item('Iced Coffee', '', '1.59 / 2.19');
				full_line_item('Espresso', '', '1.59 / 1.99');
				full_line_item('Hot Chocolate', '', '1.99 / 2.39');
				full_line_item('Cappuccino', '', '2.69 / 3.49');
				full_line_item('Latte or Iced Latte ', '', '2.69 / 3.49');
				full_line_item('Blended Latte', '', '3.19 / 3.99');
				full_line_item('Mocha or Iced Mocha', '', '3.09 / 3.79');
				full_line_item('Blended Mocha', '', '3.59 / 4.29');
				full_line_item('Caramel Macchiato', '', '3.39 / 4.19');
				full_line_item('Ice Caramel Macchiato', '', '3.39 / 4.19');
				full_line_item('Chai or Iced Chai', '', '2.69 / 3.59');
				full_line_item('Hot Tea', '', '1.29');
				full_line_item('Syrup Shot', 'Caramel, Hazelnut, Vanilla, Sugar Free Vanilla', 'Add .59');
				full_line_item('Soy Milk', '', 'Add .59');
				full_line_item('Breve', '', 'Add .79');
				full_line_item('Bull Shot ', '', 'Add  .99');
				full_line_item('Coffee Refill', '', '99');
    	?>
    	</div>
	</div>
	<div id="alacarte" style="display:none;" class="short">
    	<h1>Fruit Smoothies</h1>
    	<h2>Select Your Size</h2>
    	<?php
				full_line_item('12oz', '', '3.99');
				full_line_item('20oz', '', '4.99');
				full_line_item('Granola or Peanut Butter', '', 'Add .99');
    	?>
    	<h2>Select Your Fruit</h2>
    	<p class="list">
    		Banana, Blueberry, Pineapple, Mango, Peaches, Strawberry, Raspberry
    	</p>
    	<h2>Select Your Mixer</h2>
    	<p class="list">
    		Vanilla Yogurt, Orange Juice, Apple Juice, Pineapple Juice, Kiwi Strawberry Juice, Lemonade, Fat Free or 2% Milk
    	</p>
	</div>
</div>
