<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

if ( isset($_POST['submit']) ){
	
	$errors = array();

	// Initialize inputs 
		/* order is important */
	$inputArray = array();
	$name = inputValidation($_POST['client_name'],'client_name','client_name');
	$phone = inputValidation($_POST['client_phone'],'client_phone','client_phone');
	$email = inputValidation($_POST['client_email'],'client_email','client_email');
	

	$inputArray['client_name'] = $name;
	$inputArray['client_phone'] = $phone;
	$inputArray['client_email'] = $email;

	$dinner = inputValidation(isset($_POST['dinner']) ? $_POST['dinner'] : '', 'additional_item', 'dinner');
	$appetizer = inputValidation(isset($_POST['appetizer']) ? $_POST['appetizer'] : '', 'additional_item', 'appetizer');
	$starch = inputValidation(isset($_POST['starch']) ? $_POST['starch'] : array(), 'arr', 'starch');
	$vegetables = inputValidation(isset($_POST['vegetables']) ? $_POST['vegetables'] : array(), 'arr', 'vegetables');
	$dessert = inputValidation(isset($_POST['dessert']) ? $_POST['dessert'] : '', 'additional_item', 'dessert');
	$payment = $_POST['payment'];
	$grandTotal = 59;

	// If input has an error
	if (directToBackWithError($errors)){
		
		
		if ( emailTogo($email,$name,$phone,$inputArray,$payment) ) {
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

	if ($type != "arr" && $type != "additional_item" && "" == trim($input) ){
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
			case 'arr':
				// if(preg_match("/[a-z]/i", $input)){
				//     $err_msg = 'Only numbers are allowed for item quantity';
				//     $input = '';
				// 	array_push($errors, $err_msg);
				// 	return 0;
				// } else {
				// 	$inputArray[$name] = intval($input);
				// 	return $input;
				// }
				if(count($input) == 2) {
					$inputArray[$name] = $input;
					return $input;
				} else {
					$err_msg = 'Select two options for '.$name.'!';
					array_push($errors, $err_msg);
					return 0;
				}
				break;
			case 'additional_item':
				if($input != "") {
					$inputArray[$name] = $input;
					return $input;
				} else {
					$err_msg = 'Selection field '.$name.' left empty!';
					array_push($errors, $err_msg);
					return 0;
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
		//header("Location: https://".$_SERVER[HTTP_HOST]."/thanksgiving/index.php");
		echo '<script type="text/JavaScript">window.history.back();</script>';
		return false;
		header("Location: https://".$_SERVER[HTTP_HOST]."/valendine/dinnertogo.php");
		die();
		return false;
	}else{
		return true;
	}
}

function emailTogo($email,$name,$phone,$inputArray,$payment){

	
	global $grandTotal;
	// Add description for the payment option.
	switch ($payment) {
		case 1:
			$payment_2 = "Credit Card/ Debit Card";
			break;
		case 2:
			$payment_2 = "Meal Plan";
			break;
		case 3:
			$payment_2 = "Other";
			break;
	}	
	
	$subject = "Valentine Dinner To-Go Order Confirmation";
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
		$msg_top .= '<tr><th colspan="2" style="text-align: center; padding: 5px 0">Valentine Dinner To-Go Order Confirmation</th></tr>';
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
             Subotal : $59 plus taxes</th></tr>';
    $msg .= '</tbody></table></body></html>';

// Temporary
$time = "";
$location = "";

// Store the information into the database.
$db = new db_mysqli('su');
$query = "insert into forms set " . 
		 "form = 'Valentine Dinner To-Go'" .
	     ", name = '" . $name .
	     "', email = '" . $email .
	     "', phone = '" . $phone .
		 "', pickuptime = '" . $time .
	     "', pickuplocation = '" . $location .  
		 "', payment = '" . $payment_2 .  
		 // "', totalamount = '" . "'$grandTotal'" .	// It's an $85 package.
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
	header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/dinnertogo_handler.php?id=" . $max_id . "");
} else {
	// Send email for the MealPlan or Other payments.
	try {		
		mail($email, $subject, $msg, $headers);		
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
	// Redirect to the confirmation page.
	header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/index.php?confirm=feast");
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
	/*if ($inputArray['turkey']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Oven Roasted Turkey".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['turkey'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['turkey'])*36;
	}

	if ($inputArray['beef']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Prime Rib of Beef".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['beef'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['beef'])*36;
	}

	if ($inputArray['wellington']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Roasted Vegetable Wellington".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['wellington'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['wellington'])*36;
	}

	if ($inputArray['salad']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."
	 Roasted Candy Beets and Quinoa Salad with Goat Cheese and Citrus Vinaigrette".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['salad'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['salad'])*9;
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
					<td style="padding: 3px 5px;">'."Vegetarian Sage and Mushroom Stuffing".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['mushroom'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['mushroom'])*9;
	}

	if ($inputArray['yukon']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Creamy Yukon Mashed Potatoes".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['yukon'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['yukon'])*9;
	}

	if ($inputArray['corn']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cauliflower Mash with Roasted Corn".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['corn'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['corn'])*9;
	}

	if ($inputArray['pecan']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Spiced-Maple Garnet Yams, Pecans and Apricots".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['pecan'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['pecan'])*9;
	}

	if ($inputArray['herb']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Herb Roasted Potatoes".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['herb'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['herb'])*9;
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
					<td style="padding: 3px 5px;">'."Heirloom Carrots and Brussels Sprouts with Mustard Apricot Glaze".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['heirloom'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['heirloom'])*9;
	}

	if ($inputArray['cheddar']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cheddar Cauliflower Pearls with Roasted Garlic".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['cheddar'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['cheddar'])*9;
	}

	if ($inputArray['spinach']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cream Spinach with Fried Onions".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['spinach'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['spinach'])*9;
	}

	if ($inputArray['sweetcorn']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cream Sweet Corn".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['sweetcorn'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['sweetcorn'])*9;
	}

	if ($inputArray['cranberry']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cranberry Orange Relish".'</td>
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
					<td style="padding: 3px 5px;">'."Vegetarian Mushroom Gravy".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['gravy'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['gravy'])*6;
	}

	if ($inputArray['balsamic']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Apricot Balsamic Chutney".'</td>
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

	if ($inputArray['walnut']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Cranberry Walnut Orange Cornbread".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['walnut'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['walnut'])*5;
	}

	if ($inputArray['sea']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Sea Salt Soft Rolls".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['sea'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['sea'])*3;
	}

	if ($inputArray['pudding']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."You Bake Black and White Bread Pudding, Caramel Drizzle".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['pudding'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['pudding'])*12;
	}

	if ($inputArray['blondie']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Apple Blondie Bars and Pecan Bar Brownies".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['blondie'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['blondie'])*12;
	}

	if ($inputArray['pies']>0) {
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
					<td style="padding: 3px 5px;">'."Pumpkin Whoopie Pies, Maple-Spice Filling".'</td>
					<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['pies'].'</td>
				</tr>';
				$tick++;
		$grandTotal = $grandTotal + intval($inputArray['pies'])*12;
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
	}*/

	$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
		<td style="padding: 3px 5px;">'."Dinner Selection".'</td>
		<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['dinner'].'</td>
	</tr>';
	$tick++;

	$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
		<td style="padding: 3px 5px;">'."Appetizer Course".'</td>
		<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['appetizer'].'</td>
	</tr>';
	$tick++;

	$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
		<td style="padding: 3px 5px;">'."Salad Course".'</td>
		<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">Spinach, Tangerines, Strawberries, Goat Cheese, Almonds, Quinoa, Honey
Lime Vinaigrette</td>
	</tr>';
	$tick++;

	$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
		<td style="padding: 3px 5px;">'."Starch Selection".'</td>
		<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['starch'][0].'<br>'.$inputArray['starch'][1].'</td>
	</tr>';
	$tick++;


	$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
		<td style="padding: 3px 5px;">'."Side Vegetables".'</td>
		<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['vegetables'][0].'<br>'.$inputArray['vegetables'][1].'</td>
	</tr>';
	$tick++;

	$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
		<td style="padding: 3px 5px;">'."Bread".'</td>
		<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">Mini Brioche Loaves</td>
	</tr>';
	$tick++;

	$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
		<td style="padding: 3px 5px;">'."Dessert Selection".'</td>
		<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['dessert'].'</td>
	</tr>';
	$tick++;

	// echo $print_additional_items;
	return $print_additional_items;

}

function afterEmailSent(){
    header("Location: https://".$_SERVER[HTTP_HOST]."/valendine/index.php?confirm=feast");
	//header("Location: https://".$_SERVER[HTTP_HOST]."/dining/sumc/thanksgiving.php?emailSent=success");

}


?>