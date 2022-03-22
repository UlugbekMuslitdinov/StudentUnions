<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/db.inc');
$DBlink = db_connect();
//var_dump(mysql_connect('mysql_host', 'web', 'viv3nij'));
db_select('unions_app');
?>