(function ($, Drupal, window, document, undefined) {

  Drupal.uaqsNavigationSelectMenu = Drupal.uaqsNavigationSelectMenu || {};

  /**
   * Attaches behavior for select menu.
   */
  Drupal.behaviors.uaqsNavigationSelectMenu = {
    attach: function (context, settings) {
      //  uaqs_navigation_select_menu form id's are added in an array depending
      //  on th page you are on, and how many select menus are on the page.
      for ( var i = 0; i < settings.uaqsNavigationSelectMenu.ids.length; i++ ) {
        var selectFormId = settings.uaqsNavigationSelectMenu.ids[i];
        $('#' + selectFormId, context).once('uaqs-navigation-select-menu', function () {
          $('#' + selectFormId + ' .js_select_menu_button', context).on('touchstart click mouseenter mouseleave focus blur', Drupal.uaqsNavigationSelectMenu.handleEvents);
          $('#' + selectFormId + '-menu', context).on('focus mouseenter', Drupal.uaqsNavigationSelectMenu.handleEvents);
          // In MS Edge, onchange events can't be passed through the .on()
          // function for some reason.
          $('#' + selectFormId + '-menu', context).change(Drupal.uaqsNavigationSelectMenu.handleEvents);
          // Document event handlers for events not part of the select menu.
          $(document).on('touchstart', Drupal.uaqsNavigationSelectMenu.handleEvents);
        });
      };
    }
  };

  /**
   * Select menu event handler.
   *
   * Handles mouse and click events for the select menu
   * elements.
   */
  Drupal.uaqsNavigationSelectMenu.handleEvents = function (e) {
    var $this = $(this);
    // Hide the popover when user touches any part of the screen, except the
    // select form button regardless of state.
    if (e.type === 'touchstart') {
      if ($this.hasClass('btn')) {
        e.stopPropagation();
      }
      else {
        $('.uaqs-navigation-select-menu-processed').popover('hide');
        return;
      }
    }
    var $selectForm = $this.closest('form');
    var $selectElement = $selectForm.find('select');
    var $selectInfo = $selectForm.find('.select-info');
    var $selectBtn = $selectForm.find('.btn');
    var selectElementHref = $selectElement.find('option:selected').data('href');
    //  If a navigable link is selected in the dropdown.
    if (selectElementHref.indexOf('%3Cnolink%3E') <= 0) {
      $selectForm.popover('hide');
      $selectElement.attr('aria-invalid', 'false');
      $selectBtn.removeClass('disabled');
      $selectBtn.attr('aria-disabled', 'false');
      $selectBtn.removeAttr('disabled');
      switch (e.type) {
        case 'click':
          // If the link works, don't allow the button to focus.
          e.stopImmediatePropagation();
          window.location = selectElementHref;
          break;
      }
    }
    //  Don't follow link if using the nolink setting.
    else {
      $selectBtn.addClass('disabled');
      $selectBtn.attr('aria-disabled', 'true');
      $selectBtn.attr('disabled', true);
      $selectElement.attr('aria-invalid', 'true');
      switch (e.type) {
        case 'click':
          if ($this.hasClass('btn')) {
            $selectForm.popover('show');
            $selectElement.focus();
          }
          break;

        case 'focus':
        case 'mouseenter':
          if ($this.hasClass('btn')) {
            $selectForm.popover('show');
          }
          else {
            $selectForm.popover('hide');
          }
          break;

        case 'mouseleave':
          $selectForm.popover('hide');
          break;
      }
    }
  };
})(jQuery, Drupal, this, this.document);
