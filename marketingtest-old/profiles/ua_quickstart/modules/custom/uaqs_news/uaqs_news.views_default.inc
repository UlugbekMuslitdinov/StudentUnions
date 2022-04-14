<?php

/**
 * @file
 * uaqs_news.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function uaqs_news_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'uaqs_news';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'UAQS News';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'News';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['row_class'] = 'col-md-4';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'fields';
  $handler->display->display_options['row_options']['default_field_elements'] = FALSE;
  /* Field: Content: Event Photos */
  $handler->display->display_options['fields']['field_uaqs_photos']['id'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['table'] = 'field_data_field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['field'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photos']['element_wrapper_class'] = 'uaqs-news-photo';
  $handler->display->display_options['fields']['field_uaqs_photos']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_uaqs_photos']['settings'] = array(
    'image_style' => 'uaqs_spotlight',
    'image_link' => 'content',
  );
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_limit'] = '1';
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['separator'] = '';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_type'] = 'h3';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['element_wrapper_class'] = 'uaqs-news-title';
  /* Field: Content: Date of publication */
  $handler->display->display_options['fields']['field_uaqs_published']['id'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['field'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_published']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_published']['element_wrapper_class'] = 'uaqs-news-published';
  $handler->display->display_options['fields']['field_uaqs_published']['type'] = 'ap_date';
  $handler->display->display_options['fields']['field_uaqs_published']['settings'] = array(
    'interval' => 2,
    'interval_display' => 'time ago',
  );
  /* Field: Field: Summary */
  $handler->display->display_options['fields']['field_uaqs_summary']['id'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['table'] = 'field_data_field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['field'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_summary']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_summary']['element_wrapper_class'] = 'uaqs-news-summary';
  /* Sort criterion: Content: Date of publication (field_uaqs_published) */
  $handler->display->display_options['sorts']['field_uaqs_published_value']['id'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['field'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['order'] = 'DESC';
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
    'uaqs_news_tags' => 'uaqs_news_tags',
  );
  $handler->display->display_options['arguments']['term_node_tid_depth']['validate_options']['type'] = 'tids';
  $handler->display->display_options['arguments']['term_node_tid_depth']['validate']['fail'] = 'ignore';
  $handler->display->display_options['arguments']['term_node_tid_depth']['depth'] = '1';
  $handler->display->display_options['arguments']['term_node_tid_depth']['break_phrase'] = TRUE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_news' => 'uaqs_news',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Published status */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;

  /* Display: Teaser Block (3 items) */
  $handler = $view->new_display('block', 'Teaser Block (3 items)', 'three_col_news_block_3');
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '3';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'views_bootstrap_grid_plugin_style';
  $handler->display->display_options['style_options']['columns_horizontal'] = '-1';
  $handler->display->display_options['style_options']['columns_vertical'] = '4';
  $handler->display->display_options['style_options']['columns_xs'] = '12';
  $handler->display->display_options['style_options']['columns_sm'] = '6';
  $handler->display->display_options['style_options']['columns_md'] = '4';
  $handler->display->display_options['style_options']['columns_lg'] = '4';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Footer: Global: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<div class="item-list text-center"><ul class="pagination">
<li><a title="Read All Stories" href="./news-teasers">Read All News</a></li>
</ul></div>';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Event Photos */
  $handler->display->display_options['fields']['field_uaqs_photos']['id'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['table'] = 'field_data_field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['field'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_label_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photos']['element_wrapper_class'] = 'uaqs-news-photo';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photos']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_uaqs_photos']['settings'] = array(
    'image_style' => 'uaqs_spotlight',
    'image_link' => 'content',
  );
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_limit'] = '1';
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['separator'] = '';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_type'] = 'h3';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['element_wrapper_class'] = 'uaqs-news-title';
  /* Field: Content: Date of publication */
  $handler->display->display_options['fields']['field_uaqs_published']['id'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['field'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_published']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_published']['element_wrapper_class'] = 'uaqs-news-published';
  $handler->display->display_options['fields']['field_uaqs_published']['type'] = 'ap_date';
  $handler->display->display_options['fields']['field_uaqs_published']['settings'] = array(
    'format_type' => 'long',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
    'show_repeat_rule' => 'show',
  );
  /* Field: Field: Summary */
  $handler->display->display_options['fields']['field_uaqs_summary']['id'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['table'] = 'field_data_field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['field'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_summary']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_summary']['element_wrapper_class'] = 'uaqs-news-summary';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Content: Date of publication (field_uaqs_published) */
  $handler->display->display_options['sorts']['field_uaqs_published_value']['id'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['field'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_news' => 'uaqs_news',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Published status */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Promoted to front page status */
  $handler->display->display_options['filters']['promote']['id'] = 'promote';
  $handler->display->display_options['filters']['promote']['table'] = 'node';
  $handler->display->display_options['filters']['promote']['field'] = 'promote';
  $handler->display->display_options['filters']['promote']['value'] = '1';
  $handler->display->display_options['block_description'] = 'Three column news block';

  /* Display: Teaser Block (6 items) */
  $handler = $view->new_display('block', 'Teaser Block (6 items)', 'three_col_news_block');
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '6';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'views_bootstrap_grid_plugin_style';
  $handler->display->display_options['style_options']['columns_horizontal'] = '-1';
  $handler->display->display_options['style_options']['columns_vertical'] = '4';
  $handler->display->display_options['style_options']['columns_xs'] = '12';
  $handler->display->display_options['style_options']['columns_sm'] = '6';
  $handler->display->display_options['style_options']['columns_md'] = '4';
  $handler->display->display_options['style_options']['columns_lg'] = '4';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Footer: Global: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['content'] = '<div class="item-list text-center"><ul class="pagination">
<li><a title="Read All Stories" href="./news-teasers">Read All News</a></li>
</ul></div>';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Event Photos */
  $handler->display->display_options['fields']['field_uaqs_photos']['id'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['table'] = 'field_data_field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['field'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_label_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photos']['element_wrapper_class'] = 'uaqs-news-photo';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photos']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_uaqs_photos']['settings'] = array(
    'image_style' => 'uaqs_spotlight',
    'image_link' => 'content',
  );
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_limit'] = '1';
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['separator'] = '';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_type'] = 'h3';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['element_wrapper_class'] = 'uaqs-news-title';
  /* Field: Content: Date of publication */
  $handler->display->display_options['fields']['field_uaqs_published']['id'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['field'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_published']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_published']['element_wrapper_class'] = 'uaqs-news-published';
  $handler->display->display_options['fields']['field_uaqs_published']['type'] = 'ap_date';
  $handler->display->display_options['fields']['field_uaqs_published']['settings'] = array(
    'format_type' => 'long',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
    'show_repeat_rule' => 'show',
  );
  /* Field: Field: Summary */
  $handler->display->display_options['fields']['field_uaqs_summary']['id'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['table'] = 'field_data_field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['field'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_summary']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_summary']['element_wrapper_class'] = 'uaqs-news-summary';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Content: Date of publication (field_uaqs_published) */
  $handler->display->display_options['sorts']['field_uaqs_published_value']['id'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['field'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['order'] = 'DESC';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_news' => 'uaqs_news',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Published status */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Promoted to front page status */
  $handler->display->display_options['filters']['promote']['id'] = 'promote';
  $handler->display->display_options['filters']['promote']['table'] = 'node';
  $handler->display->display_options['filters']['promote']['field'] = 'promote';
  $handler->display->display_options['filters']['promote']['value'] = '1';
  $handler->display->display_options['block_description'] = 'Three column news block';

  /* Display: Sidebar promoted news block */
  $handler = $view->new_display('block', 'Sidebar promoted news block', 'sidebar_promoted_news');
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '3';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_sidebar_teaser_list';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Event Photos */
  $handler->display->display_options['fields']['field_uaqs_photos']['id'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['table'] = 'field_data_field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['field'] = 'field_uaqs_photos';
  $handler->display->display_options['fields']['field_uaqs_photos']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_label_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photos']['element_wrapper_class'] = 'uaqs-news-photo';
  $handler->display->display_options['fields']['field_uaqs_photos']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photos']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_uaqs_photos']['settings'] = array(
    'image_style' => 'uaqs_spotlight',
    'image_link' => 'content',
  );
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_limit'] = '1';
  $handler->display->display_options['fields']['field_uaqs_photos']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_photos']['separator'] = '';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_type'] = 'h3';
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['element_wrapper_class'] = 'uaqs-news-title';
  /* Field: Content: Date of publication */
  $handler->display->display_options['fields']['field_uaqs_published']['id'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['field'] = 'field_uaqs_published';
  $handler->display->display_options['fields']['field_uaqs_published']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_published']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_published']['element_wrapper_class'] = 'uaqs-news-published';
  $handler->display->display_options['fields']['field_uaqs_published']['type'] = 'ap_date';
  $handler->display->display_options['fields']['field_uaqs_published']['settings'] = array(
    'format_type' => 'long',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
    'show_repeat_rule' => 'show',
  );
  /* Field: Field: Summary */
  $handler->display->display_options['fields']['field_uaqs_summary']['id'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['table'] = 'field_data_field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['field'] = 'field_uaqs_summary';
  $handler->display->display_options['fields']['field_uaqs_summary']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_summary']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_summary']['element_wrapper_class'] = 'uaqs-news-summary';
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Content: Date of publication (field_uaqs_published) */
  $handler->display->display_options['sorts']['field_uaqs_published_value']['id'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['table'] = 'field_data_field_uaqs_published';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['field'] = 'field_uaqs_published_value';
  $handler->display->display_options['sorts']['field_uaqs_published_value']['order'] = 'DESC';
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  /* Contextual filter: Content: Nid */
  $handler->display->display_options['arguments']['nid']['id'] = 'nid';
  $handler->display->display_options['arguments']['nid']['table'] = 'node';
  $handler->display->display_options['arguments']['nid']['field'] = 'nid';
  $handler->display->display_options['arguments']['nid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['nid']['default_argument_type'] = 'node';
  $handler->display->display_options['arguments']['nid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['nid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['nid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['nid']['not'] = TRUE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_news' => 'uaqs_news',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Published status */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Promoted to front page status */
  $handler->display->display_options['filters']['promote']['id'] = 'promote';
  $handler->display->display_options['filters']['promote']['table'] = 'node';
  $handler->display->display_options['filters']['promote']['field'] = 'promote';
  $handler->display->display_options['filters']['promote']['value'] = '1';
  $handler->display->display_options['block_description'] = 'Sidebar Promoted News Block';

  /* Display: Teaser List Page */
  $handler = $view->new_display('page', 'Teaser List Page', 'uaqs_teaser_list_page');
  $handler->display->display_options['display_description'] = 'Page with teasers';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '12';
  $handler->display->display_options['pager']['options']['offset'] = '4';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'views_bootstrap_grid_plugin_style';
  $handler->display->display_options['style_options']['columns_horizontal'] = '-1';
  $handler->display->display_options['style_options']['columns_vertical'] = '4';
  $handler->display->display_options['style_options']['columns_xs'] = '12';
  $handler->display->display_options['style_options']['columns_sm'] = '4';
  $handler->display->display_options['style_options']['columns_md'] = '4';
  $handler->display->display_options['style_options']['columns_lg'] = '4';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['path'] = 'news-teasers';
  $handler->display->display_options['menu']['title'] = 'News';
  $handler->display->display_options['menu']['description'] = 'News & Updates';
  $handler->display->display_options['menu']['weight'] = '0';
  $handler->display->display_options['menu']['name'] = 'main-menu';
  $handler->display->display_options['menu']['context'] = 0;
  $handler->display->display_options['menu']['context_only_inline'] = 0;

  /* Display: Media List Page */
  $handler = $view->new_display('page', 'Media List Page', 'uaqs_media_list_page');
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['row_class'] = 'media-list-row';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_teaser_list';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['path'] = 'news';
  $handler->display->display_options['menu']['weight'] = '0';
  $handler->display->display_options['menu']['name'] = 'main-menu';
  $handler->display->display_options['menu']['context'] = 0;
  $handler->display->display_options['menu']['context_only_inline'] = 0;

  /* Display: Recent news marquee */
  $handler = $view->new_display('block', 'Recent news marquee', 'recent_news_marquee');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['css_class'] = 'row';
  $handler->display->display_options['display_description'] = 'Recent news';
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '1';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['row_class'] = 'col-md-7';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_marquee';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['footer'] = FALSE;
  $handler->display->display_options['defaults']['arguments'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_news' => 'uaqs_news',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Published status */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  $handler->display->display_options['block_description'] = 'Recent news marquee';

  /* Display: Recent news medium media list */
  $handler = $view->new_display('attachment', 'Recent news medium media list', 'recent_news_medium_media_list');
  $handler->display->display_options['defaults']['title'] = FALSE;
  $handler->display->display_options['title'] = 'Top stories';
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['css_class'] = 'col-md-5';
  $handler->display->display_options['display_description'] = 'This can be attached to the top news with marquee block.';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '3';
  $handler->display->display_options['pager']['options']['offset'] = '1';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_med_media_list';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['displays'] = array(
    'recent_news_marquee' => 'recent_news_marquee',
    'default' => 0,
    'sidebar_promoted_news_block' => 0,
    'three_col_news_block' => 0,
    'uaqs_teaser_list_page' => 0,
    'uaqs_media_list_page' => 0,
  );
  $handler->display->display_options['attachment_position'] = 'after';
  $export['uaqs_news'] = $view;

  return $export;
}
