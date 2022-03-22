<?php
// session_start();

$togoForm_oldInputs = array();
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
	'Watergate Salad' => array('label' => 'Watergate Salad',
		'quantity' => '1 qt.',
		'price' => 6),
	'Ancient Grain Salad' => array('label' => 'Roasted Pear, Cranberry and Almond Ancient Grain Salad',
		'quantity' => '16 oz.',
		'price' => 8),
	'Dressing' => array('label' => 'Sage and Sausage Dressing',
		'quantity' => '2 lbs.',
		'price' => 8),
	'Yams' => array('label' => 'Spiced-Maple Yams, Pecans and Apricot',
		'quantity' => '2 lbs.',
		'price' => 8),
	'Potatoes' => array('label' => 'Yukon Mashed Potatoes',
		'quantity' => '4 lb.',
		'price' => 8),
	'Gravy' => array('label' => 'Pan Gravy',
		'quantity' => '1 qt.',
		'price' => 8),
	'Vegetables' => array('label' => 'Medley of Fall Vegtables',
		'quantity' => '2 lbs.',
		'price' => 8),
	'Corn' => array('label' => 'Cream Corn (roasted corn kernels)',
		'quantity' => '2 lbs.',
		'price' => 8),
	'Relish' => array('label' => 'Orange Cranberry Relish',
		'quantity' => '16 oz.',
		'price' => 6),
	'Rolls' => array('label' => 'Parker House Rolls',
		'quantity' => '9 rolls',
		'price' => 6),
	'Coffee' => array('label' => 'Wildcat-Blend Coffee Package (Pre-ground)',
		'quantity' => '1/2 lb.',
		'price' => 6)
);

?>
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
				<img src="/dining/sumc/images/Header.png">
				<p class="header-text">Enjoy your Thanksgiving - let us do the cooking!</p>
			</div>

			<div class="col-sm-12 order-form">
				<form class="form-inline" action="email_turkeyTogo.php" method="POST" enctype="multipart/form-data">
					<div class="col-sm-8 form-left no-padding">
						<p class="form-header">Your complete feast for 8 includes:<br>
						</p>
						<p class="form-subheader">Your Choice of Oven Roasted Tom Turkey OR Prime Rib of Beef</p>

						<!-- <div class="wrap-menu-list"> -->
							<!-- START Add entree choice for either Turkey or Prime Rib -->
							<div class="your-choice-of">Your choice of:</div>
							<div class="wrap-menu-list pie">
								<div class="form-group">
									<input type="radio" name="entreechoice" value="Oven Roasted Tom Turkey" id="turkey" checked>
									<label for="turkey">Oven Roasted Tom Turkey
										<span class="dots"> .  .  .  .  .  .  . . . . . . . . . . . . . . . . . . .  . . . . . . . . . . . . . . . .  . . . . . . </span>
										<span class="quantity-span">13 lbs. avg. (1 ea), Pre-Roasted*</span>
									</label>
								</div>
							</div>
							<div class="wrap-menu-list pie">
								<div class="form-group">
									<input type="radio" name="entreechoice" value="Prime Rib of Beef" id="rib">
									<label for="rib">Prime Rib of Beef
										<span class="dots"> .  .  .  .  .  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .  .  </span>
										<span class="quantity-span">5-7 lbs., Pre-Roasted*</span>
									</label>
								</div>
							</div>
							<!-- END Entree choices -->

							<?php
							$print = '';
							foreach ($menu as $key => $value) {

								$print = '<div class="wrap-menu-list">'.
								'<div class="form-group">'.
								'<label for="'.$key.'">'.$menu[$key]['label'];

							// Print dots
								$line_leng = 70;
								$label_leng = strlen($menu[$key]['label']);
								$quantity_leng = strlen($menu[$key]['quantity']);
								$dot_leng = $line_leng - $label_leng - $quantity_leng;

								$print .= "<span class='dots'> ";
								for ($i=0; $i < ($dot_leng); $i++) { 
									$print .= " . ";
								}
								$print .= '</span>';

								$print .= '<span class="quantity-span">'.$menu[$key]['quantity'].'</span>';										

								$print .= '</label></div></div>';

								echo $print;

							}
							?>

							<!-- </div> -->

							<div class="your-choice-of">Your choice of:</div>
							<div class="wrap-menu-list pie">
								<div class="form-group">
									<input type="radio" name="piechoice" value="Cinnamon Streusel Apple Pie" id="cinamonpie" checked>
									<label for="cinamonpie">Cinnamon Streusel Apple Pie
										<span class="dots"> .  .  .  .  .  .  . . . . . . . . . . . . . . . . . . .  . . . . . . . . . . . . . . . .  . . . </span>
										<span class="quantity-span">1 pie</span>
									</label>
								</div>
							</div>
							<div class="wrap-menu-list pie">
								<div class="form-group">
									<input type="radio" name="piechoice" value="Classic Pumpkin Pie, Chantilly Cream" id="classicpie">
									<label for="classicpie">Classic Pumpkin Pie with Chantilly Cream
										<span class="dots"> .  .  .  .  .  . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .  .  </span>
										<span class="quantity-span">1 pie</span>
									</label>
								</div>
							</div>

						</div>

						<div class="col-sm-4 form-right">
							<p class="form-right-header">You may also order Additional Individual Items for Larger Parties:</p>

							<!-- START Add entree choice -->
							<div class="form-group add-pie">
								<input type="text" name="additional_turkey" class="food-qtn-input" id="Turkey" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Turkey');">
								<label for="">Roasted Turkey: $35</label>
							</div>
							<div class="form-group">
								<input type="text" name="additional_rib" class="food-qtn-input" id="Rib" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_rib'); ?>" onkeyup="changeGrandTotal('Rib');">
								<label for="">Prime Rib of Beef: $35</label>
							</div>
							<!-- END entree choice -->

							<?php
							$print = '';
							foreach ($menu as $key => $value) {
							// Remove white space for javascript id
								$key_id = preg_replace('/\s+/', '', $key);
								$oldInput = togoForm_oldInputs($togoForm_old_inputs,$key_id);
								$print = '<div class="form-group">';
								if ($key == 'Relish'){
									$print .= '<select class="food-qtn-input" name="'.$key_id.'" id="'.$key_id.'" onchange="onselectChangeGrandTotal(\''.$key_id.'\');">'.
									'<option value="0">0</option>'.
									'<option value="1">16 oz</option>'.
									'<option value="2">32 oz</option>'.
									'<option value="3">48 oz</option>'.
									'<option value="4">64 oz</option>'.
									'</select>'.
									'<label for="'.$key.'">'.$key.': $'.$menu[$key]['price'].'</label>';
								}else if ($key == 'Rolls'){
									$print .= '<select class="food-qtn-input" name="'.$key_id.'" id="'.$key_id.'" onchange="onselectChangeGrandTotal(\''.$key_id.'\');">'.
									'<option value="0">0</option>'.
									'<option value="1">9 rolls</option>'.
									'<option value="2">18 rolls</option>'.
									'<option value="3">27 rolls</option>'.
									'</select>'.
									'<label for="'.$key.'">'.$key.': $'.$menu[$key]['price'].'</label>';
								}else if ($key == 'Coffee'){
									$print .= '<select class="food-qtn-input" name="'.$key_id.'" id="'.$key_id.'" onchange="onselectChangeGrandTotal(\''.$key_id.'\');">'.
									'<option value="0">0</option>'.
									'<option value="1">0.5 lb.</option>'.
									'<option value="2">1 lb.</option>'.
									'<option value="3">1.5 lb.</option>'.
									'</select>'.
									'<label for="'.$key.'">'.$key.': $'.$menu[$key]['price'].'</label>';
								}else {
									$print .= '<input type="text" name="'.$key_id.'" class="food-qtn-input" id="'.$key_id.'" value="'.$oldInput.'" onkeyup="changeGrandTotal(\''.$key_id.'\');">'.
									'<label for="'.$key.'">'.$key.': $'.$menu[$key]['price'].'</label>';
								}

								$print .= '</div>';

								echo $print;

							}
							?>

							<div class="form-group add-pie">
								<input type="text" name="additional_pie_cinamon" class="food-qtn-input" id="CinPie" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_pie_cinamon'); ?>" onkeyup="changeGrandTotal('CinPie');">
								<label for="">Apple Pie: $9</label>
							</div>
							<div class="form-group">
								<input type="text" name="additional_pie_classic" class="food-qtn-input" id="ClassicPie" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_pie_classic'); ?>" onkeyup="changeGrandTotal('ClassicPie');">
								<label for="">Pumpkin Pie: $9</label>
							</div>

							<div class="form-group grand-total">
								<label for="grand_total">GRAND TOTAL:<br><span>TAXES MAY APPLY</span></label>
								<div>$<span id="grand_total">75</span></div>
							</div>
						</div>
						<div class="col-sm-12"></div>
						<div class="col-sm-1" style="height: 1px;"></div>
						<div class="col-sm-11 wrap-max-amount">
							<div class="max-amt-top">
								<p class="">Thanksgiving Feast For 8: </p><p class="wma-dollar"> $</p><p class="wma-75">75 <span class="tax">plus tax</span></p>
							</div>
							<div class="max-amt-bottom">
								<p class="">*Turkey and Prime Rib of Beef weight pre-cooked.</p>
								<p class="">NOTE: No Substitutions Please.</p>
							</div>
						</div>
						<div class="col-sm-12 order-detail no-padding">
							<span>ORDER DETAILS:</span> Thanksgiving Feast reservations and payments will be accepted through <b>TUESDAY, NOVEMBER 21, 2017 BY 1 PM</b>.<br />
							Orders can be dropped off, called in at 520-621-7038 OR by completing and submitting this online Form.<br>
							We’ll call you to confirm details, arrange payment, and schedule a pickup time for <b>WEDNESDAY BEFORE THANKSGIVING AT <br />11AM, 1PM, 2PM at On Deck Deli</b> in the Student Union Memorial Center. Cancellations must be made 48 hours in advance to avoid charges.<br> <b class="order-detail-question">Questions: email Kristi at: Kjv@email.arizona.edu OR call at: 520-621-7038.</b>
						</div>
						<div class="col-sm-12 no-padding client-contact-info">
							<div class="form-group col-sm-5 no-padding">
								<label for="turkeybreast">Name:<span class="label-required-input">Required</span></label>
								<input type="text" name="client_name" class="client-contact-input client-name" id="turkeybreast" placeholder="<?php togoForm_oldInputs($togoForm_oldInputs,'client_name'); ?>" required>
							</div>
							<div class="form-group col-sm-3 no-padding">
								<label for="turkeybreast">Phone:<span class="label-required-input">Required</span></label>
								<input type="text" name="client_phone" class="client-contact-input client-phone" id="turkeybreast" placeholder="<?php togoForm_oldInputs($togoForm_oldInputs,'client_phone'); ?>" required>
							</div>
							<div class="form-group col-sm-4 no-padding">
								<label for="turkeybreast">Email:<span class="label-required-input">Required</span></label>
								<input type="email" name="client_email" class="client-contact-input client-email" id="turkeybreast" placeholder="<?php togoForm_oldInputs($togoForm_oldInputs,'client_email'); ?>" required>
							</div>
						</div>
						<div class="col-sm-12">
							<button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button>
						</div>
					</form>
				</div>
				<div class="col-sm-12 no-padding form-bottom">
					<img src="/dining/sumc/images/Turkey_Dinner.jpg" width="100%">
				</div>
			</div>
		</div>
	</body>

	<script type="text/javascript">
		
		additional_item = {Turkey:0,
			Rib:0,
			WatergateSalad:0,
			AncientGrainSalad:0,
			Dressing:0,
			Gravy:0,
			Potatoes:0,
			Corn:0,
			Yams:0,
			Vegetables:0,
			Relish:0,
			Rolls:0,
			Coffee:0,
			CinPie:0,
			ClassicPie:0};

			function changeGrandTotal(type){
				current_grandTotal = Number(document.getElementById('grand_total').innerHTML);
				type_quantity = Number(document.getElementById(type).value);
				qnt_diff = type_quantity - additional_item[type];

				switch(type) {
					case 'Turkey':
					current_grandTotal = current_grandTotal + qnt_diff*35;
					break;
					case 'Rib':
					current_grandTotal = current_grandTotal + qnt_diff*35;
					break;
					case 'WatergateSalad':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
					case 'AncientGrainSalad':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Dressing':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Gravy':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Potatoes':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Corn':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Yams':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Vegetables':
					current_grandTotal = current_grandTotal + qnt_diff*8;
					break;
					case 'Relish':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
					case 'Rolls':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
					case 'Coffee':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
					case 'CinPie':
					current_grandTotal = current_grandTotal + qnt_diff*9;
					break;
					case 'ClassicPie':
					current_grandTotal = current_grandTotal + qnt_diff*9;
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
					case 'Relish':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
					case 'Rolls':
					current_grandTotal = current_grandTotal + qnt_diff*6;
					break;
					case 'Coffee':
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

