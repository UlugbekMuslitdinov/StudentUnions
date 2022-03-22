<?php
require_once('password_protect.php');
require_once('page_start.php');

$error = false;

if (isset($_POST['submit']))
{
	$id = intval($_POST['id']);
	$firstName = clean_string($_POST['firstName']);
	$lastName = clean_string($_POST['lastName']);
	
	//Check to see if the person is registered
	$check = (!empty($lastName)) ? "lastName LIKE '%$lastName%'" : (!empty($firstName) ? "firstName LIKE '%$firstName%'" : "id = $id");
	
	$result = mysql_query("SELECT lastName, firstName, status, id FROM registration WHERE $check");
	if (mysql_num_rows($result) > 0)
	{
		while ($registrants = mysql_fetch_assoc($result))
		{
			$registrants = array_map('htmlentities', $registrants);
			echo (!$registrants['status'] ? '<del>' : ''),
			"<a href=\"backwebinfo.php?id={$registrants['id']}\">{$registrants['firstName']} {$registrants['lastName']}</a><br>",
			(!$registrants['status'] ? '</del>' : '');
		}
	}
	else
	{
		$error = true;
		echo "No such Name";
	}
}

if (!isset($_POST['submit']) || $error):
?>

<h1 size="+2">Equiss BACKWEB</h1>

<h2>To conduct a search you may enter the party's first name, last name, or ID number and all possible results will be displayed</h2>

<h3>Search By First Name</h3>
<form name="firstName" method="post">
	<input type="text" name="firstName" maxlength="30" size="45" autocomplete="off" /><br />
	<input type="submit" name="submit" value="Submit Form"> <input type="Reset">
</form><br />

<h3>Search By Last Name</h3>
<form name="lastName" method="post">
	<input type="text" name="lastName" maxlength="30" size="45" autocomplete="off" /><br />
	<input type="submit" name="submit" value="Submit Form"> <input type="Reset">
</form>
<br />

<h3>Search By ID</h3>
<form name="id" method="post">
	<input type="text" name="id" maxlength="30" size="45" autocomplete="off" /><br />
	<input type="submit" name="submit" value="Submit Form"> <input type="Reset">
</form>

<?php 
endif;

require_once('page_end.php');
?>