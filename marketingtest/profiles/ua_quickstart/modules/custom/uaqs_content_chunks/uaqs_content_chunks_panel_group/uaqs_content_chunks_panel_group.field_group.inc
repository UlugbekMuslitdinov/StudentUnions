<?php

/**
 * @file
 * uaqs_content_chunks_panel_group.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_panel_group_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_panel_group|paragraphs_item|uaqs_panel_group|default';
  $field_group->group_name = 'group_panel_group';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_panel_group';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Panel group',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_panel',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Panel group',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'panel-group',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => 'role="tablist"',
      ),
    ),
  );
  $field_groups['group_panel_group|paragraphs_item|uaqs_panel_group|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_panel|field_collection_item|field_uaqs_panel|default';
  $field_group->group_name = 'group_panel';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_panel';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Panel',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_short_title',
      1 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Panel',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'panel panel-default',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_panel|field_collection_item|field_uaqs_panel|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Panel');
  t('Panel group');

  return $field_groups;
}
