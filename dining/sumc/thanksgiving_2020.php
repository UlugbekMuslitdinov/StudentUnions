<?php
// header("Location: ../../index.php");
// die();

session_start();

$togoForm_old_inputs = array();
if (isset($_SESSION['togoForm_old_inputs'])){
	$togoForm_old_inputs = $_SESSION['togoForm_old_inputs'];
}
// var_dump($_SESSION['togoForm_old_inputs']);
function togoForm_oldInputs($arr,$type){
	// Check if session has value for each input
	$return = isset($arr[$type]) ? $arr[$type] : '';
	return $return;
}

//$menu = array(
//	'Stuffing' => array('label' => 'Autumn Sage and Sausage Stuffing',
//		'quantity' => '2 lbs.',
//		'price' => 8),
//	'Mashed Potatoes' => array('label' => 'Creamy Yukon Mashed Potatoes',
//		'quantity' => '4 lbs.',
//		'price' => 8),
//	'Yams' => array('label' => 'Spiced-Maple Yams, Pecan and Apricot',
//		'quantity' => '2 lbs.',
//		'price' => 8),		
//	'Roasted Cauliflower' => array('label' => 'Roasted Tri-Color Cauliflower',
//		'quantity' => '2 lbs.',
//		'price' => 8),
//	'Root Vegetables' => array('label' => 'Medley of Root  Vegtables',
//		'quantity' => '2 lbs.',
//		'price' => 5),
//	'Relish' => array('label' => 'Cranberry Orange Relish',
//		'quantity' => '16 oz.',
//		'price' => 8),
//	'Rolls' => array('label' => 'Classic Wheat and Oat Pull-a-Part Rolls',
//		'quantity' => '9 rolls',
//		'price' => 3),
//	'Wildcat Coffee' => array('label' => 'Wildcat-Blend Coffee Package (Pre-ground)',
//		'quantity' => '1/2 lb.',
//		'price' => 12)
//);

?>
<title>Thanksgiving Offerings To-Go</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="StyleSheet" href="/template/global.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/dining/sumc/turkey-togo.css">
<body class="togo_order">
	<div class="container" id="">
		<div class="row">
			<?php
			if( isset($_SESSION['togoForm_errors']) ){
			// Make sure session carries data
				if ( count($_SESSION['togoForm_errors']) != 0 ){
					$echo_err = '<div class="bg-danger"> <b>Error</b> : <ul>';
					foreach ($_SESSION['togoForm_errors'] as $err) {
						$echo_err .= '<li>'.$err.'</li>';
					}
					echo $echo_err.'</ul></div>';
				// Just in case session is not deleted, empty array
					$_SESSION['togoForm_errors'] = array();
				// Session will be unset at the end of this file
				}
			}
			?>
			
			<div class="col-sm-12 tgo-header no-padding">
				<img src="/template/images/banners/thanksgiving_feast.jpg"><br />
				<img src="images/thanksgiving_top.jpg">
				<!-- <div class="row">
					<div class="col-sm-2 price-logo">
						<div class="price">$78</div>
						<hr id="line">
						<div class="tax">+TAX</div>
					</div>
					<div class="col-sm-7">
						<div class="header-text">Four Course Thanksgiving Dinner!</div>
						<div class="header-desc" style="color: #555">Serves up to 8 guests. Each dinner is artfully packed with the following items...</div>
					</div>
					<div class="col-sm-3">
						<div class="bar">ALL ORDER MUST BE PLACED BY</div>
						<div class="time-required">1PM, Tuesday | November 26, 2019</div>
						<div class="bar">PICK-UP ON</div>
						<div class="time-required"> Wednesday before Thanksgiving (November 27) at 11AM, 1PM, 2PM</div>
					</div>
				</div> -->
			</div>

			<div class="col-sm-12 order-form">
			<form class="form-inline" action="thanksgiving_submit.php" method="POST">
			<!--<form class="form-inline" action="email_feast.php" method="POST" enctype="multipart/form-data">-->
				<div class="row">
					<div class="col-sm-12 no-padding client-contact-info">
						<div class="form-group col-sm-4 no-padding">
							<label for="turkeybreast" class="font-serif-italic">NAME:<span class="label-required-input">REQUIRED</span></label>
							<input type="text" name="client_name" class="client-contact-input client-name" id="turkeybreast" style="font-size:14px; font-weight:bold;" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'client_name'); ?>" required>
						</div>
						<div class="form-group col-sm-3 no-padding">
							<label for="turkeybreast" class="font-serif-italic">PHONE:<span class="label-required-input">REQUIRED</span></label>
							<input type="text" name="client_phone" class="client-contact-input client-phone" id="turkeybreast" style="font-size:14px; font-weight:bold; height: 23px;" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'client_phone'); ?>" required>
						</div>
						<div class="form-group col-sm-4 no-padding">
							<label for="turkeybreast" class="font-serif-italic">EMAIL:<span class="label-required-input">REQUIRED</span></label>
							<input type="email" name="client_email" class="client-contact-input client-email" id="turkeybreast" style="font-size:14px; font-weight:bold;" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'client_email'); ?>" required>
						</div>
					</div>
				</div>
				
				<div class="row" style="margin-left:-45px;">
					<div class="col-sm-8">
					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SELECT ONE (1) ENTR&eacute;E *WEIGHT PRE-COOKED&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NOTE: NO SUBSITUTIONS PLEASE.</div></th>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="turkey"><!--<input type="radio" name="entreechoice" value="Tom Turkey (Pan Gravy)" id="turkey">--> Tom Turkey (Pan Gravy) .......................................................... <span class="quantity-span"><!--6-8 lbs avg., Pre-Roasted*-->Sold Out</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="rib"><input type="radio" name="entreechoice" value="Prime Rib of Beef" id="rib"> Prime Rib of Beef (Au Jus) ................................................<span class="quantity-span">5-6 lbs., Pre-Roasted*</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="vege"><input type="radio" name="entreechoice" value="Roasted Vegetable Wellington (Apricot Balsamic Chutney)" id="vegi"> Roasted Vegetable Wellington <br />&nbsp;&nbsp;&nbsp;(Apricot Balsamic Chutney) ................................................<span class="quantity-span">5-6 lbs., (you bake)*</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SALAD COURSE (INCLUDED)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="salad">Roasted Candy Beets and Quinoa Salad with Goat Cheese & Citrus Vinaigrette ......................................................................................  <span style="float:right">1 lb</span><span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SELECT TWO (2) SIDE STARCHES (INCLUDED)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="autumnsage"><input type="checkbox" name="starches[]" value="Autumn Sage and Sausage Stuffing" id="autumnsage"> Autumn Sage and Sausage Stuffing ...................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="vegtarianesage"><input type="checkbox" name="starches[]" value="Vegetarian Sage and Mushroom Stuffing" id="vegtarianesage"> Vegetarian Sage and Mushroom Stuffing ................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="mashedpotatoes"><input type="checkbox" name="starches[]" value="Creamy Yukon Mashed Potatoes" id="mashedpotatoes"> Creamy Yukon Mashed Potatoes ........................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="cauliflower"><input type="checkbox" name="starches[]" value="Cauliflower Mash with Roasted Corn" id="cauliflower"> Cauliflower Mash with Roasted Corn ...................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="yams"><input type="checkbox" name="starches[]" value="Spiced-Maple Garnet Yams, Pecans and Apricots" id="yams"> Spiced-Maple Garnet Yams, Pecans and Apricots ....................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="roastedpotatoes"><input type="checkbox" name="starches[]" value="Herb Roasted Potatoes" id="roastedpotatoes"> Herb Roasted Potatoes .......................................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SELECT THREE (3) VEGETABLE SIDES (INCLUDED)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="rootvegetables"><input type="checkbox" name="vegesides[]" value="Maple Roasted Harvest Root Vegetables" id="rootvegetables"> Maple Roasted Harvest Root Vegetables ................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="sprouts"><input type="checkbox" name="vegesides[]" value="Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze" id="sprouts"> Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze .......<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="cheddarcauliflower"><input type="checkbox" name="vegesides[]" value="Cheddar Cauliflower Pearls with Roasted Garlic" id="cheddarcauliflower"> Cheddar Cauliflower Pearls with Roasted Garlic .................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="spinach"><input type="checkbox" name="vegesides[]" value="Cream Spinach with Fried Onions" id="spinach"> Cream Spinach with Fried Onions ..............................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="corn"><input type="checkbox" name="vegesides[]" value="Cream Sweet Corn" id="corn"> Cream Sweet Corn ................................................................................<span class="quantity-span">2 lbs</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					</div>

					<div class="col-sm-4">
						<table class="table">
							<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SELECT ONE (1) BREAD (INCLUDED)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="loafbread"><input type="radio" name="bread" value="Multi Grain Artisan Loaf Bread" id="loafbread"> Multi Grain Artisan Loaf Bread</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="cornbread"><input type="radio" name="bread" value="Cranberry Walnut Orange Cornbread" id="cornbread"> Cranberry Walnut Orange Cornbread</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="rolls"><input type="radio" name="bread" value="Sea Salt Soft Rolls" id="rolls"> Sea Salt Soft Rolls</label>
								</div>
							</th></tr>
							</tbody>
						</table>
					</div>
					
					<div class="col-sm-4">
						<table class="table">
							<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SELECT ONE (1) DESSERT (INCLUDED)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pudding"><input type="radio" name="dessert" value="Black and White Bread Pudding" id="pudding"> "You Bake" Black and White Bread Pudding: <span style="font-weight:100;font-style:italic; ">Dark Chocolate and Sweet Breads Soaked in Rich Custard with White Chocolate and Caramel</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="bars"><input type="radio" name="dessert" value="Apple Blondie Bars and Pecan Bar Brownies" id="bars"> Apple Blondie Bars and Pecan Bar Brownies: <span style="font-weight:100;font-style:italic; ">Two Favorite Fall Flavors Together</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pies"><input type="radio" name="dessert" value="Pumpkin Whoopie Pies" id="pies"> Pumpkin Whoopie Pies: <span style="font-weight:100;font-style:italic; ">Maple-Spice Filling</span></label>
								</div>
							</th></tr>
							</tbody>
						</table>
					</div>
					
					<div align="center" style="margin-top:250px;"><br /><br />
					<img src="images/wantitall.jpg" width="285" height="233" />
					</div>
				</div>

				<div class="row" style="margin-left: -65px;">
					<div class="col-md-12">
						<img src="images/thanksgiving_bottom.jpg" width="950" height="114"/>
					</div>
				</div>

				<!-- <div class="order-details">
					<div class="bar">ORDER DETAILS</div>
					<span id="detail-text">
						All orders must be placed by <b>1pm on Tuesday, November 26, 2019.</b> We will call to arrange payment starting <b>Monday November 25th.</b>
						The pick-up times are on </b>Wednesday before Thanksgiving (November, 27) at 11am, 1pm, 2pm at On Deck Deli</b> in the Student Union Memorial
						Center. <b>Cancellations must be made 48hrs in advance to avoid charges.</b> We will call you if there are any questions about your order.
					</span>
				</div>

				<div class="contact">
					QUESTIONS? CONTACT ANGELICA GUERRERO-OSUNA  <i class="fa fa-arrow-right" style="font-size:16px"></i>  angelicg@email.arizona.edu OR 520-621-7038 | 520-363-3618
				</div> -->
				
				<div class="col-sm-12" style="padding-bottom: 15px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <td><span style="font-size:20px; font-weight:bold;">You can also drop off the <a href="/dining/sumc/resources/Thanksgiving_Offerings.pdf" target="_blank"><span style="font-size:24px; font-weight:bold; text-decoration: underline; color: red;">PDF ORDER</span></a> at On Deck Deli.</span></td>
						  <td><button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button></td>
						</tr>
					  </tbody>
					</table>			
				</div>
			</form>
			</div>
		</div>
	</div>
</body>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
unset($_SESSION['togoForm_errors']);
unset($_SESSION['togoForm_old_inputs']);
?>

