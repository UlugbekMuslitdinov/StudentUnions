<?php

// include_once('temp_db.class.php');

session_start();

$_SESSION['id'] = $_POST['id'];
$id = $_SESSION['id'];
$_SESSION['catering_id'] = $_POST['id'];
$id = 222;
/*

$db = new Db();

// $id = $db->quote($_SESSION['id']);
echo '<p>' . $id . '</p>';

$order_info = $db -> select("SELECT * FROM `catering` WHERE id=" . $id);
echo 'Here homie: ' . $order_info['location'];

$food = $db -> select("SELECT * FROM `catering_highland` WHERE catering_id=(`id`)");

$burritos = $db -> select("SELECT * FROM `catering_highland_burrito` WHERE catering_id=(`id`)");

include 'resultTest.php';
*/

$servername = "localhost";
//$username = "root";
//$password = "Kampoopoo889";
//$username = "web";
//$password = "viv3nij";
$username = "dbadmin";
$password = "freak0fnatur3";
$dbname = "su";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// initial order info from the table "catering"
$sql = "SELECT * FROM catering WHERE id=" . $id;
$result = $conn->query($sql);
if(!$result){
    echo "<p>Error occured</p>";
}
$order_info = $result->fetch_assoc();
print($order_info['customer_name']);

// retrieve food details from table catering_highland
//$sql = "SELECT * FROM catering_highland WHERE catering_id=" . $id;
//$result = $conn->query($sql);
//$food_info = $result->fetch_assoc();
//
//$numberOf12Packs = $food_info['burrito_12'];
//$numberOf8Packs = $food_info['burrito_8'];
//
//
//// retrieve burrito details from catering_highland_burrito
//$sql = "SELECT * FROM catering_highland_burrito WHERE pack=12 AND catering_id=" . $id;
//$twelve_pack_result = $conn->query($sql);
//// $twelve_packs = $result->fetch_assoc();
//
//// retrieve burrito details from catering_highland_burrito
//$sql = "SELECT * FROM catering_highland_burrito WHERE pack=8 AND catering_id=" . $id;
//$eight_pack_result = $conn->query($sql);
//// $eight_packs = $result->fetch_assoc();

$conn->close();

//include 'temp3.php';


?>