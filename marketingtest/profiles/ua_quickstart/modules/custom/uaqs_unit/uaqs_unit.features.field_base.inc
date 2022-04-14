<?php

/**
 * @file
 * uaqs_unit.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_unit_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_focus_areas'.
  $field_bases['field_uaqs_focus_areas'] = array(
    'active' => 1,
    'cardinality' => -1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_focus_areas',
    'indexes' => array(
      'tid' => array(
        0 => 'tid',
      ),
    ),
    'locked' => 0,
    'module' => 'taxonomy',
    'settings' => array(
      'allowed_values' => array(
        0 => array(
          'vocabulary' => 'tags',
          'parent' => 0,
        ),
      ),
      'options_list_callback' => 'title_taxonomy_allowed_values',
    ),
    'translatable' => 0,
    'type' => 'taxonomy_term_reference',
  );

  return $field_bases;
}
