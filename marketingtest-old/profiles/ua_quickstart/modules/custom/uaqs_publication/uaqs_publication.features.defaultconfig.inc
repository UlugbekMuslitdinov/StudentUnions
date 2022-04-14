<?php

/**
 * @file
 * uaqs_publication.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_publication_defaultconfig_features() {
  return array(
    'uaqs_publication' => array(
      'strongarm' => 'strongarm',
    ),
  );
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_publication_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'menu_options_uaqs_pub';
  $strongarm->value = array(
    0 => 'main-menu',
  );
  $export['menu_options_uaqs_pub'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'menu_parent_uaqs_pub';
  $strongarm->value = 'main-menu:0';
  $export['menu_parent_uaqs_pub'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_options_uaqs_pub';
  $strongarm->value = array(
    0 => 'status',
    1 => 'revision',
  );
  $export['node_options_uaqs_pub'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_preview_uaqs_pub';
  $strongarm->value = '1';
  $export['node_preview_uaqs_pub'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_submitted_uaqs_pub';
  $strongarm->value = 0;
  $export['node_submitted_uaqs_pub'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'pathauto_node_uaqs_pub_pattern';
  $strongarm->value = 'publication/[node:title]';
  $export['pathauto_node_uaqs_pub_pattern'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'pathauto_taxonomy_term_uaqs_research_areas_pattern';
  $strongarm->value = '[term:vocabulary]/[term:name]';
  $export['pathauto_taxonomy_term_uaqs_research_areas_pattern'] = $strongarm;

  return $export;
}
