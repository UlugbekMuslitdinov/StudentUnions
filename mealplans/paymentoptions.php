<?php
require_once('template/mp.inc');
require_once ('includes/mysqli.inc');
require_once('includes/bursars.inc');

$db = new db_mysqli('mealplans');


//make sure if the hit back after making it all the way to the cc page it gets cleared out
unset($_SESSION['paymentID']);

//make sure users session is still active and that this is an appropriate page for the user to be on
if(!isset($_SESSION['mp_cust']['id']) || !isset($_SESSION['webauth']['netID']) || $_SESSION['mp_cust']['state'] != 'no plan'){
  header("Location:index.php");
  exit();
}
 
//check if submitting from terms and conditions
if(isset($_POST['termsandconditions'])){
	if($_POST['agreetoterms']!=1){
		$_SESSION['errors'][2] = 'You must agree to the terms and conditions to sign up for a meal plan.';
		header('Location:termsandconditions.php');
		exit();
	}
	else{
		$_SESSION['errors'][2] = '';
		$_SESSION['agreetoterms'] = 1;
    $_SESSION['stage'] = 3;
	}
}
//otherwise make sure they have filled out the previous pages before coming here
else{
  if($_SESSION['stage'] < 3){
    header('Location: chooseplan.php');
    exit();
  }
}

//query control values to see what payment methods are currently available
$query = 'select * from control';
$result = $db->query($query);
$control = mysqli_fetch_assoc($result);

//check if half year(set on chooseplan.php), if so only show one payment options
if($_SESSION['config']['is_half_year']){
  $query = 'select * from plan join payment_plan on payment_plan.plan_id=plan.plan_id where plan.plan_id='.$_SESSION['plan'].' and num_payments=1 order by num_payments';
}
else{
  $query = 'select * from plan join payment_plan on payment_plan.plan_id=plan.plan_id where plan.plan_id='.$_SESSION['plan'].' order by num_payments';
}
$result = $db->query($query);
$payment_plan = mysqli_fetch_assoc($result);

//if plan is not a wildcat plan dont worry about half year stuff
if(!$payment_plan['plus_plan']){
	$_SESSION['config']['is_half_year'] = 0;
}

//make bursars the default option if nothing has been selected yet
if(!isset($_SESSION['payment_type'])){
	$_SESSION['payment_type'] = 'bursars';
	$_SESSION['payment_plan'] = $payment_plan['payment_plan_id'];
}

//grab the id of the single payment option for the cc option
$single_payment_id = $payment_plan['payment_plan_id'];

//define values used later
$plan_cost = $_SESSION['config']['is_half_year']?money_format("%.0n", $payment_plan['min_deposit']/2):money_format("%.0n", $payment_plan['min_deposit']);
$processing_fee = money_format("%.0n", $_SESSION['config']['is_half_year']?$payment_plan['half_year_fee']:$payment_plan['full_year_fee']);





setlocale(LC_MONETARY, 'en_US');
mp_start('Payment Options', 0, 1, 1);
?>
<h1 style="font-size:30px; margin-top:30px;">Payment Options</h1>
<span style="color:#cc0033;"><?=isset($_SESSION['errors'][3])?$_SESSION['errors'][3]:''?></span>
<form name="paymentoptions" method="post" action="confirm.php" style="width: 500px">
<span style="line-height:20px;">
Plan Selected: <b><?=$payment_plan['name']?></b><br />
<?php
// if this is a commuter sign-up, pre-populate the $100 min and highlight in red
if($payment_plan['min_deposit']>0 && $payment_plan['plan_id'] == 2){
?>
<input type="hidden" name="commuterPlan" value="1" />
<input type="hidden" name="commuterMin" value="<?=$payment_plan['min_deposit']?>" />
Plan Cost: $<input type="text" name="initial_deposit" value="<?=$payment_plan['min_deposit']?>" /> <span style="color:#ff0000;">$<?=$payment_plan['min_deposit']?> minimum</span><br />
Processing Fee: <b>$<?=$processing_fee?></b><br />
<?php
} elseif ($payment_plan['min_deposit']>0 && $payment_plan['plan_id'] != 2) {

?>
Plan Cost: <b>$<?=$plan_cost?></b><br />
Processing Fee: <b>$<?=$processing_fee?></b><br />
<?php

}

else{
?>
Initial Deposit: $<input type="text" name="initial_deposit" value="<?=$_SESSION['initial_deposit']?>" />
<?php
}
?>
</span>
<br />
<p>Select payment method:</p>
<table>
	<tbody>
<!-- This is for the Bursars Payment. -->		
<?php ?>		
<?php
		if(!$control['signup_bursars']){
		?>
		<tr>
		  <td colspan="2"><b><?=$control['signup_bursars_message']?></b><br />&nbsp;</td>
		</tr>
		<?php
		}
    // else if($_SESSION['webauth']['activestudent'] == 1){
	else if($_SESSION['webauth']['activestudent'] == 1 && !has_bursars_holds($_SESSION['mp_login']['id'])){
		?>
		<tr>
			<td style="width:15px;"><input type="radio" name="payment_type" value="bursars" <?=$_SESSION['payment_type']=='bursars'?'checked':''?> onclick="if(this.checked){document.getElementById('bursars_options').style.display = 'block';}"/></td>
			<td><b>Bursars</b></td>
		</tr>
		<tr>
			<td></td>
			<td id="bursars_options" style="display:<?=$_SESSION['payment_type']=='bursars'?'block':'none'?>;">
				<?php
					if(mysqli_num_rows($result)>1){
				?>
				<table>
					<tbody>
						<tr>
							<td><input type="radio" name="num_payments" value="<?=$payment_plan['payment_plan_id']?>" <?=$_SESSION['payment_plan']==$payment_plan['payment_plan_id']?'checked':''?> /></td>
							<td><?=$payment_plan['payment_plan_desc']?></td>
						</tr>
						<?php
						while($payment_plan = mysqli_fetch_assoc($result)){
						?>
						<tr>
							<td><input type="radio" name="num_payments" value="<?=$payment_plan['payment_plan_id']?>" <?=$_SESSION['payment_plan']==$payment_plan['payment_plan_id']?'checked':''?> /></td>
							<td><?=$payment_plan['payment_plan_desc']?></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<?php
					}
					else{
				?>
				<input type="hidden" name="num_payments" value="<?=$payment_plan['payment_plan_id']?>" />
				<?php
					}
				?>
			</td>
		</tr>
		<?php
		}
		?>
	<?php ?>	

		<!--This is for the Credit Card Payment. -->
		<tr>
		  <?php
		  if($control['signup_cc']){
		  ?>
			<td><input type="radio" name="payment_type" value="<?=$single_payment_id ?>" <?=$_SESSION['payment_type']=='charge'?'checked':''?> onclick="if(this.checked){document.getElementById('bursars_options').style.display = 'none';}" /></td>
			<td><b>Visa/MasterCard/AmEx</b> <img src="template/images/credit_cards.jpg" /></td>
			<?php
      }
      else{
      ?>
      <td colspan="2"><b><?=$control['signup_cc_message']?></b><br />&nbsp;</td>
      <?php
      }
      ?>
		</tr>
	</tbody>
</table>
<br />
<input type="submit" name="paymentoptions" value="Continue" />
<input type="button" value="back" onclick="location='termsandconditions.php'" style="margin-top:10px;" />
</form>
<?php mp_finish();?>
