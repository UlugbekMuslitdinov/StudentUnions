<?php

/**
 * @file
 * Metatag integration for the schema_book module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_book_metatag_info() {
  $info['groups']['schema_book'] = array(
    'label' => t('Schema.org: Book'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Book', '!google_url' => 'https://developers.google.com/search/docs/data-types/book']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_book',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_book.@type'] = array(
    'class' => 'SchemaBookType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of book.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.name'] = array(
    'label' => t('name'),
    'description' => t('REQUIRED BY GOOGLE. Name of the book.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.author'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('author'),
    'description' => t('REQUIRED BY GOOGLE. Author of the book.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.@id'] = array(
    'label' => t('@id'),
    'description' => t('RECOMMENDED BY GOOGLE. Universally unique id for the book, generally a url.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('REQUIRED BY GOOGLE. Url of the book.'),
    'multiple' => FALSE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.sameAs'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('sameAs'),
    'description' => t('RECOMMENDED BY GOOGLE. Social links and other urls for the book.'),
    'multiple' => FALSE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.workExample'] = array(
    'class' => 'SchemaCreativeWorkBase',
    'label' => t('workExample'),
    'description' => t('REQUIRED BY GOOGLE. Example of the book.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => t('Aggregate rating of the book.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_book.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => t('Review of the book.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
