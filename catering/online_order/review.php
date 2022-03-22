<?php
include_once('function/main.function.php');
checkStatusSession('review');


/*
 *
 *  GET DATA
 *
*/
$id = $_SESSION['catering_id'];
$db = new DB();
$customer_info = $db->select('catering')->where('id','=',$id)->get();
$customer_info = $customer_info[0];
$_SESSION['catering']['customer_info'] = $customer_info;

$extra = $db->select('catering_highland')->where('catering_id','=',$id)->get();
$extra = $extra[0];
$_SESSION['catering']['extra'] = $extra;

$burritos = $db->select('catering_highland_burrito')->where('catering_id','=',$id)->get();
$_SESSION['catering']['burritos'] = $burritos;



/*
 *
 *  PAGE SETTING
 *
*/
$restaurant = "highland_burrito";

$pageSetting['style'] = ['review.css'];
$pageSetting['script'] = [];
// $pageSetting['script'][] = 'review.js';

$pageSetting['header'] = 'Catering Online Order Review';

$content = 'view/review.view.php';

/* Call Master Page */
include_once('view/master.view.php');