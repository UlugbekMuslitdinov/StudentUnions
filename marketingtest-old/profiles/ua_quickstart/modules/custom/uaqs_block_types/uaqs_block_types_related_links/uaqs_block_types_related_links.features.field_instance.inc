<?php

/**
 * @file
 * uaqs_block_types_related_links.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_block_types_related_links_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'bean-uaqs_related_links-field_uaqs_cta'.
  $field_instances['bean-uaqs_related_links-field_uaqs_cta'] = array(
    'bundle' => 'uaqs_related_links',
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
        'weight' => 12,
      ),
    ),
    'entity_type' => 'bean',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_cta',
    'label' => 'Call to action',
    'required' => 0,
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

  // Exported field_instance: 'bean-uaqs_related_links-title_field'.
  $field_instances['bean-uaqs_related_links-title_field'] = array(
    'bundle' => 'uaqs_related_links',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'The title of the block. This will not be displayed when the block is placed. ',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 1,
      ),
    ),
    'entity_type' => 'bean',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'title_field',
    'label' => 'Title',
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
      'weight' => 5,
    ),
  );

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_cta-field_uaqs_links'.
  $field_instances['field_collection_item-field_uaqs_cta-field_uaqs_links'] = array(
    'bundle' => 'field_uaqs_cta',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'You can add ua-bootstrap classes to these links so that look like buttons as seen here: http://uadigital.arizona.edu/ua-bootstrap/css.html#buttons
',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_default',
        'weight' => 3,
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
        'class' => 'btn btn-hollow btn-block',
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
      'weight' => 2,
    ),
  );

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_cta-field_uaqs_short_title'.
  $field_instances['field_collection_item-field_uaqs_cta-field_uaqs_short_title'] = array(
    'bundle' => 'field_uaqs_cta',
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
        'weight' => 2,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_short_title',
    'label' => 'Title',
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
  // 'field_collection_item-field_uaqs_cta-field_uaqs_summary'.
  $field_instances['field_collection_item-field_uaqs_cta-field_uaqs_summary'] = array(
    'bundle' => 'field_uaqs_cta',
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
        'weight' => 1,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_summary',
    'label' => 'Text',
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
      'weight' => 1,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Call to action');
  t('Links');
  t('Text');
  t('The title of the block. This will not be displayed when the block is placed. ');
  t('Title');
  t('You can add ua-bootstrap classes to these links so that look like buttons as seen here: http://uadigital.arizona.edu/ua-bootstrap/css.html#buttons
');

  return $field_instances;
}
