<?php

/**
 * @file
 * uaqs_content_chunks_full_width_media_row.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_full_width_media_row_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bg_img|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_bg_img';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background image',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_shield',
    ),
    'format_type' => 'div_background_image',
    'format_settings' => array(
      'label' => 'Background image',
      'instance_settings' => array(
        'show_label' => '0',
        'label_element' => 'h2',
        'background_image' => 'field_uaqs_photo',
        'image_style' => '',
        'picture_mapping' => 'uaqs_full_width_marquee',
        'fallback_image_style' => '',
        'classes' => 'bg-image bg-center-vert bg-center-horiz bg-no-repeat',
      ),
      'formatter' => 'picture',
    ),
  );
  $field_groups['group_bg_img|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bg_img|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_bg_img';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background image',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_shield',
    ),
    'format_type' => 'div_background_image',
    'format_settings' => array(
      'label' => 'Background image',
      'instance_settings' => array(
        'show_label' => '0',
        'label_element' => 'h2',
        'background_image' => 'field_uaqs_photo',
        'image_style' => '',
        'picture_mapping' => 'uaqs_full_width_marquee',
        'fallback_image_style' => '',
        'classes' => 'bg-image bg-center-vert bg-center-horiz bg-no-repeat',
      ),
      'formatter' => 'picture',
    ),
  );
  $field_groups['group_bg_img|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bg_img|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_bg_img';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background image',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_shield',
    ),
    'format_type' => 'div_background_image',
    'format_settings' => array(
      'label' => 'Background image',
      'instance_settings' => array(
        'show_label' => '0',
        'label_element' => 'h2',
        'background_image' => 'field_uaqs_photo',
        'image_style' => '',
        'picture_mapping' => 'uaqs_full_width_marquee',
        'fallback_image_style' => '',
        'classes' => 'bg-image bg-center-vert bg-center-horiz bg-no-repeat',
      ),
      'formatter' => 'picture',
    ),
  );
  $field_groups['group_bg_img|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_center|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_column_center';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column center',
    'weight' => '2',
    'children' => array(
      0 => 'group_text_box',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column center',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-6 col-md-offset-3 row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_center|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_left|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_column_left';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column left',
    'weight' => '74',
    'children' => array(
      0 => 'group_text_box',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column left',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-5 row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_left|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_right|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_column_right';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column right',
    'weight' => '23',
    'children' => array(
      0 => 'group_text_box',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column right',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-offset-7 col-md-5 row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_right|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_container|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_container';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_shield';
  $field_group->data = array(
    'label' => 'Container',
    'weight' => '2',
    'children' => array(
      0 => 'group_row',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Container',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'container container-absolute',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_container|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_container|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_container';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_shield';
  $field_group->data = array(
    'label' => 'Container',
    'weight' => '74',
    'children' => array(
      0 => 'group_row',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Container',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'container container-absolute',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_container|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_container|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_container';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_shield';
  $field_group->data = array(
    'label' => 'Container',
    'weight' => '63',
    'children' => array(
      0 => 'group_row',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Container',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'container container-absolute',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_container|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_display_settings|paragraphs_item|uaqs_full_width_media_row|form';
  $field_group->group_name = 'group_display_settings';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Display Settings',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_setting_bg_attach',
      1 => 'field_uaqs_setting_bg_size',
      2 => 'field_uaqs_setting_text_bg_color',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Display Settings',
      'instance_settings' => array(
        'required_fields' => 0,
        'classes' => '',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $field_groups['group_display_settings|paragraphs_item|uaqs_full_width_media_row|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_vert_align_content';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-row-heading sans mb-2 mt-0',
        'element' => 'h1',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_heading|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_vert_align_content';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '68',
    'children' => array(
      0 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-row-heading sans mb-2 mt-0',
        'element' => 'h1',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_heading|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_vert_align_content';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '57',
    'children' => array(
      0 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-row-heading sans mb-2 mt-0',
        'element' => 'h1',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_heading|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_row_text|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_media_row_text';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_vert_align_content';
  $field_group->data = array(
    'label' => 'Media row text',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_links',
      1 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media row text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-row-text sans',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_row_text|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_row_text|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_media_row_text';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_vert_align_content';
  $field_group->data = array(
    'label' => 'Media row text',
    'weight' => '70',
    'children' => array(
      0 => 'field_uaqs_links',
      1 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media row text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-row-text sans',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_row_text|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_media_row_text|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_media_row_text';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_vert_align_content';
  $field_group->data = array(
    'label' => 'Media row text',
    'weight' => '59',
    'children' => array(
      0 => 'field_uaqs_links',
      1 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Media row text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'media-row-text sans',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_media_row_text|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_container';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '3',
    'children' => array(
      0 => 'group_column_center',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_container';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '64',
    'children' => array(
      0 => 'group_column_left',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_container';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '21',
    'children' => array(
      0 => 'group_column_right',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_shield|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_shield';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_bg_img';
  $field_group->data = array(
    'label' => 'Shield',
    'weight' => '3',
    'children' => array(
      0 => 'group_container',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Shield',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'shield-cover',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_shield|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_shield|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_shield';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_bg_img';
  $field_group->data = array(
    'label' => 'Shield',
    'weight' => '73',
    'children' => array(
      0 => 'group_container',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Shield',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'shield-cover',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_shield|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_shield|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_shield';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_bg_img';
  $field_group->data = array(
    'label' => 'Shield',
    'weight' => '62',
    'children' => array(
      0 => 'group_container',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Shield',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'shield-cover',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_shield|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_column_center';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '2',
    'children' => array(
      0 => 'uaqs_full_width_media_row_text_bg',
      1 => 'group_vert_align_content',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'height-100',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_column_left';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '2',
    'children' => array(
      0 => 'uaqs_full_width_media_row_text_bg',
      1 => 'group_vert_align_content',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'height-100',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_column_right';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '2',
    'children' => array(
      0 => 'uaqs_full_width_media_row_text_bg',
      1 => 'group_vert_align_content',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'height-100',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_vert_align_content|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_vert_align_content';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_text_box';
  $field_group->data = array(
    'label' => 'Vertical align content',
    'weight' => '56',
    'children' => array(
      0 => 'group_heading',
      1 => 'group_media_row_text',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Vertical align content',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'vertical-align-center pl-4 pr-4 pb-4 pt-4 text-center',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_vert_align_content|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_vert_align_content|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_vert_align_content';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_text_box';
  $field_group->data = array(
    'label' => 'Vertical align content',
    'weight' => '60',
    'children' => array(
      0 => 'group_heading',
      1 => 'group_media_row_text',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Vertical align content',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'vertical-align-center pl-4 pr-4 pb-4 pt-4',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_vert_align_content|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_vert_align_content|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_vert_align_content';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_full_width_media_row';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_text_box';
  $field_group->data = array(
    'label' => 'Vertical align content',
    'weight' => '53',
    'children' => array(
      0 => 'group_heading',
      1 => 'group_media_row_text',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Vertical align content',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'vertical-align-center pl-4 pr-4 pb-4 pt-4',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_vert_align_content|paragraphs_item|uaqs_full_width_media_row|uaqs_bg_img_content_right'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Background image');
  t('Column center');
  t('Column left');
  t('Column right');
  t('Container');
  t('Display Settings');
  t('Heading');
  t('Media row text');
  t('Row');
  t('Shield');
  t('Text box');
  t('Vertical align content');

  return $field_groups;
}
