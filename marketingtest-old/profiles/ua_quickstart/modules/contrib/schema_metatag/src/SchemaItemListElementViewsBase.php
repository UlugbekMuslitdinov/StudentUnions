<?php

/**
 * All Schema.org views itemListElement tags should extend this class.
 */
class SchemaItemListElementViewsBase extends SchemaItemListElementBase {

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {
    $form = parent::getForm($options);
    $form['value']['#attributes']['placeholder'] = 'view_name:display_id';
    $form['value']['#description'] = $this->t("Provide the machine name of the view, the machine name of the display, and any argument values, separated by colons, i.e. 'view_name:display_id' or 'view_name:display_id:article.  Use 'view_name:display_id:{{args}}' to pass the page arguments to the view. This will create a <a href=':url'>Summary View</a> list, which assumes each list item contains the url to a view page for the entity. The view rows should contain content (like teaser views) rather than fields for this to work correctly.", [':url' => 'https://developers.google.com/search/docs/guides/mark-up-listings']);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'frontpage:page';
  }

  /**
   * {@inheritdoc}
   */
  public static function getItems($input_value) {
    $values = [];
    $args = explode(':', $input_value);
    if (!empty($args)) {
      $view_id = count($args) > 0 ? array_shift($args) : '';
      // Get the view results.
      $view = views_get_view($view_id);

      $display_id = count($args) > 0 ? array_shift($args) : '';
      $view->set_display($display_id);

      if (count($args) == 1 && $args[0] == '{{args}}') {
        $view_path = explode("/", $view->get_path());
        $query_args = arg();

        $args = [];
        foreach ($query_args as $index => $arg) {
          if (in_array($arg, $view_path)) {
            unset($query_args[$index]);
          }
        }
        if (!empty($query_args)) {
          $args = array_values($query_args);
        }
      }

      if (!empty($args)) {
        $view->set_arguments($args);
      }
      $view->pre_execute();
      $view->execute();

      $id = $view->base_field;
      $entity_type = $view->base_table;
      $values = [];
      foreach ($view->result as $key => $item) {
        // If this is a display that does not provide an entity in the result,
        // there is really nothing more to do.
        if (!empty($item->$id)) {
          // Get the absolute path to this entity.
          $entity = entity_load($entity_type, [$item->$id]);
          $entity = array_shift($entity);
          $uri = entity_uri($entity_type, $entity);
          $url = drupal_get_path_alias($uri['path']);
          $absolute = url($url, array('absolute' => TRUE));
          $values[$key + 1] = [
            '@id' => $url,
            'name' => $entity->title,
            'url' => $absolute,
          ];
        }
      }
    }
    return !empty($values) ? $values : '';
  }

}
