<?php

/**
 * @file
 * uaqs_content_chunks_plain_text.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_plain_text_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_plain_text_paragraphs_info() {
  $items = array(
    'uaqs_plain_text' => array(
      'name' => 'UAQS Plain Text',
      'bundle' => 'uaqs_plain_text',
      'locked' => '1',
    ),
  );
  return $items;
}
