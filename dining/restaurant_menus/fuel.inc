<div id="nav" >
    <span class="active" onclick="show('0')" id="0-link">salads &amp; wraps</span>  :  <span onclick="show('1')" id="1-link">sandwiches &amp; flatbreads</span>  :  <span onclick="show('2')" id="2-link">cold treats (smoothies &amp; frozen yogurt)</span>  :  <span onclick="show('3')" id="3-link">espresso</span>
  <script>var current='0';</script>
</div>
<div id="logo">
  <img src="template/images/logos/fuel.png" alt="Fuel"/>
</div>
<div id="desc" >
  <p>Fresh salads, sandwiches, wraps, flatbreads, smoothies and frozen yogurt. Fuel up for the gym with our espresso and electrolyte water bar. Located at the Student Rec Center.</p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">
  <div id="0" style="display:block;">
    <h1>Salads &amp; Wraps</h1>
    <div class="left-col">
    <h2>Fresh Salads</h2>
        <?php
          half_line_item('Mediterranean', '-');
          half_line_item('520 Chicken', '-');
          half_line_item('Seared Tofu', '-');
          half_line_item('Grilled Angus', '-');
          half_line_item('Brianna’s Organic Dressings', '-');


        ?>
   </div>
   <div class="right-col">
    <p>&nbsp;</p><h2>Wraps</h2>
        <?php
          half_line_item('Roast Angus', '-');
          half_line_item('Greek Chicken', '-');
          half_line_item('Chicken Caesar', '-');
          half_line_item('Wildcat Veggie', '-');

        ?>
       <h2>Sides</h2>
        <?php
          half_line_item('Extra Virgin Potato Salad', '-');
          half_line_item('Organic Frozen Yogurt', '-');
          half_line_item('Seasonal Fruit Salad', '-');
        ?>
   </div>
  </div>
  <div id="1" style="display:none;">
    <h1>Sandwiches &amp; Flatbreads</h1>
   <div class="left-col">
    <h2>Breakfast Flatbreads</h2>
        <?php
          half_line_item('Turkey & Egg', '-');
          half_line_item('Bacon & Egg', '-');
          half_line_item('Veggie & Egg', '-');

        ?>
    <h2>Sandwiches</h2>
        <?php
          half_line_item('Turkey al Fresco', '-');
          half_line_item('Gigande Veggie', '-');
          half_line_item('Shaved Angus', '-');
          half_line_item('Chicken Cali', '-');

        ?>
     <h2>Sides</h2>
        <?php
          half_line_item('Extra Virgin Potato Salad', '-');
          half_line_item('Organic Frozen Yogurt', '-');
          half_line_item('Seasonal Fruit Salad', '-');
        ?>
   </div>
   <div class="right-col">
    <p>&nbsp;</p><h2>Flatbreads</h2>
        <?php
          half_line_item('Veggie al Fresco', '-');
          half_line_item('New World', '-');
          half_line_item('Gusto', '-');
          half_line_item('Chicken Caesar', '-');
          half_line_item('Buffalo Chicken', '-');

        ?>
       <h2>Sides</h2>
        <?php
          half_line_item('Extra Virgin Potato Salad', '-');
          half_line_item('Organic Frozen Yogurt', '-');
          half_line_item('Seasonal Fruit Salad', '-');
        ?>
   </div>
  </div>
  <div id="2" style="display:none;">
  <style>
    .line-item{
      margin-bottom:5px;
    }
    p{
      margin-top:0px;
    }
  </style>
  <div class="left-col" style="clear:both;">
    <h1 style="margin-bottom:0px;">FROZEN YOGURT</h1>
    <p >Includes 2 toppings. Made with 100% organic frozen yogurt from Potter Family Organics.</p>
    <?php
      half_line_item('Regular', '-');
      half_line_item('Large', '-');
    ?>
    <h2 style="margin-bottom:0px;">Flavors</h2>
    <p class="list">Chocolate, Vanilla, Sugar Free</p>
    <h2  style="margin-bottom:0px;">Toppings</h2>

    <p class="list" style="float:left;">

     Bananas<br />
     Peanuts<br />
     Caramel Syrup<br />
     Peaches<br />
     Strawberries<br />
     Butterfinger<br />
     Yogurt Pretzels<br />
     Heath Bar
    </p>

    <p class="list" style="float:left; margin-left:15px;">
     Rainbow Sprinkles<br />
     Pineapple<br />
     Blueberries<br />
     M&Ms<br />
     Walnuts<br />
     Chocolate Chips<br />
     Raspberries<br />
     Mango
    </p>
    </div>
    <div class="right-col">
    <h1 style="clear:both; margin-bottom:0px;">SMOOTHIES</h1>
    <p>Pick your favorite fruits and juices at the smoothie bar and we’ll blend them on the spot.</p>
    <?php
      half_line_item('Regular', '-');
      half_line_item('Large', '-');
    ?>
    <h2 style="margin-bottom:0px;">Fruits</h2>
    <p class="list">Bananas, Blueberries, Mango, Peaches, Pineapple, Raspberries, Strawberries</p>

    <h2 style="margin-bottom:0px;">Mixers</h2>
    <p class="list">Apple Juice, Kiwi-Strawberry Juice, Orange Juice, 2% Milk, Chocolate Milk, Fat Free Milk, Soy Milk, Vanilla Yogurt</p>

    <h2 style="margin-bottom:0px;">Extras</h2>
    <p class="list">Energy Boost, Fat Burner, Peanut Butter</p>

    <h2 style="margin-bottom:0px;">Premium Extras</h2>
    <p class="list">Chocolate Protein, Vanilla Protein</p>
    </div>
  </div>
  <div id="3" style="display:none;">
    <div style="float:left;clear:both;margin-bottom:15px;">
    <h1>Espresso</h1>
    <div style="padding-left:340px; margin-top:-40px;">Hot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iced</div>
    <div style="padding-left:340px;"><p class="list">sm/lrg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sm/lrg</p></div>
    <?php

      full_line_item('Coffee', '', '-');
      full_line_item('Espresso', '', '-');
      full_line_item('Americano', '', '-');
      full_line_item('Hot Chocolate', '', '-');
      full_line_item('Latte', '', '-');
      full_line_item('Cappuccino', '', '-');
      full_line_item('Mocha', '', '-');
      full_line_item('White Mocha', '', '-');
      full_line_item('Caramel Macchiato', '', '-');
      full_line_item('Black Tea', '', '-');
    ?>
    </div>
    <div class="left-col" style="clear:both;">
    <h2>Extras</h2>
    <?php

      half_line_item('Coffee Refills', '-');
      half_line_item('Flavored Syrups', '-');
      half_line_item('Soy Milk', '-');

    ?>
    </div>
    <div class="right-col" style="margin-top:0px;">
    <h2>Syrups</h2>
    <p class="list">Caramel, Hazelnut, Vanilla, Sugar Free Vanilla</p>
    <h2>By the glass</h2>
    <?php half_line_item('Milk (20 oz glass)', '-'); ?>
    <?php half_line_item('Soy Milk (20 oz glass)', '-'); ?>
    </div>
  </div>
</div>
