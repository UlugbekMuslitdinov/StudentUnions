<?php

/**
 * Provides a plugin for the 'schema_url_base' meta tag.
 */
class SchemaUrlBase extends SchemaNameBase {

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return static::randomUrl();
  }

}
