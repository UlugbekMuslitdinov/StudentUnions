<?php

/**
 * Schema.org tags using an id reference items should extend this class.
 */
class SchemaIdReferenceBase extends SchemaNameBase {

  use SchemaIdReferenceTrait;

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

    $form['value'] = $this->idForm($input_values);

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
    $keys = self::idFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'pivot':
          break;

        case '@id':
          $items[$key] = parent::testDefaultValue(3, ',');
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
        case '@id':
          $items[$key] = static::processTestExplodeValue($items[$key]);
          break;
      }
    }
    return $items;
  }

}
