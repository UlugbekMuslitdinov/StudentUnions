<?php
require($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
$page_options['title'] = 'Feedback';
$page_options['page'] = 'feedback';
about_start($page_options);
?>
<script language="JavaScript" type="text/javascript">
	<!--
	function javascript_confirm() {

		// CONFIRM REQUIRES ONE ARGUMENT
		var message = "Please confirm that it is OK to send feedback.";

		// CONFIRM IS BOOLEAN. THAT MEANS THAT
		// IT RETURNS TRUE IF 'OK' IS CLICKED
		// OTHERWISE IT RETURN FALSE
		return confirm(message);

	}

	//-->
</script>
<style type="text/css">
	#phone /* For confusing bots */
	{
	display: none;
	}
	<!--
	.style1 {font-size: 10px}
	-->
</style>
<style>
	table tr td {
		padding: 5px;
		background-color: #CCCCCC;
	}
</style>

<h1>Questions about the Unions?</h1>
<p>
	Fill in the contact form below and we'll get back with you.
</p>
<table border="0" cellpadding="0" cellspacing="0" >
	<tr>
		<td>
		<table border="0" cellpadding="16" cellspacing="1" width="100%">
			<tr>
				<td>
				<form name="" action="/template/form.php" method="post" onsubmit="return javascript_confirm()">
					<input type="hidden" value="http://www.union.arizona.edu/index.php" name="return_link">
					<input type="hidden" value="Arizona Student Unions Feedback" name="subject">
					<input type="hidden" value="create" name="recipient">
					<table border="0" cellpadding="1" cellspacing="2" width="350">
						<tr>
							<td width="260" align="top"> Your Name:
							<br />
							<input type="text" name="name_required" size="38" tabindex="101">
							</td>
						</tr>
						<tr>
							<td width="260" align="top"> Your email (so we can contact you):
							<br />
							<input type="text" name="email_required" size="38" tabindex="102">
							</td>
						</tr>
						<tr>
							<td width="260" align="top"> Your Affiliation:
							<br />
							<select name="affiliation" size="1" tabindex="103">
								<option value="none selected">-- select one --</option>
								<option value="student">Student</option>
								<option value="faculty">Faculty</option>
								<option value="staff">Staff</option>
								<option value="alumni">Alumni</option>
								<option value="visitor">Visitor</option>
								<option value="parent">Parent</option>
								<option value="other">Other</option>
							</select>
							</td>
						</tr>
						<tr>
							<td width="260" align="top"> Area of Concern:
							<br />
							<select name="area_of_concern" size="1" tabindex="104">
								<option value="general_comments">General Comments</option>
								<option value="customer_service">Customer Service</option>
								<option value="employment">Employment</option>
								<option value="website_issues">Website Issues</option>
								<option value="student_involvement">Student Involvement</option>
								<option value="meeting_rooms_events">Meeting Rooms / Events</option>
								<option value="catering">Catering</option>
								<option value="restaurants_student_union">Restaurants (Student Union)</option>
								<option value="park_student_union">Park Student Union</option>
								<option value="convenience_stores_vending_machines">Convenience Stores / Vending Machines</option>
								<option value="bathrooms_maintenance">Bathrooms / Maintenance</option>
								<option value="public_areas">Public Areas</option>
								<option value="computer_labs_lounges">Computer Labs/ Lounges</option>
							</select>
							</td>
						</tr>

					</table>
					<table border="0" cellpadding="1" cellspacing="2" width="266">
						<tr>
							<td width="260" align="top"> Your Comments/Suggestions:
							<br />
							<input id="phone" name="phone" type="text"/>
							<textarea name="comments" cols="45" rows="7" tabindex="105"></textarea>
							<input type="hidden" value="<?=isset($HTTP_USER_AGENT)?$HTTP_USER_AGENT:'' ?>" name="user_agent">
							</td>
						</tr>
						<tr>
							<td width="260">
							<input type="submit" name="" value="send your feedback" tabindex="106">
							<input type="reset" value="clear form" tabindex="107">
							</td>
						</tr>
					</table>
				</form>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<?php about_finish()
?>