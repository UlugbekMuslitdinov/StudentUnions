<?php

/**
 * @file
 * uaqs_person_view.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function uaqs_person_view_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'uaqs_person_directory';
  $view->description = 'Branded displays of the UAQS Person content type';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'UAQS Person Directory';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Directory';
  $handler->display->display_options['css_class'] = 'uaqs-person-list';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['row_class'] = 'uaqs-person-row';
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_card';
  $handler->display->display_options['row_options']['links'] = FALSE;
  /* Relationship: Content: Category (field_uaqs_person_category) */
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['id'] = 'field_uaqs_person_category_tid';
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['table'] = 'field_data_field_uaqs_person_category';
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['field'] = 'field_uaqs_person_category_tid';
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['label'] = 'Categories';
  /* Relationship: Taxonomy term: Parent term */
  $handler->display->display_options['relationships']['parent']['id'] = 'parent';
  $handler->display->display_options['relationships']['parent']['table'] = 'taxonomy_term_hierarchy';
  $handler->display->display_options['relationships']['parent']['field'] = 'parent';
  $handler->display->display_options['relationships']['parent']['relationship'] = 'field_uaqs_person_category_tid';
  /* Field: Field: Photo */
  $handler->display->display_options['fields']['field_uaqs_photo']['id'] = 'field_uaqs_photo';
  $handler->display->display_options['fields']['field_uaqs_photo']['table'] = 'field_data_field_uaqs_photo';
  $handler->display->display_options['fields']['field_uaqs_photo']['field'] = 'field_uaqs_photo';
  $handler->display->display_options['fields']['field_uaqs_photo']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_photo']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_photo']['element_wrapper_class'] = 'uaqs-person-photo';
  $handler->display->display_options['fields']['field_uaqs_photo']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_uaqs_photo']['settings'] = array(
    'image_style' => 'uaqs_medium_square',
    'image_link' => 'content',
  );
  /* Field: Content: Full Name (node title) */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['ui_name'] = 'Content: Full Name (node title)';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['title']['element_wrapper_type'] = 'h3';
  $handler->display->display_options['fields']['title']['element_wrapper_class'] = 'uaqs-person-name';
  /* Field: Content: Job Title(s) */
  $handler->display->display_options['fields']['field_uaqs_titles']['id'] = 'field_uaqs_titles';
  $handler->display->display_options['fields']['field_uaqs_titles']['table'] = 'field_data_field_uaqs_titles';
  $handler->display->display_options['fields']['field_uaqs_titles']['field'] = 'field_uaqs_titles';
  $handler->display->display_options['fields']['field_uaqs_titles']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_titles']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_titles']['element_wrapper_class'] = 'uaqs-person-job-titles';
  $handler->display->display_options['fields']['field_uaqs_titles']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_titles']['multi_type'] = 'ul';
  /* Field: Content: Phone Number(s) */
  $handler->display->display_options['fields']['field_uaqs_phones']['id'] = 'field_uaqs_phones';
  $handler->display->display_options['fields']['field_uaqs_phones']['table'] = 'field_data_field_uaqs_phones';
  $handler->display->display_options['fields']['field_uaqs_phones']['field'] = 'field_uaqs_phones';
  $handler->display->display_options['fields']['field_uaqs_phones']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_phones']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_phones']['element_wrapper_class'] = 'uaqs-person-phone';
  $handler->display->display_options['fields']['field_uaqs_phones']['delta_limit'] = '1';
  $handler->display->display_options['fields']['field_uaqs_phones']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_phones']['multi_type'] = 'ul';
  /* Field: Content: E-mail */
  $handler->display->display_options['fields']['field_uaqs_email']['id'] = 'field_uaqs_email';
  $handler->display->display_options['fields']['field_uaqs_email']['table'] = 'field_data_field_uaqs_email';
  $handler->display->display_options['fields']['field_uaqs_email']['field'] = 'field_uaqs_email';
  $handler->display->display_options['fields']['field_uaqs_email']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_email']['element_label_colon'] = FALSE;
  /* Field: Content: Link to edit content */
  $handler->display->display_options['fields']['edit_node']['id'] = 'edit_node';
  $handler->display->display_options['fields']['edit_node']['table'] = 'views_entity_node';
  $handler->display->display_options['fields']['edit_node']['field'] = 'edit_node';
  $handler->display->display_options['fields']['edit_node']['label'] = '';
  $handler->display->display_options['fields']['edit_node']['exclude'] = TRUE;
  $handler->display->display_options['fields']['edit_node']['element_label_colon'] = FALSE;
  /* Field: Global: Contextual Links */
  $handler->display->display_options['fields']['contextual_links']['id'] = 'contextual_links';
  $handler->display->display_options['fields']['contextual_links']['table'] = 'views';
  $handler->display->display_options['fields']['contextual_links']['field'] = 'contextual_links';
  $handler->display->display_options['fields']['contextual_links']['label'] = '';
  $handler->display->display_options['fields']['contextual_links']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['contextual_links']['fields'] = array(
    'edit_node' => 'edit_node',
    'field_uaqs_photo' => 0,
    'title' => 0,
    'field_uaqs_titles' => 0,
    'field_uaqs_phones' => 0,
  );
  /* Sort criterion: Taxonomy term: Weight */
  $handler->display->display_options['sorts']['weight']['id'] = 'weight';
  $handler->display->display_options['sorts']['weight']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['sorts']['weight']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight']['relationship'] = 'parent';
  /* Sort criterion: Taxonomy term: Weight */
  $handler->display->display_options['sorts']['weight_1']['id'] = 'weight_1';
  $handler->display->display_options['sorts']['weight_1']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['sorts']['weight_1']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight_1']['relationship'] = 'field_uaqs_person_category_tid';
  /* Sort criterion: Draggableviews: Weight */
  $handler->display->display_options['sorts']['weight_2']['id'] = 'weight_2';
  $handler->display->display_options['sorts']['weight_2']['table'] = 'draggableviews_structure';
  $handler->display->display_options['sorts']['weight_2']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight_2']['draggableviews_setting_view'] = 'uaqs_reorder_people:page';
  $handler->display->display_options['sorts']['weight_2']['draggableviews_setting_arguments'] = 'none';
  $handler->display->display_options['sorts']['weight_2']['draggableviews_setting_new_items_bottom_list'] = 1;
  /* Sort criterion: Content: Last Name (field_uaqs_lname) */
  $handler->display->display_options['sorts']['field_uaqs_lname_value']['id'] = 'field_uaqs_lname_value';
  $handler->display->display_options['sorts']['field_uaqs_lname_value']['table'] = 'field_data_field_uaqs_lname';
  $handler->display->display_options['sorts']['field_uaqs_lname_value']['field'] = 'field_uaqs_lname_value';
  /* Sort criterion: Content: First Name (field_uaqs_fname) */
  $handler->display->display_options['sorts']['field_uaqs_fname_value']['id'] = 'field_uaqs_fname_value';
  $handler->display->display_options['sorts']['field_uaqs_fname_value']['table'] = 'field_data_field_uaqs_fname';
  $handler->display->display_options['sorts']['field_uaqs_fname_value']['field'] = 'field_uaqs_fname_value';
  /* Contextual filter: Content: Has taxonomy term ID (with depth) */
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['id'] = 'term_node_tid_depth_1';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['table'] = 'node';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['field'] = 'term_node_tid_depth';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['validate_options']['vocabularies'] = array(
    'uaqs_person_category' => 'uaqs_person_category',
    'uaqs_person_category_secondary' => 'uaqs_person_category_secondary',
  );
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['validate_options']['type'] = 'tids';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['validate']['fail'] = 'ignore';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['depth'] = '1';
  $handler->display->display_options['arguments']['term_node_tid_depth_1']['break_phrase'] = TRUE;
  /* Contextual filter: Taxonomy term: Term ID */
  $handler->display->display_options['arguments']['tid']['id'] = 'tid';
  $handler->display->display_options['arguments']['tid']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['arguments']['tid']['field'] = 'tid';
  $handler->display->display_options['arguments']['tid']['relationship'] = 'field_uaqs_person_category_tid';
  $handler->display->display_options['arguments']['tid']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['tid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['tid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['tid']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['tid']['specify_validation'] = TRUE;
  $handler->display->display_options['arguments']['tid']['validate']['type'] = 'taxonomy_term';
  $handler->display->display_options['arguments']['tid']['validate_options']['vocabularies'] = array(
    'uaqs_person_category' => 'uaqs_person_category',
    'uaqs_person_category_secondary' => 'uaqs_person_category_secondary',
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
    'uaqs_person' => 'uaqs_person',
  );

  /* Display: Grid Page */
  $handler = $view->new_display('page', 'Grid Page', 'page');
  $handler->display->display_options['defaults']['css_class'] = FALSE;
  $handler->display->display_options['css_class'] = 'uaqs-person-grid';
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'views_bootstrap_grid_plugin_style';
  $handler->display->display_options['style_options']['grouping'] = array(
    0 => array(
      'field' => 'field_uaqs_person_category',
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
  $handler->display->display_options['style_options']['columns_lg'] = '3';
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_card';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Category */
  $handler->display->display_options['fields']['field_uaqs_person_category']['id'] = 'field_uaqs_person_category';
  $handler->display->display_options['fields']['field_uaqs_person_category']['table'] = 'field_data_field_uaqs_person_category';
  $handler->display->display_options['fields']['field_uaqs_person_category']['field'] = 'field_uaqs_person_category';
  $handler->display->display_options['fields']['field_uaqs_person_category']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_label_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_person_category']['type'] = 'taxonomy_term_reference_plain';
  $handler->display->display_options['fields']['field_uaqs_person_category']['settings'] = array(
    'field_multiple_limit' => '-1',
    'field_multiple_limit_offset' => '0',
    'field_multiple_limit_order' => '0',
  );
  $handler->display->display_options['fields']['field_uaqs_person_category']['group_rows'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_person_category']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_person_category']['field_api_classes'] = TRUE;
  $handler->display->display_options['path'] = 'people';

  /* Display: Row Page */
  $handler = $view->new_display('page', 'Row Page', 'page_1');
  $handler->display->display_options['defaults']['style_plugin'] = FALSE;
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['grouping'] = array(
    0 => array(
      'field' => 'field_uaqs_person_category',
      'rendered' => 1,
      'rendered_strip' => 0,
    ),
  );
  $handler->display->display_options['style_options']['row_class'] = 'uaqs-person-row';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['defaults']['style_options'] = FALSE;
  $handler->display->display_options['defaults']['row_plugin'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['links'] = FALSE;
  $handler->display->display_options['defaults']['row_options'] = FALSE;
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Category */
  $handler->display->display_options['fields']['field_uaqs_person_category']['id'] = 'field_uaqs_person_category';
  $handler->display->display_options['fields']['field_uaqs_person_category']['table'] = 'field_data_field_uaqs_person_category';
  $handler->display->display_options['fields']['field_uaqs_person_category']['field'] = 'field_uaqs_person_category';
  $handler->display->display_options['fields']['field_uaqs_person_category']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_label_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_person_category']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_person_category']['type'] = 'taxonomy_term_reference_plain';
  $handler->display->display_options['fields']['field_uaqs_person_category']['settings'] = array(
    'field_multiple_limit' => '-1',
    'field_multiple_limit_offset' => '0',
    'field_multiple_limit_order' => '0',
  );
  $handler->display->display_options['fields']['field_uaqs_person_category']['group_rows'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_person_category']['delta_offset'] = '0';
  $handler->display->display_options['path'] = 'people-list';
  $export['uaqs_person_directory'] = $view;

  $view = new view();
  $view->name = 'uaqs_reorder_people';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'UAQS Reorder People';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'UAQS Reorder People';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['access']['perm'] = 'edit any uaqs_person content';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['grouping'] = array(
    0 => array(
      'field' => 'name',
      'rendered' => 1,
      'rendered_strip' => 1,
    ),
  );
  $handler->display->display_options['style_options']['columns'] = array(
    'nid' => 'nid',
    'draggableviews' => 'draggableviews',
    'field_uaqs_photo' => 'field_uaqs_photo',
    'title' => 'title',
    'status' => 'status',
    'edit_node' => 'title',
    'weight' => 'weight',
    'name' => 'name',
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'nid' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'draggableviews' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_uaqs_photo' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'title' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '<br />',
      'empty_column' => 0,
    ),
    'status' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '<br />',
      'empty_column' => 0,
    ),
    'edit_node' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'weight' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'name' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* Header: Global: Text area */
  $handler->display->display_options['header']['area']['id'] = 'area';
  $handler->display->display_options['header']['area']['table'] = 'views';
  $handler->display->display_options['header']['area']['field'] = 'area';
  $handler->display->display_options['header']['area']['content'] = 'The order on this page is effected by term weight <a href="/admin/structure/taxonomy/uaqs_person_category">here</a>';
  $handler->display->display_options['header']['area']['format'] = 'full_html';
  /* Relationship: Category */
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['id'] = 'field_uaqs_person_category_tid';
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['table'] = 'field_data_field_uaqs_person_category';
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['field'] = 'field_uaqs_person_category_tid';
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['ui_name'] = 'Category';
  $handler->display->display_options['relationships']['field_uaqs_person_category_tid']['label'] = 'Category';
  /* Relationship: Taxonomy term: Parent term */
  $handler->display->display_options['relationships']['parent']['id'] = 'parent';
  $handler->display->display_options['relationships']['parent']['table'] = 'taxonomy_term_hierarchy';
  $handler->display->display_options['relationships']['parent']['field'] = 'parent';
  $handler->display->display_options['relationships']['parent']['relationship'] = 'field_uaqs_person_category_tid';
  /* Field: Content: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['exclude'] = TRUE;
  /* Field: Draggableviews: Content */
  $handler->display->display_options['fields']['draggableviews']['id'] = 'draggableviews';
  $handler->display->display_options['fields']['draggableviews']['table'] = 'node';
  $handler->display->display_options['fields']['draggableviews']['field'] = 'draggableviews';
  $handler->display->display_options['fields']['draggableviews']['label'] = 'Order';
  $handler->display->display_options['fields']['draggableviews']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['draggableviews']['hide_alter_empty'] = FALSE;
  $handler->display->display_options['fields']['draggableviews']['draggableviews']['ajax'] = 0;
  /* Field: Field: Photo */
  $handler->display->display_options['fields']['field_uaqs_photo']['id'] = 'field_uaqs_photo';
  $handler->display->display_options['fields']['field_uaqs_photo']['table'] = 'field_data_field_uaqs_photo';
  $handler->display->display_options['fields']['field_uaqs_photo']['field'] = 'field_uaqs_photo';
  $handler->display->display_options['fields']['field_uaqs_photo']['click_sort_column'] = 'fid';
  $handler->display->display_options['fields']['field_uaqs_photo']['settings'] = array(
    'image_style' => 'thumbnail',
    'image_link' => 'content',
    'class' => '',
  );
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'Details';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Published status */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'node';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  $handler->display->display_options['fields']['status']['label'] = 'Operations';
  $handler->display->display_options['fields']['status']['type'] = 'published-notpublished';
  $handler->display->display_options['fields']['status']['not'] = 0;
  /* Field: Content: Link to edit content */
  $handler->display->display_options['fields']['edit_node']['id'] = 'edit_node';
  $handler->display->display_options['fields']['edit_node']['table'] = 'views_entity_node';
  $handler->display->display_options['fields']['edit_node']['field'] = 'edit_node';
  /* Field: Taxonomy term: Name */
  $handler->display->display_options['fields']['name']['id'] = 'name';
  $handler->display->display_options['fields']['name']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['fields']['name']['field'] = 'name';
  $handler->display->display_options['fields']['name']['relationship'] = 'field_uaqs_person_category_tid';
  $handler->display->display_options['fields']['name']['label'] = '';
  $handler->display->display_options['fields']['name']['exclude'] = TRUE;
  $handler->display->display_options['fields']['name']['element_label_colon'] = FALSE;
  /* Sort criterion: Taxonomy term: Weight */
  $handler->display->display_options['sorts']['weight_2']['id'] = 'weight_2';
  $handler->display->display_options['sorts']['weight_2']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['sorts']['weight_2']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight_2']['relationship'] = 'parent';
  /* Sort criterion: Taxonomy term: Weight */
  $handler->display->display_options['sorts']['weight_1']['id'] = 'weight_1';
  $handler->display->display_options['sorts']['weight_1']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['sorts']['weight_1']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight_1']['relationship'] = 'field_uaqs_person_category_tid';
  /* Sort criterion: Draggableviews: Weight */
  $handler->display->display_options['sorts']['weight']['id'] = 'weight';
  $handler->display->display_options['sorts']['weight']['table'] = 'draggableviews_structure';
  $handler->display->display_options['sorts']['weight']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight']['draggableviews_setting_view'] = 'uaqs_reorder_carousel:page';
  $handler->display->display_options['sorts']['weight']['draggableviews_setting_new_items_bottom_list'] = 1;
  /* Sort criterion: Content: Last Name (field_uaqs_lname) */
  $handler->display->display_options['sorts']['field_uaqs_lname_value']['id'] = 'field_uaqs_lname_value';
  $handler->display->display_options['sorts']['field_uaqs_lname_value']['table'] = 'field_data_field_uaqs_lname';
  $handler->display->display_options['sorts']['field_uaqs_lname_value']['field'] = 'field_uaqs_lname_value';
  /* Filter criterion: Content: Published status or admin user */
  $handler->display->display_options['filters']['status_extra']['id'] = 'status_extra';
  $handler->display->display_options['filters']['status_extra']['table'] = 'node';
  $handler->display->display_options['filters']['status_extra']['field'] = 'status_extra';
  $handler->display->display_options['filters']['status_extra']['group'] = 1;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'uaqs_person' => 'uaqs_person',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;

  /* Display: Drag to reorder people */
  $handler = $view->new_display('page', 'Drag to reorder people', 'page');
  $handler->display->display_options['path'] = 'admin/uaqs-person/reorder-people';
  $export['uaqs_reorder_people'] = $view;

  return $export;
}
