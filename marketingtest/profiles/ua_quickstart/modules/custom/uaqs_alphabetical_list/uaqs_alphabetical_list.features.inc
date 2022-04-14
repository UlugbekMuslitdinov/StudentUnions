<?php
/**
 * @file
 * uaqs_alphabetical_list.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_alphabetical_list_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function uaqs_alphabetical_list_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function uaqs_alphabetical_list_node_info() {
  $items = array(
    'uaqs_major' => array(
      'name' => t('Major'),
      'base' => 'node_content',
      'description' => t('Use this content type to display majors on your site.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
