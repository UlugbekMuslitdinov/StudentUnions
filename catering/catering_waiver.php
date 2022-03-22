<?php

// turn on sessions
@session_start();

require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once('deliverance.inc.php');
require_once('includes/field_validation.inc.php');
page_start($page_options);
require_once('contact_us.inc.php');
require_once('catering_slider.inc.php');

$date = $department = $name = $address = $phone = $fax = $email = $eventDate = $location = $description = $startTime = $endTime = $numGuests = $totalEstCost = $reason = $caterer = '';

// has the form been submitted?
if (isset($_POST['submit']))
{
  $arrValidate = array();

  $arrValidate['Date'] = $date = date("F j, Y");
  $arrValidate['Department/Organization'] = $department = strip_tags($_POST['department']);
  $arrValidate['Name of Applicant'] = $name = strip_tags($_POST['name']);
  $arrValidate['Address'] = $address = strip_tags($_POST['address']);
  $arrValidate['Phone'] = $phone = strip_tags($_POST['phone']);
  $arrValidate['Fax'] = $fax = strip_tags($_POST['fax']);
  $arrValidate['E-Mail'] = $email = strip_tags($_POST['email']);
  $arrValidate['Event Date'] = $eventDate = strip_tags($_POST['eventDate']);
  $arrValidate['Event Location'] = $location = strip_tags($_POST['location']);
  $arrValidate['Event Description'] = $description = strip_tags($_POST['description']);
  $arrValidate['Start Time'] = $startTime = strip_tags($_POST['startTime']);
  $arrValidate['End Time'] = $endTime = strip_tags($_POST['endTime']);
  $arrValidate['Number of Guests'] = $numGuests = strip_tags($_POST['numGuests']);
  $arrValidate['Total Estimated Cost'] = $totalEstCost = strip_tags($_POST['totalEstCost']);
  $arrValidate['Reason for Waiver Request'] = $reason = strip_tags($_POST['reason']);
  $arrValidate['Name of Prospective Caterer'] = $caterer = strip_tags($_POST['caterer']);

  $response = "";
  $confirmation = "";

  foreach ($arrValidate as $fieldName => $input)
  {
    if (!$input)
    {
      $response .= $fieldName . " is required.<br />";
    }
    else
    {
      $confirmation .= $fieldName . ": " . $input . "<br />";
    }
  }

  if (!$response)
  {
    $subject = "Catering Waiver";
    $emailTo = "Sueventplanning@email.arizona.edu,$email";

    if(substr(php_uname("s"),0,1)=="W"){//running on windows
       ini_set(SMTP,"smtpgate.email.arizona.edu");
    }

    ini_set(sendmail_from, $email);
    $email_headers = "Content-type: text/html; charset=iso-8859-1\r\nFrom: ".$email;
    $result=mail( $emailTo, "Catering Order Online:".$subject, $confirmation, $email_headers );
  }
}

?>

<script type="text/javascript">
$(document).ready(function() {
  $(".datepicker").datepicker();
});
</script>

<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" />
<div id="left-col" style="margin-top:50px;display:fixed;width:30%;float:left;margin-left:  -.75em; padding-left:  10px;" >
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/involvement.php";
print_left_nav($involvement_route, $page_options['page'], ['other', 'other2']);
?>
</div>

<div id="catering_page" >

  <div id="center-col" style="margin-top:-50%;display:inline;width:70%;float:right;padding-bottom: 4em;">

    <h2>Catering Waiver</h2>

    <?php if (isset($_POST['submit']) && $result) { ?>

    <p class='success-msg' >Thank you for your submission. <br />We will get back to you as soon as possible.</p>

    <?php } else { ?>

      <?php if ($response) { ?>
      <h4 class='error-msg sub-nav-left-col'  >There were errors in processing the order information.</h4>
      <p class='error-msg'><?php echo $response; ?></p>
      <?php } ?>

    <form name="form1" method="post" action="">
      <h3>Applicant Information:</h3>
      <p>
        <label for="date">Date: </label><br />
        <input name="date" type="text" id="firstName" size="50" maxlength="50" value="<?php echo date("F j, Y"); ?>" disabled >
      </p>
      <p>
        <label for="department">Department/Organization: <span class="req" >*</span></label><br />
        <input name="department" type="text" id="department" size="50" maxlength="50" value="<?php echo $department; ?>" >
      </p>
      <p>
        <label for="name">Name of Applicant: <span class="req" >*</span></label><br />
        <input name="name" type="text" id="name" size="50" maxlength="50" value="<?php echo $name; ?>" >
      </p>
      <p>
        <label for="address">Address: <span class="req" >*</span></label><br />
        <input name="address" type="text" id="address" size="50" maxlength="50" value="<?php echo $address; ?>" >
      </p>
      <p>
        <label for="phone">Phone: <span class="req" >*</span></label><br />
        <input name="phone" type="text" id="phone" size="50" maxlength="50" value="<?php echo $phone; ?>" >
      </p>
      <p>
        <label for="fax">Fax: <span class="req" >*</span></label><br />
        <input name="fax" type="text" id="fax" size="50" maxlength="50" value="<?php echo $fax; ?>" >
      </p>
      <p>
        <label for="email">E-Mail: <span class="req" >*</span></label><br />
        <input name="email" type="text" id="email" size="50" maxlength="50" value="<?php echo $email; ?>" >
      </p>

      <h3>Event Information:</h3>
      <p>
        <label for="eventDate">Event Date: <span class="req" >*</span></label><br />
        <input class="datepicker right10" size="12" name="eventDate" id="eventDate" type='text' title="Event Date" value="<?php echo $eventDate; ?>" />
      </p>
      <p>
        <label for="location">Event Location: <span class="req" >*</span></label><br />
        <input name="location" type="text" id="location" size="50" maxlength="50" value="<?php echo $location; ?>" >
      </p>
      <p>
        <label for="description">Event Description: <span class="req" >*</span></label><br />
        <input name="description" type="text" id="description" size="50" maxlength="50" value="<?php echo $description; ?>" >
      </p>
      <p>
        Event Times: <span class="req" >*</span><br />
        <label for "startTime">Start: </label><input name="startTime" type="text" id="startTime" title="From Time" maxlength="12" size="12" value="<?php echo $startTime; ?>" >
        -
        <label for "endTime">End: </label><input name="endTime" type="text" id="endTime" title="To Time" maxlength="12" size="12" value="<?php echo $endTime; ?>" >
      </p>
      <p>
        <label for="numGuests">Number of Guests: <span class="req" >*</span></label><br />
        <input name="numGuests" type="text" id="numGuests" size="50" maxlength="50" value="<?php echo $numGuests; ?>" >
      </p>
      <p>
        <label for="totalEstCost">Total Estimated Cost of Food &amp; Beverage: <span class="req" >*</span></label><br />
        <input name="totalEstCost" type="text" id="totalEstCost" size="50" maxlength="50" value="<?php echo $totalEstCost; ?>" ><br />
        <small>(If the estimated cost for catering changes +/– 10% after this Waiver is submitted, a new Waiver application must be competed and returned to the Event Planning Office.)</small>
      </p>
      <p>
        <label for="reason">Reason for Waiver Request: <span class="req" >*</span></label><br />
        <textarea name="reason" cols="50" rows="4" id="reason" maxlength="500" ><?php echo $reason; ?></textarea><br />
        <small>(Waivers will not be approved based on source of funding.)</small>
      </p>
      <p>
        <label for="caterer">Name of Prospective Caterer: <span class="req" >*</span></label><br />
        <input name="caterer" type="text" id="caterer" size="50" maxlength="50" value="<?php echo $caterer; ?>" >
      </p>

      <input type="submit" name="submit" value="send">
    </form>

    <?php } ?>

  </div>

  <?php
  //require_once('catering_right_col.inc.php');
  ?>

</div>

<div style="clear:both;">
  <br /><br />
</div>
