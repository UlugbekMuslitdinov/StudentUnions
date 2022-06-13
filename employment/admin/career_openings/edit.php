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
echo '<form class="form" action="edit.php?id=' . $career_opening_id . '" method="post" enctype="multipart/form-data">';
echo '<div class="form-group">';
echo '<label for="position" style="font-weight: bold">Position</label>';
echo '<input class="form-control" type="text" name="position" placeholder="Position" required value="'.$row['position'].'">';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="url" style="font-weight: bold">URL</label>';
echo '<input class="form-control" type="text" name="url" placeholder="URL" required value="'.$row['url'].'">';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="fileToUpload" style="font-weight: bold">Change Image</label> <br>';
echo '<img src="'."/employment/images/career_openings/".$row['image_file'].'" alt="Career Opening Image" style="width:100px;">';
echo '<input class="form-control" type="file" name="ImageUpload" value="Upload File" />';
echo '</div>';
// Retired dropdown field with prepopulated value and Yes/No options
//echo '<input type="radio" class="form-control" name="retired" required>';
echo '<label for="fileToUpload" style="font-weight: bold">Retired</label>';
echo '<div class="form-group" style="display: flex">';
echo '<div class="form-check">';
if ($row['retired'] == 'Yes') {
    echo '<input type="radio" name="retired" value="Yes" style="font-weight: bold" checked>Yes</input>';
    echo '</div>';
    echo '<div class="form-check">';
    echo '<input type="radio" name="retired" value="No" style="font-weight: bold">No</input>';
} else {
    echo '<input type="radio" name="retired" value="Yes" style="font-weight: bold">Yes</input>';
    echo '</div>';
    echo '<div class="form-check">';
    echo '<input type="radio" name="retired" value="No" style="font-weight: bold" checked>No</input>';
}
echo '</div>';
echo '</div>';
echo '<input class="form-submit" type="submit" value="Edit Record" name="submit">';
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
	// $current_img = $row['image_file'];
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/employment/images/career_openings/";
    if (!empty($_FILES['ImageUpload']['name'])) {
        $current_img = basename($_FILES["ImageUpload"]["name"]);
		$target_file = $target_dir . basename($_FILES["ImageUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
          $check = getimagesize($_FILES["ImageUpload"]["tmp_name"]);
			// print_r($check);
			// exit();
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
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
            if (move_uploaded_file($_FILES["ImageUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["ImageUpload"]["name"]) . " has been uploaded.";
                $current_img = basename($_FILES["ImageUpload"]["name"]);
				// Update image.
				$query = "UPDATE career_openings SET image_file='$current_img' WHERE id=$career_opening_id";
    			$result = mysqli_query($db, $query);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } 
    echo $current_img;
    echo 'Image name should be here';
    // Update the database with the new values
    $query = "UPDATE career_openings SET position='$position', url='$url', retired='$retired' WHERE id=$career_opening_id";
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
	
	// Redirect to the main page.
	echo "<script>window.location.href='/employment/admin/career_openings/';</script>";
}
page_finish();
?>