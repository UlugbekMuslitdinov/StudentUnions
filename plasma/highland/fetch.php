<?php
  	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-type: application/json');
	
	// Buffer data we do not want to sent client.
	// This includes Deliverence edit block
	ob_start();
	
    ############################################
  	# required for all pages using DELIVERANCE #
  	############################################
  
  	// enables 'edit | view' options to appear for authorized users
  	session_start();
  
	// includes the display functions
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");
	// include("/srv/www/htdocs/commontools/deliverance/display_functions.php");
	  
	// connect to database
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");
	// include("/srv/www/htdocs/commontools/deliverance/inc_db_switch.php");
  
  	################################
  	# end DELIVERANCE requirements #
  	################################
  	
  	require_once('includes/mysqli.inc');
  	
  	//$stmt = $dbh->prepare("INSERT INTO ".TBL_OFFCAMPUS." (business_name, description, street_address, mailing_address, phone, email, website, first_name, last_name, status)"
	//		." VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	
	$dbh = new db_mysqli('plasma_highland');
	
	$day = date("N");
	$time = date("H:i");
	$result = $dbh->query("SELECT `resource_type`, `resource_id`, `viewing_time` FROM `slides` ".
			"WHERE (NOW() BETWEEN `start_date` AND `end_date`) AND (`day`=$day) AND `slide_set`=".intval($_GET['set']).
			" AND ('$time' BETWEEN `start_time` AND `end_time`) ORDER BY `relative_order` ASC");
	
	$slides = array();
	
	// Discard buffer
	$garbage = ob_get_clean();
	
	while($row = $result->fetch_assoc())
	{
		$tmp = array();
		// Ensure client gets an ID that is not already in use
		$id = $row['resource_id'].$row['resource_type'].$row['viewing_time'].'-'.date("His");
		$viewing_time = $row['viewing_time'];
		ob_start();
		$row['resource_type']($row['resource_id']);
		$content = ob_get_clean();
		$div = '<div id="'.$id.'" style="display: none; position: absolute">'.$content.'</div>';
		$tmp['id'] = $id;
		$tmp['resource'] = $row['resource_id'].$row['resource_type'];
		$tmp['viewing_time'] = $viewing_time;
		$tmp['div'] = $div;
		$slides[] = $tmp;
	}
	
	print json_encode($slides);
?>