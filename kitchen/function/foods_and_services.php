
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../js/foods_and_services.js"></script>

<?php

include_once('../db/db.php');

$sql = "SELECT * FROM event_orders WHERE event_id=" . $_GET['event_id'];
$result = $conn->query($sql);

echo "<input type=\"hidden\" id=\"event_id\" value=\"" . $_GET['event_id'] . "\">";

		// get all events with the same event id and store them in an array
while($row = $result->fetch_assoc()) {
  $all_events_with_same_id[] = $row;
}

	    // store the last row from the previous array in order to have the latest record
$event = $all_events_with_same_id[count($all_events_with_same_id)-1];
$event['json'] = json_decode($event['data'], true);


$foodservices = $event['json']['foodservice'];
echo "<h4 class=\"foodservicetable\">Foods <div id=\"foodStatus\" style=\"display: inline-block;\" class=\"text-success\" 
style=\"visibility: hidden;\">Complete!</div></h4>";

echo "<form><table class=\"table table-striped table-hover\">
<thead>
  <tr>
    <th>Status</th>
    <th>Title</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Unit</th>
    <th>Total</th>
  </tr>
</thead>
<tbody>";



  $i = 0;
  foreach($foodservices as $foodservice) {
    if($foodservice['category'] == "Food" && count($foodservice['meta']) > 0) {
      echo "<tr>";
      echo "<td><div class=\"form-actions text-center\"><input class=\"food\" id=\"food" . $i . "\" type=\"checkbox\" name=\"foodUpdates[]\" value=\"" . $foodservice['title'] . "\" onclick='updateSelection(" . $event['event_id'] . ",\"food" . $i . "\", \"" . $foodservice['category'] . "\", " . $i . ")'";

      if($foodservice['meta']['checked'] == 'true')
        echo "checked";

      echo "></input></div></td>";
      echo "<td>" . $foodservice['title'] . "</td>";
      echo "<td>" . $foodservice['meta']['Price'] . "</td>";
      echo "<td>" . $foodservice['meta']['Qty'] . "</td>";
      echo "<td>" . $foodservice['meta']['Unit'] . "</td>";
      echo "<td>" . $foodservice['meta']['Total'] . "</td>";
      echo "</tr>";
      $i++;
    }
  }

  echo "</tbody></table><br>";

  echo "<h4 class=\"foodservicetable\">Beverages <div id=\"bevStatus\" style=\"display: inline-block;\" class=\"text-success\" 
  style=\"visibility: hidden;\">Complete!</div></h4>";
  echo "<table class=\"table table-striped table-hover\">
  <thead>
    <tr>
      <th>Status</th>
      <th>Title</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Unit</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>";


    $i = 0;
    foreach($foodservices as $foodservice) {
      if($foodservice['category'] == "Beverages" && count($foodservice['meta']) > 0) {
        echo "<tr>";
        echo "<td><div class=\"form-actions text-center\"><input class=\"beverages\"  id=\"beverages" . $i . "\" type=\"checkbox\" name=\"beverageUpdates[]\" value=\"" . $foodservice['title'] . "\"  onclick='updateSelection(" . $event['event_id'] . ", \"beverages" . $i . "\", \"" . $foodservice['category'] . "\", " . $i . ")'";

        if($foodservice['meta']['checked'] == 'true')
          echo "checked";

        echo "></input></div></td>";
        echo "<td>" . $foodservice['title'] . "</td>";
        echo "<td>" . $foodservice['meta']['Price'] . "</td>";
        echo "<td>" . $foodservice['meta']['Qty'] . "</td>";
        echo "<td>" . $foodservice['meta']['Unit'] . "</td>";
        echo "<td>" . $foodservice['meta']['Total'] . "</td>";
        echo "</tr>";
        $i++;
      }
    }
    echo "</tbody></table><br>";

    echo "<h4 class=\"foodservicetable\">Equipment <div id=\"eqStatus\" style=\"display: inline-block;\" class=\"text-success\" 
    style=\"visibility: hidden;\">Complete!</div></h4>";

    echo "<table class=\"table table-striped table-hover\">
    <thead>
      <tr>
        <th>Status</th>
        <th>Title</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>";

      $i = 0;
      foreach($foodservices as $foodservice) {
        if($foodservice['category'] == "Equipment" && count($foodservice['meta']) > 0) {
          echo "<tr>";
          echo "<td><div class=\"form-actions text-center\"><input class=\"equipment\"  id=\"equipment" . $i . "\" type=\"checkbox\" name=\"equipmentUpdates[]\" value=\"" . $foodservice['title'] . "\" onclick='updateSelection(" . $event['event_id'] . ", \"equipment" . $i . "\", \"" . $foodservice['category'] . "\", " . $i . ")'";

          if($foodservice['meta']['checked'] == 'true')
            echo "checked";

          echo "></input></div></td>";
          echo "<td>" . $foodservice['title'] . "</td>";
          echo "<td>" . $foodservice['meta']['Price'] . "</td>";
          echo "<td>" . $foodservice['meta']['Qty'] . "</td>";
          echo "<td>" . $foodservice['meta']['Unit'] . "</td>";
          echo "<td>" . $foodservice['meta']['Total'] . "</td>";
          echo "</tr>";
          $i++;
        }
      }
      echo "</tbody></table><br>";

      echo "<h4 class=\"foodservicetable\">Other <div id=\"otherStatus\" style=\"display: inline-block;\" class=\"text-success\" 
      style=\"visibility: hidden;\">Complete!</div></h4>";

      echo "<table class=\"table table-striped table-hover\">
      <thead>
        <tr>
          <th>Status</th>
          <th>Title</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Unit</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>";

        $i = 0;
        foreach($foodservices as $foodservice) {
          if($foodservice['category'] == "Other" && count($foodservice['meta']) > 0) {
            echo "<tr>";
            echo "<td><div class=\"form-actions text-center\"><input class=\"other\"  id=\"other" . $i . "\" type=\"checkbox\" name=\"otherUpdates[]\" value=\"" . $i . "\" onclick='updateSelection(" . $event['event_id'] . ", \"other" . $i . "\", \"" . $foodservice['category'] . "\", " . $i . ")'";

            if($foodservice['meta']['checked'] == 'true')
              echo "checked";

            echo "></input></div></td>";
            echo "<td>" . $foodservice['title'] . "</td>";
            echo "<td>" . $foodservice['meta']['Price'] . "</td>";
            echo "<td>" . $foodservice['meta']['Qty'] . "</td>";
            echo "<td>" . $foodservice['meta']['Unit'] . "</td>";
            echo "<td>" . $foodservice['meta']['Total'] . "</td>";
            echo "</tr>";
            $i++;
          }
        }
        echo "</tbody></table><br>";

        echo "<h4 class=\"foodservicetable\">Comments</h4><hr class=\"comments\" />";
        foreach($foodservices as $foodservice) {
          if($foodservice['category'] == "Comments") {
            echo "<p class=\"foodservicetable\" style=\"font-size: 20px;\">" . $foodservice['text'] . "</p><br>";
          }
        }


        ?>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../style/event.css">
        <link rel="stylesheet" type="text/css" href="../style/foodservices.css">

