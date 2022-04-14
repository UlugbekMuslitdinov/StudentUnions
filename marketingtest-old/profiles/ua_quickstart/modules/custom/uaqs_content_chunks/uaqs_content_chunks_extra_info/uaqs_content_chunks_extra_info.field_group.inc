<?php

/**
 * @file
 * uaqs_content_chunks_extra_info.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_extra_info_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_alignment|paragraphs_item|uaqs_extra_info|uaqs_align_left';
  $field_group->group_name = 'group_alignment';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'uaqs_align_left';
  $field_group->parent_name = 'group_aria';
  $field_group->data = array(
    'label' => 'Alignment',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_body',
      1 => 'field_uaqs_link',
      2 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Alignment',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card card-block border-top-accent-azurite mb-0',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_alignment|paragraphs_item|uaqs_extra_info|uaqs_align_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_alignment|paragraphs_item|uaqs_extra_info|uaqs_align_right';
  $field_group->group_name = 'group_alignment';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'uaqs_align_right';
  $field_group->parent_name = 'group_aria';
  $field_group->data = array(
    'label' => 'Alignment',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_body',
      1 => 'field_uaqs_link',
      2 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Alignment',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card card-block border-top-accent-azurite mb-0',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_alignment|paragraphs_item|uaqs_extra_info|uaqs_align_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_aria|paragraphs_item|uaqs_extra_info|default';
  $field_group->group_name = 'group_aria';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'aria',
    'weight' => '0',
    'children' => array(
      0 => 'group_card',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'aria',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'aside',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => 'role="complementary" aria-label="extra information"',
      ),
    ),
  );
  $field_groups['group_aria|paragraphs_item|uaqs_extra_info|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_aria|paragraphs_item|uaqs_extra_info|uaqs_align_left';
  $field_group->group_name = 'group_aria';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'uaqs_align_left';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'aria',
    'weight' => '0',
    'children' => array(
      0 => 'group_alignment',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'aria',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'aside',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => 'role="complementary" aria-label="extra information"',
      ),
    ),
  );
  $field_groups['group_aria|paragraphs_item|uaqs_extra_info|uaqs_align_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_aria|paragraphs_item|uaqs_extra_info|uaqs_align_right';
  $field_group->group_name = 'group_aria';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'uaqs_align_right';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'aria',
    'weight' => '0',
    'children' => array(
      0 => 'group_alignment',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'aria',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'aside',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => 'role="complementary" aria-label="extra information"',
      ),
    ),
  );
  $field_groups['group_aria|paragraphs_item|uaqs_extra_info|uaqs_align_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_aside|paragraphs_item|uaqs_extra_info|default';
  $field_group->group_name = 'group_aside';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'aside',
    'weight' => '0',
    'children' => array(
      0 => 'group_card',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'aside',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'aside',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => 'role="complementary"',
      ),
    ),
  );
  $field_groups['group_aside|paragraphs_item|uaqs_extra_info|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_aside|paragraphs_item|uaqs_extra_info|uaqs_align_left';
  $field_group->group_name = 'group_aside';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'uaqs_align_left';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'aside',
    'weight' => '0',
    'children' => array(
      0 => 'group_alignment',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'aside',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'aside',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => 'role="complementary"',
      ),
    ),
  );
  $field_groups['group_aside|paragraphs_item|uaqs_extra_info|uaqs_align_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_aside|paragraphs_item|uaqs_extra_info|uaqs_align_right';
  $field_group->group_name = 'group_aside';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'uaqs_align_right';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'aside',
    'weight' => '0',
    'children' => array(
      0 => 'group_alignment',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'aside',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'aside',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => 'role="complementary"',
      ),
    ),
  );
  $field_groups['group_aside|paragraphs_item|uaqs_extra_info|uaqs_align_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|paragraphs_item|uaqs_extra_info|default';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_extra_info';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_aria';
  $field_group->data = array(
    'label' => 'card',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_body',
      1 => 'field_uaqs_link',
      2 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card card-block border-top-accent-azurite mb-0',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|paragraphs_item|uaqs_extra_info|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Alignment');
  t('aria');
  t('aside');
  t('card');

  return $field_groups;
}
