<?php
/*
 * Staff Directory
 * Created April, 2010
 */
ini_set('display_errors', 1);

// Force WWW for webauth
// if (!strstr($_SERVER['HTTP_HOST'], 'kbeyer') && !strstr($_SERVER['HTTP_HOST'], 'sunion') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
// {
// 	// header('Location: http://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
// 	header('Location: ' . $_SERVER['PHP_SELF']);
// 	exit;
// }

define('ACCESS', true);
include('../include.php');

// Authenticate
start_webauth($admin);
ob_start();

require_once('../../template/about.inc');
$page_options['title'] = 'Staff Directory';
$page_options['styles'] = '
#center-col {float: left;width: 780px;}
.empty {font-size:16px; color:red;}
.person {margin-bottom: 15px; font: 1.1em/1.63em Verdana,"Lucida Grande",Lucida,sans-serif; line-height: 18px;}
.name {font-size: 16px; color: #003366;}
.contact a {color: #003366 !important;}
.contact a:hover {color: #CC0033 !important;}
.title {font-style: italic;}
.error {color: red; text-align: center;}
th {background-color: #ccc; color: black;}.wrap-left-col {display:none;}
table.table a {color: #BB1F42 !important;}';
$page_options['page'] = 'about';
about_start($page_options);

echo '<div align="right"><a href="?p">Main</a> | <a href="?p=add">Add Staff</a></div>';

$departments = array();
$departments['all'] = 'All';
$dept_query = $db->query('SELECT id, departmentName FROM departments ORDER BY departmentName ASC');
while($row = mysqli_fetch_assoc($dept_query))
	$departments[$row['id']] = $row['departmentName'];

switch ($page)
{
	case 'add':
		// Cancel
		if (isset($_POST['cancel']))
		{
			redirect($file);
		}

		echo '<h2 align="center">Add Staff Information</h2>';

		// Add record
		if (isset($_POST['add']))
		{
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$department = $_POST['department'];
			$jobtitle = $_POST['jobtitle'];

			if (empty($firstname) && empty($lastname))
			{
				$errors[] = 'Please enter a first or last name';
			}

			if ($department == 'all')
			{
				$errors[] = 'Please select a department other than all';
			}

			if (empty($errors))
			{
				$query = sprintf("INSERT INTO employee (directoryFN, directoryLN, phone, email, departmentId, jobTitle) VALUES ('%s', '%s', '%s', '%s', %d, '%s')",
							   clean_string($firstname), clean_string($lastname), clean_string($phone), clean_string($email), intval($department), clean_string($jobtitle), $id);

				$db->query($query);
				echo '<h3 align="center">Staff Successfully Added!</h3>
				<h3 align="center">Click <a href="' . $file . '">here</a> to return to Staff Listing</h3>';
			}
		}

		// Form
		if (!isset($_POST['add']) || !empty($errors))
		{
			if (isset($errors)){
				print_errors($errors);
			}
			echo '<div align="center"><form method="post">
			<table cellpadding="3" cellspacing="0" border="0">
			<tr>
				<td>First Name:</td><td><input type="text" name="firstname" size="50" value="' . $firstname . '"></td>
			</tr>
			<tr>
				<td>Last Name:</td><td><input type="text" name="lastname" size="50" value="' . $lastname . '"></td>
			</tr>
			<tr>
				<td>Phone:</td><td><input type="text" name="phone" size="50" value="' . ( isset($phone) ? $phone : "" ) . '"></td>
			</tr>
			<tr>
				<td>Email:</td><td><input type="text" name="email" size="50" value="' . ( isset($email) ? $email : "" ) . '"></td>
			</tr>
			<tr>
				<td>Department:</td><td><select name="department">';
				foreach ($departments as $key => $value)
				{
					$selected = ($key == $department) ? ' selected="selected"' : '';
					echo "<option value=\"$key\"$selected>$value</option>";
				}
				echo '</select></td>
			</tr>
			<tr>
				<td>Job Title:</td><td><input type="text" size="50" name="jobtitle" value="' . $jobtitle . '"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="add" value="Submit">&nbsp;&nbsp;<input type="submit" name="cancel" value="Cancel"></td>
			</table>
			</form></div>';
		}
	break;

	case 'edit':
		// Empty ID
		if (empty($id))
		{
			redirect($file);
		}

		// Cancel
		if (isset($_POST['cancel']))
		{
			redirect($file . '#' . $id);
		}

		// Staff info
		//$db->query =  ;
		//$result = db_query();
		$staff_info = mysqli_fetch_assoc($db->query("SELECT * FROM unionstaffdirectory.employee E LEFT JOIN unionstaffdirectory.departments D ON E.departmentId = D.id WHERE E.id = $id"));

		if (!$staff_info)
		{
			redirect($file);
		}

		// Fields
		$firstname = $staff_info['directoryFN'];
		$lastname = $staff_info['directoryLN'];
		$phone = $staff_info['phone'];
		$email = $staff_info['email'];
		$departmentId = $staff_info['departmentId'];
		$departmentName = $staff_info['departmentName'];
		// $department = ( isset($staff_info['department']) ? $staff_info['department'] : '' );
		$jobtitle = $staff_info['jobTitle'];

		echo '<h2 align="center">Update Staff Information</h2>';

		// Edit record
		if (isset($_POST['edit']))
		{
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$department = $_POST['department'];
			$jobtitle = $_POST['jobtitle'];

			if (empty($firstname) && empty($lastname))
			{
				$errors[] = 'Please enter a first or last name';
			}

			if ($department == 'all')
			{
				$errors[] = 'Please select a department other than all';
			}

			if (empty($errors))
			{
				$query = sprintf("UPDATE employee SET directoryFN = '%s', directoryLN = '%s', phone = '%s', email = '%s', departmentId = '%d', jobTitle = '%s' WHERE id = %d",
							   clean_string($firstname), clean_string($lastname), clean_string($phone), clean_string($email), intval($department), clean_string($jobtitle), $id);

				$db->query($query);

				echo '<h3 align="center">Staff Successfully Updated!</h3>
				<h3 align="center">Click <a href="' . $file . '#' . $id . '">here</a> to return to Staff Listing</h3>';
			}
		}

		// Form
		if (!isset($_POST['edit']) || !empty($errors))
		{
			if (isset($errors)){
				print_errors($errors);
			}
			echo '<div align="center"><form method="post">
			<table cellpadding="3" cellspacing="0" border="0">
			<tr>
				<td>First Name:</td><td><input type="text" name="firstname" size="50" value="' . $firstname . '"></td>
			</tr>
			<tr>
				<td>Last Name:</td><td><input type="text" name="lastname" size="50" value="' . $lastname . '"></td>
			</tr>
			<tr>
				<td>Phone:</td><td><input type="text" name="phone" size="50" value="' . $phone . '"></td>
			</tr>
			<tr>
				<td>Email:</td><td><input type="text" name="email" size="50" value="' . $email . '"></td>
			</tr>
			<tr>
				<td>Department:</td><td>
				<select name="department">
				<option value="' . $departmentId . '" selected> ' . $departmentName . '</option>';
				foreach ($departments as $key => $value)
				{
					$selected = ($key == $department) ? ' selected="selected"' : '';
					echo "<option value=\"$key\"$selected>$value</option>";
				}
				echo '</select></td>
			</tr>
			<tr>
				<td>Job Title:</td><td><input type="text" name="jobtitle" size="50" value="' . $jobtitle . '"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="edit" value="Submit">&nbsp;&nbsp;<input type="submit" name="cancel" value="Cancel"></td>
			</table>
			</form></div>';
		}
	break;

	case 'delete':
		// Empty ID
		if (empty($id))
		{
			redirect($file);
		}

		// Cancel
		if (isset($_POST['cancel']))
		{
			redirect($file . '#' . $id);
		}

		// Staff info
		$staff_info = mysqli_fetch_assoc($db->query("SELECT * FROM employee WHERE id = $id"));

		if (!$staff_info)
		{
			redirect($_SERVER['PHP_SELF']);
		}

		echo '<h2 align="center">Delete Staff Information</h2>';

		// Delete confirmation
		if (isset($_POST['delete']))
		{
			$query = "DELETE FROM employee WHERE id = $id";
			$db->query($query);

			echo '<h3 align="center">Staff Successfully Deleted!</h3>
			<h3 align="center">Click <a href="' . $file . '">here</a> to return to Staff Listing</h3>';
		}
		else
		{
			$name = format_name($staff_info['directoryFN'], $staff_info['directoryLN']);
			echo '<div align="center"><p>Are you sure you want to delete ' . $name . ' ?</p>
			<form method="post"><input type="submit" name="delete" value="Delete">
			&nbsp;&nbsp;<input type="submit" name="cancel" value="Cancel"></form></div>';
		}

	break;

	default:

		// Sort
		switch ($sort)
		{
			case 'firstname': $order = 'directoryFN, directoryLN'; break;
			case 'department': $order = 'department, directoryLN'; break;
			case 'lastname':
			default: $order = 'directoryLN, directoryFN'; break;
		}

		// SQL
		$query = "SELECT employee.id, directoryFN, directoryLN, departments.departmentName, jobTitle, email, phone FROM employee, departments WHERE departmentId = departments.id";
		$query .= (!empty($order)) ? ' ORDER BY ' . $order : '';
		$result = $db->query($query);
		$count = mysqli_num_rows($result);

		// Display
		echo '<h1>Staff Listing</h1>';

		if ($count < 1)
		{
			echo '<div class="empty">No Results Found</div>';
		}
		else
		{
			echo '<table class="table table-bordered">
			<tr><th>Name</th><th>Phone</th><th>Email</th><th>Department</th><th>Job Title</th><th>Action</th></tr>';
			for ($i = 0; $i < $row = mysqli_fetch_assoc($result); $i++)
			{
				$name = '<a href="?p=edit&id=' . $row['id'] . '" id="' . $row['id'] . '">' . format_name($row['directoryFN'], $row['directoryLN']) . '</a>';

				$edit = '<a href="?p=edit&id=' . $row['id'] . '">Edit</a>';
				$delete = '<a href="?p=delete&id=' . $row['id'] . '">Delete</a>';

				$class = ($i % 2 == 0) ? 'row' : '';

				echo <<<TXT
				<tr class="">
					<td>$name</td>
					<td>{$row['phone']}</td>
					<td>{$row['email']}</td>
					<td>{$row['departmentName']}</td>
					<td>{$row['jobTitle']}</td>
					<td align="center">$edit<br />$delete</td>
				</tr>
TXT;
			}
			echo '</table>';
		}
	break;
}

about_finish();
ob_end_flush();
?>
