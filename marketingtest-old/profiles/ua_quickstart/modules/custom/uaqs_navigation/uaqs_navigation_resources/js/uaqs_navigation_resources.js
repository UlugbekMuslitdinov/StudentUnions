(function ($, Drupal, window) {
  'use strict';
  Drupal.behaviors.copy_resources_nav = {
    attach: function (context, settings) {
      if( $(window).width() < 991 ) {
        // Copy the resources nav into the main nav on page load since we need the menu in two locations.
        var resourcetitle = $("#block-bean-uaqs-resources-bean a.dropdown-toggle").text().trim().toUpperCase();
        if(resourcetitle.length < 1){
          resourcetitle = "RESOURCES";
        }
        var navItemMarkup = [
          '<li class="menu__item menu__item-resources is-expanded last expanded dropdown">',
          '<a href="#" class="nav__link" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">',
          resourcetitle + ' <span class="caret"></span></a></li>',
        ].join('');
        $('#navbar ul.menu').append(navItemMarkup);
        $('#block-bean-uaqs-resources-bean ul.dropdown-menu').clone().appendTo($('.menu__item-resources'));
      }
    }
  };

})(jQuery, Drupal, window);
