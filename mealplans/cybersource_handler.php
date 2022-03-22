<?php
session_start();
require_once ('includes/mysqli.inc');
require_once('includes/tia.php');
require_once('includes/mp_functions.inc');

$db = new db_mysqli('mealplans');

//////////////////////////////////////////////////////////////////
//																                              //
//				SAVE DATA SENT BACK FROM CYBERSOURCE			            //
//																                              //
//////////////////////////////////////////////////////////////////
	
	$_SESSION['payment_email']=$_POST['billTo_email'];
	$_SESSION['payment_phone']=$_POST['billTo_phoneNumber'];
	$_SESSION['payment_amount'] = $_POST['orderAmount'];
	

	//if this is the first attempt to submit payment
	if($_POST['paymentID'] == 0){
		
		//get app id based on form page
		//$result = mysql_query('select ID from applications where form_page="'.$_POST['form_page'].'"');
		//$app = mysql_fetch_assoc($result);
		
		//save whatever data was returned to database
		$query = "insert into Charge_payment set "
					.'ch_first_name ="'. substr($_POST['billTo_firstName'], 0, 60).'", '
					.'ch_last_name ="'. substr($_POST['billTo_lastName'], 0, 60).'", '
					.'address ="'. substr($_POST['billTo_street1'], 0, 60).'", '
					.'city ="'. substr($_POST['billTo_city'], 0, 50).'", '
					.'state ="'. $_POST['billTo_state'].'", '
					.'zipcode ="'. substr($_POST['billTo_postalCode'], 0, 10).'", '
					.'card_type ="'. $_POST['card_cardType'].'", '
					.'expiration_month ="'. $_POST['card_expirationMonth'].'", '
					.'expiration_year ="'. $_POST['card_expirationYear'].'", '
					.'cv_reply ="'. $_POST['ccAuthReply_cvCode'].'", '
					.'ch_phone ="'. substr($_POST['billTo_phoneNumber'], 0, 15).'", '
					.'ch_email ="'. substr($_POST['billTo_email'], 0, 100).'", '
					.'charge_amount ='. $_POST['orderAmount'].', '
					.'order_number ="'. $_POST['orderNumber'].'", '
					.'reason_code ='. $_POST['reasonCode'].', '
					.'decision ="'. $_POST['decision'].'", '
					.'account_number ="'. substr($_POST['card_accountNumber'], -4, 4).'" ';
		$db->query($query);
		//pass back id to data so app my retieve data
		$_SESSION['paymentID'] = $db->insert_id;
	}
	//if resubmission attempt
	else{
		//update db with newest data
		$query = "update Charge_payment set "
					.'ch_first_name ="'. substr($_POST['billTo_firstName'], 0, 60).'", '
					.'ch_last_name ="'. substr($_POST['billTo_lastName'], 0, 60).'", '
					.'address ="'. substr($_POST['billTo_street1'], 0, 60).'", '
					.'city ="'. substr($_POST['billTo_city'], 0, 50).'", '
					.'state ="'. $_POST['billTo_state'].'", '
					.'zipcode ="'. substr($_POST['billTo_postalCode'], 0, 10).'", '
					.'card_type ="'. $_POST['card_cardType'].'", '
					.'expiration_month ="'. $_POST['card_expirationMonth'].'", '
					.'expiration_year ="'. $_POST['card_expirationYear'].'", '
					.'cv_reply ="'. $_POST['ccAuthReply_cvCode'].'", '
					.'ch_phone ="'. substr($_POST['billTo_phoneNumber'], 0, 15).'", '
					.'ch_email ="'. substr($_POST['billTo_email'], 0, 100).'", '
					.'charge_amount ='. $_POST['orderAmount'].', '
					.'order_number ="'. $_POST['orderNumber'].'", '
					.'reason_code ='. $_POST['reasonCode'].', '
					.'decision ="'. $_POST['decision'].'", '
					.'account_number ="'. substr($_POST['card_accountNumber'], -4, 4).'" '
					.'where charge_id='.$_POST['paymentID'];
		$db->query($query);
		//print mysql_error();
	}
	
	
	
	
	
//////////////////////////////////////////////////////////////////
//																                              //
//			REDIRECT TO CORRECT PAGE BASED ON DECISION			        //
//																                              //
//////////////////////////////////////////////////////////////////	
	
	if(empty($_SESSION['mp_cust']['iso'])){
		$_SESSION['mp_login']['type'] = $_POST['login_type'];
		$_SESSION['mp_login']['access'] = $_POST['login_access'];
		$_SESSION['mp_login']['id'] = $_POST['login_id'];
		$_SESSION['mp_login']['guest_id'] = $_POST['login_guest'];
		
		require_once('includes/mp_functions.inc');
		
		//convert id obtained from various login methods to the id used in bb
$_SESSION['mp_login']['mp_id'] = convertIdToMPId($_SESSION['mp_login']['id']);

//try to get basic MP customer info based on id
$_SESSION['mp_cust'] = getMPCustFromId($_SESSION['mp_login']['mp_id'], $_POST['last_name']);

/*
 * 
 *
 * 	$mp_cust['firstname'] 
 *	$mp_cust['lastname'] 
 *	$mp_cust['plan']['NAME']
 *	$mp_cust['plan']['ID'] 
 *	$mp_cust['id'] 
 *	$mp_cust['balance'] 
 * 
 * 
 * 
 * 
 */
$active_plan_ids = array(1, 2, 3, 10, 11, 12);



if(!$_SESSION['mp_cust'])
	$_SESSION['mp_cust']['state'] = 'no account';
	
elseif(!in_array($_SESSION['mp_cust']['plan']['BB_ID'], $active_plan_ids)){
	if(isMPAccountSignupPending($_SESSION['mp_login']['id']))
		$_SESSION['mp_cust']['state'] = 'pending';
	else
		$_SESSION['mp_cust']['state'] = 'no plan';
}

elseif($_SESSION['mp_cust']['is_active'] == 'F')
	$_SESSION['mp_cust']['state'] = 'deactive';
	
else{
	$_SESSION['mp_cust']['state'] = 'active';
	removeMPSignupPending($_SESSION['mp_login']['id']);
}
	
//var_dump(convertIdTo5050MPId($_SESSION['mp_login']['id']));	
	
//check to see if active employee to narrow down looking up for 5050s
if($_SESSION['webauth']['activeemployee']){
	//try to load 50/50 account 
	$_SESSION['5050mp_cust'] = getMPCustFromId(convertIdTo5050MPId($_SESSION['mp_login']['id']));
	//var_dump($_SESSION['5050mp_cust']);
	if($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account')
		$_SESSION['mp_cust']['state'] == '50/50'; 
}


if($_SESSION['mp_login']['access'] == 'deposit')
	$_SESSION['mp_cust']['state'] = 'deposit';
		
		
		
	}
	
	
	
	//was payment accepted
	if($_POST['decision'] == 'ACCEPT'){
	  
    
    //decide what kind of cc transaction is taking place (deposit, 50/50 deposit, signup, mobile deposit, mobile signup)
    
    //site signup
	if($_POST['form_page'] == '/mealplans/confirm.php'){
		header("Location:signupcomplete.php");
		exit();			
	}
  
    //mobile signup
    else if(strpos($_POST['form_page'], '/dining/mealplans/functions.php', 0) === 0){
      header("Location:http://m.union.arizona.edu/dining/mealplans/chooseplan.php?success=credit");
      exit(); 
    }
	
    
    //50/50 deposit
    else if($_POST['form_page'] == '/mealplans/deposit5050.php'){
      $tia = tia_transaction(DEPOSIT, $_POST['orderAmount'], $_SESSION['5050mp_cust']['iso'], $_SESSION['5050mp_cust']['plan']['TENDER_NUM']);
        
      
      
      
      $query = 'insert into deposit set'.
              '   amount      = "'. $_POST['orderAmount'].
              '", fee       = "'. '0'.
              '", total     = "'. $_POST['orderAmount'].
              '", new_signup    = "'. '0'.
              '", charge_id   = "'. $_SESSION['paymentID'].
              '", bb_account_id = "'.   ($_SESSION['5050mp_cust']['cust_num']/1).
              '", guest_id    =  '. ($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"')).
              ', first_name   = "'. $_SESSION['5050mp_cust']['firstname'].
              '", last_name   = "'. $_SESSION['5050mp_cust']['lastname'].
              '", payment_type  = "'. $_POST['card_cardType'].
              '", plan_id     = "'. $_SESSION['5050mp_cust']['plan']['ID'].
              '", bb_plan_id    = "'. $_SESSION['5050mp_cust']['plan']['BB_ID'].
              '", num_payments  = "'. $_SESSION['5050mp_cust']['plan']['NUM_PAYMENTS'].
              '", plan_name   = "'. $_SESSION['5050mp_cust']['plan']['NAME'].
              '", email     = "'. substr($_POST['billTo_email'], 0, 100).
              '", phone     = "'. substr($_POST['billTo_phoneNumber'], 0, 15).
              '", status      = "'. 'Complete'.
              '", tia_id      = "'. $tia['tia_log_id'].
              '"';
      $db->query($query);
      
      unset($_SESSION['paymentID']);
      print '<script>var temp = new Date(); window.parent.location = "viewtransactions5050.php?deposit="+temp.getTime();</script>';
    }

    //mobile deposit
    else if(strpos($_POST['form_page'], '/dining/mealplans/info.php', 0) === 0){
      $tia = tia_transaction(DEPOSIT, $_POST['orderAmount'], $_SESSION['mp_cust']['iso'], $_SESSION['mp_cust']['plan']['TENDER_NUM']);
        
      
      
      
      $query = 'insert into deposit set'.
              '   amount      = "'. $_POST['orderAmount'].
              '", fee       = "'. '0'.
              '", total     = "'. $_POST['orderAmount'].
              '", new_signup    = "'. '0'.
              '", charge_id   = "'. $_SESSION['paymentID'].
              '", bb_account_id = "'.   $_SESSION['mp_cust']['cust_num'].
              '", guest_id    =  '. ($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"')).
              ', first_name   = "'. $_SESSION['mp_cust']['firstname'].
              '", last_name   = "'. $_SESSION['mp_cust']['lastname'].
              '", payment_type  = "'. $_POST['card_cardType'].
              '", plan_id     = "'. $_SESSION['mp_cust']['plan']['ID'].
              '", bb_plan_id    = "'. $_SESSION['mp_cust']['plan']['BB_ID'].
              '", num_payments  = "'. $_SESSION['mp_cust']['plan']['NUM_PAYMENTS'].
              '", plan_name   = "'. $_SESSION['mp_cust']['plan']['NAME'].
              '", email     = "'. substr($_POST['billTo_email'], 0, 100).
              '", phone     = "'. substr($_POST['billTo_phoneNumber'], 0, 15).
              '", status      = "'. 'Complete'.
              '", tia_id      = "'. $tia['tia_log_id'].
              '", mobile=1';
      //db_query($query);
      $db->query($query);
    
  
    
      unset($_SESSION['paymentID']);
      header("Location:http://m.union.arizona.edu/dining/mealplans/info.php?status=success");
    }

    // mobile 50/50 deposit
    else if(strpos($_POST['form_page'], '/dining/mealplans/deposit5050.php', 0) === 0){
      $tia = tia_transaction(DEPOSIT, $_POST['orderAmount'], $_SESSION['5050mp_cust']['iso'], $_SESSION['5050mp_cust']['plan']['TENDER_NUM']);
        
      $query = 'insert into deposit set'.
              '   amount      = "'. $_POST['orderAmount'].
              '", fee       = "'. '0'.
              '", total     = "'. $_POST['orderAmount'].
              '", new_signup    = "'. '0'.
              '", charge_id   = "'. $_SESSION['paymentID'].
              '", bb_account_id = "'.   ($_SESSION['5050mp_cust']['cust_num']/1).
              '", guest_id    =  '. ($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"')).
              ', first_name   = "'. $_SESSION['5050mp_cust']['firstname'].
              '", last_name   = "'. $_SESSION['5050mp_cust']['lastname'].
              '", payment_type  = "'. $_POST['card_cardType'].
              '", plan_id     = "'. $_SESSION['5050mp_cust']['plan']['ID'].
              '", bb_plan_id    = "'. $_SESSION['5050mp_cust']['plan']['BB_ID'].
              '", num_payments  = "'. $_SESSION['5050mp_cust']['plan']['NUM_PAYMENTS'].
              '", plan_name   = "'. $_SESSION['5050mp_cust']['plan']['NAME'].
              '", email     = "'. substr($_POST['billTo_email'], 0, 100).
              '", phone     = "'. substr($_POST['billTo_phoneNumber'], 0, 15).
              '", status      = "'. 'Complete'.
              '", tia_id      = "'. $tia['tia_log_id'].
              '", mobile=1';
      //db_query($query);
      $db->query($query);
      
      unset($_SESSION['paymentID']);
      header("Location:http://m.union.arizona.edu/dining/mealplans/info.php?status=success");
    }
    
    //mobile guest deposit
    else if(strpos($_POST['form_page'], '/dining/mealplans/deposit.php', 0) === 0){
      $tia = tia_transaction(DEPOSIT, $_POST['orderAmount'], $_SESSION['mp_cust']['iso'], $_SESSION['mp_cust']['plan']['TENDER_NUM']);
        
      
      
      
      $query = 'insert into deposit set'.
              '   amount      = "'. $_POST['orderAmount'].
              '", fee       = "'. '0'.
              '", total     = "'. $_POST['orderAmount'].
              '", new_signup    = "'. '0'.
              '", charge_id   = "'. $_SESSION['paymentID'].
              '", bb_account_id = "'.   $_SESSION['mp_cust']['cust_num'].
              '", guest_id    =  '. ($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"')).
              ', first_name   = "'. $_SESSION['mp_cust']['firstname'].
              '", last_name   = "'. $_SESSION['mp_cust']['lastname'].
              '", payment_type  = "'. $_POST['card_cardType'].
              '", plan_id     = "'. $_SESSION['mp_cust']['plan']['ID'].
              '", bb_plan_id    = "'. $_SESSION['mp_cust']['plan']['BB_ID'].
              '", num_payments  = "'. $_SESSION['mp_cust']['plan']['NUM_PAYMENTS'].
              '", plan_name   = "'. $_SESSION['mp_cust']['plan']['NAME'].
              '", email     = "'. substr($_POST['billTo_email'], 0, 100).
              '", phone     = "'. substr($_POST['billTo_phoneNumber'], 0, 15).
              '", status      = "'. 'Complete'.
              '", tia_id      = "'. $tia['tia_log_id'].
              '", mobile=1';
      //db_query($query);
      $db->query($query);
    
  
    
    unset($_SESSION['paymentID']);
      header("Location:http://m.union.arizona.edu/dining/mealplans/deposit.php?success");
    }

    //site deposit
    else{
		
    
  		$tia = tia_transaction(DEPOSIT, $_POST['orderAmount'], $_SESSION['mp_cust']['iso'], $_SESSION['mp_cust']['plan']['TENDER_NUM']);
  			
  		
  		
  		
  		$query = 'insert into deposit set'.
  						'   amount 			= "'.	$_POST['orderAmount'].
  						'", fee				= "'.	'0'.
  						'", total			= "'.	$_POST['orderAmount'].
  						'", new_signup		= "'.	'0'.
  						'", charge_id		= "'.	$_SESSION['paymentID'].
  						'", bb_account_id	= "'. 	$_SESSION['mp_cust']['cust_num'].
  						'", guest_id		=  '.	($_SESSION['mp_login']['guest_id'] == 'NULL'?('NULL'):('"'.$_SESSION['mp_login']['guest_id'].'"')).
  						', first_name		= "'.	$_SESSION['mp_cust']['firstname'].
  						'", last_name		= "'.	$_SESSION['mp_cust']['lastname'].
  						'", payment_type	= "'.	$_POST['card_cardType'].
  						'", plan_id			= "'.	$_SESSION['mp_cust']['plan']['ID'].
  						'", bb_plan_id		= "'.	$_SESSION['mp_cust']['plan']['BB_ID'].
  						'", num_payments	= "'.	$_SESSION['mp_cust']['plan']['NUM_PAYMENTS'].
  						'", plan_name		= "'.	$_SESSION['mp_cust']['plan']['NAME'].
  						'", email			= "'.	substr($_POST['billTo_email'], 0, 100).
  						'", phone			= "'.	substr($_POST['billTo_phoneNumber'], 0, 15).
  						'", status			= "'.	'Complete'.
  						'", tia_id			= "'.	$tia['tia_log_id'].
  						'"';
  		//db_query($query);
		$db->query($query);
  
    
    unset($_SESSION['paymentID']);
    print '<script>var temp = new Date(); window.parent.location = "viewtransactions.php?deposit="+temp.getTime();</script>';
    }
		
		require_once('phplib/mimemail/htmlMimeMail5.php');
	
	$mail = new htmlMimeMail5();

    $mail->setFrom('Arizona Student Unions<no-reply@email.arizona.edu>');
    
    $mail->setSubject('Meal Plan Deposit Confirmation');
    
    $mail->setHTML('<style type="text/css">body, html{margin:0px; padding:0px; background-image: url(\'http://studentaffairs.arizona.edu/mailcall/user_images/mp_bg(1).jpg\'); background-repeat:repeat-x;}</style>
<table width="100%" height="auto" cellspacing="0" cellpadding="0" style="border: medium none ; margin: 0px; padding: 0px; width: 100%; height: 100%; ">
    <tbody>
        <tr>
            <td valign="top" align="center">
            <table width="645" cellspacing="0" cellpadding="0" style="height: 100%;">
                <tbody>
                    <tr>
                        <td valign="top" style="height: 100%; width: 100%;">
                        <table height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="height: 100%;">
                            <tbody>
                                <tr>
                                    <td>
									<img width="646" height="196" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/DepositConfirmationTop.jpg" />
									<!--<img width="645" height="197" alt="Meal PLans" src="http://studentaffairs.arizona.edu/mailcall/user_images/MealPlans_Confirmation_Deposit_02(1).jpg" />-->
									</td>
                                </tr>
                                <tr style="height: 100%;">
                                    <td clign="center" valign="top" height="100%" style="height: 100%;">
                                    <table cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td width="30">&nbsp;</td>
                                                <td>
                                                <h1 style="font-size:18px; color:#fbb614;"><b>Your payment has been received.</b></h1>
                                                <p><b>Dear '.$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname'].',</b></p>
                                                <p>A deposit of $'.$_POST['orderAmount'].' has been made to your meal plan account via credit card charge(xxxx xxxx xxxx '.substr($_POST['card_accountNumber'], -4, 4).').</p>
                                                
                                                <p>For questions or comments, call 520.621.7043 or 800.374.7379. You can also email us at mealplan@email.arizona.edu.</p>
                                                <p>
												<img width="200" height="27" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/StudentUnions_200.jpg" />
												<!--<img width="65" height="30" alt="" src="http://studentaffairs.arizona.edu/mailcall/user_images/union_logo.jpg" />-->
												</p>
                                                </td>
                                                <td width="30">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </tbody>
</table>');
    
	$result  = $mail->send(array($_SESSION['payment_email']));
		
		
		
			
	}
	else{
		//on failure to process
		
		
		//clear any previous errors
		unset($_SESSION['cterror']);
		
		//save paymentID to app session so it can load data
		//$_SESSION['paymentID'] = $_POST['paymentID'];
		
		//set errors for any missing fields
		$i=0;
		while(isset($_POST['MissingField'.$i])){
			$_SESSION['cterror'][$_POST['MissingField'.$i++]] = 1;	
		}
		if(strpos($_POST['form_page'], '/dining/mealplans/info.php', 0) === 0){
			header("Location:https://m.union.arizona.edu/dining/mealplans/info.php?status=fail&orderAmount=".$_POST['orderAmount']);
			exit();
		}
		else if(strpos($_POST['form_page'], '/dining/mealplans/functions.php', 0) === 0){
			header("Location:https://m.union.arizona.edu/dining/mealplans/chooseplan.php?status=fail&orderAmount=".$_POST['orderAmount']);
			exit();
		}
		else if(strpos($_POST['form_page'], '/dining/mealplans/deposit.php', 0) === 0){
			header("Location:https://m.union.arizona.edu/dining/mealplans/deposit.php?status=fail&orderAmount=".$_POST['orderAmount']);
			exit();
		}
		else if(strpos($_POST['form_page'], '/dining/mealplans/deposit5050.php', 0) === 0){
			header("Location:https://m.union.arizona.edu/dining/mealplans/deposit.php?status=fail5050");
			exit();
		}
    	
		//return to form so user may correct and resubmit
		header("Location:https://".$_POST['host'].$_POST['form_page']);	
	}
	