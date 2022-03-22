<?php
	require('about.inc');
	$page_options['title'] = 'Student Union Advisory Council';
	about_start($page_options);
	session_start();
?>

<h1>Student Unions Advisory Council</h1>
<h3>MEMBERSHIP APPLICATION</h3>
<!--<p>The application period for a position on the 2006 Student Unions Advisory Council is now over.</p>-->
 
<p><b>Deadline: October 12<sup>th</sup>, 2012</b></p>
<span style="color: red"><?=$_SESSION['error'] ?></span>
<?php
	unset($_SESSION['error']);
?>
<form method="post" action="suac_app_submit.php" onsubmit="return confirm('Please confirm that it is OK to send form.')">
	<input type="hidden" name="area_of_concern" value="student_advisory_council"><input type="hidden" name="subject" value="Student Union Advisory Council Application"><input type="hidden" value="http://www.union.arizona.edu/about/suac.php" name="return_link">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="1" cellpadding="8">
					<tr>
						<td valign="top" bgcolor="white"><b>1. </b></td>
						<td valign="top" bgcolor="white">
							<p><b>About you:</b></p>
							<p>Name:<br>
								<input type="text" name="name_required" size="34" value="<?=$_SESSION['name_required'] ?>"/></p>
							<p>Daytime Phone:<br>
								<input type="text" name="phone_required" size="15" value="<?=$_SESSION['phone_required'] ?>"/></p>
							<p>Address:<br>
								<input type="text" name="address_required" size="35" value="<?=$_SESSION['address_required'] ?>"/></p>
							<p>Message Phone:<br>
								<input type="text" name="voicemail_required" size="15" value="<?=$_SESSION['voicemail_required'] ?>"/></p>
							<p>E-Mail Address:<br>
								<input type="text" name="email_required" size="30" value="<?=$_SESSION['email_required'] ?>"/></p>
							<p>Live on campus?
								<input type="radio" name="live_on_campus" value="Yes" <?=(($_SESSION['live_on_campus'] == 'Yes') ? 'checked' : '') ?>/> Yes
								<input type="radio" name="live_on_campus" value="No" <?=(($_SESSION['live_on_campus'] == 'No') ? 'checked' : '') ?>/> No</p>
						</td>
					</tr>
					<tr>
						<td valign="top" bgcolor="white"><b>2. </b></td>
						<td valign="top" bgcolor="white">Major:<br>
							<input type="text" name="major" size="35" value="<?=$_SESSION['major'] ?>"/>
							<p>GPA:<br>
								<input type="text" name="GPA" size="5" value="<?=$_SESSION['GPA'] ?>"/></p>
						</td>
					</tr>
					<tr>
						<td valign="top" bgcolor="white"><b>3. </b></td>
						<td valign="top" bgcolor="white"><b>Class standing:
							<input type="radio" name="class_standing" value="Freshman" <?=($_SESSION['class_standing'] == 'Freshman') ? 'checked' : '' ?>/></b> Freshman
							<input type="radio" name="class_standing" value="Sophmore" <?=($_SESSION['class_standing'] == 'Sophmore') ? 'checked' : '' ?>/> Sophomore
							<input type="radio" name="classStanding" value="Junior" <?=($_SESSION['class_standing'] == 'Junior') ? 'checked' : '' ?>/> Junior
							<input type="radio" name="class_standing" value="Senior" <?=($_SESSION['class_standing'] == 'Senior') ? 'checked' : '' ?>/> Senior
							<input type="radio" name="class_standing" value="Grad" <?=($_SESSION['class_standing'] == 'Grad') ? 'checked' : '' ?>/> Grad</td>
					</tr>
					<tr>
						<td valign="top" bgcolor="white"><b>4. </b></td>
						<td valign="top" bgcolor="white"><b>Other student organization involvement: </b>
							<p><textarea name="other_org_involvement" rows="10" cols="60" /><?=$_SESSION['other_org_involvement'] ?></textarea></p>
						</td>
					</tr>
					<tr>
						<td valign="top" bgcolor="white"><b>5. </b></td>
						<td valign="top" bgcolor="white"><b>Briefly describe why you are interested in becoming a member of the Student Unions Advisory Council:</b>
							<p><textarea name="why_interested" rows="10" cols="60" /><?=$_SESSION['why_interested'] ?></textarea></p>
						</td>
					</tr>
					<tr>
						<td valign="top" bgcolor="white"><b>6. </b></td>
						<td valign="top" bgcolor="white">
							<p><b>Identify two major Union issues you would like considered by the Arizona Student Unions Advisory Council:</b></p>
							<p><textarea name="two_issues" rows="10" cols="60" /><?=$_SESSION['two_issues'] ?></textarea></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<p><b></b></p>
	<p><input type="submit" value="Submit Your Application" name=""></p>
</form>

<?php about_finish() ?>
