<?php

/**
 * @file
 * uaqs_content_chunks_single_card.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_single_card_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_single_card_paragraphs_info() {
  $items = array(
    'uaqs_single_card' => array(
      'name' => 'Single Card',
      'bundle' => 'uaqs_single_card',
      'locked' => '1',
    ),
  );
  return $items;
}
