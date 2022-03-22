<?php

// set the maximum number of items for each of the four dish categories
// NOTE: reducing these numbers without first ensuring the item totals in the DB are <= the new total(s) here, will cause problems
// this functionality should probably be improved in a future version if the tool succeeds
// $maxGrains = 6; // grains
// $maxSalads = 6; // vegetarian
// $maxEntrees = 6; // entrees
// $maxSides = 6; // veg/fruit
$maxVeg = 3;
$maxNoodle = 0;
$maxInternational = 0;
$maxCarving = 0;
$maxAmerican = 7;
$maxOmelet = 3;
$maxGriddle = 1;
$maxPizza = 0;
$maxSandwich = 0;
$maxSoup = 0;

$bk = array(
    'Veg Centric' => 5,
    'International' => 5,
    'Butcher Block' => 5,
    'Hot Line' => 8,
    'Pasta Bar' => 5,
    'Salad Bar' => 5,
    'Omelet Station' => 5,
    'Pizza Station' => 5,
    'Grill/Sandwich' => 5,
);

$br = array(
    'Veg Centric' => 5,
    'International' => 5,
    'Butcher Block' => 5,
    'Hot Line' => 8,
    'Pasta Bar' => 5,
    'Salad Bar' => 5,
    'Omelet Station' => 5,
    'Pizza Station' => 5,
    'Grill/Sandwich' => 5,
    'Carving' => 5,
);

$lunch = array(
    'Veg Centric' => 5,
    'International' => 5,
    'Butcher Block' => 5,
    'Hot Line' => 8,
    'Pasta Bar' => 5,
    'Salad Bar' => 5,
    'Omelet Station' => 5,
    'Pizza Station' => 5,
    'Grill/Sandwich' => 5,
);

$dinner = array(
    'Veg Centric' => 6,
    'International' => 5,
    'Butcher Block' => 5,
    'Hot Line' => 8,
    'Pasta Bar' => 5,
    'Salad Bar' => 5,
    'Omelet Station' => 5,
    'Pizza Station' => 5,
    'Grill/Sandwich' => 5,
);

// set the ID for the various dish types
// $grains = 1; // grains
// $salads = 2; // vegetarian
// $entrees = 3; // entrees
// $sides = 4; // veg/fruit
$veg = 1;
$noodle = 2;
$international = 3;
$carving = 4;
$american = 5;
$pizza = 6;
$sandwich = 7;
$soup = 8;
$omelet = 9;
$griddle = 10;
?>