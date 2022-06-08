<?php
echo "<link rel='stylesheet' src='".$_SERVER["DOCUMENT_ROOT"]."/employment/admin/bootstrap/css/bootstrap.css"."'>";

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
$id = $_GET['id'];

echo "<div>";
echo "<h1>Delete Career Openings</h1>";



if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM career_openings WHERE id = '$id'";
    $result = $db->query($query);
    if ($result) {
        echo "<p>Career opening deleted.</p>";
    } else {
        echo "<p>Career opening not deleted.</p>";
    }
} else {
    echo "<h4>Are you sure you want to delete this career opening?</h4>";
    echo "<form action='delete.php' method='post'>";
    echo "<input type='hidden' name='id' value='$id' />";
    echo "<button name='submit' class='btn btn-danger'>Yes</button>";
    echo "</form>";
}

echo "<p><a href='/employment/admin/career_openings/'>Return to Career Openings</a></p>";
echo "</div>";

page_finish();

// Redirect to the main page
header("Location: /employment/admin/career_openings/");