<?php
/**
 * @file
 * uaqs_content_chunks_carousel.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_carousel_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_caption|field_collection_item|field_uaqs_carousel|default';
  $field_group->group_name = 'group_caption';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_carousel';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Caption',
    'weight' => '6',
    'children' => array(
      0 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Caption',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'carousel-caption bg-trans-white text-blue text-center',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_caption|field_collection_item|field_uaqs_carousel|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_carousel_image|field_collection_item|field_uaqs_carousel|default';
  $field_group->group_name = 'group_carousel_image';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_carousel';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Carousel Image',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_photo',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Carousel Image',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'carousel-image',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_carousel_image|field_collection_item|field_uaqs_carousel|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_carousel_inner|paragraphs_item|uaqs_carousel|default';
  $field_group->group_name = 'group_carousel_inner';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_carousel';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Carousel Inner',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_carousel',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Carousel Inner',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'carousel-inner',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_carousel_inner|paragraphs_item|uaqs_carousel|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Caption');
  t('Carousel Image');
  t('Carousel Inner');

  return $field_groups;
}
