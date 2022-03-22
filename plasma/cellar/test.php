<?php
  	
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
  
	require_once ('includes/mysqli.inc');

  	// select database
  	$db = new db_mysqli('deliverance');
  	if ($db->connect_errno)
	{
		echo $db->connect_errno;
		exit();
	}
  
  	################################
  	# end DELIVERANCE requirements #
  	################################

	print 'success';
	
?>