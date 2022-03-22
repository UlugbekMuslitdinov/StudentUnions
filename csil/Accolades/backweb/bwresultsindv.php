<?php

/*if(!isset($_SERVER['HTTPS']))
    {
       header("location: https://www.union.arizona.edu/csil/accolades/backweb/bwresultsindv.php");
    }*/

	session_start();
require('webauth/include.php');
	if (isset($_SESSION["webauth"]["netID"]))
	{
	    $allowed = array("sanorris", "kflores", "lindsayb", "bphinney", "kbeyer", "kyleoman", "alampiss", "celinaa", "chargrav");
	
	    if (!in_array($_SESSION["webauth"]["netID"], $allowed))
		{
			echo "You are not authorized to use this app";
			exit();
		}
	}

	require('global.inc');
  $page_options['title'] = 'Accolades';
  page_start($page_options);
	
/* require_once('password_protect.php'); */
?>

<script language="javascript">
function nav()
   {
   var w = document.myform.mylist.selectedIndex;
   var url_add = document.myform.mylist.options[w].value;
   window.location.href = url_add;
   }
</script>
</head>

<div style="width:600px;">

<a href="/csil/Accolades/"><img src="../AccoladesLogoFINAL.gif" /></a>

<?

if($_POST['lastNameNominee'] != ""){
	//print "you are here LN";
	
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli('accolades13');
	
	//Check to see if the person is registered
	$query = "select lastNameNominee, firstNameNominee, awardTitle FROM Individuals where lastNameNominee like \"%" . $_POST['lastNameNominee'] . "%\"";		
	//print $query;

		$result = $db->query($query);
		
		echo "<br>";
		
		print $results;
		
		if($result->num_rows == 0) {
			//not registered
			$error = true;
			$error_msg = "<br> <br><font size=\"+1\">Table Empty</font>";
			print $error_msg;
			} else {
			while ($Individuals = $result->fetch_array()) {
				print  "<a href=\"backwebinfoindv.php?lastNameNominee=" . $Individuals['lastNameNominee'] . "\">" . $Individuals['lastNameNominee'] . ",&nbsp;" . $Individuals['firstNameNominee'] . " -&nbsp;" . $Individuals['awardTitle'] . "</a>";
				/*print "<a href=\"backwebinfo.php?id=" . $Individuals['nameNominee'] . "\">" . $Individuals['awardTitle'] .  "</a>" ;*/
				echo "&nbsp;";
				echo "<br>";
				
			}
			
		}
		
		
}

if($_POST['firstNameNominee'] != ""){
	
	//print "you are here FN";
	
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli('accolades13');
 
	//Check to see if the person is registered
		$query = "select lastNameNominee, firstNameNominee, awardTitle FROM Individuals where firstNameNominee like \"%" . $_POST['firstNameNominee'] . "%\"";		
		//print $query;
		
		$result = $db->query($query);
		
		echo "<br>";
		
		print $results;
		
		if($result->num_rows == 0) {
			//not registered
			$error = true;
			$error_msg = "<br> <br><font size=\"+1\">Table Empty</font>";
			print $error_msg;
		} else {
			while ($Individuals =  $result->fetch_array()) {
				print  "<a href=\"backwebinfoindv.php?lastNameNominee=" . $Individuals['lastNameNominee'] . "\">" . $Individuals['lastNameNominee'] . ",&nbsp;" . $Individuals['firstNameNominee'] . "-&nbsp;" . $Individuals['awardTitle'] . "</a>";
				/*print "<a href=\"backwebinfo.php?id=" . $Individuals['nameNominee'] . "\">" . $Individuals['awardTitle'] .  "</a>" ;*/
				echo "&nbsp;";
				echo "<br>";
				
			}
			
	}
}

/*if(!$_POST['awardTitle'] == ""){
	
	$DBlink = mysql_connect("trinity.sunion.arizona.edu", "web", "viv3nij")
		or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. (error 1)</p>");

	//Choose DB
	mysql_select_db("accolades", $DBlink)
		or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)</p>");

	//Check to see if the person is registered
		$query = "select lastNameNominee, firstNameNominee, awardTitle FROM Individuals where awardTitle like \"" . $_POST['awardTitle'] . "%\"";		


		$result = mysql_query($query, $DBlink);
		
		echo "<br>";
		
		print $results;
		
		if(mysql_num_rows($result) == 0) {
			//not registered
			$error = true;
			$error_msg = "<br> <br><font size=\"+1\">Table Empty</font>";
			print $error_msg;
		} else {
			while ($Individuals = mysql_fetch_array($result, MYSQL_ASSOC)) {
				print  "<a href=\"backwebinfoindv.php?lastNameNominee=" . $Individuals['lastNameNominee'] . "\">" . $Individuals['lastNameNominee'] . ",&nbsp;" . $Individuals['firstNameNominee'] . "-&nbsp;" . $Individuals['awardTitle'] . "</a>";
				//print "<a href=\"backwebinfo.php?id=" . $Individuals['nameNominee'] . "\">" . $Individuals['awardTitle'] .  "</a>" ;
				echo "&nbsp;";
				echo "<br>";
				
			}
			
	}
}*/

page_finish() ?>
