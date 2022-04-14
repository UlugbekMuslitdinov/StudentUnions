<?php

/**
 * @file
 * uaqs_block_types_mini_blurb.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_mini_blurb_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_mini_blurb';
  $bean_type->label = 'Mini Blurb';
  $bean_type->options = '';
  $bean_type->description = 'Extends the normal Link field with a small image.';
  $export['uaqs_mini_blurb'] = $bean_type;

  return $export;
}
