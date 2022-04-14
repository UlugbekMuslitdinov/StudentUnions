<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaPersonType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Person',
    ];
  }

}
