<?php

if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://www.union.arizona.edu/csil/nclcregistration/reg.php");
    }
	

	session_start();
	if($_POST['changeAttn']) {
	$_SESSION['changeAttn'] = $_POST['changeAttn'];
	}
	include_once("common/page_start.php");
	
	if ($error == true) {
	
	print "<div class=\"content_block\">";
	
	print "<p style=\"color:red; font-size:24px; font-weight:bold; font:arial\">Error<br><br>";
	
	print "<font style=\"font-size:14px; font-weight:normal\">" . $error1;
	
	print "</p>";
	
	}
	
?>

<script type="text/javascript">

var browserType;

if (document.layers) {browserType = "nn4"}
if (document.all) {browserType = "ie"}
if (window.navigator.userAgent.toLowerCase().match("gecko")) {
   browserType= "gecko"
}

 function group() {
 
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("group")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("group")');
  else
     document.poppedLayer =   
        eval('document.layers["group"]');
  document.poppedLayer.style.display = "block";
 

}

 function indiv() {
 
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("group")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("group")');
  else
     document.poppedLayer =   
        eval('document.layers["group"]');
  document.poppedLayer.style.display = "none";
 

}

</script>
<?

if ($error != true) {
print "<div class=\"content_block\">";
}

?>

<h1>NCLC 2009 Online Registration</h1>

<p>The registration peiord for the National Collegiate Leadership Conference 2009 has concluded.</p>

<!--<p> Are you registering as an individual or for yourself and others?</p>-->

<?php

/*

//1232949600

if (!isset($_POST['changeAttn'])) {

print '<form action="reg2.php" method="post">';
print '<input type="radio" name="regType" value="indiv" onclick="indiv()"/>Individual';
print '<br />';
print '<input type="radio" name="regType" value="groupReg" onClick="group()"/>Group';

print '<div id="group" style="display:none">';
print '<br />';
print 'Other than yourself, how many participants will be attending?<br />';
print '<br />';
print '<select name="attendee">';
	print '<option>1</option>';
    print '<option>2</option>';
    print '<option>3</option>';
    print '<option>4</option>';
    print '<option>5</option>';
    print '<option>6</option>';
    print '<option>7</option>';
    print '<option>8</option>';
    print '<option>9</option>';
    print '<option>10</option>';
print '</select>';
print '</div>';

print '<br /><br />';

print '<input type="submit" value="Next"/>';

print '</div>';

} else {

//print_r($_SESSION);

print '<form action="reg2.php" method="post">';

print '<input type="radio" name="regType" value="groupReg" checked="checked" onClick="group()"/>Group';
print '<br />';
print '<input type="radio" name="regType" value="indiv" onclick="indiv()"/>Individual';



print '<div id="group" style="display:block">';
print '<br />';
print 'Next to yourself, how many participants will be attending?<br />';
print '<br />';
print '<select name="attendee">';

	for ($i = 1; $i <= 25; $i++) {
			if($_SESSION['attendee'] == $i) {
				print "<option value=\"" . $i . "\" selected=\"selected\">" . $i . "</option>";
				} else {
				print "<option value=\"" . $i . "\">" . $i . "</option>";
			}
		}
			
print '</select>';
print '</div>';

print '<br /><br />';

print '<input type="submit" value="Next"/>';
*/
print '</div>';

//$error = false;



//}

	include_once("common/page_end.php");
?>
