<?php
include_once('../kitchen/db/db.php');

$sql = "SELECT DISTINCT event_id FROM event_orders ORDER BY event_id DESC"; // get all the distinct event_ids

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

echo "<table class=\"table table-hover\">";

echo "
<thead>
  <tr>
    <th>Event ID</th>
    <th>Event Time</th>
    <th>Event Name</th>
    <th>Progress</th>
    <th>Details</th>
    <th>Food Details</th>
  </tr>
</thead>
<tbody>";

  foreach($events as $event) {

    $foodservices = $event['json']['foodservice'];

    $statusClass = "";

    if($event['progress'] == "Received"){
        $statusClass = "bg-info";
      }
      else if($event['progress'] == "In Progress"){
        $statusClass = "bg-warning";
      }
      else if($event['progress'] == "Completed"){
        $statusClass = "bg-success";
      }

    echo "
    <tr class=\"" . $statusClass . "\">
      <td>" . $event['event_id'] . "</td>
      <td>" . $event['json']['meta']['EventDate'] . "</td>
      <td>" . $event['json']['meta']['EventName'] . "</td>
      <td class=\"";

      if($event['progress'] == 'Received')
        echo "text-primary";
      else if($event['progress'] == 'In Progress')
        echo "text-warning";
      else if($event['progress'] == 'Completed')
        echo "text-success";

      echo "\"><b>" . $event['progress'] . "</b></td>
      <td><button type=\"button\" class=\"btn btn-sm\" data-target=\"#event_details" . $event['event_id'] . "\" data-toggle=\"modal\" data-keyboard=\"false\">View Details</button></td>
      <td><button type=\"button\" class=\"btn btn-sm\" data-target=\"#food_details" . $event['event_id'] . "\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\">Food/Services</button></td>
    </tr>

    <!-- Modal -->
    <div class=\"modal fade\" id=\"event_details" . $event['event_id'] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLongTitle\" aria-hidden=\"true\">
      <div class=\"modal-dialog modal-lg\" role=\"document\">
        <div class=\"modal-content\">
          <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"modal_title\">Event Details</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
              <span aria-hidden=\"true\">&times;</span>
            </button>
          </div>
          <div class=\"modal-body\">

            <h4 class=\"text-center\">Event Name: " . $event['json']['meta']['EventName'] . "</h4>
            <h4 class=\"text-center\">Client/Organization: " . $event['json']['meta']['ClientOrganization'] . "</h4>
            <h4 class=\"text-center\">Event ID: " . $event['event_id'] . "</h4><hr />


            <h4>Booking Details</h4>
            <p class=\"info\">Event Planner: " . $event['json']['meta']['EventPlanner'] . "</p>
            <p class=\"info\">Booking Contact: " . $event['json']['meta']['BookingContact'] . "</p>
            <p class=\"info\">Booking Tel: " . $event['json']['meta']['BookingTel'] . "</p>
            <p class=\"info\">Booking Email: " . $event['json']['meta']['BookingEmail'] . "</p><br>

            <h4>Site Contact</h4>
            <p class=\"info\">Site Contact: " . $event['json']['meta']['SiteContact'] . "</p>
            <p class=\"info\">Site Cell: " . $event['json']['meta']['SiteCell'] . "</p><br>

            <h4>Billing Details</h4>
            <p class=\"info\">Billing Client: " . $event['json']['meta']['BillingClient'] . "</p>

            <p class=\"info\">Form of Payment: " . $event['json']['meta']['FormOfPayment'] . "</p>


          </div>
          <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal -->
    <div class=\"modal fade\" id=\"food_details" . $event['event_id'] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLongTitle\" aria-hidden=\"true\">
      <div class=\"modal-dialog modal-lg\" role=\"document\">
        <div class=\"modal-content\">
          <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"modal_title\">Foods/Services Details</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\" onclick=\"reload()\">
              <span aria-hidden=\"true\">&times;</span>
            </button>
          </div>
          <div class=\"modal-body\">

            <h4 class=\"text-center\">Event Name: " . $event['json']['meta']['EventName'] . "</h4>
            <h4 class=\"text-center\">Client/Organization: " . $event['json']['meta']['ClientOrganization'] . "</h4>
            <h4 class=\"text-center\">Event ID: " . $event['event_id'] . "</h4><hr />

            <iframe src=\"function/foods_and_services.php?event_id=" . $event['event_id'] . "\" height=\"500\" width=\"100%\" class=\"text-center\"></iframe><br>
            ";

            echo "
          </div>
          <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\" onclick=\"reload()\">Close</button>
          </div>
        </div>
      </div>
    </div>
    ";
  }

  echo "</tbody></table>";
  $conn->close();

  ?>