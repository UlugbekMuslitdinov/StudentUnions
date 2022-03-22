<?php require_once('page_start.php'); ?>

<h1>2011 Equiss Social Justice Retreat</h1>
<h1>Scholarship Application</h1>

<?php
$_POST = array_map('htmlentities', $_POST);

if (isset($_POST['submit']))
{
	$name = clean_string($_POST['name']);
	$address = clean_string($_POST['address']);
	$email = clean_string($_POST['email']);
	$phone = clean_string($_POST['phone']);
	$catcard = clean_string($_POST['catcard']);
	$fin = clean_string($_POST['fin']);
	$imp = clean_string($_POST['imp']);
	
	$errors = array();
	if (empty($name))
		$errors[] = 'You have not entered your name';
		
	if (empty($address))
		$errors[] = 'You have not entered your address';
		
	if (empty($email))
		$errors[] = 'You have not entered your email address';
		
	if (empty($phone))
		$errors[] = 'You have not entered your phone number';
	
	if (empty($catcard))
		$errors[] = 'You have not entered your catcard number';
	
	if (empty($fin))
		$errors[] = 'You have not entered the reason for applying for this scholarship';
	
	if (empty($imp))
		$errors[] = 'You have not entered why attending EQUISS is important to you';
	
	if (empty($errors))
	{
		echo '<p>Your scholarship application is complete!<br />Thank you for applying for an equiss scholarship!';
		
		$to = EMAIL_ADMIN;
		$subject = "Equiss Scholarship Application";
		$message = "
Name: $name
Address: $address
Email: $email
Phone: $phone
CatCard #: $catcard

Please explain your financial need for this scholarship:
$fin

Explain why attending Equiss is important to you and what you plan to bring back to your community:
$imp";
		$headers = "From: union@email.arizona.edu";
		mail($to, $subject, $message, $headers);
	}
}

if (!isset($_POST['submit']) || !empty($errors))
{
	if (!empty($errors))
	{
		foreach ($errors as $error)
			echo '<div style="color: red">' . $error . '</div>';
	}
?>
<p>Scholarships are only available for University of Arizona undergraduate students.</p>

<form id="schol_app" method="post">
<p>Scholarship applications are due no later than April 8, 2011. You will be notified of your scholarship status via email. If you are selected to receive a scholarship, you will be sent a scholarship verification code with a link to the registration form. You will need to submit your registration within 1 week of receiving your scholarship notification or the awarded scholarship will expire. </p>

<table>
<tr>
	<td><p>Name</p></td>
	<td><input id="name" name="name" value="<?php echo $name; ?>" /></td>
	<td><p>Address</p></td>
	<td><input id="address" name="address" value="<?php echo $address; ?>" /></td>
</tr>
<tr>
	<td><p>Email Address</p></td>
	<td><input id="email" name="email" value="<?php echo $email; ?>" /></td>
	<td><p>Phone Number</p></td>
	<td><input id="phone" name="phone" value="<?php echo $phone; ?>" /></td>
    </tr>
<tr>
	<td><p>CatCard #</p></td>
	<td><input id="catcard" name="catcard" value="<?php echo $catcard; ?>" /></td>
</tr>
</table>

<p>Please limit your typed response to 150 words per question.</p>

<p>1. Please explain your financial need for this scholarship.<br />
<textarea id="fin" name="fin" cols="50" rows="6"/><?php echo $fin; ?></textarea>

<p>2. Explain why attending Equiss is important to you and what you plan to bring back to your community after the retreat.<br />
<textarea id="imp" name="imp" cols="50" rows="6"/><?php echo $imp; ?></textarea>

<br /><input type="submit" name="submit" id="submit" value="Submit" />

<?php 
}

require_once('page_end.php');
?>