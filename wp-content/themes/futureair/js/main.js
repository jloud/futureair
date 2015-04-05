(function($, undefined) {

  var isFired = false,
      oldReady = jQuery.fn.ready;


  $('#wrapper').addClass('intro-animation');

  $(function() {
    isFired = true;
    $(document).ready();
  });

  jQuery.fn.ready = function(fn) {
    if(fn === undefined) {
      $(document).trigger('_is_ready');
      return;
    }
    if(isFired) {
      window.setTimeout(fn, 1);
    }
    $(document).bind('_is_ready', fn);
  };

  $(function () {

    var $rightContent = $('#right-content'),
        $leftContent = $('#left-content'),
        $wrapper = $('#wrapper'),
        $body = $('body');


    function f() {
      $('#wrapper').removeClass('intro-animation');
      $('.for-logo').fadeOut(2000);
    }
    setTimeout(f, 2000);

    $wrapper.addClass('page-show');
  
    var content = $rightContent.smoothState({
      prefetch: true,
      pageCacheSize: 4,
      onStart: {
        duration: 1000, 
        render: function (url, $container) {
          $wrapper.removeClass('page-show');
        }
      },
      onEnd: {
        duration: 0,
        render: function (url, $container, $content) {
          $container.html($content);
          $body.scrollTop(0);
          $(document).ready();
          $(window).trigger('load');
        }
      },
      callback: function(url, $container, $content){}
    }).data('smoothState');

    $('.com-overlay').on('click', function () {
      $(this).fadeOut(500);
    });

  });

})(jQuery);