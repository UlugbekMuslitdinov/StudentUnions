<?php

/**
 * Provides a plugin for the 'schema_date_base' meta tag.
 */
class SchemaDateBase extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {
    $form = parent::getForm($options);
    $form['value']['#description'] .= ' ' . $this->t('Use a token like [node:created:html_datetime].');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return parent::testDefaultValue(1, '');
  }

}
