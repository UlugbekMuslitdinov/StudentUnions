<?php
  header("Location: https://union.arizona.edu");
  die();
  require_once($_SERVER['DOCUMENT_ROOT'] . '/mall/template/mall.inc');
  $page_options['title'] = 'Express Capmus Use Activity Form';
  $page_options['styles'] = '.table td{ padding:4px;}';
  $page_options['header_image'] = '/template/images/banners/ua_mall_banner.jpg';
  $page_options['page'] = 'Express Campus Use Activity Form';
  mall_start($page_options);
?>
<h1>Express Campus Use Activity Form</h1>
<p style="font-weight:bold;">To be used for the sole purpose of hosting a table only on the UA Mall. To utilize this form, your event must not require security, risk management or involve commercial activity. All other requests must use main request form.</p>
<p>Please call us at (520) 626-2630 to reserve space and for further information.</p>
<p>To ensure that we have received and processed your order, please call us and let us know that you have sent us a fax.</p>
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#cccccc">
  <tbody><tr>
    <td>
      <table border="0" cellpadding="4" cellspacing="1" frame="" width="100%" class="table">
        <tbody><tr>
          <td valign="top" bgcolor="#ffffff">
            <div align="right">
              <img src="/template/images/number_one.gif" width="20" height="31" alt="Step 1"></div>
          </td>
          <td bgcolor="#ffffff"><b><a href="express_request_form.pdf">Download the form and print it out.<br>
                <br>
              </a></b>
          </td>
        </tr>
        <tr>
          <td valign="top" bgcolor="#ffffff">
            <div align="right">
              <img src="/template/images/number_two.gif" width="20" height="31" alt="Step 2"></div>
          </td>
          <td bgcolor="#ffffff"><b>Fill it out completely and don't forget to sign it.</b></td>
        </tr>
        <tr>
          <td valign="top" bgcolor="#ffffff">
            <div align="right">
              <img src="/template/images/number_three.gif" width="20" height="31" alt="Step 3"></div>
          </td>
          <td bgcolor="#ffffff"><b>Mail or Fax it in:</b>
            <p>Student Union Memorial Center, 290A-1<br>
              Tucson, Arizona 85719<br>
              Behind the Info Desk, next to U-Mart<br>
              FAX (520) 626-8969</p></td>
        </tr>
      </tbody></table>
    </td>
  </tr>
</tbody></table>
<?php mall_finish() ?>
