<?php
function mall_start($page_options){
  global $page_options;
  require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $section_options['title'] = 'Campus Use &amp; Mall Scheduling';
  $section_options['nav']['Mall Scheduling']['Available Space Maps']['link'] = '/mall/maps.php';
  $section_options['nav']['Mall Scheduling']['Banner Policy']['link'] = '/mall/banner_policy.php';
  $section_options['nav']['Mall Scheduling']['Campus Use/Mall Activity Request Form']['link'] = '/mall/request_form.php';
  $section_options['nav']['Mall Scheduling']['Campus Use/Mall Activity Fees']['link'] = '/mall/template/resources/SUMallFees.pdf';
  $section_options['nav']['Mall Scheduling']['Credit Card Privacy Agreement']['link'] = '/mall/template/resources/VendorPrivacyAgreement.pdf';
  $section_options['nav']['Mall Scheduling']['Express Campus Use Activity Form']['link'] = '/mall/express_request_form.php';
  $section_options['nav']['Mall Scheduling']['Important Information']['link'] = '/mall/info.php';
  $section_options['nav']['Mall Scheduling']['Mall Guidelines']['link'] = '/mall/guidelines.php';
  $section_options['nav']['Mall Scheduling']['Recognized Clubs']['link'] = 'http://asuaevp.wixsite.com/uaclubs';
  $section_options['nav']['Mall Scheduling']['Unapproved Mall Vendors']['link'] = '/mall/unapprovedvendors.php';
  $section_options['header_image'] = '/mall/images/mall.png';
  $page_options = array_merge($section_options, $page_options);
  page_start($page_options);
?>
<div class="col-md-12 wrap-banner-img">
		<img src="<?php echo $page_options['header_image']; ?>" />
</div>

<?php // left_nav($section_options['nav']['Mall Scheduling'], $page_options) ?>
<!-- Left Col -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/involvement.php";
print_left_nav($involvement_route, $page_options['page'], ['other', 'other2']);
?>

<div class="col">
  <div class="col-12 mt-4">

<?php
}

function mall_finish(){
?>
</div></div>
<?php
  page_finish();
}
