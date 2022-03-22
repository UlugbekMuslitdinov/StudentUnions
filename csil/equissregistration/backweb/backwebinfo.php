<?php
require_once('password_protect.php');

$id = intval($_GET['id']);
if (!isset($id))
	redirect($_SERVER['HTTP_REFERER']);

require_once('page_start.php');

echo get_info($id);

// Delete
echo "<p><a href=\"backwebdelete.php?id=$id\">Delete this registration</a></p>";

include_once("page_end.php");
?>