<?php

/**
 * @file
 * uaqs_content_chunks_single_card.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_single_card_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|paragraphs_item|uaqs_single_card|default';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_single_card';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_short_title',
      1 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
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
  $field_groups['group_card_block|paragraphs_item|uaqs_single_card|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_link|paragraphs_item|uaqs_single_card|default';
  $field_group->group_name = 'group_card_link';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_single_card';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card link',
    'weight' => '10',
    'children' => array(
      0 => 'field_uaqs_links',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card link',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_link|paragraphs_item|uaqs_single_card|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|paragraphs_item|uaqs_single_card|default';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_single_card';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '1',
    'children' => array(
      0 => 'group_card_block',
      1 => 'group_card_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card ',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|paragraphs_item|uaqs_single_card|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Card');
  t('Card block');
  t('Card link');

  return $field_groups;
}
