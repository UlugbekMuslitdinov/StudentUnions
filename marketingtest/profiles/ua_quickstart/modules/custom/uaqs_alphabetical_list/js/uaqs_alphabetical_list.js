/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {
  Drupal.behaviors.uaqsAlphabeticalListSearch = {
    attach: function (context, settings) {
      $("#uaqs-js-alpha-navigation li", context).each(function (i, li) {
        var group_id = $(this).children().attr('data-href');
        if($(group_id).length != 0 && $(group_id).children(':visible').length) {
          $(this).removeClass('disabled');
          $(this).children().attr('tabindex','0').attr('aria-hidden','false').attr('href', group_id);
        }
        else {
          $(this).addClass('disabled');
          $(this).children().attr('tabindex','-1').attr('aria-hidden','true').removeAttr('href');
        }
      });

      /**
       *  If everything is hidden, display the no results text.
       */
      function uaqsAlphabeticalListCheckNoResults() {

        if ($('.uaqs-js-search-results').children(':visible').length === 0) {
          $('.uaqs-js-no-results').show();
        } else {
          $('.uaqs-js-no-results').hide();
        }
      }

      /**
        *  Disable all alphanav pagination items that have a hidden target or
        *  reenable them if there are search results..
        */
      function uaqsAlphabeticalListResetAlphaNav() {
        $('.uaqs-js-letter-container').each(function () {
          if ($(this).find('.uaqs-js-search-result:visible').length === 0) {
            var uaqsLetterContainerID = '#' + $(this).attr('id');
            var uaqsLetterLink = $('a[data-href="' + uaqsLetterContainerID +'"]');
            uaqsLetterLink.parent().addClass('disabled');
            uaqsLetterLink.attr('tabindex','-1').attr('aria-hidden','true').removeAttr('href');
          }
          else {
            var uaqsLetterContainerID = '#' + $(this).attr('id');
            $('a[data-href="' + uaqsLetterContainerID +'"]').parent().removeClass('disabled');
            $('a[data-href="' + uaqsLetterContainerID +'"]').attr('tabindex','0').attr('aria-hidden','false').attr('href', $(this).attr('id'));
          }
        });
      }

      // Search on each keypress,
      $("#ua-js-bootstrap-search").keyup(function () {
        // Retrieve the input field text
        var filter = $(this).val();
        // Loop through the .uaqs-js-search-result classes
        $(".uaqs-js-search-result").each(function () {
          // If the uaqs-js-search-result item does not contain the text phrase
          // hide it
          if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).children('a').attr('tabindex','0')
            $(this).hide();
          }
          // If the uaqs-js-search-result item does contain the text phrase show it.
          //  Also make sure its letter row container is visible.
          else {
            $(this).children('a').attr('tabindex','0')
            $(this).show();
            $(this).closest('.uaqs-js-letter-container').show();
          }
        });

        // Loop through all letter containers to see if they have any visible
        // content.  If they don't we can hide them.
        $('.uaqs-js-letter-container').each(function () {
          if ($(this).find('.uaqs-js-search-result:visible').length === 0) {
            $(this).hide();
          }
          else {
            $(this).show();
          }
        });
        uaqsAlphabeticalListCheckNoResults();
        uaqsAlphabeticalListResetAlphaNav();
      });
    }
  };

  // Smooth scrolling for jump links.
  // TODO: Scroll to anchor plus fixed_nav_height on page load so we can see the
  // letter section under the floating nav.
  Drupal.behaviors.uaqsAlphabeticalListSmoothAlphaJump = {
    attach: function (context, settings) {

      var $root = $('html, body');
      var breakpoint = 600;

      $('#uaqs-js-alpha-navigation a').on('click', function(event){

        event.preventDefault();
        var $alpha_nav = $('#uaqs-js-floating-alpha-nav', context);
        var href = $.attr(this, 'data-href');
        href = href.replace('_alpha_nav', '');
        var $jump = $('div[id=' + href.substring(1) + ']');
        var fixed_nav_height = $alpha_nav.outerHeight();
        if ($(window).width() <= breakpoint) {
          fixed_nav_height = 0;
        }
        if (!$alpha_nav.hasClass('affix')) {
          fixed_nav_height *= 2;
        }
        $root.animate({
          scrollTop: $jump.offset().top - fixed_nav_height
        }, 500, function () {
          window.location.hash = href + '_alpha_nav';
        });
      });
    }
  };

   // Affix the alphanavigation to the top of the screen when you scroll past
   // it.
   $(window).bind('load', function() {
     var top = $('.view-uaqs-alphabetical-listing').offset().top
     var navHeight = $('#uaqs-js-floating-alpha-nav').innerHeight()
     var innerHeight = $('.view-uaqs-alphabetical-listing').innerHeight()
     var outerHeight = $('body').outerHeight()
     $('#uaqs-js-floating-alpha-nav-container').css('height', navHeight);
     var offsetBottom = outerHeight - innerHeight - top;
     var offsetTop = top;
     $('#uaqs-js-floating-alpha-nav').affix({
         offset: { top: offsetTop, bottom: offsetBottom }
     })
   });

})(jQuery, Drupal, this, this.document);
