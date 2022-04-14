<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaBookType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Book',
    ];
  }

}
