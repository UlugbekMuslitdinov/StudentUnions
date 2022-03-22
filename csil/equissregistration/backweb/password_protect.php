<?php
// Force WWW for webauth
if (!strstr($_SERVER['HTTP_HOST'], 'styx') && !strstr($_SERVER['HTTP_HOST'], 'sutest') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
{
	redirect('http://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
}

// Authorization list
$admin = array('styx', 'sanorris', 'crs', 'cnunger');

//
// Functions
//

// Authenticate
function start_webauth($auth)
{
	// Start session
	session_start();

	// Authenticate with WebAuth
	require_once('webauth/include.php');

	// Authentication list
	if (!in_array($_SESSION['webauth']['netID'], $auth))
	{
		session_destroy();
		die('You are not authorized to access this page.');
	}
}

// Authenticate
start_webauth($admin);
?>