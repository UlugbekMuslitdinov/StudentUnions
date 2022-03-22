<?php


$servername = "mysql_host";
$username = "web";
$password = "viv3nij";
$dbname = "su";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




?>