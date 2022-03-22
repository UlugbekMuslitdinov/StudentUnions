<?php
session_start();

//include('/Library/WebServer/commontools/cardtaker/commonfunctions.inc');


//////////////////////////////////////////////////////////////////////////////
//							PAYMENT CLASS									//
//																			//
//	holds information relavent to a payment. includes method to load from	//
//	paymentid																//
//																			//
//////////////////////////////////////////////////////////////////////////////
class payment{
	
	//decalre all fields relavent to a payment. matches payment table in cardtaked db
	public $id =0;
	public $billTo_firstName = '';
	public $billTo_lastName = '';
	public $billTo_street1 = '';
	public $billTo_city = '';
	public $billTo_state = '';
	public $billTo_postalCode = '';
	public $card_cardType = '';
	public $card_expirationMonth = '';
	public $card_expirationYear = '';
	public $ccAuthReply_cvCoder = '';
	public $billTo_phoneNumber = '';
	public $billTo_email = '';
	public $orderAmount = NULL;
	public $orderNumber = '';
	public $card_accountNumber = '';
	public $decision = NULL;
	public $reasonCode = 0;
	private $DBlink;
	
	
	
	//initilize payment with a unique orderNumber based on page and timestamp
	function __construct(){
		$this->orderNumber = 'MealPlans-'.(time()-12005000000);
	}
	
	//method to easily load a payment from db into object based on id
	public function getPaymentFromID($paymentID){
		/*
		require_once('/Library/WebServer/commontools/mysql_link.inc');
		
		//get currently selected db before changing
		$result = mysql_query('select DATABASE()');
		$current_db = mysql_fetch_array($result);
		
		mysql_select_db('cardtaker');
		*/
		require_once ('includes/mysqli.inc');
		$db = new db_mysqli('mealplans');

		$result = $db->query('select * from Charge_payment where charge_id='.$paymentID);
		if(mysqli_num_rows($result)){
			$temp = mysqli_fetch_assoc($result);
			
			$this->id = $temp['charge_id'];
			$this->billTo_firstName = $temp['ch_first_name'];
			$this->billTo_lastName = $temp['ch_last_name'];
			$this->billTo_street1 = $temp['address'];
			$this->billTo_city = $temp['city'];
			$this->billTo_state = $temp['state'];
			$this->billTo_postalCode = $temp['zipcode'];
			$this->card_cardType = $temp['card_type'];
			$this->card_expirationMonth = $temp['expiration_month'];
			$this->card_expirationYear = $temp['expiration_year'];
			$this->ccAuthReply_cvCode = $temp['cv_reply'];
			$this->billTo_phoneNumber = $temp['ch_phone'];
			$this->billTo_email = $temp['ch_email'];
			$this->orderAmount = $temp['charge_amount'];
			$this->orerNumber = $temp['order_number'];
			$this->card_accountNumber = $temp['account_number'];
			$this->reasonCode = $temp['reason_code'];
			$this->decision = $temp['decision'];
			
			
		}
		
	}
	
}

//////////////////////////////////////////////////////////////////////////////
//						PAYMENT_PROCESS CLASS								//
//																			//
//	performs the steps necesary to complete a payment requires the set_total//
//	method to be called then display_form method otherwise handles the rest	//
//	also get_stage method can be used to tell where it's at in the process.	//
//////////////////////////////////////////////////////////////////////////////
class payment_process{
	//declare variables for holding payment info and errors
	public $payment;
	private $error_message;
	private $require_contact = false;
	private $show_contact = true;
	private $allow_discover = false;
	
	
	//initialize object by creating a new payment or grabbing the current payment info from db
	function __construct($initial_values){

			//add functions provided by cybersource for creating keys and signatures
			require_once('includes/cybersource_tools.inc');
			
			
			//check to see if discover is to be allowed		
			if($initial_values['discover']==1)
				$this->allow_discover = true;

			
			$this->payment = new payment();
	
			//assign initial values possibly passed in
			$this->payment->billTo_firstName = $initial_values['firstName'];
			$this->payment->billTo_lastName = $initial_values['lastName'];
			$this->payment->billTo_street1 = $initial_values['address'];
			$this->payment->billTo_city = $initial_values['city'];
			$this->payment->billTo_state = $initial_values['state'];
			$this->payment->billTo_postalCode = $initial_values['postalCode'];
			$this->payment->card_cardType = $initial_values['cardType'];
			$this->payment->card_expirationMonth = $initial_values['expirationMonth'];
			$this->payment->card_expirationYear = $initial_values['expirationYear'];
			$this->payment->billTo_phoneNumber = $initial_values['phoneNumber'];
			$this->payment->billTo_email = $initial_values['email'];
			$this->payment->orderAmount = $initial_values['orderAmount'];
		
		//checks if paymentID is set meaning has already been summited but failed. pull in all data that was submitted originaly
		if(isset($_SESSION['paymentID'])) $this->payment->getPaymentFromID($_SESSION['paymentID']);
		
	}

	function set_total($tot){
		$this->payment->orderAmount = $tot;
	}
		
	function show_contact($value){
		$this->show_contact = $value;	
	}
	
	function require_contact($value){
		$this->require_contact = $value;	
	}
	
	//call where form shall be placed. will handle errors and displays nothing if called after payment has been approved
	function display_form(){
		if($this->payment->orderAmount == NULL){
			print 'Error: orderAmount not set. Please set orderAmount via $inital_values["orderAmount"] = $amount when intializing object';	
		}
		//var_dump($this->payment->decision);
		//print $this->payment->reasonCode;
		if($this->payment->decision == 'ACCEPT'){
			
			//print 'done';
			//session_destroy();
			return true;
		}
		elseif($this->payment->decision == 'REJECT'){
			switch($this->payment->reasonCode){
				case 102:
					$this->error_message = 'Please fill out the missing fields';
				break;
				case 202:
					$this->error_message = 'The card has expired.';
				break;
				case 203:
					$this->error_message = 'The card was declined. No reason was given';
				break;
				case 204:
					$this->error_message = 'The card was declined due to insufficient funds.';
				break;
				case 205:
					$this->error_message = 'The card was declined because it has been reported stolen or lost.';
				break;
				case 207:
					$this->error_message = 'The issuing bank was unavailable. Please try again in a few minutes';
				break;
				case 208:
					$this->error_message = 'The card was declined because it is inactive or not authorized for card-not-present transactions.';
				break;
				case 210:
					$this->error_message = 'The card was declined because the credit limit for the card has been reached.';
				break;
				case 211:
					$this->error_message = 'The card was declined because the card verification number is invalid.';
				break;
				case 220:
					$this->error_message = 'The processor declined the card based on a general issue with the customer�s account.';
				break;
				case 221:
					$this->error_message = 'The card was declined because the customer matched an entry on the processor�s negative file.';
				break;
				case 222:
					$this->error_message = 'The card was declined because the customer�s bank account is frozen.';
				break;
				case 231:
					$this->error_message = 'The card was declined because the card number is invalid.';
				break;
				case 232:
					$this->error_message = 'The card type is not accepted by the payment processor.';
				break;
				case 233:
					$this->error_message = 'The processor declined the request based on an issue with the request itself.';
				break;
				case 234:
					$this->error_message = 'There is a problem with your CyberSource merchant configuration.';
				break;
				case 236:
					$this->error_message = 'A processor failure occurred. Please try again in a few minutes';
				break;
				case 240:
					$this->error_message = 'Error: The card type is invalid or does not correlate with the credit card number.';
				break;
				
				case 475:
					$this->error_message = 'The customer cannot be authenticated.';
				break;
				case 476:
					$this->error_message = 'The customer is enrolled in payer authentication.';
				break;
			}
		}
		else if($this->payment->decision == 'REVIEW'){
			switch($this->payment->reasonCode){
				case 200:
					$this->error_message = 'The authorization request was approved by the issuing bank but declined by CyberSource because it did not pass the Address Verification Service (AVS) check.';
					//send email
				break;
				case 201:
					$this->error_message = 'The issuing bank has questions about the request.';
				break;
				case 230:
					$this->error_message = 'The card was approved by the issuing bank but declined by CyberSource because it did not pass the card verification number check.';
					//send email
				break;
				case 520:
					$this->error_message = 'The authorization request was approved by the issuing bank but declined by CyberSource based on your Smart Authorization settings.';
				break;
			}
		}
		else if($this->payment->decision == 'ERROR'){
			switch($this->payment->reasonCode){
				case 150:
					$this->error_message = 'Error: General system failure. Please try agin in a few minutes';
				break;
				case 151:
					$this->error_message = 'Error: The request was received, but a server time-out occurred. Please try again in a few minutes';
					//send email
				break;
				case 152:
					$this->error_message = 'Error: The request was received, but a service did not finish running in time. Please try again in a few minutes';
					//send email
				break;
				case 250:
					$this->error_message = 'The request was received, but a time-out occurred with the payment processor.';
					//send email
				break;
			}
		}
    if($_SESSION['debug'] == 1 || $_SERVER['SERVER-ENV'] == 'staging'){
      $card_env = 'test';
    }
    else{
      $card_env = '';
    }
		?>
		<form name="ct_form" action="https://orderpage<?=$card_env?>.ic3.com/hop/ProcessOrder.do" onsubmit="return validateInput(this);" method="post">
		
			<h2>Payment Information:</h2>
			<span id="ct_error" style="color:red;"><?php print $this->error_message; ?></span>
			<table class="ct_table">
				<tr id="main_form">
    				<td valign="top">
						<table class="ct_table1"> 
							<tr>
								<td>
									First Name:
								</td>       
								<td>
									<input type="text" maxlength="60"   name="billTo_firstName"	value="<?php print $this->payment->billTo_firstName;?>" class="<?php if(isset($_SESSION['cterror']['billTo_firstName'])) print 'tberror';?>">
								</td>
							</tr> 
							<tr>
								<td>
									Last Name:
								</td>        
								<td>
									<input type="text" maxlength="60"   name="billTo_lastName"	value="<?php print $this->payment->billTo_lastName;?>" class="<?php if(isset($_SESSION['cterror']['billTo_lastName'])) print 'tberror';?>">
								</td>
							</tr> 
							<tr>
								<td>
									Address:
								</td>          
								<td>
									<input type="text" maxlength="60"   name="billTo_street1"	value="<?php print $this->payment->billTo_street1;?>" class="<?php if(isset($_SESSION['cterror']['billTo_street1'])) print 'tberror';?>">
								</td>
							</tr> 
							<tr>
								<td>
									City:
								</td>             
								<td>
									<input type="text" maxlength="50"   name="billTo_city" 	value="<?php print $this->payment->billTo_city;?>" class="<?php if(isset($_SESSION['cterror']['billTo_city'])) print 'tberror';?>">
								</td>
							</tr> 
							<tr>
								<td>
									State:
								</td>      
								<td>
									<select name="billTo_state"> 
										<option value="<?php print $this->payment->billTo_state;?>" selected="selected"><?php print $this->payment->billTo_state;?></option> 
										<option value="AL">Alabama</option> 
										<option value="AK">Alaska</option> 
										<option value="AZ">Arizona</option> 
										<option value="AR">Arkansas</option> 
										<option value="CA">California</option> 
										<option value="CO">Colorado</option> 
										<option value="CT">Connecticut</option> 
										<option value="DE">Delaware</option> 
										<option value="DC">District Of Columbia</option> 
										<option value="FL">Florida</option> 
										<option value="GA">Georgia</option> 
										<option value="HI">Hawaii</option> 
										<option value="ID">Idaho</option> 
										<option value="IL">Illinois</option> 
										<option value="IN">Indiana</option> 
										<option value="IA">Iowa</option> 
										<option value="KS">Kansas</option> 
										<option value="KY">Kentucky</option> 
										<option value="LA">Louisiana</option> 
										<option value="ME">Maine</option> 
										<option value="MD">Maryland</option> 
										<option value="MA">Massachusetts</option> 
										<option value="MI">Michigan</option> 
										<option value="MN">Minnesota</option> 
										<option value="MS">Mississippi</option> 
										<option value="MO">Missouri</option> 
										<option value="MT">Montana</option> 
										<option value="NE">Nebraska</option> 
										<option value="NV">Nevada</option> 
										<option value="NH">New Hampshire</option> 
										<option value="NJ">New Jersey</option> 
										<option value="NM">New Mexico</option> 
										<option value="NY">New York</option> 
										<option value="NC">North Carolina</option> 
										<option value="ND">North Dakota</option> 
										<option value="OH">Ohio</option> 
										<option value="OK">Oklahoma</option> 
										<option value="OR">Oregon</option> 
										<option value="PA">Pennsylvania</option> 
										<option value="RI">Rhode Island</option> 
										<option value="SC">South Carolina</option> 
										<option value="SD">South Dakota</option> 
										<option value="TN">Tennessee</option> 
										<option value="TX">Texas</option> 
										<option value="UT">Utah</option> 
										<option value="VT">Vermont</option> 
										<option value="VA">Virginia</option> 
										<option value="WA">Washington</option> 
										<option value="WV">West Virginia</option> 
										<option value="WI">Wisconsin</option> 
										<option value="WY">Wyoming</option>
									</select>
									<span id="ct_state_error" style="color:red;"><?php if(isset($_SESSION['cterror']['billTo_state'])) print '*';?></span>
								</td>
							</tr> 
							<tr>
								<td>
									Postal Code:
								</td>   
								<td>
									<input type="text" maxlength="10" name="billTo_postalCode" value="<?php print $this->payment->billTo_postalCode;?>" class="<?php if(isset($_SESSION['cterror']['billTo_postalCode'])) print 'tberror';?>">
								</td>
							</tr> 
							<tr>
								<td>
								</td>
								<td>
									<input type="hidden" name="billTo_country" value="US">
								</td>
							</tr> 
						</table>
					</td>    
					<td valign="top" style="padding-left:30px;">
						<table class="ct_table2">
							<tr>
								<td>
									Card Type:
								</td>
								<td>
									<select name="card_cardType">
										<option value=""></option>
										<option value="001" <? if($this->payment->card_cardType == "001") { print "selected=\"selected\"";} ?> >Visa</option>
										<option value="002" <? if($this->payment->card_cardType == "002") { print "selected=\"selected\"";} ?> >MasterCard</option>
										<option value="003" <? if($this->payment->card_cardType == "003") { print "selected=\"selected\"";} ?> >American Express</option>
										<?php if($this->allow_discover){ ?>
											<option value="004" <? if($this->payment->card_cardType == "004") { print "selected=\"selected\"";} ?> >Discover</option>
										<?php } ?>
									</select>
									<span id="ct_type_error" style="color:red;"><?php if(isset($_SESSION['cterror']['card_cardType'])) print '*';?></span>
								</td>
							</tr>    
							<tr>
								<td>
									Card Number:
								</td>       
								<td>
									<input type="text"   name="card_accountNumber" maxlength="16" class="<?php if(isset($_SESSION['cterror']['card_accountNumber'])) print 'tberror';?>">
								</td>
							</tr>
							<tr>
								<td>
									Expiration Date:
								</td>
								<td>
									<select name="card_expirationMonth">
										<option value="01" <?=$this->payment->card_expirationMonth=='01'?'selected':''?>>01</option>
										<option value="02" <?=$this->payment->card_expirationMonth=='02'?'selected':''?>>02</option>
										<option value="03" <?=$this->payment->card_expirationMonth=='03'?'selected':''?>>03</option>
										<option value="04" <?=$this->payment->card_expirationMonth=='04'?'selected':''?>>04</option>
										<option value="05" <?=$this->payment->card_expirationMonth=='05'?'selected':''?>>05</option>
										<option value="06" <?=$this->payment->card_expirationMonth=='06'?'selected':''?>>06</option>
										<option value="07" <?=$this->payment->card_expirationMonth=='07'?'selected':''?>>07</option>
										<option value="08" <?=$this->payment->card_expirationMonth=='08'?'selected':''?>>08</option>
										<option value="09" <?=$this->payment->card_expirationMonth=='09'?'selected':''?>>09</option>
										<option value="10" <?=$this->payment->card_expirationMonth=='10'?'selected':''?>>10</option>
										<option value="11" <?=$this->payment->card_expirationMonth=='11'?'selected':''?>>11</option>
										<option value="12" <?=$this->payment->card_expirationMonth=='12'?'selected':''?>>12</option>
									</select>
									/
									<select name="card_expirationYear">
										<?php
											$year = date("Y");
											for($x=0; $x<12; $x++){
												?>
												<option value="<?=$year?>" <?=$this->payment->card_expirationYear==$year?'selected':'';?>><?=$year++?></option>
												<?php
											}											
										?>
									</select>
								</td>
							</tr>
							<!--							
							<tr>
								<td>
									Expiration Month:
								</td>  
								<td>
									<input type="text" maxlength="2"   name="card_expirationMonth"	value="<?php print $this->payment->card_expirationMonth;?>" class="<?php if(isset($_SESSION['cterror']['card_expirationMonth'])) print 'tberror';?>" > (mm)
								</td>
							</tr> 
							<tr>
								<td>
									Expiration Year:
								</td>   
								<td>
									<input type="text" maxlength="4"   name="card_expirationYear" value="<?php print $this->payment->card_expirationYear;?>" class="<?php if(isset($_SESSION['cterror']['card_expirationYear'])) print 'tberror';?>"> (yyyy)
								</td>
							</tr>
							-->
							<tr>
								<td>
									CVN:
								</td>   
								<td>
									<input type="text" maxlength="4"   name="card_cvNumber" value="<?php print $this->payment->card_cvNumber;?>" class="<?php if(isset($_SESSION['cterror']['card_cvNumber'])) print 'tberror';?>">
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<?php if($this->show_contact){ ?>
							<tr  id="billTo_email_row">
								<td>
									Email Address:
								</td>    
								<td>
									<input type="text" maxlength="100"   name="billTo_email" 	value="<?php print $this->payment->billTo_email;?>" class="<?php if($this->require_contact) print 'require ';?><?php if(isset($_SESSION['cterror']['billTo_email'])) print 'tberror';?>">
								</td>
							</tr>
							<tr id="billTo_phoneNumber_row">
								<td>
									Phone Number:
								</td>     
								<td>
									<input type="text" maxlength="15"   name="billTo_phoneNumber"  value="<?php print $this->payment->billTo_phoneNumber;?>" class="<?php if($this->require_contact) print 'require ';?><?php if(isset($_SESSION['cterror']['billTo_phoneNumber'])) print 'tberror';?>"> (xxx-xxx-xxxx)
								</td>
							</tr>
							<?php } ?>
						</table> 
					</td>
				</tr>
				<tr id="total_row">
					<td colspan="2">
						<h3 style="padding-top:15px; padding-bottom:10px;">Amount to be charged: &nbsp;
						<? 
							
								//print "$". $total . 	".00"
								if(strstr($this->payment->orderAmount, "." )){
									print "$".$this->payment->orderAmount; 
								}
								else
								print "$". $this->payment->orderAmount . 	".00";
								
							
						?>
						</h3>
					</td>
				</tr>
				<tr id="submit_row">
					<td colspan="2" height="50px;">
						<input type="submit" name="submit1"  value="Submit Payment">
					</td>
				</tr>
			</table>
			<input type="hidden" name="session_id" value="<?php print session_id(); ?>" >
			<!-- <input type="hidden" name="orderPage_transactionType" value="sale"> -->
			<input type="hidden" name="orderNumber" value="<?php print $this->payment->orderNumber; ?>">
			<input type="hidden" name="orderPage_ignoreCVN" value="FALSE" />
			<?php 
				if(date("d") < 7){
					InsertSignature($this->payment->orderAmount, "usd", "sale");
				}
				else{
					InsertSignature($this->payment->orderAmount, "usd", "authorization");
				}
			?>
			<input type="hidden" name="paymentID" value="<?php print $this->payment->id; ?>">
			<input type="hidden" name="form_page" value="<?php print $_SERVER['REQUEST_URI'];?>">
			<input type="hidden" name="host" value="<?php print $_SERVER['SERVER_NAME']; ?>">
			<input type="hidden" name="login_type" value="<?=$_SESSION['mp_login']['type']?>" />
			<input type="hidden" name="login_access" value="<?=$_SESSION['mp_login']['access']?>" />
			<input type="hidden" name="login_id" value="<?=$_SESSION['mp_login']['id']?>" />
			<input type="hidden" name="login_guest" value="<?=$_SESSION['mp_login']['guest_id']?>" />
			 
		</form>
<?php
	}
	
	//can be used to control flow based on stage in process
	function get_stage(){
		switch($this->payment->decision){
			case 'ACCEPT':
				return 'approved';
			case NULL:
				return 'unsubmitted';
			default:
				return 'error';				
		}
	}
	
	function get_paymentID(){
		return $this->payment->id;	
	}
	function get_firstName(){
		return $this->payment->billTo_firstName;	
	}
	function get_lastName(){
		return $this->payment->billTo_lastName;	
	}
	function get_address(){
		return $this->payment->billTo_street1;	
	}
	function get_city(){
		return $this->payment->billTo_city;	
	}
	function get_state(){
		return $this->payment->billTo_state;	
	}
	function get_postalCode(){
		return $this->payment->billTo_postalCode;	
	}
	function get_cardtype(){
		return $this->payment->card_cardType;	
	}
	function get_expirationMonth(){
		return $this->payment->card_expirationMonth;	
	}
	function get_expirationYear(){
		return $this->payment->card_expirationYear;	
	}
	function get_phoneNumber(){
		return $this->payment->billTo_phoneNumber;	
	}
	function get_email(){
		return $this->payment->billTo_email;	
	}
	function get_lastFour(){
		return $this->payment->card_accountNumber;	
	}
	function get_orderAmount(){
		return $this->payment->orderAmount;
	}	

	
	
}

?>
