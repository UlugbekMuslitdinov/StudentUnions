<?php
/**
 * @file
 * uaqs_core.default_breakpoint_group.inc
 */

/**
 * Implements hook_default_breakpoint_group().
 */
function uaqs_core_default_breakpoint_group() {
  $export = array();

  $breakpoint_group = new stdClass();
  $breakpoint_group->disabled = FALSE; /* Edit this to true to make a default breakpoint_group disabled initially */
  $breakpoint_group->api_version = 1;
  $breakpoint_group->machine_name = 'ua_zen';
  $breakpoint_group->name = 'UA Zen';
  $breakpoint_group->breakpoints = array(
    0 => 'breakpoints.theme.ua_zen.screen-xs-max',
    1 => 'breakpoints.theme.ua_zen.screen-sm-min',
    2 => 'breakpoints.theme.ua_zen.screen-sm-max',
    3 => 'breakpoints.theme.ua_zen.screen-md-min',
    4 => 'breakpoints.theme.ua_zen.screen-md-max',
    5 => 'breakpoints.theme.ua_zen.screen-lg-min',
  );
  $breakpoint_group->type = 'theme';
  $breakpoint_group->overridden = 0;
  $export['ua_zen'] = $breakpoint_group;

  return $export;
}
