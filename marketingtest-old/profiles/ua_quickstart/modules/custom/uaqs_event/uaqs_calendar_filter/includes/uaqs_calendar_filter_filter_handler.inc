<?php

/**
 * @file
 * A views filter handler for a calendar filter.
 */

/**
 * Extends the date_views filter handler to provide calendar functionality.
 */
class uaqs_calendar_filter_filter_handler extends date_views_filter_handler {

  protected static $results;

  /**
   * {@inheritdoc}
   */
  public function value_form(&$form, &$form_state) {
    parent::value_form($form, $form_state);

    if (!empty($form_state['exposed'])) {
      $filter_settings = array();

      $cells = array();

      // This variable allows disabling the visible shaded calendar cells on
      // days that have events.
      $visible_cells = variable_get('uaqs_calendar_filter_visible_cells', TRUE);
      if ($visible_cells) {
        if (empty($this->view->cell_query)) {
          // Run query for calendar cell information, on a wider date range.
          $cells = $this->get_cells();
        }
        if (empty($cells)) {
          $cells = array();
        }
      }

      $filter_settings[$this->options['expose']['identifier']] = $cells;

      // Prepare a wrapper for the calendar JS to access.
      $calendar_element = array(
        '#type' => 'container',
        '#attributes' => array(
          'class' => array(
            'uaqs-calendar-filter-wrapper',
          ),
          // Communicate to the HTML DOM what the unique id of our filter is.
          'data-uaqs-calendar-filter' => $this->options['expose']['identifier'],
        ),
        // Attach JS and CSS for the calendar, along with javascript settings.
        '#attached' => array(
          'js' => array(drupal_get_path('module', 'uaqs_calendar_filter') . '/js/uaqs_calendar_filter.js',
            array(
              'data' => array('uaqsCalendarFilter' => $filter_settings),
              'type' => 'setting',
            ),
          ),
          'css' => array(drupal_get_path('module', 'uaqs_calendar_filter') . '/css/uaqs_calendar_filter.css'),
          'library' => array(array('system', 'ui.datepicker')),
        ),
      );

      // Add the calendar markup into the widget.
      array_unshift($form['value'], $calendar_element);
    }

    $granularity = array_keys($this->date_handler->date_parts($this->options['granularity']));
    $form['value']['min']['#date_format'] = date_limit_format('n-j-Y', $granularity);
    $form['value']['max']['#date_format'] = date_limit_format('n-j-Y', $granularity);
    $form['value']['#attributes'] = array('class' => array('views-widget-uaqs-calendar-filter'));
  }

  /**
   * {@inheritdoc}
   */
  public function set_default_options() {
    parent::set_default_options();
    // This filter should always be exposed!
    $this->options['exposed'] = TRUE;

    // Set defaults that make sense for the calendar filter.
    $this->options['operator'] = 'between';
    $this->options['granulatiry'] = 'day';
    $this->options['form_type'] = 'date_text';

  }

  /**
   * {@inheritdoc}
   */
  public function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    // Filter should always be exposed, show warning.
    array_unshift($form['expose_button'], array(
      'warning' => array(
        '#type' => 'markup',
        '#markup' => '<div class="messages warning">' . t('A calendar filter is always configured to be an exposed filter.') . '</div>',
      ),
    )
    );

    // Remove option to unexpose filter.
    $form['expose_button']['checkbox']['checkbox']['#type'] = 'hidden';
    unset($form['expose_button']['button']);
    unset($form['expose_button']['markup']);
    unset($form['group_button']);

    // Remove some form options that aren't applicable for the calendar.
    $form['operator']['#access'] = FALSE;
    $form['expose']['use_operator']['#access'] = FALSE;
    $form['expose']['operator_label']['#access'] = FALSE;
    $form['expose']['limit_operators']['#access'] = FALSE;
    $form['expose']['available_operators']['#access'] = FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function expose_form(&$form, &$form_state) {
    parent::expose_form($form, $form_state);

    // Provide default value for the filter name.
    if (empty($form['expose']['identifier']['#default_value'])) {
      $form['expose']['identifier']['#default_value'] = $this->options['field'];
    }
    if (empty($form['expose']['label']['#default_value'])) {
      $form['expose']['label']['#default_value'] = $this->definition['title'];
    }
    if (empty($form['ui_name']['#default_value'])) {
      $form['ui_name']['#default_value'] = $this->definition['title'];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function extra_options_form(&$form, &$form_state) {
    parent::extra_options_form($form, $form_state);

    // Restrict options that are common for all calendars, rely on defaults.
    $form['form_type']['#access'] = FALSE;
    $form['granularity']['#access'] = FALSE;
    $form['form_type']['#access'] = FALSE;
    $form['year_range']['#access'] = FALSE;
  }

  /**
   * {@inheritdoc}
   */
  protected function date_combine_conditions($function) {
    $this->get_query_fields();
    if (empty($this->query_fields)) {
      return;
    }

    // Create a custom filter group for the conditions.
    $this->query->set_where_group($this->options['date_method'], $this->options['date_group']);

    $filter_count = 0;
    // Add each condition to the custom filter group.
    foreach ((array) $this->query_fields as $query_field) {
      $field = $query_field['field'];
      $this->date_handler = $query_field['date_handler'];

      // Respect relationships when determining the table alias.
      if ($field['table_name'] != $this->table || !empty($this->relationship)) {
        $this->related_table_alias = $this->query->ensure_table($field['table_name'], $this->relationship);
      }
      else {
        $this->related_table_alias = NULL;
      }
      $table_alias = !empty($this->related_table_alias) ? $this->related_table_alias : $field['table_name'];
      $field_name = $table_alias . '.' . $field['field_name'];

      // Call the appropriate function.
      $this->{$function}($field_name, $filter_count);
      $filter_count++;
    }

    // Gather all of the condition strings and their placeholders.
    $conditions = array();
    $placeholders = array();
    foreach ($this->query->where[$this->options['date_group']]['conditions'] as $condition) {
      $conditions[] = $condition['field'];
      $placeholders += $condition['value'];
    }

    // Remove the conditions from the custom filter group.
    unset($this->query->where[$this->options['date_group']]);

    // Combine all of the conditions into one string.
    $conditions = implode(' ' . $this->options['date_method'] . ' ', $conditions);

    // Add it to the filter group chosen in the Views UI.
    $this->query->add_where_expression($this->options['group'], $conditions, $placeholders);
  }

  /**
   * {@inheritdoc}
   */
  public function op_between($field) {
    $this->date_combine_conditions('op_between_calendar');
  }

  /**
   * Computes where clauses for calendar and date field intersections.
   *
   * @param string $field
   *   The table and field name to use in the query.
   * @param int $id
   *   The field uniqueness identifer, in the case of multiple fields.
   */
  public function op_between_calendar($field, $id) {

    // Add the delta field to the view so we can later find the value that
    // matched our query.
    list($table_name, $field_name) = explode('.', $field);
    if (!empty($this->options['add_delta']) && (substr($field_name, -6) == '_value' || substr($field_name, -7) == '_value2')) {
      $this->query->add_field($table_name, 'delta');
      $real_field_name = str_replace(array('_value', '_value2'), '', $this->real_field);
      $this->query->add_field($table_name, 'entity_id', 'date_id_' . $real_field_name);
      $this->query->add_field($table_name, 'delta', 'date_delta_' . $real_field_name);
    }

    // Find the SQL for start and end date for our field.
    $fields = date_views_fields($this->base_table);
    $fields = $fields['name'];
    $fromto = $fields[$field]['fromto'];

    // Compose SQL for the date fields in the query.
    $min_value = $this->get_filter_value('min', $this->value['min']);
    $min_comp_date = new DateObject($min_value, date_default_timezone(), $this->format);
    $max_value = $this->get_filter_value('max', $this->value['max']);
    $max_comp_date = new DateObject($max_value, date_default_timezone(), $this->format);
    $field_min = $this->date_handler->sql_field($fromto[0], NULL, $min_comp_date);
    $field_min = $this->date_handler->sql_format($this->format, $field_min);
    $field_max = $this->date_handler->sql_field($fromto[1], NULL, $max_comp_date);
    $field_max = $this->date_handler->sql_format($this->format, $field_max);

    // Compose SQL for the calendar cell dates in the query.
    $field_cal_min = $this->date_handler->sql_field($fromto[0], NULL);
    $field_cal_min = $this->date_handler->sql_format('Y-n-j', $field_cal_min);
    $field_cal_max = $this->date_handler->sql_field($fromto[1], NULL);
    $field_cal_max = $this->date_handler->sql_format('Y-n-j', $field_cal_max);

    // There could be more than one calendar filter, so we must add an id.
    $this->query->add_field(NULL, $field_cal_min, "calendar_filter_{$id}_start");
    $this->query->add_field(NULL, $field_cal_max, "calendar_filter_{$id}_end");

    // Prepare placeholders for where clause.
    $placeholder_min = $this->placeholder();
    $placeholder_max = $this->placeholder();
    $group = !empty($this->options['date_group']) ? $this->options['date_group'] : $this->options['group'];

    // Add where clause to check if ranges for the field and filter intersect.
    $this->query->add_where_expression($group, "$field_min <= $placeholder_max AND $field_max >= $placeholder_min", array($placeholder_min => $min_value, $placeholder_max => $max_value));
  }

  /**
   * Helper function to see if we need to swap in the default value.
   *
   * Views exposed filters treat everything as submitted, so if it's an empty
   * value we have to see if anything actually was submitted. If nothing has
   * really been submitted, we need to swap in our default value logic.
   */
  public function get_filter_value($prefix, $input) {

    // All our date widgets provide datetime values but we use ISO in our SQL
    // for consistency between the way filters and arguments work (arguments
    // cannot contain spaces).
    $value = $input;

    if (empty($value)) {
      if (empty($this->options['exposed'])) {
        $value = $this->date_default_value($prefix);
      }
      elseif (isset($this->options['expose']['identifier']) && !isset($_GET[$this->options['expose']['identifier']])) {
        $value = $this->date_default_value($prefix);
      }
    }

    // If we are running a query to find block data for calendar cells, it's
    // necessary to expand our range. We do this so that the calendar has
    // several months of cell data so that clicking through months can display
    // calendar information without waiting on an ajax refresh. In other words,
    // attempts to find data for the calendar cells also fetch some neighboring
    // months. This does not happen on the primary query, only the calendar
    // filter query.
    //
    // Without this, switching to a new month would show a month that had no
    // events checked on the calendar until the ajax refresh happened and
    // provided new cell data.
    if (!empty($value) && !empty($this->view->cell_query) && in_array($prefix, array('min', 'max'))) {

      // Slide our range forward or back depending on context.
      $modify_date = DateTime::createFromFormat("Y-m-d", $value);
      $modifier = ($prefix == 'min') ? "first day of 3 months ago" : "last day of 3 months";
      $modify_date->modify($modifier);

      $value = $modify_date->format('Y-m-d');
    }

    return str_replace(' ', 'T', $value);
  }

  /**
   * Get a unique signature for current filter handler.
   */
  protected function getSignature() {
    $signature = md5(serialize(array(
      'name' => $this->view->name,
      'args' => $this->view->args,
      'input' => $this->view->exposed_input,
      'field' => $this->field,
      'table' => $this->table,
      'ui_name' => $this->options['ui_name'],
    )));
    return $signature;
  }

  /**
   * Get list of date ranges for current view, only at runtime.
   *
   * This is used for occurence information for grid cells of the calendar.
   * In order to do this, the view is cloned, executed, and disposed of.
   * This is a similar implementation to the views_selective_filters module.
   */
  protected function get_cells() {
    // Parameters that we will be using during the process.
    $signature = $this->getSignature();

    // Prevent same filters from being recalculated.
    if (empty(self::$results[$signature])) {

      // Clone the view (so it works while editting) and get all results.
      $view_copy = $this->view->clone_view();
      if (!$view_copy) {
        return NULL;
      }
      // Store a flag so that we can know from other places
      // that this view is being used to obtain selective data.
      $view_copy->cell_query = TRUE;
      // Store information about what filter is this view being used for.
      $view_copy->selective_handler_signature = $signature;
      // Transfer contextual information to cloned view.
      $view_copy->set_exposed_input($this->view->exposed_input);
      $view_copy->set_arguments($this->view->args);

      // Remove paging, and page number from context.
      if (isset($_GET['items_per_page'])) {
        $items_per_page = $_GET['items_per_page'];
        unset($_GET['items_per_page']);
      }
      if (isset($_GET['page'])) {
        $exposed_page = $_GET['page'];
        unset($_GET['page']);
      }

      // Manipulate display + default: don't know if fields are overriden.
      $display = $view_copy->display[$this->view->current_display];
      $display_default = $view_copy->display['default'];

      // Remove any exposed form configuration. This showed up with BEF module!
      unset($display->display_options['exposed_form']);
      unset($display_default->display_options['exposed_form']);

      // Also disable attachments.
      $display->handler->definition['accept attachments'] = FALSE;
      $display_default->handler->definition['accept attachments'] = FALSE;

      // Make sure we are not using a pager.
      $display->display_options['pager'] = unserialize('a:2:{s:4:"type";s:4:"none";s:7:"options";a:1:{s:6:"offset";s:1:"0";}}');
      $display_default->display_options['pager'] = unserialize('a:2:{s:4:"type";s:4:"none";s:7:"options";a:1:{s:6:"offset";s:1:"0";}}');

      // Some style plugins can affect the built query, make sure
      // we use a reliable field based style plugin.
      $display->display_options['style_plugin'] = 'default';
      $display->display_options['style_options'] = unserialize('a:4:{s:9:"row_class";s:0:"";s:17:"default_row_class";i:1;s:17:"row_class_special";i:1;s:11:"uses_fields";i:0;}');
      $display->display_options['row_plugin'] = 'fields';
      $display->display_options['row_options'] = unserialize('s:6:"fields";');

      // Run View.
      $view_copy->execute($this->view->current_display);

      // Restore context parameters for real View.
      if (isset($items_per_page)) {
        $_GET['items_per_page'] = $items_per_page;
      }
      if (isset($exposed_page)) {
        $_GET['page'] = $exposed_page;
      }

      // Create array for calendar cell date information.
      $cells = array();
      foreach ($view_copy->result as $index => $row) {
        $to_add = array();
        foreach ($row as $field => $value) {
          $matches = array();
          if (preg_match('/calendar_filter_(\d+)_(start|end).*/', $field, $matches)) {
            $to_add[$matches[2]] = $value;
          }
        }

        if (count($to_add) == 2) {
          $cells[$index] = array(
            $to_add['start'],
            $to_add['end'],
          );
        }
      }

      // Save our results and destroy our copy of the view.
      self::$results[$signature] = $cells;
      $view_copy->destroy();
    }
    return self::$results[$signature];
  }

}
