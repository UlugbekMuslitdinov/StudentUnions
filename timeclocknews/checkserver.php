<?php
//require('db.inc');
require_once ('includes/mysqli.inc');
//db_connect();
$db = new db_mysqli('menuboards'); 
/*
$DBlink = mysql_connect("trinity.sunion.arizona.edu","web","viv3nij")
or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. (error 1)</p>");

mysql_select_db("menuboards", $DBlink)
or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database</p> <p>It is not your fault, Please try again later.  (error 2)</p>");
*/
print 'success';
?>
