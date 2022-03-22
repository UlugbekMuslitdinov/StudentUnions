<div id="nav" >
	<span class="active" onclick="show('pastas_entrees')" id="pastas_entrees-link">coffee &amp; espresso</span>  :  <span onclick="show('salads_sides_desserts')" id="salads_sides_desserts-link">tea, blended drinks &amp; italian sodas</span>  :  <span onclick="show('healthy')" id="healthy-link">Nutrition Info</span>
	<script>var current='pastas_entrees';</script>
</div>
<div id="logo">
	<img src="template/images/logos/canyon.gif" alt="Canyon Cafe"/>
</div>
<div id="desc" >
		<p>Located in the canyon of the Student Union Memorial center, next to Pangea Restaurant. Canyon Coffee serves a wide variety of coffee blends and beverages.</p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">
	<div id="pastas_entrees" >
		<h1>Coffee &amp; Espresso</h1>
		<div class="left-col">
			<h2>Coffee <span style="float:right; font-size:9px;">short / tall / grande</span></h2>
			<?php 
				half_line_item('Drip Coffee', '1.55 / 1.85 / 2.15');
				half_line_item('Caf&eacute; Au Lait', '1.75 / 2.35 / 2.55');
				half_line_item('Steamers/Hot Chocolate', '1.90 / 2.35 / 2.75');
				half_line_item('Iced Coffee', '1.55 / 2.15 / 2.95');
				half_line_item('Coffee Refills', ' .95'); 
				half_line_item('Flavored Syrups', 'add .55');
				half_line_item('Soy Milk', 'add .55');
				half_line_item('Single Bull Shot', 'add .94');
				half_line_item('Double Bull Shot', 'add 1.45');
				half_line_item('Breve Style', 'add .75'); 
			?>
			<div style="clear:both;"></div>
		</div>
		<div class="right-col">
			<h2>Hot Espresso <span style="float:right; font-size:9px;">single / double / triple</span></h2>
			<?php 
				half_line_item('Espresso', '1.55 / 1.95'); 
		        half_line_item('Americano', '1.85 / 2.15 / 2.65');
		        half_line_item('Cappuccino', '2.65 / 3.35 / 3.85');
		        half_line_item('Latte', '2.65 / 3.45 / 3.95');
		        half_line_item('Mocha', '3.05 / 3.75 / 4.25');
		        half_line_item('Caramel Macchiato', '3.35 / 4.15 / 4.65');
		        half_line_item('Make it a Tall&nbsp;&nbsp;&nbsp;add .25', null);
		        half_line_item('Make it a Grande&nbsp;&nbsp;&nbsp;add .50', null);
		   ?>
		   <div>&nbsp;</div>
		   <h2>Cold Espresso <span style="float:right; font-size:9px;">single / double / triple</span></h2>
		   <?php
		        half_line_item('Iced Espresso', '1.55 / 1.95'); 
		        half_line_item('Iced Americano', '1.85 / 2.15 / 2.65');
		        print '<span style="float:right; font-size:9px; font-weight:bold;">short / tall / grande</span><div style="clear:right;"></div>'; 
		        half_line_item('Iced Caf&eacute; Latte ', '2.65 / 3.45 / 3.75'); 
		        half_line_item('Iced Caf&eacute; Mocha', '3.05 / 3.75 / 4.05'); 
		        half_line_item('Iced Caramel Macchiato', '3.35 / 4.15 / 4.35'); 
			?>			
		</div>
		<div style="clear:both;"></div>
  </div>
  <div id="salads_sides_desserts" style="display:none;">
    <h1>Tea, Blended Drinks &amp; Italian Sodas</h1>
    <div class="left-col">
      <h2>Tea <span style="float:right; font-size:9px;">short / tall / grande</span></h2>
      <?php 
        half_line_item('Hot Chai Latte', '2.30 / 3.00 / 3.55'); 
        half_line_item('Iced Chai Latte', '2.30 / 3.55 / 3.80');
        half_line_item('Fresh Brewed Ice Tea', ' .94 / 1.50 / 1.90');
        half_line_item('Flavored Ice Tea Coolers', '1.50 / 2.05 / 2.50');
        half_line_item('Iced Tea Lemondae', '1.85 / 2.25 / 2.75');
        half_line_item('Tea Latte (black green earl grey)', '1.85 / 2.25 / 2.50');
        half_line_item('Hot Tazo Tea (assorted flav.)', ' .94 each  .45 add\'l bag');
         
      ?>
      <div style="clear:both;"></div>
    </div>
    <div class="right-col">
    <div>&nbsp;</div>
      <h2>Blended Drinks &amp; Italian Sodas<span style="float:right; font-size:9px;">short / tall / grande</span></h2>
      <?php 
        half_line_item('Blended Mocha', '2.75 / 4.00 / 4.50'); 
        half_line_item('Blended Latte', '3.00 / 4.25 / 4.75'); 
        half_line_item('Sparkling Italian Soda', '2.50');
        half_line_item('Italian Cream Soda', '2.75');
        half_line_item('Sparkling Sluhsies (assorted flav.)', '2.90');
	  ?>
    </div>
    <div style="clear:both;"></div>
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
