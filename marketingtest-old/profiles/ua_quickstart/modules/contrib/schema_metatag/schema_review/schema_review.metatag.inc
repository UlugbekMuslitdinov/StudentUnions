<?php

/**
 * @file
 * Metatag integration for the schema_review module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_review_metatag_info() {
  $info['groups']['schema_review'] = array(
    'label' => t('Schema.org: Review'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Review', '!google_url' => 'https://developers.google.com/search/docs/data-types/review']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_review',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_review.@type'] = array(
    'class' => 'SchemaReviewType',
    'label' => t('@type'),
    'description' => t('The type of review (fixed by standard).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_review.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the review.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_review.itemReviewed'] = array(
    'class' => 'SchemaThingBase',
    'label' => t('itemReviewed'),
    'description' => t('REQUIRED BY GOOGLE. The item that is being reviewed/rated.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_review.reviewBody'] = array(
    'label' => t('reviewBody'),
    'description' => t('REQUIRED BY GOOGLE. The actual body of the review.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_review.author'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('author'),
    'description' => t('RECOMMENDED BY GOOGLE. The author of this review or rating.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_review.datePublished'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('datePublished'),
    'description' => t('REQUIRED BY GOOGLE. Date the review was published.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_review.reviewRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('reviewRating'),
    'description' => t('RECOMMENDED BY GOOGLE. The rating given in this review.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
