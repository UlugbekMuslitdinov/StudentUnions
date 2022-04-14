<?php

/**
 * @file
 * uaqs_content_chunks_marquee.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_marquee_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom';
  $field_group->group_name = 'group_bg_img';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_bottom';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background image',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
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
  $field_groups['group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_bg_img';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background image',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_container',
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
  $field_groups['group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_bg_img';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background image',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_container',
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
  $field_groups['group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_bg_img';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background image',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_container',
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
  $field_groups['group_bg_img|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_bs_column|paragraphs_item|uaqs_content_chunks_marquee|default';
  $field_group->group_name = 'group_bs_column';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'BS column',
    'weight' => '1',
    'children' => array(
      0 => 'group_text_box',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'BS column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-10 col-sm-offset-1',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_bs_column|paragraphs_item|uaqs_content_chunks_marquee|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_center|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_column_center';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column center',
    'weight' => '28',
    'children' => array(
      0 => 'group_text_box',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column center',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-12 row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_center|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_left|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_column_left';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_container';
  $field_group->data = array(
    'label' => 'Column left',
    'weight' => '22',
    'children' => array(
      0 => 'group_text_box',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column left',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-6 row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_left|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_right|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_column_right';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
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
        'classes' => 'col-md-offset-6 col-md-6 row height-100',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_right|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom';
  $field_group->group_name = 'group_column';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_bottom';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Column',
    'weight' => '1',
    'children' => array(
      0 => 'group_text_box',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_container|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_container';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_bg_img';
  $field_group->data = array(
    'label' => 'Container',
    'weight' => '14',
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
  $field_groups['group_container|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_container|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_container';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_bg_img';
  $field_group->data = array(
    'label' => 'Container',
    'weight' => '21',
    'children' => array(
      0 => 'group_column_left',
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
  $field_groups['group_container|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_container|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_container';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_bg_img';
  $field_group->data = array(
    'label' => 'Container',
    'weight' => '14',
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
  $field_groups['group_container|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_display_settings|paragraphs_item|uaqs_content_chunks_marquee|form';
  $field_group->group_name = 'group_display_settings';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Display Settings',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_setting_bg_attach',
      1 => 'field_uaqs_setting_bg_size',
      2 => 'field_uaqs_setting_bg_color',
      3 => 'field_uaqs_setting_text_bg_color',
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
  $field_groups['group_display_settings|paragraphs_item|uaqs_content_chunks_marquee|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_headline|paragraphs_item|uaqs_content_chunks_marquee|default';
  $field_group->group_name = 'group_headline';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Headline',
    'weight' => '9',
    'children' => array(
      0 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Headline',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'sans blue60b text-center',
        'element' => 'h2',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_headline|paragraphs_item|uaqs_content_chunks_marquee|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_headline|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom';
  $field_group->group_name = 'group_headline';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_bottom';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Headline',
    'weight' => '19',
    'children' => array(
      0 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Headline',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'sans blue60b text-uppercase mt-0',
        'element' => 'h1',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_headline|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_home_banner|paragraphs_item|uaqs_content_chunks_marquee|default';
  $field_group->group_name = 'group_home_banner';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Home banner',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Home banner',
      'instance_settings' => array(
        'id' => 'home-banner',
        'classes' => '',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_home_banner|paragraphs_item|uaqs_content_chunks_marquee|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '0',
    'children' => array(
      0 => 'group_bg_img',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'height-100 link-container remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '3',
    'children' => array(
      0 => 'group_bg_img',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'height-100 link-container remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '0',
    'children' => array(
      0 => 'group_bg_img',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'height-100 link-container remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_read_more|paragraphs_item|uaqs_content_chunks_marquee|default';
  $field_group->group_name = 'group_read_more';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Read more',
    'weight' => '12',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Read more',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-center card-block',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_read_more|paragraphs_item|uaqs_content_chunks_marquee|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_read_more|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom';
  $field_group->group_name = 'group_read_more';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_bottom';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Read more',
    'weight' => '21',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Read more',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-center card-block',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_read_more|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|paragraphs_item|uaqs_content_chunks_marquee|default';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_text_box';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_summary',
      1 => 'group_headline',
      2 => 'group_read_more',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|paragraphs_item|uaqs_content_chunks_marquee|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_bottom';
  $field_group->parent_name = 'group_text_box';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '16',
    'children' => array(
      0 => 'field_uaqs_summary',
      1 => 'group_headline',
      2 => 'group_read_more',
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
  $field_groups['group_row|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_container';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '27',
    'children' => array(
      0 => 'group_column_center',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
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
  $field_groups['group_row|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_content_chunks_marquee|default';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_bs_column';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '10',
    'children' => array(
      0 => 'group_row',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'banner-text-grid text-center',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_content_chunks_marquee|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_bottom';
  $field_group->parent_name = 'group_column';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '2',
    'children' => array(
      0 => 'group_row',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'banner-text-grid text-center',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_bottom'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_center';
  $field_group->parent_name = 'group_column_center';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '31',
    'children' => array(
      0 => 'field_uaqs_link',
      1 => 'field_uaqs_summary',
      2 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'vertical-align-center card-block',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_center'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_left';
  $field_group->parent_name = 'group_column_left';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '18',
    'children' => array(
      0 => 'field_uaqs_link',
      1 => 'field_uaqs_summary',
      2 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'vertical-align-center card-block',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right';
  $field_group->group_name = 'group_text_box';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_content_chunks_marquee';
  $field_group->mode = 'uaqs_bg_img_content_right';
  $field_group->parent_name = 'group_column_right';
  $field_group->data = array(
    'label' => 'Text box',
    'weight' => '21',
    'children' => array(
      0 => 'field_uaqs_link',
      1 => 'field_uaqs_summary',
      2 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Text box',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'vertical-align-center card-block',
        'element' => 'section',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_box|paragraphs_item|uaqs_content_chunks_marquee|uaqs_bg_img_content_right'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('BS column');
  t('Background image');
  t('Column');
  t('Column center');
  t('Column left');
  t('Column right');
  t('Container');
  t('Display Settings');
  t('Headline');
  t('Home banner');
  t('Link');
  t('Read more');
  t('Row');
  t('Text box');

  return $field_groups;
}
