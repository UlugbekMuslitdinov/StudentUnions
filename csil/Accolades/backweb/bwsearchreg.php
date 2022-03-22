<?php


	session_start();
	require('webauth/include.php');
	if (isset($_SESSION["webauth"]["netID"]))
	{
	    $allowed = array("sanorris", "kflores", "lindsayb", "bphinney", "kbeyer", "kyleoman", "alampiss", "chargrav");
		
	    if (!in_array($_SESSION["webauth"]["netID"], $allowed))
		{
    		echo "You are not authorized to use this app";
    		exit();
		}
  	}

?>
<title>EQUISS BACKWEB</title>

<?php
require_once('page_start.php');
require_once('password_protect.php');
?>

<h1 size="+2">Equiss BACKWEB</h1>

<h2>To conduct a search you may enter the party's first name, last name, or ID number and all possible results will be displayed</h2>


<h3>Search By First Name</h3>
<form name="firstName" action="bwresults.php" method="post">
	<input type="text" name="firstName" maxlength="30" size="45" autocomplete="off" /><br />
<input type="submit" value="Submit Form"> <input type="Reset">
</form><br />

<h3>Search By Last Name</h3>

<form name="lastName" action="bwresults.php" method="post">
	<input type="text" name="lastName" maxlength="30" size="45" autocomplete="off" /><br />
<input type="submit" value="Submit Form"> <input type="Reset">
</form>
<br />

<h3>Search By ID</h3>

<form name="id" action="bwresults.php" method="post">
	<input type="text" name="id" maxlength="30" size="45" autocomplete="off" /><br />
<input type="submit" value="Submit Form"> <input type="Reset">
</form>

<!-- table cause the main page was too short in height and unfortunately IE is as HTML and CSS literate as Allen Iverson -->

<table>
	<tr height="200px">
    	<td>&nbsp;
        </td>
     </tr>
</table>

<?php 
require_once('page_end.php');
?>
