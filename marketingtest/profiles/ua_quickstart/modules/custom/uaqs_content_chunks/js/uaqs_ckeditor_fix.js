/**
 * @file
 * A JavaScript file to fix a missing ckeditor path.
 *
 */

(function (Drupal, window) {
  "use strict";

  // CKEditor expects this variable to exist prior to its script being loaded.
  if (typeof window.CKEDITOR_BASEPATH == 'undefined') {
    if (typeof Drupal.settings.uaqsCkeditorFixPath != 'undefined') {
      // UADIGITAL-1999: Editor Module CKEditor AJAX Issue.
      // Provide default basepath to avoid ckeditor AJAX problems.
      // https://bugs.jquery.com/ticket/11795#comment:20
      // https://www.drupal.org/project/editor/issues/2813293
      window.CKEDITOR_BASEPATH = Drupal.settings.uaqsCkeditorFixPath;
    }
  }

})(Drupal, window);
