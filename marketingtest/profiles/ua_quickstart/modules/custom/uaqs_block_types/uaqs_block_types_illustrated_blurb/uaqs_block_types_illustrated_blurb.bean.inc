<?php

/**
 * @file
 * uaqs_block_types_illustrated_blurb.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_block_types_illustrated_blurb_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_illustrated_blurb';
  $bean_type->label = 'Illustrated Blurb';
  $bean_type->options = '';
  $bean_type->description = 'A short piece of text associated with an image, heading, and link to more information.';
  $export['uaqs_illustrated_blurb'] = $bean_type;

  return $export;
}
