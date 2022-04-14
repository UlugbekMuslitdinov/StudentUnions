<?php

/**
 * All Schema.org tags should extend this class.
 */
class SchemaNameBase extends DrupalTextMetaTag {

  /**
   * Wrappers to create D7 methods that match D8 format.
   *
   * To make it possible to re-use some D8 code.
   */

  /**
   * {@inheritdoc}
   */
  public function t($str, $args = []) {
    return t($str, $args);
  }

  /**
   * {@inheritdoc}
   */
  public function getPluginId() {
    return $this->info['name'];
  }

  /**
   * {@inheritdoc}
   */
  public function label() {
    return $this->info['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function description() {
    return $this->info['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function multiple() {
    return !empty($this->info['multiple']);
  }

  /**
   * {@inheritdoc}
   */
  public function value() {
    return !empty($this->data['value']) ? $this->data['value'] : '';
  }

  /**
   * The #states visibility selector for this element.
   */
  protected function visibilitySelector() {
    return 'metatags[und][' . $this->info['name'] . '][value]';
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = array()) {

    $form = parent::getForm($options);

    // Add a validation callback to serialize nested arrays.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getElement(array $options = array()) {
    $this->options = $options;
    $value = SchemaMetatagManager::unserialize($this->value());

    // If this is a complex array of value, process the array.
    if (is_array($value)) {

      // Clean out empty values.
      $value = SchemaMetatagManager::arrayTrim($value);
    }

    if (empty($value)) {
      return '';
    }
    // If this is a complex array of values, process the array.
    elseif (is_array($value)) {

      // If the item is an array of values,
      // walk the array and process the values.
      array_walk_recursive($value, 'static::processItem');

      // Recursively pivot each branch of the array.
      $value = static::pivotItem($value);

    }
    // Process a simple string.
    else {
      $this->processItem($value);
    }
    $parts = explode('.', $this->info['name']);
    $id = 'schema_metatag_' . $this->info['name'];
    $element = [
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => [
        'schema_metatag' => TRUE,
        'group' => $parts[0],
        'name' => $parts[1],
        'content' => static::outputValue($value),
      ],
    ];
    return array(
      '#attached' => array('drupal_add_html_head' => array(array($element, $id))),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function pivotItem($array) {
    // See if any nested items need to be pivoted.
    // If pivot is set to 0, it would have been removed as an empty value.
    if (array_key_exists('pivot', $array)) {
      unset($array['pivot']);
      $array = SchemaMetatagManager::pivot($array);
    }
    foreach ($array as $key => &$value) {
      if (is_array($value)) {
        $value = static::pivotItem($value);
      }
    }
    return $array;
  }

  /**
   * Nested elements that cannot be exploded.
   *
   * @return array
   *   Array of keys that might contain commas, or otherwise cannot be exploded.
   */
  public static function neverExplode() {
    return [
      'streetAddress',
      'reviewBody',
      'recipeInstructions',
    ];
  }


  /**
   * Process an individual item.
   *
   * This is a copy of the original processing done by Metatag module,
   * but applied to every item on the array of values.
   */
  protected function processItem(&$value, $key = 0) {

    $explode = $key === 0 ? $this->multiple() : !in_array($key, static::neverExplode());

    // $this->getValue() will process all subelements of our array
    // but not all of them need that processing.
    // Swap in the individual values/info as though they were the only
    // values, do the processing, then return to the original values.
    $backup_data = $this->data;
    $backup_info = $this->info;

    $this->data['value'] = $value;
    if (!empty($this->info['url'])) {
      $this->info['url'] = $this->info['url'] && in_array($key, ['url', 'sameAs']);
    }
    if (!empty($this->info['image'])) {
      $this->info['image'] = $this->info['image'] && in_array($key, ['url']);
    }

    $value = $this->getValue($this->options);

    if ($explode) {
      $value = SchemaMetatagManager::explode($value);
      // Clean out any empty values that might have been added by explode().
      if (is_array($value)) {
        $value = array_filter($value);
      }
    }

    // Swap back in the original values.
    $this->data = $backup_data;
    $this->info = $backup_info;

  }

  /**
   * Transform input value to its display output.
   *
   * Tags that need to transform the output to something different than the
   * stored value should extend this method and do the transformation here.
   *
   * @param mixed $input_value
   *   Input value, could be either a string or array. This will be the
   *   unserialized value stored in the tag configuration, after token
   *   replacement.
   *
   * @return mixed
   *   Return the (possibly expanded) value which will be rendered in JSON-LD.
   */
  public static function outputValue($input_value) {
    return $input_value;
  }

  /**
   * Provide a test input value for the property that will validate.
   *
   * Tags like @type that contain values other than simple strings, for
   * instance a list of allowed options, should extend this method and return
   * a valid value.
   *
   * @return mixed
   *   Return the test value, either a string or array, depending on the
   *   property.
   */
  public static function testValue() {
    return static::testDefaultValue(2, ' ');
  }

  /**
   * Provide a test output value for the input value.
   *
   * Tags that return values in a different format than the input, like
   * values that are exploded, should extend this method and return
   * a valid value.
   *
   * @param mixed $items
   *   The input value, either a string or an array.
   *
   * @return mixed
   *   Return the correct output value.
   */
  public static function processedTestValue($items) {
    return $items;
  }

  /**
   * Explode a test value.
   *
   * For test values, emulates the extra processing a multiple value would get.
   *
   * @param array $items
   *   The input value, either a string or an array.
   *
   * @return mixed
   *   Return the correct output value.
   */
  public static function processTestExplodeValue($items) {
    if (!is_array($items)) {
      $items = SchemaMetatagManager::explode($items);
      // Clean out any empty values that might have been added by explode().
      if (is_array($items)) {
        array_filter($items);
      }
    }
    return $items;
  }

  /**
   * Random absolute url for testing.
   *
   * @return string
   *   A random absolute url.
   */
  public static function randomUrl() {
    return 'http://google.com/' . static::testDefaultValue(1, '');
  }

  /**
   * Provide a random test value.
   *
   * A helper function to create a random test value. Use the delimiter to
   * create comma-separated values, or a few "words" separated by spaces.
   *
   * @param int $count
   *   Number of "words".
   * @param int $delimiter
   *   Delimiter used to connect "words".
   *
   * @return mixed
   *   Return the test value, either a string or array, depending on the
   *   property.
   */
  public static function testDefaultValue($count = NULL, $delimiter = NULL) {
    $items = [];
    $min = 1;
    $max = isset($count) ? $count : 2;
    $delimiter = isset($delimiter) ? $delimiter : ' ';
    for ($i = $min; $i <= $max; $i++) {
      $items[] = SchemaMetatagManager::randomMachineName();
    }
    return implode($delimiter, $items);
  }

}
