<?php

/**
 * @file
 * uaqs_block_types_card.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_card_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_card';
  $bean_type->label = 'Card';
  $bean_type->options = '';
  $bean_type->description = 'Inflexible UA Bootstrap style card.';
  $export['uaqs_card'] = $bean_type;

  return $export;
}
