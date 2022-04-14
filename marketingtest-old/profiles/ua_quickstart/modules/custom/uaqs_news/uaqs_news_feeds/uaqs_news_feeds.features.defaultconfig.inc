<?php

/**
 * @file
 * uaqs_news_feeds.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_news_feeds_defaultconfig_features() {
  return array(
    'uaqs_news_feeds' => array(
      'feeds_importer_default' => 'feeds_importer_default',
      'feeds_tamper_default' => 'feeds_tamper_default',
    ),
  );
}

/**
 * Implements hook_defaultconfig_feeds_importer_default().
 */
function uaqs_news_feeds_defaultconfig_feeds_importer_default() {
  $export = array();

  $feeds_importer = new stdClass();
  $feeds_importer->disabled = FALSE; /* Edit this to true to make a default feeds_importer disabled initially */
  $feeds_importer->api_version = 1;
  $feeds_importer->id = 'uaqs_news_external_tag';
  $feeds_importer->config = array(
    'name' => 'UArizona News External Tag',
    'description' => 'Import external news content from UArizona News with https://news.arizona.edu/feed/json/stories-external/id/[tag id]+[tag id]',
    'fetcher' => array(
      'plugin_key' => 'FeedsHTTPFetcher',
      'config' => array(
        'auto_detect_feeds' => FALSE,
        'use_pubsubhubbub' => FALSE,
        'designated_hub' => '',
        'request_timeout' => NULL,
        'auto_scheme' => 'http',
        'accept_invalid_cert' => FALSE,
        'cache_http_result' => TRUE,
      ),
    ),
    'parser' => array(
      'plugin_key' => 'FeedsJSONPathParser',
      'config' => array(
        'context' => '$..story',
        'sources' => array(
          'jsonpath_parser:0' => 'title',
          'jsonpath_parser:1' => 'source-canonical',
          'jsonpath_parser:2' => 'url-canonical',
          'jsonpath_parser:3' => '',
          'jsonpath_parser:4' => '',
          'jsonpath_parser:5' => '',
          'jsonpath_parser:6' => 'summary-med',
          'jsonpath_parser:7' => 'date-of-publication',
          'jsonpath_parser:8' => 'uuid',
          'jsonpath_parser:9' => 'date-of-publication',
          'jsonpath_parser:10' => 'title',
          'jsonpath_parser:11' => 'terms',
        ),
        'debug' => array(
          'options' => array(
            'context' => 0,
            'jsonpath_parser:0' => 0,
            'jsonpath_parser:1' => 0,
            'jsonpath_parser:2' => 0,
            'jsonpath_parser:3' => 0,
            'jsonpath_parser:4' => 0,
            'jsonpath_parser:5' => 0,
            'jsonpath_parser:6' => 0,
            'jsonpath_parser:7' => 0,
            'jsonpath_parser:8' => 0,
            'jsonpath_parser:9' => 0,
            'jsonpath_parser:10' => 0,
            'jsonpath_parser:11' => 0,
          ),
        ),
        'allow_override' => 0,
        'convert_four_byte' => 0,
      ),
    ),
    'processor' => array(
      'plugin_key' => 'FeedsNodeProcessor',
      'config' => array(
        'expire' => '-1',
        'author' => '0',
        'authorize' => 0,
        'mappings' => array(
          0 => array(
            'source' => 'jsonpath_parser:0',
            'target' => 'title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          1 => array(
            'source' => 'jsonpath_parser:1',
            'target' => 'field_uaqs_link:title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          2 => array(
            'source' => 'jsonpath_parser:2',
            'target' => 'field_uaqs_link:url',
            'unique' => FALSE,
            'language' => 'und',
          ),
          3 => array(
            'source' => 'jsonpath_parser:3',
            'target' => 'field_uaqs_photo:alt',
            'unique' => FALSE,
            'language' => 'und',
          ),
          4 => array(
            'source' => 'jsonpath_parser:4',
            'target' => 'field_uaqs_photo:title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          5 => array(
            'source' => 'jsonpath_parser:5',
            'target' => 'field_uaqs_photo:uri',
            'unique' => FALSE,
            'language' => 'und',
          ),
          6 => array(
            'source' => 'jsonpath_parser:6',
            'target' => 'field_uaqs_summary',
            'unique' => FALSE,
            'language' => 'und',
          ),
          7 => array(
            'source' => 'jsonpath_parser:7',
            'target' => 'created',
            'unique' => FALSE,
            'language' => 'und',
          ),
          8 => array(
            'source' => 'jsonpath_parser:8',
            'target' => 'guid',
            'unique' => 1,
            'language' => 'und',
          ),
          9 => array(
            'source' => 'jsonpath_parser:9',
            'target' => 'field_uaqs_published:start',
            'unique' => FALSE,
            'language' => 'und',
          ),
          10 => array(
            'source' => 'jsonpath_parser:10',
            'target' => 'field_uaqs_short_title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          11 => array(
            'source' => 'jsonpath_parser:11',
            'target' => 'field_uaqs_news_tags',
            'unique' => FALSE,
            'language' => 'und',
          ),
          12 => array(
            'source' => 'Blank source 1',
            'target' => 'user_name',
            'unique' => FALSE,
            'language' => 'und',
          ),
          13 => array(
            'source' => 'Blank source 3',
            'target' => 'promote',
            'unique' => FALSE,
            'language' => 'und',
          ),
        ),
        'insert_new' => '1',
        'update_existing' => '2',
        'update_non_existent' => 'delete',
        'input_format' => 'uaqs_standard',
        'skip_hash_check' => 0,
        'bundle' => 'uaqs_news',
        'language' => 'und',
      ),
    ),
    'content_type' => '',
    'update' => 0,
    'import_period' => '1800',
    'expire_period' => 3600,
    'import_on_create' => 1,
    'process_in_background' => 0,
  );
  $export['uaqs_news_external_tag'] = $feeds_importer;

  $feeds_importer = new stdClass();
  $feeds_importer->disabled = FALSE; /* Edit this to true to make a default feeds_importer disabled initially */
  $feeds_importer->api_version = 1;
  $feeds_importer->id = 'uaqs_news_tag';
  $feeds_importer->config = array(
    'name' => 'UAQS News Feed',
    'description' => 'Import news content from UArizona News with https://news.arizona.edu/feed/json/stories/id/[tag id]+[tag id]',
    'fetcher' => array(
      'plugin_key' => 'FeedsHTTPFetcher',
      'config' => array(
        'auto_detect_feeds' => FALSE,
        'use_pubsubhubbub' => FALSE,
        'designated_hub' => '',
        'request_timeout' => NULL,
        'auto_scheme' => 'http',
        'accept_invalid_cert' => FALSE,
        'cache_http_result' => TRUE,
      ),
    ),
    'parser' => array(
      'plugin_key' => 'FeedsJSONPathParser',
      'config' => array(
        'context' => '$..story',
        'sources' => array(
          'jsonpath_parser:0' => 'title',
          'jsonpath_parser:1' => 'source-canonical',
          'jsonpath_parser:2' => 'url-canonical',
          'jsonpath_parser:3' => 'img-large.alt',
          'jsonpath_parser:4' => 'img-large.alt',
          'jsonpath_parser:5' => 'img-large.src',
          'jsonpath_parser:6' => 'summary-med',
          'jsonpath_parser:7' => 'date-of-publication',
          'jsonpath_parser:8' => 'uuid',
          'jsonpath_parser:9' => 'date-of-publication',
          'jsonpath_parser:10' => 'title',
          'jsonpath_parser:11' => 'terms',
        ),
        'debug' => array(
          'options' => array(
            'context' => 0,
            'jsonpath_parser:0' => 0,
            'jsonpath_parser:1' => 0,
            'jsonpath_parser:2' => 0,
            'jsonpath_parser:3' => 0,
            'jsonpath_parser:4' => 0,
            'jsonpath_parser:5' => 0,
            'jsonpath_parser:6' => 0,
            'jsonpath_parser:7' => 0,
            'jsonpath_parser:8' => 0,
            'jsonpath_parser:9' => 0,
            'jsonpath_parser:10' => 0,
            'jsonpath_parser:11' => 0,
          ),
        ),
        'allow_override' => 0,
        'convert_four_byte' => 0,
      ),
    ),
    'processor' => array(
      'plugin_key' => 'FeedsNodeProcessor',
      'config' => array(
        'expire' => '-1',
        'author' => '0',
        'authorize' => 0,
        'mappings' => array(
          0 => array(
            'source' => 'jsonpath_parser:0',
            'target' => 'title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          1 => array(
            'source' => 'jsonpath_parser:1',
            'target' => 'field_uaqs_link:title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          2 => array(
            'source' => 'jsonpath_parser:2',
            'target' => 'field_uaqs_link:url',
            'unique' => FALSE,
            'language' => 'und',
          ),
          3 => array(
            'source' => 'jsonpath_parser:3',
            'target' => 'field_uaqs_photo:alt',
            'unique' => FALSE,
            'language' => 'und',
          ),
          4 => array(
            'source' => 'jsonpath_parser:4',
            'target' => 'field_uaqs_photo:title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          5 => array(
            'source' => 'jsonpath_parser:5',
            'target' => 'field_uaqs_photo:uri',
            'unique' => FALSE,
            'language' => 'und',
          ),
          6 => array(
            'source' => 'jsonpath_parser:6',
            'target' => 'field_uaqs_summary',
            'unique' => FALSE,
            'language' => 'und',
          ),
          7 => array(
            'source' => 'jsonpath_parser:7',
            'target' => 'created',
            'unique' => FALSE,
            'language' => 'und',
          ),
          8 => array(
            'source' => 'jsonpath_parser:8',
            'target' => 'guid',
            'unique' => 1,
            'language' => 'und',
          ),
          9 => array(
            'source' => 'jsonpath_parser:9',
            'target' => 'field_uaqs_published:start',
            'unique' => FALSE,
            'language' => 'und',
          ),
          10 => array(
            'source' => 'jsonpath_parser:10',
            'target' => 'field_uaqs_short_title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          11 => array(
            'source' => 'jsonpath_parser:11',
            'target' => 'field_uaqs_news_tags',
            'term_search' => '0',
            'autocreate' => 0,
            'language' => 'und',
          ),
          12 => array(
            'source' => 'Blank source 1',
            'target' => 'user_name',
            'unique' => FALSE,
            'language' => 'und',
          ),
          13 => array(
            'source' => 'Blank source 3',
            'target' => 'promote',
            'unique' => FALSE,
            'language' => 'und',
          ),
        ),
        'insert_new' => '1',
        'update_existing' => '2',
        'update_non_existent' => 'delete',
        'input_format' => 'uaqs_standard',
        'skip_hash_check' => 0,
        'bundle' => 'uaqs_news',
        'language' => 'und',
      ),
    ),
    'content_type' => '',
    'update' => 0,
    'import_period' => '1800',
    'expire_period' => 3600,
    'import_on_create' => 1,
    'process_in_background' => 0,
  );
  $export['uaqs_news_tag'] = $feeds_importer;

  return $export;
}

/**
 * Implements hook_defaultconfig_feeds_tamper_default().
 */
function uaqs_news_feeds_defaultconfig_feeds_tamper_default() {
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
