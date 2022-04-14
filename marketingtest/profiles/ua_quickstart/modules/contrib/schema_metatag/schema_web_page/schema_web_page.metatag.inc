<?php

/**
 * @file
 * Metatag integration for the schema_web_page module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_web_page_metatag_info() {
  $info['groups']['schema_web_page'] = array(
    'label' => t('Schema.org: WebPage'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/WebPage')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_web_page',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_web_page.@type'] = array(
    'class' => 'SchemaWebPageType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of web page.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the web page.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the web page.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.author'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('author'),
    'description' => 'The author of the web page.',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.publisher'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('publisher'),
    'description' => 'The publisher of the web page.',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.breadcrumb'] = array(
    'class' => 'SchemaItemListElementBreadcrumbBase',
    'label' => t('breadcrumb'),
    'description' => t('The breadcrumb of the web page.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('The url of the web page.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.hasPart'] = array(
    'class' => 'SchemaHasPartBase',
    'label' => t('hasPart'),
    'description' => t('RECOMMENDED BY GOOGLE. Use for <a href="!url">Paywalled content</a>', ['!url' => 'https://developers.google.com/search/docs/data-types/paywalled-content']),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.isAccessibleForFree'] = array(
    'class' => 'SchemaIsAccessibleForFreeBase',
    'label' => t('isAccessibleForFree'),
    'description' => t('RECOMMENDED BY GOOGLE. Use for <a href="!url">Paywalled content</a>', ['!url' => 'https://developers.google.com/search/docs/data-types/paywalled-content']),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.speakable'] = array(
    'class' => 'SchemaSpeakableBase',
    'label' => t('speakable'),
    'description' => t('Speakable property.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.inLanguage'] = array(
    'label' => t('inLanguage'),
    'description' => t('The language of the content.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.translationOfWork'] = array(
    'class' => 'SchemaIdReferenceBase',
    'label' => t('translationOfWork'),
    'description' => t('The website id that this is a direct translation of.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.workTranslation'] = array(
    'class' => 'SchemaIdReferenceBase',
    'label' => t('workTranslation'),
    'description' => t('Translation(s) of this work'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.listElementBreadcrumb'] = array(
    'class' => 'SchemaListElementBreadcrumbBase',
    'label' => t('breadcrumb'),
    'description' => t('Use for <a href="!url">Breadcrumbs</a>', ['!url' => 'https://developers.google.com/search/docs/data-types/breadcrumb']),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
