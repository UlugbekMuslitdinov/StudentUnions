<div id="nav" >
  <span class="active" onclick="show('1')" id="1-link">espresso &amp; coffee</span> : <span onclick="show('2')" id="2-link">bagels &amp; sandwiches</span>
  <script>var current='1';</script>
</div>
<div id="logo">
  <img src="template/images/logos/bookend.gif" alt="Bookend Caf&eacute;"/>
</div>
<div id="desc" >
  <p>Bookend Cafe serves a variety of drinks, bakery, and meal products. We are located at the front of the main university library.</p>
</div>
<div id="menu-content" style="clear:both; padding-top:0px; font:10px;">
  <div id="1" style="display:block;">
  <h1>Coffee &amp; Espresso</h1>
  	<div class="left-col">
    <h2>Hot Espresso</h2>
    <?php 
    	half_line_item('Espresso', '1.40 / 1.88');
    	half_line_item('Caffe Americano', '1.40 / 1.88');
    	half_line_item('Cappucino', '2.60 / 3.10');
    	half_line_item('Caffe Latte', '2.60 / 3.10');
    	half_line_item('Cafe Mocha', '2.85 / 3.35');
    ?>
    <h2>Cold Espresso</h2>
    <?php 
    	half_line_item('Iced Espresso', '1.40 / 1.88');
    	half_line_item('Iced Caffe Latte', '2.35 / 2.85 / 3.60');
    	half_line_item('Iced Caffe Mocha', '2.60 / 3.00 / 3.85');
    	
    ?>
    </div>
    <div class="right-col">
    	<h2>Coffee</h2>
    	<?php 
    		half_line_item('House Blend', '1.25 / 1.45 / 1.19');
    		half_line_item('Steamers/Hot Chocolate', '1.50 / 1.75 / 2.05');
    		half_line_item('Syrups', 'add .55');
    		half_line_item('Soy Milk', 'add .50');
    	?>
    	<h2>Tea</h2>
    	<?php 
    		half_line_item('Chai Tea', '2.30 / 3.55');	
    	?>
    </div>
  </div>
  <div id="2" style="display:none;">
  <h1>Sandwiches &amp; Bagels</h1>
  	<div class="left-col">
  		<h2>Sandwiches</h2>
  		<?php 
  			half_line_item('Bread or Croissant w/ Meat', '6.79/lb');
  			half_line_item('Bagel w/ Meat &amp; Cheese', '4.79/lb');
  			half_line_item('Egg Salad on a Bagel', '3.99/lb');
  			half_line_item('Veggie on a Bagel', '3.69/lb');
  			half_line_item('Extra Veggies', '.75');
  		?>
  		<br />
  		<p class="list">
  		Breads<br />
  		white, wheat, nine grain, sourdough, croissant
  		</p>
  		<p class="list">
  		Chesses<br />
  		swiss, provolone, pepper jack, cheddar
  		</p>
  		<p class="list">
  		Meats<br />
  		roast beef, cured ham, smoked turkey, tuna salad, roast chicken breast
  		</p>
  		<p class="list">
  		Condiments<br />
  		mustard, dijon mustard, mayonaise
  		</p>
  	</div>
  	<div class="right-col">
  		<h2>Bagels</h2>
  		<?php 
  			half_line_item('bagel', '1.69');
  			half_line_item('Bagel w/ Cream Cheese', '2.99');
  			half_line_item('Additional Cream Cheese', '1.25');
  		?>
  		<p class="list">
  		Bagels<br />
  		plain, jalapeno, blueberry, sun-dried tomato, cinnamon raisin, onion, everything, honey oat grain, sesame seed, cheddar cheese
  		</p>
  		<p class="list">
  		Cream Chesses<br />
  		plain, jalapeno, chive, blueberry, strawberry, garden veggie
  		</p>
  	</div>    
  </div>
</div>