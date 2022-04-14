<?php
/**
 * @file
 * uaqs_fields_email.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_fields_email_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_contact_email'.
  $field_bases['field_uaqs_contact_email'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_contact_email',
    'indexes' => array(),
    'locked' => 0,
    'module' => 'email',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'email',
  );

  // Exported field_base: 'field_uaqs_email'.
  $field_bases['field_uaqs_email'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_email',
    'indexes' => array(),
    'locked' => 0,
    'module' => 'email',
    'settings' => array(),
    'translatable' => 0,
    'type' => 'email',
  );

  return $field_bases;
}
