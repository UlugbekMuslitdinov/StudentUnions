<?php

// ini_set('default_socket_timeout', 10);
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/template/catcash.inc.php');
// require_once('template/mp.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/includes/bursars.inc');
//require_once('includes/mp_cardtaker.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/cybersource_submit.php');
require_once ('includes/mysqli.inc');
$db = new db_mysqli('mealplans');
$result = $db->query("select * from config");
$config = mysqli_fetch_assoc($result);

//make sure a user is currently logged in and session hasn't expired
if(!isset($_SESSION['catcash'])){
	?>
	<script>
		window.parent.location = "index.php";
	</script>
	<?php
}

//check if new deposit
if(isset($_GET['new'])){
	unset($_SESSION['paymentID'], $_SESSION['payment_amount']);
}

$page_options['page'] = 'Deposit';
cc_start('Deposit', 0, 1);

	?>
	<link rel="stylesheet" href="/commontools/cardtaker/cardtaker.css" type="text/css" />
	<script type="text/javascript" src="/commontools/cardtaker/cardtaker.js" ></script>

	<script>
		var payment_method;

		function change_payment_method(method){
			if(method=='bursars'){
				document.getElementById('bursars_radio').checked = true;
				document.getElementById('cc_form').style.display = 'none';
				document.getElementById('bursars_submit').style.display = 'block';

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
				document.getElementById('bursars_submit').style.display = 'none';
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
			/*background-color:#efeaea;*/
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
	<h1>Catcash Deposit</h1>
	<table id="processing" align="center" style="display:none; width:100%; height:100%; position:absolute; background-color:#ffffff; top:0px; left:0px;"><tr><td align="center"><img src="template/images/ajax-loader.gif" /><br /><br /><b>Processing</b></td></tr></table>
	<?php

	if($_SESSION['mp_login']['access'] == 'full'){
		if(!isset($_POST['deposit_amount']) && !isset($_SESSION['paymentID'])){
			$tmp_email = isset($_POST['email']) ? $_POST['email'] : '';
			$tmp_billTo_email = isset($_POST['billTo_email']) ? $_POST['billTo_email'] : '';
			$temp = htmlspecialchars($tmp_email.$tmp_billTo_email);
			if($temp != ''){
				$_SESSION['payment_email'] = $temp;
			}

			$tmp_phone = isset($_POST['phone']) ? $_POST['phone'] : '';
			$tmp_billTo_phoneNumber = isset($_POST['billTo_phoneNumber']) ? $_POST['billTo_phoneNumber'] : '';
			$_SESSION['payment_phone'] = htmlspecialchars($tmp_phone.$tmp_billTo_phoneNumber);




	?>
		<form action="deposit.php" method="post" onsubmit="return verify_amount(this)">
			 Deposit Amount: $ <span style="color:red; font-weight:800;"><b>*</b></span><input type="text" name="deposit_amount" value="<?php printf("%0.2f", (isset($_POST['amount']) ? $_POST['amount'] : 0) )?>" onfocus="if(this.value=='0.00') this.value=''; " /><br />
			Email: &nbsp;<input type="text" name="email" value="" /><br />
			Phone: <input type="text" name="phone" value="" /><br />
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
		Deposit Amount: $ <span style="color:red; font-weight:800;"><b>*</b></span><input type="text" name="amount" value="<?php printf("%0.2f", $_SESSION['payment_amount'])?>" disabled/> <span class="learn-more" onclick="change_amount()">edit</span><br />
		Email: <input type="text" name="email" value="<?=$_SESSION['payment_email']?>" /><br />
		Phone: <input type="text" name="phone" value="<?=$_SESSION['payment_phone']?>" /><br />
	</form>
	<?php
	//check to see if active student and that they have no holds to determine if they should be allowed to make bursars charges
	// if($_SESSION['webauth']['activestudent'] == 1){
	if(isset($_SESSION['webauth']['activestudent']) && $_SESSION['webauth']['activestudent'] == 1 && !has_bursars_holds($_SESSION['mp_login']['id'])){
	// if($_SESSION['webauth']['activestudent'] == 1 && !has_bursars_holds($_SESSION['mp_login']['id'])){
	?>
	<div>
		<div style="float:left;">
			<input type="radio" id="charge_radio" name="payment_method" value="charge" onclick="change_payment_method('charge')" /> Visa/MasterCard/AmEx<img src="template/images/credit_cards2.jpg" />
			<div id="cc_form" style="margin-left:20px; display:none;">
				<?php
					insert_submit($_SESSION['payment_amount'], $_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF']);
				?>
			</div>
		</div>
		<script>
		<?=(isset($_SESSION['paymentID']) || isset($_POST['currency']))?'change_payment_method("charge")':''?>
		<?=($_POST['selected']=='bursars')?'change_payment_method("bursars")':''?>
		</script>
		<div style="clear:both;"></div>
	</div>
	<div id="bursars_submit" style="margin-left:20px;">
		<br />
		<input type="button" value="Submit" onclick="submit_payment()" />
	</div>
	<?php
	}
	else{
	?>
	<input type="radio" id="charge_radio" name="payment_method" value="charge" onclick="change_payment_method('charge')" checked disabled /> Visa/MasterCard/AmEx<img src="template/images/credit_cards2.jpg" />
	<div id="cc_form" style="margin-left:20px;">
				<?php
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
	
	<?php
		}
}
else{
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
			Deposit Amount: $ <span style="color:red; font-weight:800;"><b>*</b></span><input type="text" name="deposit_amount" value="<?php printf("%0.2f", $_POST['amount'])?>" onfocus="if(this.value=='0.00') this.value=''; " /><br />
			Email: &nbsp;<input type="text" name="email" value="" /><br />
			Phone: <input type="text" name="phone" value="" /><br />
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
		Deposit Amount: $ <span style="color:red; font-weight:800;"><b>*</b></span><input type="text" name="amount" value="<?php printf("%0.2f", $_SESSION['payment_amount'])?>" disabled/> <span class="learn-more" onclick="change_amount()">edit</span><br />
		Email: <input type="text" name="email" value="<?=$_SESSION['payment_email']?>" /><br />
		Phone: <input type="text" name="phone" value="<?=$_SESSION['payment_phone']?>" /><br />
	</form>
	<input type="radio" id="charge_radio" name="payment_method" value="charge" onclick="change_payment_method('charge')" checked disabled /> Visa/MasterCard/AmEx<img src="template/images/credit_cards2.jpg" />
	<div id="cc_form" style="margin-top:30px;">
				<?php
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
	<?php
		}
}
print("SESSION_catcash-cust_num: " . $_SESSION['catcash']['cust_num'] . " <br/>SESSION_catcash-id: " . $_SESSION['catcash']['id'] . " <br/>SESSION_mp_login-id : " . $_SESSION['mp_login']['id']);
cc_finish();
?>
