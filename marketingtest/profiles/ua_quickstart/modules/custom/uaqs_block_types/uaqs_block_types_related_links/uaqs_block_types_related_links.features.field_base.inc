<?php

/**
 * @file
 * uaqs_block_types_related_links.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_block_types_related_links_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_cta'.
  $field_bases['field_uaqs_cta'] = array(
    'active' => 1,
    'cardinality' => 3,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_cta',
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
      'hide_initial_item' => 0,
      'path' => '',
    ),
    'translatable' => 0,
    'type' => 'field_collection',
  );

  return $field_bases;
}
