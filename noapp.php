<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<meta name="robots" content="noindex, nofollow" />
<?php
  
  $message = "";
  
  // The following code block was added to tag emails with text that would be easy to filter in order to help keep down trash
  $isJunk = FALSE;
  $isJunk = (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER']==NULL || $_SERVER['HTTP_REFERER']=="");
  $ignoreContexts = array("www.google.com",
                      "http://www.arizona.edu/search/apachesolr_search/",
                      "http://www.uafamily.arizona.edu/resourcecenter.php");
  if (!$isJunk) {
    foreach ($ignoreContexts as $context) {
      $str = strtolower($_SERVER['HTTP_REFERER']);
      $content = strtolower($context);
      echo "<!--";
      var_dump($context);
      var_dump($_SERVER['HTTP_REFERER']);
      var_dump(strpos($_SERVER['HTTP_REFERER']),$context);
      echo "-->";
      if (strpos($_SERVER['HTTP_REFERER'],$context)) {
        $isJunk = TRUE;
      }
    }
  }
  // Disable this to test if working from our machines
  // This will lable the subnets of our machines as junk
  if (strpos("150.135.75",getenv("REMOTE_ADDR"))||strpos("150.135.72",getenv("REMOTE_ADDR"))) {
    $isJunk = TRUE;
  }
  if ($isJunk) {
    $message .= "\r\nTHIS MESSAGE IS FLAGGED TO LIKELY BE NOAPP JUNK\r\n\r\n";
  }
  
	$message .= "Unavailable Application Page Accessed (" . getenv("REQUEST_URI") . ") :\r\n"
				. "\r\nQuery : " . getenv("QUERY_STRING")
				. "\r\nReferer : " . getenv("REFERER")
				. "\r\nRemote Host : " . getenv("REMOTE_ADDR")
				. "\r\nUser Agent : " . getenv("HTTP_USER_AGENT")
				. "\r\nTime : " . date("D M j G:i:s T Y") . "\r\n"
        . "\r\nPrevious Visit : " . $_SERVER['HTTP_REFERER'] . "\r\n";
	mail("web@union.arizona.edu", "Unavailable Application", $message,
     "From: web@union.arizona.edu\r\n"
    ."Reply-To: web@union.arizona.edu\r\n"
    ."X-Mailer: PHP/" . phpversion());
    
    $appName = getenv("QUERY_STRING");
	
?>

<html>

	<head>
		<title>Oops.</title>
		<link href="/common/global.css" type="text/css" rel="stylesheet" media="all">
	</head>

	<body bgcolor="#ffffff">
		<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="16">
						<tr>
							<td bgcolor="white">
								<h2><img src="/common/images/oops.gif" alt="oops!" height="39" width="102" border="0"></h2>
                                <?php
                                		if (isset($appName) && $appName == "mealplans") { 
											/*print "<h1>The Mealplans Application is currently offline due to technical difficulties.  <br>
												It will be back online as quickly as possible.<br><br>
												We apologize for any inconvenience this outage may be causing.</h1><br>";*/
											print '<h2>The Meal Plans application has been moved to a new location.</h2><br />';
											print 'It is possible that you had bookmarked the old application. You can now access the Meal Plans application at <a href="https://union.arizona.edu/mealplans/">https://union.arizona.edu/mealplans/</a>.<br /><br />';
				              print 'If you are still experiencing problems, please email the <a href="mailto:web@www.union.arizona.edu">webmaster</a> with the link that you used to get here and we can get it fixed. We apologize for the inconvenience and thank you for your help.  Webmaster email: <a href="mailto:web@www.union.arizona.edu">web@www.union.arizona.edu</a>';
										}
                    else if (isset($appName) && $appName == "Catering") {
                      print '<h2>Catering is getting a new menu.</h2><br />';
                      print 'While we put the finishing touches on it, online orders will be unavailable. The new menu will be coming soon at <a href="https://union.arizona.edu/catering/">https://union.arizona.edu/catering/</a>.<br /><br />';
                      print 'If you are still experiencing problems, please email the <a href="mailto:web@www.union.arizona.edu">webmaster</a> with the link that you used to get here and we can get it fixed. We apologize for the inconvenience and thank you for your help.  Webmaster email: <a href="mailto:web@www.union.arizona.edu">web@www.union.arizona.edu</a>';
                    }
										else {
										
											print '<h2>The ';
                                            if (isset($appName) && $appName != "") { 
												print $appName; 
											} 
											print 'application is not available currently... stay tuned!</h2>';
											
											if (isset($appName) && $appName != "") {
                                            	print '<p><a href="/cgi-bin/WebObjects/' . $appName . '.woa/wa/default">Click here to try accessing the application again.</a></p>';
											}	
											
								?>
											<p>We may be updating the application and had to take it offline for a short period of time.</p>
											<p>Please try back in approximately an hour. If you still see this message, then email the 
                                            <a href="mailto:web@www.union.arizona.edu">webmaster</a> and give the link that you used to get here. 
                                            <a href="mailto:web@www.union.arizona.edu">web@www.union.arizona.edu</a></p>
								<?php		
										}
								?>
                                							
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>

</html>