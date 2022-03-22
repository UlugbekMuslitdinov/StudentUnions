<?php

require('hours_db.inc');
			  
			  
			$query = 'delete from exceptions where location_id='.$_POST['data2'].' and date_of="'.$_POST['data'].'"';
			//print $query;
			$result = $db->query($query);
			//print mysql_error($result);  

// include mobile hours script to update table for feeds whenever a change is made
include('mobile_hours.php');
			  
?>