<?php

/**
 * @file
 * uaqs_news_feeds.feeds_tamper_default.inc
 */

/**
 * Implements hook_feeds_tamper_default().
 */
function uaqs_news_feeds_feeds_tamper_default() {
  $export = array();

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_external_tag-blank_source_1-default_value';
  $feeds_tamper->importer = 'uaqs_news_external_tag';
  $feeds_tamper->source = 'Blank source 1';
  $feeds_tamper->plugin_id = 'default_value';
  $feeds_tamper->settings = array(
    'default_value' => 'uaqs_feeds',
    'only_if_empty' => 1,
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Set author as uaqs_feeds';
  $export['uaqs_news_external_tag-blank_source_1-default_value'] = $feeds_tamper;

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_external_tag-blank_source_3-default_value';
  $feeds_tamper->importer = 'uaqs_news_external_tag';
  $feeds_tamper->source = 'Blank source 3';
  $feeds_tamper->plugin_id = 'default_value';
  $feeds_tamper->settings = array(
    'default_value' => '1',
    'only_if_empty' => 0,
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Set value or default value';
  $export['uaqs_news_external_tag-blank_source_3-default_value'] = $feeds_tamper;

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_external_tag-jsonpath_parser_1-rewrite';
  $feeds_tamper->importer = 'uaqs_news_external_tag';
  $feeds_tamper->source = 'jsonpath_parser:1';
  $feeds_tamper->plugin_id = 'rewrite';
  $feeds_tamper->settings = array(
    'text' => 'Read more at [jsonpath_parser:1]',
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Rewrite';
  $export['uaqs_news_external_tag-jsonpath_parser_1-rewrite'] = $feeds_tamper;

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_external_tag-jsonpath_parser_11-explode';
  $feeds_tamper->importer = 'uaqs_news_external_tag';
  $feeds_tamper->source = 'jsonpath_parser:11';
  $feeds_tamper->plugin_id = 'explode';
  $feeds_tamper->settings = array(
    'separator' => ',',
    'limit' => '',
    'real_separator' => ',',
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Explode';
  $export['uaqs_news_external_tag-jsonpath_parser_11-explode'] = $feeds_tamper;

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_tag-blank_source_1-default_value';
  $feeds_tamper->importer = 'uaqs_news_tag';
  $feeds_tamper->source = 'Blank source 1';
  $feeds_tamper->plugin_id = 'default_value';
  $feeds_tamper->settings = array(
    'default_value' => 'uaqs_feeds',
    'only_if_empty' => 1,
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Set value or default value';
  $export['uaqs_news_tag-blank_source_1-default_value'] = $feeds_tamper;

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_tag-blank_source_3-default_value';
  $feeds_tamper->importer = 'uaqs_news_tag';
  $feeds_tamper->source = 'Blank source 3';
  $feeds_tamper->plugin_id = 'default_value';
  $feeds_tamper->settings = array(
    'default_value' => '1',
    'only_if_empty' => 0,
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Set value or default value';
  $export['uaqs_news_tag-blank_source_3-default_value'] = $feeds_tamper;

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_tag-jsonpath_parser_1-default_value';
  $feeds_tamper->importer = 'uaqs_news_tag';
  $feeds_tamper->source = 'jsonpath_parser:1';
  $feeds_tamper->plugin_id = 'default_value';
  $feeds_tamper->settings = array(
    'default_value' => 'Read more at UArizona News',
    'only_if_empty' => 1,
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Make the link text more descriptive';
  $export['uaqs_news_tag-jsonpath_parser_1-default_value'] = $feeds_tamper;

  $feeds_tamper = new stdClass();
  $feeds_tamper->disabled = FALSE; /* Edit this to true to make a default feeds_tamper disabled initially */
  $feeds_tamper->api_version = 2;
  $feeds_tamper->id = 'uaqs_news_tag-jsonpath_parser_11-explode';
  $feeds_tamper->importer = 'uaqs_news_tag';
  $feeds_tamper->source = 'jsonpath_parser:11';
  $feeds_tamper->plugin_id = 'explode';
  $feeds_tamper->settings = array(
    'separator' => ',',
    'limit' => '',
    'real_separator' => ',',
  );
  $feeds_tamper->weight = 0;
  $feeds_tamper->description = 'Explode';
  $export['uaqs_news_tag-jsonpath_parser_11-explode'] = $feeds_tamper;

  return $export;
}
