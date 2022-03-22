<?php include("./healthy_options.inc"); ?>
<div id="nav" >
	<span class="active" onclick="show('pastas_entrees')" id="pastas_entrees-link">pastas &amp; entr&eacute;es</span> : 
	<span onclick="show('ciabattas')" id="ciabattas-link">ciabattas</span> : 
	<span onclick="show('grinders')" id="grinders-link">grinders</span> : 
	<span onclick="show('breads_calzones')" id="breads_calzones-link">flat breads &amp; calzones</span> : 
	<span onclick="show('salads_sides_desserts')" id="salads_sides_desserts-link">salads, sides, &amp; desserts</span> : 
	<span onclick="show('healthy')" id="healthy-link">Nutrition Info</span>
	<script>var current='pastas_entrees';</script>
</div>
<div id="logo">
	<img src="template/images/logos/3cheese.gif" alt="3 Cheeses &amp; a Noodle"/>
</div>
<div id="desc" >
		<p>3 Cheeses &amp; a Noodle offers an extensive selection of gourmet Italian entrees ranging from such classics as spaghetti and lasagna to favorites like chicken parmigiana. Pastas come with your choice of sauce. We also offer sandwiches, salads, deserts and more.</p>
</div>
<div id="menu-content" style="clear:both;">
	<div id="pastas_entrees" >
		<h1>Pastas &amp; Entrees</h1>
		<div class="left-col">
			<h2 >Pastas <span style="font-size:12px;">3.99</span></h2>
			<p style="margin-bottom:5px;">Choose your Pasta</p>
			<p class="list" style="float:left; margin-top:0px;">
				Bow Tie<br />
				Spaghetti
			</p>
			<p  class="list" style="float:left; margin-left:20px; margin-top:0px;">
				Penne<br />
				Whole Wheat
			</p>
			<p  class="list" style="float:left; margin-left:20px; margin-top:0px;">
				Ravioli (add .50)<br />
				Pasta of the Day	
			</p>
			
			<p style="margin-bottom:5px;">Choose your Sauace</p>
			<p class="list" style="float:left; margin-top:0px;">
				Mon: Creamy Pesto<br />
				Tues: Sausage & Fennel<br />
				Wed: Creamy Pesto<br />
				Thurs: Sausage & Fennel<br />
				Fri: Pesto
			</p>
			<p  class="list" style="float:left; margin-left:20px; margin-top:0px;">
				Servered daily<br />
				Marinara<br />
				Meat<br />
				Alfredo<br />
				Vegetarian Meat Sauce
			</p>
			
			<?php 
			/*
				half_line_item('Bow Tie', '$3.99'); 
				half_line_item('Spaghetti', '$3.99');
				half_line_item('Penne', '$3.99');
				half_line_item('Whole Wheat', '$3.99');
				half_line_item('Pasta of the Day', '$3.99');
				half_line_item('Ravioli', '$4.49');
				*/ 
			?>
			<div style="clear:both;"></div>
		</div>
		<div class="right-col">
			<h2>Entrees</h2>
			<?php 
				half_line_item('Lasagna', '3.99'); 
        		half_line_item('Vegetarian Lasagna', '3.99');
        		half_line_item('Pasta &amp; Meatballs', '5.79');
        		half_line_item('Chicken Parmesan Sandwich', '5.99'); 
        		half_line_item('Roasted Veggie Sandwich', '4.99'); 
        		half_line_item('Meatball Sandwich', '4.99'); 
        		half_line_item('Italian Sausage Sandwich', '4.99'); 
        		half_line_item('Caesar Salad', '3.99');
        		half_line_item('Chicken Caesar Calzone', '4.59');
			?>			
		</div>
		<div style="clear:both;"></div>
		<p class="list">*Includes garlic bread.</p>
  </div>
  
  <div id="ciabattas" style="display:none; margin-left:155px; margin-right:15px; margin-top:-70px;">
		<h1>Ciabatta Sandwiches</h1>
		<?php
			full_line_item("sicilian", 'capicola, genoa salami, ham, provolone, baby spinach, aged balsamic, <br/>extra virgin olive oil', "5.99");
			full_line_item("grilled chicken", 'grilled chicken breast, roasted garlic aioli, roasted red bell pepper,provolone, <br/>baby spinach', "5.99");
			full_line_item("turkey pesto", 'roasted turkey breast, pesto, oven roasted tomato, mozzarella, baby spinach', "5.99");
			full_line_item("capri", 'fresh mozzarella, oven roasted tomato, pesto', "5.69");
			full_line_item("hummus veggie", 'grilled zucchini, yellow squash, eggplant, red onion, artichoke hearts, <br/>oven roasted tomato, provolone, baby spinach, hummus', "5.69");
		?>
  </div>
  
  <div id="grinders" style="display:none; margin-left:155px; margin-right:15px; margin-top:-70px;">
		<h1>Grinders</h1>
		<?php
			half_line_item("meatball marinara", "6.99");
			half_line_item("sausage & peppers", "6.99");
			half_line_item("italian beef", "6.99");
			half_line_item("chicken parmesan", "6.99");
			half_line_item("tuscan tuna melt", "6.99");
			
			half_line_item("turkey provolone", "6.79");
			half_line_item("muffuletta", "6.99");
			half_line_item("italian classica", "6.79");
			half_line_item("grilled veggie", "6.39");
			half_line_item("tuscan tuna", "6.99");
		?>
  </div>
  
  <div id="breads_calzones" style="display:none;">
  		<div class="left-col">
		<h1>Flat Breads</h1>
		<?php
			half_line_item("Greek Chicken", "5.39");
			half_line_item("Chicken Caesar", "5.39");
			half_line_item("Caprese", "5.39");
			half_line_item("Bushetta Mozzerella", "4.99");
			half_line_item("Pesto Veggie", "4.99");
		?>
		</div>
		<div class="right-col">
		<h1>Calzones</h1>
		<?php
			half_line_item("Pepperoni", "3.79");
			half_line_item("Sausage", "3.79");
			half_line_item("Vegetarian", "3.79");
		?>
		</div>
  </div>
  <div id="salads_sides_desserts" style="display:none;">
    <h1>Salads, Sides, &amp; Desserts</h1>
    <div class="left-col">
      <h2>Salads <span style="font-size:10px; font-weight:normal;">side: .99&nbsp;&nbsp;regular: 1.99&nbsp;&nbsp;entr&eacute;ee: 3.99</span></h2>
      <div style="float:left; width:100px;">
	  <?php
      half_line_item('Caesar', null); 
      // half_line_item('Caprese', null); 
      // half_line_item('Italian Lentil', null); 
      // half_line_item('Greek Rice &amp; Feta', null); 
      half_line_item('White Beans', null); 
      ?>
      </div>
       <div style="float:left; width:100px;">
       <?php 
      // half_line_item('Orzo', null); 
      half_line_item('Vegetable', null); 
      // half_line_item('Tabbouleh', null); 
      // half_line_item('Tortellini', null); 
      half_line_item('Red Potato, Olives, &amp; Tomato ', null);
      /*
        half_line_item('Caesar Salad', '$3.99'); 
        half_line_item('Chicken Caesar Salad', '$5.99');
        half_line_item('Handmade Meatball (one)', '$.89');
        half_line_item('Italian Sausage (one)', '$1.99');
        half_line_item('Garlic Bread', '$.79');
        */ 
      ?>
      </div>
      <div style="clear:both;"></div>
      <?php half_line_item('*Please ask your server which are available today',null);?>
    </div>
    <div class="right-col">
    <h2>Sides</h2>
    <?php 
        half_line_item('Italian Sausage (one)', '1.99');
        half_line_item('Handmade Meatball (one)', '.89');
        half_line_item('Seasoned Chicken Breast (5 oz)', '2.49');
        half_line_item('Side of Sauce (4 oz)', '1.00');
        half_line_item('Garlic Bread', '.79');
		half_line_item('Chicken Ceasar', '3.99');
		half_line_item('Ceasar', '1.99');
      ?><br/>
      <h2>Desserts</h2>
      <?php 
        half_line_item('Tiramisu', '2.99');
      ?>      
    </div>
    <div style="clear:both;"></div>
  </div>
  <div id="healthy" align="center" style="display:none; margin-top:20px;">
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