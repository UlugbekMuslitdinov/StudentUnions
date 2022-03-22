<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/mealplans/includes/bb.inc');

class BBCatCash {  
    private $BBlink = null;

    public function __construct()
    {
        $this->BBlink = bb_connect();
    }

    public function get_customer_info($id, $lastname)
    {	
        $BBlink = $this->BBlink;

        if($lastname == NULL){
            $query = 'select CUST_ID, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where CUSTNUM='.$id;
            $result = bb_query($BBlink, $query);		
        }
        else{
            $query = 'select CUST_ID, FIRSTNAME, LASTNAME, IS_ACTIVE, DEFAULTCARDNUM from Customer where CUSTNUM=:custnum_bv and LASTNAME=:lastname_bv';
            $result = oci_parse($BBlink, $query);
            oci_bind_by_name($result, ":custnum_bv", $id);
            oci_bind_by_name($result, ":lastname_bv", stripslashes($lastname), 30);
            oci_execute($result);
        }



        $bbcust = oci_fetch_assoc($result);
		
        if(oci_num_rows($result) == 0)
        return false;

        $customer_info = [];
        $customer_info['firstname'] = $bbcust['FIRSTNAME'];
        $customer_info['lastname'] = $bbcust['LASTNAME'];
        $customer_info['plan'] = $this->getPlanForCustID();
        $customer_info['id'] = $bbcust['CUST_ID'];
        $customer_info['cust_num'] = $id;
        $customer_info['balance'] = $this->get_balance($bbcust['CUST_ID']);
        $customer_info['is_active'] = $bbcust['IS_ACTIVE'];
        $customer_info['iso'] = '6017090'.substr($bbcust['DEFAULTCARDNUM'], -9, 9);			
        return $customer_info;	
    }

    public function getPlanForCustID()
    {
        $plan = [];
        $plan['ID'] = 7;
        $plan['BB_ID'] = 31;
        $plan['NAME'] = 'CatCash';
        $plan['TENDER_NUM'] = 3;
        $plan['EXPIRES'] = null;
        $plan['NUM_PAYMENTS'] = 1;

        return $plan;
    }

    public function get_balance($customer_id)
    {
        $BBlink = $this->BBlink;

        $query = 'select sum(BALANCE) as TOTALBALANCE from Customer_sv_account join sv_account on sv_account.sv_account_id=Customer_sv_account.sv_account_id  where Customer_sv_account.sv_account_type_id = 31 and cust_id='.$customer_id.' group by cust_id';
        $result = bb_query($BBlink, $query);

        $accounts = oci_fetch_assoc($result);

        return $accounts['TOTALBALANCE']/1000;
    }

    public function get_transaction_count($customer_id)
    {
        $BBlink = bb_connect();
        $query = 'select sv_account_type_id from sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id where sv_account_type_id = 31 and cust_id='.$customer_id;

        $count_query = 	"SELECT COUNT(*) AS num_rows FROM($query)";
        $result = bb_query($BBlink, $count_query);
        $total = oci_fetch_assoc($result);

        return $total['NUM_ROWS'];
    }

    public function get_transaction($customer_id, $start_row=0, $end_row=31)
    {
        $BBlink = bb_connect();
        if(empty($start) && empty($end)){
            $query = 'SELECT  TO_CHAR(UDF_FUNCTIONS.UDF_TDATETIMETOORACLEDATETIME(datetime), \'Mon dd, yyyy hh:miam\') as datetimef, TRAN_PROFITCENTER_NAME, DEBIT_CREDIT_TYPE, ENDING_BALANCE, AMOUNT, sv_account_history.SV_ACCOUNT_ID, DATETIME FROM sv_account_history join sv_account on sv_account.sv_account_id=sv_account_history.sv_account_id WHERE cust_id='.$customer_id.' and sv_account_type_id = 31 order by datetime desc';
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
}