<?php
	

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
	

?>
<title>Accolades Backweb</title>

<?php
	
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

<h1>ACCOLADES BACKWEB GROUP AWARDS</h1>

<?
	
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli('accolades13');
 	
		$query = "select nameOrganization, awardTitle FROM Groups order by awardTitle";		
		$result = $db->query($query);
		$award = '';
		
		if($result->num_rows == 0) {
			//not registered
			$error = true;
			$error_msg = "<br> <br><font size=\"+1\">Table Empty</font>";
			print $error_msg;
		} else {
			while ($Groups =  $result->fetch_array()) {
				if ($award != $Groups['awardTitle'])
				{
					echo '<h2>' . $Groups['awardTitle'] . '</h2>';
					$award = $Groups['awardTitle'];
				}
				
				print  "<a href=\"backwebinfogrp.php?nameOrganization=" . $Groups['nameOrganization'] . "\">" . $Groups['nameOrganization'] . "</a><br>";
				
			}		
		}	
		
 page_finish() ?>
