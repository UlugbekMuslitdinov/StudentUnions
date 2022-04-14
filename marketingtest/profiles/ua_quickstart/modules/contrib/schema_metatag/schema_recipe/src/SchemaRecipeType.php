<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaRecipeType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Recipe',
    ];
  }

}
