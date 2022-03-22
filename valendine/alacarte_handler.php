<?php
// header("Location: /index.php");
// die();
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

// Store the information into the database.
$id = $_GET['id'];
$total = $_GET['total'];
$total_tax = $total * 0.061;	// Add 6.1% tax.
$total = $total + $total_tax;
$total = number_format((float)$total, 2, '.', '');

// Process Credit Card Payment
function sign ($params) {
    $secret_key = 'a2e10790fadb4d7894a6ef92d7814cd187dfa8519ce64ff8aff2a044288888a378b7e070b2274db8bc89d9f2769ce72976580e8779184061a80b602cd70c8c6329dffef0b6594719b8bbc7416ef85dbbecb2c93df24e4a0e8ff4ad9ed0da932810543b3f58f44426ad2ba2df72592530fec892c9e02e455d901e3b2f800ca3c0'; // Testing Site
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
$creditcard['access_key'] = 'e87e8081fef834ea9c55f0db405c50b8'; // Testing Site
$creditcard['profile_id'] = 'F851862C-59C5-4076-AEF4-5EC4391DA180'; // Testing Site
// $creditcard['access_key'] = 'bfe7b0985b2937c6b4e1c3c7ae4806f4'; // Production Site
// $creditcard['profile_id'] = 'ADBF0BF7-9552-4499-A739-1BD30869143D'; // Production Site
$creditcard['transaction_uuid'] = uniqid();
$creditcard['unsigned_field_names'] = '';
$creditcard['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
$creditcard['locale'] = 'en';
$creditcard['transaction_type'] = 'sale';
$creditcard['reference_number'] = strtotime("now");
$creditcard['currency'] = 'USD';
	
$creditcard['signed_field_names'] = 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4';

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
?>