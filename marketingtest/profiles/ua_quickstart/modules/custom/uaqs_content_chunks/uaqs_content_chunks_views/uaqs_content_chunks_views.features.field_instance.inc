<?php
/**
 * @file
 * uaqs_content_chunks_views.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_content_chunks_views_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance:
  // 'paragraphs_item-uaqs_content_chunks_view-field_uaqs_view'.
  $field_instances['paragraphs_item-uaqs_content_chunks_view-field_uaqs_view'] = array(
    'bundle' => 'uaqs_content_chunks_view',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'viewfield',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'viewfield_default',
        'weight' => 0,
      ),
      'paragraphs_editor_preview' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'paragraphs_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_view',
    'label' => 'View',
    'required' => 1,
    'settings' => array(
      'allowed_views' => array(
        'uaqs_events' => 0,
        'uaqs_hero_carousel' => 0,
        'uaqs_news' => 0,
        'uaqs_person_directory' => 0,
        'uaqs_reorder_carousel' => 0,
        'uaqs_reorder_people' => 0,
      ),
      'force_default' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'viewfield',
      'settings' => array(),
      'type' => 'viewfield_select',
      'weight' => 1,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('View');

  return $field_instances;
}
