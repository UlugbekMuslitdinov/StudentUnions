<?php
/*
 * NCLC Registration
 * Created October, 2009
 */

// Force WWW for webauth
if (!strstr($_SERVER['HTTP_HOST'], 'jsosa') && !strstr($_SERVER['HTTP_HOST'], 'elvis.sunion') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
{
	header('Location: http://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	exit;
}

define('ACCESS', true);
include('../include.php');

// Authenticate
start_webauth($admin);

// Excel
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=nclc.xls");
header("Pragma: no-cache");
header("Expires: 0"); 

echo "firstname\tlastname\temail\tphone\tschool\tmeals\tsandwiches\tshirts\tpaid\tpaytype\tpayid\n";

$sql = "select firstname, lastname, email, phone, school, schooletc, meal, mealetc, sandwich, shirt, paid, paytype, payid from guests where attend = 1";
$result = mysql_query($sql) or die(mysql_error());
while ($row = mysql_fetch_assoc($result))
{
	foreach ($row as $key => $value)
	{
		$$key = $value;
	}
	
	echo "$firstname\t$lastname\t$email\t$phone\t{$schools[$school]} $schooletc\t{$meals[$meal]} $mealetc\t{$sandwiches[$sandwich]}\t{$shirts[$shirt]}\t{$options[$paid]}\t$paytype\t$payid\n";
}
?>