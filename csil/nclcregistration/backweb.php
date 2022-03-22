<?php
if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://www.union.arizona.edu/csil/nclcregistration/backweb.php");
    }

	session_start();
	if(!isset($_SESSION['netID'])){

	if(!isset($_GET['ticket'])) {
		header("Location: https://webauth.arizona.edu/webauth/login?service=https://www.union.arizona.edu/csil/nclcregistration/backweb.php");
	}else {
		
		$tix = $_GET['ticket'];
		$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=https://www.union.arizona.edu/csil/nclcregistration/backweb.php"';
		exec("curl -m 120 $url " ,$return_message_array, $return_number);
		
	
		$netID = $return_message_array[2];
	
		$netID = trim(str_replace("<cas:user>","",str_replace("</cas:user>","", $netID)));
		$_SESSION['netID'] = $netID;
	}
}
	
	if($_SESSION['netID'] != sanorris  && $_SESSION['netID'] != ahoefner && $_SESSION['netID'] != hroundtr && $_SESSION['netID'] != tam && $_SESSION['netID'] != den && $_SESSION['netID'] != crs) {  
	
		echo "not allowed";
	
	
	}
	else {
	include_once("common/page_startbw.php");
?>

<script type="text/javascript">

var browserType;

if (document.layers) {browserType = "nn4"}
if (document.all) {browserType = "ie"}
if (window.navigator.userAgent.toLowerCase().match("gecko")) {
   browserType= "gecko"
}

 function names() {
 
 	noName();
 
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("names")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("names")');
  else
     document.poppedLayer =   
        eval('document.layers["names"]');
  document.poppedLayer.style.display = "block";
 
}

function emailAdd() {
 
 	noName();
 	
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("email")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("email")');
  else
     document.poppedLayer =   
        eval('document.layers["email"]');
  document.poppedLayer.style.display = "block";
 
}

function noName() {
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("names")');

  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("names")');
	
  else
     document.poppedLayer =   
        eval('document.layers["names"]');
 	document.poppedLayer.style.display = "none";
 
 
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("email")');

  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("email")');
	
  else
     document.poppedLayer =   
        eval('document.layers["email"]');
 	document.poppedLayer.style.display = "none";

}

</script>
<?


print "<div class=\"content_block\">";


?>

<h1>NCLC 2009 BACKWEB</h1>

<p>What Criteria are you searching by?</p>


<form action="backwebroute.php" method="post">
<b>Users:</b><br />
<input type="radio" name="search" value="total" onClick="noName()"/>All Users
<br />
<input type="radio" name="search" value="names" onClick="names()"/>First / Last Name
<br />
	<div id="names" style="display:none"><br />
    	First Name: &nbsp;
    	<input type="text" size="20" maxlength="30" name="firstName">
        <br />
        Last Name: &nbsp;
		<input type="text" size="20" maxlength="30" name="lastName">
        <br /><br />
     </div>
	
<input type="radio" name="search" value="email" onClick="emailAdd()"/>Email Address
<br />
<div id="email" style="display:none"><br />
        Registrants Email: &nbsp;
		<input type="text" size="20" maxlength="40" name="email">
        <br /><br />
     </div>
<b>Counts:</b> <br />
<input type="radio" name="search" value="tShirts" onClick="noName()"/>T-Shirt Count
<br />
<input type="radio" name="search" value="meals" onClick="noName()"/>Meal Count
<br />
<input type="radio" name="search" value="housing" onClick="noName()"/>Host/Guest Details


<br /><br />
<input type="submit" value="Next"/>

</div>


<?
	}
	include_once("common/page_end.php");
?>
