<html>
	<head>
		<title>Holiday Bake Sale Pre-Order Form</title>
		<style>
			body{
				background: #525659;
			}
			#page-container{
				background: #F4E7D7;
				position: absolute;
				top: 0px;
				left: 0px;
				right: 0px;
				margin: 0 auto;
				width: 850px;
				min-height: 100%;
				font-size: 13px;
				color: #231F20;
				font-family: sans-serif;
				font-weight: bold;
				box-shadow: 0px 0px 8px 2px #333;
			}
			#header-image{
				position: absolute;
				top: 0px;
				left: 0px;
				height: 270px;
				width: 421px;
				background-image: url("/template/images/BakedGoogs_Background_Reduced.jpg");
			}
			#header-text{
				position: absolute;
				top: 0px;
				right: 0px;
				height: 270px;
				overflow: hidden;
				text-align: right;
				margin: 12px 16px;
				font-size: 15px;
			}
			#header-text h1{
				margin: 4px 0;
				font-family: serif;
				font-style: italic;
				color: #BE1E35;
			}
			#header-text p{
				margin: 6px 0;
			}
			#header-text h3{
				margin: 6px 0;
			}
			#bakesale-form{
				position: absolute;
				top: 270px;
				width: 100%;
				background: #F4E7D7;
				margin-bottom: 0px;
				padding-bottom: 16px;
			}
			.subheader{
				width: 100%;
				height: 26px;
				line-height: 20px;
				background: #CC9D66;
				overflow: hidden;
			}
			.sh-left{
				float: left;
				padding: 4px 0px 4px 24px;
			}
			.sh-right{
				background: #F4E7D7;
				float: right;
				text-align: right;
				padding: 4px 12px 4px 0px;
				width: 100px;
				height: 100%;
			}
			#foods, #order-info{
				margin-left: 24px;
			}
			#order-info .food-left{
				font-weight: normal;
			}
			.food-left{
				display: inline-block;
				width: 720px;
				padding-bottom: 4px;
				border-bottom: 1px solid #231F20;
				vertical-align: middle;
			}
			.food-left h3{
				font-family: serif;
				font-size: 17px;
				margin: 6px 0px 0px 0px;
			}
			.food-option{
				display: inline-block;
				margin-right: 12px;
				margin-bottom: 1px;
				font-weight: normal;
				font-size: 14px;
			}
			.food-price::before{
				content: "$";
				font-weight: bold;
			}
			.food-price{
				display: inline-block;
				width: 50px;
				float: right;
				vertical-align: middle;
				border-bottom: 1px solid black;
				margin-top: 10px;
				margin-right: 37px;
			}
			.grand-total{
				display: inline-block;
				width: 94px;
				float: right;
				vertical-align: middle;
				text-align: center;
				margin-top: 4px;
				margin-right: 6px;
				font-size: 12px;
				
			}
			.food-qty{
				width: 50px;
			}
			.food-chk{
				vertical-align: top;
				margin: none;
			}
			.super-block{
				display: inline-block;
				vertical-align: middle;
				height: 26px;
			}
			.super-block p{
				display: block;
				margin: 0;
				font-size: 16px;
				height: 16px;
				line-height: 16px;
			}
			.super-block sup, .super-block sub{
				display: block;
				font-size: 10px;
				height: 10px;
				line-height: 10px;
			}
			.super-block sup{
				font-weight: bold;
			}
			.super-block sub{
				color: #BE1E35;
			}
			#order-info .food-left label, #order-info .food-left b, #order-info .food-left label input{
				display: inline-block;
				vertical-align: middle;
			}
			#order-info .food-left{
				font-family: serif;
				font-size: 16px;
			}
			#order-info input[type=text]{
				margin-right: 8px;
			}
			#button-submit{
				background: url("/template/images/Submit.png");
				border: none;
				width: 88;
				height: 26;
				margin-right: 16px;
				padding: 0;
				cursor: pointer;
			}
			.error{
				outline: 1px solid red;
			}
			#error-msg{
				position: absolute;
				display: none;
				border: 1px solid red;
				border-bottom: none;
				border-top-right-radius: 3px;
				border-top-left-radius: 3px;
				background: #f33;
				color: #000;
				font-family: sans-serif;
				font-size: 13px;
				font-weight: bold;
				padding: 0px 4px;
			}
		</style>
	</head>
<?php
$foods = Array(
	"pies" => Array(
		"name"	=> "Homemade Pies",
		"price"		=> 9,
		"choices"	=> Array(
			"apple"		=> "Cinnamon Apple Streusel",
			"cherry"	=> "Cherry",
			"pumpkin"	=> "Pumpkin"
		)
	),
	"breads" => Array(
		"name"	=> "Seasonal Breads",
		"price"		=> 6,
		"choices"	=> Array(
			"banana"	=> "Banana Nut Bread",
			"chocolate"	=> "Chocolate",
			"orange"	=> "Orange Cranberry Nut",
			"pumpkin"	=> "Pumpkin",
			"zucchini"	=> "Zucchini"
		)
	),
	"rings" => Array(
		"name"	=> "Danish Rings",
		"price"		=> 6,
		"choices"	=> Array(
			"almond"	=> "Almond",
			"apple"		=> "Apple",
			"cheese"	=> "Cheese",
			"cherry"	=> "Cherry",
			"cherrycheese"	=> "Cherry Cheese"
		)
	),
	"cakes" => Array(
		"name"	=> "Coffee Cakes",
		"price"		=> 4.5,
		"choices"	=> Array(
			"apple"		=> "Apple",
			"blueberry"	=> "Blueberry",
			"cheese"	=> "Cheese",
			"cherry"	=> "Cherry",
			"cherrycheese"	=> "Cherry Cheese",
			"raspberry"	=> "Raspberry"
		)
	),
	"carrotcake" => Array(
		"name" => "Carrot Cake",
		"price" => 6
	),
	"pumpkinroll" => Array(
		"name" => "Pumpkin Roll",
		"price" => 6
	),
	"applestrudel" => Array(
		"name" => "Apple Strudel",
		"price" => 6
	),
	"jcheesebread" => Array(
		"name" => "Jalapeño Cheese Bread",
		"price" => 3
	),
	"cheesebread" => Array(
		"name" => "Cheese Bread",
		"price" => 3
	),
	"chippers" => Array(
		"name" => "\"Chippers\" bite-size cookies in a 1lb. bag",
		"price" => 4
	),
	"madeleines" => Array(
		"name" => "Madeleines French Tea Cookies",
		"price" => 4
	),
	"palmiers" => Array(
		"name" => "Palmiers Puff Pastry Sugar Cookies",
		"price" => 4
	),
	"pfeffernusse" => Array(
		"name" => "Pfeffernüsse Peppered Ginger Bread",
		"price" => 6
	)
);
$fields = array_fill_keys(Array(
	"info-name",
	"info-phone",
	"info-email",
	"info-pickup"
), "");
$valid_dates = Array(
	"nov-21" => "2016-11-21",
	"nov-22" => "2016-11-22",
	"nov-23" => "2016-11-23"
);
$date_names = Array(
	"nov-21" => "November 21<sup>st</sup>",
	"nov-22" => "November 22<sup>nd</sup>",
	"nov-23" => "November 23<sup>rd</sup>"
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
						$formerrors["foods"][$shortname][$choice_S] = "You must enter a quantity.";
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
					$formerrors["foods"][$shortname] = "You must enter a quantity.";
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
		// $headers .= "Bcc: su-web@email.arizona.edu\r\n";
		$headers .= "Bcc: angelicg@email.arizona.edu\r\n";
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
}

if($success){ ?>
<body>
		<div id="page-container">
			<div id="header-image"></div>
			<div id="header-text">
				<h1>Holiday Bake Sale Pre-Order Form</h1>
				<p>Please order 24-hours prior to your pickup date</p>
				<h3>Pick up and pay for your order<br/>
				Monday, Nov. 21 - Wednesday, Nov. 23, 10am-5pm</h3>
				<p style="text-shadow: 0px 0px 10px #F4E7D7, 0px 0px 10px #F4E7D7, 0px 0px 10px #F4E7D7; margin-left: 10px;">Orders can be picked up from On Deck Deli in the SUMC Food Court<br/>
				<b style="font-weight: bolder;"><i>Identification required for order pickup.</i><b></p>
				<p><b style="font-weight: bolder;">Payments Accepted:</b><br/>
				IDB • Meal Plan Card • Cash<br/>
				All Major Credit Cards Accepted</p>
			</div>
			<div id="bakesale-form">
				<div class="subheader">
				</div>
				<h2 style="text-align: center;">Thank you for your order!</h2>
				<h3 style="text-align: center;">An email has been sent to you confirming the details of your order.</h3>
				<div style="text-align: center;">Go back to the <a href="bakesale.php">Bake Sale Pre-Order From</a> and order some more!</div><br />
				<div class="subheader">
				</div>
			</div>
		</div>
	</body>
<?php }else{ ?>
	<body>
		<div id="page-container">
			<div id="header-image"></div>
			<div id="header-text">
				<h1>Holiday Bake Sale Pre-Order Form</h1>
				<p>Please order 24-hours prior to your pickup date</p>
				<h3>Pick up and pay for your order<br/>
				Monday, Nov. 21 - Wednesday, Nov. 23, 10am-5pm</h3>
				<p style="text-shadow: 0px 0px 10px #F4E7D7, 0px 0px 10px #F4E7D7, 0px 0px 10px #F4E7D7; margin-left: 10px;">Orders can be picked up from On Deck Deli in the SUMC Food Court<br/>
				<b style="font-weight: bolder;"><i>Identification required for order pickup.</i><b></p>
				<p><b style="font-weight: bolder;">Payments Accepted:</b><br/>
				IDB • Meal Plan Card • Cash<br/>
				All Major Credit Cards Accepted</p>
				<!--<p><a target="_blank" href="/template/resources/forms/HolidayBakeSaleOrderForm.pdf">Click here for a PDF version of this form.</a></p>-->
			</div>
			<form action="" method="post" id="bakesale-form">
				<script>var fields = document.getElementById("bakesale-form").elements;</script>
				<?php if(isset($formerrors["general-error"])){ ?>
				<div class="subheader" style="background: #f33; text-align: center; line-height: 28px;">
					<?=$formerrors["general-error"]?>
				</div>
				<? } ?>
				<div class="subheader">
					<span class="sh-left" style="font-weight: bolder;">
						PLEASE INDICATE QUANTITIES NEXT TO EACH ITEM ORDERED BELOW:
					</span>
					<span class="sh-right" style="font-size: 11px; line-height: 24px; font-weight: bolder;">
						ITEM COSTS
					</span>
				</div>
				<div id="foods">
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
							<h3>'.$heading.'</h3>
							<div class="food-options">'
								);
								foreach($food["choices"] as $choice_S=>$choice_L){
									echo(
								'
								<div class="food-option'.(isset($formerrors["foods"][$shortname][$choice_S])?" error":"").'" id="food-'.$shortname.'-'.$choice_S.'">
									<label>
										<input class="food-chk" type="checkbox" name="food-'.$shortname.'-'.$choice_S.'-chk" '.(isset($_POST["food-".$shortname."-".$choice_S."-chk"])?"checked ":"").'/>
										<span class="food-option-label">'.$choice_L.'</span>
									</label>
									<input class="food-qty" type="number" min="0" onchange="fields[\'food-'.$shortname.'-'.$choice_S.'-chk\'].checked=true;" name="food-'.$shortname.'-'.$choice_S.'-qty" '.(isset($_POST["food-".$shortname."-".$choice_S."-qty"])?"value=\"".$_POST["food-".$shortname."-".$choice_S."-qty"]."\" ":"").'/>
								</div>'
									);
								}
								echo(
							'
							</div>
						</div>
						<div class="food-price" id="food-'.$shortname.'-price"></div>
					</div>'."\n"
								);
							}else{
								echo(
'					<div class="food-item" onchange="update_single_price(\''.$shortname.'\')">
						<div class="food-left">
							<h3'.(isset($formerrors["foods"][$shortname])?" class=\"error\"":"").' id="food-'.$shortname.'">
								<label>
									<input class="food-chk" type="checkbox" name="food-'.$shortname.'-chk" '.(isset($_POST["food-".$shortname."-chk"])?"checked ":"").'/>
									<span class="food-option-label">'.$heading.'</span>
								</label>
								<input class="food-qty" type="number" min="0" onchange="fields[\'food-'.$shortname.'-chk\'].checked=true;" name="food-'.$shortname.'-qty" '.(isset($_POST["food-".$shortname."-qty"])?"value=\"".$_POST["food-".$shortname."-qty"]."\" ":"").'/>
							</h3>
						</div>
						<div class="food-price" id="food-'.$shortname.'-price"></div>
					</div>'."\n"
								);
							}
						}
					?>
				</div>
				<div id="order-info">
					<div class="food-left" style="margin: 10px 0px; padding-bottom: 0px; border-bottom: none">
						<label id="info-name" <?=(isset($formerrors["fields"]["info-name"])?"class=\"error\"":"")?>>
							<span class="super-block">
								<p>Name:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 410px;" type="text" name="info-name" <?=(isset($_POST["info-name"])?"value=\"".$_POST["info-name"]."\" ":"")?>/>
						</label>
						<label id="info-phone" <?=(isset($formerrors["fields"]["info-phone"])?"class=\"error\"":"")?>>
							<span class="super-block">
								<p>Phone:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 180px;" type="text" name="info-phone" id="info-phone" <?=(isset($_POST["info-phone"])?"value=\"".$_POST["info-phone"]."\" ":"")?>/>
						</label>
					</div>
					<div class="grand-total" style="position: relative; top: 16px; right: 2px;">
						<b style="font-weight: bolder; letter-spacing: -0.5px;">GRAND TOTAL</b><br/>
						<span style="font-size: 9px; font-weight: bold;">TAXES MAY APPLY</span>
					</div>
					<div class="food-left" style="margin-bottom: 10px; border-bottom: none">
						<label id="info-email" <?=(isset($formerrors["fields"]["info-email"])?"class=\"error\"":"")?>>
							<span class="super-block">
								<p>Email:</p>
								<sub>REQUIRED</sub>
							</span>
							<input style="width: 290px;" type="text" name="info-email" <?=(isset($_POST["info-email"])?"value=\"".$_POST["info-email"]."\" ":"")?>/>
						</label>
						<span id="info-pickup" <?=(isset($formerrors["fields"]["info-pickup"])?"class=\"error\"":"")?>>
							<span class="super-block">
								<p><b>Pickup Day:&nbsp;</b></p>
								<sub>REQUIRED</sub>
							</span>
							<label>
								<input type="radio" value="nov-21" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-21"?"checked ":"")?>/>								
								<span class="super-block">
									<sup>MONDAY</sup>
									<p>Nov. 21</p>
								</span>
							</label>
							<label>								
								<input type="radio" value="nov-22" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-22"?"checked ":"")?>/>
								<span class="super-block">
									<sup>TUESDAY</sup>
									<p>Nov. 22</p>
								</span>
							</label>
							<label>							
								<input type="radio" value="nov-23" name="info-pickup" <?=(isset($_POST["info-pickup"])&&$_POST["info-pickup"]=="nov-23"?"checked ":"")?>/>
								<span class="super-block">
									<sup>WEDNESDAY</sup>
									<p>Nov. 23</p>
								</span>
							</label>
						</span>
					</div>
					<div class="grand-total" style="text-align: left; position: relative; right: 0px; top: 4px; font-size: 18px; font-family: serif; font-weight: bold; color: #BE1E35;">
						$
						<span id="total-price" style="margin-left 2px;">0.00</span>
					</div>
				</div>
				<div class="subheader">
					<span class="sh-left" style="font-family: serif; font-weight: normal;">
						<b>TO PLACE ORDER:</b> CALL: 520-621-7041 <b>OR</b> PRINT and FAX to: 520-626-3278 <b>OR</b> Click <b>SUBMIT</b> to order electronically ❯❯
					</span>
					<span class="sh-right" style="padding: 0; width: 115px;">
						<input id="button-submit" type="submit" value=""/>
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