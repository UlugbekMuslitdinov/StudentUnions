<?php
include_once('../function/post.function.php');
include_once('../function/email.class.php');

postSetup('review');

// var_dump($_POST);

if ($_POST['status'] == "Complete Order"){
	// Update status in catering table
	$db = new CateringDB();
	$db_success = $db->table('catering')->where('id','=',$_SESSION['catering_id'])->update(['status' => 'Submitted']);

	// if $db_success returns 1 then query updated successfully
	if ($db_success == 1) {
		// echo 'yes updated';
	}else if ($db_success == 0) {
		// echo 'non affected';
	}else if ($db_success == -1) {
		// echo 'there was an error';
	}

	// echo "<pre>";
	// var_dump($_SESSION);
	// echo "<br>Email:" . $_SESSION['catering']['customer_info']['customer_email'] . "<br>";

	$email = new sendEmail();
	// Set email sender and receiver
	$email->setSender('From Catering','su-retailcatering@email.arizona.edu');
	$email->setReceiver('Customer',$_SESSION['catering']['customer_info']['customer_email']);
	

	$email->setReceiver('Web Manager','su-web@email.arizona.edu');
	//NEED $email->setReceiver('Catering Manager','su-retailcatering@email.arizona.edu');

	// $email->setReceiver('Highland Manager','SU-HighlandBurritoCatering@email.arizona.edu');
	$email->setReceiver('Catering Manager','su-retailcatering@email.arizona.edu');
	// $email->setReceiver('Web Manager','su-web@email.arizona.edu');

	// var_dump($_SESSION['catering']['customer_info']);
	// var_dump($_SESSION['catering']['burritos']);

	$email->changeEmailSetting('msgContainHtml',true);

	// echo printOrder();
	// $msg = 'Thank you for ordering from Highland Burrito! Your order request was successfully received and is being reviewed. You will receive an email response when further action is taken, or if more information is required.';
	// printOrder($msg, $_POST['additional_comment']);

	// Email to customer
	$email->setEmailTitle('Highland Market : Catering Order');
	$msg = 'Thank you for ordering from Highland Burrito! Your order request was successfully received and is being reviewed. You will receive an email response when further action is taken, or if more information is required.';
	$email->setMessage(printOrder($msg, $_POST['additional_comment']));
	$email->finallySendEmail('From Catering','Customer');

	if ($_SESSION['catering']['customer_info']['method'] == 'Delivery'){
		// Email to onsite
		$email->setReceiver('Onsite',$_SESSION['catering']['customer_info']['onsite_email']);
		$email->setEmailTitle('Highland Market : Catering Order');
		$msg = 'Thank you for ordering from Highland Burrito! Your order request was successfully received and is being reviewed. You will receive an email response when further action is taken, or if more information is required.';
		$email->setMessage(printOrder($msg, $_POST['additional_comment']));
		$email->finallySendEmail('From Catering','Onsite');
	}

	// Email to highland manager
	$email->setEmailTitle('Highland Market : Catering Order');
	$msg = 'We\'ve received a new order for Highland Burrito catering!<br/> Please check the order and follow up.';
	$email->setMessage(printOrder($msg, $_POST['additional_comment']));
	$email->finallySendEmail('From Catering','Catering Manager');
	$email->finallySendEmail('From Catering','Web Manager');
	
	// Email to printer
	// $email->setEmailTitle('Highland Market : Catering Order');
	// $email->setMessage($print_order_detail);
	// $email->finallySendEmail('From Catering','Printer');


	$_SESSION['catering_status']['review'] = true;
	// header("Location: /catering/online/order_complete.php");
	exit(header("Location: /catering/online/order_complete.php"));
}


// Sent user to customer information page
header("Location: ../index.php");

function printOrder($msg, $comment){
	$customer_info = $_SESSION['catering']['customer_info'];
	$burritos = $_SESSION['catering']['burritos'];
	$extra = $_SESSION['catering']['extra'];
	
	$wrap_order = "width:700px;";
	$top_title = "font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;";
	$panel = "font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; border-collapse: collapse; border: 1px solid #f1f1f1;";
	$title = "width:100%; background-color: #a8bb63; border: 1px solid #f1f1f1; color: #525252; font-weight: 700 !important;";
	$table_header = "padding: 10px 15px; font-size:17px; background-color: #a8bb63; color: #525252; font-weight: 700 !important;";
	$panel_body = "padding: 15px;";
	$row = "border: 1px solid #f1f1f1;";
	$row_header ="font-size:15px;";
	$cell_padding = "padding:5px; border: 1px solid #f1f1f1;";
	$cell = "font-size:14px;";
	$burr_header = "width: 100px;";
	$extra_header = "width: 150px;";
	$sub_price = "width:70px; color:#a21b1b;";
	$sub_total = "font-size:16px; font-weight:700; text-align:right;";
	$tax_style = "font-size:18px; font-weight:500; text-align:right;";
	$total_style = "font-size:24px; font-weight:700; text-align:right;";

	$print = '
	<div style="'.$wrap_order.'">

	<table style="'.$top_title.' width:520px;">
		<tr>'.$msg.'</tr>
		<tr style=""><th style="padding: 10px 15px; font-size:20px;" border="0" colspan="1">Order Detail <br />
		<span style="font-size:14px;">(Order Number: '.$customer_info['id'].')</span>
		</th>
		</tr>
	
	<tr style="'.$panel_body.'"><td>
	<table style="'.$panel.' width:500px;" align="center" cellspacing="10">
		<tr style="'.$title.'">
			<th style="'.$table_header.'" align="center" valign="middle" colspan="2">
				<span>Customer Information</span>
			</th>
		</tr>
		<tr style="'.$row.'">
			<th style="'.$cell_padding.$row_header.'">Delivery Method</th>
			<td style="'.$cell_padding.$cell.'">'.$customer_info['method'].'</td>
		</tr>

		<tr style="'.$row.'">
			<th style="'.$cell_padding.$row_header.'">'.$customer_info['method'].' Date</th>
			<td style="'.$cell_padding.$cell.'">'.date("m/d/Y", strtotime($customer_info['delivery_date'])).'</td>
		</tr>
		
		<tr style="'.$row.'">
			<th style="'.$cell_padding.$row_header.'">'.$customer_info['method'].' Time</th>
			<td style="'.$cell_padding.$cell.'">'.$customer_info['delivery_time'].'</td>
		</tr>';

	if ($customer_info['method']=="Delivery"){
		$print .= '
			<tr>
				<th style="'.$cell_padding.$row_header.'">Delivery Building</th>
				<td style="'.$cell_padding.$cell.'">'.$customer_info['delivery_building'].'</td>
			</tr>

			<tr>
				<th style="'.$cell_padding.$row_header.'">Delivery Room</th>
				<td style="'.$cell_padding.$cell.'">'.$customer_info['delivery_room'].'</td>
			</tr>

			<tr>
				<th style="'.$cell_padding.$row_header.'">On-site Contact</th>
				<td style="'.$cell_padding.$cell.'">'. $customer_info['onsite_name'].'</td>
			</tr>

			<tr>
				<th style="'.$cell_padding.$row_header.'">On-site Email</th>
				<td style="'.$cell_padding.$cell.'">'. $customer_info['onsite_email'].'</td>
			</tr>

			<tr>
				<th style="'.$cell_padding.$row_header.'">On-site Phone</th>
				<td style="'.$cell_padding.$cell.'">'. $customer_info['onsite_phone'].'</td>
			</tr>';
	}

$print .= '<tr>
			<th style="'.$cell_padding.$row_header.'">Customer Name</th>
			<td style="'.$cell_padding.$cell.'">'. $customer_info['customer_name'].'</td>
		</tr>

		<tr>
			<th style="'.$cell_padding.$row_header.'">Customer Phone</th>
			<td style="'.$cell_padding.$cell.'">'. $customer_info['customer_phone'].'</td>
		</tr>

		<tr>
			<th style="'.$cell_padding.$row_header.'">Customer Email</th>
			<td style="'.$cell_padding.$cell.'">'. $customer_info['customer_email'].'</td>
		</tr>

		<tr>
			<th style="'.$cell_padding.$row_header.'">Customer Notes</th>
			<td style="'.$cell_padding.$cell.'">'. $customer_info['delivery_notes'].'</td>
		</tr>

		<tr>
			<th style="'.$cell_padding.$row_header.'">Payment Method</th>
			<td style="'.$cell_padding.$cell.'">'. $customer_info['payment_method'].'</td>
		</tr>';
		
		if($customer_info['payment_method'] == 'IDB'){
						$print .= '
									<tr>
										<th style="'.$cell_padding.$row_header.'">Account Number</th>
										<td style="'.$cell_padding.$cell.'">'. $customer_info['account_num'].'</td>
									</tr>
						';
						if($customer_info['sub_code']){
								$print .='
									<tr>
										<th style="'.$cell_padding.$row_header.'">Sub Code</th>
										<td style="'.$cell_padding.$cell.'">'. $customer_info['sub_code'].'</td>
									</tr>	
								';
							}
			}
		
	$print .='</table>

		</tr></td>

		<tr style="'.$panel_body.'">
			<td align="center">';

			$total = 0;

			$pack = 0;
			$pack_num = 0;
			$burrito_num = 0;
			// var_dump($burritos);
			foreach ($burritos as $burrito) {
				// New pack start
				if ($pack_num != $burrito["pack_num"]){
					$extra_meat_subTotal = 0;
					$print .= '<table style="'.$panel.' width:500px;">';
					$pack = $burrito['pack'];
					$pack_num = $burrito["pack_num"];
					$burrito_num = 0;
					$print .= '<tr><th style="'.$table_header.'" colspan="3">Pack '.$burrito['pack'].' #'.$burrito['pack_num'].'</th></tr>';
					// $print .= '<ul style="'.$list_group.'">';
				}

				// Wrap burrito
				// $print .= '<li style="'.$list_group_item.'">';
				// $print .= '<b> burrito #'.$burrito['burrito_num'].'</b> - ';
				$print .= '<tr>
							  <th style="'.$burr_header.$cell_padding.$row_header.'"> burrito #'.$burrito['burrito_num'].'</th>
							  <td style="'.$cell_padding.$cell.'">';

				$meat = 'meat_';
				$print_burr = '';
				$extra_meat_count = -1;
				for ($i=1; $i < 5; $i++) { 
					if ($burrito[$meat.$i]!=""){
						$print_burr .= $burrito[$meat.$i].', ';
						$extra_meat_count++;
					}
				}

				$vegi = 'vege_';
				for ($i=1; $i < 5; $i++) { 
					if ($burrito[$vegi.$i]!=""){
						$print_burr .= $burrito[$vegi.$i].', ';
					}
				}

				$print_burr = rtrim($print_burr,', ');
				$print .= $print_burr.'</td>';

				$print .= '<td style="'.$cell_padding.$cell.$sub_price.'">';
				if ($extra_meat_count > 0){
					$print .= '+ $'.($extra_meat_count*2).'.00';
					$extra_meat_subTotal += $extra_meat_count;
				}
				$print .= '</td>';

				// $extra_meat_subTotal += $extra_meat_count;

				$print .= '</tr>';

				$burrito_num++;

				// End panel
				if ($burrito_num == $pack){
					// Reset burrito_num and pack_num
					$burrito_num = 0;
					$pack_num = 0;
					// Print sub total for each pack
					$print .= '<tr class="list-group-item">';
					$print .= '<td style="'.$sub_total.'" colspan="3">Pack Subtotal : $';
					if ($pack == 12){
						$tempTotal = 120+($extra_meat_subTotal*2);
						// $print .= $tempTotal;
						$print .= '120.00';
					}else {
						$tempTotal = 89+($extra_meat_subTotal*2);
						// $print .= $tempTotal;
						$print .= '89.00';
					}
					$total += $tempTotal;

					if ($extra_meat_subTotal != 0){
						$print .= ' <span style="color:#a21b1b;">+ $'.$extra_meat_subTotal*2;
						$print .= '.00</span>';
					}

					$print .= '</td>';
					$print .= '</tr>';

					// Wrap pack
					$print .= '</table>';
				}
				// if ($burrito_num == $burrito['pack']){
				// 	$print .= '</table>';
				// }
			}
		$print .= '</td></tr>';

		$print .= '<tr style="'.$panel_body.'"><td align="center"><table style="'.$panel.' width:500px;">
				<tr><th style="'.$table_header.'" colspan="3">Extra</th></tr>
				<tr>
					<th style="'.$extra_header.$cell_padding.$row_header.'">Extra Chips, Salsa, Sour cream, and Guacamole</th>
					<td style="'.$cell_padding.$cell.'">'.$extra['extra_chips'].'</td><td style="'.$cell_padding.$cell.$sub_price.'"> $'.number_format($extra['extra_chips']*3, 2, '.', ' ').'</td>
				</tr>';
				
		//$extra_total = ($extra['extra_chips'] + $extra['extra_salsa'] + $extra['extra_sourcream'] + $extra['extra_guacamole'])*3;
		$extra_total = ($extra['extra_chips'])*3;
		// Need to print out coke, diet coke, sprite
		if ($extra['upgrade'] != 0){
			// $print .= '<ul style="'.$list_group.'">';
			$upgrade_cost = 0;

			if($extra['upgrade'] == 12) {
				$upgrade_cost = 18.00;
			} elseif($extra['upgrade'] == 8) {
				$upgrade_cost = 12.00;
			}

			$print .= '<tr><th style="'.$extra_header.$cell_padding.$row_header.'">Upgrade</th><td style="'.$cell_padding.$cell.'">'.$extra["upgrade"].'</td><td style="'.$cell_padding.$cell.$sub_price.'">$'.number_format($upgrade_cost/*($extra['upgrade']*6.00)*/, 2, '.', ' ').'</td></tr>';


			$extra_total = $extra_total+number_format($upgrade_cost, 2, '.', ' ');
			if ($extra['coke'] != 0){
				$print .= '<tr><th style="'.$extra_header.$cell_padding.$row_header.'">Coke</th><td style="'.$cell_padding.$cell.'">'.$extra["coke"].'</td><td></td></tr>';
				// $extra_total = $extra_total+$extra['coke']*5.99;
			}

			if ($extra['diet_coke'] != 0){
				$print .= '<tr><th style="'.$extra_header.$cell_padding.$row_header.'">Diet Coke</th><td style="'.$cell_padding.$cell.'">'.$extra["diet_coke"].'</td><td></td></tr>';
				// $extra_total = $extra_total+$extra['diet_coke']*5.99;
			}

			if ($extra['sprite'] != 0){
				$print .= '<tr><th style="'.$extra_header.$cell_padding.$row_header.'">Sprite</th><td style="'.$cell_padding.$cell.'">'.$extra["sprite"].'</td><td></td></tr>';
				// $extra_total = $extra_total+$extra['coke_zero']*5.99;
			}

			if ($extra['fanta'] != 0){
				$print .= '<tr><th style="'.$extra_header.$cell_padding.$row_header.'">Fanta</th><td style=".$cell_padding.$cell.">'.$extra["fanta"].'</td><td></td></tr>';
				// $extra_total = $extra_total+$extra['dr_pepper']*5.99;
			}

			if ($extra['water'] != 0){
				$print .= '<tr><th style="'.$extra_header.$cell_padding.$row_header.'">Dasani Water</th><td style="'.$cell_padding.$cell.'">'.$extra["water"].'</td><td></td></tr>';
				// $extra_total = $extra_total+$extra['dr_pepper']*5.99;
			}
			// $print .= '</ul>';
		}
		// $print .= '</li>';

		$print .= '<tr><td style="'.$sub_total.'" colspan="3">Extra Subtotal : $'.number_format($extra_total, 2, '.', ' ').'</td></tr>';
		$print .= '</table>
					</tr>';
		$print .= '</td>';

		$print .= '<tr><td style="'.$tax_style.' padding: 10px;" colspan="3">Pack Subtotal + Extra Subtotal : $'.number_format(($total+$extra_total), 2, '.', ' ').'</td></tr>';
		$print .= '<tr><td style="'.$tax_style.' padding: 10px;" colspan="3">Tax (6.1%) : $'.number_format(($total+$extra_total)*6.1/100, 2, '.', ' ').'</td></tr>';
		$print .= '<tr><td style="'.$total_style.' padding: 10px;" colspan="3">Total : $'.number_format(($total+$extra_total)*106.1/100, 2, '.', ' ').'</td></tr>';
		$print .= '</table>';
		$print .= '<table style="'.$top_title.' width:520px; padding: 8px;">';
		$print .= '<tr style="padding:15px;">
				   	<th style="'.$extra_header.$cell_padding.$row_header.'">Additionl Comment</th>
					<td style="'.$cell_padding.$cell.'">'.$comment.'</td>
				   </tr>';
		$print .= '</table>';
return $print;
}