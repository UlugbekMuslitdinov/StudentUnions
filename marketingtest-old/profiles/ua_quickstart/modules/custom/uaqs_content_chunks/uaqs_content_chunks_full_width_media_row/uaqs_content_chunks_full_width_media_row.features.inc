<?php

/**
 * @file
 * uaqs_content_chunks_full_width_media_row.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_full_width_media_row_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_full_width_media_row_paragraphs_info() {
  $items = array(
    'uaqs_full_width_media_row' => array(
      'name' => 'Full width media row',
      'bundle' => 'uaqs_full_width_media_row',
      'locked' => '1',
    ),
  );
  return $items;
}
