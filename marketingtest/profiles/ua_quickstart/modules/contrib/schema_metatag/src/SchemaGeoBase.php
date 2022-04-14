<?php

/**
 * Schema.org Geo items should extend this class.
 */
class SchemaGeoBase extends SchemaNameBase {

  use SchemaGeoTrait;

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

    $form['value'] = $this->geoForm($input_values);

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
    $keys = self::geoFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'GeoCoordinates';
          break;

        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;

      }
    }
    return $items;
  }

}
