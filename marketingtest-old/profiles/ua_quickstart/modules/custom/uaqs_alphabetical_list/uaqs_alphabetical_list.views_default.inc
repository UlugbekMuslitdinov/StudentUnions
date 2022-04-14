<?php
/**
 * @file
 * uaqs_alphabetical_list.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function uaqs_alphabetical_list_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'uaqs_alphabetical_listing';
  $view->description = 'Content in this view must have the field_uaqs_index_letter field.';
  $view->tag = 'UAQS';
  $view->base_table = 'node';
  $view->human_name = 'UAQS Alphabetical listing';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = '<none>';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['group_by'] = TRUE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['grouping'] = array(
    0 => array(
      'field' => 'field_uaqs_index_letter',
      'rendered' => 0,
      'rendered_strip' => 0,
    ),
  );
  $handler->display->display_options['style_options']['row_class'] = 'uaqs-row-[field_uaqs_index_letter]';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_sidebar_teaser_list';
  /* Field: Content: Alpha index letters */
  $handler->display->display_options['fields']['field_uaqs_index_letter']['id'] = 'field_uaqs_index_letter';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['table'] = 'field_data_field_uaqs_index_letter';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['field'] = 'field_uaqs_index_letter';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['element_type'] = 'h3';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['element_class'] = 'text-uppercase text-blue60b sans';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['element_label_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_index_letter']['element_wrapper_type'] = 'h3';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['element_wrapper_class'] = 'text-uppercase';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_index_letter']['hide_empty'] = TRUE;
  $handler->display->display_options['fields']['field_uaqs_index_letter']['empty_zero'] = TRUE;
  $handler->display->display_options['fields']['field_uaqs_index_letter']['type'] = 'list_key';
  $handler->display->display_options['fields']['field_uaqs_index_letter']['settings'] = array(
    'field_multiple_limit' => '1',
    'field_multiple_limit_offset' => '0',
    'field_multiple_limit_order' => '0',
  );
  $handler->display->display_options['fields']['field_uaqs_index_letter']['group_columns'] = array(
    'value' => 'value',
  );
  $handler->display->display_options['fields']['field_uaqs_index_letter']['group_rows'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_index_letter']['delta_offset'] = '0';
  /* Sort criterion: Content: Alpha index letters (field_uaqs_index_letter) */
  $handler->display->display_options['sorts']['field_uaqs_index_letter_value']['id'] = 'field_uaqs_index_letter_value';
  $handler->display->display_options['sorts']['field_uaqs_index_letter_value']['table'] = 'field_data_field_uaqs_index_letter';
  $handler->display->display_options['sorts']['field_uaqs_index_letter_value']['field'] = 'field_uaqs_index_letter_value';
  /* Sort criterion: Content: Title */
  $handler->display->display_options['sorts']['title']['id'] = 'title';
  $handler->display->display_options['sorts']['title']['table'] = 'node';
  $handler->display->display_options['sorts']['title']['field'] = 'title';
  /* Contextual filter: Content: Type */
  $handler->display->display_options['arguments']['type']['id'] = 'type';
  $handler->display->display_options['arguments']['type']['table'] = 'node';
  $handler->display->display_options['arguments']['type']['field'] = 'type';
  $handler->display->display_options['arguments']['type']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['type']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['type']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['type']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['type']['limit'] = '0';
  /* Filter criterion: Content: Alpha index letters (field_uaqs_index_letter) */
  $handler->display->display_options['filters']['field_uaqs_index_letter_value']['id'] = 'field_uaqs_index_letter_value';
  $handler->display->display_options['filters']['field_uaqs_index_letter_value']['table'] = 'field_data_field_uaqs_index_letter';
  $handler->display->display_options['filters']['field_uaqs_index_letter_value']['field'] = 'field_uaqs_index_letter_value';
  $handler->display->display_options['filters']['field_uaqs_index_letter_value']['operator'] = 'not empty';
  /* Filter criterion: Content: Published or admin */
  $handler->display->display_options['filters']['status_extra']['id'] = 'status_extra';
  $handler->display->display_options['filters']['status_extra']['table'] = 'node';
  $handler->display->display_options['filters']['status_extra']['field'] = 'status_extra';

  /* Display: UAQS Minimal Media List */
  $handler = $view->new_display('page', 'UAQS Minimal Media List', 'uaqs_sidebar_teaser_list');
  $handler->display->display_options['defaults']['group_by'] = FALSE;
  $handler->display->display_options['group_by'] = TRUE;
  $handler->display->display_options['path'] = 'a-z/uaqs_sidebar_teaser_list/%';
  $export['uaqs_alphabetical_listing'] = $view;

  return $export;
}
