<div id="login-box">
<div id="login-wrapper">
<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Cancel</a></h1>
<p><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
<?php 
if(isset($_SESSION['import_plan_name'])){
?>
<p>Plan: <b><?=$_SESSION['import_plan_name']?></b></p>
<?php }
if($title == 'Confirm &amp; Finish'){
	if($_SESSION['num_payments']==1){
?>
<!-- <p>Plan Expires: <b><?=$_SESSION['mp_cust']['plan']['EXPIRES']?></b></p> -->
<p>Plan Cost: <b>$<?=$_SESSION['deposit_amount']?></b></p>
<p>Plan Fee: <b>$<?=$_SESSION['fees']?></b></p>

<p>Payment Method: <b><?=$_SESSION['payment_type']=='bursars'?'Bursars&nbsp;'.($_SESSION['num_payments']>1?'('.$_SESSION['num_payments'].'&nbsp;payments)':''):'Visa/MasterCard/AmEx '?></b></p>
<?php 
	}
	else{
?>
<p>Plan Total <b>$<?=$_SESSION['deposit_amount']*2?></b></p>
<p>First Payment: <b>$<?=$_SESSION['deposit_amount']?></b></p>
<p>Second Payment: <b>$<?=$_SESSION['deposit_amount']?></b></p>
<p>Plan Fee: <b>$<?=$_SESSION['fees']?></b></p>
<p>Today's Total: <b>$<?=$_SESSION['total_amount']?></b></p>

<p>Payment Method: <b><?=$_SESSION['payment_type']=='bursars'?'Bursars&nbsp;'.($_SESSION['num_payments']>1?'('.$_SESSION['num_payments'].'&nbsp;payments)':''):'Visa/MasterCard/AmEx '?></b></p>	
<?php 
	}
}
?>
</div>
</div>
