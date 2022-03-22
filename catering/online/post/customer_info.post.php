<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/function/post.function.php');

postSetup('index');

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

// Need to check if POST value is empty
$check = [];
checkPost($check);

// Store in Database
$insert = [
	'location' => $_POST['location'],
	'method' => $_POST['delivery_option'],
	'delivery_date' => date('Y-m-d', strtotime(str_replace('-', '/', $_POST['delivery_date']))),
	'delivery_time' => $_POST['delivery_time']
];

if ($_POST['delivery_option'] == "Delivery"){
	$insert['delivery_building'] = $_POST['delivery_building'];
	$insert['delivery_room'] = $_POST['delivery_room'];
	$insert['onsite_name'] = $_POST['onsite_name'];
	$insert['onsite_email'] = $_POST['onsite_email'];
	$insert['onsite_phone'] = $_POST['onsite_phone'];
}

$insert['customer_name'] = $_POST['customer_name'];
$insert['customer_phone'] = $_POST['customer_phone'];
$insert['customer_email'] = $_POST['customer_email'];
$insert['payment_method'] = $_POST['payment_method'];
$insert['delivery_notes'] = $_POST['delivery_notes'];
$insert['status'] = $_POST['status'];


if ($_POST['payment_method'] == 'IDB'){
	$insert['account_num'] = $_POST['account_num'];
	$insert['sub_code'] = $_POST['sub_code'];
}

$db = New CateringDB('su');
$db_insertId = $db->table('catering')->insertGetId($insert);

// $db = new DB();
// $db_insert = $db->insert('catering');
// $db_insert->into('location',$_POST['location'])
// 	      ->into('method',$_POST['delivery_option'])
// 	      ->into('delivery_date',date('Y-m-d', strtotime(str_replace('-', '/', $_POST['delivery_date']))) )
// 	      // ->into('delivery_date',$post['delivery_date'])
// 	      ->into('delivery_time',$_POST['delivery_time']);
// if ($_POST['delivery_option'] == "Delivery"){
// 	$db_insert->into('delivery_building',$_POST['delivery_building'])
// 	      	  ->into('delivery_room',$_POST['delivery_room'])
// 	          ->into('onsite_name',$_POST['onsite_name'])
// 	          ->into('onsite_email',$_POST['onsite_email'])
// 	          ->into('onsite_phone',$_POST['onsite_phone']);
// }
// $db_insert->into('customer_name',$_POST['customer_name'])
// 	      ->into('customer_phone',$_POST['customer_phone'])
// 	      ->into('customer_email',$_POST['customer_email'])
// 	      ->into('payment_method',$_POST['payment_method'])
// 		  ->into('delivery_notes',$_POST['delivery_notes'])
// 	      ->into('status',$_POST['status']);

// if ($_POST['payment_method'] == 'IDB'){
// 	$db_insert->into('account_num',$_POST['account_num'])
// 			  ->into('sub_code',$_POST['sub_code']);
// }

// Store
// $db_check = $db_insert->save();

// // Need to check database error
// echo $db_check;

// Set and store session
$catering_id = $db_insertId;
$_SESSION['status'] = $_POST['status'];
$_SESSION['catering_id'] = $db_insertId;
$_SESSION['catering_status']['index'] = true;
$_SESSION['catering_post']['index'] = true;

// Sent user to menu page
if ($_SESSION['catering']['restaurant'] == 'highland'){
	header("Location: /catering/online/menu.php");
}
else {
	header("Location: /catering/online/" . $_SESSION['catering']['restaurant'] . "/");
}
?>

<?php 
// include_once('../function/post.function.php');

// // postSetup('index');

// // echo '<pre>';
// // var_dump($_POST);
// // echo '</pre>';

// // Need to check if POST value is empty
// $check = [];
// // checkPost($check);

// require  $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
// require "../function/DB.php";

// // Store in Database
// $db = New DB('su');
// $data = [
// 			'location' => $_POST['location'],
// 			'method' => $_POST['delivery_option'],
// 			'delivery_date' => date('Y-m-d', strtotime(str_replace('-', '/', $_POST['delivery_date']))),
// 			'delivery_time' => $_POST['delivery_time']
// 		];

// if ($_POST['delivery_option'] == "Delivery"){
// 	$delivery_data = [
// 				'delivery_building' => $_POST['delivery_building'],
// 				'delivery_room' => $_POST['delivery_room'],
// 				'onsite_name' => $_POST['onsite_name'],
// 				'onsite_email' => $_POST['onsite_email'],
// 				'onsite_phone' => $_POST['onsite_phone']
// 			];
// 	$data = array_merge($data, $delivery_data);
// }
// $customer_data = [
// 					'customer_name' => $_POST['customer_name'],
// 					'customer_phone' => $_POST['customer_phone'],
// 	      			'customer_email' => $_POST['customer_email'],
// 	      			'payment_method' => $_POST['payment_method'],
// 		  			'delivery_notes' => $_POST['delivery_notes'],
// 	      			'status' => $_POST['status']
// 	      		];
// $data = array_merge($data, $customer_data);

// if ($_POST['payment_method'] == 'IDB'){
// 	$idb_data = [
// 					'account_num' => $_POST['account_num'],
// 					'sub_code' => $_POST['sub_code']
// 				];
// 	$data = array_merge($data, $idb_data);
// }

// var_dump($data);

// $insert = $db->table('catering')->insertGetId($data);

// var_dump($insert);


// // Store
// // $db_check = $db_insert->save();

// // // Need to check database error
// // echo $db_check;

// // Set and store session
// // $catering_id = $db_insert->id();
// $_SESSION['status'] = $_POST['status'];
// $_SESSION['catering_id'] = $insert;
// $_SESSION['catering_status']['index'] = true;
// $_SESSION['catering_post']['index'] = true;

// // Sent user to menu page
// if (isset($_SESSION['catering']['restaurant']))
// {
// 	if ($_SESSION['catering']['restaurant'] == 'highland_burrito')
// 	{
// 		header("Location: ../menu.php");
// 	}
// 	else
// 	{
// 		header("Location: ../../online/".$_SESSION['catering']['restaurant'].'/');
// 	}
// }
// else
// {
// 	header('Location: /catering/online_order/');
// }
?>