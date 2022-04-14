/**
 * @file
 * Funcion #1 remove orphans from any element with the class no-widows.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */
(function ($, Drupal, document) {

  "use strict"

  Drupal.behaviors.uaqs_featured_content_behavior = {
    attach: function(context, settings) {
      $('.no-widows').each(function(i,d){
        $(document).html($(document).text().replace(/\s(?=[^\s]*$)/g, '&nbsp;'))
      });
    }
  };
})(jQuery, Drupal, this, this.document);
