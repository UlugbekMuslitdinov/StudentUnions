<?php

/**
 * @file
 * uaqs_content_chunks.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_button|node|uaqs_flexible_page|teaser';
  $field_group->group_name = 'group_button';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'teaser';
  $field_group->parent_name = 'group_column_2';
  $field_group->data = array(
    'label' => 'Button',
    'weight' => '11',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Button',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'btn btn-primary mt-2',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_button|node|uaqs_flexible_page|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_button|node|uaqs_flexible_page|uaqs_card';
  $field_group->group_name = 'group_button';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Button',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Button',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'btn btn-default btn-small btn-block psuedo-link',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_button|node|uaqs_flexible_page|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|node|uaqs_flexible_page|uaqs_card';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_summary',
      1 => 'group_button',
      2 => 'group_h4',
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
  $field_groups['group_card_block|node|uaqs_flexible_page|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|node|uaqs_flexible_page|uaqs_card';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_card_block',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'mb-0',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|node|uaqs_flexible_page|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_categorization|node|uaqs_flexible_page|form';
  $field_group->group_name = 'group_categorization';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Categorization',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_flexible_category',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-categorization field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_categorization|node|uaqs_flexible_page|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_category|node|uaqs_flexible_page|teaser';
  $field_group->group_name = 'group_category';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'teaser';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Category',
    'weight' => '9',
    'children' => array(
      0 => 'field_uaqs_flexible_category',
    ),
    'format_type' => 'hidden',
    'format_settings' => array(
      'label' => 'Category',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'label label-muted m-0',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
      'formatter' => '',
    ),
  );
  $field_groups['group_category|node|uaqs_flexible_page|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_1|node|uaqs_flexible_page|teaser';
  $field_group->group_name = 'group_column_1';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'teaser';
  $field_group->parent_name = 'group_row_1';
  $field_group->data = array(
    'label' => 'Column 1',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_photo',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column 1',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-4 p-0',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_1|node|uaqs_flexible_page|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_2|node|uaqs_flexible_page|teaser';
  $field_group->group_name = 'group_column_2';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'teaser';
  $field_group->parent_name = 'group_row_1';
  $field_group->data = array(
    'label' => 'Column 2',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_flexible_page_sub',
      1 => 'field_uaqs_short_title',
      2 => 'field_uaqs_summary',
      3 => 'group_button',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column 2',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-8 p-0 px-md-3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_2|node|uaqs_flexible_page|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_h4|node|uaqs_flexible_page|uaqs_card';
  $field_group->group_name = 'group_h4';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-title h3',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_h4|node|uaqs_flexible_page|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|node|uaqs_flexible_page|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_short_title',
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
  $field_groups['group_heading|node|uaqs_flexible_page|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_flexible_page|uaqs_card';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '0',
    'children' => array(
      0 => 'group_card',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'list-link-block p-0 m-0 remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|node|uaqs_flexible_page|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_flexible_page|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '0',
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
  $field_groups['group_link|node|uaqs_flexible_page|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_body|node|uaqs_flexible_page|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_media_body';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media Body',
    'weight' => '3',
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
  $field_groups['group_media_body|node|uaqs_flexible_page|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media|node|uaqs_flexible_page|uaqs_sidebar_teaser_list';
  $field_group->group_name = 'group_media';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'uaqs_sidebar_teaser_list';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Media',
    'weight' => '4',
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
  $field_groups['group_media|node|uaqs_flexible_page|uaqs_sidebar_teaser_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_publication|node|uaqs_flexible_page|form';
  $field_group->group_name = 'group_publication';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'form';
  $field_group->parent_name = 'group_uaqs_summary_fields';
  $field_group->data = array(
    'label' => 'Publication',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_link',
      1 => 'field_uaqs_short_title',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'label' => 'Publication',
      'instance_settings' => array(
        'required_fields' => 1,
        'id' => '',
        'classes' => 'group-publication field-group-fieldset',
        'description' => 'Replace the token [site:name] to customize your link output.',
      ),
      'formatter' => 'collapsible',
    ),
  );
  $field_groups['group_publication|node|uaqs_flexible_page|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row_1|node|uaqs_flexible_page|teaser';
  $field_group->group_name = 'group_row_1';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'teaser';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Row 1',
    'weight' => '0',
    'children' => array(
      0 => 'group_column_1',
      1 => 'group_column_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row 1',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row card card-block mx-0',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row_1|node|uaqs_flexible_page|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_uaqs_main_content|node|uaqs_flexible_page|form';
  $field_group->group_name = 'group_uaqs_main_content';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Main content',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_flexible_page_sub',
      1 => 'field_uaqs_main_content',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-uaqs-main-content field-group-fieldset',
        'required_fields' => 1,
        'id' => '',
      ),
    ),
  );
  $field_groups['group_uaqs_main_content|node|uaqs_flexible_page|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_uaqs_placement_fields|node|uaqs_flexible_page|form';
  $field_group->group_name = 'group_uaqs_placement_fields';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Placement',
    'weight' => '6',
    'children' => array(
      0 => 'field_uaqs_flexible_category',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-uaqs-placement-fields field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_uaqs_placement_fields|node|uaqs_flexible_page|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_uaqs_summary_fields|node|uaqs_flexible_page|form';
  $field_group->group_name = 'group_uaqs_summary_fields';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_flexible_page';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Summary fields',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'field_uaqs_summary',
      2 => 'group_publication',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Summary fields',
      'instance_settings' => array(
        'required_fields' => 0,
        'classes' => '',
        'description' => 'These fields appear in display modes other that the full page view mode.',
      ),
      'formatter' => 'closed',
    ),
  );
  $field_groups['group_uaqs_summary_fields|node|uaqs_flexible_page|form'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Button');
  t('Card');
  t('Card block');
  t('Categorization');
  t('Category');
  t('Column 1');
  t('Column 2');
  t('Heading');
  t('Link');
  t('Main content');
  t('Media');
  t('Media Body');
  t('Placement');
  t('Publication');
  t('Row 1');
  t('Summary fields');

  return $field_groups;
}
