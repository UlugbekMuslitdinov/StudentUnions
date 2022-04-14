<?php
/**
 * @file
 * uaqs_block_types_search.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_search_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_search';
  $bean_type->label = 'Search';
  $bean_type->options = '';
  $bean_type->description = 'Add a search block with custom wrapper classes.';
  $export['uaqs_search'] = $bean_type;

  return $export;
}
