<?php

/**
 * Provides a plugin for the 'schema_movie_has_part' meta tag.
 */
class SchemaMovieHasPart extends SchemaHasPartBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {

    $form = parent::getForm($options);

    // Limit potential actions to WatchAction.
    $form['value']['potentialAction']['actionType']['#options'] = ['ConsumeAction' => 'ConsumeAction'];
    $form['value']['potentialAction']['ConsumeAction']['@type']['#options'] = [
      'WatchAction' => $this->t('WatchAction'),
    ];
    return $form;

  }

}
