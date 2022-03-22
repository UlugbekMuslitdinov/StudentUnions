<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/template/catcash.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/catcash/includes/BBCatCash.php');
define("RESULTS_PAGE", 10);

$page_options['page'] = 'Transaction History';

//make sure someone didn't just manualy hit this address while account was in different state
if(!isset($_SESSION['catcash'])){
	header("Location:index.php");
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

$BBCatCash = New BBCatCash;
$total = $BBCatCash->get_transaction_count($_SESSION['catcash']['id']);
$pages = ceil($total/RESULTS_PAGE);
if ($total > 0)
{
    $transactions = $BBCatCash->get_transaction($_SESSION['catcash']['id'], $rowstart, $rowend);
}
cc_start('Transaction History', 0, 1);

if(isset($_GET['deposit'])){
	print '<h1>Thank You</h1><p><b>Thank you for your business. Your transaction has been processed.<br />A confirmation of your purchase has been sent to your email address.</b></p>';
}

// if($_SESSION['mp_login']['access'] == 'deposit'){
// 	mp_finish();
// 	exit();
// }
?>

<h1>Catcash Transaction History</h1>

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
			<td>
			<?php
			if ($transaction['where'] == "Meal Plan Web Application") {
				echo "CatCash Web Application";
			}
			else {
				echo $transaction['where'];
			}
			?>
			</td>
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
                print '<a href="transactions.php?page='.($current_page-1).'" class="page-link" >&lt; Previous</a> ';
            }
        ?>

            <?php for($x=max(1, $current_page-3); $x<min($current_page+4, $pages+1); $x++){?>
            <a href="transactions.php?page=<?=$x?>" class="page-link" >
                <?=($x==$current_page)?'&nbsp;<b style="color:#363636;">'.($x).'</b>':'&nbsp;'.($x)?>
            </a>
            <?php }?>
        <?php
            if($current_page!=$pages){
                print '<a href="transactions.php?page='.($current_page+1).'" class="page-link" >Next &gt;</a> ';
            }
        ?>

        </div>
    <?php

}
cc_finish();
?>
