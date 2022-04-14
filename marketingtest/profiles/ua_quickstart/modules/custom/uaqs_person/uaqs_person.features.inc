<?php

/**
 * @file
 * uaqs_person.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_person_ctools_plugin_api($module = NULL, $api = NULL) {
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
function uaqs_person_node_info() {
  $items = array(
    'uaqs_person' => array(
      'name' => t('Person'),
      'base' => 'node_content',
      'description' => t('The UA QuickStart component for the contact information and brief biography of a person.'),
      'has_title' => '1',
      'title_label' => t('Full Name'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
