<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaWebPageType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'WebPage',
      'ItemPage',
      'AboutPage',
      'CheckoutPage',
      'ContactPage',
      'CollectionPage',
      '- ImageGallery',
      '- VideoGallery',
      'ProfilePage',
      'SearchResultsPage',
    ];
  }

}
