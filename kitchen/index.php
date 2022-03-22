<?php
header("Location: /");
die();

$pageSetting['style'] = ['customer_info.css', 'event.css'];
$pageSetting['script'] = ['customer_info.js'];
$pageSetting['header'] = 'Catering Online Order';

$events = 'view/events.view.php';
$services = 'view/services.view.php';
$progress = 'view/progress.view.php';

$page_content = 'view/content.view.php';


include_once('view/master.view.php');