<?php
/*
 * CSIL NCLC Registration
 * Created October, 2009
 */
 
// Force HTTPS
$file = $_SERVER['PHP_SELF'];
if (!isset($_SERVER['HTTPS']))
{
	header('Location: https://www.union.arizona.edu' . $file);
	exit;
}

define('ACCESS', true);
include('include.php');
include('common/page_start.php');
//$_SESSION['test'] = NULL;

// Push post content into session
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$_SESSION = array_merge($_SESSION, $_POST);
}

//
// Attendees
//
if (isset($_POST['add']))
{
	$_SESSION['attendees']++;
}

if (isset($_POST['remove']))
{
	$_SESSION['attendees']--;
}

if (empty($_SESSION['attendees']))
{
	$_SESSION['attendees'] = 1;
}

echo '<script type="text/javascript" src="include.js"></script>';

if (!close_registration())
{
	echo '<a href="javascript:;" onclick="redirect(\'' . $file . '\')">Guest Info</a> |
	<a href="javascript:;" onclick="redirect(\'' . $file . '?p=stay\')">Stay Info</a> |
	<a href="javascript:;" onclick="redirect(\'' . $file . '?p=photo\')">Photo Release</a> |
	<a href="javascript:;" onclick="redirect(\'' . $file . '?p=pay\')">Payment</a>';/* |
	<a href="javascript:;" onclick="redirect(\'' . $file . '?p=destroy\')">End Session</a>';*/
}

/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/
// Registration pages
switch($page)
{
	/*case 'destroy':
		session_destroy();
		redirect($file);
	break;*/
	
	case 'pay':
		// Check close registration
		if (close_registration())
		{
			redirect($file);
		}
		
		// Check if primary contact and guest is set
		if (empty($_SESSION['contact']) || empty($_SESSION['guest']))
		{
			redirect($file);
		}
		/*
		// Check if host is set, if needed
		if (early_registration() && !isset($_SESSION['host']))
		{
			redirect($file . '?p=stay');
		}
		*/
		// Check if photo release is set
		if (!isset($_SESSION['photorelease']))
		{
			redirect($file . '?p=photo');
		}
		
		// Check to send to last page
		if (isset($_POST['back']))
		{
			redirect($file . '?p=photo');
		}
		
		// Account for both form submissions and redirect
		if (isset($_POST['pay']) || isset($_POST['submit']) || isset($_SESSION['paymentID']))
		{
			$code = md5($current_time);
			$cost = $_SESSION['attendees'] * (early_registration() ? 50 : 75);
			$payid = intval($_SESSION['paymentID']);
			
			if ($_SESSION['paytype'] == 'card')
			{
				//
				// Start card processing
				//
				echo '<link rel="stylesheet" href="http://elvis.sunion.arizona.edu:8088/cardtaker/cardtaker.css" type="text/css" />
				<script type="text/javascript" src="http://elvis.sunion.arizona.edu:8088/cardtaker/cardtaker.js"></script>';
				//<a href="javascript:;" onclick="autoCard()">Auto Fill Card Test</a>';
				
				$intial_values = array(
				    'firstName' => $_SESSION['contact']['firstname'],
				    'lastName' => $_SESSION['contact']['lastname'],
				    'address' => $_SESSION['contact']['address1'],
				    'city' => $_SESSION['contact']['city'],
				    'state' => $_SESSION['contact']['state'],
				    'postalCode' => $_SESSION['contact']['zip'],
				    'phoneNumber' => $_SESSION['contact']['phone'],
				    'email' => $_SESSION['contact']['email'],
					'orderAmount' => $cost
				);
				
				$initial_values = array();
				$order_form = new payment_process($initial_values);
				if ($order_form->get_stage() != 'approved')
				{
					$order_form->set_total($cost);
				    $order_form->require_contact(TRUE);
				    $order_form->show_contact(TRUE);
				    $order_form->display_form();
				}
				else
				{
					//
					// Database querying
					//
					if (!isset($_SESSION['contact']['attend']))
					{
						$firstname = clean_string($_SESSION['contact']['firstname']);
						$lastname = clean_string($_SESSION['contact']['lastname']);
						$school = intval($_SESSION['contact']['school']);
						$schooletc = clean_string($_SESSION['contact']['schooletc']);
						$organization = intval($_SESSION['contact']['organization']);
						$email = clean_string($_SESSION['contact']['email']);
						$phone = clean_string($_SESSION['contact']['phone']);
						$address1 = clean_string($_SESSION['contact']['address1']);
						$address2 = clean_string($_SESSION['contact']['address2']);
						$city = clean_string($_SESSION['contact']['city']);
						$state = clean_string($_SESSION['contact']['state']);
						$zip = clean_string($_SESSION['contact']['zip']);
						$host = clean_string($_SESSION['host']);
						$paytype = clean_string($_SESSION['paytype']);
						
						$sql = "INSERT INTO guests (code, time, firstname, lastname, school, schooletc, organization, email, phone, address1, address2, city, state, zip, attend, primary_contact, host, cost, paid, paytype, payid)
								VALUES ('$code', $current_time, '$firstname', '$lastname', $school, '$schooletc', $organization, '$email', '$phone', '$address1', '$address2', '$city', '$state', '$zip', 0, 1, '$host', $cost, 1, '$paytype', $payid)";
						mysql_query($sql) or die('Primary contact error: ' . mysql_error());
					}
					
					foreach ($_SESSION['guest'] as $i => $guest)
					{
						$firstname = clean_string($guest['firstname']);
						$lastname = clean_string($guest['lastname']);
						$age = intval($guest['age']);
						$gender = intval($guest['gender']);
						$class = intval($guest['class']);
						$meal = intval($guest['meal']);
						$mealetc = clean_string($guest['mealetc']);
						$sandwich = intval($guest['sandwich']);
						$shirt = (early_registration()) ? intval($guest['shirt']) : -1;
						$school = intval($guest['school']);
						$schooletc = clean_string($guest['schooletc']);
						$international = intval($guest['international']);
						$country = clean_string($guest['country']);
						$organization = intval($guest['organization']);
						$email = clean_string($guest['email']);
						$phone = clean_string($guest['phone']);
						$address1 = clean_string($guest['address1']);
						$address2 = clean_string($guest['address2']);
						$city = clean_string($guest['city']);
						$state = clean_string($guest['state']);
						$zip = clean_string($guest['zip']);
						
						$primary_fields = '';
						$primary_values = '';
						if (isset($_SESSION['contact']['attend']) && $i == 1)
						{
							$host = clean_string($_SESSION['host']);
							$paytype = clean_string($_SESSION['paytype']);
							$primary_fields = ', primary_contact, host, cost, paytype';
							$primary_values = ", 1, '$host', $cost, '$paytype'";
						}
						
						$sql = "INSERT INTO guests (code, time, firstname, lastname, age, gender, class, meal, mealetc, sandwich, shirt, school, schooletc, international, country, organization, email, phone, address1, address2, city, state, zip, paid, payid{$primary_fields})
								VALUES ('$code', $current_time, '$firstname', '$lastname', $age, $gender, $class, $meal, '$mealetc', $sandwich, $shirt, $school, '$schooletc', $international, '$country', $organization, '$email', '$phone', '$address1', '$address2', '$city', '$state', '$zip', 1, $payid{$primary_values})";
						mysql_query($sql) or die('Guest error: ' . mysql_error());
					}
				
					// Send email
					$message = file_get_contents('email/summary.txt');
					$message = str_replace('{NAME}', $_SESSION['contact']['firstname'] . ' ' . $_SESSION['contact']['lastname'], $message);
					$message = str_replace('{MESSAGE}', "Total: \$$cost\nOrder ID: $code\n\n" . prep_email(), $message);
					mail($_SESSION['contact']['email'], 'NCLC Registration Summary', $message, 'From: NCLC Registration <noreply@union.arizona.edu');
					
					//
					// Display thank you
					//
					echo '<h3>Thank you!</h3>
					We look forward to seeing you at the conference!';
					session_destroy();
				}
			}
			else
			{
				//
				// Database querying
				//
				if (!isset($_SESSION['contact']['attend']))
				{
					$firstname = clean_string($_SESSION['contact']['firstname']);
					$lastname = clean_string($_SESSION['contact']['lastname']);
					$school = intval($_SESSION['contact']['school']);
					$schooletc = clean_string($_SESSION['contact']['schooletc']);
					$organization = intval($_SESSION['contact']['organization']);
					$email = clean_string($_SESSION['contact']['email']);
					$phone = clean_string($_SESSION['contact']['phone']);
					$address1 = clean_string($_SESSION['contact']['address1']);
					$address2 = clean_string($_SESSION['contact']['address2']);
					$city = clean_string($_SESSION['contact']['city']);
					$state = clean_string($_SESSION['contact']['state']);
					$zip = clean_string($_SESSION['contact']['zip']);
					$host = clean_string($_SESSION['host']);
					$paytype = clean_string($_SESSION['paytype']);
					
					$sql = "INSERT INTO guests (code, time, firstname, lastname, school, schooletc, organization, email, phone, address1, address2, city, state, zip, attend, primary_contact, host, cost, paytype)
							VALUES ('$code', $current_time, '$firstname', '$lastname', $school, '$schooletc', $organization, '$email', '$phone', '$address1', '$address2', '$city', '$state', '$zip', 0, 1, '$host', $cost, '$paytype')";
					mysql_query($sql) or die('Primary contact error: ' . mysql_error());
				}
				
				foreach ($_SESSION['guest'] as $i => $guest)
				{
					$firstname = clean_string($guest['firstname']);
					$lastname = clean_string($guest['lastname']);
					$age = intval($guest['age']);
					$gender = intval($guest['gender']);
					$class = intval($guest['class']);
					$meal = intval($guest['meal']);
					$mealetc = clean_string($guest['mealetc']);
					$sandwich = intval($guest['sandwich']);
					$shirt = (early_registration()) ? intval($guest['shirt']) : -1;
					$school = intval($guest['school']);
					$schooletc = clean_string($guest['schooletc']);
					$international = intval($guest['international']);
					$country = clean_string($guest['country']);
					$organization = intval($guest['organization']);
					$email = clean_string($guest['email']);
					$phone = clean_string($guest['phone']);
					$address1 = clean_string($guest['address1']);
					$address2 = clean_string($guest['address2']);
					$city = clean_string($guest['city']);
					$state = clean_string($guest['state']);
					$zip = clean_string($guest['zip']);
					
					$primary_fields = '';
					$primary_values = '';
					if (isset($_SESSION['contact']['attend']) && $i == 1)
					{
						$host = clean_string($_SESSION['host']);
						$paytype = clean_string($_SESSION['paytype']);
						$primary_fields = ', primary_contact, host, cost, paytype';
						$primary_values = ", 1, '$host', $cost, '$paytype'";
					}
					
					$sql = "INSERT INTO guests (code, time, firstname, lastname, age, gender, class, meal, mealetc, sandwich, shirt, school, schooletc, international, country, organization, email, phone, address1, address2, city, state, zip{$primary_fields})
							VALUES ('$code', $current_time, '$firstname', '$lastname', $age, $gender, $class, $meal, '$mealetc', $sandwich, $shirt, $school, '$schooletc', $international, '$country', $organization, '$email', '$phone', '$address1', '$address2', '$city', '$state', '$zip'{$primary_values})";
					mysql_query($sql) or die('Guest error: ' . mysql_error());
				}
				
				// Send email
				$message = file_get_contents('email/summary.txt');
				$message = str_replace('{NAME}', $_SESSION['contact']['firstname'] . ' ' . $_SESSION['contact']['lastname'], $message);
				$message = str_replace('{MESSAGE}', "Total: \$$cost\nOrder ID: $code\n\n" . prep_email(), $message);
				mail($_SESSION['contact']['email'], 'NCLC Registration Summary', $message, 'From: NCLC Registration <noreply@union.arizona.edu');
				
				//
				// Display print page
				//
				echo '<h3>Print This Page </h3>

				<p />We have stored your information in our database and look forward to receiving your payment. Your registration will not be processed until we receive your payment and a copy of the summary page. A confirmation e-mail will be sent to the primary registrant\'s e-mail address to confirm that payment has been received.
				
				<p /><h4>Primary Contact</h4>
				Name: ' . $_SESSION['contact']['firstname'] . ' ' . $_SESSION['contact']['lastname'] . '
				<br />School: ' . $schools[$_SESSION['contact']['school']] . ' ' . $_SESSION['contact']['schooletc'] . '
				<br />Cost: $' . $cost . '
				<br />Order ID: ' . $code . '
				
				<p /><h4>Payments</h4>
				Registrations postmarked between January 19, 2011 and February 4, 2011 will be charged $75 per person. Registrations postmarked after February 4, 2011 will not be processed. 
				
				<p />Checks must be received by the final day of registration, February 4, 2011, or registration will be cancelled.
				Please mail a copy of your registration summary and payment to: 
				<blockquote>
				National Collegiate Leadership Conference
				<br />Center for Student Involvement and Leadership
				<br />Arizona Student Unions
				<br />PO Box 210017
				<br />Tucson, Arizona 85721-0017
				</blockquote>
				
				<h4>Questions</h4>
				If you have any questions please contact our office by phone at 520-626-1572) or by e-mail at nclc@email.arizona.edu.
				
				<p /><h4>Requesting Special Services</h4>
				We are committed to providing a fully inclusive experience. If you would like to discuss anticipated accommodation needs, please contact our Facilities Chair, Colleen Carlotto at nclc@email.arizona.edu.
				
				<p /><h4>Cost and Refund Policy</h4>
				The registration fee for the National Collegiate Leadership Conference includes all conference materials, three days of programming and dinner on Friday and Saturday evening, and a conference t-shirt for those who register prior to January 19, 2011. The fee does not include lodging or transportation. After January 19, 2011, the registration fee will increase to $75 per person and t-shirts will not be provided for participants who register after this date. Requests for refunds must be made in writing and are subject to a 25% administrative fee. Refund Requests must be received no later than January 19, 2011.';
			}
		}
		else
		{
			echo '<h3>Payment Type</h3>
			<form name="reg" method="post">
			<select name="paytype">';
			foreach ($paytypes as $key => $value)
			{
				echo "<option value=\"$key\">$value</option>\n";
				//echo "<option value=\"card\">Credit Card</option>\n";
			}
 			echo '</select>
		
			<p /><input type="submit" name="back" value="Back"> <input type="submit" name="pay" value="Next">
			</form>';
		}
	break;
	
	case 'photo':
		// Check close registration
		if (close_registration())
		{
			redirect($file);
		}
		
		// Brought by Cybersource
		if (!empty($_SESSION['contact']) && !empty($_SESSION['guest']) && isset($_SESSION['paymentID']))
		{
			redirect($file . '?p=pay');
		}
		
		// Check if primary contact and guest is set
		if (empty($_SESSION['contact']) || empty($_SESSION['guest']))
		{
			redirect($file);
		}
		/*
		// Check if host is set, if needed
		if (early_registration() && !isset($_SESSION['host']))
		{
			redirect($file . '?p=stay');
		}
		*/
		// Check to send to last page
		if (isset($_POST['back']))
		{
			redirect($file . '?p=stay');
		}
		
		// Check main form submission
		if (isset($_POST['photo']))
		{
			if (!isset($_SESSION['photorelease']))
			{
				$errors[] = 'Registration cannot be completed until the terms of the photo release are agreed to';
			}
			
			if (empty($errors))
			{
				redirect($file . '?p=pay');
			}
		}
		
		print_errors($errors);
		
		$checked_photo = (isset($_SESSION['photorelease'])) ? ' checked="checked"' : '';
		echo '<h3>Photo Release:</h3>
		<p>I understand that upon check in to the National Collegiate Leadership Conference, it is my responsibility to ensure that all of the members of my group (including myself) sign a photo release form prior to attending any workshops or conference events.</p>
		
		<form name="reg" method="post">
		<input type="checkbox" name="photorelease"' . $checked_photo . '> I Understand<br />
		<p /><input type="submit" name="back" value="Back"> <input type="submit" name="photo" value="Next">
		</form>';
	break;
	
	case 'stay':
		// Check close registration
		if (close_registration())
		{
			redirect($file);
		}
		
		// Brought by Cybersource
		if (!empty($_SESSION['contact']) && !empty($_SESSION['guest']) && isset($_SESSION['paymentID']))
		{
			redirect($file . '?p=pay');
		}
		
		// Check if primary contact and guest is set
		if (empty($_SESSION['contact']) || empty($_SESSION['guest']))
		{
			redirect($file);
		}
		
		// Check to send to last page
		if (isset($_POST['back']))
		{
			redirect($file . '?p=confirm');
		}
		
		// Check main form submission
		if (isset($_POST['stay']))
		{
			/*
			if (early_registration() && !isset($_SESSION['host']))
			{
				$errors[] = 'Please select an option for hosting';
			}
			*/
			if (empty($errors))
			{
				redirect($file . '?p=photo');
			}
		}
		
		echo '<h3>Hotel Information</h3>
		If you are coming from outside of Tucson, visit our website www.union.arizona.edu/nclc for information on hotels near the University of Arizona. Remember to reserve hotel rooms as soon as possible to take advantage of any special discount prices that are offered specifically for Conference participants.
		
		<form name="reg" method="post">';
		/*
		if (early_registration())
		{
			echo '<h3>Hosting Information</h3>';
			
			print_errors($errors);
			
			$checked_resident = ($_SESSION['host'] == 'resident') ? ' checked="checked"' : '';
			$checked_nonresident = ($_SESSION['host'] == 'nonresident') ? ' checked="checked"' : '';
			$checked_nointerest = ($_SESSION['host'] == 'nointerest') ? ' checked="checked"' : '';
			echo 'A host is a Tucson resident who can provide free housing accommodations for one or more conference participants who are traveling from outside the Tucson area. Hosts are not required to provide food or transportation to and from the conference. Hosting is not guaranteed as all of our hosts are volunteers.
			
			<p /><input type="radio" name="host" value="resident"' . $checked_resident . '> I am a Tucson resident who would like to be a host for an out-of-town Conference participant. 
			<br /><input type="radio" name="host" value="nonresident"' . $checked_nonresident . '> I am coming to the Conference from outside of Tucson and would like to stay with a host during the conference
			<br /><input type="radio" name="host" value="nointerest"' . $checked_nointerest . '> I am not interested in participating in the hosting program';
		}
		*/
		echo '<p /><input type="submit" name="back" value="Back"> <input type="submit" name="stay" value="Next">
		</form>';
	break;
	
	case 'confirm':
		// Check close registration
		if (close_registration())
		{
			redirect($file);
		}
		
		// Brought by Cybersource
		if (!empty($_SESSION['contact']) && !empty($_SESSION['guest']) && isset($_SESSION['paymentID']))
		{
			redirect($file . '?p=pay');
		}
		
		// Check if primary contact and guest is set
		if (empty($_SESSION['contact']) || empty($_SESSION['guest']))
		{
			redirect($file);
		}
		
		// Check to send to last page
		if (isset($_POST['back']))
		{
			redirect($file);
		}
		
		// Check main form submission
		if (isset($_POST['confirm']))
		{
			redirect($file . '?p=stay');
		}
		
		// Primary contact
		echo '<h3>Confirm Information</h3>
		
		<h4>Primary Contact Information</h4>
		<hr /><table width="100%" cellpadding="5" cellspacing="3" border="0">
		<tr>
		  <td width="20%" align="right"><strong>First Name</strong></td>
		  <td>' . $_SESSION['contact']['firstname'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>Last Name</strong></td>
		  <td>' . $_SESSION['contact']['lastname'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>School</strong></td>
		  <td>' . $schools[$_SESSION['contact']['school']] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>School Other</strong></td>
		  <td>' . $_SESSION['contact']['schooletc'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>Organizaiton</strong></td>
		  <td>' . $organizations[$_SESSION['contact']['organization']] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>Email address</strong></td>
		  <td>' . $_SESSION['contact']['email'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>Daytime Phone</strong></td>
		  <td>' . $_SESSION['contact']['phone'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>Address Line 1</strong></td>
		  <td>' . $_SESSION['contact']['address1'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>Address Line 2</strong></td>
		  <td>' . $_SESSION['contact']['address2'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>City</strong></td>
		  <td>' . $_SESSION['contact']['city'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>State</strong></td>
		  <td>' . $_SESSION['contact']['state'] . '</td>
		</tr>
		<tr>
		  <td align="right"><strong>ZIP</strong></td>
		  <td>' . $_SESSION['contact']['zip'] . '</td>
		</tr>
		</table>
		<hr />';
		
		// Attendees
		for ($i = 1; $i <= $_SESSION['attendees']; $i++)
		{
			echo '<h4>Attendee ' . $i . ' Information</h4>
			<hr /><table width="100%" cellpadding="5" cellspacing="0" border="0">
			<tr>
			  <td width="20%" align="right"><strong>First Name</strong></td>
			  <td>' . $_SESSION['guest'][$i]['firstname'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Last Name</strong></td>
			  <td>' . $_SESSION['guest'][$i]['lastname'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Age</strong></td>
			  <td>' . $_SESSION['guest'][$i]['age'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Gender</strong></td>
			  <td>' . $genders[$_SESSION['guest'][$i]['gender']] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Attendee Type</strong></td>
			  <td>' . $classes[$_SESSION['guest'][$i]['class']] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Meal Type</strong></td>
			  <td>' . $meals[$_SESSION['guest'][$i]['meal']] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Meal Type Specifics</td>
			  <td>' . $_SESSION['guest'][$i]['mealetc'] . '</td>
			</tr>';
			if (early_registration())
			{
				echo '<tr>
				  <td align="right"><strong>T-Shirt Size</strong></td>
				  <td>' . $shirts[$_SESSION['guest'][$i]['shirt']] . '</td>
				</tr>';
			}
			echo '<tr>
			  <td align="right"><strong>Sandwich Type</strong></td>
			  <td>' . $sandwiches[$_SESSION['guest'][$i]['sandwich']] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>School</strong></td>
			  <td>' . $schools[$_SESSION['guest'][$i]['school']] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>School Other</strong></td>
			  <td>' . $_SESSION['guest'][$i]['schooletc'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>International</strong></td>
			  <td>' . $options[$_SESSION['guest'][$i]['international']] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Country (If International)</strong></td>
			  <td>' . $_SESSION['guest'][$i]['country'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Organization</strong></td>
			  <td>' . $organizations[$_SESSION['guest'][$i]['organization']] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Email address</strong></td>
			  <td>' . $_SESSION['guest'][$i]['email'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Daytime Phone</strong></td>
			  <td>' . $_SESSION['guest'][$i]['phone'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Address Line 1</strong></td>
			  <td>' . $_SESSION['guest'][$i]['address1'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>Address Line 2</strong></td>
			  <td>' . $_SESSION['guest'][$i]['address2'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>City</strong></td>
			  <td>' . $_SESSION['guest'][$i]['city'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>State</strong></td>
			  <td>' . $_SESSION['guest'][$i]['state'] . '</td>
			</tr>
			<tr>
			  <td align="right"><strong>ZIP</strong></td>
			  <td>' . $_SESSION['guest'][$i]['zip'] . '</td>
			</tr>
			</table>
			<hr />';
		}
		
		echo '<form name="reg" method="post"><input type="submit" name="back" value="Back"> <input type="submit" name="confirm" value="Next"></form>';
	break;
	
	default:
		// Brought by Cybersource
		if (!empty($_SESSION['contact']) && !empty($_SESSION['guest']) && isset($_SESSION['paymentID']))
		{
			redirect($file . '?p=pay');
		}
		
		// Check close registration
		if ($current_time > $close_registration)
		{
			echo '<p>The registration peiord for the National Collegiate Leadership Conference has concluded.';
		}
		elseif (global_total() > $conference_limit)
		{
			echo '<p>Thank you for your interest in the National Collegiate Leadership Conference. For the 2011 conference, we have reached our registration capacity of 600 people. We regret that we are not able to accept any additional registrations at this time. Early registration for NCLC 2011 will begin in November of this year.<p>If you have any questions or concerns, please contact Tom Murray at tam@email.arizona.edu or 520-621-8065.';
		}
		else
		{
			echo '<h3>Guest Information</h3>';
			
			if (isset($_POST['info']))
			{
				// Check primary contact
				if (empty($_SESSION['contact']['firstname']))
				{
					$errors[] = 'Please enter a firstname for the primary contact';
				}
				
				if (empty($_SESSION['contact']['lastname']))
				{
					$errors[] = 'Please enter a lastname for the primary contact';
				}
				
				if (($_SESSION['contact']['school'] == -1 || $_SESSION['contact'][$i]['school'] == -2) && empty($_SESSION['contact'][$i]['schooletc']))
				{
					$errors[] = 'Please select or enter a school for the primary contact';
				}
				
				if ($_SESSION['contact']['organization'] == -1)
				{
					$errors[] = 'Please enter an organization for the primary contact';
				}
				
				if (empty($_SESSION['contact']['email']))
				{
					$errors[] = 'Please enter an email for the primary contact';
				}
				
				if (empty($_SESSION['contact']['phone']))
				{
					$errors[] = 'Please enter a phone number for the primary contact';
				}
				
				if (empty($_SESSION['contact']['address1']))
				{
					$errors[] = 'Please enter an address for the primary contact';
				}
				
				if (empty($_SESSION['contact']['city']))
				{
					$errors[] = 'Please enter a city for the primary contact';
				}
				
				if (empty($_SESSION['contact']['state']))
				{
					$errors[] = 'Please enter a state for the primary contact';
				}
				
				if (empty($_SESSION['contact']['zip']))
				{
					$errors[] = 'Please enter a zip code for the primary contact';
				}
				
				// Check attendees
				for ($i = 1; $i <= $_SESSION['attendees']; $i++)
				{
					if (empty($_SESSION['guest'][$i]['firstname']))
					{
						$errors[] = 'Please enter a firstname for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['lastname']))
					{
						$errors[] = 'Please enter a lastname for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['age']))
					{
						$errors[] = 'Please enter a age for guest ' . $i;
					}
					
					if ($_SESSION['guest'][$i]['sandwich'] == -1)
					{
						$errors[] = 'Please select a sandwich type for guest ' . $i;
					}
					
					if (early_registration() && $_SESSION['guest'][$i]['shirt'] == -1)
					{
						$errors[] = 'Please select a T-shirt size for guest ' . $i;
					}
					
					if (($_SESSION['guest'][$i]['school'] == -1 || $_SESSION['guest'][$i]['school'] == -2) && empty($_SESSION['guest'][$i]['schooletc']))
					{
						$errors[] = 'Please select or enter a school for guest ' . $i;
					}
					
					if ($_SESSION['guest'][$i]['international'] == 1 && empty($_SESSION['guest'][$i]['country']))
					{
						$errors[] = 'Please enter a country for guest ' . $i;
					}
					
					if ($_SESSION['guest'][$i]['organization'] == -1)
					{
						$errors[] = 'Please enter an organization for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['email']))
					{
						$errors[] = 'Please enter an email for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['phone']))
					{
						$errors[] = 'Please enter a phone number for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['address1']))
					{
						$errors[] = 'Please enter an address for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['city']))
					{
						$errors[] = 'Please enter a city for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['state']))
					{
						$errors[] = 'Please enter a state for guest ' . $i;
					}
					
					if (empty($_SESSION['guest'][$i]['zip']))
					{
						$errors[] = 'Please enter a zip code for guest ' . $i;
					}
				}
				
				if (empty($errors))
				{
					redirect($file . '?p=confirm');
				}
			}
			
			print_errors($errors);
			
			echo '<form name="reg" method="post">
			<div align="right">' . $_SESSION['attendees'] . ' Guest(s)
			  <input type="submit" name="add" value="Add Attendee">
			  <input type="submit" name="remove" value="Remove Attendee">
			</div>';
			//<a href="javascript:;" onclick="autoTest()">Auto Fill Test</a>';
			
			// Primary contact
			$checked_primary = (isset($_SESSION['contact']['attend'])) ? ' checked="checked"' : '';
			echo '<h4>Primary Contact Information</h4>
			<hr /><table cellpadding="5" cellspacing="3" border="0">
			<tr>
			  <td width="30%">First Name</td>
			  <td><input type="text" name="contact[firstname]" value="' . $_SESSION['contact']['firstname'] . '"></td>
			</tr>
			<tr>
			  <td>Last Name</td>
			  <td><input type="text" name="contact[lastname]" value="' . $_SESSION['contact']['lastname'] . '"></td>
			</tr>
			<tr>
			  <td>Which participating school are you affiliated with?</td>
			  <td><select name="contact[school]"><option value="-1">-select-</option>';
			foreach ($schools as $key => $value)
			{
				$selected = (!empty($_SESSION['contact']) && $_SESSION['contact']['school'] == $key) ? 'selected="selected"' : '';
				echo "<option value=\"$key\" $selected>$value</option>";
			}
			echo '<option value="-2">Other</option></select></td>
			</tr>
			<tr>
			  <td>If your school was not listed above, what school are you associated with?</td>
			  <td><input type="text" name="contact[schooletc]" value="' . $_SESSION['contact']['schooletc'] . '"></td>
			</tr>
			<tr>
			  <td>What Type of organization are you affiliated with?</td>
			  <td><select name="contact[organization]"><option value="-1">-select-</option>';
			foreach ($organizations as $key => $value)
			{
				$selected = (!empty($_SESSION['contact']) && $_SESSION['contact']['organization'] == $key) ? 'selected="selected"' : '';
				echo "<option value=\"$key\" $selected>$value</option>";
			}
			echo '</select></td>
			</tr>
			<tr>
			  <td>Email address</td>
			  <td><input type="text" name="contact[email]" value="' . $_SESSION['contact']['email'] . '"></td>
			</tr>
			<tr>
			  <td>Daytime Phone</td>
			  <td><input type="text" name="contact[phone]" value="' . $_SESSION['contact']['phone'] . '" size="12"></td>
			</tr>
			<tr>
			  <td>Address Line 1</td>
			  <td><input type="text" name="contact[address1]" value="' . $_SESSION['contact']['address1'] . '" size="40"></td>
			</tr>
			<tr>
			  <td>Address Line 2</td>
			  <td><input type="text" name="contact[address2]" value="' . $_SESSION['contact']['address2'] . '" size="40"></td>
			</tr>
			<tr>
			  <td>City</td>
			  <td><input type="text" name="contact[city]" value="' . $_SESSION['contact']['city'] . '"></td>
			</tr>
			<tr>
			  <td>State</td>
			  <td><input type="text" name="contact[state]" value="' . $_SESSION['contact']['state'] . '"></td>
			</tr>
			<tr>
			  <td>ZIP</td>
			  <td><input type="text" name="contact[zip]" value="' . $_SESSION['contact']['zip'] . '" size="8"></td>
			</tr>
			<tr>
			  <td>Is this person attending the conference?</td>
			  <td><input type="checkbox" name="contact[attend]" onclick="primaryGuest(this)"' . $checked_primary . '></td>
			</tr>
			</table>
			<hr />';
			
			// Attendees
			for ($i = 1; $i <= $_SESSION['attendees']; $i++)
			{
				echo '<h4>Attendee ' . $i . ' Information</h4>
				<hr /><table cellpadding="5" cellspacing="3" border="0">
				<tr>
				  <td width="30%">First Name</td>
				  <td><input type="text" name="guest[' . $i . '][firstname]" value="' . $_SESSION['guest'][$i]['firstname'] . '"></td>
				</tr>
				<tr>
				  <td>Last Name</td>
				  <td><input type="text" name="guest[' . $i . '][lastname]" value="' . $_SESSION['guest'][$i]['lastname'] . '"></td>
				</tr>
				<tr>
				  <td>Age</td>
				  <td><input type="text" name="guest[' . $i . '][age]" value="' . $_SESSION['guest'][$i]['age'] . '" size="3"></td>
				</tr>
				<tr>
				  <td>Gender</td>
				  <td><select name="guest[' . $i . '][gender]">';
				foreach ($genders as $key => $value)
				{
					$selected = ($_SESSION['guest'][$i]['gender'] == $key) ? 'selected="selected"' : '';
					echo "<option value=\"$key\" $selected>$value</option>";
				}
				echo '</select></td>
				</tr>
				<tr>
				  <td>Are you a participating student or advisor?</td>
				  <td><select name="guest[' . $i . '][class]">';
				foreach ($classes as $key => $value)
				{
					$selected = ($_SESSION['guest'][$i]['class'] == $key) ? 'selected="selected"' : '';
					echo "<option value=\"$key\" $selected>$value</option>";
				}
				echo '</select></td>
				</tr>
				<tr>
				  <td>What Meal Type would you prefer for the Keynote Banquet?</td>
				  <td><select name="guest[' . $i . '][meal]">';
				foreach ($meals as $key => $value)
				{
					$selected = ($_SESSION['guest'][$i]['meal'] == $key) ? 'selected="selected"' : '';
					echo "<option value=\"$key\" $selected>$value</option>";
				}
				echo '</select></td>
				</tr>
				<tr>
				  <td>Do you have any additional specific meal requests?</td>
				  <td><input type="text" name="guest[' . $i . '][mealetc]" value="' . $_SESSION['guest'][$i]['mealetc'] . '"></td>
				</tr>
				<tr>
				  <td>What sandwich type would you prefer for the Friday Opening dinner?</td>
				  <td><select name="guest[' . $i . '][sandwich]"><option value="-1">-select-</option>';
				foreach ($sandwiches as $key => $value)
				{
					$selected = (!empty($_SESSION['guest'][$i]) && $_SESSION['guest'][$i]['sandwich'] == $key) ? 'selected="selected"' : '';
					echo "<option value=\"$key\" $selected>$value</option>";
				}
				echo '</select></td>
				</tr>';
				if (early_registration())
				{
					echo '<tr>
					  <td>T-Shirt Size</td>
					  <td><select name="guest[' . $i . '][shirt]"><option value="-1">-select-</option>';
					foreach ($shirts as $key => $value)
					{
						$selected = (!empty($_SESSION['guest'][$i]) && $_SESSION['guest'][$i]['shirt'] == $key) ? 'selected="selected"' : '';
						echo "<option value=\"$key\" $selected>$value</option>";
					}
				}
				echo '</select></td>
				</tr>
				<tr>
				  <td>Which participating school are you affiliated with?</td>
				  <td><select name="guest[' . $i . '][school]"><option value="-1">-select-</option>';
				foreach ($schools as $key => $value)
				{
					$selected = (!empty($_SESSION['guest'][$i]) && $_SESSION['guest'][$i]['school'] == $key) ? 'selected="selected"' : '';
					echo "<option value=\"$key\" $selected>$value</option>";
				}
				echo '<option value="-2">Other</option></select></td>
				</tr>
				<tr>
				  <td>If your school was not listed above, what school are you associated with?</td>
				  <td><input type="text" name="guest[' . $i . '][schooletc]" value="' . $_SESSION['guest'][$i]['schooletc'] . '"></td>
				</tr>
				<tr>
				  <td>Do you consider yourself International?</td>
				  <td><select name="guest[' . $i . '][international]">';
				foreach ($options as $key => $value)
				{
					$selected = ($_SESSION['guest'][$i]['international'] == $key) ? 'selected="selected"' : '';
					echo "<option value=\"$key\" $selected>$value</option>";
				}
				echo '</select></td>
				</tr>
				<tr>
				  <td>If yes, what country/countries are you from</td>
				  <td><input type="text" name="guest[' . $i . '][country]" value="' . $_SESSION['guest'][$i]['country'] . '"></td>
				</tr>
				<tr>
				  <td>What Type of organization are you affiliated with?</td>
				  <td><select name="guest[' . $i . '][organization]"><option value="-1">-select-</option>';
				foreach ($organizations as $key => $value)
				{
					$selected = (!empty($_SESSION['guest'][$i]) && $_SESSION['guest'][$i]['organization'] == $key) ? 'selected="selected"' : '';
					echo "<option value=\"$key\" $selected>$value</option>";
				}
				echo '</select></td>
				</tr>
				<tr>
				  <td>Email address</td>
				  <td><input type="text" name="guest[' . $i . '][email]" value="' . $_SESSION['guest'][$i]['email'] . '"></td>
				</tr>
				<tr>
				  <td>Daytime Phone</td>
				  <td><input type="text" name="guest[' . $i . '][phone]" value="' . $_SESSION['guest'][$i]['phone'] . '" size="12"></td>
				</tr>
				<tr>
				  <td>Address Line 1</td>
				  <td><input type="text" name="guest[' . $i . '][address1]" value="' . $_SESSION['guest'][$i]['address1'] . '" size="40"></td>
				</tr>
				<tr>
				  <td>Address Line 2</td>
				  <td><input type="text" name="guest[' . $i . '][address2]" value="' . $_SESSION['guest'][$i]['address2'] . '" size="40"></td>
				</tr>
				<tr>
				  <td>City</td>
				  <td><input type="text" name="guest[' . $i . '][city]" value="' . $_SESSION['guest'][$i]['city'] . '"></td>
				</tr>
				<tr>
				  <td>State</td>
				  <td><input type="text" name="guest[' . $i . '][state]" value="' . $_SESSION['guest'][$i]['state'] . '"></td>
				</tr>
				<tr>
				  <td>ZIP</td>
				  <td><input type="text" name="guest[' . $i . '][zip]" value="' . $_SESSION['guest'][$i]['zip'] . '" size="8"></td>
				</tr>
				</table>
				<hr />';
			}
			
			echo '<input type="submit" name="save" value="Save"> <input type="submit" name="info" value="Next">
			
			<div align="right">' . $_SESSION['attendees'] . ' Guest(s)
			  <input type="submit" name="add" value="Add Attendee">
			  <input type="submit" name="remove" value="Remove Attendee">
			</div>
			</form>';
		}
	break;
}

echo '</form>';

include('common/page_end.php');
ob_end_flush();
?>
