<?php


include_once('../db/db.php');

$sql = "SELECT * FROM event_orders WHERE event_id=" . $_GET['event_id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {

		// get all events with the same event id and store them in an array
	while($row = $result->fetch_assoc()) {
		$all_events_with_same_id[] = $row;
	}

	    // store the last row from the previous array in order to have the latest record
	$event = $all_events_with_same_id[count($all_events_with_same_id)-1];
	$event['json'] = json_decode($event['data'], true);

	    $foodservices = $event['json']['foodservice'];

	  foreach($foodservices as $foodservice) {
        if($foodservice['category'] == "Comments") {
          echo "<p style=\"font-size: 20px;\">" . $foodservice['text'] . "</p><br>";
        }
       }
	}

	$conn->close();



?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">