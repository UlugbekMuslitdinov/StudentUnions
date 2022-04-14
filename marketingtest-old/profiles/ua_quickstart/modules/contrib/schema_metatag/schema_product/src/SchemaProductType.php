<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaProductType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Product',
      'IndividualProduct',
      'ProductModel',
      'SomeProducts',
      'Vehicle',
      '- Car',
    ];
  }

}
