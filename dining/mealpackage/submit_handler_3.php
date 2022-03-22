<?php
// ini_set('display_errors', 1);
session_start();

require_once('includes/mysqli.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/dining/mealpackage/include/tia.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/mealplans/includes/mp_functions.inc');
require_once('phplib/mimemail/htmlMimeMail5.php');

$error = false;

// Check if it is POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: index.php");
	die();
}

// Check inputs
foreach(['meal', 'refrigerator', 'microwave', 'payment'] as $key ){
    if (!array_key_exists($key, $_POST)){
        $error = true;
        break;
    }
}
foreach( $_POST as $key => $value ) {
    if("" == trim($value)){
        $error = true;
        break;
    }   
}
if ($error) {
//     $_SESSION['mealpackage']['error'] = [
//         status => true,
//         message => 'Please complete all required fields.'
//     ];
//     header("Location: index.php");
//     die();
}

// Get total amount.
$amount = $_POST['order_total_hidden_2'];

// var_dump($_POST);

// Store in Session
$_POST['secret_key'] = ($_POST['secret_key'] == 'FALL2020Q') ? 'Quarantine' : 'Isolation';
$_SESSION['mealpackage']['post'] = $_POST;
// Check water order.
if (isset($_POST['water'])) {
	$water = $_POST['water'];
} else {
	$water = 0;
}

// Store in DB
$db = new db_mysqli('su');
$query = "insert into mealpackage set "
            .'netid="'. $_SESSION['mealpackage']['login_info']['netid'] .'", '
            .'sid="'. $_SESSION['mealpackage']['login_info']['id'] .'", '
            .'email="'. $_POST['email'] .'", '
            .'firstname="'. $_POST['first_name'] .'", '
            .'lastname="'. $_POST['last_name'] .'", '
            .'phone="'. $_POST['phone'] .'", '
            .'dorm="'. $_POST['dorm'] .'", '
            .'meal="'. $_POST['meal'] .'", '
            .'days="'. $_POST['days'] .'", '
            .'refrigerator="'. $_POST['refrigerator'] .'", '
            .'microwave="'. $_POST['microwave'] .'", '
            .'requests="'. $_POST['requests'] .'", '
            .'room_number="'. $_POST['room_number'] .'", '
			.'water="'. $water .'", '
			.'amount="'. $_POST['order_total_hidden_2'] .'", '
            .'payment="'. $_POST['payment'] .'", '
            .'status="form submitted", '
            .'type="'. $_POST['secret_key'] .'", '
            .'timestamp="'. date("Y-m-d H:i:s") .'"';
$db->query($query);
//pass back id to data so app my retieve data
$_SESSION['mealpackage']['orderid'] = $db->insert_id;

// Payment
$creditcard = [];
if ($_POST['payment'] == 'Credit Card'){
    $creditcard['amount'] = $amount;
    $creditcard['merchant_defined_data1'] = $_SERVER['SERVER_NAME'];
    $creditcard['merchant_defined_data2'] = $_SERVER['PHP_SELF'];
    $creditcard['merchant_defined_data3'] = 'false'; // mobile?
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $creditcard['merchant_defined_data3'] = 'true'; // mobile?
    }
    $creditcard['merchant_defined_data4'] = $_SESSION['mealpackage']['orderid'];
    $creditcard['merchant_defined_data5'] = $_POST['email'];
    $creditcard['merchant_defined_data6'] = NULL;
    $creditcard['merchant_defined_data7'] = NULL;
    $creditcard['merchant_defined_data8'] = NULL;
    $creditcard['access_key'] = '2232d9c4d6263cf096c648a08efb86d0'; // Test
    $creditcard['profile_id'] = '85D0458B-BD1D-41EB-8D94-C2F76A7CD983'; // Test
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

    $env_test = true;			// Testing site
	// $env_test = false;		// Production Site
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
else {
    // Check mealplan or balance
    // $balance = 0;
    // if ($_POST['payment'] == 'MealPlan'){
    //     $mp_cust = getMPCustFromId($_SESSION['mealpackage']['login_info']['mp_id'], NULL);
    //     // $balance = getBalanceForCustID($mp_cust);

    //     // $tia = tia_transaction(DEBIT, 1, $mp_cust['iso'], $mp_cust['plan']['TENDER_NUM']);
    //     // echo $mp_cust['iso'].'<br>';
    //     echo 'iso : ' . $mp_cust['iso'] . '<br/>';
    //     echo 'tender num : ' . $mp_cust['plan']['TENDER_NUM'] . '<br/>';
    //     $tia = tia_transaction(DEBIT, 0.5, $mp_cust['iso'], $mp_cust['plan']['TENDER_NUM']);
    // }
    // else {
    //     // Catcash balance
    // }

    // Send an email confirmation
    $email_response = send_mail($_POST, $_POST['email']);
    // $email_response = send_mail_to_manager($_POST, 'sueventplanning@email.arizona.edu');
	$email_response = send_mail_to_manager($_POST, 'su-web@email.arizona.edu');

    if ($email_response){
        header("Location: /dining/mealpackage/confirmation.php");
        exit();
    }
}

// mail($to, $subject, $msg, $headers);

// $msg2 = '<html><body>';
// $msg2 .= "<p style='margin-bottom: 20px;'>We've received new catering event request submission. Thank you.</p>";
// $msg2 .= $data;
// $msg2 .= "</body></html>";

// mail($from, $subject, $msg2, $headers);
// mail('sueventplanning@email.arizona.edu', $subject, $msg2, $headers);
// mail('su-web@email.arizona.edu', $subject, $msg2, $headers);

// var_dump($_POST);

if (!$error){

}

function sign ($params) {
    $secret_key = '159f2f62f0cd487ba3f4d0517ad1df2b9664ab24ca3d48fdb219d15e632a0886ce148c6ca0b94736a61e21d97ffb541cd08be01e55ef441e99c4bc72dec9946fe1fbf7ba148945dfaa5e3ccd64b7a8b902c60735018e43f39169251340ca08e7a23746c3e8dc4abfba18bca22784cc3edc9d991acb044d93bda8a49ee8f12a19'; // Test
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

function send_mail($data, $email)
{
$days_val = "";

if($data['days'] == '1day') {
    $days_val = "1 day meal package";
}
if($data['days'] == '3day') {
    $days_val = "3 day meal package";
}

// Check water order.
if (isset($_POST['water'])) {
	$water = $_POST['water'] . " x 6 pack";
} else {
	$water = "";
}
$mail = new htmlMimeMail5();
// $mail->setFrom('Arizona Student Unions<no-reply@email.arizona.edu>');
$mail->setFrom('Arizona Student Unions<su-sueventplanning@email.arizona.edu>');
$mail->setSubject('Meal Package Order Confirmation');
$mail->setHTML('<style type="text/css">body, html{margin:0px; padding:0px;}</style>
    <table width="100%" height="auto" cellspacing="0" cellpadding="0" style="border: medium none ; margin: 0px; padding: 0px; width: 100%; height: 100%; ">
        <tbody>
            <tr>
                <td valign="top" align="center">
                <table width="700" cellspacing="0" cellpadding="0" style="height: 100%;">
                    <tbody>
                        <tr>
                            <td valign="top" style="height: 100%; width: 100%;">
                            <table height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="height: 100%;">
                                <tbody>
                                    <tr>
                                        <td>
                                        <!--<img width="646" height="196" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/DepositConfirmationTop.jpg" />-->
                                        <!--<img width="645" height="197" alt="Meal PLans" src="http://studentaffairs.arizona.edu/mailcall/user_images/MealPlans_Confirmation_Deposit_02(1).jpg" />-->
                                        </td>
                                    </tr>
                                    <tr style="height: 100%;">
                                        <td clign="center" valign="top" height="100%" style="height: 100%;">
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td>
                                                        <h1 style="font-size:18px; color:#fbb614;"><b>Your order has been received.</b></h1>
                                                        <p><b>Dear '.$data['first_name'].' '.$data['last_name'].',</b></p>
                                                        <!--<p>A deposit of $ has been made to your meal plan account via credit card charge().</p>-->

                                                        <!--<p>For questions or comments, call 520.621.7043 or 800.374.7379. You can also email us at mealplan@email.arizona.edu.</p>-->
                                                        <!--<img width="200" height="27" alt="Meal Plans" src="http://union.arizona.edu/mealplans/template/images/StudentUnions_200.jpg" />-->
                                                        <!--<img width="65" height="30" alt="" src="http://studentaffairs.arizona.edu/mailcall/user_images/union_logo.jpg" />-->
                                                    </td>
                                                    <td width="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td>
                                                        <table rules="all" style="border-color: #666; border: 1px;" cellpadding="3">
                                                            <tr style="background: #eee;"><td><strong>First Name:</strong> </td><td>' . $data['first_name'] . '</td></tr>
                                                            <tr><td><strong>Last Name:</strong> </td><td>' . $data['last_name'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Email:</strong> </td><td>' . $data['email'] . '</td></tr>
                                                            <tr><td><strong>Phone:</strong> </td><td>' . $data['phone'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Dorm:</strong> </td><td>' . $data['dorm'] . '</td></tr>
                                                            <tr><td><strong>Package:</strong> </td><td>' . $days_val . '</td></tr>
                                                            <tr><td><strong>Room Number:</strong> </td><td>' . $data['room_number'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Meal:</strong> </td><td>' . $data['meal'] . '</td></tr>
                                                            <tr><td><strong>Refrigerator:</strong> </td><td>' . $data['refrigerator'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Microwave:</strong> </td><td>' . $data['microwave'] . '</td></tr>
															<tr style="background: #eee;"><td><strong>Water:</strong> </td><td>' . $water . '</td></tr>
                                                            <tr><td><strong>Request:</strong> </td><td><pre>' . $data['requests'] . '</pre></td></tr>
															<tr style="background: #eee;"><td><strong>Total Amount:</strong> </td><td>$' . $data['order_total_hidden_2'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Payment Method:</strong> </td><td>' . $data['payment'] . '</td></tr>
                                                        </table>
                                                    </td>
                                                    <td width="20">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
            </tr>
        </tbody>
    </table>');

    $result  = $mail->send(array($email));

    return $result;
}


function send_mail_to_manager($data, $email)
{
$days_val = "";

if($data['days'] == '1day') {
    $days_val = "1 day meal package";
}
if($data['days'] == '3day') {
    $days_val = "3 day meal package";
}

// Check water order.
if (isset($_POST['water'])) {
	$water = $_POST['water'] . " x 6 pack";
} else {
	$water = "";
}
$mail = new htmlMimeMail5();
// $mail->setFrom('Arizona Student Unions<no-reply@email.arizona.edu>');
$mail->setFrom('Arizona Student Unions<su-sueventplanning@email.arizona.edu>');
$mail->setSubject('Meal Package Order Submission');
$mail->setHTML('<style type="text/css">body, html{margin:0px; padding:0px;}</style>
    <table width="100%" height="auto" cellspacing="0" cellpadding="0" style="border: medium none ; margin: 0px; padding: 0px; width: 100%; height: 100%; ">
        <tbody>
            <tr>
                <td valign="top" align="center">
                <table width="700" cellspacing="0" cellpadding="0" style="height: 100%;">
                    <tbody>
                        <tr>
                            <td valign="top" style="height: 100%; width: 100%;">
                            <table height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="height: 100%;">
                                <tbody>
                                    <tr style="height: 100%;">
                                        <td clign="center" valign="top" height="100%" style="height: 100%;">
                                        <table cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td>
                                                        <table rules="all" style="border-color: #666; border: 1px;" cellpadding="3">
                                                            <tr style="background: #eee;"><td><strong>Type</strong> </td><td>' . $data['secret_key'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>First Name:</strong> </td><td>' . $data['first_name'] . '</td></tr>
                                                            <tr><td><strong>Last Name:</strong> </td><td>' . $data['last_name'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Email:</strong> </td><td>' . $data['email'] . '</td></tr>
                                                            <tr><td><strong>Phone:</strong> </td><td>' . $data['phone'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Dorm:</strong> </td><td>' . $data['dorm'] . '</td></tr>
                                                            <tr><td><strong>Package:</strong> </td><td>' . $days_val . '</td></tr>
                                                            <tr><td><strong>Room Number:</strong> </td><td>' . $data['room_number'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Meal:</strong> </td><td>' . $data['meal'] . '</td></tr>
                                                            <tr><td><strong>Refrigerator:</strong> </td><td>' . $data['refrigerator'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Microwave:</strong> </td><td>' . $data['microwave'] . '</td></tr>
															<tr style="background: #eee;"><td><strong>Water:</strong> </td><td>' . $water . '</td></tr>
                                                            <tr><td><strong>Request:</strong> </td><td><pre>' . $data['requests'] . '</pre></td></tr>
															<tr style="background: #eee;"><td><strong>Total Amount:</strong> </td><td>$' . $data['order_total_hidden_2'] . '</td></tr>
                                                            <tr style="background: #eee;"><td><strong>Payment Method:</strong> </td><td>' . $data['payment'] . '</td></tr>
                                                        </table>
                                                    </td>
                                                    <td width="20">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
            </tr>
        </tbody>
    </table>');

    $result  = $mail->send(array($email));

    return $result;
}