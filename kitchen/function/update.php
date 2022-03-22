<?php

include_once('../db/db.php');

$sql = 'UPDATE event_orders SET progress=\'' . $_POST['progress'] . '\' WHERE event_id=' . $_POST['event_id'];

$result = $conn->query($sql);

if($_POST['progress'] == 'Received'){
	$res['status'] = 'Received';
	$res['style'] = 'text-primary';
}
else if($_POST['progress'] == 'In Progress'){
	$res['status'] = 'In Progress';
	$res['style'] = 'text-warning';
}
else if($_POST['progress'] == 'Completed'){
	$res['status'] = 'Completed';
	$res['style'] = 'text-success';
}
else {
	$res['status'] = 'Error';
	$res['style'] = '';
	$res['progress'] = $_POST['progress'];
}

echo json_encode($res);
?>