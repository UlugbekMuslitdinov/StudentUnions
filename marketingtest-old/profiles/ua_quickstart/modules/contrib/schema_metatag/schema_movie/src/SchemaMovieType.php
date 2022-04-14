<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaMovieType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Movie',
      'Series',
      '- EventSeries',
      '- CreativeWorkSeries',
      '-- BookSeries',
      '-- MovieSeries',
      '-- Periodical',
      '--- ComicSeries',
      '--- Newspaper',
      '-- PodcastSeries',
      '-- RadioSeries',
      '-- TVSeries',
      '-- VideoGameSeries',
      'CreativeWorkSeason',
      '- PodcastSeason',
      '- RadioSeason',
      '- TVSeason',
      'Episode',
      '- PodcastEpisode',
      '- RadioEpisode',
      '- TVEpisode',
    ];
  }

}
