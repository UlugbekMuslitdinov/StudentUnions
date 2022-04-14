<?php /*_track_vars*/?>
<?php
/***************************************
** Title........: Red Dot From Processor
** Filename.....: red.formproc.php
** Author.......: Richard Heyes
** Version......: 1.5
** Notes........:
** Last changed.: 6/8/2012 (Alex Babis)
** Last change..: Replaced deprecated regex code
****************************************
**
** Customized by Steve Stout sps@u.arizona.edu on March 24, 2001
**  - Added support for $return_link
**
/***************************************
** Variables for you to set.
***************************************/

$security = 1;
$servername = 'union.arizona.edu';
$addhostip = 1;
$email = '';
$recipient = '';
$subject = '';
$redirect = '';
$return_link = '';
$debug = 0;

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

/***************************************
** This is the html code called when a
** required field is not filled out.
***************************************/
function error_required() {

  $page_options['title'] = 'Form Submission Error';
  page_start($page_options);

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Error!</h1>
<p>You seem to have neglected to fill out all of the required fields.</p>
<p>Please click the back button on your browser and go back and make sure you have filled out all fields.</p>

<?php

	page_finish();

}

// Form data cleaning function
function cleanFormData($formData) {
	$formData = trim($formData); // removes leading and trailing spaces
	$formData = strip_tags($formData); // strips HTML style tags

		if(get_magic_quotes_gpc()){ // prevents duplicate backslashes if magic quotes is enabled in php install
			$formData = stripslashes($formData);
		}

	return $formData;
}


/***************************************
** This is the html code called when a
** bad referer is detected.
***************************************/
function error_bad_referer() {

	 $page_options['title'] = 'Form Submission Error';
  page_start($page_options);

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Error!</h1>
<p>You appear to be trying to use this script from an invalid domain. Don't.</p>

<?php

	page_finish();

}


/***************************************
** This is the html code called when an
** invalid email address is entered.
***************************************/
function error_invalid_email() {

	 $page_options['title'] = 'Form Submission Error';
  page_start($page_options);

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Error!</h1>
<p>You entered an invalid email address. Please go back and correct it.</p>

<?php

	page_finish();

}

/***************************************
** This is the html code called when a
** spammer submits a message.
***************************************/
function error_URLs() {

	$page_options['title'] = 'Thank You!';
	page_start($page_options);

	#######################################################################################
	// -------------- BROWSER SNIFF AND SEND INFO FOR FUTURE BLACKLISTING -------------- //
	#######################################################################################
	require_once('phplib/mimemail/htmlMimeMail5.php');

	// BEGIN send Kevin a some browser specs
	$specs = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
	$mail = new htmlMimeMail5();

	//Set the From and Reply-To headers
	$mail->setFrom('Union Spam User<no-reply@email.arizona.edu>');
	$mail->setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail->setSubject('Union - Tell Us Spam');

	//Create the message body.
	$mail->setHTML(
	"<p>A user (<strong style=\"color:#ff0000;\">" . $_POST['email_required'] . "</strong>) tried to send spam on the Union site [<strong style=\"color:#ff0000;\">" . $_SERVER['HTTP_HOST'] . "</strong>]. The attempt was blocked. A summary follows:</p>
	<p style=\"color:#ff0000;\"><strong>Current date/time:</strong><br />" . date("D, M j, Y - g:i:s A", time()) . "</p>
	<p style=\"color:#ff0000;\"><strong>IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>
	<p style=\"color:#ff0000;\"><strong>User Info:</strong><br /><strong>Name:</strong> " . $_POST['name_required'] . "<br /><strong>Affiliation:</strong> " . $_POST['affiliation'] . "<br /><strong>Email:</strong> " . $_POST['email_required'] . "<br /><strong>Area of Concern:</strong> " . $_POST['area_of_concern'] . "<br /><strong>Spammer:</strong> " . $_POST['human'] . "<br /><strong>Comments:</strong> " . $_POST['comments'] . "</p>
	<p style=\"color:#ff0000;\"><strong>Platform/Browser Specs:</strong><br />" . $specs . "</p>");
	$result=$mail->send(array('su-web@email.arizona.edu'));
	// END send Kevin a some browser specs and user info
	###############################################################

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Success!</h1>
<p>Thank you! Your comments have been submitted.</p>

<?php

	page_finish();

}

/***************************************
** This is the html code called when a
** spammer submits a message.
***************************************/
function error_nosubject() {

	$page_options['title'] = 'Thank You!';
	page_start($page_options);

	#######################################################################################
	// -------------- BROWSER SNIFF AND SEND INFO FOR FUTURE BLACKLISTING -------------- //
	#######################################################################################
	require_once('phplib/mimemail/htmlMimeMail5.php');

	// BEGIN send Kevin a some browser specs
	$specs = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
	$mail = new htmlMimeMail5();

	//Set the From and Reply-To headers
	$mail->setFrom('Union Spam User<no-reply@email.arizona.edu>');
	$mail->setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail->setSubject('Union - Tell Us Spam');

	//Create the message body.
	$mail->setHTML(
	"<p>A user (<strong style=\"color:#ff0000;\">" . $_POST['email_required'] . "</strong>) tried to send spam on the Union site [<strong style=\"color:#ff0000;\">" . $_SERVER['HTTP_HOST'] . "</strong>]. The attempt was blocked. A summary follows:</p>
	<p style=\"color:#ff0000;\"><strong>Current date/time:</strong><br />" . date("D, M j, Y - g:i:s A", time()) . "</p>
	<p style=\"color:#ff0000;\"><strong>IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>
	<p style=\"color:#ff0000;\"><strong>User Info:</strong><br /><strong>Name:</strong> " . $_POST['name_required'] . "<br /><strong>Affiliation:</strong> " . $_POST['affiliation'] . "<br /><strong>Email:</strong> " . $_POST['email_required'] . "<br /><strong>Area of Concern:</strong> " . $_POST['area_of_concern'] . "<br /><strong>Spammer:</strong> " . $_POST['human'] . "<br /><strong>Comments:</strong> " . $_POST['comments'] . "</p>
	<p style=\"color:#ff0000;\"><strong>Platform/Browser Specs:</strong><br />" . $specs . "</p>");
	$result=$mail->send(array('su-web@email.arizona.edu'));
	// END send Kevin a some browser specs and user info
	###############################################################

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Success!</h1>
<p>Thank you! Your comments have been submitted.</p>

<?php

	page_finish();

}

/*************************************************
** This is the html code called a spambot submits
** the form and tags the hidden field.
*************************************************/
function error_not_human() {

	$page_options['title'] = 'Thank You!';
	page_start($page_options);

	#######################################################################################
	// -------------- BROWSER SNIFF AND SEND INFO FOR FUTURE BLACKLISTING -------------- //
	#######################################################################################
	require_once('phplib/mimemail/htmlMimeMail5.php');

	// BEGIN send Kevin a some browser specs
	$specs = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
	$mail = new htmlMimeMail5();

	//Set the From and Reply-To headers
	$mail->setFrom('Union Spam User<no-reply@email.arizona.edu>');
	$mail->setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail->setSubject('Union - Tell Us Spam');

	//Create the message body.
	$mail->setHTML(
	"<p>A user (<strong style=\"color:#ff0000;\">" . $_POST['email_required'] . "</strong>) tried to send spam on the Union site [<strong style=\"color:#ff0000;\">" . $_SERVER['HTTP_HOST'] . "</strong>]. The attempt was blocked. A summary follows:</p>
	<p style=\"color:#ff0000;\"><strong>Current date/time:</strong><br />" . date("D, M j, Y - g:i:s A", time()) . "</p>
	<p style=\"color:#ff0000;\"><strong>IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>
	<p style=\"color:#ff0000;\"><strong>User Info:</strong><br /><strong>Name:</strong> " . $_POST['name_required'] . "<br /><strong>Affiliation:</strong> " . $_POST['affiliation'] . "<br /><strong>Email:</strong> " . $_POST['email_required'] . "<br /><strong>Area of Concern:</strong> " . $_POST['area_of_concern'] . "<br /><strong>Spammer:</strong> " . $_POST['human'] . "<br /><strong>Comments:</strong> " . $_POST['comments'] . "</p>
	<p style=\"color:#ff0000;\"><strong>Platform/Browser Specs:</strong><br />" . $specs . "</p>");
	$result=$mail->send(array('su-web@email.arizona.edu'));
	// END send Kevin a some browser specs and user info
	###############################################################

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Success!</h1>
<p>Thank you! Your comments have been submitted.</p>

<?php

	page_finish();

}

/***************************************
** This is the html code called when comments
** are over 100 words.
***************************************/
function error_too_wordy() {

	 $page_options['title'] = 'Form Submission Error';
  page_start($page_options);

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Error!</h1>
<p>Please keep your comments to 100 words or fewer. You entered <? echo str_word_count($_POST['comments'], 0) ?> words. Use your browser's back button to return to the form and make corrections.</p>

<?php

	page_finish();

}

/***************************************
** This is the code called when the form
** has completed. This only gets called
** if no redirect is specified. If redirect
** is specified, client gets redirected,
** (which kinda follows...).
***************************************/
function thank_you($return_link) {



	if(isset($return_link) AND $return_link != '') {
		$page_options['head'] = '<meta http-equiv="refresh" content="10;URL='.$return_link.'">';
	}

	 $page_options['title'] = 'Form Submitted';
  page_start($page_options);

?>

<h1 style="font-family: Verdana, Arial, sans-serif; font-size: 18pt; font-weight: normal; letter-spacing: 3pt">Thanks!</h1>
<p>Your form was submitted.</p>

<?php

	if(isset($return_link) AND $return_link != '')
		echo '<a href="'.$return_link.'">Click here to return.</a>';

	page_finish();

}


/***************************************
**
**     *** HTML Mime Mail Class ***
**
** Based upon mime_mail.class
** by Tobias Ratschiller <tobias@dnet.it>
** and Sascha Schumann <sascha@schumann.cx>.
** Thanks to Thomas Flemming for supplying a fix
** for Win32.
***************************************/
      class html_mime_mail{
              var $headers;
              var $body;
              var $multipart;
              var $mime;
              var $html;
              var $html_text;
              var $html_images = array();
              var $cids = array();
              var $do_html;
              var $parts = array();
			  /***************************************
			  ** Constructor function. Sets the headers
			  ** if supplied.
			  ***************************************/
              function html_mime_mail($headers = ''){
                      $this->headers = $headers;
              }
			  /***************************************
			  ** Adds a html part to the mail.
			  ** Also replaces image names with
			  ** content-id's.
			  ***************************************/
              function add_html($html, $text){
                      $this->do_html = 1;
                      $this->html = $html;
                      $this->html_text = $text;
                      if(is_array($this->html_images) AND count($this->html_images) > 0){
                              for($i=0; $i<count($this->html_images); $i++){
                                      $this->html = ereg_replace($this->html_images[$i]['name'], 'cid:'.$this->html_images[$i]['cid'], $this->html);
                              }
                      }
              }

			  /***************************************
			  ** Builds html part of email.
			  ***************************************/
              function build_html($orig_boundary){
                      $sec_boundary = '=_'.md5(uniqid(time()));
                      $thr_boundary = '=_'.md5(uniqid(time()));

                      if(!is_array($this->html_images)){
                              $this->multipart.= '--'.$orig_boundary."\n";
                              $this->multipart.= 'Content-Type: multipart/alternative; boundary = "'.$sec_boundary."\"\n\n\n";

                              $this->multipart.= '--'.$sec_boundary."\n";
                              $this->multipart.= 'Content-Type: text/plain'."\n";
                              $this->multipart.= 'Content-Transfer-Encoding: 7bit'."\n\n";
                              $this->multipart.= $this->html_text."\n\n";

                              $this->multipart.= '--'.$sec_boundary."\n";
                              $this->multipart.= 'Content-Type: text/html'."\n";
                              $this->multipart.= 'Content-Transfer-Encoding: 7bit'."\n\n";
                              $this->multipart.= $this->html."\n\n";
                              $this->multipart.= '--'.$sec_boundary."--\n\n";
                      }else{
                              $this->multipart.= '--'.$orig_boundary."\n";
                              $this->multipart.= 'Content-Type: multipart/related; boundary = "'.$sec_boundary."\"\n\n\n";

                              $this->multipart.= '--'.$sec_boundary."\n";
                              $this->multipart.= 'Content-Type: multipart/alternative; boundary = "'.$thr_boundary."\"\n\n\n";

                              $this->multipart.= '--'.$thr_boundary."\n";
                              $this->multipart.= 'Content-Type: text/plain'."\n";
                              $this->multipart.= 'Content-Transfer-Encoding: 7bit'."\n\n";
                              $this->multipart.= $this->html_text."\n\n";

                              $this->multipart.= '--'.$thr_boundary."\n";
                              $this->multipart.= 'Content-Type: text/html'."\n";
                              $this->multipart.= 'Content-Transfer-Encoding: 7bit'."\n\n";
                              $this->multipart.= $this->html."\n\n";
                              $this->multipart.= '--'.$thr_boundary."--\n\n";

                              for($i=0; $i<count($this->html_images); $i++){
                                      $this->multipart.= '--'.$sec_boundary."\n";
                                      $this->build_html_image($i);
                              }

                              $this->multipart.= "--".$sec_boundary."--\n\n";
                      }
              }
			  /***************************************
			  ** Adds an image to the list of embedded
			  ** images.
			  ***************************************/
              function add_html_image($file, $name = '', $c_type='application/octet-stream'){
                      $this->html_images[] = array( 'body' => $file,
                                                    'name' => $name,
                                                    'c_type' => $c_type,
                                                    'cid' => md5(uniqid(time())) );
              }


			  /***************************************
			  ** Adds a file to the list of attachments.
			  ***************************************/
              function add_attachment($file, $name = '', $c_type='application/octet-stream'){
                      $this->parts[] = array( 'body' => $file,
                                              'name' => $name,
                                              'c_type' => $c_type );
              }

			  /***************************************
			  ** Builds an embedded image part of an
			  ** html mail.
			  ***************************************/
              function build_html_image($i){
                      $this->multipart.= 'Content-Type: '.$this->html_images[$i]['c_type'];

                      if($this->html_images[$i]['name'] != '') $this->multipart .= '; name = "'.$this->html_images[$i]['name']."\"\n";
                      else $this->multipart .= "\n";

                      $this->multipart.= 'Content-ID: <'.$this->html_images[$i]['cid'].">\n";
                      $this->multipart.= 'Content-Transfer-Encoding: base64'."\n\n";
                      $this->multipart.= chunk_split(base64_encode($this->html_images[$i]['body']))."\n";
              }

			  /***************************************
			  ** Builds a single part of a multipart
			  ** message.
			  ***************************************/
              function build_part($i){
                      $message_part = '';
                      $message_part.= 'Content-Type: '.$this->parts[$i]['c_type'];
                      if($this->parts[$i]['name'] != '')
                              $message_part .= '; name = "'.$this->parts[$i]['name']."\"\n";
                      else
                              $message_part .= "\n";

                      // Determine content encoding.
                      if($this->parts[$i]['c_type'] == 'text/plain'){
                              $message_part.= 'Content-Transfer-Encoding: 7bit'."\n\n";
                              $message_part.= $this->parts[$i]['body']."\n";
                      }else{
                              $message_part.= 'Content-Transfer-Encoding: base64'."\n";
                              $message_part.= 'Content-Disposition: attachment; filename = "'.$this->parts[$i]['name']."\"\n\n";
                              $message_part.= chunk_split(base64_encode($this->parts[$i]['body']))."\n";
                      }

                      return $message_part;
              }

			  /***************************************
			  ** Builds the multipart message from the
			  ** list ($this->parts).
			  ***************************************/
              function build_message(){
                      $boundary = '=_'.md5(uniqid(time()));

                      $this->headers.= "MIME-Version: 1.0\n";
                      $this->headers.= "Content-Type: multipart/mixed; boundary = \"".$boundary."\"\n";
                      $this->multipart = '';
                      $this->multipart.= "This is a MIME encoded message.\nCreated by html_mime_mail.class.\nSee http://www.heyes-computing.net/red.software/ for a copy.\n\n";

                      if(isset($this->do_html) AND $this->do_html == 1) $this->build_html($boundary);
                      if(isset($this->body) AND $this->body != '') $this->parts[] = array('body' => $this->body, 'name' => '', 'c_type' => 'text/plain');

                      for($i=(count($this->parts)-1); $i>=0; $i--){
                              $this->multipart.= '--'.$boundary."\n".$this->build_part($i);
                      }

                      $this->mime = $this->multipart."--".$boundary."--\n";
              }

			  /***************************************
			  ** Sends the mail.
			  ***************************************/
              function send($to_name, $to_addr, $from_name, $from_addr, $subject = '', $headers = ''){

                      if($to_name != '') $to = '"'.$to_name.'" <'.$to_addr.'>';
                      else $to = $to_addr;

                      if($from_name != '') $from = '"'.$from_name.'" <'.$from_addr.'>';
                      else $from = $from_addr;

                      $this->headers.= 'From: '.$from."\n";
                      $this->headers.= $headers;

                      mail($to, $subject, $this->mime, $this->headers);
              }

      } // End of class.


		/***************************************
		** Check if security is enabled and if
		** so perform referer check.
		***************************************/
        if($security == 1){
                //if(!eregi($servername, getenv('HTTP_REFERER'))){
                  //      error_bad_referer();
                    //    exit;
                //}
        }


		/***************************************
		** Debug feature. If $debug is set to 1,
		** script dies and prints whatever is in
		** $_POST and phpinfo.
		***************************************/
        if(isset($debug) AND $debug == 1){
                if(isset($_POST)){
                        while(list($key, $value) = each($_POST)){
                                echo $key.' = '.$value."<BR>\n";
                        }
                        echo "<BR><BR>\n\n";
                }
                //phpinfo();
                exit;
        }

        /***************************************
        ** Check to see if the user has put
        ** data in the phone field. If they
        ** have, they are probably a bot
        ***************************************/
        if(!empty($_POST['phone']))
        {
        	thank_you($return_link); // Shamelessly lie to bot
        	exit;
    	}

		/***************************************
		** Check for Redirect hidden attribute
		** and also for recipient and subject
		** hidden attributes.
		***************************************/
		// NOTE: Unless otherwise mentioned, these codes are defined in /about/ask.php
        if(isset($_POST['redirect']) AND $_POST['redirect'] != '') $redirect = $_POST['redirect'];

    /*
		switch($_POST['area_of_concern'])
		{
			case "student_advisory_council":
				//$recipient = 'drodriguez1@email.arizona.edu'; // Dominic Rodriguez - From /about/suac_app.php
				//$cc = 'su-web@email.arizona.edu'; // Kevin Beyer
				break;
			case "employment":
				//$recipient = 'csykos@email.arizona.edu'; // Courtney Sykos
				$cc = 'harrisoj@email.arizona.edu';//, su-web@email.arizona.edu'; // Judy Harrison / Kevin Beyer
				break;
			case "website_issues":
				//$recipient = "ricarlos@email.arizona.edu"; // Kevin Beyer
				$cc = 'ricarlos@email.arizona.edu, harrisoj@email.arizona.edu'; // Judy Harrison
				break;
			case "student_involvement":
				//$recipient = 'chargrav@email.arizona.edu'; // Chris Hargraves
				//$cc = 'su-web@email.arizona.edu'; // Kevin Beyer
				break;
			case "meeting_rooms_events":
				//$recipient = 'brendak@email.arizona.edu, ldj@email.arizona.edu'; // Brenda Keagle / Larry Jones
				$cc = 'harrisoj@email.arizona.edu';//, su-web@email.arizona.edu'; // Judy Harrison / Kevin Beyer
				break;
			case "catering":
				//$recipient = 'cunninghaml@email.arizona.edu'; // Lyn Cunningham
				$cc = 'harrisoj@email.arizona.edu';//, su-web@email.arizona.edu'; // Judy Harrison / Kevin Beyer
				break;
			case "park_student_union":
				//$recipient = 'harrisoj@email.arizona.edu, tabrousse@email.arizona.edu'; // Judy Harrison & Tim Brousse
				//$cc = 'su-web@email.arizona.edu'; // Kevin Beyer
				break;
			case "restaurants_student_union":
			case "convenience_stores_vending_machines":
				//$recipient = 'levengoo@email.arizona.edu, ddougall@email.arizona.edu'; // Jon Levengood / David Dougall
				$cc = 'harrisoj@email.arizona.edu';//, tabrousse@email.arizona.edu, su-web@email.arizona.edu'; // Judy Harrison & Tim Brousse / Kevin Beyer
				break;
			case "bathrooms_maintenance":
			case "public_areas":
			case "computer_labs_lounges":
				//$recipient = 'ldj@email.arizona.edu'; // Larry Jones
				$cc = 'harrisoj@email.arizona.edu';//, su-web@email.arizona.edu'; // Judy Harrison
				break;
			case "general_comments":
			case "customer_service":
			default:
				//$recipient = 'harrisoj@email.arizona.edu, levengoo@email.arizona.edu, ericajd3@email.arizona.edu'; // Judy Harrison / Jon Levengood / Erica Donegan
				//$cc = 'su-web@email.arizona.edu'; // Kevin Beyer
		}
    */

    $recipient = 'jtoddmillay@email.arizona.edu, su-tellus@email.arizona.edu'; // New recipients for all emails

        if(isset($_POST['subject']) AND $_POST['subject'] != '') {
			$subject = $_POST['subject'];
		}elseif(!isset($subject) OR $subject == '') {
			$subject = 'Feedback from website.';
		}

		/***************************************
		** Check to see if email was included in
		** form. If so check validity.
		***************************************/
        if(isset($_POST['email']) AND $_POST['email'] != ''){
                $email = $_POST['email'];
                if(!preg_match('/^([._a-z0-9-]+[._a-z0-9-]*)@(([a-z0-9-]+\.)*([a-z0-9-]+)(\.[a-z]{2,3})?)$/i', $email)){
                        error_invalid_email();
                        exit;
                }
        }elseif(isset($_POST['email_required']) AND $_POST['email_required'] != ''){
                $email = $_POST['email_required'];
                if(!preg_match('/^([._a-z0-9-]+[._a-z0-9-]*)@(([a-z0-9-]+\.)*([a-z0-9-]+)(\.[a-z]{2,3})?)$/i', $email)){
                        error_invalid_email();
                        exit;
                }
        }

		/***************************************
		** Check to see if comments are too
		** wordy.
		***************************************/
        if(str_word_count($_POST['comments'], 0) > 100){
			error_too_wordy();
			exit;
        }


		/********************************************************************
		** Check to see if comments contain URLs or other likely spam content
		********************************************************************/
        if (stristr($_POST['comments'], '{') || stristr($_POST['comments'], '[') || stristr($_POST['comments'], 'url')) {
			error_URLs();
			exit;
        }

		/********************************************************************
		** Check to see if subject was left blank
		********************************************************************/
        if ($subject == 'Feedback from website.') {
			error_nosubject();
			exit;
        }

		/********************************************************************
		** Check to see if hidden field contains data to indicate likely spam content
		********************************************************************/
        if ($_POST['human'] != false) {
			error_not_human();
			exit;
        }

		/****************************************************************
		** Check to see if name contain URLs or other likely spam content
		*****************************************************************/
        if (stristr($_POST['name_required'], 'http') || stristr($_POST['name_required'], '{') || stristr($_POST['name_required'], '[') || stristr($_POST['name_required'], 'url')) {
			error_URLs();
			exit;
        }

		/***************************************
		** Parse HTTP_POST_VARS and extract
		** name/value stuff. Also checks for
		** required inputs and starts email creation.
		***************************************/
        $mail = new html_mime_mail();
        $message = array();
        $message_values = array();
        $num_attachments = 0;

        while(list($key, $value) = each($_POST)){

                $orig_key = $key;

                if(preg_match('/_required$/i', $key)){
                        $key = preg_replace('/_required/i', '', $key);
                        if(empty($value)){
                                error_required();
                                exit;
                        }elseif(preg_match('/_file$/i', $key) AND $value == 'none'){
                                error_required();
                                exit;
                        }
                }

				/***************************************
				** This bit handles file uploads for php3.
				***************************************/
                if((int)phpversion() < 4){
                        if(preg_match('/_file$/i', $key)){
                                if($value != 'none' AND $value != ''){
                                        $ctype = $orig_key.'_type';
                                        $origname = $orig_key.'_name';
                                        $attachment = fread(fopen($value, 'r'), filesize($value));

                                        $mail->add_attachment($attachment, $$origname, $$ctype);
                                        $num_attachments++;
                                        continue;
                                }
                        }

				/***************************************
				** And this bit handles file uploads for
				** php4.
				***************************************/
                }elseif((int)phpversion() >= 4){
                        while(list($file, $attributes) = each($HTTP_POST_FILES)){
                                if($$file != 'none' AND $$file != ''){
                                        $ctype = $attributes['type'];
                                        $origname = $attributes['name'];
                                        $attachment = fread(fopen(stripslashes($$file), 'r'), filesize(stripslashes($$file)));

                                        $mail->add_attachment($attachment, $origname, $ctype);
                                        $num_attachments++;
                                        continue;
                                }
                        }
                }


				/***************************************
				** Main bit for normal fields.
				***************************************/
                if($key != 'redirect' AND $key != 'recipient' AND $key != 'subject'
                	AND $key != 'addhostip' AND $key != 'MAX_FILE_SIZE' AND $key != 'return_link'
                	AND $key != 'submit' AND !preg_match('/_file$|_file_name$|_file_size$/', $key)){
                        if(is_array($value)){
                                $message[] = $key;
                                $message_values[] = implode(', ', $value);
                        }else{
                                $message[] = $key;
                                $message_values[] = cleanFormData($value);
                        }
                }
        }

		/***************************************
		** Works out the longest key and pads
		** out the rest with dots. Makes it look
		** pretty.
		***************************************/
        //$time = date('H:i', time());
        $date = date('r', time());

        $longest = 0;
        for($i=0; $i<count($message); $i++){
                if(strlen($message[$i]) > strlen($message[$longest])) $longest = $i;
        }
        $length = strlen($message[$longest]);

        for($i=0; $i<count($message); $i++){
                $padding = $length - strlen($message[$i]);;
                for($j=0; $j<$padding; $j++){
                        $message[$i] .= '.';
                }
                $message[$i] .= '..: '.$message_values[$i];
        }

		/***************************************
		** Constructs the email. If there are
		** attachments it uses the mime mail
		** class, if not then normal mail().
		***************************************/
        $body = 'On '.$date.', the following information was submitted to your form at '.getenv('HTTP_REFERER')." :\r\n\r\n";
        $body .= implode("\r\n", $message)."\r\n\r\n";
        $body .= $_POST['addhostip'] ? 'Remote IP: '.$REMOTE_ADDR."\r\nRemote hostname: ".$REMOTE_HOST."\r\n" : '';
        $body .= $addhostip ? 'Remote IP: '.$REMOTE_ADDR."\r\nRemote hostname: ".$REMOTE_HOST."\r\n" : '';

        if($num_attachments > 0){
                $mail->add_attachment($body, '', 'text/plain');
                $mail->build_message();
                $mail->send('', $recipient, '', $email, $subject, 'Return-Path: '.$email."\n");
        }else{
                $headers = 'Return-Path: '.$email."\nFrom: ".$email. "\n";
                $headers .= 'Cc: ' . $cc . "\n";
                mail($recipient, $subject, $body, $headers);
        }
	if(isset($_POST['return_link']) AND $_POST['return_link'] != '') $return_link = $_POST['return_link'];
        (isset($redirect) AND $redirect != '') ? header('Location: '.$redirect) : thank_you($return_link);
?>
