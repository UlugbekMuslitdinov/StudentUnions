<?php
session_start();

/*	if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://elvis.sunion.arizona.edu/intra/marketingform/backweb.php");
    }

	session_start();
	if(!isset($_SESSION['netID'])){

	if(!isset($_GET['ticket'])) {
		header("Location: https://webauth.arizona.edu/webauth/login?service=https://elvis.sunion.arizona.edu/intra/marketingform/backweb.php");
	}else {
		
		$tix = $_GET['ticket'];
		$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=https://elvis.sunion.arizona.edu/intra/marketingform/backweb.php"';
		exec("curl -m 120 $url " ,$return_message_array, $return_number);
		
	
		$netID = $return_message_array[2];
	
		$netID = trim(str_replace("<cas:user>","",str_replace("</cas:user>","", $netID)));
		$_SESSION['netID'] = $netID;
	}
}*/	
require_once('webauth/include.php');
$_SESSION['netID'] = $_SESSION['webauth']['netID'];
?>

<script type="text/javascript">

function delAlert(i) {
	
		if (i == "Delete") {
		alert('If you select "Delete" and submit this form, all information and comments relating to this job will be removed');
		}
	
	}



</script>

<?


$access = false;
	
include_once('access.php');
	
	for ($i = 1; $i <= $empCount; $i++) {
		if($_SESSION['netID'] == $user[$i]['netID']) {
		$access = true;
		$id = $i;
			if ($user[$i]['rank'] == "admin") {
			$_SESSION['admin'] = true;
			}
		}
	} 
	
	if ($access != true || $_SESSION['netID'] == "" || !isset($_SESSION['netID'])) {
	print "Access Denied";
	} else {
	
	//$_GET['ID'];
	$_GET['ID'];
	?>
		<head>
	<style>
		body {font-family: sans-serif; font-size:12px;}
		table {font-size:12px;}
	</style>
	</head>
	<body>
    <div style="padding-left:20px;">
    <h4>Marketing Request Backweb</h4>
   <a href="backweb.php">[ BackWeb Overview ]</a>
   <a href="archive.php">[ Archive ]</a>
   <a href="backweblogin.php">[ BackWeb Login Page ]</a>
   <a href="logout.php">[ Logout ]</a>
   <br /><br />
    <?
	
	require('marketing_db.inc');
	
	/* ENTER UPDATES INTO DATABASE AND THEN REDISPLAY */
	
	if ($_GET['updateAssign'] == "yes") {
	
	
		$_SESSION['ReqAssign'] = $_POST[$user[1]['netID']]  
								  . $_POST[$user[2]['netID']]
								  . $_POST[$user[3]['netID']]
								  .	$_POST[$user[4]['netID']]
								  .	$_POST[$user[5]['netID']]
								  .	$_POST[$user[6]['netID']]
								  .	$_POST[$user[7]['netID']]
								  .	$_POST[$user[8]['netID']]
								  .	$_POST[$user[9]['netID']]
								  .	$_POST[$user[10]['netID']]
								  .	$_POST[$user[11]['netID']]
								  .	$_POST[$user[12]['netID']]; 
		
		for ($i = 1; $i < $empCount; $i++) {
			if ($_POST[$user[$i]['netID']] == true) {
			$to = $user[$i]['netID'] . "@email.arizona.edu";
			$subject = "Assigned to Project";
			$message = "You have been assigned to the Marketing project with the ID " . $_GET['ID'] . ", you can view the exact details of this at https://elvis.sunion.arizona.edu/intra/backwebdetailsMktg.php?ID=" . $_GET['ID'] . ", the complete team assigned to the project is: \n\n" . $_SESSION['ReqAssign'] . "\n\n Please log into the marketing request backweb under https://elvis.sunion.arizona.edu/intra/marketingform/backweblogin.php to view the exact details";
			$from = "Requests";
			$headers = "From: $from";
			mail($to,$subject,$message,$headers);
				}
			}
	
		
	
	$queryAssign = "update Request set assignment = \"" . $_SESSION['ReqAssign'] . "\" where ID=" . $_GET['ID'] . ";";
	db_query($queryAssign);
	//print $queryEdit;
	
	$queryReq = "select * from Request where ID = " . $_GET['ID'] . "";
	$resultReq = db_query($queryReq);
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	
	$to = $rowVal['contactEmail'];
	$subject = "Your project has been assigned!";
	$message = "Your project with the ID " . $_GET['ID'] . " has been assigned to the following marketing staff members:\n" . $_SESSION['ReqAssign'] . "\n If you haven't already you will receive an email indicating your job has been activated. \n\n Best Regards,\n Student Unions Marketing ";
	$from = "Requests";
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);
	}
	
	if ($_GET['updateStatus'] == "yes") {
	$queryStatus = "update Request set status = \"" . $_POST['newStatus'] . "\" where ID=" . $_GET['ID'] . ";";
	db_query($queryStatus);
	
		if ($_POST['newStatus'] == "Delete") {
			$queryDelete = "delete from Request where ID=" . $_GET['ID'] . ";";
			db_query($queryDelete);
			
			$queryDeleteComments = "delete from Comments where ID=" . $_GET['ID'] . ";";
			db_query($queryDeleteComments);
			}
	
	$queryReq = "select * from Request where ID = " . $_GET['ID'] . "";
	$resultReq = db_query($queryReq);
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	
	$to = $rowVal['contactEmail'];
	if ($_POST['newStatus'] == "Active") {
	$subject = "Your project has been activated!";
	$message = "The status of your project with the ID " . $_GET['ID'] . " has been changed to " . $_POST['newStatus'] . "! You will receive an email giving you the details of which employees have been assigned to your job. \n\n Best Regards,\n Student Unions Marketing ";
	} else if ($_POST['newStatus'] == "Completed") {
	$subject = "Your project has been completed!";
	$message = "The status of your project with the ID " . $_GET['ID'] . " has been changed to " . $_POST['newStatus'] . "! \n\n Best Regards,\n Student Unions Marketing ";
	}
	$from = "Requests";
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);
	} 
	
	if (isset($_GET['ID']) && ($_GET['ID'] != "")) {
	
	$queryReq = "select * from Request where ID = " . $_GET['ID'] . "";
	$resultReq = db_query($queryReq);
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	
	print "<table border=\"0\" cellpadding=\"4\" cellspacing=\"1\" bgcolor=\"#333333\">";
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\" width=\"150px\">";
		print "Project ID";
		print "</td>";
		print "<td style=\"color:#000\" width=\"600px\">";
		print $rowVal['ID'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Type";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['type'];
		print "</td>";
		print "</tr>";
		
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Status";
		print "</td>";
		print "<td style=\"color:#000\">";
			print "<form action=\"backwebdetailsMktg.php?updateStatus=yes&amp;ID=" . $_GET['ID'] . "\" method=\"post\">";
			print $rowVal['status'];
				if ($_SESSION['admin'] == true) {
				print " &nbsp; &nbsp;[Change to: ";
				print "<select name=\"newStatus\" onchange=\"delAlert(options[selectedIndex].value)\">";
				print "<option>New</option>";
				print "<option>Active</option>";
				print "<option>Completed</option>";
				print "<option>Delete</option>";
				print "</select>";
				print "&nbsp;";
				print "<input type=\"submit\" value=\"Update\">";
				print "]";
				}
			print "</form>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Rush Charge";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['rushCharge'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Due Date";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['dueDateMonth'];
		print "&nbsp;/&nbsp;";
		print $rowVal['dueDateDay'];
		print "&nbsp;/&nbsp;";
		print $rowVal['dueDateYear'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Description of Request";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['reqDesc'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Contact Name";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['contactName'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Contact Number";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['contactNumber'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Contact Email";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['contactEmail'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "FRS Account Number";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['acctFRS'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Marketing Budget";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['mktgBudget'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Primary Audience";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['primAudience'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Secondary Audience";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['secAudience'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Assigned To";
		print "</td>";
		print "<td style=\"color:#000\">";
			
			if ((($rowVal['assignment'] == "") || $_GET['editReq'] == "yes") && $_SESSION['admin'] == true){
			?>
            <form action="backwebdetailsMktg.php?updateAssign=yes&ID=<? print $_GET['ID'] ?>" method="post">
            <? for ($i = 1; $i < $empCount; $i++) {
            print "<input type=\"checkbox\" name=\"" . $user[$i]['netID'] . "\" value=\"" . $user[$i]['name'] . ", \" />" . $user[$i]['name'] . "<br />";
            }
			?>
            <input type="submit" />
            </form>
            
			<?
			}else{
			print $rowVal['assignment'];
				if ($_SESSION['admin'] == true){
				print " [ <a href=\"backwebdetailsMktg.php?editReq=yes&ID=" . $_GET['ID'] . "\">change</a> ]";
				}
			}
			
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Time Remaining";
		print "</td>";
		print "<td style=\"color:#000\">";
		
		//Set up this way so that strtotime can read it in correctly, but the numeric value in the database allow mySql to sort by it correctly. 
		if ($rowVal['dueDateMonth'] == "1") { $dueMonth = "January"; }
		if ($rowVal['dueDateMonth'] == "2") { $dueMonth = "February"; }
		if ($rowVal['dueDateMonth'] == "3") { $dueMonth = "March"; }
		if ($rowVal['dueDateMonth'] == "4") { $dueMonth = "April"; }
		if ($rowVal['dueDateMonth'] == "5") { $dueMonth = "May"; }
		if ($rowVal['dueDateMonth'] == "6") { $dueMonth = "June"; }
		if ($rowVal['dueDateMonth'] == "7") { $dueMonth = "July"; }
		if ($rowVal['dueDateMonth'] == "8") { $dueMonth = "August"; }
		if ($rowVal['dueDateMonth'] == "9") { $dueMonth = "September"; }
		if ($rowVal['dueDateMonth'] == "10") { $dueMonth = "October"; }
		if ($rowVal['dueDateMonth'] == "11") { $dueMonth = "November"; }
		if ($rowVal['dueDateMonth'] == "12") { $dueMonth = "December"; }
		
		$timePosted = strtotime($dueMonth . " " . $rowVal['dueDateDay'] . " " . $rowVal['dueDateYear']);
		$diff = $timePosted  - time();
		$diffDays = floor($diff/60/60/24);
		$diffHours = ($diff/60/60);
		$diffHoursReal = round(24 * (($diffHours / 24) - (floor($diffHours / 24))));
		
		if (0 < $diffDays && $diffDays < 2) {
		print "<font color=\"red\"><b>";
		print $diffDays . " Days " . $diffHoursReal . " Hours";
		print "</font></b>";
		} else if ($timePosted < time()) {
		print "<font color=\"red\"><b>Job Expired " . $dueMonth . " " . $rowVal['dueDateDay'] . " " . $rowVal['dueDateYear'] . "</b></font>";
		} else {
		print $diffDays . " Days " . $diffHoursReal . " Hours";
		}
		print "</td>";
		print "</tr>";
	
			if ($rowVal['type'] == "Dining") {
			$queryReq = "select * from diningReq where ID = " . $_GET['ID'] . "";
			$resultReq = db_query($queryReq, $DBlink);
			$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
		
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "11 x 17 Posters";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['1117posters'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Amount";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['amt1117'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "B/W or Color?";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['bwColor1117'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Large Format Posters";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['largeFormatPosters']  . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Amount";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['amtLargeFormat'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Large Format Size";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['lFSize'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Large Format Mount";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['lFMount'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "8.5 x 11 Flyers";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['8511Flyers'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Amount";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['amt8511'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "B/W or Color";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['bwColor8511'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Half-Page Handbills";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['hlfPage'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Amount";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['amtHlfPage'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "B/W or Color";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['bwColorHlfPage'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Quarter-Page Handbills";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['qtrPage'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Amount";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['amtQtrPage'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "B/W or Color";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['bwColorQtrPage'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Shelf Labels";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['shelfLabels'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Shelf Labels";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['amtShelfLabel'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "B/W or Color";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['bwColorShelfLabel'];
		print "</td>";
		print "</tr>";
			
			
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Web Banner";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['webBanner'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Plasma Ads";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['plasmaAds'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Outdoor Banner";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['outdoorBanner'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Outdoor Banner Material";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['matOtdBanner'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "myPlace! Ads";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['myPlace'] . "</b>";
		print "</td>";
		print "</tr>";
			
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "myPlace Ad Dates";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['myPlaceDates'];
		print "</td>";
		print "</tr>";
			
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Other";
		print "</td>";
		print "<td style=\"color:#000\">";
		print "<b>" . $rowVal['other'] . "</b>";
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Other Desc";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['otherDesc'];
		print "</td>";
		print "</tr>";
			
			}
	
			if ($rowVal['type'] == "Event") {
			$queryReq = "select * from eventReq where ID = " . $_GET['ID'] . "";
			$resultReq = db_query($queryReq);
			$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Event Title";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['eventTitle'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Event Location";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['eventLoc'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Event Price";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['eventPrice'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Event URL";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['eventURL'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Event Date";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['eventDate'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Event Time";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['eventTime'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Public Contact Name";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['pubContactName'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#CCCCCC\">";
		print "<td style=\"color:#000\">";
		print "Public Contact Phone";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['pubContactPhone'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Public Contact Email";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['pubContactEmail'];
		print "</td>";
		print "</tr>";
		
		}
	
	print "</table>";
    }
	
	print "<br /><br /><br />";
	
	print "<span style=\"font-size:14px; font-weight:bold\">Leave a Comment</span>";
	/*print "<br>";
	print $_POST['user'];
	print "<br>";*/
	//print $_POST['date'];
	/*print "<br>";
	print $_POST['comment'];*/
	
	if (isset($_POST['user'])) {
	$commentNumQuery = "select max(commentNum) from Comments where ID=\"" . $_GET['ID'] . "\"";
	$commentIDResult = db_query($commentNumQuery);
	$commentNum = mysql_result($commentIDResult, 0);
	$commentNum = $commentNum+1;
	
	$commentQuery = " insert into Comments set 
	ID =\"" . $_POST['IDCom'] . "\",
	commentNum =\"" . $commentNum . "\",
	userPost =\"" . $_POST['user'] . "\", 
	date =\"" . $_POST['date'] . "\",
	comment =\"" . $_POST['comment'] . "\";";
	
	db_query($commentQuery);
	
	}
	
	?>
    <form action="backwebdetailsMktg.php?ID=<? print $_GET['ID'] ?>" method="post">
    <input type="hidden" name="IDCom" value="<? print $_GET['ID'] ?>" />
    <input type="hidden" name="user" value="<? print $user[$id]['name'] ?>" />
    <input type="hidden" name="date" value="<? print date('j-F-Y, g:i') ?>"  />
    
    <textarea name="comment" cols="60" rows="5">Enter Comment Here</textarea><br /><br />
    <input type="submit" />
    
    </form>
    
    <?
	
	$queryCommentDisplay = "select * from Comments where ID=\"" . $_GET['ID'] . "\" order by commentNum desc";
	$resultComment = db_query($queryCommentDisplay);
	$comCount = mysql_num_rows($resultComment);
	
	//print $queryCommentDisplay;
	if ($comCount > 0) {
	
    print "<table border=\"0\" cellpadding=\"4\" cellspacing=\"1\"  bgcolor=\"#333333\">";
    print	"<tr style=\"background-color:#003366\">";
    print  	"<td style=\"color:#FFFFFF; width:100px;\">";
    print        "Poster Name";
    print        "</td>";
    print    	"<td style=\"color:#FFFFFF; width:100px;\">";
    print        "Date Posted";
    print        "</td>";
    print        "<td style=\"color:#FFFFFF; width:600px;\">";
    print        "Comment";
    print    	"</td>";
    print     "</tr>";

	
		for ($i = 1; $i <= $comCount; $i++) {
		$rowCom = mysql_fetch_array($resultComment, MYSQL_ASSOC);
		print "<tr>";
			print "<td style=\"background-color:#FFF\">";
			print $rowCom['userPost'];
			print "</td>";
			print "<td style=\"background-color:#FFF\">";
			print $rowCom['date'];
			print "</td>";
			print "<td style=\"background-color:#FFF\">";
			print $rowCom['comment'];
			print "</td>";
		print "</tr>";
		}
	print "</table>";
	}
	?>
	   
    </div>
    </body>
<?php 
}
?>