<?php
// Force HTTPS
if (!isset($_SERVER['HTTPS']))
{
	header('Location: https://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	exit;
}

session_start();
if ($_POST['changeAttn'])
{
	$_SESSION['changeAttn'] = $_POST['changeAttn'];
}

include_once("common/page_start.php");

if ($error == true)
{
	echo '<div class=\"content_block\">
	<p style=\"color:red; font-size:24px; font-weight:bold; font:arial\">Error<br><br>
	<span style="font-size:14px; font-weight:normal">' . $error1 . '</span></p>';	
}
?>

<script type="text/javascript">
var browserType;

if (document.layers) {browserType = "nn4"}
if (document.all) {browserType = "ie"}
if (window.navigator.userAgent.toLowerCase().match("gecko")) {
   browserType= "gecko"
}

function group()
{
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

function indiv()
{
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

if ($error != true)
{
	echo '<div class="content_block">';
}
?>
<!--
<h1>NCLC 2009 Online Registration</h1>

<p>The registration peiord for the National Collegiate Leadership Conference 2009 has concluded.</p>
-->
<!--<p> Are you registering as an individual or for yourself and others?</p>-->

<?php if (!isset($_POST['changeAttn'])): ?>
<form action="reg2.php" method="post">
<input type="radio" name="regType" value="indiv" checked="checked" onclick="indiv()"/>Individual
<br />
<input type="radio" name="regType" value="groupReg" onClick="group()"/>Group

<div id="group" style="display:none">
<br />Other than yourself, how many participants will be attending?
<p /><select name="attendee">
<?php
for ($i = 1; $i <= 10; $i++)
{
	echo "<option>$i</option>";
}
?>
</select>
</div>

<p /><input type="submit" value="Next"/>
<?php else: ?>

<form action="reg2.php" method="post">
<input type="radio" name="regType" value="groupReg" checked="checked" onClick="group()"/>Group
<br />
<input type="radio" name="regType" value="indiv" onclick="indiv()"/>Individual

<div id="group" style="display:block">
<br />Next to yourself, how many participants will be attending?
<p /><select name="attendee">
<?php
for ($i = 1; $i <= 25; $i++)
{
	$selected = ($_SESSION['attendee'] == $i) ? ' selected="selected"' : '';
	echo "<option{$selected}>$i</option>";
}
?>
</select>
</div>
<p /><input type="submit" value="Next"/>
<?php
endif;

if ($error != true)
{
	echo '</div>';
}

include_once("common/page_end.php");
?>
