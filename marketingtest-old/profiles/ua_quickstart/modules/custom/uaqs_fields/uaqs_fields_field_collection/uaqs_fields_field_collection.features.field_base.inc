<?php
/**
 * @file
 * uaqs_fields_field_collection.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_fields_field_collection_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_contacts'.
  $field_bases['field_uaqs_contacts'] = array(
    'active' => 1,
    'cardinality' => -1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_contacts',
    'indexes' => array(
      'revision_id' => array(
        0 => 'revision_id',
      ),
    ),
    'locked' => 0,
    'module' => 'field_collection',
    'settings' => array(
      'hide_blank_items' => 1,
      'path' => '',
    ),
    'translatable' => 0,
    'type' => 'field_collection',
  );

  return $field_bases;
}
