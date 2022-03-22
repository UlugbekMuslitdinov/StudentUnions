<?php
ini_set('display_errors', 1);
$lock = sem_get('1');
sem_acquire($lock);
require_once ('includes/mysqli.inc');
include('tia_functions.php');
$db = new db_mysqli('mealplans');
$result = $db->query('select * from tia_log where online_flag="F" order by ID');
while($offline_tran = mysqli_fetch_assoc($result)){


$encrypted_request = $offline_tran['request'];
$response ='';
$time = time();
$response = send_request($encrypted_request);
while($response == '' && time()-$time <10){
	usleep(50000);
	$response = send_request($encrypted_request);
}

if($response == ''){
	$db->query('update tia_log set  online_flag="F", request="'.addslashes($encrypted_request).'", response="'.addslashes($response).'" where ID='.$offline_tran['ID']);
	mcrypt_module_close($cipher);
	sem_release($lock);
	exit();
}

$db->query('update tia_log set  online_flag="T", request="'.addslashes($encrypted_request).'", response="'.addslashes($response).'"where ID='.$offline_tran['ID']);



$transaction_object["response"]["message_pieces"]["unencrypted"]["message_length"] = strtok($response, '~');
$transaction_object["response"]["message_pieces"]["unencrypted"]["encryption"] = strtok('~');
$transaction_object["response"]["message_pieces"]["unencrypted"]["vendor_number"] =  strtok('~');
$transaction_object["response"]["message_pieces"]["unencrypted"]["terminal_number"] = strtok('~');
$transaction_object["response"]["message_pieces"]["unencrypted"]["encryption_length"] = strtok('~');


$header_length = strlen(implode('', $transaction_object["response"]["message_pieces"]["unencrypted"]))+5;
$enc2 = substr($response, $header_length, strlen($response) - $header_length -2);


$p_t2 = decrypt($enc2);


$encrypt_pieces = explode('~', $p_t2);
$transaction_object["response"]["message_pieces"]["encrypted"]["version_number"] = $encrypt_pieces[0];
$transaction_object["response"]["message_pieces"]["encrypted"]["transaction_type"] = $encrypt_pieces[1];
$transaction_object["response"]["message_pieces"]["encrypted"]["sequence_number"] = $encrypt_pieces[2];
$transaction_object["response"]["message_pieces"]["encrypted"]["response_code"] = $encrypt_pieces[3];
$transaction_object["response"]["message_pieces"]["encrypted"]["display_text"] = $encrypt_pieces[4];

$transaction_object["response"]["encrypted_message"] = $response;
$transaction_object["response"]["unencrypted_message"] = implode('~', $transaction_object["response"]["message_pieces"]["unencrypted"]).'~'.$p_t2;

//var_dump($resp_length.'~'.$encry.'~'.$vendor.'~'.$terminal.'~'.$encry_length.'~'.$p_t);
//var_dump($resp_length.'~'.$encry.'~'.$vendor.'~'.$terminal.'~'.$encry_length.'~'.$p_t2);
//var_dump($transaction_object);
$temp = $result;
$result = $transaction_object;
?>
<h1>Response - Offline</h1>

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
$result = $temp;
}
sem_release($lock);

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







function decrypt($cipherText){
	//key in plain string
	$key = 'abcdef0123456789abcdef0123456789';
	//same key in format needed to make the string have those actual hex value
	$key = chr(hexdec('ab')).chr(hexdec('cd')).chr(hexdec('ef')).chr(hexdec('01')).chr(hexdec('23')).chr(hexdec('45')).chr(hexdec('67')).chr(hexdec('89'));
	$key .= chr(hexdec('ab')).chr(hexdec('cd')).chr(hexdec('ef')).chr(hexdec('01')).chr(hexdec('23')).chr(hexdec('45')).chr(hexdec('67')).chr(hexdec('89'));
	//creates the required initialization vector of 0
	$iv = chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0);

	$cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
	mcrypt_generic_init($cipher, $key, $iv);

	$data = mdecrypt_generic($cipher, $cipherText);

    /* Clean up */
    mcrypt_generic_deinit($cipher);
    mcrypt_module_close($cipher);

    return $data;
}
