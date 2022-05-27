<?php
// This file will allow the admin to create a new career opening record.

// Styles import
echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap.css'/>";
echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap-theme.css'/>";

// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');
$page_options['title'] = 'Career Openings';
page_start($page_options);

echo '<h1>Create a New Career Opening</h1>';
?>

<!--- Form with fields name, surname and position ---->
<form action="create_record.php" method="post">
    <input class="form-control" type="text" name="position" placeholder="Position" required>
    <input class="form-control" type="text" name="url" placeholder="URL" required>
    <input class="form-control" type="text" name="image_file" placeholder="ImageFile" required>
    <input class="form-control" type="text" name="retired" placeholder="Retired" required>
    <input class="form-control" type="submit" value="Create Record">
</form>
<?php
// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the data from the form
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $position = $_POST['position'];

    // Check if the name is empty
    if (empty($name)) {
        // Set an error message
        $error = 'Please enter the name of the applicant.';
    }
    // Check if the surname is empty
    elseif (empty($surname)) {
        // Set an error message
        $error = 'Please enter the surname of the applicant.';
    }
    // Check if the position is empty
    elseif (empty($position)) {
        // Set an error message
        $error = 'Please enter the position of the applicant.';
    }
    // Check if there are no errors
    elseif (!isset($error)) {
        // Insert the data into the database
        $query = "INSERT INTO `career_openings` (`position`, `url`, `image_file`, `retired`) VALUES ('$name', '$surname', '$position', '$current_time_for_db')";
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

