<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

if ( isset($_POST['submit']) ){	
// if($_SERVER["REQUEST_METHOD"]=="POST"){
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
		$subject = "Valentine Bake Sale Order Confirmation";
		$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
		$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
		// $headers .= "Bcc: angelicg@arizona.edu\r\n";
		// $headers .= "Bcc: su-web@email.arizona.edu\r\n";
		// $headers .= "Bcc: yontaek@email.arizona.edu\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
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
?>