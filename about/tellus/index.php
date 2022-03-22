<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	$page_options['title'] = 'About the Unions';
  	$page_options['page'] = 'about';
  	$page_options['styles'] = '#right-col img { margin-bottom: 5px;}';
  	$page_options['header_image'] = '/template/images/banners/tellus.jpg';
	about_start($page_options);
?>
<h1>Tell US!</h1>
<!--
<p>
	Surveys aren't fun, but spouting off your opinion is! Just answer a few easy questions and tell us all about your experiences with the Union, good or bad. Or if you just have a quick comment or question, feel free to drop it in the feedback box or tweet us <a href="http://twitter.com/#!/arizonaunions">@arizonaunions</a>.
</p>

<a href="survey.php"><h2 onmouseover="this.style.color='#cc1f35'" onmouseout="this.style.color='#444'">Tell Us! survey <img src="/template/images/buttons/arrow.png" height="13" /></h2></a>
-->
<p>
	If you just have a quick comment or question, feel free to drop it in the feedback box or tweet us <a href="http://twitter.com/#!/arizonaunions">@arizonaunions</a>.
</p>
<p>
	You’ve got opinions and we want to hear them! While we'd love to hear how awesome we are, we understand that you might not always feel that way (or maybe you do!) Share your honest feedback in a quick survey and we'll try to do better next time!
</p>
<br /><br />
<h2>Got a request or question on the go? Tweet us: <a href="http://twitter.com/#!/arizonaunions">@arizonaunions</a></h2>
<br /><br />
<h2 onclick="document.getElementById('feedback').style.display='block';" style="cursor:pointer;" onmouseover="this.style.color='#cc1f35'" onmouseout="this.style.color='#444'">Student Union Feedback box <img src="/template/images/buttons/arrow.png" height="13" /></h2>
<p>
	Comments, questions or requests go in our cool feedback box.
</p>
<div id="feedback" style="display:none;">
	<table border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
	<tr>
		<td>
			<table border="0" cellpadding="16" cellspacing="1" width="100%">
				<tr>
					<td bgcolor="#cccccc">
						<form name="" action="/template/form.php" method="post" onsubmit="return javascript_confirm()">
							<input type="hidden" value="http://www.union.arizona.edu/index.php" name="return_link"><input type="hidden" value="Arizona Student Unions Feedback" name="subject"><input type="hidden" value="create" name="recipient">
							<table border="0" cellpadding="1" cellspacing="2" width="455">
								<tr>
									<td style="padding-bottom:5px;">
										your name<br />
										<input type="text" name="name_required" size="33" tabindex="100" />
										<input type="text" name="human" style="display: none;">
									</td>
								</tr>
									<td style="padding-bottom:5px;">your affiliation<br />
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
									<td style="padding-bottom:5px;">
										your email (so we can contact you)<br />
										<input type="text" name="email_required" size="38" tabindex="101">
									</td>
								</tr>
								<tr>
									<td>
										area of concern<br />
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
							<table border="0" cellpadding="1" cellspacing="2" width="455">
								<tr>
									<td width="260"></td>
									<td width="150"></td>
								</tr>
								<tr>
									<td width="260"></td>
									<td width="150"></td>
								</tr>
							</table>
							<table border="0" cellpadding="1" cellspacing="2" width="266">
								<tr>
									<td width="260">your comments/suggestions (100 words max)</td>
								</tr>
								<tr>
									<td width="260"><textarea name="comments" cols="45" rows="7" tabindex="105"></textarea><input type="hidden" value="<?php echo (isset($HTTP_USER_AGENT) ? $HTTP_USER_AGENT : ''); ?>" name="user_agent">
</td>
								</tr>
								<tr>
									<td width="260"><input type="submit" name="" value="send your feedback" tabindex="106"><input type="reset" value="clear form" tabindex="107"></td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>
<?php
// right_column();

	############################################
	# required for all pages using DELIVERANCE #
	############################################

	// enables 'edit | view' options to appear for authorized users
	//session_start();

	// connect to database
	// require_once("/srv/www/htdocs/commontools/deliverance/inc_db_switch.php");
	// require_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");

	// includes the display functions
	// require_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");

	################################
	# end DELIVERANCE requirements #
	################################

	// randomFeed(37);
	// sequentialFeed(38);
?>

</div>
<?php
about_finish() ?>
