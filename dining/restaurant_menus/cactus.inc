<?php
	date_default_timezone_set('America/Phoenix');
	// connect to database
	require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

	// default text to appear when no price has been entered
	$priceText = 'TBD';

	// Initialize
	$_GET['addDays'] = ( isset($_GET['addDays']) ? $_GET['addDays'] : 0 );
	$menuNameRow = null;
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<link rel="stylesheet" type="text/css" href="/dining/restaurant_menus/online_css/cactus.css">
<script type="text/javascript" src="online_menu.js"></script>



<div class="background">

<!-- <img src="images/cactusgrill.jpg" alt=""> -->

<div id="menu-content" style="clear:both; padding-top:5px; position: relative;">

	<?php // sticky menus and navigation to handle Hotline system

	if (!isset($_GET['menuType'])){
		$_GET['menuType'] = 'hotline-lunch';
	}

	if ($_GET['menuType'] == 'hotline-lunch' || $_GET['menuType'] == 'hotline-dinner') { // if this is a link from w/in Hotline, apply appropriate div IDs and display styles

		if ($_GET['menuType'] == 'hotline-lunch') { // looking at lunch

			$hotlineL = 'block';
			$hotlineD = 'none';
			$lunch = 'buffet';
			$dinner = 'buffet-off';

		} else { // looking at dinner

			$hotlineD = 'block';
			$hotlineL = 'none';
			$dinner = 'buffet';
			$lunch = 'buffet-off';

		}

		// set a flag to show we're inside Hotline
		$inHotline = true;

		// turn off breakfast
		$breakfast = 'none';

		echo '<a id="btn-back" href="/dining/sumc/cactus" style="">RETURN TO RESTAURANT PAGE</a>';

		// show the navigation w/Hotline turned on
		echo '<div id="nav" align="center">
				<span name="nav breakfast" onclick="show(\'breakfast\')" id="breakfast-link">BREAKFAST</span>
				<span name="nav omelet" onclick="show(\'omelet\')" id="omelet-link">OMELET BAR</span>
				<span name="nav wraps" onclick="show(\'wraps\')" id="wraps-link">WRAPS</span>
				<span name="nav grill" onclick="show(\'grill\')" id="grill-link">THE GRILL</span>
				<span name="nav hotline" class="active" onclick="show(\'buffet\')" id="buffet-link">HOT LINE</span>
				<span name="nav noodle" onclick="show(\'wox\')" id="wox-link">NOODLE BOWL</span>
				<span name="nav bbq" onclick="show(\'bbq\')" id="bbq-link">BBQ</span>
			<script>var current=\'buffet\';</script>
		</div>';

	} else { // we're landing on the menu for the first time and don't have any Hotline params set

		// not in Hotline
		$inHotline = false;

		// turn off display values for all Hotline divs
		$hotlineL = 'none';
		$hotlineD = 'none';

		// turn on breakfast
		$breakfast = 'block';
	}

	// calculate which Hotline menu to display (lunch or dinner) depending on time of day
	// only do this if we are not coming from a date- or menu-specific link from within Hotline system already
	if (!$inHotline) {
		if ((date("Hi", time()) >= 0 && date("Hi", time()) <= 1400)) { // lunch settings: for initial load, display lunch from midnight - 2:00:59pm and dinner from 2:01:00pm - 11:59:59pm
			$lunch = 'buffet';
			$dinner = 'buffet-off';
		} else { // dinner settings
			$dinner = 'buffet';
			$lunch = 'buffet-off';
		}
	}

	?>

	<div id="breakfast" style="display:<?php echo $breakfast; ?>;">

		<?php 
		$title = array(
			'title'		=> "breakfast",
			'desc' 		=> "Breakfast is available from 8 a.m. to 10:30 a.m. Monday through Friday. We offer several breakfast specials as well as made-to-order omelets, breakfast burros, and bagel sandwiches.",
			'available'	=> "8:00 AM to 10:30 AM",
		);

		cactus_menu_title($title);

		/******		Start of Breakfast Burritos 	******/		
		cactus_title("Breakfast Burritos", "Available 8-10:30AM", '');
		$item = array(
			'title'		=>	'#1: Two Eggs, Potatoes, Salsa, Mixed Cheese Blend',
			'desc'		=>	'',
			'price'		=>	'6.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'#2: Chorizo, Potatoes, Salsa, and Mixed Cheese Blend',
			'desc'		=>	'',
			'price'		=>	'6.99');
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'#3: Two Eggs, Chorizo, Potatoes, Salsa, Mixed Cheese Blend',
			'desc'		=>	'', 
			'price'		=>	'7.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		/******		Start of Customize Your Burrito	******/

		$data = array(
			'title'	=> 'Customize Your Burrito',
			'price'	=> '79¢ per item',
			'desc'	=> '',
			'options' => array(
				'mixed cheese', 			'ham', 
				'bacon', 			'mushrooms', 
				'green peppers', 	'onions', 
				'green chiles', 	'salsa',
			),
		);
		list_item_options($data);


/******		Start of Customize Your Breakfast Sandwiches	******/

			cactus_title("Breakfast Sandwiches", "Available 8-10:30AM", "Served on a bagel, biscuit, or English muffin"); 
			
			$item = array(
				'title'		=>	'Eggs and Cheese',
				'desc'		=>	'',
				'price'		=>	'2.09',
				);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);


			$item = array(
				'title'		=>	'Eggs, Cheese and Ham',
				'desc'		=>	'',
				'price'		=>	'3.09',
				);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		?>

	</div>

	<div id="omelet" style="display:none;">

<?php
		
		$title = array(
			'title'		=> "Omelet",
			'desc' 		=> "",
			'available'	=> "8:00 AM to 8:00 PM",
		);
		cactus_menu_title($title);
		cactus_title("Omelet Bar", "Available 8 AM to 8 PM", '');
		
		$item = array(
			'title'		=>	'Wildcat Omelet',
			'desc'		=>	'diced ham, green peppers and mixed cheese blend',
			'price'		=>	'6.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'Tucson Omelet',
			'desc'		=>	'green peppers, onions, and diced chicken',
			'price'		=>	'6.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'Western Omelet',
			'desc'		=>	'green chilies, diced ham, diced tomato, and mixed cheese blend',
			'price'		=>	'6.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'Chorizo Omelet',
			'desc'		=>	'chorizo and mixed cheese blend',
			'price'		=>	'6.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'Garden Omelet',
			'desc'		=>	'spinach, mushrooms, onion, and Swiss cheese',
			'price'		=>	'6.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'Tofu Scramble',
			'desc'		=>	'spinach, onions, tomato',
			'price'		=>	'5.59'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$item = array(
			'title'		=>	'Three Egg Omelet and one topping',
			'desc'		=>	'egg white substitution available',
			'price'		=>	'5.59'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$data = array(
			'title'	=> 'Customize Your Omelet',
			'price'	=> '79¢ per topping',
			'desc'	=> '',
			'options' => array(
				'ham',			'green chilis',	'bacon',
				'mushrooms',	'chicken',		'mixed peppers',
				'spinach',		'tomatoes',		'salsa',
				'green onions',	'chorizo',		'sour cream',
				'Swiss',		'Montery jack',	'mixed cheese',
			),
		);
		list_item_options($data);		
?>

	</div>

	<div id="wraps" style="display:none;">
<?php
		
		$title = array(
			'title'		=> "Wrap Station",
			'desc' 		=> "",
			'available'	=> "After 10:30AM",
		);
		cactus_menu_title($title);
		cactus_title("Wraps $7.89", "Available After 10:30AM", '');

		?>

		<?php
		$wrap_list = array(
			[	'name'	=> 'Adobo Chicken',
				'desc'	=> 'plain wrap, brown rice, black beans, mixed cheese blend, sour cream, salsa, romaine lettuce, adobo chicken',
				'price'	=> ''],
			[	'name'	=> 'Buffalo Chicken',
				'desc'	=> 'spinach wrap, chicken tender, buffalo sauce, mixed cheese blend, ranch dressing, romaine lettuce, diced tomatoes',
				'price'	=> ''],
			[	'name'	=> 'Chicken BLT',
				'desc'	=> 'spinach wrap, mixed cheese blend, bacon, diced chicken, diced tomatoes, creamy, sriracha, ranch dressing, romaine Lettuce',
				'price'	=> ''],
			[	'name'	=> 'Chicken Caesar',
				'desc'	=> 'spinach wrap, diced chicken, caesar dressing, shredded parmesan cheese, romaine lettuce',
				'price'	=> ''],
			[	'name'	=> 'Falafel Hummus',
				'desc'	=> 'spinach wrap, falafel (4), red pepper hummus, romaine lettuce, fattoush, garbanzo beans',
				'price'	=> ''],
			[	'name'	=> 'Italian Garden',
				'desc'	=> 'spinach wrap, fattoush mix, garbanzo beans, romaine lettuce, red pepper hummus',
				'price'	=> ''],
			[	'name'	=> 'Teriyaki Chicken',
				'desc'	=> 'plain wrap, teriyaki sauce, diced chicken, Asian blend, brown rice',
				'price'	=> ''],
			);
			print_cactus_wrap_list($wrap_list);
		?>
	</div>

	<div id="grill" style="display:none;">
	<?php
		$title = array(
			'title'		=> "THE GRILL",
			'desc' 		=> "",
			'available'	=> "",
		);
		cactus_menu_title($title);
	?>
		<div class="arrows" onload="save_states();">
			<button class=" arrow previous" onclick="showPreviousFlex()">&laquo;</button>
			<button class=" arrow next" onclick="showNextFlex()">&raquo;</button>
		</div>
		<div class="flex_two_cols" id="first">
			<div class="flex-col burgers"><?php
				cactus_title("Burgers", two_prices('single', 'double'), "");
				
				$item = array(
					'title'		=>	'Hamburger',
					'desc'		=>	'',
					'price'		=>	two_prices('5.49', '6.99'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
				
				$item = array(
					'title'		=>	'Cheeseburger',
					'desc'		=>	'your choice: American, Swiss, provolone, pepper jack, or cheddar',
					'price'		=>	two_prices('6.99','7.99'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
				
				$item = array(
					'title'		=>	'Bacon Burger',
					'desc'		=>	'burger patty with two slices of bacon',
					'price'		=>	two_prices('6.49','7.99'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
						
				$item = array(
					'title'		=>	'Bacon Cheeseburger',
					'desc'		=>	'burger patty with two slices of bacon and your choice of cheese',
					'price'		=>	two_prices('7.49', '8.99'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
				
				$item = array(
					'title'		=>	'Patty Melt',
					'desc'		=>	'burger patty with grilled onions and Swiss cheese on grilled rye bread',
					'price'		=>	two_prices('5.99',''),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
	
				$item = array(
					'title'		=>	'Black Bean Burger',
					'desc'		=>	'includes grilled onions, mushrooms, green peppers, and provolone cheese',
					'price'		=>	two_prices('6.59',''),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
				
			
			?></div>
			<div class="flex-col">
			<?php
				cactus_title("Grilled Sandwiches", '', "");
				
				$item = array(
					'title'		=>	'Cactus Giant Philly',
					'desc'		=>	'loaded with lean grilled steak, onions, peppers, cheese sauce, on a 12 inch hoagie roll',
					'price'		=>	'9.99',
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$item = array(
					'title'		=>	'Steak Provolone Philly',
					'desc'		=>	'lean grilled steak, onions, peppers, provolone cheese, and sauce, served on a steak roll',
					'price'		=>	'7.99',
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$item = array(
					'title'		=>	'Chicken Provolone Philly',
					'desc'		=>	'grilled chicken breasts, onions, peppers, provolone cheese, and sauce, served on a steak roll',
					'price'		=>	'7.99',
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$item = array(
					'title'		=>	'Ruben Sandwich',
					'desc'		=>	'lean grilled corn beef, sauerkraut, Swiss cheese, and thousand island dressing on grilled rye bread',
					'price'		=>	'6.99',
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$item = array(
					'title'		=>	'Hot Pastrami',
					'desc'		=>	'lean pastrami and Swiss cheese on grilled rye bread',
					'price'		=>	'6.99',
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
				
			?></div>
		</div>
		<div class="flex_two_cols" id="second" style="display:none;">
			<div class="flex-col"><?php
			cactus_title("Chicken", '', "Served with Ranch Dressing and Self-serve BBQ sauces located at condiment station");
			
			$item = array(
				'title'		=>	'Chicken Strip Sandwich',
				'desc'		=>	'',
				'price'		=>	'6.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			$item = array(
				'title'		=>	'Chicken Strip (3) Basket',
				'desc'		=>	'',
				'price'		=>	'7.59',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			cactus_title("Quesadillas", '', "Served with salsa or sour cream");
			
			$item = array(
				'title'		=>	'Cheese',
				'desc'		=>	'flour tortilla and cheese',
				'price'		=>	'4.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			$item = array(
				'title'		=>	'Chicken',
				'desc'		=>	'flour tortilla, cheese, and chicken',
				'price'		=>	'6.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			$item = array(
				'title'		=>	'Steak',
				'desc'		=>	'flour tortilla, cheese, and steak',
				'price'		=>	'6.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			$item = array(
				'title'		=>	'Green Chile',
				'desc'		=>	'flour tortilla, cheese, and green chiles',
				'price'		=>	'5.59',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			
			
			?></div>
			<div class="flex-col"><?php
			$desc = "<b>Your Choice of:</b>";
			$desc .= "Sourdough or Multigrain Wheat&nbsp;<b>and</b>";
			$desc .= "American, Swiss, Pepper Jack, Provolone, or Cheddar Cheese.";
			cactus_title("Grilled Cheese", '', $desc);
			
			$item = array(
				'title'		=>	'Grilled Cheese',
				'desc'		=>	'',
				'price'		=>	'3.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			
			$item = array(
				'title'		=>	'Grilled Cheese and Bacon',
				'desc'		=>	'',
				'price'		=>	'4.59',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			
			$item = array(
				'title'		=>	'Grilled Cheese and Ham',
				'desc'		=>	'',
				'price'		=>	'4.59',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			
			$item = array(
				'title'		=>	'Grilled Cheese and Tomato',
				'desc'		=>	'',
				'price'		=>	'3.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			cactus_title("Sides", '', '');
			
			$item = array(
				'title'		=>	'French Fries',
				'desc'		=>	'',
				'price'		=>	'2.09',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			$item = array(
				'title'		=>	'Additional Sauce',
				'desc'		=>	'salsa, ranch, or sour cream',
				'price'		=>	'79¢',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
			
			
			?></div>
		</div>
	</div>
	<div id="wox" style="display:none;">	<?php		
		$title = array(
			'title'		=> "Noodle Bowls",
			'desc' 		=> "",
			'available'	=> "After 11 AM",
		);
		cactus_menu_title($title);

		cactus_title("Noodle Bowls", "Available After 11 AM", '');
		$item = array(
			'title'		=>	'Choose your toppings and sauce',
			'desc'		=>	'udon noodles or brown rice',
			'price'		=>	'5.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);
	
		$item = array(
			'title'		=>	'Choose your toppings, sauce, and protein',
			'desc'		=>	'udon noodles or brown rice',
			'price'		=>	'6.99'
			);
		flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		$data = array(
			'title'	=> 'Choose 4 toppings',
			'price'	=> '',
			'desc'	=> 'Additional Toppings Are Extra .79',
			'options' => array(
				'bell pepper mix',	'bean sprouts',	'celery',
				'broccoli',			'tomatoes',		'green onions',
				'baby corn',		'Asian mix',	'edamame',
				'shredded carrots',		
				),
		);
		list_item_options($data);

		$data = array(
			'title'	=> 'Choose 1 Sauce',
			'price'	=> '',
			'desc'	=> '',
			'options' => array(
				'Mongolian',	'soy garlic',	'sweet & sour',
			),
		);
		list_item_options($data);
		
		$data = array(
			'title'	=> 'Choose 1 Protein',
			'price'	=> '',
			'desc'	=> 'Depending on original choice above',
			'options' => array(
				'beef',		'chicken',	
				'shrimp',	'tofu',
			),
		);
		list_item_options($data);

	?>
	</div>

	<div id="bbq" style="display:none;">
	<?php
		$title = array(
			'title'		=> "BBQ",
			'desc' 		=> "",
			'available'	=> "",
		);
		cactus_menu_title($title);
	?>
	
	<div class="flex_two_cols">
		<div class="flex-col"><?php
				cactus_title("BBQ", two_prices('Plate', 'A La Carte'), "");
				
				$item = array(
					'title'		=>	'Pulled Pork',
					'desc'		=>	'Hand-pulled pork piled high with a pickle, a corn bread muffin and two super sidekicks',
					'price'		=>	two_prices('9.99', '7.99'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$item = array(
					'title'		=>	'Beef Brisket',
					'desc'		=>	'Tender, melt in your mouth brisket with a pickle, a corn bread muffin, and two super sidekicks',
					'price'		=>	two_prices('9.99', '7.99'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$item = array(
					'title'		=>	'Half Chicken',
					'desc'		=>	'Tender, juicy rotisserie half chicken with a corn bread muffin and two super sidekicks',
					'price'		=>	two_prices('9.99', '8.29'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$item = array(
					'title'		=>	'Baby Back Style Ribs',
					'desc'		=>	'Bone-in pork ribs glazed with BBQ sauce with a corn bread muffin and two super sidekicks',
					'price'		=>	two_prices('9.99', '7.99'),
				);
				flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				// $item = array(
				// 	'title'		=>	'Chicken Wings',
				// 	'desc'		=>	'6 wings with your choice of sauce: BBQ, Smoke, Buffalo, or Sweet Mustard, and two super sidekicks',
				// 	'price'		=>	two_prices('8.59', '7.29'),
				// );
				// flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				// $item = array(
				// 	'title'		=>	'Whole Chicken',
				// 	'desc'		=>	'Tender, juicy, whole rotisserie chicken',
				// 	'price'		=>	two_prices('9.59', ''),
				// );
				// flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

				$data = array(
					'title'	=> 'Toppings Bar',
					'price'	=> '',
					'desc'	=> '',
					'options' => array(
						'Green Onions',	'Cheddar Cheese',	'Bacon Bits',
						'Sour Cream',	'Broccoli',			'Whipped Butter',
						'Quinoa Chili',
						),
				);
				list_item_options($data);				

		?></div>
		<div class="flex-col"><?php 
			cactus_title("Super Sidekicks", "", "");
			
			$item = array(
				'title'		=>	'BBQ Smoked Baked Beans',
				'desc'		=>	'',
				'price'		=>	'2.59',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

			$item = array(
				'title'		=>	'Creamy Mac & Cheese',
				'desc'		=>	'',
				'price'		=>	'2.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

			$item = array(
				'title'		=>	'Macaroni Salad',
				'desc'		=>	'',
				'price'		=>	'2.59',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

			$item = array(
				'title'		=>	'House Made Coleslaw',
				'desc'		=>	'',
				'price'		=>	'2.59',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

			$item = array(
				'title'		=>	'French Fries',
				'desc'		=>	'',
				'price'		=>	'1.99',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

			$item = array(
				'title'		=>	'House Made Corn Bread Muffin',
				'desc'		=>	'',
				'price'		=>	'99¢',
			);
			flex_line_item_cactus($item['title'], $item['desc'], $item['price']);

		
		?>

			<!-- <div class="value_meals">
				<div class="value_meals_top">
					<div class="value_meals_title">
						<div class="color">Value&nbsp;</div>
						<div class="normal">Meals</div>
					</div>
					<div class="value_meals_price">
						<div class="price">
							<div class="top">$</div>
							<div class="middle">16</div>
							<div class="bottom">EA.</div>
						</div>
						<div class="tagline">GET IT TO GO!</div>
					</div>
				</div>
				<div class="value_meals_item">
					<div class="value_meals_item_title">Winner Winner, Chicken Dinner</div>
					<div class="value_meals_item_desc">1 Whole Rotisserie Chicken,<br>3 Super Sidekicks, 4 Cornbread Muffins</div>
				</div>
				<div class="value_meals_item">
					<div class="value_meals_item_title">Big Platter</div>
					<div class="value_meals_item_desc"><b>Your choice of Hand-Pulled Pork, Brisket, Ribs, or Wings</b><br>Choose 3 Super Sidekicks: House-Made Coleslaw, BBQ Smoked Baked Beans, Creamy Mac & Cheese, or Macaroni Salad</div>
				</div>
			</div> -->
		</div>
	</div>
	
	</div>



<!-- HOTLINE START -->
<!--begin lunch -->
<!-- sticky menus / see code starting on line 10  -->
<div id="<?php echo $lunch; ?>" style="display:<?php echo $hotlineL; ?>;">

	<h1 class="title">HOT LINE: LUNCH</h1>

	<div id="ld-time">
		Lunch: 11am - 2pm<br />
		Dinner: 4pm - 7:30pm</p>
	</div>

	<div align=center>
		<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
		<input type="hidden" name="unit" value="cactus" />
		<input type="hidden" name="menuType" value="hotline-dinner" />
		<input type="hidden" name="addDays" value="<?php echo $_GET['addDays']; ?>" />
		<input id = "view-other" type="submit" value="View Dinner" />
		</form>
	</div>

	<br clear="both" />

<?php

// include menu settings
include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_cactus/hotline/admin_menu_settings.php");

#####################################
## BEGIN HOT LINE MENU LUNCH LOGIC ##
#####################################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_cactus_hotline");

// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$plusSeconds = $_GET['addDays'] * 86400;
	$weeksPast = floor(((time()+$plusSeconds) - strtotime($startRow['startDay'])) / 604800);
}

## assign current dates ##
// assign for use in menu logic
$today = date("njY", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));
// assign current date in format for menu display
$todayFormatted = date("l, F j, Y", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));

// calculate days and weeks passed
$dayCount = $daysPast % 7; // based on a Monday start date sometime in the past; setting in db
$weekCount = $weeksPast % 3; // based on a 4-week rotation ## New Rotation

	// figure out which day of the week it is
	switch ($dayCount) {
    case 0:
        $dayOfWk = 'Monday';
        break;
    case 1:
        $dayOfWk = 'Tuesday';
        break;
    case 2:
        $dayOfWk = 'Wednesday';
        break;
    case 3:
        $dayOfWk = 'Thursday';
        break;
    case 4:
        $dayOfWk = 'Friday';
        break;
    case 5:
        $dayOfWk = 'Saturday';
        break;
    case 6:
        $dayOfWk = 'Sunday';
        break;
	}

	// figure out which week of the rotation we are in

	switch ($weekCount) {
	case 0:
		$whichWeek = 'Week 1'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 1;
		$wkPlDwn2 = 2;
		$wkPlDwn3 = 3;
		$wkPlDwn4 = 4;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week1
		$week1 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week 2 in week2
		$week2 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week3
		$week3 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week4
		$week4 = $weekRow['status'];

		// assign the days based on which week we are in
		$days = array();
		for ($counter = 1; $counter <= 20; $counter++){
			$days[$counter] = $counter;
		}
		break;

	case 1:
		$whichWeek = 'Week 2'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 2;
		$wkPlDwn2 = 3;
		$wkPlDwn3 = 1;
		$wkPlDwn4 = 1;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week4
		$week4 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week1
		$week1 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week2
		$week2 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week3
		$week3 = $weekRow['status'];

		// assign the days based on which week we are in
		// $days = array();
		// for ($counter = 6; $counter <= 20; $counter++){
		// 	$days[] = $counter;
		// }
		// if ($counter = 21){
		// 	for ($sub_counter = 1; $sub_counter <= 5; $sub_counter++){
		// 		$days[] = $sub_counter;
		// 	}
		// }
		$days[1] = 6;
		$days[2] = 7;
		$days[3] = 8;
		$days[4] = 9;
		$days[5] = 10;
		$days[6] = 11;
		$days[7] = 12;
		$days[8] = 13;
		$days[9] = 14;
		$days[10] = 15;


		// $day11 = 16;
		// $day12 = 17;
		// $day13 = 18;
		// $day14 = 19;
		// $day15 = 20;

		$days[11] = 1;
		$days[12] = 2;
		$days[13] = 3;
		$days[14] = 4;
		$days[15] = 5;


		$days[16] = 1;
		$days[17] = 2;
		$days[18] = 3;
		$days[19] = 4;
		$days[20] = 5;
		break;

	case 2:
		$whichWeek = 'Week 3'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 3;
		$wkPlDwn2 = 1;
		$wkPlDwn3 = 2;
		$wkPlDwn4 = 2;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week3
		$week3 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week4
		$week4 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week1
		$week1 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week2
		$week2 = $weekRow['status'];

		// assign the days based on which week we are in
		// $days = array();
		// for ($counter = 11; $counter <= 20; $counter++){
		// 	$days[] = $counter;
		// 	}
		// if ($counter = 21){
		// 	for ($sub_counter = 1; $sub_counter <= 10; $sub_counter++){
		// 		$days[] = $sub_counter;
		// 	}
		// }
		$days[1] = 11;
		$days[2] = 12;
		$days[3] = 13;
		$days[4] = 14;
		$days[5] = 15;

		$days[6] = 1;
		$days[7] = 2;
		$days[8] = 3;
		$days[9] = 4;
		$days[10] = 5;

		$days[11] = 6;
		$days[12] = 7;
		$days[13] = 8;
		$days[14] = 9;
		$days[15] = 10;

		// $day16 = 6;
		// $day17 = 7;
		// $day18 = 8;
		// $day19 = 9;
		// $day20 = 10;
		break;

	case 3:
		$whichWeek = 'Week 4'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 4;
		$wkPlDwn2 = 1;
		$wkPlDwn3 = 2;
		$wkPlDwn4 = 3;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week2
		$week2 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week3
		$week3 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week4
		$week4 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week1
		$week1 = $weekRow['status'];

		// assign the days based on which week we are in
		$days = array();
		for ($counter = 16; $counter <= 20; $counter++){
			$days[] = $counter;
			}
		if ($counter = 21){
			for ($sub_counter = 1; $sub_counter <= 15; $sub_counter++){
				$days[] = $sub_counter;
			}
		}
		break;
	}

// calculate how many total days have past using the total number of rounded weeks
$tmp = $weeksPast * 7;

// figure out where to start the date count for the first Monday
$startDate = date("M j", strtotime("+" . $tmp . " days", strtotime($startRow['startDay'])));

// assign dates for week 1
$mon1 = date("njY", strtotime("+0 days", strtotime($startDate)));
$tue1 = date("njY", strtotime("+1 days", strtotime($startDate)));
$wed1 = date("njY", strtotime("+2 days", strtotime($startDate)));
$thu1 = date("njY", strtotime("+3 days", strtotime($startDate)));
$fri1 = date("njY", strtotime("+4 days", strtotime($startDate)));

// assign dates for week 2
$mon2 = date("njY", strtotime("+7 days", strtotime($startDate)));
$tue2 = date("njY", strtotime("+8 days", strtotime($startDate)));
$wed2 = date("njY", strtotime("+9 days", strtotime($startDate)));
$thu2 = date("njY", strtotime("+10 days", strtotime($startDate)));
$fri2 = date("njY", strtotime("+11 days", strtotime($startDate)));

// assign dates for week 3
$mon3 = date("njY", strtotime("+14 days", strtotime($startDate)));
$tue3 = date("njY", strtotime("+15 days", strtotime($startDate)));
$wed3 = date("njY", strtotime("+16 days", strtotime($startDate)));
$thu3 = date("njY", strtotime("+17 days", strtotime($startDate)));
$fri3 = date("njY", strtotime("+18 days", strtotime($startDate)));

// assign dates for week 4
$mon4 = date("M j", strtotime("+21 days", strtotime($startDate)));
$tue4 = date("M j", strtotime("+22 days", strtotime($startDate)));
$wed4 = date("M j", strtotime("+23 days", strtotime($startDate)));
$thu4 = date("M j", strtotime("+24 days", strtotime($startDate)));
$fri4 = date("M j", strtotime("+25 days", strtotime($startDate)));

// $ignore = [5,6];
// $count = 0;
// $tmp_arr
// $tmp_weekCount = 0;
// for ($i=0; $i <= 25; $i++) {
// 	if (ignore){
// 		${"mon" . $i} = date("M j", strtotime("+25 days", strtotime($startDate)));
// 		$count++;
// 		if ($count ==5){
// 			$tmp_weekCount++;
// 			$count = 0;
// 		}
// 	}
// }

// list($mon1 , ) = arr


?>

<?php
// figure out which day of the week it is and run day-specific query (unless it's a weekend)
	switch ($today) {

	// week 1
    case $mon1:
		// query the day table for day 1

		$day = $db->query("SELECT * FROM day WHERE id = " . $days[1] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue1:
		// query the day table for day 2
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[2] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed1:
		// query the day table for day 3
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[3] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu1:
		// query the day table for day 4
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[4] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri1:
		// query the day table for day 5
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[5] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

	// week 2
    case $mon2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[6] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[7] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[8] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[9] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri2:
		// query the day table for day 10
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[10] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

	// week 3
    case $mon3:
		// query the day table for day 11
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[11] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue3:
		// query the day table for day 12
		echo $day[11];
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[12] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed3:
		// query the day table for day 13
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[13] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu3:
		// query the day table for day 14
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[14] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri3:
		// query the day table for day 15
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[15] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

	// week 4
    // case $mon4:
	// 	// query the day table for day 16
	// 	$day = $db->query("SELECT * FROM day WHERE id = " . $days[15] . "");
	// 	$dayRow = $day->fetch_assoc();
	// 	// query the menu table to figure out the name of the menu based on the menu ID for this day
	// 	$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
	// 	$menuNameRow = $menuName->fetch_assoc();
    //     break;

    // case $tue4:
	// 	// query the day table for day 17
	// 	$day = $db->query("SELECT * FROM day WHERE id = " . $days[16] . "");
	// 	$dayRow = $day->fetch_assoc();
	// 	// query the menu table to figure out the name of the menu based on the menu ID for this day
	// 	$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
	// 	$menuNameRow = $menuName->fetch_assoc();
    //     break;

    // case $wed4:
	// 	// query the day table for day 18
	// 	$day = $db->query("SELECT * FROM day WHERE id = " . $days[17] . "");
	// 	$dayRow = $day->fetch_assoc();
	// 	// query the menu table to figure out the name of the menu based on the menu ID for this day
	// 	$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
	// 	$menuNameRow = $menuName->fetch_assoc();
    //     break;

    // case $thu4:
	// 	// query the day table for day 19
	// 	$day = $db->query("SELECT * FROM day WHERE id = " . $days[18] . "");
	// 	$dayRow = $day->fetch_assoc();
	// 	// query the menu table to figure out the name of the menu based on the menu ID for this day
	// 	$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
	// 	$menuNameRow = $menuName->fetch_assoc();
    //     break;

    // case $fri4:
	// 	// query the day table for day 20
	// 	$day = $db->query("SELECT * FROM day WHERE id = " . $days[19] . "");
	// 	$dayRow = $day->fetch_assoc();
	// 	// query the menu table to figure out the name of the menu based on the menu ID for this day
	// 	$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
	// 	$menuNameRow = $menuName->fetch_assoc();
    //     break;
	}

## END CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##
// Debug
// $debug_data = [
// 	'today' => $today,
// 	'which week' => $whichWeek,
// 	'days' => $days,
// 	'mon1' => $mon1,
// 	'mon2' => $mon2,
// 	'mon3' => $mon3,
// 	'tue1' => $tue1
// ];
// var_dump($debug_data);
?>

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION

	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="today-formatted"><p><span>' . $todayFormatted . '</span>';

	// check to make sure the restaurant is open before displaying the menu name and menu
	if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
		echo ' <strong>Closed</strong></p>';
		// decide if we need to announce a day-only closure...
		if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
			echo '<p style="padding-top:14px;">We are closed today. Please visit us another time.</p></div>';
		} else { // ...or a week-long closure
			echo '<p style="padding-top:14px;">We are closed this week. Please visit us another time.</p></div>';
		}

		// get out of php so we can easily show the form
		?>
		<div style="float:left; padding:0 0 0 20px;">
			<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
			<input type="hidden" name="unit" value="cactus" />
			<input type="hidden" name="menuType" value="hotline-lunch" />
			<select class="date-picker" name="addDays" onChange="this.form.submit();">
				<option value="" disabled selected>View another day...</option>
				<option <?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
				<option <?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
				<option <?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
			</select>

			</form>
		</div>
		<br clear="all" />

		<?php

	} else {

		// check price display setting and assign appropriate function name for menu display
		if ($menuNameRow['prices'] == 'Yes') {
			$displayFunction = 'full_line_item_cactus';
		} else {
			$displayFunction = 'item_only_cactus';
		}

		// should we show the menu name
		if ($menuNameRow['display'] == 'Yes') {
			echo ': <span style="font-size:11px; color:#F29332;"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
		} else {
			echo '</p></div>';
		}

		// get out of php so we can easily show the form
		?>
		<div style="float:left; padding:0 0 0 20px;">
			<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
			<input type="hidden" name="unit" value="cactus" />
			<input type="hidden" name="menuType" value="hotline-lunch" />
			<select class="date-picker" name="addDays" onChange="this.form.submit();">
				<option value="" disabled selected>View another day...</option>
				<option <?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
				<option <?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
				<option <?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
			</select>
			</form>
		</div>
		<br clear="all" />

		<?php

		############################
		## START THE MENU DISPLAY ##
		############################

		// set default decimals places to use in prices
		$num_dec_places = 2;

		// GET PLATE PRICING
		$plateResult = $db->query("SELECT * FROM plate_pricing WHERE id = 1");
		$plateRow = $plateResult->fetch_assoc();

		// BEGIN ENTREES
		// query the item table to get all the Entrees on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $entrees . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;
		$noPrice = false;
		$padding = 5;

		echo '<div id="carte">a la carte / plate</div>';

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxEntrees)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Entr&eacute;es</strong><span id="hotline-plate">(plate price includes 2 sides & roll)</span></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

				// calculate plate pricing
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT) . ' / ';
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				$cost .= str_pad($additional,$padding,' ',STR_PAD_LEFT);
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END ENTREES

		// BEGIN VEGETARIAN (aka SALADS in menu system)
		// query the item table to get all the Entrees on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $salads . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSalads)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Vegetarian</strong></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

				// calculate straight cost
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT);
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END VEGETARIAN (aka SALADS in menu system)

		// BEGIN GRAINS
		// query the item table to get all the Entrees on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $grains . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxGrains)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Grains</strong></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

## we ONLY need this for entrees, not for the sides or other dished
				// calculate straight cost
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT);
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END GRAINS

		// BEGIN SIDES
		// query the item table to get all the SIDES on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $sides . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSides)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Sides</strong></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

## we ONLY need this for entrees, not for the sides or other dished
				// calculate straight cost
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT);
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END SIDES

		// BEGIN COMMENTS (Chef's Notes)
		// query the menu table to get comments on this menu
		$commentResult = $db->query("SELECT comments FROM menu WHERE id = " . $dayRow['menuID'] . "");

		// init counters and flags
		$display = false;
		$showHeader = false;

		while ($commentRow = $commentResult->fetch_assoc()) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $commentRow['comments'] != '') {
				echo '<p style="margin-top: 10px; margin-left: 150px;"><strong id="chef-note"><div id="chef-title">Chef\'s Notes</div></strong><br />';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<div style="margin-left: 150px; margin-right: 150px;"><span style="font-size:16px; font-weight:800;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
				echo '<br /></span><span style="font-size:16px; color:black; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span></div>';
				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} // END IF not empty

			// only show the closing P tag if we actually have items in the list
			if (!$showHeader && $commentRow['comments'] != '') {
				echo '</p>';
			} // END IF to show header

		} // END While loop
		// END COMMENTS (Chef's Notes)
		## END THE MENU DISPLAY

	} // END the IF for checking on restaurant closure

	// if we have 4 dishes w/o items, we have no menu, so let them know
	if ($noMenu == 4) {
		echo '<p>We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION

###################################
## END HOT LINE MENU LUNCH LOGIC ##
###################################

?>
</div>
<!--end lunch -->

<!--begin dinner -->
<!-- sticky menus / see code starting on line 13  -->
<div id="<?php echo $dinner; ?>" style="display:<?php echo $hotlineD; ?>;">

	<h1 class="title">HOT LINE: DINNER</h1>

	<div id="ld-time">
		Lunch: 11am - 2pm<br />
		Dinner: 4pm - 7:30pm
	</div>
	<div align="center">
		<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
		<input type="hidden" name="unit" value="cactus" />
		<input type="hidden" name="menuType" value="hotline-lunch" />
		<input type="hidden" name="addDays" value="<?php echo $_GET['addDays']; ?>" />
		<input id="view-other" type="submit" value="View Lunch" />
		</form>
	</div>

	<br clear="both" />

<?php

// include menu settings
include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_cactus/hotline_dinner/admin_menu_settings.php");

######################################
## BEGIN HOT LINE MENU DINNER LOGIC ##
######################################

## BEGIN CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

// select database
$db = new db_mysqli("menus_cactus_dinner");


// query the start table to get start date
$start = $db->query("SELECT * FROM start");
$startRow = $start->fetch_assoc();

// divide by the number of seconds in a day and round down to current day
$daysPast = floor((time() - strtotime($startRow['startDay'])) / 86400);
// if this is for a future date, add it to the actual days passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$daysPast = $daysPast + $_GET['addDays'];
}
// divide by the number of seconds in a week and round down to current week
$weeksPast = floor((time() - strtotime($startRow['startDay'])) / 604800);
// if this is for a future date, add it to the actual weeks passed figure
if (isset($_GET['addDays']) && $_GET['addDays']) {
	$plusSeconds = $_GET['addDays'] * 86400;
	$weeksPast = floor(((time()+$plusSeconds) - strtotime($startRow['startDay'])) / 604800);
}

## assign current dates ##
// assign for use in menu logic
$today = date("njY", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));
// assign current date in format for menu display
$todayFormatted = date("l, F j, Y", strtotime("+".$daysPast."days", strtotime($startRow['startDay'])));

// calculate days and weeks passed
$dayCount = $daysPast % 7; // based on a Monday start date sometime in the past; setting in db
$weekCount = $weeksPast % 3; // based on a 4-week rotation

	// figure out which day of the week it is
	switch ($dayCount) {
    case 0:
        $dayOfWk = 'Monday';
        break;
    case 1:
        $dayOfWk = 'Tuesday';
        break;
    case 2:
        $dayOfWk = 'Wednesday';
        break;
    case 3:
        $dayOfWk = 'Thursday';
        break;
    case 4:
        $dayOfWk = 'Friday';
        break;
    case 5:
        $dayOfWk = 'Saturday';
        break;
    case 6:
        $dayOfWk = 'Sunday';
        break;
	}

	// figure out which week of the rotation we are in
	switch ($weekCount) {
	case 0:
		$whichWeek = 'Week 1'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 1;
		$wkPlDwn2 = 2;
		$wkPlDwn3 = 3;
		$wkPlDwn4 = 4;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week1
		$week1 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week 2 in week2
		$week2 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week3
		$week3 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week4
		$week4 = $weekRow['status'];

		// assign the days based on which week we are in
		$days = array();
		for ($counter = 1; $counter <= 20; $counter++){
			$days[] = $counter;
		}
		break;

	case 1:
		$whichWeek = 'Week 2'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 2;
		$wkPlDwn2 = 3;
		$wkPlDwn3 = 1;
		$wkPlDwn4 = 1;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week4
		$week4 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week1
		$week1 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week2
		$week2 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week3
		$week3 = $weekRow['status'];

		// assign the days based on which week we are in
		$days = array();
		for ($counter = 6; $counter <= 20; $counter++){
			$days[] = $counter;
			}
		if ($counter = 21){
			for ($sub_counter = 1; $sub_counter <= 5; $sub_counter++){
				$days[] = $sub_counter;
			}
		}
		break;

	case 2:
		$whichWeek = 'Week 3'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 3;
		$wkPlDwn2 = 1;
		$wkPlDwn3 = 2;
		$wkPlDwn4 = 2;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week3
		$week3 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week4
		$week4 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week1
		$week1 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week2
		$week2 = $weekRow['status'];

		// assign the days based on which week we are in
		$days = array();
		for ($counter = 11; $counter <= 20; $counter++){
			$days[] = $counter;
			}
		if ($counter = 21){
			for ($sub_counter = 1; $sub_counter <= 10; $sub_counter++){
				$days[] = $sub_counter;
			}
		}
		break;

	case 3:
		$whichWeek = 'Week 4'; // this is only used for debugging

		// assign the weeks accordingly for use in the select names of the weekly closed/open pulldowns
		$wkPlDwn1 = 4;
		$wkPlDwn2 = 1;
		$wkPlDwn3 = 2;
		$wkPlDwn4 = 3;

		// query the week table now that we've figured out which week we are in
		$week = $db->query("SELECT * FROM week ORDER BY id ASC");

		// arrange the weeks' closed/open status fields accordingly
		// get results for 1st week
		$weekRow = $week->fetch_assoc();
		// put week1 in week2
		$week2 = $weekRow['status'];

		// get results for 2nd week
		$weekRow = $week->fetch_assoc();
		// put week2 in week3
		$week3 = $weekRow['status'];

		// get results for 3rd week
		$weekRow = $week->fetch_assoc();
		// put week3 in week4
		$week4 = $weekRow['status'];

		// get results for 4th week
		$weekRow = $week->fetch_assoc();
		// put week4 in week1
		$week1 = $weekRow['status'];

		// assign the days based on which week we are in
		$days = array();
		for ($counter = 16; $counter <= 20; $counter++){
			$days[] = $counter;
			}
		if ($counter = 21){
			for ($sub_counter = 1; $sub_counter <= 15; $sub_counter++){
				$days[] = $sub_counter;
			}
		}
		break;
	}

// calculate how many total days have past using the total number of rounded weeks
$tmp = $weeksPast * 7;

// figure out where to start the date count for the first Monday
$startDate = date("M j", strtotime("+" . $tmp . " days", strtotime($startRow['startDay'])));

// assign dates for week 1
// the $tue1 below is how i'll probably want to show this on the actual display page for the popup editor and on the live menu page
// $tue1 = date("l, F j, Y", strtotime("+1 days", strtotime($startDate)));
// $mon1 = $startDate;
$mon1 = date("njY", strtotime("+0 days", strtotime($startDate)));
$tue1 = date("njY", strtotime("+1 days", strtotime($startDate)));
$wed1 = date("njY", strtotime("+2 days", strtotime($startDate)));
$thu1 = date("njY", strtotime("+3 days", strtotime($startDate)));
$fri1 = date("njY", strtotime("+4 days", strtotime($startDate)));

// assign dates for week 2
$mon2 = date("njY", strtotime("+7 days", strtotime($startDate)));
$tue2 = date("njY", strtotime("+8 days", strtotime($startDate)));
$wed2 = date("njY", strtotime("+9 days", strtotime($startDate)));
$thu2 = date("njY", strtotime("+10 days", strtotime($startDate)));
$fri2 = date("njY", strtotime("+11 days", strtotime($startDate)));

// assign dates for week 3
$mon3 = date("njY", strtotime("+14 days", strtotime($startDate)));
$tue3 = date("njY", strtotime("+15 days", strtotime($startDate)));
$wed3 = date("njY", strtotime("+16 days", strtotime($startDate)));
$thu3 = date("njY", strtotime("+17 days", strtotime($startDate)));
$fri3 = date("njY", strtotime("+18 days", strtotime($startDate)));

// assign dates for week 4
$mon4 = date("M j", strtotime("+21 days", strtotime($startDate)));
$tue4 = date("M j", strtotime("+22 days", strtotime($startDate)));
$wed4 = date("M j", strtotime("+23 days", strtotime($startDate)));
$thu4 = date("M j", strtotime("+24 days", strtotime($startDate)));
$fri4 = date("M j", strtotime("+25 days", strtotime($startDate)));

?>

<?php

// figure out which day of the week it is and run day-specific query (unless it's a weekend)
	switch ($today) {

	// week 1
    case $mon1:
		// query the day table for day 1

		// $day = $db->query("SELECT * FROM day WHERE id = " . $day1 . "");

		$day = $db->query("SELECT * FROM day WHERE id = " . $days[0] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue1:
		// query the day table for day 2
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[1] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed1:
		// query the day table for day 3
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[2] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu1:
		// query the day table for day 4
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[3] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri1:
		// query the day table for day 5
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[4] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

	// week 2
    case $mon2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[5] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[6] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[7] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu2:
		// query the day table for day 1
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[8] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri2:
		// query the day table for day 10
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[9] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

	// week 3
    case $mon3:
		// query the day table for day 11
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[10] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue3:
		// query the day table for day 12
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[11] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed3:
		// query the day table for day 13
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[12] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu3:
		// query the day table for day 14
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[13] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri3:
		// query the day table for day 15
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[14] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

	// week 4
    case $mon4:
		// query the day table for day 16
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[15] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $tue4:
		// query the day table for day 17
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[16] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $wed4:
		// query the day table for day 18
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[17] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $thu4:
		// query the day table for day 19
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[18] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;

    case $fri4:
		// query the day table for day 20
		$day = $db->query("SELECT * FROM day WHERE id = " . $days[19] . "");
		$dayRow = $day->fetch_assoc();
		// query the menu table to figure out the name of the menu based on the menu ID for this day
		$menuName = $db->query("SELECT * FROM menu WHERE id = " . $dayRow['menuID'] . "");
		$menuNameRow = $menuName->fetch_assoc();
        break;
	}

## END CODE TO DETERMINE WHAT DAY IT IS/WHERE WE ARE IN THE ROTATION ##

?>

<?php
	// START THE LOGIC TO DISPLAY THE MENU INFORMATION

	// set counter to track empty menu items
	$noMenu = 0;

	// display the date
	echo '<div id="today-formatted"><p><span>' . $todayFormatted . '</span>';

	// check to make sure the restaurant is open before displaying the menu name and menu
	if ($menuNameRow['name'] == 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday' || $week1 == 'Closed') {
		echo ' <strong>Closed</strong></p>';
		// decide if we need to announce a day-only closure...
		if ($week1 != 'Closed' || $dayOfWk == 'Saturday' || $dayOfWk == 'Sunday') {
			echo '<p style="padding-top:14px;">We are closed today. Please visit us another time.</p></div>';
		} else { // ...or a week-long closure
			echo '<p style="padding-top:14px;">We are closed this week. Please visit us another time.</p></div>';
		}

		// get out of php so we can easily show the form
		?>
		<div style="float:left; padding:0 0 0 20px;">
			<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
			<input type="hidden" name="unit" value="cactus" />
			<input type="hidden" name="menuType" value="hotline-dinner" />
			<select class="date-picker" name="addDays" onChange="this.form.submit();">
				<option value="" disabled selected>View another day...</option>
				<option <?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
				<option <?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
				<option <?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
			</select>

			</form>
		</div>
		<br clear="all" />

		<?php

	} else {

		// check price display setting and assign appropriate function name for menu display
		if ($menuNameRow['prices'] == 'Yes') {
			$displayFunction = 'full_line_item_cactus';
		} else {
			$displayFunction = 'item_only_cactus';
		}

		// should we show the menu name
		if ($menuNameRow['display'] == 'Yes') {
			echo ': <span style="font-size:11px; color:#F29332;"><strong>' . $menuNameRow['name'] . '</strong></span></p></div>';
		} else {
			echo '</p></div>';
		}

		// get out of php so we can easily show the form
		?>
		<div style="float:left; padding:0 0 0 20px;">
			<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" style="padding:0; margin:0;">
			<input type="hidden" name="unit" value="cactus" />
			<input type="hidden" name="menuType" value="hotline-dinner" />
			<select class="date-picker" name="addDays" onChange="this.form.submit();">
				<option value="" disabled selected>View another day...</option>
				<option <?= $_GET['addDays'] == '0' ? ' selected' : '' ?> value="0">Today</option>
				<option <?= $_GET['addDays'] == '1' ? ' selected' : '' ?> value="1">Tomorrow</option>
				<option <?= $_GET['addDays'] == '2' ? ' selected' : '' ?> value="2"><?php echo date("l, F j", strtotime("+2 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '3' ? ' selected' : '' ?> value="3"><?php echo date("l, F j", strtotime("+3 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '4' ? ' selected' : '' ?> value="4"><?php echo date("l, F j", strtotime("+4 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '5' ? ' selected' : '' ?> value="5"><?php echo date("l, F j", strtotime("+5 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '6' ? ' selected' : '' ?> value="6"><?php echo date("l, F j", strtotime("+6 days", time())) ?></option>
				<option <?= $_GET['addDays'] == '7' ? ' selected' : '' ?> value="7"><?php echo date("l, F j", strtotime("+7 days", time())) ?></option>
			</select>
			</form>
		</div>
		<br clear="all" />

		<?php

		############################
		## START THE MENU DISPLAY ##
		############################

		// set default decimals places to use in prices
		$num_dec_places = 2;

		// GET PLATE PRICING
		$plateResult = $db->query("SELECT * FROM plate_pricing WHERE id = 1");
		$plateRow = $plateResult->fetch_assoc();

		// BEGIN ENTREES
		// query the item table to get all the Entrees on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $entrees . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;
		$noPrice = false;
		$padding = 5;

		echo '<div id="carte">a la carte / plate</div>';

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxEntrees)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Entr&eacute;es</strong><span id="hotline-plate">(plate price includes 2 sides & roll)</span></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

				// calculate plate pricing
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT) . ' / ';
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				$cost .= str_pad($additional,$padding,' ',STR_PAD_LEFT);
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END ENTREES

		// BEGIN VEGETARIAN (aka SALADS in menu system)
		// query the item table to get all the Entrees on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $salads . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSalads)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Vegetarian</strong></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

## we ONLY need this for entrees, not for the sides or other dished
				// calculate plate pricing
//				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT) . ' / ';
//				if (!$noPrice) {
//					$additional = $itemRow['price'] + $plateRow['offset'];
//					$additional = number_format($additional, $num_dec_places);
//				} else {
//					$additional = $priceText;
//				}
//				$cost .= str_pad($additional,$padding,' ',STR_PAD_LEFT);
//				echo $displayFunction($itemRow['name'], '', $cost);

				// calculate straight cost
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT);
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END VEGETARIAN (aka SALADS in menu system)

		// BEGIN GRAINS
		// query the item table to get all the Entrees on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $grains . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxGrains)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Grains</strong></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

## we ONLY need this for entrees, not for the sides or other dished
				// calculate plate pricing
//				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT) . ' / ';
//				if (!$noPrice) {
//					$additional = $itemRow['price'] + $plateRow['offset'];
//					$additional = number_format($additional, $num_dec_places);
//				} else {
//					$additional = $priceText;
//				}
//				$cost .= str_pad($additional,$padding,' ',STR_PAD_LEFT);
//				echo $displayFunction($itemRow['name'], '', $cost);

				// calculate straight cost
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT);
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END GRAINS

		// BEGIN SIDES
		// query the item table to get all the SIDES on this menu
		$itemResult = $db->query("SELECT * FROM item WHERE menuID = " . $dayRow['menuID'] . " AND dishID = " . $sides . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = $itemResult->fetch_assoc()) || ($count <= $maxSides)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p id="entree"><strong style="font-size:40px; color:#dc4821; text-transform:uppercase;">Sides</strong></p>';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($itemRow['name'] != '') {

				// if no price is entered, display using predefined setting
				if (!$itemRow['price']) {
					$itemRow['price'] = $priceText;
					$noPrice = true;
					$padding = 3;
				}

## we ONLY need this for entrees, not for the sides or other dished
				// calculate plate pricing
//				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT) . ' / ';
//				if (!$noPrice) {
//					$additional = $itemRow['price'] + $plateRow['offset'];
//					$additional = number_format($additional, $num_dec_places);
//				} else {
//					$additional = $priceText;
//				}
//				$cost .= str_pad($additional,$padding,' ',STR_PAD_LEFT);
//				echo $displayFunction($itemRow['name'], '', $cost);

				// calculate straight cost
				$cost = str_pad($itemRow['price'],$padding,' ',STR_PAD_LEFT);
				if (!$noPrice) {
					$additional = $itemRow['price'] + $plateRow['offset'];
					$additional = number_format($additional, $num_dec_places);
				} else {
					$additional = $priceText;
				}
				echo $displayFunction($itemRow['name'], '', $cost);

				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;

		} // END While loop
		// END SIDES

		// BEGIN COMMENTS (Chef's Notes)
		// query the menu table to get comments on this menu
		$commentResult = $db->query("SELECT comments FROM menu WHERE id = " . $dayRow['menuID'] . "");

		// init counters and flags
		$display = false;
		$showHeader = false;

		while ($commentRow = $commentResult->fetch_assoc()) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $commentRow['comments'] != '') {
				echo '<p style="margin-top: 10px; margin-left: 150px;"><strong id="chef-note"><div id="chef-title">Chef\'s Notes</div></strong><br />';
				$showHeader = true;
			} // END IF to show header

			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<div style="margin-left: 150px; margin-right: 150px;"><span style="font-size:16px; font-weight:800;">' . nl2br($commentRow['comments']) . '</span><span style="font-size:16px;"><br />';
				echo '<br /></span><span style="font-size:16px; color:black; font-weight: normal;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span></div>';
				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} // END IF not empty

			// only show the closing P tag if we actually have items in the list
			if (!$showHeader && $commentRow['comments'] != '') {
				echo '</p>';
			} // END IF to show header

		} // END While loop
		// END COMMENTS (Chef's Notes)
		## END THE MENU DISPLAY

	} // END the IF for checking on restaurant closure

	// if we have 4 dishes w/o items, we have no menu, so let them know
	if ($noMenu == 4) {
		echo '<p>We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION

####################################
## END HOT LINE MENU DINNER LOGIC ##
####################################

?>
</div>
<!--end dinner -->
<!-- HOTLINE FINISH -->
	<div id="bbq" style="display:none;">
		<h1 class="title">BBQ SANDWICHES</h1>
		<div class="row bbq_list">
			<div class="col" style="width: 450px;">
				<?php
					half_line_item('Pork', '7.19 / 8.49');
					echo '<br/><span id="subs">Hand-pulled pork piled high with a pickle, a cornbread muffin, and two super sidekicks</span>';
					half_line_item('Beef Brisket', '7.19 / 8.49');
					echo '<br/><span id="subs">Tender, melt-in-your-mouth brisket with a pickle, cornbread muffin, and two super sidekicks</span>';
					half_line_item('Baby Back Style Ribs', '7.19 / 8.49');
					echo '<br/><span id="subs">Bone-in pork ribs glazed with BBQ sauce with a cornbread muffin and two super sidekicks</span>';
					half_line_item('Big Platter', '16.00');
					echo '<br/><span id="subs">Includes 3 BBQ items, as well as 3 BBQ sides</span>';
				?>
			</div>
			<div class="col" style="width: 450px;">
				<?php
					half_line_item('Half Chicken', '7.19 / 8.48');
					echo '<br/><span id="subs">Tender, juicy rotisserie half chicken with a cornbread muffin and two super sidekicks</span>';
					half_line_item('Chicken Wings', '6.49 / 7.69');
					echo '<br/><span id="subs">Six&nbsp;wings with your choice of sauce: BBQ, Smokey BBQ, Buffalo or sweet mustard, and two super sidekicks</span>';
					half_line_item('Whole Chicken', '9.49');
					echo '<br/><span id="subs">Tender, juicy whole rotisserie chicken</span>';
					half_line_item('Winner Winner Chicken Dinner', '16');
					echo '<br/><span id="subs">Includes one whole rotisserie chicken, three super sidekicks, and four cornbread muffins</span>';
				?>
			</div>
		</div>

		<div class="row" style="margin-top: -50px;">
			<div style="width: 550px;">
				<h1 class="sub_title" style="margin-left: 120px;">SUPER SIDEKICKS</h1>
				<div class="bbq_items" style="margin-left: 120px;">
					<?php
						half_line_item('BBQ Smoked Baked Beans', '2.49');
						half_line_item('Macaroni & Cheese', '2.49');
						half_line_item('Home Style Slaw', '2.49');
						half_line_item('Carolina Slaw', '2.49');
						half_line_item('Gil’s Potato Salad', '2.49');
						half_line_item('Macaroni Salad', '2.49');
					?>
				</div>
			</div>

			<div style="width: 500px;">
				<h1 class="sub_title" style="margin-left: 20px;">BUILD YOUR POTATO</h1>
				<div class="bbq_items" style="margin-left: 20px;">
					<?php
						half_line_item('Baked Potato', '4.60');
						echo '<br/><span id="subs">Includes baked potato and toppings</span>';
					?>
					<h2 style="color: transparent;">TOPPINGS</h2>
					<div class="bbq_topping row" >
						<div class="col">
							Green onions<br/>
							Cheddar Cheese<br/>
							Bacon Bits<br/>
							Sour Cream<br/>
						</div>

						<div class="col">
							Chili Beans<br/>
							Broccoli<br/>
							Whipped butter
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

</div>

