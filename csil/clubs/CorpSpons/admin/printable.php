<?php
/*
 * Corporate Sponsors
 * Created September, 2009
 */

// Force WWW for webauth
if (!strstr($_SERVER['HTTP_HOST'], 'styx') && !strstr($_SERVER['HTTP_HOST'], 'sunion') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
{
	header('Location: http://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	exit;
}

define('ACCESS', true);
include('../include.php');

// Authenticate
start_webauth($admin);

$result = mysql_query("SELECT * FROM csil_club_funding WHERE id = $id");
$app_info = mysql_fetch_assoc($result);

if (!$app_info)
{
	die('<h3>Invalid ID!</h3>');
}

// Application
$date = $app_info['date'];
$organization = $app_info['organization'];
$name = $app_info['name'];
$phone = $app_info['phone'];
$email = $app_info['email'];
$event_name = $app_info['event_name'];
$event_date_start = date('F j, Y', $app_info['event_date_start']);
$event_date_end = date('F j, Y', $app_info['event_date_end']);
$event_location = $app_info['event_location'];
$request_amount = $app_info['request_amount'];
$request_pizzas = $app_info['request_pizzas'];
$request_beverages = $app_info['request_beverages'];
$request_eegees = $app_info['request_eegees'];

$criteria = unserialize($app_info['criteria']);
$outcome = @implode(', ', unserialize($app_info['outcome']));

$description = $app_info['description'];

$budget_expense = unserialize($app_info['budget_expense']);
$budget_item = unserialize($app_info['budget_item']);
$budget_cost = unserialize($app_info['budget_cost']);
$budget_funded = unserialize($app_info['budget_funded']);
$budget_donated =unserialize( $app_info['budget_donated']);
$budget_requested = unserialize($app_info['budget_requested']);
$budget_income = $app_info['budget_income'];

$sample = $app_info['sample'];

// Administrative
$request_approved = $app_info['request_approved'];
$request_pizzas_approved = $app_info['request_pizzas_approved'];
$request_beverages_approved = $app_info['request_beverages_approved'];
$request_eegees_approved = $app_info['request_eegees_approved'];
$budget_approved = unserialize($app_info['budget_approved']);
$approved = $app_info['approved'];
$comments = $app_info['comments'];

$updated = $app_info['updated'];
$updated_name = $app_info['updated_name'];
?>
<h2 align="center">CSIL Request for Funding Application</h2>
<h3 align="center"><?php echo status_color($approved); ?></h3>

<?php
// Last updated
echo ((!empty($updated)) ?  '<h5 align="center">Last Updated ' . date('F jS, Y', $updated) . ' by ' . $updated_name . '</h5>' : '');
?>
<h3>Section 1: General Information</h3>
Organization: <?php echo stripslashes($organization); ?>
<br />Name: <?php echo stripslashes($name); ?>
<br />Phone: <?php echo stripslashes($phone); ?>
<br />E-mail: <?php echo stripslashes($email); ?>
<br />Event Details: <?php echo stripslashes($event_name); ?>, <?php echo $event_date_start; ?> - <?php echo $vent_date_end ?>, <?php echo stripslashes($event_location); ?>
<br />Request: $<?php echo $request_amount; ?>, <?php echo $request_pizzas; ?> Pizzas, <?php echo $request_beverages; ?> Cases of Beverage, <?php echo $request_eegees; ?> Eegees

<hr />
<h3>Section 2: Evaluation Criteria</h3>

<div style="padding: 10px;border: 1px solid black;">
<?php
for ($i = 0; $i < count($criterias); $i++)
{
	if (@in_array($i, $criteria))
	{
		echo '<strong>' . $criterias[$i]['name'] . '</strong><br />';
		if (strstr($criterias[$i]['description'], '{OUTCOMES}'))
		{
			$outcome = split('(,|, )', $outcome);
			foreach ($outcomes as $key => $out)
			{
				if (in_array($key + 1, $outcome))
				{
					echo '- (' . ($key+1) . ') ' . $out['name'] . '<br />';
				}
			}
		}
	}
}
?>
</div>

<hr />
<h3>Section 3: Program Description</h3>
<?php echo nl2br($description); ?>

<hr />
<h3>Section 4: Event Budget</h3>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
  <th>Expense Catagory</th>
  <th width="15%">Itemization</th>
  <th width="15%">Estimate Cost</th>
  <th width="15%">Funded By</th>
  <th width="15%">Donated By</th>
  <th width="10%">CSIL Request?</th>
  <th width="15%">Item Approved For</th>
</tr>
<?php
$initial_total = 0;
for ($i = 0; $i < count($budget_item); $i++)
{
	if (!empty($budget_item[$i]))
	{
		$initial_total += $budget_cost[$i];
		echo '<tr>
  <td>' . (!empty($budget_expense[$i]) ? stripslashes($budget_expense[$i]) : '&nbsp;') . '</td>
  <td>' . (!empty($budget_item[$i]) ? stripslashes($budget_item[$i]) : '&nbsp;') . '</td>
  <td>$' . (!empty($budget_cost[$i]) ? $budget_cost[$i] : '&nbsp;') . '</td>
  <td>' . (!empty($budget_funded[$i]) ? stripslashes($budget_funded[$i]) : '&nbsp;') . '</td>
  <td>' . (!empty($budget_donated[$i]) ? stripslashes($budget_donated[$i]) : '&nbsp;') . '</td>
  <td>' . (!empty($budget_requested[$i]) ? $budget_requested[$i] : '&nbsp;') . '</td>
  <td>$' . (!empty($budget_approved[$i]) ? $budget_approved[$i] : '&nbsp;') . '</td>
</tr>
';
	}
}
?>
<tr>
  <td colspan="2" align="right" style="background-color: #ccc; color: white;"><em>Total estimated expenses</em></td>
  <td colspan="6" style="background-color: #ccc; color: white;">$<?php echo $initial_total; ?></td>
</tr>
<tr>
  <td colspan="2" align="right"><p><strong>Total projected income</strong></p></td>
  <td colspan="6">$<?php echo intval($budget_income); ?></td>
</tr>
<tr>
  <td colspan="2" align="right"><strong>Total Balance</strong></td>
  <td colspan="6">$<?php echo ($initial_total - $budget_income); ?></td>
</tr>
</table>

<hr />
<h3>Section 5: Event Flyer/Brochure</h3>
<?php
$file = '../documents/' . $sample;
list($width) = @getimagesize($file);
echo ((ext($sample) != 'pdf') ? '<p><img src="' . $file . '"' . ($width > 500 ? ' width="500"' : '') . ' /></p>' : '');
?>
<a href="<?php echo $file; ?>">Click to view <?php echo $sample; ?></a><br />
Allowed file types: <?php echo $config['allowed_types']; ?>

<hr />
<h3>Application Status</h3>
Status: <?php echo status_color($approved); ?>
<br />Amount Rewarded $<?php echo $request_approved; ?>
<br />Pizzas Rewarded <?php echo $request_pizzas_approved; ?>
<br />Beverages Rewarded <?php echo $request_beverages_approved; ?>
<br />Eegees Rewarded <?php echo $request_eegees_approved; ?>
<p />Comments
<br /><?php echo nl2br($comments); ?>