<?
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli("nclc10");
	if(isset($_POST['drop']))
	{
		$drop = preg_replace("/[^0-9]/", "", $_POST['drop']);
		$db->query("UPDATE excursionguests SET status=1 WHERE id=".$drop);
	}
	else if(isset($_POST['restore']))
	{
		$restore = preg_replace("/[^0-9]/", "", $_POST['restore']);
		$db->query("UPDATE excursionguests SET status=0 WHERE id=".$restore);
	}
	else if(isset($_POST['change']))
	{
		$db->query("UPDATE excursionguests SET status=2 WHERE id=".$_POST['change']); // Set status to 2 (Permanently Deleted). This entry will remain, but will not appear in interface.
		$result = $db->query("SELECT lastName, firstName, payment_id FROM excursionguests WHERE id='" . $_POST['change'] . "'");
		$row = $result->fetch_array();
		$fname = $row[1];
		$lname = $row[0];
		$payment_id = $row[2];
		$ex_id = $_POST['newExcursion'];
		db_query("INSERT INTO excursionguests (`firstName` , `lastName` , `excursionID`, `payment_id`) VALUES ('$fname', '$lname', '$ex_id', '$payment_id')");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Process</title>
<meta http-equiv="REFRESH" content="0;url=admin.php"></HEAD>
<BODY>
</BODY>
</HTML>