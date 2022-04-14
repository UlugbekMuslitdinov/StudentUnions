<?php

/**
 * @file
 * uaqs_fields_media.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_fields_media_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_16x9|file|audio|uaqs_large';
  $field_group->group_name = 'group_16x9';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '16:9 responsive	',
    'weight' => '3',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '16:9 responsive	',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-16by9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_16x9|file|audio|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_16x9|file|audio|uaqs_medium';
  $field_group->group_name = 'group_16x9';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '16:9 responsive	',
    'weight' => '3',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '16:9 responsive	',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-16by9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_16x9|file|audio|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_16x9|file|audio|uaqs_small';
  $field_group->group_name = 'group_16x9';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '16:9 responsive	',
    'weight' => '3',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '16:9 responsive	',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-16by9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_16x9|file|audio|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_16x9|file|video|default';
  $field_group->group_name = 'group_16x9';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '16:9 responsive',
    'weight' => '0',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '16:9 responsive',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-16by9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_16x9|file|video|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_16x9|file|video|uaqs_large';
  $field_group->group_name = 'group_16x9';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '16:9 responsive',
    'weight' => '0',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '16:9 responsive',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-16by9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_16x9|file|video|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_16x9|file|video|uaqs_medium';
  $field_group->group_name = 'group_16x9';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '16:9 responsive',
    'weight' => '0',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '16:9 responsive',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-16by9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_16x9|file|video|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_16x9|file|video|uaqs_small';
  $field_group->group_name = 'group_16x9';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '16:9 responsive',
    'weight' => '0',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '16:9 responsive',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-16by9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_16x9|file|video|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_4x3|file|audio|uaqs_square';
  $field_group->group_name = 'group_4x3';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '4:3 responsive',
    'weight' => '3',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '4:3 responsive',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-4by3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_4x3|file|audio|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_4x3|file|video|uaqs_square';
  $field_group->group_name = 'group_4x3';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => '4:3 responsive',
    'weight' => '3',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => '4:3 responsive',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'embed-responsive embed-responsive-4by3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_4x3|file|video|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_2|file|document|uaqs_large';
  $field_group->group_name = 'group_card_block_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_column_bottom';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '9',
    'children' => array(
      0 => 'uaqs_file_separator',
      1 => 'uaqs_file_size',
      2 => 'group_view_link',
      3 => 'group_download_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block well no-margin',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block_2|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_2|file|document|uaqs_medium';
  $field_group->group_name = 'group_card_block_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_column_bottom';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '2',
    'children' => array(
      0 => 'uaqs_file_separator',
      1 => 'uaqs_file_size',
      2 => 'group_view_link',
      3 => 'group_download_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block well no-margin',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block_2|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_2|file|document|uaqs_small';
  $field_group->group_name = 'group_card_block_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_column_bottom';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '5',
    'children' => array(
      0 => 'uaqs_file_separator',
      1 => 'uaqs_file_size',
      2 => 'group_view_link',
      3 => 'group_download_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block well no-margin',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block_2|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_2|file|document|uaqs_square';
  $field_group->group_name = 'group_card_block_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_column_bottom';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '3',
    'children' => array(
      0 => 'uaqs_file_separator',
      1 => 'group_view_link',
      2 => 'group_download_link',
      3 => 'group_size',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block well no-margin',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block_2|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|file|document|uaqs_large';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_column_left';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_download_description',
      1 => 'field_uaqs_summary',
      2 => 'group_card_title',
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
  $field_groups['group_card_block|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|file|document|uaqs_medium';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_column_left';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_download_description',
      1 => 'field_uaqs_summary',
      2 => 'group_card_title',
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
  $field_groups['group_card_block|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|file|document|uaqs_small';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_column_left';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '4',
    'children' => array(
      0 => 'group_card_title',
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
  $field_groups['group_card_block|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|file|document|uaqs_square';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_column';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_download_description',
      1 => 'field_uaqs_summary',
      2 => 'group_card_title',
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
  $field_groups['group_card_block|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_title|file|document|uaqs_large';
  $field_group->group_name = 'group_card_title';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Card title',
    'weight' => '5',
    'children' => array(
      0 => 'filename_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card title',
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
  $field_groups['group_card_title|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_title|file|document|uaqs_medium';
  $field_group->group_name = 'group_card_title';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Card title',
    'weight' => '8',
    'children' => array(
      0 => 'filename_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card title',
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
  $field_groups['group_card_title|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_title|file|document|uaqs_small';
  $field_group->group_name = 'group_card_title';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Card title',
    'weight' => '5',
    'children' => array(
      0 => 'filename_field',
      1 => 'field_uaqs_download_description',
      2 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card title',
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
  $field_groups['group_card_title|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_title|file|document|uaqs_square';
  $field_group->group_name = 'group_card_title';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Card title',
    'weight' => '2',
    'children' => array(
      0 => 'filename_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card title',
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
  $field_groups['group_card_title|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|file|document|uaqs_large';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '0',
    'children' => array(
      0 => 'group_row',
      1 => 'group_row_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|file|document|uaqs_medium';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '0',
    'children' => array(
      0 => 'group_row',
      1 => 'group_row_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|file|document|uaqs_small';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '3',
    'children' => array(
      0 => 'group_row',
      1 => 'group_row_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|file|document|uaqs_square';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '0',
    'children' => array(
      0 => 'group_row',
      1 => 'group_row_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_cite|file|image|default';
  $field_group->group_name = 'group_cite';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_figcaption';
  $field_group->data = array(
    'label' => 'Cite',
    'weight' => '10',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Cite',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'small clearfix',
        'element' => 'cite',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_cite|file|image|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_cite|file|image|uaqs_large';
  $field_group->group_name = 'group_cite';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_figcaption';
  $field_group->data = array(
    'label' => 'Cite',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Cite',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'small clearfix',
        'element' => 'cite',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_cite|file|image|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_cite|file|image|uaqs_medium';
  $field_group->group_name = 'group_cite';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_figcaption';
  $field_group->data = array(
    'label' => 'Cite',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Cite',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'small clearfix',
        'element' => 'cite',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_cite|file|image|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_cite|file|image|uaqs_small';
  $field_group->group_name = 'group_cite';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_figcaption';
  $field_group->data = array(
    'label' => 'Cite',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Cite',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'small clearfix',
        'element' => 'cite',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_cite|file|image|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_cite|file|image|uaqs_square';
  $field_group->group_name = 'group_cite';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_figcaption';
  $field_group->data = array(
    'label' => 'Cite',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Cite',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'small clearfix',
        'element' => 'cite',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_cite|file|image|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_bottom|file|document|uaqs_large';
  $field_group->group_name = 'group_column_bottom';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_row_2';
  $field_group->data = array(
    'label' => 'Column bottom',
    'weight' => '8',
    'children' => array(
      0 => 'group_card_block_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column bottom',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_bottom|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_bottom|file|document|uaqs_medium';
  $field_group->group_name = 'group_column_bottom';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_row_2';
  $field_group->data = array(
    'label' => 'Column bottom',
    'weight' => '1',
    'children' => array(
      0 => 'group_card_block_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column bottom',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_bottom|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_bottom|file|document|uaqs_small';
  $field_group->group_name = 'group_column_bottom';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_row_2';
  $field_group->data = array(
    'label' => 'Column bottom',
    'weight' => '4',
    'children' => array(
      0 => 'group_card_block_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column bottom',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_bottom|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_bottom|file|document|uaqs_square';
  $field_group->group_name = 'group_column_bottom';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_row_2';
  $field_group->data = array(
    'label' => 'Column bottom',
    'weight' => '8',
    'children' => array(
      0 => 'group_card_block_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column bottom',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_bottom|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_left|file|document|uaqs_large';
  $field_group->group_name = 'group_column_left';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column left',
    'weight' => '8',
    'children' => array(
      0 => 'group_card_block',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column left',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_left|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_left|file|document|uaqs_medium';
  $field_group->group_name = 'group_column_left';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column left',
    'weight' => '6',
    'children' => array(
      0 => 'group_card_block',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column left',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_left|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_left|file|document|uaqs_small';
  $field_group->group_name = 'group_column_left';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column left',
    'weight' => '5',
    'children' => array(
      0 => 'group_card_block',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column left',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-9',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_left|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_right|file|document|uaqs_large';
  $field_group->group_name = 'group_column_right';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column right',
    'weight' => '9',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column right',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_right|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_right|file|document|uaqs_medium';
  $field_group->group_name = 'group_column_right';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column right',
    'weight' => '7',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column right',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_right|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_right|file|document|uaqs_small';
  $field_group->group_name = 'group_column_right';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column right',
    'weight' => '6',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column right',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_right|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column|file|document|uaqs_square';
  $field_group->group_name = 'group_column';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column',
    'weight' => '12',
    'children' => array(
      0 => 'file',
      1 => 'group_card_block',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_download_link|file|document|uaqs_large';
  $field_group->group_name = 'group_download_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'Download link',
    'weight' => '12',
    'children' => array(
      0 => 'uaqs_file_download_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Download link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:download-url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_download_link|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_download_link|file|document|uaqs_media_list';
  $field_group->group_name = 'group_download_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Download link',
    'weight' => '8',
    'children' => array(
      0 => 'uaqs_file_download_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Download link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:download-url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_download_link|file|document|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_download_link|file|document|uaqs_medium';
  $field_group->group_name = 'group_download_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'Download link',
    'weight' => '7',
    'children' => array(
      0 => 'uaqs_file_download_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Download link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:download-url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_download_link|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_download_link|file|document|uaqs_small';
  $field_group->group_name = 'group_download_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'Download link',
    'weight' => '7',
    'children' => array(
      0 => 'uaqs_file_download_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Download link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:download-url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_download_link|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_download_link|file|document|uaqs_square';
  $field_group->group_name = 'group_download_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'Download link',
    'weight' => '12',
    'children' => array(
      0 => 'uaqs_file_download_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Download link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:download-url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_download_link|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figcaption|file|image|default';
  $field_group->group_name = 'group_figcaption';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_figure';
  $field_group->data = array(
    'label' => 'Figcaption',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_cite',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figcaption',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figcaption|file|image|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figcaption|file|image|uaqs_large';
  $field_group->group_name = 'group_figcaption';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_figure';
  $field_group->data = array(
    'label' => 'Figcaption',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_cite',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figcaption',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figcaption|file|image|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figcaption|file|image|uaqs_medium';
  $field_group->group_name = 'group_figcaption';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_figure';
  $field_group->data = array(
    'label' => 'Figcaption',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_cite',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figcaption',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figcaption|file|image|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figcaption|file|image|uaqs_small';
  $field_group->group_name = 'group_figcaption';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_figure';
  $field_group->data = array(
    'label' => 'Figcaption',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_cite',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figcaption',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figcaption|file|image|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figcaption|file|image|uaqs_square';
  $field_group->group_name = 'group_figcaption';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_figure';
  $field_group->data = array(
    'label' => 'Figcaption',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_cite',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figcaption',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figcaption|file|image|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figure|file|image|default';
  $field_group->group_name = 'group_figure';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Figure',
    'weight' => '0',
    'children' => array(
      0 => 'file',
      1 => 'group_figcaption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figure',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figure',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figure|file|image|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figure|file|image|uaqs_large';
  $field_group->group_name = 'group_figure';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Figure',
    'weight' => '0',
    'children' => array(
      0 => 'file',
      1 => 'group_figcaption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figure',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figure',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figure|file|image|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figure|file|image|uaqs_medium';
  $field_group->group_name = 'group_figure';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Figure',
    'weight' => '0',
    'children' => array(
      0 => 'file',
      1 => 'group_figcaption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figure',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figure',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figure|file|image|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figure|file|image|uaqs_small';
  $field_group->group_name = 'group_figure';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Figure',
    'weight' => '0',
    'children' => array(
      0 => 'file',
      1 => 'group_figcaption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figure',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figure',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figure|file|image|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figure|file|image|uaqs_square';
  $field_group->group_name = 'group_figure';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Figure',
    'weight' => '0',
    'children' => array(
      0 => 'file',
      1 => 'group_figcaption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Figure',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figure',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figure|file|image|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_body|file|audio|uaqs_media_list';
  $field_group->group_name = 'group_media_body';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media body',
    'weight' => '4',
    'children' => array(
      0 => 'group_media_heading',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media body',
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
  $field_groups['group_media_body|file|audio|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_body|file|document|uaqs_media_list';
  $field_group->group_name = 'group_media_body';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media body',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_download_description',
      1 => 'field_uaqs_summary',
      2 => 'uaqs_file_separator',
      3 => 'uaqs_file_size',
      4 => 'group_media_heading',
      5 => 'group_view_link',
      6 => 'group_download_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media body',
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
  $field_groups['group_media_body|file|document|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_body|file|image|uaqs_media_list';
  $field_group->group_name = 'group_media_body';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media body',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'field_uaqs_image_credit',
      2 => 'group_media_heading',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media body',
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
  $field_groups['group_media_body|file|image|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_body|file|video|uaqs_media_list';
  $field_group->group_name = 'group_media_body';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media body',
    'weight' => '3',
    'children' => array(
      0 => 'group_media_heading',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media body',
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
  $field_groups['group_media_body|file|video|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_heading|file|audio|uaqs_media_list';
  $field_group->group_name = 'group_media_heading';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Media heading',
    'weight' => '5',
    'children' => array(
      0 => 'group_strong',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-heading',
        'element' => 'h5',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_heading|file|audio|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_heading|file|document|uaqs_media_list';
  $field_group->group_name = 'group_media_heading';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Media heading',
    'weight' => '3',
    'children' => array(
      0 => 'group_strong',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-heading',
        'element' => 'h5',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_heading|file|document|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_heading|file|image|uaqs_media_list';
  $field_group->group_name = 'group_media_heading';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Media heading',
    'weight' => '6',
    'children' => array(
      0 => 'group_strong',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-heading',
        'element' => 'h5',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_heading|file|image|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_heading|file|video|uaqs_media_list';
  $field_group->group_name = 'group_media_heading';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'Media heading	',
    'weight' => '4',
    'children' => array(
      0 => 'group_strong',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media heading	',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-heading',
        'element' => 'h5',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_heading|file|video|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_object|file|image|uaqs_media_list';
  $field_group->group_name = 'group_media_object';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_position';
  $field_group->data = array(
    'label' => 'Media object',
    'weight' => '11',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media object',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-object',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_object|file|image|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_position|file|audio|uaqs_media_list';
  $field_group->group_name = 'group_media_position';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media position',
    'weight' => '5',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media position',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-right',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_position|file|audio|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_position|file|document|uaqs_media_list';
  $field_group->group_name = 'group_media_position';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media position',
    'weight' => '5',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media position',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-right',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_position|file|document|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_position|file|image|uaqs_media_list';
  $field_group->group_name = 'group_media_position';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media position',
    'weight' => '8',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media position',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-right',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_position|file|image|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_position|file|video|uaqs_media_list';
  $field_group->group_name = 'group_media_position';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media';
  $field_group->data = array(
    'label' => 'Media position',
    'weight' => '5',
    'children' => array(
      0 => 'file',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media position',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-right',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_position|file|video|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media|file|audio|uaqs_media_list';
  $field_group->group_name = 'group_media';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Media',
    'weight' => '0',
    'children' => array(
      0 => 'group_media_body',
      1 => 'group_media_position',
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
  $field_groups['group_media|file|audio|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media|file|document|uaqs_media_list';
  $field_group->group_name = 'group_media';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Media',
    'weight' => '3',
    'children' => array(
      0 => 'group_media_body',
      1 => 'group_media_position',
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
  $field_groups['group_media|file|document|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media|file|image|uaqs_media_list';
  $field_group->group_name = 'group_media';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Media',
    'weight' => '0',
    'children' => array(
      0 => 'group_media_body',
      1 => 'group_media_position',
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
  $field_groups['group_media|file|image|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media|file|video|uaqs_media_list';
  $field_group->group_name = 'group_media';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Media',
    'weight' => '2',
    'children' => array(
      0 => 'group_media_body',
      1 => 'group_media_position',
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
  $field_groups['group_media|file|video|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row_2|file|document|uaqs_large';
  $field_group->group_name = 'group_row_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '5',
    'children' => array(
      0 => 'group_column_bottom',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row_2|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row_2|file|document|uaqs_medium';
  $field_group->group_name = 'group_row_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '7',
    'children' => array(
      0 => 'group_column_bottom',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row_2|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row_2|file|document|uaqs_small';
  $field_group->group_name = 'group_row_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '5',
    'children' => array(
      0 => 'group_column_bottom',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row_2|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row_2|file|document|uaqs_square';
  $field_group->group_name = 'group_row_2';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '5',
    'children' => array(
      0 => 'group_column_bottom',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row_2|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|file|document|uaqs_large';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '4',
    'children' => array(
      0 => 'group_column_left',
      1 => 'group_column_right',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|file|document|uaqs_medium';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '6',
    'children' => array(
      0 => 'group_column_left',
      1 => 'group_column_right',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|file|document|uaqs_small';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '4',
    'children' => array(
      0 => 'group_column_left',
      1 => 'group_column_right',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|file|document|uaqs_square';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '4',
    'children' => array(
      0 => 'group_column',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_size|file|document|uaqs_square';
  $field_group->group_name = 'group_size';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'Size',
    'weight' => '13',
    'children' => array(
      0 => 'uaqs_file_size',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Size',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_size|file|document|uaqs_square'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_strong|file|audio|uaqs_media_list';
  $field_group->group_name = 'group_strong';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'audio';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_heading';
  $field_group->data = array(
    'label' => 'Strong',
    'weight' => '2',
    'children' => array(
      0 => 'filename_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Strong',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'strong',
        'element' => 'strong',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_strong|file|audio|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_strong|file|document|uaqs_media_list';
  $field_group->group_name = 'group_strong';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_heading';
  $field_group->data = array(
    'label' => 'Strong',
    'weight' => '3',
    'children' => array(
      0 => 'filename_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Strong',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'strong',
        'element' => 'strong',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_strong|file|document|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_strong|file|image|uaqs_media_list';
  $field_group->group_name = 'group_strong';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'image';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_heading';
  $field_group->data = array(
    'label' => 'Strong',
    'weight' => '6',
    'children' => array(
      0 => 'filename_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Strong',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'strong',
        'element' => 'strong',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_strong|file|image|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_strong|file|video|uaqs_media_list';
  $field_group->group_name = 'group_strong';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'video';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_heading';
  $field_group->data = array(
    'label' => 'Strong',
    'weight' => '5',
    'children' => array(
      0 => 'filename_field',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Strong',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'strong',
        'element' => 'strong',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_strong|file|video|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_view_link|file|document|uaqs_large';
  $field_group->group_name = 'group_view_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_large';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'View link',
    'weight' => '10',
    'children' => array(
      0 => 'uaqs_file_view_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'View link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_view_link|file|document|uaqs_large'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_view_link|file|document|uaqs_media_list';
  $field_group->group_name = 'group_view_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_media_list';
  $field_group->parent_name = 'group_media_body';
  $field_group->data = array(
    'label' => 'View link',
    'weight' => '6',
    'children' => array(
      0 => 'uaqs_file_view_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'View link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_view_link|file|document|uaqs_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_view_link|file|document|uaqs_medium';
  $field_group->group_name = 'group_view_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_medium';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'View link',
    'weight' => '9',
    'children' => array(
      0 => 'uaqs_file_view_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'View link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_view_link|file|document|uaqs_medium'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_view_link|file|document|uaqs_small';
  $field_group->group_name = 'group_view_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_small';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'View link',
    'weight' => '5',
    'children' => array(
      0 => 'uaqs_file_view_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'View link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_view_link|file|document|uaqs_small'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_view_link|file|document|uaqs_square';
  $field_group->group_name = 'group_view_link';
  $field_group->entity_type = 'file';
  $field_group->bundle = 'document';
  $field_group->mode = 'uaqs_square';
  $field_group->parent_name = 'group_card_block_2';
  $field_group->data = array(
    'label' => 'View link',
    'weight' => '10',
    'children' => array(
      0 => 'uaqs_file_view_text',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'View link',
      'instance_settings' => array(
        'link_to' => 'custom_url',
        'custom_url' => '[file:url]',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'text-capitalize',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_view_link|file|document|uaqs_square'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('16:9 responsive');
  t('16:9 responsive	');
  t('4:3 responsive');
  t('Card');
  t('Card block');
  t('Card title');
  t('Cite');
  t('Column');
  t('Column bottom');
  t('Column left');
  t('Column right');
  t('Download link');
  t('Figcaption');
  t('Figure');
  t('Media');
  t('Media body');
  t('Media heading');
  t('Media heading	');
  t('Media object');
  t('Media position');
  t('Row');
  t('Size');
  t('Strong');
  t('View link');

  return $field_groups;
}
