<?php

/**
 * @file
 * uaqs_content_chunks_marquee.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_marquee_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_marquee_paragraphs_info() {
  $items = array(
    'uaqs_content_chunks_marquee' => array(
      'name' => 'Marquee',
      'bundle' => 'uaqs_content_chunks_marquee',
      'locked' => '1',
    ),
  );
  return $items;
}
