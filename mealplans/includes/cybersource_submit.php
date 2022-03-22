<?php
  include 'cybersource_security.php';

  function insert_submit($amount, $host, $origin)
  {
    global $env_test;

    $params['amount'] = $amount;
    $params['merchant_defined_data1'] = $host;
    $params['merchant_defined_data2'] = $origin;
    $params['merchant_defined_data3'] = false; // mobile?
    $params['merchant_defined_data4'] = $_SESSION['mp_cust']['lastname'];
    $params['merchant_defined_data5'] = $_SESSION['mp_login']['type'];
    $params['merchant_defined_data6'] = $_SESSION['mp_login']['access'];
    $params['merchant_defined_data7'] = $_SESSION['mp_login']['id'];
    $params['merchant_defined_data8'] = $_SESSION['mp_login']['guest_id'];
    // $params['access_key'] = $env_test ? '839308c6e979302b8ecaec505355f94d' : '839308c6e979302b8ecaec505355f94d';
	$params['access_key'] = $env_test ? '781920e5b1f636d9bf6cf604c80b241a' : '781920e5b1f636d9bf6cf604c80b241a';   // Testing Server
    $params['profile_id'] = 'samk-mp';
    $params['transaction_uuid'] = uniqid();
    $params['unsigned_field_names'] = '';
    $params['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
    $params['locale'] = 'en';
    $params['transaction_type'] = 'authorization';
    $params['reference_number'] = strtotime("now");
    $params['currency'] = 'USD';

    $params['signed_field_names'] = 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4,merchant_defined_data5,merchant_defined_data6,merchant_defined_data7,merchant_defined_data8';
?>

<form action="https://<?php echo $env_test ? 'test' : '' ?>secureacceptance.cybersource.com/pay" method="post"/>
    <?php
        foreach($params as $name => $value) {
            echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
        }

        echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($params) . "\"/>\n";
    ?>
    <br />
    <input type="submit" id="submit" value="Submit"/>
</form>

<?php } ?>
