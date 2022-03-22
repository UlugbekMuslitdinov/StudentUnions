<?php
// header("Location: ../../index.php");
// die();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
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
<html>
<head>
	<title>Valentine Dinner To-Go</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="StyleSheet" href="/template/global.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- this is not most recent bootstrap -->
<link rel="stylesheet" type="text/css" href="/valendine/css/dinnertogo.css">
<SCRIPT LANGUAGE="javascript">
// Check form.
function checkForm() {
	var name = document.getElementById("client_name").value;
	var phone = document.getElementById("client_phone").value;
	var email = document.getElementById("client_email").value;
	var q_1 = document.getElementById("quantity_menu1").value;
	var q_2 = document.getElementById("quantity_menu2").value;
 
    if (name == "") {
    alert("Please enter Name and re-Submit.");
    return false;
	}
	if (phone == "") {
    alert("Please enter Phone and re-Submit.");
    return false;
	}
	if (email == "") {
    alert("Please enter Email and re-Submit.");
    return false;
	}
	if ((q_1 == 0) && (q_2 == 0)) {
	alert("Please select a Menu and re-Submit.");	
	return false;
	}
	// Validate Pickup Date.
	var radios = document.getElementsByName('info-pickup');
	var checkCounter = 0;
		for(const radio of radios){
			if(radio.checked){
				checkCounter++;
			}
		}
	if (!checkCounter) {
		alert("Please select Pickup Date and re-Submit.");	
		return false;
	} 
	// Validate Payment.
	var radios = document.getElementsByName('payment');
	var checkCounter = 0;
		for(const radio of radios){
			if(radio.checked){
				checkCounter++;
			}
		}
	if (!checkCounter) {
		alert("Please select Payment and re-Submit.");	
		return false;
	} 
  return true;
}
</SCRIPT>
<style>
.error-message {
	font-size: 16px;
	font-weight: bold;
	color: red;
	background-color: yellow;
	padding: 5px;
}
#menu_1_td, #menu_2_td {		
	border: solid black 0px;
	padding: 5px;
}

#menu1_label, #menu2_label {
	font-size:24px; 
	font-family: Helvetica, Arial, sans-serif;
	color: black !important;
	height: 100%;
}
#menu-info {
	border: black solid 1px;
	padding: 5px;
}
#green_option {
	color: limegreen;
}
#title {
	background-color: #51272b;
	color: white;
	padding: 0 5px 0 5px;
	line-height: 1.5; /* prevents purple padding merging with words on next line */
}
h4 {
	margin:0;	
	padding:0;
}
small, #subtitle {
	color: #912a3b !important;
	font-weight: bold !important;
}
#menu_1, #menu_2 {
	font-size:4rem;
	font-weight: bold;
	margin-left: 2px;
}
#quantity {
	padding-top:2px;
	font-weight: bold;
	font-size: 20px;
}
input[type='number']{
    width: 80px;
} 
</style>

<?php
$fields = array_fill_keys(Array(
	"info-name",
	"info-phone",
	"info-email",
	"info-pickup"
), "");
?>


<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$hidden_q1 = $_POST['hidden_q1'];
	$hidden_q2 = $_POST['hidden_q2'];
	$hidden_total = $hidden_q1 + $hidden_q2;
	$total_before_tax = $hidden_total * 59; //order is $59 each
	$tax_total = $total_before_tax * 0.061;
	$grandTotal = $total_before_tax + $tax_total;
	$grandTotal = number_format((float)$grandTotal, 2, '.', '');
	$menu_1 = $_POST['menu_1'];
	$menu_2 = $_POST['menu_2'];
	$quantity_menu1 = $_POST['quantity_menu1'];
	$quantity_menu2 = $_POST['quantity_menu2'];
	//print("Menu: " . $menu_1 . "<br />");
//	print("Menu: " . $menu_2 . "<br />");
//	print("Q: " . $quantity_menu1 . "<br />");
//	print("Q: " . $quantity_menu2 . "<br />");
//	exit();
	$pickupday = $_POST["info-pickup"];
	$payment = $_POST['payment'];
	// $menuOption = $_POST['menu']; //can be 1 or 2;
	
	//for 2022
	if ($pickupday === 'Feb11'){
		$pickupday = "2022-02-11";
	} else {
		$pickupday = "2022-02-14";
	}
	// Add description for the payment option.
	switch ($payment) {
			case 1:
				$payment_type = "Credit Card/ Debit Card";
				$status = "Started";
				$payment_message = "";
				break;
			case 2:
				$payment_type = "Meal Plan";
				$status = "Not Paid";
				$payment_message = "<p><b>A team member from Dining Services will contact you for Meal Plan/Cat Cash payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
			case 3:
				$payment_type = "Other";
				$status = "Not Paid";
				$payment_message = "<p><b>A team member from Dining Services will contact you for your IDB payment shortly.  Payment must be received prior to pick up.</b></p>";
				break;
	}
	
	if($grandTotal <= 0){ 	//even though user cannot select 0 items, they may be able to submit form at $0
		$formerrors["general-error"] = "You must select some food to place an order.";
	}
	
	//if (!$menu) {
	//	$formerrors["general-error"] = "You must select one menu to place an order.";
	//}
		
	// if(empty($formerrors)){
	if(($quantity_menu1 > 0) || ($quantity_menu2 > 0)){
		$success = true;
		$subject = "Valentine Dinner To-Go Order Confirmation - " . date("F j, Y, g:i a") . "";
		$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n";
		$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
		// $headers .= "Bcc: angelicg@arizona.edu\r\n";
		$headers .= "Bcc: su-web@email.arizona.edu\r\n";
		// $headers .= "Bcc: yontaek@email.arizona.edu\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body style="font-family: arial, sans-serif;font-size: 13px;">
				<br /><h3 style="width:100%;border-top:1px solid #333;border-bottom:1px solid #333;padding-top:5px;padding-bottom:6px;margin-top:0px;margin-bottom:10px;">Valentine Dinner To-Go Order Summary:</h3>
				<h4>Menu 1 Quantity - ' . $quantity_menu1 . '</h4>
				<h4>Menu 2 Quantity - ' . $quantity_menu2 . '</h4>';
		$message .= '<table width="95%" border="0" id="datenight-table" cellspacing="0">
  					<tbody>
    					<tr>
     							<td id="menu-info" valign="top"></td>
						</tr>';
		//if ($quantity_menu1 > '0') { //add menu1 to message
//			$message .= '<table width="95%" border="0" id="datenight-table" cellspacing="0">
//  					<tbody>
//    						<tr>
//     							<td id="menu-info" valign="top">
//								<p><span id="title" style="font-weight:bold;">Menu 1 - Quantity</span><br>
//        						</p>
//								</td>
//						</tr>';
//		} else { //add menu2 to message
//			$message .= '<table width="95%" border="0" id="datenight-table" cellspacing="0">
//  					<tbody>
//    						<tr>
//							<td id="menu-info" valign="top"><p><span id="title" style="font-weight:bold;">Starter</span><br>
//						        <span style="font-style:italic;">Unbeetable Salad</span><br>
//						        Spinach, Tomatoes, Pumpkin Seeds, Roasted Beets, Red Onion, and Balsamic Vinaigrette</p>
//						        <p><span id="title" style="font-weight:bold;">Entrée</span><br>
//						        <span style="font-style:italic;">Baked Lentil Pasta</span><br>
//						        Plum Tomatoes, Roasted Red Peppers, Basil, Vegan Cheese and Cream</p>
//						        <p><span id="title" style="font-weight:bold;">Sides</span><br>
//						        Rosemary Fingerling Potatoes<br>
//						        Roasted Tri-Color Cauliflower<br>
//						        Three Bean Relish<br><br>
//						        Cheese Bread and Butter</p>
//						        <p><span id="title" style="font-weight:bold;">Dessert</span><br>
//						        Tropical Mousse Cheese Cake<br><br>
//						        </p></td>
//						</tr>';
//		}
		$message .= '
		<div style="float:left">
			<tr style="border-top: 2px solid black; float:left;">
				<td><b>Total: </b>$'.number_format($total_before_tax, 2).'</td>
			</tr>
			</tr>
			<tr style="border-top: 2px solid black; float:left;">
				<td><b>Tax: </b>$'.number_format($tax_total, 2).'</td>
			</tr>
			<tr style="border-top: 2px solid black; float:left;">
				<td><b>Grand Total: $'.number_format($grandTotal, 2).'</b></td>
			</tr>
		</div>
		</tbody></table><br/>
		<b>Name:</b> '.$_POST["client_name"].'<br/>
		<b>Email Address:</b> '.$_POST["client_email"].'<br/>
		<b>Phone #:</b> '.$_POST["client_phone"].'<br/>
		<b>Pickup Day:</b> '.$pickupday.'<br/>
		<b>Pickup Times:</b> 2:00 pm - 4:30 pm<br/>
		<b>Pickup Location:</b> On Deck Deli<br/>
		<b>Payment Method:</b> '.$payment_type.'<br/>
		</body>
		</html>';
		
		// in 2022
		$time = "2:00 pm - 4:30 pm";
		$location = "On Deck Deli";
		
		// Store the information into the database.
		$db = new db_mysqli('su');
		$query = "insert into forms set " . 
			"form = 'Valentine Dinner To-Go'" .
			", name = '" . $_POST["client_name"] .
	     		"', email = '" . $_POST["client_email"] .
			"', phone = '" . $_POST["client_phone"] .
			"', pickupday = '" . $pickupday .
			"', pickuptime = '" . $time .
			"', pickuplocation = '" . $location .  
			"', payment = '" . $payment_type .  
			"', totalamount = '" . $total_before_tax .	
			"', totalamount_2 = '" . $grandTotal .	
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
			header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/datenightmenu_handler.php?id=" . $max_id . "&total=" . $grandTotal . "");
			exit();
		} else {		
			mail($_POST["client_email"], $subject, $message, $headers);
	}
	} else {
		print("You need to select, at least, one Menu item.  Please go back and try again.");
		exit();
	}  // If open at 146	
}  // If open at 94
if($success){ 
		header("Location: http://".$_SERVER[HTTP_HOST]."/valendine/index.php?confirm=feast");
} else { ?> 
<body class="togo_order">

	<div class="container-fluid" id="" style="background-color: white !important; max-width:950px;" >
		<div class="row">
			<div class="col-sm-12 tgo-header no-padding">
				<img class="img-fluid" src="/template/images/banners/valentine_dinnertogo.jpg"><br />
			</div>

			<div class="col-sm-12 order-form">
			<form class="form-inline" action="" method="POST" enctype="multipart/form-data"  onSubmit="return checkForm();">
				<div class="row">
					
						<div class="form-group col-sm-4 p-1">
							<label for="client_name" class="font-serif-italic">NAME:</label>
							<input type="text" name="client_name" class="client-contact-input client-name" id="client_name" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'client_name'); ?>" >
							<br><span class="font-serif-italic" style="color: #5f407c; font-size: 12px;">REQUIRED</span>
						</div>
						<div class="form-group col-sm-3 p-1">
							<label for="client_phone" class="font-serif-italic">PHONE:</label>
							<input type="text" name="client_phone" class="client-contact-input client-phone" id="client_phone" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'client_phone'); ?>" >
							<br><span class="font-serif-italic"  style="color: #5f407c; font-size: 12px;">REQUIRED</span>
						</div>
						<div class="form-group col-sm-4 p-1">
							<label for="client_email" class="font-serif-italic">EMAIL:</label>
							<input type="email" name="client_email" class="client-contact-input client-email" id="client_email" value="<?php echo togoForm_oldInputs($togoForm_old_inputs,'client_email'); ?>" >
							<br><span class="font-serif-italic"  style="color: #5f407c; font-size: 12px;">REQUIRED</span>
						</div>
					
				</div>
			

<p>&nbsp;</p>

				<div class="row" style="margin-left:-45px;">
					<div class="col-sm-12" align="center">

<table class="" width="95%" border="0" id="datenight-table" cellspacing="0">
  <thead>
    <tr>
      <th width="50%" id="menu_1_td"><h2>
		  <label for="menu_1" id="menu1_label" style="line-height:1.6;"><input type="checkbox" id="menu_1" name="menu_1" value="1" style="" onClick="selectMenu(1)" >
		  &nbsp;Menu 1</label></h2>
	  </th><span> </span>
      <th width="50%" id="menu_2_td"><h2>
		  <label for="menu_2" id="menu2_label" style="line-height:1.6;" ><input type="checkbox" id="menu_2" name="menu_2" value="2" onClick="selectMenu(2)" >
		  &nbsp;Menu 2 (<span id="green_option">Plant-Based Option</span>)</label></h2></th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td id="menu-info" valign="top"><p><h4><span id="title">Starter</span><br>
        <small>Iceberg Wedge Salad</small></h4>
        Smoked Bacon, Goat Cheese, Cured Tomato, and Creamy Ranch</p>
      </td>
      <td id="menu-info" valign="top"><p><h4><span id="title">Starter</span><br>
        <small>Unbeetable Salad</small></h4>
        Spinach, Tomatoes, Pumpkin Seeds, Roasted Beets, Red Onion, and Balsamic Vinaigrette</p>
      </td>
    </tr>
    <tr>
      <td id="menu-info" valign="top"><p><h4><span id="title">Entrée</span><br>
          <small>Ribeye Steak</small></h4>
          Roasted Mushrooms and Demi-Glace</p>
      </td>
      <td id="menu-info" valign="top"><p><h4><span id="title">Entrée</span><br>
          <small>Baked Lentil Pasta</small></h4>
          Plum Tomatoes, Roasted Red Peppers, Basil, Vegan Cheese and Cream</p>
      </td>
    </tr>
      <td id="menu-info" valign="top"><p><h4><span id="title">Sides</span><br>
          <small>- Creamy Yukon Gold Mashed Potatoes<br>
          - Roasted Tri-Color Cauliflower<br>
          - Grilled Jumbo Asparagus, Orange Zest<br>
        - Brioche Bread and Butter</small></h4></p>
      </td>
      <td id="menu-info" valign="top"><p><h4><span id="title">Sides</span><br>
          <small>- Rosemary Fingerling Potatoes<br>
          - Roasted Tri-Color Cauliflower<br>
          - Three Bean Relish<br>
        - Cheese Bread and Butter</small></h4></p>
      </td>
    </tr>
    <tr>
      <td id="menu-info" valign="top"><p><h4><span id="title">Dessert</span><br>
          <small>Chocolate Decadence Cake<br>
        </small></h4></p>
      </td>      
      <td id="menu-info" valign="top"><p><h4><span id="title">Dessert</span><br>
          <small>Tropical Mousse Cheese Cake<br>
        </small></h4></p>
      </td>
    </tr>
    <tr>
      <td id="quantity">Quantity: 
		  <input type="number" id="quantity_menu1" onChange="updateTotal(1)" name="quantity_menu1" value="0" size="5" min="0" >
		  <input type="hidden" id="hidden_q1" name="hidden_q1" >
	  </td>
      <td id="quantity">Quantity: 
		  <input type="number" id="quantity_menu2" onChange="updateTotal(2)" name="quantity_menu2" value="0" size="5" min="0" >
		  <input type="hidden" id="hidden_q2" name="hidden_q2" >
	  </td>
    </tr>
  </tbody>
</table>
					</div>
<p>&nbsp;</p>
					<div style="margin-left:60px;"><h4>
					Select a Pickup Date<span style="font-size:25px; font-weight: bold; color: red;">*</span>:<br />
						<input type="radio" name="info-pickup" id="date_1" value="Feb11" style="font-size:3rem;"  /><small>&nbsp;<label for="date_1">Fri, Feb. 11,   2:00 pm - 4:30 pm</label></small><br />
						<input type="radio" name="info-pickup" id="date_2" value="Feb14" style="font-size:3rem;" /><small>&nbsp;<label for="date_2">Mon, Feb. 14,   2:00 pm - 4:30 pm</label></small><br />
					</h4></div>
<p>&nbsp;</p>
					<div style="margin-left:60px;"><h4>
					Pickup Location:<br />
					<label for="date_1">On Deck Deli located in SUMC Food Court</label>
					</div>

<p>&nbsp;</p>	
				<!--	<div class="" style="padding: 10px 30px 0px 0px; border: 0px solid #333;">
							<b style="font-weight: bolder; letter-spacing: -0.5px;">TOTAL: <span id="" style="color: black; font-size: 30px; font-weight: bold;">$</span></b>
							<span id="total-no-tax" style="color: #BE1E35; font-size: 30px; font-weight: bold;"></span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b style="font-weight: bolder; letter-spacing: -0.5px;">TAX: <span id="" style="color: black; font-size: 30px; font-weight: bold;">$</span></b>
							<span id="tax" style="color: #BE1E35; font-size: 30px; font-weight: bold;">0.00</span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b style="font-weight: bolder; letter-spacing: -0.5px;">GRAND TOTAL: <span id="" style="color: black; font-size: 30px; font-weight: bold;">$</span></b>
						    <span id="total-price" style="color: #BE1E35; font-size: 30px; font-weight: bold;">0.00</span>
					</div> -->
					
					<div class="form-group grand-total row">
						<label for="total-no-tax" class="grand_total col-xs-3 "><div id="grand-text" style="display:inline; ">TOTAL:</div>
						<div>$<span id="total-no-tax" name="total-no-tax">0</span></div></label>
						
						<label for="tax" class="grand_total col-xs-3"><div id="grand-text" style="display:inline;">TAX:</div>
						<div>$<span id="tax" name="tax">0</span></div></label>
						
						<label for="grand_total" class="grand_total col-xs-6"><div id="grand-text">GRAND TOTAL:</div>
						<div>$<span id="grand_total" name="grand_total">0</span></div></label>
					</div> 

				</div>

				
<br>
				<div>
					<table style="width: 100%;">
						<tr>
							<td width="18%"><b><span style="font-size:16px; margin-bottom:20px;">Payment Option:</span></b><span style="font-size:25px;color:red;">*</span></td>
							<td width="82%">
								<input type="radio" value="1" name="payment" id="card" style="height:15px;width:15px; margin-bottom:10px;" value="CREDIT CARD / DEBIT CARD"  />&nbsp;<label for="card" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">CREDIT CARD / DEBIT CARD</label>&nbsp;&nbsp;
								<input type="radio" value="2" name="payment" id="meal_plan" style="height:15px;width:15px; margin-bottom:10px;" value="MEAL PLAN"  />&nbsp;<label for="meal_plan" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">MEAL PLAN</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" value="3" name="payment" id="other_payment" style="height:15px;width:15px; margin-bottom:10px;" value="OTHER PAYMENT METHOD"  />&nbsp;<label for="other_payment" style="width: 200px;background-color: #ad1136;color: white !important;font-size: 14px;font-weight: bolder;border: none;border-radius: 5px;padding: 8px;text-align: center;">Other</label>
							</td>
						</tr>
					</table>
				</div>
				
				<div>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <td></td>
						  <td><span class="sh-right" style="padding: 0; width: 100%;">
						<!--<input id="button-submit" type="submit" value="SUBMIT"/>-->
						<div id="error_message"></div>
					    <button type="submit" id="btn-submit" class="order-submit-btn" name="submit"><img src="/dining/sumc/images/Submit.png" width="170"></button>
					</span></td>
						</tr>
					  </tbody>
					</table>					
				</div>
				<br>
		
			</form>
			</div>
				
				<div class="row" align="center">
					<div class="col-md-12">
						<img class="img-fluid" src="./images/thanksgiving_sides_bottom_2.png" style="height:4rem;max-width: 100%;" />
					</div><br /><br />
				</div><br /><br />
		</div>
	</div>
	<script>

function selectMenu(menuNum) {
	var select_1 = document.getElementById("menu_1");
	var select_2 = document.getElementById("menu_2");
	var total = document.getElementById("grand_total");
	var total_no_tax = document.getElementById("total-no-tax");
	var tax = document.getElementById("tax");
	var quantity_1 = document.getElementById("quantity_menu1");
	var quantity_2 = document.getElementById("quantity_menu2");
	// Hidden qunatity values to process them in email.
	var hidden_q1 = document.getElementById("hidden_q1");
	var hidden_q2 = document.getElementById("hidden_q2");
	
	// Update Quantity depending on the check box selection.
	if (select_1.checked && menuNum===1) {
		quantity_1.value = 1;
		quantity_1.min = 1;
		quantity_1.max = 999;
		hidden_q1.value = 1;
	} else if (!select_1.checked && menuNum===1){
		quantity_1.value = 0;
		quantity_1.min = 0;
		quantity_1.max = 0;
		hidden_q1.value = 0;
	}
	if (select_2.checked && menuNum===2) {
		quantity_2.value = 1;
		quantity_2.min = 1;
		quantity_2.max = 999;
		hidden_q2.value = 1;
	} else if (!select_2.checked && menuNum===2) {
		quantity_2.value = 0;
		quantity_2.min = 0;
		quantity_2.max = 0;
		hidden_q2.value = 0;
	}
	// Quantities can change.
	quantity_1.disabled = false;
	quantity_2.disabled = false;
	// Update the Grand Total amount with the checkbox selection.
	var no_tax_total = Number(quantity_1.value) + Number(quantity_2.value);
	no_tax_total *= 59;
	var tax_total = no_tax_total * 0.061;
	var grant_total = tax_total + no_tax_total;
	total.innerHTML = grant_total.toFixed(2); /* Calculate the Grand Total.*/
	total_no_tax.innerHTML = no_tax_total.toFixed(2);
	tax.innerHTML = tax_total.toFixed(2);
}
function updateTotal(menuNum) {
	// Update hidden qunatity values to process them in email.
	var hidden_q1 = document.getElementById("hidden_q1");
	var hidden_q2 = document.getElementById("hidden_q2");
	// Display the Grant Total on the screen.
	var total = document.getElementById("grand_total");
	var total_no_tax = document.getElementById("total-no-tax");
	var tax = document.getElementById("tax");
	var amountOrdered_1 = document.getElementById("quantity_menu1").value;
	var amountOrdered_2 = document.getElementById("quantity_menu2").value;
	hidden_q1.value = document.getElementById("quantity_menu1").value;
	hidden_q2.value = document.getElementById("quantity_menu2").value;
	var amountOrdered = Number(amountOrdered_1) + Number(amountOrdered_2);
	var no_tax_total = 59 * amountOrdered;
	var tax_total = no_tax_total * 0.061;
	var grand_total = tax_total + no_tax_total;
	total_no_tax.innerHTML = no_tax_total.toFixed(2);
	total_no_tax.value = no_tax_total.toFixed(2);
	tax.innerHTML = tax_total.toFixed(2);
	total.innerHTML = grand_total.toFixed(2);
	
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php } ?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



		<?php
		unset($_SESSION['togoForm_old_inputs']);
		?>

