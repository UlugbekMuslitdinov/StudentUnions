<?php
/**
 * @file
 * UAQS Call To Action bean plugin.
 */

class UaqsCallToActionBean extends BeanPlugin {
  /**
   * Declares default block settings.
   */
  public function values() {
    $values = array(
      'uaqs_call_to_action' => array(
        'call_to_action_block_wrapper_class' => 'col-md-12'
      ),
    );
    return array_merge(parent::values(), $values);
  }

  /**
   * Builds extra settings for the block edit form.
   */
  public function form($bean, $form, &$form_state) {
    $form = array();
    $form['uaqs_call_to_action'] = array(
      '#type' => 'fieldset',
      '#tree' => 1,
      '#title' => t('Call To Action block settings'),
    );
    $form['uaqs_call_to_action']['call_to_action_block_wrapper_class'] = array(
      '#maxlength' => '1028',
      '#type' => 'textfield',
      '#title' => t('Wrapper class around block'),
      '#default_value' => $bean->uaqs_call_to_action['call_to_action_block_wrapper_class'],
      '#description' => t('You may use hyphens, underscores, and alphanumeric characters.'),
    );
    return $form;
  }

  /**
   * Displays the bean.
   */
  public function view($bean, $content, $view_mode = 'default', $langcode = NULL) {
    $content['#prefix'] = '<div class="' . $bean->uaqs_call_to_action['call_to_action_block_wrapper_class'] . '">';
    $content['#suffix'] = '</div>';

    return $content;
  }
}
