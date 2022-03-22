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
  $section_options['nav']['Mall Scheduling']['DRC Guidelines']['link'] = '/mall/template/resources/DRC_PlanningAccessibleInclusiveEvents.pdf';
  $section_options['nav']['Mall Scheduling']['Important Information']['link'] = '/mall/info.php';
  $section_options['nav']['Mall Scheduling']['Mall Guidelines']['link'] = '/mall/guidelines.php';
  $section_options['nav']['Mall Scheduling']['Recognized Clubs']['link'] = 'http://asua.arizona.edu/colist.htm';
  $section_options['nav']['Mall Scheduling']['Unapproved Mall Vendors']['link'] = '/mall/unapprovedvendors.php';
  $section_options['header_image'] = '/template/images/banners/mall.png';
  $page_options = array_merge($section_options, $page_options);
  page_start($page_options);
 }

function mall_finish(){
  page_finish();
}
