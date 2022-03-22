<?php

$str = "<table class=\"table table-hover\">
<thead>
  <tr>
    <th>Event ID</th>
    <th>Event Time</th>
    <th>Event Name</th>
    <th>Progress</th>
    <th>Update Progress</th>
    <th></th>
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

    $str .= "
    <tr class=\"" . $statusClass . "\">
      <td>" . $event['event_id'] . "</td>
      <td>" . $event['json']['meta']['EventDate'] . "</td>
      <td>" . $event['json']['meta']['EventName'] . "</td>
      <td id=\"status" . $event['event_id'] . "\" class=\"";
      if($event['progress'] == "Received"){
        $str .= "text-primary";
      }
      else if($event['progress'] == "In Progress"){
        $str .= "text-warning";
      }
      else if($event['progress'] == "Completed"){
        $str .= "text-success";
      }

      $str .="\"><b>" . $event['progress'] . "</b></td>
      <form>
      <input type=\"hidden\" name=\"event_id\" value=\"" . $event['event_id'] . "\">
        <td><select name=\"progress\" id=\"progress" . $event['event_id'] . "\">
          <option value=\"Received\">Received</option>
          <option value=\"In Progress\">In Progress</option>
          <option value=\"Completed\">Completed</option>
        </select>
      </td>
      <td><button type=\"button\" class=\"btn btn-sm\" onclick=\"update(" . $event['event_id'] . ")\">Update</button></td>
    </form>
  </tr>
  ";

}



$str .= "</tbody></table>";

echo $str;

?>

<script type="text/javascript">

  function update(event_id) {
    var updateStatusOnPage = document.getElementById('status' + event_id);
    var FD = new FormData();
    FD.append('progress', document.getElementById('progress' + event_id).value);
    FD.append('event_id', event_id);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        $('#status' + event_id).attr("class", res.style);
        $('#status' + event_id).css("font-weight","Bold");
        $('#status' + event_id).html(res.status);
        location.reload();
      }
    };
    xhttp.open("POST", "function/updateProgress.php", true);
    xhttp.send(FD);

  }
</script>