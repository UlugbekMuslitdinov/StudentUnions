<?php
	require('global.inc');
    require('hours.inc');
	$page_options['title'] = 'feed your IQ!';
	$photo_url = 'IQJuice.jpg';
	page_start($page_options);
	
	$today = getdate();
	$m = $today["mon"];
	$d = $today["mday"];
	$y = $today["year"];
?>
  	<img src="/template/images/banners/iq.png" style="margin-top:6px; margin-bottom:15px;" />
	<link href="/template/iqfresh.css" type="text/css" rel="stylesheet" />
	<h1 style="font-size:18px; color:#424242">feed your IQ</h1>

	<p>You are what you eat. Show your Mensa-level mental capacity by picking up some <a href="#juices">IQ juice</a>, <a href="#smoothies">IQ smoothies</a>, <a href="#tea">		
    IQ-i-tea</a>, IQ java, <a href="#water">IQ water</a>, and <a href="#salads">fresh salads</a> and <a href="#wrap">wraps</a> at <a href="#fresh">IQ fresh</a>. Made fresh at the 	Arizona Student Unions every single day, IQ products are natural, preservative-free, and just plain scrumptious.</p>

	<br />
		<img src="/template/images/foursquares_white.gif">
	<br /><br />

<h1 style="font-size:14px;"><a name="fresh"></a>IQ Fresh, the restaurant</h1>

		<p>Looking for something interesting to perk up those brain cells before the big test? Or just a bright place to wait for that really cute tutor? IQ fresh is your place. Take a peek at the <a href="IQ_Fresh_Slips.pdf">menu</a>, and find out about nutrition information.</p>
        
            <p><a href="IQ_Fresh_Slips.pdf">IQ Fresh Menu</a></p>
            
		<p>From Vivacious Veggie Wraps, Well-Rounded Wraps, Signature Salads and unique sides, to fountain drinks and of course, our famous Smoothies - IQ fresh is the ideal spot to try something delightful.</p>
		<p>And, of course, you can just swipe your CatCard (with the UA Meal Plan) to get this all.</p>
		<p>Do you want to work for this great place? Give us a call at (520) 626-0371.</p>
		<p><p><?php printLocationHours(48) ?></p>
                                                            
                                        
<br>
<h1><a name="breakfast"></a>Now Serving Breakfast every day and all day on weekends.</h1>
	<p>Mon-Fri: 7:30-9:30a &bull; Sat &amp; Sun: 10a-6p</p>
    	<ul>
        	<li>
            	<h2>Breakfast Pita</h2>
                Eggs, low fat cheddar &amp; choice of ham, turkey, sausage or bacon
            </li>
        	<li>
            	<h2>Breakfast Wrap</h2>
				Eggs, potatoes, low fat cheddar &amp; choice of ham, turkey, sausage or bacon
            </li>
        	<li>
            	<h2>Bagel Combo</h2>
				Eggs, low fat cheddar  & choice of ham, turkey, sausage or bacon with tater tots and 10oz juice 
            </li>
        </ul>
<br />                                                                                
<img src="/template/images/foursquares_white.gif">
    <br /><br />

<h1><a name="smoothies"></a>Brilliant Smoothies</h1>
    <p>Get your smoothie the way you like it - made right when you order it! Available at IQ fresh, Cactus Grill, and the Park Student Union food court.</p>
		<ul>
			<li>
				<h2>Pinedexter</h2>
				Pineapple, Peaches, Bananas, Orange Juice, Ice
			</li>
			<li>
				<h2>Synaptic Strawberry</h2>
				Strawberries, Peaches, Bananas, Apple Juice, Ice
			</li>
			<li>
				<h2>Mensa Mango</h2>
				Mango, Strawberries, Peaches, Bananas, Orange Juice, Vanilla Yogurt, Ice
			</li>
			<li>
				<h2>E=mooC<sup>2</sup></h2>
				Chocolate Syrup, Bananas, Chocolate Milk, Ice
			</li>
			<li>
				<h2>Peachy Professor</h2>
				Peaches, Raspberries, Bananas, Vanilla Yogurt, Orange Juice, Ice
			</li>
			<li>
				<h2>Stradiberrious</h2>
				Strawberries, Peaches, Orange Sherbert, Strawberry-Kiwi Juice, Ice
			</li>
			<li>
				<h2>Newton&rsquo;s Nana</h2>
				Bananas, Blueberries, Vanilla Yogurt, Raspberry Sherbert, Strawberry-Kiwi Juice, Ice
			</li>
			<li>
				<h2>Raspberry Fusion</h2>
				Raspberries, Strawberries, Bananas, Raspberry Sherbert, Strawberry-Kiwi Juice, Ice
			</li>
			<li>
				<h2>Orange Chemistry</h2>
				Orange Sherbert, Peaches, Bananas, Vanilla Yogurt, Orange Juice, Ice
			</li>
			<li>
				<h2>Smart Tart</h2>
				peaches, pineapple, raspberries, desert passion juice, ice
			</li>
			<li>
				<h2>Nutty Savant</h2>
				peanut butter, bananas, plain yogurt, chocolate syrup, ice
			</li>
            <li>
				<h2>A&ccedil;ai</h2>
				A&ccedil;ai Berry, Strawberry Banana, Apple Juice, Ice
			</li>
		</ul>
<h1>Create Your Own Smoothie</h1>
		<ul>
			<li>
			<h2>Pick your fruit:</h2>
			Strawberries &laquo; Cranberries &laquo; Blackberries &laquo; Bananas &laquo; Mangos &laquo; Raspberries &laquo; Blueberries &laquo; Cherries &laquo; 	
            Pineapple &laquo; Peaches
		</li>
		<li>
			<h2>Pick Your Mixers:</h2>
			Vanilla Yogurt &laquo; Plain Yogurt<br />
			Cranberry Juice &laquo; Pineapple Juice &laquo; Apple Juice &laquo; Kiwi-Strawberry Juice &laquo; Fresh Squeezed Orange Juice		
            <br />
			2% Milk &laquo; Fat Free Milk &laquo; Chocolate Milk &laquo; Soy Milk
		</li>
		<li>
			<h2>Want Sherbert?</h2>
			Orange Sherbert &laquo; Raspberry Sherbert
		</li>
		<li>
			<h2>Additional Items</h2>
			Vanilla Protein Powder &laquo; Chocolate Protein &laquo; Honey &laquo; Energy Boost &laquo; Fat Burner &laquo; Granola 
		</li>
	</ul>
<br />                                                                                
<img src="/template/images/foursquares_white.gif">
    <br /><br />
    
<h1 style="font-size:14px;"><a name="juices"></a>IQ juice, bottled smoothies</h1>
    
    <p>Quick and clever, you think IQ when you have only a few minutes between classes. Speed by the Cactus Grill,  Highland Market, Park Ave Market, U-Mart, and many other campus locations when you need a healthy IQ pick-me-up.</p>
    
		<p>IQ juice is made only with real fruits and fresh juices. No preservatives, no fillers, no food coloring. We make it and bottle it every day right here at the UA. IQ stays on the shelf for only 24 hours, so you know it&rsquo;s fresh.</p>
		<ul>
			<li>
				<strong>New Flavor!</strong> <span class="date_entry">Peachy Professor</span>
				Peaches, raspberries, bananas, orange juice
			</li>
			<li>
				<h2>Pinedexter (formerly Albert Pinestein)</h2>
				Pineapple, peaches, bananas, orange juice
			</li>
			<li>
				<h2>Synaptic Strawberry</h2>
				Strawberries, bananas, peaches, apple juice
			</li>
			<li>
				<h2>Hyperberry Function</h2>
				Blueberries, raspberries, strawberries, apple juice
			</li>
			<li>
				<h2>Berry Smart</h2>
				Blueberries, strawberries, cranberries, apple juice
			</li>
			<li>
				<h2>Mango cum laude</h2>
				Mango, pineapple, raspberries, orange juice
			</li>
		</ul>
                                        <br />
<img src="/template/images/foursquares_white.gif">
<br /><br />
                                        
<h1 style="font-size:14px;"><a name="tea"></a>IQ-i-tea, bottled green teas</h1>
										<p>Gifted and grounded, you think IQ when looking for an moment of relaxed enlightenment. Research continues to show what has been know in traditional medicine for millennia: green tea is good for the mind! Drink deeply from the well of pure genius.</p>
										<p>Enjoy the healthy, refreshing taste of all-natural green tea as you like it! You can have your tea straight or with your choice of sweetener: honey, Splenda&reg;, or cane sugar.</p>
                                        
<br>
<img src="/template/images/foursquares_white.gif">
<br /><br />
                                       
                                        
		<h1 style="font-size:14px;"><a name="water"></a>IQ water, vitamin-enhanced bottled water</h1>
		<p>Accomplished and ambitious, you think IQ to take your vitamins, stay hydrated, and enjoy the taste all at once. Nine combinations of formulas and flavors keep your 				
        <br />energy level up and your immune system nourished. Available in citrus, kiwi strawberry, or raspberry. 
		</p>
	<ul>
    	<li>
        	<h2>Immuno Logic</h2>
            	<strong>vitamin c + echinacea</strong> Deionized Water, Fructose, Citric Acid, Natural Flavors, Beet Juice (Rasperry IQ Water only), Sucralose, Ascorbic Acid 	
                (Vitamin C), Echinacea Extract, Green Tea Extract, Ginseng Extract, Zinc Chelate
        </li>
        <li>
			<h2>Vitamania</h2>
            <strong>multivitamin</strong> Deionized Water, Fructose, Citric Acid, Natural Flavors, Beet Juice (Raspberry IQ Water only), Sucralose, Vitamin C, Vitamin E, Vitamin 	
            A, Niacinamide (B3), Vitamin B5 (Pantothenic Acid), Vitamin D3, Vitamin B6, Vitamin B2, Vitamin B1, Vitamin B12,  Folic Acid &amp; Biotin
        </li>
        <li>
			<h2>Recovery</h2> 
            <strong>vitamin b complex</strong> Deionized Water, Fructose, Citric Acid, Natural Flavors, Beet Juice (Rasperry IQ Water only), Sucralose, Sodium Chloride, Potassium 			Chloride, Choline Bitartrate, Vitamin B1, Vitamin B2, Vitamin B5 (Pantothenic Acid), Vitamin B6, Inositol, Zinc Chelate, Magnesium Chelate, Vitamin B12, Folic Acid 	
            &amp; Biotin
        </li>
    </ul>
                                        
                                        
                                        

<?php page_finish() ?>