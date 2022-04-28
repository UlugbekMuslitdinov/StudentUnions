
<?php
// $fp = fsockopen("www.example.com", 80, $errno, $errstr, 30);
// $fp = fsockopen("tcp://150.135.74.146", 9003, $errno, $errstr, 10); // Test Server
$fp = fsockopen("tcp://150.135.73.44", 9003, $errno, $errstr, 10);		// Production 
if (!$fp) {
	echo "Connection Failed.<br />\n";
    echo "$errstr ($errno)<br />\n";
} else {
	echo "Connection Successful.<br />\n";
    $out = "GET / HTTP/1.1\r\n";
    // $out .= "Host: https://150.135.73.44:9003\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}
?>
