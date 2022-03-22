<?php
	require('../GroupAwards/groupqs.php');
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
<br /><br />
<?

	$id=$_GET['nameOrganization'];
	
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli('accolades13');
 
		$query = "select nameOrganization, currentMailOrg, currentMailOrg2, currentMail, currentMail2, cityStateZipOrg, cityStateZip, awardTitle, nominatorName, phone, email, phoneOrg, emailOrg, relationToNominee, question1, question2, question3, question4 FROM Groups WHERE nameOrganization = \"" . $id . "\"";

		//print $query;
		
		$result = $db->query($query);
		
		if($result->num_rows == 0) {
			//not registered
			$error = true;
			$error_msg = "No such Name";
			print $error_msg;
		} else {
			while ($Groups = $result->fetch_array()) {
		
		echo '<hr>';
		print "Organization &nbsp;" . $Groups['nameOrganization'] . "<br>";
		print "Award Nominated &nbsp;" .  $Groups['awardTitle']. "<br><br>";
		
		print "Address &nbsp;" . $Groups['currentMailOrg'] . "<br>";
		print "Address Line 2 &nbsp;" .  $Groups['currentMailOrg2']. "<br>";
		print "City, State and ZIP &nbsp;" .  $Groups['cityStateZipOrg'] . "<br>";
		print "Phone &nbsp;" . $Groups['phoneOrg'] . "<br>";
		print "Email &nbsp;" . $Groups['emailOrg'] . "<br><br>";
		
		echo "Nominated By: <br /><br />";
		
		print "Nominator: &nbsp;" . $Groups['nominatorName'] . "<br>";
		print "Address &nbsp;" . $Groups['currentMail'] . "<br>";
		print "Address Line 2 &nbsp;" .  $Groups['currentMail2']. "<br>";
		print "City, State and ZIP &nbsp;" .  $Groups['cityStateZip'] . "<br>";
		print "Phone &nbsp;" . $Groups['phone'] . "<br>";
		print "Email &nbsp;" . $Groups['email'] . "<br>";
		print "Relation to Nominee&nbsp;" . $Groups['relationToNominee'] . "<br>"; 
		
		for ($i = 1; $i <= 7; $i++) {
			if ($groupques[$i][5] == $Groups['awardTitle']) {
		
			echo $groupques[$i][1] . ": <br /><br />";
			print $Groups['question1'];
			print "<br><br>";
			
			echo $groupques[$i][2] . ": <br /><br />";
			print $Groups['question2'];
			print "<br><br>";
			
			echo $groupques[$i][3] . ": <br /><br />";
			print $Groups['question3'];
			print "<br><br>";
			
			echo $groupques[$i][4] . ": <br /><br />";
			print $Groups['question4'];
			print "<br><br>";
				}
			}
		
		}
	}
		
		echo "<br>";

		


	
page_finish()	?>