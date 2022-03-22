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
//Useful colors: #ad1136 - dark red
?>
<title>Thanksgiving A La Carte Sides</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="StyleSheet" href="/template/global.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/dining/sumc/thanksgiving_sides.css">
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
				</div><br/>
				<div class="col-sm-12 tgo-header no-padding">
					<span style="margin-left:-10px;"><img src="./images/thanksgiving_sides_top.png"></span>
				</div>
			
				<div class="row" style="margin-left:-45px;margin-top:-30px;">
					<div class="col-sm-6">
					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Entr&eacute;es: $36 EACH (Specify Quantity)</div>
								</th>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="turkey" class="food-qtn-input" id="Turkey" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Turkey');">
									<label for="turkey" id="item-label">Whole Tom Turkey (Pre-Roasted, 10-14 lbs)</label>
									
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="beef" class="food-qtn-input" id="Beef" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Beef');">
									<label for="beef" id="item-label">Prime Rib of Beef (Pre-Roasted, 5-6 lbs)</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="wellington" class="food-qtn-input" id="Wellington" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Wellington');">
									<label for="wellington" id="item-label">Roasted Vegetable Wellington (You Bake, 5-6 lbs)</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="lamb" class="food-qtn-input" id="Lamb" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Lamb');">
									<label for="lamb" id="item-label">Rosemary Roasted Leg of Lamb <br/>(Pre-Roasted, 5-6 lbs)</label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Salads: $9 EACH (Specify Quantity)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="salad" class="food-qtn-input" id="Salad" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Salad');"></td><td>
									<label for="salad" id="item-label">Fall Layered Salad: Butternut Squash, Quinoa, Celery, Cranberries, Pumpkin Seeds, <br/>and Citrus Vinaigrette <em>(V)</em></label></td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="slaw" class="food-qtn-input" id="Slaw" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Slaw');"></td><td>
									<label for="slaw" id="item-label">Thanksgiving Slaw: Cabbage, Cranberries, Almonds, and Maple Cider Vinaigrette <em>(V)</em></label></td></tr></table>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Starches: $9 EACH (Specify Quantity)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="sausage" class="food-qtn-input" id="Sausage" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Sausage');">
									<label for="sausage" id="item-label">Autumn Sage and Sausage Stuffing</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="mushroom" class="food-qtn-input" id="Mushroom" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Mushroom');">
									<label for="mushroom" id="item-label">Quinoa, Mushroom, Garlic, and Sage Stuffing <em>(V)</em></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="yukon" class="food-qtn-input" id="Yukon" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Yukon');">
									<label for="yukon" id="item-label">Creamy Yukon Mashed Potatoes <em>(V)</em></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="dairy" class="food-qtn-input" id="Dairy" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Dairy');">
									<label for="dairy" id="item-label">Mashed Potatoes <em>(V <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="pecan" class="food-qtn-input" id="Pecan" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pecan');"></td><td>
									<label for="pecan" id="item-label">Spiced-Maple Garnet Yams, Pecans and Apricots <em>(V)</em></label>
									</td></tr></table>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">Side Vegetables: $9 EACH (Specify Quantity)</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="maple" class="food-qtn-input" id="Maple" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Maple');">
									<label for="maple" id="item-label">Maple Roasted Harvest Root Vegetables</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="heirloom" class="food-qtn-input" id="Heirloom" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Heirloom');"></td><td>
									<label for="heirloom" id="item-label">Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze <em>(MWG <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label></td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<table><tr><td>
									<input type="text" name="cheddar" class="food-qtn-input" id="Cheddar" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Cheddar');"></td><td>
									<label for="cheddar" id="item-label">Cheddar Cauliflower Pearls with Roasted Garlic <br/><em>(MWG <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label>
									</td></tr></table>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="spinach" class="food-qtn-input" id="Spinach" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Spinach');">
									<label for="spinach" id="item-label">Cream Spinach with Shallot Rings <em>(MWG <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="sweetcorn" class="food-qtn-input" id="SweetCorn" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('SweetCorn');">
									<label for="sweetcorn" id="item-label">Cream Sweet Corn <em>(MWG <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<input type="text" name="cauliflower_side" class="food-qtn-input" id="Cauliflower_side" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Cauliflower_side');">
									<label for="cauliflower_side" id="item-label">Roasted Cauliflower and Pomegranate Molasses <em>(V)</em></span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					</div>

					<div class="col-sm-6">
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Accompaniments: $6 EACH (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">										
										<input type="text" name="cranberry" class="food-qtn-input" id="Cranberry" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Cranberry');">	
										<label for="cranberry" id="item-label" style="text-align:right;" >Cranberry Orange Relish <em>(V, MWG, DF)</em></label>		
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="pan" class="food-qtn-input" id="Pan" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pan');">
										<label for="pan" id="item-label" style="text-align:right;">Rich Pan Turkey Gravy</label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="gravy" class="food-qtn-input" id="Gravy" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Gravy');">
										<label for="gravy" id="item-label" style="text-align:right;">Pan Gravy <em>(V, MWG, DF)</em></label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="balsamic" class="food-qtn-input" id="Balsamic" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Balsamic');">
										<label for="balsamic" id="item-label" style="text-align:right;">Apricot Balsamic Chutney <em>(V, MWG, DF)</em></label>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Breads: $5 each (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
										<input type="text" name="grain" class="food-qtn-input" id="Grain" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Grain');">
										<label for="grain"  id="item-label">Multi Grain Artisan Loaf Bread</label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<table><tr><td>
										<input type="text" name="cornbread" class="food-qtn-input" id="Cornbread" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Cornbread');"></td><td>
										<label for="cornbread" id="item-label">Sour Cream Cornbread</label>
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
										<label for="sea" id="item-label">Sea Salt Soft Rolls (9 rolls)</label>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Desserts: $12 each (Specify Quantity)</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="pumpkin" class="food-qtn-input" id="Pumpkin" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pumpkin');"></td><td>
										<label for="pumpkin" id="item-label">Traditional Pumpkin Pie with Chantilly Cream</label>
										</td></tr></table>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="pecan_pie" class="food-qtn-input" id="Pecan_pie" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Pecan_pie');"></td><td>
										<label for="pecan_pie" id="item-label">Chocolate Bourbon Pecan Pie</label>
										</td></tr></table>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="streusel" class="food-qtn-input" id="Streusel" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Streusel');"></td><td>
										<label for="streusel" id="item-label">Apple Harvest Walnut Streusel <em>(MWG <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label>
										</td></tr></table>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="trifle" class="food-qtn-input" id="Trifle" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Trifle');"></td><td>
										<label for="trifle" id="item-label">Pumpkin Mousse Trifle <em>(MWG <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label>
										</td></tr></table>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
									<table><tr><td>
										<input type="text" name="rice" class="food-qtn-input" id="Rice" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'additional_turkey'); ?>" onkeyup="changeGrandTotal('Rice');"></td><td>
										<label for="rice" id="item-label">Pumpkin Arborio Rice Pudding, Fig Compote <br/><em>(MWG <span style="font-family:Times,Arial,Helvetica,Georgia;">&amp;</span> DF)</em></label>
										</td></tr></table>
									</div>
								</th></tr>
							</tbody>
						</table>
						<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col">
									<div style="text-transform:uppercase; color:#fff;">Coffee: $11 EACH (Specify Quantity) &nbsp;|&nbsp; 12 OZ BAG OR 12 K-CUPS</div>
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
							<table class="table">
							<thead class="thead-dark">
								<tr><th class="thead-text" scope="col" style="background-color:#ad1136;">
									<div style="text-transform:uppercase; color:#fff;background-color:#ad1136;">SELECT LOCATION & PICK UP TIME</div>
								</tr></thead>
								<tbody>
								<tr><th scope="row">									
									<div class="form-group">
										<input type="radio" id="onDeckDeli" name="pickup_location" value="On Deck Deli" style="height:15px;width:15px"  required />
										<label for="onDeckDeli"> On Deck Deli</label>&emsp;&emsp;
										<input type="radio" id="sumc" name="pickup_location" value="SUMC Traffic Circle" style="height:15px;width:15px" required />
										<label for="sumc"> SUMC Traffic Circle</label>
									</div>
								</th></tr>
								<tr><th scope="row">
									<div class="form-group">
										<input type="radio" id="11am" name="pickupTime" value="11am" style="height:15px;width:15px" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'pickupTime'); ?>" required />
										<label for="11am" id="item-label"> 11AM</label>&emsp;
										<input type="radio" id="1pm" name="pickupTime" value="1pm" style="height:15px;width:15px" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'pickupTime'); ?>"  required />
										<label for="1pm" id="item-label"> 1PM</label>&emsp;
										<input type="radio" id="2pm" name="pickupTime" value="2pm" style="height:15px;width:15px" placeholder="<?php togoForm_oldInputs($togoForm_old_inputs,'pickupTime'); ?>"  required />
										<label for="2pm" id="item-label"> 2PM</label>
									</div>
								</th></tr>
							</tbody>
						</table>			
					</div>

					<div class="form-group grand-total">
						<label for="grand_total" class="grand_total"><div id="grand-text">GRAND TOTAL:</div>
						<div>$<span id="grand_total">0</span></div><br />(Taxes may apply)
					</div>
				</div><br>
				<div><img src="./images/thanksgiving_sides_bottom_1.png" style="max-width: 100%;" /></div><br /><br />
				<div>
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
				<br>
				
				<div style="margin-top: -20px;">
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
			
				<div class="row" style="margin-left: -65px; margin-right: -30px;">
					<div class="col-md-12">
						<img src="./images/thanksgiving_sides_bottom_2.png" style="max-width: 100%;" />
					</div><br /><br />
				</div><br /><br />
	
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
			Lamb: 0,
			Salad: 0,
			Slaw: 0,
			Sausage: 0,
			Mushroom: 0,
			Yukon: 0,
			Dairy: 0,
			Pecan: 0,
			Maple: 0,
			Heirloom: 0,
			Cheddar: 0,
			Spinach: 0,
			SweetCorn: 0,
			Cauliflower_side: 0,
			Cranberry: 0,
			Pan: 0,
			Gravy: 0,
			Balsamic: 0,
			Grain: 0,
			Cornbread: 0,
			Sea: 0,
			Pumpkin: 0,
			Pecan_pie: 0,
			Streusel: 0,
			Trifle: 0,
			Rice: 0,
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
					case 'Lamb':
						current_grandTotal = current_grandTotal + qnt_diff*36;
						break;
					case 'Salad':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Slaw':
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
					case 'Dairy':
						current_grandTotal = current_grandTotal + qnt_diff*9;
						break;
					case 'Pecan':
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
					case 'Cauliflower_side':
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
					case 'Cornbread':
						current_grandTotal = current_grandTotal + qnt_diff*5;
						break;
					case 'Sea':
						current_grandTotal = current_grandTotal + qnt_diff*3;
						break;
					case 'Pumpkin':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'Pecan_pie':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'Streusel':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;	
					case 'Trifle':
						current_grandTotal = current_grandTotal + qnt_diff*12;
						break;
					case 'Rice':
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

