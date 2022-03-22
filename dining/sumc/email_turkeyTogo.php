<?php

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
	$piechoice = inputValidation($_POST['piechoice'],'piechoice','piechoice');
	$entreechoice = inputValidation($_POST['entreechoice'],'entreechoice','entreechoice');
	$WatergateSalad = inputValidation($_POST['WatergateSalad'],'additional_item','WatergateSalad');
	$AncientGrainSalad = inputValidation($_POST['AncientGrainSalad'],'additional_item','AncientGrainSalad');
	$Dressing = inputValidation($_POST['Dressing'],'additional_item','Dressing');
	$Gravy = inputValidation($_POST['Gravy'],'additional_item','Gravy');
	$Potatoes = inputValidation($_POST['Potatoes'],'additional_item','Potatoes');
	$Corn = inputValidation($_POST['Corn'],'additional_item','Corn');
	$Yams = inputValidation($_POST['Yams'],'additional_item','Yams');
	$Vegetables = inputValidation($_POST['Vegetables'],'additional_item','Vegetables');
	$Relish = inputValidation($_POST['Relish'],'additional_item','Relish');
	$Rolls = inputValidation($_POST['Rolls'],'additional_item','Rolls');
	$Coffee = inputValidation($_POST['Coffee'],'additional_item','Coffee');

	// Also check if pie is not selected
	//if (isset($_POST['cinamonpie']) == False && isset($_POST['classicpie']) == False ) {
//		$err_msg = 'Select a pie!';
//		array_push($errors, $err_msg);
//	}
	
	$Turkey = inputValidation($_POST['additional_turkey'],'additional_item','additional_turkey');
	$Rib = inputValidation($_POST['additional_rib'],'additional_item','additional_rib');
	$CinamonPie = inputValidation($_POST['additional_pie_cinamon'],'additional_item','additional_pie_cinamon');
	$ClassicPie = inputValidation($_POST['additional_pie_classic'],'additional_item','additional_pie_classic');

	$grandTotal = 75;


	// If input has an error
	if (directToBackWithError($errors)){
		
		
		if ( emailTogo($email,$name,$phone,$entreechoice,$piechoice,$inputArray) ) {
			afterEmailSent();
		}
			
		// Check if there is an error
		directToBackWithError($errors);
	}
}else {
	header("Location: http://".$_SERVER[HTTP_HOST]."/dining/sumc/turkey_order.php");
	die();
}


function inputValidation($input,$type,$name){
	// echo $input;
	global $errors;
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
		}
	}else {
		switch ($type) {
			case 'client_phone':
				if(preg_match("/[a-z]/i", $input)){
				    $err_msg = 'Enter Valid Phone Number';
				    $input = '';
					array_push($errors, $err_msg);
				}
				break;
			case 'client_email':
				// PHP email validation
				if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
				    // This email address is not considered valid
					$err_msg = 'Your email is not valid';
					array_push($errors, $err_msg);
				}
				break;
			case 'additional_item':
				if(preg_match("/[a-z]/i", $input)){
				    $err_msg = 'Only numbers are allowed for additional items';
				    $input = '';
					array_push($errors, $err_msg);
				}
				break;
		}
	}

	// Store in $inputArray
	global $inputArray;
	$inputArray[$name] = $input;
	return $input;
}



function directToBackWithError($errors){
	if ( count($errors) > 0 ){
		global $inputArray;
		$_SESSION['togoForm_errors'] = $errors;
		$_SESSION['togoForm_old_inputs'] = $inputArray;
		header("Location: http://".$_SERVER[HTTP_HOST]."/dining/sumc/turkey_order.php");
		die();
		return false;
	}else{
		return true;
	}
}

function emailTogo($email,$name,$phone,$entreechoice,$piechoice,$inputArray){

	global $grandTotal;

	
		$subject = "Thanksgiving Feast To Go Order Confirmation";
		$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
		$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
		// $headers .= "Bcc: angelicg@email.arizona.edu\r\n";
		$headers .= "Bcc: yontaek@email.arizona.edu\r\n";
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

	// Change Message to a table
	$msg_top .= '<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: arial, sans-serif;font-size: 13px;">
		<table style="text-align: left; border-collapse: collapse; width: 700px; border: 1px solid #999;"><tbody>';
		$tick = 0;
		$msg_top .= '<tr><th colspan="2" style="text-align: center; padding: 5px 0">Thanksgiving Feast To Go Order Confirmation</th></tr>';
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
				<td style="padding: 3px 5px; width: 50%;">'."Choice of Entree".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$entreechoice.'</td>
			</tr>';
					$tick++;
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">'."Choice of Pie".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$piechoice.'</td>
			</tr>';
					$tick++;
					$msg_top .='
			<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px; width: 50%;">'."Email".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px;">'.$email.'</td>
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
             Grand Total : $'.$grandTotal.'</th></tr>';
    $msg .= '</tbody></table></body></html>';

	// $mailTochef = 'vrmancha37@email.arizona.edu';
	$mailTochef = 'su-web@email.arizona.edu';
	$mailToclient = $email;

	// send email
	try {		
		mail($email, $subject, $msg, $headers);
		//mail($email, $subject, $msg, $msg_header);
		
		unset($_SESSION['togoForm_old_inputs']);
		return true;
	} catch (Exception $e) {
		global $errors;
		$err_msg = 'There was a problem sending an email! - errCode005';
	    array_push($errors, $err_msg);
	    return false;
	}
}

function OrderDetail($inputArray){
	//Additional Item
	global $grandTotal;
	// Create a table which will be empty if there are no items
	$print_additional_items .= '<tr>
                        <th colspan="2" style="text-align: center;">Additional Items</th>
                </tr>';
		$tick = 0;
	if ($inputArray['additional_turkey']>0) {
		//$print_additional_items .= 'Oven Roasted Tom Turkey: '.$inputArray['additional_turkey']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Oven Roasted Tom Turkey".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['additional_turkey'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['additional_turkey'])*35;
	}

	if ($inputArray['additional_rib']>0) {
		//$print_additional_items .= 'Prime Rib of Beef: '.$inputArray['additional_rib']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Prime Rib of Beef".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['additional_rib'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['additional_rib'])*35;
	}

	if ($inputArray['WatergateSalad']>0) {
		//$print_additional_items .= 'Watergate Salad: '.$inputArray['WatergateSalad']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Watergate Salad".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['WatergateSalad'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['WatergateSalad'])*6;
	}

	if ($inputArray['AncientGrainSalad']>0) {
		//$print_additional_items .= 'Ancient Grain Salad: '.$inputArray['AncientGrainSalad']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Ancient Grain Salad".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['AncientGrainSalad'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['AncientGrainSalad'])*8;
	}

	if ($inputArray['Dressing']>0) {
		//$print_additional_items .= 'Dressing: '.$inputArray['Dressing']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Dressing".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Dressing'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Dressing'])*8;
	}

	if ($inputArray['Gravy']>0) {
		//$print_additional_items .= 'Gravy: '.$inputArray['Gravy']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Gravy".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Gravy'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Gravy'])*8;
	}

	if ($inputArray['Potatoes']>0) {
		//$print_additional_items .= 'Potatoes: '.$inputArray['Potatoes']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Potatoes".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Potatoes'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Potatoes'])*8;
	}

	if ($inputArray['Corn']>0) {
		//$print_additional_items .= 'Corn: '.$inputArray['Corn']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Corn".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Corn'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Corn'])*8;
	}

	if ($inputArray['Yams']>0) {
		//$print_additional_items .= 'Yams: '.$inputArray['Yams']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Yams".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Yams'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Yams'])*8;
	}

	if ($inputArray['Vegetables']>0) {
		//$print_additional_items .= 'Vegetables: '.$inputArray['Vegetables']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Vegetables".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Vegetables'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Vegetables'])*8;
	}

	if ($inputArray['Relish']>0) {
		//$print_additional_items .= 'Relish: '.$inputArray['Relish']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Relish".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Relish'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Relish'])*6;
	}

	if ($inputArray['Rolls']>0) {
		//$print_additional_items .= 'Rolls: '.$inputArray['Rolls']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Rolls".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Rolls'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Rolls'])*6;
	}

	if ($inputArray['Coffee']>0) {
		//$print_additional_items .= 'Coffee: '.$inputArray['Coffee']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Coffee".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['Coffee'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['Coffee'])*6;
	}

	if ($inputArray['additional_pie_cinamon']>0) {
		//$print_additional_items .= 'Cinnamon Streusel Apple Pie: '.$inputArray['additional_pie_cinamon']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Cinnamon Streusel Apple Pie".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['additional_pie_cinamon'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['additional_pie_cinamon'])*9;
	}

	if ($inputArray['additional_pie_classic']>0) {
		//$print_additional_items .= 'Classic Pumpkin Pie with Chantilly Cream: '.$inputArray['additional_pie_classic']."\r\n";
		$print_additional_items .= '<tr'.($tick%2==0?' style="background: #ddd;"':'').'>
				<td style="padding: 3px 5px;">'."Classic Pumpkin Pie with Chantilly Cream".'</td>
				<td style="border-left: 1px solid #999;padding: 3px 5px; text-align: center;">'.$inputArray['additional_pie_classic'].'</td>
			</tr>';
			$tick++;
		$grandTotal = $grandTotal + intval($inputArray['additional_pie_classic'])*9;
	}
	// echo $print_additional_items;
	return $print_additional_items;

}

function afterEmailSent(){

	header("Location: http://".$_SERVER[HTTP_HOST]."/dining/sumc/thanksgiving.php?emailSent=success");

}


?>