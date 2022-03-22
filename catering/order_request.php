<?php
// This is an old form.  Redirect the page to:
header( 'Location: order_online_1.php' );

  /******************************
   * order_request.php
   * Last Modified 08/26/3013
   * 
   * Send catering order details
   * to predetermined recipients
   ******************************/
   
  session_start();
  require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Redington Catering';
  $page_options['header_image'] = '/template/images/banners/catering.png';
  $page_options['nav']['Catering']['Home']['link'] = '/catering';
  $page_options['nav']['Catering']['Online Order Request']['link'] = '/catering/order_request.php';
  $page_options['nav']['Catering']['UA Catering Waiver']['link'] = '/template/resources/forms/CateringWaiver.pdf';
  $page_options['nav']['Catering']['UA Catering &amp; Food Service Policy']['link'] = 'http://policy.arizona.edu/catering-policy';
  $page_options['nav']['Catering']['UA Alcohol Permit']['link'] = '/alcohol/';
  page_start($page_options);
  
  unset($_SESSION['error']);
  $_SESSION['error_msg'] = '';
  if (isset($_POST['submit'])) {
    
    //Validate the required fields
    $required_fields = array('name', 'phone', 'department', 'billing', 'people', 'type', 'order_text', 'event_time', 'billName', 'billEmail', 'billPhone', 'eventTitle', 'emerContact');
    foreach ($required_fields as $cur_field) {
      if(!$_POST[$cur_field]) {
        if ($cur_field=='order_text') {
          $_SESSION['error_msg'] .= "Order Request required, ";
        }
        else if ($cur_field=='billing') {
          $_SESSION['error_msg'] .= "Customer Billing Address and FRS Account Number (if applicable) required, ";
        }
        else if ($cur_field=='people') {
          $_SESSION['error_msg'] .= "Estimated Number of People required, ";
        }
        else if ($cur_field=='type') {
          $_SESSION['error_msg'] .= "Order Type required, ";
        }
        else if ($cur_field=='event_time') {
          $_SESSION['error_msg'] .= "Event Time required, ";
        }
		else if ($cur_field=='billName') {
          $_SESSION['error_msg'] .= "Name of Contact responsible for billing &amp; payment required, ";
        }
		else if ($cur_field=='billEmail') {
          $_SESSION['error_msg'] .= "Billing Contact email required, ";
        }
		else if ($cur_field=='billPhone') {
          $_SESSION['error_msg'] .= "Billing Contact Phone required, ";
        }
		else if ($cur_field=='eventTitle') {
          $_SESSION['error_msg'] .= "Event title required, ";
        }
		else if ($cur_field=='emerContact') {
          $_SESSION['error_msg'] .= "Emergency contact name and cell phone number for client who will be in attendance at the event required, ";
        }
        else {
          $_SESSION['error_msg'] .= ucwords($cur_field)." required, ";
        }
        $_SESSION['error'][$cur_field] = 'border:1px solid red;';
        unset($_SESSION[$cur_field]);
      }
      else {
        $_SESSION[$cur_field] = $_POST[$cur_field];
        unset($_SESSION['error'][$cur_field]);
      }
    }
    $save_fields = array('fax', 'email', 'location', 'room', 'pickuptime', 'sub_account', 'sub_object', 'project_code');
    foreach ($save_fields as $cur_field) {
      $_SESSION[$cur_field] = $_POST[$cur_field];
    }
    
    if($_SESSION['error_msg'] != '') {
      $_SESSION['error_msg'] = substr($_SESSION['error_msg'], 0, -2).".";
      $lastCommaPos = strrpos($_SESSION['error_msg'], ',') - strlen($_SESSION['error_msg']);
      if (count($_SESSION['error'])>2) {
        $_SESSION['error_msg'] = substr($_SESSION['error_msg'], 0, $lastCommaPos) . str_replace(',', ', and ', substr($_SESSION['error_msg'], $lastCommaPos));
      }
      else {
        $_SESSION['error_msg'] = substr($_SESSION['error_msg'], 0, $lastCommaPos) . str_replace(',', ' and ', substr($_SESSION['error_msg'], $lastCommaPos));
      }
    }
    else {
      //Piece together the request email given the provided information
      $message = "";
      $message .= "There has been a new Online Catering order submitted!\r\n\r\n";
      $message .= "Customer Name :  ".$_SESSION['name']."\r\n";
      $message .= "Customer Phone :  ".$_SESSION['phone']."\r\n";
      $message .= "Customer Fax :  ".$_SESSION['fax']."\r\n";
      $message .= "Customer Email :  ".$_SESSION['email']."\r\n";
      $message .= "Customer Department or Organization :  ".$_SESSION['department']."\r\n";
      $message .= "Customer Billing Address and FRS Account Number (if applicable) :  ".$_SESSION['billing']."\r\n";
      $message .= "    Sub-Account (if applicable) :  ".$_SESSION['sub_account']."\r\n";
      $message .= "    Sub-Object Code (if applicable) :  ".$_SESSION['sub_object']."\r\n";
      $message .= "    Project Code (if applicable) :  ".$_SESSION['project_code']."\r\n";
	  
	  $message .= "Name of Contact responsible for billing & payment :  ".$_SESSION['billName']."\r\n";
	  $message .= "Billing Contact email :  ".$_SESSION['billEmail']."\r\n";
	  $message .= "Billing Contact Phone :  ".$_SESSION['billPhone']."\r\n";
	  
	  $message .= "Event title :  ".$_SESSION['eventTitle']."\r\n";
      $message .= "Estimated number of People :  ".$_SESSION['people']."\r\n";
      $message .= "Customer Order Type :  ".$_SESSION['type']."\r\n";
      $message .= "Delivery Location :  ".$_SESSION['location']."\r\n";
      $message .= "Delivery Room # :  ".$_SESSION['room']."\r\n";
      $message .= "Event Time :  ".$_SESSION['event_time']."\r\n";
      $message .= "Equipment Pick-up Time :  ".$_SESSION['pickuptime']."\r\n\r\n";
      $message .= "Request:  ".$_SESSION['order_text'] . "\r\n";
	  $message .= "Emergency contact name and cell phone number for client who will be in attendance at the event :  ".$_SESSION['emerContact']."\r\n";
      $message .= "\r\n\r\nTime Order Was Requested : " . date("D M j G:i:s T Y");
  
  	  // $emails = array('bphinney@email.arizona.edu');
  	 $emails = array('samarketingnoise@gmail.com','ehinojos@email.arizona.edu',
  	  	'brendak@email.arizona.edu', 'mlrobin1@email.arizona.edu',
  	   	'charlenej@email.arizona.edu', 'sueventplanning@email.arizona.edu');
      
      //Submit the Request to the emails array
      foreach ($emails as $to) {
        mail($to, "New Redington Catering Order (".date("D M j G:i:s T Y").")", $message,
         "From: Redington Catering Online <web@union.arizona.edu>\r\n"
        ."Reply-To: web@union.arizona.edu\r\n"
        ."X-Mailer: PHP/" . phpversion());
      }
      
      //Display confirmation
      echo '<div style="width:500px;"><h1 style="font-size:14px;">Online Order Request Form</h1>';
      echo "<p>We have received your order.</p>";
      echo "<p>If you do not receive a confirmation within 48 hours, please call the Event Services Office at (520) 621-1414 to confirm that your order was received.</p>";
      page_finish();
      die;
    }
  }
  else {
    $required_fields = array('name', 'phone', 'department', 'billing', 'people', 'type', 'order_text', 'fax', 'email', 'location', 'room', 'event_time', 'pickuptime');
    foreach ($required_fields as $cur_field) {
      unset($_SESSION[$cur_field]);
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<style type="text/css">
#order_form_wrapper {
  width:440px;
}
#order_form_fields, #order_form_fields select {
  width:100% !important;
}
#order_form_fields input, #order_form_fields textarea {
  width:100% !important;
  border:solid 1px #999;
}
#order_form_fields textarea {
  height:150px;
}
#order_form_fields td {
  padding-top:8px;
}
.field_row_long input {
  width:auto !important;
}
.field_title {
  font-weight:bold;
  text-align:right;
  width:130px;
}
.field_title_long {
  font-weight:bold;
}
#error_msg {
  color:#CC0000;
  font-weight:bold;
}
.field_input {
  width:300px;
}
.field_input_indent {
  font-weight:bold;
  text-align:left;
  width:300px;
  padding: 0px 0px 0px 30px;
}
</style>

<div id="order_form_wrapper">
  <h1>Online Order Request Form</h1>
  <p>If your group is placing an order for within the next 2 weeks, please do not use this form.  Instead contact the Event Services Office at (520) 621-1414 or by visiting us on the 3rd floor of the SUMC.</p>
  <div id="error_msg"><?php echo $_SESSION['error_msg']; ?></div>
  <form id="order_form" name="order_form" action="" method="POST">
    <table id="order_form_fields">
      <tr>
        <td class="field_title">Name:</td>
        <td class="field_input"><input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" style="<?php echo $_SESSION['error']['name']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Phone:</td>
        <td class="field_input"><input type="text" id="phone" name="phone" value="<?php echo $_SESSION['phone']; ?>" style="<?php echo $_SESSION['error']['phone']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Fax Number:</td>
        <td class="field_input"><input type="text" id="fax" name="fax" value="<?php echo $_SESSION['fax']; ?>" style="<?php echo $_SESSION['error']['fax']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">E-Mail:</td>
        <td class="field_input"><input type="text" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" style="<?php echo $_SESSION['error']['email']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Department<br />or Organization:</td>
        <td class="field_input"><input type="text" id="department" name="department" value="<?php echo $_SESSION['department']; ?>" style="<?php echo $_SESSION['error']['department']; ?>" /></td>
      </tr>
      <tr>
        <td style="padding-top:10px;text-align:left;" class="field_title" colspan="2" >Customer Billing Address and FRS Account Number (if applicable) :</td>
      </tr>
      <tr>
        <td class="field_input" colspan="2" ><input type="text" id="billing" name="billing" value="<?php echo $_SESSION['billing']; ?>" style="<?php echo $_SESSION['error']['billing']; ?>" /></td>
      </tr>
      
      <tr>
        <td class="field_title"></td>
        <td class="field_input_indent">Sub-Account (if applicable):<br /><input type="text" id="sub_account" name="sub_account" value="<?php echo $_SESSION['sub_account']; ?>" style="<?php echo $_SESSION['error']['sub_account']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title"></td>
        <td class="field_input_indent">Sub-Object Code (if applicable):<br /><input type="text" id="sub_object" name="sub_object" value="<?php echo $_SESSION['sub_object']; ?>" style="<?php echo $_SESSION['error']['sub_object']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title"></td>
        <td class="field_input_indent">Project Code (if applicable):<br /><input type="text" id="project_code" name="project_code" value="<?php echo $_SESSION['project_code']; ?>" style="<?php echo $_SESSION['error']['project_code']; ?>" /></td>
      </tr>
       
      <tr><td colspan="2" >&nbsp;</td></tr>
      <tr>
        <td  style="padding-top:10px;text-align:left;" colspan="2" class="field_title">Name of Contact responsible for billing &amp; payment:</td>
      </tr>
      <tr>
        <td  colspan="2" class="field_input"><input type="text" id="billName" name="billName" value="<?php echo $_SESSION['billName']; ?>" style="<?php echo $_SESSION['error']['billName']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Billing Contact email:</td>
        <td class="field_input"><input type="text" id="billEmail" name="billEmail" value="<?php echo $_SESSION['billEmail']; ?>" style="<?php echo $_SESSION['error']['billEmail']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Billing Contact Phone:</td>
        <td class="field_input"><input type="text" id="billPhone" name="billPhone" value="<?php echo $_SESSION['billPhone']; ?>" style="<?php echo $_SESSION['error']['billPhone']; ?>" /></td>
      </tr>
       
      <tr><td colspan="2" >&nbsp;</td></tr>
      <tr>
        <td class="field_title">Event title:</td>
        <td class="field_input"><input type="text" id="eventTitle" name="eventTitle" value="<?php echo $_SESSION['eventTitle']; ?>" style="<?php echo $_SESSION['error']['eventTitle']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Estimated Number<br />of People:</td>
        <td><input type="text" id="people" name="people" value="<?php echo $_SESSION['people']; ?>" style="<?php echo $_SESSION['error']['people']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Order Type:</td>
        <td  class="field_input" style="<?php echo $_SESSION['error']['type']; ?>" >
          <select id="type" name="type">
            <option></option>
            <option value="In-House (Student Union)" <?php if($_SESSION['type']=="In-House (Student Union)"){echo "selected";} ?> >In-House (Student Union)</option>
            <option value="Pick-up" <?php if($_SESSION['type']=="Pick-up"){echo "selected";} ?> >Pick-up</option>
            <option value="Delivery" <?php if($_SESSION['type']=="Delivery"){echo "selected";} ?> >Delivery</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="field_title">Delivery Location:</td>
        <td class="field_input"><input type="text" id="location" name="location" value="<?php echo $_SESSION['location']; ?>" style="<?php echo $_SESSION['error']['location']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Delivery Room #:</td>
        <td class="field_input"><input type="text" id="room" name="room" value="<?php echo $_SESSION['room']; ?>" style="<?php echo $_SESSION['error']['room']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Event Date and Time:</td>
        <td class="field_input"><input type="text" id="event_time" name="event_time" value="<?php echo $_SESSION['event_time']; ?>" style="<?php echo $_SESSION['error']['event_time']; ?>" /></td>
      </tr>
      <tr>
        <td class="field_title">Equipment Pick-up Time:</td>
        <td class="field_input"><input type="text" id="pickuptime" name="pickuptime" value="<?php echo $_SESSION['pickuptime']; ?>" style="<?php echo $_SESSION['error']['pickuptime']; ?>" /></td>
      </tr>
      <tr>
        <td style="padding-top:0;" colspan="2" align="right">(When should union staff pickup the equipment)</td>
      </tr>
      <tr>
        <td style="padding-top:10px;text-align:left;" colspan="2" class="field_title">Order Request:</td>
      </tr>
      <tr>
        <td colspan="2"><textarea id="order_text" name="order_text" style="<?php echo $_SESSION['error']['order_text']; ?>" ><?php echo $_SESSION['order_text']; ?></textarea></td>
      </tr>
      
      <tr><td colspan="2" >&nbsp;</td></tr>
      <tr>
        <td style="padding-top:10px;text-align:left;" class="field_title" colspan="2" >Emergency contact name and cell phone number for client who will be in attendance at the event:</td>
      </tr>
      <tr>
        <td class="field_input" colspan="2" ><input type="text" id="emerContact" name="emerContact" value="<?php echo $_SESSION['emerContact']; ?>" style="<?php echo $_SESSION['error']['emerContact']; ?>" /></td>
      </tr>
    </table>
    <div style="width:100%;text-align:right;margin-top:20px;margin-right:25px;">
      <input type="submit" id="cancel" name="cancel" value="Cancel" />&nbsp;&nbsp;&nbsp;
      <input type="submit" id="submit" name="submit" value="Submit Order Request" />
    </div>
  </form>
</div>

<?php page_finish(); ?>
