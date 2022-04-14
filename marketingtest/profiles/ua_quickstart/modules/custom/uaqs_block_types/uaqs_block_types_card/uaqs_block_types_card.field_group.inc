<?php

/**
 * @file
 * uaqs_block_types_card.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_block_types_card_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_1|bean|uaqs_card|default';
  $field_group->group_name = 'group_card_block_1';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card Block',
    'weight' => '13',
    'children' => array(
      0 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Block',
      'instance_settings' => array(
        'classes' => 'card-block',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block_1|bean|uaqs_card|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_2|bean|uaqs_card|default';
  $field_group->group_name = 'group_card_block_2';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card Block',
    'weight' => '14',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block_2|bean|uaqs_card|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_header|bean|uaqs_card|default';
  $field_group->group_name = 'group_card_header';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card Header',
    'weight' => '11',
    'children' => array(
      0 => 'group_card_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Header',
      'instance_settings' => array(
        'classes' => 'card-header',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_header|bean|uaqs_card|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_img_overlay|bean|uaqs_card|uaqs_card_overlay';
  $field_group->group_name = 'group_card_img_overlay';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'uaqs_card_overlay';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card Image Overlay',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_link',
      1 => 'group_card_text',
      2 => 'group_card_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Image Overlay',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-img-overlay',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_img_overlay|bean|uaqs_card|uaqs_card_overlay'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_text|bean|uaqs_card|uaqs_card_overlay';
  $field_group->group_name = 'group_card_text';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'uaqs_card_overlay';
  $field_group->parent_name = 'group_card_img_overlay';
  $field_group->data = array(
    'label' => 'Card Text',
    'weight' => '10',
    'children' => array(
      0 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-text',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_text|bean|uaqs_card|uaqs_card_overlay'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_title|bean|uaqs_card|default';
  $field_group->group_name = 'group_card_title';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card_header';
  $field_group->data = array(
    'label' => 'Card Title',
    'weight' => '7',
    'children' => array(
      0 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Title',
      'instance_settings' => array(
        'classes' => 'card-title',
        'element' => 'h4',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_title|bean|uaqs_card|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_title|bean|uaqs_card|uaqs_card_overlay';
  $field_group->group_name = 'group_card_title';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'uaqs_card_overlay';
  $field_group->parent_name = 'group_card_img_overlay';
  $field_group->data = array(
    'label' => 'Card Title',
    'weight' => '9',
    'children' => array(
      0 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Title',
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
  $field_groups['group_card_title|bean|uaqs_card|uaqs_card_overlay'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|bean|uaqs_card|default';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_card_block_1',
      2 => 'group_card_block_2',
      3 => 'group_card_header',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'classes' => 'card',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|bean|uaqs_card|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|bean|uaqs_card|uaqs_card_overlay';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_card';
  $field_group->mode = 'uaqs_card_overlay';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_card_img_overlay',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card card-inverse',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|bean|uaqs_card|uaqs_card_overlay'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Card');
  t('Card Block');
  t('Card Header');
  t('Card Image Overlay');
  t('Card Text');
  t('Card Title');

  return $field_groups;
}
