<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaReviewType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Review',
      'UserReview',
      'CriticReview',
      'EmployerReview',
      'ClaimReview',
    ];
  }

}
