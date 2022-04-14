<?php
/**
 * @file
 * uaqs_block_types_contact_summary.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_contact_summary_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_contact_summary';
  $bean_type->label = 'Contact Summary';
  $bean_type->options = '';
  $bean_type->description = 'Summary contact information, for example a departmental postal address, generic email address, and main office phone number.';
  $export['uaqs_contact_summary'] = $bean_type;

  return $export;
}
