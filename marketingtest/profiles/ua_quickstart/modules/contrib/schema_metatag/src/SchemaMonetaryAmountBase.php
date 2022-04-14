<?php

/**
 * Schema.org MonetaryAmount should extend this class.
 */
class SchemaMonetaryAmountBase extends SchemaNameBase {

  use SchemaMonetaryAmountTrait;

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

    $form['value'] = $this->monetaryAmountForm($input_values);

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
    $keys = self::monetaryAmountFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'MonetaryAmount';
          break;

        case 'value':
          $items[$key] = [
            '@type' => 'QuantitativeValue',
            'value' => parent::testDefaultValue(1, ''),
            'minValue' => parent::testDefaultValue(1, ''),
            'maxValue' => parent::testDefaultValue(1, ''),
            'unitText' => 'HOUR',
          ];
          break;

        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;

      }
    }
    return $items;
  }

}
