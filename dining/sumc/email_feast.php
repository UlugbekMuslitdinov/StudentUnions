<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
if ( isset($_POST['submit']) ){	
	$errors = array();
	
	// Initialize inputs 
		/* order is important */
	$inputArray = array();
	$name = inputValidation($_POST['client_name'],'client_name','client_name');
	$phone = inputValidation($_POST['client_phone'],'client_phone','client_phone');
	$email = inputValidation($_POST['client_email'],'client_email','client_email');
	//location and time
	$pickup_location = $_POST['pickup_location'];
	$pickupTime = $_POST['pickupTime'];
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
	
	//food
	$turkey = inputValidation($_POST['turkey'], 'additional_item', 'turkey');
	$beef = inputValidation($_POST['beef'], 'additional_item', 'beef');
	$wellington = inputValidation($_POST['wellington'], 'additional_item', 'wellington');
	$lamb = inputValidation($_POST['lamb'], 'additional_item', 'lamb');
	$salad = inputValidation($_POST['salad'], 'additional_item', 'salad');
	$slaw = inputValidation($_POST['slaw'], 'additional_item', 'slaw');
	$sausage = inputValidation($_POST['sausage'], 'additional_item', 'sausage');
	$mushroom = inputValidation($_POST['mushroom'], 'additional_item', 'mushroom');
	$yukon = inputValidation($_POST['yukon'], 'additional_item', 'yukon');
	$dairy = inputValidation($_POST['dairy'], 'additional_item', 'dairy');
	$pecan = inputValidation($_POST['pecan'], 'additional_item', 'pecan');
	$maple = inputValidation($_POST['maple'], 'additional_item', 'maple');
	$heirloom = inputValidation($_POST['heirloom'], 'additional_item', 'heirloom');
	$cheddar = inputValidation($_POST['cheddar'], 'additional_item', 'cheddar');
	$spinach = inputValidation($_POST['spinach'], 'additional_item', 'spinach');
	$sweetcorn = inputValidation($_POST['sweetcorn'], 'additional_item', 'sweetcorn');
	$cauliflower_side = inputValidation($_POST['cauliflower_side'], 'additional_item', 'cauliflower_side');
	$cranberry = inputValidation($_POST['cranberry'], 'additional_item', 'cranberry');
	$pan = inputValidation($_POST['pan'], 'additional_item', 'pan');
	$gravy = inputValidation($_POST['gravy'], 'additional_item', 'gravy');
	$balsamic = inputValidation($_POST['balsamic'], 'additional_item', 'balsamic');
	$grain = inputValidation($_POST['grain'], 'additional_item', 'grain');
	$cornbread = inputValidation($_POST['cornbread'], 'additional_item', 'cornbread');
	$sea = inputValidation($_POST['sea'], 'additional_item', 'sea');
	$pumpkin = inputValidation($_POST['pumpkin'], 'additional_item', 'pumpkin');
	$pecan_pie = inputValidation($_POST['pecan_pie'], 'additional_item', 'pecan_pie');
	$streusel = inputValidation($_POST['streusel'], 'additional_item', 'streusel');
	$trifle = inputValidation($_POST['trifle'], 'additional_item', 'trifle');
	$rice = inputValidation($_POST['rice'], 'additional_item', 'rice');
	$grounddecaf = inputValidation($_POST['grounddecaf'], 'additional_item', 'grounddecaf');
	$ground = inputValidation($_POST['ground'], 'additional_item', 'ground');
	$kcupsdecaf = inputValidation($_POST['kcupsdecaf'], 'additional_item', 'kcupsdecaf');
	$kcups = inputValidation($_POST['kcups'], 'additional_item', 'kcups');

	$totalCount = $turkey + $beef + $wellington + $lamb + $salad + $slaw + $sausage + $mushroom + $yukon + $dairy + $pecan + $maple + $heirloom + $cheddar + $spinach + $sweetcorn + $cauliflower_side + $cranberry + $pan + $gravy + $balsamic + $grain + $walnut + $sea + $pumpkin + $pecan_pie + $streusel + $trifle + $rice + $grounddecaf + $ground + $kcupsdecaf + $kcups;

	////location and time
//	$pickup_location = $_POST['pickup_location'];
//	$pickupTime = $_POST['pickupTime'];

	if($totalCount <= 0) {
		$err_msg = 'Select at least one item!';
		array_push($errors, $err_msg);
	}

	$grandTotal = 0;


	// If input has an error
	if (directToBackWithError($errors)){
		
		
		if ( emailTogo($email,$name,$phone,$pickup_location,$pickupTime,$payment,$payment_2,$status,$payment_message,$inputArray) ) {
			afterEmailSent();
		}
			
		// Check if there is an error
		directToBackWithError($errors);
	}
}else {
	header("Location: http://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php");
	die();
}


function inputValidation($input,$type,$name){
	// echo $input;
	global $errors;
	global $inputArray;

	if ( "" == trim($input) ){
		switch ($type) {
			case 'client_name':
				$err_msg = 'Enter your name';
				array_push($errors, $err_msg);
				$input = " ";
				break;

			case 'client_email':
				$err_msg = 'Your email address was not entered';
				array_push($errors, $err_msg);
				$input = " ";
				break;

			case 'client_phone':
				$err_msg = 'Your phone number was not entered';
				array_push($errors, $err_msg);
				$input = NULL;
				break;
			case 'additional_item':
				return 0;
				break;
			//case 'pickup_location':
//				$err_msg = 'Your pickup location was not selected';
//				array_push($errors,$err_msg);
//				$input = " ";
//				break;
//			case 'pickupTime':
//				$err_msg = 'Your pickup time was not selected';
//				array_push($erros,$err_msg);
//				$input = " ";
//				break;
		}
	}else {
		switch ($type) {
			case 'client_phone':
				// if(preg_match("/[a-z]/i", $input)){
				//     $err_msg = 'Enter Valid Phone Number';
				//     $input = '';
				// 	array_push($errors, $err_msg);
				// }
				return $input;
				break;
			case 'client_email':
				// PHP email validation
				if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
				    // This email address is not considered valid
					$err_msg = 'Your email is not valid';
					array_push($errors, $err_msg);
				} else {
					return $input;
				}
				break;
			case 'additional_item':
				if(preg_match("/[a-z]/i", $input)){
				    $err_msg = 'Only numbers are allowed for item quantity';
				    $input = '';
					array_push($errors, $err_msg);
					return 0;
				} else {
					$inputArray[$name] = intval($input);
					return intval($input);
				}
				break;
			//case 'pickup_location':
//				return $input;
//				break;
//			case 'pickupTime':
//				return $input;
//				break;
		}
	}

	// Store in $inputArray
	
	return $input;
}



function directToBackWithError($errors){
	if ( count($errors) > 0 ){
		global $inputArray;
		$_SESSION['togoForm_errors'] = $errors;
		$_SESSION['togoForm_old_inputs'] = $inputArray;
		//header("Location: http://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php");
		header("Location: http://".$_SERVER[HTTP_HOST]."/dining/sumc/thanksgiving_sides.php");
		die();
		return false;
	}else{
		return true;
	}
}

function emailTogo($email,$name,$phone,$pickup_location,$pickupTime,$payment,$payment_2,$status,$payment_message,$inputArray){
	global $grandTotal;
	
	$subject = "Thanksgiving A La Carte - " . date("F j, Y, g:i a") . "";
	$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
	$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
	//$headers .= "Bcc: emilyr1@arizona.edu\r\n";
	$headers .= "Bcc: su-web@email.arizona.edu\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		
	$title = "";
	$msg_header = 'From: '.$email.'\r\n '
				 .' '.$name;
	$msg_top = '';

	// Change Message to a table
	$msg_top .= '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: arial, sans-serif;font-size: 13px;">
		<table style="text-align: left; border-collapse: collapse; width: 700px; border: 1px solid #999;"><tbody>';
		$tick = 0;
		$msg_top .= '<tr><th colspan="2" style="text-align: center; padding: 5px 0">Thanksgiving A La Carte To-Go Order Confirmation</th></tr>';
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">'."Name".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$name.'</td>
			</tr>';
					$tick++;
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">'."Phone".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$phone.'</td>
			</tr>';
					$tick++;
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">'."Email".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$email.'</td>
			</tr>';
					$tick++;
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">'."Payment Option".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$payment_2.'</td>
			</tr>';
					$tick++;
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">'."Pickup Location".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$pickup_location.'</td>
			</tr>';
					$tick++;
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">Pickup Time</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$pickupTime.'</td>
			</tr>';
					$tick++;
						
		$msg_top .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
// 		$msg_top .= '
// 		</tbody></table><br/>
// 	</body>
// </html>';

	// End Change Message to a table

	// $countFile = count($_FILES['files']['name']);

	// use wordwrap() if lines are longer than 70 characters
	// $msg = $msg_top." : \r\n     ".wordwrap($msg,70,"\r\n")."\r\n \r\n";
    $msg = $msg_top;
	$msg .= OrderDetail($inputArray).'<tr style="background: #ddd; padding: 10px;">
                        <th colspan="2" style="padding: 10px;">
             Total : $'.$grandTotal.'';
	if ($payment != 2) {	// Taxes won't apply for Meal Plan payment.
	$msg .= ' plus tax';
	}
    $msg .= '</th></tr></tbody></table><br />'.$payment_message.'</body></html>';

// Store the information into the database.
$db = new db_mysqli('su');
$query = "insert into forms set " . 
		 "form = 'Thanksgiving Side A La Carte To-Go'" .
	     ", name = '" . $name .
	     "', email = '" . $email .
	     "', phone = '" . $phone .
		 "', pickuptime = '" . $pickupTime .
	     "', pickuplocation = '" . $pickup_location .  
		 "', payment = '" . $payment_2 .  
		 "', totalamount = '" . $grandTotal .
	     "', status = '" . $status .
	     "', emailsubject = '" . $subject .
	     "', emailheaders = '" . $headers .
	     "', emailmessage = '" . $msg .
		 "'" ;
	$db->query($query);

	// Retrieve ID for this record. The ID is needed after the credit card payment to send email.
	$query = "SELECT max(id) as max_id FROM forms";
	$result = $db->query($query);
	$form = mysqli_fetch_assoc($result);
	$max_id = $form['max_id'];
	
	// Payment Option
	if ($payment == 1) {	// If the payment option is 1 (Credit Card)
		header("Location: http://".$_SERVER[HTTP_HOST]."/dining/sumc/thanksgiving_sides_handler.php?id=" . $max_id . "&total=" . $grandTotal . "");
	} else {
		// If the payment option is 2 (Meal Plan) or 3 (other), send email.
		// mail($fields["info-email"], $subject, $message, $headers);
		// send email
		try {		
			mail($email, $subject, $msg, $headers);
			// mail($email, $subject, $msg, $msg_header);

			if(isset($_SESSION['togoForm_old_inputs'])) {
				unset($_SESSION['togoForm_old_inputs']);
			}
			return true;
		} catch (Exception $e) {
			global $errors;
			$err_msg = 'There was a problem sending an email! - errCode005';
			array_push($errors, $err_msg);
			return false;
		}
		header("Location: http://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php?confirm=feast");
	}			
}

function OrderDetail($inputArray){
	//Additional Item
	global $grandTotal;
	// Create a table which will be empty if there are no items
	$print_additional_items = '';
	$print_additional_items .= '<tr>
                        <th colspan="2" style="text-align: center;">Additional Items</th>
                </tr>';
	
		$tick = 0;
	if ($inputArray['turkey']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px; width:75%;">'."Whole Tom Turkey (Pre-Roasted, 10-14 lbs)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['turkey'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['turkey'])*36;
	}

	if ($inputArray['beef']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Prime Rib of Beef (Pre-Roasted, 5-6 lbs)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['beef'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['beef'])*36;
	}

	if ($inputArray['wellington']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Roasted Vegetable Wellington (You Bake, 5-6 lbs)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['wellington'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['wellington'])*36;
	}
	
	if ($inputArray['lamb']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Rosemary Roasted Leg of Lamb (Pre-Roasted, 5-6 lbs)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['lamb'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['lamb'])*36;
	}

	if ($inputArray['salad']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."
	 Fall Layered Salad: Butternut Squash, Quinoa, Celery, Cranberries, Pumpkin Seeds and Citrus Vinaigrette (V)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['salad'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['salad'])*9;
	}
	
	if ($inputArray['slaw']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."
	 Thanksgiving Slaw: Cabbage, Cranberries, Almonds, and Maple Cider Vinaigrette (V)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['slaw'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['slaw'])*9;
	}

	if ($inputArray['sausage']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Autumn Sage and Sausage Stuffing".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['sausage'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['sausage'])*9;
	}

	if ($inputArray['mushroom']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Quinoa, Mushroom, Garlic, Sage Stuffing (V)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['mushroom'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['mushroom'])*9;
	}

	if ($inputArray['yukon']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Creamy Yukon Mashed Potatoes (V)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['yukon'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['yukon'])*9;
	}
	
	if ($inputArray['dairy']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Mashed Potatoes (V & DF)</em>".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['dairy'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['dairy'])*9;
	}

	if ($inputArray['pecan']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Spiced-Maple Garnet Yams, Pecans and Apricots (V)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['pecan'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['pecan'])*9;
	}

	if ($inputArray['maple']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Maple Roasted Harvest Root Vegetables".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['maple'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['maple'])*9;
	}

	if ($inputArray['heirloom']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze (MWG & DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['heirloom'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['heirloom'])*9;
	}

	if ($inputArray['cheddar']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cheddar Cauliflower Pearls with Roasted Garlic (MWG & DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['cheddar'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['cheddar'])*9;
	}

	if ($inputArray['spinach']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cream Spinach with Shallot Rings (MWG & DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['spinach'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['spinach'])*9;
	}

	if ($inputArray['sweetcorn']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cream Sweet Corn (MWG & DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['sweetcorn'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['sweetcorn'])*9;
	}
	
	if ($inputArray['cauliflower_side']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Roasted Cauliflower and Pomegranate Molasses (V)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['cauliflower_side'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['cauliflower_side'])*9;
	}

	if ($inputArray['cranberry']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cranberry Orange Relish (V, MWG, DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['cranberry'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['cranberry'])*6;
	}

	if ($inputArray['pan']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Rich Pan Turkey Gravy".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['pan'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['pan'])*6;
	}

	if ($inputArray['gravy']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Pan Gravy (V, MWG, DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['gravy'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['gravy'])*6;
	}

	if ($inputArray['balsamic']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Apricot Balsamic Chutney (V, MWG, DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['balsamic'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['balsamic'])*6;
	}

	if ($inputArray['grain']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Multi Grain Artisan Loaf Bread".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['grain'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['grain'])*5;
	}

	if ($inputArray['cornbread']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Sour Cream Cornbread".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['cornbread'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['cornbread'])*5;
	}

	if ($inputArray['sea']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Sea Salt Soft Rolls (9 rolls)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['sea'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['sea'])*3;
	}

	if ($inputArray['pumpkin']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Traditional Pumpkin Pie with Chantilly Cream".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['pumpkin'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['pumpkin'])*12;
	}

	if ($inputArray['pecan_pie']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Chocolate Bourbon Pecan Pie".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['pecan_pie'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['pecan_pie'])*12;
	}

	if ($inputArray['streusel']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Apple Harvest Walnut Streusel (MWG & DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['streusel'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['streusel'])*12;
	}

	if ($inputArray['trifle']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Pumpkin Mousse Trifle (MWG & DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['trifle'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['trifle'])*12;
	}
	
	if ($inputArray['rice']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Pumpkin Arborio Rice Pudding, Fig Compote (MWG & DF)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['rice'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['rice'])*12;
	}
	
	if ($inputArray['grounddecaf']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Wildcat-Blend Coffee Ground(Decaf)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['grounddecaf'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['grounddecaf'])*12;
	}

	if ($inputArray['ground']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Wildcat-Blend Coffee Ground(Regular)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['ground'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['ground'])*12;
	}

	if ($inputArray['kcupsdecaf']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Wildcat-Blend Coffee K-Cups(Decaf)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['kcupsdecaf'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['kcupsdecaf'])*12;
	}

	if ($inputArray['kcups']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Wildcat-Blend Coffee K-Cups(Regular)".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['kcups'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['kcups'])*12;
	}
	
	//identifier row to indicate to user what the abbreviations mean
	$print_additional_items .= '<tr>
                        <th colspan="2" style="text-align: center; ">VEGETARIAN - (V) | MADE WITHOUT GLUTEN - (MWG) | DAIRY FREE - (DF)</th>
                </tr>';

	// echo $print_additional_items;
	return $print_additional_items;

}

function afterEmailSent(){
    header("Location: http://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php?confirm=feast");

}


?>