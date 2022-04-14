<?php

/**
 * Schema.org Brand items should extend this class.
 */
class SchemaBrandBase extends SchemaNameBase {

  use SchemaBrandTrait;

  /**
   * The top level keys on this form.
   */
  public static function formKeys() {
    return ['pivot'] + self::brandFormKeys();
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

    $form['value'] = $this->brandForm($input_values);

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
    $keys = self::brandFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'logo':
          $items[$key] = SchemaImageBase::testValue();
          break;

        case '@type':
          $items[$key] = 'Brand';
          break;

        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
          break;

      }
    }
    return $items;
  }

}
