<?php
 //header("Location: /thanksgiving/index.php");
// die();
?>
<html>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132122543-2"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-132122543-2');
		</script>
		<title>Holiday Bake Sale Pre-Order Form</title>
		<link rel="stylesheet" type="text/css" href="/dining/forms/bakesale.css">
	</head>
	<style>
		.item-description { 
			margin-left:8px; 
			font-family: MiloWeb, Verdana, Geneva, sans-serif; 
			font-weight:bold; 
			font-size: 14px;
			color: black; 
		}
	</style>
<?php
$foods = Array(
	"falltasting" => Array(
		"name" => "FALL TASTING TRIO - Enjoy a small sample of each of these flavors<br />
		<span class='item-description'>Apple Blondie, Pumpkin Cheese Cookie, Caramelized Pecan Bar</span>",
		"price" => 9
	),
	"coffeecake" => Array(
	"name" => "COFFEE CAKE TRIO<br />
	<span class='item-description'>Apple Blondie - vanilla cream cake with apples and streusel</span> <br />
	<span class='item-description'>Cheese - vanilla cream cake with cheese filling and streusel</span><br/>
	<span class='item-description''>Cherry - vanilla cream cake with cherries and streusel</span>",
	"price" => 6
	),
	"breads" => Array(
		"name"	=> "BREADS",
		"price"		=> 5,
		"choices"	=> Array(
			"banananutbread"	=> "Banana Nut Bread - bananas and walnuts",
			"chocolatebread"	=> "Chocolate Bread - double chocolate with chocolate chips",
			"pumpkinbread"		=> "Pumpkin Bread - traditional pumpkin",
			"cranberryorange"	=> "Cranberry Orange Walnut Cornbread - holiday flair of your favorite bread"
		)
	),
	"jalapenobread" => Array(
		"name" => "JALAPENO CHEESE BREAD<br /><span class='item-description'>French bread with jalapenos and cheddar cheese</span>",
		"price" => 6
	),
	"danishclaws" => Array(
		"name"	=> "DANISH CLAWS",
		"price"		=> 7,
		"choices"	=> Array(
			"almond"	=> "Almond - almond paste, chopped walnuts, slivered almonds, streusel and glazed",
			"cherrycheese"	=> "Cherry-Cheese - cherries, cheese filling and glazed"
		)
	),
	"specialty" => Array(
		"name"	=> "SPECIALTY",
		"price"		=> 7,
		"choices"	=> Array(
			"carrotcake"	=> "Carrot Cake - UArizona tradition, made with fresh carrots and walnuts",
			"doublechocolate"	=> "Double Chocolate Cake Brownie - made without gluten"
		)
	),
	"pie" => Array(
		"name" => "PIE<br /><span class='item-description'>Pumpkin - traditional pumpkin pie</span>",
		"price" => 8
	)
);
$fields = array_fill_keys(Array(
	"info-name",
	"info-phone",
	"info-email",
	"info-pickup"
), "");
$valid_dates = Array(
	"nov-23" => "2020-11-23",
	"nov-24" => "2020-11-24",
	"nov-25" => "2020-11-25"
);
$date_names = Array(
	"nov-23" => "November 23<sup></sup>",
	"nov-24" => "November 24<sup></sup>",
	"nov-25" => "November 25<sup></sup>"
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
	if($price <= 0){
		$formerrors["general-error"] = "You must select some food to place an order.";
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
		$subject = "Holiday Bake Sale Order Confirmation";
		$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
		$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
		$headers .= "Bcc: emilyr1@arizona.edu\r\n";
		$headers .= "Bcc: su-web@email.arizona.edu\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		$message = '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: arial, sans-serif;font-size: 13px;">
		<br /><h3 style="width:100%;border-top:1px solid #333;border-bottom:1px solid #333;padding-top:5px;padding-bottom:6px;margin-top:0px;margin-bottom:10px;">Holiday Bake Sale Order Summary:</h3>
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
				<td><b>Grand Total:</b></td>
			</tr>
			<tr style="border-bottom: 2px solid black;">
				<td colspan="3"> </td>
				<td>$'.number_format($price, 2).'</td>
			</tr>
		</tbody></table><br/>
		<b>Name:</b> '.$fields["info-name"].'<br/>
		<b>Email Address:</b> '.$fields["info-email"].'<br/>
		<b>Phone #:</b> '.$fields["info-phone"].'<br/>
		<b>Pickup Day:</b> '.$fields["info-pickup-fmt"].'<br/>
	</body>
</html>';
		mail($fields["info-email"], $subject, $message, $headers);
	}
} ?>
	<body>
		<div id="page-container">
			<div class="col-sm-12 tgo-header no-padding">
				<img src="/template/images/banners/holiday_bakesale.jpg"><br /><br /><br />
				<!-- <p class="header-text">Enjoy your Thanksgiving - let us do the cooking!</p> -->
			</div>
			<div id="header-image"></div>
			<div id="header-text">
				
<?php if($success){ 
		header("Location: http://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php?confirm=feast");
?>
<!--			
			</div>
			<div id="bakesale-form">
				<div class="subheader">
				</div><br /><br /><br />
				<h2 style="text-align: center;">Thank you for your order!</h2>
				<h3 style="text-align: center;">An email has been sent to you confirming the details of your order.</h3>
				<div style="text-align: center;">Go back to the <a href="bakesale.php">Bake Sale Pre-Order From</a> and order some more!</div><br /><br />
				<div align="center">OR</div><br /><br />
				<div style="text-align: center;">Go to <a href="../../thanksgiving/index.php">Thanksgiving Offerings To-Go and Bake Sale!</a></div>
				<br /><br /><br /><br /><br />
				<div class="subheader">
				</div>
			</div>
		</div>
	</body>
	-->
<?php }else{ ?>
				<!--<p><a target="_blank" href="/template/resources/forms/HolidayBakeSaleOrderForm.pdf">Click here for a PDF version of this form.</a></p>-->
			</div>

			<form action="" method="post" id="bakesale-form">
				<script>var fields = document.getElementById("bakesale-form").elements;</script>
				<?php if(isset($formerrors["general-error"])){ ?>
				<div class="subheader" style="background: #f33; text-align: center; line-height: 28px;">
					<?=$formerrors["general-error"]?>
				</div>
				<?php } ?>
				<!-- Start : Customer Information -->
				<div class="row">
					<div class="food-left" style="margin: 10px 0px; padding-bottom: 0px; width: 100%; border-width: 0px;">
						<label id="info-name" <?=(isset($formerrors["fields"]["info-name"])?"class=\"error\"":"") ?>>
							<span class="super-block">
								<p class="font-serif-italic">NAME:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 210px;" type="text" name="info-name" <?=(isset($_POST["info-name"])?"value=\"".$_POST["info-name"]."\" ":"") ?>/>
						</label>
						<label id="info-phone" <?=(isset($formerrors["fields"]["info-phone"])?"class=\"error\"":"") ?>>
							<span class="super-block">
								<p class="font-serif-italic">PHONE:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 180px;" type="text" name="info-phone" id="info-phone" <?=(isset($_POST["info-phone"])?"value=\"".$_POST["info-phone"]."\" ":"")?>/>
						</label>
						<label id="info-email" <?=(isset($formerrors["fields"]["info-email"])?"class=\"error\"":"")?>>
							<span class="super-block">
								<p class="font-serif-italic">EMAIL:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 290px;" type="text" name="info-email" <?=(isset($_POST["info-email"])?"value=\"".$_POST["info-email"]."\" ":"")?>/>
						</label>
					</div>
				</div>
				<!-- End : Customer Information -->

				<div class="row" style="margin-top: 20px;">
					<span id="info-pickup" <?=(isset($formerrors["fields"]["info-pickup"])?"class=\"error\"":"")?>>
						<span class="super-block">
							<p class="font-serif-italic"><b><span style='padding:3px; background-color:#972e3d; color: white; font-weight:bold; font-size: 20px;'>PICKUP DAY</span>&nbsp;</b></p>
							<!--<p class="font-serif-italic"><b>PICKUP DAY:&nbsp;</b></p>-->
							 <!--<span style="margin-top: 25px;"><sub>REQUIRED</sub> </span>-->
						</span>
						<label>
							<input type="radio" value="nov-23" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-23"?"checked ":"")?>/>								
							<span class="super-block">
								<!-- <sup>MONDAY</sup> -->
								<p class="font-sans-italic"><b>Monday, Nov. 23</b><br />10AM - 5PM</p>
							</span>
						</label>
						<label style="margin-left: 20px;">								
							<input type="radio" value="nov-24" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-24"?"checked ":"")?>/>
							<span class="super-block">
								<!-- <sup>TUESDAY</sup> -->
								<p class="font-sans-italic"><b>Tuesday, Nov. 24</b><br />10AM - 5PM
								</p>
							</span>
						</label>
						<label style="margin-left: 20px;">							
							<input type="radio" value="nov-25" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-25"?"checked ":"")?>/>
							<span class="super-block">
								<!-- <sup>WEDNESDAY</sup> -->
								<p class="font-sans-italic"><b>Wednesday, Nov. 25</b><br />10AM - 3PM</p>
							</span>
						</label>
					</span>
				</div>
				
				<div class="row" style="margin-top: 20px;">
					<span class="super-block">
						<p><span class="font-serif-italic"><b><span style='padding:3px; background-color:#972e3d; color: white; font-weight:bold; font-size: 20px;'>PICK UP YOUR ORDER AT</span></b></span> <span style='padding:3px; color:#BE1E35; font-weight:100; font-size: 20px;'><i>On Deck Deli in the SUMC Food Court *(ID Required for order pickup)</i></span></p>
					</span>
				</div>

				 <div align="center" class="row" style="margin-top: 20px;">
					<span class="super-block">
						<p><span class="font-serif-italic"><b>PLEASE ORDER 24-HOURS PRIOR TO YOUR PICKUP DATE</b></span></p>
					</span>
				</div>
				
				<div id="foods" class="row" style="margin-top: 10px;">
					<div class="food-item" onchange="update_single_price('pies')" id="food-pies">
						<div class="food-left serif-medium" style="padding-top: 7px; padding-bottom: 6px; padding-left: 5px; color: #fff; letter-spacing: 1; background-color: #51272b;">
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
								foreach($food["choices"] as $choice_S=>$choice_L){
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
									<span class="food-option-label pink-color letter-spacing"><em><b style="padding-left: 6px;">'.$heading.'</b></em></span>
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
						}
					?>

					<div class="food-item" onchange="update_single_price('pies')" id="food-pies">
						<div class="food-left" style="padding: 0px; border-width: 0px; text-align: center;">
							<p style="margin-top: 20px; margin-bottom: 5px; display: inline-block; text-transform: uppercase; color: #fff; padding: 2px 11px 2px 11px; font-size: 12px; background-color: #972e3d; letter-spacing: 0.8;"><strong>Access Electronic form at: union.arizona.edu/thanksgiving</strong></p>
							
							<p class="" style="margin: 0px; font-size: 19px; letter-spacing: 0.8;"><em><b>Payments Accepted:</b></em></p>
							
							<p style="margin: 0px; font-size: 19px; color: #886f51; letter-spacing: 0.8;"><em>IDB Account &#9679; Meal Plan Card &#9679; All Major Credit Cards Accepted</em></p>
						</div>
						<div style="width: 10px;"></div>
						<div class="wrap-food-price" style="padding: 10px 0px 0px 0px; border: 0px solid #333;">
							<b style="font-weight: bolder; letter-spacing: -0.5px;">GRAND TOTAL</b><br/>
							<span style="font-size: 9px; font-weight: bold;">TAXES MAY APPLY</span>
							<span style="margin-left 2px; text-align: left; position: relative; right: 0px; top: 4px; font-size: 20px; font-family: serif; font-weight: bold; ">$</span><span id="total-price" style="margin-left 2px; text-align: left; position: relative; right: 0px; top: 4px; font-size: 20px; font-family: serif; font-weight: bold; color: #BE1E35;">0.00</span>
						</div>
					</div>

				</div>
				<div id="order-info">
					<!-- <div class="food-left" style="margin: 10px 0px; padding-bottom: 0px; border-bottom: none">
						<label id="info-name" <?=(isset($formerrors["fields"]["info-name"])?"class=\"error\"":"") ?>>
							<span class="super-block">
								<p>Name:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 410px;" type="text" name="info-name" <?=(isset($_POST["info-name"])?"value=\"".$_POST["info-name"]."\" ":"") ?>/>
						</label>
						<label id="info-phone" <?=(isset($formerrors["fields"]["info-phone"])?"class=\"error\"":"") ?>>
							<span class="super-block">
								<p>Phone:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 180px;" type="text" name="info-phone" id="info-phone" <?=(isset($_POST["info-phone"])?"value=\"".$_POST["info-phone"]."\" ":"")?>/>
						</label>
					</div> -->
					<!-- <div class="grand-total" style="position: relative; margin-top: 16px;">
						<b style="font-weight: bolder; letter-spacing: -0.5px;">GRAND TOTAL</b><br/>
						<span style="font-size: 9px; font-weight: bold;">TAXES MAY APPLY</span>
						$<span id="total-price" style="margin-left 2px; text-align: left; position: relative; right: 0px; top: 4px; font-size: 18px; font-family: serif; font-weight: bold; color: #BE1E35;">0.00</span>
					</div> -->
					<!-- <div class="food-left" style="margin-bottom: 10px; border-bottom: none"> -->
						<!-- <label id="info-email" <?=(isset($formerrors["fields"]["info-email"])?"class=\"error\"":"")?>>
							<span class="super-block">
								<p>Email:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 290px;" type="text" name="info-email" <?=(isset($_POST["info-email"])?"value=\"".$_POST["info-email"]."\" ":"")?>/>
						</label> -->
						<!-- <span id="info-pickup" <?=(isset($formerrors["fields"]["info-pickup"])?"class=\"error\"":"")?>>
							<span class="super-block">
								<p><b>Pickup Day:&nbsp;</b></p>
								<sub>REQUIRED</sub>
							</span>
							<label>
								<input type="radio" value="nov-19" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-19"?"checked ":"")?>/>								
								<span class="super-block">
									<sup>MONDAY</sup>
									<p>Nov. 19</p>
								</span>
							</label>
							<label>								
								<input type="radio" value="nov-20" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-20"?"checked ":"")?>/>
								<span class="super-block">
									<sup>TUESDAY</sup>
									<p>Nov. 20</p>
								</span>
							</label>
							<label>							
								<input type="radio" value="nov-21" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-21"?"checked ":"")?>/>
								<span class="super-block">
									<sup>WEDNESDAY</sup>
									<p>Nov. 21</p>
								</span>
							</label>
						</span> -->
					<!-- </div> -->
					<!-- <div class="grand-total" style="text-align: left; position: relative; right: 0px; top: 4px; font-size: 18px; font-family: serif; font-weight: bold; color: #BE1E35;">
						$
						<span id="total-price" style="margin-left 2px;">0.00</span>
					</div> -->
				</div>
				<div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <td><span style="font-size:20px; font-weight:bold;">You can also drop off the <a href="../sumc/resources/BakeSale.pdf" target="_blank"><span style="font-size:24px; font-weight:bold; text-decoration: underline; color: red;">PDF ORDER</span></a> at On Deck Deli.</span></td>
						  <td><span class="sh-right" style="padding: 0; width: 100%;">
						<input id="button-submit" type="submit" value="SUBMIT"/>
					</span></td>
						</tr>
					  </tbody>
					</table>
					
				</div>
				<div class="subheader" style="margin-top: 20px; margin-bottom: 100px;">
					<span class="sh-left" style="width: 100%; font-family: serif; font-weight: 900; font-size:16px; text-align: center; color: #fff; text-transform: uppercase; letter-spacing: 1; font-weight: 900;">
						❮❮❮  <em><b>TO PLACE ORDER: Submit form online OR Drop off at On Deck Deli</b></em>  ❯❯❯
					</span>
				</div>
			</form>
		</div>
		<div id="error-msg">
		</div>
		<script>
			var foods_preload = <?=json_encode($foods)?>;
			var errors = <?=json_encode($formerrors)?>;
			var foods = {};
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
	</body>
<?php } ?>
</html>