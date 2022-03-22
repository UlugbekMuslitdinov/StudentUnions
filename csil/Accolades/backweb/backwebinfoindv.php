<?php
	require('../indvawards/indvqs.php');
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

<a href="/csil/Accolades/"><img src="../AccoladesLogoFINAL.gif" /></a><br />
<?

	$id=$_GET ['lastNameNominee'];
	
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli('accolades13');
 
		$query = "select lastNameNominee, firstNameNominee, currentMailNominee, currentMailNominee2, currentMail, currentMail2, cityStateZipNominee, cityStateZip, awardTitle, nominatorName, phone, email, phoneNominee, emailNominee, college, relationToNominee, department, question1, question2, question3, question4 FROM Individuals WHERE lastNameNominee = \"" . $id . "\";";

		//print $query;

		$result = $db->query($query);
		
		if($result->num_rows == 0) {
			//not registered
			$error = true;
			$error_msg = "No such Name";
			print $error_msg;
		} else {
			while ($Individuals = $result->fetch_array()) {
		echo '<hr>';
		print "Name &nbsp;" . $Individuals['firstNameNominee'] . "&nbsp;" .  $Individuals['lastNameNominee'] . "<br>";
		print "Award Nominated &nbsp;" .  $Individuals['awardTitle']. "<br><br>";
		
		print "Address &nbsp;" . $Individuals['currentMailNominee'] . "<br>";
		print "Address Line 2 &nbsp;" .  $Individuals['currentMailNominee2']. "<br>";
		print "City, State and ZIP &nbsp;" .  $Individuals['cityStateZipNominee'] . "<br>";
		print "Phone &nbsp;" . $Individuals['phoneNominee'] . "<br>";
		print "Email &nbsp;" . $Individuals['emailNominee'] . "<br>";
		print "College &nbsp;" . $Individuals['college'] . "<br>";
		print "Department &nbsp;" . $Individuals['department'] . "<br><br />";
		
		echo "Nominated By: <br /><br />";
		
		print "Nominator: &nbsp;" . $Individuals['nominatorName'] . "<br>";
		print "Address &nbsp;" . $Individuals['currentMail'] . "<br>";
		print "Address Line 2 &nbsp;" .  $Individuals['currentMail2']. "<br>";
		print "City, State and ZIP &nbsp;" .  $Individuals['cityStateZip'] . "<br>";
		print "Phone &nbsp;" . $Individuals['phone'] . "<br>";
		print "Email &nbsp;" . $Individuals['email'] . "<br>";
		print "Relation to Nominee&nbsp;" . $Individuals['relationToNominee'] . "<br>"; 
		
		print "<br><br>";
		
		for ($i = 1; $i <= 9; $i++) {
			if ($individualq[$i][5] == $Individuals['awardTitle']) {
		
			echo $individualq[$i][1] . ": <br /><br />";
			print $Individuals['question1'];
			print "<br><br>";
			
			echo $individualq[$i][2] . ": <br /><br />";
			print $Individuals['question2'];
			print "<br><br>";
			
			echo $individualq[$i][3] . ": <br /><br />";
			print $Individuals['question3'];
			print "<br><br>";
			
			echo $individualq[$i][4] . ": <br /><br />";
			print $Individuals['question4'];
			print "<br><br>";
				}
			}
		
		}
	}

		
		echo "<br>";

		


	
page_finish()	?>