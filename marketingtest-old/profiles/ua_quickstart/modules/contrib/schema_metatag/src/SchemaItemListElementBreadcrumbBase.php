<?php

/**
 * All Schema.org Breadcrumb tags should extend this class.
 */
class SchemaItemListElementBreadcrumbBase extends SchemaItemListElementBase {

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {
    $form['value'] = [
      '#type' => 'select',
      '#title' => $this->label(),
      '#default_value' => $this->value(),
      '#empty_option' => $this->t('No'),
      '#empty_value' => '',
      '#options' => [
        'Yes' => $this->t('Yes'),
      ],
      '#description' => $this->description(),
    ];

    // Validation from parent::getForm() got wiped out, so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'Yes';
  }

  /**
   * {@inheritdoc}
   */
  public static function outputValue($input_value) {
    $output_value = parent::outputValue($input_value);
    $items = [];
    if (!empty($output_value)) {
      $items = [
        "@type" => "BreadcrumbList",
        "itemListElement" => $output_value,
      ];
    }
    return $items;
  }

  /**
   * {@inheritdoc}
   */
  public static function getItems($input_value) {
    $values = [];
    if (!empty($input_value)) {
      $breadcrumbs = drupal_get_breadcrumb();

      // Methods on DrupalDefaultMetaTag can't be called statically, and we
      // can't use $this from a static method, so create an empty instance.
      $data = $info = [];
      $processor = new DrupalDefaultMetaTag($data, $info);
      $key = 1;
      foreach ($breadcrumbs as $item) {
        $text = strip_tags($item);
        $url = '';
        $matches = [];
        if (preg_match('/href="([^"]*)"/', $item, $matches)) {
          if (!empty($matches[1])) {
            $url = $matches[1];
            $url = $processor->convertUrlToAbsolute($url);
          }
        }
        $values[$key] = [
          '@id' => $url,
          'name' => $text,
          'item' => $url,
        ];
         $key++;
      }
    }
    return $values;
  }

}
