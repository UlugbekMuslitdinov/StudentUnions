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

echo "<h1>Career Openings Registration</h1>";
//<!--- Form with fields name, surname and position ---->
echo '<div style="width: 100%">';
echo '<form class="form" action="create_record.php" method="post">';
echo '<input class="form-control" type="text" name="position" placeholder="Position" required>';
echo '<input class="form-control" type="text" name="url" placeholder="URL" required>';
echo '<input class="form-control" type="text" name="image_file" placeholder="ImageFile" required>';
echo '<input class="form-control" type="text" name="retired" placeholder="Retired" required>';
echo '<input class="form-submit" type="submit" value="Create Record">';
echo '</form>';
echo '</div>';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the data from the form
    $position = $_POST['position'];
    $url = $_POST['url'];
    $image_file = $_POST['image_file'];
    $retired = $_POST['retired'];

    // Check if the position is empty
    if (empty($position)) {
        // Set an error message
        $error = 'Please enter the position of the applicant.';
    }
    // Check if the url is empty
    elseif (empty($url)) {
        // Set an error message
        $error = 'Please enter the url of the applicant.';
    }
    // Check if the image file is empty
    elseif (empty($image_file)) {
        // Set an error message
        $error = 'Please enter the image file of the applicant.';
    }
    // Check if the retired is empty
    elseif (empty($retired)) {
        // Set an error message
        $error = 'Please enter the retired of the applicant.';
    }
    // Check if there are no errors
    elseif (!isset($error)) {
        // Insert the data into the database
        $query = "INSERT INTO 'career_openings' ('position', 'url', 'image_file', 'retired') VALUES ('$position', '$url', '$image_file', '$retired')";
        $result = $db->query($query);

        // Check if the query was successful
        if ($result) {
            // Set a success message
            $success = 'The record has been added.';
        }
        else {
            // Set an error message
            $error = 'The record could not be added.';
        }
    }

}

