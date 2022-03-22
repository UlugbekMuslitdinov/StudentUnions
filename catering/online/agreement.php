<?php
include_once('function/main.function.php');

// Record time
$date = new DateTime();
$_SESSION['catering']['time'] = $date->getTimestamp();



// Check restaurant name in url parameter
$_SESSION['catering']['restaurant'] = '';
if (isset($_GET['r']))
{
	if ($_GET['r']!='')
	{
		$_SESSION['catering']['restaurant'] = $_GET['r'];
	}
}
else {
	$_SESSION['catering']['restaurant'] = 'highland';
}

// checkStatusSession('agreement');


/*
 *
 *  PAGE SETTING
 *
 */
$pageSetting['style'] = [
	"agreement.css"
];
$pageSetting['script'] = ["agreement.js"];
$pageSetting['header'] = 'Catering Online Order';

$content = 'view/agreement.view.php';

include_once('view/master.view.php');