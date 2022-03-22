<?php
	// applicant information
	$fullName = "";

	// all of the personal information fields are required.
	if (!$firstName) {
		$response .= "You must enter a First Name.<br />";
	} else if (!validateName($firstName)) {
		$response .= sprintf("The first name <strong>%s</strong> contains invalid characters.<br />", $firstName);
	} else {
		$fullName = $firstName;
	}

	if (!$lastName) {
		$response .= "You must enter a Last Name.<br />";
	} else if (!validateName($lastName)) {
		$response .= sprintf("The last name <strong>%s</strong> contains invalid characters.<br />", $lastName);
	} else {
		$fullName .= ' ' . $lastName;
	}

	$phoneNumber = "";

	if ((!$area) || (!$prefix) || (!$phone)) {
		$response .= "You must enter a complete phone number.<br />";
	} else if ((!is_numeric($area)) || (!is_numeric($prefix)) || (!is_numeric($phone))) {
		$response .= sprintf("The phone number <strong>%s-%s-%s</strong> is invalid.<br />", $area, $prefix, $phone);
	} else {
		$phoneNumber = '(' . $area . ') ' . $prefix . '-' . $phone;
	}

	if (!$email) {
		$response .= "You must enter an email address.<br />";
	} else if (!validateEmail($email)) {
		$response .= sprintf("The email address <strong>%s</strong> is invalid.<br />", $email);
	}

?>