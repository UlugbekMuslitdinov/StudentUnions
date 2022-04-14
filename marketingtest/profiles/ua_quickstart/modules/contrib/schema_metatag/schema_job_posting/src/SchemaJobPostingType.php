<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaJobPostingType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'JobPosting',
    ];
  }

}
