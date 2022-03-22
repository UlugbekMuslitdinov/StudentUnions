<?php

session_start();

/*
	if(!isset($_SERVER['HTTPS']))
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

$access = false;
	
//print $_SESSION['netID'];

include_once('access.php');
	
	for ($i = 1; $i <= $empCount; $i++) {
		if($_SESSION['netID'] == $user[$i]['netID']) {
		$access = true;
		$id = $i;
		}
	} 
	
	if ($access != true || $_SESSION['netID'] == "" || !isset($_SESSION['netID'])) {
	print "Access Denied";
	} else {
	 require('global.inc');
  $page_options['title'] = 'Union Marketing Request Form:';
  page_start($page_options);
	?>
	
    <div style="padding-left:20px;">
    <h4>Marketing Request Backweb</h4>
    
    <?
	
	print "<span style=\"font-size:14px; font-weight:bold\">" . $user[$id]['name'] . "</span><br>";
	
    require('marketing_db.inc');
	?>
    <a href="backweb.php">[ BackWeb Overview ]</a>
    <a href="backweblogin.php">[ BackWeb Login Page ]</a>
    <a href="logout.php">[ Logout ]</a>
	<?
	
	

	if ( (isset($_GET['Sort'])) && ($_GET['type'] == "mktgComp")) {
		$query = "select * from request where status=\"completed\" order by " . $_GET['Sort'] . ";";
		} else {
		$query = "select * from request where status=\"completed\" order by timeSubmit";
		}
	$resultReq = db_query($query);
    $num = mysql_num_rows($resultReq);
	
	//print $query;
	print "<h2>Completed Jobs</h2>";
	
	print "<table border=\"0\" cellpadding=\"4\" cellspacing=\"1\" bgcolor=\"#333333\">";
		print "<tr style=\"background-color:#003366;\">";
			print "<td style=\"color:#FFF\">";
			print "Request ID <a href=\"archive.php?Sort=timeSubmit&type=mktgComp\"><img src=\"images/triangle.gif\"></a>";
			print "</td>";
			print "<td style=\"color:#FFF\">";
			print "Type <a href=\"archive.php?Sort=Type&type=mktgComp\"><img src=\"images/triangle.gif\"></a>";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Due Date <a href=\"archive.php?Sort=dueDateYear,dueDateMonth,dueDateYear&type=mktgComp\"><img src=\"images/triangle.gif\"></a>";
			print "</td>";
			print "<td width=\"100px\" style=\"color:#FFF\">";
			print "Description";
			print "</td>";
			print "</td>";
			print "<td style=\"color:#FFF\">";
			print "Contact Name";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Contact Number";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Contact Email";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Billing Account";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Budget";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Primary Audience";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Secondary Audience";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Status";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Assigned to?";
			print "</td>";
			print "<td style=\"color:#FFF\">";
			print "Due Date";
			print "</td>";
		print "</tr>";
		
				
	for ($i = 1; $i <= $num; $i++) {
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	print "<tr style=\"background-color:#FFF\">";
		print "<td>";
		print "<a href=\"backwebdetailsMktg.php?ID=" . $rowVal['ID'] . "\">" . $rowVal['ID'] . "</a>";
		print "</td>";
		print "<td>";
		print $rowVal['type'];
		print "</td>";
		print "<td>";
		print $rowVal['dueDateMonth'];
		print "&nbsp;/&nbsp;";
		print $rowVal['dueDateDay'];
		print "&nbsp;/&nbsp;";
		print $rowVal['dueDateYear'];
		print "</td>";
		print "<td width=\"100px\">";
		print $rowVal['reqDesc'];
		print "</td>";
		print "<td>";
		print $rowVal['contactName'];
		print "</td>";
		print "<td>";
		print $rowVal['contactNumber'];
		print "</td>";
		print "<td>";
		print $rowVal['contactEmail'];
		print "</td>";
		print "<td>";
		print $rowVal['acctFRS'];
		print "</td>";
		print "<td>";
		print $rowVal['mktgBudget'];
		print "</td>";
		print "<td>";
		print $rowVal['primAudience'];
		print "</td>";
		print "<td>";
		print $rowVal['secAudience'];
		print "</td>";
		print "<td>";
		print $rowVal['status'];
		print "</td>";
		print "<td>";
		print $rowVal['assignment'];
		print "</td>";
		print "<td>";
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
		
		print "<font color=\"red\"><b>Job Expired " . $dueMonth . " " . $rowVal['dueDateDay'] . " " . $rowVal['dueDateYear'] . "</b></font>";
		
		print "</td>";
	print "</tr>";
		
	}
	
	print "</table>";
	
		if ( (isset($_GET['Sort'])) && ($_GET['type'] == "webComp")) {
		$queryWeb = "select * from webRequest where status=\"completed\" order by " . $_GET['Sort'] . ";";
		} else {
		$queryWeb = "select * from webRequest where status=\"completed\" order by timeSubmit;";
		}
		$resultReq = db_query($queryWeb);
    	$num = mysql_num_rows($resultReq);
	
	print "<h2>Completed Web Edits</h2>";
	
	print "<table border=\"0\" cellpadding=\"4\" cellspacing=\"1\" bgcolor=\"#333333\">";
		print "<tr style=\"background-color:#003366\">";
			print "<td style=\"color:#FFF\">";
			print "Web ID <a href=\"archive.php?Sort=timeSubmit&type=webComp\"><img src=\"images/triangle.gif\"></a>";
			print "</td>";
			print "<td style=\"color:#FFF\">";
			print "Type <a href=\"archive.php?Sort=Type&type=webComp\"><img src=\"images/triangle.gif\"></a>";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Due Date <a href=\"archive.php?Sort=dueDateYear,dueDateMonth,dueDateYear&type=webComp\"><img src=\"images/triangle.gif\"></a>";
			print "</td>";
			print "<td width=\"100px\" style=\"color:#FFF\">";
			print "Contact Name";
			print "</td>";
			print "<td style=\"color:#FFF\">";
			print "Contact Number";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Contact Email";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Web URL";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Web Desc";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Status";
			print "</td>";
			print "<td style=\"color:#FFF\">";	
			print "Assigned to?";
			print "</td>";
			print "<td style=\"color:#FFF\">";
			print "Due Date";
			print "</td>";
		print "</tr>";
		
				
	for ($i = 1; $i <= $num; $i++) {
	$rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
	print "<tr style=\"background-color:#FFF\">";
		print "<td>";
		print "<a href=\"backwebdetailsWeb.php?webID=" . $rowVal['webID'] . "\">" . $rowVal['webID'] . "</a>";
		print "</td>";
		print "<td>";
		print $rowVal['type'];
		print "</td>";
		print "<td>";
		print $rowVal['dueDateMonth'];
		print "&nbsp;/&nbsp;";
		print $rowVal['dueDateDay'];
		print "&nbsp;/&nbsp;";
		print $rowVal['dueDateYear'];
		print "</td>";
		print "<td>";
		print $rowVal['contactName'];
		print "</td>";
		print "<td>";
		print $rowVal['contactNumber'];
		print "</td>";
		print "<td>";
		print $rowVal['contactEmail'];
		print "</td>";
		print "<td>";
		print $rowVal['webURL'];
		print "</td>";
		print "<td>";
		print $rowVal['webDesc'];
		print "</td>";
		print "<td>";
		print $rowVal['status'];
		print "</td>";
		print "<td>";
		print $rowVal['assignment'];
		print "</td>";
		print "<td>";
		
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
		
		print "<font color=\"red\"><b>Job Expired " . $dueMonth . " " . $rowVal['dueDateDay'] . " " . $rowVal['dueDateYear'] . "</b></font>";
		
		print "</td>";
	print "</tr>";
		
	}
	
	print "</table>";
	
	
	?>
    </div>
<?php 
page_finish(); 
}




?>
    