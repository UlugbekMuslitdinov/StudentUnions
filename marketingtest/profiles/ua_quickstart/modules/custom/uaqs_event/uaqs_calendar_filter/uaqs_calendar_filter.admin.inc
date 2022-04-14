<?php

/**
 * @file
 * uaqs_calendar_filter.admin.inc
 */

/**
 * Form builder for UAQS Calendar Filter admin settings form.
 */
function uaqs_calendar_filter_settings_form($form, &$form_state) {
  $form['uaqs_calendar_filter_visible_cells'] = array(
    '#title' => t('Enable visible shading of days with events'),
    '#type' => 'checkbox',
    '#description' => t("Applies visible shading to calendar cells for days that have events in the UAQS Calendar Filter widget. Site administrators managing calendars with a large number of events may wish to disable this setting."),
    '#default_value' => variable_get('uaqs_calendar_filter_visible_cells', TRUE),
  );

  return system_settings_form($form);
}
