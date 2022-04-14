<?php

/**
 * @file
 * uaqs_content_chunks_full_width_bg_wrapper.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_full_width_bg_wrapper_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_full_width_bg_wrapper_paragraphs_info() {
  $items = array(
    'uaqs_full_width_bg_wrapper' => array(
      'name' => 'Full width background wrapper',
      'bundle' => 'uaqs_full_width_bg_wrapper',
      'locked' => '1',
    ),
  );
  return $items;
}
