<?php

/**
 * @file
 * uaqs_content_chunks_views_page_by_category.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function uaqs_content_chunks_views_page_by_category_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'uaqs_content_chunks_views_page_by_category';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'UAQS Content Chunks - Views Flexible Page by Category';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['grouping'] = array(
    0 => array(
      'field' => 'field_uaqs_flexible_category',
      'rendered' => 1,
      'rendered_strip' => 0,
    ),
  );
  $handler->display->display_options['style_options']['row_class'] = 'uaqs-search-result uaqs-row-visible';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_sidebar_teaser_list';
  /* Relationship: Content: Category (field_uaqs_flexible_category) */
  $handler->display->display_options['relationships']['field_uaqs_flexible_category_tid']['id'] = 'field_uaqs_flexible_category_tid';
  $handler->display->display_options['relationships']['field_uaqs_flexible_category_tid']['table'] = 'field_data_field_uaqs_flexible_category';
  $handler->display->display_options['relationships']['field_uaqs_flexible_category_tid']['field'] = 'field_uaqs_flexible_category_tid';
  $handler->display->display_options['relationships']['field_uaqs_flexible_category_tid']['label'] = 'Categories';
  /* Field: Content: Category */
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['id'] = 'field_uaqs_flexible_category';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['table'] = 'field_data_field_uaqs_flexible_category';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['field'] = 'field_uaqs_flexible_category';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['element_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['type'] = 'taxonomy_term_reference_plain';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['settings'] = array(
    'field_multiple_limit' => '-1',
    'field_multiple_limit_offset' => '0',
    'field_multiple_limit_order' => '0',
  );
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['group_rows'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_flexible_category']['field_api_classes'] = TRUE;
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Contextual filter: Content: Has taxonomy term ID (with depth) */
  $handler->display->display_options['arguments']['term_node_tid_depth']['id'] = 'term_node_tid_depth';
  $handler->display->display_options['arguments']['term_node_tid_depth']['table'] = 'node';
  $handler->display->display_options['arguments']['term_node_tid_depth']['field'] = 'term_node_tid_depth';
  $handler->display->display_options['arguments']['term_node_tid_depth']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['term_node_tid_depth']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['term_node_tid_depth']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['term_node_tid_depth']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['term_node_tid_depth']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['term_node_tid_depth']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['term_node_tid_depth']['validate_options']['vocabularies'] = array(
    'uaqs_flexible_categories' => 'uaqs_flexible_categories',
  );
  $handler->display->display_options['arguments']['term_node_tid_depth']['validate_options']['type'] = 'tids';
  $handler->display->display_options['arguments']['term_node_tid_depth']['validate']['fail'] = 'ignore';
  $handler->display->display_options['arguments']['term_node_tid_depth']['depth'] = '1';
  $handler->display->display_options['arguments']['term_node_tid_depth']['break_phrase'] = TRUE;
  /* Contextual filter: Taxonomy term: Term ID */
  $handler->display->display_options['arguments']['tid']['id'] = 'tid';
  $handler->display->display_options['arguments']['tid']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['arguments']['tid']['field'] = 'tid';
  $handler->display->display_options['arguments']['tid']['relationship'] = 'field_uaqs_flexible_category_tid';
  $handler->display->display_options['arguments']['tid']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['tid']['validate_options']['vocabularies'] = array(
    'uaqs_flexible_categories' => 'uaqs_flexible_categories',
  );
  $handler->display->display_options['arguments']['tid']['validate_options']['type'] = 'tids';
  $handler->display->display_options['arguments']['tid']['validate']['fail'] = 'ignore';
  $handler->display->display_options['arguments']['tid']['break_phrase'] = TRUE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_flexible_page' => 'uaqs_flexible_page',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Published status or admin user */
  $handler->display->display_options['filters']['status_extra']['id'] = 'status_extra';
  $handler->display->display_options['filters']['status_extra']['table'] = 'node';
  $handler->display->display_options['filters']['status_extra']['field'] = 'status_extra';
  $handler->display->display_options['filters']['status_extra']['group'] = 1;

  /* Display: List */
  $handler = $view->new_display('page', 'List', 'page');
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['grouping'] = array(
    0 => array(
      'field' => 'field_uaqs_flexible_category',
      'rendered' => 1,
      'rendered_strip' => 0,
    ),
  );
  $handler->display->display_options['style_options']['row_class'] = 'uaqs-search-result uaqs-row-visible';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['path'] = 'flexible-page-by-category';

  /* Display: Card */
  $handler = $view->new_display('page', 'Card', 'page_1');
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'views_bootstrap_grid_plugin_style';
  $handler->display->display_options['style_options']['grouping'] = array(
    0 => array(
      'field' => 'field_uaqs_flexible_category',
      'rendered' => 1,
      'rendered_strip' => 0,
    ),
  );
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['style_options']['columns_horizontal'] = '-1';
  $handler->display->display_options['style_options']['columns_vertical'] = '4';
  $handler->display->display_options['style_options']['columns_xs'] = '12';
  $handler->display->display_options['style_options']['columns_sm'] = '6';
  $handler->display->display_options['style_options']['columns_md'] = '4';
  $handler->display->display_options['style_options']['columns_lg'] = '4';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_card';
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['path'] = 'flexible-page-by-category';
  $export['uaqs_content_chunks_views_page_by_category'] = $view;

  return $export;
}
