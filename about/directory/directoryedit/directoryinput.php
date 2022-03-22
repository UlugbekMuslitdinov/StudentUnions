<?php
session_start();
require_once ('includes/mysqli.inc');
require_once ('about.inc');
$page_options['title'] = 'Staff Directory';
$page_options['page'] = 'about';
about_start($page_options);

if (!$_SESSION['directory_access']) {
	echo 'not allowed';
	about_finish();
	exit();
}
?>
<h2>Arizona Student Unions Staff Directory Backweb</h2>

<?
/* THIS PART IS FOR EDITS */


if(isset($_GET['edit'])) {

  		$db = new db_mysqli('unionstaffdirectory');
		
		$query = "SELECT * from employee where id =" . $_GET['edit'];
		$result = $db->query($query);
		$row = $result->fetch_array();
		
		print "<h1 style=\"color:red\">Edit " . $row['directoryFN'] . "&nbsp;" . $row['directoryLN'] . "</h1>";
		
		print "<form action=\"directoryresults.php\" method=\"post\">";

		print "Last Name: <br />";
		print "<input type=\"text\" maxlength=\"25\" size=\"25\" name=\"directoryLN\" value=\"" . $row['directoryLN'] . "\"><br /><br />";
		
		print "First Name: <br />";
		print "<input type=\"text\" maxlength=\"25\" size=\"25\" name=\"directoryFN\" value=\"" . $row['directoryFN'] . "\"/><br /><br />";
		
		print "Department: <br />";
		print "<select name=\"directoryDept\">";
		
		if ($row['departmentId'] == "1") {
		print "	<option value=\"1\" SELECTED>administration &amp; business office</option>";
		} else {
		print "	<option value=\"1\">administration &amp; business office</option>";
		}
		
		if ($row['departmentId'] == "2") {
		print "	<option value=\"2\" SELECTED>center for student involvement &amp; leadership</option>";
		} else {
		print "	<option value=\"2\">center for student involvement &amp; leadership</option>";
		}
		
		if ($row['departmentId'] == "3") {
		print "	<option value=\"3\" SELECTED>dining &amp; information services</option>";
		} else {
		print "	<option value=\"3\">dining &amp; information services</option>";
		}
		
		if ($row['departmentId'] == "4") {
		print "<option value=\"4\" SELECTED>event planning &amp; catering</option>";
		} else {
		print "<option value=\"4\">event planning &amp; catering</option>";
		}
		
		if ($row['departmentId'] == "5") {
		print "<option value=\"5\" SELECTED>facilities management &amp; computer services</option>";
		} else {
		print "<option value=\"5\">facilities management &amp; computer services</option>";
		}
		
		if ($row['departmentId'] == 9) {
		print "<option value=\"9\" SELECTED>retail services</option>";
		} else {
		print "<option value=\"9\">retail services</option>";
		}
		
		print "</select>";
		//var_dump($row);
		print "<br /><br />";
		
		print "Job Title: <br />";
		print "<input type=\"text\" maxlength=\"50\" size=\"50\" name=\"jobTitle\" value=\"" . $row['jobTitle'] . "\"/><br /><br />";
		
		print "Email: <br />";
		print "<input type=\"text\" maxlength=\"50\" size=\"50\" name=\"email\" value=\"" . $row['email'] . "\" /><br /><br />";
		
		print "Phone (###-###-####): <br />";
		print "<input type=\"text\" maxlength=\"20\" size=\"25\" name=\"phone\" value=\"" . $row['phone'] . "\"/><br /><br />";
		
		print "<input type=\"hidden\" name=\"editUser\" value=\"true\" />";
		print "<input type=\"hidden\" name=\"id\" value=" . $row['id'] . ">";
		
		print "<input type=\"submit\" value=\"Edit\"/>";
		

		
		
		/* $query = "DELETE * from employee where id =" . $_GET['edit'];
		db_query($query, $DBlink);*/
		

} else {

?>

<form action="directoryresults.php" method="post">

Last Name: <br />
<input type="text" maxlength="25" size="25" name="directoryLN" /><br /><br />

First Name: <br />
<input type="text" maxlength="25" size="25" name="directoryFN" /><br /><br />

Department: <br />
<select name="directoryDept">
	<option value="none">-- --</option>
	<option value="Admin &amp; Business Office">administration &amp; business office</option>
	<option value="CSIL">center for student involvement &amp; leadership</option>
	<option value="Dining Services">dining &amp; information services</option>
	<option value="Event Services">event services &amp; catering</option>
	<option value="FCS">facilities management &amp; computer services</option>
	<option value="Retail">retail services</option>
</select>
<br /><br />

Job Title: <br />
<input type="text" maxlength="50" size="50" name="jobTitle" /><br /><br />

Email: <br />
<input type="text" maxlength="50" size="50" name="email" /><br /><br />

Phone (###-###-####): <br />
<input type="text" maxlength="20" size="25" name="phone" /><br /><br />

<input type="hidden" name="addUser" value="true" />

<input type="submit" value="Add"/>

<?php
}

about_finish()
?>