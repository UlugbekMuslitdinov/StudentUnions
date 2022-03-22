<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

define("COMMITMENT_ID", 1);
define("NONTAX_ID", 2);
define("TAXABLE_ID", 3);

define("COMMUTER_ID", 2);
define("PLUS5_ID", 46);
define("PLUS7_ID", 47);
define("PLUS10_ID", 48);
define("ENRICHMENT_TAX_ID", 49);
define("ENRICHMENT_ID", 50);
define("STAFF_ID", 43);

define("FIFTYFIFTY_ID", 41);

define("CATCASH_ID", 31);
define("RESLIFE_ID", 45);
// print("mpid: " . $mp_id. "<br/>");

function bb_connect(){
	// $BBlink = oci_connect('guest', 'cHeer#03', '150.135.72.244');
	// $BBlink = oci_connect('guest', 'cHeer#03', '150.135.73.45:1521/BBTS');	// BB Prod Server
	$BBlink = oci_connect('guest', 'cHeer#03', '150.135.74.147:1521/BBTS'); // BB Test Server
	if (!$BBlink) {
	    $e = oci_error();

		// print "<pre>".print_r($e, true)."</pre>";

	    // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	return $BBlink;
}

function bb_query($conn, $query){
	//print $query.'<br />';
	$result = oci_parse($conn, $query);

	oci_execute($result);

	return $result;
}

//not sure if this is used
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

//return mealplan account object which contains all basic info needed by the app
function getBBcustFromId($mp_id, $last_name){
	//print("mp_id:" . $mp_id . "</br>");
//	print("last_name:" . $last_name . "</br>");
//	exit();
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
	// print("balance: " . $mp_cust['balance']);
	// exit();
	return $mp_cust;
}

function getPlanIDS(){
  return array(COMMUTER_ID, PLUS5_ID, PLUS7_ID, PLUS10_ID, STAFF_ID, FIFTYFIFTY_ID);
}
function getAccountIDS(){
  return array(COMMUTER_ID, PLUS5_ID, PLUS7_ID, PLUS10_ID, STAFF_ID, FIFTYFIFTY_ID, ENRICHMENT_ID, ENRICHMENT_TAX_ID);
}

function getPlanNameFromID($plan_id){
  switch($plan_id){
    case COMMUTER_ID:
      return "Commuter";
    break;

    case PLUS5_ID:
      return "Copper";
    break;

    case PLUS7_ID:
      return "Silver";
    break;

    case PLUS10_ID:
      return "Gold";
    break;

    case STAFF_ID:
      return "Faculty/Staff";
    break;

    case FIFTYFIFTY_ID:
      return "50/50";
    break;
  }
}

function getPlanForCustID($bb_id){
	$db = new db_mysqli('mealplans');
	$BBlink = bb_connect();


  $query = 'select SV_ACCOUNT_TYPE_ID as BB_ID from CUSTOMER_SV_ACCOUNT where SV_ACCOUNT_TYPE_ID in ('.implode(', ', getPlanIDS()).') and CUST_ID ='.$bb_id;

	$result = bb_query($BBlink, $query);

	$active_grp = oci_fetch_assoc($result);


	if(oci_num_rows($result) == 0)
		return NULL;

  $active_grp['NAME'] = getPlanNameFromID($active_grp['BB_ID']);
   /*
   $query = 'select NAME, customer_def_grp_def_item.CUSTOMER_DEF_GRP_DEF_ITEM_ID as BB_ID from customer_def_grp_value join customer_def_grp_def_item on customer_def_grp_value.customer_def_grp_def_item_id = customer_def_grp_def_item.customer_def_grp_def_item_id where cust_id='.$bb_id;

  $result = bb_query($BBlink, $query);

  $active_grp = oci_fetch_assoc($result);
  */
  if(oci_num_rows($result) == 0)
    return NULL;

  switch($active_grp['BB_ID']){
    case 1:
      $active_grp['BB_ID'] = 41;
    break;
    case 2:
      $active_grp['BB_ID'] = 2;
    break;
    case 3:
      $active_grp['BB_ID'] = 43;
    break;

  }


	$query = 'select field_value from customer_def_field_value where customer_def_field_def_id = 31 and cust_id='.$bb_id;
	//print $query;
	$result = bb_query($BBlink, $query);
	$row = oci_fetch_assoc($result);
	$active_grp['NUM_PAYMENTS'] = $row['FIELD_VALUE'] == NULL?1:2;

	$query = 'select plan_id, tender_num, expiration_date from plan where bb_plan_id='.$active_grp['BB_ID'];

	$result = $db->query($query);
	$plan = mysqli_fetch_assoc($result);
	$active_grp['ID'] = $plan['plan_id'];
	$active_grp['TENDER_NUM'] = $plan['tender_num'];
	$active_grp['EXPIRES'] = $plan['expiration_date'];

	return $active_grp;
}

function getBalanceForCustID($bb_id){
	$BBlink = bb_connect();
	$query = 'select sum(BALANCE) as TOTALBALANCE from Customer_sv_account join sv_account on sv_account.sv_account_id=Customer_sv_account.sv_account_id  where (Customer_sv_account.sv_account_type_id in ('.implode(', ', getAccountIDS()).')) and cust_id='.$bb_id.' group by cust_id';
	$result = bb_query($BBlink, $query);

	$accounts = oci_fetch_assoc($result);

	return $accounts['TOTALBALANCE']/1000;
}

function getBBTransactionsForAccountType($bb_id, $account_type, $start_row=0, $end_row=31){
	$BBlink = bb_connect();
	if(empty($start) && empty($end)){
		$query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT, sv_account_history.SV_ACCOUNT_ID, DATETIME FROM sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id WHERE cust_id='.$bb_id.' and sv_account_type_id in ('.$account_type.') order by datetime desc';
		$query_paged = 'SELECT * FROM (SELECT r.*, ROWNUM as row_number FROM ( '.$query.' ) r WHERE ROWNUM <= '.$end_row.') WHERE '.$start_row.' <= row_number';
		$result = bb_query($BBlink, $query_paged);
		$i=0;
		while($transaction = oci_fetch_assoc($result)){

			$transactions[$i]['when'] = $transaction['DATETIMEF'];
			$transactions[$i]['where'] = is_numeric($transaction['TRAN_PROFITCENTER_NAME'][strlen($transaction['TRAN_PROFITCENTER_NAME'])-1])?substr($transaction['TRAN_PROFITCENTER_NAME'], 0, -7):$transaction['TRAN_PROFITCENTER_NAME'];
			$transactions[$i]['debit'] = ($transaction['DEBIT_CREDIT_TYPE']?'':'-');
			$transactions[$i]['amount'] = $transaction['AMOUNT']/1000;
			$transactions[$i]['balance'] = $transaction['ENDING_BALANCE']/1000;
			$transactions[$i]['account_id'] = $transaction['SV_ACCOUNT_ID'];
			$transactions[$i]['datetime'] = $transaction['DATETIME'];
			$i++;
		}
	}

	return $transactions;
}
function getAccountIdsForAccounts($bb_id, $accounts){
	$BBlink = bb_connect();
	$query = 'select SV_ACCOUNT_ID from CUSTOMER_SV_ACCOUNT where cust_id='.$bb_id.' and SV_ACCOUNT_TYPE_ID in('.implode(', ', $accounts).')';
	$result = bb_query($BBlink, $query);
	while($account = oci_fetch_assoc($result))
		$account_ids[] = $account['SV_ACCOUNT_ID'];
	return $account_ids;
}
function getBBTransactionsForAccounts($bb_id, $accounts, $start_row, $end_row){
	$BBlink = bb_connect();
	$account_ids = getAccountIdsForAccounts($bb_id, $accounts);

	//initialize balance array which will be used to hold the balance of each account type
	foreach($account_ids as $account){
		  $balance[$account['id']] = 0;
	}

	$query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT, sv_account_history.SV_ACCOUNT_ID, DATETIME, SV_ACCOUNT_TYPE_ID, TRAN_LINEITEM_SEQUENCENUMBER FROM sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id WHERE cust_id='.$bb_id.' and sv_account_type_id in ('.implode(', ',$accounts).') order by datetime desc';
	$query_paged = 'SELECT * FROM (SELECT r.*, ROWNUM as row_number FROM ( '.$query.' ) r WHERE ROWNUM <= '.$end_row.') WHERE '.$start_row.' <= row_number';
	$result = bb_query($BBlink, $query_paged);
	$i=0;

	while($transaction = oci_fetch_assoc($result)){
		 //var_dump($transaction);
		$transactions[$i]['when'] = $transaction['DATETIMEF'];
		$transactions[$i]['where'] = is_numeric($transaction['TRAN_PROFITCENTER_NAME'][strlen($transaction['TRAN_PROFITCENTER_NAME'])-1])?substr($transaction['TRAN_PROFITCENTER_NAME'], 0, -7):$transaction['TRAN_PROFITCENTER_NAME'];
		$transactions[$i]['debit'] = ($transaction['DEBIT_CREDIT_TYPE']?'':'-');
		$transactions[$i]['amount'] = $transaction['AMOUNT']/1000;
		$transactions[$i]['balance'] = $transaction['ENDING_BALANCE']/1000;
		$transactions[$i]['account_id'] = $transaction['SV_ACCOUNT_ID'];
		$transactions[$i]['account_type_id'] = $transaction['SV_ACCOUNT_TYPE_ID'];
		$transactions[$i]['datetime'] = $transaction['DATETIME'];
		$transactions[$i]['seqnum'] = $transaction['TRAN_LINEITEM_SEQUENCENUMBER'];
     	//used to try an extract beginning balance of each account prior to these transactions
		$balance[$transaction['SV_ACCOUNT_ID']] =  $transactions[$i]['balance'] + ($transaction['DEBIT_CREDIT_TYPE']?-$transactions[$i]['amount']:$transactions[$i]['amount']);
		$i++;
	}
	--$i;

	//for each account type if a beginning balance was not obtained from the transactions get ending balance from most recent transaction prior to this set of transactions
	foreach($balance as $account_id => $bal){
		if($bal == 0){
			$query = 'select ending_balance from sv_account_history where cust_id='.$bb_id.' and sv_account_id='.$account_id.' and datetime < '.$transactions[$i]['datetime'].' order by datetime desc';
			$result = bb_query($BBlink, $query);
			if($row = oci_fetch_assoc($result))
				$balance[$account_id] = $row['ENDING_BALANCE']/1000;
		}

	}

	//add the ending balance of each transaction to the balance of the other accounts at that time
	for($i; $i > -1; $i--){
		$balance[$transactions[$i]['account_id']] = $transactions[$i]['balance'];
		foreach($balance as $id => $amount){
			if($id != $transactions[$i]['account_id'])
				$transactions[$i]['balance'] += $amount;
		}
	}
	return $transactions;
}
function getBBTransactions($bb_id, $start_row, $end_row){
	$BBlink = bb_connect();
	$transaction_counts = getTransactionCountForEachAccont($bb_id);

	if(false)//$transaction_counts[ENRICHMENT_ID]['count'] > 0){
		{
		$query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT, sv_account_history.SV_ACCOUNT_ID, DATETIME FROM sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id WHERE cust_id='.$bb_id.' and sv_account_type_id in ('.implode(', ',getAccountIDS()).', 1, 3) order by datetime desc';
		var_dump($query);
		$query_paged = 'SELECT * FROM (SELECT r.*, ROWNUM as row_number FROM ( '.$query.' ) r WHERE ROWNUM <= '.$end_row.') WHERE '.$start_row.' <= row_number';
		$result = bb_query($BBlink, $query_paged);
		$i=0;
		//$balance = array($transaction_counts[ENRICHMENT_ID]['id'] => 0, $transaction_counts[PLUS5_ID]['id'] => 0, $transaction_counts[PLUS7_ID]['id'] => 0, $transaction_counts[PLUS10_ID]['id'] => 0);
		foreach($transaction_counts as $account){
		  $balance[$account['id']] = 0;
		}


		while($transaction = oci_fetch_assoc($result)){

			$transactions[$i]['when'] = $transaction['DATETIMEF'];
			$transactions[$i]['where'] = is_numeric($transaction['TRAN_PROFITCENTER_NAME'][strlen($transaction['TRAN_PROFITCENTER_NAME'])-1])?substr($transaction['TRAN_PROFITCENTER_NAME'], 0, -7):$transaction['TRAN_PROFITCENTER_NAME'];
			$transactions[$i]['debit'] = ($transaction['DEBIT_CREDIT_TYPE']?'':'-');
			$transactions[$i]['amount'] = $transaction['AMOUNT']/1000;
			$transactions[$i]['balance'] = $transaction['ENDING_BALANCE']/1000;
			$transactions[$i]['account_id'] = $transaction['SV_ACCOUNT_ID'];
			$transactions[$i]['datetime'] = $transaction['DATETIME'];
      //get balance for each account type before the current transaction
			$balance[$transaction['SV_ACCOUNT_ID']] =  $transactions[$i]['balance'] + ($transaction['DEBIT_CREDIT_TYPE']?-$transactions[$i]['amount']:$transactions[$i]['amount']);
			$i++;
		}
		--$i;

		//for each account type if a previous balance was not obtained from the transactions safe to use account ending balance
		foreach($balance as $account_id => $bal){
			if($bal == 0){
				$query = 'select ending_balance from sv_account_history where cust_id='.$bb_id.' and sv_account_id='.$account_id.' and datetime < '.$transactions[$i]['datetime'].' order by datetime desc';
				$result = bb_query($BBlink, $query);
				if($row = oci_fetch_assoc($result))
					$balance[$account_id] = $row['ENDING_BALANCE']/1000;
			}

		}

		//add the ending balance of each transaction to the balance of the other accounts at that time
		for($i; $i > -1; $i--){
			$balance[$transactions[$i]['account_id']] = $transactions[$i]['balance'];
			$transactions[$i]['balance'] += $transaction_counts[ENRICHMENT_ID]['id'] == $transactions[$i]['account_id'] ? ($balance[$transaction_counts[PLUS5_ID]['id']] + $balance[$transaction_counts[PLUS7_ID]['id']] + $balance[$transaction_counts[PLUS10_ID]['id']]):$balance[$transaction_counts[ENRICHMENT_ID]['id']];

		}



	}
  else if(false)//$transaction_counts[ENRICHMENT_TAX_ID]['count'] > 0){
		{
    $query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT, sv_account_history.SV_ACCOUNT_ID, DATETIME, sv_account_type_id FROM sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id WHERE cust_id='.$bb_id.' and sv_account_type_id in ('.implode(', ',getAccountIDS()).', 1, 3) order by datetime desc';
		var_dump($query);
    $query_paged = 'SELECT * FROM (SELECT r.*, ROWNUM as row_number FROM ( '.$query.' ) r WHERE ROWNUM <= '.$end_row.') WHERE '.$start_row.' <= row_number';
    $result = bb_query($BBlink, $query_paged);
    $i=0;
    foreach($transaction_counts as $account){
      $balance[$account['id']] = 0;
    }
    while($transaction = oci_fetch_assoc($result)){
      $transactions[$i]['when'] = $transaction['DATETIMEF'];
      $transactions[$i]['where'] = is_numeric($transaction['TRAN_PROFITCENTER_NAME'][strlen($transaction['TRAN_PROFITCENTER_NAME'])-1])?substr($transaction['TRAN_PROFITCENTER_NAME'], 0, -7):$transaction['TRAN_PROFITCENTER_NAME'];
      $transactions[$i]['debit'] = ($transaction['DEBIT_CREDIT_TYPE']?'':'-');
      $transactions[$i]['amount'] = $transaction['AMOUNT']/1000;
      $transactions[$i]['balance'] = $transaction['ENDING_BALANCE']/1000;
      $transactions[$i]['account_id'] = $transaction['SV_ACCOUNT_ID'];
      $transactions[$i]['datetime'] = $transaction['DATETIME'];
      $transactions[$i]['type'] = $transaction['SV_ACCOUNT_TYPE_ID'];
      //get balance for each account type before the current transaction
      $balance[$transaction['SV_ACCOUNT_ID']] =  $transactions[$i]['balance'] + ($transaction['DEBIT_CREDIT_TYPE']?-$transactions[$i]['amount']:$transactions[$i]['amount']);
      $i++;
    }
    --$i;

    //for each account type if a previous balance was not obtained from the transactions safe to use account ending balance
    foreach($balance as $account_id => $bal){
      if($bal == 0){
        $query = 'select ending_balance from sv_account_history where cust_id='.$bb_id.' and sv_account_id='.$account_id.' and datetime < '.$transactions[$i]['datetime'].' order by datetime desc';
        $result = bb_query($BBlink, $query);
        if($row = oci_fetch_assoc($result))
          $balance[$account_id] = $row['ENDING_BALANCE']/1000;
      }

    }
    //add the ending balance of each transaction to the balance of the other accounts at that time
    for($i; $i > -1; $i--){
      $balance[$transactions[$i]['account_id']] = $transactions[$i]['balance'];
      $transactions[$i]['balance'] += $transaction_counts[ENRICHMENT_TAX_ID]['id'] == $transactions[$i]['account_id'] ? ($balance[$transaction_counts[STAFF_ID]['id']]):$balance[$transaction_counts[ENRICHMENT_TAX_ID]['id']];

    }



  }
	else{

	foreach($transaction_counts as $account){
	 $accounts[]=$account['id'];
	}
  $accounts[] = 1;
  $accounts[] = 3;

		$query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT FROM sv_account_history WHERE cust_id='.$bb_id.' and sv_account_id in ('.implode(", ", $accounts).') order by datetime desc';
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
	//$query = 'SELECT  customer_sv_account.cust_id, sv_account_type_id, customer_sv_account.sv_account_id FROM sv_account_history join customer_sv_account on sv_account_history.sv_account_id=customer_sv_account.sv_account_id WHERE customer_sv_account.sv_account_type_id in ('.implode(", ", getAccountIDS()).') and sv_account_history.cust_id='.$bb_id;
	$query = 'SELECT  cust_id, sv_account_type_id, sv_account.sv_account_id FROM sv_account_history join sv_account on sv_account_history.sv_account_id=sv_account.sv_account_id WHERE sv_account.sv_account_type_id in ('.implode(", ", getAccountIDS()).', 1, 3) and sv_account_history.cust_id='.$bb_id;
	$count_query = 	"SELECT COUNT(cust_id) AS num_rows, sv_account_id, sv_account_type_id FROM($query)".' group by sv_account_type_id, sv_account_id';
	$result = bb_query($BBlink, $count_query);
	while($row = oci_fetch_assoc($result)){
		if (isset($total[$row['SV_ACCOUNT_TYPE_ID']]) && $total[$row['SV_ACCOUNT_TYPE_ID']] == NULL)
		{
			$total[$row['SV_ACCOUNT_TYPE_ID']] = array('count' => $row['NUM_ROWS'], 'id' => $row['SV_ACCOUNT_ID']);
		}
		else
		{
			$total[] = array('count' => $row['NUM_ROWS'], 'id' => $row['SV_ACCOUNT_ID']);
		}
	}
	return $total;
}
function getBBTransactionCount($bb_id){

	$BBlink = bb_connect();
	$query = 'select sv_account_type_id from sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id where sv_account_type_id in ('.implode(', ', getAccountIDS()).', 1, 3) and cust_id='.$bb_id;

	$count_query = 	"SELECT COUNT(*) AS num_rows FROM($query)";
	$result = bb_query($BBlink, $count_query);
	$total = oci_fetch_assoc($result);

	return $total['NUM_ROWS'];
}

function getSPFromId(){
	$BBlink = bb_connect();

	$cust_num = $_SESSION['mp_cust']['cust_num'];
	$query = "SELECT c.custnum, c.firstname, c.lastname, cbv.boardplanid, b.boardplan, cbv.weekallowed, cbv.weekused, cbv.weekbalance, cbv.monthallowed, cbv.monthused, cbv.monthbalance, cbv.semqtrallowed, cbv.semqtrused, cbv.semqtrbalance, cbv.yearallowed, cbv.yearused, cbv.yearbalance
	from customerboardplanusagestatus cbv, customer c, boardplan b
	where cbv.customerid=c.cust_id 
	and cbv.boardplanid=b.boardplan_id
	and cbv.boardplanid in (15,22,23,25,26,27,28) 
	and c.custnum='$cust_num'
	order by cbv.boardplanid";

	$result = bb_query($BBlink, $query);
	$bbcust = oci_fetch_assoc($result);

	if(oci_num_rows($result) == 0)
		return NULL;

	$return = [
		'firstname' => $bbcust['FIRSTNAME'],
		'lastname' => $bbcust['LASTNAME'],
		'plan_name' => $bbcust['BOARDPLAN'],
		'plan_id' => $bbcust['BOARDPLANID']
	];

	return $return;
}

function getBalanceForSwipe($mp_id){
	$BBlink = bb_connect();

	$query = "SELECT c.custnum, c.firstname, c.lastname, cbv.boardplanid, b.boardplan, cbv.weekallowed, cbv.weekused, cbv.weekbalance, cbv.monthallowed, cbv.monthused, cbv.monthbalance, cbv.semqtrallowed, cbv.semqtrused, cbv.semqtrbalance, cbv.yearallowed, cbv.yearused, cbv.yearbalance
	from customerboardplanusagestatus cbv, customer c, boardplan b
	where cbv.customerid=c.cust_id 
	and cbv.boardplanid=b.boardplan_id
	and cbv.boardplanid in (15,22,23,25,26,27,28) 
	and c.custnum='$mp_id'
	order by cbv.boardplanid";

	$result = bb_query($BBlink, $query);
	$bbcust = oci_fetch_assoc($result);

	$balance = 0;
	if ($bbcust['BOARDPLANID'] == 22)
	{
		$balance = $bbcust['SEMQTRBALANCE'];
	} elseif (($bbcust['BOARDPLANID'] == 25 || ($bbcust['BOARDPLANID'] == 26) || ($bbcust['BOARDPLANID'] == 27) || ($bbcust['BOARDPLANID'] == 28))) {
		$balance = $bbcust['MONTHBALANCE'];
	} else {
		$balance = $bbcust['YEARBALANCE'];
	}
	return $balance;
}

function getTransactionsCountForSwipe($cust_num){
	$BBlink = bb_connect();
	$query = "select custnum from V_boardtransaction where boardplan != 'Finals Survival' AND DENIED='F' AND CUSTNUM = '$cust_num' order by actualdatetime";

	$count_query = 	"SELECT COUNT(*) AS num_rows FROM($query)";
	$result = bb_query($BBlink, $count_query);
	$total = oci_fetch_assoc($result);

	return $total['NUM_ROWS'];
}
function getTransactionsForSwipe($cust_num, $start_row, $end_row){
	$BBlink = bb_connect();
	
	$query = "select to_char(to_date('12-30-1899','mm-dd-yyyy') + ACTUALDATETIME,'mm-dd-yyyy hh24:mi:ss')as Date_Time ,custnum ,BOARDPLAN ,pcname ,COUNTUSED from V_boardtransaction where boardplan != 'Finals Survival' AND DENIED='F' AND CUSTNUM = '$cust_num' order by actualdatetime DESC";
	$query_paged = 'SELECT * FROM (SELECT r.*, ROWNUM as row_number FROM ( '.$query.' ) r WHERE ROWNUM <= '.$end_row.') WHERE '.$start_row.' <= row_number';
	$result = bb_query($BBlink, $query_paged);

	$i=0;
	while($transaction = oci_fetch_assoc($result)){
		// $where = is_numeric($transaction['TRAN_PROFITCENTER_NAME'][strlen($transaction['TRAN_PROFITCENTER_NAME'])-1])?substr($transaction['TRAN_PROFITCENTER_NAME'], 0, -7):$transaction['TRAN_PROFITCENTER_NAME'];
		// if($where == 'Tomdra')
		// 	$where = 'Snack Machine';
		// elseif($where == 'Coca-Cola')
		// 	$where = 'Soda Machine';

		$transactions[$i]['when'] = $transaction['DATE_TIME'];

		$pcname = explode(' ', $transaction['PCNAME']);
		$search = ['1631850', '1631700', '1631930', '1631780', '1631250', '1632000', '1631200', '1634700', '1631300', '1631950', '163240', '1631770', '1632050', '1631350', '1631830', '1631550', '1631900', '1631860', '1631870', '1631500', '1631760', '163179', '1631400', '1631450', '1631840'];
		$transactions[$i]['where'] = str_replace($search, '', implode(" ", str_replace($search, '', $pcname)));

		$transactions[$i]['plan'] = $transaction['BOARDPLAN'];
		$i++;
	}

	return $transactions;
}
