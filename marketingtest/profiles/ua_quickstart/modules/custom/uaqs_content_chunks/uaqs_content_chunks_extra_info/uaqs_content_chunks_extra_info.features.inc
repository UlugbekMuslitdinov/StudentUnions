<?php

/**
 * @file
 * uaqs_content_chunks_extra_info.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_extra_info_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_extra_info_paragraphs_info() {
  $items = array(
    'uaqs_extra_info' => array(
      'name' => 'Extra info',
      'bundle' => 'uaqs_extra_info',
      'locked' => '1',
    ),
  );
  return $items;
}
