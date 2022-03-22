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

if (!$address) {
	$response .= "You must enter an Organization Address.<br />";
} else if (!validateAddress($address)) {
	$response .= sprintf("The Address <strong>%s</strong> contains invalid characters.<br />", $address);
}

if (!$country) {
	$response .= "You must enter a Organization Country.<br />";
}

if (!$city) {
	$response .= "You must enter a City.<br />";
} else if (!validateName($city)) {
	$response .= sprintf("The City <strong>%s</strong> contains invalid characters.<br />", $city);
}

if (!$country) {
	$response .= "You must select a Country.<br />";
}

if ($country == "United States") {

	if (!$state) {
		$response .= "You must select a State.<br />";
	}

	$zipcode = "";

	if (!is_numeric($zip1)) {
		$response .= sprintf("The 5-digit Zipcode <strong>%s</strong> is invalid.<br />", $zip1);
	} else {
		$zipcode = $zip1;
	}

	// zip extension is optional
	if ($zip2) {
		if (!is_numeric($zip2)) {
			$response .= sprintf("The 4-digit Zipcode extension <strong>%s</strong> is invalid.<br />", $zip2);
		} else {
			$zipcode .= '-' . $zip2;
		}
	}
} else {
	if (!$province) {
		$response .= "You must enter a Province.<br />";
	} else if (!validateName($province)) {
		$response .= sprintf("The Province <strong>%s</strong> contains invalid characters.<br />", $province);
	}

	if (!$postalCode) {
		$response .= "You must enter a Postal Code.<br />";
	}
}

$phoneNumber = "";

if ((!is_numeric($area)) || (!is_numeric($prefix)) || (!is_numeric($phone))) {
	$response .= sprintf("The Phone number <strong>%s-%s-%s</strong> is invalid.<br />", $area, $prefix, $phone);
} else {
	$phoneNumber = '(' . $area . ') ' . $prefix . '-' . $phone;
}

if (!$brideName) {
	$response .= "You must enter the Bride's Name.<br />";
} else if (!validateName($brideName)) {
	$response .= sprintf("The Bride's Name <strong>%s</strong> contains invalid characters.<br />", $brideName);
} 

if (!$groomName) {
	$response .= "You must enter the Groom's Name.<br />";
} else if (!validateName($groomName)) {
	$response .= sprintf("The Groom's Name <strong>%s</strong> contains invalid characters.<br />", $groomName);
} 
?>