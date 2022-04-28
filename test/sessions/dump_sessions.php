<?php
session_start(); 
 
print("Sessions: <br/>");
foreach ($_SESSION as $key=>$val);
echo $key." - " . $val . "<br />";
var_dump($val);
print("<br/>");
print("Sessions: <br/>");
Print_r($_SESSION);
?>