  
<p>Message was submitted <?php echo format_date(time(), 'small') ?></p>
<p>From NetID <?php echo $_SESSION['webauth']['netID']; ?> (<?php echo $_SERVER['REMOTE_ADDR']; ?>)</p>

<?php
function display_email2($array)
{
	foreach ($array as $key => $value)
	{
		$key = str_replace('_', ' ', ucfirst($key));
		if (is_array($value))
		{
			echo "<p><strong>$key</strong>\n";
			display_email2($value);
			echo "</p>\n";
		}
		else
		{
			echo "<br />$key: $value\n";
		}
	}
}

display_email2($form_values['submitted_tree']);
?>