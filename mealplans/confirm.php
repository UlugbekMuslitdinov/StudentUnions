<?php
require_once('template/mp.inc');
require_once ('includes/mysqli.inc');

$db = new db_mysqli('mealplans');
$result = $db->query("select * from config");
$config = mysqli_fetch_assoc($result);

//make sure users session is still active and that this is an appropriate page for the user to be on
if(!isset($_SESSION['mp_cust']['id']) || !isset($_SESSION['webauth']['netID']) || $_SESSION['mp_cust']['state'] != 'no plan'){
  header("Location:index.php");
  exit();
}

 



if(isset($_POST['paymentoptions'])){
	if(!isset($_POST['payment_type'])){
		$_SESSION['errors'][3] = 'Please choose a payment method.';
		header('Location:paymentoptions.php');
		exit();
	}
	elseif(isset($_POST['initial_deposit']) && $_POST['initial_deposit']==''){
		$_SESSION['errors'][3] = 'Please set your initial deposit amount.';
		header('Location:paymentoptions.php');
		exit();
	}
	elseif(isset($_POST['initial_deposit'])){
			if(preg_match('/^[0-9]+(\.[0-9]{0,2})?$/', $_POST['initial_deposit'])){

				// validate commuter plan minimum deposit
				if ($_POST['initial_deposit'] < $_POST['commuterMin'] && $_POST['commuterPlan']) {
					$_SESSION['errors'][3] = 'Please enter an amount of $' . $_POST['commuterMin'] . ' or more.';
					header('Location:paymentoptions.php');
					exit();
				}

				if($_POST['initial_deposit'] >= $config['min_deposit']){
					if($_POST['initial_deposit'] > $config['max_deposit']){
						$_SESSION['errors'][3] = 'The maximum allowed deposit is $'.$config['max_deposit'].'.';
						header('Location:paymentoptions.php');
						exit();
					}
				}
				else{
					$_SESSION['errors'][3] = 'Please enter an amount of $'.$config['min_deposit'].' or more.';
					header('Location:paymentoptions.php');
					exit();
				}
			}
			else{
				$_SESSION['errors'][3] = 'Please enter a correctly formatted dollar amount. (x.xx)';
				header('Location:paymentoptions.php');
				exit();
			}
	}
	else{
		$_SESSION['errors'][3] = '';
	}
		if($_POST['payment_type'] == 'bursars'){
			if(!isset($_POST['num_payments'])){
				$_SESSION['errors'][3] = 'Please select one of the payment options under Bursars.';
				header('Location:paymentoptions.php');
				exit();
			}

			$_SESSION['payment_type'] = 'bursars';
			$_SESSION['payment_plan'] = $_POST['num_payments'];
		}
		else{
			$_SESSION['payment_type'] = 'charge';
			$_SESSION['payment_plan'] = $_POST['payment_type'];
		}

}
$_SESSION['errors'][3] = '';
$query = 'select * from payment_plan join plan on plan.plan_id = payment_plan.plan_id where payment_plan_id='.$_SESSION['payment_plan'];
$result = $db->query($query);
$plan = mysqli_fetch_assoc($result);
if(isset($_POST['initial_deposit']) && $_POST['initial_deposit'] > 0 ){
	$_SESSION['initial_deposit'] = $_POST['initial_deposit'];
	$plan['min_deposit'] = 	$_SESSION['initial_deposit'];
	$_SESSION['config']['is_half_year'] = 0;
}
elseif(isset($_POST['paymentoptions'])){
	unset($_SESSION['initial_deposit']);
}

if(isset($_SESSION['initial_deposit'])){
	$plan['min_deposit'] = $_SESSION['initial_deposit'];
}

$_SESSION['deposit_amount'] = $plan['min_deposit']/$plan['num_payments']/($_SESSION['config']['is_half_year']?2:1);
$_SESSION['fees'] = $plan[$_SESSION['config']['is_half_year']?'half_year_fee':'full_year_fee']/1;
$_SESSION['total_amount'] = $_SESSION['deposit_amount'] + $_SESSION['fees'];
$_SESSION['plan_name'] = $plan['name'].($plan['num_payments']>1?'('.$plan['num_payments'].' payments)':'');
$_SESSION['import_plan_name'] = $plan['name'];
$_SESSION['num_payments'] = $plan['num_payments'];
$_SESSION['bb_plan_id.'] = $plan['bb_plan_id'];
$_SESSION['plan_subcode'] = $plan['signup_subcode'];
$_SESSION['plan_tender_num'] = $plan['tender_num'];
$_SESSION['plus_plan'] = $plan['plus_plan'];


mp_start('Confirm &amp; Finish', 0, 1, 1);
?>
<style>
	#mp-content .confirm h2{
		font-size:18px;
		color:#363636;
	}
	#mp-content form{
		clear:both;
		padding-top:30px;
	}
	#mp-content form h2{
		font-size:30px;
		color:#FBB611;
		clear:both;
	}
	.ct_table{
		width:660px;
	}
</style>
<link rel="stylesheet" href="/commontools/cardtaker/cardtaker.css" />
<div id="cont" style="position:relative;">
<div id="processing" align="center" style="display:none; width:100%; height:100%; position:absolute; background-color:#ffffff; top:0px; left:0px; padding-top:50px;"><img src="template/images/ajax-loader.gif" /><br /><br /><b>Processing</b></div>
<h1  style="font-size:30px; margin-top:30px;">Confirm Signup</h1>
<div style="float:left" class="confirm">
	<h2>Patron Information</h2>
	Name: <b><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></b><br />
	StudentID/EmplID: <b><?=$_SESSION['webauth']['emplid']?></b><br />
	<br />
	<h2>Selected Plan <a href="chooseplan.php" class="learn-more">edit</a></h2>
	<b><?=$plan['name']?></b>
</div>
<div style="float:left; margin-left:30px;"  class="confirm">
	<h2>Deposit Amount <?=(isset($_SESSION['initial_deposit']) && $_SESSION['initial_deposit']!=0)?'<a href="paymentoptions.php" class="learn-more" >edit</a>':''?></h2>
	<?php
	if($_SESSION['num_payments']==1){
	?>
	Deposit Amount: <b>$<?=$_SESSION['deposit_amount']?></b><br />
	Processing Fee: <b>$<?=$_SESSION['fees']?></b><br />
	Total: <b>$<?=$_SESSION['total_amount']?></b><br />
	<?php
	}
	else{
	?>
	Plan Total: <b>$<?=$_SESSION['deposit_amount']*2?></b><br />
	First Payment: <b>$<?=$_SESSION['deposit_amount']?></b><br />
	Second Payment: <b>$<?=$_SESSION['deposit_amount']?></b> <span style="font-size:11px;">(spring semester)</span><br />
	Processing Fee: <b>$<?=$_SESSION['fees']?></b><br />
	Today's Total: <b>$<?=$_SESSION['total_amount']?></b><br />
	<?php
	}
	?>
	<br />
	<h2>Payment Method <a href="paymentoptions.php" class="learn-more" >edit</a></h2>
	<b><?=$_SESSION['payment_type']=='bursars'?'Bursars '.($plan['num_payments']>1?'('.$plan['num_payments'].' payments)':''):'Visa/MasterCard/AmEx <img src="template/images/credit_cards.jpg" />'?></b>
</div>


<br />
<br />

<?php
if($_SESSION['payment_type']=='bursars'){
?>
<form name="confirm" method="post" action="signupcomplete.php" style="clear:both" onsubmit="document.getElementById('processing').style.display='block'">
	<input type="submit" name="confirm" value="Submit Payment" />
	<input type="button" value="back" onclick="location='paymentoptions.php'" style="margin-top: 10px" />
</form>
<?php
}
else{
  include 'includes/cybersource_submit.php';

  insert_submit($_SESSION['total_amount'], $_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF']);
}
?>
</div>
<?php mp_finish();?>
