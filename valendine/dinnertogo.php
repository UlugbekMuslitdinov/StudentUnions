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

$menu = array(
	'Stuffing' => array('label' => 'Autumn Sage and Sausage Stuffing',
		'quantity' => '2 lbs.',
		'price' => 8),
	'Mashed Potatoes' => array('label' => 'Creamy Yukon Mashed Potatoes',
		'quantity' => '4 lbs.',
		'price' => 8),
	'Yams' => array('label' => 'Spiced-Maple Yams, Pecan and Apricot',
		'quantity' => '2 lbs.',
		'price' => 8),
	'Roasted Cauliflower' => array('label' => 'Roasted Tri-Color Cauliflower',
		'quantity' => '2 lbs.',
		'price' => 8),
	'Root Vegetables' => array('label' => 'Medley of Root  Vegtables',
		'quantity' => '2 lbs.',
		'price' => 5),
	'Relish' => array('label' => 'Cranberry Orange Relish',
		'quantity' => '16 oz.',
		'price' => 8),
	'Rolls' => array('label' => 'Classic Wheat and Oat Pull-a-Part Rolls',
		'quantity' => '9 rolls',
		'price' => 3),
	'Wildcat Coffee' => array('label' => 'Wildcat-Blend Coffee Package (Pre-ground)',
		'quantity' => '1/2 lb.',
		'price' => 12)
);

?>
<title>Valentine Dinner To-Go</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="StyleSheet" href="/template/global.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/valendine/css/dinnertogo.css">
<style>
.error-message {
	font-size: 16px;
	font-weight: bold;
	color: red;
	background-color: yellow;
	padding: 5px;
}
</style>

<body class="togo_order">
	<div class="container" id="">
		<div class="row">
			<div class="col-sm-12 tgo-header no-padding">
				<img src="/template/images/banners/DinnerToGoHeaders.png"><br />
				<!-- <img src="./thanksgiving_top.jpg"> -->



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
			<form class="form-inline" action="dinnertogo_submit.php" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-sm-12 no-padding client-contact-info">
						<div class="form-group col-sm-4 no-padding">
							<label for="turkeybreast" class="font-serif-italic">NAME:<span class="label-required-input">REQUIRED</span></label>
							<input type="text" name="client_name" class="client-contact-input client-name" id="turkeybreast" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'client_name'); ?>" required>
						</div>
						<div class="form-group col-sm-3 no-padding">
							<label for="turkeybreast" class="font-serif-italic">PHONE:<span class="label-required-input">REQUIRED</span></label>
							<input type="text" name="client_phone" class="client-contact-input client-phone" id="turkeybreast" style="height: 23px;" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'client_phone'); ?>" required>
						</div>
						<div class="form-group col-sm-4 no-padding">
							<label for="turkeybreast" class="font-serif-italic">EMAIL:<span class="label-required-input">REQUIRED</span></label>
							<input type="email" name="client_email" class="client-contact-input client-email" id="turkeybreast" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'client_email'); ?>" required>
						</div>
					</div>
				</div>



				<div class="row" style="margin-left:-45px;">
					<div class="col-sm-7">
					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Dinner Selection (SELECT ONE)</div>
								<!-- <span style="font-size:10.5px;">*Turkey, Prime Rib of Beef, and Pork Loin weight pre-cooked. NOTE: No Substitutions Please.</span></th> -->
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="turkey"><input type="radio" name="dinner" value="Sweet and Smoky Tri Tip, Black Bean Relish" id="turkey"> Sweet and Smoky Tri Tip, Black Bean Relish<!-- <span class="quantity-span">10-13 lbs. avg. (1 ea), Pre-Roasted *</span> --></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="rib"><input type="radio" name="dinner" value="Chicken Ricotta Tortellini Pasta" id="rib"> Chicken Ricotta Tortellini Pasta<!-- <span class="quantity-span">5-6 lbs., Pre-Roasted *</span> --></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pork"><input type="radio" name="dinner" value="Lentil Fritter, Apricot Balsamic Chutney" id="pork"> Lentil Fritter, Apricot Balsamic Chutney<!-- <span class="quantity-span">5-7 lbs., Pre-Roasted *</span> --></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Appetizer Course (Select one)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="salad"><input type="radio" name="appetizer" value="Mini Beef Wellingtons with Mustard Apricot Glaze" id="turkey"> Mini Beef Wellingtons with Mustard Apricot Glaze<!-- <span style="float:right">(16 oz.)<span> --></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="squash"><input type="radio" name="appetizer" value="Purple Moon White Cheddar, Sea Salt Crackers and Dates" id="turkey"> Purple Moon White Cheddar, Sea Salt Crackers and Dates<!-- <span style="float:right">(16 oz.)</span> --></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Salad Course (INCLUDED)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row"><div class="wrap-menu-list"><div class="form-group">
								<label for="salads"><i>Spinach, Tangerines, Strawberries, Goat Cheese, Almonds, Quinoa, Honey Lime Vinaigrette</i></label>
							<!-- <?php
							$print = '';
							foreach ($menu as $key => $value) {
								$print = ''.
								''.
								'<label for="'.$key.'">'.$menu[$key]['label'];

								//$print .= '<span class="quantity-span">'.$menu[$key]['quantity'].'</span>';

								$print .= '';

								echo $print;
								}
							?> -->
							</label></div></div></th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Starch Selection (SELECT TWO)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="applepie"><input type="checkbox" class="limit_two" name="starch[]" value="Creamy Yukon Mashed Potatoes" id="applepie"> Creamy Yukon Mashed Potatoes</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pecan"><input type="checkbox" class="limit_two" name="starch[]" value="Herb Roasted Potatoes" id="pecan"> Herb Roasted Potatoes</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pumpkinpie"><input type="checkbox" class="limit_two" name="starch[]" value="Turmeric Rice and Herbs" id="pumpkinpie"> Turmeric Rice and Herbs</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pumpkinpie"><input type="checkbox" class="limit_two" name="starch[]" value="Roasted Pepper Orzo and Kalamata Olives" id="pumpkinpie"> Roasted Pepper Orzo and Kalamata Olives</label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Side Vegetables (SELECT TWO)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="applepie"><input type="checkbox" class="limit_two" name="vegetables[]" value="Cremini Mushroom and Lip Stick Pepper Ragout" id="applepie"> Cremini Mushroom and Lip Stick Pepper Ragout</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pecan"><input type="checkbox" class="limit_two" name="vegetables[]" value="Tikka Marsala Cauliflower Rice" id="pecan"> Tikka Marsala Cauliflower Rice</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pumpkinpie"><input type="checkbox" class="limit_two" name="vegetables[]" value="Edamame Succotash" id="pumpkinpie"> Edamame Succotash</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pumpkinpie"><input type="checkbox" class="limit_two" name="vegetables[]" value="Roasted Broccoli with Lemon Oil" id="pumpkinpie"> Roasted Broccoli with Lemon Oil</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pumpkinpie"><input type="checkbox" class="limit_two" name="vegetables[]" value="Cream Sweet Corn" id="pumpkinpie"> Cream Sweet Corn</label>
								</div>
							</th></tr>
						</tbody>
					</table>

					</div>

					<div class="col-sm-5">
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Bread (Included)</div>
								</tr></thead>
								<tbody>

									<tr><th scope="row"><div class="form-group">
										<label for="salads"><i>Mini Brioche Loaves</i></label>
										<!-- <label for="" style="margin-bottom: -10px;">Oven Roasted Turkey: $36</label> -->
									</div></th></tr>

							</tbody>
						</table>


						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Dessert (Select one)</div>
								</tr></thead>
								<tbody>

									<tr><th scope="row"><div class="form-group">
										<label for="pumpkinpie"><input type="radio" name="dessert" value="You Bake Sticky Toffee Pudding - Butter Cake Smothered in Sticky Toffee Caramel Sauce" id="pumpkinpie"> You Bake Sticky Toffee Pudding - Butter Cake Smothered in Sticky Toffee Caramel Sauce</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<label for="pumpkinpie"><input type="radio" name="dessert" value="Chocolate Covered Strawberries - Four  Strawberries Covered in Dark Chocolate  Drizzled with White Chocolate" id="pumpkinpie"> Chocolate Covered Strawberries - Four  Strawberries Covered in Dark Chocolate  Drizzled with White Chocolate</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<label for="pumpkinpie"><input type="radio" name="dessert" value="Flourless Chocolate Brownies - Whipped  Cream, Raspberry Sauce" id="pumpkinpie"> Flourless Chocolate Brownies - Whipped  Cream, Raspberry Sauce</label>
									</div></th></tr>

							</tbody>
						</table>
					</div>

					<div class="form-group grand-total">
						<label for="grand_total" class="grand_total"><div id="grand-text">GRAND TOTAL:</div>
						<div>$<span id="grand_total">59</span></div>
						<br>
						<span id="tax-apply">TAXES MAY APPLY</span></label>
					</div>

				</div>

				<div class="row" style="margin-left: -65px;">
					<div class="col-md-12">
						<!-- <img src="./thanksgiving_bottom.jpg" /> -->
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
				<?php
// Error Message:
if( isset($_SESSION['togoForm_errors']) ){
// Make sure session carries data
	if ( count($_SESSION['togoForm_errors']) != 0 ){
		$echo_err = '<div class="error-message"> <b>Form Submit Error</b> : <ul style="list-style-type:none;">';
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
				<!--<div class="col-sm-12" style="padding-bottom: 15px;">
					<button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button>
				</div>-->
		
<br>
				<div>
					<table style="width: 100%;">
						<tr>
							<td width="18%"><b><span style="font-size:16px; margin-bottom:20px;">Payment Option:</span></b><span style="font-size:25px;color:red;">*</span></td>
							<td width="82%">
								<input type="radio" value="1" name="payment" id="card" style="height:15px;width:15px; margin-bottom:10px;" value="CREDIT CARD / DEBIT CARD" required />&nbsp;<label for="card" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">CREDIT CARD / DEBIT CARD</label>&nbsp;&nbsp;
								<input type="radio" value="2" name="payment" id="meal_plan" style="height:15px;width:15px; margin-bottom:10px;" value="MEAL PLAN" required />&nbsp;<label for="meal_plan" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">MEAL PLAN</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" value="3" name="payment" id="other_payment" style="height:15px;width:15px; margin-bottom:10px;" value="OTHER PAYMENT METHOD" required />&nbsp;<label for="other_payment" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">Other</label>
							</td>
						</tr>
					</table>
				</div>
				<br>
				
				<div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <td></td>
						  <td><span class="sh-right" style="padding: 0; width: 100%;">
						<!--<input id="button-submit" type="submit" value="SUBMIT"/>-->
					    <button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button>
					</span></td>
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

		additional_item = {Turkey:0,
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

			function changeGrandTotal(type){
				current_grandTotal = Number(document.getElementById('grand_total').innerHTML);
				input_quantity = document.getElementById(type).value;
				if (isNaN(input_quantity)) {
					changeGrandTotal(type);
				}
				type_quantity = Number(input_quantity);
				qnt_diff = type_quantity - additional_item[type];

				switch(type) {
					case 'Turkey':
					current_grandTotal = current_grandTotal + qnt_diff*36;
					break;
					case 'Rib':
					current_grandTotal = current_grandTotal + qnt_diff*36;
					break;
					case 'Pork':
					current_grandTotal = current_grandTotal + qnt_diff*35;
					break;
					case 'Candied':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Butternut':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'MashedPotatoes':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'PanGravy':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Yams':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Stuffing':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Cauliflower':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Relish':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
					case 'RootVeg':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Rolls':
					current_grandTotal = current_grandTotal + qnt_diff*3;
					break;
					case 'Coffee':
					current_grandTotal = current_grandTotal + qnt_diff*12;
					break;
					case 'ApplePie':
					current_grandTotal = current_grandTotal + qnt_diff*11;
					break;
					case 'PumpkinPie':
					current_grandTotal = current_grandTotal + qnt_diff*11;
					break;
					case 'Pecan':
					current_grandTotal = current_grandTotal + qnt_diff*11;
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

		</script>


		<?php

		unset($_SESSION['togoForm_errors']);
		unset($_SESSION['togoForm_old_inputs']);
		?>

