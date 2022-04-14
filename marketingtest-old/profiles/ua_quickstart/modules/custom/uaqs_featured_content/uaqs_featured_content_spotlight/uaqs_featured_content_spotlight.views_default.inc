<?php
/**
 * @file
 * uaqs_featured_content_spotlight.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function uaqs_featured_content_spotlight_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'uaqs_reorder_spotlight';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Reorder Spotlight';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Reorder Spotlight Content';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['access']['perm'] = 'edit any uaqs_carousel_item content';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'title' => 'title',
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'title' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* Relationship: Flags: uaqs_spotlight */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'node';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['label'] = 'UAQS Spotlight Flag';
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'uaqs_spotlight';
  $handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
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
    'image_style' => 'medium',
    'image_link' => '',
    'class' => '',
  );
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'Headline';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Type */
  $handler->display->display_options['fields']['type']['id'] = 'type';
  $handler->display->display_options['fields']['type']['table'] = 'node';
  $handler->display->display_options['fields']['type']['field'] = 'type';
  $handler->display->display_options['fields']['type']['label'] = 'Content type';
  /* Sort criterion: Draggableviews: Weight */
  $handler->display->display_options['sorts']['weight']['id'] = 'weight';
  $handler->display->display_options['sorts']['weight']['table'] = 'draggableviews_structure';
  $handler->display->display_options['sorts']['weight']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight']['draggableviews_setting_view'] = 'uaqs_reorder_carousel:page';
  $handler->display->display_options['sorts']['weight']['draggableviews_setting_new_items_bottom_list'] = 1;
  /* Filter criterion: Content: Published or admin */
  $handler->display->display_options['filters']['status_extra']['id'] = 'status_extra';
  $handler->display->display_options['filters']['status_extra']['table'] = 'node';
  $handler->display->display_options['filters']['status_extra']['field'] = 'status_extra';

  /* Display: Reorder spotlight */
  $handler = $view->new_display('page', 'Reorder spotlight', 'uaqs_reorder_spotlight_admin');
  $handler->display->display_options['path'] = 'admin/uaqs-featured-content/reorder-spotlight';
  $export['uaqs_reorder_spotlight'] = $view;

  $view = new view();
  $view->name = 'uaqs_spotlight';
  $view->description = 'Flag content types that have a card view mode to appear in this block.';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Spotlight';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Spotlight';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '0';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['style_plugin'] = 'views_bootstrap_grid_plugin_style';
  $handler->display->display_options['style_options']['uses_fields'] = TRUE;
  $handler->display->display_options['style_options']['columns_horizontal'] = '-1';
  $handler->display->display_options['style_options']['columns_vertical'] = '4';
  $handler->display->display_options['style_options']['columns_xs'] = '12';
  $handler->display->display_options['style_options']['columns_sm'] = '6';
  $handler->display->display_options['style_options']['columns_md'] = '4';
  $handler->display->display_options['style_options']['columns_lg'] = '3';
  $handler->display->display_options['row_plugin'] = 'node';
  $handler->display->display_options['row_options']['view_mode'] = 'uaqs_card';
  $handler->display->display_options['row_options']['links'] = FALSE;
  /* Relationship: Flags: uaqs_spotlight */
  $handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['table'] = 'node';
  $handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
  $handler->display->display_options['relationships']['flag_content_rel']['label'] = 'UAQS Spotlight Flag';
  $handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'uaqs_spotlight';
  $handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
  /* Field: Content: When */
  $handler->display->display_options['fields']['field_uaqs_date']['id'] = 'field_uaqs_date';
  $handler->display->display_options['fields']['field_uaqs_date']['table'] = 'field_data_field_uaqs_date';
  $handler->display->display_options['fields']['field_uaqs_date']['field'] = 'field_uaqs_date';
  $handler->display->display_options['fields']['field_uaqs_date']['label'] = '';
  $handler->display->display_options['fields']['field_uaqs_date']['element_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_date']['element_label_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_date']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_date']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_uaqs_date']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_date']['settings'] = array(
    'format_type' => 'long',
    'custom_date_format' => '',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
    'show_remaining_days' => 0,
    'show_repeat_rule' => 'show',
    'field_multiple_limit' => '-1',
    'field_multiple_limit_offset' => '0',
    'field_multiple_limit_order' => '0',
  );
  $handler->display->display_options['fields']['field_uaqs_date']['group_rows'] = FALSE;
  $handler->display->display_options['fields']['field_uaqs_date']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_uaqs_date']['field_api_classes'] = TRUE;
  /* Sort criterion: Draggableviews: Weight */
  $handler->display->display_options['sorts']['weight']['id'] = 'weight';
  $handler->display->display_options['sorts']['weight']['table'] = 'draggableviews_structure';
  $handler->display->display_options['sorts']['weight']['field'] = 'weight';
  $handler->display->display_options['sorts']['weight']['draggableviews_setting_view'] = 'uaqs_reorder_spotlight:uaqs_reorder_spotlight_admin';
  $handler->display->display_options['sorts']['weight']['draggableviews_setting_new_items_bottom_list'] = 1;
  /* Filter criterion: Content: Published or admin */
  $handler->display->display_options['filters']['status_extra']['id'] = 'status_extra';
  $handler->display->display_options['filters']['status_extra']['table'] = 'node';
  $handler->display->display_options['filters']['status_extra']['field'] = 'status_extra';

  /* Display: Spotlight grid */
  $handler = $view->new_display('block', 'Spotlight grid', 'uaqs_card_grid');
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '4';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['block_description'] = 'Spotlight grid';

  /* Display: Spotlight columns */
  $handler = $view->new_display('block', 'Spotlight columns', 'uaqs_card_columns');
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
  $handler->display->display_options['block_description'] = 'Spotlight columns';

  /* Display: Spotlight deck */
  $handler = $view->new_display('block', 'Spotlight deck', 'uaqs_card_deck');
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
  $handler->display->display_options['block_description'] = 'Spotlight deck';
  $export['uaqs_spotlight'] = $view;

  return $export;
}
