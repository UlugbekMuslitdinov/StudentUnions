<?php

/**
 * @file
 * uaqs_content_chunks_card_deck.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_content_chunks_card_deck_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_cards'.
  $field_bases['field_uaqs_cards'] = array(
    'active' => 1,
    'cardinality' => 3,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_cards',
    'indexes' => array(
      'revision_id' => array(
        0 => 'revision_id',
      ),
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'field_collection',
    'settings' => array(
      'hide_blank_items' => 1,
      'hide_initial_item' => FALSE,
      'path' => '',
    ),
    'translatable' => 0,
    'type' => 'field_collection',
  );

  // Exported field_base: 'field_uaqs_setting_deck_width'.
  $field_bases['field_uaqs_setting_deck_width'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_setting_deck_width',
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        'full_width' => 'Full width',
        'single_card_width' => 'Single card width',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  return $field_bases;
}
