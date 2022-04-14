<?php

/**
 * @file
 * uaqs_content_chunks_well.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_well_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_well_paragraphs_info() {
  $items = array(
    'uaqs_well' => array(
      'name' => 'Well',
      'bundle' => 'uaqs_well',
      'locked' => '1',
    ),
  );
  return $items;
}
