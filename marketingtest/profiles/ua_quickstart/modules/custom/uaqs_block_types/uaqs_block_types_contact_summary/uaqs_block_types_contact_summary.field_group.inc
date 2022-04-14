<?php
/**
 * @file
 * uaqs_block_types_contact_summary.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_block_types_contact_summary_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_address_area|bean|uaqs_contact_summary|default';
  $field_group->group_name = 'group_address_area';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_contact_summary';
  $field_group->data = array(
    'label' => 'Contact Address',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_contact_address',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Address',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_address_area|bean|uaqs_contact_summary|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_address_area|bean|uaqs_contact_summary|uaqs_expanded';
  $field_group->group_name = 'group_address_area';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'uaqs_expanded';
  $field_group->parent_name = 'group_contact_summary';
  $field_group->data = array(
    'label' => 'Contact Address',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_contact_address',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Address',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'div',
        'show_label' => '1',
        'label_element' => 'h5',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_address_area|bean|uaqs_contact_summary|uaqs_expanded'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_contact_summary|bean|uaqs_contact_summary|default';
  $field_group->group_name = 'group_contact_summary';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Contact Summary',
    'weight' => '0',
    'children' => array(
      0 => 'group_address_area',
      1 => 'group_email_area',
      2 => 'group_phone_area',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Summary',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-center-xs text-right-sm text-right-md text-right-lg',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_contact_summary|bean|uaqs_contact_summary|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_contact_summary|bean|uaqs_contact_summary|uaqs_expanded';
  $field_group->group_name = 'group_contact_summary';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'uaqs_expanded';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Contact Summary',
    'weight' => '0',
    'children' => array(
      0 => 'group_address_area',
      1 => 'group_email_area',
      2 => 'group_phone_area',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Summary',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'div',
        'show_label' => '1',
        'label_element' => 'h4',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_contact_summary|bean|uaqs_contact_summary|uaqs_expanded'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_email_area|bean|uaqs_contact_summary|default';
  $field_group->group_name = 'group_email_area';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_contact_summary';
  $field_group->data = array(
    'label' => 'Contact Email',
    'weight' => '6',
    'children' => array(
      0 => 'field_uaqs_contact_mail_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Email',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_email_area|bean|uaqs_contact_summary|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_email_area|bean|uaqs_contact_summary|uaqs_expanded';
  $field_group->group_name = 'group_email_area';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'uaqs_expanded';
  $field_group->parent_name = 'group_contact_summary';
  $field_group->data = array(
    'label' => 'Contact Email',
    'weight' => '6',
    'children' => array(
      0 => 'field_uaqs_contact_mail_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Email',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'div',
        'show_label' => '1',
        'label_element' => 'h5',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_email_area|bean|uaqs_contact_summary|uaqs_expanded'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_phone_area|bean|uaqs_contact_summary|default';
  $field_group->group_name = 'group_phone_area';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_contact_summary';
  $field_group->data = array(
    'label' => 'Contact Phone',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_contact_phone',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Phone',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_phone_area|bean|uaqs_contact_summary|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_phone_area|bean|uaqs_contact_summary|uaqs_expanded';
  $field_group->group_name = 'group_phone_area';
  $field_group->entity_type = 'bean';
  $field_group->bundle = 'uaqs_contact_summary';
  $field_group->mode = 'uaqs_expanded';
  $field_group->parent_name = 'group_contact_summary';
  $field_group->data = array(
    'label' => 'Contact Phone',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_contact_phone',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Contact Phone',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'div',
        'show_label' => '1',
        'label_element' => 'h5',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_phone_area|bean|uaqs_contact_summary|uaqs_expanded'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Contact Address');
  t('Contact Email');
  t('Contact Phone');
  t('Contact Summary');

  return $field_groups;
}
