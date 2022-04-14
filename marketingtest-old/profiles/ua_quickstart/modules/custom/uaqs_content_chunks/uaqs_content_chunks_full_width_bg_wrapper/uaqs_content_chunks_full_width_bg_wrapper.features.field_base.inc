<?php

/**
 * @file
 * uaqs_content_chunks_full_width_bg_wrapper.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_content_chunks_full_width_bg_wrapper_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_background_color'.
  $field_bases['field_uaqs_background_color'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_background_color',
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        'bg-red' => 'Arizona Red',
        'bg-blue' => 'Arizona Blue',
        'bg-sky' => 'Sky',
        'bg-oasis' => 'Oasis',
        'bg-azurite' => 'Azurite',
        'bg-midnight' => 'Midnight',
        'bg-bloom' => 'Bloom',
        'bg-chili' => 'Chili',
        'bg-cool-gray' => 'Cool Gray',
        'bg-warm-gray' => 'Warm Gray',
        'bg-leaf' => 'Leaf',
        'bg-river' => 'River',
        'bg-silver' => 'Silver',
        'bg-ash' => 'Ash',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  // Exported field_base: 'field_uaqs_background_pattern'.
  $field_bases['field_uaqs_background_pattern'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_background_pattern',
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        'bg-triangles-top-left' => 'Triangles Top Left',
        'bg-triangles-top-right' => 'Triangles Top Right',
        'bg-triangles-centered' => 'Triangles Centered',
        'bg-trilines' => 'Trilines',
        'bg-triangles-mosaic' => 'Triangles Mosaic (Deprecated)',
        'bg-triangles-fade' => 'Triangles Fade (Deprecated)',
        'bg-catalinas-abstract' => 'Catalinas Abstract (Deprecated)',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  return $field_bases;
}
