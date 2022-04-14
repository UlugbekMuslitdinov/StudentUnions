<?php

/**
 * @file
 * uaqs_block_types_statement.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_statement_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_statement';
  $bean_type->label = 'Statement';
  $bean_type->options = '';
  $bean_type->description = 'Freestanding text with an optional link, for mission statements and similar sections.';
  $export['uaqs_statement'] = $bean_type;

  return $export;
}
