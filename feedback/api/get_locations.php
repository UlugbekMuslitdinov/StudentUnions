<?php
require_once ('./db/MysqliDb.php');

$db = new MysqliDb ('mysql_host', 'web', 'viv3nij', 'hours2');
$result = $db->get('location', null, ['location_name']);

if(!$result) {
    echo json_encode(Array());
} else {
    echo json_encode($result);
}
?>