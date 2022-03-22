<title>Payment Information</title>

<h1>NCLC 2009 Online Registration Summary</h1>
		
<b>You have successfully registered the following participant(s):</b> 
<br /><br />

<?

	 print '<div style="width:400px">';
		 print "<b>Primary Registrant:</b>";
		 print "<br><br>";
	 print '</div>';
	
	 print '<div style="float:left;">';
		 print "<table>";
		 print "<tr>";
			 print "<td width=\"200px\">";
			 print "First Name:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['firstName'];
			 print "</td>";
		 print "</tr>";
	
	
		 print "<tr>";
			 print "<td>";
			 print "Last Name";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['lastName'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Age:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['age'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Gender:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['gender'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Attendee Type:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['attnType'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Meal Type:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['mealType'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Meal Type Specifics:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['mealSpecReq'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "T-Shirt Size:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['TShirtSize'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "School:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['school'];
			 print "</td>";
		 print "</tr>";
		
		 print "<tr>";
			 print "<td>";
			 print "International Student:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['Intl'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Country (If International):";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['IntlCountry'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Student Organization:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['StuOrg'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Email:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['email'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Phone:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['phone'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Address:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['add1'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "Addr Line 2:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['add2'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "City:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['city'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "State:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['state'];
			 print "</td>";
		 print "</tr>";
	
		 print "<tr>";
			 print "<td>";
			 print "ZIP:";
			 print "</td>";
			 print "<td>";
			 print $_SESSION['zip'];
			 print "</td>";
		 print "</tr>";

	
	 print "<br><br>";
	 print "</table>";
	 print "</div>";
	
if($_SESSION['attendee'] > 0) {	

	

	 print '<div style="height:40px; width:400px">';
	 print '<div style="float:left; width:300px">';
	 print "<br><br>";
	 print "<b>Other Attendee(s):</b>";
	 print "<br><br>";
	 print '</div>';
	 print '<div style="float:left; width:100px"">';
	 print "<br><br>";
	 print "<br><br>";
	 print '</div>';
	 print '</div>';
	
	 print '<div style="float:left;">';
	 print "<table>";
	for($i = 1; $i <= $_SESSION['attendee']; $i++) {
	
	 print "<tr>";
	 print '<td colspan="2">';
	 print '<b>Additional Attendee &nbsp;' . $i . '</b>';
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td width=\"200px\">";
	 print "First Name";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['firstName' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Last Name";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['lastName' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Age:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['age' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Gender:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['gender' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Attendee Type:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['attnType' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Meal Type:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['mealType' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Meal Type Specifics:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['mealSpecReq' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "School:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['school' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "International Student:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['Intl' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Country (If International):";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['IntlCountry' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "Student Organization:";
	 print "</td>";
	 print "<td>";
	 print $_SESSION['StuOrg' . $i];
	 print "</td>";
	 print "</tr>";
	
	 print "<tr>";
	 print "<td>";
	 print "&nbsp;";
	 print "</td>";
	 print "</tr>";
	 print "<tr>";
	 print "<td>";
	 print "&nbsp;";
	 print "</td>";
	 print "</tr>";
	
	
	}
	 print "</table>";
	 print "</div>";
	
	


}

?>



