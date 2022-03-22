<?php
session_start();
session_destroy();

/*	if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://elvis.sunion.arizona.edu/intra/marketingform/backweb.php");
    }

	session_start();
	if(!isset($_SESSION['netID'])){

	if(!isset($_GET['ticket'])) {
		header("Location: https://webauth.arizona.edu/webauth/login?service=https://elvis.sunion.arizona.edu/intra/marketingform/backweb.php");
	}else {
		
		$tix = $_GET['ticket'];
		$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=https://elvis.sunion.arizona.edu/intra/marketingform/backweb.php"';
		exec("curl -m 120 $url " ,$return_message_array, $return_number);
		
	
		$netID = $return_message_array[2];
	
		$netID = trim(str_replace("<cas:user>","",str_replace("</cas:user>","", $netID)));
		$_SESSION['netID'] = $netID;
	}
}*/	
	
	 require('global.inc');
  $page_options['title'] = 'Union Marketing Request Form:';
  page_start($page_options);
	?>
	
    <div style="padding-left:20px;">
    <h4>Marketing Request Backweb</h4>
   <a href="backweblogin.php">[ BackWeb Login Page ]</a>
   <br /><br />
   
   <a href="https://webauth.arizona.edu/webauth/logout?logout_href=https://elvis.sunion.arizona.edu/intra/marketingform/backweblogin.php&logout_text=Return%20to%20Marketing%20Backweb">[ Log Out of WebAuth ]</a>
   <br /><br />
   <span style="font-size:14px">Thank You for Logging Out!</span>
   
   <?php 
	page_finish(); 

	?>