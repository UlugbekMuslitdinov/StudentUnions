<?php

/**
 * @file
 * uaqs_event.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_event_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block_2|node|uaqs_event|uaqs_card';
  $field_group->group_name = 'group_card_block_2';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
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
  $field_groups['group_card_block_2|node|uaqs_event|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|node|uaqs_event|uaqs_card';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Card block',
    'weight' => '1',
    'children' => array(
      0 => 'group_date',
      1 => 'group_h4',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card block',
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
  $field_groups['group_card_block|node|uaqs_event|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_category|node|uaqs_event|default';
  $field_group->group_name = 'group_category';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Category Div',
    'weight' => '3',
    'children' => array(
      0 => 'field_uaqs_event_category',
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
  $field_groups['group_category|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_col_1|node|uaqs_event|default';
  $field_group->group_name = 'group_col_1';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_row_1';
  $field_group->data = array(
    'label' => 'column 1',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_date',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'column 1',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-6',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_col_1|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_col_2|node|uaqs_event|default';
  $field_group->group_name = 'group_col_2';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_row_1';
  $field_group->data = array(
    'label' => 'column 2',
    'weight' => '5',
    'children' => array(
      0 => 'field_uaqs_location',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'column 2',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-6',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_col_2|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_col_3|node|uaqs_event|default';
  $field_group->group_name = 'group_col_3';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_row_2';
  $field_group->data = array(
    'label' => 'column 3',
    'weight' => '26',
    'children' => array(
      0 => 'field_uaqs_contacts',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'column 3',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-6',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_col_3|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_col_4|node|uaqs_event|default';
  $field_group->group_name = 'group_col_4';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_row_2';
  $field_group->data = array(
    'label' => 'column 4',
    'weight' => '27',
    'children' => array(
      0 => 'field_uaqs_attachments',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'column 4',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-md-6',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_col_4|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_col_one|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_col_one';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column one',
    'weight' => '43',
    'children' => array(
      0 => 'group_short_date',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column one',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-4 col-md-2',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_col_one|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_col_two|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_col_two';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_row';
  $field_group->data = array(
    'label' => 'Column two',
    'weight' => '44',
    'children' => array(
      0 => 'group_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Column two',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'col-xs-8 col-md-10',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => 'div',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_col_two|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_date|node|uaqs_event|uaqs_card';
  $field_group->group_name = 'group_date';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Date',
    'weight' => '14',
    'children' => array(
      0 => 'field_uaqs_date',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Date',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'h5 card-subtitle text-muted',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_date|node|uaqs_event|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_day|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_day';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_short_date';
  $field_group->data = array(
    'label' => 'Day',
    'weight' => '49',
    'children' => array(
      0 => 'uaqs_event_day_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Day',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'h3 text-center margin-zero-top margin-zero-bottom',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_day|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_deprecation|node|uaqs_event|form';
  $field_group->group_name = 'group_deprecation';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Scheduled for deprecation',
    'weight' => '11',
    'children' => array(
      0 => 'field_uaqs_front',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Scheduled for deprecation',
      'instance_settings' => array(
        'required_fields' => 1,
        'classes' => 'group-deprecation field-group-tab',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $field_groups['group_deprecation|node|uaqs_event|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_h4|node|uaqs_event|uaqs_card';
  $field_group->group_name = 'group_h4';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'h4',
    'weight' => '15',
    'children' => array(
      0 => 'group_span',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'h4',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-title psuedo-link',
        'element' => 'h4',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_h4|node|uaqs_event|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_heading|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_heading';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_summary';
  $field_group->data = array(
    'label' => 'Heading',
    'weight' => '53',
    'children' => array(
      0 => 'group_text_red_30b',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Heading',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'h4 margin-zero-top',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_heading|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_event|uaqs_card';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '0',
    'children' => array(
      0 => 'group_card_block_2',
      1 => 'group_card_block',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'link-container height-100 remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|node|uaqs_event|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '0',
    'children' => array(
      0 => 'group_row',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_link',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'uaqs-event-row remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_margin_align_bottom|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_margin_align_bottom';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_summary';
  $field_group->data = array(
    'label' => 'Align bottom',
    'weight' => '54',
    'children' => array(
      0 => 'field_uaqs_summary',
      1 => 'group_strong',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Align bottom',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-ash',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_margin_align_bottom|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_month|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_month';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_short_date';
  $field_group->data = array(
    'label' => 'Month',
    'weight' => '47',
    'children' => array(
      0 => 'uaqs_event_month_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Month',
      'instance_settings' => array(
        'id' => '',
        'classes' => ' h5 text-center margin-zero-top margin-zero-bottom text-uppercase',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_month|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row_1|node|uaqs_event|default';
  $field_group->group_name = 'group_row_1';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'row 1',
    'weight' => '5',
    'children' => array(
      0 => 'group_col_1',
      1 => 'group_col_2',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'row 1',
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
  $field_groups['group_row_1|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row_2|node|uaqs_event|default';
  $field_group->group_name = 'group_row_2';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'row 2',
    'weight' => '6',
    'children' => array(
      0 => 'group_col_3',
      1 => 'group_col_4',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'row 2',
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
  $field_groups['group_row_2|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_row|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_row';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Row',
    'weight' => '39',
    'children' => array(
      0 => 'group_col_one',
      1 => 'group_col_two',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Row',
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
  $field_groups['group_row|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_short_date|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_short_date';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_col_one';
  $field_group->data = array(
    'label' => 'Short Date',
    'weight' => '58',
    'children' => array(
      0 => 'group_day',
      1 => 'group_month',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Short Date',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'bg-ash-tint event-date card-block embed-responsive-item',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_short_date|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_span_subtitle|node|uaqs_event|default';
  $field_group->group_name = 'group_span_subtitle';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'span subtitle',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_summary_short',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'span subtitle',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'lead',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_span_subtitle|node|uaqs_event|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_span|node|uaqs_event|uaqs_card';
  $field_group->group_name = 'group_span';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_card';
  $field_group->parent_name = 'group_h4';
  $field_group->data = array(
    'label' => 'External link span',
    'weight' => '27',
    'children' => array(
      0 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'External link span',
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
  $field_groups['group_span|node|uaqs_event|uaqs_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_span|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_span';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_text_red_30b';
  $field_group->data = array(
    'label' => 'External link span',
    'weight' => '65',
    'children' => array(
      0 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'External link span',
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
  $field_groups['group_span|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_strong|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_strong';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_margin_align_bottom';
  $field_group->data = array(
    'label' => 'Strong',
    'weight' => '14',
    'children' => array(
      0 => 'field_uaqs_date',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Strong',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-ash',
        'element' => 'strong',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_strong|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_summary|node|uaqs_event|form';
  $field_group->group_name = 'group_summary';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Summary fields',
    'weight' => '10',
    'children' => array(
      0 => 'field_uaqs_link',
      1 => 'field_uaqs_short_title',
      2 => 'field_uaqs_summary',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Summary fields',
      'instance_settings' => array(
        'required_fields' => 1,
        'classes' => 'group-summary field-group-tab',
        'description' => 'For use in feeds and content listings.',
      ),
      'formatter' => 'closed',
    ),
  );
  $field_groups['group_summary|node|uaqs_event|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_summary|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_summary';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_col_two';
  $field_group->data = array(
    'label' => 'Summary',
    'weight' => '52',
    'children' => array(
      0 => 'group_heading',
      1 => 'group_margin_align_bottom',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Summary',
      'instance_settings' => array(
        'id' => '',
        'classes' => ' bg-ash-tint card-block',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_summary|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_text_red_30b|node|uaqs_event|uaqs_med_media_list';
  $field_group->group_name = 'group_text_red_30b';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'uaqs_event';
  $field_group->mode = 'uaqs_med_media_list';
  $field_group->parent_name = 'group_heading';
  $field_group->data = array(
    'label' => 'Dark red text',
    'weight' => '61',
    'children' => array(
      0 => 'group_span',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Dark red text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'text-red30b psuedo-link',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_text_red_30b|node|uaqs_event|uaqs_med_media_list'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Align bottom');
  t('Card block');
  t('Category Div');
  t('Column one');
  t('Column two');
  t('Dark red text');
  t('Date');
  t('Day');
  t('External link span');
  t('Heading');
  t('Link');
  t('Month');
  t('Row');
  t('Scheduled for deprecation');
  t('Short Date');
  t('Strong');
  t('Summary');
  t('Summary fields');
  t('column 1');
  t('column 2');
  t('column 3');
  t('column 4');
  t('h4');
  t('row 1');
  t('row 2');
  t('span subtitle');

  return $field_groups;
}
