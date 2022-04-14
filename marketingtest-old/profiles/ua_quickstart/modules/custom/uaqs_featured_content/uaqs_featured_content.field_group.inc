<?php

/**
 * @file
 * uaqs_featured_content.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_featured_content_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|node|uaqs_carousel_item|uaqs_card';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_summary_short',
      1 => 'group_text_red',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block card-text',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block|node|uaqs_carousel_item|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_h2|node|uaqs_carousel_item|uaqs_featured_content';
  $field_group->group_name = 'group_h2';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_featured_content';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'h2',
    'weight' => '0',
    'children' => array(
      0 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'h2',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'no-widows remove-external-link-icon',
        'element' => 'h2',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_h2|node|uaqs_carousel_item|uaqs_featured_content'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_h4|node|uaqs_carousel_item|uaqs_card';
  $field_group->group_name = 'group_h4';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'h4',
    'weight' => '3',
    'children' => array(
      0 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'h4',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-title',
        'element' => 'h4',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_h4|node|uaqs_carousel_item|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_carousel_item|uaqs_card';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_card_block',
      2 => 'group_h4',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-center link-container height-100 feature-reveal',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|node|uaqs_carousel_item|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_carousel_item|uaqs_featured_content';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_featured_content';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Pseudo Link',
    'weight' => '2',
    'children' => array(
      0 => 'group_span',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Pseudo Link',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'psuedo-link',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_link|node|uaqs_carousel_item|uaqs_featured_content'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_short_summary|node|uaqs_carousel_item|uaqs_featured_content';
  $field_group->group_name = 'group_short_summary';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_featured_content';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Short summary',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Short summary',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'field-uaqs-summary-short',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_short_summary|node|uaqs_carousel_item|uaqs_featured_content'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_span|node|uaqs_carousel_item|uaqs_featured_content';
  $field_group->group_name = 'group_span';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_featured_content';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'External link span',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'External link span',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_span|node|uaqs_carousel_item|uaqs_featured_content'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_strong|node|uaqs_carousel_item|uaqs_card';
  $field_group->group_name = 'group_strong';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_text_red';
  $field_group->data = array(
    'label' => 'Strong',
    'weight' => '9',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Strong',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'strong',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_strong|node|uaqs_carousel_item|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_red|node|uaqs_carousel_item|uaqs_card';
  $field_group->group_name = 'group_text_red';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_carousel_item';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Red text',
    'weight' => '7',
    'children' => array(
      0 => 'group_strong',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Red text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-red30b btn-arrow',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_red|node|uaqs_carousel_item|uaqs_card'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Card block');
  t('External link span');
  t('Link');
  t('Pseudo Link');
  t('Red text');
  t('Short summary');
  t('Strong');
  t('h2');
  t('h4');

  return $field_groups;
}
