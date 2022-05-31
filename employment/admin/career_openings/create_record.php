<?php
// This file will allow the admin to create a new career opening record.

// Styles import
//echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap.css'/>";
//echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap-theme.css'/>";

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

echo "<h1>ADD Career Openings</h1>";
//<!--- Form with fields name, surname and position ---->
echo '<div style="width: 100%">';
echo '<form class="form" action="create_record.php" method="post">';
echo '<input class="form-control" type="text" name="position" placeholder="Position" required>';
echo '<input class="form-control" type="text" name="url" placeholder="URL" required>';
echo '<input class="form-control" type="file" name="file" value="Upload File" required />';
echo '<input class="form-submit" type="submit" value="Create Record">';
echo '</form>';
echo '</div>';

// If the form has been submitted, insert the record into the database.
if (isset($_POST['position'])) {
    $position = $_POST['position'];
    $url = $_POST['url'];
    $image_name = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/employment/images/career_openings/';
    $retired = $_POST['retired'];
    $query = "INSERT INTO career_openings (position, url, image_file, retired) VALUES ('$position', '$url', '$image_name', '$retired')";
    $result = $db->query($query);
    move_uploaded_file($temp_name, $folder);
    if (!$result) {
        echo '<p>Error inserting record into database!</p>';
    } else {
        echo '<p>Record inserted successfully!</p>';
    }
}
echo '<p><a href="index.php">Back to main page</a></p>';
page_finish();
