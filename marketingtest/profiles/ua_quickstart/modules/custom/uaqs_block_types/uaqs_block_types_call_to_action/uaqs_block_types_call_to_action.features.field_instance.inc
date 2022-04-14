<?php
/**
 * @file
 * uaqs_block_types_call_to_action.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_block_types_call_to_action_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'bean-uaqs_call_to_action-field_uaqs_link'.
  $field_instances['bean-uaqs_call_to_action-field_uaqs_link'] = array(
    'bundle' => 'uaqs_call_to_action',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_default',
        'weight' => 1,
      ),
    ),
    'entity_type' => 'bean',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_link',
    'label' => 'Link',
    'required' => 0,
    'settings' => array(
      'absolute_url' => 1,
      'attributes' => array(
        'class' => 'gta-cta-header-buttons btn btn-hollow-default btn-block',
        'configurable_class' => 1,
        'configurable_title' => 0,
        'rel' => '',
        'target' => 'default',
        'title' => '',
      ),
      'display' => array(
        'url_cutoff' => 80,
      ),
      'enable_tokens' => 1,
      'rel_remove' => 'default',
      'title' => 'required',
      'title_label_use_field_label' => 0,
      'title_maxlength' => 128,
      'title_value' => '',
      'url' => 0,
      'user_register_form' => FALSE,
      'validate_url' => 0,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'link',
      'settings' => array(),
      'type' => 'link_field',
      'weight' => 2,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Link');

  return $field_instances;
}
