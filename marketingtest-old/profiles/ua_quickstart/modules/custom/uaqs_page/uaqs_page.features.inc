<?php

/**
 * @file
 * uaqs_page.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_page_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function uaqs_page_node_info() {
  $items = array(
    'uaqs_page' => array(
      'name' => t('Basic page'),
      'base' => 'node_content',
      'description' => t('The UA QuickStart component for basic page content. Use basic pages for your static content, such as an \'About us\' page.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
