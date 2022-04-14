<?php
/**
 * @file
 * UAQS Search bean plugin.
 */

class UaqsSearchBean extends BeanPlugin {
  /**
   * Declares default block settings.
   */
  public function values() {
    $values = array(
      'uaqs_search' => array(
        'search_block_wrapper_class' => 'col-sm-7 col-md-5 col-lg-5 col-lg-offset-4 no-gutter col-md-offset-3',
        'search_block_form' => array(
          'search_block_form_wrapper_class' => 'search-form text-size-h6 visible-sm visible-md visible-lg',
          'search_block_form_placeholder' => 'Search Site...',
          'search_block_tiny_on_mobile' => '',
        ),
      ),
    );

    return array_merge(parent::values(), $values);
  }

  /**
   * Builds extra settings for the block edit form.
   */
  public function form($bean, $form, &$form_state) {
    $form = array();
    $form['uaqs_search'] = array(
      '#type' => 'fieldset',
      '#tree' => 1,
      '#title' => t('Search block settings'),
    );
    $form['uaqs_search']['search_block_wrapper_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Wrapper class around block'),
      '#default_value' => $bean->uaqs_search['search_block_wrapper_class'],
      '#description' => t('You may use hyphens, underscores, and alphanumeric characters.'),
    );
    $form['uaqs_search']['search_block_form'] = array(
      '#type' => 'fieldset',
      '#tree' => 1,
      '#title' => t('Search block form settings'),
    );
    $form['uaqs_search']['search_block_form']['search_block_form_wrapper_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Wrapper class around form'),
      '#default_value' => $bean->uaqs_search['search_block_form']['search_block_form_wrapper_class'],
      '#description' => t('You may use hyphens, underscores, and alphanumeric characters.'),
    );
    $form['uaqs_search']['search_block_form']['search_block_form_placeholder'] = array(
      '#type' => 'textfield',
      '#title' => t('Placeholder text'),
      '#default_value' => $bean->uaqs_search['search_block_form']['search_block_form_placeholder'],
      '#description' => t('The placeholder attribute specifies a short hint that describes the expected value of an input field.'),
    );
    $form['uaqs_search']['search_block_form']['search_block_tiny_on_mobile'] = array(
      '#type' => 'checkbox',
      '#title' => t('Tiny on mobile'),
      '#default_value' => $bean->uaqs_search['search_block_form']['search_block_tiny_on_mobile'],
      '#description' => t('Would you like the search box to just be a tiny square link to the search page on mobile?lPlease style your other wrappers accordingly.'),
    );
    return $form;
  }

  /**
   * Displays the bean.
   */
  public function view($bean, $content, $view_mode = 'default', $langcode = NULL) {
    $content = drupal_get_form('search_block_form');
    $content['search_block_form']['#attributes']['placeholder'] = t($bean->uaqs_search['search_block_form']['search_block_form_placeholder']);
    $content['search_block_form']['#attributes']['class'][] = 'form-control';
    $content['search_block_form']['#attributes']['onfocus'] = "this.placeholder = ''";
    $content['search_block_form']['#attributes']['tabindex'] = "0";
    $content['search_block_form']['#attributes']['onblur'] = "this.placeholder = '" . t($bean->uaqs_search['search_block_form']['search_block_form_placeholder']) . "'";
    $content['#prefix'] = '<div class="' . $bean->uaqs_search['search_block_wrapper_class'] . '">';
    $content['#prefix'] .=  '<div class="' . $bean->uaqs_search['search_block_form']['search_block_form_wrapper_class'] . '">';
    $content['#suffix'] = '</div>';
    if ($bean->uaqs_search['search_block_form']['search_block_tiny_on_mobile']) {
      $content['#suffix'] .= '<a class="search-input-link visible-xs pull-right" href="/search/node"></a>';
    }
    $content['#suffix'] .= '</div>';

    return $content;
  }
}
