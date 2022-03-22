<?php
session_start();
include('webauth/include.php');
$_SESSION['authorized']=TRUE;
header('Location: tickets.php');
?>
