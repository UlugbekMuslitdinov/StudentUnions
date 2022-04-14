<?php

/**
 * @file
 * uaqs_content_chunks.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "picture" && $api == "default_picture_mapping") {
    return array("version" => "2");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function uaqs_content_chunks_node_info() {
  $items = array(
    'uaqs_flexible_page' => array(
      'name' => t('Flexible Page'),
      'base' => 'node_content',
      'description' => t('The UA QuickStart component for pages containing content chunks (Paragraphs).'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
