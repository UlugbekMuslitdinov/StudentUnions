<?php
include_once('/db/db.php');

$sql = "SELECT DISTINCT event_id FROM event_orders"; // get all the distinct event_ids

$result = $conn->query($sql);

// get a list of event_ids
while($row = $result->fetch_assoc()) {
    $event_ids[] = $row["event_id"];
}

// iterate through the array of event_ids and populate the array

$events = [];
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

	    $events[$i]['json'] = json_decode($events[$i]['data'], true);

	    $i++;

	} else {
	    continue;
	}
}

echo "<table class=\"table table-striped table-hover\">";

echo "
<thead>
      <tr>
        <th>Event ID</th>
        <th>Event Time</th>
        <th>Event Name</th>
        <th>Progress</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>";

foreach($events as $event) {
    echo "
      <tr>
        <td>" . $event['event_id'] . "</td>
        <td>" . $event['event_time'] . "</td>
        <td>" . $event['json']['meta']['EventName'] . "</td>
        <td>" . $event['progress'] . "</td>
        <td><button type=\"button\" class=\"btn\" data-target=\"#testModal\" data-toggle=\"modal\">View Details</button></td>
      </tr>

      <!-- Modal -->
<div id=\"testModal\" class=\"modal fade\" role=\"dialog\">
  <div class=\"modal-dialog\">

    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h4 class=\"modal-title\">Event Details</h4>
      </div>
      <div class=\"modal-body\">
        <p>Some text in the modal.</p>
      </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
      </div>
    </div>

  </div>
</div>


      ";
}

echo "</tbody></table>";


$conn->close();
?>