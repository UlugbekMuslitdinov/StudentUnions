<?php
// Styles import
echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap.css'/>";
echo "<link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap-theme.css'/>";

// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');
$page_options['title'] = 'Manage Career Openings';
page_start($page_options);
?>

<div>
<h1>Manage Career Openings</h1><br/>
<!--Create new record in DB button-->
<h4><a href="create_record.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Create New Record
    </button></a></h4>
</div>

<?php
// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

// List all records from DB table and sort by retired and position
$sql = "SELECT * FROM career_openings ORDER BY retired, position";
$result = $db->query($sql);

// Loop thriugh every record and display it as HTML table row
// Each row contains info about ID, name, surname, position and date_applied

// Show only first 38 symbols and then ... of url if url is longer
function shorten_url($url) {
    if (strlen($url) > 38) {
        $url = substr($url, 0, 38) . "...";
    }
    return $url;
}


echo "<table class='table'><thead class='thead-dark'><tr><th><h4>Position</h4></th><th><h4>URL</h4></th><th><h4>Image File</h4></th><th><h4>Retired</h4></th><th><h4>Action</h4></th></tr></thead><tbody>";
// output data of each row
while($row = $result->fetch_assoc()) {
    if ($row["retired"] == "Yes") {
        // If record is retired, display it in lightgray color
        $color = "lightgray";
    } else {
        $color = "white";
    }
    echo "<tr bgcolor='" . $color . "'><td><h4>" . $row["position"]. "</h4></td><td><h4><a href='" . $row["url"] . "' target='blank'>" . shorten_url($row["url"]). "</a></h4></td><td><img src='". "/employment/images/career_openings/" . $row["image_file"]. "' style='width:100px'/><br><p>" . $row["image_file"] . "</p></td><td><h4>" . $row["retired"]. "</h4></td><td><h4><a href='edit.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete.php?id=" . $row["id"] . "'>Delete</a></h4></td></tr>";
}
echo "</tbody></table>";

page_finish();
