<?php
$new_list = file_get_contents('php://input');
$order_path = "../slides/order.json";

// write new list to file
$slides_file = fopen($order_path, "w");
fwrite($slides_file, $new_list);
fclose($slides_file);

echo $new_list;
?>