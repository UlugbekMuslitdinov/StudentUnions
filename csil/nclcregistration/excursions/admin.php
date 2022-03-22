<?

define('ACCESS', true);
include('../include.php');
// Authenticate
start_webauth($admin);

	session_start();
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli("nclc10");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCLC Excursion Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<style type="text/css">
body
{
	width: 1500px;
}
table {
	font-size: 13px;
	border-width: 2px;
	border-spacing: 1px;
	border-style: none;
	border-color: white;
	border-collapse: collapse;
	background-color: #999;
}
table th {
	text-align: left;
	font-family:Arial, Helvetica, sans-serif;
	border-width: 3px;
	padding: 3px;
	border-style: solid;
	border-color: white;
	background-color: white;
	-moz-border-radius: 0px 0px 0px 0px;
}
table td {
	border-width: 3px;
	padding: 3px;
	border-style: solid;
	border-color: white;
	background-color: #DDD;
	-moz-border-radius: 0px 0px 0px 0px;
}

span.form
{
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 13px;
}
</style>
</head>


<body style="margin:0px; padding:0px">
<img src="/csil/nclcregistration/common/banner_whiteB.gif" alt="banner" /><br />

<div style="margin: 20px">
	<span style="font-family: Arial, Helvetica, sans-serif; color: #003; font-weight: bold; font-size: 20px">NCLC Excursion Administration</span><br/><br/>
    <hr />
    <br/>
    <div style="float: left;">
    <span style="font-family: Arial, Helvetica, sans-serif; color: #003; font-weight: bold; font-size: 16px">Excursion Statuses</span>
    <table>
        <thead>
        	<tr><th>Excursion</th><th>Cost</th><th>Spots Filled</th><th>Spots Remaining</th><th>Total Spots</th></tr>
        </thead>
    	<tbody>
        <?
			$excursionsList = $db->query("SELECT * FROM excursions");
			while($row = $excursionsList->fetch_array())
			{
				// Populate Event Array for Later Use
				$events[$row[0]] = $row[1];
				if($_GET['ex_id'] == $row[0])
					$eventName = $row[1];
				$seatsFullQuery = $db->query("SELECT * FROM excursionguests WHERE status=0 AND excursionID=" . $row[0]);
				$seatsFull = $seatsFullQuery->num_rows;
				print '<tr><td><a href="?ex_id=' . $row[0] . '">' . $row[1] . '</a></td><td>$' . $row[3] . '</td><td>' . $seatsFull . '</td><td>' . ($row[2] - $seatsFull) . '</td><td>' . $row[2] . '</td></tr>';
			}
		?>
        </tbody>
	</table>
    <br />
    <br />
    <span style="font-family: Arial, Helvetica, sans-serif; color: #003; font-weight: bold; font-size: 16px">Excursion Attendees</span>
    <table>
        <thead>
        	<tr><th>Last Name</th><th>First Name</th><th>Excursion</th></tr>
        </thead>
    	<tbody>
        <?
			$excursionsList = $db->query("SELECT lastName, firstName, excursionID FROM excursionguests WHERE status=0 ORDER BY lastName");
			while($row = $excursionsList->fetch_array())
			{
				print '<tr><td>'. $row[0] . '</td><td>' . $row[1] . '</td><td><a href="?ex_id='.$row[2].'">'.$events[$row[2]].'</a></td></tr>';
			}
		?>
        </tbody>
	</table>
    </div>
    <div style="float:left; margin: 0px 0px 0px 20px;">
    	<div style="padding: 20px; background-color: #6CC">
            <span class="form">Name Search (Full Words not Required)</span><br />
            <form action="" method="get"><span class="form">First Name: </span><input type="text" name="fname" /><span class="form"> Last Name: </span><input type="text" name="lname" /> <input type="submit" value="Search" /></form><br />
            <?
            if(isset($_GET['ex_id']))
            {
                $ex_id = preg_replace("/[^0-9]/", "", $_GET['ex_id']);
            ?>
            <span style="font-family: Arial, Helvetica, sans-serif; color: #003; font-weight: bold; font-size: 16px">Excursion Attendees for <? print $events[$ex_id]; ?></span>
            <table>
                <thead>
                    <tr><th>Last Name</th><th>First Name</th><th>Drop</th></tr>
                </thead>
                <tbody>
                <?
                    $excursionsList = $db->query("SELECT lastName, firstName, id FROM excursionguests WHERE excursionID=".$ex_id." ORDER BY lastName");
                    while($row = $excursionsList->fetch_array())
                    {
                        print '<tr><td>'. $row[0] . '</td><td>' . $row[1] . '</td><td>
						<form action="process.php" method="post"><input type="hidden" name="drop" value="' . $row[2] . '"/>
						<input type="submit" value="X" onclick="return confirm(\'Really drop this attendee? This will not refund their payment.\')"/></form></td></tr>';
                    }
                ?>
                </tbody>
            </table>
            <?
            }
            ?>
            <?
            if(isset($_GET['fname']) || isset($_GET['lname']))
            {
                $fname = preg_replace("/[^a-zA-Z0-9\s]/", "", $_GET['fname']);
                $lname = preg_replace("/[^a-zA-Z0-9\s]/", "", $_GET['lname']);
            ?>
            <span style="font-family: Arial, Helvetica, sans-serif; color: #003; font-weight: bold; font-size: 16px">
                <?
                    if($_GET['fname'] != "" && $_GET['lname'] != "")
                        print "Excursion Attendees with Last Names Containing '" . $lname . "' and First Names Beginning with '" . $fname . "'";
                    else if($_GET['fname'] != "")
                        print "Excursion Attendees with First Names Beginning with '" . $fname . "'";
                    else if($_GET['lname'] != "")
                        print "Excursion Attendees with Last Names Containing '" . $lname . "'";
                    else
                        print "Displaying all Excursion Attendees";
                ?>
            </span>
            <table>
                <thead>
                    <tr><th>Last Name</th><th>First Name</th><th>Excursion</th><th>Drop</th></tr>
                </thead>
                <tbody>
                <?
                    $excursionsList = $db->query("SELECT lastName, firstName, excursionID, id FROM excursionguests WHERE lastName LIKE '%" . $lname . "%' AND firstName LIKE '" . $fname . "%' AND status=0 ORDER BY lastName");
                    while($row = $excursionsList->fetch_array())
                    {
                        print '<tr><td>'. $row[0] . '</td><td>' . $row[1] . '</td><td><a href="?ex_id='.$row[2].'">'.$events[$row[2]].'</a></td><td>
						<form action="process.php" method="post"><input type="hidden" name="drop" value="' . $row[3] . '"/>
						<input type="submit" value="X" onclick="return confirm(\'Really drop this attendee? This will not refund their payment.\')"/></form></td></tr>';
                    }
                ?>
                </tbody>
            </table>
            <?
            }
            ?>
        </div>
        <div style="padding: 20px">
        <span style="font-family: Arial, Helvetica, sans-serif; color: #003; font-weight: bold; font-size: 16px">Dropped Attendees</span>
        <table>
            <thead>
                <tr><th>Last Name</th><th>First Name</th><th>Excursion</th><th>Restore</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Add to Different Event</th></tr>
            </thead>
            <tbody>
            <?
				$select = '<select name="newExcursion">';
				for($i = 1; $i < 9; $i++)
				{
					$select = $select . '<option value="'.$i.'">' . $events[$i] . '</option>';
				}
				$select = $select . '</select>';
                $excursionsList = $db->query("SELECT lastName, firstName, excursionID, id FROM excursionguests WHERE status=1 ORDER BY lastName");
                while($row = $excursionsList->fetch_array())
                {
                    print '<tr><td>'. $row[0] . '</td><td>' . $row[1] . '</td><td><a href="?ex_id='.$row[2].'">'.$events[$row[2]].'</a></td><td>
						<form action="process.php" method="post"><input type="hidden" name="restore" value="' . $row[3] . '"/>
						<input type="submit" value="Yes" onclick="return confirm(\'Really restore this attendee? This may exceed the limit for this excursion.\')"/></form></td>
						<td></td><td><form action="process.php" method="post"><input type="hidden" name="change" value="' . $row[3] . '"/>'.$select.'
						<input type="submit" value="OK" onclick="return confirm(\'Add attendee to excursion. This will not check if excursion is full and will not consider amount of money attendee has paid.\')"/></form></td></tr>';
                }
            ?>
            
            </tbody>
        </table>
        </div>
    </div>
    <div style="clear: both"></div>
</div>
<br />
<div style="background-color: #000099; color: white; font-family: Verdana, Geneva, sans-serif; font-size: 12px; padding: 10px">

  NCLC is brought to you by the <br />
  Center for Student Involvement and Leadership at The University of Arizona<br />
  PO Box 210017, Tucson, AZ 85721-0017<br />
</div>

</body>
</html>