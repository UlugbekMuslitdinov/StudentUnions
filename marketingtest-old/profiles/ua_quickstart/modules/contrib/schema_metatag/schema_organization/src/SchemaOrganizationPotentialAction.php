<?php

/**
 * Provides a plugin for the 'schema_organization_potential_action' meta tag.
 */
class SchemaOrganizationPotentialAction extends SchemaActionBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {

    $this->actionTypes = ['TradeAction', 'OrganizeAction'];
    $this->actions = ['OrderAction', 'ReserveAction'];

    $form = parent::getForm($options);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::actionFormKeys('OrganizeAction');
    foreach ($keys as $key) {
      switch ($key) {

        case '@type':
          $items[$key] = 'ReserveAction';
          break;

        case 'target':
          $items[$key] = SchemaEntryPointBase::testValue();
          break;

        case 'result':
          $items[$key] = SchemaThingBase::testValue();
          break;

        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;

      }
    }
    return $items;

  }

}
