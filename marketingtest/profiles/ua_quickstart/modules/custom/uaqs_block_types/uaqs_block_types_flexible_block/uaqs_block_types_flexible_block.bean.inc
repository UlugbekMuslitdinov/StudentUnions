<?php

/**
 * @file
 * uaqs_block_types_flexible_block.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_flexible_block_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_flexible_block';
  $bean_type->label = 'Flexible Block';
  $bean_type->options = '';
  $bean_type->description = 'Create a block using UA Bootstrap components';
  $export['uaqs_flexible_block'] = $bean_type;

  return $export;
}
