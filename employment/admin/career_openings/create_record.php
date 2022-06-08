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
echo '<form class="form" action="create_record.php" method="post" enctype="multipart/form-data">';
echo '<input class="form-control" type="text" name="position" placeholder="Position" required>';
echo '<input class="form-control" type="text" name="url" placeholder="URL" required>';
echo '<input class="form-control" id="fileToUpload" type="file" name="file" value="Upload File" required />';
echo '<input class="form-submit" type="submit" value="Create Record" name="submit">';
echo '</form>';
echo '</div>';

// If the form has been submitted, insert the record into the database.
if (isset($_POST['position'])) {
    $position = $_POST['position'];
    $url = $_POST['url'];
    $retired = "No";

    // Image upload
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/employment/images/career_openings/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $query = "INSERT INTO career_openings (position, url, image_file, retired) VALUES ('$position', '$url', '$file_name', '$retired')";
    $result = $db->query($query);
    if (!$result) {
        echo '<p>Error inserting record into database!</p>';
    } else {
        echo '<p>Record inserted successfully!</p>';
        header('Location: https://su-wdevtest.union.arizona.edu/employment/admin/career_openings/index.php');
        exit();
    }

    // Redirect to the main page
    ob_start();
    header('Location: https://su-wdevtest.union.arizona.edu/employment/admin/career_openings/index.php');
    ob_end_flush();
    die();
}
echo '<p><a href="index.php">Back to main page</a></p>';
page_finish();
