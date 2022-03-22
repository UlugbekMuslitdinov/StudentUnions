<?php
// Force WWW for webauth
if (!strstr($_SERVER['HTTP_HOST'], 'styx') && !strstr($_SERVER['HTTP_HOST'], 'sutest') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
{
	header('Location: https://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	exit;
}

$base = '';
if (strstr($_SERVER['PHP_SELF'], 'bwapp.php'))
{
	$base = '../';
}
else
{
	session_start();
}

//If someone comes back to the beginning.
session_destroy();

require_once('page_start.php');
?>

<h1>Equiss Social Justice Retreat</h1>
<p><strong>Registration Deadline: <?php echo DEADLINE; ?> $<?php echo COST; ?></strong></p>
<p>This retreat is limited to 50 participants. We encourage people to register as early as possible, because we may close registration before <?php echo DEADLINE; ?> in the event we reach capacity. Participants will be selected on a first-come, first-served basis. </p>

<h2>On-Line Registration</h2>
<ul>
   	<li>Online registrations must be submitted using a credit card, IDB code, check code, or scholarship code.
	<li>Final registration must be submitted on-line by <?php echo DEADLINE; ?>.
    <li>Cancellations must be emailed by April 22, 2011.
</ul>

<?php
if (close_registration()):
?>
We are sorry but the registration period for Equiss has ended!
<?php else: ?>
<table>
<tr><td colspan="3"><strong>We currently have <?php echo (50 - reg_count()); ?> spots left!</strong></td></tr>
<tr>
<?php
if (strstr($_SERVER['PHP_SELF'], 'bwapp.php'))
{
	// Authentication list
	if (in_array($_SESSION['webauth']['netID'], $admin))
	{
		echo '<td>
		<form action="' . $base . 'application.php" method="post">
		<input type="hidden" name="check" value="true" />
			<input type="submit" value="Check Registrations" />
		</form>
		</td>';
	}
}
else
{
	echo '<td>
	<form action="' . $base . 'application.php" method="post">
		<input type="submit" value="Credit Card Registrations" />
	</form>
	</td>';
}
?>
<td>
<form action="<?php echo $base; ?>application.php" method="post">
	<input type="hidden" name="idb" value="true" />
	<input type="submit" value="IDB/Check Registrations" />
</form>
</td>
<td>
<form action="<?php echo $base; ?>application.php" method="post">
	<input type="hidden" name="scholarship" value="true" />
	<input type="submit" value="Scholarship Recipient Registrations" />
</form>
</td>
</tr>
</table>

<h2>Scholarship Information</h2>

<p>The Equiss Social Justice Retreat is dedicated to providing financial assistance to those individuals who show strong ambition and desire to attend yet are financially unable to pay the registration fee. Full and partial scholarships are awarded on a first-come, first-served basis and only cover registration fees.</p>

<p>To qualify, we ask that you follow the link below to complete the on-line scholarship application.</p>

<p>Scholarships are limited to University of Arizona undergraduate students.</p>

<form action="scholarship_app.php" method="post">
	<input type="submit" value="Apply Now!" />
</form>

<?php
endif;

require_once('page_end.php');
?>
