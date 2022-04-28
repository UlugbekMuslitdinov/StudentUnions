<?php
// Check if it is POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: index.php");
	die();
}
session_start();

// Process Credit Card Payment
function sign ($params) {
    $secret_key = 'fab12da561cb4fdba80c3fc11e1eba82895d54ae7aff404fabcd94d2cac7f609cdf058586a8d4247ba0f8ae79be53d23116437cf64d84d95917ed32aeb168195ac0fb44cb7e54123bdf822733c58cdd30c00c868aea84e4f86275d81fa35135c4b084ca712484f8abbfd7b9dd736de939e416270e5ec462a8f6972a0230f2a99'; // Test Cookie
    // $secret_key = '213e217d8c7b43d3abee17feab595a4df95697ab7acb4f869edf4898362d67f6eaa66af7e60549d2882ec67bdaca903bdf8f2bcea82c4054820c0d0a4ab597ca391f9b606aea4f14bf9a5f26acd4deb5d00f72e5ef10487ea5c326ee1bd990436fffd5735e514a7d804f4fc32b0b3c7cb4bf8ac6f0fc44b3875ca014b90a3f47'; // Production
    
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

$creditcard = [];
if (1 == 1){
$creditcard['amount'] = $amount;
$creditcard['merchant_defined_data1'] = $_SERVER['SERVER_NAME'];
$creditcard['merchant_defined_data2'] = $_SERVER['PHP_SELF'];
$creditcard['merchant_defined_data3'] = 'false'; // mobile?
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	$creditcard['merchant_defined_data3'] = 'true'; // mobile?
}
$creditcard['merchant_defined_data4'] = $_POST["first_name"];;
$creditcard['merchant_defined_data5'] = "";
$creditcard['merchant_defined_data6'] = $_POST["email"];
$creditcard['merchant_defined_data7'] = "";
$creditcard['merchant_defined_data8'] = $_POST["statement"];
$creditcard['access_key'] = '49c7531bc20f31caa7e4174ee72e5cbc'; // Test Cookie
$creditcard['profile_id'] = '897833B6-4D9C-4634-AC80-98DBA7A45ED9'; // Test Cookie
// $creditcard['access_key'] = '45e346781520348ebdc71e866177962c'; // Production
// $creditcard['profile_id'] = '2A9B8D06-CDBE-41F2-9E06-5DBB2B0A81BC'; // Production
$creditcard['transaction_uuid'] = uniqid();
$creditcard['unsigned_field_names'] = '';
$creditcard['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
$creditcard['locale'] = 'en';
$creditcard['transaction_type'] = 'sale';
$creditcard['reference_number'] = strtotime("now");
$creditcard['currency'] = 'USD';

$creditcard['signed_field_names'] = 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4,merchant_defined_data5,merchant_defined_data6,merchant_defined_data7,merchant_defined_data8';

$creditcard['signature'] = sign($creditcard);

$env_test = true;
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
}