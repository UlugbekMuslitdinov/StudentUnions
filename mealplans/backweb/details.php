<?php
//include backweb template
require_once('template/mpbackweb.inc');
//start page
mpbackweb_start('details');

//grab details from database based on id field in address
if (!isset($_GET['id'])){ $_GET['id'] = 0; }
$result = $db->query('select * from deposit left join Charge_payment on Deposit.charge_id=Charge_payment.charge_id left join Bursar_payment on Deposit.bursar_id=Bursar_payment.bursar_id where deposit_id='.($_GET['id'] | 0));
$deposit = mysqli_fetch_assoc($result);
?>
<form id="deposit_lookup" name="deposit_lookup" method="GET" action="details.php">Deposit ID:<input type="text" name="id" /><input type="submit" value="Go" /></form> <h2>Deposit Detail View</h2>
<div id="detailed-view-wrapper">
	<div id="deposit-information">
		<h3>Deposit Information</h3>
		<div class="deposit-keys">
			New Signup:<br />
			Plan Type:<br />
			Deposit ID:<br />
			Last Update:<br />
			Status:<br />
			Amount:<br />
			Fee:
		</div>
		<div class="deposit-values">
			<?=$deposit['new_signup']?'Yes':'No'?><br />
			<?=$deposit['plan_name']?><br />
			<?=$deposit['deposit_id']?><br />
			<?=$deposit['deposit_time']?><br />
			<?='Complete'?><br />
			<?=$deposit['amount']?><br />
			<?=$deposit['fee']?>
		</div>
	</div>
	<div id="deposit-contact">
		<h3>Deposit Contact</h3>
		<div class="deposit-keys">
			Name:<br />
			Email:<br />
			Phone:<br />
			emplID:
		</div>
		<div class="deposit-values">
			<?=$deposit['first_name'].' '.$deposit['last_name']?><br />
			<?=$deposit['email']?><br />
			<?=$deposit['phone']?><br />
			<?=$deposit['bb_account_id']?>
		</div>
	</div>
	<div id="payment-info">
		<h3>Payment Information</h3>
		<div class="deposit-keys">
			<?php
				if($deposit['payment_type'] == 'Bursars'){
			?>
					Payment Type:<br />
					Term Code:
			<?php
				}
				else{
			?>
					Payment Type:<br />
					last 4:<br />
					Expiration Date:
					<h4>Card Holder Info</h4>
					&nbsp;&nbsp;Name on Card:<br />
					&nbsp;&nbsp;Billing Address:<br />
					<br />
					&nbsp;&nbsp;Email:<br />
					&nbsp;&nbsp;Phone:
			<?php
				}
			?>
		</div>
		<div class="deposit-values">
			<?php
				if($deposit['payment_type'] == 'Bursars'){
			?>
					<?=$deposit['payment_type']?><br />
					<?=$deposit['term']?>
			<?php
				}
				else{
			?>
					<?=$deposit['payment_type']?><br />
					<?=$deposit['account_number']?><br />
					<?=$deposit['expiration_month'].'/'.$deposit['expiration_year']?><br />
					<br />
					<?=$deposit['ch_first_name'].' '.$deposit['ch_last_name']?><br />
					<?=$deposit['address']?><br />
					<?=$deposit['city'].', '.$deposit['state'].' '.$deposit['zipcode']?><br />
					<?=$deposit['ch_email']?><br />
					<?=$deposit['ch_phone']?>
			<?php
				}
			?>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
<?=$deposit['status'] == "Bursars Hold"?'<input type="button" value="Remove pending signup" onclick="remove_pending_signup('.$deposit['deposit_id'].')"':''?>

<?php
mpbackweb_finish();
?>
