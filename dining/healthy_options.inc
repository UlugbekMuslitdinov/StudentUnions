<?php
	//echo $_SESSION['menu_location_id'];
	$healthy_options = array(20 => array("3 Cheeses & a Noodle", 
							array("Whole Wheat Pasta (3/4 c up)", "210", "7", "1",	"43.3"),
							array("Marinara Sauce (6 oz)", "60", "2", "2", "10"),
							array("Caesar Salad (1 oz)", "39", "1", "3","1"),
 							array("Caesar Salad (1 oz) w/ Romaine Lettuce (1 oz)", "5", "0", "0", "1")
						),
			2 => array("Burger King",
							array("Hamburger (ketchup, mustard, pickle only)", "250", "13", "10", "27"),
							array("Tendergrill Chicken Sandwich", "540", "55", "18", "40"),
							array("Tendergrill Garden Salad", "490", "36", "30", "20"),
							array("Side Garden Salad", "330", "6", "26", "18")
					  ),
			5 => array("Cactus Grill",
							array("Single Hamburger", "502", "27", "32", "25"),
							array("Chicken Philly", "452", "44", "13", "39"),
							array("3 Egg Omelet", "90", "18", "0", "3")
					  ),
			21 => array("Cafe Sonora",
							array("Carne Asada Cilantro Lime Taco", "197", "15", "1", "12"),
							array("Sautéed Fajita Veggies (4 oz)", "40", "11", "1", "9"),
							array("Smoky Chipotle Chicken Taco", "153", "11", "1", "12")
					   ),
			22 => array("Canyon Cafe",
							array("Drip Coffee (1 cup)", "0", "0", "0", "0"),
							array("Tea Latte  (1 cup)", "0", "0", "0", "0")
					   ),
			23 => array("Cellar Bistro",
							array("Mediterranean Chicken Salad", "259", "28", "13", "6"),
							array("Sesame Crusted Tuna", "93", "3", "7", "6"),
							array("Flame Roasted Vegetables", "60", "1", "3", "8"),
							array("Fresh Fruit Salad (1oz)", "17", "0", "0", "4"),
							array("Natural Cottage Cheese (1/2 cup)", "110", "13", "5", "4")	
					   ),
			24 => array("Chick-Fil-A",
							array("Chargrilled Chicken Sandwich", "300", "29", "3.5", "38"),
							array("Fruit Cup (6.85oz)", "105", "1", "0", "27"),
							array("Chargrilled and Fruit Salad (12.25oz)", "230", "22", "6", "23"),
							array("Chargrilled Chicken Salad (10.5oz)",	"180", "22", "6", "11")
					   ),
			1 => array("Core",
							array("Salad (1 cup)", "10.75", "1", "0.12", "2"),
							array("W/ 1/2 spinach, 1/2 mesclun lettuce", "9", "0", "0", "2"),
							array("Smoked Turkey (1oz)", "28", "6", "0", "1"),
							array("Roasted Chicken (1oz)", "83", "14", "3", "0"),
							array("Balsamic  (1oz)", "25", "1", "1", "4")
					  ),
			27 => array("IQ Fresh",
							array("Acai Smoothie (12oz)", "189", "2.1", "1.6", "44.3"),
							array("Stradiberrious Smoothie (12oz)",	"142", "1.7", "0.7", "33.2"),
							array("Caesar Wrap", "469", "3", "22", "56"),
							array("Grilled Veggie Wrap", "492",	"14.1", "14.1", "88.9"),
							array("Caesar Dressing (2 Tbsp)", "130", "2", "13", "2")
					   ),
			28 => array("On Deck Deli",
							array("Plain Light Cream Cheese (1oz)", "66", "2", "6", "2"),
							array("Veggie Light Cream Cheese (1oz)", "80", "2", "8", "1"),
							array("Onion & Chive Light Cream Cheese", "65", "2", "6", "2"),
							array("Organic Whole Wheat (1 slice)", "358", "13", "2", "71")
						),
		 	29 => array("Panda Express",
		 					array("Broccoli Beef (5.4 oz)", "130", "10", "4", "12"),
							array("Broccoli Chicken (5.5 oz)", "180", "13", "9", "11"),
							array("String Bean Chicken Breast (5.6 oz)", "170", "15", "10", "13"),
							array("Veggie Spring Rolls (2 rolls)", "160", "4", "7", "22"),
							array("Sweet and Sour Sauce (1.8oz)", "80", "0", "0", "21")	
					   ),
			26 => array("Papa John’s Pizza",
							array("Garden Fresh Slice", "200", "8", "7", "28"),
							array("Cheese Slice", "210", "9", "8", "37")
					   ),
			31 => array("U-Mart",
							array("Spicy Bean Salad (4oz)", "84", "4", "2", "16"),
							array("Lucys Pasta Salad (4oz)", "160", "4", "7", "22"),
							array("Tuna Salad Sandwich", "430", "20", "16", "52")
					   ),
			30 => array("Redington",
							array("Choose whole wheat products, vegetables, and fruits")
					   ),
			21 => array("Sabor",
							array("Carne Asada Taco", "325", "18.1", "12.6", "38.3"),
							array("Chicken Taco", "263", "14.3", "6", "40.5"),
							array("Guacamole Taco", "277", "9.7", "10.6", "39.7"),
							array("Achiote Fish Taco", "275", "15.6", "7.1", "39.3"),
							array("Black Beans (4oz)", "152", "10", "0.8", "27.2")
						),
			62 => array("La Petite Patisserie",
							array("Turkey, Spinach & Pesto Crepe", "305", "15.2", "15.4", "27"),
							array("Banana & Nutella Crepe", "303", "8.1", "10.5", "46.2"),
							array("Yogurt, Banana, Honey & Granola Crepe", "572", "12", "15.3", "101.8"),
							array("Sugar & Lemon Crepe", "356", "9.7", "10.8", "72.6"),
							array("Apple & Cinnamon Sugar Crepe", "277", "7.1", "10.2", "39.6"),
							array("Strawberry & Honey Crepe", "290", "7.6", "10.4", "43.1")
						),
			102 => array("The Mesa Room",
							array("Wedge Salad W/New York Strip Steak", "720", "51.1", "51.4", "13.2"),
							array("Vanilla Mocha Cake", "192", "3.1", "6.9", "31.7")
						)
		);
?>