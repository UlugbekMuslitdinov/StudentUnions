<style>
	.line-item {
		margin-bottom: 8px;
		line-height: 14px;
	}

	.line-item div{
		width:420px;
	}

	.group {
		margin-bottom: 10px;
	}

	.group .line-item {
		font-weight: normal;
		margin-bottom: 0;
	}

	.group .line-item:first-child {
		font-weight: bold;
	}
</style>
<div id="nav" >
	<span class="active" onclick="show('signature')" id="signature-link" >Signature Sandwiches</span> :
	<span onclick="show('bagel_egg')" id="bagel_egg-link" >Bagels and Egg Sandwiches</span> :
	<span onclick="show('hot')" id="hot-link" >Hot Sandwiches</span> :
	<span onclick="show('beverages')" id="beverages-link" >Beverages</span>
	<script>var current='signature';</script>
</div>
<!--div id="logo">
	<img src="template/images/logos/sabor.jpg" alt="Sabor"/>
</div>
<div id="desc" >
	<p>
		Sabor offers fresh Mexican fare with a fast-casual, modern twist and a focus on quality ingredients and table service. We seek to transform traditional Mexican food and combine it with an engaging experience that fits the current mindset of students. With a menu consisting of tacos, burritos, taco salads and more, the restaurant features a full salsa bar and is located on the east end of the main level of the Student Union Memorial Center.
	</p>
</div-->
<div id="menu-content" style="clear:both; padding-top:5px;">
	<div id="signature">
		<h1 style="margin-bottom:.1em;">Signature Sandwiches</h1>
		<?php
			full_line_item('Nova Lox', '', '7.29');
			full_line_item('Tasty Turkey', '', '7.19');
			full_line_item('Turkey, Bacon and Avocado', '', '7.19');
			full_line_item('Hummus Veg Out', '', '6.79');
			full_line_item('Turkey Club Mex Wrap', '', '7.19');
		?>

		<h2>Deli</h2>
		<p>Served on your choice of Multigrain Bread, Bagel or Wheat Tortilla</p>
		<?php
			full_line_item('Turkey and Cheddar', '', '6.79');
			full_line_item('Harvest Chicken Salad', '', '6.79');
			full_line_item('Albacore Tuna Salad', '', '6.79');
			full_line_item('Ham and Swiss', '', '6.79');
		?>

	</div>

	<div id="bagel_egg" style="display:none;">
		<h1>Bagels and Egg Sandwiches</h1>
		<div class="left-col" style="position: relative;">
			<h2>Egg Sandwiches</h2>
			<?php
				half_line_item('Applewood Bacon and Cheddar', '5.49');
				half_line_item('Turkey Sausage and Cheddar', '5.49');
				half_line_item('Ham and Swiss', '5.49');
				half_line_item('Cheddar Cheese', '4.99');
				half_line_item('Santa Fe Wrap', '5.69');
				half_line_item('Spinach, Mushroom and Swiss', '5.49');
				half_line_item('Asparagus and Mushroom Egg White', '5.19');
				half_line_item('Southwest Egg White', '5.19');
			?>
			<h2 style="clear:both; padding-top:1em;">Bagel Boxes</h2>
			<?php
				half_line_item('Baker’s Dozen Box', '15.49');
				half_line_item('Half Dozen Box', '9.49');
				half_line_item('Extra Tub of Shmear', '3.79');
			?>
		</div>
		<div class="right-col" style="position: relative; margin-top:0;">
			<h2>Bagel and Topping</h2>
			<?php
				half_line_item('Bagel', '1.49');
				half_line_item('Power Protein', '1.84');
				half_line_item('Shmear', '2.80');
				half_line_item('Nutella&reg;', '2.80');
				half_line_item('Hummus', '2.80');
				half_line_item('Peanut Butter', '1.90');
				half_line_item('PB&J', '2.80');
				half_line_item('Butter Blend', '1.90');
				half_line_item('Honey Butter', '1.90');
			?>
		</div>
	</div>

	<div id="hot" style="display:none;">
		<h1>Hot Sandwiches</h1>

		<?php
			full_line_item('Italian Chicken Tostini&reg;', '', '7.89');
			full_line_item('Turkey Club Tostini&reg;', '', '7.89');
			full_line_item('Buffalo Chicken and Bacon Tostini&reg;', '', '7.89');
			full_line_item('Cheesy Chicken and Asparagus Melt', '', '6.79');
			full_line_item('Thintastic&trade; Buffalo Chicken', '', '5.39');
		?>

		<h2>Pizza Bagel</h2>
		<?php
			full_line_item('Cheese', '', '6.19');
			full_line_item('Pepperoni', '', '6.19');
		?>
	</div>

	<div id="beverages" style="display:none;">
		<h1>Hot Sandwiches</h1>
		<div class="left-col" style="position: relative;">
			<h2>Hot, Iced, or Frozen Drinks</h2>
			<div class="half-line-item"><div><div>Medium /  Large</div>&nbsp;</div></div>
			<?php
				half_line_item('Vanilla Hazelnut Latte', '4.29 / 4.79');
				half_line_item('Vanilla Latte', '4.09 / 4.79');
				half_line_item('White Chocolate Mocha', '4.29 / 4.79');
				half_line_item('Caramel macchiato', '4.09 / 4.79');
				half_line_item('Hazelnut Mocha', '4.29 / 4.79');
				half_line_item('Latte', '3.59 / 4.29');
				half_line_item('Mocha', '4.09 / 4.79');
				half_line_item('Oregon Chai&reg; Tea Latte', '3.79 / 4.49');
				half_line_item('Cappuccino', '3.59 / 4.29');
			?>
			<h2 style="clear:both; padding-top:1em;">Smoothies</h2>
			<div class="half-line-item"><div><div>Medium</div>&nbsp;</div></div>
			<?php
				half_line_item('Strawberry Banana Smoothie', '4.19');
				half_line_item('Mixed Berry Smoothie', '4.19');
			?>
		</div>
		<div class="right-col" style="position: relative; margin-top:0;">
			<h2>Neighborhood Favorites</h2>
			<div class="half-line-item"><div><div>Medium /  Large</div>&nbsp;</div></div>
			<?php
				half_line_item('Coffee', '2.09 / 2.59');
				half_line_item('Iced Coffee', '2.09 / 2.59');
				half_line_item('Hot Tea', '2.09 / 2.59');
				half_line_item('Iced Tea', '1.89 / 2.39');
				half_line_item('Hot Cocoa', '3.09 / 3.79');
				half_line_item('Fountain', '1.89 / 2.39');
			?>
		</div>
	</div>
</div>
