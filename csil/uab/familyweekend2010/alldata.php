<?php 
session_start();
if(!$_SESSION['fw']['backweb']){
	header("Location:backweb.php");
	exit();	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>All Signups</title>
</head>
<style>
@media print

{

  hr {page-break-before:always; visibility:hidden;}

}
</style>
<body>

<?php

function format_phnum($ph) {

	$num = '(' . substr($ph,0,3) . ') ';
	$num .= substr($ph,3,3) . '-';
	$num .= substr($ph,6,4);

	return $num;

}
	
	//Connect to MySQL
//	$DBlink = mysql_connect("trinity.sunion.arizona.edu","web","viv3nij")
//		or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. (error 1)</p>");

	//Choose DB
//	mysql_select_db("familyweekend08", $DBlink)
//		or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)</p>");

// Database
include('../../../../commontools/mysql_link.inc');
mysql_select_db('familyweekend10', $DBlink);


	//Check to see if this person has already RSVPd
	$query = "SELECT id, cybersource_orderNum, firstName, lastName, email, phone, address, city, state, zip, total FROM payment WHERE status <> \"canceled\" ORDER BY lastName";

	
	$All_Not_Canceled_Payments = mysql_query($query, $DBlink);
		
	if(mysql_num_rows($All_Not_Canceled_Payments) == 0) {
		
		print "No one is in the Payment table!";
			
	}else { 
	
		//Go through each payment one by one
		$i = 0;
		//while(($temp_Payment = mysql_fetch_array($All_Not_Canceled_Payments, MYSQL_ASSOC)) && ($i < 3)) {
		while($temp_Payment = mysql_fetch_array($All_Not_Canceled_Payments, MYSQL_ASSOC)) {
			
			$query = "SELECT firstName, lastName FROM Attendee WHERE payment_id = " . $temp_Payment['id'];
			
			$Attendees = mysql_query($query, $DBlink);
			
			$query = "SELECT event_title FROM EventRegistration WHERE payment_id = " . $temp_Payment['id'];
			
			$Events = mysql_query($query, $DBlink);
			
			$a_String = '<div style="font-size:18px;"><b>';
			$a_String .=  $temp_Payment['lastName'] . ", " . $temp_Payment['firstName'] ;
			$a_String .= '</b></div>';
			
			$a_String .= '<div style="padding-left:300px; padding-bottom:25px;">';
			$a_String .= "Total: $" . $temp_Payment['total'] . "<br>";
			$a_String .= "Confirmation #: " . $temp_Payment['cybersource_orderNum'] . "<br>";
			$a_String .= "\t\t " . format_phnum($temp_Payment['phone']) . "<br>";
			$a_String .= "\t\t " . $temp_Payment['address'] . "<br>";
			$a_String .= "\t\t " . $temp_Payment['city'] . ", " . $temp_Payment['state'] . " " . $temp_Payment['zip'];
			$a_String .= '</div>';
			
			$a_String .= '<div style="padding-left:100px; padding-bottom:25px;">';
			$a_String .= "<B>Attendees:</B><br>";
			
			while($temp_Attend = mysql_fetch_array($Attendees, MYSQL_ASSOC)) {
			
				$a_String .= $temp_Attend['firstName'] . " " . $temp_Attend['lastName'] . "<br>";
			}
			$a_String .= '</div>';
			
			$a_String .= '<div style="padding-left:100px;">';
			$a_String .= "\t<B>Events:</B><br>";
			
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
//			$a_String .= '<br clear="all" style="page-break-before:always" />';
		
			++$i;
			print "<hr />" . $a_String;
			
			
			$query = "SELECT * FROM TshirtOrder WHERE payment_id = " . $temp_Payment['id'];
			
			$tshirt = mysql_query($query, $DBlink);
		
		
		
			
			while($temp_shirts = mysql_fetch_array($tshirt, MYSQL_ASSOC)) {
			print '<br /><div style="padding-left:100px; padding-bottom:25px;">';
			print "\t<B>T-shirts:</B><br>";
//				print 'x small: '.$temp_shirts['xsmall']."<br>";
				// changed to kids size 6 for 2009
				print 'kids size 6: '.$temp_shirts['xsmall']."<br>";
				print 'small: '.$temp_shirts['small']."<br>";
				print 'medium: '.$temp_shirts['medium']."<br>";
				print 'large: '.$temp_shirts['large']."<br>";
				print 'x large: '.$temp_shirts['xlarge']."<br>";
				print '2x large: '.$temp_shirts['x2large']."<br>";
				print '</div>';
				}
				echo '<br clear="all" style="page-break-before:always" />';
			
		}
		
		
	
	}
	


?>
</body>
</html>
