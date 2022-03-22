<?php 
	require('about.inc');
  	$page_options['title'] = 'Nomination for USS Arizona Outstanding University Achievement';
  	about_start($page_options);

$errors = '';
$list_award_type = array('Outstanding Recognition', 'Memorial Recognition');

$list_name_title = array('Mr.', 'Mrs.', 'Ms.', 'Dr.');
$list_classification = array('Student', 'Faculty', 'Staff', 'Alumni');

$award_type = intval($_POST['award_type']);
$award_type_special = (!isset($_POST['award_type_special'])) ? -1 : intval($_POST['award_type_special']);
$award_title = strip_tags($_POST['award_title']);
$award_date = strip_tags($_POST['award_date']);
$award_description = strip_tags($_POST['award_description']);
$award_significance = strip_tags($_POST['award_significance']);

$name_title = intval($_POST['name_title']);
$name_first = strip_tags($_POST['name_first']);
$name_last = strip_tags($_POST['name_last']);

$classification = intval($_POST['classification']);
$department = strip_tags($_POST['department']);
$title = strip_tags($_POST['title']);

$address = strip_tags($_POST['address']);
$phone = strip_tags($_POST['phone']);
$email = strip_tags($_POST['email']);

$nominator_name = strip_tags($_POST['nominator_name']);
$nominator_department = strip_tags($_POST['nominator_department']);
$nominator_title = strip_tags($_POST['nominator_title']);
$nominator_email = strip_tags($_POST['nominator_email']);
$nominator_phone = strip_tags($_POST['nominator_phone']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!isset($award_type) || empty($award_title) || empty($award_date) || empty($award_description) || empty($award_significance) ||
		empty($name_first) || empty($name_last) || !isset($classification) || empty($department) || empty($title) || empty($address) || empty($phone) || empty($email) ||
		empty($nominator_name) || empty($nominator_department) || empty($nominator_title) || empty($nominator_email) || empty($nominator_phone))
	{
		$errors = 'One or more fields have not been filled out. Please revise your entries and try again.';
	}

	if (empty($errors)) {
		echo '<h1>Thank you for submitting the form!</h1>';
		
		$award_description = nl2br($award_description);
		$award_significance = nl2br($award_significance);
		
		$message = "
<h3>Section I</h3>
<p><strong>Achievement/Recognition Type:</strong> {$list_award_type[$award_type]} </p>

<hr><h3>Section II</h3>
<p><strong>Nominee Name:</strong> {$list_name_title[$name_title]} $name_first $name_last
<br><strong>Classification:</strong> {$list_classification[$classification]}
<br><strong>Department Name:</strong> $department
<br><strong>Title:</strong> $title</p>
<p><strong>Address:</strong> $address
<br><strong>Phone:</strong> $phone
<br><strong>Email:</strong> $email</p>

<hr><h3>Section III</h3>
<p><strong>Achievement/Award Title:</strong> $award_title
<br><strong>Date of Achievement/Award:</strong> $award_date</p>
<p><strong>Description of the Achievement/Award:</strong><blockquote>$award_description</blockquote></p>
<p><strong>Why this achievement brings significant recongnition to the University of Arizona:</strong><blockquote>$award_significance</blockquote></p>

<hr><h3>Section IV</h3>
<p><strong>Nominator Name:</strong> $nominator_name
<br><strong>Nominator Department:</strong> $nominator_department
<br><strong>Nominator Title:</strong> $nominator_title
<br><strong>Nominator Email:</strong> $nominator_email
<br><strong>Nominator Phone:</strong> $nominator_phone</p>
";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Student Union <noreply@union.arizona.edu>' . "\r\n";
		mail('harrisoj@email.arizona.edu', 'Nomination for USS Arizona Outstanding University Achievement', $message, $headers);
	}
}

if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($errors)):
echo '<h3 style="color: red">' . $errors . '</h3>';
?>
<form method="post">
<h2>Section I</h2>
<p>Achievement / Recognition Type:</p>
<?php
$temp = array();
foreach ($list_award_type as $key => $value) {
	$checked = ($award_type == $key) ? ' checked="checked"' : '';
	$temp[] = '<input type="radio" name="award_type" value="' . $key . '"' . $checked . ' /> ' . $value;
}
echo implode('<br />', $temp);
?>

<hr style="margin-top: 10px;" /><h2>Section II</h2>
<p><strong>Nominee Info:</strong></p>
<p>Nominee Name:</p>
<p><select name="name_title">
<?php
foreach ($list_name_title as $key => $value) {
	$selected = ($name_title == $key) ? ' selected="selected"' : '';
	echo "<option value=\"$key\"$selected>$value</option>\n";
}
?>
</select>
First: <input type="text" name="name_first" size="25" value="<?php echo $name_first; ?>" />
Last <input type="text" name="name_last" size="25" value="<?php echo $name_last; ?>" /></p>

<p>Classification:<br />
<?php
$temp = array();
foreach ($list_classification as $key => $value) {
	$checked = ($classification == $key) ? ' checked="checked"' : '';
	$temp[] = '<input type="radio" name="classification" value="' . $key . '"' . $checked . ' /> ' . $value;
}
echo implode('<br />', $temp);
?>

<p>Department Name:<br /><input type="text" name="department" size="35" value="<?php echo $department; ?>" /><br />
Title:<br /><input type="text" name="title" size="35" value="<?php echo $title; ?>" /></p>

<p>Address:<br />
	<input type="text" name="address" size="35" value="<?php echo $address; ?>" /><br />
Phone:<br />
	<input type="text" name="phone" size="35" value="<?php echo $phone; ?>" /><br />
Email:<br />
	<input type="text" name="email" size="35" value="<?php echo $email; ?>" /></p>

<hr /><h2>Section III</h2>
<p>Achievement / Award Title:<br />
	<input type="text" name="award_title" size="35" value="<?php echo $award_title; ?>" /></p>
<p>Date of Achievement/Award:<br />
	<input tpye="text" name="award_date" size="8" value="<?php echo $award_date; ?>" /></p>
<p>Description of the Achievement/Award (100 words or less):<br />
	<textarea name="award_description" rows="4" cols="70"><?php echo $award_description; ?></textarea></p>
<p>Please describe why this achievement brings significant recongnition to the University of Arizona:<br />
	<textarea name="award_significance" rows="6" cols="70"><?php echo $award_significance; ?></textarea></p>

<hr /><h2>Section IV</h2>
<p><strong>Nominator Info:</strong></p>
<p>Name:<br />
	<input type="text" name="nominator_name" size="35" value="<?php echo $nominator_name; ?>" /></p>
<p>Department:<br />
	<input type="text" name="nominator_department" size="35" value="<?php echo $nominator_department; ?>" /></p>
<p>Title:<br />
	<input type="text" name="nominator_title" size="35" value="<?php echo $nominator_title; ?>" /></p>
<p>Phone:<br />
	<input type="text" name="nominator_phone" size="35" value="<?php echo $nominator_phone; ?>" /></p>
<p>Email:<br />
	<input type="text" name="nominator_email" size="35" value="<?php echo $nominator_email; ?>" /></p>

<p><input type="submit" name="submit" value="Submit" /></p>
</form>
<?php endif; page_finish() ?>