<?php

/**
 * @file
 * uaqs_block_types_related_links.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_block_types_related_links_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_block_admin|bean|uaqs_related_links|form';
  $field_group->group_name = 'group_block_admin';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_related_links';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Administration',
    'weight' => '7',
    'children' => array(
      0 => 'title_field',
      1 => 'label',
      2 => 'revision',
      3 => 'view_mode',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => '',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_block_admin|bean|uaqs_related_links|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|bean|uaqs_related_links|default';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_related_links';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Wrapper',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_cta',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'bg-trilines border-top-accent-azurite',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|bean|uaqs_related_links|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_title|field_collection_item|field_uaqs_cta|default';
  $field_group->group_name = 'group_title';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cta';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Title',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Title',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-blue h2',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_title|field_collection_item|field_uaqs_cta|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Administration');
  t('Title');
  t('Wrapper');

  return $field_groups;
}
