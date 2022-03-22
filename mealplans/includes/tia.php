<?php
// ini_set('display_errors', 1);
require_once ('includes/mysqli.inc');
require_once('tia_functions.php');


define("DEBIT", '1');
define("BALANCE_INQUIRY", '2');
define("COUNT", '3');
define("ACTIVITY", '4');
define("REFUND", '5');
define("DEPOSIT", '6');
define("AUTHORIZATION_LIMIT", '7');
define("CASH_EQUIVALENCY", '8');

function tia_transaction($transaction_type, $amount, $iso, $tender_number = '910', $terminal_number = 3, $online='T', $manual = 'F'){
global $cipher;

$lock = sem_get('1'); 	//get semaphore lock 	
sem_acquire($lock);		//block until lock is acquired since transactions must be done one at a time in order

$db = new db_mysqli('mealplans');

//select the last transaction to acquire it's sequence number to determine what the next sequence number should be
$result = $db->query('select sequence_number, online_flag from tia_log order by ID desc limit 1');
$last_transaction = mysqli_fetch_assoc($result);
$sequence_number = $last_transaction['sequence_number']+1;

//sequence number must range between 2 and 999999. If over 999999 rollover to 2 
if($sequence_number == 1000000)
	$sequence_number=2;

//as long as online is not manually being set to false use the online flag from the last transaction	
if($online == 'T')
	$online = $last_transaction['online_flag'];




//correctly format the amount based on transaction type
if($transaction_type == DEPOSIT || $transaction_type == DEBIT || $transaction_type == REFUND || $transaction_type == COUNT || $transaction_type == CASH_EQUIVALENCY)
	$amount = $amount*100;
else
	$amount = 0;


/////deposit
$message['unencrypted']['message_length'] = '0000';  	//between 44 - 150 includes message length through CRC
$message['unencrypted']['encryption'] = '1';			//1 for AES and CRC, 0 for non-encr and LRC
$message['unencrypted']['vendor_number'] = '3151';		//unigue identifer assigned by bb, really is 3151 but testing on offsite account is 0163
$message['unencrypted']['terminal_number'] = '1046';	//configured in bb
$message['unencrypted']['encrypted_length'] = '0000';	//length of encrypted parts below including field seporators

$message['encrypted']['version_number'] = '2';											//version number of bb - 2
$message['encrypted']['transaction_type'] = $transaction_type;										//transaction type - see above info
$message['encrypted']['sequence_number'] = str_pad($sequence_number, 6, '0', STR_PAD_LEFT);			//unique transaction id between 1 and 999999
$message['encrypted']['tender_number'] = $tender_number;											//determines transaction type
$message['encrypted']['date_time'] = date("YmdHis");	//date time in YYYYMMDDHHMMSS format
$message['encrypted']['online_flag'] = $online;												//is transaction occuring with bb online
$message['encrypted']['transaction_amount'] = $amount;									//amount with 2 right most digits as cents
$message['encrypted']['currency'] = 'USD';												//must be USD
$message['encrypted']['was_manual'] = $manual;												//was number entered manual 
$message['encrypted']['track2_data'] = $iso;											//card number
$message['encrypted']['pin'] = '0';														//pin
$message['encrypted']['cash_equiv_amount'] = '0';										//0 for us always

$message['crc'] = '0';	// cyclical redundancy check




$to_be_encrypted = ''; //start with empty string
//loop through all the parts needing encryption and seperate with seporator string '~'
foreach($message['encrypted'] as $piece)
	$to_be_encrypted .= $piece.'~';
	

$cipherText = encrypt($to_be_encrypted);

//calculate the length of the original string to be encrpted and pad the value to be 4 charaters long
$message['unencrypted']['encrypted_length'] = str_pad(strlen($to_be_encrypted), 4, '0', STR_PAD_LEFT);

//now calculate the entire message length which is just the length of the encrypted text plus 24 for the unencrpted header part and the crc redundancy check
$message['unencrypted']['message_length'] = str_pad(strlen($cipherText) + 24, 4, '0', STR_PAD_LEFT);

//start with empty header string
$header = '';
//loop through all header peices joining them with the seperator string '~'
foreach($message['unencrypted'] as $piece)
	$header .= $piece.'~';

//join header and encrypted parts
$encrypted_request = $header.$cipherText;

//perform crc calculation
$message['crc'] = perform_crc($encrypted_request);


//add crc to rest of message which should now be ready to be sent
$encrypted_request .= $message['crc'];

//add theses pecies to the transaction object which holds al pertinent values
$transaction_object["requet"]["message_pieces"] = $message; 
$transaction_object["requet"]["unencrypted_message"] = $header.$to_be_encrypted; 
$transaction_object["requet"]["encrypted_message"] = $header.$cipherText; 

//if online flag is false save transaction to db to  be sent when systme comes back online
// if($online == 'F'){
// 	$db->query('insert into tia_log set sequence_number='.$sequence_number.',  online_flag="F", request="'.addslashes($encrypted_request).'", response="'.$response.'"'); //save to db
// 	$transaction_object['tia_log_id'] = $db->insert_id;
// 	mcrypt_module_close($cipher);	//release cipher resource
// 	sem_release($lock); //release lock
// 	return $transaction_object; //stop execution
// }




$response =''; //will hold response from BB
$time = time(); //get current time for timeout comparison

$response = send_request($encrypted_request); //make intial attempt to send transaction to BB

//if no response continue to send request every 50 milliseconds afterwhich timeout after 7 seconds
while($response == '' && time()-$time <7){
	usleep(50000);
	$response = send_request($encrypted_request);
}

//if we still have not resceived a response save to db with online flag set to F so that new transactions will be in offline mode and this can be sent later when system is back up
if($response == ''){
	$db->query('insert into tia_log set sequence_number='.$sequence_number.',  online_flag="F", request="'.addslashes($encrypted_request).'", response="'.addslashes($response).'"');
	$transaction_object['tia_log_id'] = $db->insert_id;
	mcrypt_module_close($cipher);
	sem_release($lock);
	return $transaction_object;
}

//we've recieved the response so save it to the db
$db->query('insert into tia_log set sequence_number='.$sequence_number.',  online_flag="T", request="'.addslashes($encrypted_request).'", response="'.addslashes($response).'"');
$transaction_object['tia_log_id'] = $db->insert_id;

//next parse out the unencrypted header parts which are all seperated by ~
$transaction_object["response"]["message_pieces"]["unencrypted"]["message_length"] = strtok($response, '~'); //full message length
$transaction_object["response"]["message_pieces"]["unencrypted"]["encryption"] = strtok('~');					//whether message is encrypted or not
$transaction_object["response"]["message_pieces"]["unencrypted"]["vendor_number"] =  strtok('~');			//should be our unique BB assigened vendor number
$transaction_object["response"]["message_pieces"]["unencrypted"]["terminal_number"] = strtok('~');			//unique terminal number
$transaction_object["response"]["message_pieces"]["unencrypted"]["encryption_length"] = strtok('~');		//length of encrypted response


$header_length = strlen(implode('', $transaction_object["response"]["message_pieces"]["unencrypted"]))+5; 	//calculate header length by adding the different parts and the seperators

$enc2 = substr($response, $header_length, strlen($response) - $header_length -2); //grab the encypted part which starts after the header and ends 2 characters before the end of the message

//if encrypted decrpt otherwise pass through as is
if($transaction_object["response"]["message_pieces"]["unencrypted"]["encryption"] == 1)        
	$p_t2 = decrypt($enc2);       
else
	$p_t2 = $enc2;
        
//parse out the different peices of resposne       
$encrypt_pieces = explode('~', $p_t2);

//add the peices to the transaction object
$transaction_object["response"]["message_pieces"]["encrypted"]["version_number"] = $encrypt_pieces[0];
$transaction_object["response"]["message_pieces"]["encrypted"]["transaction_type"] = $encrypt_pieces[1];
$transaction_object["response"]["message_pieces"]["encrypted"]["sequence_number"] = $encrypt_pieces[2];
$transaction_object["response"]["message_pieces"]["encrypted"]["response_code"] = $encrypt_pieces[3];
$transaction_object["response"]["message_pieces"]["encrypted"]["display_text"] = $encrypt_pieces[4];

$transaction_object["response"]["encrypted_message"] = $response;
$transaction_object["response"]["unencrypted_message"] = implode('~', $transaction_object["response"]["message_pieces"]["unencrypted"]).'~'.$p_t2;


sem_release($lock);//release lock
return $transaction_object; //return transaction object with a relavent information about this transaction
}


function perform_crc($data){
	$crc = 0;
	$temp = 0;
	for($x=0; $x < strlen($data); $x++){
		$value = (int)base_convert(bin2hex($data[$x]),16, 10); //get string value in actual decimal format
		
		$temp = $value ^ ($crc >> 8);
		
		
		
		$temp = $temp ^ ($temp >> 4);
		
		
		$temp = $temp ^ ($temp >> 2);
		
		
		$temp = $temp ^ ($temp >> 1);
		
		
		$crc = ($crc << 8) ^ ($temp << 15) ^ ($temp << 2) ^ $temp;
		$crc= $crc & hexdec('FFFF'); //get rid of all but lower 16 bits since this works on words but there is no way to use just a word in php
	}
	$crc = str_pad(dechex($crc), 4,'0', STR_PAD_LEFT);
	//lastly get crc as part of sting formated with the correct value
	return chr(hexdec(substr($crc,0,2))).chr(hexdec(substr($crc,2)));	
}


//key in plain string
$key = 'abcdef0123456789abcdef0123456789';
$key = '245f3f3354585d7379496d794551707c';
//same key in format needed to make the string have those actual hex value
//$key = chr(hexdec('ab')).chr(hexdec('cd')).chr(hexdec('ef')).chr(hexdec('01')).chr(hexdec('23')).chr(hexdec('45')).chr(hexdec('67')).chr(hexdec('89'));
//$key .= chr(hexdec('ab')).chr(hexdec('cd')).chr(hexdec('ef')).chr(hexdec('01')).chr(hexdec('23')).chr(hexdec('45')).chr(hexdec('67')).chr(hexdec('89'));
$key = chr(hexdec('24')).chr(hexdec('5f')).chr(hexdec('3f')).chr(hexdec('33')).chr(hexdec('54')).chr(hexdec('58')).chr(hexdec('5d')).chr(hexdec('73'));
$key .= chr(hexdec('79')).chr(hexdec('49')).chr(hexdec('6d')).chr(hexdec('79')).chr(hexdec('45')).chr(hexdec('51')).chr(hexdec('70')).chr(hexdec('7c'));
//creates the required initialization vector of 0
$iv = chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0);



function encrypt($data){
	global $cipher, $key, $iv;
	
	//create cipher with 128 bit chunks and CBC
	$cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
	
	//intialize the mcrypt with the cipher, key, and initialization vector
	mcrypt_generic_init($cipher, $key, $iv);
	
	//encrypt the part of the message that should be
	$cipherText = mcrypt_generic($cipher,$data);
	
	mcrypt_generic_deinit($cipher); //realease the initializeed cipher

	return $cipherText;
}
function decrypt($cipherText){
	global $cipher, $key, $iv;
	
	mcrypt_generic_init($cipher, $key, $iv);
     
	$data = mdecrypt_generic($cipher, $cipherText);
    
    /* Clean up */
    mcrypt_generic_deinit($cipher);
    mcrypt_module_close($cipher);
    
    return $data;
}


//$transaction_type, $amount, $iso, $tender_number = '910', $terminal_number = 3, $online='T', $manual = 'F'
//$result = tia_transaction((string)$_POST['tran_type'], (string)$_POST['amount'], (string)$_POST['carddata'], (string)$_POST['tend_num'], (string)$_POST['terminal_number'], (string)$_POST['online'], (string)$_POST['manual']);
//var_dump($result);
/*
<!-- 
<h1>Response</h1>

<div>
transaction type: <?=$result['response']["message_pieces"]["encrypted"]["transaction_type"]?>   sequence_number: <?=$result['response']["message_pieces"]["encrypted"]['sequence_number']?>
</div>
<div>
response code: <?=$result['response']['message_pieces']["encrypted"]['response_code']?>    display text: <?=$result['response']['message_pieces']["encrypted"]['display_text']?>
</div>
<div>
message length: <?=$result['response']['message_pieces']["unencrypted"]['message_length']?>  
encryption: <?=$result['response']['message_pieces']["unencrypted"]['encryption']?>  
vendor number: <?=$result['response']['message_pieces']["unencrypted"]['vendor_number']?>  
terminal number: <?=$result['response']['message_pieces']["unencrypted"]['terminal_number']?>  
encryption length: <?=$result['response']['message_pieces']["unencrypted"]['encryption_length']?>
</div>
<div>
unencrypted: <?=$result['response']['unencrypted_message']?>  <br />  encrypted: <?=bin2hex($result['response']['encrypted_message'])?>
</div>


<h1>Request</h1>

<div>
transaction type: <?=$result['requet']["message_pieces"]["encrypted"]["transaction_type"]?>   sequence_number: <?=$result['requet']["message_pieces"]["encrypted"]['sequence_number']?>
</div>
<div>
requet code: <?=$result['requet']['message_pieces']["encrypted"]['response_code']?>    display text: <?=$result['requet']['message_pieces']["encrypted"]['display_text']?>
</div>
<div>
message length: <?=$result['requet']['message_pieces']["unencrypted"]['message_length']?>  
encryption: <?=$result['requet']['message_pieces']["unencrypted"]['encryption']?>  
vendor number: <?=$result['requet']['message_pieces']["unencrypted"]['vendor_number']?>  
terminal number: <?=$result['requet']['message_pieces']["unencrypted"]['terminal_number']?>  
encryption length: <?=$result['requet']['message_pieces']["unencrypted"]['encryption_length']?>
</div>
<div>
unencrypted: <?=$result['requet']['unencrypted_message']?>  <br />  encrypted: <?=bin2hex($result['requet']['encrypted_message'])?>
</div>

<hr />


-->


*/
?>