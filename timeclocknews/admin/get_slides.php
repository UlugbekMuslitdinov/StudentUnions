<?php

$strJsonFileContents = file_get_contents("../slides/order.json");
// Convert to array 
$images = json_decode($strJsonFileContents, true);

echo json_encode($images);

?>