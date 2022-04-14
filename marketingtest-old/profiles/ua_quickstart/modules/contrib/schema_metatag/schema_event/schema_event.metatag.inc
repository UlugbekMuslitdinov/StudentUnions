<?php

/**
 * @file
 * Metatag integration for the schema_event module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_event_metatag_info() {
  $info['groups']['schema_event'] = array(
    'label' => t('Schema.org: Event'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Event', '!google_url' => 'https://developers.google.com/search/docs/data-types/event']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_event',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_event.@type'] = array(
    'class' => 'SchemaEventType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of event.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.name'] = array(
    'label' => t('name'),
    'description' => t('REQUIRED BY GOOGLE. The name of the event.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('RECOMMENDED BY GOOGLE. The primary image for this event.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the event.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.isAccessibleForFree'] = array(
    'label' => t('isAccessibleForFree'),
    'description' => t('RECOMMENDED BY GOOGLE. Use for <a href="!url">Paywalled content</a>', ['!url' => 'https://developers.google.com/search/docs/data-types/paywalled-content']),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.startDate'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('startDate'),
    'description' => t('REQUIRED BY GOOGLE. Date and time when the event starts.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.endDate'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('endDate'),
    'description' => t('RECOMMENDED BY GOOGLE. Date and time when the event ends.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.previousStartDate'] = array(
      'class' => 'SchemaDateBase',
      'label' => t('previousStartDate'),
      'description' => t('RECOMMENDED BY GOOGLE. The previousStartDate of the event.'),
      'weight' => ++$weight,
    ) + $defaults;

  $info['tags']['schema_event.eventAttendanceMode'] = array(
      'label' => t('eventAttendanceMode'),
      'description' => t('RECOMMENDED BY GOOGLE. The eventAttendanceMode of the event. Valid values are https://schema.org/OfflineEventAttendanceMode, https://schema.org/MixedEventAttendanceMode, or https://schema.org/OnlineEventAttendanceMode.'),
      'weight' => ++$weight,
    ) + $defaults;

  $info['tags']['schema_event.eventStatus'] = array(
    'label' => t('eventStatus'),
    'description' => t('RECOMMENDED BY GOOGLE. The status of the event. Valid options are https://schema.org/EventCancelled, https://schema.org/EventMovedOnline, https://schema.org/EventPostponed, https://schema.org/EventRescheduled, or https://schema.org/EventScheduled.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.location'] = array(
    'class' => 'SchemaPlaceBase',
    'label' => t('location'),
    'description' => t('REQUIRED BY GOOGLE. The location of the event.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.organizer'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('performer'),
    'description' => t('RECOMMENDED BY GOOGLE. The organizer of the event.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.performer'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('performer'),
    'description' => t('RECOMMENDED BY GOOGLE. The performer(s) in the event.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.offers'] = array(
    'class' => 'SchemaOfferBase',
    'label' => t('offers'),
    'description' => t('RECOMMENDED BY GOOGLE. Offers associated with the event.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('The url of the event.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.doorTime'] = array(
    'label' => t('doorTime'),
    'description' => t('The time when admission will commence.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_event.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
