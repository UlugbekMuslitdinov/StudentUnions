<?php

/**
 * Schema.org MainEntityOfPage items should extend this class.
 */
class SchemaMainEntityOfPageBase extends SchemaNameBase {

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {
    $form = parent::getForm($options);
    $form['value']['#description'] = $this->t("If this is the main content of the page, provide url of the page. i.e. '[current-page:url]'. Only one object on each page should be marked as the main entity of the page.");
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return static::randomUrl();
  }

}
