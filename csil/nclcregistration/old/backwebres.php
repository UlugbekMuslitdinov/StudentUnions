<?
	
	if ($_POST['lastName'] != "") {
		$_SESSION['lastName'] = $_POST['lastName'];
		}
	
	if ($_POST['firstName'] != "") {
		$_SESSION['firstName'] = $_POST['firstName'];
		}
		
	if ($_POST['total'] != "") {
		$_SESSION['total'] = $_POST['total'];
		}
	
	if ($_GET['firstName'] != "") {
		$_SESSION['firstName'] = $_GET['firstName'];
		}
	
	if ($_GET['lastName'] != "") {
		$_SESSION['lastName'] = $_GET['lastName'];
		}
	
	if ($_POST['email'] != "") {
		$_SESSION['email'] = $_POST['email'];
		}
	 

	if (isset($_GET['validate'])) {
			
			$regID = $_GET['validate'];
				
				
				$queryVal = "select * from attendee where regID=\"" . $regID . "\";";
				$resultVal = mysql_query($queryVal, $DBlink);
				$rowVal = mysql_fetch_array($resultVal, MYSQL_ASSOC);
				
				print $rowVal['firstName'];
				print "&nbsp;";
				print $rowVal['lastName'];
				print "'s group payment has been validated!";
				
				print "<br><br>";
				
				$queryVal = "update attendee set payconf=\"yes\" where regID=\"" . $regID . "\";";
				mysql_query($queryVal, $DBlink);
				
				$_GET['group'] = $regID;
				
			}
	
		
	if (isset($_GET['delete'])) {
			
			$ID = $_GET['delete'];
				
				
				
				$queryDel = "select * from attendee where id=\"" . $ID . "\";";
				$resultDel = mysql_query($queryDel, $DBlink);
				$rowDel = mysql_fetch_array($resultDel, MYSQL_ASSOC);
				
				print $rowDel['firstName'];
				print "&nbsp;";
				print $rowDel['lastName'];
				print " deleted";
				
				print "<br><br>";
				
				$queryDel = "delete from attendee where id=\"" . $ID . "\";";
				//mysql_query($queryDel, $DBlink);
				mysql_query($queryDel, $DBlink);
				
			}
		
		
	if ($_SESSION['search'] == "names" || $_SESSION['search'] == "total" || (isset($_GET['lastName']))) {

			if ($_SESSION['search'] == "total") {
				$query = "SELECT * from attendee;";
				$result = mysql_query($query, $DBlink);
				$num = mysql_num_rows($result);
					if ($num > 0) {
					$res = true;
					}
			
			}elseif (($_SESSION['lastName'] != "") && ($_SESSION['firstName'] != "")) {
				$query = "SELECT * from attendee where lastName LIKE \"%" . $_SESSION['lastName'] . "%\" AND firstName LIKE \"%" . $_SESSION['firstName'] . "%\" order by lastName;";
				$result = mysql_query($query, $DBlink);
				$num = mysql_num_rows($result);
					if ($num > 0) {
					$res = true;
					}
		
				
		}elseif (($_SESSION['lastName'] != "") && ($_SESSION['firstName'] == "")) {
				$query = "SELECT * from attendee where lastName LIKE \"%" . $_SESSION['lastName'] . "%\" order by lastName;";
				$result = mysql_query($query, $DBlink);
				$num = mysql_num_rows($result);
					if ($num > 0) {
					$res = true;
					}
					
		}elseif (($_SESSION['lastName'] == "") && ($_SESSION['firstName'] != "")) {
				$query = "SELECT * from attendee where firstName LIKE \"%" . $_SESSION['firstName'] . "%\" order by firstName;";
				$result = mysql_query($query, $DBlink);
				$num = mysql_num_rows($result);
					if ($num > 0) {
					$res = true;
					}
			}
		}
			
		
		if($_SESSION['search'] == "email") {
				
				$query = "SELECT * from attendee where email LIKE \"%" . $_SESSION['email'] . "%\"  order by lastName;";
				$result = mysql_query($query, $DBlink);
				$num = mysql_num_rows($result);
					if ($num > 0) {
					$res = true;
					}
		
		}
		

		if ($res == true) {
		
				if (!isset($_GET['group'])) {
				
								
				print "<a href=\"backweb.php\">Start New Search</a>";
			
				print "<br>";
				print "<br>";
			
				print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
				print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "First Name";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Last Name";
							print "</td>";
							
							/* print "<td bgcolor=\"#C9E2FF\">";
							print "regID";
							print "</td>"; */
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Payment Type";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Payment Conf";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Email";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Validate Payment";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Expanded View";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "View Group";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Delete User";
							print "</td>";
							
						print "</tr>";
					for ($i = 1; $i <= $num; $i++) {
						$row = mysql_fetch_array($result, MYSQL_ASSOC);
						print "<tr>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['firstName'];
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['lastName'];
							print "</td>";
							/*print "<td bgcolor=\"#ffffff\">";
							print $row['regID'];
							print "</td>";*/
							print "<td bgcolor=\"#ffffff\">";
							print $row['paytype'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $row['payconf'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print "<a href=\"mailto:" . $row['email'] . "\">" . $row['email'] . "</a>";
							print "</td>";

							print "<td bgcolor=\"#ffffff\">";
							
							if ((isset($row['email'])) && ($row['payconf'] == "No")) {
							
							print "<input type=\"button\" name=\"expand\" onClick=\"location.href='backwebroute.php?validate=" . $row['regID'] . "'\" value=\"Validate\">"; 
							}
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print "<input type=\"button\" name=\"expand\" onClick=\"location.href='backwebroute.php?expand=" . $row['id'] . "&firstName=" . $row['firstName'] . "&lastName=" . $row['lastName'] . "'\" value=\"Expand View\">"; 
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print "<input type=\"button\" name=\"group\" onClick=\"location.href='backwebroute.php?group=" . $row['regID'] . "'\" value=\"View Group\">"; 
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							
							$queryDel = "SELECT * from attendee where regID=\"" . $row['regID'] . "\";";
							$resultDel = mysql_query($queryDel, $DBlink);
							$numRegId = mysql_num_rows($resultDel);
							
							if ((!isset($row['email'])) || ($numRegId == 1)) {
							
							print "<input type=\"button\" name=\"expand\" onClick=\"location.href='backwebroute.php?delete=" . $row['id'] . "'\" value=\"Delete\">"; 
							}
							print "</td>";
							
							
							
							/*print "<td bgcolor=\"#ffffff\">";
							print "<form action=\"backwebres.php\" name=\"deleteUsers\" method=\"post\">";
							print "<input type=\"checkbox\" name=\"delete" . $i . "\" value=" . $row['id'] . ">";
							print "</td>";*/
						print "</tr>";
						}
				print "</table>";
				

			}	
		}
			
			
			if (isset($_GET['group'])) {
			
				$regID = $_GET['group'];

				
				$query = "SELECT * from attendee where regID=\"" . $regID . "\" order by id;";
				$result = mysql_query($query, $DBlink);
				$num = mysql_num_rows($result);
				
				print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
				print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "First Name";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Last Name";
							print "</td>";
							
							/* print "<td bgcolor=\"#C9E2FF\">";
							print "regID";
							print "</td>"; */
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Payment Type";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Payment Conf";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Email";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Validate Payment";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Expanded View";
							print "</td>";
							
							print "<td bgcolor=\"#C9E2FF\">";
							print "Delete?";
							print "</td>";
						print "</tr>";
					for ($i = 1; $i <= $num; $i++) {
						$row = mysql_fetch_array($result, MYSQL_ASSOC);
						print "<tr>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['firstName'];
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['lastName'];
							print "</td>";
							/*print "<td bgcolor=\"#ffffff\">";
							print $row['regID'];
							print "</td>";*/
							print "<td bgcolor=\"#ffffff\">";
							print $row['paytype'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print $row['payconf'];
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							print "<a href=\"mailto:" . $row['email'] . "\">" . $row['email'] . "</a>";
							print "</td>";
							
							print "<td bgcolor=\"#ffffff\">";
							
							if ((isset($row['email'])) && ($row['payconf'] == "No")) {
							
							print "<input type=\"button\" name=\"validate\" onClick=\"location.href='backwebroute.php?validate=" . $row['regID'] . "'\" value=\"Validate\">"; 
							}
							print "</td>";

							print "<td bgcolor=\"#ffffff\">";
							print "<input type=\"button\" name=\"expand\" onClick=\"location.href='backwebroute.php?expand=" . $row['id'] . "&firstName=" . $row['firstName'] . "&lastName=" . $row['lastName'] . "'\" value=\"Expanded View\">"; 
							print "</td>";
							
							
							print "<td bgcolor=\"#ffffff\">";
							
							$queryDel = "SELECT * from attendee where regID=\"" . $row['regID'] . "\";";
							$resultDel = mysql_query($queryDel, $DBlink);
							$numRegId = mysql_num_rows($resultDel);
							
							if ((!isset($row['email'])) || ($numRegId == 1)) {
							
							print "<input type=\"button\" name=\"expand\" onClick=\"location.href='backwebroute.php?delete=" . $row['id'] . "'\" value=\"Delete\">"; 
							}
							print "</td>";
							
							/*print "<td bgcolor=\"#ffffff\">";
							print "<form action=\"backwebres.php\" name=\"deleteUsers\" method=\"post\">";
							print "<input type=\"checkbox\" name=\"delete" . $i . "\" value=" . $row['id'] . ">";
							print "</td>";*/
						print "</tr>";
						}
				print "</table>";
				
								print "<br>";
				
				print "<a href=\"backweb.php\">Start New Search</a>";
			
				}
			
			if (isset($_GET['expand'])) {
			
				$id = $_GET['expand'];
				
				print "<br><br>";
				
				$query = "SELECT * from attendee where id=\"" . $id . "\" order by id;";
				$result = mysql_query($query, $DBlink);
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				//$num = mysql_num_rows($result);
				
				print "<table  border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" bgcolor=\"#333333\">";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "ID";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['id'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "regID";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['regID'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Payment ID";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['payment_id'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Last Name";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['lastName'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "First Name";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['firstName'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Email";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['email'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Payment Confirmed?";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['payconf'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Age";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['age'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "gender";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['gender'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Attendee Type";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['attnType'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Meal Type";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['mealType'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Specific Meal Requests";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['mealSpecReq'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "T-Shirt Size";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['tShirtSize'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "School";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['school'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "International";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['International'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "International Coutry";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['IntlCountry'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Student Organization";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['StudentOrg'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Email";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['email'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Phone";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['phone'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Address Line 1";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['address1'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "Address Line 2";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['address2'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "City";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['city'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "State";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['state'];
							print "</td>";
					print "</tr>";
					print "<tr>";
							print "<td bgcolor=\"#C9E2FF\" >";
							print "ZIP";
							print "</td>";
							print "<td bgcolor=\"#ffffff\" >";
							print $row['ZIP'];
							print "</td>";
					print "</tr>";
					
							
				print "</table>";
			
			}
			
?>