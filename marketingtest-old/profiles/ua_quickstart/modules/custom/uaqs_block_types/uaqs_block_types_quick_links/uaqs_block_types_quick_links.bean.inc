<?php
/**
 * @file
 * uaqs_block_types_quick_links.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_quick_links_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_quick_links';
  $bean_type->label = 'Quick Links';
  $bean_type->options = '';
  $bean_type->description = 'Add quick links to a site.';
  $export['uaqs_quick_links'] = $bean_type;

  return $export;
}
