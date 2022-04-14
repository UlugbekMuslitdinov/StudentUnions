<?php
/**
 * @file
 * uaqs_event_importer.feeds_importer_default.inc
 */

/**
 * Implements hook_feeds_importer_default().
 */
function uaqs_event_importer_feeds_importer_default() {
  $export = array();

  $feeds_importer = new stdClass();
  $feeds_importer->disabled = FALSE; /* Edit this to true to make a default feeds_importer disabled initially */
  $feeds_importer->api_version = 1;
  $feeds_importer->id = 'uaqs_event_importer';
  $feeds_importer->config = array(
    'name' => 'UAQS Event Importer',
    'description' => 'Imports events from the master calendar (https://uanews.arizona.edu/feed/vcal/event/%)',
    'fetcher' => array(
      'plugin_key' => 'FeedsHTTPFetcher',
      'config' => array(
        'auto_detect_feeds' => FALSE,
        'use_pubsubhubbub' => FALSE,
        'designated_hub' => '',
        'request_timeout' => NULL,
        'auto_scheme' => 'http',
        'accept_invalid_cert' => FALSE,
      ),
    ),
    'parser' => array(
      'plugin_key' => 'DateiCalFeedsParser',
      'config' => array(
        'indefinite_count' => '52',
        'indefinite_message_display' => TRUE,
        'until_not_utc' => FALSE,
        'skip_days' => NULL,
      ),
    ),
    'processor' => array(
      'plugin_key' => 'FeedsNodeProcessor',
      'config' => array(
        'expire' => '31536000',
        'author' => 0,
        'mappings' => array(
          0 => array(
            'source' => 'SUMMARY',
            'target' => 'title',
            'unique' => 0,
            'language' => 'und',
          ),
          1 => array(
            'source' => 'DTSTART',
            'target' => 'field_uaqs_date:start',
            'unique' => FALSE,
            'language' => 'und',
          ),
          2 => array(
            'source' => 'DTEND',
            'target' => 'field_uaqs_date:end',
            'unique' => FALSE,
            'language' => 'und',
          ),
          3 => array(
            'source' => 'DESCRIPTION',
            'target' => 'field_uaqs_body',
            'unique' => FALSE,
            'language' => 'und',
          ),
          4 => array(
            'source' => 'LOCATION',
            'target' => 'field_uaqs_location:title',
            'unique' => FALSE,
            'language' => 'und',
          ),
          5 => array(
            'source' => 'UID',
            'target' => 'guid',
            'unique' => 1,
            'language' => 'und',
          ),
          6 => array(
            'source' => 'URL',
            'target' => 'field_uaqs_link:url',
            'unique' => FALSE,
            'language' => 'und',
          ),
          7 => array(
            'source' => 'RRULE',
            'target' => 'field_uaqs_date:rrule',
            'unique' => FALSE,
            'language' => 'und',
          ),
        ),
        'update_existing' => '2',
        'input_format' => 'uaqs_filtered_html',
        'authorize' => 0,
        'skip_hash_check' => 0,
        'bundle' => 'uaqs_event',
        'insert_new' => '1',
        'update_non_existent' => 'skip',
        'language' => 'und',
      ),
    ),
    'content_type' => '',
    'update' => 0,
    'import_period' => '21600',
    'expire_period' => 3600,
    'import_on_create' => 1,
    'process_in_background' => 1,
  );
  $export['uaqs_event_importer'] = $feeds_importer;

  return $export;
}
