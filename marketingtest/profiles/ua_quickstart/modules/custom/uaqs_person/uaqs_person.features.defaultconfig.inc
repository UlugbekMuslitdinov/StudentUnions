<?php

/**
 * @file
 * uaqs_person.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_person_defaultconfig_features() {
  return array(
    'uaqs_person' => array(
      'field_default_fields' => 'field_default_fields',
      'strongarm' => 'strongarm',
    ),
  );
}

/**
 * Implements hook_defaultconfig_field_default_fields().
 */
function uaqs_person_defaultconfig_field_default_fields() {
  $fields = array();

  // Exported field: 'node-uaqs_person-title_field'.
  $fields['node-uaqs_person-title_field'] = array(
    'field_config' => array(
      'active' => 1,
      'cardinality' => 1,
      'deleted' => 0,
      'entity_types' => array(),
      'field_name' => 'title_field',
      'foreign keys' => array(
        'format' => array(
          'columns' => array(
            'format' => 'format',
          ),
          'table' => 'filter_format',
        ),
      ),
      'indexes' => array(
        'format' => array(
          0 => 'format',
        ),
      ),
      'locked' => 0,
      'module' => 'text',
      'settings' => array(
        'max_length' => 255,
      ),
      'translatable' => 1,
      'type' => 'text',
    ),
    'field_instance' => array(
      'bundle' => 'uaqs_person',
      'default_value' => NULL,
      'deleted' => 0,
      'description' => '',
      'display' => array(
        'default' => array(
          'label' => 'hidden',
          'module' => 'title',
          'settings' => array(
            'enable_trim' => FALSE,
            'field_multiple_limit' => -1,
            'field_multiple_limit_offset' => 0,
            'field_multiple_limit_order' => 0,
            'title_class' => 'margin-align-top margin-zero-bottom sans text-blue h2',
            'title_link' => '',
            'title_style' => 'h1',
            'trim_length' => 50,
          ),
          'type' => 'title_linked',
          'weight' => 2,
        ),
        'full' => array(
          'label' => 'hidden',
          'module' => 'title',
          'settings' => array(
            'enable_trim' => FALSE,
            'field_multiple_limit' => -1,
            'field_multiple_limit_offset' => 0,
            'field_multiple_limit_order' => 0,
            'title_class' => 'margin-zero-top margin-zero-bottom',
            'title_link' => '',
            'title_style' => 'h2',
            'trim_length' => 50,
          ),
          'type' => 'title_linked',
          'weight' => 1,
        ),
        'teaser' => array(
          'label' => 'hidden',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 7,
        ),
        'uaqs_card' => array(
          'label' => 'hidden',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 12,
        ),
        'uaqs_sidebar_teaser_list' => array(
          'label' => 'hidden',
          'module' => 'title',
          'settings' => array(
            'enable_trim' => FALSE,
            'field_multiple_limit' => -1,
            'field_multiple_limit_offset' => 0,
            'field_multiple_limit_order' => 0,
            'title_class' => '',
            'title_link' => '',
            'title_style' => '_none',
            'trim_length' => 50,
          ),
          'type' => 'title_linked',
          'weight' => 2,
        ),
      ),
      'entity_type' => 'node',
      'fences_wrapper' => 'no_wrapper',
      'field_name' => 'title_field',
      'label' => 'Title',
      'required' => 1,
      'settings' => array(
        'hide_label' => array(
          'entity' => 'entity',
          'page' => 'page',
        ),
        'text_processing' => 0,
        'user_register_form' => FALSE,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'text',
        'settings' => array(
          'size' => 60,
        ),
        'type' => 'text_textfield',
        'weight' => 0,
      ),
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Title');

  return $fields;
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_person_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'auto_entitylabel_node_uaqs_person';
  $strongarm->value = '1';
  $export['auto_entitylabel_node_uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'auto_entitylabel_pattern_node_uaqs_person';
  $strongarm->value = '[node:field-uaqs-fname] [node:field-uaqs-lname]';
  $export['auto_entitylabel_pattern_node_uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'auto_entitylabel_php_node_uaqs_person';
  $strongarm->value = 0;
  $export['auto_entitylabel_php_node_uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_options_uaqs_person';
  $strongarm->value = array(
    0 => 'status',
    1 => 'revision',
  );
  $export['node_options_uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_preview_uaqs_person';
  $strongarm->value = '1';
  $export['node_preview_uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_submitted_uaqs_person';
  $strongarm->value = 0;
  $export['node_submitted_uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'pathauto_node_uaqs_person_pattern';
  $strongarm->value = 'person/[node:title]';
  $export['pathauto_node_uaqs_person_pattern'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'pathauto_taxonomy_term_uaqs_person_category_pattern';
  $strongarm->value = '[term:vocabulary]/[term:name]';
  $export['pathauto_taxonomy_term_uaqs_person_category_pattern'] = $strongarm;

  return $export;
}
