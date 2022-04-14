<?php

/**
 * Provides a plugin for the 'schema_web_site_potential_action' meta tag.
 */
class SchemaWebSitePotentialAction extends SchemaActionBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {

    $this->actionTypes = ['SearchAction'];
    $this->actions = ['SearchAction'];

    $form = parent::getForm($options);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::actionFormKeys('SearchAction');
    foreach ($keys as $key) {
      switch ($key) {

        case '@type':
          $items[$key] = 'SearchAction';
          break;

        case 'target':
          $items[$key] = SchemaEntryPointBase::testValue();
          break;

        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;

      }
    }
    return $items;

  }

}
