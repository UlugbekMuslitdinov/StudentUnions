<?php

/**
 * @file
 * Metatag integration for the schema_video_object module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_video_object_metatag_info() {
  $info['groups']['schema_video_object'] = array(
    'label' => t('Schema.org: VideoObject'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/VideoObject', '!google_url' => 'https://developers.google.com/search/docs/data-types/video']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_video_object',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_video_object.@type'] = array(
    'class' => 'SchemaVideoObjectType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of video file.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.name'] = array(
    'label' => t('name'),
    'description' => t('REQUIRED BY GOOGLE. Name of the video.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.description'] = array(
    'label' => t('description'),
    'description' => t('REQUIRED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.uploadDate'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('uploadDate'),
    'description' => t('REQUIRED BY GOOGLE. The date the video was first published, in ISO 8601 format.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.expires'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('expires'),
    'description' => t("RECOMMENDED BY GOOGLE. If applicable, the date after which the video will no longer be available, in ISO 8601 format. Don't supply this information if your video does not expire."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.thumbnailUrl'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('thumbnailUrl'),
    'description' => t('REQUIRED BY GOOGLE. The thumbnail URL of the video.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.contentUrl'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('contentUrl'),
    'description' => t('RECOMMENDED BY GOOGLE. A URL pointing to the actual video media file.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.embedUrl'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('embedUrl'),
    'description' => t('RECOMMENDED BY GOOGLE. A URL pointing to a player for the specific video. Usually this is the information in the src element of an <embed> tag.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.duration'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('duration'),
    'description' => t('RECOMMENDED BY GOOGLE. The video duration in seconds or ISO 8601 format.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.interactionCount'] = array(
    'label' => t('interactionCount'),
    'description' => t('RECOMMENDED BY GOOGLE. The number of times the video has been viewed.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.transcript'] = array(
    'label' => t('transcript'),
    'description' => t('The transcript of the video.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_video_object.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
