<?php
ini_set('display_errors', 1);
require_once('includes/mp_functions.inc');
session_start();

//make sure a user is currently logged in and session hasn't expired
if(!isset($_SESSION['5050mp_cust']['id'])){
	header("Location:viewaccount.php");
}

//get recent transactions
$recent_transactions = getRecentMPTransactions($_SESSION['5050mp_cust']['id']);

?>
<div><a href="viewaccount.php">home</a> <a href="viewtransactions.php">transactions</a> <a href="makedeposit.php">deposit</a> <a href="deactivate.php">deactivate</a> <a href="5050.php">50/50</a></div>
<?=$_SESSION['5050mp_cust']['firstname'].' '.$_SESSION['5050mp_cust']['lastname']?><br />
Plan: 50/50<br />
<!--Plan Expires: Never<br />-->
Balance: $<?=$_SESSION['5050mp_cust']['balance']?><br />
<div>
<input type="button" value="Make a deposit" onclick="this.style.display = 'none'; document.deposit_form.style.display = 'block';" />
<form action="makedeposit.php" method="post" id="deposit_form" name="deposit_form" style="display:none;">
	<input type="submit" name="payment_type" value="Bursar's Account" />
	<input type="submit" name="payment_type" value="Visa/MS/Amex" />
</form>
</div>
<!--
how much would you like to deposit?<br />
<form action="makedeposit.php" method="post">
	$<input type="text" name="amount" value="0.00" onclick="if(this.value=='0.00') this.value='';" /><input type="submit" value="continue" />
</form>
-->
Last 5 transactions
<table>
	<thead>
		<tr>
			<th>Time</th>
			<th>Location</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($recent_transactions as $transaction){
		?>
		<tr>
			<td><?=$transaction['when']?></td>
			<td><?=$transaction['where']?></td>
			<td><?=$transaction['amount']?></td>
		</tr>
		<?php 
		}
		?>
	</tbody>
</table>