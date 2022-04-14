<?php

/**
 * Schema.org SchemaGovernmentService trait.
 */
trait SchemaGovernmentServiceTrait {

  use SchemaPersonOrgTrait, SchemaPivotTrait {
    SchemaPivotTrait::pivotForm insteadof SchemaPersonOrgTrait;
  }

  /**
   * Form keys.
   */
  public static function governmentServiceFormKeys() {
    return [
      '@type',
      'name',
      'url',
      'serviceType',
      'provider',
      'audience',
    ];
  }

  /**
   * The form element.
   */
  public function governmentServiceForm($input_values) {

    $input_values += SchemaMetatagManager::defaultInputValues();
    $value = $input_values['value'];

    // Get the id for the nested @type element.
    $visibility_selector = $input_values['visibility_selector'];
    $selector = ':input[name="' . $visibility_selector . '[@type]"]';
    $visibility = ['invisible' => [$selector => ['value' => '']]];
    $selector2 = SchemaMetatagManager::altSelector($selector);
    $visibility2 = ['invisible' => [$selector2 => ['value' => '']]];
    $visibility['invisible'] = [$visibility['invisible'], $visibility2['invisible']];

    $form['#type'] = 'fieldset';
    $form['#title'] = $input_values['title'];
    $form['#description'] = $input_values['description'];
    $form['#tree'] = TRUE;

    // Add a pivot option to the form.
    $form['pivot'] = $this->pivotForm($value);
    $form['pivot']['#states'] = $visibility;

    $options = static::types();
    $options = array_combine($options, $options);
    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => $options,
      '#required' => $input_values['#required'],
      '#weight' => -10,
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('name'),
      '#default_value' => !empty($value['name']) ? $value['name'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t("The name of the government benefits."),
    ];

    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t("The URL to more information about the government benefits."),
    ];

    $form['audience'] = [
      '#type' => 'textfield',
      '#title' => $this->t('audience'),
      '#default_value' => !empty($value['audience']) ? $value['audience'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t("The audience that is eligible to receive the government benefits. For example, small businesses."),
    ];

    $form['serviceType'] = [
      '#type' => 'textfield',
      '#title' => $this->t('serviceType'),
      '#default_value' => !empty($value['serviceType']) ? $value['serviceType'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t("Service type, one of http://schema.org/BasicIncome, http://schema.org/BusinessSupport, http://schema.org/DisabilitySupport, http://schema.org/HealthCare, http://schema.org/OneTimePayments, http://schema.org/PaidLeave, http://schema.org/ParentalSupport, http://schema.org/UnemploymentSupport."),
    ];

    $input_values = [
      'title' => $this->t('provider'),
      'description' => 'The government organization that is providing the benefits.',
      'value' => !empty($value['provider']) ? $value['provider'] : [],
      '#required' => $input_values['#required'],
      'visibility_selector' => $visibility_selector . '[provider]',
    ];

    $form['provider'] = $this->personOrgForm($input_values);
    $form['provider']['#states'] = $visibility;

    $keys = static::governmentServiceFormKeys();
    foreach ($keys as $key) {
      if ($key != '@type') {
        $form[$key]['#states'] = $visibility;
      }
    }

    return $form;
  }

  /**
   * Thing object types.
   */
  public static function types() {
    return [
      'GovernmentService',
    ];
  }

}
