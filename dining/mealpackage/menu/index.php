<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] .'/dining/template/dining.inc');	
	$page_options['page'] = 'Meal Package Menu';	
    page_start($page_options);
?>
<link rel="stylesheet" type="text/css" href="/dining/mealpackage/index.css">
<title>Mealpackage Menu</title>
<h2 class="mb-4">Meal Package Menu</h2>
<table id="table" border="0" cellpadding="5">
  <tbody>
	<!--Breakfast-->
	<tr>
      <td valign="top" width="300px">
	  	<div class="menu_title">Breakfast</div><br />
	 </td>
      <td>&nbsp;
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>B1</h3>
		Chicken Chorizo, Poblano, Cheese Egg Bite<br />
		Fruity Greek Yogurt and Crunchy Granola<br />
		Pomegranate Fig Bar<br />
		Whole Fruit<br />
		Minute Maid Juice<br />
		Earl Grey Tea
	 </td>
      <td><img src="images/B1_a.jpg" alt="B1" width="350px">&nbsp;
		  <img src="images/B1_b.jpg" alt="B1" width="350px">
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>B2</h3>
		Egg, Cheese and Meat Breakfast Sandwich<br />
		Breakfast Pastry<br />
		Bowl of Cereal <br />
		Whole Fruit<br />
		Moo Juice (Milk) <br />
		Minute Maid Juice<br />
	 </td>
      <td><img src="images/B2_a.jpg" alt="B2" width="350px">&nbsp;
		  <img src="images/B2_b.jpg" alt="B2" width="350px">
	  </td>
    </tr>
	<tr>
      <td valign="top" width="300px">
	  	<h3>B3</h3>
		Bagel and Cream Cheese<br />
		Hard Boiled Eggs<br />
		Brown Sugar Oatmeal <br />
		Breakfast Pastry<br /> 
		Whole Fruit<br />
		Dunk’in Coffee<br />
		Minute Maid Juice
	 </td>
      <td><img src="images/B3_a.jpg" alt="B3" width="350px">&nbsp;
		  <img src="images/B3_b.jpg" alt="B3" width="350px">
	  </td>
    </tr>
	<!--AM Snack-->
	<tr>
      <td valign="top" width="300px">
	  	<div class="menu_title">Mid-Morning Snacks</div>
	 </td>
      <td>&nbsp;
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>AM Snack 1</h3>
		Hummus Among Us<br />
		Hummus, Celery & Carrot Sticks, Grape Tomatoes
	 </td>
      <td>
		  <img src="images/AM_snack_1.jpg" alt="AM_snack_1" width="350px">
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>AM Snack 2</h3>
		Protein Pack<br />
 		Cheese, Cashews, Crackers and Pepperoni
	 </td>
      <td>
		  <img src="images/AM_snack_2.jpg" alt="AM_snack_2" width="350px">
	  </td>
    </tr>
	<tr>
      <td valign="top" width="300px">
	  	<h3>AM Snack 3</h3>
		Power Pack<br />
		Roasted Almonds, Cheese, Salami, Crackers & Pretzels
	 </td>
      <td>
		  <img src="images/AM_snack_3.jpg" alt="AM_snack_3" width="350px">
	  </td>
    </tr>	
	<!--Lunch-->
	<tr>
      <td valign="top" width="300px">
	  	<div class="menu_title">Lunch</div>
	 </td>
      <td>&nbsp;
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>L1</h3>
		BBQ Brisket Sandwich<br />
		"A" Bun, Pickle Chips, BBQ Sauce<br />
		Pita Chips<br />
		Creamy Coleslaw<br />
		Whole Fruit<br />
		Fruit Leather<br />
		Dasani Water
	 </td>
     <td><img src="images/L1.jpg" alt="L1" width="350px"></td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>L2</h3>
		Mexican Shredded Pork Wrap<br />
		Pork, Pepper Jack Cheese, Cabbage, Bean Salsa<br />
		Pasta Lucy Salad<br />
		Pita Chips<br />
		Fruit Leather<br />
		Whole Fruit<br />
		Gold Peak Tea
	 </td>
     <td><img src="images/L2.jpg" alt="L2" width="350px"></td>
    </tr>
	<tr>
      <td valign="top" width="300px">
	  	<h3>L3</h3>
		Rigatoni Pillows <br />
		Spinach, Ricotta, Basil, Butternut, Broccoli, Asparagus, Mozzarella<br />
		Cranberry, Orange Quinoa Grains<br />
		Pita Chips<br />
		Fruit Leather<br />
		Whole Fruit<br />
		Powerade 
	 </td>
     <td><img src="images/L3.jpg" alt="L3" width="350px"></td>
    </tr>
	<!--Mid-Afternoon Snack-->
	<tr>
      <td valign="top" width="300px">
	  	<div class="menu_title">Mid-Afternoon Snacks</div>
	 </td>
      <td>&nbsp;
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>PM Snack 1</h3>
		Sweet & Salty<br />
		Cheese, Grapes, Crunchy Banana Chips, Carmel Cookie
	 </td>
      <td>
		  <img src="images/PM_snack_1.jpg" alt="PM_snack_1" width="350px">
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>PM Snack 2</h3>
		U-Pop Buttery Popcorn<br />
		Marshmallow Treat
	 </td>
      <td>
		  <img src="images/PM_snack_2.jpg" alt="PM_snack_2" width="350px">
	  </td>
    </tr>
	<tr>
      <td valign="top" width="300px">
	  	<h3>PM Snack 3</h3>
		Nutt’in But Good Stuff<br />
		Fresh Ground Nut Butter, Carrots, Celery, Pretzels
	 </td>
      <td>
		  <img src="images/PM_snack_3.jpg" alt="PM_snack_3" width="350px">
	  </td>
    </tr>
	<tr>
      <td valign="top" width="300px">
	  	<h3>Extra Water</h3>	
	 </td>
      <td>
		  <img src="images/water.jpg" alt="water" width="350px">
	  </td>
    </tr>
	<!--Dinner-->
	<tr>
      <td valign="top" width="300px">
	  	<div class="menu_title">Dinner</div><br />
	 </td>
      <td>&nbsp;
	  </td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>D1</h3>
		Chicken Cordon Bleu<br />
		Chicken, Ham, Swiss Cheese, Roasted Cauliflower, Rice Blend<br />
		Garden Salad<br />
		Tomato, Onion, Cucumber, Dressing<br />
		Seasonal Cut Fruit<br />
		Sweet Treat<br />
		Gold Peak Tea
	 </td>
     <td><img src="images/D1.jpg" alt="D1" width="350px"></td>
    </tr>
    <tr>
      <td valign="top" width="300px">
	  	<h3>D2</h3>
		Chicken and Cheese Enchiladas Pie<br />
		Bean Salsa, Roasted Corn, Pico De Gallo, Red Sauce, Monterey Jack Cheese<br />
		Three Layer Dip<br />
		Seasonal Cut Fruit<br />
		Sweet Treat<br />
		Dasani Water
	 </td>
     <td><img src="images/D2.jpg" alt="D2" width="350px"></td>
    </tr>
	<tr>
      <td valign="top" width="300px">
	  	<h3>D3</h3>
		Meat Loaf<br />
		Mashed Potato, Mushroom, Carrot, Onion Pea, Brown Gravy<br />
		Mixed Greens Salad<br />
		Cucumber, Tomatoes, Red Onion, Dressing<br />
		Seasonal Cut Fruit<br />
		Sweet Treat<br />
		Powerade
	 </td>
     <td><img src="images/D3.jpg" alt="D3" width="350px"></td>
    </tr>	
</tbody>
</table>
</div>




<?php
page_finish();
?>
