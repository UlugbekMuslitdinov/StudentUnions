<?php

/**
 * @file
 * uaqs_event.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_event_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function uaqs_event_node_info() {
  $items = array(
    'uaqs_event' => array(
      'name' => t('Event'),
      'base' => 'node_content',
      'description' => t('The UA QuickStart component for calendar entries and other events.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
