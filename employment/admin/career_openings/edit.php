<?php
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');
$page_options['title'] = 'Career Openings Edit';
page_start($page_options);

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
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
echo '<form class="form" action="edit.php" method="post">';
echo '<input class="form-control" type="text" name="position" placeholder="Position" required value="'.$row['position'].'">';
echo '<input class="form-control" type="text" name="url" placeholder="URL" required value="'.$row['url'].'">';
echo '<input class="form-control" type="file" name="file" value="Upload File" required value="'.$row['file'].'">';
// Retired dropdown field with prepopulated value and Yes/No options
echo '<select class="form-control" name="retired" required>';
if ($row['retired'] == 'Yes') {
    echo '<option value="Yes" selected>Yes</option>';
    echo '<option value="No">No</option>';
} else {
    echo '<option value="Yes">Yes</option>';
    echo '<option value="No" selected>No</option>';
}
echo '<input class="form-submit" type="submit" value="Edit Record">';
echo '</form>';
echo '</div>';


// Process the form if submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $position = $_POST['position'];
    $url = $_POST['url'];
//    $file = $_POST['file'];
    $retired = $_POST['retired'];

    // Update the database
    $query = "UPDATE career_openings SET position = '$position', url = '$url', retired = '$retired' WHERE id = $career_opening_id";
    $result = $db->query($query);

    // Redirect to the careers page
//    header("Location: /employment/admin/career_openings/");
}

page_finish();