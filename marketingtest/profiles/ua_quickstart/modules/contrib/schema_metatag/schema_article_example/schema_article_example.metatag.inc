<?php

/**
 * @file
 * Metatag integration for the schema_article_example module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_article_example_metatag_info() {

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_article_example',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_article.typicalAgeRange'] = array(
    'class' => 'SchemaNameBase',
    'label' => t('typicalAgeRange'),
    'description' => t('The applicable age range of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
