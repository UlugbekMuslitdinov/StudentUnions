<div id="nav" >
  <span class="active" onclick="show('bagels')" id="bagels-link">bagels and sandwiches</span> :
	<span id="delivery-link"><a href="/dining/template/resources/OnDeckCatering.pdf" target="_blank">delivery</a></span>
  <!--<span onclick="show('delivery')" id="delivery-link">delivery</span>-->
  <script>var current='bagels';</script>
</div>
<div id="logo">
  <img src="template/images/logos/ondeck.png" alt="On Deck Deli" style="width:100px;"/>
</div>
<div id="desc" >
  <p>
  	Located in the Student Union food court. On Deck Deli offers custom sandwiches and gourmet bagels with a wide variety of cream cheeses and spreads.
  </p>
</div>
<div id="menu-content" style="clear:both; margin-top:-5px;">
  <style>
  	.line-item{
  		margin-bottom:5px;
  	}
  	p{
  		margin-top:0px;
  	}
  </style>
  <div id="bagels" style="display:block;">
    <br />
    <h2>Bagel w/ Cream Cheese or Spreads:  $2.99</h2>
    <h2>Build your own Sandwich:  $0.67 per ounce</h2>
    <br />
    <div class="left-col" style="position: relative;">
      <h2>Bagels:</h2>
      <p class="list">Plain, Asiago, Everything, Blueberry, Cinnamon Raisin, Jalapeño and Multigrain-Energy</p>

      <h2>Cream Cheeses:</h2>
      <p class="list">Plain, Strawberry, Honey Almond, Jalapeño, Veggie, Onion & Chive, Salmon</p>

      <h2>Spreads:</h2>
      <p class="list">Nutella®, Peanut Butter, Strawberry Jelly, Butter</p>

      <h2>Meats:</h2>
      <p class="list">Turkey Pastrami, Roasted Turkey, Baked Chicken, Smoked Ham, Roast Beef, Pastrami, Salami, Pepperoni, Bacon</p>

      <h2>Cheeses:</h2>
      <p class="list">Provolone, Swiss, Cheddar, Havarti, Pepper Jack and American</p>

      <h2>Salads:</h2>
      <p class="list">Chunky Chicken, Tuna and Egg</p>
    </div>
    <div class="right-col" style="position: relative; margin-top: 0;">
      <h2>Greens and Things:</h2>
      <p class="list">Lettuce (leaf or shredded), Tomatoes, Red Onions, Alfalfa Sprouts, Spinach, Cucumbers, Green Bell Peppers, Pickles, Avocado, Jalapeños, Black Olives, Pepperoncini, Shredded Carrots, Hard Boil Eggs, Salt, Black Pepper, Oregano</p>

      <h2>Condiments:</h2>
      <p class="list">Mayo, Chipotle Mayo, Avocado Mayo, Yellow Mustard, Honey Mustard, Deli Mustard, Pesto, Hummus, Olive Oil, Red Vinegar</p>

      <h2>Breads:</h2>
      <p class="list">Sourdough, White, Whole Wheat, Multigrain, Marble Rye, Sub Rolls, Spinach Wraps, Croissants, Ciabatta, Focaccia Buns, Pretzel Rolls</p>

      <h2>Gluten-Free Breads:</h2>
      <p class="list">White, Wholegrain and Bagels</p>

      <h2>Organic Breads:</h2>
      <p class="list">Whole Wheat with Honey and Multigrain</p>
    </div>
  </div>

  <div id="delivery" style="display:none;">
    <?php
    	include_once('ondeck_delivery.inc');
    ?>
  </div>
</div>
