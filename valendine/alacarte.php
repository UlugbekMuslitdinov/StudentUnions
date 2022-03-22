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
<title>A La Carte Sides</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="StyleSheet" href="/template/global.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/valendine/css/alacarte.css">
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
				<img src="/template/images/banners/ALaCarteHeader.png"><br />
				<!-- <img src="./images/thanksgiving_sides_top.jpg"> -->
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
			<form class="form-inline" action="alacarte_submit.php" onsubmit="return validateForm();" method="POST" enctype="multipart/form-data">
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
								<div style="text-transform:uppercase; color:#fff;">Entr&eacute;es: $20 each</div>
								</th>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="Bean" class="food-qtn-input" id="Bean" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Bean');"></td><td>
									<label for="turkey" id="item-label">Sweet and Smoky Tri Tip, Black Bean<br> Relish<span class="quantity-span">(18 oz)</span></label></td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="Chicken" class="food-qtn-input" id="Chicken" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Chicken');">
									<label for="beef" id="item-label">Chicken Ricotta Tortellini Pasta<span class="quantity-span">(18 oz)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="Lentil" class="food-qtn-input" id="Lentil" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Lentil');">
									<label for="wellington" id="item-label">Lentil Fritter, Apricot Balsamic Chutney<span class="quantity-span">(18 oz)</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Appetizer course: $9 each</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="Beef" class="food-qtn-input" id="Beef" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Beef');"></td><td>
									<label for="salad" id="item-label">Mini Beef Wellingtons with Mustard<br> Apricot Glaze<span class="quantity-span">(6 each)</span></label></td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="Moon" class="food-qtn-input" id="Moon" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Moon');"></td><td>
									<label for="salad" id="item-label">Purple Moon White Cheddar, Sea Salt Crackers and Dates<span class="quantity-span">(6 oz)</span></label></td></tr></table>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Salad course: $9 each</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="Salad" class="food-qtn-input" id="Salad" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Salad');"></td><td>
									<label for="salad" id="item-label">Spinach, Tangerines, Strawberries, Goat Cheese, Almonds, Quinoa, Honey Lime Vinaigrette<span class="quantity-span">(12 oz)</span></label></td></tr></table>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Side Starches: $7 each</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="Yukon" class="food-qtn-input" id="Yukon" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Yukon');">
									<label for="sausage" id="item-label">Creamy Yukon Mashed Potatoes<span class="quantity-span">(10 oz)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="Potatoes" class="food-qtn-input" id="Potatoes" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Potatoes');">
									<label for="mushroom" id="item-label">Herb Roasted Potatoes<span class="quantity-span">(10 oz)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="Turmeric" class="food-qtn-input" id="Turmeric" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Turmeric');">
									<label for="yukon" id="item-label">Turmeric Rice and Herbs<span class="quantity-span">(10 oz)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="Orzo" class="food-qtn-input" id="Orzo" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Orzo');">
									<label for="corn" id="item-label">Roasted Pepper Orzo and Kalamata Olives<span class="quantity-span">(10 oz)</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Side Vegetables: $7 each</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group"><table><tr><td>
									<input type="text" name="Mushroom" class="food-qtn-input" id="Mushroom" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Mushroom');"></td><td>
									<label for="maple" id="item-label">Cremini Mushroom and Lip Stick Pepper<br> Ragout<span class="quantity-span">(8 oz)</span></label></td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="Tikka" class="food-qtn-input" id="Tikka" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Tikka');"></td><td>
									<label for="heirloom" id="item-label">Tikka Marsala Cauliflower Rice<span class="quantity-span">(8 oz)</span></label></td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="Edamame" class="food-qtn-input" id="Edamame" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Edamame');"></td><td>
									<label for="cheddar" id="item-label">Edamame Succotash<span class="quantity-span">(8 oz)</span></label>
									</td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="Broccoli" class="food-qtn-input" id="Broccoli" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Broccoli');">
									<label for="spinach" id="item-label">Roasted Broccoli with Lemon Oil<span class="quantity-span">(8 oz)</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="SweetCorn" class="food-qtn-input" id="SweetCorn" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('SweetCorn');">
									<label for="sweetcorn" id="item-label">Cream Sweet Corn<span class="quantity-span">(8 oz)</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					</div>

					<div class="col-sm-6">
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Accompaniments: $4 each</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="Relish" class="food-qtn-input" id="Relish" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Relish');">
										<label for="cranberry" id="item-label">Black Bean Relish<span class="quantity-span">(8 oz)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="Ragout" class="food-qtn-input" id="Ragout" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Ragout');">
										<label for="pan" id="item-label">Tomato Ragout<span class="quantity-span">(8 oz)</span></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="Apricot" class="food-qtn-input" id="Apricot" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Apricot');">
										<label for="gravy" id="item-label">Apricot Balsamic Chutney<span class="quantity-span">(4 oz)</span></label>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Rolls: $2 each</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="Brioche" class="food-qtn-input" id="Brioche" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Brioche');">
										<label for="grain"  id="item-label">Mini Brioche Loaves</label>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Dessert: $9 each</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="Pudding" class="food-qtn-input" id="Pudding" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pudding');">
										<label for="sea" id="item-label">You Bake Sticky Toffee Pudding</label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="Brownies" class="food-qtn-input" id="Brownies" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Brownies');">
										<label for="sea" id="item-label">Flourless Chocolate Brownies</label>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Dipped fruit: $6 each</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="Strawberries" class="food-qtn-input" id="Strawberries" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Strawberries');"></td><td>
										<label for="pudding" id="item-label">Chocolate Covered Strawberries</label>
										</td></tr></table>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Coffee: $12 each</div>
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
						<!-- <img src="./images/thanksgiving_sides_bottom.jpg" style="max-width: 100%;" /> -->
					</div>
				</div>
				
				<div> <!-- Payment options -->
					<table style="width: 100%;">
						<tr>
							<td width="18%"><span style="font-size:16px;">Payment Option:</span><span style="font-size:25px;color:red;">*</span></td>
							<td width="82%">
								<input type="radio" value="1" name="payment" id="card" style="height:15px;width:15px; margin-bottom:10px;" value="CREDIT CARD / DEBIT CARD" required />&nbsp;<label for="card" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">CREDIT CARD / DEBIT CARD</label>&nbsp;&nbsp;
								<input type="radio" value="2" name="payment" id="meal_plan" style="height:15px;width:15px; margin-bottom:10px;" value="MEAL PLAN" required />&nbsp;<label for="meal_plan" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">MEAL PLAN</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" value="3" name="payment" id="other_payment" style="height:15px;width:15px; margin-bottom:10px;" value="OTHER PAYMENT METHOD" required />&nbsp;<label for="other_payment" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">Other</label>
							</td>
						</tr>
					</table>
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

	                                <td><span style="font-size:20px; font-weight:bold;">You can also drop off the <a href="/valendine/resources/ALaCarte.pdf" target="_blank"><span style="font-size:24px; font-weight:bold; text-decoration: underline; color: red;">PDF ORDER</span></a> at On Deck Deli.</span></td>

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
			Bean: 0,
			Chicken: 0,
			Lentil: 0,
			Beef: 0,
			Moon: 0,
			Salad: 0,
			Yukon: 0,
			Potatoes: 0,
			Turmeric: 0,
			Orzo: 0,
			Mushroom: 0,
			Tikka: 0,
			Edamame: 0,
			Broccoli: 0,
			SweetCorn: 0,
			Relish: 0,
			Ragout: 0,
			Apricot: 0,
			Brioche: 0,
			Pudding: 0,
			Walnut: 0,
			Brownies: 0,
			Pudding: 0,
			Strawberries: 0,
			Pumpkin: 0,
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
					case 'Bean':
						current_grandTotal = current_grandTotal + qnt_diff*20;
						break;
					case 'Chicken':
						current_grandTotal = current_grandTotal + qnt_diff*20;
						break;
					case 'Lentil':
						current_grandTotal = current_grandTotal + qnt_diff*20;
						break;
					case 'Beef':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Moon':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Salad':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Yukon':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Potatoes':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Turmeric':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Orzo':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Mushroom':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Tikka':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Edamame':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Broccoli':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'SweetCorn':
						current_grandTotal = current_grandTotal + qnt_diff*7;
						break;
					case 'Relish':
						current_grandTotal = current_grandTotal + qnt_diff*4;
						break;
					case 'Ragout':
						current_grandTotal = current_grandTotal + qnt_diff*4;
						break;
					case 'Apricot':
						current_grandTotal = current_grandTotal + qnt_diff*4;
						break;
					case 'Brioche':
						current_grandTotal = current_grandTotal + qnt_diff*2;
						break;
					case 'Pudding':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Brownies':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Strawberries':
						current_grandTotal = current_grandTotal + qnt_diff*6;
						break;
					case 'Pumpkin':
						current_grandTotal = current_grandTotal + qnt_diff*6;
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

