<?php

// set the maximum number of items for each of the four dish categories
// NOTE: reducing these numbers without first ensuring the item totals in the DB are <= the new total(s) here, will cause problems
// this functionality should probably be improved in a future version if the tool succeeds
$maxSoups = 4;
$maxSalads = 4;
$maxEntrees = 8;
$maxSides = 8;

// set the ID for the various dish types
$soups = 1;
$salads = 2;
$entrees = 3;
$sides = 4;

?>