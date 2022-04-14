<?php
/**
 * @file
 * uaqs_alphabetical_list.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_alphabetical_list_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|node|uaqs_major|default';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '1',
    'children' => array(
      0 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'h4 text-blue30w margin-zero-top margin-zero-bottom media-heading',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_heading|node|uaqs_major|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|node|uaqs_major|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '3',
    'children' => array(
      0 => 'title_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'h4 text-blue30w margin-zero-top margin-zero-bottom media-heading',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_heading|node|uaqs_major|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_major|default';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '5',
    'children' => array(
      0 => 'group_media',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'list-link-block remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|node|uaqs_major|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_major|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = 'group_uaqs_search_result';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '1',
    'children' => array(
      0 => 'group_media',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'list-link-block remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|node|uaqs_major|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_body|node|uaqs_major|default';
  $field_group->group_name = 'group_media_body';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media Body',
    'weight' => '5',
    'children' => array(
      0 => 'group_heading',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media Body',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-body',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_body|node|uaqs_major|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_body|node|uaqs_major|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_media_body';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media Body',
    'weight' => '4',
    'children' => array(
      0 => 'group_heading',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media Body',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-body',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_body|node|uaqs_major|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media|node|uaqs_major|default';
  $field_group->group_name = 'group_media';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Media',
    'weight' => '5',
    'children' => array(
      0 => 'group_media_body',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media|node|uaqs_major|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media|node|uaqs_major|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_media';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Media',
    'weight' => '1',
    'children' => array(
      0 => 'group_media_body',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media|node|uaqs_major|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_uaqs_search_result|node|uaqs_major|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_uaqs_search_result';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_major';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Search result',
    'weight' => '0',
    'children' => array(
      0 => 'group_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Search result',
      'instance_settings' => array(
        'id' => '',
        'classes' => ' uaqs-js-search-result',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_uaqs_search_result|node|uaqs_major|uaqs_sidebar_teaser_list'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Heading');
  t('Link');
  t('Media');
  t('Media Body');
  t('Search result');

  return $field_groups;
}
