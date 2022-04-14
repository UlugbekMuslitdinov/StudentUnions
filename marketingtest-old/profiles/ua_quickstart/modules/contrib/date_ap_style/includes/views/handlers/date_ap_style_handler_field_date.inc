<?php

/**
 * @file
 * A handler to display dates in AP style.
 */

// @codingStandardsIgnoreStart
/**
 * Extends views_handler_field_date class with AP date format option.
 *
 * @ingroup views_field_handlers
 */
class date_ap_style_handler_field_date extends views_handler_field_date {

  function option_definition() {
    $options = parent::option_definition();

    $options['date_ap_style_output'] = array('default' => variable_get('date_ap_style_defaults', array()));

    return $options;
  }

  /**
   * Provides selection option for views date format.
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['date_format']['#options']['date_ap_style'] = t('AP Date Style');
    $form['date_ap_style_output'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Display Options'),
      '#options' => array(
        'use_dow' => t('Use day of week for current week'),
        'use_year' => t('Use year'),
        'show_time' => t('Show time'),
        'date_time' => t('Use date before time'),
      ),
      '#default_value' => isset($this->options['date_ap_style_output']) ? $this->options['date_ap_style_output'] : variable_get('date_ap_style_defaults', array(
        'use_dow' => 0,
        'use_year' => 0,
        'show_time' => 0,
        'date_time' => 0,
      )),
      '#dependency' => array('edit-options-date-format' => array('date_ap_style')),
    );
  }

  /**
   * Creates an AP Style formatted date string from a date string.
   */
  function render($values) {
    // If view date format is not date_ap_style, return to parent.
    if ($this->options['date_format'] != 'date_ap_style') {
      return parent::render($values);
    }
    
    $value = $this->get_value($values);
    $settings = $this->options['date_ap_style_output'];
    // Determine if the date is within the current week and set final output.
    if ($settings['use_dow'] && date('W') == date('W', $value)) {
      $ap_format = 'l';
    }
    else {
      // Determine the month and set the AP Style abbreviation.
      $input_month = date('m', $value);
      switch ($input_month) {
        case '03':
        case '04':
        case '05':
        case '06':
        case '07':
          $ap_month = 'F';
          break;

        case '09':
          $ap_month = 'M\t.';
          break;

        default:
          $ap_month = 'M.';
      }
      // Determine whether the date is within the current year.
      $ap_year = '';
      if ($settings['use_year'] || date('Y', $value) != date('Y')) {
        $ap_year = ', Y';
      }
      $ap_format = $ap_month . ' j' . $ap_year;
    }
    if ($settings['show_time']){
      $time_format = 'g:i ';
      // Format am and pm to AP Style abbreviations.
      if (date('a', $value) == 'am') {
        $time_format .= '\a.\m.';
      }
      elseif (date('a', $value) == 'pm') {
        $time_format .= 'p.\m.';
      }
      if ($settings['date_time']){
        $ap_format .= ' ' . $time_format;
      }
      else {
        $ap_format = $time_format . ' ' . $ap_format;
      }
    }
    return format_date($value, 'custom', $ap_format);
  }
}
// @codingStandardsIgnoreEnd
