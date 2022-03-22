<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/template/mp.inc');
require_once('includes/mp_functions.inc');
define("RESULTS_PAGE", 10);

$page_options['page'] = 'View Transactions';

//make sure a user is currently logged in and session hasn't expired
if(!isset($_SESSION['mp_cust']['id'])){
	header("Location:index.php");
	exit();
}

//make sure someone didn't just manualy hit this address while account was in different state
if($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account'){
	header("Location:index.php");
	exit();
}

//check to see if MP is in a state that doesn't allow deposits
if($_SESSION['mp_cust']['state'] == 'pending'){
	header("Location:pending.php");
	exit();
}




if(!isset($_GET['page'])){
	$rowstart=1;
	$rowend=RESULTS_PAGE;
	$current_page=1;
}
else{
	$rowstart = $_GET['page']*RESULTS_PAGE-RESULTS_PAGE+1;
	$rowend = $_GET['page']*RESULTS_PAGE;
	$current_page= $_GET['page'];
}

	$total = getMPTransactionCount($_SESSION['mp_cust']['id']);
	$pages = ceil($total/RESULTS_PAGE);
	if ($total > 0)
	{
		$transactions = getMPTransactions($_SESSION['mp_cust']['id'], $rowstart, $rowend);
	}
	mp_start('Transaction History', 0, 1);

if(isset($_GET['deposit'])){
	print '<h1>Thank You</h1><p><b>Thank you for your business. Your transaction has been processed.<br />A confirmation of your purchase has been sent to your email address.</b></p>';
}

if($_SESSION['mp_login']['access'] == 'deposit'){
	mp_finish();
	exit();
}
?>


<h1>Meal Plan Transaction History</h1>

<div style="margin-top:15px;">Showing <?=$rowstart?> to <?=min($rowend, $total)?> of <?=$total?> transactions</div>
<table style="width:100%;" class="transaction-table">
	<thead>
		<tr style="background-color:#363636; color:white; height:20px;">
			<th style="color:#ffffff; padding-left: 5px;">Time</th>
			<th style="color:#ffffff;">Location</th>
			<th style="color:#ffffff; text-align: right;">Amount</th>
			<th style="color:#ffffff; text-align: right; padding-right: 5px;">Remaining Bal</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($transactions) { foreach($transactions as $transaction){
		?>
		<tr>
			<td><?=$transaction['when']?></td>
			<td><?=$transaction['where']?></td>
			<td align="right"><?php printf("%s$%01.2f",$transaction['debit'], $transaction['amount'])?></td>
			<td align="right"><?php printf("$%01.2f",$transaction['balance'])?></td>
		</tr>
		<?php
		}}
		?>
	</tbody>
</table>
<?php
if($pages > 1){


						?>
							<div style="margin-top:30px; font-weight:normal; font-size:14px;">
							<?php
								if($current_page!=1){
									print '<a href="viewtransactions.php?page='.($current_page-1).'" class="page-link" >&lt; Previous</a> ';
								}
							?>

								<?php for($x=max(1, $current_page-3); $x<min($current_page+4, $pages+1); $x++){?>
								<a href="viewtransactions.php?page=<?=$x?>" class="page-link" >
									<?=($x==$current_page)?'&nbsp;<b style="color:#363636;">'.($x).'</b>':'&nbsp;'.($x)?>
								</a>
								<?php }?>
							<?php
								if($current_page!=$pages){
									print '<a href="viewtransactions.php?page='.($current_page+1).'" class="page-link" >Next &gt;</a> ';
								}
							?>

							</div>
	 					<?php

}
mp_finish();
?>
