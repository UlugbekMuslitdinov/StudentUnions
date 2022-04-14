(function($, Drupal, window, document) {
  'use strict';

  Drupal.uaqsContentChunks = Drupal.uaqsContentChunks || {};

  // Set background image once the image downloads
  Drupal.uaqsContentChunks.renderBgImages = function() {
    $.each(Drupal.settings.uaqsContentChunks.bgImages, function (index, value ) {
      var img = $(value).css('background-image');
      img = img.replace(/(url\(|\)|")/g, '');
      if (img != 'none') {
        $('<img/>').attr('src', img).on('load', function() {
           $(this).remove(); // prevent memory leaks
           $(value).css('background-image', 'url(' + img + ')');
        });
      }
    });
  }

  // Make sure images get set on window load and resize.
  $(window).on('load resize',function (e) {
    Drupal.uaqsContentChunks.renderBgImages();
  });

}(jQuery, Drupal, window, document));