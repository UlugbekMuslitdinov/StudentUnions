<?php

/**
 * @file
 * uaqs_news.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_news_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-uaqs_news-field_uaqs_attachments'.
  $field_instances['node-uaqs_news-field_uaqs_attachments'] = array(
    'bundle' => 'uaqs_news',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'file',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'file_default',
        'weight' => 3,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 8,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 3,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 3,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 2,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_uaqs_attachments',
    'label' => 'Attachments',
    'required' => 0,
    'settings' => array(
      'description_field' => 1,
      'file_directory' => 'documents',
      'file_extensions' => 'pdf',
      'max_filesize' => '10 MB',
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'file',
      'settings' => array(
        'file_entity_inline' => 1,
        'file_entity_inline_fields' => array(),
        'progress_indicator' => 'throbber',
      ),
      'type' => 'file_generic',
      'weight' => 9,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_body'.
  $field_instances['node-uaqs_news-field_uaqs_body'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => array(
      0 => array(
        'summary' => '',
        'value' => '',
        'format' => 'uaqs_unconstrained',
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
        'weight' => 11,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 9,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_body',
    'label' => 'Article Body',
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
      'display_summary' => 0,
      'text_processing' => 1,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'rows' => 20,
        'summary_rows' => 5,
      ),
      'type' => 'text_textarea_with_summary',
      'weight' => 5,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_byline'.
  $field_instances['node-uaqs_news-field_uaqs_byline'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'Author of this article',
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
        'weight' => 19,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 10,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 11,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 9,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 10,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 5,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_uaqs_byline',
    'label' => 'Byline',
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
      'weight' => 1,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_contacts'.
  $field_instances['node-uaqs_news-field_uaqs_contacts'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'Persons who can be contacted about the news article',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'field_collection',
        'settings' => array(
          'add' => 'Add',
          'delete' => 'Delete',
          'description' => TRUE,
          'edit' => 'Edit',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'translate' => 'Translate',
          'view_mode' => 'full',
        ),
        'type' => 'field_collection_view',
        'weight' => 2,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 11,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 1,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 3,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 2,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 1,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 5,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_uaqs_contacts',
    'label' => 'Contacts',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'field_collection',
      'settings' => array(),
      'type' => 'field_collection_embed',
      'weight' => 8,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_expiration_date'.
  $field_instances['node-uaqs_news-field_uaqs_expiration_date'] = array(
    'bundle' => 'uaqs_news',
    'deleted' => 0,
    'description' => 'The date and time this news item drops out of website displays',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 12,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 13,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 12,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 12,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 9,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 8,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_expiration_date',
    'label' => 'Expiration Date',
    'required' => 0,
    'settings' => array(
      'default_value' => 'now',
      'default_value2' => 'same',
      'default_value_code' => '',
      'default_value_code2' => '',
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'date',
      'settings' => array(
        'display_all_day' => 0,
        'increment' => 30,
        'input_format' => 'm/d/Y - g:i:sa',
        'input_format_custom' => '',
        'label_position' => 'within',
        'no_fieldset' => 0,
        'repeat_collapsed' => 0,
        'text_parts' => array(),
        'year_range' => '-1:+3',
      ),
      'type' => 'date_select',
      'weight' => 19,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_link'.
  $field_instances['node-uaqs_news-field_uaqs_link'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => array(
      0 => array(
        'title' => 'Read more',
        'url' => '[node:url]',
        'attributes' => array(
          'class' => 'btn-arrow',
          'target' => 0,
        ),
      ),
    ),
    'deleted' => 0,
    'description' => 'Leave as default setting (takes to internal news story) or change to external URL (goes to external news story).',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 9,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 22,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 19,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 24,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 46,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 25,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_title_plain',
        'weight' => 35,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_link',
    'label' => 'Link to news',
    'required' => 1,
    'settings' => array(
      'absolute_url' => 1,
      'attributes' => array(
        'class' => 'btn-arrow',
        'configurable_class' => 1,
        'configurable_title' => 0,
        'rel' => '',
        'target' => 'user',
        'title' => '',
      ),
      'display' => array(
        'url_cutoff' => 80,
      ),
      'enable_tokens' => 1,
      'rel_remove' => 'default',
      'title' => 'required',
      'title_allowed_values' => '',
      'title_label_use_field_label' => 1,
      'title_maxlength' => 128,
      'title_value' => '',
      'url' => 0,
      'user_register_form' => FALSE,
      'validate_url' => 0,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'link',
      'settings' => array(),
      'type' => 'link_field',
      'weight' => 17,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_main_content'.
  $field_instances['node-uaqs_news-field_uaqs_main_content'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'uaqs_content_chunks',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'paragraphs_view_mode',
        'weight' => 12,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 8,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_main_content',
    'label' => 'Extra body content',
    'required' => 0,
    'settings' => array(
      'add_mode' => 'button',
      'allowed_bundles' => array(
        'uaqs_card_deck' => 'uaqs_card_deck',
        'uaqs_column_image' => 'uaqs_column_image',
        'uaqs_extra_info' => 'uaqs_extra_info',
        'uaqs_file_download' => 'uaqs_file_download',
        'uaqs_full_width_bg_wrapper' => -1,
        'uaqs_headed_text' => 'uaqs_headed_text',
        'uaqs_plain_text' => -1,
      ),
      'bundle_weights' => array(
        'uaqs_card_deck' => 2,
        'uaqs_column_image' => 3,
        'uaqs_extra_info' => 11,
        'uaqs_file_download' => 4,
        'uaqs_full_width_bg_wrapper' => 5,
        'uaqs_headed_text' => 6,
        'uaqs_plain_text' => 7,
      ),
      'default_edit_mode' => 'open',
      'title' => 'Paragraph',
      'title_multiple' => 'Paragraphs',
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'paragraphs',
      'settings' => array(),
      'type' => 'paragraphs_embed',
      'weight' => 6,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_news_tags'.
  $field_instances['node-uaqs_news-field_uaqs_news_tags'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 20,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_news_tags',
    'label' => 'News Tags',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'options',
      'settings' => array(
        'apply_chosen' => '',
        'autocomplete_path' => 'taxonomy/autocomplete',
        'size' => 60,
      ),
      'type' => 'options_select',
      'weight' => 7,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_photo'.
  $field_instances['node-uaqs_news-field_uaqs_photo'] = array(
    'bundle' => 'uaqs_news',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'file_entity',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'file_view_mode' => 'default',
        ),
        'type' => 'file_rendered',
        'weight' => 10,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => '',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'uaqs_spotlight',
        ),
        'type' => 'image',
        'weight' => 1,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => 'margin-align-middle margin-zero-top',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'uaqs_card_image',
        ),
        'type' => 'image',
        'weight' => 10,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => 'marquee-img',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'uaqs_spotlight',
        ),
        'type' => 'image',
        'weight' => 4,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => 'media-object',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'thumbnail',
        ),
        'type' => 'image',
        'weight' => 29,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => 'media-object',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'thumbnail',
        ),
        'type' => 'image',
        'weight' => 8,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => 'media-object',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'medium',
        ),
        'type' => 'image',
        'weight' => 4,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_photo',
    'label' => 'Photo',
    'required' => 0,
    'settings' => array(
      'alt_field' => 1,
      'default_image' => 0,
      'file_directory' => '',
      'file_extensions' => 'png gif jpg jpeg',
      'max_filesize' => '',
      'max_resolution' => '',
      'min_resolution' => '568x426',
      'title_field' => 1,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'media',
      'settings' => array(
        'allowed_schemes' => array(
          'oembed' => 0,
          'private' => 0,
          'public' => 'public',
        ),
        'allowed_types' => array(
          'audio' => 0,
          'document' => 0,
          'image' => 'image',
          'video' => 0,
        ),
        'browser_plugins' => array(
          'media_default--media_browser_1' => 0,
          'media_default--media_browser_my_files' => 0,
          'media_internet' => 0,
          'upload' => 0,
        ),
        'manualcrop_crop_info' => 1,
        'manualcrop_default_crop_area' => 1,
        'manualcrop_enable' => 1,
        'manualcrop_inline_crop' => 0,
        'manualcrop_instant_crop' => FALSE,
        'manualcrop_instant_preview' => 1,
        'manualcrop_keyboard' => 1,
        'manualcrop_maximize_default_crop_area' => 1,
        'manualcrop_require_cropping' => array(),
        'manualcrop_styles_list' => array(
          'uaqs_card_image' => 'uaqs_card_image',
          'uaqs_spotlight' => 'uaqs_spotlight',
        ),
        'manualcrop_styles_mode' => 'include',
        'manualcrop_thumblist' => 1,
      ),
      'type' => 'media_generic',
      'weight' => 3,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_photos'.
  $field_instances['node-uaqs_news-field_uaqs_photos'] = array(
    'bundle' => 'uaqs_news',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 13,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 12,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 10,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 11,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 2,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_uaqs_photos',
    'label' => 'News Article Photos',
    'required' => 0,
    'settings' => array(
      'alt_field' => 1,
      'default_image' => 0,
      'file_directory' => 'images/news',
      'file_extensions' => 'png gif jpg jpeg',
      'max_filesize' => '2 MB',
      'max_resolution' => '',
      'min_resolution' => '',
      'title_field' => 1,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'image',
      'settings' => array(
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
      'type' => 'image_image',
      'weight' => 10,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_published'.
  $field_instances['node-uaqs_news-field_uaqs_published'] = array(
    'bundle' => 'uaqs_news',
    'deleted' => 0,
    'description' => 'Date when article was published',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 0,
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 0,
            'use_all_day' => 0,
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 18,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 0,
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 0,
            'use_all_day' => 0,
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 3,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 0,
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 0,
            'use_all_day' => 0,
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 9,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 0,
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 0,
            'use_all_day' => 0,
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 8,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 0,
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 0,
            'use_all_day' => 0,
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 9,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 0,
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 0,
            'use_all_day' => 0,
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 31,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_published',
    'label' => 'Date of publication',
    'required' => 0,
    'settings' => array(
      'default_value' => 'now',
      'default_value2' => 'same',
      'default_value_code' => '',
      'default_value_code2' => '',
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'date',
      'settings' => array(
        'display_all_day' => 0,
        'increment' => 15,
        'input_format' => 'm/d/Y - g:i:sa',
        'input_format_custom' => '',
        'label_position' => 'within',
        'no_fieldset' => 0,
        'repeat_collapsed' => 0,
        'text_parts' => array(),
        'year_range' => '-10:+3',
      ),
      'type' => 'date_select',
      'weight' => 2,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_short_title'.
  $field_instances['node-uaqs_news-field_uaqs_short_title'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => array(
      0 => array(
        'value' => '[node:title]',
      ),
    ),
    'deleted' => 0,
    'description' => '<strong>Suggested character limit:</strong> 30.  This field supports tokens.',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 5,
      ),
      'teaser' => array(
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
        'weight' => 2,
      ),
      'uaqs_card' => array(
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
        'weight' => 2,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'module' => 'title',
        'settings' => array(
          'enable_trim' => FALSE,
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title_class' => 'h2 sans',
          'title_link' => '',
          'title_style' => 'h2',
          'trim_length' => 50,
        ),
        'type' => 'title_linked',
        'weight' => 13,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'module' => 'title',
        'settings' => array(
          'enable_trim' => FALSE,
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title_class' => '',
          'title_link' => '',
          'title_style' => '',
          'trim_length' => 50,
        ),
        'type' => 'title_linked',
        'weight' => 11,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'title',
        'settings' => array(
          'enable_trim' => FALSE,
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title_class' => '',
          'title_link' => '',
          'title_style' => '',
          'trim_length' => 50,
        ),
        'type' => 'title_linked',
        'weight' => 2,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_plain',
        'weight' => 23,
      ),
    ),
    'entity_type' => 'node',
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
      'weight' => 16,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_summary'.
  $field_instances['node-uaqs_news-field_uaqs_summary'] = array(
    'bundle' => 'uaqs_news',
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
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 4,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 4,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 15,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 27,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 10,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 29,
      ),
    ),
    'entity_type' => 'node',
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
      'weight' => 18,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-field_uaqs_summary_short'.
  $field_instances['node-uaqs_news-field_uaqs_summary_short'] = array(
    'bundle' => 'uaqs_news',
    'default_value' => NULL,
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
        'weight' => 3,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 5,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 3,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 3,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_summary_short',
    'label' => 'Subheading',
    'required' => 0,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 100,
      ),
      'type' => 'text_textfield',
      'weight' => 4,
    ),
  );

  // Exported field_instance: 'node-uaqs_news-title_field'.
  $field_instances['node-uaqs_news-title_field'] = array(
    'bundle' => 'uaqs_news',
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
          'title_class' => '',
          'title_link' => '',
          'title_style' => 'h1',
          'trim_length' => 50,
        ),
        'type' => 'title_linked',
        'weight' => 16,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 8,
      ),
      'uaqs_marquee' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 11,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 1,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 1,
      ),
      'uaqs_teaser_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 22,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'title_field',
    'label' => 'Title',
    'required' => 1,
    'settings' => array(
      'hide_label' => array(
        'entity' => 'entity',
        'page' => 'page',
      ),
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

  // Translatables
  // Included for use with string extractors like potx.
  t('<strong>Suggested character limit:</strong> 30.  This field supports tokens.');
  t('Article Body');
  t('Attachments');
  t('Author of this article');
  t('Byline');
  t('Contacts');
  t('Date of publication');
  t('Date when article was published');
  t('Expiration Date');
  t('Extra body content');
  t('Leave as default setting (takes to internal news story) or change to external URL (goes to external news story).');
  t('Link to news');
  t('News Article Photos');
  t('News Tags');
  t('Persons who can be contacted about the news article');
  t('Photo');
  t('Short Title');
  t('Subheading');
  t('Summary');
  t('The date and time this news item drops out of website displays');
  t('Title');

  return $field_instances;
}
