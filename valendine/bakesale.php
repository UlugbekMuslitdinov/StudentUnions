<?php
// header("Location: ../../index.php");
// die();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
session_start();
?>
<html>
	<head>
		<title>Bake Sale Pre-Order Form</title>
		<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
		<link rel="stylesheet" type="text/css" href="/valendine/css/bakesale.css">
	</head>
	<!--<style>
	.container-fluid {
  margin-right: auto;
  margin-left: auto;
  max-width: 950px; /* 768px messes with the img banner */
}	
	</style> -->
<?php
$foods = Array(
	"1" => Array(
		"name"	=> "VALENTINE’S COOKIES",
		"price"		=> 1.99,
		"choices"	=> Array(
			"apple"		=> "Assorted hand decorated Valentine’s cookies"
		)
	),
	"2" => Array(
		"name"	=> "HEART SHAPED CAKE",
		"price"		=> 6.89,
		"choices"	=> Array(
			"one"	=> "Chocolate cake with decoration", //was "banana" for some reason
			"two"   => "Vanilla cake with decoration"
		)
	),
//	"3" => Array(
//		"name"	=> "SWEETHEART CAKE",
//		"price"		=> 12.99,
//		"choices"	=> Array(
//			"almond"	=> "Chocolate cake with ganache drizzle topped with chocolate dipped strawberries"
//		)
//	),
	"4" => Array(
		"name"	=> "VALENTINE CUP CAKE",
		"price"		=> 2.29,
		"choices"	=> Array(
			"apple"		=> "Red velvet cake with decoration"
		)
	),
//	"5" => Array(
//		"name" => "FRUIT TREATS",
//		"price" => 5.99,
//		"choices"	=> Array(
//			"apple"		=> "Chocolate Covered Strawberries: chocolate dipped fresh strawberries",
//			"apple"		=> "Chocolate Covered Dried Fruit: assorted dried fruit, chocolate covered and shell coating"
//		)
//	),
	"6" => Array(
		"name"	=> "CHOCOLATE COVERED STRAWBERRIES",
		"price"		=> 6.49,
		"choices"	=> Array(
			"apple"		=> "Chocolate dipped fresh strawberries"
		)
	),
//	"7" => Array(
//		"name" => '“A” CUP TREAT',
//		"price" => 7.99,
//		"choices" => Array(
//			"one" => 'Two “A” cups with chocolate covered dried fruit and chocolate covered strawberries'
//		)
//	),
//	"8" => Array(
//		"name" => '“A” BAG PRALINES:',
//		"price" => 10.99,
//		"choices" => Array(
//			"one" => 'Decorated pralines in “A” branded burlap bag'
//		)
//	),
//	"9" => Array(
//		"name" => 'FRUIT & COOKIES BOX',
//		"price" => 4.49,
//		"choices" => Array(
//			"one" => "Chocolate covered dried fruit and chocolate covered sandwich cookies"
//		)
//	),
//	"10" => Array(
//		"name" => 'PRALINES AND CHOCOLATE PRETZEL BOX',
//		"price" => 4.99,
//		"choices" => Array(
//			"one" => "Assorted decorated pralines and chocolate covered pretzels"
//		)
//	),
	"11" => Array(
		"name" => 'GANACHE CUP CAKE BITES',
		"price" => 6.99,
		"choices" => Array(
			"one" => "Mini cupcakes with chocolate ganache and decoration in a heart shaped container"
		)
	),
//	"12" => Array(
//		"name" => 'FRENCH MACARONS',
//		"price" => 14.09,
//		"choices" => Array(
//			"one" => "13 assorted mini macarons in a heart shaped container"
//		)
//	),
	"13" => Array(
		"name" => 'BON BON BOX',
		"price" => 15.99,
		"choices" => Array(
			"one" => "Assorted packaged bon bons with decoration"
		)
	),
);
$fields = array_fill_keys(Array(
	"info-name",
	"info-phone",
	"info-email",
	"info-pickup"
), "");
$valid_dates = Array(
	"feb-10" => "2022-02-10",
	"feb-11" => "2022-02-11",
	"feb-14" => "2022-02-14"
);
$date_names = Array(
	"feb-10" => "February 10<sup></sup>",
	"feb-11" => "February 11<sup></sup>",
	"feb-14" => "February 14<sup></sup>"
);
$success = false;
$formerrors = Array();

//http://stackoverflow.com/q/19261987
function domain_exists($email, $record = 'MX'){
	list($user, $domain) = explode('@', $email);
	return checkdnsrr($domain, $record);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$price = 0;
	$payment = $_POST['payment'];
	// Add description for the payment option.
	switch ($payment) {
			case 1:
				$payment_2 = "Credit Card/ Debit Card";
				$status = "Started";
				$payment_message = "";
				break;
			case 2:
				$payment_2 = "Meal Plan";
				$status = "Not Paid";
				$payment_message = "<p><b>A team member from Dining Services will contact you for Meal Plan/Cat Cash payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
			case 3:
				$payment_2 = "Other";
				$status = "Not Paid";
				$payment_message = "<p><b>A team member from Dining Services will contact you for your IDB payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
	}
	
	foreach($foods as $shortname=>&$food){
		if(isset($food["choices"])){
			$formerrors["foods"][$shortname] = Array();
			$food["quantity"] = Array();
			$food["group-total"] = 0;
			foreach($food["choices"] as $choice_S=>$choice_L){
				if(isset($_POST["food-".$shortname."-".$choice_S."-chk"])){
					$ref = "food-".$shortname."-".$choice_S."-qty";
					if(!empty($_POST[$ref])){
						if(ctype_digit($_POST[$ref])){
							$qty = (int)$_POST[$ref];
							if($qty >= 0){
								$price += $qty*$food["price"];
								$food["group-total"] += $qty;
								$food["quantity"][$choice_S] = $qty;
							}else{
								$formerrors["foods"][$shortname][$choice_S] = "Negative values are not allowed.";
							}
						}else{
							$formerrors["foods"][$shortname][$choice_S] = "Only (positive) numbers are allowed.";
						}
					}else{
						// $formerrors["foods"][$shortname][$choice_S] = "You must enter a quantity.";
					}
				}else{
					$food["quantity"][$choice_S] = 0;
				}
			}
			if(empty($formerrors["foods"][$shortname])){
				unset($formerrors["foods"][$shortname]);
			}
		}else{
			if(isset($_POST["food-".$shortname."-chk"])){
				$ref = "food-".$shortname."-qty";
				if(!empty($_POST[$ref])){
					if(ctype_digit($_POST[$ref])){
						$qty = (int)$_POST[$ref];
						if($qty >= 0){
							$price += $qty*$food["price"];
							$food["quantity"] = $qty;
						}else{
							$formerrors["foods"][$shortname] = "Negative values are not allowed.";
						}
					}else{
						$formerrors["foods"][$shortname] = "Only (positive) numbers are allowed.";
					}
				}else{
					// $formerrors["foods"][$shortname] = "You must enter a quantity.";
				}
			}else{
				$food["quantity"] = 0;
			}
		}
	}
	unset($food);
	if(empty($formerrors["foods"])){
		unset($formerrors["foods"]);
	}
	foreach($fields as $field=>$value){
		if(!empty($_POST[$field])){
			$fields[$field] = addslashes($_POST[$field]);
		}else{
			$formerrors["fields"][$field] = "This field is required.";
		}
	}
	if(!empty($fields["info-email"])){
		if(!(filter_var($fields["info-email"], FILTER_VALIDATE_EMAIL) && domain_exists($fields["info-email"]))){
			$formerrors["fields"]["info-email"] = "You must enter a valid email address.";
		}
	}
	if(!empty($fields["info-pickup"])){
		if(isset($valid_dates[$fields["info-pickup"]])){
			$fields["info-pickup-fmt"] = $date_names[$fields["info-pickup"]];
			$fields["info-pickup"] = $valid_dates[$fields["info-pickup"]];
		}else{
			$formerrors["fields"]["info-pickup"] = "You must select a valid date.";
		}
	}
	if(empty($formerrors["fields"])){
		unset($formerrors["fields"]);
	}
	if(empty($formerrors)){
		$success = true;
		$subject = "Valentine Bake Sale Order Confirmation - " . date("F j, Y, g:i a") . "";
		$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
		$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
		// $headers .= "Bcc: angelicg@arizona.edu\r\n";
		$headers .= "Bcc: su-web@email.arizona.edu\r\n";
		// $headers .= "Bcc: yontaek@email.arizona.edu\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		$total_tax = $price * 0.061;	// Add 6.1% tax.
		$total_before_tax = $price;
		$price = $price + $total_tax; //total with tax
		$price = number_format((float)$price, 2, '.', '');
		$message = '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: arial, sans-serif;font-size: 13px;">
		<br /><h3 style="width:100%;border-top:1px solid #333;border-bottom:1px solid #333;padding-top:5px;padding-bottom:6px;margin-top:0px;margin-bottom:10px;">Valentine Bake Sale Order Summary:</h3>
		<table style="text-align: center; border-collapse: collapse;"><tbody>
			<tr style="border-bottom: 2px solid black">
				<th style="text-align: left;">Item</th>
				<th>&nbsp;Unit Price&nbsp;</th>
				<th>&nbsp;Quantity&nbsp;</th>
				<th>Price</th>
			</tr>';
		$tick = 0;
		foreach($foods as $food){
			if(isset($food["choices"])){
				if($food["group-total"]>0){
					$message .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="text-align: left;">'.$food["name"].'</td>
				<td style="border-left: 1px solid #999;">$'.number_format($food["price"], 2).'</td>
				<td style="border-left: 1px solid #999;">'.$food["group-total"].'</td>
				<td style="border-left: 1px solid #999;">$'.number_format($food["price"]*$food["group-total"], 2).'</td>
			</tr>';
					$tick++;
					foreach($food["choices"] as $choice=>$choicename){
						if($food["quantity"][$choice]>0){
							$message .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="text-align: left; padding-left: 16px;">'.$choicename.'</td>
				<td style="border-left: 1px solid #999;"> </td>
				<td style="border-left: 1px solid #999;">'.$food["quantity"][$choice].'</td>
				<td style="border-left: 1px solid #999;"> </td>
			</tr>';
							$tick++;
						}
					}
				}
			}else{
				if($food["quantity"]>0){
					$message .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="text-align: left;">'.$food["name"].'</td>
				<td style="border-left: 1px solid #999;">$'.number_format($food["price"], 2).'</td>
				<td style="border-left: 1px solid #999;">'.$food["quantity"].'</td>
				<td style="border-left: 1px solid #999;">$'.number_format($food["price"]*$food["quantity"], 2).'</td>
			</tr>';
					$tick++;
				}
			}
		}
		$message .= '
			<tr style="border-top: 2px solid black">
				<td colspan="3"> </td>
				<td><b>Total: </b>$'.number_format($total_before_tax, 2).'</td>
			</tr>
			</tr>
			<tr style="border-top: 2px solid black">
				<td colspan="3"> </td>
				<td><b>Tax: </b>$'.number_format($total_tax, 2).'</td>
			</tr>
			<tr style="border-top: 2px solid black">
				<td colspan="3"> </td>
				<td><b>Grand Total: $'.number_format($price, 2).'</b></td>
			</tr>
		</tbody></table><br/>
		<b>Name:</b> '.$fields["info-name"].'<br/>
		<b>Email Address:</b> '.$fields["info-email"].'<br/>
		<b>Phone #:</b> '.$fields["info-phone"].'<br/>
		<b>Pickup Day:</b> '.$fields["info-pickup-fmt"].'<br/>
		<b>Pickup Times:</b> 10am-3pm<br/>
		<b>Pickup Location:</b> On Deck Deli<br/>
		<b>Payment Method:</b> '.$payment_2.'<br/>
	</body>
</html>';
		
// in 2022
$time = "10:00 am - 3:00 pm";
$location = "On Deck Deli";

// Store the information into the database.
$db = new db_mysqli('su');
$query = "insert into forms set " . 
		 "form = 'Valentine Bakesale'" .
	     ", name = '" . $fields["info-name"] .
	     "', email = '" . $fields["info-email"] .
	     "', phone = '" . $fields["info-phone"] .
	     "', pickupday = '" . $fields["info-pickup"] .
		 "', pickuptime = '" . $time .
	     "', pickuplocation = '" . $location .  
		 "', payment = '" . $payment_2 .  
		 "', totalamount = '" . $total_before_tax .	
	     "', totalamount_2 = '" . $price .	
		 "', status = '" . $status .
	     "', emailsubject = '" . $subject .
	     "', emailheaders = '" . $headers .
	     "', emailmessage = '" . $message .
		 "'" ;
$db->query($query);
		
// Retrieve ID for this record. The ID is needed after the credit card payment to send email.
$query = "SELECT max(id) as max_id FROM forms";
$result = $db->query($query);
$form = mysqli_fetch_assoc($result);
$max_id = $form['max_id'];
		
// Payment Option
if ($payment == 1) {	// If the payment option is 1 (Credit Card)	
	header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/bakesale_handler.php?id=" . $max_id . "&total=" . $price . "");
	exit();
} else {		
		mail($fields["info-email"], $subject, $message, $headers);
	}
}
} ?>
	
	<body>
		<div class="container-fluid ps-0 pe-0" id="page-container">
			<div class="col-sm-12 tgo-header no-padding">
				<img class="" src="/template/images/banners/valentine_bakesale.jpg" style="width: 100%;"><br /><br /><br />
				<!-- <p class="header-text">Enjoy your Thanksgiving - let us do the cooking!</p> -->
			</div>
			<div id="header-image"></div>
			<div id="header-text">
				
<?php if($success){ 
		header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/index.php?confirm=feast");
?>

<?php }else{ ?>

				<!--<p><a target="_blank" href="/template/resources/forms/HolidayBakeSaleOrderForm.pdf">Click here for a PDF version of this form.</a></p>-->
			</div>
			
			<form class="col-sm-12" action="" method="post" id="bakesale-form" name="bakesale-form">
				<script>var fields = document.getElementById("bakesale-form").elements;</script>
				<?php if(isset($formerrors["general-error"])){ ?>
				<div class="subheader" style="background: #f33; text-align: center; line-height: 28px;">
					<?=$formerrors["general-error"]?>
				</div>
				<?php } ?>
				<!-- Start : Customer Information -->
				<div class="row">
					<div class="food-left" style="margin: 10px 0px; padding-bottom: 0px; width: 100%; border-width: 0px;">
						<label id="info-name"  >
							<span class="super-block">
								<p class="font-serif-italic">NAME:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 210px;" type="text" id="info-name" name="info-name" <?=(isset($_POST["info-name"])?"value=\"".$_POST["info-name"]."\" ":"") ?>/>
						</label>
						<label id="info-phone" <?=(isset($formerrors["fields"]["info-phone"])?"class=\"error\"":"") ?>>
							<span class="super-block">
								<p class="font-serif-italic">PHONE:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 180px;" type="text" id="info-phone" name="info-phone" id="info-phone" <?=(isset($_POST["info-phone"])?"value=\"".$_POST["info-phone"]."\" ":"")?>/>
						</label>
						<label id="info-email" <?=(isset($formerrors["fields"]["info-email"])?"class=\"error\"":"")?> >
							<span class="super-block">
								<p class="font-serif-italic">EMAIL:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 290px;" type="text" id="info-email" name="info-email" <?=(isset($_POST["info-email"])?"value=\"".$_POST["info-email"]."\" ":"")?>/>
						</label>
					</div>
				</div>
				<!-- End : Customer Information -->
				 
				<div class="container-fluid row" style="margin-top: 20px;">
					<span id="info-pickup" required>
						<span class="super-block">
							<p class="font-serif-italic"><b>PICKUP DAY:&nbsp;<span style="font-size:25px; font-weight: bold; color: red;">*</span></b></p>
							<!-- <sub>REQUIRED</sub> -->
						</span>
						<label>
							<input type="radio" value="feb-10" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="feb-10"?"checked ":"")?>/>								
							<span class="super-block">
								<!-- <sup>MONDAY</sup> -->
								<p class="font-sans-italic"><b>Thu, Feb. 10</b></p>
							</span>
						</label>
						<label style="margin-left: 20px;">								
							<input type="radio" value="feb-11" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="feb-11"?"checked ":"")?>/>
							<span class="super-block">
								<!-- <sup>TUESDAY</sup> -->
								<p class="font-sans-italic"><b>Fri, Feb. 11</b></p>
							</span>
						</label>
						<label style="margin-left: 20px;">							
							<input type="radio" value="feb-14" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="feb-14"?"checked ":"")?>/>
							<span class="super-block">
								<!-- <sup>WEDNESDAY</sup> -->
								<p class="font-sans-italic"><b>Mon, Feb. 14</b></p>
							</span>
						</label>
					</span> <br>
					<span class="super-block">
							<p class="font-serif-italic"><b>PICKUP TIME:&nbsp;<span class="font-sans-italic"><b> 10am-3pm</b>&emsp;&emsp;</span></b></p>
					</span> 
					<span class="super-block">
							<p class="font-serif-italic"><b>PICKUP LOCATION:&nbsp;<span class="font-sans-italic"><b> On Deck Deli</b></span></b></p>
					</span>
				</div>

				
				<div class="container-fluid col-sm-12" id="foods" class="row" style="margin-top: 10px;">
					<div class="food-item" onchange="update_single_price('pies')" id="food-pies">
						<div class="food-left serif-medium" style="padding-top: 7px; padding-bottom: 6px; padding-left: 0px; color: #fff; letter-spacing: 1; background-color: #51272b;">
							PLEASE INDICATE QUANTITIES NEXT TO EACH ITEM ORDERED BELOW
						</div>
						<div style="width: 10px;"></div>
						<div class="wrap-food-price serif-medium" style="padding-top: 7px; padding-bottom: 6px; padding-left: 5px; color: #fff; letter-spacing: 1; text-align: center; background-color: #51272b;">
							ITEM COST
						</div>
					</div>
<?php
						foreach($foods as $shortname=>$food){
							if(is_int($food["price"])){
								$price = (string)$food["price"];
							}else{
								$price = number_format($food["price"], 2, ".", "");
							}
							$heading = $food["name"]." - $".$price." ea:";
							if(isset($food["choices"])){
								echo(
'					<div class="food-item" onchange="update_single_price(\''.$shortname.'\')" id="food-'.$shortname.'">
						<div class="food-left">
							<h3 class="pink-color letter-spacing"><em><b style="padding-left: 5px; text-transform: uppercase;">'.$heading.'</b></em></h3>
							<div class="food-options" style="padding-left: 6px;">'
								);
								$choiceCount = 0; //counter to keep track of choice index
								foreach($food["choices"] as $choice_S=>$choice_L){
									//need a line break every item except the first
									if ($choiceCount != 0){
										echo('<br>');
									}
									$choiceCount++;
									echo(
								'
								<div class="food-option'.(isset($formerrors["foods"][$shortname][$choice_S])?" error":"").'" id="food-'.$shortname.'-'.$choice_S.'">
									<label>
										<input class="food-chk" type="checkbox" name="food-'.$shortname.'-'.$choice_S.'-chk" '.(isset($_POST["food-".$shortname."-".$choice_S."-chk"])?"checked ":"").'/>
										<span class="food-option-label"><strong>'.$choice_L.'</strong></span>
									</label>
									<input class="food-qty" type="number" min="0" onchange="fields[\'food-'.$shortname.'-'.$choice_S.'-chk\'].checked=true;" name="food-'.$shortname.'-'.$choice_S.'-qty" '.(isset($_POST["food-".$shortname."-".$choice_S."-qty"])?"value=\"".$_POST["food-".$shortname."-".$choice_S."-qty"]."\" ":"").'/>
								</div>'
									);
								}
								echo(
							'
							</div>
						</div>
						<div style="width: 10px;"></div>
						<div class="wrap-food-price">
							<div class="food-price" id="food-'.$shortname.'-price"></div>
						</div>
					</div>'."\n"
								);
							}else{
								echo(
'					<div class="food-item" onchange="update_single_price(\''.$shortname.'\')">
						<div class="food-left">
							<h3'.(isset($formerrors["foods"][$shortname])?" class=\"error\"":"").' id="food-'.$shortname.'">
								<label>
									<input class="food-chk" type="checkbox" name="food-'.$shortname.'-chk" '.(isset($_POST["food-".$shortname."-chk"])?"checked ":"").'/>
									<span class="food-option-label pink-color letter-spacing"><em><b style="padding-left: 6px; text-transform: uppercase;">'.$heading.'</b></em></span>
								</label>
								<input class="food-qty" type="number" min="0" onchange="fields[\'food-'.$shortname.'-chk\'].checked=true;" name="food-'.$shortname.'-qty" '.(isset($_POST["food-".$shortname."-qty"])?"value=\"".$_POST["food-".$shortname."-qty"]."\" ":"").'/>
							</h3>
						</div>
						<div style="width: 10px;"></div>
						<div class="wrap-food-price">
							<div class="food-price" id="food-'.$shortname.'-price"></div>
						</div>
					</div>'."\n"
								);
							}
						} //end foreach
					?>

	<br />
					<div class="" style="padding: 10px 30px 0px 0px; border: 0px solid #333;">
							<b style="font-weight: bolder; letter-spacing: -0.5px;">TOTAL: <span id="" style="color: black; font-size: 30px; font-weight: bold;">$</span></b>
							<span id="total-no-tax" style="color: #BE1E35; font-size: 30px; font-weight: bold;"></span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b style="font-weight: bolder; letter-spacing: -0.5px;">TAX: <span id="" style="color: black; font-size: 30px; font-weight: bold;">$</span></b>
							<span id="tax" style="color: #BE1E35; font-size: 30px; font-weight: bold;">0.00</span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b style="font-weight: bolder; letter-spacing: -0.5px;">GRAND TOTAL: <span id="" style="color: black; font-size: 30px; font-weight: bold;">$</span></b>
						    <span id="total-price" style="color: #BE1E35; font-size: 30px; font-weight: bold;">0.00</span>
					</div>
				</div>
				
				
				<br>
				<div class="container-fluid"> 
					<table width="100%">
						<tr>
							<td class="col-sm-3" width="150px"><b><span style="font-size:16px; font-weight:bold; margin-bottom:20px;">Payment Option:</span></b><span style="font-size:25px; font-weight: bold; color:red;">*</span></td>
							<td class="col-sm-9">
								<input type="radio" value="1" name="payment" id="card" style="height:15px;width:15px; margin-bottom:10px;" value="CREDIT CARD / DEBIT CARD"  />&nbsp;<label for="card" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">CREDIT CARD / DEBIT CARD</label>&nbsp;&nbsp;
								<input type="radio" value="2" name="payment" id="meal_plan" style="height:15px;width:15px; margin-bottom:10px;" value="MEAL PLAN"  />&nbsp;<label for="meal_plan" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">MEAL PLAN</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" value="3" name="payment" id="other_payment" style="height:15px;width:15px; margin-bottom:10px;" value="OTHER PAYMENT METHOD"  />&nbsp;<label for="other_payment" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">Other</label>
							</td>
						</tr>
						<tr>
						  <td></td>
						  <td align="right"><span class="" style="padding: 0; width: 100%;">
								<input id="button-submit" type="button" value="SUBMIT"/>
							</span></td>
						</tr>
					</table>
				</div>
				<br>
				
				<div class="container-fluid row" align="center">
					<div class="col-md-12">
						<img src="./images/thanksgiving_sides_bottom_2.png" style="max-width: 100%;" />
					</div><br /><br />
				</div><br /><br />

			</form>
		</div>
		<div id="error-msg">
		</div>
		<script>
			document.getElementById("button-submit").addEventListener("click", function(event){
        			event.preventDefault();
				/*Order matters for the following If statement*/
        			if (checkCustomerInfoErrors() && checkPickupErrors() && checkFoodErrors() && checkPaymentErrors()) {
					document.getElementById("bakesale-form").submit();
				}
    			});
			function checkCustomerInfoErrors() {
				var custName = document.forms["bakesale-form"]["info-name"].value;
				var custPhone = document.forms["bakesale-form"]["info-phone"].value;
				var custEmail = document.forms["bakesale-form"]["info-email"].value;
				if (!custName) {
					alert("Please Enter a Name");
					return false;
				} else if (!custPhone) {
					alert("Please Enter a Phone Number");
					return false;
				} else if (!custEmail) {
					alert("Please Enter an Email Address");
					return false;
				} else {
					return true;
				}
			}
			function checkFoodErrors() {
				var errortxt = "Please select at least one item to place an order";
				var total = document.getElementById("total-price").innerHTML;
				if (total <= 0) {
					alert(errortxt);
					return false;
				} else {
					return true;
				}
			}
			function checkPickupErrors() {
				/*Check Payment*/
				var errortxt = "Please Select a Pickup Date";
			        var radios = document.getElementsByName('info-pickup');
				var checkCounter = 0;
			        for(const radio of radios){
			        	if(radio.checked){
			        		checkCounter++;
			        	}
			        }
				if (!checkCounter) {
					alert(errortxt);
					return false;
				} else {
					return true;
				}
			}
			function checkPaymentErrors() {
				/*Check Payment*/
				var errortxt = "Please Select a Payment Option";
			        var radios = document.getElementsByName('payment');
				var checkCounter = 0; /*3 radios */
			        for(const radio of radios){
			        	if(radio.checked){
			        		checkCounter++;
			        	}
			        }
				if (!checkCounter) {
					alert(errortxt);
					return false; 
				} else {
					return true;
				}
			}
		
			var foods_preload = <?=json_encode($foods)?>;
			var errors = <?=json_encode($formerrors)?>;
			var foods = {};
			var tax = 0;
			var totalNoTax = document.getElementById("total-no-tax");
			var taxElement = document.getElementById("tax");
			var grandTotal = document.getElementById("total-price");
			var errorMsg = document.getElementById("error-msg");
			
			function initialize_foods(){
				for(var i in foods_preload){
					foods[i] = foods_preload[i];
					foods[i].pricetag = document.getElementById("food-"+i+"-price");
					foods[i].qty = 0;
				}
			}
			
			function initialize_errors(){
				for(var i in errors["foods"]){
					if(typeof errors["foods"][i] === "object"){
						for(var j in errors["foods"][i]){
							var elem = document.getElementById("food-"+i+"-"+j);
							elem.formErrorMsg = errors["foods"][i][j];
							elem.onmouseenter = pin_error_to;
							elem.onmouseout = hide_error;
						}
					}else{
						var elem = document.getElementById("food-"+i);
						elem.formErrorMsg = errors["foods"][i];
						elem.onmouseenter = pin_error_to;
						elem.onmouseout = hide_error;
					}
				}
				for(var i in errors["fields"]){
					var elem = document.getElementById(i);
					elem.formErrorMsg = errors["fields"][i];
					elem.onmouseenter = pin_error_to;
					elem.onmouseout = hide_error;
				}
			}
			
			initialize_foods();
			initialize_errors();
			
			function update_final_price(){
				var price = 0;
				for(var i in foods){
					price += foods[i].qty * foods[i].price;
				}
				tax = price * 0.061; 
				totalNoTax.innerHTML = price.toFixed(2);
				taxElement.innerHTML = tax.toFixed(2);
				price += tax;
				grandTotal.innerHTML = price.toFixed(2);
			}
			
			function update_single_price(shortname, defer){
				if(shortname in foods){
					var qty=0;
					if(typeof foods[shortname].choices === "object"){
						for(choice in foods[shortname].choices){
							if(fields["food-"+shortname+"-"+choice+"-chk"].checked){
								qty+=fields["food-"+shortname+"-"+choice+"-qty"].value*1;
							}
						}
					}else{
						if(fields["food-"+shortname+"-chk"].checked){
							qty+=fields["food-"+shortname+"-qty"].value*1;
						}
					}
					foods[shortname].qty = qty;
					var price = qty*foods[shortname].price;
					if(price>0){
						foods[shortname].pricetag.innerHTML = price.toFixed(2);
					}else{
						foods[shortname].pricetag.innerHTML = "";
					}
					if(defer !== true){
						update_final_price();
					}
				}
			}
			
			function update_all_prices(){
				for(var food in foods){
					update_single_price(food, true);
				}
				update_final_price();
			}
			
			function pin_error_to(id){
				if(typeof id === "object"){
					var elem = id.currentTarget;
					id = elem.id;
					if(typeof elem.formErrorMsg === "string"){
						errorMsg.innerHTML = elem.formErrorMsg;
					}
				}else{
					var elem = document.getElementById(id);
				}
				errorMsg.currentTarget = id;
				errorMsg.style.display = "block";
				var iBB = elem.getBoundingClientRect();
				var eBB = errorMsg.getBoundingClientRect();
				errorMsg.style.left = iBB.left+document.body.scrollLeft;
				errorMsg.style.top = iBB.top-eBB.height+document.body.scrollTop;
				if(eBB.width > iBB.width){
					errorMsg.style.borderBottomRightRadius="3px";
				}else{
					errorMsg.style.borderBottomRightRadius="0px";
				}
			}
			
			function hide_error(id){
				if(typeof id === "object"){
					var bb = id.currentTarget.getBoundingClientRect();
					if(id.clientX > bb.left && id.clientX < bb.right && id.clientY > bb.top && id.clientY < bb.bottom){
						id = "";
					}else{
						id = id.currentTarget.id;
					}
				}
				if(id == errorMsg.currentTarget){
					errorMsg.style.display = "none";
				}
			}
			
			document.getElementById("bakesale-form").reset();
			update_all_prices();
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
<?php } ?>
</html>