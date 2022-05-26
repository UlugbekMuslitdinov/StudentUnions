<?php

//DB connection
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
<!--Create new record in DB button-->
<a href="create_record.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create New Record
    </button></a>

<?php
// List all records from DB table
$sql = "SELECT * FROM career_openings";
$result = $con->query($sql);

// Loop thriugh every record and display it as HTML table row
    // Each row contains info about ID, name, surname, position and date_applied

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'><tr><th>ID</th><th>Name</th><th>Surname</th><th>Position</th><th>Date Applied</th><th>Action</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["surname"]. "</td><td>" . $row["position"]. "</td><td>" . $row["date_applied"]. "</td><td><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

