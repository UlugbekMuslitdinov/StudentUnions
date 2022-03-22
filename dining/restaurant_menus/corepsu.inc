<div id="nav" >
  <span class="active" onclick="show('1')" id="1-link">Step 1</span>  :  <span onclick="show('2')" id="2-link">Step 2</span>  :  <span onclick="show('3')" id="3-link">Step 3</span>  :  <span onclick="show('4')" id="4-link">Step 4</span>  :  <span onclick="show('5')" id="5-link">Step 5</span>  :  <span onclick="show('6')" id="6-link">Other or Extras</span>  
  <!-- Remove this - It opens a blank page. -->
  <!--:  <span onclick="show('healthy')" id="healthy-link">Nutrition Info</span>-->
  <script>var current='1';</script>
</div>
<div id="logo">
  <img src="template/images/logos/core.gif" alt="Core"/>
</div>
<div id="desc" >
  <p>Core is designed to offer healthy, tasty and unique food options that meet your needs.</p>
</div>
<div id="menu-content" style="clear:both; padding-top:5px;">
  <div id="1" style="display:block;">
    <h1>Step 1</h1>
    <p style="font-weight:normal;">FILL YOUR BOWL TO THE RIM WITH CORE ITEMS<br /><br />
        
        <strong>Core Items</strong><br />
        almonds | apples | avocado (add $0.60) | baby corn | bacon bits (soy) |
        bean sprouts | green bell peppers | yellow bell peppers | black beans |
        blue cheese | broccoli | red cabbage | shredded carrots | cashews | corn |
        celery | cheddar cheese | dried cranberries | cucumbers | edamame |
        hard-boiled eggs | feta cheese | fire-roasted red peppers | flax seed |
        garbanzo beans | grapes | jalape&ntilde;os | j&iacute;cama | kidney beans |
        fresh mushrooms | marinated mushrooms | black olives | kalamata olives |
        manzanilla olives | green onions | red onions | parmesan cheese | peanuts | peas |
        pepperjack cheese | pepperoncini | pineapples | pumpkin seeds | bean salsa |
        strawberries | sunflower seeds | monterey jack cheese | grape tomatoes |
        sun-dried tomatoes | tomato wedges | tortilla strips | walnuts | water chestnuts |
        zucchini ...

		</br></br>
		toppings vary according to availability</p>        
  </div>
  
  <div id="2" style="display:none;">
    <h1>Step 2</h1>
    <p style="font-weight:normal;">     
      <strong>Extras</strong><br />
      	POWER UP [EXTRA] - add protein to your salad or your hot veggies for an
      	additional $1.25 or $1.75 <br/>
      	<br/>
		
		<strong>Add $1.25</strong><br/>
		Mesquite Smoked Turkey<br/>
		Virginia Honey Ham<br/>
		Marinated Tofu<br/>
		
		<strong>Add $1.75</strong><br/>
		Mesquite Roasted Chicken<br/>
		Saut&eacute;ed Shrimp<br/>
		Grilled Sirloin
    </p>        
  </div>
  
  <div id="3" style="display:none;">
    <h1>Step 3</h1>
    <p style="font-weight:normal;">   
      
      <strong>Choose how you want your veggies:</strong><br /><br />
      
      <strong>Cold</strong><br />
		with Salad Greens $6.75 <br /><br /> 
		
		<strong>Hot</strong><br /> 
		Corn Tortilla Quesadilla $6.75  <br />
		Stir Fry $3.95  <br />
		Fajitas or $4.25  <br />
		Omelet $3.95  <br />
    </p>        
  </div>
  
  <div id="4" style="display:none;">
    <h1>Step 4</h1>
    <p style="font-weight:normal;">     
      <strong>GO GREEN</strong><br />
		select your greens:<br /><br />
		Crisp Romaine<br />
		Fresh Baby Spinach<br />
		Spring Mix<br />
    </p>        
  </div>
  
  <div id="5" style="display:none;">
    <h1>Step 5</h1>
    <p style="font-weight:normal;">     
      <strong>FINISH IT UP</strong><br />
      choose a dressing<br /><br />
		Balsamic Vinaigrette | Blue Cheese | Caesar | Creamy Pepper &amp; Parmesan |
		Italian | Italian (low cal) | Lime Cilantro Vinaigrette |
		Oil & Vinegar with extra virgin olive oil and red wine or balsamic vinegar |
		Poppy Seed | Ranch | Ranch (fat free) | Strawberry Vinaigrette |
		Spicy Honey Mustard
    </p>        
  </div>
  
  <div id="6" style="display:none;">
    <h1>Extras</h1>
    <div style="float:left;">
    <p style="font-weight:normal;">     
      <strong>SOUP</strong><br />
      <br />
    	Gluten Free Soup of the Day -<br/>Seasonal throughout the winter months
    </p>   
    </div>
    <div style="float:left; margin-left: 20px">
    <p style="font-weight:normal;">
      <strong>DRINKS</strong><br />
      <br />
		V8 Splash and Fusion<br />
		Vitamin Water<br />
		Minute Maid Juice
    </p>  
    </div>       
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