<?php

/**
 * @file
 * uaqs_fields_field_collection.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uaqs_fields_field_collection_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_contacts-field_uaqs_contact_email'.
  $field_instances['field_collection_item-field_uaqs_contacts-field_uaqs_contact_email'] = array(
    'bundle' => 'field_uaqs_contacts',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'hidden',
        'module' => 'email',
        'settings' => array(
          'field_multiple_limit' => -1,
          'field_multiple_limit_offset' => 0,
          'field_multiple_limit_order' => 0,
        ),
        'type' => 'email_default',
        'weight' => 1,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'field_name' => 'field_uaqs_contact_email',
    'label' => 'Contact Email',
    'required' => 0,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'email',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'email_textfield',
      'weight' => 2,
    ),
  );

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_contacts-field_uaqs_contact_name'.
  $field_instances['field_collection_item-field_uaqs_contacts-field_uaqs_contact_name'] = array(
    'bundle' => 'field_uaqs_contacts',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => 'Full name if possible',
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
    ),
    'entity_type' => 'field_collection_item',
    'field_name' => 'field_uaqs_contact_name',
    'label' => 'Contact Name',
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

  // Exported field_instance:
  // 'field_collection_item-field_uaqs_contacts-field_uaqs_contact_phone'.
  $field_instances['field_collection_item-field_uaqs_contacts-field_uaqs_contact_phone'] = array(
    'bundle' => 'field_uaqs_contacts',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '<strong>Suggested format:</strong> 520-626-0000',
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
        'weight' => 2,
      ),
    ),
    'entity_type' => 'field_collection_item',
    'field_name' => 'field_uaqs_contact_phone',
    'label' => 'Contact Phone',
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
      'weight' => 3,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('<strong>Suggested format:</strong> 520-626-0000');
  t('Contact Email');
  t('Contact Name');
  t('Contact Phone');
  t('Full name if possible');

  return $field_instances;
}
