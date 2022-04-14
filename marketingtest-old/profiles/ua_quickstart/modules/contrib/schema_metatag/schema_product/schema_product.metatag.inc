<?php

/**
 * @file
 * Metatag integration for the schema_product module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_product_metatag_info() {
  $info['groups']['schema_product'] = array(
    'label' => t('Schema.org: Product'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Product', '!google_url' => 'https://developers.google.com/search/docs/data-types/product']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_product',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_product.@type'] = array(
    'class' => 'SchemaProductType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of product (fixed by standard).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.name'] = array(
    'label' => t('name'),
    'description' => t('REQUIRED BY GOOGLE. Name of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.brand'] = array(
    'class' => 'SchemaBrandBase',
    'label' => t('brand'),
    'description' => t('REQUIRED BY GOOGLE. The brand of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.category'] = array(
    'label' => t('category'),
    'description' => t('RECOMMENDED BY GOOGLE. The category of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.url'] = array(
    'label' => t('url'),
    'description' => t('RECOMMENDED BY GOOGLE. The url of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.sku'] = array(
    'label' => t('sku'),
    'description' => t('RECOMMENDED BY GOOGLE. Populate one of sku, gtin8, gtin12, gtin13, gtin14, isbn, or mpn.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.gtin8'] = array(
    'label' => t('gtin8'),
    'description' => t('RECOMMENDED BY GOOGLE. Populate one of sku, gtin8, gtin12, gtin13, gtin14, isbn, or mpn.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.gtin12'] = array(
    'label' => t('gtin12'),
    'description' => t('RECOMMENDED BY GOOGLE. Populate one of sku, gtin8, gtin12, gtin13, gtin14, isbn, or mpn.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.gtin13'] = array(
    'label' => t('gtin13'),
    'description' => t('RECOMMENDED BY GOOGLE. Populate one of sku, gtin8, gtin12, gtin13, gtin14, isbn, or mpn.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.gtin14'] = array(
    'label' => t('gtin14'),
    'description' => t('RECOMMENDED BY GOOGLE. Populate one of sku, gtin8, gtin12, gtin13, gtin14, isbn, or mpn.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.isbn'] = array(
    'label' => t('isbn'),
    'description' => t('RECOMMENDED BY GOOGLE. Populate one of sku, gtin8, gtin12, gtin13, gtin14, isbn, or mpn.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.mpn'] = array(
    'label' => t('mpn'),
    'description' => t('RECOMMENDED BY GOOGLE. Populate one of sku, gtin8, gtin12, gtin13, gtin14, isbn, or mpn.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('REQUIRED BY GOOGLE. The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.offers'] = array(
    'class' => 'SchemaOfferBase',
    'label' => t('offers'),
    'description' => t('RECOMMENDED BY GOOGLE. Offers associated with the product.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => t('RECOMMENDED BY GOOGLE. Aggregate rating of the product.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => t('RECOMMENDED BY GOOGLE. Review of the product.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
