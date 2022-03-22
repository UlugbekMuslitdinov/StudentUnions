<style type="text/css">

	ol {
		padding: 0;
		margin-top: 10px;
		list-style-position: inside;
	}
</style>

<div id="nav" >
	<span class="active" onclick="show('wraps')" id="wraps-link">wraps</span>  :  
    <span onclick="show('falafels')" id="falafels-link">gyros</span>  :  
    <span onclick="show('salads')" id="salads-link">sides</span>  : 
    <span onclick="show('smoothies')" id="smoothies-link">smoothies</span>  :  
    <span onclick="show('beverages')" id="beverages-link">beverages</span>
	<script>var current='wraps';</script>
</div>
<div id="logo">
	<img src="template/images/logos/iq.jpg" alt="IQ Fresh"/>
</div>
<div id="desc" >
	<p>
		You are what you eat. Show your Mensa-level mental capacity by picking up some IQ juice, IQ smoothies, and fresh salads and wraps at IQ fresh.
	</p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">


	<div id="wraps">
		<h1>Wraps</h1>
		<div>
			<h2>Pick Your Wrapper</h2>
			<ul>
				<li>Spinach / Flax seed</li>
			</ul>

			<h2 class="new-section">Veggie Wraps</h2>
			<?php
				full_line_item('Caesar', '', '6.39');
			?>
            
			<h2>That's a wrap</h2>
			<?php
				full_line_item('Crunch Roll', 'Crispy chicken, lettuce, tomatoes, serrano ranch dressing, spinach wrap', '6.59');
				full_line_item('Hail Caesar', '', '6.59');
				full_line_item('The Italian Job', 'Ham, Peppered turkey, salami, provolone tomato, sport peppers, spinach wrap', '7.99');
				full_line_item('Wrapzilla', 'Ham, turkey, bacon, swiss cheese, lettuce, tomato, pesto spread', '6.59');
				full_line_item('Garden of Eden', 'Ancient grains, soy nuts, lemon citrus dressing wrapped in lettuce leaves', '4.59');
			?>
		</div>
	</div>

	<div id="falafels" style="display:none;">
		<h1>Gyros</h1>
		<div class="left-col">
			<h2>Gyros</h2>
			<?php
				half_line_item('Gyro Wrapture', '6.59');
			?>
		</div>
	</div>

	<div id="salads" style="display:none;">
		<h1>Sides</h1>
		<div class="left-col">
			<h2>Extras</h2>
			<?php
			half_line_item('Shoestring Fries', '1.69');
			half_line_item('Sweet Potato Fries', '2.79');
			half_line_item('Extra Dressing', '0.75');
			half_line_item('Pita Chips', '0.99');
			half_line_item('Hummus', '1.49');
			?>

		</div>
		<div class="right-col">
			<h2 class="new-section">Dressings</h2>
				<p class="list">
					Caesar, Ranch, Serrano ranch, BBQ, Buffalo, Lemon Citrus, Balsamic, Sesame Ginger
				</p>
		</div>
	</div>

	<div id="smoothies" style="display:none;">
		<h1>Smoothies</h1>

			<div class="left-col">
				<h2>Brilliant Smoothies</h2>
				<?php
					half_line_item('12oz', '3.99');
					half_line_item('20oz', '4.99');
				?>
				<p class="list" style="font-size:10px;">
					Mensa Mango<br>
					Twisted Elvis<br>
					Tropical<br>
					Back to Basics<br>
					Green Monster<br>
					Champ
				</p>
			</div>

			<div class="right-col">
				<h2>Create Your Own Smoothie</h2>
				<?php
					half_line_item('12oz', '4.29');
					half_line_item('20oz', '5.29');
				?>
				<div style="clear:both;"></div>
				<p class="list">
					<ol>
						<li>Pick your fruit(s)<br>
						Peaches, Raspberries, Bananas, Mangos, Strawberries, Blueberries, Pineapple, Cucumber, Kale</li>
						<li>Check your mixer(s)<br>
						Vanilla Yogurt, Pineapple Juice, Orange Juice, Apple Juice, 2% Milk, Soy Milk, Almond Milk, Coconut water</li>
						<li>ADD Ins<br>
						<?php
							half_line_item('Acal', '1.99');
							half_line_item('Protein Powder', '1.69');
						?>
                        <div class="list" style="font-size:10px;">(Vanilla Bio Pro, Chocolate  Bio Pro)</div>	
						<?php
							half_line_item('Peanut Butter', '0.99');
							half_line_item('Flax Seed', '0.99');
						?>
                        
					</ol>
				</p>
			</div>
			<div style="clear:both;"></div>

	</div>


	<div id="beverages" style="display:none;">
		<h1>Beverages</h1>
		<div class="left-col">
			<h2>Fountain Drinks and More</h2>
			<?php
				half_line_item('Fountain Drinks and Tea 24oz', '1.65');
				half_line_item('Dasani Water', '1.55');
				half_line_item('Smart Water', '1.55');
				half_line_item('Milk', '1.89');
				half_line_item('Chocolate Milk', '1.89');
			?>
		</div>
		<div class="right-col">
			<h2 class="new-section">Juice</h2>
			<?php
				half_line_item('Orange, Apple, Pineapple 12oz', '1.89');
			?>
		</div>
	</div>

</div>
