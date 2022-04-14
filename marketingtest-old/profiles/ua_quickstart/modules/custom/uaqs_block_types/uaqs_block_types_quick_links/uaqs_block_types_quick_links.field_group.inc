<?php
/**
 * @file
 * uaqs_block_types_quick_links.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_block_types_quick_links_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|bean|uaqs_quick_links|default';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_quick_links';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '0',
    'children' => array(
      0 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'h3 mt-4',
        'element' => 'h2',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_heading|bean|uaqs_quick_links|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_list_group|bean|uaqs_quick_links|default';
  $field_group->group_name = 'group_list_group';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_quick_links';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'List Group',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_links',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'List Group',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'list-group margin-align-middle',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_list_group|bean|uaqs_quick_links|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Heading');
  t('List Group');

  return $field_groups;
}
