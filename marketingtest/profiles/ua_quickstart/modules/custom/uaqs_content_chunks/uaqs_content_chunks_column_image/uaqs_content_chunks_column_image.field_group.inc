<?php
/**
 * @file
 * uaqs_content_chunks_column_image.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_column_image_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_alignment|paragraphs_item|uaqs_column_image|default';
  $field_group->group_name = 'group_alignment';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Alignment',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_figcaption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Alignment',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'center-block',
        'element' => 'figure',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_alignment|paragraphs_item|uaqs_column_image|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_alignment|paragraphs_item|uaqs_column_image|uaqs_align_left';
  $field_group->group_name = 'group_alignment';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'uaqs_align_left';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Alignment',
    'weight' => '8',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_figcaption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Alignment',
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
  $field_groups['group_alignment|paragraphs_item|uaqs_column_image|uaqs_align_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_alignment|paragraphs_item|uaqs_column_image|uaqs_align_right';
  $field_group->group_name = 'group_alignment';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'uaqs_align_right';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Alignment',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_caption',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Alignment',
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
  $field_groups['group_alignment|paragraphs_item|uaqs_column_image|uaqs_align_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_caption|paragraphs_item|uaqs_column_image|uaqs_align_right';
  $field_group->group_name = 'group_caption';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'uaqs_align_right';
  $field_group->parent_name = 'group_alignment';
  $field_group->data = array(
    'label' => 'Caption',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Caption',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_caption|paragraphs_item|uaqs_column_image|uaqs_align_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_credit|paragraphs_item|uaqs_column_image|uaqs_align_left';
  $field_group->group_name = 'group_credit';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'uaqs_align_left';
  $field_group->parent_name = 'group_figcaption';
  $field_group->data = array(
    'label' => 'Credit',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Credit',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted small',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_credit|paragraphs_item|uaqs_column_image|uaqs_align_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_credit|paragraphs_item|uaqs_column_image|uaqs_align_right';
  $field_group->group_name = 'group_credit';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'uaqs_align_right';
  $field_group->parent_name = 'group_caption';
  $field_group->data = array(
    'label' => 'Image credit',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Image credit',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted small',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_credit|paragraphs_item|uaqs_column_image|uaqs_align_right'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figcaption|paragraphs_item|uaqs_column_image|default';
  $field_group->group_name = 'group_figcaption';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_alignment';
  $field_group->data = array(
    'label' => 'Caption',
    'weight' => '2',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Caption',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figcaption|paragraphs_item|uaqs_column_image|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_figcaption|paragraphs_item|uaqs_column_image|uaqs_align_left';
  $field_group->group_name = 'group_figcaption';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'uaqs_align_left';
  $field_group->parent_name = 'group_alignment';
  $field_group->data = array(
    'label' => 'Caption/Cutline',
    'weight' => '10',
    'children' => array(
      0 => 'field_uaqs_caption_text',
      1 => 'group_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Caption/Cutline',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'figcaption',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_figcaption|paragraphs_item|uaqs_column_image|uaqs_align_left'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_image_credit|paragraphs_item|uaqs_column_image|default';
  $field_group->group_name = 'group_image_credit';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_column_image';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_figcaption';
  $field_group->data = array(
    'label' => 'Image Credit',
    'weight' => '8',
    'children' => array(
      0 => 'field_uaqs_image_credit',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Image Credit',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-muted small',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_image_credit|paragraphs_item|uaqs_column_image|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Alignment');
  t('Caption');
  t('Caption/Cutline');
  t('Credit');
  t('Image Credit');
  t('Image credit');

  return $field_groups;
}
