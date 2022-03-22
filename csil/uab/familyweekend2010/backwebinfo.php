<?php
/*
	if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://www.union.arizona.edu/csil/uab/familweekend2007/backweform.php");
    }
*/

	$id=$_GET ['id'];
	

	//Connect to MySQL
//	$DBlink = mysql_connect("trinity.sunion.arizona.edu","web","viv3nij")
//		or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. (error 1)</p>");

	//Choose DB
//	mysql_select_db("familyweekend08", $DBlink)
//		or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)</p>");

// Database
include('../../../commontools/mysql_link.inc');
mysql_select_db('familyweekend10', $DBlink);

	//Check to see if this person has already RSVPd
		$query = "SELECT cybersource_orderNum, status, lastName, firstName, email, phone, total, id FROM payment WHERE id = \"" . $id . "\"";

		$result = mysql_query($query, $DBlink);
		
		if(mysql_num_rows($result) == 0) {
			//not invited!!
			$error = true;
			$error_msg = "No such Name";
			
		}else { 
			//while 
			$payment = mysql_fetch_array($result, MYSQL_NUM);
	}		
		
		
	

	?>
    <br><br>
    
<div style="position:absolute; top:50px; border: ">
<div style="position:absolute; left:0px; top:0px; width:150px;">


		<br><br>
        Order Number:<br>
        Status:<br>
        Last Name:<br>
        First Name:<br>
        Email:<br>
        Phone:<br>
        Total:<br />
<br><br><br><br><br><br><br>
</div>        
<div style="position:absolute; left:200px; top:0px; width:500px;"> 
		
<?php        
		echo "<B>PAYMENT DETAILS:</B>";
		?>
        
<form action="cancel.php" method="post" style="float:right;" target="_blank">
<input type="hidden" name="trannumber" value="<?php print $payment[0]; ?>" />
<input type="hidden" name="netID" value="<?php print $_SESSION['webauth']['netID']; ?>" />
<input type="submit" value="cancel" id="cancelbutton" />
</form>
<?php
		echo "<br><br>";
		
	for($index = 0; $index < 7; $index++) {
		print $payment[$index];
		echo "<br>";
		
		}
		
		?>
		
</div>
</div>    
    
    
<div style="position:absolute; top:250px">
<div style="position:absolute; left:0px; top:0px; width:150px;">
		<br><br>
        Name Attendee 1:<br>
        Name Attendee 2:<br>
        Name Attendee 3:<br>
        Name Attendee 4:<br>
        Name Attendee 5:<br>
        Name Attendee 6:<br>
        Name Attendee 7:<br>
        Name Attendee 8:<br>
        Name Attendee 9:<br>
           
</div>        
    
	
<div style="position:absolute; left:200px; top:0px; width:400px;">    
<?php	

	$query = "SELECT firstName, lastName, class_hometown FROM Attendee WHERE payment_id = \"" . $payment[7] . "\" order by student desc";

		$result = mysql_query($query, $DBlink);
		$numAttendees = mysql_num_rows($result);
		if($numAttendees == 0) {
			//not invited!!
			$error = true;
			$error_msg = "No one registered";
			
		}else { 
			//while 
			
		    echo "<B>ATTENDEES UNDER THIS ORDER:</B> <br><br>";
		
		while ($Attendees = mysql_fetch_array($result, MYSQL_ASSOC)) {
				print $Attendees['firstName'];
				echo "&nbsp;";
				print $Attendees['lastName'];
				echo "&nbsp;-&nbsp;";
				print $Attendees['class_hometown'];
				echo "<br>";
		}	
		}

		
?>
</div>
</div>

<div style="position:absolute; top:500px">
<div style="position:absolute; left:0px; top:0px; width:150px;">

		<br><br>
       <!-- Event 1:<br>
        Event 2:<br>
        Event 3:<br>
        Event 4:<br>
        Event 5:<br>
        Event 6:<br> -->

</div>        
<div style="position:absolute; left:200px; top:0px; width:400px;">  
	
<?php	

	$query = "SELECT event_title FROM EventRegistration WHERE payment_id = \"" . $payment[7] . "\"";

		$result = mysql_query($query, $DBlink);
		$eventReg = mysql_num_rows($result);
		if($eventReg == 0) {
			//not invited!!
			$error = true;
			$error_msg = "No events registered";
			
		}else { 
			//while 
    echo "<B>EVENTS SCHEDULED:</B> <br><br>";
		/*
		
		while ($Events = mysql_fetch_array($result, MYSQL_ASSOC)) {
		print $Events['event_title'];
		echo "<br>";
		
		}
		*/
		$query = "SELECT event_title FROM EventRegistration WHERE payment_id = " . $payment[7];
			
			$Events = mysql_query($query, $DBlink);
		
		
		$count = 0;
			
			while($temp_Event = mysql_fetch_array($Events, MYSQL_ASSOC)) {
			
				if($count == 0) {
					//first time through
					$curTitle = $temp_Event['event_title'];
					$count = 1;
					
				}elseif ($curTitle != $temp_Event['event_title']) {
					//time to switch
					$a_String .= $count . " - " . $curTitle . "<br>";
					
					$curTitle = $temp_Event['event_title'];
					$count = 1;
				}else {
					//Still counting the current title
					$count++;
				}
			}
			//Will have missed the print for the last event, so print it now.
			$a_String .= $count . " - " . $curTitle;
			$a_String .= '</div>';
			$a_String .= '<br clear="all" style="page-break-before:always" />';
		
			++$i;
			print $a_String;
		
		
		
		
		
		
		
		}
?>
<div style="position:absolute; left:0px; top:0px; width:400px;">
<?php		
		
		echo "<B>T-SHIRT ORDERS:</B> <br><br>";
		
		$query = "SELECT * FROM TshirtOrder WHERE payment_id = " . $payment[7];
			
			$tshirt = mysql_query($query, $DBlink);
			
		
		
		$count = 0;

			while($temp_shirts = mysql_fetch_array($tshirt, MYSQL_ASSOC)) {
//				print 'x small: '.$temp_shirts['xsmall']."<br>";
				// changed to kids size 6 for 2009
				print 'kids size 6: '.$temp_shirts['xsmall']."<br>";
				print 'small: '.$temp_shirts['small']."<br>";
				print 'medium: '.$temp_shirts['medium']."<br>";
				print 'large: '.$temp_shirts['large']."<br>";
				print 'x large: '.$temp_shirts['xlarge']."<br>";
				print '2x large: '.$temp_shirts['x2large']."<br>";
				}

		

?>
        </div>
</div>
</div>