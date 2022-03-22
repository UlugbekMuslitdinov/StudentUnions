<?php
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/template/mp.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/includes/mp_functions.inc');
define("RESULTS_PAGE", 10);

$page_options['page'] = 'View Transactions';

//make sure a user is currently logged in and session hasn't expired
if(!isset($_SESSION['mp_cust']['id'])){
	header("Location: /mealplans/index.php");
	exit();
}

//make sure someone didn't just manualy hit this address while account was in different state
if($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account'){
	header("Location: /mealplans/index.php");
	exit();
}

//check to see if MP is in a state that doesn't allow deposits
if($_SESSION['mp_cust']['state'] == 'pending'){
	header("Location: /mealplans/pending.php");
	exit();
}

if (!array_key_exists('swipe_plan', $_SESSION)){
	header("Location: /mealplans/index.php");
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

$total = getTransactionsCountForSwipe($_SESSION['mp_cust']['cust_num']);
$pages = ceil($total/RESULTS_PAGE);
if ($total > 0)
{
	$transactions = getTransactionsForSwipe($_SESSION['mp_cust']['cust_num'], $rowstart, $rowend);
}
mp_start('Transaction History', 0, 1);
?>

<h1><?php echo $_SESSION['swipe_plan']['plan_name']; ?> Transaction History</h1>

<div style="margin-top:15px;">Showing <?=$rowstart?> to <?=min($rowend, $total)?> of <?=$total?> transactions</div>
<table style="width:100%;" class="transaction-table">
	<thead>
		<tr style="background-color:#363636; color:white; height:20px;">
			<th style="color:#ffffff; padding-left: 5px;">Time</th>
			<th style="color:#ffffff;">Location</th>
			<th style="color:#ffffff;">Plan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($transactions)) { 
			foreach($transactions as $transaction){
			?>
			<tr>
				<td><?=$transaction['when']?></td>
				<td><?=$transaction['where']?></td>
				<td><?=$transaction['plan']?></td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>
<?php
if($pages > 1){
?>
	<div style="margin-top:30px; font-weight:normal; font-size:14px;">
	<?php
		if($current_page!=1){
			print '<a href="./?page='.($current_page-1).'" class="page-link" >&lt; Previous</a> ';
		}
	?>

		<?php for($x=max(1, $current_page-3); $x<min($current_page+4, $pages+1); $x++){?>
		<a href="./?page=<?=$x?>" class="page-link" >
			<?=($x==$current_page)?'&nbsp;<b style="color:#363636;">'.($x).'</b>':'&nbsp;'.($x)?>
		</a>
		<?php }?>
	<?php
		if($current_page!=$pages){
			print '<a href="./?page='.($current_page+1).'" class="page-link" >Next &gt;</a> ';
		}
	?>

	</div>
<?php

}

?>

<?php
mp_finish();
?>
