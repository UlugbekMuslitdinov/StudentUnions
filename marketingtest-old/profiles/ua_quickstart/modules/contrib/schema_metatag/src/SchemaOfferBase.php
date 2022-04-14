<?php

/**
 * Provides a plugin for the 'schema_offer_base' meta tag.
 */
class SchemaOfferBase extends SchemaNameBase {

  use SchemaOfferTrait;

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

    $form['value'] = $this->offerForm($input_values);

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
    $keys = self::offerFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'Offer';
          break;

        case 'eligibleRegion':
        case 'ineligibleRegion':
          $items[$key] = SchemaCountryBase::testValue();
          break;

        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
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
        case 'eligibleRegion':
        case 'ineligibleRegion':
          $items[$key] = SchemaCountryBase::processedTestValue($items[$key]);
          break;

      }
    }
    return $items;
  }


}
