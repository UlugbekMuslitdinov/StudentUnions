<?php
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
?>
<!--Create new record in DB button-->
<h4><a href="create_record.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create New Record
    </button></a></h4>

<?php
// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

// List all records from DB table
$sql = "SELECT * FROM career_openings";
$result = $db->query($sql);

// Loop thriugh every record and display it as HTML table row
// Each row contains info about ID, name, surname, position and date_applied


echo "<table class='table'><thead class='thead-dark'><tr><th><h4>ID</h4></th><th><h4>Position</h4></th><th><h4>URL</h4></th><th><h4>Image File</h4></th><th><h4>Retired</h4></th><th><h4>Timestamp</h4></th><th><h4>Action</h4></th></tr></thead><tbody>";
// output data of each row
while($row = $result->fetch_assoc()) {
    echo "<tr><td><h4>" . $row["id"]. "</h4></td><td><h4>" . $row["position"]. "</h4></td><td><h4>" . $row["url"]. "</h4></td><td><h4>" . $row["image_file"]. "</h4></td><td><h4>" . $row["retired"]. "</h4></td><td><h4>" . $row["timestamp"]. "</h4></td><td><h4><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></h4></td></tr>";
}
echo "</tbody></table>";

page_finish();
