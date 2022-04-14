<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaArticleType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Article',
      '- NewsArticle',
      '- Report',
      '- ScholarlyArticle',
      '- SocialMediaPosting',
      '-- BlogPosting',
      '- TechArticle',
      '-- APIReference',
    ];
  }

}
