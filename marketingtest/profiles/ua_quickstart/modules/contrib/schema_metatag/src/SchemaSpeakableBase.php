<?php

/**
 * Schema.org Speakable items should extend this class.
 */
class SchemaSpeakableBase extends SchemaNameBase {

  use SchemaSpeakableTrait;

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

    $form = parent::getForm($options);
    $form['value'] = $this->speakableForm($input_values);

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
    $keys = self::speakableFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'pivot':
          break;

        case '@type':
          $items[$key] = 'SpeakableSpecification';
          break;

        case 'xpath':
          $items[$key] = '/html/head/title,/html/head/meta[@name=\'description\']/@content';
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
        case 'xpath':
        case 'cssSelector':
          $items[$key] = static::processTestExplodeValue($items[$key]);
          break;

      }
    }
    return $items;
  }

}
