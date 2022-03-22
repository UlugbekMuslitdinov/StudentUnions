<style>
	ol{
		margin:0px; line-height:11px; padding-left:20px;
	}
	ol li{
		line-height:11px;
		margin:0px;
		padding:0px;
	}
	.line-item {
    margin-bottom: 10px;
  }
</style>
<div id="nav" >
  <span class="active" onclick="show('bagels')" id="bagels-link">bagels</span>  :  <span onclick="show('sand')" id="sand-link">sandwiches</span>  :  
  <span onclick="show('pizza')" id="pizza-link">pizza bagels</span>  :  <span onclick="show('extras')" id="extras-link">extras</span>
  <script>var current='bagels';</script>
</div>
<div id="logo">
  <img src="template/images/logos/bageltalk.gif" alt="Bagel Talk"/>
</div>
<div id="desc" >
  <p>Located at Park Student Union, Bagel Talk! features a large selection of gourmet bagels, cream cheese, breakfast bagel sandwiches, and piping hot coffee.</p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">

  <div id="bagels" style="display:block;">
    <h1>Bagels</h1>
    <?php 
    	full_line_item('Plain or with Butter', '', '1.89');
    	full_line_item('With Cream Cheese', '', '2.99');
    	full_line_item('Make it a Combo', 'w/ cream cheese &amp; coffee', '4.59');
    ?>
    <p style="font-weight:normal;">
    	<strong>Bagels</strong>
    		Blueberry, 
		Cheddar,
		Cinnamon Raisin,
		Everything,
		Honey Oat Grain,
		Jalape&ntilde;o,
		Multi Grain,
		Onion,
		Pesto,
		Plain,
		Poppy Seed,
		Pumpernickel Rye,
		Sesame Seed,
		Sun-Dried Tomato,
		Whole Wheat<br /><br />
        
        <strong>Cream Cheeses</strong><br />
		Blueberry,
		Chive,
		Flavor of the Month,
		Honey Walnut,
		Jalape&ntilde;o,
		Plain,
		Strawberry,
		Sun Dried Tomato &amp; Basil,
		Veggie<br /><br />
        
        <strong>Spreads</strong> <br />
        Butter, Jelly, Peanut Butter
        <br /><br />
	</p>        
  </div>
  
  <style>
  	#sand .line-item div{
  		width:215px;
  	}
  </style>
  <div id="sand" style="display:none;">
    <h1 style="margin-bottom:3px;">Sandwiches</h1>
    <div class="left-col">
	    <?php 

	    	full_line_item('Mix &amp; Match', 'any bagel, cheese, fried egg', '3.79');
	    	full_line_item('Mix &amp; Match w/ Meat', 'add ham, bacon or sausage', '4.79');
	    	full_line_item('French Toast', 'plain bagel, fried egg, maple cream cheese, sausage', '4.49');
	    	full_line_item('Tucson', 'cheddar bagel, jalapeno cream cheese, fried egg, bacon', '4.39');
	    	full_line_item('New York Deli', 'sesame bagel, swiss cheese, fried egg, pastrami', '5.69');
	    	full_line_item('Bagel &amp; Lox', 'plain bagel, plain cream cheese, nova lox,<br/>capers, onion, tomato', '7.89');

			// We are hard-coding the remaining items for style consistency purposes
		?>
		<div class="line-item"><div style="width: 177px">PB&amp;B..................................................................................................................................................</div>
		3.49<br/><span>peanut butter, honey, banana & chopped walnuts on wheat</span></div>
		<div class="line-item"><div style="width: 177px">Veggie..................................................................................................................................................</div>
		4.29<br/><span>cucumber, tomato, alfalfa sprouts, avocado,<br>sweet onion &amp; cream cheese on 9 grain</span></div>
		
	</div>
	<div class="right-col">
		<div class="line-item"><div style="width: 177px">California&nbsp;BLT..................................................................................................................................................</div>
		4.79<br/><span>bacon, lettuce, avocado, tomato &amp; mayo on toasted white</span></div>
		<div class="line-item"><div style="width: 177px">Albacore&nbsp;Tuna..................................................................................................................................................</div>
		4.29<br/><span>albacore tuna salad, lettuce &amp; tomato on wheat</span></div>
		<div class="line-item"><div style="width: 177px">You&nbsp;Call&nbsp;It..................................................................................................................................................</div>
		5.99<br/><span><ol><li>Choose your meat: roast beef, pastrami, turkey or ham</li><li>Pick a cheese: swiss, pepperjack, provolone or cheddar</li><li>Choose your veggies: tomato, lettuce, onions or pickles</li><li>Finish it with mayo or mustard</li></ol></span></div>
		<div class="line-item"><div style="width: 177px">Classic&nbsp;Club..................................................................................................................................................</div>
		6.79<br/><span>a triple decker with turkey, bacon, lettuce,<br>tomato &amp; mayo on toasted white</span></div>
		<div class="line-item"><div style="width: 177px">Wildcat..................................................................................................................................................</div>
		6.99<br/><span>turkey, bacon, pepperjack cheese with lettuce, avocado,<br>tomato, sweet onion &amp; mayo on wheat</span></div>
		<div class="line-item"><div style="width: 177px">The&nbsp;New&nbsp;Breakfast&nbsp;Bagel:&nbsp;Southwest..................................................................................................................................................</div>
		4.99<br/><span>Jalapeno Bagel, Cheddar Cheese, Avocado, Egg, Bacon and Salsa</span></div>
	</div>  
  </div>
  
  <div id="pizza" style="display:none;">
    <h1 style="margin-bottom:3px;">Pizza Bagels</h1>
    <div class="left-col">
	    
		<div class="line-item"><div style="width: 177px">Cheese&nbsp;Pizza..................................................................................................................................................</div>
		2.99<br/><span>mozzarella &amp; marinara sauce</span></div>
		<div class="line-item"><div style="width: 177px">Vegetarian..................................................................................................................................................</div>
		3.49<br/><span>Spinach, Tomato, Green peppers, Onion, Olive, Mozzarella &amp; Marinara Sauce</span></div>
		<div class="line-item"><div style="width: 177px">California..................................................................................................................................................</div>
		4.59<br/><span>Avocado, Bacon, Mozzarella & Marinara Sauce</span></div>
		
	</div>
	<div class="right-col">
		<div class="line-item"><div style="width: 177px">Meat&nbsp;Lovers..................................................................................................................................................</div>
		5.69<br/><span>Sausage, Bacon, Pepperoni, Mozzarella & Marinara Sauce</span></div>
		<div class="line-item"><div style="width: 177px">Pizza&nbsp;Bagel&nbsp;w/&nbsp;Veggies..................................................................................................................................................</div>
		3.59<br/><span>choose your toppings</span></div>
		<div class="line-item"><div style="width: 177px">Pizza&nbsp;Bagel&nbsp;w/&nbsp;Protein..................................................................................................................................................</div>
		4.59<br/><span>choose your toppings</span></div>
		
	</div>  
  </div>
  
  <div id="extras" style="display:none;">
    <h1 style="margin-bottom:3px;">Extras</h1>
    <div class="left-col">
	    <?php 
	    half_line_item('Fresh Fruit', '0.59');
		half_line_item('Granookie', '1.29');
		half_line_item('Parfait', '2.49');
		half_line_item('Fountain Drink (24oz)', '1.49');
	    	half_line_item('Hot or Iced Coffee', '1.79');
		?>
	</div>
	<div class="right-col">
		<?php
		half_line_item('Hot Chocolate', '1.79');
		half_line_item('Bacon (slice)', '0.59');
		half_line_item('Avocado (slice)', '0.69');
		half_line_item('Cream Cheese', '1.19');
		?>
	</div>  
  </div>
  
  
</div>