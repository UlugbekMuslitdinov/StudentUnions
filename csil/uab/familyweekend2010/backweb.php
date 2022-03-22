<?php

/*
	 if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://www.union.arizona.edu/csil/och/WebMail.php");
    }
*/ 
session_start();

/*
// TEST SESSION VARS
echo 'fri.php: SESSION VARS <br />';
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
echo "--------------------------------------<br /><br />";
// END

// TEST POST VARS
echo 'fri.php: POST VARS <br />';
echo '<pre>';
print_r($_POST);
echo '</pre>';
echo "--------------------------------------<br /><br />";
// END

// TEST GET VARS
echo 'fri.php: GET VARS <br />';
echo '<pre>';
print_r($_GET);
echo '</pre>';
echo "--------------------------------------<br /><br />";
// END
*/


// authenticate with WebAuth; new setup
$webauth_splash = '';
require_once('/Library/WebServer/commontools/webauth/include.php');

$allowed = array('kmbeyer', 'jmasson', 'sanorris', 'ceagan', 'rghull', 'kflores', 'lindsayb', 'lpgamez');

	if(!in_array($_SESSION['webauth']['netID'], $allowed)) {  
		echo "<p>You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.</p>";
		echo '<p><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://www.union.arizona.edu/csil/uab/familyweekend2009/backweb.php&logout_text=Return%20to%20Family%20Weekend%202009%20Backweb">Logout of UA NetID WebAuth</a></p>';
		session_destroy();
		
	}
	else {

	$_SESSION['fw']['backweb'] = 1;
/*
// this is the old webauth setup
//if($_POST['submit']!=1) {
if(!isset($_SESSION['netID'])){

	if(!isset($_GET['ticket'])) {

		//header("Location: https://webauth.arizona.edu/webauth/login?service=https://www.union.arizona.edu/csil/och/BackWeb.php");
//		header("Location: https://webauth.arizona.edu/webauth/login?service=http://elvis.sunion.arizona.edu/csil/uab/familyweekend2009/backweb.php");
		header("Location: https://webauth.arizona.edu/webauth/login?service=http://www.union.arizona.edu/csil/uab/familyweekend2009/backweb.php");
		
		
	}else {
		
		$tix = $_GET['ticket'];
		
		//$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=https://www.union.arizona.edu/csil/och/backweb.php"';
//		$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=http://elvis.sunion.arizona.edu/csil/uab/familyweekend2009/backweb.php"';
		$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=http://www.union.arizona.edu/csil/uab/familyweekend2009/backweb.php"';
		//echo $url;
		exec("curl -m 120 $url " ,$return_message_array, $return_number);
		
	
		$netID = $return_message_array[2];
		
	

		$netID = trim(str_replace("<cas:user>","",str_replace("</cas:user>","", $netID)));
		$_SESSION['netID'] = $netID;
	}
}
	
	if($_SESSION['netID'] != sanorris  && $_SESSION['netID'] != jmasson && $_SESSION['netID'] != kmbeyer && $_SESSION['netID'] != ceagan ) {
	
		echo "<p>You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.</p>";
		echo '<p><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://www.union.arizona.edu/csil/uab/familyweekend2009/backweb.php&logout_text=Return%20to%20Family%20Weekend%202009%20Backweb">Logout of UA NetID WebAuth</a></p>';
	
	
	}
	else {
*/





?>
<style type="text/css" media="print">
#divform{
display:none;
}


#divrecords{
display:none;
}

#cancelbutton{
display:none;
}


</style>
<div style="width:100%; float:left;" id="divform">
<form action="./backweb.php" method="get">

   <div class="form_line">
   		Search by last name&nbsp;&nbsp;&nbsp;&nbsp;
        	<input type="text" name="lname" /><input type="submit" value="view" name="vlname"/>
         
		    <span style="float:right;"><a href="alldata.php" target="_blank" >all data</a> <a href="backwebemails.php" target="_blank" >all emails</a></span>
   </div>
   <br />
      <div class="form_line">
   		Search by transaction number&nbsp;&nbsp;&nbsp;&nbsp;
        	<input type="text" name="tran" /><input type="submit" value="view" name="vtran"/>
            <!--<span style="float:right;"><a href="./backweb/events.php" target="_blank">events</a></span>-->
         
		    <span style="float:right;"><? echo '<a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://www.union.arizona.edu/csil/uab/familyweekend2009/backweb.php&logout_text=Return%20to%20Family%20Weekend%202009%20Backweb">logout</a>'; ?> | <a href="pcancel.php" target="_blank">pending cancellations</a></span>

   </div>
   <br>
   <div class="form_line">
   		Event Count&nbsp;&nbsp;
        	<input type="submit" value="view" name="veventcnt"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Alumni&nbsp;&nbsp;
        	<input type="submit" value="view" name="valumni"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Tshirts&nbsp;&nbsp;
        	<input type="submit" value="view" name="vtshirt"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Totals&nbsp;&nbsp;
        	<input type="submit" value="view" name="sales"/>
			
            <!--<span style="float:right;"><a href="./backweb/lunch.php" target="_blank">lunch</a></span>-->
   </div>
   
   <hr />
</form>
</div>
<?php
print '<div style="width:100%; min-width:800px;">';
print '<div style="width:450px; min-width:450px; float:left; border-right: 2px groove; height:100%; min-height:100%;" id="divrecords"> ';

$query = "";

//$DBlink = mysql_connect("trinity.sunion.arizona.edu", "web", "viv3nij")
	//	or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. (error 1)</p>");

//	Choose DB
//	mysql_select_db("familyweekend08", $DBlink)
	//	or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)</p>");

// Database
include('../../../commontools/mysql_link.inc');
mysql_select_db('familyweekend10', $DBlink);


	//Check to see if this person has already RSVPd
	if(isset($_GET['vlname'])){
		$query = "select lastName, firstName, status, cybersource_orderNum, id FROM payment WHERE lastName LIKE \"" . $_GET['lname'] . "%\"";
		$view="vlname";
	}
	else if(isset($_GET['vtran'])){
		$query = "select lastName, firstName, status, cybersource_orderNum, id FROM payment WHERE cybersource_orderNum = \"" . $_GET['tran'] . "\"";
		$view="vtran";
	}
	// kmb: this alumni query works now and also checks for valid payment status before listing as an attending alumni
	else if(isset($_GET['valumni'])){
		$query = "SELECT alumni.alumniFN, alumni.alumniLN, alumni.payment_id, alumni.payment_lname, payment.id FROM Alumni, payment WHERE alumni.payment_id = payment.id AND alumni.id IS NOT NULL AND payment.status <> \"canceled\" AND payment.status <> \"pcancel\"";
		$view="valumni";



// original, does not check for active payment status, but works otherwise -->
/*	else if(isset($_GET['valumni'])){
		$query = "SELECT alumniFN, alumniLN, payment_id, payment_lname FROM Alumni WHERE id IS NOT NULL"; //kmb - problem with alumni query begins here...
		$view="valumni";
*/




//		$query = "select lastName, firstName, status, cybersource_orderNum, id FROM payment WHERE cybersource_orderNum = \"" . $_GET['tran'] . "\"";
//		$view="vtran";




	}
	else if(isset($_GET['vtshirt'])){
		// KMB: new query joins tshirts with only active payments to get actual tshirt order numbers
		$query = "SELECT sum(tshirtorder.xsmall), sum(tshirtorder.small), sum(tshirtorder.medium), sum(tshirtorder.large), sum(tshirtorder.xlarge), sum(tshirtorder.x2large), tshirtorder.payment_id FROM tshirtorder, payment WHERE tshirtorder.payment_id = payment.id AND payment.status <> \"canceled\" AND payment.status <> \"pcancel\"";

// KMB: old code didn't exclude canceled payments from tshirt orders...
//		$query = "SELECT sum(xsmall), sum(small), sum(medium), sum(large), sum(xlarge), sum(x2large) FROM TshirtOrder"; original
		
	}
	else if (isset($_GET['sales'])) {
		// KMB: new query total sales minus canceled orders
		$query = "SELECT sum(total) FROM payment WHERE status <> \"canceled\" AND status <> \"pcancel\"";
	}
	
	else {
		//$query = "SELECT event_title, COUNT(payment_id) FROM EventRegistration GROUP BY event_title";
		
		$query = "SELECT payment.id, payment.firstName, payment.lastName, payment.email, payment.phone, EventRegistration.event_title , COUNT(EventRegistration.payment_id) FROM payment, EventRegistration WHERE EventRegistration.payment_id = payment.id AND payment.status <> \"canceled\" GROUP BY EventRegistration.event_title";
	}
		
		
		$result = mysql_query($query, $DBlink)
		 or die("query failed");
		if(mysql_num_rows($result) == 0) {
			//not invited!!
			$error = true;
			$error_msg = "No such Entry";
		} else {
		
			if(isset($_GET['veventcnt'])){ 
				while($row = mysql_fetch_array($result)){
					echo $row['event_title']." - ". $row[6];
					echo "<br />";
				}
			}
			else if(isset($_GET['vtshirt'])){
			$row = mysql_fetch_array($result);
			
//				print 'xsmall: '.$row['sum(xsmall)'].'<br>';
				//changed to kids size 6 for 2009

/* KMB: changed below code to use join query from above so that tshirts that are part of canceled or pending cancel orders don't get factored into the totals
				print 'kids size 6: '.$row['sum(xsmall)'].'<br>';
				print 'small: '.$row['sum(small)'].'<br>';
				print 'medium: '.$row['sum(medium)'].'<br>';
				print 'large: '.$row['sum(large)'].'<br>';
				print 'xlarge: '.$row['sum(xlarge)'].'<br>';
				print 'x2large: '.$row['sum(x2large)'].'<br>';
*/				
// KMB: new code to display accurate tshirt order numbers using join with payment table, active payments only
				print 'kids size 6: '.$row['sum(tshirtorder.xsmall)'].'<br>';
				print 'small: '.$row['sum(tshirtorder.small)'].'<br>';
				print 'medium: '.$row['sum(tshirtorder.medium)'].'<br>';
				print 'large: '.$row['sum(tshirtorder.large)'].'<br>';
				print 'xlarge: '.$row['sum(tshirtorder.xlarge)'].'<br>';
				print 'x2large: '.$row['sum(tshirtorder.x2large)'].'<br>';
			
			}
			else if (isset($_GET['sales'])) {
				$row = mysql_fetch_array($result);
				echo 'Total: $' . $row['sum(total)'].'<br />';
				
				$query = "select count(id) as num_registrants, sum(student) as num_students from attendee";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				print 'Registrants: '.$row['num_registrants'].' ('.$row['num_students'].' students '.($row['num_registrants']-$row['num_students']).' parents)<br />';
				
				$query = 'select count(id) as num from attendee group by cost order by cost';
				$result = mysql_query($query);
				$row0 = mysql_fetch_assoc($result);
				$row1 = mysql_fetch_assoc($result);
				$row2 = mysql_fetch_assoc($result);
				print 'Premium: '.$row2['num'].' Basic: '.$row1['num'].' Free: '.$row0['num'].'<br />';
				
				$class = array(0, 0, 0, 0);
				$query = 'select count(id) as num, class_hometown as class from attendee where class_hometown in ("Freshman", "Sophmore", "Junior", "Senior") group by class_hometown';
				$result = mysql_query($query);
				while($row = mysql_fetch_assoc($result)){
					switch($row['class']){
						case 'Freshman':
							$class[0] = $row['num'];
						break;
						case 'Sophmore':
							$class[1] = $row['num'];
						break;
						case 'Junior':
							$class[2] = $row['num'];
						break;
						case 'Senior':
							$class[3] = $row['num'];
						break;
					}
				}
				print 'Freshman: '.$class[0].'<br />';
				print 'Sophmore: '.$class[1].'<br />';
				print 'Junior: '.$class[2].'<br />';
				print 'Senior: '.$class[3].'<br />';				
			}
			
			else{

			$i = 1; // set counter for alumni list
	
			while ($Customers = mysql_fetch_array($result, MYSQL_ASSOC)) {
				print $Customers['firstName'];
				echo "&nbsp;";
				print $Customers['lastName'];
				echo "&nbsp;";
				print "<a href=\"backweb.php?id=" . $Customers['id']."&lname=".$_GET['lname']."&tran=".$_GET['tran'] ."&".$view."=view"."\">" . $Customers['cybersource_orderNum'] . "</a>" ;
				//print "<a href=\"backwebinfo.php?id=" . $Customers['id'] ."&query=".$query."\">" . $Customers['cybersource_orderNum'] . "</a>" ;
				
				//this will now display the alumni list; kmb: 6/19/09

				if(isset($_GET['valumni']))
				{
					print $i . ") " . $Customers['alumniFN'] . " " . $Customers['alumniLN'] . " - <a href=\"backweb.php?id=" . $Customers['payment_id']."&lname=".$Customers['payment_lname']."&".$view."=view"."\">" . "view details" . "</a>";
					$i++;
				}
								
				echo "&nbsp;";
				print $Customers['status'];
				echo "<br>";
				
			}
		}
		}

}

print '</div>';
print '<div style="width:350px; float:left; position:relative; padding-left:15px;">';

	include('backwebinfo.php');
print '</div>';
print '</div>';