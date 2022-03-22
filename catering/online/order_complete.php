<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/function/main.function.php');
// session_destroy();
// var_dump($_SESSION);
// unset($_SESSION);
// $_SESSION['agreement'] = true;
// Check if user agreed on policies
checkAgreement();
checkStatusSession('order_complete');


/*
 *
 *  PAGE SETTING
 *
*/
$restaurant = "highland_burrito";

$pageSetting['style'] = [];

$pageSetting['script'] = [];

$pageSetting['header'] = 'Catering Online Order';

$content = 'view/orderConfirm.view.php';

include_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/view/master.view.php');

unset_all_session();

?>