<?php

include_once('../db/db.php');
$res['event_id'] = $_POST['event_id'];
$res['category'] = $_POST['category'];
$sql = "SELECT * FROM event_orders WHERE event_id=" . $_POST['event_id'];
$result = $conn->query($sql);

// get all events with the same event id and store them in an array
while($row = $result->fetch_assoc()) {
	$event = $row; // stores the latest event in the last iteration
}

$event_json = json_decode($event['data'], true);

$i = 0;
foreach($event_json['foodservice'] as $key=>$foodservice) {
	if(($foodservice['category'] == $_POST['category']) && count($foodservice['meta']) > 0) {
		if($i == (int)$_POST['i']){
			$foodservice['meta']['checked'] = $_POST['checked'];
			$event_json['foodservice'][$key]['meta']['checked'] = $_POST['checked'];
			$res['updatedFoodService'] = $foodservice;
		}
		$i++;
	}
}

$temp = mysqli_real_escape_string($conn, json_encode($event_json));
$sql = "UPDATE event_orders SET data='$temp' WHERE event_id=" . $_POST['event_id'];

$result = $conn->query($sql);

$res['checked'] = $_POST['checked'];
$res['json'] = json_encode($event_json);
$res['i'] = $_POST['i'];

echo json_encode($res);
?>