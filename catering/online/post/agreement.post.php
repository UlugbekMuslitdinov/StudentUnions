<?php
include_once('../function/post.function.php');

// var_dump($_SESSION);

postSetup('agreement');

// var_dump($_POST);

$_SESSION['catering']['restaurant'] = $_POST['restaurant'];

// Intialize status session with false value
$_SESSION['catering']['agreement'] = 'agree';
$_SESSION['catering_status']['agreement'] = true;
$_SESSION['catering_status']['index'] = false;
$_SESSION['catering_status']['menu'] = false;
$_SESSION['catering_status']['review'] = false;
$_SESSION['catering_status']['order_complete'] = false;

$_SESSION['catering_post']['agreement'] = true;
$_SESSION['catering_post']['index'] = false;
$_SESSION['catering_post']['menu'] = false;
$_SESSION['catering_post']['review'] = false;

header("Location: ../index.php");