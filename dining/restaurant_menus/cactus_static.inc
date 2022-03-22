<div id="nav" > 
			<span class="active" onclick="show('breakfast')" id="breakfast-link">breakfast</span> 
		:	<span onclick="show('omlet_potato')" id="omlet_potato-link">omelet/potato bar</span>
		:	<span onclick="show('wraps')" id="wraps-link">wraps</span>
		:	<span onclick="show('grill')" id="grill-link">the grill</span>
		:	<span onclick="show('buffet')" id="buffet-link">hot line</span>
		:	<span onclick="show('wox')" id="wox-link">noodle bowl</span>
		:	<span onclick="show('bbq')" id="bbq-link">bbq</span>
		:	<span onclick="show('healthy')" id="healthy-link">Nutrition Info</span>
	<script>var current='breakfast';</script>
</div>
<div id="logo">
	<img src="template/images/logos/cactus.gif" alt="Cactus Grill"/>
</div>
<div id="desc" >
	<p>Located on the third floor of the Student Union, the Cactus Grill offers a wide
	variety of choices ranging from soups, breakfasts, grilled sandwiches, hot lunches
	and dinners to frozen yogurt, coffee, desserts and an extensive salad bar.</p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">
	<div id="breakfast" style="display:block;">
		<h1>breakfast</h1>
		<p> 
			Monday through Friday breakfast is available from 7am to 10:30am. We offer
			several breakfast specials as well as made to order omelets, breakfast burros,
			and bagel sandwiches. You may make your own waffles or grab and go from a
			variety of pastries, bagels, yogurts and cereal.
		</p>
		
		<h2>Breakfast Burritos</h2>
		<?php 
			full_line_item('2 Eggs, Potatoes, Salsa &amp; Cheddar or Jack','', '3.49');
			full_line_item('Chorizo, Potatoes, Salsa &amp; Cheddar or Jack','', '3.99');
			full_line_item('2 Eggs, Chorizo, Potatoes, Salsa &amp; Cheddar or Jack','', '4.59');
			full_line_item('Customize Your Burrito:','', '.55/item');
		?>
		
		<p>&nbsp;</p><h2>Breakfast Sandwiches</h2>
		<span style="font-size: 8px;">english muffin, biscuit or bagel</span>
		<?php 
			full_line_item('Egg &amp; Cheese','', '2.39');
			full_line_item('Egg &amp; Cheese w/ Sausage or Bacon','', '2.99');
		?>
	</div>
	
	<div id="omlet_potato" style="display:none;">
		<h1>Omelet/Potato Bar</h1>
		 <?php 
				full_line_item('Three Egg Omelet (with one topping)', '', '2.29');
				full_line_item('Baked Potato', '', '1.89');
				full_line_item('Customize Your Omelet or Potato', '','.55/item');
		 ?> 
		 <div style="float:left;">
			<p class="list">
				ham<br />
				bacon<br />
				chicken<br />
				chorizo<br />
				sausage<br />
				monterey jack<br />
				spinach
			</p>
		 </div>
		 <div style="float:left; margin-left:15px;">
			<p class="list">
				green chilies<br />
				mushrooms<br />
				green peppers<br />
				tomatoes<br />
				black olives<br />
				american<br />
			green onions
			</p>
		 </div>
		 <div style="float:left; margin-left:15px;">
			<p class="list">
				potatoes<br />
				onions<br />
				salsa<br />
				sour cream<br />
				swiss<br />
				cheddar
			</p>
		 </div>			
	</div>
	
	<div id="wraps" style="display:none;">
		<style>
			.line-item{
				margin-bottom:5px;
			}
			p{
				margin-top:0px;
			}
		</style>
		<h1>Wrap Station</h1>
		<?php 
			full_line_item('Marinated Steak', '', '4.99');
			full_line_item('Crispy Chicken', '', '5.09');
			full_line_item('Grilled Chicken', '', '4.89');
			full_line_item('Thai Chicken', '', '4.19');
			full_line_item('Veggie Delight', '', '3.49');
			full_line_item('Tofu', '', '4.89');
		?>	
		<h2>Wraps are made to order with your choice of tortilla:</h2>
	 
	 	<p class="list" style="float:left;">
	 		flour<br />
	 		wheat<br />
	 		lo-carb
	 	</p>
	 
	 	<p class="list" style="float:left; margin-left:15px;">
	 		tomato basil<br />
	 		garlic &amp; herb
	 	</p>
	 
	 	<p class="list" style="float:left; margin-left:15px;">
	 		chipotle<br />
	 		spinach
	 	</p>
		<div style="float:left;clear:both;margin-right:25px;">
			<h2 style="clear:both;">Please pick from the following toppings:</h2>
			<p class="list" style="float:left;">
				lettuce<br />
				tomatoes<br />
				green onions<br />
				cheddar<br />
				white rice<br />
				pinto beans
			</p>
 
			<p class="list" style="float:left; margin-left:15px;">
				romaine<br />
				pickles<br />
				olives<br />
				jack cheese<br />
				spanish rice<br />
				spinach<br />
			cucumber
			</p>
 
			<p class="list" style="float:left; margin-left:15px;">
				red onions<br />
				salsa<br />
				jalapenos<br />
				parmesan<br />
				black beans
			</p>
	 	</div>
	 	<div style="float:left;">
	 		<h2 style="">and from the following sauces:</h2>
			<p class="list" style="float:left;">
				ranch<br />
				chipotle mayo<br />
				chinese ginger<br />
				BBQ<br />
				sun dried tomato
			</p>
 
			<p class="list" style="float:left; margin-left:15px;">
				salsa<br />
				thai peanut<br />
				caesar<br />
				lemon ginger
			</p>
		</div>
	</div>
	
	<div id="grill" style="display:none; width: 2000px;">
		<h1 style="margin-bottom:8px;">The Grill</h1>
		<div class="left-col" style="position: relative;">
			<h2>Burgers<span style="font-size: 9px;"> - <a href="javascript: $('#burgers-single').slideDown(); $('#burgers-double').slideUp();" style="color: #484848; text-decoration:none;">single</a> : <a href="javascript: $('#burgers-double').slideDown(); $('#burgers-single').slideUp();" style="color: #484848; text-decoration:none;">double</a></span></h2>
			<div id="burgers-single">
				<?php 
					half_line_item('Hamburger', '2.69');
					half_line_item('Cheeseburger', '3.29');
					half_line_item('Bacon Cheeseburger', '4.29');
				?>
				<span style="font-size: 8px;">(american, swiss, provolone, pepper jack or cheddar)</span>
				<?php 
					half_line_item('Bacon Burger', '3.79');
				?>
				<span style="font-size: 8px;">with two slices of bacon</span>
				<?php 
					half_line_item('Garden or Black Bean Burger', '4.09');
				?>
				<span style="font-size: 8px;">with grilled onion, mushrooms, provolone &amp; green pepper</span>
				<?php 
					half_line_item('Patty Melt', '3.69');
				?>
				<span style="font-size: 8px;">burger patty with swiss &amp; grilled onions on grilled rye bread</span>
			</div>
			<div id="burgers-double" style="display:none;">
				<?php 
					half_line_item('Double Hamburger', '4.49');
					half_line_item('Double Cheeseburger', '4.99');
					half_line_item('Double Bacon Burger', '6.49');
					half_line_item('Double Bacon Cheeseburger', '6.59');
				?><br /><br />
			</div>
			<h2 style="margin-top:8px;">Chicken</h2>
			<?php 
				half_line_item('One Chicken Strip', '1.49');
				half_line_item('Chicken Strip Basket', '5.19');
			?>
			<span style="font-size: 8px;">salsa or sour cream</span>
			<?php 
				half_line_item('Chicken Strips', '4.29');
			?>
			<span style="font-size: 8px;">self-serve BBQ sauces located at condiment station.</span>
		</div>
		<div class="right-col" style="position: relative;">
			<p>&nbsp;</p><h2>Grilled Sandwiches</h2>
			<?php 
				half_line_item('Steak Provolone Philly', '5.19');
			?>
			<span style="font-size: 8px;">lean grilled steak, onions, peppers, mushrooms,
			provolone &amp; teriyaki sauce on a steak roll</span>
			<?php 
				half_line_item('Chicken Provolone Philly', '4.29');
			?>
			<span style="font-size: 8px;">grilled chicken breast, onions, peppers,
			mushrooms, provolone &amp; teriyaki sauce, served on a steak roll</span>
			<?php 
				half_line_item('Reuben Sandwich', '4.99');
			?>
			<span style="font-size: 8px;">lean grilled corned beef, sauerkraut, swiss
			cheese &amp; thousand island dressing on grilled rye bread.</span>
			<?php 
				half_line_item('Chicken and Provolone', '4.49');
			?>
			<span style="font-size: 8px;">grilled chicken breast, onions, peppers,
			mushrooms, provolone, &amp; teriyaki sauce on a bun</span>
			<?php 
				half_line_item('Hot Pastrami', '4.89');
			?>
			<span style="font-size: 8px;">lean pastrami &amp; swiss on grilled rye bread</span>
			<?php 
				half_line_item('Grilled Veggie', '3.09');
			?>
			<span style="font-size: 8px;">grilled onions, peppers, mushrooms, provolone
			&amp; teriyaki sauce, served on a bun</span>
			<?php 
				half_line_item('Hot Ham &amp; Cheese', '2.89');
			?>
			<span style="font-size: 8px;">grilled ham &amp; cheese on Kaiser roll</span>
	 		<?php
	 			half_line_item('Turkey Provolone', '3.09');
			?>
		</div>
		<div class="right-col" style="position: relative;">
			<p>&nbsp;</p><h2>Grilled Cheese</h2>
			<?php 
				half_line_item('Grilled Cheese', '1.85');
				half_line_item('Grilled Cheese &amp; Bacon', '2.99');
				half_line_item('Grilled Cheese &amp; Tomato', '2.09');
				half_line_item('Grilled Ham &amp; Cheese', '2.89');
			?>
			<span style="font-size: 8px;">Cheese options are American, Cheddar, Swiss, or
			Provolone</span><br /><br />
			<h2>Quesadillas</h2>
			<?php 
				half_line_item('Chicken Quesadilla', '4.79');
				half_line_item('Chicken Fajita Ques', '4.99');
				half_line_item('Steak Quesadilla', '5.39');
				half_line_item('Steak Fajita Quesadilla', '5.59');
				half_line_item('Vegetable Ques', '4.59');
				half_line_item('Cheese Quesadilla', '3.49');
				half_line_item('Green Chile Ques', '3.59');
			?>
		</div>
		<div class="right-col" style="position: relative;">
			<p>&nbsp;</p><h2>Veggie Sandwiches</h2>
			<?php 
				half_line_item('Garden Burger', '4.09');
				half_line_item('Black Bean Burger', '2.99');
				half_line_item('Grilled Vegetable', '3.89');
			?>
		</div>
		<div style="background-image: url('template/images/Arrows.png'); background-position: 0px -28px; background-repeat: no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 14px; width: 14px; cursor:pointer; margin-top: 296px;" onclick="scrollBackward();"></div>
		<div style="background-image: url('template/images/Arrows.png'); background-position: 0px -28px; background-repeat: no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 14px; width: 14px; cursor:pointer; -moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); filter: FlipH; -ms-filter: 'FlipH'; margin-left: 490px; margin-top: -12px;" onclick="scrollForward();"></div>
	</div>
	
	<div id="buffet" style="display:none;">
		<h1>Hot Line</h1>
		<p> 
			Our hotline serves fresh entrees, carved meats, vegetables and great macaroni and cheese. The menu changes daily at lunch and dinner. 
		</p>				
	</div>
	
	<div id="wox" style="display:none;">
		<h1>Noodle Bowls</h1>
		<?php 
			full_line_item('Noodle Bowl', 'udon or rice noodles', '2.99');
			full_line_item('Add Shrimp', '', '2.29');
			full_line_item('Add Beef', '', '1.69');
			full_line_item('Add Chicken', '', '1.29');
			full_line_item('Add Tofu', '', '.99');
		?>
		<h2>Choose 4 toppings:</h2>
		<p class="list" style="float:left;">
	 		green onion<br />
	 		napa cabbage<br />
	 		bean sprouts<br />
	 		baby corn<br />
	 		edamame
	 	</p>
	 
	 	<p class="list" style="float:left; margin-left:15px;">
	 		yellow onion<br />
	 		green pepper<br />
	 		mushroom<br />
	 		bok choy<br />
	 		carrot
	 	</p>
	 
	 	<p class="list" style="float:left; margin-left:15px;">
	 		tomato<br />
	 		red pepper<br />
	 		broccoli<br />
	 		water chestnuts<br />
	 		peanuts
	 	</p>
	 	
		<h2 style="clear:both;">Choose a sauce</h2>
		<p class="list" style="float:left;">
	 		sesame
	 	</p>
	 
	 	<p class="list" style="float:left; margin-left:15px;">
	 		Thai peanut
	 	</p>
	 
	 	<p class="list" style="float:left; margin-left:15px;">
	 		ginger lime soy
	 	</p>				
	</div>
	
	<div id="bbq" style="display:none;">
		<h1>BBQ Sandwiches</h1>
		<p>All of our meats our smoked 24 hours with local pecan wood and served on our signature bun.</p>
		<?php 
			full_line_item('Pork', '', '4.79 (4oz) 5.69 (6oz)');
			full_line_item('Turkey', '', '4.99 (4oz) 5.89 (6oz)');
			full_line_item('Beef Brisket', '', '5.99 (4oz) 7.59 (6oz)');
		?>
		<div style="float: left; width: 250px;">
			<h1>Hot Sides</h1>
			<?php 
				half_line_item('Baked Beans', '1.19');
				half_line_item('Macaroni & Cheese', '1.19');
			?>
			<br/>
			<br/>
			<h1>Cold Sides</h1>
			<?php 
				half_line_item('Home Style Slaw', '1.49');
				half_line_item('Carolina Slaw', '1.49');
				half_line_item('Gil’s Potato Salad', '1.49');
			?>
		</div>
		
		<div style="float: left; width: 175px; margin: 20px">
			<h2>Chips 1.09</h2>
			<p class="list">
				Regular - BBQ - Salt & Vinegar - Jalapeños - Baked Lays - Doritos
			</p>
			
			<h2>Make it a combo 1.99</h2>
			<p class="list">
				Sandwich, Hot or Cold Side and Drink
			</p>
			
			<h2>Sandwich toppings</h2>
			<p class="list">
				Jalapeños - Sweet Peppers - <br/>Chow Chow
			</p>
			
			<h2>BBQ Sauces (Self-Serve)</h2>
			<p class="list">
				Regular - Golden - Memphis Heat - Smoky
			</p>
		</div>
		<br style="clear: both"/>
	</div>
	
	<div id="healthy" align="center" style="display:none; margin-top:20px;">
		<?php include("./healthy_options.inc"); ?>
		<h1>Top Healthy Options</h1>
		<table width="95%" cellpadding="5">
			<tr><td><strong>Item</strong></td><td><strong>Cal</td><td><strong>Pro</strong></td><td><strong>Fat</strong></td><td><strong>Carb</strong></td></tr>
		<?php 
		
			$arr = $healthy_options[$_SESSION['menu_location_id']];
			for($i = 1; $i < count($arr); $i++)
		{
			echo "<tr>";	
			for($z = 0; $z < count($arr[$i]); $z++)
			{
				echo "<td>".$arr[$i][$z]."</td>";
			}
			echo "</tr>";
		}
	?>
	</table>
	</div>
</div>

<script>
	$("#menu-content-wrapper").css({"margin-right": "25px", "overflow": "hidden"})

	i = 0;

	function scrollForward()
	{
		if(i < 2)
		{
			$('.right-col').animate({left: '-=270'});
			$('.left-col').animate({left: '-=270'});
			i++;
		}
	}
	
	function scrollBackward()
	{
		if(i > 0)
		{
			$('.right-col').animate({left: '+=270'});
			$('.left-col').animate({left: '+=270'});
			i--;
		}
	}
</script>