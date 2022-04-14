<?php

/**
 * @file
 * uaqs_block_types_related_links.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_related_links_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_related_links';
  $bean_type->label = 'Related Links';
  $bean_type->options = '';
  $bean_type->description = 'Add up to three links to a block with a graphical background pattern.';
  $export['uaqs_related_links'] = $bean_type;

  return $export;
}
