<?php	
	session_start();
	include_once("common/page_start.php");

?>


<script type="text/javascript">

function divVisibility(divid)
{

for (i=1; i <= 4; i++) {
		if (divid == i) {
			showDiv(i)
			} else {
			hideDiv(i)
			}
		}
}
 


function hideDiv(i) { 
if (document.getElementById) {  // DOM3 = IE5, NS6 
document.getElementById(i).style.display = 'none'; 
} else {
document.poppedLayer =   
        eval('document.layers[i]');
  document.poppedLayer.style.display = "none";
  }

}

function showDiv(i) { 
if (document.getElementById) { // DOM3 = IE5, NS6 
document.getElementById(i).style.display = 'block'; 
} else {
document.poppedLayer =   
        eval('document.layers[i]');
  document.poppedLayer.style.display = "block";
  }


}

</script>



<div class="content_block">

<h1>NCLC 2009 Online Registration</h1>

<br /><br />

<b>Hotel Information:</b>
<br />
<p>If you are coming from outside of Tucson, visit our website www.union.arizona.edu/nclc for information on hotels near the University of Arizona. Remember to reserve hotel rooms as soon as possible to take advantage of any special discount prices that are offered specifically for Conference participants.  </p>

<b>Hosting Information:</b> 

<p>A host is a Tucson resident who can provide free housing accommodations for one or more conference participants who are traveling from outside the Tucson area.   Hosts are provided on a first come basis. We cannot guarantee host spots as hosts are volunteers.  Priority will be given to participants who register by January 25, 2009.</p>


<form name="housing" action="reg5.php" method="post">
	<input type="radio" name="hostType" value="host" onclick="divVisibility(1)" />I am a Tucson resident who would like to be a host for an out-of-town Conference participant<br />
    <input type="radio" name="hostType" value="guest" onclick="divVisibility(2)" />I am coming to the Conference from outside of Tucson and would like to stay with a host during the conference<br />
	<input type="radio" name="hostType" value="none" onclick="divVisibility(3)"/>I am not interested in participating in the hosting program<br /><br /><br /><br />
    
    
    <span id="1" style="display:none">
    1.	I prefer to host  
    <select name="hostPref">
    	<option>Male</option>
        <option>Female</option>
        <option>Doesn't Matter</option>
     </select><br /><br />
	2.	Number of participants I can host: 
    <select name="hostCap">
    	<option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
     </select><br /><br />
	3.	My gender: 
     <select name="hostGen">
    	<option>Male</option>
        <option>Female</option>
        <option>Transgender</option>
     </select>
     <br /><br />
     <input type="Submit" value="Save &amp; Continue">
    </span>
    
    <span id="2" style="display:none">
    1. I prefer to be hosted by: 
    <select name="guestPref">
    	<option>Male</option>
        <option>Female</option>
        <option>Doesn't Matter</option>
     </select><br /><br />
    
    2.	My gender: 
     <select name="guestGen">
    	<option>Male</option>
        <option>Female</option>
        <option>Transgender</option>
     </select>
     <br /><br />
	3.	Number of participants in my group that need hosting
    <?
	print '<select name="guestNum">';
		
		for ($i=0; $i <= ($_SESSION['attendee']+1); $i++) {
			
			print '<option>' . $i . '</name>';
			
			}
		
		print "</select>";

	?>
    <br /><br />
	4.	Do you have transportation?
     <select name="guestTrans">
    	<option>Yes</option>
        <option>No</option>
     </select><br /><br />
     
     <input type="Submit" value="Save &amp; Continue">
    </span>
    
    <span id="3" style="display:none">
    <input type="Submit" value="Save &amp; Continue">
    </span>

</form>


<?
/*
print "Would you like to request housing with other students or a family here in Tucson?";
print "<br>";
print "Note that these spots are rare and we cannot guarantee accomodation";

print "<br><br>";


print "Please select the amount of people you would like to request accomodation for";
print "<br><br>";

print "<form action=\"payment.php\" method=\"post\">";
print '<select name="housing">';

for ($i=0; $i <= ($_SESSION['attendee']+1); $i++) {
	
	print '<option>' . $i . '</name>';
	
	}

print "</select>";

print "<br><br>";

print "<input type=\"Submit\" value=\"Save &amp; Continue\">"; 
print "</form>";

print "<br>";*/

?>

</div>

<?
	include_once("common/page_end.php");
?>