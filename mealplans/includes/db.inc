<?php

function db_connect($host = NULL, $user = 'web', $pass = 'viv3nij'){
	
	// require('/Library/WebServer/commontools/mysql_activeserver.inc');
	require($_SERVER['DOCUMENT_ROOT'].'/commontools/db/mysql_activeserver.inc');
	$activeServers = array('mysql_host', 'mysql_host2');
	
	if($host == NULL || $host == '')
		$host = $activeServers[$active_server];

	

	$link = mysql_connect($host, $user, $pass);
	
	if($link){
		return $link;
	}
	
	else if($host==$activeServers[$active_server]){
		db_connect_error($host, false);
		$link = mysql_connect( $activeServers[++$active_server], $user, $pass);
		
		if($link){
			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/commontools/db/mysql_activeserver.inc', '<?php $active_server='.$active_server.'; ?>');
			return $link;
		}
		else{
			db_connect_error($host, true);
		}
	}
	
	else
		db_connect_error($host, true);
}
 

function email_error($error, $critical = 0){

	define("CRITICAL_EMAIL", "su-web@email.arizona.edu");
	define("NONCRITICAL_EMAIL", "su-web@email.arizona.edu");
	
	// require_once('/Library/WebServer/commontools/phplib/mimemail/htmlMimeMail5.php');
	require_once('phplib/mimemail/htmlMimeMail5.php');
	
	$mail = new htmlMimeMail5();

    $mail->setFrom('Trinity.sunion.arizona.edu<no-reply@email.arizona.edu>');
    
    $mail->setSubject('Meal Plans Database Error');
    
    ob_start();
    var_dump($_SESSION);
    $sessions = ob_get_clean();
    $sessions = str_replace(' ', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $sessions);    
    $sessions = str_replace(chr(10), '<br />', $sessions);    
    $mail->setHTML($error.'<br /><br />'.$sessions);
    
	if($critical)
	    $result  = $mail->send(array(CRITICAL_EMAIL));
	else
		 $result  = $mail->send(array(NONCRITICAL_EMAIL));
}

function db_connect_error($host, $die){
	// file_put_contents ( "/Library/WebServer/commontools/mysql_error.inc" , date(DATE_RSS)." Error connecting to ".$host.": ".mysql_error().' - '.$_SERVER['PHP_SELF'].chr(10), FILE_APPEND );
	email_error(date(DATE_RSS)." Error connecting to ".$host.": ".mysql_error().' - '.$_SERVER['PHP_SELF'], 1);
	if($die)
		die("Could not connect to database.");
}

function db_select_error($db){
	// file_put_contents ( "/Library/WebServer/commontools/mysql_error.inc" , date(DATE_RSS)." Error selecting ".$db.": ".mysql_error().' - '.$_SERVER['PHP_SELF'].chr(10), FILE_APPEND );
	email_error(date(DATE_RSS)." Error selecting ".$db.": ".mysql_error().' - '.$_SERVER['PHP_SELF']);
	die("Could not select database.");
}

function db_query_error($query){
	// file_put_contents ( "/Library/WebServer/commontools/mysql_error.inc" , date(DATE_RSS)." Error executiong ".$query.": ".mysql_error().' - '.$_SERVER['PHP_SELF'].chr(10), FILE_APPEND );
	email_error(date(DATE_RSS)." Error executiong ".$query.": ".mysql_error().' - '.$_SERVER['PHP_SELF']);
	die("Database query failed.");
}


function db_select($db){
	if(mysql_select_db($db))
		return true;
	else	
		db_select_error($db);		
}

function db_query($query){
	$result =  mysql_query($query);
	if($result)
		return $result;
	else
		db_query_error($query);
}

?>
