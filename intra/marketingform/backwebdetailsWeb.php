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
	$_GET['webID'];
	
	 require('global.inc');
  $page_options['title'] = 'Union Marketing Request Form:';
  page_start($page_options);
	?>
	
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
	
	
		$_SESSION['webReqAssign'] = $_POST[$user[1]['netID']]  
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
			$message = "You have been assigned to the WebEdit project with the web ID " . $_GET['webID'] . ", you can view the exact details of this at https://elvis.sunion.arizona.edu/intra/backwebdetailsWeb.php?webID=" . $_GET['webID'] . ", the complete team assigned to the project is: \n\n" . $_SESSION['webReqAssign'] . "\n\n Please log into the marketing request backweb under https://elvis.sunion.arizona.edu/intra/marketingform/backweblogin.php to view the exact details";
			$from = "Requests";
			$headers = "From: $from";
			mail($to,$subject,$message,$headers);
				}
			}
	
		
	
	$queryAssign = "update webRequest set assignment = \"" . $_SESSION['webReqAssign'] . "\" where webID=" . $_GET['webID'] . ";";
	db_query($queryAssign);
	//print $queryEdit;
	
	$queryWeb = "select * from webRequest where webID = " . $_GET['webID'] . "";
	$resultReq = db_query($queryWeb);
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	
	$to = $rowVal['contactEmail'];
	$subject = "Your project has been assigned!";
	$message = "Your project with the web ID " . $_GET['webID'] . " has been assigned to the following marketing staff members:\n" . $_SESSION['webReqAssign'] . "\n If you haven't already you will receive an email indicating your job has been activated. \n\n Best Regards,\n Student Unions Marketing ";
	$from = "Requests";
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);
	}
	
	if ($_GET['updateStatus'] == "yes") {
	$queryStatus = "update webRequest set status = \"" . $_POST['newStatus'] . "\" where webID=" . $_GET['webID'] . ";";
	db_query($queryStatus);
	
		if ($_POST['newStatus'] == "Delete") {
			$queryDelete = "delete from webRequest where webID=" . $_GET['webID'] . ";";
			db_query($queryDelete);
			
			$queryDeleteComments = "delete from webComments where webID=" . $_GET['webID'] . ";";
			db_query($queryDeleteComments);
			}
	
	$queryWeb = "select * from webRequest where webID = " . $_GET['webID'] . "";
	$resultReq = db_query($queryWeb);
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	
	$to = $rowVal['contactEmail'];
	if ($_POST['newStatus'] == "Active") {
	$subject = "Your project has been activated!";
	$message = "The status of your project with the web ID " . $_GET['webID'] . " has been changed to " . $_POST['newStatus'] . "! You will receive an email giving you the details of which employees have been assigned to your job. \n\n Best Regards,\n Student Unions Marketing ";
	} else if ($_POST['newStatus'] == "Completed") {
	$subject = "Your project has been completed!";
	$message = "The status of your project with the web ID " . $_GET['webID'] . " has been changed to " . $_POST['newStatus'] . "! \n\n Best Regards,\n Student Unions Marketing ";
	}
	$from = "Requests";
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);
	}
	
	// print $rowVal['assignment']
	
	/*if (isset($_GET['ID']) && ($_GET['ID'] != "")) {
    
    $query = "select * from request where ID = " . $_GET['ID'] . "";
	$resultReq = mysql_query($query, $DBlink);
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	
		if ($rowVal['type'] == "dining") {
		
		}
	
		if ($rowVal['type'] == "event") {
		
		}
		
		if ($rowVal['type'] == "general") {
		
		} 
		
	}*/
	
	if (isset($_GET['webID']) && ($_GET['webID'] != "")) {
	
	$queryWeb = "select * from webRequest where webID = " . $_GET['webID'] . "";
	$resultReq = db_query($queryWeb);
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	
	print "<table border=\"0\" cellpadding=\"4\" cellspacing=\"1\" bgcolor=\"#333333\">";
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\" width=\"150px\">";
		print "Web Edit ID";
		print "</td>";
		print "<td style=\"color:#000\" width=\"600px\">";
		print $rowVal['webID'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
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
			print "<form action=\"backwebdetailsWeb.php?updateStatus=yes&amp;webID=" . $_GET['webID'] . "\" method=\"post\">";
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
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Rush Charge";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['rushCharge'];
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
		
		print "<tr style=\"background-color:#FFF\">";
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
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Web URL to be edited";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['webURL'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Description of Edits";
		print "</td>";
		print "<td style=\"color:#000\">";
		print $rowVal['webDesc'];
		print "</td>";
		print "</tr>";
		
		print "<tr style=\"background-color:#FFF\">";
		print "<td style=\"color:#000\">";
		print "Assigned To";
		print "</td>";
		print "<td style=\"color:#000\">";
			
			if ((($rowVal['assignment'] == "") || $_GET['editWeb'] == "yes") && $_SESSION['admin'] == true){
			?>
            <form action="backwebdetailsWeb.php?updateAssign=yes&amp;webID=<? print $_GET['webID'] ?>" method="post">
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
				print " [ <a href=\"backwebdetailsWeb.php?editWeb=yes&webID=" . $_GET['webID'] . "\">change</a> ]";
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
	$commentNumQuery = "select max(commentNum) from webComments where webID=\"" . $_GET['webID'] . "\"";
	$commentIDResult = db_query($commentNumQuery);
	$commentNum = mysql_result($commentIDResult, 0);
	$commentNum = $commentNum+1;
	
	$commentQuery = " insert into webComments set 
	webID =\"" . $_POST['webIDCom'] . "\",
	commentNum =\"" . $commentNum . "\",
	userPost =\"" . $_POST['user'] . "\", 
	date =\"" . $_POST['date'] . "\",
	comment =\"" . $_POST['comment'] . "\";";
	
	db_query($commentQuery);
	
	}
	
	?>
    <form action="backwebdetailsWeb.php?webID=<? print $_GET['webID'] ?>" method="post">
    <input type="hidden" name="webIDCom" value="<? print $_GET['webID'] ?>" />
    <input type="hidden" name="user" value="<? print $user[$id]['name'] ?>" />
    <input type="hidden" name="date" value="<? print date('j-F-Y, g:i') ?>"  />
    
    <textarea name="comment" cols="60" rows="5">Enter Comment Here</textarea><br /><br />
    <input type="submit" />
    
    </form>
    
    <?
	
	$queryCommentDisplay = "select * from webComments where webID=\"" . $_GET['webID'] . "\" order by commentNum desc";
	$resultComment = db_query($queryCommentDisplay);
	$comCount = mysql_num_rows($resultComment);
	
	//print $queryCommentDisplay;
	if ($comCount > 0) {
	?>
	
    <table border="0" cellpadding="4" cellspacing="1"  bgcolor="#333333">
    	<tr style="background-color:#003366">
        	<td style="color:#FFFFFF; width:100px;">
            Poster Name
            </td>
        	<td style="color:#FFFFFF; width:100px;">
            Date Posted
            </td>
            <td style="color:#FFFFFF; width:600px;">
            Comment
        	</td>
         </tr>
    
    
    
    <?
	
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
<?php 
page_finish(); 
}
?>