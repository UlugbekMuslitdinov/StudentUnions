<?php
/**
 * @file
 * uaqs_content_chunks_views.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_views_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_views_paragraphs_info() {
  $items = array(
    'uaqs_content_chunks_view' => array(
      'name' => 'View',
      'bundle' => 'uaqs_content_chunks_view',
      'locked' => '1',
    ),
  );
  return $items;
}
