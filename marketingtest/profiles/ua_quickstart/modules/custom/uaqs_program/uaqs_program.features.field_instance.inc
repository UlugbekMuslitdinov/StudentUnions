<?php

/**
 * @file
 * uaqs_program.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_program_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-uaqs_program-field_uaqs_focus_areas'.
  $field_instances['node-uaqs_program-field_uaqs_focus_areas'] = array(
    'bundle' => 'uaqs_program',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'module' => 'taxonomy',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'taxonomy_term_reference_link',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_uaqs_focus_areas',
    'label' => 'Focus Areas',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'taxonomy',
      'settings' => array(
        'autocomplete_path' => 'taxonomy/autocomplete',
        'size' => 60,
      ),
      'type' => 'taxonomy_autocomplete',
      'weight' => -4,
    ),
  );

  // Exported field_instance: 'node-uaqs_program-title_field'.
  $field_instances['node-uaqs_program-title_field'] = array(
    'bundle' => 'uaqs_program',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'title_field',
    'label' => 'Title',
    'required' => TRUE,
    'settings' => array(
      'hide_label' => array(
        'entity' => 'entity',
        'page' => 'page',
      ),
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => -5,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Focus Areas');
  t('Title');

  return $field_instances;
}
