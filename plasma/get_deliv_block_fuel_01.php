<?php
  ###########################################
  # required for all pages using DELIVERANCE #
  ############################################
  
  // enables 'edit | view' options to appear for authorized users
  session_start();
  
  // includes the display functions
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");
	
	// connect to database
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");

  ################################
  # end DELIVERANCE requirements #
  ################################
  
  randomFeed(99);
?>
