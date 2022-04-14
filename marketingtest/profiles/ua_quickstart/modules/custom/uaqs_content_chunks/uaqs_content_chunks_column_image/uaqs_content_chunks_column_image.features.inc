<?php
/**
 * @file
 * uaqs_content_chunks_column_image.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_column_image_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_column_image_paragraphs_info() {
  $items = array(
    'uaqs_column_image' => array(
      'name' => 'Image with caption',
      'bundle' => 'uaqs_column_image',
      'locked' => '1',
    ),
  );
  return $items;
}
