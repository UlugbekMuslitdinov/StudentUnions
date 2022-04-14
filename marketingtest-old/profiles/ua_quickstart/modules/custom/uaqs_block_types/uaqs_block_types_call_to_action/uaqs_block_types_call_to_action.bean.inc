<?php
/**
 * @file
 * uaqs_block_types_call_to_action.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_call_to_action_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_call_to_action';
  $bean_type->label = 'Call To Action';
  $bean_type->options = '';
  $bean_type->description = 'Add a call to action block with custom wrapper classes.';
  $export['uaqs_call_to_action'] = $bean_type;

  return $export;
}
