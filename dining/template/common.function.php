<?php
function printLocationHours($location_id, $loc_name = "") {
    global $location;
  // $db_name = "hours2";
  // $db_host = "mysql_host";
  // $db_user = "web";
  // $db_pass = "viv3nij";

  $locations_table = "locations";
  $groups_table = "groups";
  $subgroups_table = "subgroups";
  $hours_table = "hours";

  // $db2 = new DB('hours2');
  $db2 = new db_mysqli('hours2');

  $today = date("Y-m-d", time());
  // echo $today;

  $day = date("N");
  $query='select location_id from location where location_id='.$location_id;
  // $query='select location_id from location where old_id='.$location_id;
  //print $query;
  $result = $db2->query($query);
  $temp =  $result->fetch_array();
  $location_id = $temp['location_id'];

  $query = 'select * from hours join periods on hours.type=periods.type where start_date<="'.$today.'" and end_date>="'.$today.'" and location_id='.$location_id;
  $result = $db2->query($query);
  $query_row = $result->fetch_array(MYSQLI_NUM);
  $open = $query_row[(($day-1)*2)+1];
  $close = $query_row[(($day-1)*2)+2];
  $isClosed = (($open==$close) && ($open == '00:00:00'));


  $query = 'select * from exceptions where location_id ='.$location_id.' and date_of="'.$today.'"';
  $result = $db2->query($query);
  if(mysqli_num_rows($result)){
      $row = mysqli_fetch_assoc($result);
      $open = $row['open'];
      $close = $row['close'];
      $isClosed = (($open==$close) && ($open == '00:00:00'));
  }

  $phone = $location["phone"];

  echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#999999\" width=\"100%\">";
  echo "<tr><td>";
  echo "<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\">";
  echo "<tr><td width=\"35\"><img src=\"/template/images/clock.gif\" width=\"33\" height=\"33\" alt=\"clock image\" border=\"0\"></td>";
  echo "<td>";

  if( $loc_name == "" ) $loc_name = isset($query_row["location_name"]) ? $query_row["location_name"] : '';

  // This is for the customized message for specific restaurant.
  if($location['location_id']==999){
      echo "We will be CLOSED until mid August for remodeling.";
  } else {
      if( $isClosed == 1 || !isset($open) || !isset($close)) {
          echo $loc_name . " is closed today.&nbsp;&nbsp;";
      }
      // highland market is open 24hrs during the regular school year.
      else if ($open == $close && $open != "00:00:00") {
          echo $loc_name . " is open 24hrs!&nbsp;&nbsp;";
      }
      else {
          echo $loc_name . " is open today from ";
          echo printHours($open, $close, $isClosed);
          echo ".&nbsp;&nbsp;";
      }
  }

      
  if( $phone != null && isset($phone) ) {
      echo "<br>Call us at " . $phone . ".";
  }

  echo "<br><a href = \"/infodesk/hours\">view all student union hours</a>&nbsp;&nbsp;";

  echo "</td>";
  echo "</tr></table></td></tr></table>";

}

function printHours($open_time, $close_time, $isClosed) {

  // check if the location is closed
  if ($isClosed == 1) {

      echo "<font color=\"#666666\">closed</font><br>";

  } else {

      echo prettyTime($open_time) . '-' . prettyTime($close_time);

  }

}

function prettyTime($time) {

  list($hour, $min, $sec) = explode(":", $time);

  //echo $open_hour, ":<br>", $open_min,":<br>", $open_sec,":<br>",$close_hour,":<br>", $close_min,":<br>", $close_sec;

  if ($hour >= 12) { // hour changes to pm at 12, not 13
      $hour = $hour >= 13 ? $hour - 12 : $hour; // if hour is indeed 13+, change to 1+
      $ampm = 'p';
  } else {
      $ampm = 'a';
  }

  $hour = (int)$hour; // cast to an int to get rid of leading 0

  if ($min == "00") {
      if ($hour == "00") return "mid";
      if ($hour == "12") return "noon";
      else return $hour . $ampm;
  } else {
      return $hour . ':' . $min . $ampm;
  }

}