<?php

/**
 * Schema.org Person/Org items should extend this class.
 */
class SchemaPersonOrgBase extends SchemaNameBase {

  use SchemaPersonOrgTrait;

  /**
   * The top level keys on this form.
   */
  public function formKeys() {
    return ['pivot'] + self::personOrgFormKeys();
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

    $form['value'] = $this->personOrgForm($input_values);

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
    $keys = self::personOrgFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'pivot':
          break;

        case 'logo':
          $items[$key] = SchemaImageBase::testValue();
          break;

        case '@type':
          $items[$key] = 'Organization';
          break;

        case 'url':
        case 'sameAs':
          $items[$key] = static::randomUrl() . ',' . static::randomUrl() . ',' . static::randomUrl();

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
        case 'url':
        case 'sameAs':
          $items[$key] = static::processTestExplodeValue($items[$key]);
          break;

        case 'logo':
          $items[$key] = SchemaImageBase::processedTestValue($items[$key]);
          break;

      }
    }
    return $items;
  }

}
