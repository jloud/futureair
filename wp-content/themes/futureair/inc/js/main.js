(function($, undefined) {

  var isFired = false,
      oldReady = jQuery.fn.ready;

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

  function stopIntro() {
    $('#wrapper').removeClass('intro-animation');
    $('.site-content').addClass('page-show');
  }
  
  function onLanding() {
    var currUrl = document.URL,
        urlRoot = location.hostname;

    if(currUrl === urlRoot || urlRoot === 'louden.io' || currUrl === 'http://localhost:8888/futureair/' &&  $('html').hasClass('js')) {
      $('#wrapper').addClass('intro-animation');
      
      setTimeout(stopIntro, 2500);
    } else {
      $('.site-content').addClass('page-show');
    }
    console.log(currUrl);
    console.log(urlRoot);
  }

  var smoothSettings = {
    prefetch: true,
    pageCacheSize: 4,
    onStart: {
      duration: 1000, 
      render: function (url, $container) {
        $container.removeClass('page-show');
        // $('body').addClass('is-exiting');
        if(!$('body').hasClass('smooth-ran')) {
          $('body').addClass('smooth-ran');
        }
      }
    },
    onEnd: {
      duration: 1000,
      render: function (url, $container, $content) {
        $('body').find("a").css("cursor", "auto");
        $('body').css("cursor", "auto");
        // $('body').removeClass('is-exiting');
        $container.html($content);
        $('body').scrollTop(0);
        $(document).ready();
        $(window).trigger('load');
        $container.addClass('page-show');
      }
    }
  }

  $(function () {

    var $rightContent = $('#right-content'),
        $leftContent = $('#left-content'),
        $wrapper = $('#wrapper'),
        $body = $('body');

    if(!$('body').hasClass('smooth-ran')) {
      onLanding();
    }

    var content = $rightContent.smoothState(smoothSettings).data('smoothState');

    $('.com-overlay').on('click', function () {
      $(this).fadeOut(500);
    });

    $('.site-link ul a, .home-link').on('click', function (e) {
      e.preventDefault();
      
      var content  = $rightContent.smoothState(smoothSettings).data('smoothState');
      var href = $(this).attr('href');
      content.load(href);
    });

  });

})(jQuery);