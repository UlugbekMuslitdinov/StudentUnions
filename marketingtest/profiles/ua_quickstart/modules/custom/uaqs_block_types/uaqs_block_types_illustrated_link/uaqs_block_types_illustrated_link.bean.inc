<?php
/**
 * @file
 * uaqs_block_types_illustrated_link.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_illustrated_link_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_illustrated_link';
  $bean_type->label = 'Illustrated Link';
  $bean_type->options = '';
  $bean_type->description = 'Extends the normal Link field with a small image.';
  $export['uaqs_illustrated_link'] = $bean_type;

  return $export;
}
