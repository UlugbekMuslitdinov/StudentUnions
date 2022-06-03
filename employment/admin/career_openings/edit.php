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
echo '<form action="edit.php?id=' . $career_opening_id . '" method="post">';
echo '<div class="form-group">';
echo '<label for="position">Position</label>';
echo '<input class="form-control" id="position" type="text" name="position" placeholder="Position" required value="'.$row['position'].'">';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="url">URL</label>';
echo '<input class="form-control" id="url" type="text" name="url" placeholder="URL" required value="'.$row['url'].'">';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="file_upload">Change Image</label> <br>';
echo '<img src="'."/employment/images/career_openings/".$row['image_file'].'" alt="'.$row['position'].'" style="width: 100px; height: 100px;">';
echo '<input class="form-control" id="file_upload" type="file" name="file_upload" placeholder="File Upload" required value="'.$row['file_upload'].'">';
echo '</div>';
echo '<div class="form-group">';
// Retired radio buttons with pre-filled Yes/No values
echo '<label for="retired">Retired</label>';
if ($row['retired'] == 'Yes') {
    echo '<div class="form-check">';
    echo '<label><input class="form-check-input" type="radio" name="retired" value="Yes" checked>Yes</label>';
    echo '</div>';
    echo '<div class="form-check">';
    echo '<label><input class="form-check-input" type="radio" name="retired" value="No">No</label>';
    echo '</div>';
} else {
    echo '<div class="form-check">';
    echo '<label><input class="form-check-input" type="radio" name="retired" value="Yes">Yes</label>';
    echo '</div>';
    echo '<div class="form-check">';
    echo '<label><input class="form-check-input" type="radio" name="retired" value="No" checked>No</label>';
    echo '</div>';
}
echo '</div>';
// Save changes button
echo '<button type="submit" name="submit" class="btn btn-block btn-red mb-3 gta-cta-header-buttons">Save Changes</button>';
echo '</div>';
echo '</form>';
echo '</div>';


// Process the form and upload image if submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $position = $_POST['position'];
    $url = $_POST['url'];
    $retired = $_POST['retired'];
    $file_upload = $_FILES['file_upload'];

    // Update the career opening information
    $query = "UPDATE career_openings SET position = '$position', url = '$url', retired = '$retired' WHERE id = $career_opening_id";
    $result = $db->query($query);
}


page_finish();