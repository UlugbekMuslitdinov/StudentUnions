<?php

/**
 * @file
 * uaqs_unit.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_unit_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function uaqs_unit_node_info() {
  $items = array(
    'uaqs_unit' => array(
      'name' => t('Unit'),
      'base' => 'node_content',
      'description' => t('The UA QuickStart component that describes an academic unit.'),
      'has_title' => '1',
      'title_label' => t('Unit Name'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
