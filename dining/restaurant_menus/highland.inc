<div id="nav" >
  <span class="active" onclick="show('1')" id="1-link">breakfast</span> : <span onclick="show('2')" id="2-link">grill</span> : <span onclick="show('3')" id="3-link">wraps &amp; sandwiches</span><!-- : <span onclick="show('4')" id="4-link">pasta</span> : <span onclick="show('5')" id="5-link">rotisserie chicken</span>--> : <span onclick="show('4')" id="4-link">late night</span>
  <script>var current='1';</script>
</div>
<div id="logo">
  <img src="template/images/logos/highland.gif" alt="Highland"/>
</div>
<div id="desc" >
  <p>On the corner of Sixth and Highland, next to El Portal and across from the Rec Center.</p>
</div>
<style>
h2 {
  float:left;
}
</style>
<div id="menu-content" style="clear:both; padding-top:5px;">
  <div id="1" style="display:block;">
    <h1>Breakfast</h1>
    <div class="left-col">
    	<h2>Burritos</h2>
    	<p class="list">
    		<br clear="all">Includes potatoes, eggs, cheese and salsa
    	</p>
    	<?php 
    		half_line_item('Vegetable', '4.19');
    		half_line_item('Meat', '4.89');
    		half_line_item('Extra Veggies', '.75 ea');
    		half_line_item('Extra Protein', '1.39 ea');
    	?>
    </div>
    <div class="right-col">
    	<h2>Breakfast Sandwiches</h2>
    	<p class="list">
			<br clear="all">Includes two eggs, american cheese and choice of english muffin, bagel or bread
    	</p>
    	<?php 
    		half_line_item('Egg &amp; Cheese', '3.39');
    		half_line_item('Sausage, Bacon or Ham', '4.79');
    	?>
    </div>
  </div>
  <div id="2" style="display:none;">
    <h1>Grill</h1>
    <div class="left-col">
    	<h2>Quesadillas</h2>
    	<div style="float:left;">
    	<?php 
    		half_line_item('Cheese', '2.99');
    		half_line_item('Chicken', '5.19');
    		half_line_item('Steak', '5.99');
    	?>
    	</div>
    	<h2 style="margin-top:10px;">Burgers</h2>
    	<div style="float:left;">
    	<?php 
    		half_line_item('Hamburger','2.99');
    		half_line_item('Double Burger','3.99');
    		half_line_item('Turkey Burger','3.99');
    		half_line_item('Double Turkey Burger','5.25');
    		half_line_item('Garden Burger','3.99');
    	?>
    	</div>
    </div>
    <div class="right-col" style="margin-top:-40px;">
    	<h2>Chicken</h2>
    	<div style="float:left;">
    	<?php 
    		half_line_item('Chicken Basket','5.29');
    		half_line_item('Grilled Chicken Breast','4.69');
    		half_line_item('(1) Chicken Strip','1.75');
    	?>
    	</div>
    	<h2 style="margin-top:10px;">Fajitas</h2>
    	<div style="float:left;">
      <?php 
        half_line_item('Chicken', '5.39');
        half_line_item('Steak', '5.39');
      ?>
      </div>
    	<h2 style="margin-top:10px;">Sides</h2>
    	<div style="float:left;">
    	<?php 
    		half_line_item('Cheese Slice','.30');
    		half_line_item('Extra Sauce','.75');
    		half_line_item('Small Fries','.99');
    		half_line_item('Large Fries','1.89');
    		half_line_item('Salsa','.75');
    		half_line_item('Bacon','1.39');
    		
    	?>
    	</div>
    </div>
  </div>
  <div id="3" style="display:none;">
    <div class="left-col" style="margin-top:-10px;">
    <h1>Wraps &amp; Sandwiches</h1>
    <h2>Wraps</h2>
	<?php half_line_item('All Wraps', '6.79/lb');?>
    
    <div style="float:left; margin-top:5px;">
    	<h2>Tortillas</h2>
    	<p class="list">
    		<br clear="all">plain, wheat, tomato basil, garlic pesto, spinach herb
    	</p>
    	<h2>Proteins</h2>
    	<p class="list">
    		<br clear="all">steak, crispy chicken, grilled chicken, turkey
    	</p>
    	<h2>Cheeses</h2>
    	<p class="list">
    		<br clear="all">monterey jack, cheddar cheese
    	</p>
    	
    	<h2>Veggies</h2>
    	<p class="list">
    		<br clear="all">tomato, leaf lettuce, shredded lettuce, sliced onion, green bell pepper, sprouts, black olives, shredded carrots, pickles, jalapenos, avocado, cucumbers
    	</p>
    	<h2>Sauces</h2>
    	<p class="list">
    		<br clear="all">ranch, chipotle mayo, salsa, caesar dressing, BBQ
    	</p>    	
    	
    	</div>
    </div>
    <div class="right-col" style="margin-top:54px;">
    
    <div class="right-col">
    	<h2>Sandwiches</h2>
    	<?php 
			half_line_item('Grilled Cheese', '2.09');
			half_line_item('Grilled Ham &amp; Cheese', '2.99');
			half_line_item('French Dip Au Jus', '4.29');
			half_line_item('Reuben', '4.79');
			half_line_item('Philly Cheesesteak', '4.99');
			half_line_item('Tenderloin Steak', '5.49');
			half_line_item('Grill Sandwiches', '7.09/lb');
			half_line_item('Deli Sandwiches', '7.19/lb');
    	?>
    </div>

    </div>
  </div>

  <div id="4" style="display:none;">
    <h1>Late Night</h1>
    <div class="left-col">
    	<h2>Burgers & Sandwiches</h2>
    	<div style="float:left;">
    	<?php 
			half_line_item('Hamburger', '2.99');
			half_line_item('Double Burger', '3.99');
			half_line_item('Garden Burger', '3.99');
			half_line_item('Chicken Sandwich', '3.39');
			half_line_item('Grilled Cheese', '2.09');
			half_line_item('Grilled Ham & Cheese', '2.99');
    	?>
    	</div>
    </div>
    <div class="right-col" style="margin-top:0;">

    	<h2>Quesadillas</h2>
    	<div style="float:left;">
    	<?php 
			half_line_item('Cheese','2.99');
			half_line_item('Chorizo','4.39');
			half_line_item('Veggie','4.49');
			half_line_item('Chicken','5.19');
			half_line_item('Steak','5.99');
    	?>
    	</div>

    	<h2 style="margin-top:10px;">Sides</h2>
    	<div style="float:left;">
    	<?php 
    		half_line_item('Small','.99');
    		half_line_item('Large','1.89');
    	?>
    	</div>
    </div>
  </div>


  <div id="5" style="display:none;">
    <h1>Rotisserie Chicken</h1>
    <?php 
    	full_line_item('Roasted Chicken Plate', 'includes half roast chicken with 2 sides and 2 rolls', '5.59');
    	full_line_item('Roasted Chicken Dinner', 'one whole roast chicken with 4 sides and 4 rolls', '11.29');
    	full_line_item('Whole Roasted Chicken', '', '6.29');
    ?>
    <h2>Sides</h2>
    <div style="clear:both;"></div>
    <?php 
    	full_line_item('Mashed Potatoes with Gravy', '', '.89');
    	full_line_item('Vegetable', '', '.99');
    	full_line_item('Rolls (2)', '', '.75');
    ?>
    
  </div>
  
</div>