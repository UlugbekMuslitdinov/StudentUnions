<div id="nav" >
  <span class="active" onclick="show('1')" id="1-link">coffee counter</span> : <span onclick="show('2')" id="2-link">deli counter</span> : <span onclick="show('3')" id="3-link">delivery</span>
  <script>var current='1';</script>
</div>
<div id="logo">
  <img src="/template/images/logos/14_The_Counter_Web_Menu_Logo.gif" alt="The Counter"/>
</div>
<div id="desc" >
  <p>
  	Located just under the McClelland Hall. The Counter allows you to make your own sandwich with a great variety of breads, meats, 
  	cheeses, and condiments. The Counter also offers a diversified option of sides, drinks, and desserts. They offer delivery.
  </p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">
  <div id="1" style="display:block;">
    <h1>Coffee Counter</h1>
    <div class="left-col">
    	<?php 
    		half_line_item('Breakfast Bagel', '4.79');
    		half_line_item('Breakfast Burrito', '4.19');
			half_line_item('Breakfast Burrito w/ Meat', '5.09');
			half_line_item('Bagels', '1.89');
			half_line_item('Cream Cheese', '1.09');
			half_line_item('Bear Claws', '1.49');
			half_line_item('Crossiants (Plain)', '1.45');
			half_line_item('Crossiants (Choc. or almond)', '1.69');
			half_line_item('Muffins', '1.49');
    	?>
    </div>
    <div class="right-col">
    	<h2>Sides</h2>
    	<?php 
    		half_line_item('Potato Salad', '0.89');
    		half_line_item('Lucy\'s Pasta Salad', '0.89');
    		half_line_item('Thai Pasta Salad', '0.89');
    	?>
    	<h2>Desserts</h2>
    	<?php 
    		half_line_item('Choc Chip Cookie', '0.69');
    		half_line_item('Whole Fruit', '0.59');
    	?>
    </div>
  </div>
  <div id="2" style="display:none;">
    <h1>Deli Counter</h1>
    <?php 
    	full_line_item('Build your own sandwich', '', '4.59');
    ?>  
    <h2 style="margin-top:-5px;">Breads</h2>
    <p class="list">
    	white, wheat, torpedo roll, rye, low carb wrap or tortilla
    </p>
    <h2>Options</h2>
    <p class="list">
    	roast beef, ham, turkey, bacon, tuna salad, grilled veggies or sliced chicken breast
    </p>
    <h2>Chesses</h2>
    <p class="list">
    	american, cheddar, swiss or provolone
    </p>
    <h2>Condiments</h2>
    <p class="list">
    	chipotle mayo, garlic mayo, mayo, honey mustard, mustard, pepperoncini, pickles, red onion, tomato, shedded lettuce
    </p>
    
    <h2>Drinks</h2>
    <div class="left-col">
    <?php 
    	half_line_item('Asst. Can Sodas', '0.89');
    	half_line_item('Bottled Water', '1.29');
    	half_line_item('Powerade', '1.49');
    ?>
    </div>
    <div class="right-col">
    <br />
    <?php 
    	half_line_item('Minute Maid', '1.69');
    	half_line_item('Coffee', '12oz 1.45 / 16oz 1.75');
    ?>
    </div>
  </div>
  <div id="3" style="display:none;">
    <?php include('counter_delivery.inc')?>
  </div>
</div>