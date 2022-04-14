<?php

/**
 * @file
 * uaqs_content_chunks_callout.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_callout_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_callout_paragraphs_info() {
  $items = array(
    'uaqs_callout' => array(
      'name' => 'Callout',
      'bundle' => 'uaqs_callout',
      'locked' => '1',
    ),
  );
  return $items;
}
