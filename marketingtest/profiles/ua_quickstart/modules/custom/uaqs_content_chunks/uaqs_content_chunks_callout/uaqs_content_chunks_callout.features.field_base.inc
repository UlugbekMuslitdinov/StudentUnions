<?php

/**
 * @file
 * uaqs_content_chunks_callout.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_content_chunks_callout_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_callout_background'.
  $field_bases['field_uaqs_callout_background'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_callout_background',
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        0 => 'NULL',
        1 => 'Dark Background',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_boolean',
  );

  // Exported field_base: 'field_uaqs_callout_border_color'.
  $field_bases['field_uaqs_callout_border_color'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_callout_border_color',
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        'callout-warning' => 'Warning (Adds Heading Color)',
        'callout-danger' => 'Danger (Adds Heading Color)',
        'callout-info' => 'Info (Adds Heading Color)',
        'callout-red' => 'Arizona Red',
        'callout-blue' => 'Arizona Blue',
        'callout-bloom' => 'Bloom',
        'callout-chili' => 'Chili',
        'callout-sky' => 'Sky',
        'callout-midnight' => 'Midnight',
        'callout-oasis' => 'Oasis',
        'callout-azurite' => 'Azurite',
        'callout-cool-gray' => 'Cool Gray',
        'callout-warm-gray' => 'Warm Gray',
        'callout-leaf' => 'Leaf',
        'callout-river' => 'River',
        'callout-silver' => 'Silver',
        'callout-mesa' => 'Mesa',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  return $field_bases;
}
