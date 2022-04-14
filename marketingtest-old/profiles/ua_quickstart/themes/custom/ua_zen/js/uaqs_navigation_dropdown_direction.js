(function ($, Drupal, window) {
  'use strict';
  /**
   * Attaches behavior to prevent submenu overflow.
   */
  Drupal.behaviors.uaZenDropdownOverflowPrevention = {
    attach: function (context, settings) {
      var navBar = $('#main_nav'); // find main nav
      var navBarSize = navBar.offset().left + navBar.width(); // save its right-most position on the screen

      navBar.find('.dropdown').mouseenter( function () {
        var thisDropdownSize = $(this).find('.dropdown-menu').offset().left + $(this).find('.dropdown-menu').width(); // save dropdown menu right-most position on screen

        if (thisDropdownSize > navBarSize) {
          // if dropdown extends past navBarSize, make right-aligned
          $(this).find('.dropdown-menu').addClass('dropdown-menu-right');
        }
      });
      navBar.find('.dropdown').focusin( function () {
        var thisDropdownSize = $(this).find('.dropdown-menu').offset().left + $(this).find('.dropdown-menu').width(); // save dropdown menu right-most position on screen

        if (thisDropdownSize > navBarSize) {
          // if dropdown extends past navBarSize, make right-aligned
          $(this).find('.dropdown-menu').addClass('dropdown-menu-right');
        }
      });
    }
  };
})(jQuery, Drupal, window);