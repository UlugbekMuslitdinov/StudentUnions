<?php

/**
 * Provides a plugin to extend for the 'Review' meta tag.
 */
class SchemaReviewBase extends SchemaNameBase {

  use SchemaReviewTrait;

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
    $form['value'] = $this->reviewForm($input_values);

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
    $keys = static::reviewFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'Review';
          break;

        case 'author':
          $items[$key] = [
            '@type' => 'Person',
            'name' => parent::testDefaultValue(2, ' '),
          ];
          break;

        case 'reviewRating':
          $items[$key] = [
            '@type' => 'Rating',
            'ratingValue' => parent::testDefaultValue(2, ' '),
          ];
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
  public static function outputValue($input_value) {
    return $input_value;
  }

}
