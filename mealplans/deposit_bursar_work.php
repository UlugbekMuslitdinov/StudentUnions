<?php

ini_set('default_socket_timeout', 10);
session_start();
require_once('template/mp.inc');
require_once('includes/bursars.inc');
//require_once('includes/mp_cardtaker.inc');
require_once('cybersource_submit.php');
require_once ('includes/mysqli.inc');
$db = new db_mysqli('mealplans');
$result = $db->query("select * from config");
$config = mysqli_fetch_assoc($result);

// get deadline from db for bursar deposits and convert to unix time format
$bursarDeadline = strtotime($config['bursar_deposit_deadline']);

// pull date only (not time) from db deadline value for use in messaging
$bursarDeadlineText = date("n/j/Y", $bursarDeadline);

//make sure a user is currently logged in and session hasn't expired
if(!isset($_SESSION['mp_cust']['id'])){
	?>
	<script>
		window.parent.location = "index.php";
	</script>
	<?php
}

//make sure someone didn't just manualy hit this address while account was in different state
if($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account'){
	?>
	<script>
		window.parent.location = "index.php";
	</script>
	<?php
}

//check to see if MP is in a state that doesn't allow deposits
if($_SESSION['mp_cust']['state'] == 'pending'){
	?>
	<script>
		window.parent.location = "pending.php";
	</script>
	<?php
}

//check if new deposit
if(isset($_GET['new'])){
	unset($_SESSION['paymentID'], $_SESSION['payment_amount']);
}




	?>
	<link rel="stylesheet" href="/commontools/cardtaker/cardtaker.css" type="text/css" />
	<script type="text/javascript" src="/commontools/cardtaker/cardtaker.js" ></script>

	<script>
		var payment_method;

		function change_payment_method(method){
			if(method=='bursars'){
				document.getElementById('bursars_radio').checked = true;
				document.getElementById('cc_form').style.display = 'none';

				if(payment_method == 'charge'){
				window.parent.document.getElementById('sb-wrapper').style.width = "400px";
				window.parent.document.getElementById('sb-wrapper-inner').style.height = "320px";
				parent.document.getElementById('sb-wrapper').style.top = (parseInt(parent.document.getElementById('sb-wrapper').style.top) + 100)+"px";
				parent.document.getElementById('sb-wrapper').style.left = (parseInt(parent.document.getElementById('sb-wrapper').style.left) + 100)+"px";
				}
				payment_method = 'bursars';
			}
			else{
				document.getElementById('charge_radio').checked = true;
				document.getElementById('cc_form').style.display = 'block';
				payment_method = 'charge';
				window.parent.document.getElementById('sb-wrapper').style.width = "600px";
				window.parent.document.getElementById('sb-wrapper-inner').style.height = "520px";
				parent.document.getElementById('sb-wrapper').style.top = (parseInt(parent.document.getElementById('sb-wrapper').style.top) - 100)+"px";
				parent.document.getElementById('sb-wrapper').style.left = (parseInt(parent.document.getElementById('sb-wrapper').style.left) - 100)+"px";
			}
		}
		function submit_payment(){
			var error = 0;
			var common_form = document.common_info;
			var amount = common_form.amount.value;


			if(common_form.email.value ==''){
				error = 1;
				common_form.email.className = 'tberror';
			}
			else{
				common_form.email.className = '';
			}

			if(common_form.phone.value ==''){
				error = 1;
				common_form.phone.className = 'tberror';
			}
			else{
				common_form.phone.className = '';
			}





			switch(payment_method){
				case 'bursars':
					var form = document.bursars_form;
					form.amount.value = amount;
					form.email.value = common_form.email.value;
					form.phone.value = common_form.phone.value;
					document.getElementById("processing").style.display = 'block';
					form.submit();


					return true;
				break;

				case 'charge':
					var form = document.ct_form;
					form.amount.value = amount;
					form.billTo_email.value  = common_form.email.value;
					form.billTo_phoneNumber.value = common_form.phone.value;

					if(validateInput(form)){
						document.getElementById("processing").style.display = 'block';
						form.submit();
						return true;
					}
				break;

				default:
					alert('Please select a payment method');
				break;
			}

			return false;
		}
		function verify_amount(form){
			var amount = form.deposit_amount.value;

			if(amount.match(/^[0-9]+(\.[0-9]{0,2})?$/)){
				if(amount >= <?=$config['min_deposit']?>){
					if(amount > <?=$config['max_deposit']?>){
						alert('The maximum allowed deposit is $<?=$config['max_deposit']?>.');
						return false;
					}
				}
				else{
					alert('Please enter an amount of $<?=$config['min_deposit']?> or more.');
					return false;
				}
			}
			else{
				alert('Please enter a correctly formated dollar amount. (x.xx)');
				return false;
			}

			return true;
		}
		function change_amount(){
			var amount = <?=$_POST['deposit_amount']==''?0:$_POST['deposit_amount']?>;
			var common_form = document.common_info;

			switch(payment_method){
			case 'bursars':
				var form = document.bursars_form;
				form.amount.value = amount;
				form.email.value = common_form.email.value;
				form.phone.value = common_form.phone.value;
				form.selected.value = "bursars";
				form.action = 'deposit.php';
				form.submit();
				return true;
			break;

			case 'charge':
				var form = document.ct_form;
				form.amount.value = amount;
				form.billTo_email.value  = common_form.email.value;
				form.billTo_phoneNumber.value = common_form.phone.value;
				form.action = 'deposit.php';
				form.submit();
				return true;

			break;

			default:
				var form = document.bursars_form;
				form.amount.value = amount;
				form.email.value = common_form.email.value;
				form.phone.value = common_form.phone.value;
				form.action = 'deposit.php';
				form.submit();
				return true;
			break;
			}
		}

	</script>
	<style>
		body{
			background-color:#efeaea;
			margin:15px;
			padding:0px;
			font-family: Helvetica, Arial, sans-serif;
			color:#363636;
			font-weight:bold;
		}
		.learn-more{
	font-size:10px;
	font-weight:normal;
	color:#cc0033;
	text-decoration:none;
	cursor:pointer;
}
		#total_row, #submit_row, #billTo_email_row, #billTo_phoneNumber_row{
			display:none;
		}
		.ct_table{
			width:540px;
		}
	</style>
	<link rel="stylesheet" href="/commontools/cardtaker/cardtaker.css" />
	<table id="processing" align="center" style="display:none; width:100%; height:100%; position:absolute; background-color:#ffffff; top:0px; left:0px;"><tr><td align="center"><img src="template/images/ajax-loader.gif" /><br /><br /><b>Processing</b></td></tr></table>
	<?php
	if($_SESSION['mp_login']['access'] == 'full'){
		if(!isset($_POST['deposit_amount']) && !isset($_SESSION['paymentID'])){
			$temp = htmlspecialchars($_POST['email'].$_POST['billTo_email']);
			if($temp != ''){
				$_SESSION['payment_email'] = $temp;
			}
			$_SESSION['payment_phone'] = htmlspecialchars($_POST['phone'].$_POST['billTo_phoneNumber']);




	?>
		<form action="deposit.php" method="post" onsubmit="return verify_amount(this)">
			Deposit Amount: $<input type="text" name="deposit_amount" value="<?php printf("%0.2f", $_POST['amount'])?>" onfocus="if(this.value=='0.00') this.value=''; " /><br />
			Email: &nbsp;<input type="text" name="email" value="<?=$_SESSION['payment_email']?>" /><br />
			Phone: <input type="text" name="phone" value="<?=$_SESSION['payment_phone']?>" /><br />
			<br />
			<input type="submit" value="Continue" />
			<?php
			foreach($_POST as $key => $value){
				print '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($value).'" />';
			}

			?>
		</form>
	<?php
		}
		else{
			if(isset($_POST['deposit_amount'])){
				$_SESSION['payment_amount'] = htmlspecialchars($_POST['deposit_amount']);
				$_SESSION['payment_email'] = htmlspecialchars($_POST['email']);
				$_SESSION['payment_phone'] = htmlspecialchars($_POST['phone']);
				$_SESSION['payment_amount'] = sprintf("%0.2f", $_SESSION['payment_amount']);
			}
	?>

	<form name="common_info" onsubmit="return false">
		deposit amount: $<input type="text" name="amount" value="<?php printf("%0.2f", $_SESSION['payment_amount'])?>" disabled/> <span class="learn-more" onclick="change_amount()">edit</span><br />
		Email: <input type="text" name="email" value="<?=$_SESSION['payment_email']?>" /><br />
		Phone: <input type="text" name="phone" value="<?=$_SESSION['payment_phone']?>" /><br />
	</form>
	<?php
	//check to see if active student and that they have no holds to determine if they should be allowed to make bursars charges
	if($_SESSION['webauth']['activestudent'] == 1 && !has_bursars_holds($_SESSION['mp_login']['id'])){
	?>
	<?
		## Check to see if it's past the deadline for charging to Bursars
		if (time() < $bursarDeadline) {

	?>
	<div>
		<div style="float:left;">
			<input type="radio" id="bursars_radio" name="payment_method" value="bursar" onclick="change_payment_method('bursars')"/> Bursars
			<p style="padding:0 0 5px 20px; margin:0; font-size:11px;"><strong>NOTE:</strong> After <?php echo $bursarDeadlineText; ?> you <strong style="color:#ff0000;">will not</strong> be able to charge to your Bursars account for the remainder of the semester. Please plan accordingly.</p>
			<form method="post" action="bursars_handler.php  " name="bursars_form" style="display:none;" onsubmit="return false" >
				<input type="hidden" name="amount" />
				<input type="hidden" name="email" />
				<input type="hidden" name="phone" />
				<input type="hidden" name="selected" />
			</form>
		</div>
		<div style="clear:both;"></div>
	</div>

	<input type="button" value="Submit" onclick="submit_payment()" />
	<?php
		} // end deadline check
	?>
	<div>
		<div style="float:left;">
			<input type="radio" id="charge_radio" name="payment_method" value="charge" onclick="change_payment_method('charge')" /> Visa/MasterCard/AmEx <img src="template/images/credit_cards2.jpg" />
			<?php
			// explanatory note below cc info once Bursars option disappears
			if (time() > $bursarDeadline) {
			?>
			<p style="padding:0 0 5px 20px; margin:0; font-size:11px;"><strong>NOTE:</strong> The Bursars option is not available for the remainder of this semester.</p>
			<?php
				} // end deadline check
			?>
			<div id="cc_form" style="margin-left:20px; display:none;">
				<?php
					/*
					$initial_values['orderAmount'] 		= $_SESSION['payment_amount'];
					$initial_values['firstName'] 		= htmlspecialchars($_POST['billTo_firstName']);
					$initial_values['lastName'] 		= htmlspecialchars($_POST['billTo_lastName']);
					$initial_values['address'] 			= htmlspecialchars($_POST['billTo_street1']);
					$initial_values['city'] 			= htmlspecialchars($_POST['billTo_city']);
					$initial_values['state'] 			= htmlspecialchars($_POST['billTo_state']);
					$initial_values['postalCode'] 		= htmlspecialchars($_POST['billTo_postalCode']);
					$initial_values['cardType'] 		= htmlspecialchars($_POST['card_cardType']);
					$initial_values['expirationMonth'] 	= htmlspecialchars($_POST['card_expirationMonth']);
					$initial_values['expirationYear'] 	= htmlspecialchars($_POST['card_expirationYear']);
					$initial_values['phoneNumber'] 		= htmlspecialchars($_POST['billTo_phoneNumber']);
					$initial_values['email'] 			= htmlspecialchars($_POST['billTo_email']);

					$payment = new payment_process($initial_values);
					$payment->display_form();
					*/
					insert_submit($_SESSION['total_amount'], $_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF']);
				?>
			</div>
		</div>
		<script>
		<?=(isset($_SESSION['paymentID']) || isset($_POST['currency']))?'change_payment_method("charge")':''?>
		<?=($_POST['selected']=='bursars')?'change_payment_method("bursars")':''?>
		</script>
		<div style="clear:both;"></div>
	</div>
	<?php
	}
	else{
	?>
	<div id="cc_form" style="margin-left:20px;">
				<?php
					/*
					$initial_values['orderAmount'] 		= $_SESSION['payment_amount'];
					$initial_values['firstName'] 		= htmlspecialchars($_POST['billTo_firstName']);
					$initial_values['lastName'] 		= htmlspecialchars($_POST['billTo_lastName']);
					$initial_values['address'] 			= htmlspecialchars($_POST['billTo_street1']);
					$initial_values['city'] 			= htmlspecialchars($_POST['billTo_city']);
					$initial_values['state'] 			= htmlspecialchars($_POST['billTo_state']);
					$initial_values['postalCode'] 		= htmlspecialchars($_POST['billTo_postalCode']);
					$initial_values['cardType'] 		= htmlspecialchars($_POST['card_cardType']);
					$initial_values['expirationMonth'] 	= htmlspecialchars($_POST['card_expirationMonth']);
					$initial_values['expirationYear'] 	= htmlspecialchars($_POST['card_expirationYear']);
					$initial_values['phoneNumber'] 		= htmlspecialchars($_POST['billTo_phoneNumber']);
					$initial_values['email'] 			= htmlspecialchars($_POST['billTo_email']);

					$payment = new payment_process($initial_values);
					//$payment->display_form();
					*/
					insert_submit($_SESSION['payment_amount'], $_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF']);
				?>

	</div>
	<script>
	payment_method = 'charge';
	window.parent.document.getElementById('sb-wrapper').style.width = "600px";
	window.parent.document.getElementById('sb-wrapper-inner').style.height = "520px";
	parent.document.getElementById('sb-wrapper').style.top = (parseInt(parent.document.getElementById('sb-wrapper').style.top) - 100)+"px";
	parent.document.getElementById('sb-wrapper').style.left = (parseInt(parent.document.getElementById('sb-wrapper').style.left) - 100)+"px";
	</script>
	<?php
	}
	?>
	<br />
	<!--input type="button" value="Submit" onclick="submit_payment()" /-->
	<?php
		}
}
else{

	mp_start('Deposit', 0, 1);
?>
<style>
			html, body{
				background-color:#ffffff !important;
			}
		</style>
		<h1>Make a Deposit</h1>
<?php
if(!isset($_POST['deposit_amount']) && !isset($_SESSION['paymentID'])){
			$_SESSION['payment_email'] = htmlspecialchars($_POST['email'].$_POST['billTo_email']);
			$_SESSION['payment_phone'] = htmlspecialchars($_POST['phone'].$_POST['billTo_phoneNumber']);




	?>
		<form action="deposit.php" method="post" onsubmit="return verify_amount(this)">
			Deposit Amount: $<input type="text" name="deposit_amount" value="<?php printf("%0.2f", $_POST['amount'])?>" onfocus="if(this.value=='0.00') this.value=''; " /><br />
			Email: &nbsp;<input type="text" name="email" value="<?=$_SESSION['payment_email']?>" /><br />
			Phone: <input type="text" name="phone" value="<?=$_SESSION['payment_phone']?>" /><br />
			<br />
			<input type="submit" value="Continue" />
			<?php
			foreach($_POST as $key => $value){
				print '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($value).'" />';
			}

			?>
		</form>
	<?php
		}
		else{

			if(isset($_POST['deposit_amount']))
				$_SESSION['payment_amount'] = htmlspecialchars($_POST['deposit_amount']);
				$_SESSION['payment_email'] = htmlspecialchars($_POST['email']);
				$_SESSION['payment_phone'] = htmlspecialchars($_POST['phone']);
				$_SESSION['payment_amount'] = sprintf("%0.2f", $_SESSION['payment_amount']);
	?>
	<form name="common_info" onsubmit="return false">
		deposit amount: $<input type="text" name="amount" value="<?php printf("%0.2f", $_SESSION['payment_amount'])?>" disabled/> <span class="learn-more" onclick="change_amount()">edit</span><br />
		Email: <input type="text" name="email" value="<?=$_SESSION['payment_email']?>" /><br />
		Phone: <input type="text" name="phone" value="<?=$_SESSION['payment_phone']?>" /><br />
	</form>
	<div id="cc_form" style="margin-top:30px;">
				<?php
					/*
					$initial_values['orderAmount'] 		= $_SESSION['payment_amount'];
					$initial_values['firstName'] 		= htmlspecialchars($_POST['billTo_firstName']);
					$initial_values['lastName'] 		= htmlspecialchars($_POST['billTo_lastName']);
					$initial_values['address'] 			= htmlspecialchars($_POST['billTo_street1']);
					$initial_values['city'] 			= htmlspecialchars($_POST['billTo_city']);
					$initial_values['state'] 			= htmlspecialchars($_POST['billTo_state']);
					$initial_values['postalCode'] 		= htmlspecialchars($_POST['billTo_postalCode']);
					$initial_values['cardType'] 		= htmlspecialchars($_POST['card_cardType']);
					$initial_values['expirationMonth'] 	= htmlspecialchars($_POST['card_expirationMonth']);
					$initial_values['expirationYear'] 	= htmlspecialchars($_POST['card_expirationYear']);
					$initial_values['phoneNumber'] 		= htmlspecialchars($_POST['billTo_phoneNumber']);
					$initial_values['email'] 			= htmlspecialchars($_POST['billTo_email']);

					$payment = new payment_process($initial_values);
					//$payment->display_form();
					*/
					insert_submit($_SESSION['payment_amount'], $_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF']);
				?>

	</div>
	<script>
	payment_method = 'charge';
	window.parent.document.getElementById('sb-wrapper').style.width = "600px";
	window.parent.document.getElementById('sb-wrapper-inner').style.height = "520px";
	parent.document.getElementById('sb-wrapper').style.top = (parseInt(parent.document.getElementById('sb-wrapper').style.top) - 100)+"px";
	parent.document.getElementById('sb-wrapper').style.left = (parseInt(parent.document.getElementById('sb-wrapper').style.left) - 100)+"px";
	</script>

	<br />
	<!--input type="button" value="Submit" onclick="submit_payment()" /-->
	<?php
		}
	mp_finish();
}
?>