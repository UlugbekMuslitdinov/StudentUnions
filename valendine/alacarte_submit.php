<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
/*



*/
// session_start();

if ( isset($_POST['submit']) ){
	
	$errors = array();
	
	// Initialize inputs 
		/* order is important */
	$inputArray = array();
	$name = inputValidation($_POST['client_name'],'client_name','client_name');
	$phone = inputValidation($_POST['client_phone'],'client_phone','client_phone');
	$email = inputValidation($_POST['client_email'],'client_email','client_email');
	$payment = $_POST['payment'];
	// Add description for the payment option.
		switch ($payment) {
			case 1:
				$payment_type = "Credit Card/ Debit Card";
				$payment_message = "";
				break;
			case 2:
				$payment_type = "Meal Plan";
				$payment_message = "<p><b>A team member from Dining Services will contact you for Meal Plan/Cat Cash payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
			case 3:
				$payment_type = "Other";
				$payment_message = "<p><b>A team member from Dining Services will contact you for your IDB payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
		}	

	// $piechoice = inputValidation($_POST['piechoice'],'piechoice','piechoice');
	// $entreechoice = inputValidation($_POST['entreechoice'],'entreechoice','entreechoice');
	// $Candied = inputValidation($_POST['additional_candied'],'additional_item','additional_candied');
	// $MashedPotatoes = inputValidation($_POST['additional_mashedpotatoes'],'additional_item','additional_mashedpotatoes');
	// $PanGravy = inputValidation($_POST['additional_pangravy'],'additional_item','additional_pangravy');
	// $Yams = inputValidation($_POST['additional_yams'],'additional_item','additional_yams');	
	// $Stuffing = inputValidation($_POST['additional_stuffing'],'additional_item','additional_stuffing');
	// $RoastedCauliflower = inputValidation($_POST['additional_cauliflower'],'additional_item','additional_cauliflower');
	// $QuinoaSalad = inputValidation($_POST['additional_butternut'],'additional_item','additional_butternut');
	// $Relish = inputValidation($_POST['additional_relish'],'additional_item','additional_relish');	
	// $RootVegetables = inputValidation($_POST['additional_rootveg'],'additional_item','additional_rootveg');	
	// $Rolls = inputValidation($_POST['additional_rolls'],'additional_item','additional_rolls');
	// $WildcatCoffee = inputValidation($_POST['additional_coffee'],'additional_item','additional_coffee');

	// Also check if pie is not selected
	//if (isset($_POST['cinamonpie']) == False && isset($_POST['classicpie']) == False ) {
//		$err_msg = 'Select a pie!';
//		array_push($errors, $err_msg);
//	}
	
	// $Turkey = inputValidation($_POST['additional_turkey'],'additional_item','additional_turkey');
	// $Rib = inputValidation($_POST['additional_rib'],'additional_item','additional_rib');
	// $Pork = inputValidation($_POST['additional_pork'],'additional_item','additional_pork');
	// $ApplePie = inputValidation($_POST['additional_applepie'],'additional_item','additional_applepie');
	// $ClassicPie = inputValidation($_POST['additional_pumpkinpie'],'additional_item','additional_pumpkinpie');
	// $Pecan = inputValidation($_POST['additional_pecan'],'additional_item','additional_pecan');

	$turkey = inputValidation($_POST['Bean'], 'additional_item', 'Bean');
	$beef = inputValidation($_POST['Chicken'], 'additional_item', 'Chicken');
	$wellington = inputValidation($_POST['Lentil'], 'additional_item', 'Lentil');
	$salad = inputValidation($_POST['Beef'], 'additional_item', 'Beef');
	$sausage = inputValidation($_POST['Moon'], 'additional_item', 'Moon');
	$mushroom = inputValidation($_POST['Yukon'], 'additional_item', 'Yukon');
	$yukon = inputValidation($_POST['Salad'], 'additional_item', 'Salad');
	$corn = inputValidation($_POST['Potatoes'], 'additional_item', 'Potatoes');
	$pecan = inputValidation($_POST['Turmeric'], 'additional_item', 'Turmeric');
	$herb = inputValidation($_POST['Orzo'], 'additional_item', 'Orzo');
	$maple = inputValidation($_POST['Mushroom'], 'additional_item', 'Mushroom');
	$heirloom = inputValidation($_POST['Tikka'], 'additional_item', 'Tikka');
	$cheddar = inputValidation($_POST['Edamame'], 'additional_item', 'Edamame');
	$spinach = inputValidation($_POST['Broccoli'], 'additional_item', 'Broccoli');
	$sweetcorn = inputValidation($_POST['SweetCorn'], 'additional_item', 'SweetCorn');
	$cranberry = inputValidation($_POST['Relish'], 'additional_item', 'Relish');
	$pan = inputValidation($_POST['Ragout'], 'additional_item', 'Ragout');
	$gravy = inputValidation($_POST['Apricot'], 'additional_item', 'Apricot');
	$balsamic = inputValidation($_POST['Brioche'], 'additional_item', 'Brioche');
	$grain = inputValidation($_POST['Pudding'], 'additional_item', 'Pudding');
	$walnut = inputValidation($_POST['Brownies'], 'additional_item', 'Brownies');
	$sea = inputValidation($_POST['Strawberries'], 'additional_item', 'Strawberries');
	// $pudding = inputValidation($_POST['Pumpkin'], 'additional_item', 'Pumpkin');
	$grounddecaf = inputValidation($_POST['grounddecaf'], 'additional_item', 'grounddecaf');
	$ground = inputValidation($_POST['ground'], 'additional_item', 'ground');
	$kcupsdecaf = inputValidation($_POST['kcupsdecaf'], 'additional_item', 'kcupsdecaf');
	$kcups = inputValidation($_POST['kcups'], 'additional_item', 'kcups');

	$totalCount = $turkey + $beef + $wellington + $salad + $sausage + $mushroom + $yukon + $corn + $pecan + $herb + $maple + $heirloom + $cheddar + $spinach + $sweetcorn + $cranberry + $pan + $gravy + $balsamic + $grain + $walnut + $sea + $grounddecaf + $ground + $kcupsdecaf + $kcups;

	//die(var_dump($inputArray));

	//die("test:".$totalCount);
	//die(var_dump($_POST));

	if($totalCount <= 0) {
		$err_msg = 'Select at least one item!';
		array_push($errors, $err_msg);
	}

	$grandTotal = 0;

	//die();
	// If input has an error
	if (directToBackWithError($errors)){
		
		
		if ( emailTogo($email,$name,$phone,$inputArray) ) {
			afterEmailSent();
		}
			
		// Check if there is an error
		directToBackWithError($errors);
	}
}else {
	header("Location: https://".$_SERVER[HTTP_HOST]."/valendine/index.php");
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
				$inputArray[$name] = 0;
				return 0;
				break;
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
				$inputArray[$name] = 0;
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
		die(var_dump($errors));
		header("Location: https://".$_SERVER[HTTP_HOST]."/valendine/alacarte.php");
		die();
		return false;
	}else{
		return true;
	}
}

function emailTogo($email,$name,$phone,$inputArray){
	global $grandTotal;
	global $subject;
	global $headers;
	global $msg;
	global $payment_type;
	
	$subject = "Valentine A La Carte To-Go Order Confirmation";
	$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
	$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
	//$headers .= "Bcc: angelicg@arizona.edu\r\n";
	$headers .= "Bcc: su-web@email.arizona.edu\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		
	$title = "";
	$msg_header = 'From: '.$email.'\r\n '
				 .' '.$name;

	// $msg_top = "Thanksgiving Feast To Go Order Confirmation"."\r\n\r\n".
	// 		   "Name: ".$name."\r\n".
	// 	       "Phone: ".$phone."\r\n".
	// 	       "Choice of Entree: ".$entreechoice."\r\n".
	// 	       "Choice of Pie: ".$piechoice."\r\n".
	// 		   "Email: ".$email."\r\n";

	$msg_top = '';

	// Change Message to a table
	$msg_top .= '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: arial, sans-serif;font-size: 13px;">
		<table style="text-align: left; border-collapse: collapse; width: 700px; border: 1px solid #999;"><tbody>';
		$tick = 0;
		$msg_top .= '<tr><th colspan="2" style="text-align: center; padding: 5px 0">Valentine A La Carte To-Go Order Confirmation</th></tr>';
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
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$payment_type.'</td>
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
             Subotal : $'.$grandTotal.' plus taxes</th></tr>';
    $msg .= '</tbody></table></body></html>';

	// $mailTochef = 'cyont@hotmail.com';
	//$mailTochef = 'su-web@email.arizona.edu';
	// $mailToclient = $email;

	// send email
//	try {		
//		mail($email, $subject, $msg, $headers); //*****Might need to delete this. New mail() send below in payment option. ******************************************************************************************
		// mail($email, $subject, $msg, $msg_header);
		
//		if(isset($_SESSION['togoForm_old_inputs'])) {
//			unset($_SESSION['togoForm_old_inputs']);
//		}
//		return true;
//	} catch (Exception $e) {
//		global $errors;
//		$err_msg = 'There was a problem sending an email! - errCode005';
//	    array_push($errors, $err_msg);
//	    return false;
//	}
}
// Store the information into the database.
$db = new db_mysqli('su');
$query = "insert into forms set " . 
		 "form = 'Valentine A La Carte'" .
	     ", name = '" . $name .
	     "', email = '" . $email .
	     "', phone = '" . $phone .
//		 "', pickuptime = '" . $pickupTime .
//	     "', pickuplocation = '" . $pickup_location .  
		 "', payment = '" . $payment_type .  
		 "', totalamount = '" . $grandTotal .
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
	if ($payment == 1) {	// If the payment option is 1 (Credit Card) //update this when new handler.php is created
		header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/alacarte_handler.php?id=" . $max_id . "&total=" . $grandTotal . "");
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
		header("Location: https://".$_SERVER[HTTP_HOST]."/valendine/index.php?confirm=feast");
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
	if ($inputArray['Bean']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Sweet and Smoky Tri Tip, Black Bean Relish".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Bean'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Bean'])*20;
	}

	if ($inputArray['Chicken']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Chicken Ricotta Tortellini Pasta".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Chicken'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Chicken'])*20;
	}

	if ($inputArray['Lentil']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Lentil Fritter, Apricot Balsamic Chutney".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Lentil'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Lentil'])*20;
	}

	if ($inputArray['Beef']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Mini Beef Wellingtons with Mustard Apricot Glaze".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Beef'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Beef'])*9;
	}

	if ($inputArray['Moon']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Purple Moon White Cheddar, Sea Salt Crackers and Dates".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Moon'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Moon'])*9;
	}

	if ($inputArray['Salad']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Spinach, Tangerines, Strawberries, Goat Cheese, Almonds, Quinoa, Honey Lime Vinaigrette".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Salad'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Salad'])*9;
	}

	if ($inputArray['Yukon']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Creamy Yukon Mashed Potatoes".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Yukon'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Yukon'])*7;
	}

	if ($inputArray['Potatoes']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Herb Roasted Potatoes".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Potatoes'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Potatoes'])*7;
	}

	if ($inputArray['Turmeric']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Turmeric Rice and Herbs".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Turmeric'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Turmeric'])*7;
	}

	if ($inputArray['Orzo']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Roasted Pepper Orzo and Kalamata Olives".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Orzo'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Orzo'])*7;
	}

	if ($inputArray['Mushroom']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cremini Mushroom and Lip Stick Pepper Ragout".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Mushroom'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Mushroom'])*7;
	}

	if ($inputArray['Tikka']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Tikka Marsala Cauliflower Rice".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Tikka'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Tikka'])*7;
	}

	if ($inputArray['Edamame']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Edamame Succotash".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Edamame'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Edamame'])*7;
	}

	if ($inputArray['Broccoli']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Roasted Broccoli with Lemon Oil".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Broccoli'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Broccoli'])*7;
	}

	if ($inputArray['SweetCorn']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cream Sweet Corn".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['SweetCorn'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['SweetCorn'])*7;
	}

	if ($inputArray['Relish']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Black Bean Relish".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Relish'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Relish'])*4;
	}

	if ($inputArray['Ragout']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Tomato Ragout".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Ragout'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Ragout'])*4;
	}

	if ($inputArray['Apricot']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Apricot Balsamic Chutney".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Apricot'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Apricot'])*4;
	}

	if ($inputArray['Brioche']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Mini Brioche Loaves".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Brioche'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Brioche'])*2;
	}

	if ($inputArray['Pudding']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."You Bake Sticky Toffee Pudding".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Pudding'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Pudding'])*9;
	}

	if ($inputArray['Brownies']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Flourless Chocolate Brownies".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Brownies'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Brownies'])*9;
	}

	if ($inputArray['Strawberries']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Chocolate Covered Strawberries".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Strawberries'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Strawberries'])*6;
	}

	if ($inputArray['Pumpkin']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Pumpkin Whoopie Pies, Maple-Spice Filling".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Pumpkin'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Pumpkin'])*6;
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

	// echo $print_additional_items;
	return $print_additional_items;

}

//function afterEmailSent(){
  //  header("Location: https://".$_SERVER[HTTP_HOST]."/valendine/index.php?confirm=feast");
	//header("Location: http://".$_SERVER[HTTP_HOST]."/dining/sumc/thanksgiving.php?emailSent=success");

//}


?>