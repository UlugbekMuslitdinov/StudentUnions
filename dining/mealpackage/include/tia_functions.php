<?php
// ini_set('display_errors', 1);
function send_request($request){
//var_dump("test");
	// $fp = fsockopen("tcp://150.135.73.44", 9003, $errno, $errstr, 10);
	$fp = fsockopen("tcp://150.135.74.146", 9003, $errno, $errstr, 10); // test server
	//var_dump($fp);
//var_dump($errno);
//var_dump($errstr);
if($fp){
	fwrite($fp, $request);
	stream_set_timeout($fp, 10);
	$response = fgets($fp, 6);
	$length = strtok($response, '~');
	//var_dump($length);
	while(strlen($response) < $length){
		$response .= fgets($fp, 2);
		// var_dump($response);
	}
	// var_dump($request);
	// echo "<br>";
	// var_dump($response);
	fclose($fp);
}
	return $response;	
}