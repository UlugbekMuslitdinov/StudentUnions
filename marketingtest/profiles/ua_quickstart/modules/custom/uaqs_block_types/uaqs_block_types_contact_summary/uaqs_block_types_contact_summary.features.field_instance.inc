<?php
/**
 * @file
 * uaqs_block_types_contact_summary.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_block_types_contact_summary_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance:
  // 'bean-uaqs_contact_summary-field_uaqs_contact_address'.
  $field_instances['bean-uaqs_contact_summary-field_uaqs_contact_address'] = array(
    'bundle' => 'uaqs_contact_summary',
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
        'weight' => 1,
      ),
      'uaqs_expanded' => array(
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
    'entity_type' => 'bean',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_contact_address',
    'label' => 'Address',
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
      'weight' => 11,
    ),
  );

  // Exported field_instance:
  // 'bean-uaqs_contact_summary-field_uaqs_contact_mail_link'.
  $field_instances['bean-uaqs_contact_summary-field_uaqs_contact_mail_link'] = array(
    'bundle' => 'uaqs_contact_summary',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'General email address for this contact.<br />
<strong>URL format:</strong> mailto:email@email.arizona.edu',
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
        'weight' => 6,
      ),
      'uaqs_expanded' => array(
        'label' => 'hidden',
        'module' => 'link',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'link_default',
        'weight' => 6,
      ),
    ),
    'entity_type' => 'bean',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_contact_mail_link',
    'label' => 'Email',
    'required' => 0,
    'settings' => array(
      'absolute_url' => 1,
      'attributes' => array(
        'class' => '',
        'configurable_class' => 0,
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
      'weight' => 12,
    ),
  );

  // Exported field_instance:
  // 'bean-uaqs_contact_summary-field_uaqs_contact_phone'.
  $field_instances['bean-uaqs_contact_summary-field_uaqs_contact_phone'] = array(
    'bundle' => 'uaqs_contact_summary',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'General phone number for the contact (use the form 520-999-9999).',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'telephone',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title' => '',
        ),
        'type' => 'telephone_link',
        'weight' => 10,
      ),
      'uaqs_expanded' => array(
        'label' => 'hidden',
        'module' => 'telephone',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
          'title' => '',
        ),
        'type' => 'telephone_link',
        'weight' => 10,
      ),
    ),
    'entity_type' => 'bean',
    'fences_wrapper' => 'no_wrapper',
    'field_name' => 'field_uaqs_contact_phone',
    'label' => 'Phone',
    'required' => 0,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'telephone',
      'settings' => array(
        'placeholder' => '',
        'size' => 60,
      ),
      'type' => 'telephone_default',
      'weight' => 13,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Address');
  t('Email');
  t('General email address for this contact.<br />
<strong>URL format:</strong> mailto:email@email.arizona.edu');
  t('General phone number for the contact (use the form 520-999-9999).');
  t('Phone');

  return $field_instances;
}
