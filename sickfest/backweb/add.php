<?
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
	$maxsell = 350;
	if ($tickets>=$maxsell) {
		echo '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>SICKFEST Backweb</title>
		<link rel="stylesheet" type="text/css" href="backwebstyle.css" />
		</head>
		<body>
		<h1 style="color:#CC0000;">SOLD OUT</h1>
		</body>
		</html>
		';
		die;
	}
}

if (isset($_POST['add'])) {
	$adderror = FALSE;
	$fields = array("first_name","last_name","email");
	foreach ($fields as $cur) {
		if (!isset($_POST[$cur])||$_POST[$cur]==NULL||$_POST[$cur]=="")  {
			$adderror = TRUE;
		}
	}
	$ticketsPurchased = 0;
	if (isset($_POST['num_student'])&&$_POST['num_student']>=1) {
		$ticketsPurchased += $_POST['num_student'];
	}
	else {
		$_POST['num_student'] = 0;
	}
	if (isset($_POST['num_general'])&&$_POST['num_general']>=1) {
		$ticketsPurchased += $_POST['num_general'];
	}
	else {
		$_POST['num_general'] = 0;
	}
	if ($ticketsPurchased==0) {
		$adderror = TRUE;
	}
	$stuPrice = 10;
	$genPrice = 20;
	$total = $stuPrice*$_POST['num_student'] + $genPrice*$_POST['num_general'];
	if ($adderror) {
		unset($_POST);
	}
	else {
	  $query = 'INSERT INTO purchase SET'
				  . ' first_name = "'			. $_POST['first_name']
				  . '", last_name = "'			. $_POST['last_name']
				  . '", email = "'				. $_POST['email']
				  . '", num_student = '			. $_POST['num_student']
				  . ', num_general = '			. $_POST['num_general']
				  . ', total = '				. $total
			  . ';';
	  
	  //echo "<br /><br />Query: ".$query;
	  $result = mysql_query($query, $DBlink);
	  if (!$result) {
		  $error=TRUE;
		  die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 4)<br />" . mysql_error()) . "</p>";
	  }
	  
	  $confirmationNumber = mysql_insert_id();
	  echo '
	  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	  <html xmlns="http://www.w3.org/1999/xhtml">
	  <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	  <title>SICKFEST Backweb</title>
	  <link rel="stylesheet" type="text/css" href="backwebstyle.css" />
	  </head>
	  <body>
	  <div style="width:100%;float:left;">
		<div style="float:right; text-align:right;">
		  <p><a href="index.php">Backweb Home</a> | <a href="search.php">Search For Purchase</a> | <a href="list.php">List Purchases</a> | <a href="add.php">Add New Purchase</a> | <a href="index.php?logout=yes">logout</a></p>
		</div>
	  </div>
	  <div style="width:100%;float:left;">
	  Sucessfully inserted with confirmation number: 100'.$confirmationNumber.'
	  </div>
	  </body>
	  </html>
	  ';
	  die;
	}
}

if (!isset($_POST['add'])):
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
    <h1>Add Purchase</h1>
  </div>
  <div style="float:right; text-align:right;">
  	<p><a href="index.php">Backweb Home</a> | <a href="search.php">Search For Purchase</a> | <a href="list.php">List Purchases</a> | <a href="index.php?action=logout">logout</a></p>
  </div>
</div>
<div style="width:100%;float:left;">
<?php 
if ($adderror) {
	echo '<h3 style="color:#CC0000;">Please fill required fields.</h3>';
}
?>
<form id="addForm" name="paymentForm" method="post" action="" >
First Name: <input type="text" name="first_name" id="first_name" size="40" /><br /><br />
Last Name: <input type="text" name="last_name" id="last_name" size="40" /><br /><br />
E-mail: <input type="text" name="email" id="email" size="40" /><br /><br />
Number Student Tickets: <input type="text" name="num_student" id="num_student" size="3" /><br /><br />
Number General Addmission Tickets: <input type="text" name="num_general" id="num_general" size="3" /><br /><br />
<input type="submit" value="Add Purchase" id="add" name="add" />
</form>
</div>
</body>
</html>
<?php endif; ?>