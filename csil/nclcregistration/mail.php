<?php
	include_once("mimemail/htmlMimeMail.php");		

	$mail = new htmlMimeMail();
 
	//Set the From and Reply-To headers
	$mail->setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
	$mail->setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail->setSubject('NCLC Registration');

	$body .= "<h1>NCLC 2009 Online Registration Summary</h1>";
		
	$body .= "<b>You Have successfully registered the following participant(s):</b>";
	$body .= "<br /><br />";

	$body .=  '<div style="width:400px">';
		$body .=  "<b>Primary Registrant:</b>";
		$body .=  "<br><br>";
	$body .=  '</div>';
	
	$body .=  '<div style="float:left;">';
		$body .=  "<table>";
		$body .=  "<tr>";
			$body .=  "<td width=\"200px\">";
			$body .=  "First Name:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['firstName'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Last Name";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['lastName'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Age:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['age'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Gender:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['gender'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Attendee Type:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['attnType'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Meal Type:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['mealType'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Meal Type Specifics:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['mealSpecReq'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "T-Shirt Size:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['TShirtSize'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "School:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['school'];
			$body .=  "</td>";
		$body .=  "</tr>";
		
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "International Student:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['Intl'];
			$body .=  "</td>";
		$body .=  "</tr>";

		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Country (If International):";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['IntlCountry'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Student Organization:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['StuOrg'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Email:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['email'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Phone:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['phone'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Address:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['add1'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "Addr Line 2:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['add2'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "City:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['city'];
			$body .=  "</td>";
		$body .=  "</tr>";
	
		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "State:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['state'];
			$body .=  "</td>";
		$body .=  "</tr>";

		$body .=  "<tr>";
			$body .=  "<td>";
			$body .=  "ZIP:";
			$body .=  "</td>";
			$body .=  "<td>";
			$body .=  $_SESSION['zip'];
			$body .=  "</td>";
		$body .=  "</tr>";

	
	$body .=  "<br><br>";
	$body .=  "</table>";
	$body .=  "</div>";
	$body .=  "<br><br>";

if($_SESSION['attendee'] > 0) {	

	

	$body .=  '<div style="height:40px; width:400px">';
	$body .=  '<div>';
	$body .=  "<br><br>";
	$body .=  "<br><br>";
	$body .=  "<b>Other Attendee(s):</b>";
	$body .=  "<br><br>";
	$body .=  '</div>';
	$body .=  '<div style="float:left;">';
	$body .=  "<br><br>";
	$body .=  "<br><br>";
	$body .=  '</div>';
	$body .=  '</div>';
	
	$body .=  '<div style="float:left;">';
	$body .=  "<table>";
	for($i = 1; $i <= $_SESSION['attendee']; $i++) {
	
	$body .=  "<tr>";
	$body .=  '<td colspan="2">';
	$body .=  '<b>Additional Attendee &nbsp;' . $i . '</b>';
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td width=\"200px\">";
	$body .=  "First Name";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['firstName' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Last Name";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['lastName' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Age:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['age' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Gender:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['gender' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Attendee Type:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['attnType' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Meal Type:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['mealType' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Meal Type Specifics:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['mealSpecReq' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "School:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['school' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "International Student:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['Intl' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Country (If International:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['IntlCountry' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "Student Organization:";
	$body .=  "</td>";
	$body .=  "<td>";
	$body .=  $_SESSION['StuOrg' . $i];
	$body .=  "</td>";
	$body .=  "</tr>";
	
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "&nbsp;";
	$body .=  "</td>";
	$body .=  "</tr>";
	$body .=  "<tr>";
	$body .=  "<td>";
	$body .=  "&nbsp;";
	$body .=  "</td>";
	$body .=  "</tr>";
	
	
	}
	$body .=  "</table>";
	$body .=  "</div>";
}
	

	$mail->setHTML($body);

	$result=$mail->send(array($_SESSION['email']));
?>



