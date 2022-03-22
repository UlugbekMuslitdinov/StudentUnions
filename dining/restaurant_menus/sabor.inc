<style>
	.line-item {
		margin-bottom: 8px;
		line-height: 14px;
	}
	.short .line-item div {
		width:450px;
	}
	.line-item div{
		width:520px;
	}
</style>
<div id="nav" >
	<span class="active" onclick="show('entrees')" id="entrees-link" >Combos</span> :
	<span onclick="show('value')" id="value-link" >Value Menu</span>
	<script>var current='entrees';</script>
</div>
<div id="logo">
	<img src="template/images/logos/sabor.jpg" alt="Sabor"/>
</div>
<div id="desc" >
	<p>
		Sabor offers fresh Mexican fare with a fast-casual, modern twist and a focus on quality ingredients and table service. We seek to transform traditional Mexican food and combine it with an engaging experience that fits the current mindset of students. With a menu consisting of tacos, burritos, taco salads and more, the restaurant features a full salsa bar and is located on the east end of the main level of the Student Union Memorial Center.
	</p>
</div>
<style type="text/css">
h4 {
	font-size:12px;
	margin-top:10px;
	margin-bottom:5px;
}
i {
	font-size:10px;
}
.right-col {
	margin-top:0;
}
#specials .line-item {
	margin-bottom:5px;
	}
	ol
	{
		padding-left: 0;
		margin-left: 1em;
	}
</style>
<div id="menu-content" style="clear:both; padding-top:5px;">
	<div id="entrees">
		<h1 style="margin-bottom:.1em;">Combos</h1>
		<ol class="short" style="margin-top:.5em;">
			<li><?php full_line_item('Tacos', 'Baja Chicken OR Fajitas Steak OR Tequila Lime Pork, 2 soft or hard tacos with ancho rice, refried beans and a drink<br>Tacos Only: $5.29', '$6.29'); ?></li>
			<li><?php full_line_item('Burrito', 'Baja Chicken OR Fajitas Steak OR Tequila Lime Pork, Flour Tortilla with pico de gallo, ancho rice, refried beans and a drink<br>Burrito Only: $6.99', '$7.99'); ?></li>
			<li><?php full_line_item('Enchiladas', 'Baja Chicken OR Cheese, 2 corn tortillas with choice of red OR green sauce with ancho rice OR refried beans and a drink<br>Enchiladas Only: $4.99', '5.99'); ?></li>
			<li><?php full_line_item('Quesadilla', 'Baja Chicken OR Cheese, Flour tortilla with pico de gallo, sour cream, ancho rice, refried beans and a drink<br>Quesadilla only: $5.99', '$6.99'); ?></li>
			<li><?php full_line_item('Taco Salad', 'Baja Chicken OR Spicy Beef OR Tequila Lime Pork, Crispy taco bowl with lettuce, cheese, pico de gallo, sour cream,<br>onions, cilantro and a drink<br>Taco Salad Only $6.29', '$6.99'); ?></li>
		</ol>
	</div>

	<div id="value" style="display:none;">
		<h1>Value Menu</h1>
		<div class="short">
		<?php
			full_line_item('Egg & Chorizo Burrito', '', '$5');
			full_line_item('Egg, Cheese & Salsa Burrito', '', '$5');
			full_line_item('½ lb. Bean & Cheese Burrito', '', '$3');
			full_line_item('Spicy Cheese Nachos', '', '$4');
			full_line_item('(2) Taquitos', '', '$3');
			full_line_item('(2) Chicken Tacos', '', '$4');
			full_line_item('(2) Spicy Ground Beef Tacos', '', '$3');
			full_line_item('Ancho Rice and Beans', '', '$3');
			full_line_item('Guacamole Side', '', '$2');
			full_line_item('Chips', '', '$1');
			full_line_item('Any Fountain Drink', '', '$1');
		?>
		</div>
	</div>
</div>
