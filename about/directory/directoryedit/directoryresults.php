<?php
  session_start();
  require_once ('includes/mysqli.inc');
  require_once('../../template/about.inc');
  $page_options['title'] = 'Staff Directory';
  $page_options['page'] = 'about'; 
  about_start($page_options);
  
  
  if ($_SESSION['directory_access'] != 1) {
    echo 'not allowed';
    about_finish();
    exit();
  }
	
	if(isset($_POST['newSearch'])) {
	unset($_SESSION['directoryFN'], $directoryFN);
	unset($_SESSION['directoryLN'], $directoryLN);
	}
	
	
	if ($_POST['directoryLN'] != "") {
	$_SESSION['directoryLN'] = $_POST['directoryLN'];
	}
	
	if ($_POST['directoryFN'] != "") {
	$_SESSION['directoryFN'] = $_POST['directoryFN'];
	}
	
	if (isset($_POST['directoryDept'])) {
	$_SESSION['directoryDept'] = $_POST['directoryDept'];
	}
	

?>
<h2>Arizona Student Unions Staff Directory</h2>
<?



		/*print $_SESSION['directoryFN'];
		print "<br>";
		print $_SESSION['directoryLN'];
		print "<br>";
		print $_SESSION['directoryDept'];*/
		
	//db_connect();
    //db_select('unionstaffdirectory');
    $db = new db_mysqli('unionstaffdirectory');
/* THIS PART IS APPLICABLE IF A USER IS BEING DELETED */


for ($j = 0; $j <= $_POST['maxNum']; $j++) {
	if (isset($_POST['delete' . $j])) {

		//print $_POST['delete' . $j];
		
		$query = "SELECT * from employee where id =" . $_POST['delete' . $j];
		$result = $db->query($query);
		$row = $result->fetch_array();
		print $row['directoryFN'] . "&nbsp;" . $row['directoryLN'] . " deleted";
		
		print "<br /><br />";
		
		$query = "DELETE from employee where id =" . $_POST['delete' . $j];
		$db->query($query);
		//print $db->query;
		
		}
	}

		
/* THIS PART IS APPLICABLE WHEN A USER IS BEING ADDED */

if (isset($_POST['addUser'])) {
		$query = "INSERT INTO employee SET 
		directoryFN = \"" . $_POST['directoryFN'] . "\"
		, directoryLN = \"" . $_POST['directoryLN'] . "\"
		, department = \"" . $_POST['directoryDept'] . "\"
		, jobTitle = \"" . $_POST['jobTitle'] . "\"
		, email = \"" . $_POST['email'] . "\"
		, phone = \"" . $_POST['phone'] . "\";";
		
		$db->query($query);
		//print $queryAdd;
		
		print "<br>";
		
		print "<p>" . $_POST['directoryFN'] . "&nbsp;" . $_POST['directoryLN'] . " added into " . $_POST['directoryDept'] . "</p>";
	}

if (isset($_POST['editUser'])) {
		$query = "UPDATE employee SET 
		directoryFN = \"" . $_POST['directoryFN'] . "\"
		, directoryLN = \"" . $_POST['directoryLN'] . "\"
		, departmentid = \"" . $_POST['directoryDept'] . "\"
		, jobTitle = \"" . $_POST['jobTitle'] . "\"
		, email = \"" . $_POST['email'] . "\"
		, phone = \"" . $_POST['phone'] . "\"
		where id = " . $_POST['id'] . ";";
		
		//print $queryEdit;
		
		$db->query($query);
		//print $queryAdd;
		
		print "<br>";
		
		print "<p>" . $_POST['directoryFN'] . "&nbsp;" . $_POST['directoryLN'] . " added into " . $_POST['directoryDept'] . "</p>";
	}


/* THIS PART IS APPLICABLE TO LOOK UP A USER */
	
if ($_GET['showAll'] == "true") {
	
			$query = "SELECT employee.*, departments.departmentName from employee join departments on employee.departmentid=departments.id ORDER BY departmentname, directoryLN;";
			$result = $db->query($query);
			$num = $result->num_rows;
			$res = true;
		
	} else {

	
	
	if ($_POST['directoryLN'] != "") {
		$lastName = true;
		}
	if ($_POST['directoryFN'] != "") {
		$firstName = true;
		}
	if ($_POST['directoryDept'] != "") {
		$directoryDept = true;
		} 
	
	print "<br>";
	
		if ($lastName && !$firstName && !$directoryDept) {
				$query = "SELECT * from employee where directoryLN LIKE \"%" . $_POST['directoryLN'] . "%\" order by directoryLN;";
				$result = $db->query($query);
				$num = $result->num_rows;
					if ($num > 0) {
					$res = true;
					}
		
				
		}elseif (!$lastName && $firstName && !$directoryDept) {
				$query = "SELECT * from employee where directoryFN LIKE \"%" . $_POST['directoryFN'] . "%\" order by directoryFN;";
				$result = $db->query($query);
				$num = $result->num_rows;
					if ($num > 0) {
					$res = true;
					}
				
		}elseif (!$lastName && !$firstName && $directoryDept) {
				$query = "SELECT * from employee where departmentid = \"" . $_POST['directoryDept'] . "\" order by directoryLN;";
				$result = $db->query($query);
				$num = $result->num_rows;
					if ($num > 0) {
					$res = true;
					}
				
		}elseif ($lastName && $firstName && !$directoryDept) {
				$query = "SELECT * from employee where directoryLN LIKE \"%" . $_POST['directoryLN'] . "%\" AND directoryFN LIKE \"%" . $_POST['directoryFN'] . "%\" order by directoryLN;";
				$result = $db->query($query);
				$num = $result->num_rows;
					if ($num > 0) {
					$res = true;
					}
				
		}elseif ($lastName && !$firstName && $directoryDept) {
				$query = "SELECT * from employee where departmentid = \"" . $_POST['directoryDept'] . "\" AND directoryLN LIKE \"%" . $_POST['directoryLN'] . "%\" order by directoryLN;";
				$result = $db->query($query);
				$num = $result->num_rows;
					if ($num > 0) {
					$res = true;
					}
				
				
		}elseif (!$lastName && $firstName && $directoryDept) {
				$query = "SELECT * from employee where departmentid = \"" . $_POST['directoryDept'] . "\" and directoryFN LIKE \"%" . $_POST['directoryFN'] . "%\" order by directoryLN;";
				$result = $db->query($query);
				$num = $result->num_rows;
					if ($num > 0) {
					$res = true;
					}
				
		}elseif ($lastName && $firstName && $directoryDept) {
				$query = "SELECT * from employee where departmentid = \"" . $_POST['directoryDept'] . "\" AND directoryLN LIKE \"%" . $_POST['directoryLN'] . "%\" AND directoryFN LIKE \"%" . $_POST['directoryFN'] . "%\" order by directoryLN;";
				$result = $db->query($query);
				$num = $result->num_rows;
					if ($num > 0) {
					$res = true;
					}
		}
else {
		$query = "SELECT employee.*, departments.departmentName from employee join departments on employee.departmentid=departments.id ORDER BY departmentname, directoryLN;";
			$result = $db->query($query);
			$num = $result->num_rows;
			$res = true;
}
		
	
	
	
	
				
				print "<p><b>This Search Was Based On:<b><br />";
				print "Last Name: "; 
				if(isset($_POST['directoryLN']) && $_POST['directoryLN'] != "") {
					print $_POST['directoryLN'];
					}else{
					print "None Set";
					}
				print "<br>";
				
				print "First Name: "; 
				if(isset($_POST['directoryFN']) && $_POST['directoryFN'] != "") {
					print $_POST['directoryFN'];
					}else{
					print "None Set";
					}
				print "<br>";
				
				print "Department: "; 
				if ($_POST['directoryDept'] != "none") {
					print $_POST['directoryDept'];
					}else{
					print "None Set";
					}

	}
				print "<br>";
				print "<br>";
				print "<br>";
		
			if ($res != true) {
            
            print "<font style=\"font-size:16px; color:red\">No Results Found</font>";
			
			} else {
			
		
			print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
			print "<tr>";
						print "<td bgcolor=\"#C9E2FF\" >";
						print "First Name";
						print "</td>";
						
						print "<td bgcolor=\"#C9E2FF\" >";
						print "Last Name";
						print "</td>";
						
						print "<td bgcolor=\"#C9E2FF\">";
						print "Department";
						print "</td>";
						
						print "<td bgcolor=\"#C9E2FF\">";
						print "Job Title";
						print "</td>";
						
						print "<td bgcolor=\"#C9E2FF\">";
						print "Email";
						print "</td>";
						
						print "<td bgcolor=\"#C9E2FF\" width=\"90px\">";
						print "Phone";
						print "</td>";
						
						print "<td bgcolor=\"#C9E2FF\">";
						print "Edit";
						print "</td>";
						
						print "<td bgcolor=\"#C9E2FF\">";
						print "Delete?";
						print "</td>";
					print "</tr>";
				for ($i = 1; $i <= $num; $i++) {
					$row = $result->fetch_array();
					print "<tr>";
						print "<td bgcolor=\"#ffffff\" >";
						print $row['directoryFN'];
						print "</td>";
						print "<td bgcolor=\"#ffffff\" >";
						print $row['directoryLN'];
						print "</td>";
						print "<td bgcolor=\"#ffffff\">";
						print $row['departmentName'];
						print "</td>";
						print "<td bgcolor=\"#ffffff\">";
						print $row['jobTitle'];
						print "</td>";
						print "<td bgcolor=\"#ffffff\">";
						print "<a href=\"mailto:" . $row['email'] . "\">" . $row['email'] . "</a>";
						print "</td>";
						print "<td bgcolor=\"#ffffff\">";
						print $row['phone'];
						print "</td>";
						
						//EDIT EXPERIMENT
						print "<td bgcolor=\"#ffffff\">";
						//print "<input type=\"hidden\" name=\"edit" . $i . "\" value=" . $row['id'] . ">";
						print "<input type=\"button\" name=\"edit\" onClick=\"location.href='directoryinput.php?edit=" . $row['id'] . "'\" value=\"Edit\">"; 
						print "</td>";
						//OVER
						
						print "<td bgcolor=\"#ffffff\">";
						print "<form action=\"directoryresults.php\" name=\"deleteUsers\" method=\"post\">";
						print "<input type=\"checkbox\" name=\"delete" . $i . "\" value=" . $row['id'] . ">";
						print "</td>";
					print "</tr>";
					}
			print "</table>";
			print "<input type=\"hidden\" name=\"maxNum\" value=" . $num. ">";
			print "<input type=\"submit\" value=\"Delete Selected\">";
		}
			
	print "<br><br>";
	
	if (isset($_POST['addUser'])) {
		print "<a href=\"directoryInput.php\">Add another employee</a><br />";
		print "<a href=\"index.php\">Return to Search</a>";
		}else {
		print "<a href=\"directoryInput.php\">Add an employee</a><br />";
		print "<a href=\"index.php\">Return to Search</a>";
		}
			
					


about_finish() ?>


