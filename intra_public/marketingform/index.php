<?php

	print $_POST['bwColor1117'];

	session_start();
	if ($error != true) {
	 require('global.inc');
  $page_options['title'] = 'Union Marketing Request Form:';
  page_start($page_options);
	}
	?>
	
	<script type="text/javascript">
		
	
	function checkEmail() {
	
	 if (document.marketingReq.contactEmail.value.length >0) {
	 i=document.marketingReq.contactEmail.value.indexOf("@")
	 j=document.marketingReq.contactEmail.value.indexOf(".",i)
	 k=document.marketingReq.contactEmail.value.indexOf(",")
	 kk=document.marketingReq.contactEmail.value.indexOf(" ")
	 jj=document.marketingReq.contactEmail.value.lastIndexOf(".")+1
	 len=document.marketingReq.contactEmail.value.length

			if ((i>0) && (j>(1+1)) && (k==-1) && (kk==-1) && (len-jj >=2) && (len-jj<=3)) {
			}
			else {
				alert("Please enter an exact email address.\n" +
				document.marketingReq.contactEmail.value + " is invalid. Even if you are a summary appears the form did not submit, please hit the \"back button\" on your browser");
				window.stop();
				document.execCommand('Stop');
				return false;
				
				
			}

 		}
 	}
	
	// Declaring required variables
	var digits = "0123456789";
	// non-digit characters which are allowed in phone numbers
	var phoneNumberDelimiters = "()- ";
	// characters which are allowed in international phone numbers
	// (a leading + is OK)
	var validWorldPhoneChars = phoneNumberDelimiters + "+";
	// Minimum no of digits in an international phone no.
	var minDigitsInIPhoneNumber = 10;

		function isInteger(s)
		{   var i;
			for (i = 0; i < s.length; i++)
			{   
				// Check that current character is number.
				var c = s.charAt(i);
				if (((c < "0") || (c > "9"))) return false;
			}
			// All characters are numbers.
			return true;
		}
		function trim(s)
		{   var i;
			var returnString = "";
			// Search through string's characters one by one.
			// If character is not a whitespace, append to returnString.
			for (i = 0; i < s.length; i++)
			{   
				// Check that current character isn't whitespace.
				var c = s.charAt(i);
				if (c != " ") returnString += c;
			}
			return returnString;
		}
		function stripCharsInBag(s, bag)
		{   var i;
			var returnString = "";
			// Search through string's characters one by one.
			// If character is not in bag, append to returnString.
			for (i = 0; i < s.length; i++)
			{   
				// Check that current character isn't whitespace.
				var c = s.charAt(i);
				if (bag.indexOf(c) == -1) returnString += c;
			}
			return returnString;
		}
		
		function checkInternationalPhone(strPhone) {
		var bracket=3
		strPhone=trim(strPhone)
		if(strPhone.indexOf("+")>1) return false
		if(strPhone.indexOf("-")!=-1)bracket=bracket+1
		if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false
		var brchr=strPhone.indexOf("(")
		if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false
		if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false
		s=stripCharsInBag(strPhone,validWorldPhoneChars);
		return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
		}
		
		function ValidateForm(){
		
			var Phone=document.marketingReq.contactNumber;
			
			if ((Phone.value==null)||(Phone.value=="")){
				alert("Please Enter your Phone Number")
				Phone.focus()
				checkEmail();
				return false
			}
			if (checkInternationalPhone(Phone.value)==false){
				alert("Please Enter a Valid Phone Number")
				Phone.value=""
				Phone.focus()
				checkEmail();
				return false
				}
	checkEmail();
	return true
 }
			
		
	var browserType;

		if (document.layers) {browserType = "nn4"}
		if (document.all) {browserType = "ie"}
		if (window.navigator.userAgent.toLowerCase().match("gecko")) {
		   browserType= "gecko"
		}
		

		
		 function visible(i) {
		 invisible();
		 
		  if (browserType == "gecko" )
			 document.poppedLayer = 
				 eval('document.getElementById(i)');
		  else if (browserType == "ie")
			 document.poppedLayer = 
				eval('document.getElementById(i)');
		  else
			 document.poppedLayer =   
				eval('document.layers[i]');
		  document.poppedLayer.style.display = "block";
		 
		if (i == 4) {
					if (browserType == "gecko" )
					 document.poppedLayer = 
						 eval('document.getElementById(5)');
				  else if (browserType == "ie")
					 document.poppedLayer = 
						eval('document.getElementById(5)');
				  else
					 document.poppedLayer =   
						eval('document.layers[5]');
				  document.poppedLayer.style.display = "none";
			} else {
			if (browserType == "gecko" )
					 document.poppedLayer = 
						 eval('document.getElementById(5)');
				  else if (browserType == "ie")
					 document.poppedLayer = 
						eval('document.getElementById(5)');
				  else
					 document.poppedLayer =   
						eval('document.layers[5]');
				  document.poppedLayer.style.display = "block";
			}
		
		if (i == 4) {
					if (browserType == "gecko" )
					 document.poppedLayer = 
						 eval('document.getElementById(6)');
				  else if (browserType == "ie")
					 document.poppedLayer = 
						eval('document.getElementById(6)');
				  else
					 document.poppedLayer =   
						eval('document.layers[6]');
				  document.poppedLayer.style.display = "none";
			} else {
			
			if (browserType == "gecko" )
					 document.poppedLayer = 
						 eval('document.getElementById(6)');
				  else if (browserType == "ie")
					 document.poppedLayer = 
						eval('document.getElementById(6)');
				  else
					 document.poppedLayer =   
						eval('document.layers[6]');
				  document.poppedLayer.style.display = "block";
			
			}
			
			
		
		}
		
		 function invisible() {
		 
		 for (i = 1; i < 5; i++) {
		 
		  if (browserType == "gecko" )
			 document.poppedLayer = 
				 eval('document.getElementById(i)');
		  else if (browserType == "ie")
			 document.poppedLayer = 
				eval('document.getElementById(i)');
		  else
			 document.poppedLayer =   
				eval('document.layers[i]');
		  document.poppedLayer.style.display = "none";
		 
		 	}
		
		}
		
		function disableField(i) {
		
		//document.write(i.value);
		
		if (i.value == "Incoming Students") {
			document.marketingReq.incStudent.disabled=true;
			document.marketingReq.incStudent.checked=false;
			} else {
			document.marketingReq.incStudent.disabled=false;
			}
		
		if (i.value == "Current Students") {
			document.marketingReq.curStudent.disabled=true;
			document.marketingReq.curStudent.checked=false;
			} else {
			document.marketingReq.curStudent.disabled=false;
			}
			
		if (i.value == "Faculty") {
			document.marketingReq.faculty.disabled=true;
			document.marketingReq.faculty.checked=false;
			} else {
			document.marketingReq.faculty.disabled=false;
			}
		
		if (i.value == "Staff") {
			document.marketingReq.staff.disabled=true;
			document.marketingReq.staff.checked=false;
			} else {
			document.marketingReq.staff.disabled=false;
			}
		
		if (i.value == "Alumni") {
			document.marketingReq.alumni.disabled=true;
			document.marketingReq.alumni.checked=false;
			} else {
			document.marketingReq.alumni.disabled=false;
			}
		
		if (i.value == "Donors") {
			document.marketingReq.donors.disabled=true;
			document.marketingReq.donors.checked=false;
			} else {
			document.marketingReq.donors.disabled=false;
			}
		
		if (i.value == "Community") {
			document.marketingReq.community.disabled=true;
			document.marketingReq.community.checked=false;
			} else {
			document.marketingReq.community.disabled=false;
			}
		
		if (i.value == "Parents") {
			document.marketingReq.parents.disabled=true;
			document.marketingReq.parents.checked=false;
			} else {
			document.marketingReq.parents.disabled=false;
			}
		
		if (i.value == "Other") {
			document.marketingReq.others.disabled=true;
			document.marketingReq.others.checked=false;
			} else {
			document.marketingReq.others.disabled=false;
			}
		}
	</script>
	
	<?
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
	
	//RAW MARKETING REQUEST FORM 
	
	?>
	
   <div style="padding-left:20px;">
    <h4>Marketing Request Form</h4>
	
    <b>Request Information</b>
    <br /><br />
    
    <form name="marketingReq" action="mktgsubmit.php" method="post" onSubmit="return ValidateForm()">
    
    
    What type of marketing materials do you need? <? if ($error1 == true) { print "<b><font color=\"red\">**</font></b>"; } ?><br />
    
    <input type="radio" name="type" value="General" onclick="visible(1)" <? if($_SESSION['type'] == "General") { print "checked";} ?> />General <br />
    <input type="radio" name="type" value="Event" onclick="visible(2)" <? if($_SESSION['type'] == "Event") { print "checked";} ?>/>Event <br />
    <input type="radio" name="type" value="Dining"  onclick="visible(3)" <? if($_SESSION['type'] == "Dining") { print "checked";} ?>/>Dining <br />
    <input type="radio" name="type" value="webEdits"  onclick="visible(4)" <? if($_SESSION['type'] == "webEdits") { print "checked";} ?>/>Web Edits <br />
    
    <span id="1"> </span>
    <br /><br />
    
    <table>
    	<tr>
        	<td width="150px">
                Desired Due Date <br>
	(Month<? if ($error2 == true) { print "<b><font color=\"red\">**</font></b>"; } ?> 
	/ Day<? if ($error3 == true) { print "<b><font color=\"red\">**</font></b>"; } ?> 
    / Year<? if ($error4 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>) 
            </td>
            <td>
                <select name="dueDateMonth"/>
                	<option><? print $_SESSION['dueDateMonth']; ?></option>
                	<option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
                <select name="dueDateDay">
               		<option><? print $_SESSION['dueDateDay']; ?></option>
                	<option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    <option>19</option>
                    <option>20</option>
                    <option>21</option>
                    <option>22</option>
                    <option>23</option>
                    <option>24</option>
                    <option>25</option>
                    <option>26</option>
                    <option>27</option>
                    <option>28</option>
                    <option>29</option>
                    <option>30</option>
                    <option>31</option>
               </select>
               
               <? $curYear = floor(1970 +(time() / 31556926)) ;
			   $twoYearsAhead = ($curYear + 2);
               ?>
               
               <select name="dueDateYear">
               	<option><? print $_SESSION['dueDateYear']; ?></option>
               	<? 
				for ($i = $curYear; $i <= $twoYearsAhead; $i++) {
				print "<option>" . $i . "</option>";
				}
				?>
               </select>
           
            </td>
        </tr>
        </table>
        
        <div id="5" <? if ($_SESSION['type'] == "webEdits") { print "style=\"display:none\""; } else { print "style=\"display:block\""; } ?>>
        <table>
        <tr width="150px">
        	<td colspan="2" width="500px" style="padding-top:5px; padding-bottom:5px;">
            *<i>Please Note: Any requests that are submitted less than 14 days from the due date will incur a rush charge of $50, for requests needing turnaround times under 48 hours, please contact Fast Design, 621-5305.</i>
            </td>
       </tr>
       <tr>
       		<td  style="vertical-align:top">
            	Brief Description <? if ($error5 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<textarea name="reqDesc" cols="50" rows="10"><? if (isset($_SESSION['reqDesc']) && ($_SESSION['reqDesc'] != "") && ($_SESSION['reqDesc'] != "Enter Description Here")) { print stripslashes($_SESSION['reqDesc']); }else{ print "Enter description here"; } ?></textarea>
            </td>
       </tr>
       </table>
       </div>
       <table>
       <tr>
       		<td>
            	Contact Name <? if ($error6 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="contactName" size="30" maxlength="50" <? print "value=" . $_SESSION['contactName']; ?>  >
            </td>
       </tr>
       <tr>
       		<td>
            	Contact Number <? if ($error7 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="contactNumber" size="30" maxlength="50" <? print "value=" . $_SESSION['contactNumber']; ?> >
            </td>
       </tr>
       <tr>
       		<td>
            	Contact Email <? if ($error8 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="contactEmail" size="30" maxlength="50" <? print "value=" . $_SESSION['contactEmail']; ?> >
            </td>
       </tr>
       </table>
       <div id="6" <? if ($_SESSION['type'] == "webEdits") { print "style=\"display:none\""; } else { print "style=\"display:block\""; } ?>>
       <table>
       <tr>
       		<td width="150px">
            FRS Account Number <? if ($error9 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td colspan="3">
            	<input type="text" name="acctFRS" size="30" maxlength="50" <? print "value=" . $_SESSION['acctFRS']; ?> >
       </td>
       </tr>
         <tr>
       		<td>
            Alloted Project Budget <? if ($error10 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td colspan="3">
            	<input type="text" name="mktgBudget" size="30" maxlength="50" <? print "value=" . $_SESSION['mktgBudget']; ?> >
            </td>
       </tr>
         <tr>
       		<td>
            Primary Audience (Select one)<? if ($error11 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td colspan="3">
            	<select name="primAudience" onChange="disableField(this)">
                	<option><? print $_SESSION['primAudience']; ?></option>
                	<option name="incStudent">Incoming Students</option>
                    <option name="curStudent">Current Students</option>
                    <option name="alumni">Alumni</option>
                    <option name="faculty">Faculty</option>
                    <option name="staff">Staff</option>
                    <option name="parents">Parents</option>
                    <option name="donors">Donors</option>
                    <option name="community">Community</option>
                    <option name="other">Other</option>
                </select>
            </td>
       </tr>
        <tr>
       		<td>
            If other, please specify (required) <? if ($error12 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td colspan="3">
            	<input type="text" name="otherDetPrim" size="30" maxlength="50" <? print "value=" . $_SESSION['otherDetPrim']; ?> >
            </td>
       </tr>
          <tr>
       		<td style="vertical-align:top">
            Secondary Audience (Select all that apply)
            </td>
            <td colspan="3">
            	<input type="checkbox" name="incStudent" value="true" <? if (isset($_SESSION['incStudent']) && $_SESSION['incStudent'] != "") { print "checked"; } ?>/>Incoming Students<br />
                <input type="checkbox" name="curStudent" value="true" <? if (isset($_SESSION['curStudent']) && $_SESSION['curStudent'] != "") { print "checked"; } ?>/>Current Students<br />
                <input type="checkbox" name="alumni" value="true" <? if (isset($_SESSION['alumni']) && $_SESSION['alumni'] != "") { print "checked"; } ?>/>Alumni<br />
                <input type="checkbox" name="faculty" value="true" <? if (isset($_SESSION['faculty']) && $_SESSION['faculty'] != "") { print "checked"; } ?>/>Faculty<br />
                <input type="checkbox" name="staff" value="true" <? if (isset($_SESSION['staff']) && $_SESSION['staff'] != "") { print "checked"; } ?>/>Staff<br />
                <input type="checkbox" name="parents" value="true" <? if (isset($_SESSION['parents']) && $_SESSION['incStudent'] != "") { print "checked"; } ?> />Parents<br />
                <input type="checkbox" name="donors" value="true" <? if (isset($_SESSION['donors']) && $_SESSION['donors'] != "") { print "checked"; } ?>/>Donors<br />
                <input type="checkbox" name="community" value="true" <? if (isset($_SESSION['community']) && $_SESSION['community'] != "") { print "checked"; } ?>/>Community<br />
                <input type="checkbox" name="others" value="true" <? if ($_SESSION['others'] == "Others - ") { print "checked"; } ?>/>Others<br />
            </td>
       </tr>
       <tr>
       		<td>
            If other, please specify (required) <? if ($error13 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td colspan="3">
            	<input type="text" name="otherDetSec" size="30" maxlength="50" <? print "value=" . $_SESSION['otherDetSec']; ?> >
            </td>
       </tr>
       
    </table>
    </div>
    
    <br />
<div id="2" <? if ($_SESSION['type'] == "Event") { print "style=\"display:block\""; } else { print "style=\"display:none\""; } ?>>
     <table>
     	<tr>
       		<td colspan="3">
       		<strong>Event Specific Information</strong>
            <br>
       		</td>
       </tr>
      
    	<tr>
        	<td width="150px">
                Event Title<? if ($error14 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
                <input type="text" name="eventTitle" size="30" maxlength="50" <? print "value=" . $_SESSION['eventTitle']; ?>>
            </td>
       </tr>
       <tr>
       		<td>
                Location<? if ($error15 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="eventLoc" size="30" maxlength="50" <? print "value=" . $_SESSION['eventLoc']; ?> >
            </td>
       </tr>
       <tr>
       		<td>
            	Price of the Event<? if ($error16 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="eventPrice" size="10" maxlength="10" <? print "value=" . $_SESSION['eventPrice']; ?>>
            </td>
       </tr>
       <tr>
       		<td>
            	Event URL
            </td>
            <td>
            	<input type="text" name="eventURL" size="30" maxlength="80" <? print "value=" . $_SESSION['eventURL']; ?>>
            </td>
       </tr>
       <tr>
       		<td>
            	Event Date(s)<? if ($error17 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="eventDate" size="30" maxlength="30" <? print "value=" . $_SESSION['eventDate']; ?>>
            </td>
       </tr>
       <tr>
       		<td>
            	Event Time(s)<? if ($error18 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="eventTime" size="30" maxlength="30" <? print "value=" . $_SESSION['eventTime']; ?>>
            </td>
       </tr>
       <tr>
       		<td>
            	Public Contact Name<? if ($error19 == true) { print "<b><font color=\"red\">**</font></b>"; } ?>
            </td>
            <td>
            	<input type="text" name="pubContactName" size="30" maxlength="50" <? print "value=" . $_SESSION['pubContactName']; ?>>
            </td>
       </tr>
       <tr>
       		<td>
            	Public Contact Phone<? if ($error20 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
            </td>
            <td>
            	<input type="text" name="pubContactPhone" size="30" maxlength="50" <? print "value=" . $_SESSION['pubContactPhone']; ?>>
            </td>
       </tr>
       <tr>
       		<td>
            	Public Contact Email<? if ($error21 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
            </td>
            <td>
            	<input type="text" name="pubContactEmail" size="30" maxlength="50" <? print "value=" . $_SESSION['pubContactEmail']; ?>>
            </td>
       </tr>
    </table>
    </div>
    
<div id="3" <? if ($_SESSION['type'] == "Dining") { print "style=\"display:block\""; } else { print "style=\"display:none\""; } ?>>
   <table>
 		<tr>
       		<td colspan="4">
       		<strong>Dining Specific Information</strong>
            <br>
       		</td>
       </tr>
      
 	<tr>
    	<td>
        <input type="checkbox" name="1117posters" <? if (isset($_SESSION['1117posters']) && $_SESSION['1117posters'] == true) { print "checked"; } ?>>11x17 Posters
        </td>
        <td> 
        Amount:<? if ($error22 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
         <input type="text" name="amt1117" size="5" maxlength="5" <? print "value=" . $_SESSION['amt1117']; ?>>
        </td>
        <td>
        <select name="bwColor1117">
        	<option><? print $_SESSION['bwcolor1117']; ?></option>
        	<option>Black/White</option>
            <option>Color</option>
            <? if ($error23 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </select>
        </td>
    </tr>
    <tr>
    	<td>
        <input type="checkbox" name="largeFormatPosters" <? if (isset($_SESSION['largeFormatPosters']) && $_SESSION['largeFormatPosters'] == true) { print "checked"; } ?>> Large Format Posters
        </td>
        <td> 
        Amount: <? if ($error24 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        <input type="text" name="amtLargeFormat" size="5" maxlength="5" <? print "value=" . $_SESSION['amtLargeFormat']; ?>>
        </td>
        <td>
        Size: <? if ($error25 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?><input type="text" name="lFSize" size="10" maxlength="10" <? print "value=" . stripslashes($_SESSION['lFSize']); ?>>&nbsp;
        <input type="checkbox" name="lFMount" <? if (isset($_SESSION['lFMount']) && $_SESSION['lFMount'] == true) { print "checked"; } ?>> Mounted
        </td>
    </tr>
     <tr>
    	<td>
        <input type="checkbox" name="8511Flyers" <? if (isset($_SESSION['8511Flyers']) && $_SESSION['8511Flyers'] == true) { print "checked"; } ?>>8.5 x 11 Flyers
        </td>
        <td> 
        Amount:  <? if ($error26 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        <input type="text" name="amt8511" size="5" maxlength="5" <? print "value=" . $_SESSION['amt8511']; ?>>
        </td>
        <td>
        <select name="bwColor8511">
        	<option><? print $_SESSION['bwColor8511']; ?></option>
        	<option>Black/White</option>
            <option>Color</option>
            <? if ($error27 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </select>
        </td>
    </tr>
     <tr>
    	<td>
        <input type="checkbox" name="hlfPage" <? if (isset($_SESSION['hlfPage']) && $_SESSION['hlfPage'] == true) { print "checked"; } ?>>Half-Page Handbills
        </td>
        <td> 
        Amount: <? if ($error28 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        <input type="text" name="amtHlfPage" size="5" maxlength="5" <? print "value=" . $_SESSION['amtHlfPage']; ?>>
        </td>
        <td>
        <select name="bwColorHlfPage">
        	<option><? print $_SESSION['bwColorHlfPage']; ?></option>
        	<option>Black/White</option>
            <option>Color</option>
            <? if ($error29 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </select>
        </td>
    </tr>
    <tr>
    	<td>
        <input type="checkbox" name="qtrPage" <? if (isset($_SESSION['qtrPage']) && $_SESSION['qtrPage'] == true) { print "checked"; } ?>>Qtr-Page Handbills
        </td>
        <td> 
        Amount: <? if ($error30 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        <input type="text" name="amtQtrPage" size="5" maxlength="5" <? print "value=" . $_SESSION['amtQtrPage']; ?>>
        </td>
        <td>
        <select name="bwColorQtrPage">
        	<option><? print $_SESSION['bwColorQtrPage']; ?></option>
        	<option>Black/White</option>
            <option>Color</option>
            <? if ($error31 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </select>
        </td>
    </tr>
    <tr>
    	<td>
        <input type="checkbox" name="shelfLabel" <? if (isset($_SESSION['shelfLabel']) && $_SESSION['shelfLabel'] == true) { print "checked"; } ?>>Shelf Labels
        </td>
        <td> 
        Amount: <? if ($error32 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        <input type="text" name="amtShelfLabel" size="5" maxlength="5" <? print "value=" . $_SESSION['amtShelfLabel']; ?>>
        </td>
        <td>
        <select name="bwColorShelfLabel">
       		<option><? print $_SESSION['bwColorShelfLabel']; ?></option>
        	<option>Black/White</option>
            <option>Color</option>
        <? if ($error33 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </select>
        </td>
    </tr>
    <tr>
    	<td>
        <input type="checkbox" name="tabTents" <? if (isset($_SESSION['tabTents']) && $_SESSION['tabTents'] == true) { print "checked"; } ?>>Table Tents
        </td>
        <td> 
        Amount: <? if ($error34 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        <input type="text" name="amtTabTents" size="5" maxlength="5" <? print "value=" . $_SESSION['amtTabTents']; ?>>
        </td>
        <td>
        <select name="bwColorTabTents">
        	<option><? print $_SESSION['bwColorTabTents']; ?></option>
        	<option>Black/White</option>
            <option>Color</option>
            <? if ($error35 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </select>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        <input type="checkbox" name="webBanner" <? if (isset($_SESSION['webBanner']) && $_SESSION['webBanner'] == true) { print "checked"; } ?>>Web Banner
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        <input type="checkbox" name="plasmaAds" <? if (isset($_SESSION['plasmaAds']) && $_SESSION['plasmaAds'] == true) { print "checked"; } ?>>Plasma Ads
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        <input type="checkbox" name="outdoorBanner" <? if (isset($_SESSION['outdoorBanner']) && $_SESSION['outdoorBanner'] == true) { print "checked"; } ?>>Outdoor Banner
        </td>
        <td> 
        <select name="matOtdBanner">
        	<option>Vinyl</option>
            <option>Paper</option>
        </select>
        </td>
    </tr>
    <tr>
    	<td>
        <input type="checkbox" name="myPlace" <? if (isset($_SESSION['myPlace']) && $_SESSION['myPlace'] == true) { print "checked"; } ?>>MY!PLACE Ad
        </td>
        <td colspan="2"> 
        Desired Dates: <? if ($error36 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        <input type="text" name="myPlaceDates" size="30" maxlength="50" <? print "value=" . $_SESSION['myPlaceDates']; ?>>
        </td>
    </tr>
    <tr>
    	<td colspan="1" style="vertical-align:top">
        <input type="checkbox" name="other" <? if (isset($_SESSION['other']) && $_SESSION['other'] == true) { print "checked"; } ?> >Other<? if ($error37 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </td>
        <td colspan="3"> 
        <textarea name="otherDesc" rows="10" cols="50"><? if (isset($_SESSION['otherDesc']) && ($_SESSION['otherDesc'] != "") && ($_SESSION['otherDesc'] != "Enter Description Here")) { print  $_SESSION['otherDesc']; }else{ print "Enter description here"; } ?></textarea>
        </td>
    </tr>
</table>
    </div>
 
 
<br /><br />
<div id="4" <? if ($_SESSION['type'] == "webEdits") { print "style=\"display:block\""; } else { print "style=\"display:none\""; }?>>
<table>
	<tr>
    	<td colspan="3">
        <b>Web Page Requirements</b>
        </td>
    </tr>
    <tr>
    	<td style="padding-top:20px" colspan="3" width="500px">
        <i>The web team will contact you upon receipt to clairfy your needs are met correctly, if you need an entirely new site created, please call the Student Affairs web team at (520) 626-1238 and arrange a meeting.</i>
    	</td>
    </tr>
    <!--<tr>
    	<td colspan="2">
        <input type="checkbox" name="webPages" <? // if($_SESSION['webPages'] == true) { print "checked";} ?> /><strong>We require corresponding web edits</strong>
        </td>
    </tr>-->
    <tr>
    	<td>
        </td>
    	<td colspan="2">
        What is the URL of the web page that needs to be edited<? if ($error38 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </td>
    </tr>
    <tr>
    	<td>
        </td>
    	<td colspan="2">
        <input type="text" name="webURL" maxlength="50" size="80" <? print "value=" . $_SESSION['webURL']; ?> >
        </td>
    </tr>
    <!--  <tr>
    	<td width="80px">&nbsp;
        
        </td>
        <td>
        How many pages would approx need to be created or edited?<? if ($error39 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </td>
        <td>
        <input type="text" name="numWebPages" size="5" maxlength="5" <? print "value=" . $_SESSION['numWebPages']; ?> >
        </td>
    </tr>
  <tr>
    	<td colspan="3">
        <input type="checkbox" name="onlineReg" />The desired page requires a registration
		</td>
    </tr>
    <tr>
    	<td width="100px">&nbsp;
        
        </td>
    	<td>
        If you answered yes, will you require online Credit Card Processing?
        </td>
        <td>
        <select name="ccProcess">
        	<option>Yes</option>
            <option>No</option>
        </select>
        </td>
    </tr>-->
    <tr>
    	<td style="vertical-align:top; width:150px">
        Give a brief description of the edits you are requesting<? if ($error40 == true) { print "<b><font color=\"red\">**</font></b>"; }  ?>
        </td>
        <td colspan="2">
        <textarea name="webDesc" cols="50" rows="10"><? if (isset($_SESSION['webDesc']) && ($_SESSION['webDesc'] != "") && ($_SESSION['webDesc'] != "Enter Description Here")) { print stripslashes($_SESSION['webDesc']); }else{ print "Enter description here"; } ?></textarea>
    </tr>
</table>
</div>

<input type="hidden" name="dateTime" value="<? print date('G:i, d-m-y');?>" />
<input type="hidden" name="timeSubmit" value="<? print time();?>" />
<br>



<input type="submit" value="Submit Request">

</form>
</div>
<?php 
if ($error != true) {
page_finish(); 
}
?>
    
       
       
       
            
            
            
            
                