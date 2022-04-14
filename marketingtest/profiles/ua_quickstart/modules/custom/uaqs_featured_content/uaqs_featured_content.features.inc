<?php

/**
 * @file
 * uaqs_featured_content.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_featured_content_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "flexslider" && $api == "flexslider_default_preset") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function uaqs_featured_content_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function uaqs_featured_content_node_info() {
  $items = array(
    'uaqs_carousel_item' => array(
      'name' => t('Carousel Item'),
      'base' => 'node_content',
      'description' => t('The UA QuickStart component for a prominent (hero) display of rotating content items.'),
      'has_title' => '1',
      'title_label' => t('Headline'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
