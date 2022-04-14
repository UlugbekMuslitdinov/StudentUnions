<?php

/**
 * @file
 * uaqs_person.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_person_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_background|node|uaqs_person|default';
  $field_group->group_name = 'group_background';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Background',
    'weight' => '0',
    'children' => array(
      0 => 'group_parent_row',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Background',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'margin-align-bottom ',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_background|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_1|node|uaqs_person|uaqs_card';
  $field_group->group_name = 'group_card_block_1';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card Block',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_email',
      1 => 'field_uaqs_phones',
      2 => 'field_uaqs_titles',
      3 => 'group_h4',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block_1|node|uaqs_person|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_div|node|uaqs_person|default';
  $field_group->group_name = 'group_card_div';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_column_one';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '43',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_ul',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card margin-align-middle',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_div|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_categories|node|uaqs_person|form';
  $field_group->group_name = 'group_categories';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Categories',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_person_category',
      1 => 'field_uaqs_person_categories',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'label' => 'Categories',
      'instance_settings' => array(
        'required_fields' => 1,
        'id' => '',
        'classes' => 'group-categories field-group-fieldset',
        'description' => '',
      ),
      'formatter' => 'collapsed',
    ),
  );
  $field_groups['group_categories|node|uaqs_person|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_category_div|node|uaqs_person|default';
  $field_group->group_name = 'group_category_div';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_column_two';
  $field_group->data = array(
    'label' => 'Category Div',
    'weight' => '59',
    'children' => array(
      0 => 'field_uaqs_person_category',
      1 => 'field_uaqs_person_categories',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Category Div',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_category_div|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_left|node|uaqs_person|teaser';
  $field_group->group_name = 'group_column_left';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'teaser';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Left Column',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Left Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_left|node|uaqs_person|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_middle|node|uaqs_person|teaser';
  $field_group->group_name = 'group_column_middle';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'teaser';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Middle Column',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_titles',
      1 => 'group_h4',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Middle Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-5',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_middle|node|uaqs_person|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_one|node|uaqs_person|default';
  $field_group->group_name = 'group_column_one';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_parent_row';
  $field_group->data = array(
    'label' => 'Photo Card Column',
    'weight' => '43',
    'children' => array(
      0 => 'group_card_div',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Photo Card Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12 col-md-4',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_one|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_right|node|uaqs_person|teaser';
  $field_group->group_name = 'group_column_right';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'teaser';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Right Column',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_email',
      1 => 'field_uaqs_phones',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Right Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-4',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_right|node|uaqs_person|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_column_two|node|uaqs_person|default';
  $field_group->group_name = 'group_column_two';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_parent_row';
  $field_group->data = array(
    'label' => 'Biography Column',
    'weight' => '44',
    'children' => array(
      0 => 'field_uaqs_bio',
      1 => 'field_uaqs_degrees',
      2 => 'group_category_div',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Biography Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12 col-md-8 pull-right',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_column_two|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_cv|node|uaqs_person|default';
  $field_group->group_name = 'group_cv';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_li_address';
  $field_group->data = array(
    'label' => 'CV / Document Group',
    'weight' => '22',
    'children' => array(
      0 => 'field_uaqs_cv_documents',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'CV / Document Group',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-cv field-group-html-element mt-3',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_cv|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_h4|node|uaqs_person|teaser';
  $field_group->group_name = 'group_h4';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'teaser';
  $field_group->parent_name = 'group_column_middle';
  $field_group->data = array(
    'label' => 'H4',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'H4',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-title',
        'element' => 'h4',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_h4|node|uaqs_person|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_h4|node|uaqs_person|uaqs_card';
  $field_group->group_name = 'group_h4';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_card_block_1';
  $field_group->data = array(
    'label' => 'H4',
    'weight' => '19',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'H4',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-title',
        'element' => 'h4',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_h4|node|uaqs_person|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_lead|node|uaqs_person|default';
  $field_group->group_name = 'group_lead';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_title_column';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_titles',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'h4',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_lead|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_li_address|node|uaqs_person|default';
  $field_group->group_name = 'group_li_address';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_ul';
  $field_group->data = array(
    'label' => 'li address',
    'weight' => '17',
    'children' => array(
      0 => 'field_uaqs_addresses',
      1 => 'field_uaqs_email',
      2 => 'field_uaqs_phones',
      3 => 'field_uaqs_links',
      4 => 'group_cv',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'li address',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'list-group-item',
        'element' => 'li',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_li_address|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_parent_row|node|uaqs_person|default';
  $field_group->group_name = 'group_parent_row';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_background';
  $field_group->data = array(
    'label' => 'Parent Row',
    'weight' => '28',
    'children' => array(
      0 => 'group_column_one',
      1 => 'group_column_two',
      2 => 'group_title_column',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Parent Row',
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
  $field_groups['group_parent_row|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|node|uaqs_person|teaser';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'teaser';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '0',
    'children' => array(
      0 => 'group_column_left',
      1 => 'group_column_middle',
      2 => 'group_column_right',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'row border-separator',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_row|node|uaqs_person|teaser'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_summary|node|uaqs_person|form';
  $field_group->group_name = 'group_summary';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Summary fields',
    'weight' => '14',
    'children' => array(
      0 => 'field_uaqs_link',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-summary field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_summary|node|uaqs_person|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_title_column|node|uaqs_person|default';
  $field_group->group_name = 'group_title_column';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_parent_row';
  $field_group->data = array(
    'label' => 'Title Column',
    'weight' => '42',
    'children' => array(
      0 => 'title_field',
      1 => 'group_lead',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Title Column',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-12 col-md-8 pull-right',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_title_column|node|uaqs_person|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_ul|node|uaqs_person|default';
  $field_group->group_name = 'group_ul';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_person';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card_div';
  $field_group->data = array(
    'label' => 'ul',
    'weight' => '9',
    'children' => array(
      0 => 'group_li_address',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'ul',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'list-group list-group-flush ',
        'element' => 'ul',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_ul|node|uaqs_person|default'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Background');
  t('Biography Column');
  t('CV / Document Group');
  t('Card');
  t('Card Block');
  t('Categories');
  t('Category Div');
  t('H4');
  t('Heading');
  t('Left Column');
  t('Middle Column');
  t('Parent Row');
  t('Photo Card Column');
  t('Right Column');
  t('Row');
  t('Summary fields');
  t('Title Column');
  t('li address');
  t('ul');

  return $field_groups;
}
