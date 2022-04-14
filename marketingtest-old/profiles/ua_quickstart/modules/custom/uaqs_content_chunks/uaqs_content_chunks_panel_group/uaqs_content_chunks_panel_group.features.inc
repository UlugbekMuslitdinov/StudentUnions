<?php

/**
 * @file
 * uaqs_content_chunks_panel_group.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_panel_group_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_panel_group_paragraphs_info() {
  $items = array(
    'uaqs_panel_group' => array(
      'name' => 'Panel group (Collapsible)',
      'bundle' => 'uaqs_panel_group',
      'locked' => '1',
    ),
  );
  return $items;
}
