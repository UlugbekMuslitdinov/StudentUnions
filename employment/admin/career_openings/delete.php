<?php
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');
$page_options['title'] = 'Career Openings Registration';
page_start($page_options);

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

echo "<div>";
echo "<h1>Delete Career Openings</h1>";


$id = $_GET['id'];


$query = "DELETE FROM career_openings WHERE id = '$id'";
$result = $db->query($query);

echo "<p>Career Opening Deleted Successfully</p>";
echo "<p><a href='/employment/admin/career_openings/'>Return to Career Openings</a></p>";
echo "</div>";

page_finish();

// Redirect to the main page
header("Location: /employment/admin/career_openings/");