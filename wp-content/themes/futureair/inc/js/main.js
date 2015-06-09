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
        urlRoot = location.hostname,
        currUrlFixed = currUrl.replace(/\/$/, '').replace(/.*?:\/\//g, '');

    if(currUrl === urlRoot || currUrlFixed  === urlRoot || urlRoot === 'localhost' &&  $('html').hasClass('js')) {
      $('#wrapper').addClass('intro-animation');
      
      setTimeout(stopIntro, 2500);
    } else {
      $('.site-content').addClass('page-show');
    }
    console.log(currUrl);
    console.log(urlRoot);
    var a = currUrl.replace(/\/$/, '').replace(/.*?:\/\//g, '');
    console.log(a);
  }

  var smoothSettings = {
    prefetch: true,
    pageCacheSize: 4,
    onStart: {
      duration: 1000, 
      render: function (url, $container) {
        $container.removeClass('page-show');
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

        $container.html($content);
        $('body').scrollTop(0);

        if($('#main').hasClass('home-page')) {
          $('#left-content').removeClass('page-default').addClass('page-home');
        } else if ($('#left-content').hasClass('page-default')) {
          console.log('do nothing');
        } else {
          $('#left-content').removeClass('page-home').addClass('page-default');
        }

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

    $('#respond').on('click', function () {
      // $(this).fadeOut(500);
      $('#com-overlay').css({'display':'none'});
    });

    $('body').on('click', function () {
      // $(this).fadeOut(500);
      $(this).css({'display':'none'});
    });

    $('.site-link ul a, .home-link').on('click', function (e) {
      e.preventDefault();
      
      var content  = $rightContent.smoothState(smoothSettings).data('smoothState');
      var href = $(this).attr('href');
      content.load(href);
    });

  });

})(jQuery);