<?php

/**
 * @file
 * uaqs_event_view.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function uaqs_event_view_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'uaqs_events';
  $view->description = 'Lists of events made with the UAQS Event content type.';
  $view->tag = 'uaqs_event';
  $view->base_table = 'node';
  $view->human_name = 'UAQS Events';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Calendar';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_text'] = '';
  $handler->display->display_options['link_display'] = 'custom_url';
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['row_class'] = 'uaqs-event-row';
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['row_plugin'] = 'node';
  /* Field: Content: When (field_uaqs_date:delta) */
  $handler->display->display_options['fields']['delta']['id'] = 'delta';
  $handler->display->display_options['fields']['delta']['table'] = 'field_data_field_uaqs_date';
  $handler->display->display_options['fields']['delta']['field'] = 'delta';
  $handler->display->display_options['fields']['delta']['label'] = '';
  $handler->display->display_options['fields']['delta']['element_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_label_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['delta']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['delta']['separator'] = '';
  /* Sort criterion: Content: When -  start date (field_uaqs_date) */
  $handler->display->display_options['sorts']['field_uaqs_date_value']['id'] = 'field_uaqs_date_value';
  $handler->display->display_options['sorts']['field_uaqs_date_value']['table'] = 'field_data_field_uaqs_date';
  $handler->display->display_options['sorts']['field_uaqs_date_value']['field'] = 'field_uaqs_date_value';
  /* Contextual filter: Content: Has taxonomy term ID */
  $handler->display->display_options['arguments']['tid']['id'] = 'tid';
  $handler->display->display_options['arguments']['tid']['table'] = 'taxonomy_index';
  $handler->display->display_options['arguments']['tid']['field'] = 'tid';
  $handler->display->display_options['arguments']['tid']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['tid']['validate_options']['vocabularies'] = array(
    'event_categories' => 'event_categories',
  );
  $handler->display->display_options['arguments']['tid']['validate_options']['type'] = 'tids';
  $handler->display->display_options['arguments']['tid']['validate']['fail'] = 'ignore';
  $handler->display->display_options['arguments']['tid']['break_phrase'] = TRUE;
  /* Filter criterion: Content: Published status */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_event' => 'uaqs_event',
  );
  /* Filter criterion: Date: Date (node) */
  $handler->display->display_options['filters']['date_filter']['id'] = 'date_filter';
  $handler->display->display_options['filters']['date_filter']['table'] = 'node';
  $handler->display->display_options['filters']['date_filter']['field'] = 'date_filter';
  $handler->display->display_options['filters']['date_filter']['operator'] = '>=';
  $handler->display->display_options['filters']['date_filter']['granularity'] = 'second';
  $handler->display->display_options['filters']['date_filter']['default_date'] = 'now';
  $handler->display->display_options['filters']['date_filter']['date_fields'] = array(
    'field_data_field_uaqs_date.field_uaqs_date_value' => 'field_data_field_uaqs_date.field_uaqs_date_value',
    'field_data_field_uaqs_date.field_uaqs_date_value2' => 'field_data_field_uaqs_date.field_uaqs_date_value2',
  );

  /* Display: Full Calendar */
  $handler = $view->new_display('page', 'Full Calendar', 'page');
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['css_class'] = 'uaqs-event-calendar';
  $handler->display->display_options['defaults']['use_ajax'] = FALSE;
  $handler->display->display_options['use_ajax'] = TRUE;
  $handler->display->display_options['defaults']['exposed_form'] = FALSE;
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['autosubmit'] = TRUE;
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'mini';
  $handler->display->display_options['pager']['options']['items_per_page'] = '20';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_med_media_list';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['exposed_block'] = TRUE;
  $handler->display->display_options['defaults']['empty'] = FALSE;
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = '<em>There are no events listed for this time span.</em>';
  $handler->display->display_options['empty']['area']['format'] = 'filtered_html';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: When (field_uaqs_date:delta) */
  $handler->display->display_options['fields']['delta']['id'] = 'delta';
  $handler->display->display_options['fields']['delta']['table'] = 'field_data_field_uaqs_date';
  $handler->display->display_options['fields']['delta']['field'] = 'delta';
  $handler->display->display_options['fields']['delta']['label'] = '';
  $handler->display->display_options['fields']['delta']['element_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_label_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['delta']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['delta']['separator'] = '';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published status */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_event' => 'uaqs_event',
  );
  /* Filter criterion: Calendar Filter (node) */
  $handler->display->display_options['filters']['calendar_filter']['id'] = 'calendar_filter';
  $handler->display->display_options['filters']['calendar_filter']['table'] = 'node';
  $handler->display->display_options['filters']['calendar_filter']['field'] = 'calendar_filter';
  $handler->display->display_options['filters']['calendar_filter']['ui_name'] = 'Calendar Filter (node)';
  $handler->display->display_options['filters']['calendar_filter']['operator'] = 'between';
  $handler->display->display_options['filters']['calendar_filter']['exposed'] = TRUE;
  $handler->display->display_options['filters']['calendar_filter']['expose']['operator_id'] = '';
  $handler->display->display_options['filters']['calendar_filter']['expose']['identifier'] = 'calendar_filter';
  $handler->display->display_options['filters']['calendar_filter']['expose']['remember_roles'] = array(
    2 => '2',
  );
  $handler->display->display_options['filters']['calendar_filter']['form_type'] = 'date_text';
  $handler->display->display_options['filters']['calendar_filter']['default_date'] = 'today';
  $handler->display->display_options['filters']['calendar_filter']['default_to_date'] = 'last day of 3 years';
  $handler->display->display_options['filters']['calendar_filter']['date_fields'] = array(
    'field_data_field_uaqs_date.field_uaqs_date_value' => 'field_data_field_uaqs_date.field_uaqs_date_value',
  );
  /* Filter criterion: Content: Category (field_uaqs_event_category) */
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['id'] = 'field_uaqs_event_category_tid';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['table'] = 'field_data_field_uaqs_event_category';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['field'] = 'field_uaqs_event_category_tid';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['exposed'] = TRUE;
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['expose']['operator_id'] = 'field_uaqs_event_category_tid_op';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['expose']['label'] = 'Category';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['expose']['operator'] = 'field_uaqs_event_category_tid_op';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['expose']['identifier'] = 'field_uaqs_event_category_tid';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['expose']['remember_roles'] = array(
    2 => '2',
  );
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['type'] = 'select';
  $handler->display->display_options['filters']['field_uaqs_event_category_tid']['vocabulary'] = 'event_categories';
  $handler->display->display_options['path'] = 'calendar';

  /* Display: Event list block */
  $handler = $view->new_display('block', 'Event list block', 'list_block');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Events';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '6';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['header'] = FALSE;
  /* Header: Global: Unfiltered text */
  $handler->display->display_options['header']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['header']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['content'] = '<hr>';
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Footer: Global: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<p>&nbsp;</p>
<div class="text-center"><a href="/calendar" class="btn btn-arrow btn-sand text-uppercase">View all events on the calendar</a></div>
<hr>';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: When (field_uaqs_date:delta) */
  $handler->display->display_options['fields']['delta']['id'] = 'delta';
  $handler->display->display_options['fields']['delta']['table'] = 'field_data_field_uaqs_date';
  $handler->display->display_options['fields']['delta']['field'] = 'delta';
  $handler->display->display_options['fields']['delta']['label'] = '';
  $handler->display->display_options['fields']['delta']['element_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_label_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['delta']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['delta']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['delta']['separator'] = '';
  $handler->display->display_options['block_description'] = 'UAQS Event list block';

  /* Display: Event card group */
  $handler = $view->new_display('block', 'Event card group', 'card_group_block');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Events';
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['display_description'] = 'Use in a region that spans at least 12 columns.';
  $handler->display->display_options['defaults']['use_more'] = FALSE;
  $handler->display->display_options['defaults']['use_more_always'] = FALSE;
  $handler->display->display_options['defaults']['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_always'] = TRUE;
  $handler->display->display_options['defaults']['use_more_text'] = FALSE;
  $handler->display->display_options['use_more_text'] = 'Full Calendar »';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '3';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_card';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Footer: Global: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<div class="item-list text-center"><ul class="pagination">
<li><a title="View all events on the calendar" href="/calendar">View all events on the calendar</a></li>
</ul></div>
';
  $handler->display->display_options['block_description'] = 'UAQS Event card group';

  /* Display: Event card group sidebar */
  $handler = $view->new_display('block', 'Event card group sidebar', 'block_1');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = '<none>';
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['display_description'] = 'Use in first or second sidebar regions';
  $handler->display->display_options['defaults']['use_more'] = FALSE;
  $handler->display->display_options['defaults']['use_more_always'] = FALSE;
  $handler->display->display_options['defaults']['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_always'] = TRUE;
  $handler->display->display_options['defaults']['use_more_text'] = FALSE;
  $handler->display->display_options['use_more_text'] = 'Full Calendar »';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '3';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_card';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['header'] = FALSE;
  /* Header: Global: Unfiltered text */
  $handler->display->display_options['header']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['header']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['header']['area_text_custom']['content'] = '<h2 class="h4 margin-align-middle text-uppercase"><strong>Upcoming Events</strong></h2>';
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Footer: Global: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<div class="item-list text-center"><ul class="pagination">
<li><a title="View all events on the calendar" href="/calendar">View all events on the calendar</a></li>
</ul></div>
';
  $handler->display->display_options['block_description'] = 'Sidebar UAQS Event Card Group ';
  $export['uaqs_events'] = $view;

  return $export;
}
