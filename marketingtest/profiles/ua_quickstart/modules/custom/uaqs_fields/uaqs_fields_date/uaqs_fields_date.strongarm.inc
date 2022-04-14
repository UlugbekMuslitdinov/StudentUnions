<?php
/**
 * @file
 * uaqs_fields_date.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_fields_date_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date_format_uaqs_event_abbr_month_only';
  $strongarm->value = 'M';
  $export['date_format_uaqs_event_abbr_month_only'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date_format_uaqs_event_date';
  $strongarm->value = 'F d, Y g:ia';
  $export['date_format_uaqs_event_date'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date_format_uaqs_event_day_only';
  $strongarm->value = 'd';
  $export['date_format_uaqs_event_day_only'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date_format_uaqs_event_full_month_and_year';
  $strongarm->value = 'F Y';
  $export['date_format_uaqs_event_full_month_and_year'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date_format_uaqs_event_time_only';
  $strongarm->value = 'g:ia';
  $export['date_format_uaqs_event_time_only'] = $strongarm;

  return $export;
}
