<?php
/**
 * @file
 * uaqs_fields_telephone.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_fields_telephone_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_contact_phone'.
  $field_bases['field_uaqs_contact_phone'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_contact_phone',
    'indexes' => array(),
    'locked' => 0,
    'module' => 'telephone',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'telephone',
  );

  // Exported field_base: 'field_uaqs_phones'.
  $field_bases['field_uaqs_phones'] = array(
    'active' => 1,
    'cardinality' => -1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_phones',
    'indexes' => array(),
    'locked' => 0,
    'module' => 'telephone',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'telephone',
  );

  return $field_bases;
}
