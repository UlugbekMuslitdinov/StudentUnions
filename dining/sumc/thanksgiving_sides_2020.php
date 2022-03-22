<?php
// header("Location: ../../index.php");
// die();

session_start();

$togoForm_old_inputs = array();
if (isset($_SESSION['togoForm_old_inputs'])){
	$togoForm_old_inputs = $_SESSION['togoForm_old_inputs'];
}

if(isset($_SESSION['togoForm_errors'])) {
	var_dump($_SESSION['togoForm_errors']);
	foreach($_SESSION['togoForm_errors'] as $error) {
		echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=none;">&times;</span>'.$error.'</div>';
	}
}
function togoForm_oldInputs($arr,$type){
	// Check if session has value for each input
	$return = isset($arr[$type]) ? $arr[$type] : '';
	return $return;
}

?>
<title>Thanksgiving A La Carte Sides</title>
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
				<img src="/template/images/banners/thanksgiving_sides.jpg"><br />
				<img src="./images/thanksgiving_sides_top.jpg">
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
			<form class="form-inline" action="email_feast.php" onsubmit="return validateForm();" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12 no-padding client-contact-info">
						<div class="form-group col-sm-4 no-padding">
							<label for="turkeybreast" class="font-serif-italic">NAME:<span class="label-required-input">REQUIRED</span></label>
							<input type="text" name="client_name" class="client-contact-input client-name" id="turkeybreast" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'client_name'); ?>" required>
						</div>
						<div class="form-group col-sm-3 no-padding">
							<label for="turkeybreast" class="font-serif-italic">PHONE:<span class="label-required-input">REQUIRED</span></label>
							<input type="text" name="client_phone" class="client-contact-input client-phone" id="turkeybreast" style="height: 23px;" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'client_phone'); ?>" required>
						</div>
						<div class="form-group col-sm-4 no-padding">
							<label for="turkeybreast" class="font-serif-italic">EMAIL:<span class="label-required-input">REQUIRED</span></label>
							<input type="email" name="client_email" class="client-contact-input client-email" id="turkeybreast" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'client_email'); ?>" required>
						</div>
					</div>
				</div>
				
				<div class="row" style="margin-left:-45px;">
					<div class="col-sm-6">
					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Entr&eacute;es: $36 each (Specify Quantity)</div>
								</th>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<!--<input type="text" name="turkey" class="food-qtn-input" id="Turkey" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Turkey');">-->
									<label for="turkey" id="item-label">Oven Roasted Turkey<span class="quantity-span">Sold Out<!--(pre-roasted 6-8 lbs avg.)--></span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="beef" class="food-qtn-input" id="Beef" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Beef');">
									<label for="beef" id="item-label">Prime Rib of Beef<span class="quantity-span">(pre-roasted 5-6 lbs avg.)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="wellington" class="food-qtn-input" id="Wellington" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Wellington');">
									<label for="wellington" id="item-label">Roasted Vegetable Wellington<span class="quantity-span">(you bake 5-6 lbs)</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Salad: $9 (Specify Quantity)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="salad" class="food-qtn-input" id="Salad" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Salad');"></td><td>
									<label for="salad" id="item-label">Roasted Candy Beets and Quinoa Salad with Goat Cheese and Citrus Vinaigrette<span class="quantity-span">(1 lb)</span></label></td></tr></table>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Side Starches: $9 (Specify Quantity)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="sausage" class="food-qtn-input" id="Sausage" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Sausage');">
									<label for="sausage" id="item-label">Autumn Sage and Sausage Stuffing<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="mushroom" class="food-qtn-input" id="Mushroom" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Mushroom');">
									<label for="mushroom" id="item-label">Vegetarian Sage and Mushroom Stuffing<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="yukon" class="food-qtn-input" id="Yukon" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Yukon');">
									<label for="yukon" id="item-label">Creamy Yukon Mashed Potatoes<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="corn" class="food-qtn-input" id="Corn" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Corn');">
									<label for="corn" id="item-label">Cauliflower Mash with Roasted Corn<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="pecan" class="food-qtn-input" id="Pecan" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pecan');"></td><td>
									<label for="pecan" id="item-label">Spiced-Maple Garnet Yams, Pecans <br>and Apricots<span class="quantity-span">(2 lbs)</span></label>
									</td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="herb" class="food-qtn-input" id="Herb" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Herb');">
									<label for="herb" id="item-label">Herb Roasted Potatoes<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Side Vegetables: $9 (Specify Quantity)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="maple" class="food-qtn-input" id="Maple" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Maple');">
									<label for="maple" id="item-label">Maple Roasted Harvest Root Vegetables<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="heirloom" class="food-qtn-input" id="Heirloom" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Heirloom');"></td><td>
									<label for="heirloom" id="item-label">Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze<span class="quantity-span">(2 lbs)</span></label></td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="cheddar" class="food-qtn-input" id="Cheddar" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Cheddar');"></td><td>
									<label for="cheddar" id="item-label">Cheddar Cauliflower Pearls with <br>Roasted Garlic<span class="quantity-span">(2 lbs)</span></label>
									</td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="spinach" class="food-qtn-input" id="Spinach" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Spinach');">
									<label for="spinach" id="item-label">Cream Spinach with Fried Onions<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="sweetcorn" class="food-qtn-input" id="SweetCorn" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('SweetCorn');">
									<label for="sweetcorn" id="item-label">Cream Sweet Corn<span class="quantity-span">(2 lbs)</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					</div>

					<div class="col-sm-6">
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Accompaniments: $6 each (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="cranberry" class="food-qtn-input" id="Cranberry" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Cranberry');">
										<label for="cranberry" id="item-label">Cranberry Orange Relish<span class="quantity-span">(1 lb)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="pan" class="food-qtn-input" id="Pan" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pan');">
										<label for="pan" id="item-label">Rich Pan Turkey Gravy<span class="quantity-span">(1 lb)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="gravy" class="food-qtn-input" id="Gravy" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Gravy');">
										<label for="gravy" id="item-label">Vegetarian Mushroom Gravy<span class="quantity-span">(1 lb)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="balsamic" class="food-qtn-input" id="Balsamic" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Balsamic');">
										<label for="balsamic" id="item-label">Apricot Balsamic Chutney<span class="quantity-span">(1 lb)</span></label>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Bread: $5 each (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="grain" class="food-qtn-input" id="Grain" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Grain');">
										<label for="grain"  id="item-label">Multi Grain Artisan Loaf Bread<span class="quantity-span">(1.5 lbs)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<table><tr><td>
										<input type="text" name="walnut" class="food-qtn-input" id="Walnut" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Walnut');"></td><td>
										<label for="walnut" id="item-label">Cranberry Walnut Orange Cornbread<span class="quantity-span">(2 lbs)</span></label>
										</td></tr></table>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Rolls: $3 each (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="sea" class="food-qtn-input" id="Sea" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Sea');">
										<label for="sea" id="item-label">Sea Salt Soft Rolls<span class="quantity-span">(9 rolls)</span></label>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Dessert: $12 each (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="pudding" class="food-qtn-input" id="Pudding" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pudding');"></td><td>
										<label for="pudding" id="item-label">You Bake Black and White Bread Pudding, Caramel Drizzle</label>
										</td></tr></table>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="blondie" class="food-qtn-input" id="Blondie" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Blondie');"></td><td>
										<label for="blondie" id="item-label">Apple Blondie Bars and Pecan Bar Brownies</label>
										</td></tr></table>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="pies" class="food-qtn-input" id="Pies" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pies');"></td><td>
										<label for="pies" id="item-label">Pumpkin Whoopie Pies, Maple-Spice Filling</label>
										</td></tr></table>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Coffee: $12 (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="grounddecaf" class="food-qtn-input" id="GroundDecaf" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('GroundDecaf');">
										<label for="ground_decaf" id="item-label">Wildcat-Blend Coffee Ground<span class="quantity-span">(Decaf)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="ground" class="food-qtn-input" id="Ground" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Ground');">
										<label for="ground" id="item-label">Wildcat-Blend Coffee Ground<span class="quantity-span">(Regular)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="kcupsdecaf" class="food-qtn-input" id="KcupsDecaf" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('KcupsDecaf');">
										<label for="kcups_decaf" id="item-label">Wildcat-Blend Coffee K-Cups<span class="quantity-span">(Decaf)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="kcups" class="food-qtn-input" id="Kcups" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Kcups');">
										<label for="kcups" id="item-label">Wildcat-Blend Coffee K-Cups<span class="quantity-span">(Regular)</span></label>
									</div>
								</th></tr>
							</tbody>
						</table>
					</div>

					<div class="form-group grand-total">
						<label for="grand_total" class="grand_total"><div id="grand-text">GRAND TOTAL:</div>
						<div>$<span id="grand_total">0</span></div>
						<br>
						<span id="tax-apply">TAXES MAY APPLY</span></label>
					</div>

				</div>

				<div class="row" style="margin-left: -65px; margin-right: -30px;">
					<div class="col-md-12">
						<img src="./images/thanksgiving_sides_bottom.jpg" style="max-width: 100%;" />
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
				
				<!-- <div class="col-sm-12" style="padding-bottom: 15px;">
					<button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button>
				</div> -->
				<div class="col-sm-12" style="padding-bottom: 15px;">

	               <table width="100%" border="0" cellspacing="0" cellpadding="0">

	                 <tbody>

	                              <tr>

	                                <td><span style="font-size:20px; font-weight:bold;">You can also drop off the <a href="/dining/sumc/resources/Thanksgiving_Sides.pdf" target="_blank"><span style="font-size:24px; font-weight:bold; text-decoration: underline; color: red;">PDF ORDER</span></a> at On Deck Deli.</span></td>

	                                <td><button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button>></td>

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

	<script type="text/javascript">
		
		additional_item1 = {Turkey:0,
			Rib:0,
			Pork:0,
			Candied:0,
			Butternut:0,
			MashedPotatoes:0,
			PanGravy:0,
			Yams:0,
			Stuffing:0, 		   
			Cauliflower:0,
			Relish:0,			   
			RootVeg:0,
			Rolls:0,
			ApplePie:0,
			PumpkinPie:0,
			Pecan:0,
			Coffee:0};

		additional_item = {
			Turkey: 0,
			Beef: 0,
			Wellington: 0,
			Salad: 0,
			Sausage: 0,
			Mushroom: 0,
			Yukon: 0,
			Corn: 0,
			Pecan: 0,
			Herb: 0,
			Maple: 0,
			Heirloom: 0,
			Cheddar: 0,
			Spinach: 0,
			SweetCorn: 0,
			Cranberry: 0,
			Pan: 0,
			Gravy: 0,
			Balsamic: 0,
			Grain: 0,
			Walnut: 0,
			Sea: 0,
			Pudding: 0,
			Blondie: 0,
			Pies: 0,
			GroundDecaf: 0,
			Ground: 0,
			KcupsDecaf: 0,
			Kcups: 0
		};

			function changeGrandTotal(type){
				current_grandTotal = Number(document.getElementById('grand_total').innerHTML);
				input_quantity = document.getElementById(type).value;
				if (isNaN(input_quantity)) {
					changeGrandTotal(type);
				}
				type_quantity = Number(input_quantity);

				if(type_quantity < 0) {
					type_quantity = 0;
				}
				qnt_diff = type_quantity - additional_item[type];

				switch(type) {
					case 'Turkey':
						current_grandTotal = current_grandTotal + qnt_diff*36;
						break;
					case 'Beef':
						current_grandTotal = current_grandTotal + qnt_diff*36;
						break;
					case 'Wellington':
						current_grandTotal = current_grandTotal + qnt_diff*36;
						break;
					case 'Salad':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Sausage':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Mushroom':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Yukon':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Corn':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Pecan':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Herb':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Maple':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Heirloom':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Cheddar':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Spinach':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'SweetCorn':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Cranberry':
						current_grandTotal = current_grandTotal + qnt_diff*6;
						break;
					case 'Pan':
						current_grandTotal = current_grandTotal + qnt_diff*6;
						break;
					case 'Gravy':
						current_grandTotal = current_grandTotal + qnt_diff*6;
						break;
					case 'Balsamic':
						current_grandTotal = current_grandTotal + qnt_diff*6;
						break;
					case 'Grain':
						current_grandTotal = current_grandTotal + qnt_diff*5;
						break;
					case 'Walnut':
						current_grandTotal = current_grandTotal + qnt_diff*5;
						break;
					case 'Sea':
						current_grandTotal = current_grandTotal + qnt_diff*3;
						break;
					case 'Pudding':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'Blondie':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'Pies':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'GroundDecaf':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'Ground':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'KcupsDecaf':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'Kcups':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
				}
				additional_item[type] = type_quantity;

				document.getElementById('grand_total').innerHTML = current_grandTotal;
			}

			function onselectChangeGrandTotal(type){
				var e = document.getElementById(type);
				var selectedValue = e.options[e.selectedIndex].value;

				current_grandTotal = Number(document.getElementById('grand_total').innerHTML);
				type_quantity = Number(selectedValue);
				qnt_diff = type_quantity - additional_item[type];

				switch(type) {
					case '1Relish1':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case '1Rolls1':
					current_grandTotal = current_grandTotal + qnt_diff*3;
					break;
					case '1Coffee1':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
				}

				additional_item[type] = type_quantity;
				document.getElementById('grand_total').innerHTML = current_grandTotal;
			}

			function validateForm() {
				var sum = 0;

				for(item in additional_item) {
					sum += additional_item[item];
				}

				if(sum <= 0) {
					alert("You must select, at least, one item.");
					return false;
				}

				return true;
			}

		</script>


		<?php

		unset($_SESSION['togoForm_errors']);
		unset($_SESSION['togoForm_old_inputs']);
		?>

