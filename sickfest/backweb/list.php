<?php
session_start();
if (!isset($_SESSION['sickfest_backweb_user'])) {
	header("Location: index.php");
	exit;
}
require('mysql_link.inc');
if (!$DBlink) {
	$error=TRUE;
	die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 1)<br />" . mysql_error()) . "</p>";
}
$DBselected = mysql_select_db("sickfest", $DBlink);
if (!$DBselected) {
	$error=TRUE;
	die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)<br />" . mysql_error()) . "</p>";
}
$query = 'SELECT (sum(num_student)+sum(num_general)) AS total_sold FROM purchase;';
$result = mysql_query($query, $DBlink);
if (!$result) {
	$error=TRUE;
	die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 3)<br />" . mysql_error()) . "</p>";
}
else {
	$tickets = mysql_fetch_assoc($result);
	$tickets = $tickets['total_sold'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SICKFEST Backweb</title>
<link rel="stylesheet" type="text/css" href="backwebstyle.css" />
</head>
<body>
<div style="width:100%;float:left;">
  <div style="float:left;">
    <h1>SICKFEST Purchases</h1>
  </div>
  <div style="float:right; text-align:right;">
  	<p><a href="index.php">Backweb Home</a> | <a href="search.php">Search For Purchase</a> | <a href="add.php">Add New Purchase</a> | <a href="index.php?action=logout">logout</a></p>
  	<?php
		echo "<p>Total Tickets Sold: ".$tickets."</p>";
	?>
    <p></p>
  </div>
</div>
<div style="width:100%;float:left;">
<table cellpadding="0" cellspacing="0">
  <tr style="font-weight:bold; text-align:left;" valign="bottom">
  	<td width="110px">Confirmation Number</td>
    <td width="240px">Name</td>
    <td width="300px">E-mail</td>
    <td width="80px">Student Tickets</td>
    <td width="110px">General Admissions Tickets</td>
    <td width="70px">Total</td>
  </tr>
  <?php
	$query = 'SELECT first_name,last_name,id,num_student,num_general,total,email FROM purchase ORDER BY id;';
	$result = mysql_query($query, $DBlink);
	if (!$result) {
		$error=TRUE;
		die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 3)<br />" . mysql_error()) . "</p>";
	}
	else {
		$everyother=0;
		while ($cur=mysql_fetch_assoc($result)) {
			if ($everyother%2==0) {
				$rowcolor = "#CCCCCC";
			}
			else {
				$rowcolor = "#FFFFFF";
			}
			echo '
			<tr style="font-weight:normal; text-align:left;" valign="center" bgcolor="'.$rowcolor.'">
			  <td>100'.$cur['id'].'</td>
			  <td>'.$cur['last_name'].', '.$cur['first_name'].'</td>
			  <td>'.$cur['email'].'</td>
			  <td>'.$cur['num_student'].'</td>
			  <td>'.$cur['num_general'].'</td>
			  <td>'.$cur['total'].'</td>
			</tr>
			';
			$everyother++;
		}
	}
  ?>
</table>
</div>
</body>
</html>