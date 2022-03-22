<?php
    function getOpenStatus($location_id){
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	$db = new db_mysqli('hours2');
    $today = date("Y-m-d");
    $day = date("N");
 
    $query = 'select * from hours join periods on hours.type=periods.type where start_date<="'.$today.'" and end_date>="'.$today.'" and location_id='.$location_id;
  
    $result = $db->query($query);
    $query_row = mysqli_fetch_array($result, MYSQLI_NUM);
  
  	//var_dump($query_row);
  
  
    $open = $query_row[(($day-1)*2)+1];
    $close = $query_row[(($day-1)*2)+2];
	
    $isClosed = (($open==$close) && ($open == '00:00:00'));
  
    $query = 'select * from exceptions where location_id ='.$location_id.' and date_of="'.$today.'"';
    
    $result = $db->query($query);
    if($row = mysqli_fetch_assoc($result)){
      $open = $row['open'];
      $close = $row['close'];
      $isClosed = (($open==$close) && ($open == '00:00:00'));
    }
    $db->close();
	
	$openD  = floatval(str_replace(":", ".", substr($open, 0, -3)));
	
	$closeD = floatval(str_replace(":", ".", substr($close, 0, -3)));
	
	if($isClosed)
		$test = false;
	else
		if($closeD >= 0 && $closeD <= 7)
			$test = ($openD < floatval(date("H.i")));
		else
			$test = (($openD <= floatval(date("H.i"))) && ($closeD >= floatval(date("H.i"))));
	
    return $test;
  }

  function printLocationHours($location_id, $loc_name = "") {
    global $location;  
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	$db = new db_mysqli('hours2');
  
  $locations_table = "locations";
  $groups_table = "groups";
  $subgroups_table = "subgroups";
  $hours_table = "hours";
                 
  
  $today = date("Y-m-d", time());
  $day = date("N");
  /*
  $query_string = "SELECT * FROM $locations_table, $hours_table
             WHERE ( ${hours_table}.location_id = '$location_id'
             AND ${hours_table}.location_id = ${locations_table}.location_id
             AND ${hours_table}.start_date <= '$today'
             AND ${hours_table}.end_date >= '$today' )";

  $query_result = mysql_query( $query_string );
  
  $query_row = mysql_fetch_assoc( $query_result );
  
  $open = $query_row[$day . "_open"];
  $close = $query_row[$day . "_close"];
  $isClosed = $query_row[$day . "_isClosed"];
  */
  $query='select location_id from location where old_id='.$location_id;
  //print $query;
  $result = $db->query($query);
  $temp = mysqli_fetch_array($result);
  $location_id = $temp['location_id'];

  $query = 'select * from hours join periods on hours.type=periods.type where start_date<="'.$today.'" and end_date>="'.$today.'" and location_id='.$location_id;
  //print $query;
  $result = $db->query($query);
  $query_row = mysqli_fetch_array($result, MYSQLI_NUM);
  //var_dump($query_row);
  //print (($day-1)*2)+1;
  //print (($day-1)*2)+2;
  $open = $query_row[(($day-1)*2)+1];
  $close = $query_row[(($day-1)*2)+2];
  $isClosed = (($open==$close) && ($open == '00:00:00'));
  
  
  $query = 'select * from exceptions where location_id ='.$location_id.' and date_of="'.$today.'"';
  //print $query;
  $result = $db->query($query);
  if(mysqli_num_rows($result)){
  //print 'exception';
    $row = mysqli_fetch_assoc($result);
    $open = $row['open'];
    $close = $row['close'];
    $isClosed = (($open==$close) && ($open == '00:00:00'));
  }
  
  $phone = $location["phone"];

  echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#999999\" width=\"100%\">";
  echo "<tr><td>";
  echo "<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\">";
  echo "<tr><td width=\"35\"><img src=\"https://union.arizona.edu/template/images/clock.gif\" width=\"33\" height=\"33\" alt=\"clock image\" border=\"0\"></td>";
  echo "<td>";
  
  if( $loc_name == "" ) $loc_name = (isset($query_row["location_name"])) ? $query_row["location_name"] : '';
  
  if( $isClosed == 1 || !isset($open) || !isset($close)) {
    echo $loc_name . " is closed today.&nbsp;&nbsp;";
  } else {
    echo $loc_name . " is open today from ";
    echo printHours($open, $close, $isClosed);
    echo ".&nbsp;&nbsp;"; 
  }
  
  if( $phone != null && isset($phone) ) {
    echo "<br>Call us at " . $phone . ".";
  }
  
  echo "<br><a href = \"/infodesk/hours\">view all student union hours</a>&nbsp;&nbsp;";
  
  echo "</td>";
  echo "</tr></table></td></tr></table>";
  
  $db->close();

}

function printLocationHoursMobile($location_id, $loc_name = "") {
    global $location;  
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	$db = new db_mysqli('hours2');
  
  $locations_table = "locations";
  $groups_table = "groups";
  $subgroups_table = "subgroups";
  $hours_table = "hours";
                 
  
  $today = date("Y-m-d", time());
  $day = date("N");
  /*
  $query_string = "SELECT * FROM $locations_table, $hours_table
             WHERE ( ${hours_table}.location_id = '$location_id'
             AND ${hours_table}.location_id = ${locations_table}.location_id
             AND ${hours_table}.start_date <= '$today'
             AND ${hours_table}.end_date >= '$today' )";

  $query_result = mysql_query( $query_string );
  
  $query_row = mysql_fetch_assoc( $query_result );
  
  $open = $query_row[$day . "_open"];
  $close = $query_row[$day . "_close"];
  $isClosed = $query_row[$day . "_isClosed"];
  */
  $query='select location_id from location where old_id='.$location_id;
  //print $query;
  $result = $db->query($query);
  $temp = mysqli_fetch_array($result);
  $location_id = $temp['location_id'];

  $query = 'select * from hours join periods on hours.type=periods.type where start_date<="'.$today.'" and end_date>="'.$today.'" and location_id='.$location_id;
  //print $query;
  $result = $db->query($query);
  $query_row = mysqli_fetch_array($result, MYSQLI_NUM);
  //var_dump($query_row);
  //print (($day-1)*2)+1;
  //print (($day-1)*2)+2;
  $open = $query_row[(($day-1)*2)+1];
  $close = $query_row[(($day-1)*2)+2];
  $isClosed = (($open==$close) && ($open == '00:00:00'));
  
  
  $query = 'select * from exceptions where location_id ='.$location_id.' and date_of="'.$today.'"';
  //print $query;
  $result = $db->query($query);
  if(mysqli_num_rows($result)){
  //print 'exception';
    $row = mysqli_fetch_assoc($result);
    $open = $row['open'];
    $close = $row['close'];
    $isClosed = (($open==$close) && ($open == '00:00:00'));
  }
  
  $phone = $location["phone"];

  echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">";
  echo "<tr><td>";
  echo "<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" width=\"100%\">";
  echo "<tr><td width=\"35\"><img src=\"https://union.arizona.edu/template/images/white-clock.png\" width=\"33\" height=\"33\" alt=\"clock image\" border=\"0\"></td>";
  echo "<td>";
  
  if( $loc_name == "" ) $loc_name = $query_row["location_name"];
  
  if( $isClosed == 1 || !isset($open) || !isset($close)) {
    echo $loc_name . " is closed today.&nbsp;&nbsp;";
  } else {
    echo $loc_name . " is open today from ";
    echo printHours($open, $close, $isClosed);
    echo ".&nbsp;&nbsp;"; 
  }
  
  if( $phone != null && isset($phone) ) {
    echo "<br>Call us at " . $phone . ".";
  }
    
  echo "</td>";
  echo "</tr></table></td></tr></table>";
  
  $db->close();

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
  
  if ($hour >= 13) {
    $hour = $hour - 12;
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