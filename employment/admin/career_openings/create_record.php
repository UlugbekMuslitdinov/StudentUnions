<?php
// This file will allow the admin to create a new career opening record.
echo '<h1>Create a New Career Opening</h1>';


// Connect to the database
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="Hockey25jh";
$dbname="su";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();
?>

<!--- Form with fields name, surname and position ---->
<form action="create_record.php" method="post">
<input type="text" name="name" placeholder="Name" required>
<input type="text" name="surname" placeholder="Surname" required>
<input type="text" name="position" placeholder="Position" required>
<input type="submit" value="Create Record">

<?php
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
        $current_time_for_db = date('Y-m-d H:i:s');
        $id = $con->insert_id;
        $query = "INSERT INTO `career_openings` (`name`, `surname`, `position`, `date_applied`) VALUES ('$name', '$surname', '$position', '$current_time_for_db')";
        $result = $con->query($query);

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

