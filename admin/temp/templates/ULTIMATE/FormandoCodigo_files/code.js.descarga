$(document).ready(function() {
  $('.slider').slider({
    full_width: true
  });
  $('.collapsible').collapsible({
    accordion: false
  });
  $(".owl-demo").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items: 2,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 3]

  });
  $("#owl-demo1").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items: 2,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 3]

  });
  $(".owl-demo2").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    items: 3,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 3]

  });
  

  //hacer imagen mas grande

  $('.materialboxed').materialbox();

  $('.dropdown-button').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrain_width: false, // Does not change width of dropdown to that of the activator
    hover: true, // Activate on hover
    gutter: 0, // Spacing from edge
    belowOrigin: true, // Displays dropdown below the button
    alignment: 'left' // Displays dropdown with edge aligned to the left of button
  });

});

(function($) {
  var LBlog = {

    init: function() {
      var self = this;

      $(document).pjax('a:not(a[target="_blank"])', 'body');
      $(document).on('pjax:start', function() {
        NProgress.start();
      });
      $(document).on('pjax:end', function() {
        NProgress.done();
      });
      $(document).on('pjax:complete', function() {
        NProgress.done();
        self.siteBootUp();
      });

      self.siteBootUp();
    },

    /*
     * Things to be execute when normal page load
     * and pjax page load.
     */
    siteBootUp: function() {
      var self = this;
      self.initExternalLink();
    },
    initExternalLink: function() {
      $('a[href^="http://"], a[href^="https://"]').each(function() {
        var a = new RegExp('/' + window.location.host + '/');
        if (!a.test(this.href)) {
          $(this).click(function(event) {
            event.preventDefault();
            event.stopPropagation();
            window.open(this.href, '_blank');
          });
        }
      });
    },
  }
  window.LBlog = LBlog;
})(jQuery);

$(document).ready(function() {
  LBlog.init();

  // navegacion fixed satrt
  var nav = $('.notification-web');
  $(window).scroll(function() {
    if ($(this).scrollTop() > 20) {
      nav.addClass("dis-n");
    } else {
      nav.removeClass("dis-n");
    }
  });
  // navegacion fixed end
});