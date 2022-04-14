<?php
/**
 * @file
 * uaqs_block_types_captioned_image.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_captioned_image_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_captioned_image';
  $bean_type->label = 'Captioned Image';
  $bean_type->options = '';
  $bean_type->description = 'An image with caption and photo credit.';
  $export['uaqs_captioned_image'] = $bean_type;

  return $export;
}
