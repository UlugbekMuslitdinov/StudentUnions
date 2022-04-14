<?php

/**
 * @file
 * Metatag integration for the schema_article module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_article_metatag_info() {
  $info['groups']['schema_article'] = array(
    'label' => t('Schema.org: Article'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Article', '!google_url' => 'https://developers.google.com/search/docs/data-types/article']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_article',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_article.@type'] = array(
    'class' => 'SchemaArticleType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.headline'] = array(
    'label' => t('headline'),
    'description' => t('REQUIRED BY GOOGLE. Headline of the article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.author'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('author'),
    'description' => t('REQUIRED BY GOOGLE. Author of the article.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.publisher'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('publisher'),
    'description' => t('REQUIRED BY GOOGLE. Publisher of the article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.datePublished'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('datePublished'),
    'description' => t('REQUIRED BY GOOGLE. Date the article was published.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.dateModified'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('dateModified'),
    'description' => t('RECOMMENDED BY GOOGLE. Date the article was last modified.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('REQUIRED BY GOOGLE. The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.mainEntityOfPage'] = array(
    'class' => 'SchemaMainEntityOfPageBase',
    'label' => t('mainEntityOfPage'),
    'description' => 'RECOMMENDED BY GOOGLE. The canonical URL of the article page. Specify mainEntityOfPage when the article is the primary topic of the article page.',
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.hasPart'] = array(
    'class' => 'SchemaHasPartBase',
    'label' => t('hasPart'),
    'description' => t('RECOMMENDED BY GOOGLE. Use for <a href="!url">Paywalled content</a>', ['!url' => 'https://developers.google.com/search/docs/data-types/paywalled-content']),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.isAccessibleForFree'] = array(
    'class' => 'SchemaIsAccessibleForFreeBase',
    'label' => t('isAccessibleForFree'),
    'description' => t('RECOMMENDED BY GOOGLE. Use for <a href="!url">Paywalled content</a>', ['!url' => 'https://developers.google.com/search/docs/data-types/paywalled-content']),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.speakable'] = array(
    'class' => 'SchemaSpeakableBase',
    'label' => t('speakable'),
    'description' => t('Speakable property.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.about'] = array(
    'label' => t('about'),
    'description' => t('Comma separated list of what the article is about, for instance taxonomy terms or categories.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
