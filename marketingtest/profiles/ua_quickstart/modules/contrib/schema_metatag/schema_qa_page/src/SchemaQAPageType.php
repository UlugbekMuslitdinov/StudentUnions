<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaQAPageType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'QAPage',
      'FAQPage',
    ];
  }

}
