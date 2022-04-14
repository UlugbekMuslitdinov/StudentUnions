<?php

/**
 * @file
 * Metatag integration for the schema_item_list module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_item_list_metatag_info() {
  $info['groups']['schema_item_list'] = array(
    'label' => t('Schema.org: ItemList'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/ItemList')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_item_list',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_item_list.@type'] = array(
    'class' => 'SchemaItemListType',
    'label' => t('@type'),
    'description' => t('The type of item list.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_item_list.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_item_list.itemListElement'] = array(
    'class' => 'SchemaItemListElementViewsBase',
    'label' => t('itemListElement'),
    'description' => t('Display the view results as a JSON LD item list'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_item_list.mainEntityOfPage'] = array(
    'label' => t('mainEntityOfPage'),
    'description' => '',
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
        'placeholder' => '[node:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
