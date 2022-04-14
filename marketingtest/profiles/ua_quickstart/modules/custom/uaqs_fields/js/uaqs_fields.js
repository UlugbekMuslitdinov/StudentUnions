(function($, Drupal) {
  Drupal.behaviors.uaqs_fields = {
    attach:function() {
      CKEDITOR.on("instanceReady", function(event) {
        $('.cke_button__btgrid_label').text('Grid');
      });
    }
  }
}(jQuery, Drupal));
