<?php

/**
 * @file
 * uaqs_content_chunks_card_deck.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_content_chunks_card_deck_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_cards-field_uaqs_links'.
  $field_instances['field_collection_item-field_uaqs_cards-field_uaqs_links'] = array(
    'bundle' => 'field_uaqs_cards',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'custom_title' => '',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_default',
        'weight' => 18,
      ),
      'uaqs_borderless_card' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 32,
      ),
      'uaqs_landing_grid' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 8,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_links',
    'label' => 'Links',
    'required' => 0,
    'settings' => array(
      'absolute_url' => 1,
      'attributes' => array(
        'class' => 'card-link',
        'configurable_class' => 1,
        'configurable_title' => 0,
        'rel' => '',
        'target' => 'default',
        'title' => '',
      ),
      'display' => array(
        'url_cutoff' => 80,
      ),
      'enable_tokens' => 1,
      'rel_remove' => 'default',
      'title' => 'optional',
      'title_label_use_field_label' => 0,
      'title_maxlength' => 128,
      'title_value' => '',
      'url' => 0,
      'user_register_form' => FALSE,
      'validate_url' => 1,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'link',
      'settings' => array(),
      'type' => 'link_field',
      'weight' => 3,
    ),
  );

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_cards-field_uaqs_photo'.
  $field_instances['field_collection_item-field_uaqs_cards-field_uaqs_photo'] = array(
    'bundle' => 'field_uaqs_cards',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => '',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'uaqs_card_image',
        ),
        'type' => 'image',
        'weight' => 8,
      ),
      'uaqs_borderless_card' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => '',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'uaqs_card_image',
        ),
        'type' => 'image',
        'weight' => 2,
      ),
      'uaqs_landing_grid' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 2,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_photo',
    'label' => 'Photo',
    'required' => 0,
    'settings' => array(
      'alt_field' => 0,
      'default_image' => 0,
      'file_directory' => '',
      'file_extensions' => 'png gif jpg jpeg',
      'max_filesize' => '',
      'max_resolution' => '',
      'min_resolution' => '',
      'title_field' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'media',
      'settings' => array(
        'allowed_schemes' => array(
          'public' => 'public',
        ),
        'allowed_types' => array(
          'image' => 'image',
        ),
        'browser_plugins' => array(),
        'file_entity_inline' => 1,
        'file_entity_inline_fields' => array(),
        'manualcrop_crop_info' => TRUE,
        'manualcrop_default_crop_area' => TRUE,
        'manualcrop_enable' => FALSE,
        'manualcrop_inline_crop' => FALSE,
        'manualcrop_instant_crop' => FALSE,
        'manualcrop_instant_preview' => TRUE,
        'manualcrop_keyboard' => TRUE,
        'manualcrop_maximize_default_crop_area' => FALSE,
        'manualcrop_require_cropping' => array(),
        'manualcrop_styles_list' => array(),
        'manualcrop_styles_mode' => 'include',
        'manualcrop_thumblist' => FALSE,
        'preview_image_style' => 'thumbnail',
        'progress_indicator' => 'throbber',
      ),
      'type' => 'media_generic',
      'weight' => 1,
    ),
  );

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_cards-field_uaqs_short_title'.
  $field_instances['field_collection_item-field_uaqs_cards-field_uaqs_short_title'] = array(
    'bundle' => 'field_uaqs_cards',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'title',
        'settings' => array(
          'enable_trim' => FALSE,
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title_class' => 'card-title',
          'title_link' => '',
          'title_style' => 'h4',
          'trim_length' => 50,
        ),
        'type' => 'title_linked',
        'weight' => 5,
      ),
      'uaqs_borderless_card' => array(
        'label' => 'hidden',
        'module' => 'title',
        'settings' => array(
          'enable_trim' => FALSE,
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title_class' => 'h3 text-blue',
          'title_link' => '',
          'title_style' => 'h2',
          'trim_length' => 50,
        ),
        'type' => 'title_linked',
        'weight' => 3,
      ),
      'uaqs_landing_grid' => array(
        'label' => 'hidden',
        'module' => 'title',
        'settings' => array(
          'enable_trim' => FALSE,
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title_class' => 'h3 text-uppercase text-blue30w',
          'title_link' => '',
          'title_style' => 'h2',
          'trim_length' => 50,
        ),
        'type' => 'title_linked',
        'weight' => 5,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_short_title',
    'label' => 'Short Title',
    'required' => 0,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 0,
    ),
  );

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_cards-field_uaqs_summary'.
  $field_instances['field_collection_item-field_uaqs_cards-field_uaqs_summary'] = array(
    'bundle' => 'field_uaqs_cards',
    'default_value' => array(
      0 => array(
        'value' => '',
        'format' => 'uaqs_standard',
      ),
    ),
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 17,
      ),
      'uaqs_borderless_card' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 17,
      ),
      'uaqs_landing_grid' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 17,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_summary',
    'label' => 'Summary',
    'required' => 0,
    'settings' => array(
      'better_formats' => array(
        'allowed_formats' => array(
          'filtered_html' => 'filtered_html',
          'full_html' => 'full_html',
          'plain_text' => 'plain_text',
          'uaqs_filtered_html' => 'uaqs_filtered_html',
          'uaqs_full_html' => 'uaqs_full_html',
          'uaqs_standard' => 'uaqs_standard',
          'uaqs_textual_content' => 'uaqs_textual_content',
          'uaqs_unconstrained' => 'uaqs_unconstrained',
        ),
        'allowed_formats_toggle' => 0,
        'default_order_toggle' => 0,
        'default_order_wrapper' => array(
          'formats' => array(
            'filtered_html' => array(
              'weight' => 0,
            ),
            'full_html' => array(
              'weight' => 1,
            ),
            'plain_text' => array(
              'weight' => 10,
            ),
            'uaqs_filtered_html' => array(
              'weight' => -6,
            ),
            'uaqs_full_html' => array(
              'weight' => -7,
            ),
            'uaqs_standard' => array(
              'weight' => -9,
            ),
            'uaqs_textual_content' => array(
              'weight' => -8,
            ),
            'uaqs_unconstrained' => array(
              'weight' => -10,
            ),
          ),
        ),
      ),
      'text_processing' => 1,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'rows' => 5,
      ),
      'type' => 'text_textarea',
      'weight' => 2,
    ),
  );

  // Exported field_instance: 'paragraphs_item-uaqs_card_deck-field_uaqs_cards'.
  $field_instances['paragraphs_item-uaqs_card_deck-field_uaqs_cards'] = array(
    'bundle' => 'uaqs_card_deck',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'field_collection',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'view_mode' => 'full',
        ),
        'type' => 'field_collection_fields',
        'weight' => 5,
      ),
      'paragraphs_editor_preview' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_borderless_card' => array(
        'label' => 'hidden',
        'module' => 'field_collection',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'view_mode' => 'uaqs_borderless_card',
        ),
        'type' => 'field_collection_fields',
        'weight' => 5,
      ),
      'uaqs_landing_grid' => array(
        'label' => 'hidden',
        'module' => 'field_collection',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'view_mode' => 'uaqs_landing_grid',
        ),
        'type' => 'field_collection_fields',
        'weight' => 5,
      ),
    ),
    'entity_type' => 'paragraphs_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_cards',
    'label' => 'Cards',
    'required' => 1,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'field_collection',
      'settings' => array(),
      'type' => 'field_collection_embed',
      'weight' => 0,
    ),
  );

  // Exported field_instance:
  // 'paragraphs_item-uaqs_card_deck-field_uaqs_setting_deck_width'.
  $field_instances['paragraphs_item-uaqs_card_deck-field_uaqs_setting_deck_width'] = array(
    'bundle' => 'uaqs_card_deck',
    'default_value' => array(
      0 => array(
        'value' => 'single_card_width',
      ),
    ),
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_borderless_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_landing_grid' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'paragraphs_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_setting_deck_width',
    'label' => 'Deck width',
    'required' => 1,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(
        'apply_chosen' => '',
      ),
      'type' => 'options_select',
      'weight' => 2,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Cards');
  t('Deck width');
  t('Links');
  t('Photo');
  t('Short Title');
  t('Summary');

  return $field_instances;
}
