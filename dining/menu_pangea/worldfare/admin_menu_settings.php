<?php

// set the maximum number of items for each of the four dish categories
// NOTE: reducing these numbers without first ensuring the item totals in the DB are <= the new total(s) here, will cause problems
// this functionality should probably be improved in a future version if the tool succeeds
$maxGrains = 6; // grains
$maxSalads = 6; // vegetarian
$maxEntrees = 6; // entrees
$maxSides = 6; // veg/fruit

// set the ID for the various dish types
$grains = 1; // grains
$salads = 2; // vegetarian
$entrees = 3; // entrees
$sides = 4; // veg/fruit

?>