<html>
<head>
<title>Untitled Document</title>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?php 
date_default_timezone_set('America/Los_Angeles');

print(Date("F d, Y")); 

$ggong = "3/15/2009";
$ggong = date('m/d/Y, h:i A', strtotime($ggong));
print($ggong);
?>
</body>
</html>
