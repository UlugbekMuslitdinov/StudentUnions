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
<title>Thanksgiving Feast To-Go</title>
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
				<img src="./thanksgiving_top.jpg">
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
			<form class="form-inline" action="email_feast.php" method="POST" enctype="multipart/form-data">
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
					<div class="col-sm-7">
					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Entr&eacute;es (SELECT ONE)</div>
								<span style="font-size:10.5px;">*Turkey, Prime Rib of Beef, and Pork Loin weight pre-cooked. NOTE: No Substitutions Please.</span></th>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="turkey"><input type="radio" name="entreechoice" value="Oven Roasted Tom Turkey" id="turkey" checked> Oven Roasted Tom Turkey<span class="quantity-span">10-13 lbs. avg. (1 ea), Pre-Roasted *</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="rib"><input type="radio" name="entreechoice" value="Prime Rib of Beef" id="rib"> Prime Rib of Beef<span class="quantity-span">5-6 lbs., Pre-Roasted *</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pork"><input type="radio" name="entreechoice" value="Peppered Pork Loin" id="pork"> Peppered Pork Loin<span class="quantity-span">5-7 lbs., Pre-Roasted *</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">STARTER (INCLUDED)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="salad">Roasted Candied Beets Salad with Goat Cheese and Pumpkin Seeds <span style="float:right">(16 oz.)<span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="squash">Roasted Butternut Squash, Roasted Red Pepper, Quinoa, Arugula and White Balsamic Vinaigrette<span style="float:right">(16 oz.)</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SIDES (INCLUDED)</div>
							</tr></thead>
						<tbody>
							<?php
							$print = '';
							foreach ($menu as $key => $value) {
								$print = '<tr><th scope="row"><div class="wrap-menu-list">'.
								'<div class="form-group">'.
								'<label for="'.$key.'">'.$menu[$key]['label'];

								$print .= '<span class="quantity-span">'.$menu[$key]['quantity'].'</span>';										

								$print .= '</label></div></div></th></tr>';

								echo $print;
								}
							?>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">DESSERT (SELECT ONE)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="applepie"><input type="radio" name="piechoice" value="Sour Cream Apple Pie" id="applepie" checked> Sour Cream Apple Pie</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pecan"><input type="radio" name="piechoice" value="Sweet Pecan Bars" id="pecan"> Sweet Pecan Bars</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pumpkinpie"><input type="radio" name="piechoice" value="Classic Pumpkin Pie, Chantilly Cream" id="pumpkinpie"> Classic Pumpkin Pie, Chantilly Cream</label>
								</div>
							</th></tr>
						</tbody>
					</table>

					</div>

					<div class="col-sm-5">
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">A LA CARTE (SPECIFY QUANTITY)</div>
								</tr></thead>
								<tbody>
				
									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_turkey" class="food-qtn-input" id="Turkey" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Turkey');">
										<label for="" style="margin-bottom: -10px;">Oven Roasted Turkey: $36</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_rib" class="food-qtn-input" id="Rib" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_rib'); ?>" onkeyup="changeGrandTotal('Rib');">
										<label for="" style="margin-bottom: -10px;">Prime Rib of Beef: $36</label>
									</div></th></tr>
									
									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_pork" class="food-qtn-input" id="Pork" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_pork'); ?>" onkeyup="changeGrandTotal('Pork');">
										<label for="" style="margin-bottom: -10px;">Peppered Pork Loin: $35</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_candied" class="food-qtn-input" id="Candied" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_candied'); ?>" onkeyup="changeGrandTotal('Candied');">
										<label for="" style="margin-bottom: -10px;">Roasted Beets Salad with <br>Goat Cheese: $8</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_butternut" class="food-qtn-input" id="Butternut" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_candied'); ?>" onkeyup="changeGrandTotal('Butternut');">
										<label for="" style="margin-bottom: -10px;">Roasted Butternut Squash <br>Quinoa Salad: $8</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_stuffing" class="food-qtn-input" id="Stuffing" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_stuffing'); ?>" onkeyup="changeGrandTotal('Stuffing');">
										<label for="" style="margin-bottom: -10px;">Autumn Sage & Sausage Stuffing: $8</label>
									</div></th></tr>
									
									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_mashedpotatoes" class="food-qtn-input" id="MashedPotatoes" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_mashedpotatoes'); ?>" onkeyup="changeGrandTotal('MashedPotatoes');">
										<label for="" style="margin-bottom: -10px;">Yukon Mashed Potatoes: $8</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_yams" class="food-qtn-input" id="Yams" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_yams'); ?>" onkeyup="changeGrandTotal('Yams');">
										<label for="" style="margin-bottom: -10px;">Spiced-Maple Yams,<br> Pecan & Apricot: $8</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_cauliflower" class="food-qtn-input" id="Cauliflower" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_caulifower'); ?>" onkeyup="changeGrandTotal('Cauliflower');">
										<label for="" style="margin-bottom: -10px;">Roasted Cauliflower: $8</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_rootveg" class="food-qtn-input" id="RootVeg" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_rootveg'); ?>" onkeyup="changeGrandTotal('RootVeg');">
										<label for="" style="margin-bottom: -10px;">Medley of Root Vegetables: $8</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_relish" class="food-qtn-input" id="Relish" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_relish'); ?>" onkeyup="changeGrandTotal('Relish');">
										<label for="" style="margin-bottom: -10px;">Orange Cranberry Relish: $6</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_rolls" class="food-qtn-input" id="Rolls" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_rolls'); ?>" onkeyup="changeGrandTotal('Rolls');">
										<label for="" style="margin-bottom: -10px;">Classic House Rolls (9 ea): $3</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_pangravy" class="food-qtn-input" id="PanGravy" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_pangravy'); ?>" onkeyup="changeGrandTotal('PanGravy');">
										<label for="" style="margin-bottom: -10px;">Pan Gravy: $8</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_applepie" class="food-qtn-input" id="ApplePie" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_applepie'); ?>" onkeyup="changeGrandTotal('ApplePie');">
										<label for="" style="margin-bottom: -10px;">Sour Cream Apple Pie: $11</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_pecan" class="food-qtn-input" id="Pecan" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_pecan'); ?>" onkeyup="changeGrandTotal('Pecan');">
										<label for="" style="margin-bottom: -10px;">Sweet Pecan Bars: $11</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_pumpkinpie" class="food-qtn-input" id="PumpkinPie" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_pumpkinpie'); ?>" onkeyup="changeGrandTotal('PumpkinPie');">
										<label for="" style="margin-bottom: -10px;">Classic Pumpkin Pie: $11</label>
									</div></th></tr>

									<tr><th scope="row"><div class="form-group">
										<input type="text" name="additional_coffee" class="food-qtn-input" id="Coffee" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_coffee'); ?>" onkeyup="changeGrandTotal('Coffee');">
										<label for="" style="margin-bottom: -10px;">Wildcat-Blend Coffee: $12</label>
									</div></th></tr>

							</tbody>
						</table>
					</div>

					<div class="form-group grand-total">
						<label for="grand_total" class="grand_total"><div id="grand-text">GRAND TOTAL:</div>
						<div>$<span id="grand_total">78</span></div>
						<br>
						<span id="tax-apply">TAXES MAY APPLY</span></label>
					</div>

				</div>

				<div class="row" style="margin-left: -65px;">
					<div class="col-md-12">
						<img src="./thanksgiving_bottom.jpg" />
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
					<button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button>
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

