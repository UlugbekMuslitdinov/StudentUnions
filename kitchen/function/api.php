<?php


include_once('../db/db.php');

$sql = "SELECT DISTINCT event_id FROM event_orders"; // get all the distinct event_ids

$result = $conn->query($sql);

// get a list of event_ids
while($row = $result->fetch_assoc()) {
    $event_ids[] = $row["event_id"];
}



/*
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
*/

// iterate through the array of event_ids and populate the array
$i = 0;
foreach($event_ids as $event_id) {
	$sql = "SELECT * FROM event_orders WHERE event_id=" . $event_id;
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {

		// get all events with the same event id and store them in an array
	    while($row = $result->fetch_assoc()) {
	    	$all_events_with_same_id[] = $row;
	    }

	    // store the last row from the previous array in order to have the latest record
	    $events[$i] = $all_events_with_same_id[count($all_events_with_same_id)-1];

	    /*// decode string to json from the record
	    $temp = json_decode($events[$i]['data']);

	    // encode data as json and store in the field
	    $events[$i]['data'] = json_encode($temp);
*/
	    $i++;

	} else {
	    continue;
	}

}



print_r(json_encode($events[0]));


$conn->close();

/*
$data = $db->select('event_orders')->where('event_id','=', '31355')->get();

// count($data)-1 in order to retrieve the latest record
$order = json_decode($data[count($data)-1]['data']);


print_r(json_encode($order));
*/



?>