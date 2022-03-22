<?php

// $env_test = false;	// Production Server
$env_test = true;	// Testing Server

define ('HMAC_SHA256', 'sha256');

if ($env_test)
{
    define ('SECRET_KEY', '0c4088b08a4e4917bc301f0dc88802e6ab842f81132148f3b702d93fcecfa3a959377d8c2a7945d785a3bdb243e7e1b1e610053c236a4cffacc666cb343e0e3fff6a5426ec5d40bf9f0e71a83a085aeb740a96dce517486a97a19025bda35fe6083b3a878fe54956b145dfd9df321e10959a9de86ff646ebac3e503f9a123b90'); //Testing server
}
else
{
    define ('SECRET_KEY', '19d7bab593374c9e9afd5183a19f7eecce0c6adf3c3d45cf815abba791dc98d286f43bbc4f6d40fcbbfe58ec287920121eee2397989549d6bf3ca4baabf064cff0ee43c5a05e4b5fae2c8ad5a82685dee01c7a2d1b7d4a5da043df3170d0977c80fd0d2f3f984d0b97040414bfc0dd26a8fcc406c82840ae85eeacc36f341d03');	//Production server
}

function sign ($params) {
  return signData(buildDataToSign($params), SECRET_KEY);
}

function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}

function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as &$field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
}

function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

?>
