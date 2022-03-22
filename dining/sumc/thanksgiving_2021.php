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
			</div>
			<div class="col-sm-12 tgo-header no-padding">
				<img src="/dining/sumc/images/thanksgiving_top_image.png"><br />
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
									<label for="turkey"><input type="radio" name="entreechoice" value="Whole Tom Turkey (Rich Pan Gravy)" id="turkey"> Whole Tom Turkey (Rich Pan Gravy) .......................................................... <span class="quantity-span">10-14 lbs., Pre-Roasted*</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="rib"><input type="radio" name="entreechoice" value="Prime Rib of Beef (Au Jus)" id="rib"> Prime Rib of Beef (Au Jus) ................................................<span class="quantity-span">5-6 lbs., Pre-Roasted*</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="lamb"><input type="radio" name="entreechoice" value="Rosemary Leg of Lamb (Mint Aioli)" id="lamb"> Rosemary Leg of Lamb (Mint Aioli) ................................................<span class="quantity-span">4-5 lbs., Pre-Roasted*</span></label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="vegi"><input type="radio" name="entreechoice" value="Roasted Vegetable Wellington (Apricot Balsamic Chutney)" id="vegi"> Roasted Vegetable Wellington <br />&nbsp;&nbsp;&nbsp;(Apricot Balsamic Chutney) ................................................<span class="quantity-span">5-6 lbs., You Bake*</span></label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SALAD COURSE (included)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="salad">Fall Layered Salad (Butternut Squash, Quinoa, Celery, Cranberries, Pumpkin Seeds, and Citrus Vinalgrette)</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="salad">Thanksgiving Slaw (Cabbage, Cranberries, Almonds, and Maple Cider Vinalgrette)</label>
								</div>
							</th></tr>
						</tbody>
					</table>

					<table class="table">
						<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SIDES (included)</div>
							</tr></thead>
						<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="autumnsage">Autumn Sage and Sausage Stuffing</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="vegtarianesage">Creamy Yukon Mashed Potatoes</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="yams">Spiced-Maple Garnet Yams, Pecans and Apricots</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="cauliflower">Roasted Cauliflower and Pomegranate Molasses</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="roastedpotatoes">Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="roastedpotatoes">Creamed Spinach and Shallot Rings</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="roastedpotatoes">Maple Roasted Harvest Root Vegetables</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="roastedpotatoes">Cranberry Orange Relish</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="roastedpotatoes">Cranberry Multigrain Loaf</label>
								</div>
							</th></tr>
						</tbody>
					</table>

					</div>

					<div class="col-sm-4">
						<table class="table">
							<thead class="thead-dark">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SELECT ONE (1) DESSERT</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pumpkinPie"><input type="radio" name="dessert" value="Traditional Pumpkin Pie with Chantilly Cream" id="pumpkinPie"> Traditional Pumpkin Pie with Chantilly Cream</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="pecanPie"><input type="radio" name="dessert" value="Chocolate Bourbon Pecan Pie" id="pecanPie"> Chocolate Bourbon Pecan Pie</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="streusel"><input type="radio" name="dessert" value="Apple Harvest Walnut Streusel" id="streusel"> Apple Harvest Walnut Streusel <i style="font-weight: lighter; font-size: 90%;">(Made Without Gluten, Dairy Free)</i></label>
								</div>
							</th></tr>
							</tbody>
						</table>
					</div>
					
					<div class="col-sm-4">
						<table class="table">
							<thead class="thead-dark" style=" background-color: #c4042a;">
							<tr><th class="thead-text" scope="col">
								<div style="text-transform:uppercase; color:#fff;">SELECT LOCATION & PICK UP TIME</div>
							</tr></thead>
							<tbody>
							<tr><th scope="row">
								<div class="form-group">
									<label for="onDeckDeli"><input type="radio" name="location" value="On Deck Deli" id="onDeckDeli"> On Deck Deli</label>
									<label for="sumc"><input type="radio" name="location" value="SUMC Traffic Circle" id="sumc"> SUMC Traffic Circle</label>
								</div>
							</th></tr>
							<tr><th scope="row">
								<div class="form-group">
									<label for="11AM"><input type="radio" name="time" value="11AM" id="11AM"> 11AM</label>&nbsp;&nbsp;
									<label for="1PM"><input type="radio" name="time" value="1PM" id="1PM"> 1PM</label>&nbsp;&nbsp;
									<label for="2PM"><input type="radio" name="time" value="2PM" id="2PM"> 2PM</label>
								</div>
							</th></tr>
							</tbody>
						</table>
					</div>
					
					<div align="center" style="margin-top:250px;"><br /><br />
					<img src="images/thanksgiving_note.jpg" width="300" />
					</div>
				</div>

				<div class="row" style="margin-left: -65px;">
					<div class="col-md-12">
						<img src="images/thanksgiving_footer.jpg" width="100%"/>
					</div>
				</div>

				<br>
				<div>
					<table style="width: 100%;">
						<tr>
							<td width="18%"><b><span style="font-size:16px;">Payment Option:</span></b><span style="font-size:25px;color:red;">*</span></td>
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
				
				<!--
				<div>
					<table style="width: 100%;">
						<tr>
							<td width="25%"><div><label class="required"><b>Payment Option:</b></label></div></td>
							<td align="center" width="25%"><input type="radio" name="payment" value="card"> <span id="payment-button">CREDIT CARD / DEBIT CARD</span>
							<td align="center" width="25%"><input type="radio" name="payment" value="mealplan"> <span id="payment-button">MEAL PLAN</span>
							<td align="center" width="25%"><input type="radio" name="payment" value="other"> <span id="payment-button">OTHER</span>
						</tr>
					</table>
				</div>
				<br>

				<div class="col-sm-12" style="padding-bottom: 15px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <td><button type="submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button></td>
						</tr>
					  </tbody>
					</table>			
				</div>
				-->
				
				<div class="row" style="margin-left: -65px;">
					<div class="col-md-12">
						<img src="images/thanksgiving_footer2.jpg" width="950px" />
					</div>
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

