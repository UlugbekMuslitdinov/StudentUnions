<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/function/main.function.php');
checkAgreement();
checkStatusSession('menu');


// Check if id exists


/*
 *
 *  PAGE SETTING
 *
*/
$restaurant = "highland_burrito";

$pageSetting['style'] = ['menu.css'];

$pageSetting['script'] = ['menu.js'];

$pageSetting['header'] = 'Catering Online Order';

$content = 'view/menu.view.php';

include_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/view/master.view.php');