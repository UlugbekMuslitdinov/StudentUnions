<?php
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');
$page_options['title'] = 'Career Openings Edit';
page_start($page_options);

// Database connection
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

echo "<h1>Edit Career Openings</h1>";

// Get the ID of the career opening to edit
$career_opening_id = $_GET['id'];


// Get the career opening information
$query = "SELECT * FROM career_openings WHERE id = $career_opening_id";
$result = $db->query($query);
$row = $result->fetch_assoc();


//<!--- Form to edit with prepopulated fields -->
echo '<div style="width: 100%">';
echo '<form class="form" action="edit.php?id=' . $career_opening_id . '" method="post">';
echo '<input class="form-control" type="text" name="position" placeholder="Position" required value="'.$row['position'].'">';
echo '<input class="form-control" type="text" name="url" placeholder="URL" required value="'.$row['url'].'">';
echo '<input class="form-control" id="fileToUpload" type="file" name="file" value="Upload File" required />';
// Retired dropdown field with prepopulated value and Yes/No options
echo '<select class="form-control" name="retired" required>';
if ($row['retired'] == 'Yes') {
    echo '<option value="Yes" selected>Yes</option>';
    echo '<option value="No">No</option>';
} else {
    echo '<option value="Yes">Yes</option>';
    echo '<option value="No" selected>No</option>';
}
echo '<input class="form-submit" type="submit" value="Create Record" name="submit">';
echo '</form>';
echo '</div>';

// Process the form and upload image if submitted
if (isset($_POST['submit'])) {
    // Get the values from the form
    $position = $_POST['position'];
    $url = $_POST['url'];
    $retired = $_POST['retired'];
    $timestamp = $row['timestamp'];

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
            echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update the database with the new values
    $query = "UPDATE career_openings SET position='$position', url='$url', retired='$retired', image_file='$file_name' WHERE id=$career_opening_id";
    $result = mysqli_query($db, $query);
    if ($result) {
        echo '<div class="alert alert-success">';
        echo '<strong>Success!</strong> The record has been updated.';
        echo '</div>';
    } else {
        echo '<div class="alert alert-danger">';
        echo '<strong>Error!</strong> The record could not be updated.';
        echo '</div>';
    }
}

page_finish();