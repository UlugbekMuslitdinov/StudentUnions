<?php

include_once('/db/db.php');

$result = $conn->query($sql);

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

	$foodservice = $event['json']['foodservice'];

	echo "
	<table class=\"table table-striped table-hover\">
          <thead>
                <tr>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>";


       foreach($foodservices as $foodservice) {
        if($foodservice['category'] == "Food") {
          echo "<tr>";
          echo "<td>" . $foodservice['meta']['Price'] . "</td>";
          echo "<td>" . $foodservice['meta']['Qty'] . "</td>";
          echo "<td>" . $foodservice['meta']['Unit'] . "</td>";
          echo "<td>" . $foodservice['meta']['Total'] . "</td>";
          echo "</tr>";
        }
       }

       echo "
      </tbody></table>";

}

echo "in services.function.php";

?>