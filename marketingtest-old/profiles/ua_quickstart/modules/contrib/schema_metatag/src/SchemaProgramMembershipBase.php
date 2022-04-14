<?php

/**
 * Schema.org ProgramMembership items should extend this class.
 */
class SchemaProgramMembershipBase extends SchemaNameBase {

  use SchemaProgramMembershipTrait;

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {

    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $value,
      '#required' => isset($options['#required']) ? $options['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector(),
    ];

    $form['value'] = $this->programMembershipForm($input_values);

    if (empty($this->multiple())) {
      unset($form['value']['pivot']);
    }

    // Validation from parent::getForm() got wiped out, so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::programMembershipFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'ProgramMembership';
          break;

        case 'hostingOrganization':
        case 'member':
          $items[$key] = SchemaPersonOrgBase::testValue();
          break;

        case 'image':
          $items[$key] = SchemaImageBase::testValue();
          break;

        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;

      }
    }
    return $items;
  }

  /**
   * {@inheritdoc}
   */
  public static function processedTestValue($items) {
    foreach ($items as $key => $value) {
      switch ($key) {
        case 'hostingOrganization':
        case 'member':
          $items[$key] = SchemaPersonOrgBase::processedTestValue($items[$key]);
          break;

        case 'image':
          $items[$key] = SchemaImageBase::processedTestValue($items[$key]);
          break;

      }
    }
    return $items;
  }

}
