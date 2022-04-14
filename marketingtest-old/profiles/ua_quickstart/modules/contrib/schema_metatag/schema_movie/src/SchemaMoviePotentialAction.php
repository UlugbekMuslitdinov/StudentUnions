<?php

/**
 * Provides a plugin for the 'schema_movie_potential_action' meta tag.
 */
class SchemaMoviePotentialAction extends SchemaActionBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {

    $this->actionTypes = ['ConsumeAction'];
    $this->actions = ['WatchAction', 'ViewAction'];

    $form = parent::getForm($options);
    return $form;

  }

}
