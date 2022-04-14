<?php
/**
 * @file
 * uaqs_navigation_select_menu.bean.inc
 */

/**
 * Implements hook_bean_admin_ui_types().
 */
function uaqs_navigation_select_menu_bean_admin_ui_types() {
  $export = array();

  $bean_type = new stdClass();
  $bean_type->disabled = FALSE; /* Edit this to true to make a default bean_type disabled initially */
  $bean_type->api_version = 5;
  $bean_type->name = 'uaqs_select_menu';
  $bean_type->label = 'Select menu';
  $bean_type->options = '';
  $bean_type->description = 'Add a select menu block with custom wrapper classes.';
  $export['uaqs_select_menu'] = $bean_type;

  return $export;
}
