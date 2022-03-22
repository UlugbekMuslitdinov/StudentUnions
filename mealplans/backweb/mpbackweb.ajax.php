<?php
//******************************************************************************//
// This page handles all the ajax calls for every page in the backweb. 			//
// Essentiallay all requests get sent by post with action as a field that tells	//
// which code to run as can be seen by the switch statement.					//
//																				//
//******************************************************************************//


//since template file is not included on this page all the other individual files must be included
//include webauth wrapper to obtain users netID
require_once('webauth/include.php');
//include database related functions
require_once ('includes/mysqli.inc');


//connect to database and select mealplans database
$db = new db_mysqli('mealplans');

//include file to check that the person should be allowed to access the backweb
require_once('../includes/access.inc');


//switch statement that is the heart of this page. Every ajax call made to this page should include an action that matches one of the case statements below
switch($_POST['action']){

	//get content for export errors tab on index page
	case "get-export-errors":
		//make sure a time from when to get errors was sent otherwise return that there was an error
		if(!isset($_POST['when'])){ print 'error'; exit(); }
		?>
		<table cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Deposit ID</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Date/Time</th>
					<th>emplID</th>
					<th>Status</th>
					<th>Plan</th>
					<th>New Signup</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = $db->query('select * from deposit where deposit_time>=from_unixtime('.$_POST['when'].')');
					while($deposit = mysqli_fetch_assoc($result)){
				?>
					<tr class="row<?=$i++%2?>">
						<td><a href="details.php?id=<?=$deposit['deposit_id']?>"><?=$deposit['deposit_id']?></a></td>
						<td><?=$deposit['last_name']?></td>
						<td><?=$deposit['first_name']?></td>
						<td><?=$deposit['deposit_time']?></td>
						<td><?=sprintf("%08d",$deposit['bb_account_id'])?></td>
						<td><?=$deposit['status']?></td>
						<td><?=$deposit['name']?></td>
						<td><?=$deposit['new_signup']?'Yes':'No'?></td>
						<td><?=$deposit['total']?></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<?php
	break;

	//get content for pending errors tab on index page
	case "get-pending-deposits":
		if(!isset($_POST['when'])){ print 'error'; exit(); }
		?>
		<table cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Deposit ID</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Date/Time</th>
					<th>emplID</th>
					<th>Status</th>
					<th>Plan</th>
					<th>New Signup</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = $db->query('select * from deposit where deposit_time>=from_unixtime('.$_POST['when'].') and status="Pending"');
					while($deposit = mysqli_fetch_assoc($result)){
				?>
					<tr class="row<?=$i++%2?>">
						<td><a href="details.php?id=<?=$deposit['deposit_id']?>"><?=$deposit['deposit_id']?></a></td>
						<td><?=$deposit['last_name']?></td>
						<td><?=$deposit['first_name']?></td>
						<td><?=$deposit['deposit_time']?></td>
						<td><?=sprintf("%08d",$deposit['bb_account_id'])?></td>
						<td><?=$deposit['status']?></td>
						<td><?=$deposit['plan_name']?></td>
						<td><?=$deposit['new_signup']?'Yes':'No'?></td>
						<td><?=$deposit['total']?></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<?php
	break;

	//get content for recently completed tab on index page
	case "get-recently-completed":
		if(!isset($_POST['when'])){ print 'error'; exit(); }
		?>
		<table cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Deposit ID</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Date/Time</th>
					<th>emplID</th>
					<th>Status</th>
					<th>Plan</th>
					<th>New Signup</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = $db->query('select * from deposit where deposit_time>=from_unixtime('.$_POST['when'].') order by deposit_time desc');
					while($deposit = mysqli_fetch_assoc($result)){
				?>
					<tr class="row<?=$i++%2?>">
						<td><a href="details.php?id=<?=$deposit['deposit_id']?>"><?=$deposit['deposit_id']?></a></td>
						<td><?=$deposit['last_name']?></td>
						<td><?=$deposit['first_name']?></td>
						<td><?=$deposit['deposit_time']?></td>
						<td><?=sprintf("%08d",$deposit['bb_account_id'])?></td>
						<td><?=$deposit['status']?></td>
						<td><?=$deposit['plan_name']?></td>
						<td><?=$deposit['new_signup']?'Yes':'No'?></td>
						<td><?=$deposit['total']?></td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<?php
	break;

	//get content for lost card tab on index page
	case "get-lost-cards":
		if(!isset($_POST['when'])){ print 'error'; exit(); }
		?>
		<table  cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th>Last Name</th>
				<th>First Name</th>
				<th>emplID</th>
				<th>Date/Time</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$result = $db->query('select * from lost_card where report_time>=from_unixtime('.$_POST['when'].')');
				while($lost_card = mysqli_fetch_assoc($result)){
			?>
				<tr class="row<?=$i++%2?>">
					<td><?=$lost_card['last_name']?></td>
					<td><?=$lost_card['first_name']?></td>
					<td><?=$lost_card['cust_id']?></td>
					<td><?=$lost_card['report_time']?></td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>
		<?php
	break;

	//return content for deposit seach based on posted criteria
	case 'get-search-results':
		$query = 'select * from deposit'; //set up basic query string
		$join = ''; //variable for join statement if neccisary
		$where_clause = ' where 1'; //set initial where clause to all deposits
		$order = ' order by '.$_POST['order_by'].' '.$_POST['asce_desc']; //set order by clause


		//most of the following statements check to see if a seach criteria was filled in and if so append to the where clause
			if($_POST['first_name']!='')
				$where_clause .= ' and deposit.first_name like "'.$_POST['first_name'].'%"';
			if($_POST['last_name']!='')
				$where_clause .= ' and deposit.last_name like "'.$_POST['last_name'].'%"';
			if($_POST['cust_id']!='')
				$where_clause .= ' and bb_account_id="'.$_POST['cust_id'].'"';
			if($_POST['deposit_id']!='')
				$where_clause .= ' and deposit_id="'.$_POST['deposit_id'].'"';
			if($_POST['amount']!='')
				$where_clause .= ' and total="'.$_POST['amount'].'"';
			if($_POST['bursars'] == "false")
				$where_clause .= ' and status <> "Bursars Hold"';
			//payment type is a little more complicated and requires a case for possible value
			switch($_POST['payment_type']){
				case 'visa':
					$where_clause .= ' and payment_type="Visa"';
				break;
				case 'mc':
					$where_clause .= ' and payment_type="Master Card"';
				break;
				case 'amex':
					$where_clause .= ' and payment_type="American Express"';
				break;
				case 'charge':
					$where_clause .= ' and bursar_id is null';
				break;
				case 'bursars':
					$where_clause .= ' and bursar_id is not null';
				break;
			}

			if($_POST['last_four']!=''){
				$where_clause .= ' and account_number="'.$_POST['last_four'].'"';
				$join = ' join Charge_payment on deposit.charge_id=Charge_payment.charge_id'; //searching based on last 4 requires us to look into the charge payment table so it must be joined
			}
			//date rangne is also more complicated and has a case statment for the different type of date ranges e.g all, predifined(default), and custom
			switch($_POST['date_range']){
				case 'all':
				//nothing to do for this
				break;
				case 'custom':
					$where_clause .= ' and deposit_time >= "'.$_POST['from'].'" and deposit_time <= "'.$_POST['to'].'"';
				break;
				default:
					$where_clause .= ' and deposit_time >= date_sub(CURRENT_TIMESTAMP, INTERVAL '.$_POST['date_range'].' DAY)';
				break;
			}

		?>
		<table cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<!-- results table header row with sortable columns having onclick funtion calls to redo search with specefied sorting instrcutions -->
					<th>Deposit ID</th>
					<th onclick="get_search_results('deposit.last_name', '<?=($_POST['order_by']=='deposit.last_name' && $_POST['asce_desc']=='ASC')?'DESC':'ASC'?>')">Last Name</th>
					<th onclick="get_search_results('deposit.first_name', '<?=($_POST['order_by']=='deposit.first_name' && $_POST['asce_desc']=='ASC')?'DESC':'ASC'?>')">First Name</th>
					<th onclick="get_search_results('deposit_time', '<?=($_POST['order_by']=='deposit_time' && $_POST['asce_desc']=='DESC')?'ASC':'DESC'?>')">Last Update</th>
					<th >emplID</th>
					<th >Status</th>
					<th >Mobile</th>
					<th >Auth</th>
					<th onclick="get_search_results('plan_name', '<?=($_POST['order_by']=='plan_name' && $_POST['asce_desc']=='ASC')?'DESC':'ASC'?>')">Plan</th>
					<th >Signup</th>
					<th onclick="get_search_results('total', '<?=($_POST['order_by']=='total' && $_POST['asce_desc']=='ASC')?'DESC':'ASC'?>')">Total</th>
					<th onclick="get_search_results('payment_type', '<?=($_POST['order_by']=='payment_type' && $_POST['asce_desc']=='ASC')?'DESC':'ASC'?>')">Payment Type</th>
				</tr>
			</thead>
			<tbody>
				<?php
					//chech if sort by type and total was selected
					if($_POST['totals']=='sort'){
						//if so union the normal query with another query to grab totals adding an extra column to each to allow for sorting the totals to the bottom of each payment type
						$result = $db->query("(select *, '1' as sorter from deposit".$join.$where_clause.") union (select 'Total', null, null, sum(total), null, null, null, null, null, null, null, null, null, null, payment_type, null, null, null, null, null, null, null, '0' as sorter from deposit".$join.$where_clause." group by payment_type) order by payment_type, sorter desc, ".$_POST['order_by'].' '.$_POST['asce_desc']);
					}
					else{
						//otherwise combine all the different parts of the query and execute it
						$result = $db->query($query.$join.$where_clause.$order);
					}
					//cycle through all matching deposits creating a row for each with the deposit id as a link to deposit details page
					while($deposit = mysqli_fetch_assoc($result)){

					// $i++%2 is a trick to make rows alternate between row0 and row1 to allow for different styles
				?>
				<tr class="row<?=$i++%2?>">
					<td><a href="details.php?id=<?=$deposit['deposit_id']?>"><?=$deposit['deposit_id']?></a></td>
					<td><?=$deposit['last_name']?></td>
					<td><?=$deposit['first_name']?></td>
					<td><?=$deposit['deposit_time']?></td>
					<td><?=sprintf("%08d",$deposit['bb_account_id'])?></td>
					<td><?=$deposit['status'] == 'Bursars Hold'?'Bursars Hold':'Complete'?></td>
					<td><?=$deposit['mobile']?'Yes':'No'?></td>
					<td><?=$deposit['guest_id']==''?'NetID':($deposit['guest_id']=='0'?'Guest': 'GC')?></td>
					<td><?=$deposit['plan_name']?></td>
					<td><?=$deposit['new_signup']?'Yes':'No'?></td>
					<td>$<?=$deposit['total']?></td>
					<td><?=$deposit['payment_type']?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<?php
		//lastly if show totals was selected all the different totals should appear in a seperate area at the end
		if($_POST['totals']=='total'){
			//select the different overall totals still keeping the same where and join clauses as before
			$result = $db->query('select count(deposit_id) as num_deposits, sum(amount) as amount, sum(fee) as fee from deposit'.$join.$where_clause);
			$overall_totals = mysqli_fetch_assoc($result);

			//now select the totals by payment type again still keeping the join and where clauses
			$result = $db->query('select sum(total) as amount, payment_type from deposit'.$join.$where_clause.' group by payment_type');

			?>
			<fieldset id="overall-totals">
				<legend>Totals</legend>
				Total Deposits: $<?=$overall_totals['amount']?><br />
				Total Fees: $<?=$overall_totals['fee']?><br />
				&nbsp;&nbsp;Number of Deposits: <?=$overall_totals['num_deposits']?><br />
				<?php
				while($totals_by_type = mysqli_fetch_assoc($result))
					print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total '.$totals_by_type['payment_type'].': $'.$totals_by_type['amount'].'<br />';
				?>
			</fieldset>
			<?php
		}





	break;

	case 'remove-user':
		$db->query('delete from User_access where ID='.$_POST['id']);
	break;

	case 'remove-cashier':
		$db->query('delete from cashier_access where ID='.$_POST['id']);
	break;

	case 'add-user':
		$db->query('insert into User_access set netID="'.$_POST['netID'].'"');
		$query = 'select * from User_access';
		$result = $db->query($query);
	?>
	<legend>Backweb Access</legend>
	<table cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>netID</th>
			</tr>
		</thead>
		<tbody>
			<?php
				while($user = mysqli_fetch_assoc($result)){
			?>
					<tr class="row<?=$i++%2?>">
						<td onclick="remove_user(<?=$user['ID']?>, this)">X</td>
						<td><?=$user['netID']?></td>
					</tr>
			<?php
				}
			?>
					<tr class="row<?=$i++%2?>">
						<td><input type="button" value="add" onclick="add_user(document.getElementById('new_user_id').value)" /></td>

						<td><form onsubmit="return add_user(document.getElementById('new_user_id').value)"><input type="text" name="netID" id="new_user_id" /></form></td>
					</tr>
		</tbody>
	</table>
	<?php
	break;

	case 'add-user2':
		$db->query('insert into cashier_access set type="netID", value="'.$_POST['netID'].'"');
		$query = 'select * from cashier_access where type="netID"';
		$result = $db->query($query);
	?>
	<legend>Cashier Access</legend>
	<table cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>netID</th>
			</tr>
		</thead>
		<tbody>
			<?php
				while($user = mysqli_fetch_assoc($result)){
			?>
					<tr class="row<?=$i++%2?>">
						<td onclick="remove_user2(<?=$user['id']?>, this)">X</td>
						<td><?=$user['value']?></td>
					</tr>
			<?php
				}
			?>
					<tr class="row<?=$i++%2?>">
						<td><input type="button" value="add" onclick="add_user2(document.getElementById('new_user_id2').value)" /></td>

						<td><form onsubmit="return add_user2(document.getElementById('new_user_id2').value)"><input type="text" name="netID" id="new_user_id2" /></form></td>
					</tr>
		</tbody>
	</table>
	<?php
	break;

	case 'add-ip':
		$db->query('insert into cashier_access set type="IP", value="'.$_POST['ip'].'"');
		$query = 'select * from cashier_access where type="IP"';
		$result = $db->query($query);
	?>
	<legend>Cashier IPs</legend>
	<table cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>IP Address</th>
			</tr>
		</thead>
		<tbody>
			<?php
				while($user = mysqli_fetch_assoc($result)){
			?>
					<tr class="row<?=$i++%2?>">
						<td onclick="remove_user2(<?=$user['id']?>, this)">X</td>
						<td><?=$user['value']?></td>
					</tr>
			<?php
				}
			?>
					<tr class="row<?=$i++%2?>">
						<td><input type="button" value="add" onclick="add_ip(document.getElementById('new_ip_id').value)" /></td>

						<td><form onsubmit="return add_ip(document.getElementById('new_ip_id').value)"><input type="text" name="ip" id="new_ip_id" /></form></td>
					</tr>
		</tbody>
	</table>
	<?php
	break;

	case 'remove-pending-signup':
		$query = 'select * from deposit where deposit_id='.$_POST['id'];
		$result = $db->query($query);
		$deposit = mysqli_fetch_assoc($result);
		$db->query("delete from deposit where deposit_id=".$_POST['id']);
		$db->query("delete from signup_pending where deposit_id=".$_POST['id']);
		$db->query("delete from bursar_payment where bursar_id=".$deposit['bursar_id']);
		$db->query("delete from bursar_payment where bursar_id=".$deposit['bursar_fee_id']);

	break;
}

?>
