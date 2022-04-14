(function($, Drupal, window, document) {
  'use strict';
  function UaqsContentChunksFullWidthMediaRowBgdraw() {
    var marquees = document.getElementsByClassName('uaqs_full_width_media_row_bg');
    var bgColorMap = [];
    bgColorMap['none'] = 'none';
    bgColorMap['bg-transparent'] = 'rgba(0, 0, 0, 0)';
    bgColorMap['bg-trans-white'] = 'rgba(255, 255, 255, 0.63)';
    bgColorMap['bg-trans-black'] = 'rgba(0, 0, 0, 0.73)';
    for (var i = 0, len = marquees.length; i < len; i++) {
      var c = marquees[i];
      var data = marquees[i].dataset;
      // only draw the cutout if there is a btn and a background color.
      if (data.bgColor !== 'bg-transparent' &&  c.parentElement.getElementsByClassName('btn').length > 0 ) {
        var marqueeContainer = c.parentElement.getBoundingClientRect();
        var button = c.parentElement.getElementsByClassName('btn')[0];
        var buttonPosition = button.getBoundingClientRect();
        var ctx = c.getContext('2d');
        ctx.canvas.width = marqueeContainer.width;
        ctx.canvas.height = marqueeContainer.height;
        ctx.fillStyle = bgColorMap[data.bgColor];
        var startx = 0;
        var starty = 0;
        var endx = marqueeContainer.width;
        var endy = marqueeContainer.height;
        var caretystart = (buttonPosition.top + (33/100) * buttonPosition.height) - marqueeContainer.top;
        var caretx = buttonPosition.height/2 - ((33/100) * buttonPosition.height);
        var caretymid = (buttonPosition.top + buttonPosition.height/2) - marqueeContainer.top;
        var caretyend = buttonPosition.top + buttonPosition.height - ((33/100) * buttonPosition.height) - marqueeContainer.top;
        ctx.beginPath();
        ctx.moveTo(startx, starty);
        if (data.viewMode == 'uaqs_bg_img_content_right') {
          ctx.lineTo(startx, caretystart);
          ctx.lineTo(caretx, caretymid);
          ctx.lineTo(startx, caretyend);
        }
        ctx.lineTo(startx, endy);
        ctx.lineTo(endx, endy);
        if (data.viewMode == 'uaqs_bg_img_content_left') {
          ctx.lineTo(endx, caretyend);
          ctx.lineTo(marqueeContainer.width - buttonPosition.height/2 + ((33/100) * buttonPosition.height), caretymid);
          ctx.lineTo(marqueeContainer.width, caretystart );
          ctx.lineTo(endx, endy);
        }
        ctx.lineTo(endx, starty);
        ctx.closePath();
        ctx.fill();
        c.parentElement.classList.remove(data.bgColor);
      }
    }
  }

  // Draw the canvas on window load and redraw on resize.
  $(window).on('load resize',function (e) {
    UaqsContentChunksFullWidthMediaRowBgdraw();
  });

}(jQuery, Drupal, window, document));