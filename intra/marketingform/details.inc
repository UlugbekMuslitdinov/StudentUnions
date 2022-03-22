<?php
$queryReq = "select * from Request where ID = " . $project_id . "";
  $resultReq = db_query($queryReq);
  $rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
  
  print "<table border=\"0\" cellpadding=\"4\" cellspacing=\"1\" bgcolor=\"#CCCCCC\">";
    print "<tr>";
    print "<td width=\"150px\">";
    print "<strong>Project ID</strong>";
    print "</td>";
    print "<td width=\"600px\">";
    print $rowVal['ID'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Type</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['type'];
    print "</td>";
    print "</tr>";
    
    
    print "<tr >";
    print "<td>";
    print "<strong>Status</strong>";
    print "</td>";
    print "<td>";
      print "<form action=\"http://union.arizona.edu/backwebdetailsMktg.php?updateStatus=yes&amp;ID=" . $project_id . "\" method=\"post\">";
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
    
    print "<tr >";
    print "<td>";
    print "<strong>Rush Charge</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['rushCharge'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td style=\"color:#cc0000\">";
    print "<strong>Due Date</strong>";
    print "</td>";
    print "<td style=\"color:#cc0000\">";
    print $rowVal['dueDateMonth'];
    print "&nbsp;/&nbsp;";
    print $rowVal['dueDateDay'];
    print "&nbsp;/&nbsp;";
    print $rowVal['dueDateYear'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Description of Request</strong>"; 
    print "</td>";
    print "<td>";
    print $rowVal['reqDesc'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Contact Name</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['contactName'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Contact Number</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['contactNumber'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Contact Email</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['contactEmail'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>FRS Account Number</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['acctFRS'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Marketing Budget</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['mktgBudget'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Primary Audience</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['primAudience'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Secondary Audience</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['secAudience'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Assigned To</strong>";
    print "</td>";
    print "<td>";
      
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
    
    print "<tr >";
    print "<td>";
    print "<strong>Time Remaining</strong>";
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
      $queryReq = "select * from diningReq where ID = " . $project_id . "";
      $resultReq = db_query($queryReq, $DBlink);
      $rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
    
    
    print "<tr >";
    print "<td>";
    print "<strong>11 x 17 Posters</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['1117posters'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Amount</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['amt1117'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>B/W or Color?</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['bwColor1117'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Large Format Posters</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['largeFormatPosters']  . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Amount</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['amtLargeFormat'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Large Format Size</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['lFSize'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Large Format Mount</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['lFMount'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>8.5 x 11 Flyers</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['8511Flyers'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Amount</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['amt8511'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>B/W or Color</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['bwColor8511'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Half-Page Handbills</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['hlfPage'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Amount</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['amtHlfPage'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>B/W or Color</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['bwColorHlfPage'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Quarter-Page Handbills</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['qtrPage'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Amount</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['amtQtrPage'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>B/W or Color</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['bwColorQtrPage'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Shelf Labels</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['shelfLabels'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Shelf Labels</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['amtShelfLabel'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>B/W or Color</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['bwColorShelfLabel'];
    print "</td>";
    print "</tr>";
      
      
    print "<tr >";
    print "<td>";
    print "<strong>Web Banner</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['webBanner'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Plasma Ads</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['plasmaAds'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Outdoor Banner</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['outdoorBanner'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Outdoor Banner Material</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['matOtdBanner'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>myPlace! Ads</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['myPlace'] . "</b>";
    print "</td>";
    print "</tr>";
      
    print "<tr >";
    print "<td>";
    print "<strong>myPlace Ad Dates</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['myPlaceDates'];
    print "</td>";
    print "</tr>";
      
    print "<tr >";
    print "<td>";
    print "<strong>Other</strong>";
    print "</td>";
    print "<td>";
    print "<b>" . $rowVal['other'] . "</b>";
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Other Desc</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['otherDesc'];
    print "</td>";
    print "</tr>";
      
      }
  
      if ($rowVal['type'] == "Event") {
      $queryReq = "select * from eventReq where ID = " . $project_id . "";
      $resultReq = db_query($queryReq);
      $rowVal = mysql_fetch_array($resultReq, MYSQL_ASSOC);
    
    print "<tr >";
    print "<td>";
    print "<strong>Event Title</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['eventTitle'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Event Location</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['eventLoc'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Event Price</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['eventPrice'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Event URL</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['eventURL'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Event Date</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['eventDate'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Event Time</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['eventTime'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Public Contact Name</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['pubContactName'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Public Contact Phone</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['pubContactPhone'];
    print "</td>";
    print "</tr>";
    
    print "<tr >";
    print "<td>";
    print "<strong>Public Contact Email</strong>";
    print "</td>";
    print "<td>";
    print $rowVal['pubContactEmail'];
    print "</td>";
    print "</tr>";
    
    }
  
  print "</table>";
