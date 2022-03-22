<?php
include_once('function/main.function.php');

// Check if user agreed on policies
checkAgreement();
// echo 'nono';
// exit();
checkStatusSession('index');


/*
 *
 *  PAGE SETTING
 *
*/
$pageSetting['style'] = ['customer_info.css'];
$pageSetting['script'] = ['customer_info.js'];
$pageSetting['header'] = 'Catering Online Order';

// $_SESSION['catering']['restaurant'] = "highland_burrito";
$restaurant = $_SESSION['catering']['restaurant'];

$sidebar = 'view/customer_info_sidebar.view.php';
$content = 'view/customer_info.view.php';

include_once('view/master.view.php');