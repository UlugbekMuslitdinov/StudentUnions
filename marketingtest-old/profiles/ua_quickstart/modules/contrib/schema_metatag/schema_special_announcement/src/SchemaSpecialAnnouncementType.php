<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaSpecialAnnouncementType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'SpecialAnnouncement',
    ];
  }

}
