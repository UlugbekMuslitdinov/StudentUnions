<?php
require_once('includes/db.inc');
db_connect();
db_select('mealplans');

define("COMMITMENT_ID", 1);
define("NONTAX_ID", 2);
define("TAXABLE_ID", 3);

function bb_connect(){
	$BBlink = oci_connect('guest', 'cHeer#03', '150.135.73.45:1521/BBTS');
	if (!$BBlink) {
	    $e = oci_error();
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	return $BBlink;
}

function bb_query($conn, $query){
	//print $query.'<br />';
	$result = oci_parse($conn, $query);
		
	oci_execute($result);
	
	return $result;
}

function getBBCustumerWithCustNum($mp_id){
	$BBlink = bb_connect();
	
	$query = 'select * from Customer left join Customer_sv_account on Customer.cust_id=Customer_sv_account.cust_id left join sv_account on sv_account.sv_account_id=Customer_sv_account.sv_account_id  where (Customer_sv_account.sv_account_type_id is null or Customer_sv_account.sv_account_type_id in (1,2,3)) and custnum='.$mp_id;
	
	$result = bb_query($BBlink, $query);
	
	$bbcust = oci_fetch_assoc($result);
	
	
	if(oci_num_rows($result) == 0)
		return false;
		
	$_SESSION['bb_cust'] = $bbcust;
	if($bbcust['IS_ACTIVE']  == 'F'){
		print 'your account is not active';
	}
	
	if($bbcust['SV_ACCOUNT_TYPE_ID'] == NULL){
		header("Location:chooseplan.php");
		exit();
	}	
}

function getBBcustFromId($mp_id, $last_name){
	$BBlink = bb_connect();
	
	if($last_name == NULL){
		$query = 'select CUST_ID, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where CUSTNUM='.$mp_id;
		$result = bb_query($BBlink, $query);
	}
	else{
		$query = 'select CUST_ID, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where CUSTNUM=:custnum_bv and LASTNAME=:lastname_bv';
		$result = oci_parse($BBlink, $query);
		oci_bind_by_name($result, ":custnum_bv", $mp_id);
		oci_bind_by_name($result, ":lastname_bv", stripslashes($last_name), 30);
		oci_execute($result);
	}
		
	
	
	$bbcust = oci_fetch_assoc($result);
	
	if(oci_num_rows($result) == 0)
		return false;

		
		
	$mp_cust['firstname'] = $bbcust['FIRSTNAME'];
	$mp_cust['lastname'] = $bbcust['LASTNAME'];
	$mp_cust['plan'] = getPlanForCustID($bbcust['CUST_ID']);
	$mp_cust['id'] = $bbcust['CUST_ID'];
	$mp_cust['cust_num'] = $mp_id;
	$mp_cust['balance'] = getBalanceForCustID($bbcust['CUST_ID']);
	$mp_cust['is_active'] = $bbcust['IS_ACTIVE'];
	$mp_cust['iso'] = '6017090'.substr($bbcust['DEFAULTCARDNUM'], -9, 9);
	
	return $mp_cust;
}

function getPlanForCustID($bb_id){
	$BBlink = bb_connect();
	
	$query = 'select NAME, customer_def_grp_def_item.CUSTOMER_DEF_GRP_DEF_ITEM_ID as BB_ID from customer_def_grp_value join customer_def_grp_def_item on customer_def_grp_value.customer_def_grp_def_item_id = customer_def_grp_def_item.customer_def_grp_def_item_id where cust_id='.$bb_id;
	
	$result = bb_query($BBlink, $query);
	
	$active_grp = oci_fetch_assoc($result);
	
	if(oci_num_rows($result) == 0)
		return NULL;

	$query = 'select field_value from customer_def_field_value where customer_def_field_def_id = 31 and cust_id='.$bb_id;
	//print $query;
	$result = bb_query($BBlink, $query);
	$row = oci_fetch_assoc($result);
	$active_grp['NUM_PAYMENTS'] = $row['FIELD_VALUE'] == NULL?1:2;
	
	$query = 'select plan_id, tender_num, expiration_date from plan where bb_plan_id='.$active_grp['BB_ID'];
	$result = db_query($query);
	$plan = mysql_fetch_assoc($result);
	$active_grp['ID'] = $plan['plan_id'];
	$active_grp['TENDER_NUM'] = $plan['tender_num'];
	$active_grp['EXPIRES'] = $plan['expiration_date'];
	
		
	return $active_grp;
}

function getBalanceForCustID($bb_id){
	$BBlink = bb_connect();
	$query = 'select sum(BALANCE) as TOTALBALANCE from Customer_sv_account join sv_account on sv_account.sv_account_id=Customer_sv_account.sv_account_id  where (Customer_sv_account.sv_account_type_id in (1,2,3)) and cust_id='.$bb_id.' group by cust_id';
	$result = bb_query($BBlink, $query);
	
	$accounts = oci_fetch_assoc($result);
	
	return $accounts['TOTALBALANCE']/1000;
}

function getBBTransactions($bb_id, $start_row, $end_row){
	$BBlink = bb_connect();
	$transaction_counts = getTransactionCountForEachAccont($bb_id);

	if($transaction_counts[NONTAX_ID]['count'] > 0 && $transaction_counts[COMMITMENT_ID]['count'] > 0){
		$query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT, sv_account_history.SV_ACCOUNT_ID, DATETIME FROM sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id WHERE cust_id='.$bb_id.' and sv_account_type_id in (1,2,3) order by datetime desc';
		$query_paged = 'SELECT * FROM (SELECT r.*, ROWNUM as row_number FROM ( '.$query.' ) r WHERE ROWNUM <= '.$end_row.') WHERE '.$start_row.' <= row_number';
		$result = bb_query($BBlink, $query_paged);
		$i=0;
		$balance = array($transaction_counts[COMMITMENT_ID]['id'] => 0, $transaction_counts[NONTAX_ID]['id'] => 0);
		while($transaction = oci_fetch_assoc($result)){
			$transactions[$i]['when'] = $transaction['DATETIMEF'];
			$transactions[$i]['where'] = is_numeric($transaction['TRAN_PROFITCENTER_NAME'][strlen($transaction['TRAN_PROFITCENTER_NAME'])-1])?substr($transaction['TRAN_PROFITCENTER_NAME'], 0, -7):$transaction['TRAN_PROFITCENTER_NAME'];
			$transactions[$i]['debit'] = ($transaction['DEBIT_CREDIT_TYPE']?'':'-');
			$transactions[$i]['amount'] = $transaction['AMOUNT']/1000;
			$transactions[$i]['balance'] = $transaction['ENDING_BALANCE']/1000;
			$transactions[$i]['account_id'] = $transaction['SV_ACCOUNT_ID'];
			$transactions[$i]['datetime'] = $transaction['DATETIME'];
			$balance[$transaction['SV_ACCOUNT_ID']] =  $transactions[$i]['balance'] + ($transaction['DEBIT_CREDIT_TYPE']?-$transactions[$i]['amount']:$transactions[$i]['amount']); 
			$i++;
		}
		--$i;
		
		//var_dump($balance);
		
		foreach($balance as $account_id => $bal){
			if($bal == 0){
				$query = 'select ending_balance from sv_account_history where cust_id='.$bb_id.' and sv_account_id='.$account_id.' and datetime < '.$transactions[$i]['datetime'].' order by datetime desc';
				$result = bb_query($BBlink, $query);
				if($row = oci_fetch_assoc($result))
					$balance[$account_id] = $row['ENDING_BALANCE'];
			}
			
		}
		
		//var_dump($balance);
		for($i; $i > -1; $i--){
			$balance[$transactions[$i]['account_id']] = $transactions[$i]['balance'];
			$transactions[$i]['balance'] += $transaction_counts[NONTAX_ID]['id'] == $transactions[$i]['account_id'] ? $balance[$transaction_counts[COMMITMENT_ID]['id']]:$balance[$transaction_counts[NONTAX_ID]['id']];
			
		}
		
		
		
	}
	else{
	
		$query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT FROM sv_account_history WHERE cust_id='.$bb_id.' order by datetime desc';
		$query_paged = 'SELECT * FROM (SELECT r.*, ROWNUM as row_number FROM ( '.$query.' ) r WHERE ROWNUM <= '.$end_row.') WHERE '.$start_row.' <= row_number';
		$result = bb_query($BBlink, $query_paged);
		$i=0;
		while($transaction = oci_fetch_assoc($result)){
			$where = is_numeric($transaction['TRAN_PROFITCENTER_NAME'][strlen($transaction['TRAN_PROFITCENTER_NAME'])-1])?substr($transaction['TRAN_PROFITCENTER_NAME'], 0, -7):$transaction['TRAN_PROFITCENTER_NAME'];
			if($where == 'Tomdra')
				$where = 'Snack Machine';
			elseif($where == 'Coca-Cola')
				$where = 'Soda Machine';
			
			
			$transactions[$i]['when'] = $transaction['DATETIMEF'];
			$transactions[$i]['where'] = $where;
			$transactions[$i]['debit'] = ($transaction['DEBIT_CREDIT_TYPE']?'':'-');
			$transactions[$i]['amount'] = $transaction['AMOUNT']/1000;
			$transactions[$i]['balance'] = $transaction['ENDING_BALANCE']/1000;
			
			$i++;
		}
				
	}
	
	return $transactions;
}
function getTransactionCountForEachAccont($bb_id){
	$BBlink = bb_connect();
	$query = 'SELECT  customer_sv_account.cust_id, sv_account_type_id, customer_sv_account.sv_account_id FROM sv_account_history join customer_sv_account on sv_account_history.sv_account_id=customer_sv_account.sv_account_id WHERE sv_account_history.cust_id='.$bb_id;
	$count_query = 	"SELECT COUNT(cust_id) AS num_rows, sv_account_id, sv_account_type_id FROM($query)".' group by sv_account_type_id, sv_account_id';
	$result = bb_query($BBlink, $count_query);
	while($row = oci_fetch_assoc($result)){
		$total[$row['SV_ACCOUNT_TYPE_ID']] = array('count' => $row['NUM_ROWS'], 'id' => $row['SV_ACCOUNT_ID']);
	}
	return $total;
}
function getBBTransactionCount($bb_id){
	$BBlink = bb_connect();
	$query = 'SELECT  cust_id FROM sv_account_history WHERE cust_id='.$bb_id;
	$count_query = 	"SELECT COUNT(*) AS num_rows FROM($query)";
	$result = bb_query($BBlink, $count_query);
	$total = oci_fetch_assoc($result);
	return $total['NUM_ROWS'];	
}