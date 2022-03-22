<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  require_once($_SERVER['DOCUMENT_ROOT'] . '/template/hours.inc');
  $page_options['title'] = 'United States Post Office Contract Unit';
  $page_options['page'] = 'US Post Office';
  $page_options['header_image'] = '/template/images/banners/postoffice_banner.jpg';
  page_start($page_options);
?>

<div class="col-md-12 wrap-banner-img">
		<img src="<?php echo $page_options['header_image']; ?>" />
</div>

<!-- Left Col -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/involvement.php";
print_left_nav($involvement_route, $page_options['page'], ['other', 'other2']);
?>

<div class="col">
  <div class="col-12 mt-4">
    <h1 style="" >United States Post Office Contract Unit</h1>
    <p style="margin-top: 5px;">Welcome to the Student Union Post Office Contract Unit, located on the lower level of the Student Union Memorial Center. We offer most of the services and benefits provided by a US Post Office including:</p>
    <ul>
      <li>Domestic Mail Service</li>
      <li>International Mail Service</li>
      <li>Stamps</li>
      <li>Money Orders</li>             	
    </ul>

    <p>In addition, the student unions offers the following products and services.</p>
    <ul>
      <li>Private Mailbox Rentals</li>
      <li>Mailing and Packing Materials</li>
      <li>Notary Services</li>
      <li>Custom Ink Stamps</li>
      <li>Faxing</li>
    </ul>
    <!-- <h4>Accept Cash or Check only</h4>  -->
    <!-- <table border="0" cellpadding="4" cellspacing="0" style="margin-top: 15px;">
      <tr>
        <td valign="top">
          <h2>Arizona Student Unions' Products &amp; Services:</h2>
          <ul>
            <li>Private Mailbox Rentals</li>
            <li>Mailing and Packing Materials</li>
            <li>Notary Services</li>
            <li>Custom Ink Stamps</li>
            <li>Faxing</li>
          </ul>
        </td>
        <td valign="top" style="padding-left:20px;">
          <h2>Contract Unit Products &amp; Services:</h2>
          <ul>
            <li>Domestic Mail Service</li>
            <li>International Mail Service</li>
            <li>Stamps</li>
            <li>Money Orders</li>             	
          </ul>
        </td>
      </tr>
    </table> -->

    <!-- <h2 style="margin-top: 20px;">Mail Collection Times</h2> -->
    <p class="mt-2">Please Note : "Mail" collection time is 2pm Monday-Friday</p>
    <p>For more information on postal rates and general USPS information, please visit the <a href="http://www.usps.gov" 
      onclick="window.open(this.href); return false;"
      onkeypress="window.open(this.href); return false;" >United States Post Office website</a>.</p>
    <div style="margin-top: 10px; margin-bottom: 10px;"><?php printLocationHours(7) ?></div>
    <p>Phone: 520-626-6245, Email: <a href="mailto:sumcpo@email.arizona.edu">sumcpo@email.arizona.edu </a></p>
  </div>
</div>
<?php page_finish() ?>