<?php

/**
 * @file
 * uaqs_publication.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_publication_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function uaqs_publication_node_info() {
  $items = array(
    'uaqs_pub' => array(
      'name' => t('Publication'),
      'base' => 'node_content',
      'description' => t('The UA QuickStart component that describes a publication reference.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
