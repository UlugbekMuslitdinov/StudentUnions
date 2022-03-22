<?php
/*
 * Staff Directory
 * Created April, 2010
 * Last Modified: by Alex Babis on 3/23/12.
 *    Modified query to only check for names. Accepts
 *    one or two names and allows for last-name-first
 *    or first-name-first.
 */

define('ACCESS', true);
include('include.php');

$names = ['', ''];

if (isset($_POST['text']) && $_POST['text'] != '')
{
	$names = preg_split('/[ ]+/', $_POST['text']);
}
$lastname =  $names[0];
$firstname = ( count($names) > 2 ? $names[1] : '' );
$department_id = isset($_POST['department_id']) ? intval($_POST['department_id']) : 'all';

// Search
$search = array();
if(empty($names[1]))
{
	$search[] = "directoryFN LIKE '%" . $db->escape($names[0]) . "%'";
	$search[] = "directoryLN LIKE '%" . $db->escape($names[0]) . "%'";
	$filters[] = '(' . implode(' OR ', $search) . ')';
}
else if(!empty($names[0]))
{
	$search[] = "directoryFN LIKE '%" . $db->escape($names[0]) . "%' AND " . "directoryLN LIKE '%" . $db->escape($names[1]) . "%'";
	$search[] = "directoryFN LIKE '%" . $db->escape($names[1]) . "%' AND " . "directoryLN LIKE '%" . $db->escape($names[0]) . "%'";
	$filters[] = '(' . implode(' OR ', $search) . ')';
}

// Limit by department
if($department_id != 'all')
{
	$filters[] = '(departmentId = ' . $department_id . ')';
}

$filter = implode(' AND ', $filters);
$search = array_filter($search);

// var_dump($search);

// Sort
switch ($sort)
{
	case 'firstname': $order = 'directoryFN, directoryLN'; break;
	case 'department': $order = 'department, directoryLN'; break;
	case 'lastname':
	default: $order = 'directoryLN, directoryFN'; break;
}

// SQL
$sql = "SELECT directoryFN, directoryLN, departments.departmentName, jobTitle, email, phone FROM employee, departments";
$sql .=  ' WHERE ' . $filter . ' AND departmentId = departments.id';
if(!empty($order)) $sql .=  ' ORDER BY ' . $order;
$result = $db->query($sql);
$count = $result->num_rows;

// Display
if ($count < 1)
{
	echo '<div class="empty">No Results Found</div>';
}
else
{
	echo ($count > 1) ? '<div style="float: left; width: 380px;">' : '';
	
	for ($i = 0; $i < $row = $result->fetch_array(); $i++)
	{
		$names = array();
		if(!empty($row['directoryLN']))
		{
			$name_arr = array();
			if(!empty($lastname))
			{
				// First we mark matches with characters that are unused in names
				$tmp_name = preg_replace("/($lastname)/i", '&#00A4${1}&#00A7', $row['directoryLN']);
				if(!empty($firstname)) $tmp_name = preg_replace("/($firstname)/i", '&#00A4${1}&#00A7', $tmp_name);
				// Then we replace the marks with style information
				$tmp_name = implode('<span style="background-color:rgb(255, 220, 50)">', explode('&#00A4', $tmp_name));
				$tmp_name = implode('</span>', explode('&#00A7', $tmp_name));
				$names[] = $tmp_name;
			}
			else $names[] = $row['directoryLN'];
		}
		if(!empty($row['directoryFN']) && $row['directoryLN'] != $row['directoryFN'])
		{
			$name_arr = array();
			if(!empty($lastname))
			{
				$tmp_name = preg_replace("/($lastname)/i", '&#00A4${1}&#00A7', $row['directoryFN']);
				if(!empty($firstname)) $tmp_name = preg_replace("/($firstname)/i", '&#00A4${1}&#00A7', $tmp_name);
				$tmp_name = implode('<span style="background-color:rgb(255, 220, 50)">', explode('&#00A4', $tmp_name));
				$tmp_name = implode('</span>', explode('&#00A7', $tmp_name));
				$names[] = $tmp_name;
			}
			else $names[] = $row['directoryFN'];
		}
		$name = implode(', ', array_filter($names));
		
		$contacts = array();
		$contacts[] = (!empty($row['email'])) ? "<a href=\"mailto:{$row['email']}\">{$row['email']}</a>" : '';
		$contacts[] = (!empty($row['phone'])) ? $row['phone'] : '';
		$contact = implode(' // ', array_filter($contacts));
		
		//var_dump(intval($count / 2), $i);
		$divide = ($count > 1 && intval($count / 2) == $i) ? '</div><div style="float: right; width: 380px; padding-left: 15px; ">' : '';

		echo <<<TXT
		$divide
		<div class="person">
			<div class="name">$name</div>
			<div class="contact">$contact</div>
			<div class="department">{$row['departmentName']}</div>
			<div class="title">{$row['jobTitle']}</div>
		</div>
TXT;
	}
	
	echo ($count > 1) ? '</div>' : '';
}
?>
<br clear="all" />