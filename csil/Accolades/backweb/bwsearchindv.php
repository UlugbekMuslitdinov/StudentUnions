<?php
	
	require('global.inc');
	$title = 'Accolades BACKWEB';
	page_start($title);
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

<h1 size="+2">Accolades BACKWEB</h1>

<h2>To conduct a search you may enter the party's first name or last name and all possible results will be displayed</h2>


<h3>Search By First Name</h3>
<form name="firstName" action="bwresultsindv.php" method="post">
	<input type="text" name="firstNameNominee" maxlength="30" size="45" autocomplete="off" /><br />
<input type="submit" value="Submit Form"> <input type="Reset">
</form><br />

<h3>Search By Last Name</h3>

<form name="lastName" action="bwresultsindv.php" method="post">
	<input type="text" name="lastNameNominee" maxlength="30" size="45" autocomplete="off" /><br />
<input type="submit" value="Submit Form"> <input type="Reset">
</form>
<br />

<!--<h3>Search By Award Nominated For</h3>

<form name="awardTitle" action="bwresultsindv.php" method="post">
	<input type="text" name="awardTitle" maxlength="30" size="45" autocomplete="off" /><br />
<input type="submit" value="Submit Form"> <input type="Reset">
</form>
<br />-->

<!-- table cause the main page was too short in height and unfortunately IE is as HTML and CSS literate as Allen Iverson -->

<table>
	<tr height="200px">
    	<td>&nbsp;
        </td>
     </tr>
</table>

<?php page_finish() ?>