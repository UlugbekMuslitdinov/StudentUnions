<?php
/*
 * Staff Directory
 * Created April, 2010
 */

if (!defined('ACCESS'))
{
	die('Hacking Attempt');
}

// Database
require_once ('includes/mysqli.inc');
$db = new db_mysqli('unionstaffdirectory');


// Authentication list
$admin = array('harrisoj', 'yontaek','brandy', 'eotkank87', 'brandyh', 'abw2', 'aecheveste');

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

// Redirect
function redirect($location)
{
	header('Location: ' . $location);
	exit;
}

// Sanitize for queries
function clean_string($array)
{
  global $db;

	if (is_array($array))
	{
		foreach ($array as $key => $value)
		{
			$array[$key] = (is_array($value)) ? clean_string($value) : $db->escape(trim($value));
		}
	}
	else
	{
		$array = $db->escape(trim($array));
	}

	return $array;
}

// Print errors
function print_errors($errors)
{
	if (is_array($errors))
	{
		foreach ($errors as $error)
		{
			echo '<div class="error">' . $error . '</div>';
		}
	}
}

// Format name
function format_name($first, $last)
{
	$names = array();
	$names[] = (!empty($last)) ? $last : '';
	$names[] = (!empty($first) && $last != $first) ? $first : '';

	return implode(', ', array_filter($names));
}

$sorts = array(
	'lastname' => 'Last Name',
	'firstname' => 'First Name',
	'department' => 'Department'
);

// Get GETs
$get_p = isset($_GET['p']) ? $_GET['p'] : '';
$get_id = isset($_GET['id']) ? $_GET['id'] : '';
$get_firstname = isset($_GET['firstname']) ? $_GET['firstname'] : '';
$get_lastname = isset($_GET['lastname']) ? $_GET['lastname'] : '';
$get_sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Initialize
$file = $_SERVER['PHP_SELF'];
$page = (preg_match("#^[a-z0-9_-]+$#is", $get_p)) ? $get_p : '';
$id = (isset($get_id)) ? intval($get_id) : intval($get_id);

$firstname = strip_tags($get_firstname);
$lastname = strip_tags($get_lastname);
$sort = (in_array($get_sort, array_keys($sorts))) ? $get_sort : '';
?>
