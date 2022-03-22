<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo '<pre>';

//////////////////////////////////////////////////////

// namespace Function;

require  $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

// require "function/DB.php";
use Function\LaravelDB as DB;

$db = New LaravelDB;
$location = $db->table('location')->first();
var_dump($location);

// $db = New DB('localhost', 'su', 'root', '');
// $location = $db->table('catering')->first();
// var_dump($location);



echo 'let\'s test db';