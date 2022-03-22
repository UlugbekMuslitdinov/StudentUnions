<?php

// set the maximum number of items for each of the four dish categories
// NOTE: reducing these numbers without first ensuring the item totals in the DB are <= the new total(s) here, will cause problems
// this functionality should probably be improved in a future version if the tool succeeds
$maxFirstCourse = 1;
$maxEntrees = 7;
$maxDesserts = 1;

// set the ID for the various dish types
$firstCourses = 1;
$entrees = 2;
$desserts = 3;

// current date
$today = date("Y-m-d", time());

?>