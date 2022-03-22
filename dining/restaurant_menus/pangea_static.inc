<style>
	.line-item div
	{
		width: 210px;
	}
</style>
<div id="nav" > 
    	<span class="active" onclick="show('0')" id="0-link">world fare</span>
    :	<span onclick="show('1')" id="1-link">italian fare</span>
    :	<span onclick="show('2')" id="2-link">sushi</span>
	<script>var current='0';</script>
</div>
<div id="logo">
	<img src="template/images/logos/pangea.jpg" alt="Pangea"/>
</div>
<div id="desc" >
	<p>Rotating menu of world cuisine, sushi, and grab-n-go sandwiches, wraps and salads.</p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">

	<div id="0" style="display:block;">
    	<h1>World Fare</h1>
		<p>Menu changes daily. Online menu coming soon.</p>
	</div>
	
	<div id="1" style="display:none;">
    	<h1>Italian Fare</h1>
		<p>Menu changes daily. Online menu coming soon.</p>
	</div>
	
	<div id="2" style="display:none;">
    	<h1>Sushi</h1>
    	<div style="float: left; width: 290px">
			<h2>Rolls</h2>
			<?php
				full_line_item('Spicy Tuna Roll', 'Yellowtail Tuna, Mayo, Sriracha, Chili Oil and Sambal', '6.00 / 5.50');
				full_line_item('Skuna Salmon Roll', 'Skuna Bay Salmon', '6.50 / 5.50');
				full_line_item('Veggie Roll', 'Cucumber, Carrots, Avocado and Takuan', '4.50 / 4.50');
				full_line_item('California Roll', 'Surimi Crab Meat, Avocado and Cucumber', '5.25 / 5.25');
				full_line_item('Wildcat Roll', 'Surimi Crab Meat, Avocado and Cucumber', '5.25 / 5.25');
			?>
		</div>
    	<div style="float: left; width: 250px">
			<h2>Nigiri</h2>
			<?php
				full_line_item('Skuna Bay Salmon', 'Skuna Bay Salmon, Teriyaki Glaze and Furikake', '7.00');
				full_line_item('Unagi Kabayaki', 'Japanese Fresh Water Eel and Teriyaki Sauce', '8.00');
				full_line_item('Ebi', 'Japanese Sweet Water Shrimp and Furikake', '6.50');
				full_line_item('Yellow Tail Tuna', 'Saku', '7.50');
				full_line_item('Hamachi', 'Japanese Amberjack', '7.50');
			?>
		</div>
    </div>
</div>