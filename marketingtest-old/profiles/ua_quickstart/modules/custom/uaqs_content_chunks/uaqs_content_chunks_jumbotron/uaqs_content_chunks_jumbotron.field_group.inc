<?php

/**
 * @file
 * uaqs_content_chunks_jumbotron.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_jumbotron_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_jumbotron_body|paragraphs_item|jumbotron|default';
  $field_group->group_name = 'group_jumbotron_body';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_jumbotron';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_jumbotron';
  $field_group->data = array(
    'label' => 'Body',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Body',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_jumbotron_body|paragraphs_item|jumbotron|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_jumbotron_link|paragraphs_item|jumbotron|default';
  $field_group->group_name = 'group_jumbotron_link';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_jumbotron';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_jumbotron';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '6',
    'children' => array(
      0 => 'field_uaqs_links',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_jumbotron_link|paragraphs_item|jumbotron|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_jumbotron|paragraphs_item|jumbotron|default';
  $field_group->group_name = 'group_jumbotron';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_jumbotron';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Jumbotron',
    'weight' => '0',
    'children' => array(
      0 => 'group_jumbotron_body',
      1 => 'group_jumbotron_link',
      2 => 'group_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Jumbotron',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'jumbotron',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_jumbotron|paragraphs_item|jumbotron|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_title|paragraphs_item|jumbotron|default';
  $field_group->group_name = 'group_title';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_jumbotron';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_jumbotron';
  $field_group->data = array(
    'label' => 'Title',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Title',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'margin-align-middle margin-zero-top',
        'element' => 'h1',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_title|paragraphs_item|jumbotron|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Body');
  t('Jumbotron');
  t('Link');
  t('Title');

  return $field_groups;
}
