<?php
// header("Location: /index.php");
// die();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// Store the information into the database.
$id = $_GET['id'];
$total = $_GET['total'];
$total_tax = $total * 0.061;	// Add 6.1% tax.
$total = $total + $total_tax;
$total = number_format((float)$total, 2, '.', '');
// $total = 1;		// Just for testing

// Process Credit Card Payment
function sign ($params) {
    $secret_key = '1e1b20aebdd545888fc3409e7a844ba60c2b95922623491d984fadd10a3bfc213232c2f5547d486e882631e7a786c4139899cef1180f4b0b84e2a854502079c2e3133e3bc3a94af38ef8eadb9042cadf2bb63c7f07ef4809b1ee4ffac32c4ffbbfc867b6438e4b83a4b744dc093566c8e6098d4262a0427dadd220db159f1def'; // Testing Site
    // $secret_key = 'a7cc623e591f4a2c9cee5e16da3391f884f7a4be8a4c4928be684ab93e25a0d698df33178c564f5f83f061001ce3e8dfb1e9d39384fe46be9f46e13363f17a1624b381ec6b5a40c8ada881dcf13a93eca69144dbdb864fc7815c5693f37f7c9c5e54a1a669544ae685fdca767a86b8bd65215cea4a0f4e90a54ddd97f4017d9c'; // Production Site   
    return signData(buildDataToSign($params), $secret_key);
} 
function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}  
function buildDataToSign($params) {
    $signedFieldNames = explode(",",$params["signed_field_names"]);
    $dataToSign = [];
    foreach ($signedFieldNames as &$field) {
        $dataToSign[] = $field . "=" . $params[$field];
    }
    return commaSeparate($dataToSign);
}  
function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

// CyberSource - Process Credit Card Payment.
$creditcard = [];
$creditcard['amount'] = $total;
$creditcard['merchant_defined_data1'] = $_SERVER['SERVER_NAME'];
$creditcard['merchant_defined_data2'] = $_SERVER['PHP_SELF'];
$creditcard['merchant_defined_data3'] = 'false'; // mobile?
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
$creditcard['merchant_defined_data3'] = 'true'; // mobile?
}
$creditcard['merchant_defined_data4'] = $id;	
$creditcard['access_key'] = 'd7132db7c4db3246a0c066cc00773b8a'; // Testing Site
$creditcard['profile_id'] = '3A21ACB1-EF14-4177-B9E7-972DADDE2923'; // Testing Site
// $creditcard['access_key'] = 'e8089a036571355ba2f6ea37ad1d4995'; // Production Site
// $creditcard['profile_id'] = 'E957A06F-23A2-4AF3-8646-F5FDD105D6FF'; // Production Site
$creditcard['transaction_uuid'] = uniqid();
$creditcard['unsigned_field_names'] = '';
$creditcard['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
$creditcard['locale'] = 'en';
$creditcard['transaction_type'] = 'sale';
$creditcard['reference_number'] = strtotime("now");
$creditcard['currency'] = 'USD';
	
$creditcard['signed_field_names'] = 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4';

$creditcard['signature'] = sign($creditcard);
$env_test = true;	// Testing site
// $env_test = false;	// Production site
?>
<form name="cybersource_form" style="display: none;" action="https://<?php echo $env_test ? 'test' : '' ?>secureacceptance.cybersource.com/pay" method="post"/>
	<?php
		foreach($creditcard as $name => $value) {
			echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
		}
	?>
</form>
<script type="text/javascript">
	window.onload=function(){
		document.forms["cybersource_form"].submit();
	}
</script>
<?php
	exit();
?>