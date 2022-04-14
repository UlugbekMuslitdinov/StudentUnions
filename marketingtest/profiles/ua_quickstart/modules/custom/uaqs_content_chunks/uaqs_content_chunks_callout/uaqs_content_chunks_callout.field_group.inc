<?php

/**
 * @file
 * uaqs_content_chunks_callout.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_callout_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_columns|paragraphs_item|uaqs_callout|default';
  $field_group->group_name = 'group_columns';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_callout';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Columns',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_summary',
      1 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Columns',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_columns|paragraphs_item|uaqs_callout|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_display_settings|paragraphs_item|uaqs_callout|form';
  $field_group->group_name = 'group_display_settings';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_callout';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Display Settings',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_callout_border_color',
      1 => 'field_uaqs_callout_background',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-display-settings field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_display_settings|paragraphs_item|uaqs_callout|form'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Columns');
  t('Display Settings');

  return $field_groups;
}
