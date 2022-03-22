<?php
// Start the session
session_start();
// Include the include for access_control
include('webauth_access_control/include.php');
// Check to see if they are an allowed user
if (!$_SESSION['access_control']['allowed']) {
    echo "permission denied";
    exit();
}

include('db.inc');
db_connect();
db_select('wildcatwelcome10');

$result = db_query('select sum(bbq) as bbq, sum(brunch) as brunch, sum(vegetarian) as vegetarian from attendees');
$totals = mysql_fetch_assoc($result);

$result = db_query('select count(id) as num_students from attendees where uastudent=1 and bbq=1');
$bbq = mysql_fetch_assoc($result);

$result = db_query('select count(id) as num_students from attendees where uastudent=1 and brunch=1');
$brunch = mysql_fetch_assoc($result);

$result = db_query('select sum(orderamount) as total from payment');
$payment = mysql_fetch_assoc($result);
?>
<h1>Wildcat Welcome Backweb</h1>

<h2>Registration Summary</h2>
# of Brunches: <?=$totals['brunch']?> (<?=$brunch['num_students']?> students)<br />
# of BBQs: <?=$totals['bbq']?> (<?=$bbq['num_students']?> students)<br />
# of Vegetarian Plates: <?=$totals['vegetarian']?><br />
Registration Amount: $<?=$payment['total']?><br />

<h2>Registrants</h2>
<?php 
$result = db_query('select payment.firstname, payment.lastname, sum(bbq) as num_bbq, sum(brunch) as num_brunch from payment join attendees on payment.id=attendees.payment_id group by attendees.payment_id');
while($row = mysql_fetch_assoc($result))
	print $row['firstname'].' '.$row['lastname'].'<br /> &nbsp;&nbsp;&nbsp;brunch: '.$row['num_brunch'].'<br /> &nbsp;&nbsp;&nbsp;bbq: '.$row['num_bbq'].'<br /><br />';