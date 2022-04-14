<?php

/**
 * Schema.org EntryPoint items should extend this class.
 */
class SchemaEntryPointBase extends SchemaNameBase {

  use SchemaEntryPointTrait;

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

    $form['value'] = $this->entryPointForm($input_values);

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
    $keys = self::entryPointFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'EntryPoint';
          break;

        case 'urlTemplate':
        case 'actionPlatform':
        case 'inLanguage';
          $items[$key] = parent::testDefaultValue(3, ',');

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
        case 'urlTemplate':
        case 'actionPlatform':
        case 'inLanguage';
          $items[$key] = static::processTestExplodeValue($items[$key]);
          break;

      }
    }
    return $items;
  }

}
