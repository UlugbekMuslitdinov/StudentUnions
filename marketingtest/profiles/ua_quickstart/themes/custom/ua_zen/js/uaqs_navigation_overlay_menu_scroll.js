(function ($, Drupal, window) {
  Drupal.uaZenOverlayMenu = Drupal.uaZenOverlayMenu || {};

  /**
   * Attaches behavior for overlay menu.
   */
  Drupal.behaviors.uaZenOverlayMenuEvents = {
    attach: function (context, settings) {
      if (window.innerWidth >= 991) {
        $('.overlay-menu-scroll li.dropdown > a', context).not('.nolink').addClass('disabled');
      }
      $('.overlay-menu-scroll', context).once('uazen-overlay-menu-keyboard', function () {
        $('.overlay-menu-scroll ul.menu > li a', context).on( "keydown", Drupal.uaZenOverlayMenu.handleKeyboardEvents);
      });
      $('.overlay-menu-scroll', context).once('uazen-overlay-menu-hover', function () {
        $('.overlay-menu-scroll a.dropdown-toggle', context).on( 'mouseout', Drupal.uaZenOverlayMenu.handleHoverEvents);
      });
    }
  };

  // Remove focus on menu item if user has moved on.
  Drupal.uaZenOverlayMenu.handleHoverEvents = function (e) {
    if (window.innerWidth >= 991) {
      $(this).blur().attr('aria-expanded', false).parent().removeClass('open');
    }
  };

  Drupal.uaZenOverlayMenu.removeOpenClass = function ($link) {
    $link.parents('li.open').removeClass('open').first().find('a').attr('aria-expanded', false);
  };

  // Add keyboard arrow button navigation.
  Drupal.uaZenOverlayMenu.handleKeyboardEvents = function (e) {
    // Listen for the up, down, left and right arrow keys, otherwise, end here.
    if ([9,37,38,39,40,27,13,32].indexOf(e.keyCode) === -1) {
      return;
    }
    // Store the reference to our top level link.
    var $link = $(this);

    var $previousParentMenuItems = $link.parents('ul.navbar-nav > li').prevAll('li');
    var $nextParentMenuItems = $link.parents('ul.navbar-nav > li').nextAll('li');
    var $dropdown = $link.parent('li.dropdown').find('.dropdown-menu');
    switch(e.keyCode) {
      case 37: // left arrow pressed.
        // Make sure to stop event bubbling.
        e.preventDefault();
        e.stopPropagation();

        // This is the first item in the top level menu list.
        if ($previousParentMenuItems.first().length === 0) {
          // Focus on the last item in the top level.
          $nextParentMenuItems.last().find('a').first().focus();
          Drupal.uaZenOverlayMenu.removeOpenClass($link);
        } else {
          // Focus on the previous item in the top level.
          $previousParentMenuItems.first().find('a').first().focus();
          Drupal.uaZenOverlayMenu.removeOpenClass($link);
        }
        break;
      case 38: // Up arrow pressed.
        if ($link.parent('li').index() <= 1) {
          $link.parents('li.open').removeClass('open').first().find('a').first().focus().attr('aria-expanded', false);
        }

        // Find the nested element that acts as the menu.
        // If there is a UL available, place focus on the first focusable element within.
        if ($dropdown.length > 0) {
          e.preventDefault();
          e.stopPropagation();

          $dropdown.find('a').filter(':visible').first().focus();
        }
        break;
      case 39: // Right arrow pressed.
        // Make sure to stop event bubbling.
        e.preventDefault();
        e.stopPropagation();

        // This is the last item.
        if ($nextParentMenuItems.first().length === 0) {
          // Focus on the first item in the top level.
          $previousParentMenuItems.last().find('a').first().focus();
          Drupal.uaZenOverlayMenu.removeOpenClass($link);
        } else {
          // Focus on the next item in the top level.
          $nextParentMenuItems.first().find('a').first().focus();
          Drupal.uaZenOverlayMenu.removeOpenClass($link);
        }
        break;
      case 40: // Down arrow pressed.
      case 32: // Spacebar key pressed.
        // Find the nested element that acts as the menu.
        $link.parent('li.dropdown').addClass('open').first().find('a').first().attr('aria-expanded', true);
        // If there is a UL available, place focus on the first focusable element within.
        if ($dropdown.length > 0) {
          // Make sure to stop event bubbling.
          e.preventDefault();
          e.stopPropagation();

          $dropdown.find('a').filter(':visible').first().focus();
        }
        break;
      case 27: // ESC -- escape key pressed.
        // Make sure to stop event bubbling.
        e.preventDefault();
        e.stopPropagation();
        // If there is a UL available, place focus on the first focusable element within.
        $link.parents('li.open').removeClass('open').first().find('a').attr('aria-expanded', false).first().focus();
        break;
      case 13: // Enter key pressed.
        if ($(this).hasClass('nolink') > 0) {
          if ($(this).parent().hasClass('open')) {
            $link.parent('li.dropdown').removeClass('open').first().find('a').first().attr('aria-expanded', false);
          } else {
            // Find the nested element that acts as the menu.
            $link.parent('li.dropdown').addClass('open').first().find('a').first().attr('aria-expanded', true);
            // If there is a UL available, place focus on the first focusable element within.
            if ($dropdown.length > 0) {
              // Make sure to stop event bubbling.
              e.preventDefault();
              e.stopPropagation();

              $dropdown.find('a').filter(':visible').first().focus();
            }
          }
        }
        break;
      case 9: // Tab key press.
        // On dropdown if last child item and you tab once more, it will close the dropdown.
        if ($(this).parent().hasClass('last')) {
          $(this).blur(function() {
            Drupal.uaZenOverlayMenu.removeOpenClass($link);
          });
        }
        break;
    }
  };

  // Shows overlay menu.
  Drupal.uaZenOverlayMenu.uaZenShowNav = function () {
    $('html').removeClass('overlay-menu-scroll-hide').addClass('overlay-menu-scroll-show');
    $('.overlay-menu-scroll-toggle button.navbar-toggle').attr('aria-expanded', 'true');
    $('.overlay-menu-scroll').attr('aria-expanded', 'true');
    $('.overlay-menu-scroll').addClass('collapse in');
  };

  // Hides overlay menu.
  Drupal.uaZenOverlayMenu.uaZenHideNav = function () {
    $('html').removeClass('overlay-menu-scroll-show').addClass('overlay-menu-scroll-hide');
    $('.overlay-menu-scroll-toggle button.navbar-toggle').attr('aria-expanded', 'false');
    $('.overlay-menu-scroll').attr('aria-expanded', 'false');
    $('.overlay-menu-scroll').removeClass('in');
    $('.overlay-menu-scroll li.dropdown a').attr('aria-expanded', 'false');
  };

  $(window).on('load', function () {
    // Get the scroll width.
    var $uaZenNavbarScroller = $('.navbar-scroller');
    var $uaZenMaxScrollLeft = $uaZenNavbarScroller[0].scrollWidth - $uaZenNavbarScroller[0].clientWidth;

    // Scroll all the way right first, then delay and scroll left.
    $uaZenNavbarScroller.scrollLeft($uaZenMaxScrollLeft);
    $uaZenNavbarScroller.delay(1000).animate({
      scrollLeft: 0
    }, 500);

    // Adds clone of parent menu as overview menu item.
    var $primaryDropdownMenuItemContents = $('.overlay-menu-scroll ul li.dropdown > a');
    $.each($primaryDropdownMenuItemContents, function (index, value) {
      var uaZenHrefValue = $primaryDropdownMenuItemContents[index];
      var uaZenNewLink = '<li class="uaqs-cloned-link hidden-lg hidden-md"><a href="' + uaZenHrefValue + '">Overview</a></li>';
      var $uaZenDropdownUnorderedList = $(value).parent();
      var $uaZenNolinkMenuItem = $(value).hasClass('nolink');
      var $uaZenResourcesMenuItem = $(value).parent().hasClass('menu__item-resources');

      if ($uaZenNolinkMenuItem || $uaZenResourcesMenuItem) {
        return;
      }
      else {
        $($uaZenDropdownUnorderedList).children('.dropdown-menu').prepend(uaZenNewLink);
      }
    });
  });

  // Enable/disable menu buttons on resize.
  $(window).on('resize', function (e) {
    if (window.innerWidth >= 991) {
      $('.overlay-menu-scroll').off();
      Drupal.uaZenOverlayMenu.uaZenHideNav();
      return;
    }
  });

  // Enable or disable bootstrap default dropdown toggle functions depending on
  // the viewport width.
  $(window).on('load resize', function (e) {
    // All should happen if screen size is larger than 991px.
    if (window.innerWidth >= 991) {
      var $primaryDropdownMenuItem = $('.overlay-menu-scroll ul li.dropdown');

      $primaryDropdownMenuItem.hover(
        function () {
          $(this).first().find('a').attr('aria-expanded', 'true');
        }, function() {
          $(this).first().find('a').attr('aria-expanded', 'false');
        }
      );
      return;
    }
    else if (window.innerWidth < 991) {
      // If overlay menu is present, keyboard functionality will still work.
      $('#navbar').keyup(function (e) {
        switch(e.keyCode) {
          case 27: // ESC -- escape key pressed.
            Drupal.uaZenOverlayMenu.uaZenHideNav();
            break;
          case 32: // Spacebar key pressed.
          case 40: // Down arrow pressed.
            Drupal.uaZenOverlayMenu.uaZenShowNav();
            break;
        }
      });
      // Overrides when to body scroll and menu scroll.
      $('.overlay-menu-scroll').on('show.bs.collapse', function () {
        Drupal.uaZenOverlayMenu.uaZenShowNav();
      });

      $('.overlay-menu-scroll-hide #navbar').on('show.bs.dropdown', function () {
        Drupal.uaZenOverlayMenu.uaZenShowNav();
      });

      $('.overlay-menu-scroll').on('hide.bs.collapse', function () {
        Drupal.uaZenOverlayMenu.uaZenHideNav();
      });
    }
  });
})(jQuery, Drupal, window);
