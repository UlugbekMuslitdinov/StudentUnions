<?php
/**
 * @file
 * UAQS Select Menu bean plugin.
 */

class UaqsSelectMenuBean extends BeanPlugin {
  /**
   * Declares default block settings.
   */
  public function values() {
    $values = array(
      'layout_options' => array(
        'column_xs' => 12,
        'column_offset_xs' => 0,
        'column_buffer_top_xs' => -1,
        'column_buffer_bottom_xs' => -1,
        'column_sm' => 0,
        'column_offset_sm' => 0,
        'column_buffer_top_sm' => -1,
        'column_buffer_bottom_sm' => -1,
        'column_md' => 0,
        'column_offset_md' => 0,
        'column_buffer_top_md' => -1,
        'column_buffer_bottom_md' => -1,
        'column_lg' => 0,
        'column_offset_lg' => 0,
        'column_buffer_top_lg' => -1,
        'column_buffer_bottom_lg' => -1,
        'column_class' => '',
      ),
      'select_menu_options' => array(
        'menu_name' => '',
        'empty_option' => TRUE,
        'empty_option_label' => 'choose an option',
        'preform_text' => 'I am a',
        'preform_text_sr_only' => 'Select your audience',
        'button_text' => 'Go',
        'button_text_sr_only' => ' to the page for that group',
      ),
    );

    return $values + parent::values();
  }

  /**
   * Builds extra settings for the block edit form.
   */
  public function form($bean, $form, &$form_state) {
    $menus = menu_get_menus();
    $form = array();

    // options for column width and offset. 0 is defined later since col-xs is
    // required.
    $options = array(
      1 => 1,
      2 => 2,
      3 => 3,
      4 => 4,
      5 => 5,
      6 => 6,
      7 => 7,
      8 => 8,
      9 => 9,
      10 => 10,
      11 => 11,
      12 => 12
    );

    // options for the size of buffer you want to use.
    $buffer_options = array(
      -1 => 'Do not define',
      0 => 0,
      1 => 1,
      5 => 5,
      10 => 10,
      15 => 15,
      20 => 20,
      25 => 25,
      30 => 30,
      50 => 50
    );

    $form['uaqs_select_menu']['layout_options'] = array(
      '#type' => 'fieldset',
      '#tree' => 1,
      '#title' => t('Layout Options'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );

    $form['uaqs_select_menu']['layout_options']['column_xs'] = array(
      '#type' => 'select',
      '#title' => t('Width of block on extra small devices'),
      '#options' => $options,
      '#required' => TRUE,
      '#description' => t('Choose the number of columns for a particular device size and up. This affects the css classes that will be applied to the column and not the actual HTML structure that will be rendered. Not defining the width of the column for a device size will result in inheriting the width of the column from one size below.'),
      '#default_value' => $bean->layout_options['column_xs'],
    );

    // Add option to not define the number of columns for the rest.
    $options[0] = 'Do not define';

    $form['uaqs_select_menu']['layout_options']['column_offset_xs'] = array(
      '#type' => 'select',
      '#title' => t('Offset of block on extra small devices'),
      '#options' => $options,
      '#required' => FALSE,
      '#description' => t('If would would like to offest the column make a selection.'),
      '#default_value' => $bean->layout_options['column_offset_xs'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_top_xs'] = array(
      '#type' => 'select',
      '#title' => t('Top buffer of block on extra small devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the top of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_top_xs'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_bottom_xs'] = array(
      '#type' => 'select',
      '#title' => t('Bottom buffer of block on extra small devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the bottom of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_bottom_xs'],
    );

    $form['uaqs_select_menu']['layout_options']['column_sm'] = array(
      '#type' => 'select',
      '#title' => t('Width of block on small devices'),
      '#options' => $options,
      '#required' => FALSE,
      '#description' => t('See the description on the width of the column for extra small devices.'),
      '#default_value' => $bean->layout_options['column_sm'],
    );

    $form['uaqs_select_menu']['layout_options']['column_offset_sm'] = array(
      '#type' => 'select',
      '#title' => t('Offset of block on small devices'),
      '#options' => $options,
      '#required' => FALSE,
      '#description' => t('If would would like to offest the column make a selection.'),
      '#default_value' => $bean->layout_options['column_offset_sm'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_top_sm'] = array(
      '#type' => 'select',
      '#title' => t('Top buffer of block on small devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the top of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_top_sm'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_bottom_sm'] = array(
      '#type' => 'select',
      '#title' => t('Bottom buffer of block on small devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the bottom of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_bottom_sm'],
    );

    $form['uaqs_select_menu']['layout_options']['column_md'] = array(
      '#type' => 'select',
      '#title' => t('Width of block on medium devices'),
      '#options' => $options,
      '#required' => FALSE,
      '#description' => t('See the description on the width of the column for extra small devices.'),
      '#default_value' => $bean->layout_options['column_md'],
    );

    $form['uaqs_select_menu']['layout_options']['column_offset_md'] = array(
      '#type' => 'select',
      '#title' => t('Offset of block on medium devices'),
      '#options' => $options,
      '#required' => FALSE,
      '#description' => t('If would would like to offest the column make a selection.'),
      '#default_value' => $bean->layout_options['column_offset_md'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_top_md'] = array(
      '#type' => 'select',
      '#title' => t('Top buffer of block on medium devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the top of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_top_md'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_bottom_md'] = array(
      '#type' => 'select',
      '#title' => t('Bottom buffer of block on medium devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the bottom of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_bottom_md'],
    );

    $form['uaqs_select_menu']['layout_options']['column_lg'] = array(
      '#type' => 'select',
      '#title' => t('Width of block on large devices'),
      '#options' => $options,
      '#required' => FALSE,
      '#description' => t('See the description on the width of the column for extra small devices.'),
      '#default_value' => $bean->layout_options['column_lg'],
    );

    $form['uaqs_select_menu']['layout_options']['column_offset_lg'] = array(
      '#type' => 'select',
      '#title' => t('Offset of block on large devices'),
      '#options' => $options,
      '#required' => FALSE,
      '#description' => t('If would would like to offest the column make a selection.'),
      '#default_value' => $bean->layout_options['column_offset_lg'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_top_lg'] = array(
      '#type' => 'select',
      '#title' => t('Top buffer of block on large devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the top of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_top_lg'],
    );

    $form['uaqs_select_menu']['layout_options']['column_buffer_bottom_lg'] = array(
      '#type' => 'select',
      '#title' => t('Bottom buffer of block on large devices'),
      '#options' => $buffer_options,
      '#required' => FALSE,
      '#description' => t('If would would like to add margin to the bottom of the block make a selection.'),
      '#default_value' => $bean->layout_options['column_buffer_bottom_lg'],
    );

    $form['uaqs_select_menu']['layout_options']['column_class'] = array(
      '#title' => t('Column class'),
      '#description' => t('Additional classes to provide on the column.'),
      '#type' => 'textfield',
      '#default_value' => $bean->layout_options['column_class'],
    );

    $form['uaqs_select_menu']['select_menu_options'] = array(
      '#type' => 'fieldset',
      '#tree' => 1,
      '#title' => t('Select menu options'),
    );

    $form['uaqs_select_menu']['select_menu_options']['menu_name'] = array(
      '#type' => 'select',
      '#title' => t('Menu to be used as a select menu.'),
      '#default_value' => $bean->select_menu_options['menu_name'],
      '#options' => $menus,
      '#description' => t('Note: only top-level menu links will be used.'),
    );

    $form['uaqs_select_menu']['select_menu_options']['empty_option'] = array(
      '#type' => 'checkbox',
      '#title' => t('Include an empty option.'),
      '#default_value' => $bean->select_menu_options['empty_option'],
    );

    $form['uaqs_select_menu']['select_menu_options']['empty_option_label'] = array(
      '#type' => 'textfield',
      '#title' => t('Empty option label.'),
      '#default_value' => $bean->select_menu_options['empty_option_label'],
      '#states' => array(
        'visible' => array(
          ':input[name="select_menu_options[empty_option]"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['uaqs_select_menu']['select_menu_options']['preform_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Text to display inline before the select form.'),
      '#default_value' => $bean->select_menu_options['preform_text'],
      '#description' => t('You may use hyphens, underscores, and alphanumeric characters.'),
    );

    $form['uaqs_select_menu']['select_menu_options']['preform_text_sr_only'] = array(
      '#type' => 'textfield',
      '#title' => t('Form help for screen-readers.'),
      '#default_value' => $bean->select_menu_options['preform_text_sr_only'],
      '#description' => t('Depending on the preform text, screen readers don\'t necessarily show their users this form in a helpful context.'),
    );

    $form['uaqs_select_menu']['select_menu_options']['button_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Text you would like to appear in the button.'),
      '#default_value' => $bean->select_menu_options['button_text'],
    );

    $form['uaqs_select_menu']['select_menu_options']['button_text_sr_only'] = array(
      '#type' => 'textfield',
      '#title' => t('Text to help screen-reader users understand what to do.'),
      '#default_value' => $bean->select_menu_options['button_text_sr_only'],
    );

    return $form;
  }

  /**
   * Displays the bean.
   */
  public function view($bean, $content, $view_mode = 'default', $langcode = NULL) {
    $wrapper_classes = array();
    foreach (['xs', 'sm', 'md', 'lg'] as $size) {
      if ($bean->data['layout_options']['column_' . $size] > 0) {
        $column_class = 'col-' . $size . '-' . $bean->data['layout_options']['column_' . $size];
        $wrapper_classes[] = drupal_html_class($column_class);
      }
      if ($bean->data['layout_options']['column_offset_' . $size] > 0) {
        $column_offset_class = 'col-' . $size . '-offset-' . $bean->data['layout_options']['column_offset_' . $size];
        $wrapper_classes[] = drupal_html_class($column_offset_class);
      }
      if ($bean->data['layout_options']['column_buffer_top_' . $size] >= 0) {
        $column_buffer_top_class = 'top-buffer-' . $size . '-' . $bean->data['layout_options']['column_buffer_top_' . $size];
        $wrapper_classes[] = drupal_html_class($column_buffer_top_class);
      }
      if ($bean->data['layout_options']['column_buffer_bottom_' . $size] >= 0) {
        $column_buffer_bottom_class = 'bottom-buffer-' . $size . '-' . $bean->data['layout_options']['column_buffer_bottom_' . $size];
        $wrapper_classes[] = drupal_html_class($column_buffer_bottom_class);
      }
    }
    if (isset($bean->data['layout_options']['column_class'])) {
      $freehand_classes = explode(" ", $bean->data['layout_options']['column_class']);
      foreach ($freehand_classes as $key => $class) {
        $sanitized_class = drupal_html_class($class);
        $freehand_classes[$key] = $sanitized_class;
      }
      $wrapper_classes = array_merge($wrapper_classes, $freehand_classes);
    }
    $wrapper_classes = array_filter($wrapper_classes);

    $menu_tree = menu_build_tree(
      $bean->data['select_menu_options']['menu_name'],
      array(
        'max_depth' => 1,
      )
    );
    $menu_tree_output = menu_tree_output($menu_tree);

    $menu_items = array();
    foreach ($menu_tree_output as $menu_link) {
      if (isset($menu_link['#theme'])) {
        $menu_items[] = array(
          'href' => url($menu_link['#href'], array('absolute' => 'true')),
          'title' => $menu_link['#title'],
        );
      }
    }

    if ($bean->data['select_menu_options']['empty_option'] && !empty($bean->data['select_menu_options']['empty_option_label'])) {
      $empty_option = array(
        'href' => url('<nolink>', array('absolute' => 'true')),
        'title' => $bean->data['select_menu_options']['empty_option_label'],
      );
      array_unshift($menu_items, $empty_option);
    }

    $select_id = 'uaqs-navigation-select-menu-' . $bean->delta;
    $js_block_ids = array();
    $js_block_ids[] = $select_id;

    $output = array(
      '#theme' => 'uaqs_navigation_select_menu',
      '#menu_items' => $menu_items,
      '#wrapper_classes' => $wrapper_classes,
      '#select_id' => $select_id,
      '#preform_text' => $bean->data['select_menu_options']['preform_text'],
      '#preform_text_sr_only' => $bean->data['select_menu_options']['preform_text_sr_only'],
      '#button_text' => $bean->data['select_menu_options']['button_text'],
      '#button_text_sr_only' => $bean->data['select_menu_options']['button_text_sr_only'],
      '#attached' => array(
        'css' => array(
          drupal_get_path('module', 'uaqs_navigation_select_menu') . '/css/uaqs_navigation_select_menu.css',
        ),
        'js' => array(
          array(
            'data' => drupal_get_path('module', 'uaqs_navigation_select_menu') . '/js/uaqs_navigation_select_menu.js',
            'type' => 'file',
            'scope' => 'footer',
            'group' => JS_THEME,
          ),
          array(
            'data' => array(
              'uaqsNavigationSelectMenu' => array('ids' => $js_block_ids),
            ),
            'type' => 'setting'
          ),
        ),
      ),
    );

    return $output;
  }
}
