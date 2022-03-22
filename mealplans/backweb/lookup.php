<?php
//include backweb template
require_once('template/mpbackweb.inc');
//require_once('../includes/mp_functions.inc');

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
$cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');

function decrypt($cipherText){
	global $cipher, $key, $iv;
	
	mcrypt_generic_init($cipher, $key, $iv);
     
	$data = mdecrypt_generic($cipher, $cipherText);
    
    /* Clean up */
    mcrypt_generic_deinit($cipher);
  
    
    return $data;
}

if(isset($_POST['tiaid'])){
	$result = $db->query('select * from tia_log where ID=\''.$_POST['tiaid'].'\'');
	$row = mysqli_fetch_assoc($result);
	$response = $row['response'];
	
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
	
	
	$request = $row['request'];
	
	//next parse out the unencrypted header parts which are all seperated by ~
	$transaction_object["request"]["message_pieces"]["unencrypted"]["message_length"] = strtok($request, '~'); //full message length
	$transaction_object["request"]["message_pieces"]["unencrypted"]["encryption"] = strtok('~');					//whether message is encrypted or not
	$transaction_object["request"]["message_pieces"]["unencrypted"]["vendor_number"] =  strtok('~');			//should be our unique BB assigened vendor number
	$transaction_object["request"]["message_pieces"]["unencrypted"]["terminal_number"] = strtok('~');			//unique terminal number
	$transaction_object["request"]["message_pieces"]["unencrypted"]["encryption_length"] = strtok('~');		//length of encrypted response
	
	
	$header_length = strlen(implode('', $transaction_object["request"]["message_pieces"]["unencrypted"]))+5; 	//calculate header length by adding the different parts and the seperators
	
	$enc2 = substr($request, $header_length, strlen($request) - $header_length -2); //grab the encypted part which starts after the header and ends 2 characters before the end of the message
	
	//if encrypted decrpt otherwise pass through as is
	if($transaction_object["request"]["message_pieces"]["unencrypted"]["encryption"] == 1)        
		$p_t2 = decrypt($enc2);       
	else
		$p_t2 = $enc2;
	        
	//parse out the different peices of resposne       
	$encrypt_pieces = explode('~', $p_t2);
	
	//add the peices to the transaction object
	$transaction_object["request"]["message_pieces"]["encrypted"]["version_number"] = $encrypt_pieces[0];
	$transaction_object["request"]["message_pieces"]["encrypted"]["transaction_type"] = $encrypt_pieces[1];
	$transaction_object["request"]["message_pieces"]["encrypted"]["sequence_number"] = $encrypt_pieces[2];
	$transaction_object["request"]["message_pieces"]["encrypted"]["tender_num"] = $encrypt_pieces[3];
	$transaction_object["request"]["message_pieces"]["encrypted"]["timestamp"] = $encrypt_pieces[4];
	$transaction_object["request"]["message_pieces"]["encrypted"]["online"] = $encrypt_pieces[5];
	$transaction_object["request"]["message_pieces"]["encrypted"]["amount"] = $encrypt_pieces[6];
	$transaction_object["request"]["message_pieces"]["encrypted"]["currency"] = $encrypt_pieces[7];
	$transaction_object["request"]["message_pieces"]["encrypted"]["manual"] = $encrypt_pieces[8];
	$transaction_object["request"]["message_pieces"]["encrypted"]["iso"] = $encrypt_pieces[9];
	$transaction_object["request"]["message_pieces"]["encrypted"]["pin"] = $encrypt_pieces[10];
	$transaction_object["request"]["message_pieces"]["encrypted"]["cash_equiv"] = $encrypt_pieces[11];
	
	$transaction_object["request"]["encrypted_message"] = $request;
	$transaction_object["request"]["unencrypted_message"] = implode('~', $transaction_object["request"]["message_pieces"]["unencrypted"]).'~'.$p_t2;
	
	
	
	
	
	
	
	
	$result = $transaction_object;
	ob_start();
	?>
	<h1>Request</h1>

	<div>
		transaction type: <?=$result['request']["message_pieces"]["encrypted"]["transaction_type"]?>   sequence_number: <?=$result['request']["message_pieces"]["encrypted"]['sequence_number']?>
	</div>
	<div>
		tendernum: <?=$result['request']['message_pieces']["encrypted"]['tender_num']?>    amount: <?=$result['request']['message_pieces']["encrypted"]['amount']/100?>
	</div>
	<div>
		iso: <?=$result['request']['message_pieces']["encrypted"]['iso']?>    date: <?=$result['request']['message_pieces']["encrypted"]['timestamp']?>
	</div>
	<div>
		message length: <?=$result['request']['message_pieces']["unencrypted"]['message_length']?>  
		encryption: <?=$result['request']['message_pieces']["unencrypted"]['encryption']?>  
		vendor number: <?=$result['request']['message_pieces']["unencrypted"]['vendor_number']?>  
		terminal number: <?=$result['request']['message_pieces']["unencrypted"]['terminal_number']?>  
		encryption length: <?=$result['request']['message_pieces']["unencrypted"]['encryption_length']?>
	</div>
	<div>
		unencrypted: <?=$result['request']['unencrypted_message']?>  <br />  encrypted: <?=bin2hex($result['request']['encrypted_message'])?>
	</div>
	
	
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
<?php 
	$results = ob_get_clean();
	mcrypt_module_close($cipher);
}






//start page
mpbackweb_start('config');

?>
<h2>Lookup</h2>
<form action="lookup.php" method="post">
emplid: <input name="emplid" value="<?=$_POST['emplid']?>" type="text"/><input type="submit" value="Go" /> 
</form>
<form action="lookup.php" method="post">
tiaid: <input name="tiaid" value="<?=$_POST['tiaid']?>" type="text"/><input type="submit" value="Go" /> 
</form>
<?=$results?>
<?php 
mpbackweb_finish();
?>