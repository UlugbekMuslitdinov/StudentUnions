<?php

/**
 * @file
 * Metatag integration for the schema_image_object module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_image_object_metatag_info() {
  $info['groups']['schema_image_object'] = array(
    'label' => t('Schema.org: ImageObject'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/ImageObject')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_image_object',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_image_object.@type'] = array(
    'class' => 'SchemaImageObjectType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of video file.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the video.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('Absolute URL of the image. If using tokens include the image preset name, and the URL attribute. [node:field_name:image_preset_name:url]. If using referenced entities like Media or Paragraphs, your token would look like [node:field_name:entity:field_name:image_preset_name:url].'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.width'] = array(
    'label' => t('width'),
    'description' => t('The width of the image.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.height'] = array(
    'label' => t('height'),
    'description' => t('The height of the image.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_image_object.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
