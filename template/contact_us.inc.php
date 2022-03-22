
<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/field_validation.inc.php');

	// has the form been submitted?
	if (isset($_POST['submit']))
	{
		// remove any html tags from the input
		$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
		$xcomment = filter_var($_POST['xcomment'], FILTER_SANITIZE_STRING);
		$name = strip_tags($_POST['name']);
		$email = strip_tags($_POST['email']);
		$feedback = strip_tags($_POST['feedback']);
		$identity = strip_tags($_POST['identity']);
		$subject = strip_tags($_POST['subject']);
		$other = strip_tags($_POST['other']);
		$contact = strip_tags($_POST['contact']);

		// initialize the response variable
		$response = "";


		// default to az catering
		$emailTo = "SUEventplanning@email.arizona.edu";
		// $emailTo = "su-web@email.arizona.edu";


		// name, comment and email address are required.
		if (!$name)
		{
			$response .= "You must enter a name.<br />";
		}
		// else if(!validateName($name))
		// {
		// 	$response .= sprintf("The name <strong>%s</strong> contains invalid characters.<br />", $name);
		// }

		if (!$feedback)
		{
			$response .= "You must select what type of contact you are making.<br />";
		}

		if ($feedback == "Yes") {
			if (!$identity)
			{
				$response .= "You must select who you are.<br />";
			}
			if (!$subject)
			{
				$response .= "You must select what type of feedback you are giving.<br />";
			} else {
				if (subject == "Other") {
					if (!$other)
					{
						$response .= "You must enter the other value.<br />";
					}
				}
			}
		}

		if (!$comment)
		{
			$response .= "You must enter a comment.<br />";
		}
		else if(!validateComment($comment))
		{
			$response .= sprintf("The comment <strong>%s</strong> contains invalid characters.<br />", $comment);
		}

		// use a function to validate the email address.
		if(!validateEmail($email))
		{
			$response .= sprintf("The email address <strong>%s</strong> is invalid.<br />", $email);
		}
		$header="from: $name <$email>";



		if(substr(php_uname("s"),0,1)=="W"){//running on windows
		 	ini_set(SMTP,"smtpgate.email.arizona.edu");
		}
		$result = 0;
		$allMessage = "<br />Name: ".$name."<br />Email: ".$email;
		if ($feedback == "Yes") {
			$allMessage .= "<br />I would like to submit: Feedback about an event or service.";
			if ($other) {
				$allMessage .= "<br />I am a: ".$other;
			} else {
				$allMessage .= "<br />I am a: ".$identity;
			}
			$allMessage .= "<br />This relates to: ".$subject;
		} else {
			$allMessage .= "<br />I would like to submit: A general inquiry or comment.";
		}

		if ($contact) {
			$allMessage .= "<br />Would you like to be contacted: ".$contact;
		}

		$allMessage .= "<br /><br />Comment:<br />".$comment;

		// if there are no errors and
		// the invisible text field is empty,
		// we send the email.
		if (($response == "") && ($xcomment != ""))
		{
			ini_set('sendmail_from', $email);
  			$email_headers = "Content-type: text/html; charset=iso-8859-1\r\nFrom: ".$email;
			// webmaster@campusrec.arizona.edu
  			// $result=mail( "webmaster@campusrec.arizona.edu", "Rec Center Comments/Questions", $allMessage, $email_headers );
  			$result=mail( $emailTo, "Arizona Catering Company: Comments/Questions: ".$subject, $allMessage, $email_headers );
		}
		
		if ($result)
		{
			// if the form passes validation and the email is sent,
			// we reset the value of all form variables.
			if (isset($_POST['comment']))
			{
				unset($_POST['comment']);
			}
			if (isset($_POST['name']))
			{
				unset($_POST['name']);
			}
			if (isset($_POST['feedback']))
			{
				unset($_POST['feedback']);
			}
			if (isset($_POST['identity']))
			{
				unset($_POST['identity']);
			}
			if (isset($_POST['subject']))
			{
				unset($_POST['subject']);
			}
			if (isset($_POST['contact']))
			{
				unset($_POST['contact']);
			}
			if (isset($_POST['other']))
			{
				unset($_POST['other']);
			}
			if (isset($_POST['email']))
			{
				unset($_POST['email']);
			}
		}
	}

?>
