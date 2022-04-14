<?php

/**
 * @file
 * uaqs_event.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_event_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'node-uaqs_event-field_uaqs_attachments'.
  $field_instances['node-uaqs_event-field_uaqs_attachments'] = array(
    'bundle' => 'uaqs_event',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'module' => 'file',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'file_default',
        'weight' => 7,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 1,
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

  // Exported field_instance: 'node-uaqs_event-field_uaqs_body'.
  $field_instances['node-uaqs_event-field_uaqs_body'] = array(
    'bundle' => 'uaqs_event',
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
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 2,
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
        'weight' => 3,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 5,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_body',
    'label' => 'Event description',
    'required' => 1,
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
      'weight' => 6,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_contacts'.
  $field_instances['node-uaqs_event-field_uaqs_contacts'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'Persons who can be contacted about the event',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'module' => 'field_collection',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'view_mode' => 'full',
        ),
        'type' => 'field_collection_fields',
        'weight' => 9,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 5,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 3,
      ),
    ),
    'entity_type' => 'node',
    'field_name' => 'field_uaqs_contacts',
    'label' => 'Event Contacts',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'field_collection',
      'settings' => array(),
      'type' => 'field_collection_embed',
      'weight' => 7,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_date'.
  $field_instances['node-uaqs_event-field_uaqs_date'] = array(
    'bundle' => 'uaqs_event',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 'cap_noon',
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 'show_time',
            'use_all_day' => 'use_all_day',
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 30,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 'cap_noon',
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 'show_time',
            'use_all_day' => 'use_all_day',
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 20,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'module' => 'date_ap_style',
        'settings' => array(
          'date_ap_style_output' => array(
            'cap_noon' => 'cap_noon',
            'cap_today' => 'cap_today',
            'date_time' => 0,
            'show_time' => 'show_time',
            'use_all_day' => 'use_all_day',
            'use_dow' => 'use_dow',
            'use_today' => 'use_today',
            'use_year' => 'use_year',
          ),
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'date_ap_style',
        'weight' => 14,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'p',
    'field_name' => 'field_uaqs_date',
    'label' => 'When',
    'required' => 1,
    'settings' => array(
      'default_value' => 'now',
      'default_value2' => 'blank',
      'default_value_code' => '',
      'default_value_code2' => '',
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'date',
      'settings' => array(
        'display_all_day' => 1,
        'increment' => 1,
        'input_format' => 'm/d/Y - g:i:sa',
        'input_format_custom' => '',
        'label_position' => 'within',
        'no_fieldset' => 0,
        'repeat_collapsed' => 1,
        'text_parts' => array(),
        'year_range' => '-1:+3',
      ),
      'type' => 'date_select',
      'weight' => 5,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_event_category'.
  $field_instances['node-uaqs_event-field_uaqs_event_category'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'Select the categories you would like this event to appear in throughout the site.',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'taxonomy',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'taxonomy_term_reference_link',
        'weight' => 32,
      ),
      'uaqs_card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_event_category',
    'label' => 'Category',
    'required' => 0,
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
      'weight' => 3,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_front'.
  $field_instances['node-uaqs_event-field_uaqs_front'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => array(
      0 => array(
        'value' => 0,
      ),
    ),
    'deleted' => 0,
    'description' => '<strong>Issue</strong><br>By default, this field does not actually promote content to the front page. Instead, that\'s done by checking "Promoted to front page" under "Publishing options."<br><br>
<strong>Next Steps</strong><br>We intend to deprecate this field in the near future. If you or your team actually use this field — for custom views or other reasons — please let us know by emailing <a href="mailto:uadigital@email.arizona.edu">uadigital@email.arizona.edu</a> or on the <a href="https://uarizona.slack.com/messages/C0SAKC0T1" target="_blank">#ua-quickstart Slack channel</a>.


',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 14,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 8,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 10,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_front',
    'label' => 'Show on Front Page',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(
        'display_label' => 1,
      ),
      'type' => 'options_onoff',
      'weight' => 1,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_link'.
  $field_instances['node-uaqs_event-field_uaqs_link'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => array(
      0 => array(
        'title' => 'Read more',
        'url' => '[node:url]',
        'attributes' => array(
          'target' => 0,
        ),
      ),
    ),
    'deleted' => 0,
    'description' => 'If you want to link to this event on [site:name], leave the token in the URL field, if you want to link to the event hosted elsewhere, such as on the master calendar, replace the token with a link.',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 11,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 6,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_link',
    'label' => 'Link to event',
    'required' => 1,
    'settings' => array(
      'absolute_url' => 1,
      'attributes' => array(
        'class' => '',
        'configurable_class' => 0,
        'configurable_title' => 0,
        'rel' => '',
        'target' => 'user',
        'title' => '[node:title]',
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
      'weight' => 3,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_location'.
  $field_instances['node-uaqs_event-field_uaqs_location'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'Specify a URL if there is an online map for the location.<br />
If there is no map, simply fill in the location name or address in the title field.<br />
<strong>Campus Map: </strong> http://map.arizona.edu<br />
<strong>Google Maps: </strong> http://maps.google.com',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'module' => 'link',
        'settings' => array(
          'custom_title' => '',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_default',
        'weight' => 33,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'inline',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 12,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_location',
    'label' => 'Where',
    'required' => 0,
    'settings' => array(
      'absolute_url' => 1,
      'attributes' => array(
        'class' => '',
        'configurable_class' => 0,
        'configurable_title' => 0,
        'rel' => '',
        'target' => '_blank',
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
      'url' => 'optional',
      'user_register_form' => FALSE,
      'validate_url' => 1,
    ),
    'widget' => array(
      'active' => 0,
      'module' => 'link',
      'settings' => array(),
      'type' => 'link_field',
      'weight' => 8,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_photos'.
  $field_instances['node-uaqs_event-field_uaqs_photos'] = array(
    'bundle' => 'uaqs_event',
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'hidden',
        'module' => 'image',
        'settings' => array(
          'class' => 'bottom-buffer-15',
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'image_link' => '',
          'image_style' => 'uaqs_large',
        ),
        'type' => 'image',
        'weight' => 0,
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
        'weight' => 2,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_photos',
    'label' => 'Event Photos',
    'required' => 0,
    'settings' => array(
      'alt_field' => 1,
      'default_image' => 0,
      'file_directory' => 'images/events',
      'file_extensions' => 'png gif jpg jpeg',
      'max_filesize' => '2 MB',
      'max_resolution' => '',
      'min_resolution' => '568x426',
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
      'weight' => 4,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_short_title'.
  $field_instances['node-uaqs_event-field_uaqs_short_title'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => array(
      0 => array(
        'value' => '[node:title]',
      ),
    ),
    'deleted' => 0,
    'description' => '<strong>Suggested character limit:</strong> 30.  This field supports tokens.',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 12,
      ),
      'teaser' => array(
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
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_plain',
        'weight' => 29,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_plain',
        'weight' => 67,
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
      'weight' => 2,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_summary'.
  $field_instances['node-uaqs_event-field_uaqs_summary'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => array(
      0 => array(
        'value' => '',
        'format' => 'uaqs_standard',
      ),
    ),
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 13,
      ),
      'teaser' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
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
        'weight' => 9,
      ),
      'uaqs_med_media_list' => array(
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
      'weight' => 4,
    ),
  );

  // Exported field_instance: 'node-uaqs_event-field_uaqs_summary_short'.
  $field_instances['node-uaqs_event-field_uaqs_summary_short'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'default' => array(
        'label' => 'hidden',
        'module' => 'text',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'text_default',
        'weight' => 2,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 7,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 2,
      ),
    ),
    'entity_type' => 'node',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_summary_short',
    'label' => 'Subtitle',
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

  // Exported field_instance: 'node-uaqs_event-title_field'.
  $field_instances['node-uaqs_event-title_field'] = array(
    'bundle' => 'uaqs_event',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 10,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
      'uaqs_card' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 28,
      ),
      'uaqs_med_media_list' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 66,
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
        'page' => 0,
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
  t('<strong>Issue</strong><br>By default, this field does not actually promote content to the front page. Instead, that\'s done by checking "Promoted to front page" under "Publishing options."<br><br>
<strong>Next Steps</strong><br>We intend to deprecate this field in the near future. If you or your team actually use this field — for custom views or other reasons — please let us know by emailing <a href="mailto:uadigital@email.arizona.edu">uadigital@email.arizona.edu</a> or on the <a href="https://uarizona.slack.com/messages/C0SAKC0T1" target="_blank">#ua-quickstart Slack channel</a>.


');
  t('<strong>Suggested character limit:</strong> 30.  This field supports tokens.');
  t('Attachments');
  t('Category');
  t('Event Contacts');
  t('Event Photos');
  t('Event description');
  t('If you want to link to this event on [site:name], leave the token in the URL field, if you want to link to the event hosted elsewhere, such as on the master calendar, replace the token with a link.');
  t('Link to event');
  t('Persons who can be contacted about the event');
  t('Select the categories you would like this event to appear in throughout the site.');
  t('Short Title');
  t('Show on Front Page');
  t('Specify a URL if there is an online map for the location.<br />
If there is no map, simply fill in the location name or address in the title field.<br />
<strong>Campus Map: </strong> http://map.arizona.edu<br />
<strong>Google Maps: </strong> http://maps.google.com');
  t('Subtitle');
  t('Summary');
  t('Title');
  t('When');
  t('Where');

  return $field_instances;
}
