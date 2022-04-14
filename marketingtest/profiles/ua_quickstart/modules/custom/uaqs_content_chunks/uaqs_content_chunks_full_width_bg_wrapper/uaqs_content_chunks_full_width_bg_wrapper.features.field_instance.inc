<?php

/**
 * @file
 * uaqs_content_chunks_full_width_bg_wrapper.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_content_chunks_full_width_bg_wrapper_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance:
  // 'paragraphs_item-uaqs_full_width_bg_wrapper-field_uaqs_background_color'.
  $field_instances['paragraphs_item-uaqs_full_width_bg_wrapper-field_uaqs_background_color'] = array(
    'bundle' => 'uaqs_full_width_bg_wrapper',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '<br><big><b>Important:</b></big> Site editors are responsible for accessibility and brand guideline considerations.<ul><li>To ensure proper color contrast, use the text color accessibility test at the bottom of the <a href="http://uadigital.arizona.edu/ua-bootstrap/colors.html" target="_blank">UA Bootstrap color documentation</a>.</li><li>For guidance on using the University of Arizona color palette, visit <a href="https://brand.arizona.edu/ua-color-palette" target="_blank">brand.arizona.edu</a>.</li></ul>',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 3,
      ),
      'paragraphs_editor_preview' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'paragraphs_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_background_color',
    'label' => 'Background Color',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(),
      'type' => 'options_select',
      'weight' => 3,
    ),
  );

  // Exported field_instance:
  // 'paragraphs_item-uaqs_full_width_bg_wrapper-field_uaqs_background_pattern'.
  $field_instances['paragraphs_item-uaqs_full_width_bg_wrapper-field_uaqs_background_pattern'] = array(
    'bundle' => 'uaqs_full_width_bg_wrapper',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '<br><big><b>Important:</b></big> Patterns are intended to be used sparingly.<ul><li>Please ensure sufficient contrast between text and its background.</li><li> More detail on background pattern options can be found in the <a href="http://uadigital.arizona.edu/ua-bootstrap/components.html#background-wrappers" target="_blank">UA Bootstrap background wrapper documentation</a>.</li>',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 4,
      ),
      'paragraphs_editor_preview' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'paragraphs_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_background_pattern',
    'label' => 'Background Pattern',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(),
      'type' => 'options_select',
      'weight' => 4,
    ),
  );

  // Exported field_instance:
  // 'paragraphs_item-uaqs_full_width_bg_wrapper-field_uaqs_summary'.
  $field_instances['paragraphs_item-uaqs_full_width_bg_wrapper-field_uaqs_summary'] = array(
    'bundle' => 'uaqs_full_width_bg_wrapper',
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
        'weight' => 0,
      ),
      'paragraphs_editor_preview' => array(
        'label' => 'hidden',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'paragraphs_item',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_summary',
    'label' => 'Wrapper Text',
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
      'weight' => 0,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('<br><big><b>Important:</b></big> Patterns are intended to be used sparingly.<ul><li>Please ensure sufficient contrast between text and its background.</li><li> More detail on background pattern options can be found in the <a href="http://uadigital.arizona.edu/ua-bootstrap/components.html#background-wrappers" target="_blank">UA Bootstrap background wrapper documentation</a>.</li>');
  t('<br><big><b>Important:</b></big> Site editors are responsible for accessibility and brand guideline considerations.<ul><li>To ensure proper color contrast, use the text color accessibility test at the bottom of the <a href="http://uadigital.arizona.edu/ua-bootstrap/colors.html" target="_blank">UA Bootstrap color documentation</a>.</li><li>For guidance on using the University of Arizona color palette, visit <a href="https://brand.arizona.edu/ua-color-palette" target="_blank">brand.arizona.edu</a>.</li></ul>');
  t('Background Color');
  t('Background Pattern');
  t('Wrapper Text');

  return $field_instances;
}
