<?php

/**
 * @file
 * Metatag integration for the Schema.org Metatag module.
 */

/**
 * Text-based meta tag controller.
 */
class SchemaMetaTagTag extends DrupalTextMetaTag {

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = array()) {
    $options += array(
      'token types' => array(),
    );

    $form['value'] = isset($this->info['form']) ? $this->info['form'] : array();

    $form['value'] += array(
      '#type' => 'textfield',
      '#title' => $this->info['label'],
      '#description' => !empty($this->info['description']) ? $this->info['description'] : '',
      '#default_value' => isset($this->data['value']) ? $this->data['value'] : '',
      '#element_validate' => array('token_element_validate'),
      '#token_types' => $options['token types'],
      '#maxlength' => 1024,
    );

    // Optional handling for items that allow multiple values.
    if (!empty($this->info['multiple'])) {
      $form['value']['#description'] .= ' ' . t('Multiple values may be used, separated by a comma. Note: Tokens that return multiple values will be handled automatically.');
    }

    // Optional handling for images.
    if (!empty($this->info['image'])) {
      $form['value']['#description'] .= ' ' . t('This will be able to extract the URL from an image field.');
    }

    // Optional handling for languages.
    if (!empty($this->info['is_language'])) {
      $form['value']['#description'] .= ' ' . t('This will not be displayed if it is set to the "Language neutral" (i.e. "und").');
    }

    // Optional support for select_or_other.
    if ($form['value']['#type'] == 'select' && !empty($this->info['select_or_other']) && module_exists('select_or_other')) {
      $form['value']['#type'] = 'select_or_other';
      $form['value']['#other'] = t('Other (please type a value)');
      $form['value']['#multiple'] = FALSE;
      $form['value']['#other_unknown_defaults'] = 'other';
      $form['value']['#other_delimiter'] = FALSE;
      $form['value']['#theme'] = 'select_or_other';
      $form['value']['#select_type'] = 'select';
      $form['value']['#element_validate'] = array('select_or_other_element_validate');
    }

    // Support for dependencies, using Form API's #states system.
    // @see metatag.api.php.
    // @see https://api.drupal.org/drupal_process_states
    if (!empty($this->info['dependencies'])) {
      foreach ($this->info['dependencies'] as $specs) {
        $form['value']['#states']['visible'][':input[name*="[' . $specs['dependency'] . '][' . $specs['attribute'] . ']"]'] = array(
          $specs['condition'] => $specs['value'],
        );
      }
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getValue(array $options = array()) {
    $options += array(
      'instance' => '',
      'token data' => array(),
      // Remove any remaining token after the string is parsed.
      'clear' => TRUE,
      'sanitize' => variable_get('metatag_token_sanitize', FALSE),
      'raw' => FALSE,
    );

    $value = $this->data['value'];

    if (empty($options['raw'])) {
      // Give other modules the opportunity to use hook_metatag_pattern_alter()
      // to modify defined token patterns and values before replacement.
      drupal_alter('metatag_pattern', $value, $options['token data'], $this->info['name']);
      $value = token_replace($value, $options['token data'], $options);
    }

    // Special handling for language meta tags.
    if (!empty($this->info['is_language'])) {
      // If the meta tag value equals LANGUAGE_NONE, i.e. "und", then don't
      // output it.
      if (is_string($value) && $value == LANGUAGE_NONE) {
        $value = '';
      }
    }

    // Special handling for images and other URLs.
    if (!empty($this->info['image']) || !empty($this->info['url'])) {
      // Support multiple items, whether it's needed or not. Also remove the
      // empty values.
      $values = array_filter(explode(',', $value));

      // If this meta tag does *not* allow multiple items, only keep the first
      // one.
      if (empty($this->info['multiple']) && !empty($values[0])) {
        $values = array($values[0]);
      }

      foreach ($values as $key => &$image_value) {
        // Remove any unwanted whitespace around the value.
        $image_value = trim($image_value);

        // If this contains embedded image tags, extract the image URLs.
        if (!empty($this->info['image']) && strip_tags($image_value) != $image_value) {
          $matches = array();
          preg_match('/src="([^"]*)"/', $image_value, $matches);
          if (!empty($matches[1])) {
            $image_value = $matches[1];
          }
        }

        // Convert the URL to an absolute URL.
        $image_value = $this->convertUrlToAbsolute($image_value);

        // Replace spaces the URL encoded entity to avoid validation problems.
        $image_value = str_replace(' ', '%20', $image_value);
      }

      // Combine the multiple values into a single string.
      $value = implode(',', $values);
    }

    $value = $this->tidyValue($value);

    // Translate the final output string prior to output. Use the
    // 'output' i18n_string object type, and pass along the meta tag's
    // options as the context so it can be handled appropriately.
    $value = metatag_translate_metatag($value, $this->info['name'], $options, NULL, TRUE);

    return $value;
  }

  /**
   * Get the HTML tag for this meta tag.
   *
   * @return array
   *   A render array for this meta tag.
   */
  public function getElement(array $options = array()) {
    $value = $this->getValue($options);
    if (strlen($value) === 0) {
      return array();
    }

    // The stack of elements that will be output.
    $elements = array();

    // Dynamically add each option to this setting.
    $base_element = isset($this->info['element']) ? $this->info['element'] : array();

    // Single item.
    if (empty($this->info['multiple'])) {
      $values = array($value);
    }

    // Multiple items.
    else {
      $values = array_filter(explode(',', $value));
    }

    // Loop over each item.
    if (!empty($values)) {
      foreach ($values as $ctr => $value) {
        $value = trim($value);

        // Some meta tags must be output as secure URLs.
        if (!empty($this->info['secure'])) {
          $value = str_replace('http://', 'https://', $value);
        }

        // Combine the base configuration for this meta tag with the value.
        $id = 'schema_metatag_' . $this->info['name'] . '_' . $ctr;

        $parts = explode('.', $this->info['name']);
        $element = $base_element + array(
          '#type' => 'html_tag',
          '#tag' => 'meta',
          '#id' => $id,
          '#attributes' => [
            'schema_metatag' => TRUE,
            'group' => $parts[0],
            'name' => $parts[1],
            'content' => $value,
          ],
          '#weight' => $this->info['weight'],
        );

        $elements[] = array($element, $id);
      }
    }
    if (!empty($elements)) {
      return array(
        '#attached' => array('drupal_add_html_head' => $elements),
      );
    }
  }

}
