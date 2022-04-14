<?php

/**
 * @file
 * Metatag integration for the schema_place module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_place_metatag_info() {
  $info['groups']['schema_place'] = array(
    'label' => t('Schema.org: Place'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Place')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_place',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_place.@type'] = array(
    'class' => 'SchemaPlaceType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of Place (fixed by standard).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_place.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the Place.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_place.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the Place.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_place.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this Place.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_place.telephone'] = array(
    'label' => t('telephone'),
    'description' => t('The telephone number associated with the Place.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_place.url'] = array(
    'label' => t('url'),
    'description' => t('The url associated with the Place.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_place.address'] = array(
    'class' => 'SchemaAddressBase',
    'label' => t('address'),
    'description' => t('The address of the place.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_place.geo'] = array(
    'class' => 'SchemaGeoBase',
    'label' => t('geo'),
    'description' => t('The geographic coordinates of the Place.'),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
