<?php

$input = json_decode(file_get_contents('php://input'), true);
$delete_file_name = $input['name'];
$order_path = "../slides/order.json";

// Get the contents of the JSON file
$strJsonFileContents = file_get_contents($order_path);
// Convert to array 
$slides = json_decode($strJsonFileContents, true);
$new_slides = [];

foreach($slides as $slide) {
    if($delete_file_name != $slide['name']) {
        $slide['id'] = count($new_slides);
        $new_slides[] = $slide;
    } else {
        unlink('../slides/' . $delete_file_name);
    }
}

$slides_file = fopen($order_path, "w");
fwrite($slides_file, json_encode($new_slides));
fclose($slides_file);

echo json_encode($new_slides);

?>