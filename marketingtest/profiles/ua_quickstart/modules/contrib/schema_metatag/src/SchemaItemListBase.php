<?php

/**
 * Provides a plugin for the 'schema_item_list' meta tag.
 */
class SchemaItemListBase extends SchemaNameBase {

  /**
   * {@inheritdoc}
   */
  public function getElement(array $options = array()) {
    $element = parent::getElement($options);
    if (!empty($element)) {
      $view = $options['token data']['view'];
      $id = $view->base_field;
      $entity_type = $view->base_table;
      $key = 1;
      $value = [];
      foreach ($view->result as $item) {
        // If this is a display that does not provide an entity in the result,
        // there is really nothing more to do.
        if (empty($item->$id)) {
          return '';
        }
        // Get the absolute path to this entity.
        $entity = entity_load($entity_type, [$item->$id]);
        $entity = array_shift($entity);
        $uri = entity_uri($entity_type, $entity);
        $url = drupal_get_path_alias($uri['path']);
        $absolute = url($url, array('absolute' => TRUE));
        $value[] = [
          '@type' => 'ListItem',
          'position' => $key,
          'name' => $entity->title,
          'url' => $absolute,
        ];
        $key++;
      }
      foreach ($element['#attached']['drupal_add_html_head'] as $key => $item) {
        if ($item[1] == 'schema_metatag_schema_item_list.itemListElement') {
          $element['#attached']['drupal_add_html_head'][$key][0]['#attributes']['content'] = $value;
        }
      }
    }
    return $element;
  }

}
