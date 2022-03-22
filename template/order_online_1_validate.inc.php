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
	
// organization information
if (!$orgName) {
	$response .= "You must enter a Organization Name.<br />";
} else if (!validateName($orgName)) {
	$response .= sprintf("The organization name <strong>%s</strong> contains invalid characters.<br />", $orgName);
}

if (!$orgAddress) {
	$response .= "You must enter an Organization Address.<br />";
} else if (!validateAddress($orgAddress)) {
	$response .= sprintf("The organization address <strong>%s</strong> contains invalid characters.<br />", $orgAddress);
}

if (!$orgCountry) {
	$response .= "You must enter a Organization Country.<br />";
}

if (!$orgCity) {
	$response .= "You must enter a Organization City.<br />";
} else if (!validateName($orgCity)) {
	$response .= sprintf("The organization city <strong>%s</strong> contains invalid characters.<br />", $orgCity);
}

if (!$orgCountry) {
	$response .= "You must select a Organization Country.<br />";
}

if ($orgCountry == "United States") {

	if (!$orgState) {
		$response .= "You must select a Organization State.<br />";
	}

	$orgZipcode = "";

	if (!is_numeric($orgZip1)) {
		$response .= sprintf("The 5-digit Organization Zipcode <strong>%s</strong> is invalid.<br />", $orgZip1);
	} else {
		$orgZipcode = $orgZip1;
	}

	// zip extension is optional
	if ($orgZip2) {
		if (!is_numeric($orgZip2)) {
			$response .= sprintf("The 4-digit Organziation Zipcode extension <strong>%s</strong> is invalid.<br />", $orgZip2);
		} else {
			$orgZipcode .= '-' . $orgZip2;
		}
	}
} else {
	if (!$orgProvince) {
		$response .= "You must enter a Organization State/Province.<br />";
	} else if (!validateName($orgProvince)) {
		$response .= sprintf("The organization state/province <strong>%s</strong> contains invalid characters.<br />", $orgProvince);
	}

	if (!$orgPostalCode) {
		$response .= "You must enter a Organization Postal Code.<br />";
	}
}

$orgPhoneNumber = "";

if ((!is_numeric($orgArea)) || (!is_numeric($orgPrefix)) || (!is_numeric($orgPhone))) {
	$response .= sprintf("The Organization Phone number <strong>%s-%s-%s</strong> is invalid.<br />", $orgArea, $orgPrefix, $orgPhone);
} else {
	$orgPhoneNumber = '(' . $orgArea . ') ' . $orgPrefix . '-' . $orgPhone;
}

if($affiliation)
{
	if (($affiliation != "univDept") && ($affiliation != "thirdParty") && ($affiliation != "assn") && ($affiliation != "corp") && ($affiliation != "other"))
	{
		$_POST['affiliation'] = "other";
		$affiliation = "other";
	}
}

if($affiliation == "other")
{
	if (!other)
	{
		$response .= 'If you select an affiliation of "Other," you must specify what that is.<br />';
	}
}
?>