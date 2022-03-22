<?php
require_once('password_protect.php');
require_once('page_start.php');

$question = intval($_GET['q']);

if (!empty($question))
{
	$question = 'q_' . $question;
	
	$result = mysql_query("select $question, id FROM registration WHERE status = 1");
	if (mysql_num_rows($result) > 0)
	{
		while ($registrants = mysql_fetch_assoc($result))
		{
			$registrants = array_map('htmlentities', $registrants);
			echo "<a href=\"backwebinfo.php?id={$registrants['id']}\">{$registrants['id']}</a><br><br>{$registrants[$question]}<br><br style=\"clear: both;page-break-before:always\" />";
		}
	}
	else
	{
		echo 'No Answers';
	}
}
else
{
	echo '<h1>Essay responses</h1>
	
	<p>View prinatable versions of the answers to the Essay Questions</p>
	
	<a href="?q=1">Question 1</a><br />
	<a href="?q=2">Question 2</a><br />
	<a href="?q=3">Question 3</a>';
}

require_once('page_end.php');
?>