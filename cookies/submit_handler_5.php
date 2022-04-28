<?php
// header("Location: https://union.arizona.edu/celebrationcookies/index.php");
// die();
// Check if it is POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: index.php");
	die();
}
// session_start();

// Process Credit Card Payment
function sign ($params) {
    $secret_key = 'fab12da561cb4fdba80c3fc11e1eba82895d54ae7aff404fabcd94d2cac7f609cdf058586a8d4247ba0f8ae79be53d23116437cf64d84d95917ed32aeb168195ac0fb44cb7e54123bdf822733c58cdd30c00c868aea84e4f86275d81fa35135c4b084ca712484f8abbfd7b9dd736de939e416270e5ec462a8f6972a0230f2a99'; // Testing Site
    // $secret_key = '38ab707851bd4f23a9c1d4f83daa6a9b68889eb1832c47beb5964ebed6d8107b7964f841e61d4d45a41d9ad9474dcb8a5eb1d15cdcfd4b678c70e6ba6d7755e533553f05c75149298230a83308cfcdcf902cb4469f9543e1bf1f868f4d6baf179a4e5a3cf6b64f0c974e093efeed85b5625f3b511f28473baa88743da1b8765a'; // Production Site
    
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

$amount = $_POST["total_price_3"];

$creditcard = [];
$creditcard['amount'] = $amount;
$creditcard['merchant_defined_data1'] = $_SERVER['SERVER_NAME'];
$creditcard['merchant_defined_data2'] = $_SERVER['PHP_SELF'];
$creditcard['merchant_defined_data3'] = 'false'; // mobile?
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	$creditcard['merchant_defined_data3'] = 'true'; // mobile?
}
$creditcard['merchant_defined_data4'] = $_POST["first_name"];;
$creditcard['merchant_defined_data5'] = $_POST["last_name"];
$creditcard['merchant_defined_data6'] = $_POST["email"];
$creditcard['merchant_defined_data7'] = $_POST["phone"];
$creditcard['merchant_defined_data8'] = $_POST["statement"];
$creditcard['merchant_defined_data9'] =  $_POST["s_name"];
$creditcard['merchant_defined_data10'] = $_POST["s_email"];
$creditcard['merchant_defined_data11'] = $_POST["s_phone"];
$creditcard['merchant_defined_data12'] = date($_POST["pickupdate"]);
$creditcard['merchant_defined_data13'] = $_POST["total_price_2"];
$creditcard['merchant_defined_data14'] = $_POST["cookie_1"];
$creditcard['merchant_defined_data15'] = $_POST["cookie_2"];
$creditcard['merchant_defined_data16'] = $_POST["cookie_3"];
$creditcard['merchant_defined_data17'] = $_POST["cookie_4"];
$creditcard['merchant_defined_data18'] = $_POST["cookie_5"];
$creditcard['merchant_defined_data19'] = $_POST["cookie_6"];
$creditcard['merchant_defined_data20'] = $_POST["cookie_7"];
$creditcard['merchant_defined_data21'] = $_POST["cookie_8"];
$creditcard['merchant_defined_data22'] = $_POST["total_tax"];
$creditcard['merchant_defined_data23'] = $_POST["total_price_3"];
$creditcard['merchant_defined_data24'] = $_POST["theme"];
$creditcard['merchant_defined_data25'] = $_POST["theme_2"];
$creditcard['merchant_defined_data26'] = $_POST["cookie_9"];
$creditcard['merchant_defined_data27'] = $_POST["cookie_10"];
$creditcard['access_key'] = '49c7531bc20f31caa7e4174ee72e5cbc'; // Testing Site
$creditcard['profile_id'] = '897833B6-4D9C-4634-AC80-98DBA7A45ED9'; // Testing Site
// $creditcard['access_key'] = 'bfe7b0985b2937c6b4e1c3c7ae4806f4'; // Production Site
// $creditcard['profile_id'] = 'ADBF0BF7-9552-4499-A739-1BD30869143D'; // Production Site
$creditcard['transaction_uuid'] = uniqid();
$creditcard['unsigned_field_names'] = '';
$creditcard['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
$creditcard['locale'] = 'en';
$creditcard['transaction_type'] = 'sale';
$creditcard['reference_number'] = strtotime("now");
$creditcard['currency'] = 'USD';

$creditcard['signed_field_names'] = 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4,merchant_defined_data5,merchant_defined_data6,merchant_defined_data7,merchant_defined_data8,merchant_defined_data9,merchant_defined_data10,merchant_defined_data11,merchant_defined_data12,merchant_defined_data13,merchant_defined_data14,merchant_defined_data15,merchant_defined_data16,merchant_defined_data17,merchant_defined_data18,merchant_defined_data19,merchant_defined_data20,merchant_defined_data21,merchant_defined_data22,merchant_defined_data23,merchant_defined_data24,merchant_defined_data25,merchant_defined_data26,merchant_defined_data27';

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
// }