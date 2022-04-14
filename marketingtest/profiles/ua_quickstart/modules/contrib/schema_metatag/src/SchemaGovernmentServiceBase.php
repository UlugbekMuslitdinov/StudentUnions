<?php

/**
 * Schema.org GovernmentService items should extend this class.
 */
class SchemaGovernmentServiceBase extends SchemaNameBase {

  use SchemaGovernmentServiceTrait;

  /**
   * The top level keys on this form.
   */
  public function formKeys() {
    return ['pivot'] + self::governmentServiceFormKeys();
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {

    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $value,
      '#required' => isset($options['#required']) ? $options['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector(),
    ];

    $form['value'] = $this->governmentServiceForm($input_values);

    if (empty($this->multiple())) {
      unset($form['value']['pivot']);
    }

    // Validation from parent::getForm() got wiped out, so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::governmentServiceFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'provider':
          $items[$key] = SchemaPersonOrgBase::testValue();
          break;

        case '@type':
          $items[$key] = 'GovernmentService';
          break;

        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;

      }
    }
    return $items;
  }

  /**
   * {@inheritdoc}
   */
  public static function processedTestValue($items) {
    foreach ($items as $key => $value) {
      switch ($key) {
        case 'provider':
          $items[$key] = SchemaPersonOrgBase::processedTestValue($items[$key]);
          break;

      }
    }
    return $items;
  }

}
