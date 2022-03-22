<?php

// $env_test = false;		// Production site
$env_test = true;		// Test site

define ('HMAC_SHA256', 'sha256');

if ($env_test)
{
    define ('SECRET_KEY', '196797c5d4a448d6ba280d4e8ce232c6eba8fe7a890d4f6dbef287041a3e55fa38305865014641259365f188404cf307eaa880d777f149419e7d0f693e8cbd8c3bc82069215c4664b9996a15e3003ce6f5bd183084414fea8fb34de97e0ca6955d676d73a92a428299317339f680ebceb0b4d3b24f46434eb7f3db7249f1d525'); 	// Test site
}
else
{
    define ('SECRET_KEY', 'ec316923f53241d39ee7fe86cbf483cbace0521dd0764c57ae5e95a364d4a84a84a5f805b4d54892a8b0b67c475e5d4bd610d78cee154b3c9f366c0cc023bb2bd7a5fc53f1b340a391832b0d4b99c2d9e315df6f8ad54a80b4c4042f87cb01391080a15140c247a798d51002d1726c27b273b611a07d4785bc6f8ed27ebe17fb');	// Production site
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
