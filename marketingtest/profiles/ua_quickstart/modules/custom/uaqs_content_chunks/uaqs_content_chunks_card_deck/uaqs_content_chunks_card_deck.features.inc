<?php

/**
 * @file
 * uaqs_content_chunks_card_deck.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_content_chunks_card_deck_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_card_deck_paragraphs_info() {
  $items = array(
    'uaqs_card_deck' => array(
      'name' => 'Card deck',
      'bundle' => 'uaqs_card_deck',
      'locked' => '1',
    ),
  );
  return $items;
}
