<?php

/**
 * @file
 * Metatag integration for the schema_web_site module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_web_site_metatag_info() {
  $info['groups']['schema_web_site'] = array(
    'label' => t('Schema.org: WebSite'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/WebSite')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_web_site',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_web_site.@type'] = array(
    'class' => 'SchemaWebSiteType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of web site.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the web site.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('The url of the web site.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.sameAs'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('sameAs'),
    'description' => t('Url linked to the web site, such as wikipedia page or social profiles.'),
    'multiple' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.publisher'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('publisher'),
    'description' => t('The publisher of the web site.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.potentialAction'] = array(
    'class' => 'SchemaWebSitePotentialAction',
    'label' => t('potentialAction'),
    'description' => t('Potential action that can be accomplished on this site, like SearchAction.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.inLanguage'] = array(
    'label' => t('inLanguage'),
    'description' => t('The language of the content.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.translationOfWork'] = array(
    'class' => 'SchemaIdReferenceBase',
    'label' => t('translationOfWork'),
    'description' => t('The website id that this is a direct translation of.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_site.workTranslation'] = array(
    'class' => 'SchemaIdReferenceBase',
    'label' => t('workTranslation'),
    'description' => t('Translation(s) of this work'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
