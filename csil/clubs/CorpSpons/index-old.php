<?php
/*
 * Corporate Sponsors
 * Created September, 2009
 */

define('ACCESS', true);
include('include.php');
require('global.inc');
$page_options['title'] = 'Clubs & Organizations';
page_start($title);

$errors = array();
if (isset($_POST['submit']))
{
	$date = time();
	$organization = trim($_POST['organization']);
	$name = trim($_POST['name']);
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);
	$event_name = trim($_POST['event_name']);
	$event_date_start = $_POST['event_date_start'];
	$event_date_end = $_POST['event_date_end'];
	$event_location = trim($_POST['event_location']);
	$request_amount = intval($_POST['request_amount']);
	$request_pizzas = intval($_POST['request_pizzas']);
	$request_eegees = intval($_POST['request_eegees']);
	$request_beverages = intval($_POST['request_beverages']);

	$criteria = $_POST['criteria'];
	$outcome = trim($_POST['outcomes']);
	
	$description = trim($_POST['description']);
	
	$budget_expense = array_map('trim', budget_first($_POST['budget_expense']));
	$budget_item = array_map('trim', budget_first($_POST['budget_item']));
	$budget_cost = array_map('intval', budget_first($_POST['budget_cost']));
	$budget_funded = array_map('trim', budget_first($_POST['budget_funded']));
	$budget_donated = array_map('trim', budget_first($_POST['budget_donated']));
	$budget_requested = array_map('trim', budget_first($_POST['budget_requested']));
	
	$budget_income = intval($_POST['budget_income']);
	
	$upload = $_FILES['upload_file']['name'];
	
	if (empty($organization))
	{
		$errors[] = 'Enter a valid club/organization/association name';
	}
	
	if (empty($name))
	{
		$errors[] = 'Enter the name of the officer submitting the form';
	}
	
	if (empty($phone))
	{
		$errors[] = 'A valid phone number is required';
	}
	
	if (empty($email))
	{
		$errors[] = 'A valid email is required';
	}
	
	if (empty($event_name))
	{
		$errors[] = 'Please enter an event name';
	}
	
	if (empty($event_date_start))
	{
		$errors[] = 'Please enter an event date';
	}
	
	if (!empty($event_date_start) && !strtotime($event_date_start))
	{
		$errors[] = 'Please enter a start date in the format mm/dd/yyyy';
	}
	
	if (!empty($event_date_end) && !strtotime($event_date_end))
	{
		$errors[] = 'Please enter an end date in the format mm/dd/yyyy';
	}
	
	if (empty($event_location))
	{
		$errors[] = 'Please enter an event location';
	}
	
	if (count($criteria) < 4)
	{
		$errors[] = 'Please select at least 4 evaluation criteria';
	}
	
	if (@in_array(4, $criteria) && empty($outcome))
	{
		$errors[] = 'Please enter some learning outcomes';
	}
	
	if (empty($description))
	{
		$errors[] = 'Please enter a description of your program';
	}
	
	if (strlen($description) < $config['description_min'])
	{
		$errors[] = 'Your description is too short by ' . ($character_minimum - strlen($description)) . ' characters';
	}
	
	if (strlen($description) > $config['description_max'])
	{
		$errors[] = 'Your description is too long by ' . (strlen($description) - $character_limit) . ' characters';
	}
	
	if (empty($budget_item[0]))
	{
		$errors[] = 'Please enter your itemized total event budget';
	}
	
	$total_estimate = 0;
	$compare_amount = 0;
	for ($i = 0; $i < count($budget_item); $i++)
	{
		$total_estimate += $budget_cost[$i];
		$compare_amount += ($budget_requested[$i] == 'Yes') ? $budget_cost[$i] : 0;
		if (!empty($budget_item[$i]) && empty($budget_expense[$i]))
		{
			$errors[] = 'Please enter an expense category for item ' . $budget_item[$i];
		}
	}
	
	if (empty($budget_income))
	{
		$errors[] = 'Please enter a total projected income';
	}
	
	if ($budget_income + $request_amount != $total_estimate)
	{
		$errors[] = 'The total estimate does not match your projected income and request amount!';
	}
	
	if ($request_amount != $compare_amount)
	{
		$errors[] = 'Your request amount does not match your itemized CSIL requests!';
	}
	
	if (empty($upload))
	{
		$errors[] = 'Please select a sample brochure/flyer to upload';
	}
	
	if (!empty($upload) && empty($_FILES['upload_file']['error']))
	{
		$filetype = strtolower(substr(strrchr($upload, '.'), 1));
		$sample = time() . '.' . $filetype;

		$allowed_types = array_map('trim', explode(',', $config['allowed_types']));
		if (!in_array($filetype, $allowed_types))
		{
			$errors[] = 'The file type for your sample is not an allowed type';
		}
	}
	
	// Upload
	if (empty($errors) && !empty($upload) && empty($_FILES['upload_file']['error']))
	{
		if (!move_uploaded_file($_FILES['upload_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/uploads/corpspons/documents/' . $sample))
		{
			$errors[] = 'An error occurred while uploading, please try again';
		}
	}
	
	if (empty($errors))
	{
		$event_date_end = (!empty($event_date_end)) ? strtotime($event_date_end) : 0;
		
		// Add in requests
		$budget_expense = array_merge(array('Food', 'Food', 'Food'), $budget_expense);
		$budget_item = array_merge(array('Pizza', 'Eegees', 'Beverages'), $budget_item);
		$budget_cost = array_merge(array(0, 0, 0), $budget_cost);
		$budget_funded = array_merge(array('', '', ''), $budget_funded);
		$budget_donated = array_merge(array('CSIL (' . $request_pizzas . ')', 'CSIL (' . $request_eegees . ')', 'CSIL (' . $request_beverages . ')'), $budget_donated);
		$budget_requested = array_merge(array('Yes', 'Yes', 'Yes'), $budget_requested);
		
		$db->query = "INSERT INTO csil_club_funding (date, organization, name, phone, email, event_name, event_date_start, event_date_end, event_location, request_amount, request_pizzas, request_eegees, request_beverages, criteria, outcome, description, budget_expense, budget_item, budget_cost, budget_funded, budget_donated, budget_requested, budget_income, sample)
				VALUES ($date, '" . clean_string($organization) . "', '" . clean_string($name) . "', '" . clean_string($phone) . "', '" . clean_string($email) . "', '" . clean_string($event_name) . "', " . strtotime($event_date_start) . ", $event_date_end, '" . clean_string($event_location) . "', $request_amount, $request_pizzas, $request_eegees, $request_beverages, '" . clean_string(serialize($criteria)) . "', '" . clean_string(serialize(split('(,[[:space:]]?)', $outcome))) . "', '" . clean_string($description) . "', '" . clean_string(serialize($budget_expense)) . "', '" . clean_string(serialize($budget_item)) . "', '" . serialize($budget_cost) . "', '" . clean_string(serialize($budget_funded)) . "', '" . clean_string(serialize($budget_donated)) . "', '" . clean_string(serialize($budget_requested)) . "', $budget_income, '" . clean_string($sample) . "')";
		
		//mysql_query($sql) or die(mysql_error() . '<br />' . $sql);
		$db->query();
		
		// Prep notice email
		$vars = array(
			'NAME' => $name,
			'ORGANIZATION' => $organization
		);
		$message = parse_vars($vars, file_get_contents('emails/email_notice.txt'));
		@mail($config['email'], 'CSIL: Club Funding Request Form Submitted', $message, 'From: Student Union <noreply@union.arizona.edu>');
		
		echo '<h2>Your form has been submitted!</h2>If you have any questions, please contact Judy Harrison at 621-3546.';
	}
}

if (!isset($_POST['submit']) || !empty($errors))
{
?>
<script type="text/javascript" src="include.js"></script>
<script language="javascript">
window.onload = function() {
  textCounter(<?php echo $config['description_max']; ?>);
  addElement();
<?php if (isset($_POST['submit'])): ?>
  calcEstimate();
  //calcTotal();
  prepCompare('request');
  prepCompare();
<?php endif; ?>
};
</script>
<style type="text/css">
.error {color: #FF0000; font-weight: bold;}
.ok {color: #0C0; font-weight: bold;}
.bold {font-weight: bold;}
#budget span {display: block; float: left; font-weight: bold;}
#budget div {clear: both;}
#list_prep {display: none;}

select {height: 22px;}

#sample {margin: auto; width: 600px;}
#sample div {float: left; margin-right: 40px; margin-bottom: 10px;}

h2 {line-height:25px;}
p {margin: 10px 0 10px 0;}
th, td {padding: 5px;}
ul {list-style-position:inside; margin-bottom: 10px;}
</style>
<div style="margin-top: 15px; margin-right: 15px;">
<?php
	require_once('involv_left_col.inc');
?>
</div>
<div style="margin-left: 20%; width: 80%;">
<h2 align="center">The Center for Student Involvement &amp; Leadership Corporate Partners Grant</h2>
<h2 align="center">REQUEST FOR FUNDING APPLICATION</h2>
<p>The Arizona Student Unions&rsquo; Center for Student Involvement &amp; Leadership (CSIL) is pleased to offer University of Arizona <strong><em>recognized</em></strong> student organizations, clubs, and associations an opportunity to apply for funds and/or products (pizza/beverages) to support activities, which benefit the campus community.</p>
<p><strong>*Deadline</strong>: Proposals are due at the Student Union Office office, Student Union Room 403 (Judy Harrison)<strong>, a minimum of ONE MONTH PRIOR to the scheduled event.</strong> The committee meets every other Wednesday to review applications. Events can only be funded prior to the event. We encourage groups to apply as many times as they like, however, the Committee does not award funding beyond $1,000.00 per group, per academic year.</p>
<h2 align="center">PRE-APPLICATION CHECK LIST</h2>
<p>Before submitting your application, please be sure to have the following information completed:</p>
<ol>
<li>Must be a recognized club or organization approved by ASUA.</li>
<li>If you are having an outdoor event anywhere on campus, you MUST have a Campus Use Activity Request Form turned in to Mall Scheduling with the space desired already reserved.</li> 
<li>Must be submitted at least one month before the date of your event. NO EXCEPTIONS!</li>
<li>If there will be food at your event, you must indicate that on your Campus Use Activity Request Form & it must be approved by Dining Services.</li> 
<li>NO outside food or beverage is allowed on campus, including all buildings. The University has exclusive contracts with Coke, Papa John’s , Burger King, Panda Express, (among others), that does not allow other competitive products to be served on campus.</li>  
<li>Your event must be located  at a recognized campus location.</li>

</ol>
<p align="center"><strong>TYPE THE FOLLOWING IN DETAIL:</strong><br />
  <strong><em><u>All</u></em></strong><strong><em> 5 sections must be completed in order to be considered for funding. If you need assistance completing this application contact</em></strong><br />
<strong><em>Judy Harrison at 621-3546</em></strong></p>
<?php
if (!empty($errors))
{
	echo '<div class="error">' . implode($errors, "</div>\n<div class=\"error\">") . "</div>\n";
}
?>
<form enctype="multipart/form-data" name="post" method="post">
<h2>Section 1: General Information</h2>
<p>Student Club/Organization/Association (no abbreviations): <input type="text" name="organization" value="<?php echo stripslashes($organization); ?>"></p>
<p>Name of Officer submitting request: <input type="text" name="name" size="40" value="<?php echo stripslashes($name); ?>" /></p>
<p>Phone: <input type="text" name="phone" value="<?php echo stripslashes($phone); ?>" /></p>
<p>E-mail: <input type="text" name="email" value="<?php echo stripslashes($email); ?>" /></p>
<p>Event Name: <input type="text" name="event_name" value="<?php echo stripslashes($event_name); ?>" />
Event Location: <input type="text" name="event_location" value="<?php echo stripslashes($event_location); ?>" /></p>
<p>Start Date: <input type="text" name="event_date_start" size="15" value="<?php echo $event_date_start; ?>" />
End Date: <input type="text" name="event_date_end" size="15" value="<?php echo $event_date_end; ?>" /></p>

<hr />
<h2>Section 2: Evaluation Criteria</h2>
<p>The committee will evaluate proposals on presentation (completeness, and neatness); and will only consider funding proposals where funds can be allocated in <strong><u>advance</u> of the program</strong>. (*See deadlines below) The CSIL Corporate Partners Committee will review requests for funding which meet 4 of the 5 criteria listed below in order to receive partial or full awards as funds are available.</p>

<div style="padding: 10px;border: 1px solid black;">
<?php
for ($i = 0; $i < count($criterias); $i++)
{
	$checked = (@in_array($i, $criteria)) ? ' checked="checked"' : '';
	echo '<input type="checkbox" name="criteria[]" value="' . $i . '"' . $checked . ' /><strong>' . $criterias[$i]['name'] . '</strong>
	<p>' . str_replace('{OUTCOMES}', $outcome, $criterias[$i]['description']) . '</p>' . "\n";
}
?>
</div>

<hr />
<h2>Section 3: Program Description</h2>
<p>Briefly describe your program and how each of the above criteria is met. Please do not exceed <?php echo $character_limit; ?> characters. Remember your event must meet four of the five criteria above.</p>
<textarea rows="15" cols="90" name="description" onKeyDown="textCounter(<?php echo $config['description_max']; ?>)" onKeyUp="textCounter(<?php echo $config['description_max']; ?>)"><?php echo stripslashes($description); ?></textarea>
<br />You have <input readonly type="text" name="remLen" size="5" maxlength="5" value="<?php echo $config['description_max']; ?>"> characters left for your message.

<hr />
<h2>Section 4: Event Budget</h2>
<p>Request: 
  Financial 
  <input type="text" name="request_amount" value="<?php echo $request_amount; ?>" onkeyup="prepCompare('request')" size="7" />
# Pizzas: 
<input type="text" name="request_pizzas" value="<?php echo $request_pizzas; ?>" size="5" />
# Eegees Tubs: 
<input type="text" name="request_eegees" value="<?php echo $request_eegees; ?>" size="5" />
# Cases of Beverage: 
<input type="text" name="request_beverages" value="<?php echo $request_beverages; ?>" size="5" /> (24 cans per case)</p>
<p>Submit the <strong><u>total event budget</u></strong>, using the included template. Provide estimated expenses and all income (including: co-sponsors, matching funds, your organization&rsquo;s contributions, etc.)</p>
<p class="error">Do not enter requested pizzas, Eegees tubs or beverages in the itemized budget</p>
<ul>
  <li>Expense Catagory: AV/Media, Room Rentals, Food, Supplies, Marketing, Entertainment/Speaker, Miscellaneous</li>
  <li>Itemization: List of the items to be purchased</li>
  <li>Funded by: List the organization paying for this item</li>
  <li>Donated by: This item will have no cost and is being donated by what organization?</li>
  <li>Is this what you are requesting be funded by CSIL and Corporate Partners? Yes/No</li>
</ul>
<table width="100%" cellpadding="5" cellspacing="0" border="1" id="budget_list">
<tr>
  <th width="20%" style="background-color: #ccc; color: black;">Expense Catagory</th>
  <th width="20%" style="background-color: #ccc; color: black;">Itemization</th>
  <th width="15%" style="background-color: #ccc; color: black;">Estimate Cost</th>
  <th width="15%" style="background-color: #ccc; color: black;">Funded By</th>
  <th width="15%" style="background-color: #ccc; color: black;">Donated By</th>
  <th width="10%" style="background-color: #ccc; color: black;">CSIL Request?</th>
  <th width="10%" style="background-color: #ccc; color: black;">Delete</th>
</tr>
<tr id="list_prep">
  <td><input type="text" name="budget_expense[]" size="17" /></td>
  <td><input type="text" name="budget_item[]" size="17" /></td>
  <td>$ <input type="text" name="budget_cost[]" size="10" onkeyup="calcEstimate();prepCompare();" /></td>
  <td><input type="text" name="budget_funded[]" size="10" /></td>
  <td><input type="text" name="budget_donated[]" size="10" /></td>
  <td><select name="budget_requested[]" onchange="prepCompare()" /><option>Yes</option><option>No</option></select></td>
  <td><input type="button" value="-" onclick="removeElement(this)" /></td>
</tr>
<?php
for ($i = 0; $i < count($budget_item); $i++)
{
	$requested_yes = ($budget_requested[$i] == 'Yes') ? ' selected="selected"' : '';
	$requested_no = ($budget_requested[$i] == 'No') ? ' selected="selected"' : '';
	if (!empty($budget_item[$i]))
	{
		echo '<tr>
  <td><input type="text" name="budget_expense[]" size="17" value="' . stripslashes($budget_expense[$i]) . '" /></td>
  <td><input type="text" name="budget_item[]" size="17" value="' . stripslashes($budget_item[$i]) . '" /></td>
  <td>$ <input type="text" name="budget_cost[]" size="10" value="' . $budget_cost[$i] . '" onkeyup="calcEstimate();prepCompare();" /></td>
  <td><input type="text" name="budget_funded[]" size="10" value="' . stripslashes($budget_funded[$i]) . '" /></td>
  <td><input type="text" name="budget_donated[]" size="10" value="' . stripslashes($budget_donated[$i]) . '" /></td>
  <td><select name="budget_requested[]" onchange="prepCompare()" /><option' . $requested_yes . '>Yes</option><option' . $requested_no . '>No</option></select></td>
  <td><input type="button" value="-" onclick="removeElement(this)" /></td>
</tr>
';
	}
}
?>
<tr>
  <td colspan="2" align="right" style="background-color: #ccc; color: white;"><em>Total estimated expenses</em></td>
  <td colspan="5" style="background-color: #ccc; color: white;">$ <input type="text" name="total_estimate" size="10" disabled="disabled" /></td>
</tr>
<tr>
  <td colspan="2" align="right"><p><strong>Total projected income (ticket sales, raffels,
    <br />co-sponsors, club funds, etc)</strong></p></td>
  <td colspan="5">$ <input type="text" name="budget_income" size="10" value="<?php echo $budget_income; ?>" onkeyup="prepCompare()" /> + Request <span id="add_request" class="bold"></span> = Total <span id="total_estimate" class="bold"></span><div id="total"></div></td>
</tr>
<tr>
  <td colspan="2" align="right"><strong>Request Comparison</strong></td>
  <td colspan="5">Request <span id="compare_request" class="bold"></span> to Itemized CSIL Requests <span id="compare_itemized" class="bold"></span><div id="compare"></div></td>
</tr>
</table>
<!-- onkeup="calcTotal()" name="total_balance"-->

<a href="javascript:;" onclick="addElement()">Add Item</a>
<a href="javascript:;" onclick="sampleBudget()">Sample Budget</a>
<hr />
<h2>Section 5: Event Flyer/Brochure</h2>
<p>Submit a sample brochure/flyer, etc with the Corporate Partners logo on it along with the statement <em>&quot;this program was sponsored in part by the Corporate Partner's Grant, the Center for Student Involvement &amp; Leadership and the Arizona Student Unions&quot;</em></p>
<div id="sample">
  <div>
    <p><input type="file" name="upload_file" size="20" aceept="image/jpeg, application/pdf"></p>
    <br />Allowed file types: <?php echo $config['allowed_types']; ?>
  </div>
  <div>
    If you don't have the logo, download it here:
    <blockquote>
      <a href="../CorporateLogos/CP_Combo_logo_BW.eps">Corporate Partner Logo B&amp;W EPS</a> <br />
      <a href="../CorporateLogos/CP_Combo_logo_BW.gif">Corporate Partner Logo B&amp;W GIF</a> <br />
      <a href="../CorporateLogos/CP_Combo_logo_clr.eps">Corporate Partner Logo Color EPS</a> <br />
      <a href="../CorporateLogos/CP_Combo_logo_clr.gif">Corporate Partner Logo Color GIF</a> <br />
    </blockquote>
  </div>
</div>

<hr style="clear:both" /><p><input type="submit" name="submit" value="Submit Application" /></p>
</form>

<p>The organization&rsquo;s contact person will be notified of the Committee&rsquo;s decision within 1 week after the Committee meets, either by email,  mail or both.</p>
<p>For questions, please contact Judy Harrison at 621-3546.</p>
</div>

<?php
}
page_finish();
?>