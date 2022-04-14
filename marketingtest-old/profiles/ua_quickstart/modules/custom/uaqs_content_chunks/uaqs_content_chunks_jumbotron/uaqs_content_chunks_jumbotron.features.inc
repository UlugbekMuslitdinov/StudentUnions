<?php

/**
 * @file
 * uaqs_content_chunks_jumbotron.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_jumbotron_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_jumbotron_paragraphs_info() {
  $items = array(
    'uaqs_jumbotron' => array(
      'name' => 'Jumbotron',
      'bundle' => 'uaqs_jumbotron',
      'locked' => '1',
    ),
  );
  return $items;
}
