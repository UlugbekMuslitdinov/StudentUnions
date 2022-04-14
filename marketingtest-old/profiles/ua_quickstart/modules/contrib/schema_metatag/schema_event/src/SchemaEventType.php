<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaEventType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Event',
      'BusinessEvent',
      'ChildrensEvent',
      'ComedyEvent',
      'CourseInstance',
      'DanceEvent',
      'DeliveryEvent',
      'EducationEvent',
      'ExhibitionEvent',
      'Festival',
      'FoodEvent',
      'LiteraryEvent',
      'MusicEvent',
      'PublicationEvent',
      '- BroadcastEvent',
      '- OnDemandEvent',
      'SaleEvent',
      'ScreeningEvent',
      'SocialEvent',
      'SportsEvent',
      'TheaterEvent',
      'VisualArtsEvent',
    ];
  }

}
