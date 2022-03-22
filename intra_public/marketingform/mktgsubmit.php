<?php
  session_start();
  
  $_SESSION['timeSubmit'] = $_POST['timeSubmit']; 
  
  $_SESSION['incStudent'] = $_POST['incStudent'];
  $_SESSION['curStudent'] = $_POST['curStudent'];
  $_SESSION['faculty'] = $_POST['faculty'];
  $_SESSION['alumni'] = $_POST['alumni'];
  $_SESSION['parents'] = $_POST['parents'];
  $_SESSION['community'] = $_POST['community'];
  $_SESSION['staff'] = $_POST['staff'];
  $_SESSION['donors'] = $_POST['donors'];
  if ($_POST['others'] == true) {
    $_SESSION['others'] = "Others - ";
    $_SESSION['otherDetSec'] = $_POST['otherDetSec'];
  }else{
    $_SESSION['others'] = "";
    }
  
  if($_POST['incStudent'] == true) {
  $_SESSION['incStudent'] = "Incoming students, ";
  }
  
  if($_POST['curStudent'] == true) {
  $_SESSION['curStudent'] = "Current students, ";
  }
  
  if($_POST['alumni'] == true) {
  $_SESSION['alumni'] = "Alumni, ";
  }
  
  if($_POST['parents'] == true) {
  $_SESSION['parents'] = "Parents, ";
  }
  
  if($_POST['community'] == true) {
  $_SESSION['community'] = "Community, ";
  }
  
  if($_POST['staff'] == true) {
  $_SESSION['staff'] = "staff, ";
  }
  
  if($_POST['donors'] == true) {
  $_SESSION['donors'] = "donors, ";
  }
  
  
  $_SESSION['secAudience'] = $_SESSION['curStudent'] . $_SESSION['incStudent'] . $_SESSION['alumni'] . $_SESSION['parents'] . $_SESSION['community'] . $_SESSION['staff'] . $_SESSION['donors'] . $_POST['others'] . $_SESSION['otherDetSec'];
  
  
  if((isset($_POST['type'])) || ($_POST['type'] != "")) {
  $_SESSION['type'] = $_POST['type'];
  }else{
  $error1 = true;
  $errortext[1] = "You did not sepcify the type of event<br>";
  }
  
  if((isset($_POST['dueDateMonth'])) && ($_POST['dueDateMonth'] != "")) {
  $_SESSION['dueDateMonth'] = $_POST['dueDateMonth'];
  }else{
  $error2 = true;
  $errortext[2] = "You did not enter a valid due date for your request<br>";
  }
  
  
  if((isset($_POST['dueDateDay'])) && ($_POST['dueDateDay'] != "")) {
  $_SESSION['dueDateDay'] = $_POST['dueDateDay'];
  }else{
  $error3 = true;
  $errortext[3] = "You did not enter a valid due date month for your request<br>";
  }
  
  
  if((isset($_POST['dueDateYear'])) && ($_POST['dueDateYear'] != "")) {
  $_SESSION['dueDateYear'] = $_POST['dueDateYear'];
  }else{
  $error4 = true;
  $errortext[4] = "You did not enter a valid due date year for your request<br>";
  }
  
  
  if((isset($_POST['reqDesc'])) && ($_POST['reqDesc'] != "") && ($_POST['reqDesc'] != "Enter description here")) {
  $_SESSION['reqDesc'] = $_POST['reqDesc'];
  } else if ($_SESSION['type'] != "webEdits" ){
  $error5 = true;
  $errortext[5] = "You did not describe your request<br>";
  }
  
  if((isset($_POST['contactName'])) && ($_POST['contactName'] != "")) {
  $_SESSION['contactName'] = $_POST['contactName'];
  }else{
  $error6 = true;
  $errortext[6] = "You did not specify a contact name<br>";
  }
    
  if((isset($_POST['contactNumber'])) && ($_POST['contactNumber'] != "")) {
  $_SESSION['contactNumber'] = $_POST['contactNumber'];
  }else{
  $error7 = true;
  $errortext[7] = "You did not specify a contact name<br>";
  }
    
  if((isset($_POST['contactEmail'])) && ($_POST['contactEmail'] != "")) {
  $_SESSION['contactEmail'] = $_POST['contactEmail'];
  }else{
  $error8 = true;
  $errortext[8] = "You did not specify a contact email<br>";
  }
   
  if((isset($_POST['acctFRS'])) && ($_POST['acctFRS'] != "")) {
  $_SESSION['acctFRS'] = $_POST['acctFRS'];
  }else if ($_SESSION['type'] != "webEdits") {
  $error9 = true;
  $errortext[9] = "You did not enter a FRS account number<br>";
  }
  
  if((isset($_POST['mktgBudget'])) && ($_POST['mktgBudget'] != "")) {
  $_SESSION['mktgBudget'] = $_POST['mktgBudget'];
  }else if ($_SESSION['type'] != "webEdits") {
  $error10 = true;
  $errortext[10] = "You did not specify a budget for your project<br>";
  }
  
  if((isset($_POST['primAudience'])) && ($_POST['primAudience'] != "")) {
  $_SESSION['primAudience'] = $_POST['primAudience'];
  }else if ($_SESSION['type'] != "webEdits") {
  $error11 = true;
  $errortext[11] = "You did not specify a budget for your project<br>";
  }
  
  if($_SESSION['primAudience'] == "others") {
    if((isset($_POST['otherDetPrim'])) && ($_POST['otherDetPrim'] != "")) {
    $_SESSION['otherDetPrim'] = $_POST['otherDetPrim'];
    }else if ($_SESSION['type'] != "webEdits") {
    $error12 = true;
    $errortext[12] = "You did not specify who the \"other\" primary audience is<br>";
    }
  }
  
  if($_SESSION['others'] == "Others - ") {
    if((isset($_POST['otherDetSec'])) && ($_POST['otherDetSec'] != "")) {
    $_SESSION['otherDetSec'] = $_POST['otherDetSec'];
    } else if ($_SESSION['type'] != "webEdits") {
    $error13 = true;
    $errortext[13] = "You did not specify who the \"other\" secondary audience is<br>";
    }
  }
  
  
  
  
  if ($_POST['type'] == "Event") {
    if((isset($_POST['eventTitle'])) && ($_POST['eventTitle'] != "")) {
    $_SESSION['eventTitle'] = $_POST['eventTitle'];
    }else{
    $error14 = true;
    $errortext[14] = "You did not specify an event title<br>";
    }
    
    
    if((isset($_POST['eventLoc'])) && ($_POST['eventLoc'] != "")) {
    $_SESSION['eventLoc'] = $_POST['eventLoc'];
    }
    else{
    $error15 = true;
    $errortext[15] = "You did not specify an event location<br>";
    }
    
    if((isset($_POST['eventPrice'])) && ($_POST['eventPrice'] != "")) {
    $_SESSION['eventPrice'] = $_POST['eventPrice'];
    }
    else{
    $error16 = true;
    $errortext[16] = "You did not specify a price for your event<br>";
    }
    
    if((isset($_POST['eventURL'])) && ($_POST['eventURL'] != "")) {
    $_SESSION['eventURL'] = $_POST['eventURL'];
    }
    
    if((isset($_POST['eventDate'])) && ($_POST['eventDate'] != "")) {
    $_SESSION['eventDate'] = $_POST['eventDate'];
    }else{
    $error17 = true;
    $errortext[17] = "You did not specify the time of the event<br>";
    }
    
    if((isset($_POST['eventTime'])) && ($_POST['eventTime'] != "")) {
    $_SESSION['eventTime'] = $_POST['eventTime'];
    }else{
    $error18 = true;
    $errortext[18] = "You did not specify the time of the event<br>";
    }
    
    
    if((isset($_POST['pubContactName'])) && ($_POST['pubContactName'] != "")) {
    $_SESSION['pubContactName'] = $_POST['pubContactName'];
    }else{
    $error19 = true;
    $errortext[19] = "You did not specify a public contact name<br>";
    }
    
    if((isset($_POST['pubContactPhone'])) && ($_POST['pubContactPhone'] != "")) {
    $_SESSION['pubContactPhone'] = $_POST['pubContactPhone'];
    }else{
    $error20 = true;
    $errortext[20] = "You did not specify a public contact phone<br>";
    }
    
    
    if((isset($_POST['pubContactEmail'])) && ($_POST['pubContactEmail'] != "")) {
    $_SESSION['pubContactEmail'] = $_POST['pubContactEmail'];
    }else{
    $error21 = true;
    $errortext[21] = "You did not specify a public contact email<br>";
    }
  }
  
  
  
  if ($_POST['type'] == "Dining") {
    
    $_SESSION['1117posters'] = $_POST['1117posters'];
    if($_POST['1117posters'] == true) {
    
      if((isset($_POST['amt1117'])) && ($_POST['amt1117'] != "")) {
      $_SESSION['amt1117'] = $_POST['amt1117'];
      }else{
      $error22 = true;
      $errortext[22] = "You did not specify an amount for the posters<br>";
      }
    
      if((isset($_POST['bwColor1117'])) && ($_POST['bwColor1117'] != "")) {
      $_SESSION['bwColor1117'] = $_POST['bwColor1117'];
      }else{
      $error23 = true;
      $errortext[23] = "You did not specify whether the posters should be black/white or color<br>";
      }
    }
    
    
    $_SESSION['largeFormatPosters'] = $_POST['largeFormatPosters'];
    if($_POST['largeFormatPosters'] == true) {
      
      if((isset($_POST['amtLargeFormat'])) && ($_POST['amtLargeFormat'] != "")) {
      $_SESSION['amtLargeFormat'] = $_POST['amtLargeFormat'];
      }else{
      $error24 = true;
      $errortext[24] = "You did not specify an amount for the posters<br>";
      }
      
      if((isset($_POST['lFSize'])) && ($_POST['lFSize'] != "")) {
      $_SESSION['lFSize'] = $_POST['lFSize'];
      }else{
      $error25 = true;
      $errortext[25] = "You did not specify a size for the posters<br>";
      }
      
      if((isset($_POST['lFMount'])) && ($_POST['lFMount'] != "")) {
      $_SESSION['lFMount'] = $_POST['lFMount'];
      }
    }
    
    
    $_SESSION['8511Flyers'] = $_POST['8511Flyers'];
    if($_POST['8511Flyers'] == true) {
    
      if((isset($_POST['amt8511'])) && ($_POST['amt8511'] != "")) {
      $_SESSION['amt8511'] = $_POST['amt8511'];
      }else{
      $error26 = true;
      $errortext[26] = "You did not specify an amount for the flyers<br>";
      }
      
      if((isset($_POST['bwColor8511'])) && ($_POST['bwColor8511'] != "")) {
      $_SESSION['bwColor8511'] = $_POST['bwColor8511'];
      }else{
      $error27 = true;
      $errortext[27] = "You did not specify whether the flyers should be black/white or color<br>";
      }
    }
    
    $_SESSION['hlfPage'] = $_POST['hlfPage'];
    if($_POST['hlfPage'] == true) {
    
      if((isset($_POST['amtHlfPage'])) && ($_POST['amtHlfPage'] != "")) {
      $_SESSION['amtHlfPage'] = $_POST['amtHlfPage'];
      }else{
      $error28 = true;
      $errortext[28] = "You did not specify an amount for the half-page handbills<br>";
      }
      
      if((isset($_POST['bwColorHlfPage'])) && ($_POST['bwColorHlfPage'] != "")) {
      $_SESSION['bwColorHlfPage'] = $_POST['bwColorHlfPage'];
      }else{
      $error29 = true;
      $errortext[29] = "You did not specify whether the half-page handbills should be black/white or color<br>";
      }
    }
    
    $_SESSION['qtrPage'] = $_POST['qtrPage'];
    if($_POST['qtrPage'] == true) {

      if((isset($_POST['amtQtrPage'])) && ($_POST['amtQtrPage'] != "")) {
      $_SESSION['amtQtrPage'] = $_POST['amtQtrPage'];
      }else{
      $error30 = true;
      $errortext[30] = "You did not specify an amount for the qaurter-page handills<br>";
      }
      
      if((isset($_POST['bwColorQtrPage'])) && ($_POST['bwColorQtrPage'] != "")) {
      $_SESSION['bwColorQtrPage'] = $_POST['bwColorQtrPage'];
      }else{
      $error31 = true;
      $errortext[31] = "You did not specify whether the qaurter-page handills should be black/white or color<br>";
      }
    }
    
    
    $_SESSION['shelfLabel'] = $_POST['shelfLabel'];
    if($_POST['shelfLabel'] == true) {
    
      if((isset($_POST['amtShelfLabel'])) && ($_POST['amtShelfLabel'] != "")) {
      $_SESSION['amtShelfLabel'] = $_POST['amtShelfLabel'];
      }else{
      $error32 = true;
      $errortext[32] = "You did not specify an amount for the shelf labels<br>";
      }
      
      if((isset($_POST['bwColorShelfLabel'])) && ($_POST['bwColorShelfLabel'] != "")) {
      $_SESSION['bwColorShelfLabel'] = $_POST['bwColorShelfLabel'];
      }else{
      $error33 = true;
      $errortext[33] = "You did not specify whether the shelf labels should be black/white or color<br>";
      }
    }
    
    $_SESSION['tabTents'] = $_POST['tabTents'];
    if ($_POST['tabTents'] == true){
    
      if((isset($_POST['amtTabTents'])) && ($_POST['amtTabTents'] != "")) {
      $_SESSION['amtTabTents'] = $_POST['amtTabTents'];
      }else{
      $error34 = true;
      $errortext[34] = "You did not specify an amount for the table tents<br>";
      }
      
      if((isset($_POST['bwColorTabTents'])) && ($_POST['bwColorTabTents'] != "")) {
      $_SESSION['bwColorTabTents'] = $_POST['bwColorTabTents'];
      }else{
      $error35 = true;
      $errortext[35] = "You did not specify whether the table tents should be black/white or color<br>";
      }
    }
    
    
    $_SESSION['webBanner'] = $_POST['webBanner'];
    
    $_SESSION['plasmaAds'] = $_POST['plasmaAds'];
    
    $_SESSION['outdoorBanner'] = $_POST['outdoorBanner'];
    if((isset($_POST['outdoorBanner'])) && ($_POST['outdoorBanner'] == true)) {
      
      if((isset($_POST['matOtdBanner'])) && ($_POST['matOtdBanner'] != "")) {
      $_SESSION['matOtdBanner'] = $_POST['matOtdBanner'];
      }
    }
    
    
    
    $_SESSION['myPlace'] = $_POST['myPlace'];
    if($_POST['myPlace'] == true) {
    
      if($_POST['myPlaceDates'] == true) {
      $_SESSION['myPlaceDates'] = $_POST['myPlaceDates'];
      }else{
      $error36 = true;
      $errortext[36] = "You did not specify dates for the myPlace ad<br>";
      }
    }
    
    $_SESSION['other'] = $_POST['other'];
    if($_POST['other'] == true) {
    
      if((isset($_POST['otherDesc'])) && ($_POST['otherDesc'] != "") && ($_POST['otherDesc'] != "Enter description here")) {
      $_SESSION['otherDesc'] = $_POST['otherDesc'];
      }else{
      $error37 = true;
      $errortext[37] = "You did describe your other request<br>";
      }
    }
  }
  
  if($_POST['type'] == "webEdits") {
  
  
    if((isset($_POST['webURL'])) && ($_POST['webURL'] != "")) {
    $_SESSION['webURL'] = $_POST['webURL'];
    }else{
    $error38 = true;
    $errortext[38] = "You did not specify a URL for the page require edits for<br>";
    }
    
    /*if((isset($_POST['numWebPages'])) && ($_POST['numWebPages'] != "")) {
    $_SESSION['numWebPages'] = $_POST['numWebPages'];
    }else{
    $error39 = true;
    $errortext[39] = "You did not specify how many seperate pages will need editing<br>";
    }*/
    
      if((isset($_POST['webDesc'])) && ($_POST['webDesc'] != "") && ($_POST['webDesc'] != "Enter description here")) {
      $_SESSION['webDesc'] = $_POST['webDesc'];
      }else{
      $error40 = true;
      $errortext[40] = "You did not define the required web edits<br>";
      }
  }

  
   require('global.inc');
  $page_options['title'] = 'Union Marketing Request Form:';
  page_start($page_options);
  
    $error = false;
    
  
    for ($i = 1; $i < 41; $i++) {
      print "<div style=\"padding-left:20px\">";
      print "<font color=\"red\">";
      if (isset($errortext[$i]) && $errortext[$i] != "") {
      $error = true;
      print $errortext[$i];
        }
      print "</font>";
      print "</div>";
    }
    
    
  
  
  
  
  /*if(!isset($_SERVER['HTTPS']))
    {
       header("location: https://www.union.arizona.edu/csil/accolades/backweb/bwresultsindv.php");
    }

  session_start();
  if(!isset($_SESSION['netID'])){

  if(!isset($_GET['ticket'])) {
    header("Location: https://webauth.arizona.edu/webauth/login?service=https://www.union.arizona.edu/csil/accolades/backweb/bwresultsindv.php");
  }else {
    
    $tix = $_GET['ticket'];
    $url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=https://www.union.arizona.edu/csil/accolades/equiss/backweb/bwresultsindv.php"';
    exec("curl -m 120 $url " ,$return_message_array, $return_number);
    
  
    $netID = $return_message_array[2];
  
    $netID = trim(str_replace("<cas:user>","",str_replace("</cas:user>","", $netID)));
    $_SESSION['netID'] = $netID;
  }
}*/



//Code for rush charge and countdown

print "<div style=\"padding-left:20px\">";
//Set up this way so that strtotime can read it in correctly, but the numeric value in the database allow mySql to sort by it correctly. 
    if ($_SESSION['dueDateMonth'] == "1") { $dueMonth = "January"; }
    if ($_SESSION['dueDateMonth'] == "2") { $dueMonth = "February"; }
    if ($_SESSION['dueDateMonth'] == "3") { $dueMonth = "March"; }
    if ($_SESSION['dueDateMonth'] == "4") { $dueMonth = "April"; }
    if ($_SESSION['dueDateMonth'] == "5") { $dueMonth = "May"; }
    if ($_SESSION['dueDateMonth'] == "6") { $dueMonth = "June"; }
    if ($_SESSION['dueDateMonth'] == "7") { $dueMonth = "July"; }
    if ($_SESSION['dueDateMonth'] == "8") { $dueMonth = "August"; }
    if ($_SESSION['dueDateMonth'] == "9") { $dueMonth = "September"; }
    if ($_SESSION['dueDateMonth'] == "10") { $dueMonth = "October"; }
    if ($_SESSION['dueDateMonth'] == "11") { $dueMonth = "November"; }
    if ($_SESSION['dueDateMonth'] == "12") { $dueMonth = "December"; }

    $timePosted = strtotime($dueMonth . " " . $_SESSION['dueDateDay'] . " " . $_SESSION['dueDateYear']);
    $diff = $timePosted  - $_SESSION['timeSubmit'];
    $diffDays = round($diff/60/60/24);
    $diffHours = ($diff/60/60);
    $diffHoursReal = round(24 * (($diffHours / 24) - (floor($diffHours / 24))));
/*print "<br>";
print $diffDays . " Days " . $diffHoursReal . " Hours";
print "<br>";*/

/*
print $diffDays;
print " Days ";
print $diffHoursReal;
print " Hours ";
*/
  $rushCharge = false;

if (($diffDays < 14) && ($diffDays > 2)) {
  $rushCharge = true;
  print "Note: You will incur a $50 rush charge since your request has less than 14 days to be completed<br>";
  
  }else if ($diffDays < 2) {
  print "Please contact Fast Copy directly, your time window is too small to submit this request online";
  $error = true;
  }else {
  $rushCharge = 0;
  }

  if ($error == true) {
  include_once('index.php');
  
  } else if (($_SESSION['type'] != "webEdits") && $error != true) {
  print "Your marketing request has been received!<br>";
  print "The request will be assigned to one of our employees, and you will be contacted shortly";
  
  print "<br><br>";
  
  print "<strong>Information</strong>";
  print "<br>";
  
  print "<table width=\"500px\">";
  print "<tr>";
  print "<td>";
  print "Request Type";
  print "</td>";
  print "<td>";
  print $_SESSION['type'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Due Date:";
  print "</td>";
  print "<td>";
  print $_SESSION['dueDateMonth'] ." / " . $_SESSION['dueDateDay'] . " / " . $_SESSION['dueDateYear'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Request Description:";
  print "</td>";
  print "<td>";
  print $_SESSION['reqDesc'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Contact Name:";
  print "</td>";
  print "<td>";
  print $_SESSION['contactName'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Contact Number:";
  print "</td>";
  print "<td>";
  print $_SESSION['contactNumber'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Contact Email:";
  print "</td>";
  print "<td>";
  print $_SESSION['contactEmail'] ;
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "FRS Account Numer";
  print "</td>";
  print "<td>";
  print $_SESSION['acctFRS'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Marketing Budget";
  print "</td>";
  print "<td>";
  print $_SESSION['mktgBudget'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Primary Audience";
  print "</td>";
  print "<td>";
  print $_SESSION['primAudience'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Secondary Audience";
  print "</td>";
  print "<td>";
  print $_SESSION['secAudience'];
  print "</td>";
  print "</tr>";
  
  print "<tr>";
  print "<td>";
  print "Rush Charge";
  print "</td>";
  print "<td>";
  print $rushCharge;
  print "</td>";
  print "</tr>";
  
  } else if (($_SESSION['type'] == "webEdits") && $error != true) { 
  
  print "Your marketing web request has been received!<br>";
  print "The request will be assigned to one of our employees, and you will be contacted shortly";
  
  print "<br><br>";
  
  print "<strong>Information</strong>";
  print "<br>";
  
  print "<table width=\"500px\">";
  print "<tr>";
  print "<td>";
  print "Request Type";
  print "</td>";
  print "<td>";
  print $_SESSION['type'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Due Date:";
  print "</td>";
  print "<td>";
  print $_SESSION['dueDateMonth'] ." " . $_SESSION['dueDateDay'] . " " . $_SESSION['dueDateYear'];
  print "</td>";
  print "</tr>";
  
  print "<td>";
  print "Contact Name:";
  print "</td>";
  print "<td>";
  print $_SESSION['contactName'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Contact Number:";
  print "</td>";
  print "<td>";
  print $_SESSION['contactNumber'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Contact Email:";
  print "</td>";
  print "<td>";
  print $_SESSION['contactEmail'] ;
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Web Page URL";
  print "</td>";
  print "<td>";
  print $_SESSION['webURL'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Web Edit Description";
  print "</td>";
  print "<td>";
  print $_SESSION['webDesc'];
  print "</td>";
  print "</tr>";
  
  }
  
  print "</table>";
  
  if ($error != true) {
  
  require('../../intra/marketingform/marketing_db.inc');
      
      if ($_SESSION['type'] != "webEdits") {
      $query = "INSERT INTO request SET"
          . " type = \""            . $_SESSION['type']
          . "\", dueDateMonth = \""     . $_SESSION['dueDateMonth']
          . "\", dueDateDay = \""       . $_SESSION['dueDateDay']
          . "\", dueDateYear = \""      . $_SESSION['dueDateYear']
          . "\", reqDesc = \""        . $_SESSION['reqDesc']
          . "\", timeSubmit = \""       . $_SESSION['timeSubmit']
          . "\", contactName = \""      . $_SESSION['contactName']
          . "\", status = \"New"
          . "\", contactNumber = \""      . $_SESSION['contactNumber']
          . "\", contactEmail = \""     . $_SESSION['contactEmail']
          . "\", acctFRS = \""        . $_SESSION['acctFRS']
          . "\", mktgBudget = \""       . $_SESSION['mktgBudget']
          . "\", primAudience = \""     . $_SESSION['primAudience']
          . "\", secAudience = \""      . $_SESSION['secAudience']
          . "\", rushCharge = \""       . $rushCharge  . "\";"; 
      db_query($query);   
      $project_id = mysql_insert_id();
      $to = 'create@email.arizona.edu';
      $subject = "New Marketing Request Pending!";
      $message = "A new marketing request was created with the following information: \n " . $_SESSION['contactName'] 
      . " has posted a general request which is desired to be ready by " . $_SESSION['dueDateMonth'] . " / " . $_SESSION['dueDateDay'] . " / " . $_SESSION['dueDateYear'] . "\n\n The job's brief description is as follows:\n" . $_SESSION['reqDesc'] . ". \n\n Please log into the marketing request portal for all relevant information";
      $message .= '<br>Details  can be found <a href="https://union.arizona.edu/intra/marketingform/backwebdetailsMktg.php?ID='.$project_id.'">here</a>.';
      ob_start();
      require('../../intra/marketingform/details.inc');
      $message .= ob_get_clean(); 
      $from = "Requests";
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= "From: $from";
      mail($to,$subject,$message,$headers);
      
      $to = $_SESSION['contactEmail'];
      $subject = "New Marketing Request Confirmation";
      $message = "Your marketing request has been succesfully received and will be reviewed as soon as possible. Your general request which is requested to be complete on " . $_SESSION['dueDateMonth'] . " / " . $_SESSION['dueDateDay'] . " / " . $_SESSION['dueDateYear'] . "\n\n The job's brief description is as follows:\n" . $_SESSION['reqDesc'] . ". \n\n If there is any discrepency between this information and the job you posted, please contact the marketing department at (520) 626-1238 or by email at create@email.arizona.edu";
      $from = "Requests";
      $headers = "From: $from";
      mail($to,$subject,$message,$headers);
        
        } else {
        
      $query = "INSERT INTO webRequest SET"
          . " type = \""            . $_SESSION['type']
          . "\", dueDateMonth = \""     . $_SESSION['dueDateMonth']
          . "\", dueDateDay = \""       . $_SESSION['dueDateDay']
          . "\", dueDateYear = \""      . $_SESSION['dueDateYear']
          . "\", timeSubmit = \""       . $_SESSION['timeSubmit']
          . "\", contactName = \""      . $_SESSION['contactName']
          . "\", contactNumber = \""      . $_SESSION['contactNumber']
          . "\", contactEmail = \""     . $_SESSION['contactEmail']
          . "\", status = \"New"
          . "\", webURL = \""         . $_SESSION['webURL']
          . "\", webDesc = \""        . $_SESSION['webDesc'] 
          . "\", rushCharge = \""       . $rushCharge ."\";"; 
      
      db_query($query);
        
      $to = 'sanorris@email.arizona.edu';
      $subject = "New Marketing Request Pending!";
      $message = "A new marketing request was created with the following information: \n " . $_SESSION['contactName'] . " has posted a general request which is desired to be ready by " . $_SESSION['dueDateMonth'] . " / " . $_SESSION['dueDateDay'] . " / " . $_SESSION['dueDateYear'] . "\n\n The changes requested apply to page(s) at the following URL: " . $_SESSION['webURL'] . "\n The job's brief description is as follows: \n" . $_SESSION['webDesc'] . " \n\n Please log into the marketing request portal for all relevant information";
      $message .= '<br>Details  can be found <a href="https://union.arizona.edu/intra/marketingform/backwebdetailsMktg.php?ID='.mysql_insert_id().'">here</a>.'; 
      $from = "Requests";
      $headers = "From: $from";
      mail($to,$subject,$message,$headers);
      
      $to = $_SESSION['contactEmail'];
      $subject = "New Marketing Request Confirmation";
      $message = "Your marketing request has been succesfully received and will be reviewed as soon as possible. Your general request which is requested to be complete on " . $_SESSION['dueDateMonth'] . " / " . $_SESSION['dueDateDay'] . " / " . $_SESSION['dueDateYear'] . "\n\n The you have requested the following edits:\n" . $_SESSION['reqDesc'] . ". \n\n To the following website:\n" . $_SESSION['webURL'] . "\n If there is any discrepency between this information and the job you posted, please contact the marketing department at (520) 626-1238 or by email at sanorris@email.arizona.edu";
      $from = "Requests";
      $headers = "From: $from";
      mail($to,$subject,$message,$headers);
        
        }
      
      
      
      
  
    
  
    
    
    
    
  if ($_SESSION['type'] == "Dining"){
  
  print "<br>";
  print "<strong>Requested Dining Items</strong>";
    
  print "<table width=\"500px\">";
  
  if ($_SESSION['1117posters'] == true) {
  print "<tr>";
  print "<td width=\"150px\">";
  print "<strong>11 x 17 Posters</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Amount:";
  print "</td>";
  print "<td>";
  print $_SESSION['amt1117'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Blacke-White / Color:";
  print "</td>";
  print "<td>";
  print $_SESSION['bwColor1117'];
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['largeFormatPosters'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Large Format Posters</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Amount:";
  print "</td>";
  print "<td>";
  print $_SESSION['amtLargeFormat'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Size:";
  print "</td>";
  print "<td>";
  print $_SESSION['lFSize'];
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['8511Flyers'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>8.5 x 11 Flyers</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Amount:";
  print "</td>";
  print "<td>";
  print $_SESSION['amt8511'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Blacke-White / Color:";
  print "</td>";
  print "<td>";
  print $_SESSION['bwColor8511'];
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['qtrPage'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Quarter Page</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Amount:";
  print "</td>";
  print "<td>";
  print $_SESSION['amtQtrPage'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Blacke-White / Color:";
  print "</td>";
  print "<td>";
  print $_SESSION['bwColorQtrPage'];
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['shelfLabel'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Shelf Labels</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Amount:";
  print "</td>";
  print "<td>";
  print $_SESSION['amtShelfLabel'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Blacke-White / Color:";
  print "</td>";
  print "<td>";
  print $_SESSION['bwColorShelfLabel'];
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['tabTents'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Table Tents</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Amount:";
  print "</td>";
  print "<td>";
  print $_SESSION['amtTabTents'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Blacke-White / Color:";
  print "</td>";
  print "<td>";
  print $_SESSION['bwColorTabTents'];
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['webBanner'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Web Banner</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['plasmaAds'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Plasma Ads</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  }
  
  if ($_SESSION['outdoorBanner'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Outdoor Banner</strong>:";
  print "</td>";
  print "</tr>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Material for outdoor banner";
  print "</td>";
  print "<td>";
  print $_SESSION['matOtdBanner'];
  print "</td>";
  print "</tr>";
  }
  
  
  if ($_SESSION['myPlace'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>myPlace! Ads</strong>";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Dates for myPlace! Ads:";
  print "</td>";
  print "<td>";
  print $_SESSION['myPlaceDates'];
  print "</td>";
  print "</tr>";
  }
  
  
  if ($_SESSION['other'] == true) {
  print "<tr>";
  print "<td>";
  print "<strong>Other advertising materials</strong>:";
  print "</td>";
  print "<td>";
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Description of these advertising materials:";
  print "</td>";
  print "<td>";
  print $_SESSION['otherDesc'];
  print "</td>";
  print "</tr>";
  }
  
  print "</table>";
    
    $queryReq = "SELECT max(ID) FROM request";
    $ID = db_query($queryReq);
    $IDnum = mysql_result($ID,0,"max(id)");
    $project_id = $IDnum;
    $to = 'create@email.arizona.edu, mburton@email.arizona.edu';
    //$to = 'create@email.arizona.edu, jmasson@email.arizona.edu';
    $subject = "New Marketing Request Pending!";
    $message = "A new marketing request was created with the following information: \n\n" . $_SESSION['contactName'] 
    . " has posted a general request which is desired to be ready by" . $_SESSION['dueDateMonth'] . " / " . $_SESSION['dueDateDay'] . " / " . $_SESSION['dueDateYear'] . "\n\n The job's brief description is as follows\n:" 
    . $_SESSION['reqDesc'] . ". \n\n Please log into the marketing request portal for all relevant information";
    ob_start();
    require('../../intra/marketingform/details.inc');
    $message .= ob_get_clean();
    $from = "Marketing Requests";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: $from";
    mail($to,$subject,$message,$headers);

    
    
    $queryDin = "INSERT INTO diningReq SET"
          . " ID = \""            . $IDnum
          . "\", 1117posters = \""      . $_SESSION['1117posters']
          . "\", amt1117 = \""        . $_SESSION['amt1117']
          . "\", bwColor1117 = \""      . $_SESSION['bwColor1117']
          . "\", largeFormatPosters = \""   . $_SESSION['largeFormatPosters']
          . "\", amtLargeFormat = \""     . $_SESSION['amtLargeFormat']
          . "\", lFSize = \""         . $_SESSION['lFSize']
          . "\", lFMount = \""        . $_SESSION['lFMount']
          . "\", 8511Flyers = \""       . $_SESSION['8511Flyers']
          . "\", amt8511 = \""        . $_SESSION['amt8511']
          . "\", bwColor8511 = \""      . $_SESSION['bwColor8511']
          . "\", hlfPage  = \""       . $_SESSION['hlfPage']
          . "\", amtHlfPage = \""       . $_SESSION['amtHlfPage']
          . "\", bwColorHlfPage = \""     . $_SESSION['bwColorHlfPage']
          . "\", qtrPage  = \""       . $_SESSION['qtrPage']
          . "\", amtQtrPage = \""       . $_SESSION['amtQtrPage']
          . "\", bwColorQtrPage = \""     . $_SESSION['bwColorQtrPage']
          . "\", shelfLabels = \""      . $_SESSION['shelfLabels']
          . "\", amtShelfLabel = \""      . $_SESSION['amtShelfLabel']
          . "\", bwColorShelfLabel  = \""   . $_SESSION['bwColorShelfLabel']
          . "\", tabTents = \""       . $_SESSION['tabTents']
          . "\", bwColorTabTents = \""    . $_SESSION['bwColorTabTents']
          . "\", webBanner = \""        . $_SESSION['webBanner']
          . "\", plasmaAds = \""        . $_SESSION['plasmaAds']
          . "\", outdoorBanner = \""      . $_SESSION['outdoorBanner']
          . "\", matOtdBanner = \""     . $_SESSION['matOtdBanner']
          . "\", myPlace = \""        . $_SESSION['myPlace']
          . "\", myPlaceDates = \""     . $_SESSION['myPlaceDates']
          . "\", other = \""          . $_SESSION['other']
          . "\", otherDesc  = \""       . $_SESSION['otherDesc'] ."\";";  
      
    db_query($queryDin);
    }
    
    
    if ($_SESSION['type'] == "Event"){
    /*$to = 'create@email.arizona.edu';
    $subject = "New Marketing Request Pending!";
    $message = "A new marketing request was created with the following information: \n\n" . $_SESSION['contactName'] 
    . " has posted a general request which is desired to be ready by" . $_SESSION['dueDateMonth'] . " " . $_SESSION['dueDateDay'] . " " . $_SESSION['dueDateYear'] . "\n\n The job's brief description is as follows\n:" 
    . $_SESSION['reqDesc'] . ". \n\n Please log into the marketing request portal for all relevant information";
    $from = "Marketing Requests";
    $headers = "From: $from";
    mail($to,$subject,$message,$headers);*/
    
  print "<table width=\"500px\">";
  print "<tr>";
  print "<td>";
  print "Event Title";
  print "</td>";
  print "<td>";
  print $_SESSION['eventTitle'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Event Location:";
  print "</td>";
  print "<td>";
  print $_SESSION['eventLoc'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Event Price:";
  print "</td>";
  print "<td>";
  print $_SESSION['eventPrice'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Event URL:";
  print "</td>";
  print "<td>";
  print $_SESSION['eventURL'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Event Date:";
  print "</td>";
  print "<td>";
  print $_SESSION['eventDate'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Event Time:";
  print "</td>";
  print "<td>";
  print $_SESSION['eventTime'] ;
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Public Contact";
  print "</td>";
  print "<td>";
  print $_SESSION['pubContactName'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Public Contact Phone";
  print "</td>";
  print "<td>";
  print $_SESSION['pubContactPhone'];
  print "</td>";
  print "</tr>";
  print "<tr>";
  print "<td>";
  print "Public Contact Email";
  print "</td>";
  print "<td>";
  print $_SESSION['pubContactEmail'];
  print "</td>";
  print "</tr>";
  print "</table>";
  
    
    $queryReq = "SELECT max(ID) FROM request";
    $ID = db_query($queryReq);
    $IDnum = mysql_result($ID,0,"max(id)");
    
    $queryEvent = "INSERT INTO eventReq SET"
          . " ID = \""            . $IDnum
          . "\", eventTitle = \""       . $_SESSION['eventTitle']
          . "\", eventLoc = \""       . $_SESSION['eventLoc']
          . "\", eventPrice = \""       . $_SESSION['eventPrice']
          . "\", eventURL = \""       . $_SESSION['eventURL']
          . "\", eventDate = \""        . $_SESSION['eventDate']
          . "\", eventTime = \""        . $_SESSION['eventTime']
          . "\", pubContactName = \""     . $_SESSION['pubContactName']
          . "\", pubContactPhone = \""    . $_SESSION['pubContactPhone']
          . "\", pubContactEmail = \""    . $_SESSION['pubContactEmail'] . "\";"; 
      
      db_query($queryEvent, $DBlink);
    
    
    }
    
    if($_SESSION['webPages'] == true) {
    $to = 'sanorris@email.arizona.edu, jmasson@email.arizona.edu, nbischof@email.arizona.edu';
    $subject = "New Marketing Request Pending!";
    $message = "A new marketing request that contains web developing work was created with the following information: \n\n" . $_SESSION['contactName'] 
    . " has posted a general request which is desired to be ready by" . $_SESSION['dueDateMonth'] . " / " . $_SESSION['dueDateDay'] . " / " . $_SESSION['dueDateYear'] . "\n\n The job's brief description is as follows\n:" 
    . $_SESSION['reqDesc'] . ". \n\n Please log into the marketing request portal for all relevant information";
    $from = "Marketing Requests";
    $headers = "From: $from";
    mail($to,$subject,$message,$headers);
    }
  
  }
  
  print "</div>";
  //RAW MARKETING REQUEST FORM 
  ?>
   
<?php page_finish(); ?>