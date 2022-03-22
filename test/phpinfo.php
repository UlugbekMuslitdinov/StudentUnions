<html>
<head>
<title>Php Info</title>
</head>
<?php
date_default_timezone_set('America/Los_Angeles');
//
//$script_tz = date_default_timezone_get();
//
//if (strcmp($script_tz, ini_get('date.timezone'))){
//    echo 'Script timezone differs from ini-set timezone.';
//} else {
//    echo 'Script timezone and ini-set timezone match.';
//}
?> 
<body bgcolor="#FFFFFF" text="#000000">
<?php phpinfo(); ?> 
</body>
</html>
