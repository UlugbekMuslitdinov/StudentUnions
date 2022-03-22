<?php
	session_start();
	
/* ------------------- Corrections Check --------------------*/	
	
	if(((!isset($_POST['attendee'])) && (!isset($_SESSION['attendee'])))  || ((!isset($_POST['regType'])) && (!isset($_SESSION['regType']))))  {
	
		$error = true;
		$error1 = "You did not specify whether you are attending with a group, please indicate this";
		
		require_once('reg.php');
		
} else {
	
/* ------------------- End Corrections Check --------------------*/			
		
	if(!isset($_POST['change'])) {
	$_SESSION['attendee'] = $_POST['attendee'];
	$_SESSION['regType'] = $_POST['regType'];
	}
	
	if($_SESSION['regType'] == "indiv") {
	$_SESSION['attendee'] = 0;
	}
		
		
	include_once("common/page_start.php");
	
	if ($error == true) {
	
	print "<div class=\"content_block\">";
	
	print "<p style=\"color:red; font-size:24px; font-weight:bold; font:arial\">Error<br><br>";
	
		for ($i = 1; $i <= 10; $i++) {
			
				if (isset($_POST['error'. $i])) {
				print "<font style=\"font-size:14px; font-weight:normal\">" . $_POST['error'. $i] . "</font>";
				}
		}
		
		print "</p>";
		
		for ($j=1; $j <= $_SESSION['attendee']; $j++) {
			
			print "<p style=\"font-size:14px; color:red;  font-weight:normal\">";	
			
			for ($i=1; $i <= 5; $i++) {
				if (isset($_POST['errorAttn' . $i . $j])) {
				print "<font style=\"font-size:14px; font-weight:normal\">" . $_POST['errorAttn' . $i . $j] . "</font>";
					}
				}
			print "</p>";
		}
			
		
			
	
			
	
		}	
	
	
	if ($error != true) {
		print "<div class=\"content_block\">";
		}
	
	?>
	
	<h1>NCLC 2009 Online Registration</h1>
	
	<?
	
	print "<br>";
	print "<br>";
	
	if ((isset($_POST['change'])) || (isset($_SESSION['changeAttn']))) {
	
		print "<b>Personal Information</b>";
		
		print "<br><br>";
		
		print "<table>";
		
		print "<form action=\"reg3.php\" method=\"post\">";
		print "<tr>";
		print "<td width=\"150px\">";
		print "Last Name";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"lastName\" value=". $_SESSION['lastName'] . ">";
		print "</td>";
		print "</tr>";
		
		print "<tr>";
		print "<td>";
		print "First Name";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"firstName\" value=" . $_SESSION['firstName'] . ">";
		print "</td>";
		print "</tr>";
		
		print "<tr>";
		print "<td>";
		print "Age &nbsp;";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"2\" size=\"3\" name=\"age\" value=" . $_SESSION['age'] . ">";
		print "</td>";
		print "</tr>";
		
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Sex: &nbsp;";
		print "</td>";
		print "<td>";
		print "<select name=\"gender\">";
		if ($_SESSION['gender'] == "Female") {
		print "<option>Female</option>";
		print "<option>Male</option>";
		print "<option>Transgender</option>";
		} elseif ($_SESSION['gender'] == "Transgender") {
		print "<option>Transgender</option>";
		print "<option>Female</option>";
		print "<option>Male</option>";
		} else {
		print "<option>Male</option>";
		print "<option>Female</option>";
		print "<option>Transgender</option>";
		} 
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Are you a participating student or advisor?";
		print "</td>";
		print "<td>";
		print "<select name=\"attnType\"> ";
		if ($_SESSION['attnType'] == "Advisor") {
		print "<option>Advisor</option>";
		print "<option>Student</option>";
		} else {
		print "<option>Student</option>";
		print "<option>Advisor</option>";
		}
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "What Meal Type would you prefer?";
		print "</td>";
		print "<td>";
		print "<select name=\"mealType\">";
		if ($_SESSION['mealType'] == "Vegetarian") {
		print "<option>Vegetarian</option>";
		print "<option>Non-Vegetarian</option>";
		print "<option name=\"vegan\">Vegan</option>";
		
		} elseif($_SESSION['mealType'] == "Vegan") {
		print "<option>Vegan</option>";
		print "<option>Non-Vegetarian</option>";
		print "<option>Vegetarian</option>";
		} else {
		print "<option>Non-Vegetarian</option>";
		print "<option>Vegetarian</option>";
		print "<option>Vegan</option>";
		}
		
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Do you have any additional specific meal requests?";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"mealSpecReq\" value=\"". $_SESSION['mealSpecReq'] . "\">";
		print "</td>";
		print "</tr>";
		
	
	if (time() < 1232949600) {
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "What T-Shirt size?";
		print "</td>";
		print "<td>";
		print "<select name=\"TShirtSize\">";
		if ($_SESSION['TShirtSize'] == "XXXL") {
		print "<option>XXXL</option>";
		print "<option>Small</option>";
		print "<option>Medium</option>";
		print "<option>Large</option>";
		print "<option>XL</option>";
		print "<option>XXL</option>";
		} elseif ($_SESSION['TShirtSize'] == "XXL") {
		print "<option>XXL</option>";
		print "<option>Small</option>";
		print "<option>Medium</option>";
		print "<option>Large</option>";
		print "<option>XL</option>";
		print "<option>XXXL</option>";
		} elseif ($_SESSION['TShirtSize'] == "XL") {
		print "<option>XL</option>";
		print "<option>Small</option>";
		print "<option>Medium</option>";
		print "<option>Large</option>";
		print "<option>XXL</option>";
		print "<option>XXXL</option>";
		} elseif ($_SESSION['TShirtSize'] == "Large") {
		print "<option>Large</option>";
		print "<option>Small</option>";
		print "<option>Medium</option>";
		print "<option>XL</option>";
		print "<option>XXL</option>";
		print "<option>XXXL</option>";
		} elseif ($_SESSION['TShirtSize'] == "Medium") {
		print "<option>Medium</option>";
		print "<option>Small</option>";
		print "<option>Large</option>";
		print "<option>XL</option>";
		print "<option>XXL</option>";
		print "<option>XXXL</option>";
		} else {
		print "<option>Small</option>";
		print "<option>Medium</option>";
		print "<option>Large</option>";
		print "<option>XL</option>";
		print "<option>XXL</option>";
		print "<option>XXXL</option>";
		} 
		print "</select>";
		print "</td>";
		print "</tr>";
		
	}
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Which participating school are you affiliated with?";
		print "</td>";
		print "<td>";
		print "<select name=\"school\">";
				if (isset($_SESSION['school'])) {
					print "<option>" . $_SESSION['school'] . "</option>";
					}
		print "<option></option>";
		print "<option>Adrian College</option>";
		print "<option>Alabama State University</option>";
		print "<option>Arizona State University</option>";
		print "<option>Arizona State University - East</option>";
		print "<option>Arizona State University - West</option>";
		print "<option>Arizona Western College</option>";
		print "<option>Arkansas State University</option>";
		print "<option>Auburn University</option>";
		print "<option>Boston College</option>";
		print "<option>Bowling Green State University</option>";
		print "<option>Bryant University</option>";
		print "<option>Carleton College</option>";
		print "<option>Carroll College</option>";
		print "<option>Cedarville University</option>";
		print "<option>Central Arizona College</option>";
		print "<option>Chandler-Gilbert Community College</option>";
		print "<option>Chaparral College</option>";
		print "<option>Chapman University</option>";
		print "<option>City University of New York</option>";
		print "<option>Clarion University</option>";
		print "<option>Coastal Carolina University</option>";
		print "<option>Cochise College</option>";
		print "<option>Coconino Community College</option>";
		print "<option>Coe College</option>";
		print "<option>Colgate University</option>";
		print "<option>College of Charleston</option>";
		print "<option>Collins College - Tempe</option>";
		print "<option>Colorado State University</option>";
		print "<option>Community College of Aurora</option>";
		print "<option>Creighton University</option>";
		print "<option>Dakota State University</option>";
		print "<option>Dine College</option>";
		print "<option>Dominican University of California</option>";
		print "<option>Eastern Arizona College</option>";
		print "<option>Embry-Riddle Aeronautical</option>";
		print "<option>Estrella Mountain Community College</option>";
		print "<option>Fairfield University</option>";
		print "<option>Florida International University</option>";
		print "<option>Fort Lewis College</option>";
		print "<option>Front Range Community College</option>";
		print "<option>Gateway Community College</option>";
		print "<option>Georgetown College</option>";
		print "<option>Georgetown University</option>";
		print "<option>Georgia State University</option>";
		print "<option>Glendale Community College</option>";
		print "<option>Gonzaga University</option>";
		print "<option>Hawaii Community College</option>";
		print "<option>Hawaii Pacific University</option>";
		print "<option>Idaho State University</option>";
		print "<option>Illinois State University</option>";
		print "<option>Indiana State University</option>";
		print "<option>Indiana University</option>";
		print "<option>Ithaca College</option>";
		print "<option>ITT Technical Institute</option>";
		print "<option>Jamestown College</option>";
		print "<option>Kansas State University</option>";
		print "<option>Kentucky State University</option>";
		print "<option>Lycoming College</option>";
		print "<option>Magellan University</option>";
		print "<option>Manmouth University</option>";
		print "<option>Maricopa Community Colleges</option>";
		print "<option>Marymount University</option>";
		print "<option>Mesa Community College</option>";
		print "<option>Miami University</option>";
		print "<option>Michigan State University</option>";
		print "<option>Middle Tennessee University</option>";
		print "<option>Mississippi State University</option>";
		print "<option>Mohave Community College</option>"; 
		print "<option>Montana State University</option>";
		print "<option>Monticlair State University</option>";
		print "<option>New Jersey City University</option>";
		print "<option>New Mexico State University - Las Cruces</option>";
		print "<option>Newberry College</option>";
		print "<option>Nichols College</option>";
		print "<option>North Carolina Central University</option>";
		print "<option>North Carolina State University</option>";
		print "<option>Northern Arizona University</option>";
		print "<option>Northern Kentucky University</option>";
		print "<option>Northern State University</option>";
		print "<option>Northland Pioneer College </option>";
		print "<option>Northwestern Oklahoma State University</option>";
		print "<option>Notre Dame University</option>";
		print "<option>Ohio State University</option>";
		print "<option>Ohio University</option>";
		print "<option>Oklahoma State University</option>";
		print "<option>Old Dominion University</option>";
		print "<option>Oregon State University</option>";
		print "<option>Pace University</option>";
		print "<option>Palomar Community College</option>";
		print "<option>Paradise Valley Community College</option>";
		print "<option>Penn State University</option>";
		print "<option>Philadelphia University</option>";
		print "<option>Phoenix College</option>";
		print "<option>Pikes Peak Community College</option>";
		print "<option>Pima Community College- Community Campus</option>";
		print "<option>Pima Community College- Downtown</option>";
		print "<option>Pima Community College- Northwest</option>";
		print "<option>Pima Community College-Desert Vista</option>";
		print "<option>Pima Community College-East</option>";
		print "<option>Pima Community College-West</option>"; 
		print "<option>Plymouth State University</option>";
		print "<option>Princeton University</option>";
		print "<option>Purdue University</option>";
		print "<option>Rio Salado College</option>"; 
		print "<option>Rochester Institute of Technology</option>";
		print "<option>Rocky Mountain Community College</option>";
		print "<option>Rollins College</option>";
		print "<option>Rutgers University</option>";
		print "<option>San Diego State University</option>";
		print "<option>Savannah State University</option>";
		print "<option>Scottsdale Community College</option>"; 
		print "<option>Seton Hall University</option>";
		print "<option>Sheridan College</option>";
		print "<option>South Dakota State University</option>";
		print "<option>South Mountain Community College</option>";
		print "<option>Southern New Hampshire University</option>";
		print "<option>Southern Utah University</option>";
		print "<option>Southwest Minnesota State University</option>";
		print "<option>Towson University</option>";
		print "<option>Tucsculum College</option>";
		print "<option>Tulane University</option>";
		print "<option>University of Alabama</option>";
		print "<option>University of Alaska - Anchorage</option>";
		print "<option>University of Arizona</option>";
		print "<option>University of Arkansas</option>";
		print "<option>University of Baltimore</option>";
		print "<option>University of California - Los Angeles</option>";
		print "<option>University of California - San Diego</option>";
		print "<option>University of Central Arkansas</option>";
		print "<option>University of Central Missouri</option>";
		print "<option>University of Colorado</option>";
		print "<option>University of Connecticut</option>";
		print "<option>University of Dayton</option>";
		print "<option>University of Delaware</option>";
		print "<option>University of Florida</option>";
		print "<option>University of Georgia</option>";
		print "<option>University of Hartford</option>";
		print "<option>University of Idaho</option>";
		print "<option>University of Indiana</option>";
		print "<option>University of Kansas</option>";
		print "<option>University of Kentucky</option>";
		print "<option>University of Maine</option>";
		print "<option>University of Maryland</option>";
		print "<option>University of Massachusetts</option>";
		print "<option>University of Michigan</option>";
		print "<option>University of Minnesota</option>";
		print "<option>University of Missouri</option>";
		print "<option>University of Montana</option>";
		print "<option>University of Nevada - Las Vegas</option>";
		print "<option>University of New Hampshire</option>";
		print "<option>University of New Mexico</option>";
		print "<option>University of North Dakota</option>";
		print "<option>University of Nova Southern</option>";
		print "<option>University of Oklahoma</option>";
		print "<option>University of Oregon</option>";
		print "<option>University of Pennsylvania</option>";
		print "<option>University of Portland</option>";
		print "<option>University of Rhode Island</option>";
		print "<option>University of South Carolina</option>";
		print "<option>University of South Dakota</option>";
		print "<option>University of Southern Maine</option>";
		print "<option>University of Southern Mississippi</option>";
		print "<option>University of Tennessee</option>";
		print "<option>University of Texas - Austin</option>";
		print "<option>University of the Pacific</option>";
		print "<option>University of Vermont</option>";
		print "<option>University of Virginia</option>";
		print "<option>University of Washington</option>";
		print "<option>University of West Virginia</option>";
		print "<option>University of Wisconsin - Madison</option>";
		print "<option>University of Wisconsin - Milwaukee</option>";
		print "<option>Utah Valley State</option>";
		print "<option>Virginia Commonwealth University</option>";
		print "<option>Virginia State University</option>";
		print "<option>Weber State University</option>";
		print "<option>West Virginia State University</option>";
		print "<option>Wisconsin Lutheran College</option>";
		print "<option>Wright State University</option>";
		print "<option>Yale University</option>";
		print "<option>Yavapai College</option>";
		print "<option>York College of Pennsylvania</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "If your school was not listed above, what school are you associated with?";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"schoolMan\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "Do you consider yourself International?";
		print "</td>";
		print "<td>";
		print "<select name=\"Intl\">";
		if ($_SESSION['Intl'] == "Yes") {
		print "<option>Yes</option>";
		print "<option>No</option>";
		} else {
		print "<option>No</option>";
		print "<option>Yes</option>";
		}
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "If yes, what country/countries are you from";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"IntlCountry\" value=\"". $_SESSION['IntlCountry'] . "\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "What Type of organization are you affiliated with?";
		print "</td>";
		print "<td>";
		print "<select name=\"StuOrg\">";
		if ($_SESSION['StuOrg'] == "Student Club") {
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"None\">None</option>";
		} 
		elseif ($_SESSION['StuOrg'] == "Fraternity/Sorority") {
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"None\">None</option>";
		} 
		elseif ($_SESSION['StuOrg'] == "Honorary") {
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"None\">None</option>";
		} 
		elseif ($_SESSION['StuOrg'] == "Sports Club") {
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"None\">None</option>";
		}
		elseif ($_SESSION['StuOrg'] == "Residents Hall") {
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"None\">None</option>";
		}
		elseif ($_SESSION['StuOrg'] == "Other") {
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"None\">None</option>";
		}
		elseif ($_SESSION['StuOrg'] == "Other") {
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"None\">None</option>";
		}
		else {
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"None\">None</option>";
		}
		print "</select>";
		print "</td>";
		print "</tr>";
		
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "E-mail address";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"email\" value=\"". $_SESSION['email'] . "\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "Daytime Phone";
		print "<br>";
		print "(xxx) xxx-xxxx";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"15\" size=\"15\" name=\"phone\" value=\"". $_SESSION['phone'] . "\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "Address Line 1";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"40\" name=\"add1\" value=\"". $_SESSION['add1'] . "\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "Address Line 2";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"40\" name=\"add2\" value=\"". $_SESSION['add2'] . "\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "City";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"30\" name=\"city\" value=\"". $_SESSION['city'] . "\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "2-Letter State Abbreviation";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"3\" size=\"3\" name=\"state\" value=\"". $_SESSION['state'] . "\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "ZIP";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"6\" size=\"5\" name=\"zip\" value=\"". $_SESSION['zip'] . "\">";
		print "</td>";
		print "</tr>";
		
		
		print "</table>";
		
		print "<br><br>";
		
		if($_POST['regType'] == "indiv") {
		
		print "<input type=\"submit\">";
		
		} else {
			
			print '<a name="other">';
			print '&nbsp;';
			print '</a>';
			print "<table>";
			
			
			for($i = 1; $i <= $_SESSION['attendee']; $i++) {
			
				print "<tr>";
				print "<td colspan=\"2\">";
				print "<b>Additional Attendee "  . $i . "</b>" ;
				print "</td>";
				print "</tr>";
				print "<tr>";
				print "<td width=\"150px\">";
				print "Last Name";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"lastName" . $i . "\" value=\"" . $_SESSION['lastName' . $i] . "\">";
				print "</td>";
				print "</tr>";
				print "<tr>";
				print "<td>";
				print "First Name";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"firstName" . $i . "\" value=\"" . $_SESSION['firstName' . $i] . "\">";
				print "</td>";
				print "</tr>";
				print "<tr>";
				print "<td>";
				print "Age &nbsp;";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"2\" size=\"3\" name=\"age" . $i . "\" value=\"" . $_SESSION['age' . $i] . "\">";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "Sex: &nbsp;";
				print "</td>";
				print "<td>";
				print "<select name=\"gender" . $i . "\">";
				if ($_SESSION['gender' . $i] == "Female") {
				print "<option>Female</option>";
				print "<option>Male</option>";
				print "<option>Transgender</option>";
				} elseif ($_SESSION['gender' . $i] == "Transgender") {
				print "<option>Transgender</option>";
				print "<option>Female</option>";
				print "<option>Male</option>";
				} else {
				print "<option>Male</option>";
				print "<option>Female</option>";
				print "<option>Transgender</option>";
				} 
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "Are you a participating student or advisor?";
				print "</td>";
				print "<td>";
				print "<select name=\"attnType" . $i . "\"> ";
				if ($_SESSION['attnType' . $i] == "Advisor") {
				print "<option>Advisor</option>";
				print "<option>Student</option>";
				} else {
				print "<option>Student</option>";
				print "<option>Advisor</option>";
				}
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "What Meal Type would you prefer?";
				print "</td>";
				print "<td>";
				print "<select name=\"mealType" . $i . "\">";
				if ($_SESSION['mealType' . $i] == "Vegetarian") {
				print "<option>Vegetarian</option>";
				print "<option>Non-Vegetarian</option>";
				print "<option name=\"vegan\">Vegan</option>";
				} elseif($_SESSION['mealType' . $i] == "Vegan") {
				print "<option>Vegan</option>";
				print "<option>Non-Vegetarian</option>";
				print "<option>Vegetarian</option>";
				} else {
				print "<option>Non-Vegetarian</option>";
				print "<option>Vegetarian</option>";
				print "<option>Vegan</option>";
				}
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "Do you have any additional specific meal requests?";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"mealSpecReq" . $i . "\" value=\"" . $_SESSION['mealSpecReq' . $i] . "\">";
				print "</td>";
				print "</tr>";
		
		if (time() < 1232949600) {
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "What T-Shirt type would you prefer?";
				print "</td>";
				print "<td>";
				print "<select name=\"TShirtSize" . $i . "\">";
				if ($_SESSION['TShirtSize'. $i] == "XXXL") {
				print "<option>XXXL</option>";
				print "<option>Small</option>";
				print "<option>Medium</option>";
				print "<option>Large</option>";
				print "<option>XL</option>";
				print "<option>XXL</option>";
				} elseif ($_SESSION['TShirtSize'. $i] == "XXL") {
				print "<option>XXL</option>";
				print "<option>Small</option>";
				print "<option>Medium</option>";
				print "<option>Large</option>";
				print "<option>XL</option>";
				print "<option>XXXL</option>";
				} elseif ($_SESSION['TShirtSize'. $i] == "XL") {
				print "<option>XL</option>";
				print "<option>Small</option>";
				print "<option>Medium</option>";
				print "<option>Large</option>";
				print "<option>XXL</option>";
				print "<option>XXXL</option>";
				} elseif ($_SESSION['TShirtSize'. $i] == "Large") {
				print "<option>Large</option>";
				print "<option>Small</option>";
				print "<option>Medium</option>";
				print "<option>XL</option>";
				print "<option>XXL</option>";
				print "<option>XXXL</option>";
				} elseif ($_SESSION['TShirtSize'. $i] == "Medium") {
				print "<option>Medium</option>";
				print "<option>Small</option>";
				print "<option>Large</option>";
				print "<option>XL</option>";
				print "<option>XXL</option>";
				print "<option>XXXL</option>";
				}
				else {
				print "<option>Small</option>";
				print "<option>Medium</option>";
				print "<option>Large</option>";
				print "<option>XL</option>";
				print "<option>XXL</option>";
				print "<option>XXXL</option>";
				} 
				print "</select>";
				print "</td>";
				print "</tr>";
				
			}
		
				print "<tr height=\"70px\" style=\"vertical-align:top\">";
				print "<td width=\"150px\">";
				print "Which participating school are you affiliated with?";
				print "</td>";
				print "<td>";
				print "<select name=\"school" . $i . "\">";
					if (isset($_SESSION['school' . $i])) {
					print "<option>" . $_SESSION['school' . $i] . "</option>";
					}
				print "<option></option>";
				print "<option>Adrian College</option>";
				print "<option>Alabama State University</option>";
				print "<option>Arizona State University</option>";
				print "<option>Arizona State University - East</option>";
				print "<option>Arizona State University - West</option>";
				print "<option>Arizona Western College</option>";
				print "<option>Arkansas State University</option>";
				print "<option>Auburn University</option>";
				print "<option>Boston College</option>";
				print "<option>Bowling Green State University</option>";
				print "<option>Bryant University</option>";
				print "<option>Carleton College</option>";
				print "<option>Carroll College</option>";
				print "<option>Cedarville University</option>";
				print "<option>Central Arizona College</option>";
				print "<option>Chandler-Gilbert Community College</option>";
				print "<option>Chaparral College</option>";
				print "<option>Chapman University</option>";
				print "<option>City University of New York</option>";
				print "<option>Clarion University</option>";
				print "<option>Coastal Carolina University</option>";
				print "<option>Cochise College</option>";
				print "<option>Coconino Community College</option>";
				print "<option>Coe College</option>";
				print "<option>Colgate University</option>";
				print "<option>College of Charleston</option>";
				print "<option>Collins College - Tempe</option>";
				print "<option>Colorado State University</option>";
				print "<option>Community College of Aurora</option>";
				print "<option>Creighton University</option>";
				print "<option>Dakota State University</option>";
				print "<option>Dine College</option>";
				print "<option>Dominican University of California</option>";
				print "<option>Eastern Arizona College</option>";
				print "<option>Embry-Riddle Aeronautical</option>";
				print "<option>Estrella Mountain Community College</option>";
				print "<option>Fairfield University</option>";
				print "<option>Florida International University</option>";
				print "<option>Fort Lewis College</option>";
				print "<option>Front Range Community College</option>";
				print "<option>Gateway Community College</option>";
				print "<option>Georgetown College</option>";
				print "<option>Georgetown University</option>";
				print "<option>Georgia State University</option>";
				print "<option>Glendale Community College</option>";
				print "<option>Gonzaga University</option>";
				print "<option>Hawaii Community College</option>";
				print "<option>Hawaii Pacific University</option>";
				print "<option>Idaho State University</option>";
				print "<option>Illinois State University</option>";
				print "<option>Indiana State University</option>";
				print "<option>Indiana University</option>";
				print "<option>Ithaca College</option>";
				print "<option>ITT Technical Institute</option>";
				print "<option>Jamestown College</option>";
				print "<option>Kansas State University</option>";
				print "<option>Kentucky State University</option>";
				print "<option>Lycoming College</option>";
				print "<option>Magellan University</option>";
				print "<option>Manmouth University</option>";
				print "<option>Maricopa Community Colleges</option>";
				print "<option>Marymount University</option>";
				print "<option>Mesa Community College</option>";
				print "<option>Miami University</option>";
				print "<option>Michigan State University</option>";
				print "<option>Middle Tennessee University</option>";
				print "<option>Mississippi State University</option>";
				print "<option>Mohave Community College</option>"; 
				print "<option>Montana State University</option>";
				print "<option>Monticlair State University</option>";
				print "<option>New Jersey City University</option>";
				print "<option>New Mexico State University - Las Cruces</option>";
				print "<option>Newberry College</option>";
				print "<option>Nichols College</option>";
				print "<option>North Carolina Central University</option>";
				print "<option>North Carolina State University</option>";
				print "<option>Northern Arizona University</option>";
				print "<option>Northern Kentucky University</option>";
				print "<option>Northern State University</option>";
				print "<option>Northland Pioneer College </option>";
				print "<option>Northwestern Oklahoma State University</option>";
				print "<option>Notre Dame University</option>";
				print "<option>Ohio State University</option>";
				print "<option>Ohio University</option>";
				print "<option>Oklahoma State University</option>";
				print "<option>Old Dominion University</option>";
				print "<option>Oregon State University</option>";
				print "<option>Pace University</option>";
				print "<option>Palomar Community College</option>";
				print "<option>Paradise Valley Community College</option>";
				print "<option>Penn State University</option>";
				print "<option>Philadelphia University</option>";
				print "<option>Phoenix College</option>";
				print "<option>Pikes Peak Community College</option>";
				print "<option>Pima Community College- Community Campus</option>";
				print "<option>Pima Community College- Downtown</option>";
				print "<option>Pima Community College- Northwest</option>";
				print "<option>Pima Community College-Desert Vista</option>";
				print "<option>Pima Community College-East</option>";
				print "<option>Pima Community College-West</option>"; 
				print "<option>Plymouth State University</option>";
				print "<option>Princeton University</option>";
				print "<option>Purdue University</option>";
				print "<option>Rio Salado College</option>"; 
				print "<option>Rochester Institute of Technology</option>";
				print "<option>Rocky Mountain Community College</option>";
				print "<option>Rollins College</option>";
				print "<option>Rutgers University</option>";
				print "<option>San Diego State University</option>";
				print "<option>Savannah State University</option>";
				print "<option>Scottsdale Community College</option>"; 
				print "<option>Seton Hall University</option>";
				print "<option>Sheridan College</option>";
				print "<option>South Dakota State University</option>";
				print "<option>South Mountain Community College</option>";
				print "<option>Southern New Hampshire University</option>";
				print "<option>Southern Utah University</option>";
				print "<option>Southwest Minnesota State University</option>";
				print "<option>Towson University</option>";
				print "<option>Tucsculum College</option>";
				print "<option>Tulane University</option>";
				print "<option>University of Alabama</option>";
				print "<option>University of Alaska - Anchorage</option>";
				print "<option>University of Arizona</option>";
				print "<option>University of Arkansas</option>";
				print "<option>University of Baltimore</option>";
				print "<option>University of California - Los Angeles</option>";
				print "<option>University of California - Los Angeles</option>";
				print "<option>University of California - San Diego</option>";
				print "<option>University of Central Arkansas</option>";
				print "<option>University of Central Missouri</option>";
				print "<option>University of Colorado</option>";
				print "<option>University of Connecticut</option>";
				print "<option>University of Dayton</option>";
				print "<option>University of Delaware</option>";
				print "<option>University of Florida</option>";
				print "<option>University of Georgia</option>";
				print "<option>University of Hartford</option>";
				print "<option>University of Idaho</option>";
				print "<option>University of Indiana</option>";
				print "<option>University of Kansas</option>";
				print "<option>University of Kentucky</option>";
				print "<option>University of Maine</option>";
				print "<option>University of Maryland</option>";
				print "<option>University of Massachusetts</option>";
				print "<option>University of Michigan</option>";
				print "<option>University of Minnesota</option>";
				print "<option>University of Missouri</option>";
				print "<option>University of Montana</option>";
				print "<option>University of Nevada - Las Vegas</option>";
				print "<option>University of New Hampshire</option>";
				print "<option>University of New Mexico</option>";
				print "<option>University of North Dakota</option>";
				print "<option>University of Nova Southern</option>";
				print "<option>University of Oklahoma</option>";
				print "<option>University of Oregon</option>";
				print "<option>University of Pennsylvania</option>";
				print "<option>University of Portland</option>";
				print "<option>University of Rhode Island</option>";
				print "<option>University of San Diego</option>";
				print "<option>University of South Carolina</option>";
				print "<option>University of South Dakota</option>";
				print "<option>University of Southern Maine</option>";
				print "<option>University of Southern Mississippi</option>";
				print "<option>University of Tennessee</option>";
				print "<option>University of Texas - Austin</option>";
				print "<option>University of the Pacific</option>";
				print "<option>University of Vermont</option>";
				print "<option>University of Virginia</option>";
				print "<option>University of Washington</option>";
				print "<option>University of West Virginia</option>";
				print "<option>University of Wisconsin - Madison</option>";
				print "<option>University of Wisconsin - Milwaukee</option>";
				print "<option>Utah Valley State</option>";
				print "<option>Virginia Commonwealth University</option>";
				print "<option>Virginia State University</option>";
				print "<option>Weber State University</option>";
				print "<option>West Virginia State University</option>";
				print "<option>Wisconsin Lutheran College</option>";
				print "<option>Wright State University</option>";
				print "<option>Yale University</option>";
				print "<option>Yavapai College</option>";
				print "<option>York College of Pennsylvania</option>";
				print "</select>";
				//print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"school" . $i . "\" value=\"" . $_SESSION['school' . $i] . "\">";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"30px\">";
				print "<td width=\"150px\">";
				print "If your school was not listed above, what school are you associated with?";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"schoolMan" . $i . "\">";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"30px\">";
				print "<td width=\"150px\">";
				print "Do you consider yourself International?";
				print "</td>";
				print "<td>";
				print "<select name=\"Intl" . $i . "\">";
				if ($_SESSION['Intl'. $i] == "Yes") {
				print "<option>Yes</option>";
				print "<option>No</option>";
				} else {
				print "<option>No</option>";
				print "<option>Yes</option>";
				}
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"30px\">";
				print "<td width=\"150px\">";
				print "If yes, what country/countries are you from";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"IntlCountry" . $i . "\" value=\"". $_SESSION['IntlCountry' . $i] . "\">";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"30px\">";
				print "<td width=\"150px\">";
				print "What Type of organization are you affiliated with?";
				print "</td>";
				print "<td>";
				print "<select name=\"StuOrg" . $i . "\">";
				if ($_SESSION['StuOrg'. $i] == "Student Club") {
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"None\">None</option>";
				} 
				elseif ($_SESSION['StuOrg'. $i] == "Fraternity/Sorority") {
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"None\">None</option>";
				} 
				elseif ($_SESSION['StuOrg'. $i] == "Honorary") {
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"None\">None</option>";
				} 
				elseif ($_SESSION['StuOrg'. $i] == "Sports Club") {
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"None\">None</option>";
				}
				elseif ($_SESSION['StuOrg'. $i] == "Residents Hall") {
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"None\">None</option>";
				}
				elseif ($_SESSION['StuOrg'. $i] == "Other") {
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"None\">None</option>";
				}
				elseif ($_SESSION['StuOrg' . $i] == "None") {
				print "<option name=\"None\">None</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"StuGov\">Student Government</option>";
				}
				else {
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"None\">None</option>";
				}
				print "</select>";
				print "</td>";
				print "</tr>";
				
				
				
				
				}
				
			print "</table>";
			print "<input type=\"submit\">";
			}
	
		unset($_SESSION['changeAttn']);
	
	
	
	}else{
	
	
		print "<b>Personal Information</b>";
		
		print "<br><br>";
		
		print "<table>";
		
		print "<form action=\"reg3.php\" method=\"post\">";
		print "<tr>";
		print "<td width=\"150px\">";
		print "Last Name";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"lastName\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr>";
		print "<td>";
		print "First Name";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"firstName\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr>";
		print "<td>";
		print "Age &nbsp;";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"2\" size=\"3\" name=\"age\" />";
		print "</td>";
		print "</tr>";
		
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Sex: &nbsp;";
		print "</td>";
		print "<td>";
		print "<select name=\"gender\">";
		print "<option>Male</option>";
		print "<option>Female</option>";
		print "<option>Transgender</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Are you a participating student or advisor?";
		print "</td>";
		print "<td>";
		print "<select name=\"attnType\"> ";
		print "<option name=\"Stu\">Student</option>";
		print "<option name=\"Adv\">Advisor</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "What Meal Type would you prefer?";
		print "</td>";
		print "<td>";
		print "<select name=\"mealType\">";
		print "<option name=\"reg\">Non-Vegetarian</option>";
		print "<option name=\"vegi\">Vegetarian</option>";
		print "<option name=\"vegan\">Vegan</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Do you have any additional specific meal requests?";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"mealSpecReq\" />";
		print "</td>";
		print "</tr>";
		

	if (time() < 1232949600) {
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "T-Shirt Size";
		print "</td>";
		print "<td>";
		print "<select name=\"TShirtSize\">";
		print "<option name=\"Sm\">Small</option>";
		print "<option name=\"Md\">Medium</option>";
		print "<option name=\"Lg\">Large</option>";
		print "<option name=\"XL\">XL</option>";
		print "<option name=\"XXL\">XXL</option>";
		print "<option name=\"XXXL\">XXXL</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
	}
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Which participating school are you affiliated with?";
		print "</td>";
		print "<td>";
		print "<select name=\"school\">";
		print "<option></option>";
		print "<option>Adrian College</option>";
		print "<option>Alabama State University</option>";
		print "<option>Arizona State University</option>";
		print "<option>Arizona State University - East</option>";
		print "<option>Arizona State University - West</option>";
		print "<option>Arizona Western College</option>";
		print "<option>Arkansas State University</option>";
		print "<option>Auburn University</option>";
		print "<option>Boston College</option>";
		print "<option>Bowling Green State University</option>";
		print "<option>Bryant University</option>";
		print "<option>Carleton College</option>";
		print "<option>Carroll College</option>";
		print "<option>Cedarville University</option>";
		print "<option>Central Arizona College</option>";
		print "<option>Chandler-Gilbert Community College</option>";
		print "<option>Chaparral College</option>";
		print "<option>Chapman University</option>";
		print "<option>City University of New York</option>";
		print "<option>Clarion University</option>";
		print "<option>Coastal Carolina University</option>";
		print "<option>Cochise College</option>";
		print "<option>Coconino Community College</option>";
		print "<option>Coe College</option>";
		print "<option>Colgate University</option>";
		print "<option>College of Charleston</option>";
		print "<option>Collins College - Tempe</option>";
		print "<option>Colorado State University</option>";
		print "<option>Community College of Aurora</option>";
		print "<option>Creighton University</option>";
		print "<option>Dakota State University</option>";
		print "<option>Dine College</option>";
		print "<option>Dominican University of California</option>";
		print "<option>Eastern Arizona College</option>";
		print "<option>Embry-Riddle Aeronautical</option>";
		print "<option>Estrella Mountain Community College</option>";
		print "<option>Fairfield University</option>";
		print "<option>Florida International University</option>";
		print "<option>Fort Lewis College</option>";
		print "<option>Front Range Community College</option>";
		print "<option>Gateway Community College</option>";
		print "<option>Georgetown College</option>";
		print "<option>Georgetown University</option>";
		print "<option>Georgia State University</option>";
		print "<option>Glendale Community College</option>";
		print "<option>Gonzaga University</option>";
		print "<option>Hawaii Community College</option>";
		print "<option>Hawaii Pacific University</option>";
		print "<option>Idaho State University</option>";
		print "<option>Illinois State University</option>";
		print "<option>Indiana State University</option>";
		print "<option>Indiana University</option>";
		print "<option>Ithaca College</option>";
		print "<option>ITT Technical Institute</option>";
		print "<option>Jamestown College</option>";
		print "<option>Kansas State University</option>";
		print "<option>Kentucky State University</option>";
		print "<option>Lycoming College</option>";
		print "<option>Magellan University</option>";
		print "<option>Manmouth University</option>";
		print "<option>Maricopa Community Colleges</option>";
		print "<option>Marymount University</option>";
		print "<option>Mesa Community College</option>";
		print "<option>Miami University</option>";
		print "<option>Michigan State University</option>";
		print "<option>Middle Tennessee University</option>";
		print "<option>Mississippi State University</option>";
		print "<option>Mohave Community College</option>"; 
		print "<option>Montana State University</option>";
		print "<option>Monticlair State University</option>";
		print "<option>New Jersey City University</option>";
		print "<option>New Mexico State University - Las Cruces</option>";
		print "<option>Newberry College</option>";
		print "<option>Nichols College</option>";
		print "<option>North Carolina Central University</option>";
		print "<option>North Carolina State University</option>";
		print "<option>Northern Arizona University</option>";
		print "<option>Northern Kentucky University</option>";
		print "<option>Northern State University</option>";
		print "<option>Northland Pioneer College </option>";
		print "<option>Northwestern Oklahoma State University</option>";
		print "<option>Notre Dame University</option>";
		print "<option>Ohio State University</option>";
		print "<option>Ohio University</option>";
		print "<option>Oklahoma State University</option>";
		print "<option>Old Dominion University</option>";
		print "<option>Oregon State University</option>";
		print "<option>Pace University</option>";
		print "<option>Palomar Community College</option>";
		print "<option>Paradise Valley Community College</option>";
		print "<option>Penn State University</option>";
		print "<option>Philadelphia University</option>";
		print "<option>Phoenix College</option>";
		print "<option>Pikes Peak Community College</option>";
		print "<option>Pima Community College- Community Campus</option>";
		print "<option>Pima Community College- Downtown</option>";
		print "<option>Pima Community College- Northwest</option>";
		print "<option>Pima Community College-Desert Vista</option>";
		print "<option>Pima Community College-East</option>";
		print "<option>Pima Community College-West</option>"; 
		print "<option>Plymouth State University</option>";
		print "<option>Princeton University</option>";
		print "<option>Purdue University</option>";
		print "<option>Rio Salado College</option>"; 
		print "<option>Rochester Institute of Technology</option>";
		print "<option>Rocky Mountain Community College</option>";
		print "<option>Rollins College</option>";
		print "<option>Rutgers University</option>";
		print "<option>San Diego State University</option>";
		print "<option>Savannah State University</option>";
		print "<option>Scottsdale Community College</option>"; 
		print "<option>Seton Hall University</option>";
		print "<option>Sheridan College</option>";
		print "<option>South Dakota State University</option>";
		print "<option>South Mountain Community College</option>";
		print "<option>Southern New Hampshire University</option>";
		print "<option>Southern Utah University</option>";
		print "<option>Southwest Minnesota State University</option>";
		print "<option>Towson University</option>";
		print "<option>Tucsculum College</option>";
		print "<option>Tulane University</option>";
		print "<option>University of Alabama</option>";
		print "<option>University of Alaska - Anchorage</option>";
		print "<option>University of Arizona</option>";
print "<option>University of Arkansas</option>";
		print "<option>University of Baltimore</option>";
		print "<option>University of California - Los Angeles</option>";
		print "<option>University of California - San Diego</option>";
		print "<option>University of Central Arkansas</option>";
		print "<option>University of Central Missouri</option>";
		print "<option>University of Colorado</option>";
		print "<option>University of Connecticut</option>";
		print "<option>University of Dayton</option>";
		print "<option>University of Delaware</option>";
		print "<option>University of Florida</option>";
		print "<option>University of Georgia</option>";
		print "<option>University of Hartford</option>";
		print "<option>University of Idaho</option>";
		print "<option>University of Indiana</option>";
		print "<option>University of Kansas</option>";
		print "<option>University of Kentucky</option>";
		print "<option>University of Maine</option>";
		print "<option>University of Maryland</option>";
		print "<option>University of Massachusetts</option>";
		print "<option>University of Michigan</option>";
		print "<option>University of Minnesota</option>";
		print "<option>University of Missouri</option>";
		print "<option>University of Montana</option>";
		print "<option>University of Nevada - Las Vegas</option>";
		print "<option>University of New Hampshire</option>";
		print "<option>University of New Mexico</option>";
		print "<option>University of North Dakota</option>";
		print "<option>University of Nova Southern</option>";
		print "<option>University of Oklahoma</option>";
		print "<option>University of Oregon</option>";
		print "<option>University of Pennsylvania</option>";
		print "<option>University of Portland</option>";
		print "<option>University of Rhode Island</option>";
		print "<option>University of San Diego</option>";
		print "<option>University of South Carolina</option>";
		print "<option>University of South Dakota</option>";
		print "<option>University of Southern Maine</option>";
		print "<option>University of Southern Mississippi</option>";
		print "<option>University of Tennessee</option>";
		print "<option>University of Texas - Austin</option>";
		print "<option>University of the Pacific</option>";
		print "<option>University of Vermont</option>";
		print "<option>University of Virginia</option>";
		print "<option>University of Washington</option>";
		print "<option>University of West Virginia</option>";
		print "<option>University of Wisconsin - Madison</option>";
		print "<option>University of Wisconsin - Milwaukee</option>";
		print "<option>Utah Valley State</option>";
		print "<option>Virginia Commonwealth University</option>";
		print "<option>Virginia State University</option>";
		print "<option>Weber State University</option>";
		print "<option>West Virginia State University</option>";
		print "<option>Wisconsin Lutheran College</option>";
		print "<option>Wright State University</option>";
		print "<option>Yale University</option>";
		print "<option>Yavapai College</option>";
		print "<option>York College of Pennsylvania</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "If your school was not listed above, what school are you associated with?";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"schoolMan\">";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "Are you an International Student?";
		print "</td>";
		print "<td>";
		print "<select name=\"Intl\">";
		print "<option name=\"No\">No</option>";
		print "<option name=\"Yes\">Yes</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "If so, what country/countries are you from?";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"IntlCountry\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"40px\">";
		print "<td width=\"150px\">";
		print "What type of organization are you affiliated with?";
		print "</td>";
		print "<td>";
		print "<select name=\"StuOrg\">";
		print "<option name=\"StuGov\">Student Government</option>";
		print "<option name=\"StuClub\">Student Club</option>";
		print "<option name=\"FratSor\">Fraternity/Sorority</option>";
		print "<option name=\"Hon\">Honorary</option>";
		print "<option name=\"Sports\">Sports Club</option>";
		print "<option name=\"ResHall\">Residents Hall</option>";
		print "<option name=\"Other\">Other</option>";
		print "<option name=\"None\">None</option>";
		print "</select>";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "E-mail address";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"email\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "Daytime Phone";
		print "<br>";
		print "(xxx) xxx-xxxx";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"15\" size=\"15\" name=\"phone\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "Address Line 1";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"40\" name=\"add1\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "Address Line 2";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"40\" name=\"add2\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "City";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"40\" size=\"30\" name=\"city\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "2-Letter State Abbreviation";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"3\" size=\"3\" name=\"state\" />";
		print "</td>";
		print "</tr>";
		
		print "<tr height=\"30px\">";
		print "<td width=\"150px\">";
		print "ZIP";
		print "</td>";
		print "<td>";
		print "<input  type=\"text\" maxlength=\"6\" size=\"5\" name=\"zip\" />";
		print "</td>";
		print "</tr>";
		
		
		print "</table>";
		
		print "<br><br>";
		
		if($_POST['regType'] == "indiv") {
		
		print "<input type=\"submit\">";
	
	} else {
		
			print "<table>";
			
			for($i = 1; $i <= $_SESSION['attendee']; $i++) {
			
				print "<tr>";
				print "<td colspan=\"2\">";
				print "<b>Additional Attendee "  . $i . "</b>" ;
				print "</td>";
				print "</tr>";
				print "<tr>";
				print "<td width=\"150px\">";
				print "Last Name";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"lastName" . $i . "\" />";
				print "</td>";
				print "</tr>";
				print "<tr>";
				print "<td>";
				print "First Name";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"20\" size=\"20\" style=\"margin-right:200px\" name=\"firstName" . $i . "\"  />";
				print "</td>";
				print "</tr>";
				
				print "<tr>";
				print "<td>";
				print "Age &nbsp;";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"2\" size=\"3\" name=\"age" . $i . "\"  />";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "Sex: &nbsp;";
				print "</td>";
				print "<td>";
				print "<select name=\"gender". $i . "\" >";
				print "<option>Male</option>";
				print "<option>Female</option>";
				print "<option>Transgender</option>";
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "Are you a participating student or advisor?";
				print "</td>";
				print "<td>";
				print "<select name=\"attnType" . $i . "\" > ";
				print "<option name=\"Stu\">Student</option>";
				print "<option name=\"Adv\">Advisor</option>";
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "What Meal Type would you prefer?";
				print "</td>";
				print "<td>";
				print "<select name=\"mealType" . $i . "\" >";
				print "<option name=\"reg\">Non-Vegetarian</option>";
				print "<option name=\"vegi\">Vegetarian</option>";
				print "<option name=\"vegan\">Vegan</option>";
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "Do you have any additional specific meal requests?";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"mealSpecReq" . $i . "\"  />";
				print "</td>";
				print "</tr>";
			
		if (time() < 1232949600) {	
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "T-Shirt Size";
				print "</td>";
				print "<td>";
				print "<select name=\"TShirtSize" . $i . "\">";
				print "<option name=\"Sm\">Small</option>";
				print "<option name=\"Md\">Medium</option>";
				print "<option name=\"Lg\">Large</option>";
				print "<option name=\"XL\">XL</option>";
				print "<option name=\"XXL\">XXL</option>";
				print "<option name=\"XXXL\">XXXL</option>";
				print "</select>";
				print "</td>";
				print "</tr>";
			}
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "Which participating school are you affiliated with?";
				print "</td>";
				print "<td>";
				print "<select name=\"school" . $i . "\">";
				print "<option></option>";
				print "<option>Adrian College</option>";
				print "<option>Alabama State University</option>";
				print "<option>Arizona State University</option>";
				print "<option>Arizona State University - East</option>";
				print "<option>Arizona State University - West</option>";
				print "<option>Arizona Western College</option>";
				print "<option>Arkansas State University</option>";
				print "<option>Auburn University</option>";
				print "<option>Boston College</option>";
				print "<option>Bowling Green State University</option>";
				print "<option>Bryant University</option>";
				print "<option>Carleton College</option>";
				print "<option>Carroll College</option>";
				print "<option>Cedarville University</option>";
				print "<option>Central Arizona College</option>";
				print "<option>Chandler-Gilbert Community College</option>";
				print "<option>Chaparral College</option>";
				print "<option>Chapman University</option>";
				print "<option>City University of New York</option>";
				print "<option>Clarion University</option>";
				print "<option>Coastal Carolina University</option>";
				print "<option>Cochise College</option>";
				print "<option>Coconino Community College</option>";
				print "<option>Coe College</option>";
				print "<option>Colgate University</option>";
				print "<option>College of Charleston</option>";
				print "<option>Collins College - Tempe</option>";
				print "<option>Colorado State University</option>";
				print "<option>Community College of Aurora</option>";
				print "<option>Creighton University</option>";
				print "<option>Dakota State University</option>";
				print "<option>Dine College</option>";
				print "<option>Dominican University of California</option>";
				print "<option>Eastern Arizona College</option>";
				print "<option>Embry-Riddle Aeronautical</option>";
				print "<option>Estrella Mountain Community College</option>";
				print "<option>Fairfield University</option>";
				print "<option>Florida International University</option>";
				print "<option>Fort Lewis College</option>";
				print "<option>Front Range Community College</option>";
				print "<option>Gateway Community College</option>";
				print "<option>Georgetown College</option>";
				print "<option>Georgetown University</option>";
				print "<option>Georgia State University</option>";
				print "<option>Glendale Community College</option>";
				print "<option>Gonzaga University</option>";
				print "<option>Hawaii Community College</option>";
				print "<option>Hawaii Pacific University</option>";
				print "<option>Idaho State University</option>";
				print "<option>Illinois State University</option>";
				print "<option>Indiana State University</option>";
				print "<option>Indiana University</option>";
				print "<option>Ithaca College</option>";
				print "<option>ITT Technical Institute</option>";
				print "<option>Jamestown College</option>";
				print "<option>Kansas State University</option>";
				print "<option>Kentucky State University</option>";
				print "<option>Lycoming College</option>";
				print "<option>Magellan University</option>";
				print "<option>Manmouth University</option>";
				print "<option>Maricopa Community Colleges</option>";
				print "<option>Marymount University</option>";
				print "<option>Mesa Community College</option>";
				print "<option>Miami University</option>";
				print "<option>Michigan State University</option>";
				print "<option>Middle Tennessee University</option>";
				print "<option>Mississippi State University</option>";
				print "<option>Mohave Community College</option>"; 
				print "<option>Montana State University</option>";
				print "<option>Monticlair State University</option>";
				print "<option>New Jersey City University</option>";
				print "<option>New Mexico State University - Las Cruces</option>";
				print "<option>Newberry College</option>";
				print "<option>Nichols College</option>";
				print "<option>North Carolina Central University</option>";
				print "<option>North Carolina State University</option>";
				print "<option>Northern Arizona University</option>";
				print "<option>Northern Kentucky University</option>";
				print "<option>Northern State University</option>";
				print "<option>Northland Pioneer College </option>";
				print "<option>Northwestern Oklahoma State University</option>";
				print "<option>Notre Dame University</option>";
				print "<option>Ohio State University</option>";
				print "<option>Ohio University</option>";
				print "<option>Oklahoma State University</option>";
				print "<option>Old Dominion University</option>";
				print "<option>Oregon State University</option>";
				print "<option>Pace University</option>";
				print "<option>Palomar Community College</option>";
				print "<option>Paradise Valley Community College</option>";
				print "<option>Penn State University</option>";
				print "<option>Philadelphia University</option>";
				print "<option>Phoenix College</option>";
				print "<option>Pikes Peak Community College</option>";
				print "<option>Pima Community College- Community Campus</option>";
				print "<option>Pima Community College- Downtown</option>";
				print "<option>Pima Community College- Northwest</option>";
				print "<option>Pima Community College-Desert Vista</option>";
				print "<option>Pima Community College-East</option>";
				print "<option>Pima Community College-West</option>"; 
				print "<option>Plymouth State University</option>";
				print "<option>Princeton University</option>";
				print "<option>Purdue University</option>";
				print "<option>Rio Salado College</option>"; 
				print "<option>Rochester Institute of Technology</option>";
				print "<option>Rocky Mountain Community College</option>";
				print "<option>Rollins College</option>";
				print "<option>Rutgers University</option>";
				print "<option>San Diego State University</option>";
				print "<option>Savannah State University</option>";
				print "<option>Scottsdale Community College</option>"; 
				print "<option>Seton Hall University</option>";
				print "<option>Sheridan College</option>";
				print "<option>South Dakota State University</option>";
				print "<option>South Mountain Community College</option>";
				print "<option>Southern New Hampshire University</option>";
				print "<option>Southern Utah University</option>";
				print "<option>Southwest Minnesota State University</option>";
				print "<option>Towson University</option>";
				print "<option>Tucsculum College</option>";
				print "<option>Tulane University</option>";
				print "<option>University of Alabama</option>";
				print "<option>University of Alaska - Anchorage</option>";
				print "<option>University of Arizona</option>";
				print "<option>University of Arkansas</option>";
				print "<option>University of Baltimore</option>";
				print "<option>University of California - Los Angeles</option>";
				print "<option>University of California - San Diego</option>";
				print "<option>University of Central Arkansas</option>";
				print "<option>University of Central Missouri</option>";
				print "<option>University of Colorado</option>";
				print "<option>University of Connecticut</option>";
				print "<option>University of Dayton</option>";
				print "<option>University of Delaware</option>";
				print "<option>University of Florida</option>";
				print "<option>University of Georgia</option>";
				print "<option>University of Hartford</option>";
				print "<option>University of Idaho</option>";
				print "<option>University of Indiana</option>";
				print "<option>University of Kansas</option>";
				print "<option>University of Kentucky</option>";
				print "<option>University of Maine</option>";
				print "<option>University of Maryland</option>";
				print "<option>University of Massachusetts</option>";
				print "<option>University of Michigan</option>";
				print "<option>University of Minnesota</option>";
				print "<option>University of Missouri</option>";
				print "<option>University of Montana</option>";
				print "<option>University of Nevada - Las Vegas</option>";
				print "<option>University of New Hampshire</option>";
				print "<option>University of New Mexico</option>";
				print "<option>University of North Dakota</option>";
				print "<option>University of Nova Southern</option>";
				print "<option>University of Oklahoma</option>";
				print "<option>University of Oregon</option>";
				print "<option>University of Pennsylvania</option>";
				print "<option>University of Portland</option>";
				print "<option>University of Rhode Island</option>";
				print "<option>University of San Diego</option>";
				print "<option>University of South Carolina</option>";
				print "<option>University of South Dakota</option>";
				print "<option>University of Southern Maine</option>";
				print "<option>University of Southern Mississippi</option>";
				print "<option>University of Tennessee</option>";
				print "<option>University of Texas - Austin</option>";
				print "<option>University of the Pacific</option>";
				print "<option>University of Vermont</option>";
				print "<option>University of Virginia</option>";
				print "<option>University of Washington</option>";
				print "<option>University of West Virginia</option>";
				print "<option>University of Wisconsin - Madison</option>";
				print "<option>University of Wisconsin - Milwaukee</option>";
				print "<option>Utah Valley State</option>";
				print "<option>Virginia Commonwealth University</option>";
				print "<option>Virginia State University</option>";
				print "<option>Weber State University</option>";
				print "<option>West Virginia State University</option>";
				print "<option>Wisconsin Lutheran College</option>";
				print "<option>Wright State University</option>";
				print "<option>Yale University</option>";
				print "<option>Yavapai College</option>";
				print "<option>York College of Pennsylvania</option>";
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"30px\">";
				print "<td width=\"150px\">";
				print "If your school was not listed above, what school are you associated with?";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"schoolMan" . $i . "\">";
				print "</td>";
				print "</tr>";
				
				print "<tr>";
				print "<td>";
				print "Are you an International Student?";
				print "</td>";
				print "<td>";
				print "<select name=\"Intl" . $i . "\">";
				print "<option name=\"No\">No</option>";
				print "<option name=\"Yes\">Yes</option>";
				print "</select>";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "If so, what country/countries are you from?";
				print "</td>";
				print "<td>";
				print "<input  type=\"text\" maxlength=\"40\" size=\"20\" name=\"IntlCountry" . $i . "\" />";
				print "</td>";
				print "</tr>";
				
				print "<tr height=\"40px\">";
				print "<td width=\"150px\">";
				print "What type of organization are you affiliated with?";
				print "</td>";
				print "<td>";
				
				print "<select name=\"StuOrg" . $i . "\">";
				print "<option name=\"StuGov\">Student Government</option>";
				print "<option name=\"StuClub\">Student Club</option>";
				print "<option name=\"FratSor\">Fraternity/Sorority</option>";
				print "<option name=\"Hon\">Honorary</option>";
				print "<option name=\"Sports\">Sports Club</option>";
				print "<option name=\"ResHall\">Residents Hall</option>";
				print "<option name=\"Other\">Other</option>";
				print "<option name=\"None\">None</option>";
				print "</select>";
				
				print "</td>";
				print "</tr>";
				
				}
				
			print "</table>";
			print "<input type=\"submit\">";
			}
		}
	/* ------------------- Corrections Check --------------------*/	
	
	}
	
	$error = false;
	
	/* ------------------- End Corrections Check --------------------*/	
	?>
	
	</div>

<?
	include_once("common/page_end.php");
?>